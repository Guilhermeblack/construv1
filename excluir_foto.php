<?php 

$idfotos   = $_GET["idfotos"];
$idimovel  = $_GET["idimovel"];
$img 	   = $_GET["img"];



include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM fotos WHERE idfotos='$idfotos'");


unlink('../modelo1/fotos/'.$idimovel.'/'.$img);




?>
<script>
window.location ="adicionar_imagem.php?idimovel=<?php echo $idimovel ?>";
</script>