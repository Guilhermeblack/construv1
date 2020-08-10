<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
 ?>

<?php 
$xdata_processamento = date("Y/m/d");
function valor_vinculo($vinculo){

	include "../conexao.php";
	$select_vinculo = mysqli_query($db, "SELECT SUM(valor_parcelas) as total FROM parcelas 
		                                 WHERE vinculo = '$vinculo'");

	while ($result_vinculo = mysqli_fetch_assoc($select_vinculo)) {

		$total = $result_vinculo["total"];

	}

	return $total;

}
function php_fnumber($var1){
	//return number_format($var1,2,",",'.’.');
	return number_format($var1,2, ',', '.');
}

function datasql($data1) {
	$data1 = substr($data1,0,2).'/'.substr($data1,2,2).'/'.substr($data1,4,4);
	if (!empty($data1)){
	$p_dt = explode('/',$data1);
	$data_sql = $p_dt[2].'-'.$p_dt[1].'-'.$p_dt[0];
	return $data_sql;
	}
}

function datacx_databr( $var1 ){
	// Converter uma string data brasileira em uma data brasileira com as barras
	// Entrada: DDMMAAAA / Saida: DD/MM/AAAA
	$j_dia = substr($var1,0,2);
	$j_mes = substr($var1,2,2);
	$j_ano = substr($var1,4,4);
	$j_dtf = $j_dia."/".$j_mes."/".$j_ano;
	return $j_dtf;
}

function remove_zero_esq( $var1 ){
	$tam = strlen( $var1 );
	for( $i=0; $i<$tam; $i++ ){
		if( substr( $var1, $i, 1 )	== "0" ){
			$y = substr( $var1, ($i+1), ($tam) );
		}else{
			return $y;
		}
	}
	return $y;
}





function dados_parcela_retorno($id){
    include "conexao.php";
    $query_amigo = "SELECT * FROM parcelas WHERE idparcelas = $id";
    $executa_query = mysqli_query($db, $query_amigo);

 while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
            
            $idparcelas              = $buscar_amigo["idparcelas"];
            $data_vencimento_parcela = $buscar_amigo["data_vencimento_parcela"];
            $situacao                = $buscar_amigo["situacao"];
            $cliente_id_novo         = $buscar_amigo["cliente_id_novo"];
  	    	$empreendimento_id_novo  = $buscar_amigo["empreendimento_id_novo"];
  	    	$vinculo                 = $buscar_amigo["vinculo"];

  	    	 if($vinculo != ''){

            $valor_parcelas = valor_vinculo($vinculo);

        	}else{
	    	$valor_parcelas          = $buscar_amigo["valor_parcelas"];

        	}
            

            $dados["idparcelas"]  				= $idparcelas;
            $dados["valor_parcelas"]  			= $valor_parcelas;
            $dados["data_vencimento_parcela"]   = $data_vencimento_parcela;
            $dados["situacao"]  				= $situacao;
            $dados["cliente_id_novo"]  			= $cliente_id_novo;
            $dados["empreendimento_id_novo"]  	= $empreendimento_id_novo;

        }

    return $dados;
}











function numero_usa( $var1 ){
	$tam  = strlen( $var1 );
	$ped1 = substr( $var1,0,($tam-2) );
	$ped2 = substr( $var1,-2);
	$num2 = $ped1.".".$ped2;
	if( $num2 == "." ){
		$num2 = "0.00";
	}	
	return $num2;
}

