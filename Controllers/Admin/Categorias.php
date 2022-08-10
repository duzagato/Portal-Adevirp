<?php
    class Categorias extends Controller{
        public static function adicionar(){
            $data = array();

            if(FormHelper::getisValid() === true){
                $data = FormHelper::getValidation();
                $data['form_data']['biblioteca_categoria_slug'] = Helpers::strToSlug($data['form_data']['biblioteca_categoria_nome']);
                $data['form_data']['biblioteca_categoria_nome'] = ucwords($data['form_data']['biblioteca_categoria_nome']);

                Database::dbAction('add', $data['form_data'], 'biblioteca_categoria');
                $data['success'] = 'Categoria adicionado com sucesso';
            }elseif(FormHelper::getIsValid() === false){
                $data = FormHelper::getValidation();
            }

            self::loadView('Admin/biblioteca/categorias/adicionar', $data);
        }

        public static function editar($params){
            $data = array();
            if(!isset($params[0]) || !Database::query('SELECT biblioteca_categoria_id FROM biblioteca_categoria WHERE biblioteca_categoria_id = :id', array(':id'=>$params[0]))){
                header('Location: '.URL.'admin/biblioteca');
            }
            $data['id'] = $params[0];
            $data['biblioteca_categoria_nome'] = Database::query('SELECT biblioteca_categoria_nome FROM biblioteca_categoria WHERE biblioteca_categoria_id = :id', array(':id'=>$params[0]))[0]['biblioteca_categoria_nome'];

            if(FormHelper::getisValid() === true){
                $data = FormHelper::getValidation();
                if(!Database::query('SELECT biblioteca_categoria_id FROM biblioteca_categoria WHERE biblioteca_categoria_nome = :nome AND biblioteca_categoria_id != :id', array(':nome'=>$data['form_data']['biblioteca_categoria_nome'], ':id'=>$params[0]))){
                    $data['form_data']['biblioteca_categoria_slug'] = Helpers::strToSlug($data['form_data']['biblioteca_categoria_nome']);
                    $data['form_data']['biblioteca_categoria_nome'] = ucwords($data['form_data']['biblioteca_categoria_nome']);

                    Database::dbAction('update', $data['form_data'], 'biblioteca_categoria', $params[0]);
                    $data['success'] = 'Categoria editada com sucesso';
                }else{
                    $data['isValid'] = false;
                    $data['failure'] = 'Essa categoria já existe, tente outro nome';
                }
            }elseif(FormHelper::getIsValid() === false){
                $data = FormHelper::getValidation();
            }

            self::loadView('Admin/biblioteca/categorias/editar', $data);
        }

        public static function excluir($params){
            $data = array();
            if(!isset($params[0]) || !Database::query('SELECT biblioteca_categoria_id FROM biblioteca_categoria WHERE biblioteca_categoria_id = :id', array(':id'=>$params[0]))){
                header('Location: '.URL.'admin/biblioteca');
            }
            $data['id'] = $params[0];
            $data['biblioteca_categoria_nome'] = Database::query('SELECT biblioteca_categoria_nome FROM biblioteca_categoria WHERE biblioteca_categoria_id = :id', array(':id'=>$params[0]))[0]['biblioteca_categoria_nome'];

            self::loadView('admin/biblioteca/categorias/excluir', $data);
        }

        public static function cexcluir($params){
            if(!isset($params[0]) || !Database::query('SELECT biblioteca_categoria_id FROM biblioteca_categoria WHERE biblioteca_categoria_id = :id', array(':id'=>$params[0]))){
                header('Location: '.URL.'admin/biblioteca');
            }else{
                Database::query('DELETE FROM livro_categoria WHERE biblioteca_categoria_id = :id', array(':id'=>$params[0]));
                Database::query('DELETE FROM biblioteca_categoria WHERE biblioteca_categoria_id = :id', array(':id'=>$params[0]));
                header('Location: '.URL.'admin/biblioteca');
            }
        }
    }
?>