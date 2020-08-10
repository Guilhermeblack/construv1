<?php 

date_default_timezone_set('America/Sao_Paulo');  


$hoje = date('Y-m-d');


 function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
} 


function inadi_lote(){
    include_once "conexao.php";
	   $query_amigo = "SELECT * FROM parcelas 
                        INNER JOIN venda ON parcelas.venda_idvenda = venda.idvenda
                        WHERE imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria AND tipo_venda = 2";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
             	 
			      $valor_parcelas          	= $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
         		  $situacao           	= $buscar_amigo["situacao"];
                 

             $data_vencimento_tratada = converterdata($data_vencimento_parcela);

          if(strtotime($data_vencimento_parcela) < strtotime($hoje) AND $situacao == 'Em Aberto'){ 
             	$inadi_lote = $inadi_lote + 1;
             }
             return $inadi_lote;
}
}

function inadi_loc(){
    include_once "conexao.php";
       $query_amigo = "SELECT * FROM parcelas 
                        INNER JOIN locacao ON parcelas.venda_idvenda = locacao.idlocacao
                        WHERE imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria AND tipo_venda = 1";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
                 
                  $valor_parcelas           = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
                  $situacao             = $buscar_amigo["situacao"];
                 

             $data_vencimento_tratada = converterdata($data_vencimento_parcela);

          if(strtotime($data_vencimento_parcela) < strtotime($hoje) AND $situacao == 'Em Aberto'){ 
                $inadi_loc = $inadi_loc + 1;
             }
             return $inadi_loc;
}
}

function inadi_venda(){
    include_once "conexao.php";
       $query_amigo = "SELECT * FROM parcelas 
                        INNER JOIN venda_imovel ON parcelas.venda_idvenda = venda_imovel.idvenda_imovel
                        WHERE imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria AND tipo_venda = 3";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
                 
                  $valor_parcelas           = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
                  $situacao             = $buscar_amigo["situacao"];
                 

             $data_vencimento_tratada = converterdata($data_vencimento_parcela);

          if(strtotime($data_vencimento_parcela) < strtotime($hoje) AND $situacao == 'Em Aberto'){ 
                $inadi_venda = $inadi_venda + 1;
             }
             return $inadi_venda;
}
}

function inadi_lote_total(){
    include_once "conexao.php";
       $query_amigo = "SELECT * FROM parcelas 
                        INNER JOIN venda ON parcelas.venda_idvenda = venda.idvenda
                        WHERE imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria AND tipo_venda = 2";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
                 
                  $valor_parcelas           = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
                  $situacao             = $buscar_amigo["situacao"];
                 

             
          
                $inadi_lote_total = $inadi_lote_total + 1;
             
             return $inadi_lote_total;
}
}

function inadi_loc_total(){
    include_once "conexao.php";
       $query_amigo = "SELECT * FROM parcelas 
                        INNER JOIN locacao ON parcelas.venda_idvenda = locacao.idlocacao
                        WHERE imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria AND tipo_venda = 1";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
                 
                  $valor_parcelas           = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
                  $situacao             = $buscar_amigo["situacao"];
                 

           
                $inadi_loc_total = $inadi_loc_total + 1;
             
             return $inadi_loc_total;
}
}

function inadi_venda_total(){
    include_once "conexao.php";
       $query_amigo = "SELECT * FROM parcelas 
                        INNER JOIN venda_imovel ON parcelas.venda_idvenda = venda_imovel.idvenda_imovel
                        WHERE imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria AND tipo_venda = 3";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
                 
                  $valor_parcelas           = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
                  $situacao             = $buscar_amigo["situacao"];
                 

             

         
                $inadi_venda_total = $inadi_venda_total + 1;
             
             return $inadi_venda_total;
}
}
?>