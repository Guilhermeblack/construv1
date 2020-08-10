<?php 
// error_reporting(0);
// ini_set(“display_errors”, 0 );
include "protege_professor.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>"; die();











if(isset($_POST["idparcelas"])){


// echo "<pre>";
// print_r($_POST);
// echo "</pre>"; die();



	$hoje = date('d-m-Y');
	include "conexao.php";
	$antecipar_t 	= $_POST["idparcelas"];
	$data_boleto 	= $_POST["data_boleto"];


	if(isset($_POST["mesmadata"])){
		$mesmadata      = $_POST["mesmadata"];
	}else{
		$mesmadata = 0;
	}

	$tipo 		= $_POST["tipo"];
	$idvenda 	= $_POST["idvenda"];

	$cont_boleto = 0;

	$multa             = $_POST['vm'];
	$mora              = $_POST['vj'];
	$outros            = $_POST['vh'];
    $vmulta            = $_POST['valor_multa'];
    $vjuros            = $_POST['valor_juros'];
    $vhonorario        = $_POST['valor_honorario'];
    $valor_corrigido   = $_POST['valor_total'];


    //print_r($valor_corrigido); die();

	$count = 0;

	foreach($antecipar_t as $id){
		global $obs;
		$obs   = '<u><strong></strong></u>';	
        // $obs  .= "<br>";
        // $obs  .= "<br>";

        // $obs  .=  "<strong>VALOR PARCELA CORRIGIDO : R$  </strong>" . str_replace('R$', '', $valor_corrigido[$count]) . "<br>";
        // $obs  .=  "<strong>VALOR MULTA : R$  </strong>" . str_replace('R$', '', $vmulta[$count]) . "<br>";
        // $obs  .=  "<strong>VALOR JUROS : R$  </strong>" . str_replace('R$', '', $vjuros[$count]) . "<br>";
        // $obs  .=  "<strong>VALOR HONORARIOS : R$  </strong>" . str_replace('R$', '', $vhonorario[$count]) . "<br>";
         

         $obs_caldas = pegaObs($id);




		$obs_parcela = htmlentities($obs);
		//echo $obs; die();
		
		$valor_convertido = valor_convertido($id);
		$valor_parcelas   		 = $valor_convertido["valor_convertido"];
		$juros_multa             = $multa[$count];
		$juros_mora              = $mora[$count];
		$juros_outros            = $outros[$count];

		$cliente_id_novo   		 = $valor_convertido["cliente_id_novo"];
		$empreendimento_id_novo  = $valor_convertido["empreendimento_id_novo"];
		$fluxo   		 	     = $valor_convertido["fluxo"];
		$situacao 	 			 = $valor_convertido["situacao"];
		$descricao 	 			 = $valor_convertido["descricao"];
		$numero_sequencia     	 = $valor_convertido["numero_sequencia"];
		$tipo_venda            	 = $valor_convertido["tipo_venda"];
		$data_vencimento_parcela = $valor_convertido["data_vencimento_parcela"];


		if($mesmadata == 0){

			$vencimento = date('d-m-Y', strtotime("+".$cont_boleto." month",strtotime($data_boleto)));

			$insert_t = "INSERT INTO parcelas (venda_idvenda, fluxo, cliente_id_novo, empreendimento_id_novo, valor_parcelas, data_vencimento_parcela, situacao, descricao, numero_sequencia, tipo_venda, data_boleto, juros_mora, juros_multa, juros_outros, obs_parcela, obs_caldas) values('$idvenda', '$fluxo', '$cliente_id_novo', '$empreendimento_id_novo', '$valor_parcelas', '$data_vencimento_parcela', '$situacao', '$descricao', '$numero_sequencia','$tipo_venda', '$vencimento', '$juros_mora', '$juros_multa', '$juros_outros', '$obs_parcela', '$obs_caldas')";
			 $obs = '';

			//echo $insert_t; die();

			$inserir = mysqli_query($db, $insert_t) or die ("erro ao inserir 0");


			$estorno = mysqli_query($db, "UPDATE parcelas set fluxo ='15' WHERE idparcelas = '$id'");	
			$cont_boleto = $cont_boleto + 1;
		}else{
			$vencimento = date('d-m-Y', strtotime($data_boleto));

			$insert_t = "INSERT INTO parcelas (venda_idvenda, fluxo, cliente_id_novo, empreendimento_id_novo, valor_parcelas, data_vencimento_parcela, situacao, descricao, numero_sequencia, tipo_venda, data_boleto, juros_mora, juros_multa, juros_outros, obs_parcela, obs_caldas) values('$idvenda', '$fluxo', '$cliente_id_novo', '$empreendimento_id_novo', '$valor_parcelas', '$data_vencimento_parcela', '$situacao', '$descricao', '$numero_sequencia','$tipo_venda', '$vencimento', '$juros_mora', '$juros_multa', '$juros_outros', '$obs_parcela', '$obs_caldas')";
			$obs = '';

			//echo $insert_t; die();

			$inserir = mysqli_query($db, $insert_t) or die ("erro ao inserir 1");


			$estorno = mysqli_query($db, "UPDATE parcelas set fluxo ='15' WHERE idparcelas = '$id'");	


		}



		##############################################################################################3

		// $vencimento = date('d-m-Y', strtotime("+".$cont_boleto." month",strtotime($data_boleto)));



		// $inserir = mysqli_query($db, "INSERT INTO parcelas (venda_idvenda, fluxo, cliente_id_novo, empreendimento_id_novo, valor_parcelas, data_vencimento_parcela, situacao, descricao, numero_sequencia, tipo_venda, data_boleto) values('$idvenda', '$fluxo', '$cliente_id_novo', '$empreendimento_id_novo', '$valor_parcelas', '$data_vencimento_parcela', '$situacao', '$descricao', '$numero_sequencia','$tipo_venda', '$vencimento')");


		// $estorno = mysqli_query($db, "UPDATE parcelas set fluxo ='15' WHERE idparcelas = '$id'");	
		// $cont_boleto = $cont_boleto + 1;
		$count++;

	}

	?>

	<script type="text/javascript">window.location="parcelas.php?idvenda=<?php echo $idvenda ?>&tipo=<?php echo $tipo ?>";</script>

<?php } ?>


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
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<script type="text/javascript">


		function numberParaReal(numero){
			var formatado = "R$ " + numero.toFixed(2).replace(".",",");
			return formatado;
		}



		function CalcularDescontoApagar(id){



			var valor_normal = document.getElementById('valor_normal'+id).value


			var hono = document.getElementById('valor_honorario'+id).value

			var juros = document.getElementById('valor_juros'+id).value


			var multa = document.getElementById('valor_multa'+id).value




			var valor_normal = valor_normal.replace("R$","")
			var valor_normal = valor_normal.replace(".","")
			var valor_normal = valor_normal.replace(" ","")
			var valor_normal = valor_normal.replace(",",".")

			var hono = hono.replace("R$","")
			var hono = hono.replace(".","")
			var hono = hono.replace(" ","")
			var hono = hono.replace(",",".")

			var juros = juros.replace("R$","")
			var juros = juros.replace(".","")
			var juros = juros.replace(" ","")
			var juros = juros.replace(",",".")

			var multa = multa.replace("R$","")
			var multa = multa.replace(".","")
			var multa = multa.replace(" ","")
			var multa = multa.replace(",",".")




			if(hono == ''){
				hono = 0;
			}

			if(juros == ''){
				juros = 0;
			}

			if(multa == ''){
				multa = 0;
			}

			document.getElementById('vm'+id).value = parseFloat(multa)
			document.getElementById('vj'+id).value = parseFloat(juros)
			document.getElementById('vh'+id).value = parseFloat(hono)
0

			var corrigido = parseFloat(valor_normal) + parseFloat(hono) + parseFloat(juros) + parseFloat(multa);

			corrigidoFormato = numberParaReal(corrigido)
			console.log(corrigidoFormato)
			
			
			document.getElementById(''+id).value = corrigido
			document.getElementById('n'+id).value = corrigidoFormato


		}


	</script>


