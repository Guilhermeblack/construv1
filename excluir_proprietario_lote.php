<?php 

$idproprietarios  = $_GET["idproprietarios"];
$venda_idvenda    = $_GET["venda_idvenda"];




include "conexao.php";


$deleta_album = mysqli_query($db, "DELETE FROM proprietarios_lote WHERE idproprietarios_lote='$idproprietarios'");



  



?>
<script>
window.location ="proprietario_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>";
</script>