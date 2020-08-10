<?php

$idimovel 		= $_GET["idimovel"];
$idreserva 		= $_POST["idreserva"];
$comentario 	= $_POST["comentario"];

include "conexao.php";

$inserir = ("UPDATE reserva set comentario ='$comentario', status_reserva = '1' WHERE idreserva = '$idreserva'");

 $executa_query = mysqli_query ($db, $inserir);


$inserir_imovel = ("UPDATE imovel set status ='1' WHERE idimovel = '$idimovel'");
 $executa_query = mysqli_query ($db,$inserir_imovel );



 ?>

 <script>
window.location="visita_imovel.php?idimovel=<?php echo $idimovel ?>";
 </script>

 ?>