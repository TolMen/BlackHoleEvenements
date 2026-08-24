<?php

/**
 * Formulaire de contact.
 */
class ContactController extends Controller
{
    public function form(): void
    {
        $this->trackVisitor();

        $bdd = $this->bdd;

        require PAGES_PATH . '/contact.php';
    }

    /** Traitement du formulaire : le contrôle existant redirige vers /contact. */
    public function submit(): void
    {
        $bdd = $this->bdd;

        require CONTROL_PATH . '/ContactControl/contactControl.php';

        $this->redirect('/contact');
    }
}