</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">


		<?php include "topo.php";

		function pegaObs($id){

        	include "conexao.php";

        	$query = "SELECT obs_caldas FROM parcelas WHERE idparcelas = '$id'";
        	$executa = mysqli_query($db, $query) or die ("erro ao listar observaçoes");
        	$busca_amigo = mysqli_fetch_assoc($executa);
        	$dados =  $busca_amigo['obs_caldas']; 

        	return $dados;


         }

		function geraTimestamp($data) {
			$partes = explode('-', $data);
			$tratada = $partes[2].'-'.$partes[1].'-'.$partes[0];
			return $tratada;
		}


		function busca_primeira($idvenda){
			include "conexao.php";
			$query = "SELECT data_vencimento_parcela FROM parcelas where venda_idvenda = $idvenda AND tipo_venda = 2 AND descricao = 'Financiamento' order by idparcelas ASC limit 1";
			$executa_query = mysqli_query($db, $query);
			while ($buscar_amigo = mysqli_fetch_assoc($executa_query)){
				$data_vencimento_parcela = $buscar_amigo["data_vencimento_parcela"];
			}
			return $data_vencimento_parcela;
		}


		function valor_convertido($id){
			include "conexao.php";
			$hoje = date('Y-m-d');
			$query_amigo = "SELECT numero_sequencia, cliente_id_novo, empreendimento_id_novo, situacao, tipo_venda, venda_idvenda,descricao, data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
			$executa_query = mysqli_query ($db,$query_amigo);

			while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
			{
				$data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
				$valor_parcelas           = $buscar_amigo["valor_parcelas"];
				$descricao                = $buscar_amigo["descricao"];
				$venda_idvenda            = $buscar_amigo["venda_idvenda"];
				$tipo_venda               = $buscar_amigo["tipo_venda"];

				$cliente_id_novo          = $buscar_amigo["cliente_id_novo"];
				$empreendimento_id_novo   = $buscar_amigo["empreendimento_id_novo"];
				$situacao                 = $buscar_amigo["situacao"];
				$numero_sequencia         = $buscar_amigo["numero_sequencia"];

			}

			$time_final_tratar = geraTimestamp($data_vencimento_parcela);
			$time_final = $time_final_tratar;

			$diferenca = strtotime($time_final) - strtotime($hoje); 


			if($diferenca > 0){


				$valor_convertido = $valor_parcelas;
			}else{

				$diferenca2 = strtotime($hoje) - strtotime($time_final); 

    $dias2 = (int)floor( $diferenca2 / (60 * 60 * 24)); // 225 dias

    $multa2 = ($valor_parcelas * (2/100));
    $juros2 = ($valor_parcelas * (0.033/100) * $dias2);

    $valor_convertido = $valor_parcelas + $multa2 + $juros2;


}
$dados["valor_convertido"] 		  = $valor_convertido;
$dados["data_vencimento_parcela"] = $data_vencimento_parcela;

$dados["descricao"] 			  = $descricao;
$dados["venda_idvenda"] 		  = $venda_idvenda;
$dados["tipo_venda"] 			  = $tipo_venda;
$dados["cliente_id_novo"] 		  = $cliente_id_novo;
$dados["empreendimento_id_novo"]  = $empreendimento_id_novo;
$dados["situacao"] 				  = $situacao;
$dados["numero_sequencia"] 		  = $numero_sequencia;
$dados["tipo_venda"] 		      = $tipo_venda;
$dados["valor_parcelas"]          = $valor_parcelas;



return $dados;
}




