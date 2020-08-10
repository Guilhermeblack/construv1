<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php 

if(isset($_POST["conteudo"])){
	$conteudo 			= $_POST["conteudo"];
	$descricao_modelo   = $_POST["descricao_modelo"];
	$empreendimento_id  = $_POST["empreendimento_id"];
	$tipo_doc  			= $_POST["tipo_doc"];
	
	$conteudo = str_replace("'", '"',$conteudo);
	$conteudo = htmlentities($conteudo);
	include "conexao.php";

	$inserir = mysqli_query($db, "INSERT INTO modelo_contrato (conteudo, descricao_modelo, empreendimento_id, tipo_doc) values('$conteudo', '$descricao_modelo', '$empreendimento_id', '$tipo_doc')");


	?>
<script type="text/javascript">window.location="empreendimento_lista_contratos.php"</script>

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
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/summernote/summernote.css" rel="stylesheet" />
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
<?php include "topo.php";
$cod_empreendimento = $_GET["empreendimento_id"];
$tipo_doc = $_GET["tipo_doc"];
 ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->

			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Cadastro Cessão </h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			    <div class="col-md-2">
                    <div><b class="text-inverse">Cedente</b></div>
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


                      <div><b class="text-inverse">Cessionario</b></div>
                    <p>
                       @nome_ces, @rg_cli,@cpf_ces, 
                       @nacionalidade_ces, @profissao_ces, 
                       @nascimento_ces, @estadocivil_ces, 
                       @renda_ces,@cep_ces, @endereco_ces, @numero_ces, 
                       @bairro_ces, @cidade_ces, @estado_ces, 
                       @telefone1_ces, @telefone2_ces
                    </p>


                    <div><b class="text-inverse">Conjuge Cessionario</b></div>
                    <p>
                       @con_nome_ces, @con_rg_ces, @con_cpf_ces, 
                       @con_nacionalidade_ces, @con_profissao_ces, 
                       @con_nascimento_ces
                    </p>

                    <div><b class="text-inverse">Empreendimento</b></div>
                    <p>
                       @descricao_empreendimento, @matricula_empreendimento, 
                       @quadra, @lote, @m2, @cadastro_prefeitura, 
                       @matricula, @confrontacao
                    </p>
                     <div><b class="text-inverse">Forma de Pagamento</b></div>
                    <p>
                   	 @saldo, @quantidade_em_aberto, 
                   	 @valor_parcelas, @descricao,
                   	 @vencimento_primeira, @valor_cessao
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
                            <form action="cad_proposta.php" method="POST" name="summernote_form">
                              	<input type="hidden" name="empreendimento_id" value="<?php echo $cod_empreendimento ?>">
                              	<input type="hidden" name="tipo_doc" value="<?php echo $tipo_doc ?>">
                                <input type="text" name="descricao_modelo" class="form-control" placeholder="Titulo do Modelo" required="">
                     
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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/summernote/summernote.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/form-summernote.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			
		});
	</script>

</body>


</html>
