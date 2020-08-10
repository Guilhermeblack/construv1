
<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
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


		function excluir(){

			document.nome.action = "excluir_contatos.php";
			document.nome.submit();

		}

		function baixar(){

			document.nome.action = "baixar_contatos.php";
			document.nome.submit();

		}

 <?php

		function busca_email_setor($idchamado){


             
			$query_email = "SELECT * FROM chamado INNER JOIN chamado_status
			on chamado.status_chamado = chamado_status.idstatus
			WHERE idocorrencia = $idchamado";

			$executa_email = mysqli_query ($db,$query_email) or die ("Erro Ocorrencias");

            ($buscar_email = mysqli_fetch_assoc($executa_email));
        	
        	$email_dest  = $buscar_email['email_setor'];

        	return $email_dest;


        }


        function email_user($id){
	include "conexao.php";
	$query_igpm = "SELECT email_cli FROM cliente where idcliente = $id";

	$executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar Nome User");


            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos

            	$email_cli             = $buscar_amigoc['email_cli'];
            }
            return $email_cli;

        }    
        	
           
  ?>






		

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
			<ol class="breadcrumb pull-right">
				
				<li><a href="cadastro_chamado_cliente.php"><span class="label label-primary">NOVO CHAMADO</span></a></li>
				
				
				
				
				
				
			</ol>	 
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Chamados</h1>
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
							<h4 class="panel-title">Informações</h4>
						</div>
						
						<div class="panel-body">
							<form action="#" method="POST" id="nome" name="nome">

								<table id="data-table" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Cod</th>
											<th>Titulo</th>
											<th>Data</th>
											<th>Aberto Por</th>
											<th>Email</th>
											<th>Tipo Chamado</th>
											<th>Status</th>
											<th>Dominio</th>
											<th>IP Maquina</th>
											<th>Anexo</th>
											<th></th>
											
										</tr>     
									</thead>
									<tbody>

										<?php

										include "conexao2.php";
										include_once "topo.php";

											$dominio_cliente = $_SERVER['HTTP_HOST'];

										$dominio_cliente = '"'.$dominio_cliente.'"';
										

										$query_amigo = "SELECT * FROM chamado
										WHERE dominio = $dominio_cliente
										order by idocorrencia desc";


										
										$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro Ocorrencias");

	        $cont = 0;		


										
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
            	
                 

            	$idocorrencia       = $buscar_amigo['idocorrencia'];
            	$titulo             = $buscar_amigo["titulo"];
            	$data_ocorrencia    = $buscar_amigo["data_hora"];
            	$nome_usuario       = $buscar_amigo["nome_usuario"];
            	$tipo_chamado       = $buscar_amigo["tipo_chamado"];
            	$status_chamado     = $buscar_amigo["status_chamado"];
            	$dominio            = $buscar_amigo["dominio"];
            	$ip_maquina         = $buscar_amigo["ip"];
            	$descricao_chamado  = $buscar_amigo["descricao"];
            	$aberto_por         = $buscar_amigo["cadastrado_por"];
                $email_usuario      = email_user($aberto_por);




            

             if($cont == 0){
               

                //variaves passadas como parametro para email
                $email_cod_chamado          = $idocorrencia;
                $email_titulo_chamado       = $titulo;
                $email_desc_chamado         = $descricao_chamado;
                $email_data_ab_chamado      = $data_ocorrencia;   
                $email_ip_chamado           = $ip_maquina;
                $email_dominio_chamado      = $dominio;
                $email_abtpor_chamado       = $aberto_por;
                $email_data_chamado         = $data_ocorrencia;
                $email_tipo_chamado         = $tipo_chamado;         
                $email_abtpor_chamado       = nome_user($email_abtpor_chamado); 

                $email_status_chamado       = $status_chamado;

                //se o status for 0 = aberto manda email para default
	                if($email_status_chamado == 0){
	                	$email_destinatario = "vendas@immobilebusiness.com.br";
	                }else{

	                    $email_destinatario = busca_email_setor($email_cod_chamado);

	                };




                $cont++;

             }
            	


            	?>   

            	


            	<tr class="odd gradeX">
            		<td><?php echo $idocorrencia ?></td>
            		<td><?php echo $titulo ?></td>
            		<td><?php echo $data_ocorrencia ?></td>
            		<td><?php echo $nome_usuario ?></td>
            		<td><?php echo $email_usuario ?></td>
            		<td><?php echo $tipo_chamado ?></td>
            		<td>


            			<?php


            			if($status_chamado == 0){
            				
            				?>	

            				<span class="label label-primary">ABERTA</span>

            				<?php

            			}else{

            				?>


            				<?php


            				$query_status = "SELECT * FROM chamado_status WHERE idstatus = $status_chamado";
            				$executa_status = mysqli_query ($db,$query_status) or die ("Erro Ocorrencias");
            				
        while ($buscar_status = mysqli_fetch_assoc($executa_status)) {//--verifica se são amigos
        	
        	$status_mostrar  = $buscar_status['descricao'];
        	$cor             = $buscar_status['cor'];


        	

        	
        	
        	

        	?>

        	<?php
        	if(!empty($status_mostrar)){

        		?>


        		<label class="label" style="background-color: <?php echo $cor; ?> "><?php echo $status_mostrar ?></label>

        		<?php
        		
        	}}}

        	
        	?>
        	








        </td>
        <td><?php echo $dominio ?></td>
        <td><?php echo $ip_maquina ?></td>
        <td> 
        	<?php	
        	$query_anexo = "SELECT * FROM chamado_arquivos WHERE ocorrencia_id = $idocorrencia";
        	$executa_anexo = mysqli_query ($db,$query_anexo) or die ("Erro Ocorrencias");
        	
        while ($buscar_anexo = mysqli_fetch_assoc($executa_anexo)) {//--verifica se são amigos
        	
        	$url_anexo       = $buscar_anexo['url_anexo'];
        	if($url_anexo != ''){

        		?>    	
        		<a href="ocorrencias/<?php echo $idocorrencia  ?>/<?php echo $url_anexo ?>"> 
        			<i class="fa fa-file" aria-hidden="true"></i></a> 
        		<?php  } } ?>

        	</td> 
        	<td><a href="chamados_tratar_cliente.php?idocorrencia=<?php echo $idocorrencia ?>"><span class="label label-success">ABRIR</span></a></td>
        </tr>
        
    <?php } ?>
</tbody>
</table>
</form>
</div>
</div>
<!-- end panel -->
</div>
<!-- end col-10 -->
</div>
<!-- end row -->
</div>
<!-- end #content -->

<?php


           include_once("chamado_email.php");
           envia_email($email_cod_chamado,$email_titulo_chamado, $email_desc_chamado,$email_ip_chamado,$email_dominio_chamado, $email_abtpor_chamado,$email_data_chamado, $email_tipo_chamado,$email_destinatario,"não possui","não possui", "ABERTO","---", "", "");
 

?>

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
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
			Notification.init();
		});
	</script>

</body>


</html>