<?php


    class loginController extends Controller{
        public function __construct(){
            if(isset($_SESSION['ADEVIRP_ID'])){
                header('Location: '.URL);
            }
        }

        public static function index(){

            $data = array();
            $data = FormHelper::getValidation();
            $data['tipos'] = Database::getAllFromTable('tipo');

            if(isset($data['alerts']) && $data['alerts']['usuario_apelido'] != 1 && $data['alerts']['usuario_senha'] == 1){
                $data['alerts']['usuario_apelido'] = 1;
                $senha = Database::query('SELECT usuario_senha FROM usuario WHERE usuario_apelido = :apelido', array(':apelido'=>$data['form_data']['usuario_apelido']))[0]['usuario_senha'];
 
                if(password_verify($data['form_data']['usuario_senha'], $senha)){
                    $data['alerts']['usuario_senha'] = 1;
                    $usuario_id = Database::query('SELECT usuario_id FROM usuario WHERE usuario_apelido = :usuario_apelido', array(':usuario_apelido'=>$data['form_data']['usuario_apelido']))[0]['usuario_id'];
                    $_SESSION['ADEVIRP_ID'] = $usuario_id;
                    $token = Helpers::insertToken($usuario_id);
                    $_SESSION['ADEVIRP_TOKEN'] = $token;
                    $_SESSION['ADEVIRP_SLUG'] = Database::query('SELECT usuario_slug FROM usuario WHERE usuario_id = :id', array(':id'=> $usuario_id))[0]['usuario_slug'];

                    if(isset($data['form_data']['manter_conectado']) && $data['form_data']['manter_conectado'] == true){
                        Helpers::createCookies($usuario_id, $token);
                    }
                    $data['isValid'] = true;
                    $data['redirect'] = URL;
                }else{
                    $data['alerts']['usuario_senha'] = 'Senha inválida, tente novamente';
                }
            }else{
                $data['alerts']['usuario_apelido'] = 'Usuário inválido, tente novamente';
            }

            Controller::loadView('login', $data);
        }
    }

?>