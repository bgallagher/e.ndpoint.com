<?php

use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Endpoint\Component\HttpFoundation\File\MimeType\ExtensionMimeTypeGuesser;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
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

$app->register(new DoctrineServiceProvider());

$app->register(new DoctrineOrmServiceProvider(), array(
    "orm.proxies_dir" => "/path/to/proxies",
    "orm.em.options" => array(
        "mappings" => array(
            array(
                "type" => "xml",
                "namespace" => 'Endpoint\Entity',
                "path" => __DIR__ . "/../config/doctrine/xml",
            ),
        ),
    ),
));

$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
}));

$app['extensionGuesser'] = $app->share(function ($app) {
    return new ExtensionMimeTypeGuesser();
});

return $app;