<?php


    class loginController extends Controller{
        public function __construct(){
            if(isset($_SESSION['adevirp_id'])){
                header('Location: '.URL);
            }
        }

        public static function index(){
            $data = array();
            $data['types'] = Database::getAllFromTable('types');
            $validation = FormHelper::getValidation();

            if(isset($validation['user_add']) && $validation['user_add'] === true){
                unset($validation['form_data']['user_cpassword']);
                unset($validation['form_data']['form_submit']);
                $validation['form_data']['user_password'] = password_hash($validation['form_data']['user_password'], PASSWORD_BCRYPT);
                Database::dbAction('add', $validation['form_data'], 'user');
                $data['user_add'] = 'Usuário adicionado com sucesso';
            }elseif(isset($validation['user_add'])){
                $data['user_add'] = $validation['user_add'];
            }

            Controller::loadView('login', $data);
        }
    }

?>