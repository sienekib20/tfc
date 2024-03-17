<?php

use Sienekib\Alquimist\Http\Request;
use Sienekib\Alquimist\Http\Response;
use Sienekib\Alquimist\Templates\Engine;
use Sienekib\Alquimist\Templates\Macros;

// Retorna a instancia de Aplication
if (!function_exists('app')) {
    function app()
    {
        static $instance = null;
        if (is_null($instance)) {
            $instance = new Sienekib\Alquimist\Bootstrap\Application();
        }
        return $instance;
    }
}

// The request class Instance
if (!function_exists('request')) {
    function request()
    {
        static $instance = null;
        if (is_null($instance)) {
            $instance = new Request();
        }
        return $instance;
    }
}

// The response class Instance
if (!function_exists('response')) {
    function response()
    {
        static $instance = null;
        if (is_null($instance)) {
            $instance = new Response();
        }
        return $instance;
    }
}

// Retorna o caminho absoluto
if (!function_exists('abs_path')) {
    function abs_path()
    {
        return app()->abs_path();
    }
}

// Retorna o caminho da pasta views
if (!function_exists('view_path')) {
    function view_path()
    {
        return abs_path() . '/views';
    }
}

// Renderiza a view
if (!function_exists('view')) {
    function view($view, $params = [])
    {
        static $instance = null;
        if (is_null($instance)) {
            $instance = new Engine();
        }
        $instance->dependencies([
            new Macros
        ]);
        echo $instance->render($view, $params);
        return;
    }
}

// Renderiza a view
if (!function_exists('partials')) {
    function partials($partial)
    {
        $path = view_path() . '/partials/';
        if (str_contains($partial, '.')) {
            $partials = explode('.', $partial);
            foreach ($partials as $partial) {
                if (is_dir($path . $partial)) {
                    $path = $path . $partial . '/';
                }
            }
            $path = $path . end($partials) . '-view.php';
        } else {
            $path = $path . $partial . '-view.php';
        }
        ob_start();
        if (!file_exists($path)) {
            http_response_code(404);
            echo json_encode([
                'type' => 'erro',
                'message' => 'partial not found',
                'status' => 1002
            ]);
            exit;
        }
        require $path;
        $content = ob_get_contents();

        ob_end_clean();
        return $content;
    }
}

// Renderiza a view
if (!function_exists('asset')) {
    function asset(string $file)
    {
        $archive = abs_path() . "/public/$file";

        if (!file_exists($archive)) {
            http_response_code(404);
            echo json_encode([
                'type' => 'erro',
                'message' => 'asset not found',
                'status' => 1002
            ]);
            exit;
        }

        return "/$file?v=" . time();
    }
}
