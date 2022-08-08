<?php
    class sairController extends Controller{
        public static function index(){
            $data = array();
            if(isset($_POST['sair'])){
                if(isset($_POST['sair_tudo'])){
                    Database::query('DELETE FROM login_token WHERE usuario_id = :id', array(':id'=>$_SESSION['ADEVIRP_ID']));
                    User::userLogoutAll();
                }else{
                    User::userLogout();
                    
                }
            }

            Controller::loadView('sair', $data);
        }
    }
?>