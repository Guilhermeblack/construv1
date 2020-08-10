<?php 

 function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
} 


// Total de Contratos de Venda de Imovel  /////
function venda_total(){
    include "conexao.php";
    $query_amigo = "SELECT * FROM venda_imovel";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}

// Total de contratos de Empreendimentos em geral ////
function empreendimento_total(){
    include "conexao.php";
    $query_amigo = "SELECT * FROM venda";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}


// Total de Contratos de locação de imovel ////
function locacao_total(){
    include "conexao.php";
    $query_amigo = "SELECT * FROM locacao";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}

// total de Imoveis a venda no site ///
function imoveis_venda(){
    include "conexao.php";
    $query_amigo = "SELECT * FROM imovel where finalidade = 'Venda'";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}


// total de Imoveis para Locação  no site ///
function imoveis_locacao(){
    include "conexao.php";
    $query_amigo = "SELECT * FROM imovel where finalidade = 'Aluguel'";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}


// total de Empreendimentos cadastrados no sistema ///
function empreendimentos_sistema(){
    include "conexao.php";
    $query_amigo = "SELECT * FROM empreendimento";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}


function novos_contatos_site(){
    include "conexao.php";
    $query_amigo = "SELECT * FROM contatos WHERE visto = ''";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}

function contatos_site(){
    include "conexao.php";
    $query_amigo = "SELECT * FROM contatos";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}

function total_apagar(){

    date_default_timezone_set('America/Sao_Paulo');

    $mes_atual = date('Y-m');

    $inicio = $mes_atual.'-01';
    $fim    = $mes_atual.'-31';

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";

    include "conexao.php";
    $query_amigo = "SELECT SUM(valor_parcelas) as total FROM parcelas
                    WHERE fluxo = 1 AND situacao = 'Em Aberto' $where";
    $executa_query = mysqli_query($db, $query_amigo);

     while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }



    return $total;
}

function total_receber(){

    date_default_timezone_set('America/Sao_Paulo');

    $mes_atual = date('Y-m');

    $inicio = $mes_atual.'-01';
    $fim    = $mes_atual.'-31';

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";

    include "conexao.php";
    $query_amigo = "SELECT SUM(valor_parcelas) as total FROM parcelas
                    WHERE fluxo = 0 AND situacao = 'Em Aberto' $where";
    $executa_query = mysqli_query($db, $query_amigo);

     while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }



    return $total;
}


function troca_placa($idimovel){

    include "conexao.php";
    $hoje = date('Y-m-d');
     $query_igpm = "SELECT * FROM placa_imovel
                    INNER JOIN imovel ON placa_imovel.imovel_idimovel = imovel.idimovel
                    WHERE imovel_idimovel = $idimovel order by idplaca_imovel desc limit 1";

                $executa_igpm = mysqli_query ($db,$query_igpm) or die ("Erro ao listar troca de placa");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $idimovel           = $buscar_amigoc['idimovel'];
            $endereco           = $buscar_amigoc['endereco'];
            $numero             = $buscar_amigoc['numero'];
            $cidade_idcidade    = $buscar_amigoc['cidade_idcidade'];
            $estado             = $buscar_amigoc['estado'];
            $data_placa         = $buscar_amigoc["data_placa"];

            $data_placa         = converterdata($data_placa);

            $time_inicial       = strtotime($hoje);
            $time_final         = strtotime($data_placa);

        
            $diferenca = $time_inicial - $time_final;

            $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

            
            if($dias >= 30){ 

           $dados = 1;
         }
}
return $data_placa;

}





function imoveis_c_placa(){
    include "conexao.php";
    $hoje = date('Y-m-d');
     $query_igpm = "SELECT count(idplaca_imovel) as total FROM placa_imovel
                    group by imovel_idimovel";

                $executa_igpm = mysqli_query ($db,$query_igpm) or die ("Erro ao listar troca de placa");
                
                $num_rows = mysqli_num_rows($executa_igpm);


return $num_rows;

}





function inadimplencia_total(){
        
 
  return "4";

}






function lotes_por_empreendimento($id){



    include "conexao.php";
       $query_amigo = "SELECT * FROM lote
                       INNER JOIN produto ON lote.produto_idproduto = produto.idproduto
                       where empreendimento_idempreendimento = $id";

                $executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
     $total = mysqli_num_rows($executa_query);

    return $total;


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




function contrato_ativo_loc($venda_id){
    include "conexao.php";
    $query_igpm = "SELECT COUNT(idparcelas) as total 
                    from parcelas 
                    where venda_idvenda = $venda_id 
                    and tipo_venda = 1 
                    AND fluxo = 0 
                    and situacao = 'Em Aberto'";


    $executa_igpm = mysqli_query ($db, $query_igpm);
    while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $total             = $buscar_amigoc['total'];
}
return $total;

} 



function somar_visitas(){
      $hoje = date('Y-m-d');

                include "conexao.php";
                $query_igpm = "SELECT COUNT(idreserva) as total  FROM reserva
                               INNER JOIN imovel ON reserva.imovel_idimovel = imovel.idimovel                           
                               WHERE status_reserva != '1'";

                $executa_igpm = mysqli_query ($db,$query_igpm) or die ("Erro ao listar imoveis em visita");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $total           = $buscar_amigoc['total'];
           

            }

            return $total;
}


