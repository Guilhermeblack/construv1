<?php
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
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
	<link href="https://immobilebusiness.com.br/admin/assets/css/multiple-select.css" rel="stylesheet"/>
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"> </script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>


	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo.php"; ?>

		<script type="text/javascript">
			
			function trocaid(id){
				document.formodal.hiddenid.value = id;
			}


 

		</script>
		
		<!-- begin #content -->
		<div id="content" class="content">
			
			<h1 class="page-header">Configurações do Painel</h1>

			<?php if($cad = isset($_GET["cad"])){ 

				if ($cad == 1) {
					

					?>
					<div class="alert alert-success fade in m-b-15">
						<strong><font><font>Sucesso! </font></font></strong><font><font>
							Suas alterações foram salvas.
						</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
					</div>
				<?php }} ?>

				<div class="row">
					<?php if (in_array('33', $idrota)) { ?>
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
									<h4 class="panel-title"></h4>
								</div>

								<div class="panel-body">
									<table id="data-table" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Grupo</th>                                        
												<th> </th>
											</tr>
										</thead>
										<tbody>

											<tr class="odd gradeX">
												<td>
													Atendimento Positivo	
												</td>
												<td>


													<button onclick="trocaid(4)" type="button" class="tts btn btn-primary" name="pnl[]">
														Configurar
													</button>


												</td>
											</tr>

											<tr class="odd gradeX">
												<td>
												Atendimento Negativo</td>
												<td>


													<button onclick="trocaid(5)" type="button" class="tts btn btn-primary" name="pnl[]">
														Configurar
													</button>


												</td>
											</tr>

											<tr class="odd gradeX">
												<td>
												Em Atendimento</td>
												<td>


													<button onclick="trocaid(6)" type="button" class="tts btn btn-primary" name="pnl[]">
														Configurar
													</button>


												</td>
											</tr>

											<tr class="odd gradeX">
												<td>
												Arquivo</td>
												<td>


													<button onclick="trocaid(7)" type="button" class="tts btn btn-primary" name="pnl[]">
														Configurar
													</button>


												</td>
											</tr>

										</tbody>
									</table>
								</div>
							</div>
							<!-- end panel -->
						</div>
						<!-- end col-10 -->


					<?php } ?>


					<!-- Modal -->
					<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Configurações do Painel:</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="col-md-6">
										<div class="form-group"> 
					<form name="formodal" action="crm_salvastatuspainel.php" method="POST">
											<label>Selecione os Status Correspondentes</label>
											<input type="hidden" name="hiddenid" id="hiddenid" value="">
											<select style='width: 100%;' multiple='multiple' name='status[]' class='status1' id='22'>
												
												</select>


            
        </div>
    </div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
	<button type="submit" class="btn btn-primary">Salvar</button>
</div>
</form>
</div>
</div>
</div>
<!-- end modal -->


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
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>


	<script src="https://immobilebusiness.com.br/admin/assets/plugins/switchery/switchery.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/form-slider-switcher.demo.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script src='https://immobilebusiness.com.br/admin/assets/js/multiple-select.js'> </script>

	<script type="text/javascript">
		
		$('.tts').on('click', function(){
           /* Configura a requisição AJAX */

           $('#exampleModalLong').modal('show');
           $.ajax({
                url : 'crm_modalpainel.php', /* quando sair do campo celular verifica se ja foi cadastrado */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'success=' + $("#hiddenid").val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: data =>
                {
                $('#22').empty()
                $('#22').html(data)
                $('#22').change()
                $('#22').multipleSelect()
                }
           });   
   return false;    
   });

</script>
<script type="text/javascript"> 

	document.getElementById('menucrm').style.display="block";

</script>
<script>


	$(document).ready(function() {
		App.init();
		FormSliderSwitcher.init();
		TableManageButtons.init();
	});
</script>

</body>

</html>
