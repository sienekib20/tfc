<?php

namespace App\Http\Middlewares;

class web
{
	public function auth()
	{
		$loggedIn = true;

		if (! $loggedIn) {
			header('Location: /login');
			exit;
		}
	}
}