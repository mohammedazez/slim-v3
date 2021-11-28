<?php 
require 'vendor/autoload.php';

$app = new \Slim\App();

$app -> get('/', function($request, $response, $args){
    return $response->withStatus(200)->write("Hello world");
});

$app -> get('/forum', function($request, $response, $args){
    return $response->withStatus(200)->write("This a forum");
});

$app -> run();