<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );

include "protege_professor.php";
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br">
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title>Immobile | Business</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets\plugins\jquery-ui\themes\base\minified\jquery-ui.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />

	
	<!-- ================== END BASE CSS STYLE ================== -->

	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />

	<!-- ================== BEGIN PAGE CSS ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />

	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->



</head>
<body>

	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
		<!-- begin #header -->
		


		<?php 

		include "topo.php";
		include "conexao.php";

		$queryrota="SELECT crm_statusid FROM crm_grupostatus WHERE crm_idgrupo = '$idgrupo_acesso'"; 
		

		$execrota = mysqli_query($db, $queryrota) or die(mysqli_error());

		$querycont = mysqli_num_rows($execrota);

		$controta = 0;

		while($receberota = mysqli_fetch_assoc($execrota)) {

			$rotastatus[$controta]  = $receberota["crm_statusid"];
			

			$wherests .= " crm_statuscli = " . $rotastatus[$controta];

			if ($controta < ($querycont -1)) {
				$wherests .= " OR";
			}

			$controta ++;
		} 


		function nomestatus($id){

			include "conexao.php";

			$querystatus = "SELECT * FROM crm_status WHERE crm_idstatus = $id";

			$execquerystatus = mysqli_query($db, $querystatus);

			while ($buscastatus = mysqli_fetch_assoc($execquerystatus)) {
				
				$status['nome'][] = $buscastatus["crm_status"];
				$status['nome'][] = $buscastatus["crm_cor"];
			}

			return $status;
		}

		function origemcont($id, $nome, $idgrupo_acesso, $imobiliaria_idimobiliaria, $wherests){

			include "conexao.php";

			if ($idgrupo_acesso == 7) { //Corretor
				$where = 'WHERE crm_idcorretor = ' . $imobiliaria_idimobiliaria;
					} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 13 ) { //imobiliária
				$where = 'WHERE crm_idimob = ' . $imobiliaria_idimobiliaria;
					} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9 || $idgrupo_acesso == 11) { //Administrador
				$where = 'WHERE crm_id > 0';
					} else { $where = 'WHERE crm_id < 0'; echo "Permissão de grupo não encontrada!";}

			$queryorigem = "SELECT count(crm_id) AS id FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_id = crm_idcli $where AND ($wherests) AND crm_origem = $id";


			$execqueryorigem = mysqli_query($db, $queryorigem) or die("Parceiros não encontrados!");

			while ($buscaorigem = mysqli_fetch_assoc($execqueryorigem)) {
				
				$origem[$nome] = $buscaorigem["id"];	
			}

			return $origem;
		}

################################################################################################
#######################################para painel##############################################
################################################################################################

		include "conexao.php";

			if ($idgrupo_acesso == 7) { //Corretor
				$wherest = 'WHERE crm_idcorretor = ' . $imobiliaria_idimobiliaria;
					} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 13 ) { //imobiliária
				$wherest = 'WHERE crm_idimob = ' . $imobiliaria_idimobiliaria;
					} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9 || $idgrupo_acesso == 11) { //Administrador
				$wherest = 'WHERE crm_id > 0';
					} else { $where = 'WHERE crm_id < 0'; echo "Permissão de grupo não encontrada!";}

								$query_amigo = "SELECT count(*) as id FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_id = crm_idcli $wherest AND ($wherests) AND crm_id > 0";


								$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

								while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {

									$contalead = $buscar_amigo["id"];
								}


								$query_amigo = "SELECT * FROM crm_painel WHERE crm_tipopainel = 4";
								$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	$id                 = $buscar_amigo['crm_statuspainel'];
	$vetpositivo[] = $id;
	$query_amigo2 = "SELECT count(crm_id) as id FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_id = crm_idcli $wherest AND ($wherests) AND crm_statuscli = $id";
	$executa_query2 = mysqli_query ($db,$query_amigo2) or die ("Erro ao listar contatos");
	while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query2)) {

		$positivo += $buscar_amigo2["id"];


	}

}

