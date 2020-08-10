<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
function data_itau($var1){
  // Converter uma string data brasileira em uma data brasileira com as barras
  // Entrada: DDMMAAAA / Saida: DD/MM/AAAA
  $j_dia = substr($var1,0,2);
  $j_mes = substr($var1,2,2);
  $j_ano = substr($var1,4,2);
  $j_dtf = $j_dia."-".$j_mes."-"."20".$j_ano;
  return $j_dtf;
}
function verifica_vinculo($parcela_id){

  include "conexao.php";
  $select_vinculo = mysqli_query($db, "SELECT vinculo FROM parcelas 
                                       WHERE idparcelas = '$parcela_id'");

  while ($result_vinculo = mysqli_fetch_assoc($select_vinculo)) {

    $vinculo = $result_vinculo["vinculo"];

  }

  return $vinculo;

}
function limpa_valor($valor){

  $valor = str_replace("R$","", $valor);
  $valor = str_replace(".","", $valor);
  $valor = str_replace(",",".", $valor);

  return $valor;
}
if(isset($_POST["idparcelas"])){
date_default_timezone_set('America/Sao_Paulo');
				
        $idparcelas        = $_POST["idparcelas"];;
        $hoje              = date("d-m-Y", strtotime($hoje));

        $cod_baixa = date('Y-m-d H:i:s');

        $cod_baixa = str_replace("-","", $cod_baixa);
        $cod_baixa = str_replace(":","", $cod_baixa);
        $cod_baixa = str_replace(" ","", $cod_baixa);

          $data_baixa           = date('d-m-Y H:i:s');
          $baixado_por          = $_POST["baixado_por"];


	include "conexao.php";
	foreach($idparcelas as $id){
    
    $nosso_numero_buscar =$_SESSION["dados_gerais".$id]["idparcelas"];
    $data_ocorrencia     =$_SESSION["dados_gerais".$id]["data_pagamento"];
    $valor_pago          =$_SESSION["dados_gerais".$id]["valor_pago"];
    $acre                =$_SESSION["dados_gerais".$id]["acrescimos"];
    $desc                =$_SESSION["dados_gerais".$id]["descontos"];

    $data_ocorrencia = data_itau($data_ocorrencia);



    $verifica_vinculo = verifica_vinculo($nosso_numero_buscar);

    if($verifica_vinculo != '' AND $verifica_vinculo != 0){



  $select_todos_vinculos = mysqli_query($db, "SELECT idparcelas, valor_parcelas FROM parcelas 
                                              WHERE vinculo = '$verifica_vinculo'");

  while ($result_vinculos = mysqli_fetch_assoc($select_todos_vinculos)) {

    $valor_parcelas = $result_vinculos["valor_parcelas"];
    $idparcelas     = $result_vinculos["idparcelas"];


        $baixar = ("UPDATE parcelas set    
          situacao          = 'Pago',
          data_recebimento  = '$data_ocorrencia',
          valor_recebido    = '$valor_parcelas',
          cod_baixa         = '$cod_baixa',
          baixado_por       = '$baixado_por',
          data_baixa        = '$data_baixa',
          desc_parcela      = '$desc',
          acre_parcela      = '$acre'
          WHERE idparcelas  = '$idparcelas'");


    $executa_baixar = mysqli_query ($db, $baixar);

}


    }else{



   

		$inserir = ("UPDATE parcelas set		
					situacao 			    = 'Pago',
					data_recebimento 	= '$data_ocorrencia',
					valor_recebido 		= '$valor_pago',
          cod_baixa         = '$cod_baixa',
          baixado_por       = '$baixado_por',
          data_baixa        = '$data_baixa',
          desc_parcela      = '$desc',
          acre_parcela      = '$acre'
					WHERE idparcelas 	= '$nosso_numero_buscar'");


 		$executa_query = mysqli_query ($db, $inserir);
}


  



             
	}  }

?>
<script type="text/javascript">
  window.location="retorno_itau1400.php?baixa=1";
</script>

