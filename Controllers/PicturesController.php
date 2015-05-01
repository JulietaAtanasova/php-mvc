<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Repositories\PictureRepository;

class PicturesController extends Controller
{
    public function show()
    {
        $pictures = PictureRepository::create()->getAll();
        $this->view->pictures = PictureRepository::create()->getAll();
    }
} 