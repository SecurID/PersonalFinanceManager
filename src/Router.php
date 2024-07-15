<?php
namespace App;

class Router {
    private array $routes = [];

    public function add($method, $route, $controller): void
    {
        $this->routes[] = [
            'method' => $method,
            'route' => $route,
            'controller' => $controller,
        ];
    }

    public function dispatch(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['route'] === $requestUri) {
                list($controller, $method) = explode('@', $route['controller']);
                $controller = "App\\Controllers\\$controller";
                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    if (method_exists($controllerInstance, $method)) {
                        $controllerInstance->$method();
                        return;
                    }
                }
            }
        }

        // If no route matched
        http_response_code(404);
        echo "404 Not Found";
    }
}
