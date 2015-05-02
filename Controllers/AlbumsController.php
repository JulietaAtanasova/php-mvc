<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Models\Album;
use PhotoAlbum\Models\AlbumComment;
use PhotoAlbum\Models\AlbumVote;
use PhotoAlbum\Repositories\AlbumRepository;
use PhotoAlbum\Repositories\AlbumVoteRepository;
use PhotoAlbum\Repositories\CategoryRepository;
use PhotoAlbum\Repositories\UserRepository;

class AlbumsController extends HomeController
{
    public function showAll()
    {
        $this->view->albums = AlbumRepository::create()->getAll();
    }

    public function show()
    {
        $this->view->error = false;
        $this->view->isOwner = false;
        $params = $this->request->getParams();
        $album = AlbumRepository::create()->getOne($params['album']);
        if(!$album){
            $this->view->error = 'No such album.';
            $this->view->name = "";
            $this->view->category = "";
            $this->view->user = "";
            $this->view->pictures = "";
            $this->view->comments = "";
            $this->view->description = "";
            $this->view->rating = "";
            $this->view->createdOn = "";
            return;
        }

        if($album->getUser()->getId() == $_SESSION['userid']){
            $this->view->isOwner = true;
        }

        $this->view->album = $album;
        $this->view->name = $album->getName();
        $this->view->category = $album->getCategory()->getName();
        $this->view->user = $album->getUser()->getUsername();
        $this->view->pictures = $album->getPictures();
        $this->view->comments = $album->getComments();
        $this->view->description = $album->getDescription();
        $this->view->rating = AlbumRepository::create()->getRating($album);
        $this->view->createdOn = $album->getCreatedOn();

    }

    public function add()
    {
        $this->view->error = false;
        if (isset($_POST['create'])) {
            $name = $_POST['name'];
            if($name === ""){
                $this->view->error = 'empty album name';
                return;
            }

            $description = $_POST['description'];

            $user = UserRepository::create()->getOne($_SESSION['userid']);
            $category = CategoryRepository::create()->getOneByName($_POST['categoryName']);
            if(!$category){
                $this->view->error = 'No such category';
                return;
            }
            $album = new Album($name, $category, $user, $description);

            if (!$album->save()) {
                $this->view->error = 'duplicate albums';
            }

        }
    }

    public function edit()
    {
        $this->view->error = false;
        $params = $this->request->getParams();
        $album = AlbumRepository::create()->getOne($params['album']);
        if(!$album){
            $this->view->error = 'No such album.';
            $this->view->album = "";
            return;
        }
        $this->view->album = $album->getName();
        $this->view->category = $album->getCategory()->getName();
        $this->view->description = $album->getDescription();

        if (isset($_POST['edit'])) {
            $name = $_POST['name'];
            if($name === ""){
                $this->view->error = 'empty album name';
                return;
            }

            $description = $_POST['description'];

            $category = CategoryRepository::create()->getOneByName($_POST['categoryName']);
            if(!$category){
                $this->view->error = 'No such category';
                return;
            }

            $album->setName($name);
            $album->setDescription($description);
            $album->setCategory($category);
            if (!$album->save()) {
                $this->view->error = 'duplicate albums';
            }
        }

    }

    public function delete()
    {
        $this->view->error = false;
        $params = $this->request->getParams();
        $album = AlbumRepository::create()->getOne($params['album']);
        if(!$album){
            $this->view->error = 'No such album.';
            $this->view->album = "";
            return;
        }

        $this->view->album = $album->getName();

        if (isset($_POST['delete'])) {
            AlbumRepository::create()->delete($album);
        }
    }

    public function addComment()
    {
        $this->view->error = false;
        $params = $this->request->getParams();
        $album = AlbumRepository::create()->getOne($params['album']);
        if(!$album){
            $this->view->error = 'No such album.';
            $this->view->album = "";
            return;
        }

        $this->view->album = $album->getName();

        if (isset($_POST['create'])) {
            $text = $_POST['comment'];
            if($text === ""){
                $this->view->error = 'empty comment text';
                return;
            }

            $user = UserRepository::create()->getOne($_SESSION['userid']);

            $comment = new AlbumComment($text, $album, $user);
            if (!$comment->save()) {
                $this->view->error = 'duplicate comment';
            }

            $this->redirect('albums', 'show', ['album' => $album->getId()] );
        }
    }

    public function addVote()
    {
        $this->view->error = false;
        $params = $this->request->getParams();
        $album = AlbumRepository::create()->getOne($params['album']);
        if(!$album){
            $this->view->error = 'No such album.';
            $this->view->album = "";
            return;
        }

        $this->view->album = $album->getName();

        if (isset($_POST['vote'])) {
            $text = $_POST['rate'];
            if($text === ""){
                $this->view->error = 'empty rate';
                return;
            }

            if(!(float)$text){
                $this->view->error = 'invalid rate value';
                return;
            }

            if(!(floor((float)$text) == (float)$text)) {
                $this->view->error = 'rate must be integer number';
                return;
            }
            $rate = (int)$text;
            if($rate < 1 || $rate > 10){
                $this->view->error = 'rate must be between 1 and 10';
                return;
            }

            $votes = AlbumVoteRepository::create()->getByAlbum($album);
            foreach($votes as $vote) {
                if($vote->getUser()->getId() == $_SESSION['userid']){
                    $this->view->error = 'you are already vote for this album';
                    return;
                }
            }

            $user = UserRepository::create()->getOne($_SESSION['userid']);

            $vote = new AlbumVote($rate, $album, $user);
            if (!$vote->save()) {
                $this->view->error = 'duplicate vote';
            }

            $this->redirect('albums', 'show', ['album' => $album->getId()] );

        }
    }
} 