<?php

namespace PhotoAlbum\Controllers;

use PhotoAlbum\Models\Category;
use PhotoAlbum\Repositories\CategoryRepository;
use PhotoAlbum\Repositories\UserRepository;

class CategoriesController extends HomeController
{
    public function showAll()
    {
        $categories = CategoryRepository::create()->getAll();
        $this->view->isAdmin = $this->isAdmin();
        $this->view->categories = CategoryRepository::create()->getAll();
    }

    public function show()
    {
        $this->view->error = false;
        $this->view->category = "";
        $this->view->albums = [];
        $params = $this->request->getParams();
        $category = CategoryRepository::create()->getOneByName($params['name']);
        if(!$category){
            $this->view->error = 'No such category.';
            $this->view->category = "";
            return;
        }

        $this->view->category = $category->getName();
        $this->view->albums = $category->getAlbums();
    }

    public function add()
    {
        $this->view->error = false;
        $user = UserRepository::create()->getOne($_SESSION['userid']);
        if(!$user->isAdmin()){
            $this->view->error = 'You are not authorized!';
        }

        if (isset($_POST['create'])) {
            $name = $_POST['name'];

            $user = UserRepository::create()->getOne($_SESSION['userid']);
            $category = new Category($name, $user);

            if (!$category->save()) {
                $this->view->error = 'duplicate categories';
            }
            $this->redirect('categories', 'showall');
        }

    }

    public function edit()
    {
        $this->view->error = false;
        $user = UserRepository::create()->getOne($_SESSION['userid']);
        if(!$user->isAdmin()){
            $this->view->error = 'You are not authorized!';
        }

        $params = $this->request->getParams();
        $category = CategoryRepository::create()->getOneByName($params['name']);
        if(!$category){
            $this->view->error = 'No such category.';
            $this->view->category = "";
            return;
        }

        $this->view->category = $category->getName();
        if (isset($_POST['edit'])) {
            $name = $_POST['name'];
            if($name === ""){
                $this->view->error = 'empty category name';
            } else {
                $category->setName($name);
                if (!$category->save()) {
                    $this->view->error = 'duplicate categories';
                }
            }
            $this->redirect('categories', 'showall');
        }

    }

    public function delete()
    {
        $this->view->error = false;
        $user = UserRepository::create()->getOne($_SESSION['userid']);
        if(!$user->isAdmin()){
            $this->view->error = 'You are not authorized!';
        }

        $params = $this->request->getParams();
        $category = CategoryRepository::create()->getOneByName($params['name']);
        if(!$category){
            $this->view->error = 'No such category.';
            $this->view->category = "";
            return;
        }

        $this->view->category = $category->getName();

        if (isset($_POST['delete'])) {
            CategoryRepository::create()->delete($category);
            $this->redirect('categories', 'showall');
        }

    }
} 