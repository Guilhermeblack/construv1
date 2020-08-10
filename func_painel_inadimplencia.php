<?php 
function todos_inadi(){

   date_default_timezone_set('America/Sao_Paulo');

    $hoje = date('Y-m-d');
    $inicio = date('Y-m-d',strtotime($hoje . "-90 days"));

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' ";

    include "conexao.php";

   $query_amigo = "SELECT SUM(valor_parcelas) as total FROM parcelas                         
                   where tipo_venda = 1 AND situacao = 'Em Aberto' AND fluxo = 0 $where";

                   $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $total            = $buscar_amigo["total"];
                  
                  }
            


return $total;
}

function inadi_empreendimento(){

   date_default_timezone_set('America/Sao_Paulo');

    $hoje = date('Y-m-d');
    $inicio = date('Y-m-d',strtotime($hoje . "-90 days"));

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' ";

    include "conexao.php";

   $query_amigo = "SELECT SUM(valor_parcelas) as total FROM parcelas                         
                   where tipo_venda = 2 AND situacao = 'Em Aberto' AND fluxo = 0 $where";

                   $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $total            = $buscar_amigo["total"];
                  
                  }
            


return $total;
}


function todos_inadi_geral($data_do_repasse){
include "conexao.php";
  $hoje = date('Y-m-d');
   $query_amigo = "SELECT * FROM parcelas
                   INNER JOIN locacao ON locacao.idlocacao = parcelas.venda_idvenda
                   INNER JOIN cliente ON locacao.cliente_idcliente = cliente.idcliente              
                   INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
                   INNER JOIN locador ON imovel.locador_idlocador = locador.idlocador              
                   where tipo_venda = 1";

                   $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $valor_parcelas            = $buscar_amigo["valor_parcelas"];
                   $data_vencimento_parcela   = $buscar_amigo["data_vencimento_parcela"];                  
                   $situacao                  = $buscar_amigo["situacao"]; 
                  
                   $data_vencimento_tratada = converterdata($data_vencimento_parcela);
                   $partes = explode("-", $data_vencimento_parcela);
                   $mes_da_parcela = $partes[1].'-'.$partes[2];
       
              if(strtotime($data_vencimento_tratada) < strtotime($hoje) AND $situacao == 'Em Aberto'){ 
             
               
                 $contador_repasse = $contador_repasse + $valor_parcelas;

             } 
            


    
}
return $contador_repasse;
}


function inadi_juridico(){

   date_default_timezone_set('America/Sao_Paulo');

    $hoje = date('Y-m-d');
    $inicio = '1900-01-01';

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' group by cliente_id_novo";

    include "conexao.php";
$cont = 0;
   $query_amigo = "SELECT COUNT(idparcelas) as total FROM parcelas                         
                   where  situacao = 'Em Aberto' AND fluxo = 0 $where";

                   $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $total            = $buscar_amigo["total"];

                   if($total >= 3){
                    $cont = $cont + 1;
                   }
                  
                  }
            


return $cont;
}



function juridico_reais(){

   date_default_timezone_set('America/Sao_Paulo');

    $hoje = date('Y-m-d');
    $inicio = '1900-01-01';

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' group by cliente_id_novo";

    include "conexao.php";
$cont = 0;
$total_reais = 0;
   $query_amigo = "SELECT COUNT(idparcelas) as total, SUM(valor_parcelas) as reais  FROM parcelas                         
                   where  situacao = 'Em Aberto' AND fluxo = 0 $where";

                   $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $total            = $buscar_amigo["total"];
                   $reais            = $buscar_amigo["reais"];

                   if($total >= 3){
                    $cont = $cont + 1;
                    $total_reais = $total_reais + $reais;
                   }
                  
                  }
            


return $total_reais;
}
?>