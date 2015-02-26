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

// Home
$app->get('/', function () use ($app) {
    return $app['twig']->render('roles.twig', array(
        'role' => 'any'
    ));
})
->bind('roles');

// Admin home page
$app->get('/admin', function () use ($app) {
    return $app['twig']->render('admin/dashboard.twig', array(
        'role' => 'admin'
    ));
})
->bind('admin_dashboard');

// Admin journals list
$app->get('/admin/journals', function () use ($app) {
    return $app['twig']->render('admin/journals.twig', array(
        'role' => 'admin'
    ));
})
->bind('admin_journals');

// Admin journals list
$app->get('/author', function () use ($app) {
    return $app['twig']->render('author/dashboard.twig', array(
        'role' => 'author'
    ));
})
->bind('author_dashboard');

// Editor home page
$app->get('/editor', function () use ($app) {
    return $app['twig']->render('editor/dashboard.twig', array(
        'role' => 'editor'
    ));
})
->bind('editor_dashboard');

// Editor unassigned submissions
$app->get('/editor/unassigned', function () use ($app) {
    return $app['twig']->render('editor/unassigned.twig', array(
        'role' => 'editor'
    ));
})
->bind('editor_unassigned');

// Editor submissions in review
$app->get('/editor/inreview', function () use ($app) {
    return $app['twig']->render('editor/inreview.twig', array(
        'role' => 'editor'
    ));
})
->bind('editor_inreview');



/**
 * Run the application
 */

$app->run();
