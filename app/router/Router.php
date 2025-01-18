<?php

namespace App\Router;

class Router {
  private $routes = [];

  /**
   * Adds a new route to the routing system.
   * 
   * This method defines a route by specifying the HTTP method, the URL pattern, 
   * and the handler responsible for processing requests that match the route.
   * Dynamic parameters in the URL pattern (e.g., `{id}`) are converted to regular 
   * expression placeholders for pattern matching.
   * 
   * Example usage:
   * ```php
   * $router->addRoute('GET', '/', function() {
   *     requireFile('controller/index.controller.php');
   * });
   * ```
   * 
   * @param string $method The HTTP method for the route (e.g., 'GET', 'POST').
   * @param string $pattern The URL pattern for the route. Supports dynamic segments 
   *                        using curly braces (e.g., `/users/{id}`).
   * @param callable $handler A callable function responsible for handling requests 
   *                          that match the specified method and pattern.
   * 
   * @return self Returns the instance for method chaining.
   */
  public function addRoute($method, $pattern, $handler) {
    // Convert dynamic segments in the pattern (e.g., `{id}`) to regex named groups
    $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $pattern); 
    $pattern = "#^" . $pattern . "$#";

    // Add the new route to the routes list
    $this->routes[] = [
        'method' => $method,
        'pattern' => $pattern,
        'handler' => $handler
    ];
    return $this;
  }


/**
 * Handles an incoming HTTP request and dispatches it to the appropriate route handler.
 * 
 * This method matches the provided URI and HTTP method against the registered routes.
 * If a matching route is found, it extracts any dynamic parameters from the URI and 
 * invokes the corresponding handler with those parameters. If no route matches, the 
 * method does not return a value, allowing for custom handling (e.g., 404 responses).
 * 
 * Example usage:
 * ```php
 * $router = new Router();
 * 
 *  Get the URI and HTTP method from the incoming request
 * $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
 * $requestMethod = $_POST['__method'] ?? $_SERVER['REQUEST_METHOD'];
 * 
 * Dispatch the request
 * $router->request($uri, $requestMethod);
 * ```
 * 
 * @param string $uri The requested URI path (e.g., `/users/123`).
 * @param string $method The HTTP method used for the request (e.g., 'GET', 'POST').
 * 
 * @return mixed The result of the handler function for the matched route, or `null` 
 *               if no route matches. The return value depends on the implementation 
 *               of the handler.
 */
public function request($uri, $method) {
    foreach ($this->routes as $route) {
        // Check if the HTTP method and the URI match the route
        if ($method === $route['method'] && preg_match($route['pattern'], $uri, $matches)) {
            // Extract named parameters from the URI
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            // Call the route handler with the extracted parameters
            return call_user_func_array($route['handler'], $params);
        }
    }
    http_response_code(404);
    requireView('404.view.php');
    return $this;
}

public function only() {
  
}

}