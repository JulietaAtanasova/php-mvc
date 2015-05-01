<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Models\Album;
use PhotoAlbum\Repositories\AlbumRepository;
use PhotoAlbum\Repositories\CategoryRepository;
use PhotoAlbum\Repositories\UserRepository;

class AlbumsController extends Controller
{
    public function show()
    {
        $categories = AlbumRepository::create()->getAll();
        $this->view->albums = AlbumRepository::create()->getAll();
    }

    public function add()
    {
        $this->view->error = false;
        if (isset($_POST['create'])) {
            $name = $_POST['name'];
            if($name === ""){
                $this->view->error = 'empty category name';
                return;
            }

            $description = $_POST['description'];

            $user = UserRepository::create()->getOne($_SESSION['userid']);
            $category = CategoryRepository::create()->getOneByName($_POST['categoryName']);
            if(!$category){
                $this->view->error = 'No such category.';
                return;
            }
            $album = new Album($name, $category, $user, $description);

            if (!$album->save()) {
                $this->view->error = 'duplicate albums';
            }

        }
    }


} 