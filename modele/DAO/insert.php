<?php
require_once "modele/DAO/select.php";

/*public function inUser($id, $nom, $prenom, $mail, $mdp, $adresse, $table)
{
  $maxID = selectLastUser($table) + 1;
  $sql = "INSERT INTO " . $table . " VALUES ('" . $maxID . "', '" . $nom . "', '" .
          $prenom . "', '" . $mail . "', '" . $mdp . "', '" . $adresse . "');";
}*/

function inCommande($idCom, $idResto, $idCli,$dateCom,$dateLiv, $modeRegl){
  $sql = "INSERT INTO commande VALUES ('C" . $idCom . "',
                                       '" . $idResto . "',
                                       '" . $idCli . "',
                                       '" . $dateCom . "',
                                       '0',
                                       '" . $dateLiv . "',
                                       '" . $modeRegl . "',
                                       '0',
                                       '0',
                                       '1')";
return DBConnex::getInstance()->exec($sql);
}
 ?>
