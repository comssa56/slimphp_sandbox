<?php
namespace Slim\App\Controllers;
class Auth
{
    private $request;
    public function __construct($_request) {
        $this->request = $_request;
    }

    public function isValid()
    {
        $auth = $this->request->getHeader('Authorization');

        $authorized = false;
        if(isset($auth['0'])) {
            $authorized = $auth['0']=='Basic Y29tOjU2Cg';
        }

        return $authorized;
    }
}
