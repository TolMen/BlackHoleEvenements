<?php

/**
 * Routeur minimaliste : associe une méthode HTTP + un chemin à un contrôleur.
 *
 * Les routes peuvent contenir des paramètres dynamiques entre accolades,
 * ex. /actualites/{slug}. La valeur capturée est passée à la méthode du
 * contrôleur dans l'ordre de déclaration.
 */
class Router
{
    /** @var array<string,array<string,array{0:string,1:string}>> */
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    /** Enregistre la même cible en GET et en POST. */
    public function any(string $path, array $handler): void
    {
        $this->get($path, $handler);
        $this->post($path, $handler);
    }

    public function dispatch(): void
    {
        set_exception_handler(function (Throwable $e) {
            error_log('[Router] Exception : ' . $e->getMessage());
            $this->renderError(500);
        });

        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri    = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $uri    = rawurldecode($uri);

        // Retire le sous-dossier d'installation éventuel (/BlackHoleEvenements).
        $base = BASE_PATH;
        if ($base !== '' && str_starts_with($uri, $base)) {
            $uri = substr($uri, strlen($base));
        }

        // Normalisation : une seule URL par page, sans slash final.
        // Évite le contenu dupliqué (/services et /services/ pour Google).
        $normalized = '/' . trim($uri, '/');

        if ($method === 'GET' && $uri !== $normalized && $uri !== '') {
            header('Location: ' . BASE_PATH . $normalized, true, 301);
            exit;
        }

        $uri = $normalized;

        // ── 1. Correspondance exacte ─────────────────────────
        if (isset($this->routes[$method][$uri])) {
            [$class, $action] = $this->routes[$method][$uri];
            (new $class())->$action();
            return;
        }

        // ── 2. Correspondance dynamique ({param}) ────────────
        foreach ($this->routes[$method] ?? [] as $path => $handler) {
            $params = $this->match($path, $uri);
            if ($params !== null) {
                [$class, $action] = $handler;
                (new $class())->$action(...array_values($params));
                return;
            }
        }

        // ── 3. Aucune route trouvée ──────────────────────────
        $this->renderError(404);
    }

    /**
     * Confronte une route dynamique à l'URI demandée.
     *
     * @return array<string,string>|null Les paramètres, ou null sans correspondance.
     */
    private function match(string $path, string $uri): ?array
    {
        if (!str_contains($path, '{')) {
            return null;
        }

        // /actualites/{slug} devient la regex /actualites/([^/]+)
        $pattern = preg_replace('/\{[a-zA-Z_]+\}/', '([^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';

        if (!preg_match($pattern, $uri, $matches)) {
            return null;
        }

        preg_match_all('/\{([a-zA-Z_]+)\}/', $path, $names);

        $params = [];
        foreach ($names[1] as $i => $name) {
            $params[$name] = $matches[$i + 1];
        }

        return $params;
    }

    /** Affiche la page d'erreur correspondante et arrête le script. */
    public function renderError(int $code): void
    {
        http_response_code($code);

        $view = VIEWS_PATH . "/errors/{$code}.php";
        if (is_file($view)) {
            require $view;
        } else {
            echo "$code - Une erreur est survenue.";
        }
        exit;
    }
}
