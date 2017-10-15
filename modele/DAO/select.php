<?php
class RestoDAO
{
  public static function selectPlatResto($idResto)
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

  public static function selectListeResto()
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

  public static function selectEvaluationResto($idR)
  {
    $sql = "SELECT IDU, NOTERAPIDITE, NOTEQUALITE, NOTETEMP, NOTECOUT, COMMENTAIRE, COMVISIBLE FROM evaluer WHERE IDR ='" . $idR . "';";

  }
}


class VilleDAO
{
public static function selectListeVille()
{
	$result = array();
	$sql = "SELECT * FROM ville;";
	$liste = DBConnex::getInstance()->queryFetchAll($sql);
	if (count($liste) > 0)
	{
		foreach ($liste as $ville)
		{
			$uneVille = new Ville($ville['CODEV'], $ville['NOMV']);
			$result[] = $uneVille;
		}
	}
	return $result;
}
}

class PlatDAO
{
public static function selectListePlat()
{
	$result = array();
	$sql = "SELECT * FROM Plat;";
	$liste = DBConnex::getInstance()->queryFetchAll($sql);
	if (count($liste) > 0)
	{
		foreach ($liste as $Plat)
		{
			$unePlat = new Plat($Plat['IDP'], $Plat['IDR'], $Plat['CODET'], $Plat['NOMP'], $Plat['PRIXFOURNISSEURP'], $Plat['PRIXCLIENTP'], $Plat['PLATVISIBLE'], $Plat['PHOTOP'], $Plat['DESCRIPTIONP']);
			$result[] = $unePlat;
		}
	}
	return $result;
}
}


class TypePlatDAO
{
public static function selectListeTypePlat()
{
	$result = array();
	$sql = "SELECT * FROM Type_Plat;";
	$liste = DBConnex::getInstance()->queryFetchAll($sql);
	if (count($liste) > 0)
	{
		foreach ($liste as $TypePlat)
		{
			$uneTypePlat = new TypePlat($TypePlat['CODET'], $TypePlat['LIBELLE']);
			$result[] = $uneTypePlat;
		}
	}
	return $result;
}
}

class CommandeDAO
{
  public static function selectCommande($idUser)
  {
    $sql = "SELECT IDR, DATEC, COMMENTAIRECLIENTC, DATELIVRC, MODEREGLEMENTC, AVISCLIENT, NOTECLIENT, COMVISIBLE FROM commande WHERE IDC = $idUser";

  }
}

 ?>
