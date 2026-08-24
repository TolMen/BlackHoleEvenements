<?php

/**
 * Espace d'administration : tableau de bord, messagerie, galerie, journal
 * des modifications et actions associées.
 *
 * Toutes les méthodes sont protégées : l'accès à /admin exige une session
 * administrateur (l'ancien dashboard.php était accessible à qui connaissait
 * son adresse).
 */
class AdminController extends Controller
{
    /** /admin : tableau de bord (visiteurs, messages non lus, compte). */
    public function dashboard(): void
    {
        $this->requireAdmin();

        $bdd       = $this->bdd;
        $adminView = 'dashboard';

        require_once CONTROL_PATH . '/AdminControl/unReadMessageControl.php';
        require_once MODEL_PATH . '/AdminModel/visitorModel.php';

        $visitorModel = new VisitorModel();
        $year  = (int) date('Y');
        $month = (int) date('m');

        $monthData = $visitorModel->getMonthlyVisitors($bdd, $year, $month);
        $yearData  = $visitorModel->getYearlyVisitors($bdd, $year);

        $totalVisitorCountYear = $visitorModel->getVisitorCountYear($bdd, $year);
        $monthVisitorCount     = $monthData ? $monthData['visitor_count'] : 0;

        // Données annuelles converties pour le graphique.
        $monthlyData = array_fill(1, 12, 0);
        foreach ($yearData as $entry) {
            $monthlyData[(int) $entry['month']] = (int) $entry['visitor_count'];
        }

        require PAGES_PATH . '/dashboard.php';
    }

    /** /admin/messagerie : messages reçus via le formulaire de contact. */
    public function messagerie(): void
    {
        $this->requireAdmin();

        $bdd       = $this->bdd;
        $adminView = 'messagerie';

        require_once CONTROL_PATH . '/AdminControl/messagerieControl.php';

        require PAGES_PATH . '/dashboard.php';
    }

    /** /admin/galerie : ajout et classement des photos. */
    public function galerie(): void
    {
        $this->requireAdmin();

        $bdd       = $this->bdd;
        $adminView = 'galerie';

        require_once CONTROL_PATH . '/InspirationControl/filtreControl.php';

        require PAGES_PATH . '/dashboard.php';
    }

    /** /admin/changelog : journal des modifications du site. */
    public function changelog(): void
    {
        $this->requireAdmin();

        $bdd       = $this->bdd;
        $adminView = 'changelog';

        require PAGES_PATH . '/dashboard.php';
    }

    /** /admin/statistiques-bloquees : bots et spams bloqués. */
    public function statsBlocked(): void
    {
        $this->requireAdmin();

        require PAGES_PATH . '/statsBlocked.php';
    }

    /** POST /admin/compte : mise à jour des identifiants. */
    public function updateAccount(): void
    {
        $this->requireLogin();

        $bdd = $this->bdd;

        require CONTROL_PATH . '/UserControl/updateUserControl.php';

        $this->redirect('/admin');
    }

    /** POST /admin/galerie/photos : envoi d'une photo dans la galerie. */
    public function addPhoto(): void
    {
        $this->requireAdmin();

        $bdd = $this->bdd;

        require CONTROL_PATH . '/ImageControl/addPhotoControl.php';

        $this->redirect('/admin/galerie');
    }

    /** /admin/galerie/photos/{id}/supprimer : suppression d'une photo. */
    public function deletePhoto(string $id): void
    {
        $this->requireAdmin();

        $imgID = (int) $id;
        $bdd   = $this->bdd;

        require MODEL_PATH . '/ImageModel/deleteImageModel.php';
    }

    /** POST /admin/galerie/image-section : photo mise en avant d'un service (AJAX). */
    public function setSectionImage(): void
    {
        if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
            $this->json(['success' => false, 'message' => 'Accès refusé.'], 403);
        }

        $bdd = $this->bdd;

        require MODEL_PATH . '/ImageModel/setSectionImage.php';
    }

    /** POST /admin/messagerie/lu : marque un message comme lu (AJAX). */
    public function markAsRead(): void
    {
        if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
            $this->json(['success' => false, 'error' => 'Accès refusé.'], 403);
        }

        $bdd = $this->bdd;

        require CONTROL_PATH . '/AdminControl/markAsReadControl.php';
    }

    /** /admin/messagerie/{id}/supprimer : suppression d'un message. */
    public function deleteMessage(string $id): void
    {
        $this->requireAdmin();

        $messageID = (int) $id;
        $bdd       = $this->bdd;

        require MODEL_PATH . '/AdminModel/deleteMessagerieModel.php';
    }
}
