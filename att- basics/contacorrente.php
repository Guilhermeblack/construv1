<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

if(isset($_POST["agencia"])){
    date_default_timezone_set('America/Sao_Paulo');


    $cadastrado_por     = $_POST["imobiliaria_idimobiliaria"];
    $data_cadastro      = date('d-m-Y H:i:s');


    $nome_cedente        = $_POST["nome_cedente"];
    $agencia            = $_POST["agencia"];
    $dig_agencia        = $_POST["dig_agencia"];
    $carteira           = $_POST["carteira"];
    $conta              = $_POST["conta"];
    $dig_conta          = $_POST["dig_conta"];
    $cpf                = $_POST["cpf"];
    $codigo_cedente     = $_POST["codigo_cedente"];
    $cod_beneficiario   = $_POST["cod_beneficiario"];
    $cod_transmissao    = $_POST["cod_transmissao"];
    $nome_empresa       = $_POST["nome_empresa"];
    $banco_cedente      = $_POST["banco"];
    $data_abertura      = $_POST["data_abertura"];
    $data_abertura      = date("d-m-Y", strtotime($data_abertura));






    include "conexao.php";


    $inserir_banco = mysqli_query($db,"INSERT INTO contacorrente (nome_cedente, agencia, dig_agencia, conta, dig_conta, carteira, cpf, codigo_cedente, nome_empresa, banco, cod_beneficiario, cod_transmissao, cadastrado_por, data_cadastro, data_abertura) VALUES ('$nome_cedente','$agencia','$dig_agencia', '$conta', '$dig_conta', '$carteira','$cpf', '$codigo_cedente','$nome_empresa','$banco_cedente','$cod_beneficiario','$cod_transmissao', '$cadastrado_por', '$data_cadastro','$data_abertura')");



}

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
       <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
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
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
	<?php include "topo.php" ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			
			<!-- begin page-header -->
			<h1 class="page-header">Alterar de Conta Corrente</h1>
			<!-- end page-header -->
			<div class="row">
                <!-- begin col-12 -->
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
                            <h4 class="panel-title">Conta Corrente</h4>
               
                        </div>
                        <div class="panel-body">
                            <form action="contacorrente.php" method="POST" data-parsley-validate="true" name="form_wizard">
                                <div id="wizard">
                                    <ol>
                                        
                                         <li>
                                            Conta Corrente
                                            <small></small>
                                        </li>
                                       
                                       
                                    </ol>
                                   


                                    <div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">Informações da Conta Corrente</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Agência</label>
                                                        <div class="controls">
                               <input type="text" class="form-control"   name="agencia" />
  <input type="hidden"  value="<?php echo $imobiliaria_idimobiliaria ?>"   name="imobiliaria_idimobiliaria" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Digito Agência</label>
                                                        <div class="controls">
                                                          <input type="text" class="form-control" name="dig_agencia" />   
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Carteira</label>
                                                        <div class="controls">
                         <input type="text" class="form-control"   name="carteira" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                               
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->


                                             <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nº da Conta</label>
                                                        <div class="controls">
                     <input type="text" class="form-control"   name="conta" />
                 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Digito Conta</label>
                                                        <div class="controls">
                               <input type="text" class="form-control"  name="dig_conta"  />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>CNPJ</label>
                                                        <div class="controls">
                     <input type="text" class="form-control"   name="cpf"  />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>

                                             <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cod Cedente</label>
                                                        <div class="controls">
                     <input type="text" class="form-control"   name="codigo_cedente" />
                 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cod Beneficiario</label>
                                                        <div class="controls">
                               <input type="text" class="form-control" name="cod_beneficiario"  />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cod Transmissão</label>
                                                        <div class="controls">
                     <input type="text" class="form-control"   name="cod_transmissao" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>



                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nome Empresa</label>
                                                        <div class="controls">
                     <input type="text" class="form-control"   name="nome_empresa" />
                 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cod Banco</label>
                                                        <div class="controls">
                               <input type="text" class="form-control"  name="banco" />

                                                        </div>
                                                    </div>
                                                </div>
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cedente</label>
                                                        <div class="controls">
                               <input type="text" class="form-control"  name="nome_cedente" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Data Abertura</label>
                                                        <div class="controls">
                               <input type="date" class="form-control"  name="data_abertura" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                               
                                                <!-- end col-6 -->
                                            </div>

                                        </fieldset>
                                          <p><input type="submit" class="btn btn-success btn-lg" role="button" value="Cadastrar" /></p>
                                    </div>
                            
                        
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
			<!-- begin row -->
		
            <!-- end row -->
       
		</div>
	
     
		
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

        <script src="https://immobilebusiness.com.br/admin/assets/plugins/parsley/dist/parsley.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/form-wizards-validation.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

           <script type='text/javascript' src='cep.js'></script>
          <script type='text/javascript' src='produtos.js'></script>
     <script type='text/javascript' src='lote.js'></script>
         <script type='text/javascript' src='medidas.js'></script>
 <script type='text/javascript' src='cep.js'></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            FormWizardValidation.init();
            TableManageButtons.init();
        });
    </script>

</body>

</html>