$query_amigo = "SELECT * FROM crm_painel WHERE crm_tipopainel = 5";
$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	$id                 = $buscar_amigo['crm_statuspainel'];
	$vetnegativo[] = $id;
	$query_amigo2 = "SELECT count(crm_id) as id FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_id = crm_idcli $wherest AND ($wherests) AND crm_statuscli = $id";

	$executa_query2 = mysqli_query ($db,$query_amigo2) or die ("Erro ao listar contatos");
	while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query2)) {

		$negativo += $buscar_amigo2["id"];


	}

}

$query_amigo = "SELECT * FROM crm_painel WHERE crm_tipopainel = 6";
$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	$id                 = $buscar_amigo['crm_statuspainel'];
	$vetatt[] = $id;
	$query_amigo2 = "SELECT count(crm_id) as id FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_id = crm_idcli $wherest AND ($wherests) AND crm_statuscli = $id";
	$executa_query2 = mysqli_query ($db,$query_amigo2) or die ("Erro ao listar contatos");
	while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query2)) {

		$att += $buscar_amigo2["id"];


	}

}

$query_amigo = "SELECT * FROM crm_painel WHERE crm_tipopainel = 7";
$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	$id                 = $buscar_amigo['crm_statuspainel'];

	$vetarquivo[] = $id;

	$query_amigo2 = "SELECT count(crm_id) as id FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_id = crm_idcli $wherest AND ($wherests) AND crm_statuscli = $id";
	$executa_query2 = mysqli_query ($db,$query_amigo2) or die ("Erro ao listar contatos");
	while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query2)) {

		$arquivo += $buscar_amigo2["id"];


	}

}


