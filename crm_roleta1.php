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
	
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<h1 class="page-header">Trilha de Vendas</h1>
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
							<h4 class="panel-title">Vendedores</h4>
						</div>

						<div class="panel-body">
							<form class="form-vertical form-bordered" name="myForm" method="POST" action="crm_tratalead.php?filtro=2">

								<div class="form-group">
									<label class="col-md-2 control-label">Empreendimento</label>
									<div class="col-md-4">
										<div class="">
											<select name="statusfil" class="form-control">
												<option value="">Selecione um Empreendimento</option>
												<?php 

												include "conexao.php";
												$query_slide = mysqli_query($db,"SELECT idempreendimento_cadastro, descricao_empreendimento FROM empreendimento_cadastro") or die ("Erro ao listar grupo dos empreendimentos, tente mais tarde");


									            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

									            	$idempreendimento_cadastro      = $buscar_slide["idempreendimento_cadastro"];
               										$descricao_empreendimento       = $buscar_slide["descricao_empreendimento"];
									            	
									            	?> 
									            	<option><?php echo $descricao_empreendimento; ?></option>

									            <?php } ?> 
								            </select>

        								</div>
    								</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label">Seleção de Parceiros:</label>
									<div class="col-md-4">
										<div class="">
											
                                
											<tr class="odd gradeX">


												<?php



												include "conexao.php";

												$cont = 1;
												$query_amigo = "SELECT * FROM cliente WHERE idgrupo = 11 ORDER BY idcliente asc";
												$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar rotas");


								            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

								            	$idcli          = $buscar_amigo['idcliente'];
								            	$nome           = $buscar_amigo["nome_cli"];
//if($cont == 3){} 
								            	
								            	?>


								            	<td><input type="checkbox" name="parceiros[]" value="<?php echo $idcli ?>"><?php echo $nome ?></td>
 

								            	<?php } ?>

                                     
                                     

                                      </tr>  

										</div>
									</div>
								</div>






<div class="form-group">

	<div class="col-md-12">
		<input type="submit" class="btn btn-sm btn-success" value="Consultar" />
	</div>
</div>

</form>



</div>
</div>
<!-- end panel -->
</div>
<!-- end col-10 -->



<!-- SEGUNDO BLOCO DE INFORMAÇÃO CHAMADO PELO FILTRO -->


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
			<h4 class="panel-title">Informações dos Leads</h4>
		</div>

		<div class="panel-body">
			<form action="crm_tratalead.php?filtro=1" method="POST" id="" name="">

				<table id="data-table" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Código</th>
							<th>Nome</th>
							<th>Status</th>
							<th>Email</th>
							<th>Celular</th>
							<th>Origem</th>
							<th>Data</th>
							<th>Ações</th>

						</tr>
					</thead>
					<tbody>

					<?php
//FILTRO
$where = 'crm_id > 0';
if(isset($_GET["filtro"])) { 

  $nomefil         = $_POST["nomefil"];
  $origemfil       = $_POST["origemfil"];
  $statusfil	   = $_POST["statusfil"];
  



  

  if($nomefil != ''){
    $where .= " AND crm_nome LIKE '%".$nomefil."%'";
  }

  if($statusfil > 0){
    $where .= " AND crm_statuscli =".$statusfil;
  }

   if($origemfil != ''){
    $where .= " AND crm_origem = ".$origemfil;
  }
} //FIM FILTRO
					include "conexao.php";

					
										//inner join para mostrar o nome da origem e nao o ID.
							
							$query_amigo = "SELECT * FROM crm_cli INNER JOIN crm_origem ON crm_cli.crm_origem = crm_origem.crm_idorigem AND $where order by crm_id asc";
							
							$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");
						
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

            	$id               	= $buscar_amigo['crm_id'];
            	$nome               = utf8_encode($buscar_amigo["crm_nome"]);
            	$status          	= $buscar_amigo["crm_statuscli"];
            	$email              = $buscar_amigo["crm_email"];
            	$celular            = $buscar_amigo["crm_celular"];
            	$origem       		= $buscar_amigo["crm_origemnome"];
            	$data       		= $buscar_amigo["crm_data_cadastro"];



            	?>

            	<tr class="odd gradeX">
            		<td><input type="checkbox" name="ver[]" value="<?php echo $id ?>"></td>
            		
            		<td><?php echo $nome ?></td>
            		<td><?php echo $status ?></td>
            		<td><?php echo $email ?></td>
            		<td><?php echo $celular ?></td>
            		<td><?php echo $origem ?></td>
            		<td><?php echo $data ?></td>

            		<td>

            			<input type="hidden" name="trataid" value="<?php echo $id ?>"><a href="crm_fichalead.php?numero=<?php echo $id ?>"><span class="label label-warning">Abrir</span></a>

            		</td>

            	</tr>
            	<?php $cont = $cont + 1;

            } ?>
            </tbody> 
        </table>

    </form>
</div>
</div>
<!-- end panel -->
</div>

<?php 
  ?>


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
