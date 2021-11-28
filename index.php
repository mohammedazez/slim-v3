<?php 
require 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$app -> get('/', function($request, $response){
    return $response->withStatus(200)->write("Hello world");
});

$app -> get('/forum', function($request, $response){
    return $response->withStatus(200)->write("This a forum");
});

$app -> get('/judul[/{nama}/{halaman}]', function($request, $response, $args){
        return $args['nama'] . ' di halaman ' . $args['halaman'];
});


$app -> get('/name', function($request, $response){
    $data = array(
        'nama' => 'Muhamad Aziz',
        'hobby' => 'Making Artificial Intel'
    );

    return $response -> withJson($data, 200);
});


// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig( __DIR__. '/templates', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};

// Render Twig template in route
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'profile.html', [
        'name' => $args['name']
    ]);
})->setName('profile');

$app -> run();