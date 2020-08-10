<?php
  $start = $_GET["start"];
  $end = $_GET["end"];  
   
  $repasse = $_GET["repasse"]; 
  $idparcelas = $_GET["idparcelas"];   

   
 include "conexao.php";



 $inserir = ("UPDATE parcelas set
repasse_feito 	='$repasse'

WHERE idparcelas = '$idparcelas'   



");

 $executa_query = mysql_query ($inserir);


 ?>

 <script>
window.location='gerenciador_repasse.php?start=<?php echo $start ?>&end=<?php echo $end ?>';
 </script>