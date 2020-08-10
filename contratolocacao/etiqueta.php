<?php  ob_start(); 
//error_reporting(0);
//ni_set(“display_errors”, 0 ); 
set_time_limit(0);
ini_set("upload_max_filesize", "10M");
ini_set("max_execution_time", "800");
ini_set("memory_limit", "-1");
ini_set("realpath_cache_ttl", "120");

function retorna_dados_cliente($id, $idvenda, $tipo_venda){

	if($tipo_venda == 2)
	{
		$inner = 'INNER JOIN venda ON venda.idvenda = parcelas.venda_idvenda
		INNER JOIN lote ON venda.lote_idlote = lote.idlote
		INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
		INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
		INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
		$tabela_inner = 'venda.cliente_idcliente';
		$juros_hr = '0200';

	}
	if($tipo_venda == 3)
	{
		$inner = 'INNER JOIN contrato_pagar ON contrato_pagar.idcontrato_pagar = parcelas.venda_idvenda

		INNER JOIN empreendimento ON contrato_pagar.empreendimento_id = empreendimento.idempreendimento 
		INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
		$tabela_inner = 'contrato_pagar.fornecedor_idfornecedor';
		$juros_hr  = '0200';
	}
	if($tipo_venda == 1)
	{
		$inner = 'INNER JOIN locacao ON locacao.idlocacao = parcelas.venda_idvenda INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel';
		$tabela_inner = 'locacao.cliente_idcliente';
		$juros_hr = '1000';
	}
	if($tipo_venda == 4)
	{
		$inner = 'INNER JOIN contrato_receber ON contrato_receber.idcontrato_receber = parcelas.venda_idvenda

		INNER JOIN empreendimento ON contrato_receber.empreendimento_id = empreendimento.idempreendimento 
		INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';

		$tabela_inner = 'contrato_receber.cliente_idcliente';
		$juros_hr  = '0200';
	}

	$wes_hoje = date('dmy');
	include "../conexao.php";

	$query_amigo323 = "SELECT * FROM parcelas ".$inner."  
	INNER JOIN cliente ON ".$tabela_inner." = cliente.idcliente
	WHERE idparcelas = $id";

	$executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar dados cliente");

    while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
    	$idcliente                  = $buscar_amigo323['idcliente'];
    	$nome_cli                   = $buscar_amigo323['nome_cli'];
    	$descricao_empreendimento   = $buscar_amigo323['descricao_empreendimento'];
    	$quadra                     = $buscar_amigo323['quadra'];
    	$lote                       = $buscar_amigo323['lote'];

    	if($tipo_venda == 1){
    		$endereco      = $buscar_amigo323['endereco'];
    		$numero        = $buscar_amigo323['numero'];
    		$cep           = $buscar_amigo323['cep'];
    	}
    }

    $dados['nome_cli']                 = $nome_cli;
    $dados['descricao_empreendimento'] = $descricao_empreendimento;
    $dados['quadra']                   = $quadra;
    $dados['lote']                     = $lote;
    $dados['idcliente']                = $idcliente;

    if($tipo_venda == 1){
    	$dados['endereco']                 = $endereco;
    	$dados['numero']                   = $numero;
    	$dados['cep']                      = $cep;
    }


    return $dados;
}

function dados_locacao($locacao_id){
	include "../conexao.php";
	$query_amigo = "SELECT * FROM locacao 
	INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel                    
	WHERE idlocacao = $locacao_id";                           
	$executa_query = mysqli_query ($db,$query_amigo);                
	while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
		$endereco   = $buscar_amigo['endereco'];
	  	$numero     = $buscar_amigo['numero'];
	  	$cep        = $buscar_amigo['cep'];

	}

	$exibir = $endereco.", ".$numero." Cep: ".$cep;

	return $exibir;
}

function dados_empreendimento($empreendimento_id){
	include "../conexao.php";
	$query_amigo = "SELECT * FROM empreendimento_cadastro                           
	WHERE idempreendimento_cadastro = $empreendimento_id";                           
	$executa_query = mysqli_query ($db,$query_amigo);                
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
    	$descricao_empreendimento   = $buscar_amigo['descricao_empreendimento'];
    }

    return $descricao_empreendimento;
}

function fotologo($empreendimento_id){
	include "../conexao.php";
	$query_amigo = "SELECT * FROM empreendimento_cadastro                           
	WHERE idempreendimento_cadastro = $empreendimento_id";                           
	$executa_query = mysqli_query ($db,$query_amigo);                
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
    	$img   = $buscar_amigo['img_lote'];
    }

    return $img;
}

