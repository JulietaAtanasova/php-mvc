<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Models\Album;
use PhotoAlbum\Repositories\AlbumRepository;

class AlbumsController extends Controller
{
    public function show()
    {
        $categories = AlbumRepository::create()->getAll();
        $this->view->albums = AlbumRepository::create()->getAll();
    }

    public function add()
    {

    }
} 