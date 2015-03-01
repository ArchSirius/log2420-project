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

// Author dashboard
$app->get('/author', function () use ($app) {
    return $app['twig']->render('author/dashboard.twig', array(
        'role' => 'author'
    ));
})
->bind('author_dashboard');

// Author submissions
$app->get('/author/submissions', function () use ($app) {
    return $app['twig']->render('author/submissions.twig', array(
        'role' => 'author'
    ));
})
->bind('author_submissions');

// Author add new submissions
$app->get('/author/submissions/new', function () use ($app) {
    return $app['twig']->render('author/newSubmission.twig', array(
        'role' => 'author'
    ));
})
->bind('author_new_submission');

// Author submissions detail
$app->get('/author/submissions/{id}', function ($id) use ($app) {
    return $app['twig']->render('author/submissionDetail.twig', array(
        'role' => 'author',
        'id' => $app->escape($id)
    ));
})
->bind('author_submission_detail');

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

// Editor assign reviewer
$app->get('/editor/assign', function () use ($app) {
    return $app['twig']->render('editor/assign.twig', array(
        'role' => 'editor'
    ));
})
->bind('editor_assign');


/**
 * Run the application
 */

$app->run();
