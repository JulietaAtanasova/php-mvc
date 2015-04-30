<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Models\Category;
use PhotoAlbum\Repositories\CategoryRepository;
use PhotoAlbum\Repositories\UserRepository;

class CategoriesController extends Controller
{
    public function show()
    {
        $categories = CategoryRepository::create()->getAll();
        $this->view->categories = CategoryRepository::create()->getAll();
    }

    public function add()
    {
        $this->view->error = false;
        if (isset($_POST['create'])) {
            $name = $_POST['name'];

            $user = UserRepository::create()->getOne($_SESSION['userid']);
            $category = new Category($name, $user);

            if (!$category->save()) {
                $this->view->error = 'duplicate categories';
            }

            $this->show();
        }
    }

    public function edit()
    {
        $this->view->error = false;
        $this->view->category = "";
        if (isset($_POST['edit'])) {
            $params = $this->request->getParams();
            $category = CategoryRepository::create()->getOneByName($params['name']);
            $this->view->category = $category->getName();
            $name = $_POST['name'];

            $category->setName($name);
            if (!$category->save()) {
                $this->view->error = 'duplicate categories';
            }

            $this->show();
        }
    }
} 