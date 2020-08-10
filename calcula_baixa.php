<?php

$idparcelas = $_GET["idparcelas"];

date_default_timezone_set('America/Sao_Paulo');               
$hoje = date('Y-m-d');
function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}   

                include_once "conexao.php";
                $query_amigo = "SELECT * FROM parcelas where idparcelas = $idparcelas";

                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
             	  $idparcelas           	= $buscar_amigo["idparcelas"];
			          $valor_parcelas         = $buscar_amigo["valor_parcelas"];
                $data_vencimento_parcela= $buscar_amigo["data_vencimento_parcela"];
         		    $situacao           		= $buscar_amigo["situacao"];
                $tipo_venda             = $buscar_amigo["tipo_venda"];
                $idvenda                = $buscar_amigo["venda_idvenda"];
                $data_recebimento       = $buscar_amigo["data_recebimento"];

              $valor_normal             = $buscar_amigo["valor_parcelas"];  
              $data_vencimento_tratada  = converterdata($data_vencimento_parcela);
              $data_recebimento_tratada = converterdata($data_recebimento);

// declara a multa e a taxa de juros
if($tipo_venda == 1){
  $valor_multa = (10 / 100);
}else{
  $valor_multa = (2 / 100);
}

$valor_juros = (0.033 / 100);


  if($situacao == 'Pago'){
  
  $stilo = 'success';
  
  if(strtotime($data_vencimento_tratada) >= strtotime($data_recebimento_tratada)){ 

    $valor_parcelas = $valor_parcelas;

  }else{
    
    $time_inicial = strtotime($data_vencimento_tratada);
    $time_final = strtotime($data_recebimento_tratada);

    $diferenca = $time_final - $time_inicial;

    $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

    $multa = ($valor_parcelas * $valor_multa);
      $juros = ($valor_parcelas * $valor_juros * $dias);

      $valor_parcelas =   $valor_parcelas + $multa + $juros;

  }
      
}else{

  if(strtotime($data_vencimento_tratada) <= strtotime($hoje) ) { 

  $stilo = 'danger';
$time_inicial = strtotime($hoje);
$time_final = strtotime($data_vencimento_tratada);

$diferenca = $time_inicial - $time_final; 

$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias


      $multa = ($valor_parcelas * $valor_multa);
      $juros = ($valor_parcelas * $valor_juros * $dias);

      $valor_parcelas = $valor_parcelas + $multa + $juros;


}else{
  $valor_parcelas = $valor_parcelas;
  $multa = 0; 
  $juros = 0;
}

} 



}

$valor_normal =  'R$' . number_format($valor_normal, 2, ',', '.');
$multa =  'R$' . number_format($multa, 2, ',', '.');
$juros =  'R$' . number_format($juros, 2, ',', '.');
$valor_parcelas =  'R$' . number_format($valor_parcelas, 2, ',', '.');

$dados["dta_vencimento"] = $data_vencimento_parcela;
$dados["valor_normal"] = $valor_normal;
$dados["multa"] = $multa;
$dados["juros"] = $juros;
$dados["valor_corrigido"] = $valor_parcelas;
$dados["idparcelas"] = $idparcelas;
$dados["idvenda"] = $idvenda;
$dados["tipo_venda"] = $tipo_venda;
echo json_encode($dados);

                 
                