<?php 

$idparcelamento_entrada  		= $_GET["idparcelamento_entrada"];
$idempreendimento   			= $_GET["idempreendimento"];



include "conexao.php";


$deleta_album = mysqli_query($db, "DELETE FROM parcelamento_entrada WHERE idparcelamento_entrada='$idparcelamento_entrada'");



  



?>
<script>
window.location ="descontos.php?idempreendimento=<?php echo $idempreendimento ?>";
</script>