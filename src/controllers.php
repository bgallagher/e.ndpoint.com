<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Endpoint\Entity\Endpoint as EndpointEntity;

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

$app->get('/mocks/{mock}/info', function () use ($app) {

    return $app['twig']->render('mocks-info.html');

});

$app->post('/mocks', function(Request $request) use ($app){

    $endpointService = $app['endpoint.service'];

    $endpoint = new EndpointEntity();
    $endpoint->setGetResponse(array(
        'statusCode' => $request->get('statusCode') ? : 200,
        'body' => $request->get('body') ? : '',
        'contentType' => $request->get('contentType'),
    ));

    $endpointService->create($endpoint);

    return $app->redirect("/mocks/{$endpoint->getBase62()}/info");

})->bind('mocks-create');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});