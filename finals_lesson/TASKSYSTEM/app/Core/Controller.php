<?php

class Controller{
    protected function model(string $model){
        $path = "../app/Models/{$model}.php";

        if(!file_exists($path)){
            throw new Exception("Model {$model} not found");
        }

        require_once $path;
        return new $model();
    }

    protected function view(string $view, array $data = []){
        $viewFile = __DIR__ . "/../Views/{$view}.php";

        if(!file_exists($viewFile)){
            throw new Exception("View {$view} not found");
        }

        extract($data);
        $contentView = $viewFile;

        require __DIR__ . "/../Views/layout/app.php";
    }

    protected function redirect(string $path){
        $config = require __DIR__ . '/../Confg/config.php';

        if(!str_starts_with($path, 'http')){
            $path = rtrim($config['app_url'], '/') . '/' . ltrim($path , '/');
        }

        header("location: {$path}");
        exit;
    }
}