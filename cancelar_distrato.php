<?php 

    include "conexao.php";
    $venda_id 			= $_GET["venda_id"];
    $empreendimento_id  = $_GET["empreendimento_id"];



$atualiza_status = mysqli_query($db,"UPDATE distrato set status = 2 WHERE venda_id = '$venda_id'");


?>


<script type="text/javascript">
  window.location="empreendimentos.php";
</script>


