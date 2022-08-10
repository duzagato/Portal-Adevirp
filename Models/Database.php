<?php

	class Database{
		protected static $pdo;

		public static function connect(){
			global $db;

			self::$pdo = new PDO('mysql:host='.$db['host'].'; dbname='.$db['dbname'].'; charset=utf8', $db['user'], $db['pass']);
      		self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return self::$pdo;
		}

		public static function getAllFromTable($table){
			return self::query('SELECT * FROM '.$table, array());
		}

		public static function getTableCount($table){
			return self::query('SELECT COUNT('.$table.'_id) FROM '.$table, array())[0][0];
		}

		public static function query($sql, $params = array()){
			$st = self::$pdo->prepare($sql);
			$st->execute($params);
	
			if (explode(' ', $sql)[0] == 'SELECT') {
			  $data = $st->fetchAll();
			  return $data;
			}
		}

		public static function getAllEducandos(){
			return Database::query('SELECT usuario_id, usuario_nome, usuario_sobrenome FROM usuario WHERE tipo_id = :tipo_id ORDER BY usuario_nome ASC', array(':tipo_id'=>5));
		}

		public static function add($table, $data){
			extract($data);
			$columns = implode(', ', array_keys($values));
			$sql = "INSERT INTO $table VALUES('', $columns)";
			Database::query($sql, $values);
		}

		public static function update($table, $data){
			extract($data);
			for($i = 0; $i < count($columns); $i++){
				$columns[$i] = $columns[$i].' = :'.$columns[$i];
			}
			$columns = implode(', ', $columns);
			$id_column = $table.'_id';
			$sql = "UPDATE $table SET $columns WHERE $id_column = $id";
			Database::query($sql, $values);
		}

		public static function formatToDb($data){
			foreach($data as $key => $value){
				$data['values'][':'.$key] = $value;
				$data['columns'][] = $key;
			}

			return $data;
		}

		public static function dbAction($action, $data, $table, $id = null){
			$data = Database::formatToDb($data);
			$data['id'] = $id;
            Database::{$action}($table, $data);
		}

		public static function valueExists($table, $column, $value){
			if(Database::query('SELECT '.$table.'_id FROM '.$table.' WHERE '.$column.' = :'.$column, array(':'.$column=>$value))){
				return true;
			}else{
				return false;
			}
		}
	}

?>
