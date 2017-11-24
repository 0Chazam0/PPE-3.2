<?php
/**
 * User
 */
class User
{
  private   $id;
  private   $nom;
  private   $prenom;
  private   $mail;
  private   $mdp;
  private   $adresse;

  function __construct($pid, $pnom, $pprenom,
                        $pmail, $pmdp, $padresse)
  {
    $this->id = $pid;
    $this->nom = $pnom;
    $this->prenom = $pprenom;
    $this->mail = $pmail;
    $this->mdp = $pmdp;
    $this->adresse = $padresse;
  }

  public function   getId()
  {
    return $this->id;
  }

  public function   getNom()
  {
    return $this->nom;
  }

  public function   getPrenom()
  {
    return $this->prenom;
  }

  public function   getMail()
  {
    return $this->mail;
  }

  public function   getMdp()
  {
    return $this->mdp;
  }

  public function getAdresse()
  {
    return $this->adresse;
  }

  public static function testConnex($unId, $unMdp){
    $unUserC = UserDAO::unUserC($unId);
    $unUserA = UserDAO::unUserA($unId);
    $unUserM = UserDAO::unUserM($unId);
    $unUserR = UserDAO::unUserR($unId);
    if ($unUserA != NULL) {
      $unUser = $unUserA;
    }
    elseif ($unUserC != NULL) {
      $unUser = $unUserC;
    }
    elseif ($unUserM != NULL) {
      $unUser = $unUserM;
    }
    elseif ($unUserR != NULL) {
      $unUser = $unUserR;
    }
    else {
      $unUser ='';
    }
    if ($unUser != '') {
      if ($unUser[4]==$unMdp ) {
        $_SESSION['identite'] = $unUser;
        return 1;
      }
    }
    return 0;
  }
}
 ?>
