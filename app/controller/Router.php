<?php

namespace controller;


class Router
{
    private $pages = array();

    function addRoute($url, $path){
        $this->pages['/'.$url.'$/'] = $path;
    }


    function route($url){
        $file_dir = 'templates/';
        if (true){
            foreach ($this->pages as $key => $value) {              //Проверка на истинность рег выражения к ссылке
                if (preg_match($key, $url)){
                    require $file_dir.$value;
                }
            }
        }


    }

}