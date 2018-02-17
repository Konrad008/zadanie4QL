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
        $routes = $this->routes->getRoutes();

        if (array_key_exists($this->route, $routes)) {

            $controller = $routes[$this->route]['controller'];
            $action = $routes[$this->route]['action'];

            $controller->$action();

        } else {
            throw new \Exception(PHP_EOL.PHP_EOL.'Invalid command, please run application with none to recieve list of avalible actions'.PHP_EOL.PHP_EOL);
        }


    }
}