<?php 

$idfotos_construao   = $_GET["idfotos_construao"];
$idconstruao  = $_GET["idconstruao"];
$img 	   = $_GET["img"];



include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM fotos_construao WHERE idfotos_construao='$idfotos_construao'");


unlink('fotos/contrucao/'.$idconstruao.'/'.$img);




?>
<script>
window.location ="adicionar_imagem_construcao.php?idconstruao=<?php echo $idconstruao ?>";
</script>