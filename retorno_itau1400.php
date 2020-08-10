<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";


$xdata_processamento = date("Y/m/d");
function php_fnumber($var1){
	//return number_format($var1,2,",",'.’.');
	return number_format($var1,2, ',', '.');
}
function valor_vinculo($vinculo){

	include "../conexao.php";
	$select_vinculo = mysqli_query($db, "SELECT SUM(valor_parcelas) as total FROM parcelas 
		                                 WHERE vinculo = '$vinculo'");

	while ($result_vinculo = mysqli_fetch_assoc($select_vinculo)) {

		$total = $result_vinculo["total"];

	}

	return $total;

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
	$j_ano = substr($var1,4,2);
	$j_dtf = $j_dia."/".$j_mes."/".$j_ano;
	return $j_dtf;
}

function remove_zero_esq($var1){
	$tam = strlen($var1);
	for( $i=0; $i<$tam; $i++ ){
		if(substr($var1, $i, 1)	== "0" ){
			$y = substr( $var1, ($i+1), ($tam) );
		}else{
			return $y;
		}
	}
	return $y;
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

function rejeicao_03( $v1 ){

	switch( $v1 ){
	
		case '03':
			$xf = "AG.COBRADORA - NÃO FOI POSSÍVEL ATRIBUIR A AGÊNCIA PELO CEP OU CEP INVÁLIDO";
			break;
		
		case '04':
			$xf = "ESTADO - SIGLA DO ESTADO INVÁLIDA";		
			break;

		case '05':
			$xf = "DATA DE VENCIMENTO - PRAZO DE OPERAÇÃO MENOR QUE O MÍNIMO OU MAIOR QUE O MÁXIMO";		
			break;

		case '08':
			$xf = "NOME DO PAGADOR - NÃO INFORMADO OU DESLOCADO";		
			break;

		case '09':
			$xf = "AGÊNCIA/CONTA - AGÊNCIA ENCERRADA";		
			break;

		case '10':
			$xf = "LOGRADOURO - NÃO INFORMADO OU DESLOCADO";		
			break;

		case '11':
			$xf = "CEP - CEP NÃO NUMÉRICO";		
			break;

		case '13':
			$xf = "ESTADO/CEP INCOMPATÍVEL COM A SIGLA DO ESTADO";		
			break;

		case '14':
			$xf = "NOSSO NÚMERO JÁ REGISTRADO NO CADASTRO OU FORA DA FAIXA";		
			break;

		case '15':
			$xf = "NOSSO NÚMERO EM DUPLICIDADE NO MESMO MOVIMENTO";		
			break;

		case '37':
			$xf = "CNPJ/CPF DO PAGADOR - NÃO NUMÉRICO OU IGUAL A ZERO";		
			break;

		case '42':
			$xf = "NOSSO NUMERO FORA DA FAIXA";		
			break;

		case '54':
			$xf = "DATA DE VENCIMENTO - BANCO CORRESPONDENTE - TITULO COM VENCIMENTO INFERIOR A 15 DIAS";		
			break;

		case '55':
			$xf = "DEP./BCO.CORRESP. - CEP NÃO PERTENCE A DEPOSITÁRIA INFORMADA";		
			break;

		case '56':
			$xf = "DT.VCTO./BCO.CORRESP. - SUPERIOR A 180 DIAS DA DATA DE ENTRADA";		
			break;
		

		case '61':
			$xf = "JUROS DE MORA MAIOR QUE O PERMITIDO";		
			break;
		

		case '62':
			$xf = "VALOR DO DESCONTO MAIOR QUE O VALOR DO TÍTULO";		
			break;
		

		case '66':
			$xf = "DATA DE VENCIMENTO INVÁLIDA / FORA DE PRAZO DE OPERAÇÃO (MÍNIMO/MÁXIMO)";		
			break;

	}
	
	return( $xf );
	
}	


function rejeicao_15( $v1 ){

	switch( $v1 ){
	
		case '04':
			$xf = "NOSSO NÚMERO EM DUPLICIDADE NUM MESMO MOVIMENTO";
			break;
		
		case '05':
			$xf = "SOLICITAÇÃO DE BAIXA PARA TÍTULO JÁ LIQUIDADO OU JÁ BAIXADO";		
			break;

		case '06':
			$xf = "SOLICITAÇÃO DE BAIXA PARA TÍTULO NÃO REGISTRADO NO SISTEMA DO BANCO";		
			break;

		
	}
	
	return( $xf );
	
}	




function rejeicao_16( $v1 ){

	switch( $v1 ){
	
		case '01':
			$xf = "INSTRUÇÃO/OCORRÊNCIA NÂO EXISTE";
			break;
		
		case '03':
			$xf = "CONTA NÃO TEM PERMISÃO PARA PROTESTAR (FALE COM O GERENTE)";		
			break;

		case '06':
			$xf = "NOSSO NÚMERO IGUAL A ZEROS";		
			break;

		case '09':
			$xf = "CPF/CNPJ DO SACADOR AVALISTA INVÁLIDO";		
			break;

		case '14':
			$xf = "REGISTRO EM DUPLICIDADE";		
			break;

		case '15':
			$xf = "CNPJ/CPF INFORMADO SEM NOME DO SACADOR/AVALISTA";		
			break;

		case '19':
			$xf = "VALOR DO ABATIMENTO MAIOR QUE 90% DO TITULO";		
			break;
			

		case '20':
			$xf = "EXISTE SITUAÇÃO DE PROTESTO PENDENTE PARA O TÍTULO";		
			break;

		case '21':
			$xf = "TÍTULO NÃO REGISTRADO NO SISTEMA DO BANCO";		
			break;

		case '22':
			$xf = "TÍTULO JÁ HAVIA SIDO BAIXADO OU LIQUIDADO";		
			break;

		case '23':
			$xf = "INSTRUÇÃO NÃO ACEITA";		
			break;

		case '31':
			$xf = "EXISTE UMA OCORRENCIA DO PAGADOR QUE BLOQUEIA A INSTRUÇÃO";		
			break;

		case '48':
			$xf = "DADOS DO PAGADOR INVÁLIDOS (CPF/CNPJ/NOME)";		
			break;

		case '49':
			$xf = "DADOS DO ENDERECO DO PAGADOR INVÁLIDOS";		
			break;

		case '50':
			$xf = "DATA DE EMISSÃO DO TÍTULO INVÁLIDA";		
			break;
		
	}
	
	return( $xf );
	
}	


function rejeicao_17( $v1 ){

	switch( $v1 ){
	
		case '02':
			$xf = "AGÊNCIA COBRADORA INVÁLIDA OU COM O MESMO CONTEÚDO";
			break;
		
		case '04':
			$xf = "SIGLA DO ESTADO INVÁLIDO";		
			break;

		case '05':
			$xf = "DATA DE VENCIMENTO INVÁLIDA OU COM O MESMO CONTEÚDO";		
			break;

		case '08':
			$xf = "NOME DO PAGADOR COM O MESMO CONTEÚDO";		
			break;

		case '11':
			$xf = "CEP INVÁLIDO";		
			break;

		case '12':
			$xf = "NÚMERO DE INSCRIÇÃO INVÁLIDO SACADOR AVALISTA";		
			break;

		case '61':
			$xf = "TÍTULO JÁ BAIXADO OU LIQUIDADO OU NÃO EXISTE TÍTULO CORRESPONDENTE";		
			break;
		
	}
	
	return( $xf );
	
}	


function motivo_liquidacao( $var1 ){

	if( $var1 == "06" ){
		$xfra = "LIQUIDAÇÃO NORMAL";
	}elseif( $var1 == "08" ){
		$xfra = "LIQUIDAÇÃO EM CARTÓRIO";
	}elseif( $var1 == 0 ){
		$xfra = "LIQUIDAÇÃO NORMAL";
	}elseif( $var1 == "09" ){
		$xfra = "BAIXA SIMPLES";
	}elseif( $var1 == "10" ){
		$xfra = "BAIXA POR TER SIDO LIQUIDADO";
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
			<h1 class="page-header">Retorno Itaú</h1>
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
                            <form class="form-horizontal form-bordered" action="retorno_itau1400.php" method="POST" enctype="multipart/form-data">
                             
                                 
                              

                               

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
                            	                    <form action="receber_baixa_automatica_itau.php" method="POST" id="nome" name="nome">

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
	
		$linha = fgets($lendo,401);
		
		$rr = "<pre>".$linha."</pre>";
		
		$xtamanho_linha = strlen($linha);
	
		if( $xtamanho_linha == 400 ){
			
			if( $i > 1){   // Essa linha e' um Segmento "T"
				$num_sequencial_t         = substr( $rr, $b+9,5 );                  // 04.3T ->   Num. Seq.T -> Numero Seq.             -> 9(005)   -> Conforme (G038)
				$carteira_nosso_numero    = substr( $rr, $b+38,3 );                 // 13.3T ->   Nosso Num  -> carteira                -> 9(003)   -> Conforme (G069)
				$nosso_numero_bradesco    = substr( $rr, $b+127,8 );                // 13.3T ->   Nosso Num  -> Identific. titulo banco -> 9(011)   -> Conforme (G069)
				$nosso_numero_dv          = substr( $rr, $b+49,1 );                 // 13.3T ->   Nosso Num  -> DV Nosso Numero         -> 9(001)   -> Conforme (G069)
				$nosso_num                = $nosso_numero_bradesco;              // nosso numero para funcionar de acordo com o sistema alex.
				$nosso_numero_alex        = remove_zero_esq($nosso_num);
				$nosso_numero_buscar        = $nosso_numero_alex;
				$vencimento               = substr( $rr, $b+147,6 );                 // 13.3T ->   Vencimento -> Modalidade nosso numero -> 9(002)   -> Conforme (G069)
				$vm                       = substr( $rr, $b+254,13 );                // 13.3T ->   Valor tit. -> Modalidade nosso numero -> 9(002)   -> Conforme (G069)
				$valor_pago            = numero_usa( remove_zero_esq( $vm ) );
				$cod_movimento            = substr( $rr, $b+109,2 );                 // indica o que houve com o titulo
					$data_ocorrencia          = substr( $rr, $b+111,6 ); 


						$jumu                     = substr( $rr, $b+267,13 );         // 08.3U -> Juros/Multa          -> Juros/Multa             -> 9(015)   -> Conforme (C048)
				$juros_multa = numero_usa ( remove_zero_esq( $jumu ) );
				switch( $cod_movimento ){
				
					case '02':
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "REMESSA <br>ENTRADA <br>CONFIRMADA (02)";
						$frase_motivo = "REMESSA CONFIRMADA (02)";
						break;

					case '03': // REJEICAO
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "REMESSA <br>ENTRADA <br>REJEITADA (03)";
						$frase_motivo = rejeicao_03( $cod_ocorrencia );
						break;

					case '06': // LIQUIDACAO
					    $cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "TÍTULO <br>LIQUIDADO (06)";
						$cod_motivo_liquidacao = substr( $rr, $b+214,8);
						$cod_motivo = $cod_motivo_liquidacao;
						$frase_motivo = motivo_liquidacao( substr(trim($cod_motivo_liquidacao),-2) );
						break;
						
					case '09': // BAIXA SIMPLES
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "TÍTULO <br>BAIXADO (09)";
						$cod_motivo_liquidacao = substr( $rr, $b+214,8);
						$cod_motivo = $cod_motivo_liquidacao;
						$frase_motivo = motivo_liquidacao( substr(trim($cod_motivo_liquidacao),-2) );
						break;

					case '15': // REJEICAO
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "REMESSA <br>ENTRADA <br>REJEITADA (15)";
						$frase_motivo = rejeicao_15( $cod_ocorrencia );
						break;

					case '16': // REJEICAO
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "REMESSA <br>ENTRADA <br>REJEITADA (16)";
						$frase_motivo = rejeicao_16( $cod_ocorrencia );
						break;
						
					case '17': // REJEICAO
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "REMESSA <br>ENTRADA <br>REJEITADA (17)";
						$frase_motivo = rejeicao_17( $cod_ocorrencia );
						break;						
					
					case '28':
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "TARIFA DE RELAÇÃO DAS LIQUIDAÇÕES";
						$frase_motivo = $xfrase_movimento;
						break;
					
					case '29':
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "TARIFA DE MANUTENÇÃO DE TÍTULOS VENCIDOS";
						$frase_motivo = $xfrase_movimento;
						break;

					case '30':
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "DÉBITO MENSAL DE TARIFAS (PARA ENTRADAS E BAIXAS)";
						$frase_motivo = $xfrase_movimento;
						break;

					case '37':
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "TARIFA DE EMISSÃO DE BOLETO/TARIFA DE ENVIO DE DUPLICATA";
						$frase_motivo = $xfrase_movimento;
						break;

					case '40':
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "TARIFA MENSAL DE EMISSÃO DE BOLETOS";
						$frase_motivo = $xfrase_movimento;
						break;

					case '54':
						$cod_ocorrencia = substr( $rr, $b+214,8);
						$xfrase_movimento = "TARIFA MENSAL DE LIQUIDAÇÕES NA CARTEIRA";
						$frase_motivo = $xfrase_movimento;
						break;
					
				} // fim do switch ... case
				$dados_parcela_retorno = dados_parcela_retorno($nosso_numero_buscar);

			if( $cod_movimento == "06" ){
					// SEU CODIGO PARA LIQUIDACAO DESTE BOLETO - BOLETO LIQUIDADO
					require "retorno3itau.php";
				}
				
			}  // fim de se a linha fot uma linha T
			
			// *****************************************************************************************************************************************
			// final essa linha e' segmento "T"
			// *****************************************************************************************************************************************
			
			
			
			
			
			

			// *****************************************************************************************************************************************
			// Essa linha e' um segmento "U"
			// *****************************************************************************************************************************************
			
			if( $i > 3 && substr( $rr, $b+14,1 ) == "U" && substr( $rr, $b+16,2)!=28 ){
			
				$total_itens_processados++;

				$cod_movimento_u = $cod_movimento;  // o mesmo cod. de movimento da linha U = ao da linha T (linha anterior)

				$num_sequencial_u         = substr( $rr, $b+9,5 );           // 04.3U -> Num. Seq.U           -> Numero Seq.             -> 9(005)   -> Conforme (G038)
				
			
				
				$desco                    = substr( $rr, $b+33,15 );         // 09.3U -> Valor do desconto    -> Valor do desconto       -> 9(015)   -> Conforme (C049)
				$desconto                 = numero_usa ( remove_zero_esq( $desco ) );
				
				$vp                       = substr( $rr, $b+78,15 );         // 12.3U -> Valor pago pagador   -> Valor pago pagador      -> 9(015)   -> Conforme (C052)
				$valor_pago = numero_usa ( remove_zero_esq( $vp ) );
				
				$vl                       = substr( $rr, $b+93,15 );         // 13.3U -> Valor liquido        -> Valor liquido           -> 9(015)   -> Conforme (C078)
				$valor_liquido = numero_usa ( remove_zero_esq( $vl ) );
				
				$outdes                   = substr( $rr, $b+108,15 );        // 14.3U -> Outras despesas      -> Outras Despesas         -> 9(015)   -> Conforme (C054)				
				$outras_despesas          = numero_usa ( remove_zero_esq( $outdes ) );
				
				$data_ocorrencia          = substr( $rr, $b+111,6 );         // 16.3U -> Data ocorrencia      -> Data do evento que afet -> 9(008)   -> Conforme (C056)
				
				$data_credito             = substr( $rr, $b+296,6 );         // 17.3U -> Data do credito      -> Data do credito         -> 9(008)   -> Conforme (C057)				
				
				$data_deb_tarifa          = substr( $rr, $b+158,8 );         // 19.3U -> Data deb. tarifa     -> Data do deb. tarifa     -> 9(008)   -> 

				if( $cod_movimento_u == "06" ){
					// SEU CODIGO PARA LIQUIDACAO DESTE BOLETO - BOLETO LIQUIDADO
					require "retorno3.php";
				}
				if( $cod_movimento_u == "02" ){
					// SEU CODIGO PARA REGISTRAR QUE O BOLETO FOI ACEITO NA REMESSA - ENTRADA CONFIRMADA
					require "retorno3.php";
				}
				if( $cod_movimento_u == "03" || $cod_movimento_u == "15" || $cod_movimento_u == "16" ){
					// SEU CODIGO PARA REGISTRAR QUE O BOLETO FOI REJEITADO NA REMESSA - ENTRADA REJEITADA
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
	<script src="https://immobilebusiness.com.br/admin/assets/page-loaderugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
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
