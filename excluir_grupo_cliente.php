<?php 

$id  = $_GET["id"];




include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM grupo_cliente WHERE idgrupo_cliente='$id'");



  



?>
<script>
window.location ="grupo_clientes.php";
</script>