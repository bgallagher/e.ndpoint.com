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

            $endpointService = $app['endpoint.service'];
            $endpoint = $endpointService->findByBase62($base62);

            if (!$endpoint instanceof EndpointEntity) {
                $app->abort(404);
            }

            $model = $app['endpoint.service']->endpointToArray($endpoint);

            return $app['twig']->render('mocks-info.html', $model);

        });

        return $controllers;
    }

}