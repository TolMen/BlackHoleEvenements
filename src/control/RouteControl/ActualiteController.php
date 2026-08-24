<?php

/**
 * Actualités publiques : liste et article.
 */
class ActualiteController extends Controller
{
    /** /actualites : liste des articles, du plus récent au plus ancien. */
    public function index(): void
    {
        $this->trackVisitor();

        $bdd = $this->bdd;

        require_once MODEL_PATH . '/ActualiteModel/postArtModel.php';

        $model    = new PostArtModel();
        $articles = $model->getAllArt($bdd);

        // Une seule requête par article pour l'illustration, préparée ici
        // plutôt que dans la vue.
        $articleImages = [];
        foreach ($articles as $article) {
            $image = $model->getArticleImage($bdd, $article['id']);
            $articleImages[$article['id']] = $image['url'] ?? null;
        }

        require PAGES_PATH . '/actualite.php';
    }

    /**
     * /actualites/{slug} où {slug} vaut « 12-titre-de-l-article ».
     *
     * Si le slug demandé ne correspond plus au titre actuel (titre modifié,
     * ou lien tronqué à « /actualites/12 »), on redirige en 301 vers
     * l'adresse canonique : une seule URL indexée par article.
     */
    public function show(string $slug): void
    {
        if (!preg_match('/^(\d+)(?:-(.*))?$/', $slug, $matches)) {
            $this->notFound();
        }

        $articleID = (int) $matches[1];
        $slugFourni = $matches[2] ?? '';

        $bdd = $this->bdd;

        require_once MODEL_PATH . '/ActualiteModel/postArtModel.php';

        $model    = new PostArtModel();
        $articles = $model->getPostArt($bdd, $articleID);

        if (empty($articles)) {
            $this->notFound();
        }

        $article = $articles[0];

        $slugAttendu = slugify((string) $article['title']);
        if ($slugFourni !== $slugAttendu) {
            $this->redirect(article_path($articleID, (string) $article['title']), 301);
        }

        $this->trackVisitor();

        $model->incrementViews($bdd, $articleID);

        $imageData  = $model->getArticleImage($bdd, $articleID);
        $imageUrl   = $imageData['url'] ?? null;
        $dateToShow = !empty($article['updated_at']) ? $article['updated_at'] : $article['created_at'];

        require PAGES_PATH . '/actualiteDetail.php';
    }
}
