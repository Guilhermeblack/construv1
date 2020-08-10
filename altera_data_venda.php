<?php
  $idlocacao 		= $_GET["idlocacao"];
  $data_venda   	= $_POST["data_venda"];  
   
$data_venda    	    = date("d-m-Y", strtotime($data_venda));


 include "conexao.php";



 $inserir = ("UPDATE locacao set data_venda 	='$data_venda' WHERE idlocacao = '$idlocacao'");

 $executa_query = mysqli_query($db, $inserir);


 ?>

 <script>
window.location='ver_contrato.php?idlocacao=<?php echo $idlocacao ?>';
 </script>