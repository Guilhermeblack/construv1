<?php
  $idparcelas = $_POST["idparcelas"];

  $idvenda    = $_POST["idvenda"];  
  $tipo       = $_POST["tipo_venda"]; 
  
$valor_recebido = $_POST["valor_recebido"];

$valor_recebido = str_replace("R$","", $valor_recebido);
$valor_recebido = str_replace(".","", $valor_recebido);
$valor_recebido = str_replace(",",".", $valor_recebido);


$data_recebimento =  date('d-m-Y');





 include "conexao.php";



 $inserir = ("UPDATE parcelas set
situacao 	='Pago',
data_recebimento = '$data_recebimento',
valor_recebido = '$valor_recebido'

WHERE idparcelas = '$idparcelas'   



");

 $executa_query = mysqli_query ($db, $inserir);


 ?>

 <script>
window.location='parcelas.php?idvenda=<?php echo $idvenda ?>&tipo=<?php echo $tipo ?>';
 </script>