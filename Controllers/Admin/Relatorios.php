<?php
    class Relatorios extends Controller{
        public static function index(){
            $data = array();            
            $data['professores'] = Database::query('SELECT * FROM usuario, tipo WHERE usuario.tipo_id = tipo.tipo_id AND tipo.tipo_nome = :tipo', array(':tipo'=>'Professor'));

            Controller::loadTemplate('relatorios/index', $data);
        }
    }
?>