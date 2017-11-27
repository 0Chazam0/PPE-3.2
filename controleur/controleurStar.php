<?php

$e = 0;
if (isset($_GET[$cp_star]) || (isset($_SESSION[$cp_star]) && $_SESSION[$cp_star] != 0)) {
  if (isset($_GET[$cp_star])){
    $value = $_GET[$cp_star];
  }
  else {
    $value = $_SESSION[$cp_star];
  }
  if ($value>0) {
    $e += 1;
    echo "<a href=?" . $cp_star . "=1><img src='image/star.png' width='5%' height='5%'></a>";
  }
  if ($value>1) {
    $e += 1;
    echo "<a href=?" . $cp_star . "=2><img src='image/star.png' width='5%' height='5%'></a>";  }
  if ($value>2) {
    $e += 1;
    echo "<a href=?" . $cp_star . "=3><img src='image/star.png' width='5%' height='5%'></a>";  }
  if ($value>3) {
    $e += 1;
    echo "<a href=?" . $cp_star . "=4><img src='image/star.png' width='5%' height='5%'></a>";  }
  if ($value>4) {
    $e += 1;
    echo "<a href=?" . $cp_star . "=5><img src='image/star.png' width='5%' height='5%'></a>";
  }
  $_SESSION[$cp_star] = $value;
  $e += 1;
  for ($i = $e;$i<6;$i++){
    echo "<a href=?" . $cp_star . "=" . $i . " ><img src='image/empty.png' width='5%' height='5%'></a>";
  }
}
else {
  echo "<a href=?" . $cp_star . "=1><img src='image/empty.png'></a>";
  echo "<a href=?" . $cp_star . "=2><img src='image/empty.png'></a>";
  echo "<a href=?" . $cp_star . "=3><img src='image/empty.png'></a>";
  echo "<a href=?" . $cp_star . "=4><img src='image/empty.png'></a>";
  echo "<a href=?" . $cp_star . "=5><img src='image/empty.png'></a>";

}
 ?>
