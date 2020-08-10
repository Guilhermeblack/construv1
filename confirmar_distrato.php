<?php 

    include "conexao.php";
    $venda_id          = $_GET["venda_id"];
    $empreendimento_id = $_GET["empreendimento_id"];
    $idlote            = $_GET["idlote"];
    $estornado_por     = $_GET["estornado_por"];



$cancela_parcelas_abertas  = mysqli_query($db,"UPDATE parcelas set fluxo = 20, obs_estorno = 'DISTRATO', estornado_por = '$estornado_por' WHERE venda_idvenda = '$venda_id' AND situacao = 'Em Aberto' AND fluxo = 0 and tipo_venda = 2");

$libera_lote     = mysqli_query($db, "UPDATE lote SET status ='1' where idlote = $idlote");

$atualiza_status = mysqli_query($db,"UPDATE distrato set status = 1 WHERE venda_id = '$venda_id'");

$atualiza_venda = mysqli_query($db,"UPDATE venda set status_venda = 4 WHERE idvenda = '$venda_id'");



?>

<script type="text/javascript">
  window.location="empreendimentos.php";
</script>