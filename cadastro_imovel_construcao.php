<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<?php 

if(isset($_POST["finalidade"])){


 foreach($_FILES["img"]["error"] as $key => $error){
 
 if($error == UPLOAD_ERR_OK){
 $tmp_name = $_FILES["img"]["tmp_name"][$key];
 $cod     = $_FILES["img"]["name"][$key];
 ////////////////////////////////////////
$tipo 				= $_POST['tipo'];
$finalidade 		= $_POST['finalidade'];
$preco				= $_POST['preco'];
$dormitorios 		= $_POST['dormitorios'];
$banheiros 			= $_POST['banheiros'];
$cozinhas			= $_POST['cozinhas'];
$terreno 			= $_POST['terreno'];
$suites 			= $_POST['suites'];
$garagens 			= $_POST['garagens'];
$area_construida 	= $_POST['area_construida'];
$descricao			= $_POST['descricao'];
$ref  				= $_POST['ref']; 


$cidade             = $_POST["cidade_idcidade"];
$endereco           = $_POST["endereco"];
$numero             = $_POST["numero"];
$bairro             = $_POST["bairro"];
$cep                = $_POST["cep"];
$estado             = $_POST["estado"];



$utilizacao         = $_POST['utilizacao']; 

$categoria         = $_POST['categoria']; 








 //////////////////////////////////////////


$pasta = "fotos/construcao/";
if(!file_exists($pasta)){
mkdir($pasta);
}

 
 
 $nome    = $_FILES["img"]["name"][$key];
 $uploadfile = $pasta . basename($cod);
 
if(move_uploaded_file($tmp_name, $uploadfile)){
include "conexao.php";


$teste = mysqli_query ($db,"INSERT INTO construao (tipo, finalidade, preco, dormitorios, banheiros, cozinhas, terreno, suites, garagens, area_construida, utilizacao, bairro, descricao, ref, cidade_idcidade, img_principal, endereco, estado, cep, numero, categoria) values ('$tipo','$finalidade','$preco','$dormitorios','$banheiros','$cozinhas','$terreno','$suites','$garagens','$area_construida','$utilizacao','$bairro','$descricao','$ref','$cidade','$cod','$endereco','$estado','$cep','$numero','$categoria')");

}}}
?>

<script>
 window.location="construcao.php?cad=ok";
 </script>

 <?php } ?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Aug 2016 20:37:38 GMT -->
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
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php include "topo.php"; ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Cadastro Imóvel <small>Construções</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Inforações Básicas</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="cadastro_imovel_construcao.php" method="POST" enctype="multipart/form-data">
                               
                                 
                                  <div class="form-group">
                              
                                    <label class="col-md-3 control-label">Categoria:</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="categoria">
                                            <option value="lancamento">Pronto para Morar</option>
                                            <option value="em-obra" >Em Obra</option>
                                  


                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                              
                                    <label class="col-md-3 control-label">Tipo:</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="tipo">
                                            <option value="Casa">Casa</option>
                                            <option value="Apartamento" >Apartamento</option>
                                            <option value="Terreno">Terreno</option>
                                            <option value="Sobrado">Sobrado</option>
                                            <option value="Chacara">Chácara</option>
<option value="Barracao">Barracão</option>
<option value="Rancho">Rancho</option>
<option value="Sitio">Sítio</option>
<option value="Fazenda">Fazenda</option>
<option value="PontoComercial">Ponto Comercial</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Finalidade</label>
                                    <div class="col-md-9">
                                    <select class="form-control" name="finalidade">
                                            <option value="Venda">Venda</option>
                                            <option value="Aluguel" >Aluguel</option>
                                           
                                        </select>
	                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Código de Referencia</label>
                                    <div class="col-md-9">
                                      <input type="text" name="ref" class="form-control">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Preço</label>
                                    <div class="col-md-9">
                                        <input type="text" name="preco" class="form-control">
                                    </div>
                                </div>

                                   <div class="form-group">
                                    <label class="col-md-3 control-label">Descrição</label>
                                    <div class="col-md-9">
                                      <textarea name="descricao" class="form-control"></textarea>

                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Imagem Principal</label>
                                    <div class="col-md-9">
                                      <input type="file" name="img[]" class="form-control">

                                    </div>
                                </div>

                              
</div>
</div>
</div>

 <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Ficha do Imóvel</h4>
                        </div>
                        <div class="panel-body">



                                <div class="form-group">
                                    <label class="col-md-3 control-label">Dormitórios</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="dormitorios">
                                             <option value="">Selecione</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Banheiros</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="banheiros">
                                             <option value="">Selecione</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Cozinhas</label>
                                    <div class="col-md-9">
                                        
                                         <select class="form-control" name="cozinhas">
                                             <option value="">Selecione</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Suítes</label>
                                    <div class="col-md-9">
                                         <select class="form-control" name="suites">
                                             <option value="">Selecione</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Garagens</label>
                                    <div class="col-md-9">
                                        
                                        <select class="form-control" name="garagens">
                                             <option value="">Selecione</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                           

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Àrea do Terreno</label>

                                    <div class="col-md-9">
                                      <input type="text" name="terreno" class="form-control">

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Àrea Construida</label>
                                     <div class="col-md-9">
                                        <input type="text" name="area_construida" class="form-control">
                                        </div>
                                </div>




                                <div class="form-group">
                                    <label class="col-md-3 control-label">Utilização</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="utilizacao">
                                            <option value="Novo">Novo</option>
                                            <option value="Usado">Usado</option>
                                        
                                           

                                        </select>
                                    </div>
                                </div>
                              
     </div>
                                </div>
                                </div>



 <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Endereço</h4>
                        </div>
                        <div class="panel-body">






                              <div class="form-group">
                                    <label class="col-md-3 control-label">Cep (somente numeros)</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="cep"  name="cep" placeholder="Cep" />
                                    </div>
                                </div>



                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Cidade</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="cidade"  name="cidade_idcidade" placeholder="Cidade" />
                                    </div>
                                </div>




                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Estado</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="estado"  name="estado" placeholder="Estadp" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Rua</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="rua"   name="endereco" placeholder="Rua" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">bairro</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="bairro"  name="bairro" placeholder="Bairro" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Numero</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="numero"  name="numero" placeholder="Numero" />
                                    </div>
                                </div>

                                
                                

                               

                              

    </div>
                                </div></div>




 <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                           
                            <h4 class="panel-title"></h4>
                        </div>
                        <div class="panel-body">








                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->


          
          
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

    <!-- ================== END PAGE LEVEL JS ================== -->
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
     <script type='text/javascript' src='cep.js'></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
   
    <script>
        $(document).ready(function() {
            App.init();
            TableManageButtons.init();
        });
    </script>

</body>

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Aug 2016 20:37:38 GMT -->
</html>
