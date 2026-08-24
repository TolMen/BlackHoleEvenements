<?php

/**
 * Page des prestations.
 */
class ServiceController extends Controller
{
    public function index(): void
    {
        $this->trackVisitor();

        $bdd = $this->bdd;

        require_once CONTROL_PATH . '/ImageControl/sectionServiceImageControl.php';

        require PAGES_PATH . '/service.php';
    }
}
