<?php
/*----------------------------------------------------------*/
/*--------Class DAO pour la connexion MySql----------*/
/*----------------------------------------------------------*/
class DBConnex extends PDO{

	private static $instance;


	public static function getInstance(){
		if ( !self::$instance ){
			self::$instance = new DBConnex();
		}
		return self::$instance;
	}

	function __construct(){
		try {
			parent::__construct(Param::$dsn ,Param::$user, Param::$pass);
		} catch (Exception $e) {
			echo $e->getMessage();
			die("Impossible de se connecter. " );
		}
	}

  public function queryFetchAll($sql){
		$sth  = $this -> query($sql);

		if ( $sth ){
			return $sth -> fetchAll(PDO::FETCH_ASSOC);
		}

		return false;
	}

	public function queryFetchFirstRow($sql){
		$sth    = $this -> query($sql);
		$result    = array();

		if ( $sth ){
			$result  = $sth -> fetch();
		}

		return $result;
	}
}

/*----------------------------------------------------------*/
/*--------Class DAO pour la connexion sur le site(utilisateur)----------*/
/*----------------------------------------------------------*/

class UserDAO{
	public static function unUserC($unIdUser){
		$sql = "select DISTINCT * from client where MAIL = '".$unIdUser."'";
		$user = DBConnex::getInstance()->queryFetchFirstRow($sql);
		return $user;
	}
  public static function unUserA($unIdUser){
    $sql = "select DISTINCT * from administrateur where MAIL = '".$unIdUser."'";
    $user = DBConnex::getInstance()->queryFetchFirstRow($sql);
    return $user;
  }
  public static function unUserM($unIdUser){
    $sql = "select DISTINCT * from moderateur where MAIL = '".$unIdUser."'";
    $user = DBConnex::getInstance()->queryFetchFirstRow($sql);
    return $user;
  }
  public static function unUserR($unIdUser){
    $sql = "select DISTINCT * from restaurateur where MAIL = '".$unIdUser."'";
    $user = DBConnex::getInstance()->queryFetchFirstRow($sql);
    return $user;
  }
	public static function definirIDU(){
		$sql = "select count(IDU) from client";
		$resu = DBConnex::getInstance()->queryFetchFirstRow($sql);
		return $resu;
	}
	public static function ajouterUnClient($unClient){
		$sql="Insert into user(IDU,NOMU,PRENOMU,MAIL,MDP,ADRESSEU) VALUES ('";
		$sql .= $unClient->getId() . "',NULL,NULL,NULL,NULL,NULL)";
		DBConnex::getInstance()->queryFetchFirstRow($sql);
		$sql = "Insert into client (IDU,NOMU,PRENOMU,MAIL,MDP,ADRESSEU) VALUES ('";
		$sql .= $unClient->getId() . "','";
		$sql.= $unClient->getNom() . "','";
		$sql.= $unClient->getPrenom() . "','";
		$sql.= $unClient->getMail() . "','";
		$sql.= $unClient->getMdp() . "','";
		$sql.= $unClient->getAdresse() . "')";
		DBConnex::getInstance()->queryFetchFirstRow($sql);
	}
	public function delUser($table, $IDU)
	{
	  $sql = "DELETE FROM " . $table . " WHERE IDU = '" . $IDU . "';";

	}
}

/*----------------------------------------------------------*/
/*--------Class DAO pour les Restos----------*/
/*----------------------------------------------------------*/
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
        $unResto = new Resto($resto['IDR'], $resto['CODEV'], $resto['CODET'], $resto['NOMR'], $resto['NUMADR'], $resto['RUEADR'], $resto['CPR']);
        $result[] = $unResto;
      }
    }
    return $result;
  }

  public static function selectEvaluationResto($idR)
  {
    $sql = "SELECT IDU, NOTERAPIDITE, NOTEQUALITE, NOTETEMP, NOTECOUT, COMMENTAIRE, COMVISIBLE FROM evaluer WHERE IDR ='" . $idR . "';";

  }
	public function delResto($IDR)
	{
	  $sql = "DELETE FROM resto WHERE IDR = '" . $IDR . "';";

	}
	public static function selectListeRestoRestaurateur($idU)
	{
		$result = array();
		$sql = "SELECT IDR FROM gerer WHERE IDU = '" . $idU . "' ;";
		$liste = DBConnex::getInstance()->queryFetchAll($sql);
		if (count($liste) > 0)
		{
			foreach ($liste as $resto)
			{
				$result[] = $resto;
			}
		}
		return $result;
	}

}


/*----------------------------------------------------------*/
/*--------Class DAO pour les Villes----------*/
/*---------------------------------------------------------*/

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


/*----------------------------------------------------------*/
/*--------Class DAO pour les Plats----------*/
/*----------------------------------------------------------*/

