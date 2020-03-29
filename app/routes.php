<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\App\Controllers;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Psr\Log\LoggerInterface;

return function (App $app) {
    // $app->get('/', function (Request $request, Response $response) {
    //     $response->getBody()->write('Hello world!');
    //     return $response;
    // });

    $container = $app->getContainer();

    $app->get('/API/{ver}/{method}', function (Request $request, Response $response, array $args) use ($container) {
        $container->get('logger')->info($args['ver'] . ":" . $args['method']);
        $handle = new Slim\App\Controllers\ApiHandler($container);
        return $handle->execute($args['ver'], $args['method'], $request, $response, $args);
    });


    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
