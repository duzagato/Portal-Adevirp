<?php

	class homeController extends Controller{
		public static function index(){
			$data = array();
			
			self::loadTemplate('home', $data);
		}

	}

?>
