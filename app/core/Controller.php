<?php

class Controller {

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($src, $data = [])
    {
        require_once "View.php";
        $view = new View($src);
        $view->show($data);
    }
}