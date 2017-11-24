<?php
// Constantes


// Bases de données
define("vote", "", true);
//Définition des variables de connexion
class Param {
	public static $user = 'easyman';
	public static $pass = 'food';


	public static $dsn = 'mysql:host=127.0.0.1;dbname=bddEasyFood;charset=utf8';
	private static $sql = NULL;
	public static function getInstance() {
			if (!self::$sql) {
					self::$sql = new PDO('mysql:host=127.0.0.1;dbname=bddEasyFood;charset=utf8', 'easyman', 'food');
					self::$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			return self::$sql;
	}

}
?>
