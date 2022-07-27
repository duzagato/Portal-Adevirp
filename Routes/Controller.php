<?php

	class Controller{
		public static function loadView($viewName, $viewData = array()){
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
				echo json_encode($viewData);
				exit;
			}else{
				extract($viewData);
				include 'Views/'.$viewName.'.php';
			}
		}

		public static function loadTemplate($viewName, $viewData = array()){
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
