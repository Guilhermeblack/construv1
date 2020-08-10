<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";



	date_default_timezone_set('America/Sao_Paulo');

	function total_gasto($data_inicio, $data_fim, $empreendimento){

		include "conexao.php";

		$query = mysqli_query($db, "SELECT SUM(CIOC.valor_unidade * CIOC.qnt) AS total FROM const_insumo_oc AS CIOC INNER JOIN const_ordem_compra AS COC ON CIOC.id_oc = COC.id INNER JOIN const_recebimento_material AS CRM ON COC.id = CRM.id_oc INNER JOIN const_cotacao AS CC ON COC.id_cotacao = CC.id INNER JOIN const_orcamento AS CO ON CC.id_orc = CO.id INNER JOIN const_sub_empreendimento AS CSE ON CO.id_empreendimento = CSE.id INNER JOIN empreendimento_cadastro AS EC ON CSE.id_empreendimento = EC.idempreendimento_cadastro WHERE CRM.recebimento_completo = 1 AND EC.idempreendimento_cadastro = $empreendimento AND STR_TO_DATE(CRM.data, '%d-%m-%Y') BETWEEN '$data_inicio' and '$data_fim'");

		$assoc = mysqli_fetch_assoc($query);

		$assoc['total'] == NULL ? $assoc = 0 : $assoc = $assoc['total'];

		return $assoc;
	}

	function total_orcado($data_inicio, $data_fim, $empreendimento){

		include "conexao.php";

		$query = mysqli_query($db, "SELECT DISTINCT TORC.id_insumo_plano, SUM(TORC.valor_unitario * CIOC.qnt) AS total FROM tabela_orcamento AS TORC INNER JOIN const_insumo_oc AS CIOC ON CIOC.id_insumo = TORC.id_insumo_plano INNER JOIN const_ordem_compra AS COC ON CIOC.id_oc = COC.id INNER JOIN const_recebimento_material AS CRM ON COC.id = CRM.id_oc INNER JOIN const_cotacao AS CC ON COC.id_cotacao = CC.id INNER JOIN const_orcamento AS CO ON CC.id_orc = CO.id INNER JOIN const_sub_empreendimento AS CSE ON CO.id_empreendimento = CSE.id INNER JOIN empreendimento_cadastro AS EC ON CSE.id_empreendimento = EC.idempreendimento_cadastro WHERE TORC.id_orcamento = CO.id AND CRM.recebimento_completo = 1 AND EC.idempreendimento_cadastro = $empreendimento AND STR_TO_DATE(CRM.data, '%d-%m-%Y') BETWEEN '$data_inicio' and '$data_fim'");

		$assoc = mysqli_fetch_assoc($query);

		$assoc['total'] == NULL ? $assoc = 0 : $assoc = $assoc['total'];

		return $assoc;
	}

 ?>

 <?php

	 include "conexao.php";


	 $name = basename(__FILE__, '.php'); 
	 $fname = basename(__FILE__); 

	 $publickey = 'BJ5IxJBWdeqFDJTvrZ4wNRu7UY2XigDXjgiUBYEYVXDudxhEs0ReOJRBcBHsPYgZ5dyV8VjyqzbQKS8V7bUAglk';
	 $privatekey = 'ERIZmc5T5uWGeRxedxu92k3HnpVwy_RCnQfgek1x2Y4';

	 $_POST = json_decode(file_get_contents('php://input'), true); //for php 7
	 /*if(isset($_POST) && isset($HTTP_RAW_POST_DATA)){ //for php 5.*
	 	$json = json_decode($HTTP_RAW_POST_DATA, true);
	 	$_POST = $json;
	 	//var_dump($json); exit;
	 }*/


	 if(isset($_POST['axn']) && $_POST['axn'] != NULL){
	 	$output = '';
	 	
	 	$id_user = $_POST['id_user'];
	 	
	 	switch($_POST['axn']){
	 		case "subscribe":
	 			//filter out bad data
	 			//$myQuery = "SELECT * FROM subscribers WHERE endpoint = '".$_POST['endpoint']."' ");
	 			//var_dump($db);
	 		    $query = mysqli_query($db, "SELECT * FROM subscribers WHERE endpoint = '".$_POST['endpoint']."'")or die(mysqli_error($db));
	 		    
	 		    if(!mysqli_num_rows($query)){
	 		        $result = mysqli_fetch_assoc($query);
	 		        
	 		        //$my_query = "INSERT INTO subscribers (endpoint, p256dh, auth) VALUES (".$db->quote($_POST['endpoint']).", ".$db->quote($_POST['key']).", ".$db->quote($_POST['token'])."); ";
	 				
	 				//$query = "INSERT INTO subscribers (endpoint, p256dh, auth) VALUES ('".$_POST['endpoint']."', '".$_POST['key']."', '".$_POST['token']."' )";
	 				//echo $query;
	 				
	 				$_POST['endpoint'] = addslashes($_POST['endpoint']);
	 				$_POST['key'] = addslashes($_POST['key']);
	 				$_POST['token'] = addslashes($_POST['token']);
	 				
	 				$query = mysqli_query($db, "INSERT INTO `subscribers`(`endpoint`, `auth`, `p256dh`, `id_user`)  VALUES ('".$_POST['endpoint']."', '".$_POST['token']."', '".$_POST['key']."', $id_user )")or die(mysqli_error($db));
	 			    //echo $my_query.'<BR><BR>';
	 			    //$i++;
	 			    $output .= 'adding user <br>';
	 	   	    }else{
	 		        $output .= 'user exists in db :  <br>';
	 		        
	 		    }
	 			echo $output;
	 			exit;
	 			break;
	 		default:
	 	}
	 	exit;
	 }
 ?>

