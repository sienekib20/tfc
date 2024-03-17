<?php

namespace Sienekib\Alquimist\Routing;

class Route
{
	protected static $request;
	protected static $response;
	protected static array $routes = [];
	protected static ?string $prefix = null;
	protected static ?string $middleware = null;
	protected ?string $currentWebRoute = null;

	protected static array $name = [];

	public function __construct($request, $response)
	{
		self::$request = $request;
		self::$response = $response;
	}

	public static function add(string $method, string $uri, $action)
	{
		$uri = self::$prefix ? '/' . self::$prefix . $uri : $uri;
		$route = (object) [
			'uri' => $uri,
			$method => [
				$uri => (object) [
					'action' => $action, 'middleware' => self::$middleware
				]
			]
		];
		static::$routes[] = $route;
	}

	// set prefix on route
	public static function prefix($prefix, $callback)
	{
		self::$prefix = $prefix;
		if (is_callable($callback)) call_user_func($callback);
		self::$prefix = null;
	}

	public static function middleware($middleware, $callback)
	{
		if (!str_contains($middleware, ':')) {
			return self::$response->createResponseError('error', 'middleware mal formado', 1004, 500);
		}
		self::$middleware = $middleware;
		if (is_callable($callback)) {
			call_user_func($callback);
			self::$middleware = null;
		}
	}

	public function dispatch()
	{
		$middle = $action = null;
		foreach (self::$routes as $key => $route) {
			$uri = preg_replace('/\/{(\w+)}/', '/(?<$1>.*?)', $route->uri);
			if (preg_match("#^{$uri}$#", self::$request->uri(), $macthes)) {
				$this->currentWebRoute = $route->uri;
				$parameters = [];
				if (!empty($macthes)) {
					foreach ($macthes as $key => $value) {
						if (gettype($key) == 'integer') continue;
						$parameters[$key] = $value;
					}
				}
				if (!empty($parameters)) {
					self::$request->bind($parameters);
				}
				$method = self::$request->method();
				$action = $route->$method[$this->currentWebRoute]->action ?? false;
				$middle = $route->$method[$this->currentWebRoute]->middleware;
				break;
			}
		}

		$this->executeRouteMiddleware($middle);

		if ($action == false) {
			self::$response->createResponseError('error', 'Rota não encontrada', 1004, 404);
		}

		if (is_callable($action)) {
			return call_user_func($action);
		}

		if (is_array($action)) {
			list($controller, $method) = $action;
			return $this->classAndMethodExist($controller, $method)->$method(self::$request);
		}
	}

	public function executeRouteMiddleware($middleware)
	{
		if (!is_null($middleware)) {
			list($middleware_obj, $method) = explode(':', $middleware);
			$build = "App\\Http\\Middlewares\\{$middleware_obj}";
			return $this->classAndMethodExist($build, $method)->$method();
		}
	}

	private function classAndMethodExist(string $class, string $method)
	{
		if (!class_exists($class)) {

			self::$response->createResponseError('error', 'Class não encontrada', 1004, 404);
		}
		$class = new $class();
		if (!method_exists($class, $method)) {
			self::$response->createResponseError('error', 'Método não encontrado', 1004, 404);
		}

		return $class;
	}

	public function name($name)
	{
		self::$name[] = $name;
	}

	// The get method
	public static function get($uri, $action)
	{
		self::add('GET', $uri, $action);
		return new static(self::$request, self::$response);
	}

	public static function post($uri, $action)
	{
		self::add('POST', $uri, $action);
		return new static(self::$request, self::$response);
	}
}
