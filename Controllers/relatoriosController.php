<?php
    class relatoriosController extends Controller{
        public static function index(){
            $data = array();            
            $data['professores'] = Database::query('SELECT * FROM usuario, tipo WHERE usuario.tipo_id = tipo.tipo_id AND tipo.tipo_nome = :tipo', array(':tipo'=>'Professor'));

            Controller::loadTemplate('relatorios/index', $data);
        }

        public static function open($params){
            $data = array();
            $data['professor'] = Database::query('SELECT usuario_id FROM usuario WHERE usuario_slug = :slug', array(':slug'=>$params[0]))[0];
            $data['agenda'] = Database::query('SELECT * FROM agenda WHERE professor_id = :id ORDER BY agenda_inc_data ASC', array(':id'=>$data['professor']['usuario_id']));
            Controller::test($data['agenda']);
        }
    }
?>