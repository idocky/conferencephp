<?php


require 'app/controller/Router.php';    //подключение маршрутизации

$Route = new controller\Router();

require_once 'app/controller/Request.php';   //подключение реквеста

$Request = new controller\Request();

//Роутинг

$Route->addRoute('\/', 'mainpage.php');
$Route->addRoute('\/create', 'conf_create.php');
$Route->addRoute('\/conference\/[a-zA-Z0-9-]*', 'conf_details.php');
$Route->addRoute('\/edit\/[a-zA-Z0-9-]*', 'conf_edit.php');



$Route->route('/'.$Request->getPath());