function dados_quadra($quadra_id){
	include "../conexao.php";
	$query_amigo = "SELECT * FROM produto                           
	WHERE idproduto = $quadra_id";                           
	$executa_query = mysqli_query ($db,$query_amigo);                
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
    	$quadra   = $buscar_amigo['quadra'];
    }

    return $quadra;
}

function dados_lote($lote_id){
	include "../conexao.php";
	$query_amigo = "SELECT * FROM lote                           
	WHERE idlote = $lote_id";                           
	$executa_query = mysqli_query ($db,$query_amigo);                
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
    	$lote   = $buscar_amigo['lote'];
    }

    return $lote;
}

function nome_user($id){
	include "../conexao.php";
	$query_igpm = "SELECT nome_cli FROM cliente where idcliente = $id";

	$executa_igpm = mysqli_query ($db, $query_igpm);

    while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos

    	$nome_cli             = $buscar_amigoc['nome_cli'];
    }
    return $nome_cli;
} 

function cpf_user($id){
	include "../conexao.php";
	$query_igpm = "SELECT cpf_cli FROM cliente where idcliente = $id";

	$executa_igpm = mysqli_query ($db, $query_igpm);

    while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos

    	$cpf_cli             = $buscar_amigoc['cpf_cli'];
    }
    return $cpf_cli;
} 

function converterdata($dateSql){
	$ano= substr($dateSql, 6);
	$mes= substr($dateSql, 3,-5);
	$dia= substr($dateSql, 0,-8);
	return $ano."-".$mes."-".$dia;
}

function forma_pagamento($id){
	include "../conexao.php";
	$query_amigo = "SELECT * FROM forma_pagamento where idforma_pagamento = $id";
	$executa_query = mysqli_query ($db,$query_amigo);

	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
	{
		$descricao           = $buscar_amigo["descricao"];
	}
	return $descricao;
}


function retorna_dados_cliente($id, $idvenda){
	/*
	if($tipo_venda == 2)
	{
		$inner = 'INNER JOIN venda ON venda.idvenda = parcelas.venda_idvenda
		INNER JOIN lote ON venda.lote_idlote = lote.idlote
		INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
		INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
		INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
		$tabela_inner = 'venda.cliente_idcliente';
		$juros_hr = '0200';

	}
	if($tipo_venda == 3)
	{
		$inner = 'INNER JOIN contrato_pagar ON contrato_pagar.idcontrato_pagar = parcelas.venda_idvenda

		INNER JOIN empreendimento ON contrato_pagar.empreendimento_id = empreendimento.idempreendimento 
		INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
		$tabela_inner = 'contrato_pagar.fornecedor_idfornecedor';
		$juros_hr  = '0200';
	}
	if($tipo_venda == 1)
	{
		$inner = 'INNER JOIN locacao ON locacao.idlocacao = parcelas.venda_idvenda INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel';
		$tabela_inner = 'locacao.cliente_idcliente';
		$juros_hr = '1000';
	}
	if($tipo_venda == 4)
	{
		$inner = 'INNER JOIN contrato_receber ON contrato_receber.idcontrato_receber = parcelas.venda_idvenda

		INNER JOIN empreendimento ON contrato_receber.empreendimento_id = empreendimento.idempreendimento 
		INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';

		$tabela_inner = 'contrato_receber.cliente_idcliente';
		$juros_hr  = '0200';
	}*/

	$wes_hoje = date('dmy');
	include "../conexao.php";

	$query_amigo323 = "SELECT * FROM cliente WHERE cliente.idcliente = $id";

	$executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar dados cliente");

    while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
    	$idcliente                  = $buscar_amigo323['idcliente'];
    	$nome_cli                   = $buscar_amigo323['nome_cli'];
    	$cidade_cli 				= $buscar_amigo323['cidade_cli'];
    	$numero_cli					= $buscar_amigo323['numero_cli'];
    	$endereco_cli				= $buscar_amigo323['endereco_cli'];
    	$bairro_cli 				= $buscar_amigo323['bairro_cli'];
    	$cep_cli					= $buscar_amigo323['cep_cli'];
    }

    $dados['nome_cli']                 = $nome_cli;
    $dados['cidade_cli'] 			   = $cidade_cli;
    $dados['numero_cli']               = $numero_cli;
    $dados['endereco_cli']             = $endereco_cli;
    $dados['bairro_cli']               = $bairro_cli;
    $dados['cep_cli']              	   = $cep_cli;

    return $dados;
}

function geraTimestamp($data) {
	$partes = explode('-', $data);
	$tratada = $partes[2].'-'.$partes[1].'-'.$partes[0];
	return $tratada;
}

date_default_timezone_set('America/Sao_Paulo');               
$horario_relatorio = date('d-m-Y H:i:s');

$data_venda = date("d-m-Y");
$arrayData = explode("-",$data_venda);

