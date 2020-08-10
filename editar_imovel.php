<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<?php 

if(isset($_POST["finalidade"])){

 ////////////////////////////////////////

$idimovel         = $_GET["idimovel"];    
$tipo 				    = $_POST['tipo'];
$finalidade 		  = $_POST['finalidade'];
$preco				    = $_POST['preco'];
$dormitorios 		  = $_POST['dormitorios'];
$banheiros 			  = $_POST['banheiros'];
$cozinhas			    = $_POST['cozinhas'];
$terreno 			    = $_POST['terreno'];
$suites 			    = $_POST['suites'];
$garagens 			  = $_POST['garagens'];
$area_construida 	= $_POST['area_construida'];
$bairro 			    = $_POST['bairro'];
$descricao			  = $_POST['descricao'];
$cidade  			    = $_POST['cidade']; 
$utilizacao       = $_POST['utilizacao']; 
$imobiliaria_idimobiliaria2    = $_POST['imobiliaria_idimobiliaria2']; 




 //////////////////////////////////////////

include "conexao.php";

$atualizar="UPDATE imovel SET 
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
      cidade_idcidade = '$cidade',    
      utilizacao = '$utilizacao',
      imobiliaria_idimobiliaria = '$imobiliaria_idimobiliaria2'

      
      
       WHERE idimovel =$idimovel";


      
      $excluir = mysql_query($atualizar);



 



}   

?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title>Color Admin | Form Elements</title>
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
		<?php include "topo.php"; ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Alterar <small>Imóvel</small></h1>
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
                            <h4 class="panel-title">Preencha os campos!</h4>
                        </div>
                        <div class="panel-body">
                          


                                <?php 

                                $idimovel = $_GET["idimovel"];

                include_once "conexao.php";
                $query = mysql_query("SELECT * FROM imovel
                                      INNER JOIN cidade on imovel.cidade_idcidade = cidade.idcidade
                                      INNER JOIN estado on estado.idestado = cidade.estado_idestado
                                      where idimovel = $idimovel
                                      ") or die ("Erro ao listar imoveis, tente mais tarde"); 


            while ($buscar = mysql_fetch_assoc($query)) {//--While categoria

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
$bairro             = $buscar['bairro'];
$descricao          = $buscar['descricao'];

$cidade             = $buscar['cidade_idcidade']; 
$slide              = $buscar['slide']; 
$utilizacao         = $buscar['utilizacao']; 
$imobiliaria_idimobiliaria2         = $buscar['imobiliaria_idimobiliaria']; 




}
             ?>

  <form class="form-horizontal" action="editar_imovel.php?idimovel=<?php echo $idimovel ?>" method="POST" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Corretor</label>
                                    <div class="col-md-9">

                                     <select class="form-control" name="imobiliaria_idimobiliaria2">
                                            <option value="">Selecione</option>
                                        
                                       
                                        <?php 

                include_once "conexao.php";
                $query_slide = mysql_query("SELECT * FROM imobiliaria
                    order by nome_imob Asc") or die ("Erro ao listar Corretores, tente mais tarde"); 


            while ($buscar_slide = mysql_fetch_assoc($query_slide)) {//--While categoria
           
             $idimobiliaria      = $buscar_slide["idimobiliaria"];

             $nome_imob   = $buscar_slide["nome_imob"];

                    ?> 
                                            <option value="<?php echo $idimobiliaria ?>" <?php if($imobiliaria_idimobiliaria2 == $idimobiliaria){ ?> selected <?php } ?>><?php echo $nome_imob ?></option>
                                           <?php } ?>
                                           

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
                                    <label class="col-md-3 control-label">Preço</label>
                                    <div class="col-md-9">
                                        <input type="text" name="preco" value="<?php echo $preco ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Dormitórios</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="dormitorios">
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
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Cidade</label>
                                    <div class="col-md-9">

                                     <select class="form-control" name="cidade">
                                            <option value="">Selecione</option>
                                        
                                       
                                    	<?php 

				include_once "conexao.php";
				$query_slide = mysql_query("SELECT * FROM cidade
					order by nome_cidade Asc") or die ("Erro ao listar cidades, tente mais tarde"); 


		    while ($buscar_slide = mysql_fetch_assoc($query_slide)) {//--While categoria
		   
		     $idcidade		= $buscar_slide["idcidade"];

		     $nome_cidade 	= $buscar_slide["nome_cidade"];

		     		?> 
                                            <option value="<?php echo $idcidade ?>" <?php if($cidade == $idcidade){ ?> selected <?php } ?>><?php echo $nome_cidade ?></option>
                                           <?php } ?>
                                           

                                        </select>


                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Bairro</label>
                                    <div class="col-md-9">
                                      <input type="text" name="bairro" value="<?php echo $bairro ?>" class="form-control">

                                    </div>
                                </div>

                               
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Descrição</label>
                                    <div class="col-md-9">
                                      <textarea name="descricao" class="form-control"><?php echo $descricao ?></textarea>

                                    </div>
                                </div>

                                  
                                
                               


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
