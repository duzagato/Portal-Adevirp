<?php

	class Controller{
		protected static $usuario;
		protected static $userOfRequest;
		protected static $isAdmin;

		public function __construct(){
			if(isset($_SESSION['ADEVIRP_ID'])){
				self::$usuario = Database::query('SELECT usuario.usuario_apelido, usuario.usuario_nome, usuario.usuario_sobrenome, usuario.usuario_slug, tipo.tipo_nome FROM usuario, tipo WHERE usuario.usuario_id = :id AND usuario.tipo_id = tipo.tipo_id', array(':id'=>$_SESSION['ADEVIRP_ID']))[0];
			}

			if(self::$userOfRequest != ''){
				$userId = Database::query('SELECT usuario_id FROM usuario WHERE usuario_slug = :slug', array(':slug'=>self::$userOfRequest))[0]['usuario_id'];
				$userType = Database::query('SELECT tipo.tipo_nome FROM tipo, usuario WHERE usuario.usuario_id = :id AND usuario.tipo_id = tipo.tipo_id', array(':id'=>$_SESSION['ADEVIRP_ID']))[0]['tipo_nome'];
				if($userId === $_SESSION['ADEVIRP_ID'] || $userType === 'Administrador'){
					self::$isAdmin = true;
				}else{
					self::$isAdmin = false;
				}
			}
		}

		public static function getUsuario(){
			return self::$usuario;
		}

		public static function setUserOfRequest($userOfRequest){
			self::$userOfRequest = $userOfRequest;
		}

		public static function getUserOfRequest(){
			return self::$userOfRequest;
		}

		public static function loadView($viewName, $viewData = array()){
			$usuario = self::$usuario;
			$isAdmin = self::$isAdmin;
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
				echo json_encode($viewData);
				exit;
			}else{
				extract($viewData);
				include 'Views/'.$viewName.'.php';
			}
		}

		public static function loadTemplate($viewName, $viewData = array()){
			$usuario = self::$usuario;
			$isAdmin = self::$isAdmin;
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
				echo json_encode($viewData);
				exit;
			}else{
				extract($viewData);
				require_once 'Views/template.php';
			}
		}

		public static function loadBasicTemplate($viewName, $viewData = array()){
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
				echo json_encode($viewData);
				exit;
			}else{
				extract($viewData);
				require_once 'Views/template_basic.php';
			}
		}

		public static function test($array){
			echo '<pre>';
			print_r($array);
			exit;
		}
	}

?>
