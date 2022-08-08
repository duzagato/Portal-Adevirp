<?php
    class cadastrarController extends Controller{
        public static function index(){
            if(FormHelper::getIsValid() === true){
                $data = FormHelper::getValidation();
                $data['form_data']['usuario_nome'] = ucfirst($data['form_data']['usuario_nome']);
                $data['form_data']['usuario_sobrenome'] = ucfirst($data['form_data']['usuario_sobrenome']);
                $data['form_data']['usuario_slug'] = Helpers::strToSlug($data['form_data']['usuario_nome'].' '.$data['form_data']['usuario_sobrenome']);
                unset($data['form_data']['usuario_csenha']);
                $data['form_data']['usuario_senha'] = password_hash($data['form_data']['usuario_senha'], PASSWORD_BCRYPT);
                Database::dbAction('add', $data['form_data'], 'usuario');
            
                $data['success'] = 'Usuário adicionado com sucesso';
            }elseif(FormHelper::getIsValid() === false){
                $data = FormHelper::getValidation();
            }

            echo json_encode($data);
        }
    }
?>