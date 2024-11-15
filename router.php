<?php
require_once 'Libs/router.php';
require_once 'App/Controller/apiController.php';


$router = new Router();



    $router->addRoute('actividad',  'GET' ,     'ApiController' ,   'getAllActividades');
    $router->addRoute('actividad/:id',  'GET' ,     'ApiController' ,   'getActividad');
    $router->addRoute('actividad/:id',  'DELETE' ,     'ApiController' ,   'eliminar');
    $router->addRoute('actividad',  'POST' ,     'ApiController' ,   'agregar');
    $router->addRoute('actividad/:id',  'PUT' ,     'ApiController' ,   'modificar');


    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);