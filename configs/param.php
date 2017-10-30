<?php
// Constantes


// Bases de données
define("vote", "", true);
//Définition des variables de connexion
class Param {
	public static $user = 'root';
	public static $pass = '';
<<<<<<< HEAD
	public static $dsn = 'mysql:host=127.0.0.1;dbname=easyfoodbdd;charset=utf8';
=======
	public static $dsn = 'mysql:host=127.0.0.1;dbname=darosr_esayfoodbdd;charset=utf8';


	private static $sql = NULL;
	public static function getInstance() {
			if (!self::$sql) {
					self::$sql = new PDO('mysql:host=127.0.0.1;dbname=darosr_esayfoodbdd;charset=utf8', 'root', '');
					self::$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			return self::$sql;
	}
>>>>>>> 3207223e7225aa2637e29b6f83388b52766d13b2
}
?>