class PlatDAO
{
	public static function platsDuneCommande($unIdCOmmande){
		$sql="select Q.IDP, P.NOMP, Q.QUANTITE, P.PHOTOP,P.PRIXCLIENTP, P.DESCRIPTIONP from quantite as Q, plat as P where Q.IDP=P.IDP and Q.IDC = '";
		$sql.= $unIdCOmmande;
		$sql.= "'";
		$lesplats = DBConnex::getInstance()->queryFetchAll($sql);
		return $lesplats;
	}


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

public static function chercherPlat($idPlat)
{
  $sql = "SELECT * FROM PLAT WHERE IDP = '" . $idPlat . "';";
  $plat = DBConnex::getInstance()->queryFetchFirstRow($sql);
  return $plat;
}

public static function ajouterPlat($unPlat){
	$sql="INSERT INTO PLAT(IDP,IDR,CODET,NOMP,PRIXFOURNISSEURP,PRIXCLIENTP,PLATVISIBLE,PHOTOP,DESCRIPTIONP) VALUES ('";
	$sql .= $unPlat->getID() . "','";
	$sql.= $unPlat->getIDResto() . "','";
	$sql.= $unPlat->getTypePlat() . "','";
	$sql.= $unPlat->getNom() . "','";
	$sql.= $unPlat->getPrixFournisseur() . "','";
	$sql.= $unPlat->getPrixClient() . "','";
	$sql.= $unPlat->getPlatVisible() . "','";
	$sql.= $unPlat->getCheminPhoto() . "','";
	$sql.= $unPlat->getDescription() . "')";
	DBConnex::getInstance()->queryFetchFirstRow($sql);
}

public static function updatePlat($unPlat)
{
  $sql = "UPDATE plat SET 	IDR = '" . $unPlat->getIDResto() . "',";
	$sql .= "CODET = '" . $unPlat->getTypePlat() . "',";
	$sql .= "NOMP = '" . $unPlat->getNom() . "',";
	$sql .= "PRIXFOURNISSEURP = '" . $unPlat->getPrixFournisseur() . "',";
	$sql .= "PRIXCLIENTP = '" . $unPlat->getPrixClient() . "',";
	$sql .= "PLATVISIBLE = '" . $unPlat->getPlatVisible() . "',";
	$sql .= "PHOTOP = '" . $unPlat->getCheminPhoto() . "',";
	$sql .= "DESCRIPTIONP = '" . $unPlat->getDescription() . "'";
	$sql .= "WHERE IDP = '" . $unPlat->getID() . "';";
	return DBConnex::getInstance()->exec($sql);
}

public static function delPlat($IDR, $IDP)
{
  $sql = "DELETE FROM plat WHERE IDP = '" . $IDP . "' AND IDR = '" . $IDR . "';";
	return DBConnex::getInstance()->exec($sql);
}
}


/*----------------------------------------------------------*/
/*--------Class DAO pour les type de Restos----------*/
/*----------------------------------------------------------*/

class TypeRestoDAO
{
public static function selectListeTypeResto()
{
	$result = array();
	$sql = "SELECT * FROM Type_resto;";
	$liste = DBConnex::getInstance()->queryFetchAll($sql);
	if (count($liste) > 0)
	{
		foreach ($liste as $TypeResto)
		{
			$uneTypeResto = new TypeResto($TypeResto['CODET'], $TypeResto['LIBELLE']);
			$result[] = $uneTypeResto;
		}
	}
	return $result;
}
public function delTypePlat($code)
{
  $sql = "DELETE FROM type_plat WHERE CODET = '" . $code . "';";

}
}



/*----------------------------------------------------------*/
/*--------Class DAO pour les types de plats----------*/
/*----------------------------------------------------------*/

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

public static function ajouterTypePlat($unTypePlat){
	$sql="INSERT INTO TYPE_PLAT VALUES ('";
	$sql .= $unTypePlat->getCodeT() . "','";
	$sql.= $unTypePlat->getLibelle() . "')";
	DBConnex::getInstance()->queryFetchFirstRow($sql);
}
}



/*----------------------------------------------------------*/
/*--------Class DAO pour la commande----------*/
/*----------------------------------------------------------*/


class CommandeDAO
{

	public static function commandesDunUser($unIdClient){
		$sql="select C.IDC, C.IDR, C.IDU, C.DATEC FROM commande as C WHERE C.IDU = '";
		$sql.= $unIdClient;
		$sql.= "'";
		$comm = DBConnex::getInstance()->queryFetchAll($sql);
		return $comm;
	}

