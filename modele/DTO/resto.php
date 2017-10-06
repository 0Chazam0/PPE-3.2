<?php
/**
 * resto
 */
class Resto
{
  private   $id;
  private   $codev;
  private   $nom;
  private   $numAdr;
  private   $rueAdr;
  private   $CP;



  function __construct($pid, $pcodev, $pnom, $pnumAdr, $prueAdr, $pCP)
  {
    $this->id = $pid;
    $this->codev = $pcodev;
    $this->nom = $pnom;
    $this->numAdr = $pnumAdr;
    $this->rueAdr = $prueAdr;
    $this->CP = $pCP;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getCodeV()
  {
    return $this->codev;
  }

  public function getNom()
  {
    return $this->nom;
  }

  public function getNumAdr()
  {
    return $this->numAdr;
  }

  public function getRueAdr()
  {
    return $this->rueAdr;
  }

  public function getCP()
  {
    return $this->CP;
  }
}


 ?>
