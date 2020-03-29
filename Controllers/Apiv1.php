<?php
namespace Slim\App\Controllers;

use ReflectionClass;
use ReflectionMethod;
use Slim\Exception\HttpNotFoundException;

class Apiv1
{
    private $api_table = array(
        'test' => 'Slim\App\Controllers\ApiTest'
    );
    private $c;
    public function __construct($container) {
        $this->c = $container;
    }

    public function execute($api, $request, $response, $arg)
    {   
        if(isset($this->api_table[$api])) {
            $exec_class = new ReflectionClass($this->api_table[$api]);
            $exec_obj = $exec_class->newInstance();
            $exec_api = $exec_class->getMethod('execute');
            return $exec_api->invoke($exec_obj, $request, $response, $arg);
        } else {
            throw new HttpNotFoundException($request);
            
        }

    }
}