################################################################################################
########################################para painel#############################################
################################################################################################
?>
<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->

	<!-- begin page-header -->
	<h1 class="page-header">CRM | Immobile</h1>
	<!-- end page-header -->

	<!-- begin row -->
	<div class="row">
		<?php 
		$contador = 0;
		$cnt = 0;
		?>
		<div class="col-md-3 col-sm-6" onclick="location.href='crm_tratalead.php?dshb<?php echo $contador ?>=<?php foreach($vetpositivo as $pos){
			$contarray = count($vetpositivo);
			echo $vetpositivo[$cnt]; 
			if ($cnt < ($contarray -1)) {
			$contador++;
			echo "&dshb$contador=";
		}
			$cnt ++;
		} ?> '">
			<div class="widget widget-stats bg-green">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-user"></i></div>
				<div class="stats-title">Atendimento Positivo</div>
				<div class="stats-number"><?php echo $positivo; ?></div>
				<div class="stats-progress progress">
					<div class="progress-bar" style="width: 100%;"></div>
				</div>
				<div class="stats-desc"></div>

			</div>
		</div>
		<!-- end col-3 -->
		<?php 
		$contador = 0;
		$cnt = 0;
		?>
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6" onclick="location.href='crm_tratalead.php?dshb<?php echo $contador ?>=<?php foreach($vetnegativo as $pos){
			$contarray = count($vetnegativo);
			echo $vetnegativo[$cnt]; 
			if ($cnt < ($contarray -1)) {
			$contador++;
			echo "&dshb$contador=";
		}
			$cnt ++;
		} ?> '">
			<div class="widget widget-stats bg-blue">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-building"></i></div>
				<div class="stats-title">Atendimento Negativo</div>
				<div class="stats-number"><?php echo $negativo; ?></div>
				<div class="stats-progress progress">
					<div class="progress-bar" style="width: 100%;"></div>
				</div>
				<div class="stats-desc"></div>
			</div>
		</div>
		<!-- end col-3 -->
		<?php 
		$contador = 0;
		$cnt = 0;
		?>
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6" onclick="location.href='crm_tratalead.php?dshb<?php echo $contador ?>=<?php foreach($vetatt as $pos){
			$contarray = count($vetatt);
			echo $vetatt[$cnt]; 
			if ($cnt < ($contarray -1)) {
			$contador++;
			echo "&dshb$contador=";
		}
			$cnt ++;
		} ?> '">
			<div class="widget widget-stats bg-purple">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-mail-reply-all"></i></div>
				<div class="stats-title">Em Atendimento</div>
				<div class="stats-number"><?php echo $att; ?></div>
				<div class="stats-progress progress">
					<div class="progress-bar" style="width: 100%;"></div>
				</div>
				<div class="stats-desc"></div>
			</div>
		</div>
		<!-- end col-3 -->
		<?php 
		$contador = 0;
		$cnt = 0;
		?>
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6" onclick="location.href='crm_tratalead.php?dshb<?php echo $contador ?>=<?php foreach($vetarquivo as $pos){
			$contarray = count($vetarquivo);
			echo $vetarquivo[$cnt]; 
			if ($cnt < ($contarray -1)) {
			$contador++;
			echo "&dshb$contador=";
		}
			$cnt ++;
		} ?> '">
			<div class="widget widget-stats bg-black">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-archive"></i></div>
				<div class="stats-title">Arquivo</div>
				<div class="stats-number"><?php echo $arquivo; ?></div>
				<div class="stats-progress progress">
					<div class="progress-bar" style="width: 100%;"></div>
				</div>
				<div class="stats-desc"></div>
			</div>
		</div>
	</div>
	<!-- end col-3 -->

	<!-- begin row -->
	<div class="row">
		<div class="col-md-8">

			<div class="widget-chart with-sidebar bg-black">

				<div class="widget-chart-content">

					<h4 class="chart-title">
						Leads Captados
						<small>Fluxo de leads captados por mês</small>
					</h4>
					<div id="visitors-line-chart" class="morris-inverse" style="height: 260px;"></div>
				</div>
				<div class="widget-chart-sidebar bg-black-darker">
					<div class="chart-number">
						<?php echo $contalead ?> <br>total Leads

					</div>
					<div id="visitors-donut-chart" style="height: 160px"></div>
					<ul class="chart-legend" style="display: none;">
						<li><i class="fa fa-circle-o fa-fw text-success m-r-5"></i> 34.0% <span>Novos Cadastros</span></li>
						<li><i class="fa fa-circle-o fa-fw text-primary m-r-5"></i> 56.0% <span>Cadastros Antigos</span></li>
					</ul>

				</div>
			</div>
		</div>
		<!-- ################################################################################# -->
		<!-- ################################################################################# -->
		<!-- ################################################################################# -->

		<div class="col-md-4">
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<?php 
				include "conexao.php";

				$queryorigem = "SELECT * FROM crm_origem";

				$execqueryorigem = mysqli_query($db, $queryorigem);

				while ($buscaorigem = mysqli_fetch_assoc($execqueryorigem)) {

					$ido = $buscaorigem["crm_idorigem"];
					$nomeo = $buscaorigem["crm_origemnome"];

					$data3[$ido] = origemcont($ido, $nomeo, $idgrupo_acesso, $imobiliaria_idimobiliaria, $wherests);
				}



				?>

				<div class="list-group">
					<a href="crm_tratalead.php?org=2" class="list-group-item text-ellipsis">
						<span class="fa-stack fa-2x text-primary">
							<i class="fa fa-square-o fa-stack-2x"></i>
							<i class="fa fa-facebook fa-stack-1x"></i>
						</span>
						<span class="badge badge-primary"><?php echo $data3[2]['Facebook']; ?></span>Facebook
					</a>
					<a href="crm_tratalead.php?org=19" class="list-group-item text-ellipsis">
						<span class="fa-stack fa-2x text-success">
							<i class="fa fa-whatsapp fa-stack-2x"></i>
						</span>
						<span class="badge badge-success"><?php echo $data3[19]['WhatsApp']; ?></span>Whatsapp
					</a> <input type="hidden" id="imobiliaria_idimobiliaria" name="imobiliaria_idimobiliaria" class="form-control" value="<?php echo $imobiliaria_idimobiliaria ; ?>">  
					<a href="crm_tratalead.php?org=1" class="list-group-item text-ellipsis">
						<span class="fa-stack fa-2x text-ellipsis">

							<i class="fa fa-home fa-stack-2x"></i>
						</span>
						<span class="badge badge-inverse"><?php echo $data3[1]['Imobiliaria']; ?></span>Imobiliária
					</a>
					<a href="crm_tratalead.php?org=16" class="list-group-item text-ellipsis">
						<span class="fa-stack fa-2x text-inverse">
							<i class="fa fa-desktop fa-stack-2x"></i>
						</span>
						<span class="badge badge-danger"><?php echo $data3[16]['Site Immobile']; ?></span>Site
					</a> 
					<a href="crm_listaorigem.php" class="list-group-item text-ellipsis">
						<span class="fa-stack fa-2x text-success">
							<i class="fa fa-globe fa-stack-2x"></i>
						</span>
						<span class="badge badge-success"><?php echo $data3[10]['QR-Code'] + $data3[11]['Outdoor'] + $data3[12]['Jornal'] + $data3[20]['Placa de Imóveis'] + $data3[21]['ABIFRAN']; ?></span>OUTROS
					</a> 
				</div>
			</div>
			<!-- end panel -->
		</div>
		<!-- ################################################################################# -->
		<!-- ################################################################################# -->
		<!-- ################################################################################# -->

	</div>
	<!-- end row -->

	<!-- begin row -->
	<div class="row">
		<!-- begin col-4 -->
		<div class="col-md-6">
			<!-- begin panel -->
			<div class="panel panel-inverse" data-sortable-id="index-4">
				<div class="panel-heading">
					<div class="panel-title">Quadro de Pontuação<span class="pull-right"> 
						<select class="form-control" name="interessepts" id="interessepts" >
															


															<?php 
					include "conexao.php";
					$query_c = "SELECT empreendimento_cadastro_id as id, descricao_empreendimento 
					FROM empreendimento
					INNER JOIN empreendimento_cadastro ON empreendimento_cadastro_id = idempreendimento_cadastro

					order by descricao_empreendimento asc";
															$executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento");


            while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos

            	$id             = $buscar_amigoc['id'];
            	$descricao      = $buscar_amigoc['descricao_empreendimento'];
            	?>
            	<option value="<?php echo $id ?> "><?php echo $descricao ?></option>
            <?php }  ?>
        </select>

					</span></div>
				</div>
				<ul class="registered-users-list clearfix" id="listapts">
					
				</ul>
				<div class="panel-footer text-center">
					<a href="#" class="text-inverse">Ver Todos</a>
				</div>
			</div>
			<!-- end panel -->
		</div>
		<!-- end col-4 -->
		<!-- begin col-4 -->
		<div class="col-md-4">
			<!-- begin panel -->
			<div class="panel panel-inverse" data-sortable-id="index-3">
				<div class="panel-heading">
					<h4 class="panel-title">Calendário</h4>
				</div>
				<div id="schedule-calendar" class="bootstrap-calendar" id="cld"></div>
				<div class="list-group" style="max-height: 150px; margin-bottom: 10px; overflow:scroll;-webkit-overflow-scrolling: touch;">
					<a href="#cld" class="list-group-item text-center" style="font-size: 25px;">
						<b> Leads do dia:</b>
					</a> 

					<?php  

					include "conexao.php";

							if ($idgrupo_acesso == 7) { //Corretor
								$where = 'WHERE crm_idcorretor = ' . $imobiliaria_idimobiliaria;
							} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 13 ) { //imobiliária
								$where = 'WHERE crm_idimob = ' . $imobiliaria_idimobiliaria;
								} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9 || $idgrupo_acesso == 11) { //Administrador
									$where = 'WHERE crm_id > 0';

								} else { $where = 'WHERE crm_id < 0'; echo "Permissão de grupo não encontrada!";}

								$dtl = date('d-m-Y');
								$queryl = "SELECT crm_nome AS nome, crm_id AS idl, crm_statusdata AS venc, crm_statuscli AS sts FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_id = crm_idcli $where AND crm_statusdata = '$dtl'";


								$execqueryl = mysqli_query($db, $queryl) or die("Erro fatal!");

								while ($buscadatal = mysqli_fetch_assoc($execqueryl)) {

									$idl = $buscadatal["idl"];

									$statusl = $buscadatal["sts"];
									$nomel = $buscadatal["nome"];
									
									$Anome = nomestatus($statusl);

									$statusatual = $statusl;

									if (in_array($statusatual, $rotastatus)){
										?>
										<a href="crm_fichalead.php?numero=<?php echo $idl ?>" class="list-group-item text-ellipsis">
											<span class="badge badge-primary" style="background-color: <?php echo $Anome['nome'][1] ?>;"><?php echo $Anome['nome'][0] ?></span> <?php echo utf8_encode($nomel) ?>
										</a>

									<?php } } 
									?>


								</div>
							</div>
							<!-- end panel -->
						</div>
						<!-- end col-4 -->
						
					</div>
					<!-- end row -->
				</div>

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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/morris/raphael.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/morris/morris.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

	
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/clipboard/clipboard.min.js"></script>

	<!-- ================== END PAGE LEVEL JS ================== -->
