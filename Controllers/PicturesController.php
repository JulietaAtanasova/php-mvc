<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Repositories\PictureRepository;

class PicturesController extends Controller
{
    public function show()
    {
        $this->view->pictures = PictureRepository::create()->getAll();
    }
} 