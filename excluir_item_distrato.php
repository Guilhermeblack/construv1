<?php 

$idcusto_distrato  		= $_GET["idcusto_distrato"];
$idempreendimento   	= $_GET["idempreendimento"];



include "conexao.php";


$deleta_album = mysqli_query($db, "DELETE FROM custo_distrato WHERE idcusto_distrato='$idcusto_distrato'");



  



?>
<script>
window.location ="descontos.php?empreendimento_id=<?php echo $idempreendimento ?>";
</script>