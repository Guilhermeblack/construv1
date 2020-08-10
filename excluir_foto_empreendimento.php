<?php 

$idfotos   			= $_GET["idfotos"];
$idempreendimento   = $_GET["idempreendimento"];



include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM fotos_empreendimento WHERE idfotos_empreendimento='$idfotos'");




?>
<script>
window.location ="fotos_empreendimentos.php?idempreendimento=<?php echo $idempreendimento ?>";
</script>