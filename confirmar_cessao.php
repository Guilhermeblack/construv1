	<?php 
  	 function cod_cessao($idvenda, $idtitular)
{


    include "conexao.php";
       $query_amigo = "SELECT cod_cessao from proprietarios_lote WHERE venda_id = $idvenda AND cliente_id = $idtitular";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar dados contrato");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $cod_cessao           = $buscar_amigo["cod_cessao"];                 
                                     
            }
    	

    return $cod_cessao;

}






  	include "conexao.php";
    $venda_id          = $_GET["venda_id"];
    $empreendimento_id = $_GET["empreendimento_id"];
    $estornado_por     = $_GET["estornado_por"];



     $query_busca_cessao = "SELECT * FROM cessao
                      WHERE  venda_id= $venda_id AND status = 0 order by idcessao Asc limit 1";        
                $executa_cessao = mysqli_query ($db,$query_busca_cessao);                
                
                while ($buscar_quant = mysqli_fetch_assoc($executa_cessao)) {//--verifica se são amigos
                                  
                      $idcessao                 = $buscar_quant["idcessao"];
                      $antigo_titular           = $buscar_quant["antigo_titular"];
                      $novo_titular             = $buscar_quant["novo_titular"];
	}

    $cod_cessao = cod_cessao($venda_id, $antigo_titular);


	/// Cancela as parcelas do contrato que estão em aberto.
	$cancela_parcelas = "UPDATE parcelas SET cliente_id_novo = '$novo_titular'
	WHERE venda_idvenda = $venda_id AND tipo_venda = 2 AND fluxo = 0 AND situacao = 'Em Aberto'";

	$executa_cancelar = mysqli_query($db, $cancela_parcelas);


	/// Atualiza nome  no contrato
	$atualiza_contrato = "UPDATE venda SET cliente_idcliente = $novo_titular
	WHERE idvenda = $venda_id";

	$executa_atualiza = mysqli_query($db, $atualiza_contrato);


		/// Atualiza cessão anterior
	$atualiza_cessao_ant = "UPDATE proprietarios_lote SET situacao_cessao = '' WHERE cod_cessao = '$cod_cessao'";

	$executa_atualiza_cessao_ant = mysqli_query($db, $atualiza_cessao_ant);



	// Insere o novo titular na tabela
	$insere_proprietarios = mysqli_query($db, "INSERT INTO proprietarios_lote (venda_id, cliente_id, percentual, cod_cessao, situacao_cessao) values('$venda_id', '$novo_titular', '100', '$cod_cessao', '1')");







//busca as parcelas e depois grava ela novamente para alterar o idparcelas / nosso numero para gerar novo boleto com numero diferente
				$query_parcela = "SELECT * FROM parcelas
                				WHERE venda_idvenda = $venda_id and tipo_venda = 2 and fluxo = 0 and situacao = 'Em Aberto'";
                

                $executa_parcela = mysqli_query ($db,$query_parcela);
                while ($buscar_parcela = mysqli_fetch_assoc($executa_parcela)) {//--verifica se são amigos
           
             	$idparcelas             	= $buscar_parcela['idparcelas'];
             	$valor_parcelas             = $buscar_parcela["valor_parcelas"];
              	$data_vencimento_parcela    = $buscar_parcela["data_vencimento_parcela"];
              	$descricao              	= $buscar_parcela["descricao"];
              	$centrocusto_id             = $buscar_parcela["centrocusto_id"];
              	$cliente_id_novo            = $buscar_parcela["cliente_id_novo"];
              	$empreendimento_id_novo     = $buscar_parcela["empreendimento_id_novo"];
              	$numero_sequencia           = $buscar_parcela["numero_sequencia"];


              	$insere_nova = mysqli_query($db, "INSERT INTO parcelas (venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
fluxo,
cliente_id_novo,
empreendimento_id_novo,
centrocusto_id,
numero_sequencia) values (
'$venda_id',
'$valor_parcelas',
'$data_vencimento_parcela',
'Em Aberto',
'$descricao',
'2',
'0',
'$cliente_id_novo',
'$empreendimento_id_novo',
'1',
'$numero_sequencia'

)");

              $deleta_parcela = mysqli_query($db, "DELETE FROM parcelas where idparcelas = '$idparcelas'");
}


	$atualiza_tabcessao = "UPDATE cessao SET status = '2' WHERE idcessao = '$idcessao'";

	$executa_tabcessao  = mysqli_query($db, $atualiza_tabcessao);

    ?>
    
    <script type="text/javascript">
  window.location="empreendimentos.php";
</script>