<?php
namespace Slim\App\Controllers;

use ReflectionClass;
use ReflectionMethod;
use Slim\Exception\HttpNotFoundException;

class ApiHandler
{
    private $api_table = array(
        'v1' => 'Slim\App\Controllers\Apiv1'
    );
    private $c;
    public function __construct($container) {
        $this->c = $container;
    }

    public function execute($ver, $api, $request, $response, $arg)
    {   
        if(isset($this->api_table[$ver])) {
            $exec_class = new ReflectionClass($this->api_table[$ver]);
            $exec_obj = $exec_class->newInstance($this->c);
            $exec_api = $exec_class->getMethod('execute');
            return $exec_api->invoke($exec_obj, $api, $request, $response, $arg);
        } else {
            throw new HttpNotFoundException($request);
        }

    }
}