<?php 

$id  = $_GET["id"];




include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM pacotes WHERE id='$id'");



  



?>
<script>
window.location ="pacotes.php";
</script>