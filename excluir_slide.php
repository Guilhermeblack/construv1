<?php 

$idslide_empreendimentos   = $_GET["idslide_empreendimentos"];
$img_slide 	               = $_GET["img_slide"];



include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM slide_empreendimentos WHERE idslide_empreendimentos='$idslide_empreendimentos'");


unlink('../img/slide/'.$img_slide);




?>
<script>
window.location ="adicionar_slide.php";
</script>