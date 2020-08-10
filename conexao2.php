<?php

$hostname ='50.116.87.204';
$username ='immob049_immobil';
$senha ='si171156';
$banco ='immob049_immobile';


$db = mysqli_connect($hostname,$username,$senha,$banco) or die (mysqli_error());
mysqli_select_db($banco, $db);
?>