function valor_convertido_old($id){
	include "conexao.php";
	$hoje = date('Y-m-d');
	$query_amigo = "SELECT numero_sequencia, cliente_id_novo, empreendimento_id_novo, situacao, tipo_venda, venda_idvenda,descricao, data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
	$executa_query = mysqli_query ($db,$query_amigo);

	$buscar_amigo = mysqli_fetch_assoc($executa_query);

	$data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
	$valor_parcelas           = $buscar_amigo["valor_parcelas"];
	$descricao                = $buscar_amigo["descricao"];
	$venda_idvenda            = $buscar_amigo["venda_idvenda"];
	$tipo_venda               = $buscar_amigo["tipo_venda"];

	$cliente_id_novo          = $buscar_amigo["cliente_id_novo"];
	$empreendimento_id_novo   = $buscar_amigo["empreendimento_id_novo"];
	$situacao                 = $buscar_amigo["situacao"];
	$numero_sequencia         = $buscar_amigo["numero_sequencia"];



	$query_encargos = "SELECT multa_atraso, juros_atraso FROM `empreendimento` WHERE idempreendimento = '$empreendimento_id_novo'";

	$executa_encargos = mysqli_query($db,$query_encargos);
	$buscar_amigo1 = mysqli_fetch_assoc($executa_encargos);

	$m1 = $buscar_amigo1["multa_atraso"];
	$j1 = $buscar_amigo1["juros_atraso"];

              // $m1 = 2;
              // $j1 = 0.033;


	$time_final_tratar = geraTimestamp($data_vencimento_parcela);
	$time_final = $time_final_tratar;

	$diferenca = strtotime($time_final) - strtotime($hoje); 


	if($diferenca > 0){


		$valor_convertido = $valor_parcelas;
	}else{

		$diferenca2 = strtotime($hoje) - strtotime($time_final); 

    $dias2 = (int)floor( $diferenca2 / (60 * 60 * 24)); // 225 dias

    
    


    $multa2 = ($valor_parcelas * ($m1/100));
    $juros2 = ($valor_parcelas * ($j1/100) * $dias2);

    $valor_convertido = $valor_parcelas + $multa2 + $juros2;


}
$dados["valor_total"] 		      = $valor_convertido;
$dados["data_vencimento_parcela"] = $data_vencimento_parcela;

$dados["valor_juros"]             = $juros2;
$dados["valor_multa"]             = $multa2;



return $dados;
}





