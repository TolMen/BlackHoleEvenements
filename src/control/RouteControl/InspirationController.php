<?php

/**
 * Galerie d'inspiration.
 */
class InspirationController extends Controller
{
    public function index(): void
    {
        $this->trackVisitor();

        $bdd = $this->bdd;

        require_once CONTROL_PATH . '/InspirationControl/filtreControl.php';
        require_once CONTROL_PATH . '/ImageControl/galleryImageControl.php';

        // Filtre pré-sélectionné depuis la page Prestations (/inspiration?service=…)
        $selectedService = $_GET['service'] ?? '';

        require PAGES_PATH . '/inspiration.php';
    }
}
