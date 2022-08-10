<?php
    class Livros extends Controller{
        public static function adicionar(){
            $data = array();
            $data['categorias'] = Database::query('SELECT biblioteca_categoria_nome, biblioteca_categoria_id FROM biblioteca_categoria ORDER BY biblioteca_categoria_nome ASC');

            if(FormHelper::getIsValid() === true){
                $data = FormHelper::getValidation();
                if(isset($data['form_data']['biblioteca_categoria_id'])){
                    $biblioteca_categoria_id = $data['form_data']['biblioteca_categoria_id'];
                    unset($data['form_data']['biblioteca_categoria_id']);
                }else{
                    $data['isValid'] = false;
                    $data['failure'] = 'Escolha pelo menos uma categoria para o livro';
                }
                $autor = $data['form_data']['biblioteca_autor_nome'];
                unset($data['form_data']['biblioteca_autor_nome']);
                if(!Database::query('SELECT biblioteca_autor_id FROM biblioteca_autor WHERE biblioteca_autor_nome = :nome', array(':nome'=>$autor))){
                    Database::query('INSERT INTO biblioteca_autor VALUES (\'\', :nome, :slug)', array(':nome'=>$autor, ':slug'=>Helpers::strToSlug($autor)));
                }
                $data['form_data']['biblioteca_autor_id'] = Database::query('SELECT biblioteca_autor_id FROM biblioteca_autor WHERE biblioteca_autor_nome = :nome', array(':nome'=>$autor))[0]['biblioteca_autor_id'];
                $data['form_data']['biblioteca_livro_slug'] = Helpers::strToSlug($data['form_data']['biblioteca_livro_titulo']);
                $data['form_data']['biblioteca_livro_arquivo']['name'] = Helpers::setFileName($data['form_data']['biblioteca_livro_arquivo']['name'], $data['form_data']['biblioteca_livro_slug']);
                $data['form_data']['biblioteca_livro_capa']['name'] = Helpers::setFileName($data['form_data']['biblioteca_livro_capa']['name'], $data['form_data']['biblioteca_livro_slug']);
                Helpers::uploadFile($data['form_data']['biblioteca_livro_arquivo'], PATH_LIVROS_AUDIOS);
                Helpers::uploadFile($data['form_data']['biblioteca_livro_capa'], PATH_LIVROS_CAPAS);
                $data['form_data']['biblioteca_livro_arquivo'] = $data['form_data']['biblioteca_livro_arquivo']['name'];
                $data['form_data']['biblioteca_livro_capa'] = $data['form_data']['biblioteca_livro_capa']['name'];
                Database::dbAction('add', $data['form_data'], 'biblioteca_livro');
                $livro_id = Database::query('SELECT biblioteca_livro_id FROM biblioteca_livro WHERE biblioteca_livro_slug = :slug LIMIT 1', array(':slug'=>$data['form_data']['biblioteca_livro_slug']))[0]['biblioteca_livro_id'];
                foreach($biblioteca_categoria_id as $c){
                    Database::query('INSERT INTO livro_categoria VALUES (\'\', :livro, :categoria)', array(':livro'=>$livro_id, ':categoria'=>$c));
                }

                $data['success'] = 'Livro adicionado com sucesso';
            }elseif(FormHelper::getIsValid() === false){
                $data = FormHelper::getValidation();
            }

            Controller::loadView('admin/biblioteca/livros/adicionar', $data);
        }

        public static function editar($params){
            $data = array();
            if(!isset($params[0]) || !Database::query('SELECT * FROM biblioteca_livro, biblioteca_autor WHERE biblioteca_livro.biblioteca_autor_id = biblioteca_autor.biblioteca_autor_id AND biblioteca_livro.biblioteca_livro_id = :id', array(':id'=>$params[0]))){
                header('Location: '.URL.'admin/biblioteca');
            }
            $data['livro'] = Database::query('SELECT * FROM biblioteca_livro, biblioteca_autor WHERE biblioteca_livro.biblioteca_autor_id = biblioteca_autor.biblioteca_autor_id AND biblioteca_livro.biblioteca_livro_id = :id', array(':id'=>$params[0]))[0];
            $data['categorias'] = Database::query('SELECT biblioteca_categoria_nome, biblioteca_categoria_id FROM biblioteca_categoria ORDER BY biblioteca_categoria_nome ASC');

            if(FormHelper::getIsValid() === true){
                $data = FormHelper::getValidation();
                if(isset($data['form_data']['biblioteca_categoria_id'])){
                    $biblioteca_categoria_id = $data['form_data']['biblioteca_categoria_id'];
                    unset($data['form_data']['biblioteca_categoria_id']);
                    $autor = $data['form_data']['biblioteca_autor_nome'];
                    unset($data['form_data']['biblioteca_autor_nome']);
                    if(!Database::query('SELECT biblioteca_autor_id FROM biblioteca_autor WHERE biblioteca_autor_nome = :nome', array(':nome'=>$autor))){
                        Database::query('INSERT INTO biblioteca_autor VALUES (\'\', :nome, :slug)', array(':nome'=>$autor, ':slug'=>Helpers::strToSlug($autor)));
                    }
                    $data['form_data']['biblioteca_autor_id'] = Database::query('SELECT biblioteca_autor_id FROM biblioteca_autor WHERE biblioteca_autor_nome = :nome', array(':nome'=>$autor))[0]['biblioteca_autor_id'];
                    $data['form_data']['biblioteca_livro_slug'] = Helpers::strToSlug($data['form_data']['biblioteca_livro_titulo']);
                    if($data['form_data']['biblioteca_livro_arquivo']['name'] === ''){
                        unset($data['form_data']['biblioteca_livro_arquivo']);
                    }else{
                        $data['form_data']['biblioteca_livro_arquivo']['name'] = Helpers::setFileName($data['form_data']['biblioteca_livro_arquivo']['name'], $data['form_data']['biblioteca_livro_slug']);
                        Helpers::uploadFile($data['form_data']['biblioteca_livro_arquivo'], PATH_LIVROS_AUDIOS);
                        $data['form_data']['biblioteca_livro_arquivo'] = $data['form_data']['biblioteca_livro_arquivo']['name'];
                    }

                    if($data['form_data']['biblioteca_livro_capa']['name'] === ''){
                        unset($data['form_data']['biblioteca_livro_capa']);
                    }else{
                        $data['form_data']['biblioteca_livro_capa']['name'] = Helpers::setFileName($data['form_data']['biblioteca_livro_capa']['name'], $data['form_data']['biblioteca_livro_slug']);
                        Helpers::uploadFile($data['form_data']['biblioteca_livro_capa'], PATH_LIVROS_CAPAS);
                        $data['form_data']['biblioteca_livro_capa'] = $data['form_data']['biblioteca_livro_capa']['name'];
                    }
                    
                    $livro_categoria = Database::query('SELECT biblioteca_categoria_id FROM livro_categoria WHERE biblioteca_livro_id = :id', array(':id'=>$params[0]))[0];
                    if($livro_categoria !== array()){
                        Database::query('DELETE FROM livro_categoria WHERE biblioteca_livro_id = :id', array(':id'=>$params[0]));
                    }
                    foreach($biblioteca_categoria_id as $c){
                        Database::query('INSERT INTO livro_categoria VALUES (\'\', :livro, :categoria)', array(':livro'=>$params[0], ':categoria'=>$c));
                    }
                    Database::dbAction('update', $data['form_data'], 'biblioteca_livro', $params[0]);

                    $data['success'] = 'Livro editado com sucesso';
                }else{
                    $data['isValid'] = false;
                    $data['failure'] = 'Escolha pelo menos uma categoria para o livro';
                }
            }elseif(FormHelper::getIsValid() === false){
                $data = FormHelper::getValidation();
            }

            Controller::loadView('admin/biblioteca/livros/editar', $data);
        }

        public static function excluir($params){
            $data = array();
            if(!isset($params[0]) || !Database::query('SELECT * FROM biblioteca_livro, biblioteca_autor WHERE biblioteca_livro.biblioteca_autor_id = biblioteca_autor.biblioteca_autor_id AND biblioteca_livro.biblioteca_livro_id = :id', array(':id'=>$params[0]))){
                header('Location: '.URL.'admin/biblioteca');
            }
            $data['livro'] = Database::query('SELECT * FROM biblioteca_livro, biblioteca_autor WHERE biblioteca_livro.biblioteca_autor_id = biblioteca_autor.biblioteca_autor_id AND biblioteca_livro.biblioteca_livro_id = :id', array(':id'=>$params[0]))[0];

            self::loadView('admin/biblioteca/livros/excluir', $data);
        }

        public static function cexcluir($params){
            if(!isset($params[0]) || !Database::query('SELECT * FROM biblioteca_livro, biblioteca_autor WHERE biblioteca_livro.biblioteca_autor_id = biblioteca_autor.biblioteca_autor_id AND biblioteca_livro.biblioteca_livro_id = :id', array(':id'=>$params[0]))){
                header('Location: '.URL.'admin/biblioteca');
            }else{
                Database::query('DELETE FROM biblioteca_livro WHERE biblioteca_livro_id = :id', array(':id'=>$params[0]));
                header('Location: '.URL.'admin/biblioteca');
            }
        }
    }
?>