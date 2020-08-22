<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

	$idocorrencia = $_GET["idocorrencia"];



if(isset($_POST["status_ocorrencia"])){

	date_default_timezone_set('America/Sao_Paulo');

	$descricao_tratar  	= $_POST["descricao_tratar"];
	$status_ocorrencia  = $_POST["status_ocorrencia"];
	$atendente_id       = $_POST["atendente_id"];

	$data_tratar 	    = date('d-m-Y H:i:s');
 
	include "conexao.php";

	$inserir = mysqli_query($db, "INSERT INTO ocorrencia_tratar (ocorrencia_id, descricao_tratar, atendente_id, data_tratar, status_tratar) values ('$idocorrencia','$descricao_tratar','$atendente_id','$data_tratar','$status_ocorrencia')");

	$ultimo_id = mysqli_insert_id($db);

	$atualiza = mysqli_query($db, "UPDATE ocorrencia SET status_ocorrencia = $status_ocorrencia where idocorrencia = $idocorrencia");




	$pasta = "ocorrencias/".$idocorrencia."/".$ultimo_id."/";
	if(!file_exists($pasta)){
		mkdir($pasta);
	}


 foreach($_FILES["img"]["error"] as $key => $error){
 
 if($error == UPLOAD_ERR_OK){
 $tmp_name = $_FILES["img"]["tmp_name"][$key];
 $cod     = $_FILES["img"]["name"][$key];
 ////////////////////////////////////////

 //////////////////////////////////////////

$extensao = explode(".", $cod);
$parte1   =  $extensao[0]; // piece1
$parte2   =  ".".$extensao[1]; // piece2


$novo_nome =  rand(1, 15);
$pasta_g   = $novo_nome.$parte2;
$pasta2    = $pasta.$novo_nome.$parte2;
 
 $nome    = $_FILES["img"]["name"][$key];
 $uploadfile = $pasta . basename($cod);
 
$mover = move_uploaded_file($tmp_name, $uploadfile);

$trocando_nome = rename($uploadfile, $pasta2);

$inserir = mysqli_query ($db,"INSERT INTO ocorrencia_arquivos (ocorrencia_tratar_id, descricao, url_anexo) values ('$ultimo_id','$descricao_tratar','$pasta_g')") or die ("ERRO AO ANEXAR ARQUIVO.");

 
}}
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
	
	<?php  include "topo.php"; 
		   $idocorrencia = $_GET["idocorrencia"];

		


	?>
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
					
					<div class="tab-content">
						<div class="tab-pane fade active in" id="default-tab-1">



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
                            <h4 class="panel-title">Ocorrências</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" action="ocorrencias_tratar.php?idocorrencia=<?php echo $idocorrencia ?>" method="POST" enctype="multipart/form-data">
                               
                               <input type="hidden" name="atendente_id" value="<?php echo $imobiliaria_idimobiliaria ?>">
                               <?php    
                               	   include "conexao.php";

                               	   $query_busca_titulo = "SELECT * FROM ocorrencia WHERE idocorrencia = $idocorrencia";
                               	   $executa_titulo_descriçao = mysqli_query($db,$query_busca_titulo);
                               	   $dados_titulo_descriçao = mysqli_fetch_assoc($executa_titulo_descriçao);
                               	   $titulo = $dados_titulo_descriçao['titulo'];
                               	   $descricao = $dados_titulo_descriçao['descricao'];

                               ?>




                                 <div class="form-group">
                                 	<label class="col-md-12 control-label" style="text-align: center; font-size: 17px">
                                 		<p><strong>Titulo Inicial:&nbsp;</strong><?php echo $titulo?></label></p>
                                 		
                                 		<p><strong>Descrição Inicial:&nbsp;</strong><?php echo $descricao ?></label></p>
                               
                                 </div>

                          		  <div class="form-group">
                                    <label class="col-md-3 control-label">Descrição</label>
                                    <div class="col-md-9">
                                  <textarea class="form-control" name="descricao_tratar"></textarea>

                                      
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-9">
                                 <select name="status_ocorrencia" class="form-control">
                                 	<option value="2">Em Andamento</option>
                                 	<option value="3">Finalizada Pelo Atendente</option>
                                 	<?php if($idgrupo_acesso == 5 ){   ?>
                                 	<option value="4">Finalizada</option>
                                 	<?php } ?>
                                 </select>

                                      
                                    </div>
                                </div>

                                   <div class="form-group">
                                    <label class="col-md-3 control-label">Anexar Arquivo</label>
                                    <div class="col-md-9">
                                 <input type="file" name="img[]" multiple="">

                                      
                                    </div>
                                </div>
                            
                                  <div class="form-group">
                            
                                    <div class="col-md-9">
                                       <input type="submit" class="btn btn-success m-r-5 m-b-5" value="Cadastrar" />
                                    </div>
                                </div>
                         
                        </div>
                    </div>
                    <!-- end panel -->
                </div>




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
                            <h4 class="panel-title">Ocorrências Cadastradas</h4>
                        </div>
                        
                        <div class="panel-body">
                            <table id="" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cod</th>
                                        <th>Descrição</th>
                                        <th>Usuario</th>
                                        <th>Data</th>
                                        <th>Status</th>
                          				<th>Anexo</th>
                                         
                                        
                                    </tr>
                                </thead>

                                      <tbody>
                               <?php

            include "conexao.php";
            $query_amigo = "SELECT * FROM ocorrencia_tratar
            				WHERE ocorrencia_id = $idocorrencia
            				order by idcorrencia_tratar desc";
            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro Ocorrencias");
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $idocorrencia_tratar  = $buscar_amigo['idcorrencia_tratar'];
            $descricao_tratar     = $buscar_amigo["descricao_tratar"];
            $atendente_id    	  = $buscar_amigo["atendente_id"];
          	$data_tratar     	  = $buscar_amigo["data_tratar"];
          	$status_ocorrencia    = $buscar_amigo["status_tratar"];

  			if($status_ocorrencia == 1){
            	$status_mostrar = '<span class="label label-primary">ABERTA</span>';
            }elseif($status_ocorrencia == 2){
            	$status_mostrar = '<span class="label label-success">EM ANDAMENTO</span>';
            }elseif($status_ocorrencia == 3){
            	$status_mostrar = '<span class="label label-warning">FINALIZADA PELO ATENDENTE</span>';

            }else{
            	$status_mostrar = '<span class="label label-danger">FINALIZADA</span>';

            }
            			
 			?>

                          
                <tr class="odd gradeX">
                    <td><?php echo $idocorrencia_tratar ?></td>
                    <td><?php echo $descricao_tratar ?></td>
                    <td><?php echo nome_user($atendente_id) ?></td>
                    <td><?php echo $data_tratar ?></td>
                    <td><?php echo $status_mostrar ?></td>
                        <td>
    <?php	
        $query_anexo = "SELECT * FROM ocorrencia_arquivos WHERE ocorrencia_tratar_id = $idocorrencia_tratar";
        $executa_anexo = mysqli_query ($db,$query_anexo) or die ("Erro Ocorrencias");
                
        while ($buscar_anexo = mysqli_fetch_assoc($executa_anexo)) {//--verifica se são amigos
           
            	$url_anexo       = $buscar_anexo['url_anexo'];
            	if($url_anexo != ''){

        ?>    	
        		<a href="ocorrencias/<?php echo $idocorrencia  ?>/<?php echo $idocorrencia_tratar  ?>/<?php echo $url_anexo ?>">
<i class="fa fa-file" aria-hidden="true"></i></a>
	<?php } } ?>

                            </td>

                                    
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
