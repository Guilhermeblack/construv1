<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
if (!isset($_SESSION)) {
	session_start();
}

$idempreendimento_cadastro = $_GET["idempreendimento"];
$idvenda          = $_GET["idvenda"];
$venda_idvenda          = $idvenda;

$idcliente = dados_contrato($idvenda);
$idcliente = $idcliente['cliente_idcliente'];
//var_dump($idcliente); die();


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

		function dados_contrato($idvenda)
		{


			include "conexao.php";
			$query_amigo = "SELECT DISTINCT cliente_idcliente FROM venda where idvenda = $idvenda";

			$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar dados contrato");


			$buscar_amigo = mysqli_fetch_assoc($executa_query);


			return $buscar_amigo;

		}



//var_dump($idcliente); die();


		function dados_cliente($idcliente)
		{
			include "conexao.php";
			$query_amigo323 = "SELECT * FROM cliente where idcliente = '$idcliente'";
			$executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar dados cliente");


            while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos

            	$nome_cli         = $buscar_amigo323['nome_cli'];
            	$telefone1_cli    = $buscar_amigo323['telefone1_cli'];
            	$telefone2_cli    = $buscar_amigo323['telefone2_cli'];
            	$cpf_cli          = $buscar_amigo323['cpf_cli'];
            	$rg_cli           = $buscar_amigo323['rg_cli'];
            	$email_cli        = $buscar_amigo323['email_cli'];

            	$dados['nome_cli']      = $nome_cli;
            	$dados['telefone1_cli'] = $telefone1_cli;
            	$dados['telefone2_cli'] = $telefone2_cli;
            	$dados['cpf_cli']       = $cpf_cli;
            	$dados['rg_cli']        = $rg_cli;
            	$dados['email_cli']     = $email_cli;

            }

            return $dados;
        }


//$result_dados_cliente = dados_cliente($idcliente);

