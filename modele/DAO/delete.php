<?php

public function delCommande($IDC)
{
  $sql = "DELETE FROM commande WHERE IDC = '" . $IDC . "';";

}

public function delResto($IDR)
{
  $sql = "DELETE FROM resto WHERE IDR = '" . $IDR . "';";

}

public function delPlat($IDR, $IDP)
{
  $sql = "DELETE FROM plat WHERE IDP = '" . $IDP . "' AND IDR = '" . $IDR . "';";

}

public function delTypePlat($code)
{
  $sql = "DELETE FROM type_plat WHERE CODET = '" . $code . "';";

}

public function delUser($table, $IDU)
{
  $sql = "DELETE FROM " . $table . " WHERE IDU = '" . $IDU . "';";

}

 ?>
