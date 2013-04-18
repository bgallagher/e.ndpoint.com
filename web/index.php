<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MockUrl\Component\HttpFoundation\File\MimeType\ExtensionMimeTypeGuesser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app->get('/', function (Request $request) use ($app) {
    return 'home';
});

$app->get('/endpoint', function (Request $request) use ($app) {
    $extensionMimeTypeGuesser = new ExtensionMimeTypeGuesser();

    return new Response(
        //body
        $request->get('b'),

        //status code
        $request->get('sc') ? : 200,

        //headers
        array(
            'Content-Type' => $extensionMimeTypeGuesser->guess($request->get('ct')),
        )
    );
});

$app->run();