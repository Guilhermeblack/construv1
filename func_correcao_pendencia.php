<?php
error_reporting(0);
ini_set(“display_errors”, 0 );    
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
 function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
} 
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


$total =  somar_geral();

$dados['TOTALPENDENCIA'] = (string) $total;
echo json_encode($dados);

?>