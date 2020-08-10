<?php 

$iddesconto  		= $_GET["iddesconto"];
$idempreendimento   = $_GET["idempreendimento"];



include "conexao.php";


$deleta_album = mysqli_query($db, "DELETE FROM desconto_empreendimento WHERE iddesconto='$iddesconto'");



  



?>
<script>
window.location ="descontos.php?idempreendimento=<?php echo $idempreendimento ?>";
</script>