<?php
 
$endereco 	= $_GET['endereco'];
$numero 	= $_GET['numero'];
$cidade 	= $_GET['cidade'];

$endereco = str_replace(" ","%20", $endereco);
$address = $endereco.'%20'.$numero.'%20'.$cidade;


$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');


$output= json_decode($geocode);


$dados["lat"] = (string) $output->results[0]->geometry->location->lat;
$dados["lon"] = (string) $output->results[0]->geometry->location->lng;
$dados["sucesso"] = 1;


echo json_encode($dados);
 
?>