function somar_exclusividade(){

    $hoje = date('Y-m-d');
        include "conexao.php";
        $query_igpm = "SELECT * FROM imovel where exclusividade = '1'";
                $executa_igpm = mysqli_query ($db,$query_igpm);
                
            $cont = 0;   
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $idimovel           = $buscar_amigoc['idimovel'];
            $endereco           = $buscar_amigoc['endereco'];
            $numero             = $buscar_amigoc['numero'];
            $cidade_idcidade    = $buscar_amigoc['cidade_idcidade'];
            $estado             = $buscar_amigoc['estado'];
            $data_exclusividade = $buscar_amigoc["data_exclusividade"];
            $img_principal      = $buscar_amigoc['img_principal'];
            $data_exclusividade = converterdata($data_exclusividade);

            $time_inicial       = strtotime($hoje);
            $time_final         = strtotime($data_exclusividade);

        
            $diferenca = $time_final - $time_inicial;

            $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

                    if($dias <= 10){  
                        $cont = $cont + 1;
                    }
            }
            return $cont;
}



function somar_placaimovel(){
    $hoje = date('Y-m-d');
                          include "conexao.php";
                $query_igpm = "SELECT * FROM placa_imovel
                                INNER JOIN imovel ON placa_imovel.imovel_idimovel = imovel.idimovel";

                $executa_igpm = mysqli_query ($db,$query_igpm);
                
                $cont = 0;
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $idimovel           = $buscar_amigoc['idimovel'];
            $endereco           = $buscar_amigoc['endereco'];
            $numero             = $buscar_amigoc['numero'];
            $cidade_idcidade    = $buscar_amigoc['cidade_idcidade'];
            $estado             = $buscar_amigoc['estado'];
          

            $data_placa         = troca_placa($idimovel);
          
            $time_inicial       = strtotime($hoje);
            $time_final         = strtotime($data_placa);

        
            $diferenca = $time_inicial - $time_final;

            $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

            
            if($dias >= 30){ 
                $cont = $cont + 1;
            }
        }
        return $cont;
}


function somar_vencimento_loc(){
        include "conexao.php";
        /// Aviso de vencimento de Contrato
                $query_igpm = "SELECT * FROM locacao";
                $executa_igpm = mysqli_query ($db,$query_igpm);
                
             $cont = 0;   
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $idimovel          = $buscar_amigoc['imovel_idimovel'];
            $idlocacao         = $buscar_amigoc['idlocacao'];
            $endereco           = $buscar_amigoc['endereco'];
            $numero             = $buscar_amigoc['numero'];
            $cidade_idcidade    = $buscar_amigoc['cidade_idcidade'];
            $estado             = $buscar_amigoc['estado'];
            $img_principal      = $buscar_amigoc['img_principal'];            
            $primeira_parcela   = $buscar_amigoc['primeira_parcela'];
            $prazo_contrato     = $buscar_amigoc['prazo_contrato'];

            $contrato_ativo_loc = contrato_ativo_loc($idlocacao);

            
                    if($contrato_ativo_loc == 1){   
                        $cont = $cont + 1;
                    }
            }
            return $cont;
}

function somar_proposta_vendas(){
        include "conexao.php";
        $total = 0;
        $query_amigo = "SELECT COUNT(*) as total FROM venda
                                INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente
                                INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                                INNER JOIN lote ON venda.lote_idlote = lote.idlote 
                                INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                                INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                                WHERE status_venda = 0";

                    $executa_query = mysqli_query ($db,$query_amigo);

        if($buscar_amigo = mysqli_fetch_assoc($executa_query)){
                    $total = $buscar_amigo['total'];

        
                    return $total;
        
        }else{
                   
                    return $total;
        
        }

}








function somar_vencimento_emp(){
    include "conexao.php";
     /// Aviso de vencimento de Contrato
                $query_igpm = "SELECT * FROM venda
                               INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente
                               INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                               INNER JOIN lote ON venda.lote_idlote = lote.idlote 
                               INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                               INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro";

            $executa_igpm = mysqli_query ($db,$query_igpm);
                
            $cont = 0;   
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $idvenda            = $buscar_amigoc['idvenda'];
            $nome_cli           = $buscar_amigoc['nome_cli'];
            $quadra             = $buscar_amigoc['quadra'];
            $lote               = $buscar_amigoc['lote'];
            $descricao_empreendimento             = $buscar_amigoc['descricao_empreendimento'];
          

            $contrato_ativo = contrato_ativo($idvenda);

            
                            if($contrato_ativo == 1){  

                             $cont = $cont + 1;
                             } 
            }

            return $cont;

}

