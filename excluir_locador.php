<?php 

$idlocador  = $_GET["idlocador"];




include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM locador WHERE idlocador='$idlocador'");



  



?>
<script>
window.location ="locadores.php";
</script>