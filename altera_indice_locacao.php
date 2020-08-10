<?php
  $idlocacao 		= $_GET["idlocacao"];
  $indice_correcao 	= $_POST["indice_correcao"];  
   

   
 include "conexao.php";



 $inserir = ("UPDATE locacao set indice_correcao 	='$indice_correcao' WHERE idlocacao = '$idlocacao'");

 $executa_query = mysqli_query($db, $inserir);


 ?>

 <script>
window.location='ver_contrato.php?idlocacao=<?php echo $idlocacao ?>';
 </script>