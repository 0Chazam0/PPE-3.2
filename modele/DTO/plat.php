<?php
/**
 * Plats
 */
class Plats
{
  private   $lesPlats;

  function __construct($lesPlats)
  {
    $this->lesPlats = $lesPlats;
  }

  public function getLesPlats()
  {
    return $this->lesPlats;
  }

  public function setLesPlats($value)
  {
    $this->lesPlats = $value;
  }

  public function chercher($TheId)
  {
    foreach ($this->lesPlats as $Plat)
    {
      if ($plat->getid() == $TheId)
      {
        return $plat;
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

  function __construct($pid, $pidResto, $ptypePlat, $pnom, $pprixFournisseur,
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

  public function getIDResto()
  {
    return $this->idResto;
  }

  public function getTypePlat()
  {
    return $this->typePlat;
  }

  public function getNom()
  {
    return $this->nom;
  }

  public function getPrixFournisseur()
  {
    return $this->prixFournisseur;
  }

  public function getPrixClient()
  {
    return $this->prixClient;
  }
  public function getPlatVisible()
  {
    return $this->platVisible;
  }

  public function getCheminPhoto()
  {
    return $this->cheminPhoto;
  }

  public function getDescription()
  {
    return $this->description;
  }
}


 ?>
