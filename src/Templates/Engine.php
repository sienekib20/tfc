<?php

namespace Sienekib\Alquimist\Templates;

use ReflectionClass;
use Sienekib\Alquimist\Http\Response;

class Engine extends Response
{

	protected $layout = null;
	protected $content = null;
	protected $data;
	protected array $dependencies = [];

	public function extends($layout, $data = [])
	{
		$this->layout = $layout;
		$this->data = $data;
	}

	public function escape($title)
	{
		var_dump($title);
		exit;
	}

	private function load()
	{
		return !is_null($this->content) ? $this->content : '';
	}

	private function section(string $name)
	{

	}

	public function dependencies($depencies)
	{
		foreach ($depencies as $depency) {
			$className = strtolower((new ReflectionClass($depency))->getShortName());
			$this->dependencies[$className] = $depency;
		}
	}

	/*public function __call(string $name, mixed $arguments)
	{
		if (!method_exists($this->dependencies['macros'], $name)) {
			$this->createResponseError('erro view', 'Dependência não encontrada', 1002, 404);
		}

		return $this->dependencies['macros']->$name($arguments);
	}*/

	

	public function render(string $view, array $params = [])
	{
		$path = view_path() . '/';
		if (str_contains($view, '.')) {
			$views = explode('.', $view);
			foreach ($views as $view) {
				if (is_dir($path . $view)) {
					$path .= $view . '/';
				}
			}
			$path .= end($views) . '-view.php';
		} else {
			$path .= $view . '-view.php';
		}

		ob_start();
		extract($params);

		if (!file_exists($path)) {
			$this->createResponseError('error view', 'Arquivo não encontrado', 1002, 404);
		}
		require $path;
		$content = ob_get_contents();

		ob_end_clean();

		if (!is_null($this->layout)) {
			$this->content = $content;
			$data = array_merge($this->data, $params);
			$layout = $this->layout;
			$this->layout = null;
			return $this->render($layout, $data);
		}

		return $content;
	}
}
