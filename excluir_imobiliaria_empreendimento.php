<?php 


$imobiliaria_id  	= $_GET["imobiliaria_id"];
$empreendimento_id  = $_GET["empreendimento_id"];
$cadastro  = $_GET["cadastro"];




include "conexao.php";

$deletaimovel = mysqli_query($db,"DELETE FROM empreendimento_imob WHERE imobiliaria_id = $imobiliaria_id AND empreendimento_id = $cadastro");




?>
<script>
window.location ="descontos.php?idempreendimento=<?php echo $empreendimento_id ?>";
</script>