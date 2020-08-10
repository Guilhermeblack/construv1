<?php 

$idlote 						= $_GET["idlote"];
$idvenda 						= $_GET["idvenda"];
   
   if($idlote == 0 or $idlote == '' or $idvenda == 0 or $idvenda == ''){
   	die("Por segurança não foi possivel realizar a atualização desse lote.");
   }
 include_once "conexao.php";

$up = mysqli_query($db,"UPDATE lote SET status='2' WHERE idlote =$idlote");
$up2 = mysqli_query($db, "UPDATE venda SET status_venda ='2' WHERE idvenda =$idvenda");

$dados[0] = 1;
return $idvenda;
?>