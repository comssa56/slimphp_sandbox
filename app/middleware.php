<?php
declare(strict_types=1);

use Slim\Exception\HttpMethodNotAllowedException;
use App\Application\Middleware\SessionMiddleware;
use Slim\App;
use Slim\App\Controllers;

return function (App $app) {
    $app->add(SessionMiddleware::class);


    // 認証module
    $app->add(function ($request, $handler) {
        $auth = new Slim\App\Controllers\Auth($request);

        if(!$auth->isValid()) {
            throw new HttpMethodNotAllowedException($request);
        } else {
            return $handler->handle($request);    
        }        
    });
};
