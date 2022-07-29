<?php
	session_start();
	require_once 'vendor/autoload.php';
	require 'config.php';

	spl_autoload_register(function ($class){
    	if(file_exists('Controllers/'.$class.'.php')){
			require_once 'Controllers/'.$class.'.php';
		}elseif(file_exists('Models/'.$class.'.php')){
			require_once 'Models/'.$class.'.php';
		}elseif(file_exists('Routes/'.$class.'.php')){
			require_once 'Routes/'.$class.'.php';
		}elseif(file_exists('Helpers/'.$class.'.php')){
			require_once 'Helpers/'.$class.'.php';
		}
	});
	
	Routes::start();
?>
