<?php 

$id  		 = $_GET["id"];
$projeto_id  = $_GET["projeto_id"];
$pacotes_id  = $_GET["pacotes_id"];
$lista_id  	 = $_GET["lista_id"];



include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM itens_lista WHERE iditens_lista ='$id'");



  



?>
<script>
window.location ="cadastro_lista.php?projeto_id=<?php echo $projeto_id ?>&pacotes_id=<?php echo $pacotes_id ?>&lista_id=<?php echo $lista_id ?>";
</script>