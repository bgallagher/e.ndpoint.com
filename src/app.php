<?php

use Endpoint\Component\HttpFoundation\File\MimeType\ExtensionMimeTypeGuesser;
use Silex\Application;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;

$app = new Application();
$app->register(new FormServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path' => array(__DIR__ . '/../templates'),
    'twig.options' => array('cache' => __DIR__ . '/../cache/twig'),
));
$app->register(new Silex\Provider\TranslationServiceProvider(), array( //'locale' => 'en',
    //'translation.class_path' =>  __DIR__ . '/../vendor/symfony/src',
    //'translator.messages' => array()
));
$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
}));

$app['extensionGuesser'] = $app->share(function ($app) {
    return new ExtensionMimeTypeGuesser();
});

return $app;