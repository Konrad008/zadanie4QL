<?php
namespace KD;

class EntryPoint
{
    private $route;
    private $routes;

    public function __construct(string $route, \KD\KDRoutes $routes) {
        $this->route = $route;
        $this->routes = $routes;
    }

    public function run() {

    }
}