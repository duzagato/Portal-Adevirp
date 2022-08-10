<?php
    class Biblioteca extends Controller{
        public static function index(){
            $data = array();
            $data['livros'] = Database::query('SELECT biblioteca_livro.biblioteca_livro_id, biblioteca_livro.biblioteca_livro_titulo, biblioteca_autor.biblioteca_autor_nome FROM biblioteca_livro, biblioteca_autor WHERE biblioteca_livro.biblioteca_autor_id = biblioteca_autor.biblioteca_autor_id ORDER BY biblioteca_livro.biblioteca_livro_id DESC');
            $data['autores'] = Database::query('SELECT * FROM biblioteca_autor ORDER BY biblioteca_autor_id DESC');
            $data['categorias'] = Database::query('SELECT * FROM biblioteca_categoria ORDER BY biblioteca_categoria_nome ASC');

            Controller::loadTemplate('Admin/biblioteca/index', $data);
        }

        public static function livros($params){
            $method = $params[0];
            array_shift($params);
            Livros::{$method}($params);
        }
    }
?>