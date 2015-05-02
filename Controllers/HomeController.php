<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Repositories\CategoryRepository;
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
            //$this->view->adminMessage = "YOU ARE THE ADMIN HERE";
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

    public function search()
    {
        $this->view->error = false;
        $this->view->isSearching = false;
        if(isset($_POST['search'])){
            $this->view->isSearching = true;
            $text = ($_POST['text']);
            if($text === ""){
                $this->view->error = 'empty comment text';
                return;
            }

            $allCategories = CategoryRepository::create()->getAll();
            $categories = [];
            foreach($allCategories as $category){
                if(strpos($category->getName(), $text) !== false){
                    $categories[] = $category;
                }
            }

            $allAlbums = AlbumRepository::create()->getAll();
            $albums = [];
            foreach($allAlbums as $album){
                if(strpos($album->getName(), $text) !== false){
                    $albums[] = $album;
                }
            }

            $this->view->categories = $categories;
            $this->view->albums = $albums;
        }
    }
} 