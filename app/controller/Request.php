<?php

namespace controller;

class Request
{
    private $path;
    private $get_params;
    private $post_params;

    public function __construct()
    {
        $this->path = $_GET['path'];
        $this->get_params = $_GET;
        unset($this->get_params['path']);
        $this->post_params = $_POST;
    }

    //возвращает path-параметр

    public function getPath(){
        return $this->path;
    }

    //возвращает GET-параметры

    public function getGetParam(){
        return $this->get_params;
    }

    //возвращает POST-параметры

    public function getPostParam(){
        return $this->post_params;
    }

}