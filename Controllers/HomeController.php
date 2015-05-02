<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Repositories\UserRepository;
use PhotoAlbum\Repositories\AlbumRepository;

class HomeController extends Controller
{
    protected function onLoad()
    {

        $this->view->welcomeMessage = "You are not logged in.";
        $this->view->button = "Log In";
        $this->view->buttonAction = 'login';
        $this->view->canRegister = true;

        //$this->view->adminMessage = "Ne sam admin";

        if ($this->isLogged()) {
            $user = UserRepository::create()->getOne($_SESSION['userid']);
            $this->view->welcomeMessage = "Welcome, " . $user->getUsername();
            $this->view->button = "Log Out";
            $this->view->buttonAction = 'logout';
            $this->view->canRegister = false;
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
        $albums = AlbumRepository::create()->getAll();
        $ratings = [];
        foreach($albums as $album) {
            $rating = AlbumRepository::create()->getRating($album);
            $ratings[$album->getId()] = $rating;
        }

        arsort($ratings);
        $topRatings = array_slice($ratings, 0, 3);
        $topAlbums = [];
        foreach($albums as $album) {
            $r = AlbumRepository::create()->getRating($album);
            if (in_array($r, $topRatings)){
                $topAlbums[] = $album;
            }
        }

        $this->view->albums = $topAlbums;
    }

} 