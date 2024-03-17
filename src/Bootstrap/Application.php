<?php

namespace Sienekib\Alquimist\Bootstrap;

use Sienekib\Alquimist\Http\Request;
use Sienekib\Alquimist\Http\Response;
use Sienekib\Alquimist\Routing\Route;

class Application
{
    private $path = null;
    private $absolutePath;
    private $request;
    private $response;
    private $route;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request, $this->response);
        $this->absolutePath = function ($path) {
            return $path;
        };
    }

    public function run(string $path)
    {
        $this->path = $path;
        $this->route->dispatch();
    }

    public function abs_path()
    {
        return ($this->absolutePath)($this->path);
    }
}
