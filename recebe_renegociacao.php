 <?php 

$entrada_renegociar  = $_POST["entrada_renegociar"];
$qtd_renegociar 	 = $_POST["qtd_renegociar"];
$parcela2            = $_POST["parcela2"];
$saldo_devedor            = $_POST["saldo_devedor"];
$taxa_renegociar            = $_POST["taxa_renegociar"];

$venc_primeira_renegociar 	         = $_POST["venc_primeira_renegociar"];
$venc_restante_renegociar 	         = $_POST["venc_restante_renegociar"];
$data_contrato 	         = $_POST["data_contrato"];

$idvenda 	         = $_POST["idvenda"];
$tipo 	             = $_POST["tipo"];
$estornado_por 	     = $_POST["feito_por"];
$renegociar 	     = $_POST["renegociar"];

$empreendimento_id 	 = $_POST["empreendimento_id"];
$cliente_id 	     = $_POST["cliente_id"];

$lancamento = date('Y-m-d H:i:s');
$venc_primeira_renegociar    	        = date("d-m-Y", strtotime($venc_primeira_renegociar));
$venc_restante_renegociar    	        = date("d-m-Y", strtotime($venc_restante_renegociar));
$data_contrato    	                    = date("d-m-Y", strtotime($data_contrato));

if($entrada_renegociar != ''){
$entrada_renegociar = str_replace("R$","", $entrada_renegociar);
$entrada_renegociar = str_replace(".","",  $entrada_renegociar);
$entrada_renegociar = str_replace(",",".", $entrada_renegociar);
}

    include "conexao.php";


    $insere_no_banco = mysqli_query($db, "INSERT INTO venda_renegociacao (venda_id, saldo_devedor, entrada, total_parcelas, taxa_juros, vencimento_primeira, vencimento_restante, valor_parcela, status, feito_por, data_contrato) values('$idvenda', '$saldo_devedor', '$entrada_renegociar', '$qtd_renegociar', '$taxa_renegociar', '$venc_primeira_renegociar', '$venc_restante_renegociar', '$parcela2','0','$estornado_por', '$data_contrato')");

    $venda_idvenda = mysqli_insert_id($db);



  foreach($renegociar as $id){

  	 $insere_no_banco = mysqli_query($db, "INSERT INTO venda_ren_par(venda_ren_id, parcela_id) values('$venda_idvenda', '$id')");

}




?>

<script type="text/javascript">window.location="empreendimentos.php";</script>