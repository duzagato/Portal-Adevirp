<?php

    class agendaController extends Controller{
        public static function index(){
            $data = array();
            $data['professor'] = self::getUsuario();
            $data['agenda'] = Database::query('SELECT usuario_nome, usuario_sobrenome, agenda_id, agenda_titulo, agenda_dia, agenda_aula FROM agenda, usuario WHERE agenda.educando_id = usuario.usuario_id AND agenda.professor_id = :professor_id', array(':professor_id'=>$_SESSION['ADEVIRP_ID']));

            Controller::loadTemplate('agenda/open', $data);
        }

        public static function abrir($params){
            $data = array();
            $data['professor'] = Database::query('SELECT * FROM usuario WHERE usuario_slug = :slug', array(':slug'=>$params[0]))[0];
            $data['agenda'] = Database::query('SELECT usuario_nome, usuario_sobrenome, agenda_id, agenda_titulo, agenda_dia, agenda_aula FROM agenda, usuario WHERE agenda.educando_id = usuario.usuario_id AND agenda.professor_id = :professor_id', array(':professor_id'=>$data['professor']['usuario_id']));

            Controller::loadTemplate('agenda/open', $data);
        }

        public static function adicionar($params){
            $data = array();
            $data['slug'] = $params[0];
            $data['dia'] = Helpers::getDaysBySlug()[$params[1]];
            $data['aula'] = $params[2];
            $data['educandos'] = Database::getAllEducandos();

            if(FormHelper::getIsValid() === true){
                $data = FormHelper::getValidation();
                if(!Database::query('SELECT agenda_id FROM agenda WHERE agenda_dia = :dia AND agenda_aula = :aula AND educando_id = :educando_id', array(':dia'=>$params[1], ':aula'=>$params[2], ':educando_id'=>$data['form_data']['educando_id']))){
                    $professor_id = array('professor_id'=>Database::query('SELECT usuario_id FROM usuario WHERE usuario_slug = :slug', array(':slug'=>$params[0]))[0]['usuario_id']);
                    $data['form_data']['agenda_titulo'] = ucfirst($data['form_data']['agenda_titulo']);
                    $data['form_data']['agenda_dia'] = $params[1];
                    $data['form_data']['agenda_aula'] = $params[2];
                    $data['form_data']['agenda_inc_data'] = time();
                    $data['form_data'] = $professor_id + $data['form_data'];
                    Database::dbAction('add', $data['form_data'], 'agenda');
                    
                    $data['success'] = 'Compromisso adicionado com sucesso';
                }else{
                    $data['isValid'] = false;
                    $data['failure'] = 'O educando já possui compromisso nesse dia e horário';
                }
            }elseif(FormHelper::getIsValid() === false){
                $data = FormHelper::getValidation();
            }

            Controller::loadView('agenda/adicionar', $data);
        }

        public static function excluir($params){
            $data = array();
            if(Database::query('SELECT agenda_id FROM agenda WHERE agenda_id = :id', array(':id'=>$params[0]))[0]){
                $data['agenda'] = Database::query('SELECT * FROM agenda WHERE agenda_id = :id', array(':id'=>$params[0]))[0];
            }else{
                header('Location: '.URL.'agenda');
            }
            $data['agenda_id'] = $params[0];
            $data['professor'] = Database::query('SELECT usuario_slug FROM usuario WHERE usuario_id = :id', array(':id'=>$data['agenda']['professor_id']))[0]['usuario_slug'];

            Controller::loadView('agenda/excluir', $data);
        }

        public static function cexcluir($params){
            if(Database::query('SELECT agenda_id FROM agenda WHERE agenda_id = :id', array(':id'=>$params[0]))[0]){
                Database::query('DELETE FROM agenda WHERE agenda_id = :id', array(':id'=>$params[0]));
                $slug = Database::query('SELECT usuario_slug FROM usuario WHERE usuario_id = :id', array(':id'=>$params[0]))[0]['usuario_slug'];
                header('Location: '.URL.'agenda'.$slug);
            }else{
                header('Location: '.URL.'agenda');
            }
        }
    }

?>