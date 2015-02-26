<?php

require_once __DIR__.'/vendor/autoload.php';

// Instanciate the application
$app = new Silex\Application();
$app['debug'] = true;

// Registering the template system Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Register the URL Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Home page
$app->get('/', function () use ($app) {
    return $app['twig']->render('dashboard.twig');
})
->bind('dashboard');

// Journals list
$app->get('/journals', function () use ($app) {
    return $app['twig']->render('journals.twig');
})
->bind('journals');

$app->run();
