<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<?php 
if(isset($_POST["empreendimento"])){

    $empreendimento = $_POST["empreendimento"];

$pasta = "../img/slide/";
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

    
$inserir = mysqli_query ($db,"INSERT INTO slide_empreendimentos (categoria, img_slide) values ('$empreendimento','$cod')") or die ("ERRO NO SISTEMA TENTE MAIS TARDE!.");

 
}}}


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
			<h1 class="page-header">Destaque Empreendimentos</h1>
<h2 class="page-header">Tamanho Recomendado: 1920 x 850 px</h2>

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
                            <form class="form-horizontal" action="adicionar_destaque.php" method="POST" enctype="multipart/form-data">
                               <div class="form-group">
                                    <label class="col-md-3 control-label">Empreendimento (Link Ao Clicar)</label>
                                    <div class="col-md-9">
                                        <select name="empreendimento" class="default-select2 form-control">
                                          <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM empreendimento_cadastro
                    order by idempreendimento_cadastro desc");


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idempreendimento_cadastro      = $buscar_slide["idempreendimento_cadastro"];
             $descricao_empreendimento             = $buscar_slide["descricao_empreendimento"];
        
          

                    ?> 
                                
                                            <option value="<?php echo $idempreendimento_cadastro ?>"><?php echo $descricao_empreendimento ?></option>
                                            <?php } ?>
                                        </select>
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Imagem Destaque:</label>
                                    <div class="col-md-9">
                                        <input type="file" name="img[]" multiple>
                                       
                                    </div>
                                </div>
                               

                               



                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-sm btn-success">Adicionar Imagens</button>
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
                                        <th>Imagem</th>
                                         <th>Excluir</th>

                                     
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 

                             

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM slide_empreendimentos
                                  
                    order by idslide_empreendimentos desc") or die ("Erro ao listar fotos, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idslide_empreendimentos  = $buscar_slide["idslide_empreendimentos"];
             $img_slide                = $buscar_slide["img_slide"];
             $categoria                = $buscar_slide["categoria"];
          

                    ?> 
                                
                                    <tr>
                                        <td><img src="../img/slide/<?php echo $img_slide ?>" width="400" height="150" /></td>
                                       


                                        <td><a href="excluir_destaque.php?img=<?php echo $idslide_empreendimentos ?>"><span class="badge badge-danger">Excluir</span></a> </td>
                                    </tr>
                                        

                                        <?php } ?>



                                 
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

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Aug 2016 20:37:38 GMT -->
</html>
