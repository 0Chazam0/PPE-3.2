<?php

$e = 0;
if (isset($_GET[$cp_star]) || isset($_COOKIE[$cp_star])) {
  if (isset($_GET[$cp_star])){
    $value = $_GET[$cp_star];
  }
  else {
    $value = $_COOKIE[$cp_star];
  }
  if ($value>0) {
    $e += 1;
    setcookie($cp_star, 1);
    echo "<a href=?" . $cp_star . "=1><img src='image/star.png'></a>";
  }
  if ($value>1) {
    $e += 1;
    setcookie($cp_star, 2);
    echo "<a href=?" . $cp_star . "=2><img src='image/star.png'></a>";
  }
  if ($value>2) {
    setcookie($cp_star, 3);
    $e += 1;
    echo "<a href=?" . $cp_star . "=3><img src='image/star.png'></a>";
  }
  if ($value>3) {
    setcookie($cp_star, 4);
    $e += 1;
    echo "<a href=?" . $cp_star . "=4><img src='image/star.png'></a>";
  }
  if ($value>4) {
    setcookie($cp_star, 5);
    $e += 1;
    echo "<a href=?" . $cp_star . "=5><img src='image/star.png'></a>";
  }
  $e += 1;
  for ($i = $e;$i<6;$i++){
    echo "<a href=?" . $cp_star . "=" . $i . " ><img src='image/empty.png'></a>";
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
