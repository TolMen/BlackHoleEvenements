<?php

/**
 * Génère /sitemap.xml à la volée.
 *
 * Les pages fixes sont listées ici ; les articles d'actualité sont lus en
 * base et ajoutés automatiquement, avec leur date de dernière modification.
 * Le fichier n'a donc jamais besoin d'être régénéré à la main.
 */
class SitemapController extends Controller
{
    /** Pages fixes : [chemin, fréquence de mise à jour, priorité]. */
    private const PAGES = [
        ['/',                             'weekly',  '1.0'],
        ['/services',                     'monthly', '0.9'],
        ['/inspiration',                  'weekly',  '0.9'],
        ['/actualites',                   'weekly',  '0.8'],
        ['/faq',                          'monthly', '0.6'],
        ['/contact',                      'monthly', '0.7'],
        ['/mentions-legales',             'yearly',  '0.2'],
        ['/politique-de-confidentialite', 'yearly',  '0.2'],
    ];

    public function index(): void
    {
        header('Content-Type: application/xml; charset=UTF-8');

        $today = date('Y-m-d');

        $out  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $out .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach (self::PAGES as [$path, $freq, $priority]) {
            $out .= $this->urlEntry(absolute_url($path), $today, $freq, $priority);
        }

        foreach ($this->articles() as $article) {
            $loc     = absolute_url(article_path((int) $article['id'], (string) $article['title']));
            $lastmod = $this->lastmod($article);
            $out    .= $this->urlEntry($loc, $lastmod, 'monthly', '0.6');
        }

        $out .= '</urlset>' . "\n";

        echo $out;
    }

    /** Articles publiés, ou tableau vide si la base est indisponible. */
    private function articles(): array
    {
        try {
            require_once MODEL_PATH . '/ActualiteModel/postArtModel.php';

            $model = new PostArtModel();
            return $model->getAllArt($this->bdd);
        } catch (Throwable $e) {
            error_log('[Sitemap] Articles indisponibles : ' . $e->getMessage());
            return [];
        }
    }

    private function urlEntry(string $loc, string $lastmod, string $freq, string $priority): string
    {
        return '  <url>' . "\n"
            . '    <loc>' . htmlspecialchars($loc, ENT_XML1) . '</loc>' . "\n"
            . '    <lastmod>' . $lastmod . '</lastmod>' . "\n"
            . '    <changefreq>' . $freq . '</changefreq>' . "\n"
            . '    <priority>' . $priority . '</priority>' . "\n"
            . '  </url>' . "\n";
    }

    /** Date de dernière modification d'un article, au format AAAA-MM-JJ. */
    private function lastmod(array $article): string
    {
        $date = $article['updated_at'] ?? $article['created_at'] ?? null;

        if ($date) {
            $timestamp = strtotime((string) $date);
            if ($timestamp !== false) {
                return date('Y-m-d', $timestamp);
            }
        }

        return date('Y-m-d');
    }
}
