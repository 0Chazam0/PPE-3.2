<?php

/**
 * Commande
 */
class Commande
{
  private   $idClient;
  private   $idRestaurateur;
  private   $dateCommande;
  private   $commentaireClient;
  private   $dateLivraison;
  private   $modeReglement;
  private   $avisClient;
  private   $noteClient;
  private   $comVisible;
  private   $quantite;

  function __construct($pidClient, $pidRestaurateur, $pdateCommande,
                      $pcommentaireClient, $pdateLivraison, $pmodeReglement,
                      $pavisClient, $pnoteClient, $pcomVisible, $pquantite)
  {
    $this->idClient = $pidClient;
    $this->idRestaurateur = $pidRestaurateur;
    $this->dateCommande = $pdateCommande;
    $this->commentaireClient = $pcommentaireClient;
    $this->dateLivraison = $pdateLivraison;
    $this->modeReglement = $pmodeReglement;
    $this->avisClient = $pavisClient;
    $this->noteClient = $pnoteClient;
    $this->comVisible = $pcomVisible;
    $this->quantite = $pquantite;
  }

  public function getIdClient()
  {
    return $this->idClient;
  }

  public function getIdRestaurateur()
  {
    return $this->idRestaurateur;
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

  public function getQuantite()
  {
    return $this->quantite;
  }
}


 ?>
