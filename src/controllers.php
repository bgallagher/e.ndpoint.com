<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->get('/', function () use ($app) {

    $extensionMimeTypeGuesser = $app['extensionGuesser'];

    $model = array(
        'mimeTypes' => $extensionMimeTypeGuesser->getMimeTypes(),
        'statusCodes' => Response::$statusTexts
    );

    return $app['twig']->render('index.html', $model);

})->bind('homepage');

$app->match('/mock', function (Request $request) use ($app) {

    $extensionMimeTypeGuesser = $app['extensionGuesser'];

    $response = new Response(
        $request->get('b') ? : '',
        $request->get('sc') ? : 200,
        array(
            'Content-Type' => $extensionMimeTypeGuesser->guess($request->get('ct')) ? : $request->get('ct'),
        )
    );

    /**
     * Cache for 1 week
     */
    $response->setPublic()->setMaxAge(604800);

    return $response;

})->bind('endpoint');

$app->get('/{endpoint}/{childEndpoint}', function ($endpoint, $childEndpoint) use ($app) {
    return $endpoint . ' ' . $childEndpoint;
})->value('childEndpoint', '');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});