<!DOCTYPE html>

<html>
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
	
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/morris/morris.css" rel="stylesheet" />
    <link rel="manifest" href="manifest.json">
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>

	<style type="text/css">
		.panel > .panel-heading {
		    background-image: none;
		    background-color: #00728C;
		    color: white;

		}
	</style>
	<!-- ================== END BASE JS ================== -->
</head>
<body>

	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	

	<?php 
	
		include_once "topo.php";
	?>
		
		<!-- begin #content -->
		<div id="content" class="content scrollable">
			
			<?php 

				$query_master  = mysqli_query($db, "SELECT * FROM `empreendimento_cadastro`")or die($db);

				if(mysqli_num_rows($query_master)){ //é verdadeiro, entao pegou as os empreendimentos

					$media_orcado=[];
					$gasto_mes=[];
					while ($assoc_master = mysqli_fetch_assoc($query_master)){ //ira passar por todos os empreendimentos
					//assoc_master é o empreendimento em sí.
					$total_master = 0; //declara o total master
						// print_r($media_orcado);

						// print_r($assoc_master['idempreendimento_cadastro']);
						?>

						<div class="panel panel-inverse">
							<div class="panel-heading">
								<div class="panel-heading-btn">
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					        	</div>	
					        <h4 class="panel-title" style="text-transform: uppercase;">RESUMO GERAL <?php echo $assoc_master['descricao_empreendimento']; ?></h4>
						</div>

						<div class="panel-body">
							<div class="row">
								<!-- begin col-3 -->

								<?php 

									// $query  = mysqli_query($db, "SELECT COC.id, COC.id_cotacao FROM const_ordem_compra AS COC INNER JOIN const_recebimento_material AS CRM ON COC.id = CRM.id_oc WHERE CRM.recebimento_completo = 1")or die($db);

									$query  = mysqli_query($db, "SELECT COC.id, COC.id_cotacao FROM const_ordem_compra AS COC INNER JOIN const_recebimento_material AS CRM ON COC.id = CRM.id_oc INNER JOIN const_cotacao AS CC ON COC.id_cotacao = CC.id INNER JOIN const_orcamento AS CO ON CC.id_orc = CO.id INNER JOIN const_sub_empreendimento AS CSE ON CO.id_empreendimento = CSE.id INNER JOIN empreendimento_cadastro AS EC ON CSE.id_empreendimento = EC.idempreendimento_cadastro WHERE CRM.recebimento_completo = 1 AND EC.idempreendimento_cadastro = ".$assoc_master['idempreendimento_cadastro']." ")or die($db);

									

									if(mysqli_num_rows($query)){

										
										
										//esse while percorre as ordens de compra
										while ($assoc = mysqli_fetch_assoc($query)) {
											$query_2 = mysqli_query($db, "SELECT * FROM `const_insumo_oc` WHERE `id_oc` = ".$assoc['id']."") or die($db);

											if(mysqli_num_rows($query_2)){
												while ($assoc_2 = mysqli_fetch_assoc($query_2)) {

													$total_master += (floatval($assoc_2["valor_unidade"]) * floatval($assoc_2["qnt"]));
												}
												
												

											
											}
											
											
										}
										$gasto_mes[$assoc_master['idempreendimento_cadastro']] = ($total_master)/5;

										

										
										// print_r($gasto_mes[$assoc_master['idempreendimento_cadastro']]);
										// var_dump($gasto_mes);
										// die();


										
									?>

									<div class="col-md-4 col-sm-6">
										<div class="widget widget-stats bg-green">
											<div class="stats-icon"><i class="fa fa-money"></i></div>
											<div class="stats-info">
												<h4>ORDEM DE COMPRA</h4>
												<p>R$ <?php echo number_format($total_master, 2, ',', '.'); ?></p>	
											</div>
											<div class="stats-link">
												<a href="const_cotacao.php">Veja Mais <i class="fa fa-arrow-circle-o-right"></i></a>
											</div>
										</div>
									</div>

									<?php
									}else{
								 ?>

								 <div class="col-md-4 col-sm-6">
								 	<div class="widget widget-stats bg-green">
								 		<div class="stats-icon"><i class="fa fa-money"></i></div>
								 		<div class="stats-info">
								 			<h4>ORDEM DE COMPRA</h4>
								 			<p>R$ <?php echo number_format(0, 2, ',', '.'); ?></p>	
								 		</div>
								 		<div class="stats-link">
								 			<a href="const_cotacao.php">Veja Mais <i class="fa fa-arrow-circle-o-right"></i></a>
								 		</div>
								 	</div>
								 </div>

								<?php
								 }
								 ?>


								 <!-- begin col-3 -->
								 <div class="col-md-4 col-sm-6">
								 	<div class="widget widget-stats bg-purple">
								 		<div class="stats-icon"><i class="fa fa-truck"></i></div>
								 		<div class="stats-info">
								 			<h4>ORDEMS DE COMPRAS A RECEBER</h4>

								 			<?php 

								 				$query_2 = mysqli_query($db, "SELECT COUNT(COC.id) FROM const_ordem_compra AS COC LEFT JOIN const_recebimento_material AS CRM ON COC.id = CRM.id_oc INNER JOIN const_cotacao AS CC ON COC.id_cotacao = CC.id INNER JOIN const_orcamento AS CO ON CC.id_orc = CO.id INNER JOIN const_sub_empreendimento AS CSE ON CO.id_empreendimento = CSE.id INNER JOIN empreendimento_cadastro AS EC ON CSE.id_empreendimento = EC.idempreendimento_cadastro WHERE CRM.id IS NULL AND COC.status = 1 AND EC.idempreendimento_cadastro = ".$assoc_master['idempreendimento_cadastro']." ")or die($db);

								 				if(mysqli_num_rows($query_2)){
								 					$assoc_total_oc = mysqli_fetch_assoc($query_2);

								 					$assoc_total_oc = floatval($assoc_total_oc['COUNT(COC.id)']);
								 				}

								 			 ?>
								 			<p><?php echo($assoc_total_oc); ?></p>	
								 		</div>
								 		<div class="stats-link">
								 			<a href="javascript:;">Veja Mais <i class="fa fa-arrow-circle-o-right"></i></a>
								 		</div>
								 	</div>
								 </div>
								
								<div class="col-md-3 col-sm-6 hidden">
									<div class="widget widget-stats bg-blue">
										<div class="stats-icon"><i class="fa fa-desktop"></i></div>
										<div class="stats-info">
											<h4>TOTAL TAREFAS</h4>
											<?php 



											?>
											<p>R$ <?php echo number_format($total_master, 2, ',', '.'); ?></p>	
										</div>
										<div class="stats-link">
											<a href="const_cotacao.php">Veja Mais <i class="fa fa-arrow-circle-o-right"></i></a>
										</div>
									</div>
								</div>

								<div class="col-md-4 col-sm-6">
									<div class="widget widget-stats bg-red">
										<div class="stats-icon"><i class="glyphicon glyphicon-usd"></i></div>
										<div class="stats-info">
											<h4>TOTAL ORÇADO</h4>
					<!-- dentro dp while dos empreendimentos -->
											<?php 

												//ROTINA PARA PEGAR TOTAL ORCADO DE INSUMO
												$query_2 = mysqli_query($db, "SELECT SUM( cast(TORC.quantidade as decimal(10,1)) * cast(TORC.valor_unitario as decimal(10,1))) AS total_insumo FROM const_orcamento AS CO INNER JOIN const_sub_empreendimento AS CSE ON CO.id_empreendimento = CSE.id INNER JOIN empreendimento_cadastro AS EC ON CSE.id_empreendimento = EC.idempreendimento_cadastro INNER JOIN tabela_orcamento AS TORC ON CO.id = TORC.id_orcamento WHERE EC.idempreendimento_cadastro =  ".$assoc_master['idempreendimento_cadastro']." ")or die($db);

												 $ind=0;

												if(mysqli_num_rows($query_2)){
													$assoc_total_oc = mysqli_fetch_assoc($query_2);

													$total_insumo = ($assoc_total_oc['total_insumo']);
												}

												//ROTINA PARA PEGAR TOTAL ORCADO DE TAREFA
												$query_2 = mysqli_query($db, "SELECT SUM( cast(CITO.quantidade as decimal(10,1)) * cast(CITO.valor_unitario as decimal(10,1))) AS total_tarefa FROM const_orcamento AS CO INNER JOIN const_sub_empreendimento AS CSE ON CO.id_empreendimento = CSE.id INNER JOIN empreendimento_cadastro AS EC ON CSE.id_empreendimento = EC.idempreendimento_cadastro INNER JOIN const_item_tarefa_orcamento AS CITO ON CO.id = CITO.id_orcamento WHERE EC.idempreendimento_cadastro =  ".$assoc_master['idempreendimento_cadastro']." ")or die($db);
												
												// var_dump($query_2);
												// die();
												//retorno da query vazio ?
												if(mysqli_num_rows($query_2)){
													$assoc_total_oc = mysqli_fetch_assoc($query_2);

													$total_tarefa = ($assoc_total_oc['total_tarefa']);
												}
												// var_dump($total_tarefa + $total_insumo);
												$ind = intval($assoc_master['idempreendimento_cadastro']);
												if ($ind > 1){
													// $media_orcado[$ind] = number_format((($total_tarefa + $total_insumo)/5), 2, '.', '');
													$media_orcado[$ind] = ($total_tarefa + $total_insumo)/5;



												}
												
												// var_dump($media_orcado);
												// var_dump($ind);
												// die();

											 ?>
											<p>R$ <?php echo number_format(($total_tarefa + $total_insumo), 2, ',', '.'); ?></p>	
										</div>
										<div class="stats-link">
											<a href="javascript:;">Veja Mais <i class="fa fa-arrow-circle-o-right"></i></a>
										</div>
									</div>
								</div>
								
							</div>

							<div class="panel panel-inverse col-md-12" data-sortable-id="index-1">
								<div class="panel-heading">
									<div class="panel-heading-btn">
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
									</div>
									<h4 class="panel-title">CUSTO DE MATERIAIS</h4>
								</div>
								<div class="panel-body">
									<div id="interactive-chart<?php echo $assoc_master['idempreendimento_cadastro']; ?>" class="height-sm" style="padding: 0px; position: relative;"></div>
								</div>
							</div>
						</div>
					</div>

					<?php

					}
				}
			 ?>

		</div>
		
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

	    <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	    <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js"></script>
	    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/plugins/gritter/js/jquery.gritter.js"></script>

		<!-- ================== END BASE JS ================== -->
		
		<script src="https://immobilebusiness.com.br/admin/assets/plugins/flot/jquery.flot.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/plugins/flot/jquery.flot.time.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/plugins/flot/jquery.flot.resize.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/plugins/flot/jquery.flot.pie.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/plugins/sparkline/jquery.sparkline.js"></script>

		<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/morris/raphael.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/morris/morris.js"></script>

	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

	<script>
		var aspkey = '<?php echo $publickey; ?>';
	</script>
	<script>
		var id_user = '<?php echo $imobiliaria_idimobiliaria; ?>';
	</script>
	<script src="js/main.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script type="text/javascript">

		<?php 

			include "conexao.php";

			$query = mysqli_query($db, "SELECT STR_TO_DATE(data, '%d-%m-%Y') AS data_primeira FROM const_recebimento_material ORDER BY data_primeira ASC LIMIT 1")or die(mysqli_error($db));

			$assoc = mysqli_fetch_assoc($query);
			$assoc = $assoc['data_primeira'];

			

			$data_inicio = date('m', strtotime($assoc));
			$data_atual = date('m');

			// echo $data_inicio;
			// echo "<br>";
			// echo $data_atual;
			// echo date('Y').'-'.($data_inicio + 1).'-01';


			$mes[1] = "jan";
			$mes[2] = "Fev";
			$mes[3] = "Mar";
			$mes[4] = "Abri";
			$mes[5] = "Maio";
			$mes[6] = "jun";
			$mes[7] = "jul";
			$mes[8] = "Ago";
			$mes[9] = "Set";
			$mes[10] = "Out";
			$mes[11] = "Nov";
			$mes[12] = "Dez";

	?>

		var blue = "#348fe2"
		  , blueLight = "#5da5e8"
		  , blueDark = "#1993E4"
		  , aqua = "#49b6d6"
		  , aquaLight = "#6dc5de"
		  , aquaDark = "#3a92ab"
		  , green = "#00acac"
		  , greenLight = "#33bdbd"
		  , greenDark = "#008a8a"
		  , orange = "#f59c1a"
		  , orangeLight = "#f7b048"
		  , orangeDark = "#c47d15"
		  , dark = "#2d353c"
		  , grey = "#b6c2c9"
		  , purple = "#727cb6"
		  , purpleLight = "#8e96c5"
		  , purpleDark = "#5b6392"
		  , red = "#ff5b57";


		  <?php 

		  $query_master  = mysqli_query($db, "SELECT * FROM `empreendimento_cadastro`")or die($db);

		  if(mysqli_num_rows($query_master)){
		  	while ($assoc_master = mysqli_fetch_assoc($query_master)) { //pega o empreendimento

			?>
			
			var handleInteractiveChart<?php echo $assoc_master['idempreendimento_cadastro']; ?> = function() {
			    "use strict";
			    function e(e, t, n) {
			        $('<div id="tooltip" class="flot-tooltip">' + n + "</div>").css({
			            top: t - 45,
			            left: e - 55
			        }).appendTo("body").fadeIn(200);
			    }

				

			    if ($("#interactive-chart<?php echo $assoc_master['idempreendimento_cadastro']; ?>").length !== 0) {
			        	
					
					
    		        var t = [
    		          			
    		        		[1, <?php echo $gasto_mes[$assoc_master['idempreendimento_cadastro']]; ?>],
    		        		[2, <?php echo $gasto_mes[$assoc_master['idempreendimento_cadastro']]; ?>],
    		        		[3, <?php echo $gasto_mes[$assoc_master['idempreendimento_cadastro']]; ?>],
    		        		[4, <?php echo $gasto_mes[$assoc_master['idempreendimento_cadastro']]; ?>],
    		        		[5, <?php echo $gasto_mes[$assoc_master['idempreendimento_cadastro']]; ?>],

					  ];

    		          var n = [
						
    		            [1, <?php echo $media_orcado[$assoc_master['idempreendimento_cadastro']]; ?>],
		        		[2, <?php echo $media_orcado[$assoc_master['idempreendimento_cadastro']]; ?>],
		        		[3, <?php echo $media_orcado[$assoc_master['idempreendimento_cadastro']]; ?>],
		        		[4, <?php echo $media_orcado[$assoc_master['idempreendimento_cadastro']]; ?>],
		        		[5, <?php echo $media_orcado[$assoc_master['idempreendimento_cadastro']]; ?>],

					  ];
					  
    		          var r = [
    		          
    		            [1, 'janeiro'],
		        		[2, 'fevereiro'],
		        		[3, 'março'],
		        		[4, 'abril'],
		        		[5, 'maio'],

    		          ];
			        $.plot($("#interactive-chart<?php echo $assoc_master['idempreendimento_cadastro'];?>"), [{
			            data: t,
			            label: "Valor Gasto: R$ ",
			            color: blue,
			            lines: {
			                show: true,
			                fill: false,
			                lineWidth: 2
			            },
			            points: {
			                show: true,
			                radius: 3,
			                fillColor: "#fff"
			            },
			            shadowSize: 0
			        }, {
			            data: n,
			            label: "Valor Orcado: R$ ",
			            color: green,
			            lines: {
			                show: true,
			                fill: false,
			                lineWidth: 2
			            },
			            points: {
			                show: true,
			                radius: 3,
			                fillColor: "#fff"
			            },
			            shadowSize: 0
			        }], {
			            xaxis: {
			                ticks: r,
			                tickDecimals: 0,
			                tickColor: "#ddd"
			            },
			            yaxis: {
			                ticks: 10,
			                tickColor: "#ddd",
			                min: 0,
			                max: 1000000
			            },
			            grid: {
			                hoverable: true,
			                clickable: true,
			                tickColor: "#ddd",
			                borderWidth: 1,
			                backgroundColor: "#fff",
			                borderColor: "#ddd"
			            },
			            legend: {
			                labelBoxBorderColor: "#ddd",
			                margin: 10,
			                noColumns: 1,
			                show: true
			            }
			        });
			        var i = null;
			        $("#interactive-chart<?php echo $assoc_master['idempreendimento_cadastro'];?>").bind("plothover", function(t, n, r) {
			            $("#x").text(n.x.toFixed(2));
			            $("#y").text(n.y.toFixed(2));
			            if (r) {
			                if (i !== r.dataIndex) {
			                    i = r.dataIndex;
			                    $("#tooltip").remove();
			                    var s = r.datapoint[1].toFixed(2);
			                    var o = r.series.label + " " + s;
			                    e(r.pageX, r.pageY, o)
			                }
			            } else {
			                $("#tooltip").remove();
			                i = null
			            }
			            t.preventDefault()
			        })
			    }
			};

		<?php 
				}

			}
		 ?>


			var Dashboard = function() {
			    "use strict";
			    return {
			        init: function() {
			        	<?php 

			        	$query_master  = mysqli_query($db, "SELECT * FROM `empreendimento_cadastro`")or die($db);

			        	if(mysqli_num_rows($query_master)){
			        		while ($assoc_master = mysqli_fetch_assoc($query_master)) {

			        	?>
			        	handleInteractiveChart<?php echo $assoc_master['idempreendimento_cadastro']; ?>();

			        	<?php 
			        			}

			        		}
			        	 ?>
			           
			        }
			    }
			}();

			

	</script>

	<script>
		$(document).ready(function() {
			App.init();
			Dashboard.init();
			// MorrisChart.init();
		});

		
	</script>

	<script>
	    if ('serviceWorker' in navigator) {
	      navigator.serviceWorker.register('mysw.js')
	        .then(function () {
	          console.log('service worker registered');
	        })
	        .catch(function () {
	          console.warn('service worker failed');
	        });
	    }
	  </script>
	
</body>

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/index_v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:09:13 GMT -->
</html>
