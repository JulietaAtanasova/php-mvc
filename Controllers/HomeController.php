<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Repositories\UserRepository;

class HomeController extends Controller
{
    protected function onLoad()
    {

        $this->view->welcomeMessage = "You are not logged in.";
        $this->view->button = "Log In";
        $this->view->buttonAction = 'login';
        //$this->view->adminMessage = "Ne sam admin";

        if ($this->isLogged()) {
            $user = UserRepository::create()->getOne($_SESSION['userid']);
            $this->view->welcomeMessage = "Welcome, " . $user->getUsername();
            $this->view->button = "Log Out";
            $this->view->buttonAction = 'logout';
        }

        if ($this->isAdmin()) {
            //$this->view->adminMessage = "ADMIN  SAM";
        }

        $this->view->partial('header');
        $this->view->partial('navigation');
    }

    protected function isLogged()
    {
        return isset($_SESSION['userid']);
    }

    protected function isAdmin()
    {
        return isset($_SESSION['admin']);
    }

    public function index()
    {

    }


} 