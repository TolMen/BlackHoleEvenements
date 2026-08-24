<?php

/**
 * Base commune à tous les contrôleurs de routes.
 *
 * Fournit la connexion à la base, le comptage des visites, la protection
 * de l'espace d'administration et le rendu des pages d'erreur.
 */
abstract class Controller
{
    protected PDO $bdd;

    public function __construct()
    {
        $this->bdd = db();
    }

    /**
     * Comptage des visites + filtrage géographique.
     * Exécuté une seule fois par requête.
     */
    protected function trackVisitor(): void
    {
        $bdd = $this->bdd;
        require_once CONTROL_PATH . '/AdminControl/visitorControl.php';
    }

    /** Réservé aux administrateurs : sinon retour au formulaire de connexion. */
    protected function requireAdmin(): void
    {
        if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
            header('Location: ' . url('/connexion'), true, 302);
            exit;
        }
    }

    /** Réservé aux utilisateurs connectés. */
    protected function requireLogin(): void
    {
        if (empty($_SESSION['userID'])) {
            header('Location: ' . url('/connexion'), true, 302);
            exit;
        }
    }

    /** Affiche la page 404 et arrête le script. */
    protected function notFound(): void
    {
        http_response_code(404);
        require VIEWS_PATH . '/errors/404.php';
        exit;
    }

    /** Redirection interne, puis arrêt du script. */
    protected function redirect(string $path, int $code = 302): void
    {
        header('Location: ' . url($path), true, $code);
        exit;
    }

    /** Réponse JSON (points d'entrée appelés en AJAX). */
    protected function json(array $data, int $code = 200): void
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }
}
