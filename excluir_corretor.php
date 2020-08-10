<?php 

$idimobiliaria  = $_GET["idcorretor"];




include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM imobiliaria WHERE idimobiliaria='$idimobiliaria'");



  



?>
<script>
window.location ="relatorio_corretor.php";
</script>