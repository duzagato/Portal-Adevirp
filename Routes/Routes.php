<?php

	class Routes{

		public static function start(){
			Database::connect();
			$request = self::checkRoutes();

			if(isset($request) && !empty($request[0]) && is_array($request) && count($request) != 0){
				$controller = $request[0].'Controller';
				array_shift($request);

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
			require_once 'Routes/Controller.php';

			if(class_exists($controller) && method_exists($controller, $method)){
				if(isset($_POST) && $_POST != array()){
					FormHelper::form_validation($_POST);
				}
				
				if(isset($_COOKIE['ADEVIRP_ID']) && isset($_COOKIE['ADEVIRP_TOKEN'])){
					if(!Database::query('SELECT token_id FROM login_token WHERE usuario_id = :usuario_id', array(':usuario_id'=>$_COOKIE['ADEVIRP_ID']))){
						User::userLogout();
					}
				}
				elseif(!isset($_SESSION['usuario_id']) || empty($_SESSION['usuario_id']) || !is_numeric($_SESSION['usuario_id'])){
					if(REQUEST != '/login'){
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
