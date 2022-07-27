<?php
	date_default_timezone_set('America/Sao_Paulo');
	$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
	define('REQUEST', '/'. substr_replace(trim($_SERVER['REQUEST_URI'], '/'), '', 0, strlen($scriptName)));
	$environment = 'dev';

	if($environment === 'dev'){
		define('URL', 'http://localhost/adevirp/');
		$db = array(
			'host' => 'localhost',
			'dbname' => 'adevirp',
			'user' => 'root',
			'pass' => ''
		);
	}else{
		$db = array(
			'host' => 'localhost',
			'dbname' => 'test',
			'user' => 'root',
			'pass' => ''
		);
	}

	
	global $db, $routes;
	$path = array();

	$routes['/example'] = '/escolas/abrir';
	$routes['/example/{titulo}'] = '/posts/open/:titulo';
	$routes['/example/{id}/{titulo}'] = '/galeria/abrir/:id/:titulo';
	$routes['/professor/{professor}'] = '/professor/open/:professor';
	$routes['/professor/{professor}/agenda'] = '/agenda/open/:professor';
	$routes['/professor/{professor}/agenda/adicionar/{dia}/{aula}'] = '/agenda/adicionar/:professor/:dia/:aula';
	$routes['/professor/{professor}/agenda/excluir/{id}'] = '/agenda/excluir/:id/:professor';
	$routes['/professor/{professor}/agenda/cexcluir/{id}'] = '/agenda/cexcluir/:id/:professor';
	$routes['/relatorios/{professor}'] = '/relatorios/open/:professor';
?>