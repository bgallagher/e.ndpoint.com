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
            $extensionMimeTypeGuesser = $app['extensionGuesser'];

            $endpoint = new EndpointEntity();
            $endpoint->setGetResponse(array(
                'statusCode' => $request->get('statusCode') ? : 200,
                'body' => $request->get('body') ? : '',
                'contentType' => $extensionMimeTypeGuesser->guess($request->get('contentType')) ?: $request->get('contentType'),
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


        $controllers->match('/{base62}', function (Request $request, $base62) use ($app) {

            $defaults =  array(
                'body' => null,
                'statusCode' => 200,
                'contentType' => null,
            );

            $endpointService = $app['endpoint.service'];
            $extensionMimeTypeGuesser = $app['extensionGuesser'];

            $endpoint = $endpointService->findByBase62($base62);

            if (!$endpoint instanceof EndpointEntity) {
                $app->abort(404);
            }

            $methodGetter = 'get' . ucfirst(strtolower($request->getMethod())) . 'Response';
            $methodGetter = 'getGetResponse'; //temporary override

            $responseData = array_merge($defaults, $endpoint->$methodGetter());

            return new Response(
                $responseData['body'],
                $responseData['statusCode'],
                array(
                    'Content-Type' => $responseData['contentType'],
                )
            );

        })->method('GET|POST|PUT|DELETE');

        return $controllers;
    }

}