function pegaMultaJurosHonorarios($idparcela, $emp){
	include "conexao";



	$query =  "SELECT empreendimento.multa_atraso as multa, empreendimento.juros_atraso as juros  FROM `parcelas` INNER JOIN empreendimento ON parcelas.empreendimento_id_novo = empreendimento.idempreendimento WHERE parcelas.idparcelas = '$idparcela' AND empreendimento.idempreendimento = '$emp'";


	$executa = mysqli_query($db, $query) or die ("erro interno ");

	$result = mysqli_fetch_assoc($executa);


	$dados['percentual_multa'] = $result['multa'];
	$dados['percentual_juros'] = $result['juros'];


	// $dados['percentual_multa'] = 2.0;
	// $dados['percentual_juros'] = 0.033;



	return $dados;

}







?>

<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->

	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Atualizar Parcela</h1>
	<!-- end page-header -->
	<div class="alert alert-warning fade in m-b-15">
		<strong><font><font>Atenção! </font></font></strong><font><font>
			Será necessário gerar uma nova remessa para as parcelas selecionadas.
		</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
	</div>
	<!-- begin row -->
	<div class="row">

		<!-- begin col-6 -->
		<div class="col-md-12">
			<!-- begin panel -->
			<div class="panel panel-inverse" data-sortable-id="table-basic-4">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Parcelas</h4>
				</div>
				<div class="panel-body">
					<form action="atualizar_parcela.php" method="POST" name="nome">
						<?php 

						$idvenda = $_POST["idvenda"];
						$tipo    = $_POST["tipo"];

						?>





						<input type="hidden" name="idvenda" value="<?php echo $idvenda; ?>">
						<input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
						<table class="table table-striped">
							<thead>
								<tr>

									<th>ID / Nosso Numero</th>
									<th>Valor </th>
									<th>Data Vencimento</th>
									<th>Valor Corrigido</th>
									<th>Multa</th>
									<th>Juros</th>
									<th>Honorarios</th>
								</tr>
							</thead>
							<tbody>
								<?php             


								include "conexao.php";
								$antecipar = $_POST["antecipar"];




								foreach($antecipar as $id){

									$valor_convertido          = valor_convertido($id);

									$valor_parcelas   		   = $valor_convertido["valor_convertido"];
									$data_vencimento_parcela   = $valor_convertido["data_vencimento_parcela"];



									$busca_encargos = valor_convertido_old($id);
								//	print_r($busca_encargos);


									$valor_total = $busca_encargos['valor_total'];
									$valor_multa = $busca_encargos['valor_multa'];
									$valor_juros = $busca_encargos['valor_juros'];
									$valor_total = $valor_total + $valor_multa + $valor_juros;
									$honorarios = 0.00;

									?>


									<tr>
										<td>
											<input type="hidden" name="idparcelas[]" value="<?php echo $id ?>">
											<?php echo $id ?></td>
											<td><input type="text" name="valor_normal" id="valor_normal<?php echo $id ?>" value="<?php echo number_format($valor_parcelas, 2, ',', '.') ?>" class="form-control valor_parcelas"></td>

											<td><?php echo $data_vencimento_parcela ?></td>

											<td><input type="text" name="valor_total[]" id="n<?php echo $id ?>" value="<?php echo number_format($valor_total, 2, ',', '.') ?>" class="form-control valor_parcelas" >
											</td>                                    

											<td><input type="text"  name="valor_multa[]" id="valor_multa<?php echo $id ?>" value="<?php echo number_format($valor_multa, 2, ',', '.') ?>" class="form-control valor_parcelas" onblur="CalcularDescontoApagar(<?php echo $id ?>)"  ><input type="hidden" name="vm[]" id="vm<?php echo $id ?>" value="" class="form-control valor_parcelas">
											</td>
											
											<td><input type="text"  name="valor_juros[]" id="valor_juros<?php echo $id ?>" value="<?php echo  number_format($valor_juros, 2, ',', '.') ?>" class="form-control valor_parcelas" onblur="CalcularDescontoApagar(<?php echo $id ?>)" ><input type="hidden" name="vj[]" id="vj<?php echo $id ?>" value="" class="form-control valor_parcelas"> </td>


										</td>

										<td><input type="text" name="valor_honorario[]" id="valor_honorario<?php echo $id ?>" value="<?php echo  number_format($honorarios, 2, ',', '.') ?>" class="form-control valor_parcelas"  onblur="CalcularDescontoApagar(<?php echo $id ?>)">
											<input type="hidden" name="vh[]" id="vh<?php echo $id ?>" value="" class="form-control valor_parcelas">
											<input type="hidden" name="<?php echo $id ?>" id="<?php echo $id ?>" value="" class="form-control valor_parcelas"> </td>

										</td>










									</tr>

								<?php } ?>
								<tr>


									<td>Nova data para o boleto: <br>
										*As demais datas serão nos meses subsequentes<br>
										<!-- 	*Ou Mesma data para poder vincular parcelas --></td>
										<td>	<input type="date" name="data_boleto" class="form-control">
											Mesma Data? &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="restante" name="mesmadata" value="1"></td>

											<td colspan="2"><input type="submit" name="corrigir" class="btn btn-success" value="Atualizar"></td>


										</tr>

									</tbody>
								</table>
							</form>
						</div>
					</div>
					<!-- end panel -->

				</div>
				<!-- end col-6 -->
			</div>


		</div>
		<!-- end #content -->



		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

	<script type="text/javascript">


		$(function(){
			$(".valor_parcelas").maskMoney({symbol:'R$ ', 
				showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
		})

// $(function(){
// $("#valor_cheque").maskMoney({symbol:'R$ ', 
// showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
//  })
</script>



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
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>



		$(document).ready(function() {
			App.init();
		});
	</script>

</body>

</html>
