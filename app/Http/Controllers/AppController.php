<?php

namespace app\Http\Controllers;

class AppController
{
	public function index()
	{
		$dados = [];

		return view('site.index', compact('dados'));
	}
}