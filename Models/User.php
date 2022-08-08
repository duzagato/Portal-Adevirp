<?php


    class User extends Database{
        public static function userLogout(){
            Database::query('DELETE FROM login_token WHERE token = :token', array(':token'=>$_SESSION['ADEVIRP_TOKEN']));
            if(isset($_COOKIE['ADEVIRP_ID'])){
                Helpers::expireCookie('ADEVIRP_ID');
            }

            if(isset($_COOKIE['ADEVIRP_TOKEN'])){
                Helpers::expireCookie('ADEVIRP_TOKEN');
            }

            self::logoutSession();
            header('Location: '.URL.'login');
        }

        public static function userLogoutAll(){
            Database::query('DELETE FROM login_token WHERE token = :token', array(':token'=>password_hash($_COOKIE['ADEVIRP_TOKEN'])));
            Helpers::expireCookie('ADEVIRP_ID');
            Helpers::expireCookie('ADEVIRP_TOKEN');
            self::logoutSession();

            header('Location: '.URL.'login');
        }

        public static function logoutSession(){
            unset($_SESSION['ADEVIRP_ID']);
            unset($_SESSION['ADEVIRP_TOKEN']);
            session_destroy();
        }

        public static function verifyToken($usuario_id, $token){
            if(Database::query('SELECT token_id FROM login_token WHERE token = :token', array(':token'=>$token))){
                return true;
            }else{
                return false;
            }
        }
    }

?>