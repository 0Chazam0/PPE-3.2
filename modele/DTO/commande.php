<?php
class Commandes
{
  private   $lesCommandes;

  function __construct($lesCommandes)
  {
    $this->lesCommandes = $lesCommandes;
  }

  public function getLesCommandes()
  {
    return $this->lesCommandes;
  }

  public function setLesCommandes($value)
  {
    $this->lesCommandes = $value;
  }

  public function chercher($TheId)
  {
    foreach ($this->lesCommandes as $Commande)
    {
      if ($Commande->getid() == $TheId)
      {
        return $Commande;
      }
    }
    return null;
  }

}
/**
 * Commande
 */
class Commande
{
  private   $idCommande;
  private   $idResto;
  private   $idUser;
  private   $dateCommande;
  private   $commentaireClient;
  private   $dateLivraison;
  private   $modeReglement;
  private   $avisClient;
  private   $noteClient;
  private   $comVisible;


  function __construct($pidCommande, $pidResto, $pidUser, $pdateCommande,
                      $pcommentaireClient, $pdateLivraison, $pmodeReglement,
                      $pavisClient, $pnoteClient, $pcomVisible)
  {
    $this->idCommande = $pidCommande;
    $this->idResto = $pidResto;
    $this->idUser = $pidUser;
    $this->dateCommande = $pdateCommande;
    $this->commentaireClient = $pcommentaireClient;
    $this->dateLivraison = $pdateLivraison;
    $this->modeReglement = $pmodeReglement;
    $this->avisClient = $pavisClient;
    $this->noteClient = $pnoteClient;
    $this->comVisible = $pcomVisible;
  }

  public function getidCommande()
  {
    return $this->idCommande;
  }

  public function getidResto()
  {
    return $this->idResto;
  }
  public function getidUser()
  {
    return $this->idUser;
  }


  public function getDateCommande()
  {
    return $this->dateCommande;
  }

  public function getCommentaireClient()
  {
    return $this->commentaireClient;
  }

  public function getDateLivraison()
  {
    return $this->dateLivraison;
  }

  public function getModeReglement()
  {
    return $this->modeReglement;
  }

  public function getAvisClient()
  {
    return $this->avisClient;
  }

  public function getNoteClient()
  {
    return $this->noteClient;
  }

  public function getComVisible()
  {
    return $this->comVisible;
  }






  public function setidCommande($value)
  {
     $this->idCommande = $value;
  }

  public function setidResto($value)
  {
     $this->idResto =$value;
  }
  public function setidUser($value)
  {
     $this->idUser= $value;
  }


  public function setDateCommande($value)
  {
     $this->dateCommande =$value;
  }

  public function setCommentaireClient($value)
  {
     $this->commentaireClient=$value;
  }

  public function setDateLivraison($value)
  {
     $this->dateLivraison=$value;
  }

  public function setModeReglement($value)
  {
     $this->modeReglement =$value;
  }

  public function setAvisClient($value)
  {
     $this->avisClient =$value;
  }

  public function setNoteClient($value)
  {
     $this->noteClient =$value;
  }

  public function setComVisible($value)
  {
     $this->comVisible = $value;
  }
}


 ?>
