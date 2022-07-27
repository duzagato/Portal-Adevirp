<?php

    class professorController extends Controller{
        public static function open($params){
            $data = array();
            $data['professor'] = Database::query('SELECT * FROM usuario WHERE usuario_slug = :slug', array(':slug'=>$params[0]))[0];

            Controller::loadTemplate('professor/open', $data);
        }
    }

?>