<?php 
date_default_timezone_set('America/Sao_Paulo');

$idfolha_cheque  		= $_POST["idfolha_cheque"];
$idcheque  		 		= $_POST["idcheque"];
$descricao_cancelar  	= $_POST["descricao_cancelar"];
$alterado_por       	= $_POST["iduser"];
$data_alterado          = date('d-m-Y H:i:s');




include "conexao.php";


  $cancelar_folha="UPDATE folha_cheque SET situacao_folha='2', descricao_cancelar ='$descricao_cancelar', alterado_por = '$alterado_por', data_alterado = '$data_alterado' WHERE idfolha_cheque =$idfolha_cheque";
  $cancelar = mysqli_query($db,$cancelar_folha);


  



?>
<script>
window.location ="ver_folhas.php?idcheque=<?php echo $idcheque ?>";
</script>