function rejeicao($v1){

	switch($v1){
	
		case '01':
			$xf = "CÓD. DO BANCO INVÁLIDO";
			break;
		
		case '02':
			$xf = "CÓDIGO DO REGISTRO DETALHE INVÁLIDO";		
			break;

		case '03':
			$xf = "CÓDIGO DO SEGMENTO INVÁLIDO";		
			break;

		case '04':
			$xf = "CÓDIGO DE MOVIMENTO NÃO PERMITIDO PARA A CARTEIRA";		
			break;

		case '05':
			$xf = "CÓDIGO DE MOVIMENTO INVÁLIDO";		
			break;

		case '06':
			$xf = "TIPO/NÚMERO DE INSCRIÇÃO DO BENEFICIÁRIO INVÁLIDO";		
			break;

		case '07':
			$xf = "AGÊNCIA/CONTA/DV INVÁLIDO";		
			break;

		case '08':
			$xf = "NOSSO NÚMERO INVÁLIDO";		
			break;

		case '09':
			$xf = "NOSSO NÚMERO DUPLICADO";		
			break;

		case '10':
			$xf = "CARTEIRA INVÁLIDA";		
			break;

		case '11':
			$xf = "FORMA DE CADASTRAMENTO DO TÍTULO INVÁLIDO";		
			break;

		case '12':
			$xf = "TIPO DE DOCUMENTO INVÁLIDO";		
			break;

		case '13':
			$xf = "IDENTIFICAÇÃO DA EMISSÃO DO BLOQUETO INVÁLIDA";		
			break;

		case '14':
			$xf = "IDENTIFICAÇÃO DA DISTRIBUIÇÃO DO BLOQUETO INVÁLIDA";		
			break;

		case '15':
			$xf = "CARACTERÍSTICAS DA COBRANÇA INCOMPATÍVEIS";		
			break;

		case '16':
			$xf = "DATA DE VENCIMENTO INVÁLIDA";		
			break;
		
		case '17':
			$xf = "DATA DE VENCIMENTO ANTERIOR A DATA DE EMISSÃO";		
			break;

		case '18':
			$xf = "VENCIMENTO FORA DO PRAZO DA OPERAÇÃO";		
			break;

		case '19':
			$xf = "TÍTULO A CARGO DE BANCOS CORRESPONDENTES COM VENCIMENTO INFERIOR A XX DIAS";		
			break;

		case '20':
			$xf = "VALOR DO TÍTULO INVÁLIDO";		
			break;

		case '21':
			$xf = "ESPÉCIE DO TÍTULO INVÁLIDA";		
			break;

		case '22':
			$xf = "ESPÉCIE DO TÍTULO NÃO PERMITIDA PARA A CARTEIRA";		
			break;

		case '23':
			$xf = "ACEITA INVÁLIDO (UTILIZAR SERVIÇO DE NEGATIVAÇÃO)";		
			break;

		case '24':
			$xf = "DATA DE EMISSÃO INVÁLIDA";		
			break;

		case '25':
			$xf = "DATA DE EMISSÃO POSTERIOR A DATA DE ENTRADA";		
			break;

		case '26':
			$xf = "CÓDIGO DE JUROS DE MORA INVÁLIDO";		
			break;

		case '27':
			$xf = "VALOR/TAXA DE JUROS DE MORA INVÁLIDO";		
			break;

		case '28':
			$xf = "CÓDIGO DO DESCONTO INVÁLIDO";		
			break;
		
		case '29':
			$xf = "VALOR DO DESCONTO MAIOR OU IGUAL AO VALOR DO TÍTULO";		
			break;

		case '30':
			$xf = "DESCONTO A CONCEDER NÃO CONFERE";
			break;

		case '31':
			$xf = "CONCESSÃO DE DESCONTO - JÁ EXISTE DESCONTO ANTERIOR";		
			break;

		case '35':
			$xf = "VALOR A CONCEDER NÃO CONFERE";		
			break;

		case '42':
			$xf = "CÓDIGO PARA BAIXA/DEVOLUÇÃO INVÁLIDO";		
			break;

		case '43':
			$xf = "PRAZO PARA BAIXA/DEVOLUÇÃO INVÁLIDO";		
			break;

		case '44':
			$xf = "CÓDIGO DE MOEDA INVÁLIDO";		
			break;

		case '45':
			$xf = "NOME DO PAGADOR NÃO INFORMADO";		
			break;

		case '46':
			$xf = "TIPO/Nº DE INSCRIÇÃO DO PAGADOR INVÁLIDOS";		
			break;

		case '47':
			$xf = "ENDEREÇO DO PAGADOR NÃO INFORMADO";		
			break;

		case '48':
			$xf = "CEP INVÁLIDO";		
			break;

		case '49':
			$xf = "CEP SEM PRAÇA DE COBRANÇA (SEM AGÊNCIA NA LOCALIDADE )";		
			break;

		case '50':
			$xf = "CEP REFERENTE A UM BANCO CORRESPONDENTE";		
			break;

		case '51':
			$xf = "CEP INCOMPATÍVEL COM A UNIDADE DA FEDERAÇÃO (SIGLA DO ESTADO)";		
			break;

		case '52':
			$xf = "UNIDADE DA FEDERAÇÃO INVÁLIDA";		
			break;

		case '57':
			$xf = "CÓDIGO DA MULTA INVÁLIDO";		
			break;

		case '58':
			$xf = "DATA DA MULTA INVÁLIDA";		
			break;

		case '59':
			$xf = "VALOR/PERCENTUAL DA MULTA INVÁLIDO";		
			break;

		case '60':
			$xf = "MOVIMENTO PARA TÍTULO NÃO CADASTRADO";		
			break;

		case '62':
			$xf = "TIPO DE IMPRESSÃO INVÁLIDA";		
			break;

		case '63':
			$xf = "ENTRADA PARA TÍTULO JÁ CADASTRADO";		
			break;

		case '64':
			$xf = "Nº DE LINHA INVÁLIDO";		
			break;

		case '72':
			$xf = "DÉBITO NÃO AGENDADO - BENEFICIÁRIO NÃO PARTICIPA DA MODALIDADE DE DÉBITO AUTOMÁTICO";		
			break;

		case '79':
			$xf = "DATA DE JUROS DE MORA INVÁLIDO";		
			break;

		case '80':
			$xf = "DATA DO DESCONTO INVÁLIDA";		
			break;

		case '86':
			$xf = "SEU NÚMERO INVÁLIDO";		
			break;

	}
	
	return( $xf );
	
}	





