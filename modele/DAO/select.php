<?php





class RestoDAO
{
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

  public function selectListeResto()
  {
    $result = array();
    $sql = "SELECT * FROM resto;";
    $liste = DBConnex::getInstance()->queryFetchAll($sql);
    if (count($liste) > 0)
    {
      foreach ($liste as $resto)
      {
        $unResto = new Resto($resto['IDR'], $resto['CODEV'], $resto['NOMR'], $resto['NUMADR'], $resto['RUEADR'], $resto['CPR']);
        $result[] = $unResto;
      }
    }
    return $result;
  }

  public function selectEvaluationResto($idR)
  {
    $sql = "SELECT IDU, NOTERAPIDITE, NOTEQUALITE, NOTETEMP, NOTECOUT, COMMENTAIRE, COMVISIBLE FROM evaluer WHERE IDR ='" . $idR . "';";

  }
}

class CommandeDAO
{
  public function selectCommande($idUser)
  {
    $sql = "SELECT IDR, DATEC, COMMENTAIRECLIENTC, DATELIVRC, MODEREGLEMENTC, AVISCLIENT, NOTECLIENT, COMVISIBLE FROM commande WHERE IDC = $idUser";

  }
}

 ?>