<script>

	$(document).ready( function() {

   
<?php 
           if ($idgrupo_acesso == 7) { //Corretor
           	?>

								$.ajax({
                url : 'crm_contapontos.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'ctrr=' + $('#imobiliaria_idimobiliaria').val()+'&int=' + $('#interessepts').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: data =>
                {
                $('#listapts').html(data)
                $('#listapts').change()
                
                }
           });

									/* Executa a requisição quando o campo CEP perder o foco */
   $('#interessepts').on('change', function(){
           /* Configura a requisição AJAX */
									$.ajax({
                url : 'crm_contapontos.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'ctrr=' + $('#imobiliaria_idimobiliaria').val()+'&int=' + $('#interessepts').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: data =>
                {
                $('#listapts').html(data)
                $('#listapts').change()
                
                }
           }); 
									return false;    
   });

								<?php
							} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 13 ) { //imobiliária
								
?>

											$.ajax({
                url : 'crm_contapontos.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'ctr=' + $('#imobiliaria_idimobiliaria').val()+'&int=' + $('#interessepts').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: data =>
                {
                $('#listapts').html(data)
                $('#listapts').change()
                
                }
           });

									/* Executa a requisição quando o campo CEP perder o foco */
   $('#interessepts').on('change', function(){
           /* Configura a requisição AJAX */
									$.ajax({
                url : 'crm_contapontos.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'ctr=' + $('#imobiliaria_idimobiliaria').val()+'&int=' + $('#interessepts').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: data =>
                {
                $('#listapts').html(data)
                $('#listapts').change()
                
                }
           }); 
									return false;    
   });
								<?php	

								} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9 || $idgrupo_acesso == 11) {
									?>

											$.ajax({
                url : 'crm_contapontos.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'id=' + $('#interessepts').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: data =>
                {
                $('#listapts').html(data)
                $('#listapts').change()
                }
           });



									/* Executa a requisição quando o campo CEP perder o foco */
   $('#interessepts').on('change', function(){
            /* Configura a requisição AJAX */
									$.ajax({
                url : 'crm_contapontos.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'id=' + $('#interessepts').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: data =>
                {
                $('#listapts').html(data)
                $('#listapts').change()
                
                }
           }); 
									return false;    
   })
									<?php 

								} else { $where = 'WHERE crm_id < 0'; echo "Permissão de grupo não encontrada!";}

