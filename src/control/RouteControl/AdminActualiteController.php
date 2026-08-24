<?php

/**
 * Gestion des articles côté administration.
 */
class AdminActualiteController extends Controller
{
    /** /admin/actualites/nouvelle : formulaire de création. */
    public function create(): void
    {
        $this->requireAdmin();

        $isUpdateView = false;

        require PAGES_PATH . '/actualiteForm.php';
    }

    /** POST /admin/actualites : enregistrement d'un nouvel article. */
    public function store(): void
    {
        $this->requireAdmin();

        $bdd = $this->bdd;

        require CONTROL_PATH . '/ActualiteControl/addArtControl.php';

        // Le contrôle redirige vers l'article créé ; sinon, retour à la liste.
        $this->redirect('/actualites');
    }

    /** /admin/actualites/{id}/modifier : formulaire de modification. */
    public function edit(string $id): void
    {
        $this->requireAdmin();

        $articleID = (int) $id;
        $bdd       = $this->bdd;

        require_once MODEL_PATH . '/ActualiteModel/postArtModel.php';

        $model    = new PostArtModel();
        $articles = $model->getPostArt($bdd, $articleID);

        if (empty($articles)) {
            $this->notFound();
        }

        $article        = $articles[0];
        $articleAncien  = $article;
        $imageData      = $model->getArticleImage($bdd, $articleID);
        $imageUrl       = $imageData['url'] ?? null;
        $isUpdateView   = true;

        require PAGES_PATH . '/actualiteForm.php';
    }

    /** POST /admin/actualites/{id} : enregistrement des modifications. */
    public function update(string $id): void
    {
        $this->requireAdmin();

        $articleID = (int) $id;
        $bdd       = $this->bdd;

        require CONTROL_PATH . '/ActualiteControl/updateArtControl.php';
    }

    /** /admin/actualites/{id}/supprimer : suppression de l'article. */
    public function destroy(string $id): void
    {
        $this->requireAdmin();

        $articleID = (int) $id;
        $bdd       = $this->bdd;

        require CONTROL_PATH . '/ActualiteControl/deleteArtControl.php';
    }
}
