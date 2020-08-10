<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
if (!isset($_SESSION)) {
	session_start();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
</head>
<body>
	<script type="text/javascript">
			
			function trocaid(id){

				document.formdl.corr.value = id;
			}

		</script>
		<!-- begin #page-loader -->
		<div id="page-loader" class="fade in"><span class="spinner"></span></div>
		<!-- end #page-loader -->
		
		<!-- begin #page-container -->
		<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
			<!-- begin #header -->
			
			<?php 
			include "topo.php";
			//echo $_SERVER['HTTP_REFERER']; 

			?>


			
			<!-- begin #content -->
			<div id="content" class="content">
				<!-- begin breadcrumb -->
				
				<!-- begin page-header -->
				<h1 class="page-header">CRM | Immoblie</h1>
				<!-- end page-header -->
				
				<!-- CONFIRMAÇÃO ENVIO -->
				<?php if(isset($_GET["cad"])){ 

					$resposta = $_GET["cad"];
					if($resposta == 1){ ?>

					<div class="alert alert-success fade in m-b-15">
						<strong><font><font>Sucesso! </font></font></strong><font><font>
						Seus dados foram enviados.
					</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
				</div>
				<?php }else{ ?> 
				<div class="alert alert-danger fade in m-b-15">
					<strong><font><font>Erro! </font></font></strong><font><font>
					Seus dados não foram enviados.
				</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
			</div>

			<?php } } ?>


			<!-- FIM CONFIRMAÇÃO ENVIO -->
			

			<!-- begin row -->
			<div class="row">
				<!-- begin col-2 -->

				<!-- end col-2 -->
				<!-- begin col-10 -->
				<div class="col-md-12">
					<div class="panel panel-inverse">
							<div class="panel-heading">
								<div class="panel-heading-btn">
									
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
								</div>
								<h4 class="panel-title">Loja de Prêmios</h4>
							</div>
							<?php if (in_array('66', $idrota)) { ?>
							<div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
										<th>COD</th>
										<th>Produto</th>
										<th>Valor Resgate</th>
                                        <th>Descrição</th>
  										<th>Empreendimento</th>
                                        <th>Solicitado Por</th>
                                        <th>Data Resgate</th>
                                        <th>Ações</th>

                                    </tr>
                                </thead>
                                <tbody>
                                	
                                		<?php 
                                		include "conexao.php";
                                			$queryresgate = "SELECT * FROM crm_resgate 
                                			INNER JOIN crm_premio ON crm_codproduto = crm_idpremio 
                                			INNER JOIN cliente ON crm_corretorid = idcliente
                                			INNER JOIN empreendimento_cadastro ON idempreendimento_cadastro = crm_interesseresgate WHERE crm_statusresgate = '1' || crm_statusresgate = '2' || crm_statusresgate = '3' ORDER BY crm_idresgate desc";
                                			$execresgate = mysqli_query($db, $queryresgate);
                                			while ($buscaresgate = mysqli_fetch_assoc($execresgate)) {

                                				$idR		= $buscaresgate["crm_idresgate"];
                                				$interesseR	= $buscaresgate["descricao_empreendimento"];
                                				$corretorR	= $buscaresgate["nome_cli"];
                                				$vlrR 		= $buscaresgate["crm_vlrresgate"];
                                				$descR 		= utf8_encode($buscaresgate["crm_descresgate"]);
                                				$tituloR 	= utf8_encode($buscaresgate["crm_titulopremio"]);
                                				$sts 		= $buscaresgate["crm_statusresgate"];
                                				$dataR 		= $buscaresgate["crm_dataresgate"];
												$dataR = date("d-m-Y", strtotime($dataR));
                                				
	                                		?>
	                                	<tr>
	                                		<td></td>
	                                		<td><?php echo $tituloR ?></td>
	                                		<td>Pt$: <?php echo $vlrR ?></td>
	                                		<td><?php echo $descR ?></td>

	                                		<td><?php echo $interesseR ?></td>
	                                		<td><?php echo $corretorR ?></td>
	                                		
	                                		<td style="text-align: center;">
	                                			<?php if ($sts == 2) { 
	                                				echo $dataR ?>
	                                			<?php } else { echo "-";}?>
	                                		</td>
	                                			
	                                		<td>
	                                			<?php if ($sts == '1') { ?>
	                                			
	                                			<a href="#" onclick="javascript: trocaid(<?php echo $idR ?>);" data-toggle="modal" data-target="#modalresgate"><span class="label label-primary">Aprovar Pedido</span></a><br><br>

   												<a href="crm_salvaresgate.php?app=3&cod=<?php echo $idR ?>"><span class="label label-warning">Recusar Pedido</span></a>

	                                			<?php } elseif ($sts == '2') { ?>

	                                				<span class="label label-success">Pedido Aprovado</span>
	                                				
	                                		<?php } else { ?><span class="label label-danger">Pedido Recusado</span><?php } ?>
	                                			
</td>
										</tr>
                                		<?php } 
                                		####################################################################
                                		####################################################################
                                		####################################################################

                                		####################################################################

                                		?>
                                		

                                	
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
						</div>
						<!-- Modal -->
<div class="modal fade" id="modalresgate" tabindex="-1" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	
    	
      <div class="modal-header">
        <h5 class="modal-title" id="modallabel">Informe a data para disponibilidade do resgate:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="crm_salvaresgate.php" method="POST" name="formdl" id="formodal">
      <div class="modal-body">
        
        <div id="mdlr">
              <label class="col-md-3 control-label">Data Para Disponibilidade: </label>
              <div class="col-md-4">
              <input type="date" name="dataresgate" class="form-control" min="2018-04-01" value="<?php echo date('Y-m-d'); ?>" />
              </div>
              <input type="hidden" id="corr" name="corr" value="">
              <input type="hidden" name="tipo" value="2">
              
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" name="btnapr" id="btnapr" class="btn btn-primary">Salvar</button>
      </div>
      </form>

    </div>
  </div>
</div>
						<!-- END Modal -->

				</div>
	<!-- end col-10 -->
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