?>
              
  
});
</script>

	<script type="text/javascript">
		var getMonthName=function(e){var t=[];t[0]="Janeiro";t[1]="Fevereiro";t[2]="Março";t[3]="Abril";t[4]="Maio";t[5]="Junho";t[6]="Julho";t[7]="Agosto";t[8]="Setembro";t[9]="Outubro";t[10]="Novembro";t[11]="Dezembro";return t[e]};

		var getDate=function(e){var t=new Date(e);var n=t.getDate();var r=t.getMonth()+1;var i=t.getFullYear();if(n<10){n="0"+n}if(r<10){r="0"+r}t=i+"-"+r+"-"+n;return t};

		var handleVisitorsLineChart=function(){
			var e="#0D888B";
			var t="#00ACAC";
			var n="#3273B1";
			var r="#348FE2";
			var i="rgba(0,0,0,0.6)";
			var s="rgba(255,255,255,0.4)";

			Morris.Line({
				element:"visitors-line-chart",
				data:[
				<?php 
				include "conexao.php";

				$query = "SELECT count(crm_data_cadastro) as cont, crm_data_cadastro as venc FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_id = crm_idcli WHERE crm_statuscli != 18 GROUP BY SUBSTR( venc, 7, 4), SUBSTR( venc, 4, 2)";
				$exec = mysqli_query ($db, $query);
				$cont2 = 0;
				$query2 = "SELECT count(crm_id) as cont2, crm_data_cadastro as venc2 FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_id = crm_idcli WHERE crm_statuscli = 18 GROUP BY SUBSTR( venc2, 7, 4), SUBSTR( venc2, 4, 2)";
				if ($exec2 = mysqli_query ($db, $query2)) {
					foreach ($exec2 as $key2) {
						$datacad2 = $key2["venc2"];
						$datacad2 = date('Y-m', strtotime($datacad2));
						$cont2 += $key2["cont2"];

						?>

						{x:"<?php echo $datacad2 ?>",y:<?php echo $cont2 ; ?>,z:<?php echo $cont2 ?>}, 
					<?php } 
					} 

					foreach ($exec as $key) {
						$datacad = $key["venc"];
						$datacad = date('Y-m', strtotime($datacad));
						$cont = $key["cont"];

						?>

						{x:"<?php echo $datacad ?>",y:<?php echo $cont ++; ?>,z:<?php echo '0' ?>}, <?php } ?> 


						],


						xkey:"x",ykeys:["y","z"],xLabelFormat:function(e){e=getMonthName(e.getMonth());return e.toString()},labels:["Cadastros","Vendido"],lineColors:[e,n],pointFillColors:[t,r],lineWidth:"2px",pointStrokeColors:[i,i],resize:true,gridTextFamily:"Open Sans",gridTextColor:s,gridTextWeight:"normal",gridTextSize:"11px",gridLineColor:"rgba(0,0,0,0.5)",hideHover:"auto"})};

			var handleVisitorsDonutChart=function(){
				var e="#00acac";
				var t="#348fe2";
				Morris.Donut({
					element:"visitors-donut-chart",
					data:[
					{label:"Cadastros",value:<?php echo $contalead ?>},
					{label:"Total de Vendas",value:<?php echo $cont2 ?>}

					],

					colors:[e,t],labelFamily:"Open Sans",labelColor:"rgba(255,255,255,0.4)",labelTextSize:"12px",backgroundColor:"#242a30"})};

				handleScheduleCalendar=function(){

					<?php  

					include "conexao.php";

						 if ($idgrupo_acesso == 7) { //Corretor
						 	$where = 'WHERE crm_idcorretor = ' . $imobiliaria_idimobiliaria;
							} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 13 ) { //imobiliária
								$where = 'WHERE crm_idimob = ' . $imobiliaria_idimobiliaria;
								} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9 || $idgrupo_acesso == 11) { //Administrador
									$where = 'WHERE crm_id > 0';

								} else { $where = 'WHERE crm_id < 0'; echo "Permissão de grupo não encontrada!";}



								$queryc = "SELECT COUNT(crm_id) as idc, crm_statusdata AS venc, crm_statuscli AS sts FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_id = crm_idcli $where AND ($wherests) AND crm_id > 0 GROUP BY SUBSTR( venc, 7, 4), SUBSTR( venc, 4, 2), SUBSTR( venc, 1, 2)";

								$execqueryc = mysqli_query($db, $queryc) or die("Erro fatal!");

								while ($buscadata = mysqli_fetch_assoc($execqueryc)) {

									$contid = $buscadata["idc"];
									$datac = $buscadata["venc"];
									
									$sts = $buscadata["sts"];
									$x['data'][] = $datac;
									$x['nlead'][] = $contid;
									
								} 
								?>



								var a=["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
								b=["D","S","T","Q","Q","S","S"],
								c=new Date,
								d=c.getMonth()+1,
								e=c.getFullYear(),
								f=[ <?php 

									$cont = 0;
									foreach($x['data'] as $valor) {


										$arrayData = explode("-",$valor);

// Imprimindo os dados:
										$dia = intval($arrayData[0]);
										$mes = intval($arrayData[1]);
										$ano = $arrayData[2];

										?>	


										["<?php echo "$dia/$mes/$ano";?>","Leads no grupo: <?php echo $x['nlead'][$cont];?>","#","<?php if (strtotime("$dia-$mes-$ano") > strtotime(date("d-m-Y"))) {echo "blue";} else if (strtotime("$dia-$mes-$ano") == strtotime(date("d-m-Y"))) {echo "green";} else {echo "red";}?>",'<div class="text-center"><a href="crm_tratalead.php?dsh=<?php echo "$dia-$mes-$ano" ?>">Ir para Leads</a></div>'],


										<?php $cont++; } ?>

		/*["5/3/"+e,"Tooltip with link","#","brown"],
		["18/"+d+"/"+e,"Popover with HTML Content","#","blue",'Some contents here <div class="text-right"><a href="http://www.google.com">view more >>></a></div>'],
		["28/"+d+"/"+e,"Immobile Business","http://www.immobilebusiness.com.br","Grey"]*/
		],
		g=$("#schedule-calendar");

		$(g).calendar({months:a,days:b,events:f,popover_options:{placement:"top",html:!0}}),
		$(g).find("td.event").each(function(){var a=$(this).css("background-color");
			$(this).removeAttr("style"),
			$(this).find("a").css("background-color",a)}),
		$(g).find(".icon-arrow-left, .icon-arrow-right").parent().on("click",function(){$(g).find("td.event").each(function(){var a=$(this).css("background-color");
			$(this).removeAttr("style"),
			$(this).find("a").css("background-color",a)})})
	}


	var DashboardV2=function(){"use strict";return{init:function(){handleVisitorsLineChart();handleVisitorsDonutChart();handleScheduleCalendar();}}}()
</script>
 <script type="text/javascript">
    	
    		function abreCorretor(imob){
    			$.ajax({
                url : 'crm_contapontos.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'ctr=' + imob +'&int=' + $('#interessepts').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: data =>
                {
                $('#listapts').html(data)
                $('#listapts').change()
                
                }
           });

    			//document.getElementById("listapts").innerHTML = "CORRETOR AQUI";
    		}

    </script>

<script type="text/javascript"> 

	document.getElementById('menucrm').style.display="block";

</script>

<script>
	$(document).ready(function() {
		App.init();
		DashboardV2.init();
	});
</script>

</body>



</html>