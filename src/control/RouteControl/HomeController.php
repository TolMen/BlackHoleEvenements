<?php

/**
 * Page d'accueil.
 */
class HomeController extends Controller
{
    public function index(): void
    {
        $this->trackVisitor();

        $bdd = $this->bdd;

        require_once CONTROL_PATH . '/ImageControl/HeroHomeImageControl.php';
        require_once CONTROL_PATH . '/ImageControl/sectionServiceImageControl.php';

        require PAGES_PATH . '/home.php';
    }
}
