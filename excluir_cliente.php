<?php 

$idcliente  = $_GET["idcliente"];




include "conexao.php";


$deleta_album = mysqli_query($db, "DELETE FROM cliente WHERE idcliente='$idcliente'");



  



?>
<script>
window.location ="clientes.php";
</script>