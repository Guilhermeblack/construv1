<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
    date_default_timezone_set('America/Sao_Paulo');

	$idimovel = $_GET["idimovel"];


	if(isset($_POST["cliente_idcliente"])){

		$cliente_idcliente 		= $_POST["cliente_idcliente"];
		$corretor_idcorretor 	= $_POST["corretor_idcorretor"];
		$data_reserva 			= $_POST["data_reserva"];
		$data_entrega 			= $_POST["data_entrega"];
		$hora_inicio 			= $_POST["hora_inicio"];
		$hora_fim 				= $_POST["hora_fim"];
		$cadastrado_por 		= $_POST["cadastrado_por"];
		$data_lancamento 		= date('d-m-Y H:i:s');


		include "conexao.php";

		$inserir = "INSERT INTO reserva(cliente_idcliente, corretor_idcorretor, data_reserva, data_entrega, hora_inicio, hora_fim, imovel_idimovel, data_lancamento, cadastrado_por) values ('$cliente_idcliente','$corretor_idcorretor','$data_reserva','$data_entrega','$hora_inicio','$hora_fim','$idimovel','$data_lancamento', '$cadastrado_por')";


		$gravar = mysqli_query($db, $inserir);



	}


	if(isset($_POST["idreserva"])){

		$idreserva	 			= $_POST["idreserva"];
		$comentario 			= $_POST["comentario"];
		$status_reserva			= $_POST["status_reserva"];
		$alterado_por			= $_POST["alterado_por"];
		$data_alterado			= date('d-m-Y H:i:s');
		


		include "conexao.php";

		$alterar_reserva = ("UPDATE reserva set
							comentario 		= '$comentario',
							status_reserva  = '$status_reserva',    
							alterado_por    = '$alterado_por',    
							data_alterado  =  '$data_alterado'    
							WHERE idreserva = '$idreserva'");


 		$executa_alterar = mysqli_query ($db, $alterar_reserva);

	}



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
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
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
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
	
	<?php  include "topo.php"; ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		
				
			<!-- end breadcrumb -->
			<!-- begin page-header -->
		
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-6 -->
			    <div class="col-md-12">
					<ul class="nav nav-tabs">
						
<li class=""><a href="ver_imovel.php?idimovel=<?php echo $idimovel ?>">Resumo</a></li>
<li class="active"><a href="visita_imovel.php?idimovel=<?php echo $idimovel ?>">Visitas</a></li>
<li class=""><a href="adicionar_imagem.php?idimovel=<?php echo "$idimovel"; ?>">Galeria de Fotos</a></li>
<li class=""><a href="tour_360.php?idimovel=<?php echo "$idimovel"; ?>">Tour 360</a></li>
<li class=""><a href="video_imovel.php?idimovel=<?php echo "$idimovel"; ?>">Vídeo</a></li>
<li class=""><a href="integracao.php?idimovel=<?php echo "$idimovel"; ?>">Integração Portais</a></li>


<li class=""><a href="ocorrencias_imovel.php?idimovel=<?php echo $idimovel?>">Ocorrências</a></li>
<li class=""><a href="placa_imovel.php?idimovel=<?php echo $idimovel?>">Placa</a></li>
<li class=""><a href="proprietario_imovel.php?idimovel=<?php echo $idimovel?>">Proprietários</a></li>




					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="default-tab-1">
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
                            <h4 class="panel-title">Reservar</h4>
                        </div>
                        
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Interessado</th> 
                                        <th>Corretor</th>
                                        <th>Data Reserva</th>
                                         <th>Data Entrega</th>
                                          <th>Status</th>
                                          <th>Obs:</th>
                                           <th>Ações</th>
                                            <th>Data Lançamento</th>
                                            <th>Ultima Alteração</th>

                                        
                                    </tr>
                                </thead>

                                      <tbody>
                              	<?php 

								

				include "conexao.php";
				$query = mysqli_query($db, "SELECT * FROM reserva
									  WHERE imovel_idimovel = $idimovel order by idreserva desc") or die ("ERRO ao listar Reservas"); 


		    while ($buscar = mysqli_fetch_assoc($query)) {//--While categoria
		   
		    $idreserva 		= $buscar["idreserva"];
		    $cliente_idcliente     	= $buscar["cliente_idcliente"];
		   	$data_reserva   = $buscar["data_reserva"];
		   	$data_entrega   = $buscar["data_entrega"];
		   	$hora_inicio    = $buscar["hora_inicio"];
		   	$hora_fim     	= $buscar["hora_fim"];
		   	$status_reserva = $buscar["status_reserva"];
		   	$comentario     = $buscar["comentario"];
		   	$corretor_idcorretor     	= $buscar["corretor_idcorretor"];

		   	$cadastrado_por_result  = $buscar["cadastrado_por"];
		   	$alterado_por_result    = $buscar["alterado_por"];
		   	$data_lancamento_result = $buscar["data_lancamento"];
		   	$data_alterado_result   = $buscar["data_alterado"];

			
			if($status_reserva == 1){

				$cor = 'danger';
				$status_reserva = 'Finalizada';

			}elseif($status_reserva == 2){

				$cor = 'success';
				$status_reserva = 'Em Andamento';

			}elseif($status_reserva == 3){

				$cor = 'warning';
				$status_reserva = 'Aguardando Documentação';

			}else{
			    $cor = 'warning';
				$status_reserva = 'Fila de Espera';
			}



													?>

                          
                                    <tr class="odd gradeX">
                                        <td><?php echo nome_user($cliente_idcliente); ?></td>
                                        <td><?php echo nome_user($corretor_idcorretor); ?></td>
                                        <td><?php echo $data_reserva ?> / <?php echo $hora_inicio ?></td>
                                        <td><?php echo $data_entrega ?> / <?php echo $hora_fim ?></td>

                                        <td>
                                        	<span class="badge badge-<?php echo $cor ?> badge-square"><?php echo $status_reserva ?></span>


                                        </td>
                                           <td><?php echo $comentario ?></td>
                                        <td> 
                                        <?php if($status_reserva != 'Finalizada'){ ?>
                            <a href="#modal-dialog" data-toggle="modal" onclick="finalizar_reserva(<?php echo $idreserva ?>)"> <button type="button" class="btn btn-inverse"><i class="fa fa-cog"></i> Finalizar Visita</button></a>
                                        <?php } ?>
                                        </td>

                                          <td><?php echo $data_lancamento_result ?> - <?php echo nome_user($cadastrado_por_result); ?></td>


                                               <td><?php
                                               if($alterado_por_result != 0){
                                                echo $data_alterado_result ?> - <?php echo nome_user($alterado_por_result);
                                                }
                                                 ?></td>




                                    </tr>
                                   <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
						</div>




<!-- inicio da aba de parcelas -->


						<div class="tab-pane fade" id="default-tab-2">
							


						</div>
						<div class="tab-pane fade" id="default-tab-3">
							
						</div>
					</div>
					
				</div>
			    <!-- end col-6 -->
			 
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->

   <!-- begin theme-panel -->
      <div class="modal fade" id="modal-dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Finalizar Visita</h4>
                    </div>
                    <div class="modal-body">


              <form class="form-group" id="formmodal" name="formmodal" action="visita_imovel.php?idimovel=<?php echo $idimovel ?>" method="POST">	

              					 <div class="form-group">
                                    <label class="col-md-3 control-label">Status Visita:</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status_reserva">
                                            <option value="">Selecione</option>
                                            <option value="1">Finalizada</option>
                                            <option value="2">Em Andamento</option>
                                            <option value="3">Aguardando Documentação</option>
                                            <option value="4">Fila de Espera</option>

                                        </select>
	                                </div>
                                </div>


                               <div class="form-group">
                                    <label class="col-md-3 control-label">Observação:</label>
                                    <div class="col-md-9">
                                        
                                	<textarea name="comentario" class="form-control"></textarea>        
                                    </div>
                                </div>
                                  
                                  
                                  <input type="hidden" name="idreserva" id="idreserva" value="">
                                  <input type="hidden" name="alterado_por"  value="<?php echo $imobiliaria_idimobiliaria ?>">

                              
                                
                           
                    </div>
                    <div class="modal-footer">
                      <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancelar</a>
                      <input type="submit" class="btn btn-sm btn-success" value="Confirmar"/>
                        </form>
                    </div>
                  </div>
                </div>
              </div>


		<script type="text/javascript">
     
     function finalizar_reserva(id){

     	document.formmodal.idreserva.value = id 


     }


     	</script>
        <!-- end theme-panel -->
		
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
	
<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
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
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
		});
	</script>

</body>


</html>
