<?php

public function selectUser($table)
{
  $sql = "SELECT NOMU, PRENOMU FROM " . $table . ";";
}

public function selectPlatResto($idResto)
{
  $sql = "SELECT NOMP, PRIXFOURNISSEURP, PRIXCLIENTP, PLATVISIBLE, PHOTOP, DESCRIPTIONP FROM PLAT WHERE IDR = '" . $idResto . "';";
  foreach ($cnx->query($sql) as $tablo)
  {
    printf(['NOMP']);
    printf(['PRIXFOURNISSEURP']);
    printf(['PRIXCLIENTP']);
    printf(['PLATVISIBLE']);
    printf(['PHOTOP']);
    printf(['DESCRIPTIONP']);
  }

}

public function selectFindIDResto($resto)
{
  $sql = "SELECT IDR FROM resto WHERE NOMR = ''" . $resto . "'';";
}

public function selectCommande($idUser)
{
  $sql = "SELECT IDR, DATEC, COMMENTAIRECLIENTC, DATELIVRC, MODEREGLEMENTC, AVISCLIENT, NOTECLIENT, COMVISIBLE FROM commande WHERE IDC = $idUser";

}

public function selectListeResto()
{
  $sql = "SELECT * FROM resto;";
}

public function selectEvaluationResto($idR)
{
  $sql = "SELECT IDU, NOTERAPIDITE, NOTEQUALITE, NOTETEMP, NOTECOUT, COMMENTAIRE, COMVISIBLE FROM evaluer WHERE IDR ='" . $idR . "';";

}
 ?>