//print_r($result_dados_cliente); die();




        function quadra_lote($idvenda){


        	include "conexao.php";

        	$query_amigo = "SELECT produto_idproduto, lote_idlote FROM venda                         
        	where idvenda = $idvenda";

        	$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar lote");


                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  	$produto_idproduto      = $buscar_amigo["produto_idproduto"];
                  	$lote_idlote            = $buscar_amigo["lote_idlote"];

                  }

                  $dados["produto_idproduto"] = $produto_idproduto;
                  $dados["lote_idlote"]       = $lote_idlote;

                  return $dados;
              }



              $quadra_lote = quadra_lote($idvenda);




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
              			<ul class="nav nav-tabs">
              				<li class=""><a href="ver_contrato_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>" >Resumo</a></li>
              				<li class=""><a href="cessao_contrato.php?idvenda=<?php echo $venda_idvenda ?>&idempreendimento=<?php echo $idempreendimento_cadastro ?>">Cessão</a></li>
              				<li class=""><a href="#">Distrato</a></li>
              				<li class=""><a href="ocorrencias_empreendimento.php?venda_idvenda=<?php echo $idvenda ?>&idempreendimento=<?php echo $idempreendimento_cadastro ?>">Ocorrências</a></li>
              				<li class="active"><a href="documentos_empreendimento.php?idempreendimento=<?php echo $idempreendimento_cadastro ?>&idvenda=<?php echo $venda_idvenda ?>">Documentos</a></li>
              				<li class=""><a href="proprietario_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>&idempreendimento=<?php echo $idempreendimento_cadastro ?>">Proprietários</a></li>

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
              								<h4 class="panel-title">Documentos Cadastrados da Venda </h4>
              							</div>

              							<div class="panel-body">
              								<table id="" class="table table-striped table-bordered">
              									<thead>
              										<tr>
              											<th>Data</th>
              											<th>Titulo</th>
              											<th>Descrição</th>
              											<th>Anexo</th>
              											<?php if(in_array('66', $idrota)){
              												?>
              												<th>Ação</th>
              												<?php
              											} 
              											?>

              										</tr>
              									</thead>

              									<tbody>
              										<?php 



              										include  "conexao.php";

              										$busca_quadra = $quadra_lote['produto_idproduto'];
              										$busca_lote   = $quadra_lote['lote_idlote'];



              										$query = mysqli_query($db,"SELECT * FROM documentos
              											WHERE quadra_id = $busca_quadra AND lote_id = $busca_lote order by iddocumentos desc"); 


		    while ($buscar = mysqli_fetch_assoc($query)) {//--While categoria

		    	$iddocumentos 			= $buscar["iddocumentos"];
		    	$titulo 				= $buscar["titulo"];
		    	$data_ocorrencia     	= $buscar["data_ocorrencia"];
		    	$descricao     		= $buscar["descricao"];
		    	$cadastrado_por     	= $buscar["cadastrado_por"];


		    	?>


		    	<tr class="odd gradeX">
		    		<td><?php echo $data_ocorrencia ?> - <?php echo nome_user($cadastrado_por); ?></td>
		    		<td><?php echo $titulo ?></td>
		    		<td><?php echo $descricao ?></td>
		    		<td>


		    			<?php	
		    			include "conexao.php";
		    			$query_anexo = "SELECT * FROM documentos_arquivos WHERE documentos_id = $iddocumentos";
		    			$executa_anexo = mysqli_query ($db,$query_anexo) or die ("Erro Ocorrencias");

        while ($buscar_anexo = mysqli_fetch_assoc($executa_anexo)) {//--verifica se são amigos

        	$url_anexo       = $buscar_anexo['url_anexo'];
        	$iddoc 			 = $buscar_anexo['documentos_id'];
        	$anexos[]        = $url_anexo;

        	if($url_anexo != ''){

        		?>    	
        		<a href="documentos_arquivos/<?php echo $iddocumentos  ?>/<?php echo $url_anexo ?>">
        			<i class="fa fa-file" aria-hidden="true"></i></a>
        			<?php } } ?>


        		</td>

        		<?php
        		if(in_array('66', $idrota)){
        			$anexos = implode(",", $anexos);
        			?> 

        		<td><a href="excluir_anexar_documentos.php?iddoc=<?php echo "$iddoc";?>&idempreendimento=<?php echo $idempreendimento_cadastro;?>&idvenda=<?php echo "$idvenda";?>&pag=documentos&anexo=<?php echo $anexos; ?>"><span class="badge badge-danger">Excluir</span></a> </td>
        			<?php
        		}

        		?>


        	</tr>
        	<?php } ?>


        </tbody>
    </table>
</div>
</div>
<!-- end panel -->
</div>




<!-- ===============================================================
-->
<div class="col-md-12">
	<!-- begin panel -->
	<div class="panel panel-inverse" data-sortable-id="ui-general-3">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			</div>
			<h4 class="panel-title">Documentos Cadastrados do Cliente</h4>
		</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Descrição</th>
						<th>Arquivo</th>
						<?php if(in_array('66', $idrota)){
							?>
							<th>Ação</th>
							<?php
						} 
						?>


					</tr>
				</thead>
				<tbody>
					<?php
					include "conexao.php";
					$query_slide = mysqli_query($db,"SELECT * FROM anexar_documentos
						WHERE cliente_id = $idcliente
						order by idanexar_documentos desc") or die ("Erro ao listar documentos, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

            	$idanexar_documentos   = $buscar_slide["idanexar_documentos"];
            	$url_anexo             = $buscar_slide["url_anexo"];
            	$descricao_doc         = $buscar_slide["descricao_doc"];


            	?> 

            	<tr>
            		<td><?php echo $descricao_doc ?></td>

            		<td><a href="anexar_documentos/<?php echo $idcliente ?>/<?php echo $url_anexo ?>"> Download </a></td>


            		<?php
            		  if(in_array('66', $idrota)){
            		  	?>
 
            		<td><a href="excluir_anexar_documentos.php?idanexar_documentos=<?php echo "$idanexar_documentos"; ?>&idcliente=<?php echo $idcliente ?>&idempreendimento=<?php echo $idempreendimento_cadastro;?>&idvenda=<?php echo "$idvenda";?>&pag=documentos&anexo=<?php echo $url_anexo ?>"><span class="badge badge-danger">Excluir</span></a> </td>
            	</tr>
            		<?php
            		 }
            		 ?>



            	<?php } ?>












            </tbody>

        </table>
    </div>
</div>

</div>


<!-- ===============================================================
-->




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