function motivo_liquidacao( $var1 ){

	if( $var1 == "01" ){
		$xfra = "LIQUIDAÇÃO POR SALDO";
	}elseif( $var1 == "02" ){
		$xfra = "LIQUIDAÇÃO POR CONTA";
	}elseif( $var1 == "03" ){
		$xfra = "LIQUIDAÇÃO NO GUICHÊ DE CAIXA EM DINHEIRO";
	}elseif( $var1 == "04" ){
		$xfra = "COMPENSAÇÃO ELETRÔNICA";
	}elseif( $var1 == "05" ){
		$xfra = "COMPENSAÇÃO CONVENCIONAL";
	}elseif( $var1 == "06" ){
		$xfra = "COMPENSAÇÃO POR MEIO ELETRÔNICO";
	}elseif( $var1 == "07" ){
		$xfra = "COMPENSAÇÃO APÓS FERIADO LOCAL";
	}elseif( $var1 == "08" ){
		$xfra = "COMPENSAÇÃO EM CARTÓRIO";
	}elseif( $var1 == "30" ){
		$xfra = "LIQUIDAÇÃO EM GUICHÊ EM CHEQUE";
	}elseif( $var1 == "31" ){
		$xfra = "LIQUIDAÇÃO EM BANCO CORRESPONDENTE";
	}elseif( $var1 == "32" ){
		$xfra = "LIQUIDAÇÃO EM TERMINAL DE AUTO-ATENDIMENTO";
	}elseif( $var1 == "33" ){
		$xfra = "LIQUIDAÇÃO EM INTERNET BANKING";
	}elseif( $var1 == "34" ){
		$xfra = "LIQUIDAÇÃO EM OFFICE BANKING";
	}elseif( $var1 == "35" ){
		$xfra = "LIQUIDADO CORRESPONDENTE EM DINHEIRO";
	}elseif( $var1 == "36" ){
		$xfra = "LIQUIDADO CORRESPONDENTE EM CHEQUE";
	}elseif( $var1 == "37" ){
		$xfra = "LIQUIDADO POR MEIO DE CENTRAL DE ATENDIMENTO (TELEFONE) BAIXA PELO BANCO";
	}elseif( $var1 == "12" ){
		$xfra = "DECURSO PRAZO - CLIENTE";
	}elseif( $var1 == "13" ){
		$xfra = "DECURSO PRAZO - BANCO";
	}elseif( $var1 == "14" ){
		$xfra = "TÍTULO PROTESTADO";
	}elseif( $var1 == "15" ){
		$xfra = "TÍTULO EXCLUÍDO DO BANCO";
	}else{
		$xfra = "MOTIVO PG: ".$var1." <br>CONSULTAR MANUAL";
	}
	return( $xfra );
	
}	

$z = 0; // contador dos itens da tabela a ser exibida
$total_itens = 0;
$total_itens_processados = 0;
$total_valor_nominal = 0;
$frase_motivo = "";
$bg_color = "";
?>
 <!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->


