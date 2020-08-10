<?php 
$venda_idvenda = $_POST["idvenda"];
$tipo_venda    = $_POST["tipo"];


if(isset($_POST["antecipar"])){
    
$antecipar 		   = $_POST["antecipar"];


	include "conexao.php";
        $cod_baixa = date('Y-m-d H:i:s');

        $cod_baixa = str_replace("-","", $cod_baixa);
        $cod_baixa = str_replace(":","", $cod_baixa);
        $cod_baixa = str_replace(" ","", $cod_baixa);

	foreach($antecipar as $id){

$vincula = mysqli_query($db, "UPDATE parcelas SET vinculo = '$cod_baixa' WHERE idparcelas = '$id'");

  }


?>
<script type="text/javascript">window.location="parcelas.php?idvenda=<?php echo $venda_idvenda ?>&tipo=<?php echo $tipo_venda ?>"</script>

<?php } ?>           
	