function somar_geral(){

    $somar_placaimovel      = somar_placaimovel();
    $somar_exclusividade    = somar_exclusividade();
    $somar_visitas          = somar_visitas();
    $somar_vencimento_loc   = somar_vencimento_loc();
    $somar_vencimento_emp   = somar_vencimento_emp();
    $somar_proposta_vendas  = somar_proposta_vendas();
    
    //$somar_vencimento_emp = 0;
    //$somar_vencimento_loc = 0;


    $total_geral = $somar_placaimovel + $somar_exclusividade + $somar_visitas + $somar_vencimento_loc + $somar_vencimento_emp + $somar_proposta_vendas;

    return $total_geral;
}


function total_ocorrencia(){
      include "conexao.php";
            $query_amigo = "SELECT COUNT(idocorrencia) as total FROM ocorrencia WHERE status_ocorrencia = '1' or status_ocorrencia = '2' or status_ocorrencia = 3";
            $executa_query = mysqli_query ($db,$query_amigo);
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $total       = $buscar_amigo['total'];

        }

        if($total == ''){
            $total = 0;
        }
        return $total;
}



function lotes($empreendimento_id){
    include "conexao.php";
    $query_amigo = "SELECT COUNT(idlote) as total from lote
                    INNER JOIN produto ON lote.produto_idproduto = produto.idproduto
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento                  
                    WHERE empreendimento_cadastro_id = $empreendimento_id";
    $executa_query = mysqli_query($db, $query_amigo);

  while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }
    return $total;
}

function contratos($empreendimento_id){
    include "conexao.php";
    // $query_amigo = "SELECT COUNT(idvenda) as total from venda
    //                 INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
    //                 INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento                  
    //                 WHERE empreendimento_cadastro_id = $empreendimento_id";


    $query_amigo = " SELECT COUNT(idvenda) as total  FROM venda vnd INNER JOIN cliente imob ON vnd.imobiliaria_idimobiliaria = imob.idcliente INNER JOIN cliente cli ON vnd.cliente_idcliente = cli.idcliente INNER JOIN lote ON vnd.lote_idlote = lote.idlote INNER JOIN produto ON produto.idproduto = lote.produto_idproduto WHERE empreendimento_idempreendimento = $empreendimento_id and status_venda != 1 AND idvenda > 0 ";


    $executa_query = mysqli_query($db, $query_amigo);

  while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }
    return $total;
}



function lotes_disponiveis($empreendimento_id){
    include "conexao.php";
    $query_amigo = "SELECT COUNT(idlote) as total from lote
                    INNER JOIN produto ON lote.produto_idproduto = produto.idproduto
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento                  
                    WHERE empreendimento_cadastro_id = $empreendimento_id AND status = 1";
    $executa_query = mysqli_query($db, $query_amigo);

  while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }
    return $total;
}

function lotes_reservados($empreendimento_id){
    include "conexao.php";
    $query_amigo = "SELECT COUNT(idlote) as total from lote
                    INNER JOIN produto ON lote.produto_idproduto = produto.idproduto
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento                  
                    WHERE empreendimento_cadastro_id = $empreendimento_id AND status = 0";
    $executa_query = mysqli_query($db, $query_amigo);

  while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }
    return $total;
}



function inadi_juridico_2($empreendimento_id){

   date_default_timezone_set('America/Sao_Paulo');

    $hoje = date('Y-m-d');
    $inicio = '1900-01-01';

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' group by cliente_id_novo";

    include "conexao.php";
$cont = 0;
   $query_amigo = "SELECT COUNT(idparcelas) as total FROM parcelas                         
                   where  situacao = 'Em Aberto' AND empreendimento_id_novo = $empreendimento_id AND fluxo = 0 $where";

                   $executa_query = mysqli_query ($db,$query_amigo);
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $total            = $buscar_amigo["total"];

                   if($total >= 3){
                    $cont = $cont + 1;
                   }
                  
                  }
            


return $cont;
}



function valor_inadi_juridico_2($empreendimento_id){

   date_default_timezone_set('America/Sao_Paulo');

    $hoje   = date('Y-m-d');
    $inicio = date('Y-m-d',strtotime($hoje . "-10000 days"));

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' ";

    include "conexao.php";

   $query_amigo = "SELECT SUM(valor_parcelas) as total FROM parcelas                         
                   where empreendimento_id_novo = $empreendimento_id AND tipo_venda = 2 AND situacao = 'Em Aberto' AND fluxo = 0 $where";

                   $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $total            = $buscar_amigo["total"];
                  
                  }
            


return $total;
}

function inadi_normal($empreendimento_id){

   date_default_timezone_set('America/Sao_Paulo');

    $hoje = date('Y-m-d');
    $inicio = '1900-01-01';

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' group by cliente_id_novo";

    include "conexao.php";
$cont = 0;
   $query_amigo = "SELECT COUNT(idparcelas) as total FROM parcelas                         
                   where  situacao = 'Em Aberto' AND empreendimento_id_novo = $empreendimento_id AND fluxo = 0 $where";

                   $executa_query = mysqli_query ($db,$query_amigo);
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $total            = $buscar_amigo["total"];

                   if($total >= 1){
                    $cont = $cont + 1;
                   }
                  
                  }
            


return $cont;
}


?>