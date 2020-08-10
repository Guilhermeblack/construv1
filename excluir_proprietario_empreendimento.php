<?php 

$idproprietarios  = $_GET["idproprietarios"];
$idempreendimento         = $_GET["idempreendimento"];




include "conexao.php";


$deleta_album = mysqli_query($db, "DELETE FROM proprietarios WHERE idproprietarios='$idproprietarios'");



  



?>
<script>
window.location ="proprietario_empreendedor.php?idempreendimento=<?php echo $idempreendimento ?>";
</script>