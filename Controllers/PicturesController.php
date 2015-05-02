<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Models\Album;
use PhotoAlbum\Models\Category;
use PhotoAlbum\Models\Picture;
use PhotoAlbum\Models\PictureComment;
use PhotoAlbum\Models\PictureVote;
use PhotoAlbum\Repositories\AlbumRepository;
use PhotoAlbum\Repositories\PictureRepository;
use PhotoAlbum\Repositories\UserRepository;
use PhotoAlbum\Repositories\VoteRepository;

class PicturesController extends HomeController
{
    public function showAll()
    {
        $this->view->pictures = PictureRepository::create()->getAll();
    }

    public function show()
    {
        $this->view->error = false;
        $params = $this->request->getParams();
        $picture = PictureRepository::create()->getOne($params['picture']);
        if(!$picture){
            $this->view->error = 'No such picture';
            $this->view->rating = "";
            return;
        }
        $this->view->picture = $picture;
        $this->view->rating = PictureRepository::create()->getRating($picture);
    }

    public function add()
    {
        $this->view->error = false;
        $params = $this->request->getParams();
        $album = AlbumRepository::create()->getOne($params['album']);
        if(!$album){
            $this->view->error = 'No such album';
            return;
        }
        $this->view->album = $album->getName();

        if (isset($_POST['create'])) {
            $name = $_POST['name'];
            if($name === ""){
                $this->view->error = 'empty picture name';
                return;
            }

            $description = $_POST['description'];

            $user = UserRepository::create()->getOne($_SESSION['userid']);

            $url = $_POST['url'];
            if($url === ""){
                $this->view->error = 'empty picture url';
                return;
            }

            if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
                $this->view->error = 'invalid picture url';
                return;
            }
            if(!getimagesize($url)) {
                $this->view->error = 'invalid picture url';
                return;
            }

            $size = getimagesize($url);
            $width = $size[0];
            $height = $size[1];
            $maxSize = 2000;
            if($width > $maxSize || $height > $maxSize) {
                $this->view->error = 'picture must be max 2000 width/height;';
                return;
            }

            $picture = new Picture($name, $url, $album, $description);

            if (!$picture->save()) {
                $this->view->error = 'duplicate picture';
            }

            $this->redirect('albums', 'show', ['album' => $album->getId()] );

        }
    }

    public function addComment()
    {
        $this->view->error = false;
        $params = $this->request->getParams();
        $picture = PictureRepository::create()->getOne($params['picture']);
        if(!$picture){
            $this->view->error = 'No such picture.';
            $this->view->picture = "";
            return;
        }

        $this->view->picture = $picture->getName();

        if (isset($_POST['create'])) {
            $text = $_POST['comment'];
            if($text === ""){
                $this->view->error = 'empty comment text';
                return;
            }

            $user = UserRepository::create()->getOne($_SESSION['userid']);

            $comment = new PictureComment($text, $picture, $user);
            if (!$comment->save()) {
                $this->view->error = 'duplicate comment';
            }

            $this->redirect('pictures', 'show', ['picture' => $picture->getId()] );

        }
    }

    public function addVote()
    {
        $this->view->error = false;
        $params = $this->request->getParams();
        $picture = PictureRepository::create()->getOne($params['picture']);
        if(!$picture){
            $this->view->error = 'No such $picture.';
            $this->view->album = "";
            return;
        }

        $this->view->picture = $picture->getName();

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

            $votes = VoteRepository::create()->getByPicture($picture);
            foreach($votes as $vote) {
                if($vote->getUser()->getId() == $_SESSION['userid']){
                    $this->view->error = 'you are already vote for this album';
                    return;
                }
            }

            $user = UserRepository::create()->getOne($_SESSION['userid']);

            $vote = new PictureVote($rate, $picture, $user);
            if (!$vote->save()) {
                $this->view->error = 'duplicate vote';
            }

            $this->redirect('pictures', 'show', ['picture' => $picture->getId()] );
        }
    }
} 