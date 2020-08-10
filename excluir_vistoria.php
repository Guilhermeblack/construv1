<?php 

$idvistoria   = $_GET["idvistoria"];
$idlocacao    = $_GET["idlocacao"];
$url 	      = $_GET["url"];



include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM vistoria WHERE idvistoria='$idvistoria'");


unlink('fotos/vistoria/'.$idlocacao.'/'.$url);




?>
<script>
window.location ="vistoria.php?idlocacao=<?php echo $idlocacao ?>";
</script>