<?php

require './src/Router.php';
require './src/Container.php';
require './src/Template.php';

$router = new Router;

$router->get('/', function () {
    Template::view('./templates/index.html', [
        'msg' => 'Welcome to the home page!'
    ]);
})->get('/contact', function () {
    require 'contact.php';
})->post('/contact', function () {
    $name = $_POST['name'];
    $message = 'Vous vous appelez ' . $name;

    require 'result.php';
});

$router->direct($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
