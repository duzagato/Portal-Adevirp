<?php
	class ajaxController extends Controller{
		public static function login(){
			$data = array();
			Users::login_user($_POST);
		}

		public static function create_course(){
			$data['schools_values']['price'] = $_POST['price1'].','.$_POST['price2'];
			unset($_POST['price1']);
			unset($_POST['price2']);
			$data['schools_courses'] = $_POST;
			print_r($data);
			exit;
		}

		public static function create_school(){
			global $path;
			extract($_FILES);
			
			$data['alerts']['name'] = self::create_school__name($_POST['name'], true);
			$_POST['slug'] = Modules::generateSlug($_POST['name']);
			$data['alerts']['description'] = self::create_school__description($_POST['description'], true);

			if(isset($_POST['sale_system']) && !empty($_POST['sale_system'])){
				$data['alerts']['sale_system'] = 1;
			}else{
				$data['alerts']['sale_system'] = 'Escolha um sistema de vendas';
			}

			if(Modules::validateFile($profile_image, 'image') == 1){
				$data['alerts']['profile_image'] = 1;
			}elseif(Modules::validateFile($profile_image, 'image') == 0){
				$data['alerts']['profile_image'] = 'Escolha uma imagem de perfil';
			}else{
				$data['alerts']['profile_image'] = Modules::validateFile($profile_image, 'image');
			}

			if(Modules::validateFile($cover_image, 'image') == 1){
				$data['alerts']['cover_image'] = 1;
			}else{
				$data['alerts']['cover_image'] = (Modules::validateFile($cover_image, 'image') == 0) ? 1 : Modules::validateFile($cover_image, 'image');
			}

			if(Modules::validateFile($presentation_video, 'video') == 1){
				$data['alerts']['presentation_video'] = 1;
			}else{
				$data['alerts']['presentation_video'] = (Modules::validateFile($presentation_video, 'video') == 0) ? 1 : Modules::validateFile($presentation_video, 'video');
			}

			if(Modules::validateForm($data['alerts']) == 1){
				$_POST['profile_image'] = Modules::uploadFile($profile_image, $path['profile_image']);
				$_POST['cover_image'] = ($cover_image['name'] != '') ? Modules::uploadFile($cover_image, $path['cover_image']) : '';
				$_POST['presentation_video'] = ($presentation_video['name'] != '') ? Modules::uploadFile($presentation_video, $path['presentation_video']) : '';

				$data['school_name'] = Schools::create_school($_POST);
				$data['alerts']['valid'] = 1;
			}

			echo json_encode($data);
		}

		public static function create_school__description($data, $return = false){
			if($return == true){
				return Schools::validateSchoolName($data[0]);
			}else{
				$description = (isset($data[0]) ? $data[0] : '');
				$data['alerts']['description'] = Schools::validateSchoolDescription($description);
				if($data['alerts']['description'] == 1){
					$data['alerts']['valid'] = 1;
				}else{
					$data['alerts']['valid'] = 0;
				}
				echo json_encode($data);
			}
		}

		public static function create_school__name($data, $return = false){
			if($return == true){
				return Schools::validateSchoolName($data);
			}else{
				$name = (isset($data[0]) ? $data[0] : '');
				$data['alerts']['name'] = Schools::validateSchoolName($name);
				if($data['alerts']['name'] == 1){
					$data['alerts']['valid'] = 1;
				}else{
					$data['alerts']['valid'] = 0;
				}
				echo json_encode($data);
			}
		}

		public static function register_user(){
			$data = array();

			Users::register_user($_POST);
		}

		public static function register_user__email($data = ''){
			echo json_encode(Users::validateEmail($data));
		}

		public static function register_user__password($data = ''){
			echo json_encode(Users::validatePassword($data));
		}

		public static function user_activation($data){
			echo json_encode(Users::activateUser($data[0], $_POST['activation_code']));
		}

		public static function user_activation__activation_code($data){
			$code = (isset($data[1])) ? $data[1] : '';
			echo json_encode(Users::activateUser($data[0], $code));
		}
	}
?>