<?php
    class bibliotecaController extends Controller{
        public static function index(){
            $data = array();

            Controller::loadTemplate('biblioteca/index', $data);
        }
    }
?>