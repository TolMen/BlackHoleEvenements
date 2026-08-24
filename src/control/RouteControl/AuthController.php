<?php

/**
 * Connexion et déconnexion.
 */
class AuthController extends Controller
{
    public function loginForm(): void
    {
        $bdd = $this->bdd;

        require PAGES_PATH . '/login.php';
    }

    public function login(): void
    {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $this->redirect('/connexion?erreur=1');
        }

        $bdd = $this->bdd;

        require CONTROL_PATH . '/UserControl/loginUser.php';
    }

    public function logout(): void
    {
        require CONTROL_PATH . '/UserControl/logoutUser.php';
    }
}
