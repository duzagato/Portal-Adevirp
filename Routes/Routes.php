<?php

	class Routes{

		public static function start(){
			Database::connect();
			$request = self::checkRoutes();

			if(isset($request) && !empty($request[0]) && is_array($request) && count($request) != 0){
				if($request[0] === 'admin'){
					if(isset($request[1])){
						$controller = ucfirst($request[1]);
						require_once 'Controllers/Admin/'.$controller.'.php';
						array_shift($request);
						array_shift($request);
					}else{
						header('Location: '.URL);
					}
				}else{
					$controller = $request[0].'Controller';
					array_shift($request);
				}

				if(isset($request[0]) && !empty($request[0])){
					$method = $request[0];
					array_shift($request);
				}else{
					$method = 'index';
				}

				$info = count($request) > 0 ? $request : array();
			}else{
				$controller = 'homeController';
				$method = 'index';
				$info = array();
			}

			// echo '<pre>';
			// echo $controller;
			// echo '<br>';
			// echo $method;
			// echo '<br>';
			// print_r($info);
			// exit;
			require_once 'Routes/Controller.php';

			if(class_exists($controller) && method_exists($controller, $method)){
				if($_POST != array() && !isset($_POST[$controller])){
					FormHelper::form_validation($_POST, $_FILES);
				}

				if(isset($_SESSION['ADEVIRP_ID']) && isset($_SESSION['ADEVIRP_TOKEN'])){
					if(User::verifyToken($_SESSION['ADEVIRP_ID'], $_SESSION['ADEVIRP_TOKEN']) === false){
						User::userLogout();
					}
				}elseif(isset($_COOKIE['ADEVIRP_ID']) && isset($_COOKIE['ADEVIRP_TOKEN'])){
					if(User::verifyToken($_COOKIE['ADEVIRP_ID'], $_COOKIE['ADEVIRP_TOKEN']) === false){
						User::userLogout();
					}else{
						$_SESSION['ADEVIRP_ID'] = $_COOKIE['ADEVIRP_ID'];
						$_SESSION['ADEVIRP_TOKEN'] = $_COOKIE['ADEVIRP_TOKEN'];
						$_SESSION['ADEVIRP_SLUG'] = Database::query('SELECT usuario_slug FROM usuario WHERE usuario_id = :id', array(':id'=> $_COOKIE['ADEVIRP_ID']))[0]['usuario_slug'];
					}
				}else{
					if(REQUEST != '/login' && REQUEST != '/cadastrar'){
						header('Location: '.URL.'login');
					}
				}

				$c = new $controller();
				if(is_array($info) === true && $info != array()){
					foreach($info as $key => $value){
						$info[$key] = Helpers::strToSlug($value);
					}
				}

				$controller::{$method}($info);
			}else{
				require_once 'erro.php';
			}
		}

		public static function checkRoutes(){
			global $routes;
			$request = REQUEST;

			if(isset(explode('/', REQUEST)[1]) && explode('/', REQUEST)[1] !== '' && Database::query('SELECT usuario_id FROM usuario WHERE usuario_slug = :slug', array(':slug'=>explode('/', REQUEST)[1]))){
				$r = explode('/', REQUEST);
				array_shift($r);
				Controller::setUserOfRequest(Helpers::strToSlug($r[0]));
				$user = Helpers::strToSlug($r[0]);
				if(count($r) === 1){
					Controller::setUserOfRequest(Helpers::strToSlug($r[0]));
					$request = '/perfil/open/'.$user;
				}
			}
			
			foreach($routes as $pt => $newrequest) {
				// Identifica os argumentos e substitui por regex
				$pattern = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $pt);

				// Faz o match da request
				if(preg_match('#^('.$pattern.')*$#i', $request, $matches) === 1) {
					array_shift($matches);
					array_shift($matches);
					// Pega todos os argumentos para associar
					$itens = array();
					if(preg_match_all('(\{[a-z0-9]{1,}\})', $pt, $m)) {
						$itens = preg_replace('(\{|\})', '', $m[0]);
					}
					
					// Faz a associação
					$arg = array();
					foreach($matches as $key => $match) {
						$arg[$itens[$key]] = $match;
					}

					if(count($arg) != 0){
						// Monta a nova request
						foreach($arg as $argkey => $argvalue) {
							$newrequest = str_replace(':'.$argkey, $argvalue, $newrequest);
						}
						
						$request = $newrequest;
						break;
					}

				}
			}

			$request = explode('/', $request);
			if($request[0] === ''){
				array_shift($request);
			}

            for($i = 0; $i < count($request); $i++){
                if(strstr($request[$i], '-')){
                    $request[$i] = str_replace('-', '_', $request[$i]);
                }
            }

			return $request;
        }
	}

?>
