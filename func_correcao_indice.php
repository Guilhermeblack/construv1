<?php

function contrato_ativo($venda_id){
    include "conexao.php";
    $query_igpm = "SELECT COUNT(idparcelas) as total 
                    from parcelas 
                    where venda_idvenda = $venda_id 
                    and tipo_venda = 2 
                    AND fluxo = 0 
                    and situacao = 'Em Aberto'";


    $executa_igpm = mysqli_query ($db, $query_igpm);
    while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $total             = $buscar_amigoc['total'];
}
return $total;

} 
function converterdataigpm($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}  

function verifica_venda_id(){

  date_default_timezone_set('America/Sao_Paulo'); 
$data_hoje = date('Y-m-d');
          include "conexao.php";
                   $query_igpm = "SELECT vencimento_primeira, igpm, idvenda FROM venda";
$cont = 0;
                $executa_igpm = mysqli_query($db, $query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $vencimento_primeira     = $buscar_amigoc['vencimento_primeira'];
             $igpm                    = $buscar_amigoc['igpm'];
             $idvenda                 = $buscar_amigoc['idvenda'];

             if($igpm == ''){
              $data_para_calculo = $vencimento_primeira;
             }else{
              $data_para_calculo = $igpm;
             }

             $data_para_calculo_tratada = converterdataigpm($data_para_calculo);


        $time_inicial = strtotime($data_hoje);
    $time_final   = strtotime($data_para_calculo_tratada);

    
    $diferenca = $time_inicial - $time_final;

    $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

    $contrato_ativo = contrato_ativo($idvenda);

    if($dias >= 334 AND $contrato_ativo > 0){ 
 


$cont = $cont + 1;


 
} }

return $cont;
}


$total =  verifica_venda_id();

$dados['TOTAL'] = (string) $total;
echo json_encode($dados);

?>