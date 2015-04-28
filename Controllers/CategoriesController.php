<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Repositories\CategoryRepository;

class CategoriesController extends Controller
{
    public function show()
    {
        $categories = CategoryRepository::create()->getAll();
        $this->view->categories = CategoryRepository::create()->getAll();
    }

} 