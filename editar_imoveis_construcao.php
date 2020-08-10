<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<?php 

if(isset($_POST["finalidade"])){

 ////////////////////////////////////////

$idconstruao = $_GET["idconstruao"];    
$tipo               = $_POST['tipo'];
$finalidade         = $_POST['finalidade'];
$preco              = $_POST['preco'];
$dormitorios        = $_POST['dormitorios'];
$banheiros          = $_POST['banheiros'];
$cozinhas           = $_POST['cozinhas'];
$terreno            = $_POST['terreno'];
$suites             = $_POST['suites'];
$garagens           = $_POST['garagens'];
$area_construida    = $_POST['area_construida'];
$descricao          = $_POST['descricao'];
$ref                = $_POST['ref']; 

$cep                = $_POST['cep'];
$endereco           = $_POST['endereco'];
$numero             = $_POST['numero'];
$bairro             = $_POST['bairro'];
$cidade             = $_POST['cidade'];
$estado             = $_POST['estado'];

$categoria             = $_POST['categoria'];




$utilizacao         = $_POST['utilizacao']; 



 //////////////////////////////////////////

include "conexao.php";

$atualizar="UPDATE construao SET 
      tipo='$tipo',
      finalidade='$finalidade',
      preco='$preco',
      dormitorios = '$dormitorios',
      banheiros = '$banheiros',
      cozinhas = '$cozinhas',
      terreno = '$terreno',
      suites = '$suites',
      garagens = '$garagens',
      area_construida = '$area_construida',
      bairro = '$bairro', 
      descricao = '$descricao',
      ref = '$ref',
      cidade_idcidade = '$cidade',    
      utilizacao = '$utilizacao', 
      endereco = '$endereco',
      numero  = '$numero',
      estado = '$estado',  
      categoria = '$categoria',  
      cep = '$cep'
      
      
       WHERE idconstruao =$idconstruao";


      
      $excluir = mysqli_query($db,$atualizar);



 



}   

