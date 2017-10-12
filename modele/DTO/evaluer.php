<?php

/**
 * Evaluer
 */
class Evaluer
{

  private   $mail;
  private   $resto;
  private   $noteQualite;
  private   $noteRapidite;
  private   $noteTemp;
  private   $noteCout;
  private   $commentaire;

  function __construct($pmail, $presto, $pnoteQualite, $pnoteRapidite, $pnoteTemp, $pnoteCout, $pcommentaire)
  {
    $this->mail = $pmail;
    $this->resto = $presto;
    $this->noteQualite = $pnoteQualite;
    $this->noteRapidite = $pnoteRapidite;
    $this->noteTemp = $pnoteTemp;
    $this->noteCout = $pnoteCout;
    $this->commentaire = $pcommentaire;
  }

  public function getMail()
  {
    $this->mail;
  }

  public function getResto()
  {
    $this->resto;
  }

  public function getNoteQualite()
  {
    $this->noteQualite;
  }

  public function getNoteRapidite()
  {
    $this->noteRapidite;
  }

  public function getNoteTemp()
  {
    $this->noteTemp;
  }

  public function getNoteCout()
  {
    $this->noteCout;
  }

  public function getCommentaire()
  {
    $this->commentaire;
  }

}
 ?>
