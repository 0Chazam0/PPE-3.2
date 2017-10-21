<?php
/**
 * TypeRestos
 */
class TypeRestos
{
  private   $lesTypeRestos;

  function __construct($lesTypeRestos)
  {
    $this->lesTypeRestos = $lesTypeRestos;
  }

  public function getLesTypeRestos()
  {
    return $this->lesTypeRestos;
  }

  public function setLesTypeRestos($value)
  {
    $this->lesTypeRestos = $value;
  }

  public function chercher($TheId)
  {
    foreach ($this->lesTypeRestos as $TypeResto)
    {
      if ($TypeResto->getCodeT() == $TheId)
      {
        return $TypeResto;
      }
    }
    return null;
  }

}

/**
 * TypeResto
 */
class TypeResto
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
