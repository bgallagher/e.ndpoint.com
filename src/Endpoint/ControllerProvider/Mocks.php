<?php
namespace Endpoint\ControllerProvider;

use Endpoint\Entity\Endpoint as EndpointEntity;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Mocks implements ControllerProviderInterface
{

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->post('/', function (Request $request) use ($app) {

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


        $controllers->get('/{base62}/info', function ($base62) use ($app) {

            $tmpEndpoint = new EndpointEntity();
            $tmpEndpointArray = [];

            $tmpEndpoint->setBase62($base62);
            $tmpEndpoint->setGetResponse(array(
                'content-type' => 'json',
                'body' => 'hello world',
                'status-code' => 200
            ));

            $model = array(
                'contentType' => 'json',
                'body' => 'hello world',
                'statusCode' => 200
            );

            return $app['twig']->render('mocks-info.html', $model);

        });

        return $controllers;
    }

}