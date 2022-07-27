<?php

    class usuariosController extends Controller{
        public static function index(){
            $data = array();
            $data['usuarios'] = Database::query('SELECT * FROM usuario, tipo WHERE usuario.tipo_id = tipo.tipo_id ORDER BY usuario_nome ASC');

            Controller::loadTemplate('usuarios/index', $data);
        }

        public static function adicionar(){
            $data = array();
            $data['tipos'] = Database::query('SELECT * FROM tipo ORDER BY tipo_nome ASC');
            
            if(FormHelper::getIsValid() === true){
                $data = FormHelper::getValidation();
                $data['form_data']['usuario_nome'] = ucfirst($data['form_data']['usuario_nome']);
                $data['form_data']['usuario_sobrenome'] = ucfirst($data['form_data']['usuario_sobrenome']);
                unset($data['form_data']['usuario_csenha']);
                $data['form_data']['usuario_senha'] = password_hash($data['form_data']['usuario_senha'], PASSWORD_BCRYPT);
                Database::dbAction('add', $data['form_data'], 'usuario');
            
                $data['success'] = 'Usuário adicionado com sucesso';
            }elseif(FormHelper::getIsValid() === false){
                $data = FormHelper::getValidation();
            }

            Controller::loadView('usuarios/adicionar', $data);
        }

        public static function editar($params){
            $data = array();
            $data = Helpers::loadValidation($params, 'usuario', array('tipo'));
            $data['tipos'] = Database::query('SELECT * FROM tipo ORDER BY tipo_nome ASC');
            
            if(FormHelper::getIsValid() === true){
                $data = FormHelper::getValidation();
                $data['form_data']['usuario_nome'] = ucfirst($data['form_data']['usuario_nome']);
                $data['form_data']['usuario_sobrenome'] = ucfirst($data['form_data']['usuario_sobrenome']);
                unset($data['form_data']['usuario_csenha']);
                $data['form_data']['usuario_senha'] = password_hash($data['form_data']['usuario_senha'], PASSWORD_BCRYPT);
                Database::dbAction('update', $data['form_data'], 'usuario', $params[0]);
            
                $data['success'] = 'Usuário editado com sucesso';
            }elseif(FormHelper::getIsValid() === false){
                $data = FormHelper::getValidation();
            }

            Controller::loadView('usuarios/editar', $data);
        }

        public static function excluir($params){
            $data = array();
            $data = Helpers::loadValidation($params, 'usuario', array('tipo'));

            Controller::loadView('usuarios/excluir', $data);
        }

        public static function cexcluir($params){
            if(Database::query('SELECT usuario_id FROM usuario WHERE usuario_id = :id', array(':id'=>$params[0]))[0]){
                Database::query('DELETE FROM usuario WHERE usuario_id = :id', array(':id'=>$params[0]));
                header('Location: '.URL.'usuarios');
            }else{
                header('Location: '.URL.'usuarios');
            }
        }
    }

?>