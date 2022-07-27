<?php


    class User extends Database{
        public static function userLogout(){
            Database::query('DELETE FROM token WHERE token = :token', array(':token'=>password_hash($_COOKIE['ADEVIRP_TOKEN'])));
            Helpers::unsetCookies();
            session_destroy();

            header('Location: '.URL.'login');
        }
    }

?>