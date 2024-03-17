<?php

namespace Sienekib\Alquimist\Http;

class Request
{
    protected $data = [];
    protected $queryParams;
    /**
     * Construct method
     */
    public function __construct()
    {
        $this->queryParams = $_GET;
        $this->data[] = (object) $this->queryParams;
    }

    public function bind($data)
    {
        $_REQUEST = $data;
    }

    public function __get($key)
    {
        return $this->data[$key] ?? null;
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function uri()
    {
        return $_SERVER['REQUEST_URI'];
    }












    /*protected $method;
	protected $url;
	protected $uri;
	protected $headers;
	protected $body;
	protected $cookies;
	protected $routeParams;
	protected $queryParams;
	protected $clientIp;
	protected $clientPort;
	protected $protocolVersion;

	public function __construct()
	{
		$this->method = $_SERVER['REQUEST_METHOD'];
        $this->url = $this->full_url();
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->headers = $this->getHeaders();
        $this->body = file_get_contents('php://input');
        $this->cookies = $_COOKIE;
        $this->routeParams = [];
        $this->queryParams = $_GET;
        $this->clientIp = $_SERVER['REMOTE_ADDR'];
        $this->clientPort = $_SERVER['REMOTE_PORT'];
        $this->protocolVersion = $_SERVER['SERVER_PROTOCOL'];
	}

	protected function full_url() {
        $ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
        return $ssl . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    protected function getHeaders() {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($key, 5)))))] = $value;
            }
        }
        return $headers;
    }

    // Métodos getter para acessar as propriedades protegidas

    public function getMethod() {
        return $this->method;
    }

    public function url() {
        return $this->url;
    }

    public function uri() {
        return $this->uri;
    }

    public function getBody() {
        return $this->body;
    }

    public function cookies() {
        return $this->cookies;
    }

    public function routeParams() {
        return $this->routeParams;
    }

    public function queryParams() {
        return $this->queryParams;
    }

    public function clientIp() {
        return $this->clientIp;
    }

    public function clientPort() {
        return $this->clientPort;
    }

    public function protocolVersion() {
        return $this->protocolVersion;
    }*/
}
