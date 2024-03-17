<?php

class Application
{
	public function __construct() {}

	// Inicializa a aplicação
	public static function run(string $path)
	{
		$path = realpath($path);
		require $path . "/routes/web.php";

		return  app()->run($path);
	}
}