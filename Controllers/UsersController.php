<?php
namespace PhotoAlbum\Controllers;

use PhotoAlbum\Models\User;
use PhotoAlbum\Repositories\UserRepository;

class UsersController extends HomeController
{
    public function login()
    {
        $this->view->error = false;
        $this->view->user = false;
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = UserRepository::create()->getOneByDetails(
                $username,
                $password
            );

            if (!$user) {
                $this->view->error = 'Invalid details';
                return;
            }

            $_SESSION['userid'] = $user->getId();
            if ($user->isAdmin()) {
                $_SESSION['admin'] = true;
            }
            $this->view->user = $user->getUsername();
            $this->redirect('home');
        }
    }

    public function register()
    {
        $this->view->error = false;
        if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = new User($username, $password);

            if (!$user->save()) {
                $this->view->error = 'duplicate users';
            }

            $this->login();
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('home');
    }
}