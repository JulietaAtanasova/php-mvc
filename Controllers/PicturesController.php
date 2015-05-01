<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Models\PictureComment;
use PhotoAlbum\Repositories\PictureRepository;
use PhotoAlbum\Repositories\UserRepository;

class PicturesController extends Controller
{
    public function show()
    {
        $this->view->pictures = PictureRepository::create()->getAll();
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