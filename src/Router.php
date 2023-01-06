<?php

/**
 * This class describe a simple router.
 */
class Router
{
	/** @var array<string, array<string, string>> $routes Registered routes */
    protected array $routes = [
        'GET'    => [],
        'POST'   => [],
        'PUT'    => [],
        'PATCH'  => [],
        'DELETE' => [],
    ];

    /**
     * Adds a route accessible by the given HTTP method.
     *
     * @param string $uri      Matching uri
     * @param string $callable Function to call on match
     * @param string $method   HTTP method to access the route/view
     */
    public function add(string $uri, callable $callable, string $method = 'GET'): self
    {
        $this->routes[$method][$uri] = $callable;

        return $this;
    }

    /**
     * Adds a route accessible by the GET method.
     *
     * @param string   $uri      Matching uri
     * @param callable $callable Function to call on match
     */
    public function get(string $uri, callable $callable): self
    {
        return $this->add($uri, $callable);
    }

    /**
     * Adds a route accessible by the GET method.
     *
     * @param string   $uri      Matching uri
     * @param callable $callable Function to call on match
     */
    public function post(string $uri, callable $callable): self
    {
        return $this->add($uri, $callable, 'POST');
    }

    /**
     * Adds a route accessible by the PUT method.
     *
     * @param string   $uri      Matching uri
     * @param callable $callable Function to call on match
     */
    public function put(string $uri, callable $callable): self
    {
        return $this->add($uri, $callable, 'PUT');
    }

    /**
     * Adds a route accessible by the PATCH method.
     *
     * @param string   $uri      Matching uri
     * @param callable $callable Function to call on match
     */
    public function patch(string $uri, callable $callable): self
    {
        return $this->add($uri, $callable, 'PATCH');
    }

    /**
     * Adds a route accessible by the DELETE method.
     *
     * @param string   $uri      Matching uri
     * @param callable $callable Function to call on match
     */
    public function delete(string $uri, callable $callable): self
    {
        return $this->add($uri, $callable, 'DELETE');
    }

    /**
     * Router execution function. Returns the page corresponding to the URI.
     *
     * @param string $uri    Matching uri
     * @param string $method HTTP method
     */
    public function direct(string $uri, string $method): void
    {
        if (array_key_exists($method, $this->routes) && array_key_exists($uri, $this->routes[$method])) {
            $callable = $this->routes[$method][$uri];
            $callable();
        } else {
            http_response_code(404);
            require '404.php';
        }
    }
}