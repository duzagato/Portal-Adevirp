<?php
	date_default_timezone_set('America/Sao_Paulo');
	$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
	define('REQUEST', '/'. substr_replace(trim($_SERVER['REQUEST_URI'], '/'), '', 0, strlen($scriptName)));
	$environment = 'dev';

	if($environment === 'dev'){
		define('URL', 'http://localhost/adevirp/');
		define('PATH_UPLOADS_IMPRESSOES', 'assets/uploads/impressoes/');
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
	$routes['/agenda/{usuario}'] = '/agenda/abrir/:usuario';
	$routes['/agenda/{professor}/adicionar/{dia}/{aula}'] = '/agenda/adicionar/:professor/:dia/:aula';
	$routes['/relatorios/{usuario}'] = '/relatorios/abrir/:usuario';
	$routes['/professor/{professor}'] = '/professor/open/:professor';
	$routes['/relatorios/{professor}'] = '/relatorios/open/:professor';
	$routes['/{professor}/relatorios/{id}'] = '/relatorios/ver/:professor/:id';
	$routes['/relatorios/{professor}/preencher/{aluno}/{time}'] = '/relatorios/preencher/:aluno/:time';
	$routes['/relatorios/{professor}/falta/{aluno}/{time}'] = '/relatorios/falta/:aluno/:time';
	$routes['/relatorios/{professor}/cfalta/{aluno}/{time}'] = '/relatorios/cfalta/:aluno/:time';
?>