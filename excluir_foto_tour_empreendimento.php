<?php 

$idtour_empreendimento   = $_GET["idtour_empreendimento"];
$idempreendimento        = $_GET["idempreendimento"];
$img 	                 = $_GET["img"];



include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM tour_empreendimento WHERE idtour_empreendimento='$idtour_empreendimento'");


unlink('tour_empreendimento/fotos/'.$idempreendimento.'/'.$img);
unlink('tour_empreendimento/small/'.$idempreendimento.'/'.$img);




?>
<script>
window.location ="tour_empreendimento_360.php?idempreendimento=<?php echo $idempreendimento ?>";
</script>