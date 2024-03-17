<?php

namespace Sienekib\Alquimist\Http;

class Response
{
	protected $content;
	protected $status;
	protected $headers;

	public function __construct($content = '', $status = 200, $headers = [])
	{
		$this->content = $content;
		$this->status = $status;
		$this->headers = $headers;
		//$this->setHeader('Access-Control-Allow-Origin', '*');
		$this->setHeader('Access-Control-Allow-Headers', 'Content-Type');
		$this->setHeader('Access-Control-Allow-Credentials', 'true');

		if (request()->method() && request()->method() == 'OPTIONS') {
			$this->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
			$this->send();
		}
	}

	public function createResponseError($type, $message, $status, $error)
	{
		header('Content-Type: application/json');
		http_response_code($error);

		$response = [
			"type" => $type,
			"message" => $message,
			"status" => $status
		];

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		exit;
	}

	public function setHeader(string $header, string $value)
	{
		$this->headers[$header] = $value;
	}


	public function setContent($content)
	{
		$this->content = $content;
		return $this;
	}

	public function setStatusCode($status)
	{
		$this->status = $status;
		return $this;
	}

	public function setHeaders(array $headers)
	{
		$this->headers = $headers;
		return $this;
	}

	public function send()
	{
		// Envia os cabeçalhos HTTP
		http_response_code($this->status);
		foreach ($this->headers as $name => $value) {
			header("{$name}: {$value}");
		}

		// Envia o conteúdo da resposta
		echo $this->content;
	}

	public static function json($data, $statusCode = 200)
	{
		// Define o cabeçalho Content-Type para application/json
		header('Content-Type: application/json');

		// Define o código de status HTTP
		http_response_code($statusCode);

		// Converte os dados para JSON
		$json = json_encode($data);

		// Verifica se a codificação foi bem-sucedida
		if ($json === false) {
			// Se a codificação falhar, gera um erro interno do servidor
			http_response_code(500); // Erro interno do servidor
			echo json_encode(['error' => 'Erro ao codificar para JSON']);
			exit;
		}

		// Envia a resposta JSON para o cliente
		echo $json;
	}
}
