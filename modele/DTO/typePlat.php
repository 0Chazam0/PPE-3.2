<?php
/**
 * TypePlats
 */
class TypePlats
{
  private   $lesTypePlats;

  function __construct($lesTypePlats)
  {
    $this->lesTypePlats = $lesTypePlats;
  }

  public function getLesTypePlats()
  {
    return $this->lesTypePlats;
  }

  public function setLesTypePlats($value)
  {
    $this->lesTypePlats = $value;
  }

  public function chercher($TheId)
  {
    foreach ($this->lesTypePlats as $TypePlat)
    {
      if ($typePlat->getid() == $TheId)
      {
        return $typePlat;
      }
    }
    return null;
  }

}

/**
 * TypePlat
 */
class TypePlat
{
  private   $codeT;
  private   $libelle;


  function __construct($pcodeT, $plibelle)
  {
    $this->codeT = $pcodeT;
    $this->libelle = $plibelle;

  }

  public function getCodeT()
  {
    return $this->codeT;
  }

  public function getLibelle()
  {
    return $this->libelle;
  }


}


 ?>
