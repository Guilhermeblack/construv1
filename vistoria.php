<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<?php 
if(isset($_POST["idlocacao"])){

    $idlocacao = $_POST["idlocacao"];
    $codigo_img_gravar = $_POST["codigo"];
    $titulo             = $_POST["titulo"];
    $descricao_vistoria = $_POST["descricao_vistoria"];

$pasta = "fotos/vistoria/".$idlocacao."/";
if(!file_exists($pasta)){
mkdir($pasta);
}


 foreach($_FILES["img"]["error"] as $key => $error){
 
 if($error == UPLOAD_ERR_OK){
 $tmp_name = $_FILES["img"]["tmp_name"][$key];
 $cod     = $_FILES["img"]["name"][$key];
 ////////////////////////////////////////

 //////////////////////////////////////////



 
 $nome    = $_FILES["img"]["name"][$key];
 $uploadfile = $pasta . basename($cod);
 
if(move_uploaded_file($tmp_name, $uploadfile)){
include "conexao.php";

    
$inserir = mysqli_query ($db, "INSERT INTO vistoria (idlocacao, codigo, titulo, url, descricao_vistoria ) values ('$idlocacao','$codigo_img_gravar','$titulo','$cod','$descricao_vistoria')") or die ("ERRO NO SISTEMA TENTE MAIS TARDE!.");

 
}}}


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
			<?php
            $codigo_img_gravar = date('YmdHis');
             ?>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Cadastro Vistoria  </h1>
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

                        <?php    $idlocacao = $_GET["idlocacao"]; ?>
                        <div class="panel-body">
                            <form class="form-horizontal" action="vistoria.php?idlocacao=<?php echo $idlocacao ?>" method="POST" enctype="multipart/form-data">
                                 
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Titulo:</label>
                                    <div class="col-md-9">
                                        <input type="text" name="titulo" class="form-control">
                                        <input type="hidden" name="idlocacao" value="<?php echo $idlocacao ?>">
                                        <input type="hidden" name="codigo" value="<?php echo $codigo_img_gravar ?>">
                                    </div>
                                </div>
                                   <div class="form-group">
                                    <label class="col-md-3 control-label">Descrição:</label>
                                    <div class="col-md-9">
                                    <textarea name="descricao_vistoria" class="form-control"></textarea>                                       
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Selecione a Imagem:</label>
                                    <div class="col-md-9">
                                        <input type="file" name="img[]" multiple="">
                                        
                                    </div>
                                </div>
                               

                               



                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-sm btn-success">Gravar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->


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
                            <h4 class="panel-title">Imagens Cadastradas</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Imagem</th>
                                        <th></th>


                                     
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 

                            

                include "conexao.php";
                $query_slide = mysqli_query($db, "SELECT * FROM vistoria
                                    WHERE idlocacao = $idlocacao group by codigo") or die ("Erro ao listar fotos, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idvistoria         = $buscar_slide["idvistoria"];
             $titulo                = $buscar_slide["titulo"];
             $codigo                = $buscar_slide["codigo"];
          

                    ?> 
                                
                                    <tr>
                                        <td><?php echo $titulo ?>- <?php echo $idvistoria ?></td>
                                     


                                        <td> 
<?php 
                $query_url = mysqli_query($db, "SELECT * FROM vistoria
                                    WHERE codigo = $codigo") or die ("Erro ao listar fotos, tente mais tarde"); 


            while ($buscar_url = mysqli_fetch_assoc($query_url)) {//--While categoria
           
             $idvistoria         = $buscar_url["idvistoria"];
             $url                = $buscar_url["url"];
             ?>

                                         <img src="fotos/vistoria/<?php echo $idlocacao ?>/<?php echo $url ?>" width="150" height="150" />
                                         <?php } ?>

                                          </td>
                                          <td><a href="excluir_vistoria.php?url=<?php echo $url ?>&idvistoria=<?php echo $idvistoria ?>&idlocacao=<?php echo $idlocacao ?>"><span class="label label-danger">Excluir</span></a></td>
                                    </tr>
                                        

                                        <?php   }   ?>



                                 
                                </tbody>

                            </table>
                        </div>
                    </div>
               
            </div>
          
          
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