  public static function selectListeCommande()
  {
    $sql = "SELECT * FROM commande ";
		$liste = DBConnex::getInstance()->queryFetchAll($sql);
		if (count($liste) > 0)
		{
			foreach ($liste as $com)
			{
				$uneCommande = new Commande($com['IDC'], $com['IDR'], $com['IDU'], $com['DATEC'], $com['COMMENTAIRECLIENTC'], $com['DATELIVRC'], $com['MODEREGLEMENTC'], $com['AVISCLIENT'], $com['NOTECLIENT'], $com['COMVISIBLE']);
				$result[] = $uneCommande;
			}
		}
		return $result;
  }
	public static function inCommande($idCom, $idResto, $idCli,$dateCom,$dateLiv, $modeRegl){
		$sql = "INSERT INTO commande VALUES ('" . $idCom . "',
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


	public static function inQte($idPlat,$idCom, $qte){
		$sql = "INSERT INTO quantite VALUES ('" . $idPlat . "',
																				 '" . $idCom . "',
																				 '" . $qte . "'
																				 )";
	return DBConnex::getInstance()->exec($sql);
	}


	public function delCommande($IDC)
	{
	  $sql = "DELETE FROM commande WHERE IDC = '" . $IDC . "';";

	}
}



/*----------------------------------------------------------*/
/*--------Class DAO pour les commentaires (EVALUER en bdd)----------*/
/*----------------------------------------------------------*/

class CommentaireDAO
{

  public static function selectCommentaire()
  {
    $sql = "SELECT C.MAIL, R.NOMR, `NOTERAPIDITE`, `NOTEQUALITE`, `NOTETEMP`, `NOTECOUT`, `COMMENTAIRE` FROM `evaluer` AS E, `client` AS C, `resto` AS R WHERE R.IDR = E.IDR AND C.IDU = E.IDU";
    $liste = DBConnex::getInstance()->queryFetchAll($sql);
    if (count($liste) > 0)
    {
      foreach ($liste as $note)
      {
        $uneNote = new Evaluer($note['MAIL'], $note['NOMR'], $note['NOTERAPIDITE'],
                              $note['NOTEQUALITE'], $note['NOTETEMP'],
                              $note['NOTECOUT'], $note['COMMENTAIRE']);
        $result[] = $uneNote;
      }
    }
    return $result;
  }

}


/*----------------------------------------------------------*/
/*--------Class DAO pour les notes Resto et site (evaluer et resto en dbb)----------*/
/*----------------------------------------------------------*/
class NoteDAO
{

  public static function selectResto($IDClient)
  {
    $sql = "SELECT NOMR FROM evaluer As E, resto As R WHERE E.IDR = R.IDR
            AND IDU = '" . $IDClient . "' AND COMVISIBLE = 0 LIMIT 1";
    $liste = DBConnex::getInstance()->queryFetchAll($sql);
    if (count($liste) > 0)
    {
      foreach ($liste as $note)
      {
        $result = $note['NOMR'];
      }
    }
		else {
			$result = 0;
		}
    return $result;
  }

  public static function selectIDCommand($IDClient, $selectResto)
  {
    $sql = 'SELECT IDC FROM evaluer As E, resto As R WHERE E.IDR = R.IDR
            AND IDU = "' . $IDClient . '" AND R.NOMR = "' . $selectResto . '" LIMIT 1';
    $liste = DBConnex::getInstance()->queryFetchAll($sql);
    if (count($liste) > 0)
    {
      foreach ($liste as $note)
      {
        $result = $note['IDC'];
      }
    }
    return $result;
  }

	public static function updateNote($ntR, $ntQ, $ntT, $ntC, $command, $commentaire)
	{
		$sql = 'UPDATE evaluer SET NOTERAPIDITE = ' . $ntR . ', NOTEQUALITE = ' . $ntQ .
					', NOTETEMP = ' . $ntT . ', NOTECOUT = ' . $ntC . ',    COMMENTAIRE = "' . $commentaire .
					'", COMVISIBLE = 2 WHERE IDC = "' . $command . '"';
	return DBConnex::getInstance()->exec($sql);
	}

	public static function selectModeNote(){
		$sql = "SELECT R.NOMR, IDC, NOTERAPIDITE, NOTEQUALITE, NOTETEMP, NOTECOUT, COMMENTAIRE
						FROM evaluer, resto AS R WHERE evaluer.IDR = R.IDR AND COMVISIBLE = 1 LIMIT 1";
    $liste = DBConnex::getInstance()->queryFetchAll($sql);
    return ($liste);
  }

	public static function	updateModeSee($command, $afficher)
	{
		$sql = 'UPDATE evaluer SET COMVISIBLE = ' . $afficher . ' WHERE IDC = "' . $command . '"';

		return DBConnex::getInstance()->exec($sql);
	}
}
 ?>