?>

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
			<h1 class="page-header">Alterar Imóvel <small>Construção </small></h1>
			<!-- end page-header -->
			       <?php 

                                $idconstruao = $_GET["idconstruao"];

                include_once "conexao.php";
                $query = mysqli_query($db,"SELECT * FROM construao
                                     
                                      where idconstruao = $idconstruao
                                      ") or die ("Erro ao listar imoveis, tente mais tarde"); 


            while ($buscar = mysqli_fetch_assoc($query)) {//--While categoria

$tipo               = $buscar['tipo'];
$finalidade         = $buscar['finalidade'];
$preco              = $buscar['preco'];
$dormitorios        = $buscar['dormitorios'];
$banheiros          = $buscar['banheiros'];
$cozinhas           = $buscar['cozinhas'];
$terreno            = $buscar['terreno'];
$suites             = $buscar['suites'];
$garagens           = $buscar['garagens'];
$area_construida    = $buscar['area_construida'];
$descricao          = $buscar['descricao'];
$ref                = $buscar['ref'];


$cep             = $buscar['cep'];
$endereco             = $buscar['endereco'];
$numero             = $buscar['numero'];
$bairro             = $buscar['bairro'];
$cidade             = $buscar['cidade_idcidade']; 
$estado             = $buscar['estado']; 



$categoria              = $buscar['categoria']; 
$slide              = $buscar['slide']; 
$utilizacao         = $buscar['utilizacao']; 





}
             ?>

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
                            <form class="form-horizontal" action="editar_imoveis_construcao.php?idconstruao=<?php echo $idconstruao ?>" method="POST" enctype="multipart/form-data">
                               
                                   <div class="form-group">
                             
                              
                                    <label class="col-md-3 control-label">Categoria:</label>
                                    <div class="col-md-9">
                                         <select class="form-control" name="categoria">
                                            <option value="lancamento" <?php if($categoria == 'lancamento'){ ?> checked="checked" <?php } ?>>Pronto para Morar</option>
                                            <option value="em-obra" <?php if($categoria == 'em-obra'){ ?> selected <?php } ?> >Em Obra</option>
                                           
                                        </select>
                                    </div>
                                </div>










                                <div class="form-group">
                             
                              
                                    <label class="col-md-3 control-label">Tipo:</label>
                                    <div class="col-md-9">
                                         <select class="form-control" name="tipo">
                                            <option value="Casa" <?php if($tipo == 'Casa'){ ?> checked="checked" <?php } ?>>Casa</option>
                                            <option value="Apartamento" <?php if($tipo == 'Apartamento'){ ?> selected <?php } ?> >Apartamento</option>
                                            <option value="Terreno" <?php if($tipo == 'Terreno'){ ?> selected <?php } ?>>Terreno</option>
                                            <option value="Sobrado" <?php if($tipo == 'Sobrado'){ ?> selected <?php } ?>>Sobrado</option>
                                            <option value="Chacara" <?php if($tipo == 'Chacara'){ ?> selected <?php } ?>>Chácara</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Finalidade</label>
                                    <div class="col-md-9">
                                      <select class="form-control" name="finalidade">
                                            <option value="Venda" <?php if($finalidade == 'Venda'){ ?> selected <?php } ?>>Venda</option>
                                            <option value="Aluguel" <?php if($finalidade == 'Aluguel'){ ?> selected <?php } ?> >Aluguel</option>
                                           
                                        </select>
	                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Código de Referencia</label>
                                    <div class="col-md-9">
                                       <input type="text" name="ref" value="<?php echo $ref ?>" class="form-control">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Preço</label>
                                    <div class="col-md-9">
                                        <input type="text" name="preco" value="<?php echo $preco ?>" class="form-control">
                                    </div>
                                </div>

                                   <div class="form-group">
                                    <label class="col-md-3 control-label">Descrição</label>
                                    <div class="col-md-9">
                                      <textarea name="descricao" class="form-control"><?php echo $descricao ?></textarea>

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
                                             <option value="" <?php if($dormitorios == ''){ ?> selected <?php } ?>>Selecione</option>
                                            <option value="1" <?php if($dormitorios == '1'){ ?> selected <?php } ?>>1</option>
                                            <option value="2" <?php if($dormitorios == '2'){ ?> selected <?php } ?>>2</option>
                                            <option value="3" <?php if($dormitorios == '3'){ ?> selected <?php } ?>>3</option>
                                            <option value="4" <?php if($dormitorios == '4'){ ?> selected <?php } ?>>4</option>
                                            <option value="5" <?php if($dormitorios == '5'){ ?> selected <?php } ?>>5</option>
                                            <option value="6" <?php if($dormitorios == '6'){ ?> selected <?php } ?>>6</option>
                                            <option value="7" <?php if($dormitorios == '7'){ ?> selected <?php } ?>>7</option>
                                            <option value="8" <?php if($dormitorios == '8'){ ?> selected <?php } ?>>8</option>
                                            <option value="9" <?php if($dormitorios == '9'){ ?> selected <?php } ?>>9</option>
                                            <option value="10" <?php if($dormitorios == '10'){ ?> selected <?php } ?>>10</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Banheiros</label>
                                    <div class="col-md-9">
                                       <select class="form-control" name="banheiros">
                                           <option value="" <?php if($banheiros == ''){ ?> selected <?php } ?>>Selecione</option>
                                            <option value="1" <?php if($banheiros == '1'){ ?> selected <?php } ?>>1</option>
                                            <option value="2" <?php if($banheiros == '2'){ ?> selected <?php } ?>>2</option>
                                            <option value="3" <?php if($banheiros == '3'){ ?> selected <?php } ?>>3</option>
                                            <option value="4" <?php if($banheiros == '4'){ ?> selected <?php } ?>>4</option>
                                            <option value="5" <?php if($banheiros == '5'){ ?> selected <?php } ?>>5</option>
                                            <option value="6" <?php if($banheiros == '6'){ ?> selected <?php } ?>>6</option>
                                            <option value="7" <?php if($banheiros == '7'){ ?> selected <?php } ?>>7</option>
                                            <option value="8" <?php if($banheiros == '8'){ ?> selected <?php } ?>>8</option>
                                            <option value="9" <?php if($banheiros == '9'){ ?> selected <?php } ?>>9</option>
                                            <option value="10" <?php if($banheiros == '10'){ ?> selected <?php } ?>>10</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Cozinhas</label>
                                    <div class="col-md-9">
                                        
                                          <select class="form-control" name="cozinhas">
                                             <option value="" <?php if($cozinhas == ''){ ?> selected <?php } ?>>Selecione</option>
                                            <option value="1" <?php if($cozinhas == '1'){ ?> selected <?php } ?>>1</option>
                                            <option value="2" <?php if($cozinhas == '2'){ ?> selected <?php } ?>>2</option>
                                            <option value="3" <?php if($cozinhas == '3'){ ?> selected <?php } ?>>3</option>
                                            <option value="4" <?php if($cozinhas == '4'){ ?> selected <?php } ?>>4</option>
                                            <option value="5" <?php if($cozinhas == '5'){ ?> selected <?php } ?>>5</option>
                                            <option value="6" <?php if($cozinhas == '6'){ ?> selected <?php } ?>>6</option>
                                            <option value="7" <?php if($cozinhas == '7'){ ?> selected <?php } ?>>7</option>
                                            <option value="8" <?php if($cozinhas == '8'){ ?> selected <?php } ?>>8</option>
                                            <option value="9" <?php if($cozinhas == '9'){ ?> selected <?php } ?>>9</option>
                                            <option value="10" <?php if($cozinhas == '10'){ ?> selected <?php } ?>>10</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Suítes</label>
                                    <div class="col-md-9">
                                          <select class="form-control" name="suites">
                                            <option value="" <?php if($suites == ''){ ?> selected <?php } ?>>Selecione</option>
                                            <option value="1" <?php if($suites == '1'){ ?> selected <?php } ?>>1</option>
                                            <option value="2" <?php if($suites == '2'){ ?> selected <?php } ?>>2</option>
                                            <option value="3" <?php if($suites == '3'){ ?> selected <?php } ?>>3</option>
                                            <option value="4" <?php if($suites == '4'){ ?> selected <?php } ?>>4</option>
                                            <option value="5" <?php if($suites == '5'){ ?> selected <?php } ?>>5</option>
                                            <option value="6" <?php if($suites == '6'){ ?> selected <?php } ?>>6</option>
                                            <option value="7" <?php if($suites == '7'){ ?> selected <?php } ?>>7</option>
                                            <option value="8" <?php if($suites == '8'){ ?> selected <?php } ?>>8</option>
                                            <option value="9" <?php if($suites == '9'){ ?> selected <?php } ?>>9</option>
                                            <option value="10" <?php if($suites == '10'){ ?> selected <?php } ?>>10</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Garagens</label>
                                    <div class="col-md-9">
                                        
                                        <select class="form-control" name="garagens">
                                             <option value="" <?php if($garagens == ''){ ?> selected <?php } ?>>Selecione</option>
                                            <option value="1" <?php if($garagens == '1'){ ?> selected <?php } ?>>1</option>
                                            <option value="2" <?php if($garagens == '2'){ ?> selected <?php } ?>>2</option>
                                            <option value="3" <?php if($garagens == '3'){ ?> selected <?php } ?>>3</option>
                                            <option value="4" <?php if($garagens == '4'){ ?> selected <?php } ?>>4</option>
                                            <option value="5" <?php if($garagens == '5'){ ?> selected <?php } ?>>5</option>
                                           

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Àrea do Terreno</label>

                                    <div class="col-md-9">
                                      <input type="text" name="terreno" value="<?php echo $terreno ?>" class="form-control">

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Àrea Construida</label>
                                     <div class="col-md-9">
                                          <input type="text" name="area_construida" value="<?php echo $area_construida ?>" class="form-control">
                                        </div>
                                </div>




                                <div class="form-group">
                                    <label class="col-md-3 control-label">Utilização</label>
                                    <div class="col-md-9">
                                       <select class="form-control" name="utilizacao">
                                            <option value="Novo" <?php if($utilizacao == 'Novo'){ ?> selected <?php } ?>>Novo</option>
                                            <option value="Usado"<?php if($utilizacao == 'Usado'){ ?> selected <?php } ?>>Usado</option>
                                        
                                           

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
                                        <input type="text" name="cep" value="<?php echo $cep ?>" id="cep" class="form-control">
                                    </div>
                                </div>



                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Cidade</label>
                                    <div class="col-md-9">
                                       <input type="text" name="cidade" value="<?php echo $cidade ?>" id="cidade" class="form-control">
                                    </div>
                                </div>




                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Estado</label>
                                    <div class="col-md-9">
                                        <input type="text" name="estado" value="<?php echo $estado ?>" id="estado" class="form-control">
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Rua</label>
                                    <div class="col-md-9">
                                       <input type="text" name="endereco" value="<?php echo $endereco ?>" id="rua" class="form-control">
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">bairro</label>
                                    <div class="col-md-9">
                                        <input type="text" name="bairro" id="bairro" value="<?php echo $bairro ?>" class="form-control">
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Numero</label>
                                    <div class="col-md-9">
                                        <input type="text" name="numero" value="<?php echo $numero ?>" id="numero" class="form-control">
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
                                        <button type="submit" class="btn btn-sm btn-success">Alterar</button>
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
