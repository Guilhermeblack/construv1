<?php 

$id  = $_GET["id"];




include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM insumo WHERE id='$id'");



  



?>
<script>
window.location ="insumos.php";
</script>