<head>
	<meta charset="utf-8" />
	<title>Immobile | Business</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
<script type="text/javascript">
	
		function verificaStatus(nome){
	if(nome.form.tudo.checked == 0)
		{
			nome.form.tudo.checked = 1;
			marcarTodos(nome);
		}
	else
		{
			nome.form.tudo.checked = 0;
			desmarcarTodos(nome);
		}
}
 
function marcarTodos(nome){
   for (i=0;i<nome.form.elements.length;i++)
	  if(nome.form.elements[i].type == "checkbox")
		 nome.form.elements[i].checked=0
}
 
function desmarcarTodos(nome){
   for (i=0;i<nome.form.elements.length;i++)
	  if(nome.form.elements[i].type == "checkbox")
		 nome.form.elements[i].checked=1
}
</script>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
	
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Retorno Santander</h1>
			<!-- end page-header -->
			<?php if(isset($_GET["baixa"])){ ?>
			  <div class="alert alert-success fade in m-b-15">
								<strong><font><font>Sucesso! </font></font></strong><font><font>
								Suas Parcelas foram baixadas.
								</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
							</div>
			<?php } ?>
			<!-- begin row -->
			<div class="row">
			   <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-11">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                           
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" action="retorno_santander1.php" method="POST" enctype="multipart/form-data">
                             
                                 
                              

                               

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Arquivo de Retorno:</label>
                                    <div class="col-md-9">
                                 <input type="file"  name="arquivo" id="arquivo">

                                      
                                    </div>
                                </div>
                               
                            
                                  <div class="form-group">
                            
                                    <div class="col-md-9">
                                       <input type="submit" name="Proximo" class="btn btn-success m-r-5 m-b-5" value="Próximo" />
                                    </div>
                                </div>

                             



</form>
                              





                              






                         
                        </div>
                    </div>
                    <!-- end panel -->
                </div>

		




