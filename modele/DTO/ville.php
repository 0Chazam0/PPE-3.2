<?php

/**
 * Ville
 */
class Ville
{
  private   $code;
  private   $nom;

  function __construct($pcode, $pnom)
  {
    $this->code = $pcode;
    $this->nom = $pnom;
  }

  public function getCode()
  {
    return $this->code;
  }

  public function getNom()
  {
    return $this->nom;
  }
}


 ?>
