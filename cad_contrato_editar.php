<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
?>
<?php 

if(isset($_POST["conteudo"])){
	$conteudo 			= $_POST["conteudo"];
	$descricao_modelo   = $_POST["descricao_modelo"];
	$idmodelo_contrato  = $_GET["idmodelo_contrato"];
	
	$conteudo = str_replace("'", '"',$conteudo);
	$conteudo = htmlentities($conteudo);
	include "conexao.php";

	$inserir = mysqli_query($db, "UPDATE modelo_contrato SET 
								  conteudo= '$conteudo',  
								  descricao_modelo = '$descricao_modelo'
								  WHERE idmodelo_contrato = '$idmodelo_contrato'
									");

	?>
<script type="text/javascript">window.location="modelos_contratos.php"</script>

	<?php } ?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Immobile business</title>
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
	
	<!-- ================== BEGIN PAGE CSS ================== -->
	
	<!-- ================== END PAGE CSS ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	 <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=shgcpb5mcjj2aclo6xy02pw1nff4235ewyrdu7x558wq6xcs"></script>
  <script>

  	tinymce.init({
  selector: "textarea",  // change this value according to your HTML
  plugins: "print",
  menubar: "file",
  toolbar: "print|newdocument| undo| redo| visualaid| cut| copy| paste| selectall| bold| italic| underline|strikethrough| subscript| superscript| removeformat| formats | alignleft aligncenter alignright"

});

  	


	</script>


</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
		<!-- begin #header -->
<?php include "topo.php" ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		<?php 
		$idmodelo_contrato = $_GET["idmodelo_contrato"];
		 include "conexao.php";
   $query_contrato = mysqli_query($db, "SELECT conteudo, descricao_modelo FROM modelo_contrato WHERE idmodelo_contrato = '$idmodelo_contrato'");

  while ($buscar_amigo = mysqli_fetch_assoc($query_contrato)) {
               
      $conteudo  = $buscar_amigo["conteudo"];
      $descricao_modelo  = $buscar_amigo["descricao_modelo"];
  }
		?>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Cadastro Contrato </h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			    <div class="col-md-2">
                    <div><b class="text-inverse">Cliente</b></div>
                    <p>
                       @nome_cli, @rg_cli,@cpf_cli, 
                       @nacionalidade_cli, @profissao_cli, 
                       @nascimento_cli, @estadocivil_cli, 
                       @renda_total,@cep_cli, @endereco_cli, @numero_cli, 
                       @bairro_cli, @cidade_cli, @estado_cli, 
                       @telefone1_cli, @telefone2_cli
                    </p>
                    <div><b class="text-inverse">Conjuge</b></div>
                    <p>
                       @nome_con, @rg_con, @cpf_con, 
                       @nacionalidade_con, @profissao_con, 
                       @nascimento_con
                    </p>

                    <div><b class="text-inverse">Empreendimento</b></div>
                    <p>
                       @descricao_empreendimento, @matricula_empreendimento, 
                       @quadra, @lote, @m2, @cadastro_prefeitura, 
                       @matricula, @confrontacao
                    </p>
                     <div><b class="text-inverse">Forma de Pagamento</b></div>
                    <p>
                      @valor_sinal, @valor_entrada, 
                      @qtd_parcelas_entrada, 
                      @valor_parcela_entrada, 
                      @vencimento_primeira,
                      @qtd_parcelas_financiamento, 
                      @valor_parcela_financiamento,
                      @data_vencimento_primeira_financiamento
                      @dia_vencimento_primeira_financiamento
                    </p>
                      <div><b class="text-inverse">Vendedora</b></div>
                    <p>
                     @vendedora
                    </p>
                     <div><b class="text-inverse">Data</b></div>
                    <p>
                     @dia_contrato
                     @mes_contrato
                     @ano_contrato
                    </p>
                    
			    </div>
			    <!-- end col-2 -->

			     <div class="col-md-10">
                    <div class="panel panel-inverse m-b-0">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Titulo do Modelo</h4>
                        </div>
                        <div class="panel-body p-0">
                            <form action="cad_contrato_editar.php?idmodelo_contrato=<?php echo $idmodelo_contrato ?>" method="POST" name="summernote_form">
                              
                                <input type="text" name="descricao_modelo" class="form-control" placeholder="Titulo do Modelo" value="<?php echo $descricao_modelo ?>">
                     
                        </div>

                    </div>
			    </div>

			    <!-- begin col-10 -->
			    <div class="col-md-10">
                    <div class="panel panel-inverse m-b-0">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Cadastrar Contrato</h4>
                        </div>
                        <div class="panel-body p-0">
                                <textarea name="conteudo"><?php echo $conteudo ?></textarea>
                                <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success">
                            </form>
                        </div>
                    </div>
			    </div>
			    <!-- end col-10 -->
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
	<!--[if lt IE 9]>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/respond.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->

	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		
		});
	</script>

</body>


</html>