// Imprimindo os dados:
$dia = $arrayData[0];
$mes = intval($arrayData[1]);
$ano = $arrayData[2];


$dia_hoje = $dia;
$ano_hoje = $ano;

$hoje = getdate();

$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 0 => "Outubro", 11 => "Novembro", 12 => "Dezembro");


$nome_mes = $meses[$mes];



$idempreendimento = $_GET["empreendimento_id"];
$quadra         = $_GET["idquadra"];
$lote           = $_GET["lote"];

$status_venda   = $_GET["status_venda"];

$imobiliaria_id = $_GET["imobiliaria_id"];
$corretor_id    = $_GET["corretor_id"];

$inicio                   = $_GET["inicio"];
$fim                      = $_GET["fim"];


$where = 'idvenda > 0';





if($status_venda != 'Todos' AND $status_venda != ''){
	$where .= " AND status_venda =".$status_venda;
}

if(($imobiliaria_id != 'Todos' AND $imobiliaria_id != '') AND ($corretor_id == 0 AND $corretor_id == '')){
	$where .= " AND (imob.imob_id =".$imobiliaria_id." or imob.idcliente =".$imobiliaria_id.")";
} 

if(($imobiliaria_id != 'Todos' AND $imobiliaria_id != '')AND ($corretor_id != 0 and $corretor_id != '')){
	$where .= " AND  vnd.imobiliaria_idimobiliaria =".$corretor_id;
}

if($quadra != '' AND $quadra != 0){
	$where .= " AND vnd.produto_idproduto = '$quadra'";
}

if($lote != '' AND $lote != 0){
	$where .= " AND vnd.lote_idlote = '$lote'";
}

if($inicio != '' AND $fim != ''){
	$where .=" AND STR_TO_DATE(data_venda, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";

}

if($status_venda != 'Todos'){

	if($status_venda == 0){
		$exibir_status = 'Proposta em Análise';
	}elseif($status_venda == 1){
		$exibir_status = 'Proposta Recusada';
	}elseif($status_venda == 2){
		$exibir_status = 'Proposta Aprovada';
	}elseif($status_venda == 3){
		$exibir_status = 'Contrato Ativo';
	}else{
		$exibir_status ='Contrato Concluido';
	}

}

if($inicio != '' and $inicio != 0 and $inicio != 'Todos'){
	$rel_inicio = date("d-m-Y", strtotime($inicio));
	$rel_fim    = date("d-m-Y", strtotime($fim));
	$rel_periodo = "$rel_inicio"." até ".$rel_fim;
}else{
	$rel_periodo = '';
}


$rel_empreendimento = dados_empreendimento($idempreendimento);
$logo = fotologo($idempreendimento);
$rel_quadra = dados_quadra($quadra);
$rel_lote   = dados_lote($lote);

$rel_imobiliaria = nome_user($imobiliaria_id);
$rel_corretor    = nome_user($corretor_id);

//require_once("dompdf/dompdf_config.inc.php");

/* Cria a instância */
//$dompdf = new DOMPDF();



$html = "<table style='width:100%' border='0'>
<tr>
<td colspan='2'><img src='../img/$idempreendimento/$logo' height='110' /></td>
<td colspan='2' style='text-align: center'>Caldas Novas, $dia_hoje de $nome_mes de $ano_hoje</td>
</tr>
<tr>
<td colspan='4' style='text-align: center; font-weight: bold;'>RELATÓRIO DE VENDAS</td>
</tr>

<tr>
<td colspan='3'><span style='font-weight: bold'>Empreendimento</span>: $rel_empreendimento</td>
<td><span style='font-weight: bold'>Q:</span> $rel_quadra / <span style='font-weight: bold'>L:</span> $rel_lote</td>
</tr>
<tr>
<td colspan='2'><span style='font-weight: bold'>Status</span>: $exibir_status </td>
<td><span style='font-weight: bold'>Imobiliaria:</span> $rel_imobiliaria</td>
<td><span style='font-weight: bold'>Corretor:</span>: $rel_corretor </td>
</tr>
<tr>
<td colspan='2'><span style='font-weight: bold'>Periodo</span>: $rel_periodo</td>
</tr>
</table>";


$html .="<table style='width:100%; font-size:10px;' height='127' border='0'>

<tr bgcolor='#b8b8b8'>
<td style='text-align: center'><strong>Nº Ficha</strong></td>
<td style='text-align: center'><strong>Imobiliaria</strong></td>
<td style='text-align: center'><strong>Cliente</strong></td>
<td style='text-align: center'><strong>Data Venda</strong></td>
<td style='text-align: center'><strong>Q/L</strong></td>

