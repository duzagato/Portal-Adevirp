<?php

    class Projetos extends Controller{
        public static function index(){
            $data = array();
            $data['projetos'] = Database::query('SELECT projeto_id, projeto_nome, projeto_data, usuario_nome, usuario_sobrenome, usuario.usuario_id FROM projeto, usuario WHERE projeto.usuario_id = usuario.usuario_id ORDER BY projeto_nome ASC');

            Controller::loadTemplate('projetos/index', $data);
        }

        public static function adicionar(){
            $data = array();
            $data['usuarios'] = Database::query('SELECT usuario_id, usuario_nome, usuario_sobrenome FROM usuario ORDER BY usuario_nome ASC');

            if(FormHelper::getIsValid() === true){
                $data = FormHelper::getValidation();
                if(!Database::query('SELECT projeto_id FROM projeto WHERE projeto_nome = :projeto_nome', array(':projeto_nome'=>$data['form_data']['projeto_nome']))){
                    $data['form_data']['projeto_nome'] = ucfirst($data['form_data']['projeto_nome']);
                    $data['form_data']['projeto_data'] = Helpers::getNow();
                    Database::dbAction('add', $data['form_data'], 'projeto');
                    $data['success'] = 'Projeto adicionado com sucesso';
                }else{
                    $data['isValid'] = false;
                    $data['failure'] = 'O nome do projeto já está em uso';
                }
            }elseif(FormHelper::getIsValid() === false){
                $data = FormHelper::getValidation();
            }

            Controller::loadView('projetos/adicionar', $data);
        }

        public static function editar($params){
            $data = array();
            $data = Helpers::loadValidation($params, 'projeto', array('usuario'));
            $data['usuarios'] = Database::query('SELECT usuario_id, usuario_nome, usuario_sobrenome FROM usuario ORDER BY usuario_nome ASC');

            if(FormHelper::getIsValid() === true){
                $data = FormHelper::getValidation();
                if(!Database::query('SELECT projeto_id FROM projeto WHERE projeto_nome = :projeto_nome AND projeto_id != :id', array(':projeto_nome'=>$data['form_data']['projeto_nome'], ':id'=>$params[0]))){
                    $data['form_data']['projeto_nome'] = ucfirst($data['form_data']['projeto_nome']);
                    Database::dbAction('update', $data['form_data'], 'projeto', $params[0]);
                    $data['success'] = 'Projeto editado com sucesso';
                }else{
                    $data['isValid'] = false;
                    $data['failure'] = 'O nome do projeto já está em uso';
                }
            }elseif(FormHelper::getIsValid() === false){
                $data = FormHelper::getValidation();
            }
            
            Controller::loadView('projetos/editar', $data);
        }

        public static function excluir($params){
            $data = array();
            $data = Helpers::loadValidation($params, 'projeto');

            Controller::loadView('projetos/excluir', $data);
        }

        public static function cexcluir($params){
            if(Database::query('SELECT projeto_id FROM projeto WHERE projeto_id = :id', array(':id'=>$params[0]))[0]){
                Database::query('DELETE FROM projeto WHERE projeto_id = :id', array(':id'=>$params[0]));
                header('Location: '.URL.'projetos');
            }else{
                header('Location: '.URL.'projetos');
            }
        }
    }

?>