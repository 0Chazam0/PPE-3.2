<?php
/*************************/
/***** Connexion PDO *****/
/*************************/

// Constantes
define("127.0.0.1","", true);
define("root","", true);
define("","", true);

// Bases de données
define("vote", "", true);

// Define class
class DB
{
     private static $sql = NULL;
     public static $dsn = '';
     public static function getInstance() {
         if (!self::$sql) {
             self::$sql = new PDO('mysql:host=127.0.0.1;dbname=vote;charset=utf8', 'root', '');
             self::$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         return self::$sql;
     }

     // interdiction de cloner l'instance
     private function __clone() {
     }
}

?>
