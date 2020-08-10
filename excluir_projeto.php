<?php 

$id  = $_GET["id"];




include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM projetos WHERE id='$id'");



  



?>
<script>
window.location ="projetos.php";
</script>