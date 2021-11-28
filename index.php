<?php 
require 'vendor/autoload.php';

$app = new \Slim\App();

$app -> get('/', function($request, $response){
    return $response->withStatus(200)->write("Hello world");
});

$app -> get('/forum', function($request, $response){
    return $response->withStatus(200)->write("This a forum");
});

$app -> get('/judul[/{nama}/{halaman}]', function($request, $response, $args){
        return $args['nama'] . ' di halaman ' . $args['halaman'];
});

$app -> run();