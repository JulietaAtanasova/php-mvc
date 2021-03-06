<?php

namespace PhotoAlbum\Controllers;

class Controller
{
    /**
     * @var \PhotoAlbum\View;
     */
    protected $view;

    /**
     * @var \PhotoAlbum\Request;
     */
    protected $request;

    protected $controllerName;

    public function __construct(\PhotoAlbum\View $view, \PhotoAlbum\Request $request, $name)
    {
        $this->view = $view;
        $this->request = $request;
        $this->controllerName = $name;
        $this->onLoad();
    }

    protected function onLoad() { }

    public function redirect($controller = null, $action = null, $params = []) {
        $requestUri = explode('/', $_SERVER['REQUEST_URI']);
        $url = "//" . $_SERVER['HTTP_HOST'] . "/";

        foreach ($requestUri as $k => $uri) {
            if ($uri == $this->controllerName) {
                break;
            }
            $url .= "$uri";
        }

        if ($controller) {
            $url .= "/$controller";
        }

        if ($action) {
            $url .= "/$action";
        }

        foreach ($params as $key => $param) {
            $url .= "/$key/$param";
        }

        header("Location: " . $url);
        exit;
    }
}