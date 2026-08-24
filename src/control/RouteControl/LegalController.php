<?php

/**
 * Pages légales : FAQ, mentions légales, politique de confidentialité.
 *
 * Chaque rubrique a désormais sa propre adresse explicite plutôt qu'un
 * paramètre ?type= : c'est à la fois plus lisible et mieux référencé.
 */
class LegalController extends Controller
{
    public function faq(): void
    {
        $this->show('faq');
    }

    public function mentions(): void
    {
        $this->show('ml');
    }

    public function confidentialite(): void
    {
        $this->show('pc');
    }

    private function show(string $type): void
    {
        $this->trackVisitor();

        $bdd = $this->bdd;

        require_once CONTROL_PATH . '/LegalControl/legalControl.php';

        require PAGES_PATH . '/legalPage.php';
    }
}