<td style='text-align: center'><strong>Valor Venda</strong></td>
<td style='text-align: center'><strong>Sinal</strong></td>
<td style='text-align: center'><strong>Entrada</strong></td>      
<td style='text-align: center'><strong>Qtd Entrada</strong></td>
<td style='text-align: center'><strong>Parcela Entrada</strong></td>

<td style='text-align: center'><strong>Saldo Devedor</strong></td>
<td style='text-align: center'><strong>Qtd Parcelas</strong></td>
<td style='text-align: center'><strong>Parcela Financiamento</strong></td>
<td style='text-align: center'><strong>1º Vencimento</strong></td>
<td style='text-align: center'><strong>Restantes</strong></td>
<td style='text-align: center'><strong>Taxa %</strong></td>

</tr>";

$inicio  = converterdata($inicio);
$fim     = converterdata($fim);


include "../conexao.php";
$query_amigo = "SELECT vnd.valor_desconto, vnd.valor_entrada, vnd.vencimento_primeira, vnd.valor_para_parcelamento, vnd.plano_pagamento, vnd.taxa_financiamento, vnd.parcela_entrada, vnd.vencimento_restante, vnd.entrada_restante, vnd.valor_parcela_financiamento, vnd.valor_parcela_entrada, vnd.imobiliaria_idimobiliaria, imob.idcliente as imobid, cli.nome_cli as nomecliente, cliente_idcliente,idvenda, idlote, lote, quadra, libera_proposta, status_venda, data_venda, vnd.produto_idproduto, vnd.lote_idlote FROM venda vnd
INNER JOIN cliente imob ON vnd.imobiliaria_idimobiliaria = imob.idcliente
INNER JOIN cliente cli  ON vnd.cliente_idcliente = cli.idcliente
INNER JOIN lote    ON vnd.lote_idlote = lote.idlote 
INNER JOIN produto ON produto.idproduto = lote.produto_idproduto 
INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
WHERE empreendimento_cadastro_id = $idempreendimento  AND $where
order by idvenda desc";

            //   echo $query_amigo; die();

$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");

$dados = array();

while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	$idcliente        = $buscar_amigo['idcliente'];
	$idvenda          = $buscar_amigo["idvenda"];
	$idlote           = $buscar_amigo["idlote"];
	$nome_cli         = $buscar_amigo["nomecliente"];
	$lote             = $buscar_amigo["lote"];
	$quadra           = $buscar_amigo["quadra"];
	$idvenda_imob2    = $buscar_amigo["imobid"];
	$cliente_alterei  = $buscar_amigo["cliente_idcliente"];

	$nome_imob_v = nome_user($idvenda_imob2);
	$imobiliaria = nome_user($cliente_alterei); 
	$cpf = cpf_user($cliente_alterei);

	$cliente = retorna_dados_cliente($cliente_alterei, $idvenda);

	$dado = null;
	$dado[] = $cliente['nome_cli']; 
	$dado[] = $cliente['cidade_cli']; 
	$dado[] = $cliente['bairro_cli']; 
	$dado[] = $cliente['cep_cli']; 
	$dado[] = $cliente['endereco_cli'];
	$dado[] = $lote;
	$dado[] = $quadra;

	$dados[] = $dado;
}

//header('Location: http://etiquetas.ibsystem.com.br/etiqueta/etiqueta.php?ok='.$dados.'');
//die();

//print_r(scandir("../../etiquetas.ibsystem.com.br/etiqueta/"));

//die();

/*


$html .="</table>";


$dompdf->load_html($html);
  $dompdf->set_paper("A4","landscape");
  ob_clean();

  $pdf = $dompdf->render();
  $canvas = $dompdf->get_canvas(); 
  $font = Font_Metrics::get_font("helvetica", "bold"); 
  $canvas->page_text(510, 18, "", $font, 6, array(0,0,0)); 
  $canvas->page_text(270, 792, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); 
  header("Content-type: application/pdf");     
 
 
$dompdf->stream(
    "saida.pdf", 
    array(
        "Attachment" => false 
    )
);



*/

?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
</head>
<body>
	<button>
		alindo
	</button>

	<script type="text/javascript">
		$(document).ready(function(){
			var dados = [];
			var dado = [];

			<?php 
				foreach ($dados as $key => $value) {
					foreach ($value as $chave => $valor) {
						?>
							dado.push('<?php echo $valor; ?>');
						<?php
					}
					?>
						dados.push(dado);
						dado = [];
					<?php
				}
			?>
			console.log(dados);

			$('button').on('click', function(){
				$.ajax({  
					url:'https://etiquetas.ibsystem.com.br/etiqueta/etiqueta.php',  
					method:'POST', 
					data: {dados},
					success: dados => 	
					{  
						alert('ok');
					},
					error: erro => {console.log(1)}  
				});
			});
			
		});
	</script>
</body>
</html>
