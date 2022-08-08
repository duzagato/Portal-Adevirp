<?php

    class Agendas extends Controller{
        public static function index(){
            $data = array();
            $data['professores'] = Database::query('SELECT usuario_nome, usuario_sobrenome, usuario_slug FROM usuario WHERE tipo_id = :tipo_id', array(':tipo_id'=>3));
            $data['educandos'] = Database::query('SELECT usuario_nome, usuario_sobrenome, usuario_slug FROM usuario WHERE tipo_id = :id', array(':id'=>5));

            Controller::loadTemplate('agendas', $data);
        }
    }

?>