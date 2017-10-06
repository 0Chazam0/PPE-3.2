<?php

/**
 * Restos
 */
class Restos
{
  private   $lesRestos;

  function __construct($lesRestos)
  {
    $this->lesRestos = $lesRestos;
  }

  public function getLesRestos()
  {
    return $this->lesRestos;
  }

  public function setLesRestos($value)
  {
    $this->lesRestos = $value;
  }

  public function chercher($TheId)
  {
    foreach ($this->lesRestos as $resto)
    {
      if ($resto->getid() == $TheId)
      {
        return $resto;
      }
    }
    return null;
  }

}


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
