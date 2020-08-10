<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

if(isset($_POST["agencia"])){

date_default_timezone_set('America/Sao_Paulo');

$idcontacorrente    = $_GET["idcontacorrente"];
$alterado_por       = $_POST["imobiliaria_idimobiliaria"];
$data_alterado      = date('d-m-Y H:i:s');

$nome_cedente       = $_POST["nome_cedente"];
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
$data_fechamento    = $_POST["data_fechamento"];

$data_abertura      = date("d-m-Y", strtotime($data_abertura));

if($data_fechamento != ''){
$data_fechamento    = date("d-m-Y", strtotime($data_fechamento));
}


include "conexao.php";


 $alterar_banco = "UPDATE contacorrente SET
agencia         = '$agencia',
dig_agencia     = '$dig_agencia',
conta           = '$conta',
dig_conta       = '$dig_conta',
carteira        = '$carteira',
cpf             = '$cpf',
codigo_cedente  = '$codigo_cedente',
nome_empresa    = '$nome_empresa', 
banco           = '$banco_cedente',
cod_beneficiario= '$cod_beneficiario',
cod_transmissao = '$cod_transmissao',
alterado_por    = '$alterado_por',
data_alterado   = '$data_alterado',
data_abertura   = '$data_abertura',
data_fechamento = '$data_fechamento',
nome_cedente    = '$nome_cedente'
WHERE idcontacorrente = '$idcontacorrente'
";
$executa_alterar =  mysqli_query($db, $alterar_banco);
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
        <?php           
            $idcontacorrente = $_GET["idcontacorrente"];
            include "conexao.php";
            $query_amigo = "SELECT * FROM contacorrente where idcontacorrente = '$idcontacorrente'";
            
            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                    $nome_cedente       = $buscar_amigo["nome_cedente"];
                    $agencia            = $buscar_amigo["agencia"];
                    $dig_agencia        = $buscar_amigo["dig_agencia"];
                    $carteira           = $buscar_amigo["carteira"];
                    $conta              = $buscar_amigo["conta"];
                    $dig_conta          = $buscar_amigo["dig_conta"];
                    $cpf                = $buscar_amigo["cpf"];
                    $codigo_cedente     = $buscar_amigo["codigo_cedente"];
                    $cod_beneficiario   = $buscar_amigo["cod_beneficiario"];
                    $cod_transmissao    = $buscar_amigo["cod_transmissao"];
                    $nome_empresa       = $buscar_amigo["nome_empresa"];
                    $banco_cedente      = $buscar_amigo["banco"];
                    $data_abertura      = $buscar_amigo["data_abertura"];
                    $data_fechamento    = $buscar_amigo["data_fechamento"];
                    $cadastrado_por     = $buscar_amigo["cadastrado_por"];
                    $alterado_por       = $buscar_amigo["alterado_por"];
                    $data_cadastro      = $buscar_amigo["data_cadastro"];
                    $data_alterado      = $buscar_amigo["data_alterado"];
            }
             ?>
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
                            <form action="alterar_contacorrente.php?idcontacorrente=<?php echo $idcontacorrente ?>" method="POST" data-parsley-validate="true" name="form_wizard">
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
                        <input type="text" class="form-control" value="<?php echo $agencia ?>"   name="agencia" />
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
                                                          <input type="text" class="form-control" name="dig_agencia" value="<?php echo $dig_agencia ?>" />   
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Carteira</label>
                                                        <div class="controls">
                         <input type="text" class="form-control"   name="carteira" value="<?php echo $carteira ?>" />

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
                     <input type="text" class="form-control"   name="conta" value="<?php echo $conta ?>" />
                 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Digito Conta</label>
                                                        <div class="controls">
                               <input type="text" class="form-control"  name="dig_conta" value="<?php echo $dig_conta ?>"  />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>CNPJ</label>
                                                        <div class="controls">
                     <input type="text" class="form-control"   name="cpf" value="<?php echo $cpf ?>" />

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
                     <input type="text" class="form-control"   name="codigo_cedente" value="<?php echo $codigo_cedente ?>" />
                 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cod Beneficiario</label>
                                                        <div class="controls">
                               <input type="text" class="form-control" name="cod_beneficiario" value="<?php echo $cod_beneficiario ?>"  />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cod Transmissão</label>
                                                        <div class="controls">
                     <input type="text" class="form-control"   name="cod_transmissao" value="<?php echo $cod_transmissao ?>" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>



                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nome Banco</label>
                                                        <div class="controls">
                     <input type="text" class="form-control"   name="nome_empresa" value="<?php echo $nome_empresa ?>" />
                 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cod Banco</label>
                                                        <div class="controls">
                               <input type="text" class="form-control"  name="banco" value="<?php echo $banco_cedente ?>" />

                                                        </div>
                                                    </div>
                                                </div>

                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Data Abertura</label>
                                                        <div class="controls">
                               <input type="text" class="form-control"  name="data_abertura" value="<?php echo $data_abertura ?>" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                               
                                                <!-- end col-6 -->
                                            </div>


                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Data Encerramento da Conta</label>
                                                        <div class="controls">
                     <input type="text" class="form-control"   name="data_fechamento" value="<?php echo $data_fechamento ?>" />
                 
                                                        </div>
                                                    </div>
                                                </div>

                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                      <label>Cedente</label>
                                                        <div class="controls">
                  
                                      <input type="text" class="form-control"   name="nome_cedente" value="<?php echo $nome_cedente ?>" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <?php if($alterado_por != '0') { ?>
                                                <!-- begin col-4 -->
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Alterado por:</label>
                                                        <div class="controls">
                     <?php 
                      $alterado_por = nome_user($alterado_por);
                     echo $alterado_por ?> /   <?php echo $data_alterado ?>
                 
                                                        </div>



    <label>Cadastrado por:</label>
                                                           <?php
                     $cadastrado_por = nome_user($cadastrado_por);
                      echo $cadastrado_por ?> /   <?php echo $data_cadastro ?>
                                                    </div>
                                                </div>

                                                <?php } ?>
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
