<?php
/**
 * Plats
 */
class Plats
{
  private   $lesPlats;

  function __construct($plesPlats)
  {
    $this->lesPlats = $plesPlats;
  }

  public  function getLesPlats()
  {
    return $this->lesPlats;
  }

  public  function setLesPlats($value)
  {
    $this->lesPlats = $value;
  }

  public  function chercher($TheId)
  {
    foreach ($this->lesPlats as $Plat)
    {
      if ($Plat->getid() == $TheId)
      {
        return $Plat;
      }
    }
    return null;
  }

}

/**
 * Plat
 */
class Plat
{
  private   $id;
  private   $idResto;
  private   $typePlat;
  private   $nom;
  private   $prixFournisseur;
  private   $prixClient;
  private   $platVisible;
  private   $cheminPhoto;
  private   $description;

  public  function  __construct($pid, $pidResto, $ptypePlat, $pnom, $pprixFournisseur,
                      $pprixClient, $pplatVisible, $pcheminPhoto, $pdescription)
  {
    $this->id = $pid;
    $this->idResto = $pidResto;
    $this->typePlat = $ptypePlat;
    $this->nom = $pnom;
    $this->prixFournisseur = $pprixFournisseur;
    $this->prixClient = $pprixClient;
    $this->platVisible = $pplatVisible;
    $this->cheminPhoto = $pcheminPhoto;
    $this->description = $pdescription;
  }

  public function getID()
  {
    return $this->id;
  }
  public  function setID($value)
  {
    $this->id = $value;
  }


  public  function getIDResto()
  {
    return $this->idResto;
  }
  public  function setIDResto($value)
  {
    $this->idResto = $value;
  }


  public  function getTypePlat()
  {
    return $this->typePlat;
  }
  public static function setTypePlat($value)
  {
    $this->typePlat = $value;
  }

  public  function getNom()
  {
    return $this->nom;
  }
  public static function setNom($value)
  {
    $this->nom = $value;
  }



  public  function getPrixFournisseur()
  {
    return $this->prixFournisseur;
  }
  public static function setPrixFournisseur($value)
  {
    $this->prixFournisseur = $value;
  }



  public  function getPrixClient()
  {
    return $this->prixClient;
  }
  public static function setPrixClient($value)
  {
    $this->prixClient = $value;
  }




  public  function getPlatVisible()
  {
    return $this->platVisible;
  }
  public static function setPlatVisible($value)
  {
    $this->platVisible = $value;
  }



  public  function getCheminPhoto()
  {
    return $this->cheminPhoto;
  }
  public static function setCheminPhoto($value)
  {
    $this->cheminPhoto = $value;
  }

  public  function getDescription()
  {
    return $this->description;
  }
  public static function setDescription($value)
  {
    $this->description = $value;
  }
}


 ?>
