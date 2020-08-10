<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
if (!isset($_SESSION)) {
	session_start();
}
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



	<?php 
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
?>
<script type="text/javascript">

		function excluir(){

			document.nome.action = "crm_excluirorigem.php";
			document.nome.submit();

		}

		

	</script>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

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
		 ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
						<!-- begin page-header -->
			
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">

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
							<h4 class="panel-title">Origem dos Leads</h4>
						</div>

						<div class="panel-body">
							
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
<div class="col-md-6">
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
						<span class="badge badge-dark"><?php echo $data3[1]['Imobiliaria']; ?></span>Imobiliária
					</a>
					<a href="crm_tratalead.php?org=16" class="list-group-item text-ellipsis">
						<span class="fa-stack fa-2x text-primary">
							<i class="fa fa-desktop fa-stack-2x"></i>
						</span>
						<span class="badge badge-primary"><?php echo $data3[16]['Site Immobile']; ?></span>Site
					</a> 
					<a href="crm_tratalead.php?org=10" class="list-group-item text-ellipsis">
						<span class="fa-stack fa-2x text-inverse">
							<i class="fa fa-qrcode fa-stack-2x"></i>
						</span>
						<span class="badge badge-inverse"><?php echo $data3[10]['QR-Code']; ?></span>QR-Code
					</a>
				</div>
				  
			</div>
			<!-- end panel -->
		<div class="col-md-6">
		<div class="list-group">
					<a href="crm_tratalead.php?org=11" class="list-group-item text-ellipsis">
						<span class="fa-stack fa-2x text-success">
							<i class="fa fa-terminal fa-stack-2x"></i>
						</span>
						<span class="badge badge-success"><?php echo $data3[11]['Outdoor']; ?></span>Outdoor
					</a> 
					<a href="crm_tratalead.php?org=12" class="list-group-item text-ellipsis">
						<span class="fa-stack fa-2x text-warning">
							<i class="fa fa-file-text fa-stack-2x"></i>
						</span>
						<span class="badge badge-warning"><?php echo $data3[12]['Jornal']; ?></span>Jornal
					</a> 
					<a href="crm_tratalead.php?org=20" class="list-group-item text-ellipsis">
						<span class="fa-stack fa-2x text-danger">
							<i class="fa fa-language fa-stack-2x"></i>
						</span>
						<span class="badge badge-danger"><?php echo $data3[20]['Placa de Imóveis']; ?></span>Placas
					</a> 
					<a href="crm_tratalead.php?org=21" class="list-group-item text-ellipsis">
						<span class="fa-stack fa-2x text-dark">
							<i class="fa fa-institution fa-stack-2x"></i>
						</span>
						<span class="badge badge-dark"><?php echo $data3[21]['ABIFRAN']; ?></span>ABIFRAN
					</a>
					</div>
					</div>
				</div>
</div>
</div>
<!-- end panel -->
</div>
<!-- end col-10 -->
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
<script type="text/javascript"> 

	document.getElementById('menucrm').style.display="block";

</script>
		<script>
			$(document).ready(function() {
				App.init();
				TableManageButtons.init();
				Notification.init();
			});
		</script>

	</body>


	</html>
