<?php 

 function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}                


function todos($start, $end, $repasse){
  if($repasse == '')
  {
    $where = 'tipo_venda = 1';
  }elseif($repasse == 1)
  {
    $where = 'tipo_venda = 1 AND repasse_feito = 1';
  }else{
        $where = 'tipo_venda = 1 AND repasse_feito = 0';
  }

    include "conexao.php";
    $query_amigo = "SELECT * FROM parcelas
                    INNER JOIN locacao ON locacao.idlocacao = parcelas.venda_idvenda
                    INNER JOIN cliente ON locacao.cliente_idcliente = cliente.idcliente              
                    INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
                    INNER JOIN locador ON imovel.locador_idlocador = locador.idlocador              
                    where $where";               

                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar repasse");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                  $venda_idvenda              = $buscar_amigo["venda_idvenda"];
                  $nome_cli                   = $buscar_amigo["nome_cli"];
                  $valor_parcelas             = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela    = $buscar_amigo["data_vencimento_parcela"];

                  $telefone1_cli              = $buscar_amigo["telefone1_cli"];
                  
                  $situacao                   = $buscar_amigo["situacao"];
                  $repasse                    = $buscar_amigo["repasse"];
                  $taxa_adm                   = $buscar_amigo["taxa_adm"];
                  $nome_loc                   = $buscar_amigo["nome_loc"];

             
             $data_vencimento_tratada         = converterdata($data_vencimento_parcela);

             $valor_repasse                   = ($valor_parcelas*($repasse/100));
             $taxa_adm_repasse                = ($valor_parcelas*($taxa_adm/100));

             $taxa_adm_repasse                = ($valor_parcelas*($taxa_adm/100));
            
             $total_repasse_cliente           = ($valor_parcelas);

             $total_geral_liquido             = $total_geral_liquido + $total_repasse_cliente;


         if((strtotime($data_vencimento_tratada) >= strtotime($start)) AND (strtotime($data_vencimento_tratada) <= strtotime($end)))
         { 
            $contador_repasse = $contador_repasse + $total_repasse_cliente;
         }
            


    
}
return $contador_repasse;
}


?>