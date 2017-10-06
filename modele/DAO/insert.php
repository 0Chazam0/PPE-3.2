<?php
require_once "modele/DAO/select.php";

public function inUser($id, $nom, $prenom, $mail, $mdp, $adresse, $table)
{
  $maxID = selectLastUser($table) + 1;
  $sql = "INSERT INTO " . $table . " VALUES ('" . $maxID . "', '" . $nom . "', '" .
          $prenom . "', '" . $mail . "', '" . $mdp . "', '" . $adresse . "');";
}

 ?>
