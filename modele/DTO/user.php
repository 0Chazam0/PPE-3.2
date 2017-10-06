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
  private   $privilege;         // modo, client, admin, etc...

  function __construct($pid, $pnom, $pprenom,
                        $pmail, $pmdp, $padresse, $pprivilege)
  {
    $this->id = $pid;
    $this->nom = $pnom;
    $this->prenom = $pprenom;
    $this->mail = $pmail;
    $this->mdp = $pmdp;
    $this->adresse = $padresse;
    $this->privilege = $pprivilege;
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

  public function getPrivilege()
  {
    return $this->privilege;
  }

}
 ?>
