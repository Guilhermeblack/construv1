<?php 

$idtour   = $_GET["idtour"];
$idimovel  = $_GET["idimovel"];
$img 	   = $_GET["img"];



include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM tour WHERE idtour='$idtour'");


unlink('tour/fotos/'.$idimovel.'/'.$img);
unlink('tour/small/'.$idimovel.'/'.$img);




?>
<script>
window.location ="tour_360.php?idimovel=<?php echo $idimovel ?>";
</script>