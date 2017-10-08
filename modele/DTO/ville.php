<?php
class Villes
{
  private   $lesVilles;

  function __construct($lesVilles)
  {
    $this->lesVilles = $lesVilles;
  }

  public function getLesVilles()
  {
    return $this->lesVilles;
  }

  public function setLesVilles($value)
  {
    $this->lesVilles = $value;
  }

  public function chercher($TheId)
  {
    foreach ($this->lesVilles as $ville)
    {
      if ($ville->getid() == $TheId)
      {
        return $ville;
      }
    }
    return null;
  }

}
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
