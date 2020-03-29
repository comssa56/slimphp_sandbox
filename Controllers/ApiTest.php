<?php
namespace Slim\App\Controllers;

class ApiTest
{
    public function __construct() {
    }

    public function execute($request, $response, $arg)
    {   
        $response->getBody()->write('test ok');
        return $response;
    }
}