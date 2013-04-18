<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Endpoint\Component\HttpFoundation\File\MimeType\ExtensionMimeTypeGuesser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app->get('/', function (Request $request) use ($app) {
    return 'home';
});

$app->get('/mock.{extension}', function ($extension, Request $request) use ($app) {
    $extensionMimeTypeGuesser = new ExtensionMimeTypeGuesser();

    return new Response(
        //body
        $request->get('b') ?: 'e.ndpoint.com',

        //status code
        $request->get('sc') ? : 200,

        //headers
        array(
            'Content-Type' => $extensionMimeTypeGuesser->guess($extension),
        )
    );
});

$app->run();