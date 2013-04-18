<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Endpoint\Component\HttpFoundation\File\MimeType\ExtensionMimeTypeGuesser;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html', array());
})
->bind('homepage');

$app->get('/mock.{extension}', function ($extension, Request $request) use ($app) {
    $extensionMimeTypeGuesser = new ExtensionMimeTypeGuesser();

    return new Response(
        //body
        $request->get('b'),

        //status code
        $request->get('sc') ? : 200,

        //headers
        array(
            'Content-Type' => $extensionMimeTypeGuesser->guess($extension),
        )
    );
});

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});
