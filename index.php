<?php

require_once __DIR__.'/vendor/autoload.php';

// Instanciate the application
$app = new Silex\Application();

/**
 * Configure the app
 */

// Debug
$app['debug'] = true;

// Registering the template system Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Register the URL Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());


/**
 * Here are the routes
 */

// Home page
$app->get('/', function () use ($app) {
    return $app['twig']->render('admin/dashboard.twig', array(
        'role' => 'admin'
    ));
})
->bind('admin_dashboard');

// Journals list
$app->get('/journals', function () use ($app) {
    return $app['twig']->render('admin/journals.twig', array(
        'role' => 'admin'
    ));
})
->bind('admin_journals');


/**
 * Run the application
 */

$app->run();