<?php if(isset($_POST["Proximo"])){ ?>
<h3>Arquivo de Retorno: <strong><?php echo $_FILES['arquivo']['name'];?></strong></h3>

			    <!-- begin col-10 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Informações dos Contatos:</h4>
                        </div>
                      
                        <div class="panel-body">

                            <table id="data-table" class="table table-striped table-bordered">
                            	                    <form action="receber_baixa_automatica.php" method="POST" id="nome" name="nome">

                                <thead>
                                    <tr>
                                    	 <th><input type='checkbox' name='tudo' onclick="verificaStatus(this)" /></th>
                                   <th>N&ordm; Boleto</th>
                                        <th>C&oacute;d.&nbsp;Movimento</th>
                                        <th>C&oacute;d.&nbsp;Motivo</th>
                                        <th>Pagador</th>
                                        <th>Vencimento</th>
                                        <th>Pagamento</th>
                                        <th>Valor</th>
                                         <th>Valor Pago</th>
                                               <th>Acr&eacute;scimos</th>
                                                <th>Desconto</th>
                                                
                                    </tr>
                                </thead>
                                <tbody>

            
<?php

# Pegando dados do arquivo ##############################################################################

$nome = $_FILES['arquivo']['name'];
$type = $_FILES['arquivo']['type'];
$size = $_FILES['arquivo']['size'];
$tmp  = $_FILES['arquivo']['tmp_name'];

$b = 4;

$pasta = "retorno"; // Nome da pasta onde ficaram os arquivos de retorno

if(move_uploaded_file($tmp, $pasta."/".$nome)){

	$lendo = @fopen($pasta."/".$nome,"r");

	if (!$lendo){
		echo "Erro ao abrir a URL.";
		exit;
	}else{
		//echo "<br>arquivo aberto com sucesso";
	}

	$i = 1;
	$x = 1;
	$cod_motivo = "  ";
		
	while ( !feof( $lendo ) ) {
	
		$linha = fgets($lendo,241);
		
		$rr = "<pre>".$linha."</pre>";
		
		$xtamanho_linha = strlen($linha);
	
		if( $xtamanho_linha == 240 ){
			
			if( $i > 2 && substr( $rr, $b+14,1 ) == "T" && substr( $rr, $b+16,2)!=28 ){   // Essa linha e' um Segmento "T"
				$num_sequencial_t         = substr( $rr, $b+9,5 );                  // 04.3T ->   Num. Seq.T -> Numero Seq.             -> 9(005)   -> Conforme (G038)
				$carteira_nosso_numero    = substr( $rr, $b+41,13 );   
				$carteira_nosso_buscar    = substr( $rr, $b+41,12 );                 // 13.3T ->   Nosso Num  -> carteira                -> 9(003)   -> Conforme (G069)
				$nosso_numero_bradesco    = substr( $rr, $b+41,13 );                // 13.3T ->   Nosso Num  -> Identific. titulo banco -> 9(011)   -> Conforme (G069)
				$nosso_numero_dv          = substr( $rr, $b+52,1 );                 // 13.3T ->   Nosso Num  -> DV Nosso Numero         -> 9(001)   -> Conforme (G069)
				$nosso_num                = substr( $rr, $b+41,13 );               // nosso numero para funcionar de acordo com o sistema alex.
				$nosso_numero_alex        = remove_zero_esq( $nosso_num );
				$nosso_numero_buscar      = remove_zero_esq($carteira_nosso_buscar);
				$vencimento               = substr( $rr, $b+70,8 );                 // 13.3T ->   Vencimento -> Modalidade nosso numero -> 9(002)   -> Conforme (G069)
				$vm                       = substr( $rr, $b+78,15 );                // 13.3T ->   Valor tit. -> Modalidade nosso numero -> 9(002)   -> Conforme (G069)
				$valor_nominal            = numero_usa( remove_zero_esq( $vm ) );
				$cod_movimento = substr( $rr, $b+16,2 );                            // indica o que houve com o titulo
				$cod_ocorrencia = substr( $rr, $b+209,10);

				switch( $cod_movimento ){
				
					case '02':
						$xfrase_movimento = " REMESSA <br>ENTRADA BR>CONFIRMADA (02)";
						$bg_color = ""; // branco
						$frase_motivo = "REMESSA CONFIRMADA (02)";
						break;

					case '03': // REJEICAO
						$xfrase_movimento = "REMESSA <br>ENTRADA <br>REJEITADA (03)";
						$bg_color = "danger"; // vermelho
						$frase_motivo = rejeicao( $cod_ocorrencia );
						break;
						
					case '06': // LIQUIDACAO --> RELACIONA-SE COM O COD. DE OCORRENCIA ( C047 )
						$xfrase_movimento = "LIQUIDAÇÃO (06)";
						$bg_color = ""; // verde
						$cod_motivo_liquidacao = $cod_ocorrencia;
						$cod_motivo = $cod_motivo_liquidacao;
						$frase_motivo = motivo_liquidacao(substr(trim($cod_motivo_liquidacao),-2) );
						break;
						
					case '09': // BAIXA SIMPLES 
						$xfrase_movimento = "TÍTULO <br>BAIXADO (09)";
						$bg_color = "success"; // verde
						$cod_motivo_liquidacao = substr( $rr, $b+214,8);
						$cod_motivo = $cod_motivo_liquidacao;
						$frase_motivo = motivo_liquidacao( substr(trim($cod_motivo_liquidacao),-2) );
						break;
				
					case '11':
						$xfrase_movimento = "TÍTULOS EM CARTEIRA";
						$frase_motivo = $xfrase_movimento;
						break;
																	
					case '14':
						$xfrase_movimento = "CONFIRMAÇÃO DE RECEBIMENTO INSTRUÇÃO DE ALTERAÇÃO DE VENCIMENTO";
						$frase_motivo = $xfrase_movimento;
						break;
												
					case '15':
						$xfrase_movimento = "FRANCO DE PAGAMENTO";
						$frase_motivo = $xfrase_movimento;
						break;

					case '17': // LIQUIDACAO APOS BAIXA OU LIQUIDACAO SEM REGISTRO
						$xfrase_movimento = "LIQUIDAÇÃO APÓS BAIXA<br>LIQUIDAÇÃO SEM REGISTRO (17)";
						$bg_color = "success"; // verde
						$cod_motivo_liquidacao = substr( $rr, $b+214,8);
						$frase_motivo = motivo_liquidacao( substr(trim($cod_motivo_liquidacao),-2) );
						break;						

					case '26':  // REJEICAO
						$xfrase_movimento = "INSTRUÇÃO REJEITADA <BR>(UTILIZAR SERVIÇO DE NEGATIVAÇÃO)<BR> (26)";
						$bg_color = "danger"; // vermelho
						$frase_motivo = rejeicao( $cod_ocorrencia );
						break;
												
					case '27':
						$xfrase_movimento = $xf = "CONFIRMAÇÃO DO PEDIDO DE ALTERAÇÃO DE OUTROS DADOS";
						$frase_motivo = $xfrase_movimento;
						break;

					case '28':
						$xfrase_movimento = "DÉBITO DE TARIFAS/CUSTAS";
						$frase_motivo = $xfrase_movimento;
						break;
												
					case '29':
						$xfrase_movimento = $xf = "OCORRÊNCIAS DO PAGADOR";
						$frase_motivo = $xfrase_movimento;
						break;
												
					case '30':   // REJEICAO
						$xfrase_movimento = "ALTERAÇÃO <BR>DE DADOS<BR> REJEITADA (30)";
						$bg_color = "#FFC4C4"; // vermelho
						$frase_motivo = rejeicao( $cod_ocorrencia );
						break;

					case '44':
						$xfrase_movimento = "TÍTULO PAGO COM CHEQUE DEVOLVIDO";
						$frase_motivo = $xfrase_movimento;
						break;
												
					case '45':
						$xfrase_movimento = "TÍTULO PAGO COM CHEQUE COMPENSADO";
						$frase_motivo = $xfrase_movimento;
						break;
					
				} // fim do switch ... case
			
			}  // fim de se a linha fot uma linha T
			

			

			
			if( $i > 3 && substr( $rr, $b+14,1 ) == "U" && substr( $rr, $b+16,2)!=28 ){
			
				$total_itens_processados++;

				$cod_movimento_u = $cod_movimento;  // o mesmo cod. de movimento da linha U = ao da linha T (linha anterior)

				$num_sequencial_u         = substr( $rr, $b+9,5 );       
				$jumu                     = substr( $rr, $b+18,15 );   
				$juros_multa 			  = numero_usa ( remove_zero_esq( $jumu ) );
				
				$desco                    = substr( $rr, $b+33,15 );  
				$desconto                 = numero_usa ( remove_zero_esq( $desco ) );
				
				$vp                       = substr( $rr, $b+78,15 );     
				$valor_pago 			  = numero_usa ( remove_zero_esq( $vp ) );
				
				$vl                       = substr( $rr, $b+93,15 );  
				$valor_liquido 			  = numero_usa ( remove_zero_esq( $vl ) );
				
				$outdes                   = substr( $rr, $b+108,15 );   	
				$outras_despesas          = numero_usa ( remove_zero_esq( $outdes ) );
				
				$data_ocorrencia          = substr( $rr, $b+138,8 );  
				
				$data_credito             = substr( $rr, $b+146,8 ); 	
				
				$data_deb_tarifa          = substr( $rr, $b+158,8 ); 

				
				
				if( $cod_movimento_u == "06" || $cod_movimento_u == "17" ){
					// seu codigo para boletos liquidados  -> require "grava-boleto-liquidado.php";
					if($dados_parcela_retorno["valor_parcelas"] != $valor_pago){
						$bg_color = 'danger';
					}


					$dados_parcela_retorno = dados_parcela_retorno($nosso_numero_buscar);

					if($dados_parcela_retorno["situacao"] == 'Pago'){
						$bg_color = 'success';
					}
					require "retorno3.php";
				}



				if( $cod_movimento_u == "02" ){
					// seu codigo para boletos confirmados na remessa -> require "grava-remessa-confirmada.php";
					require "retorno3.php";
				}
				if( $cod_movimento_u == "03" || $cod_movimento_u == "26" || $cod_movimento_u == "30" ){
					// seu codigo para boletos rejeitados na remessa -> require "grava-remessa-rejeitada.php";
					require "retorno3.php";
				}
				
			
			} // Final essa linha e' segmento "U"
			
			$i++;
	
		} // fim se a linha == 240	
?>

		

<?php
	} // fim While
?>

<?php

	fclose($lendo);

} // end mov_upload

?>

                   <tr>
                           	<td colspan="11"><input type="submit" class="btn btn-success" name="" value="Baixar Parcelas"></td>
	</tr>


                                </tbody>
 </form>
                            </table>

                           
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->
                <?php } ?>
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->
		
     
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/respond.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/table-manage-buttons.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/ui-modal-notification.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
			Notification.init();
		});
	</script>

</body>


</html>
