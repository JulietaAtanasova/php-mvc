<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Models\Picture;
use PhotoAlbum\Models\PictureComment;
use PhotoAlbum\Repositories\AlbumRepository;
use PhotoAlbum\Repositories\PictureRepository;
use PhotoAlbum\Repositories\UserRepository;

class PicturesController extends HomeController
{
    public function show()
    {
        $this->view->pictures = PictureRepository::create()->getAll();
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
        }
    }
} 