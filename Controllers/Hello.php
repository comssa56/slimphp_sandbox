<?php
namespace Slim\App\Controllers;
class Hello
{
    private $c;
    public function __construct($container) {
        $this->c = $container;
    }

    public function index($request, $response, $args)
    {
        // Sample log message
        // $this->c->get('logger')->info($auth['0']);
       
//       $response->getBody()->write($request->getAttribute('session'));
       $response->getBody()->write('Hello World');

       return $response;
        // Render index view
//        return $this->c->get('renderer')->render($response, 'index.phtml', $args);
    }

    public function execute($request, $response, $args)
    {
        $response->getBody()->write('execute Hello World');

        return $response;
     }
}
