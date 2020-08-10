<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";



if(isset($_POST["nome"])){

 foreach($_FILES["img"]["error"] as $key => $error){
 
 if($error == UPLOAD_ERR_OK){
 $tmp_name = $_FILES["img"]["tmp_name"][$key];
 $cod     = $_FILES["img"]["name"][$key];
 ////////////////////////////////////////
$nome_imob       = $_POST["nome"];
$telefone     = $_POST["telefone"];
$creci       = $_POST["creci"];
$cpf      = $_POST["cpf"];
$rg       = $_POST["rg"];
$senha_corretor = $_POST["senha_corretor"];
$email_corretor = $_POST["email_corretor"];
$idpai_gravar   = $_POST["idpai"];






 //////////////////////////////////////////


$pasta = "fotos/corretor/";
if(!file_exists($pasta)){
mkdir($pasta);
}

 
 
 $nome    = $_FILES["img"]["name"][$key];
 $uploadfile = $pasta . basename($cod);
 
if(move_uploaded_file($tmp_name, $uploadfile)){
include "conexao.php";


$inserir = mysqli_query($db,"INSERT Into imobiliaria(nome_imob, email_imob, senha_imob, idpai, telefone, rg, cpf, creci, img) values ('$nome_imob', '$email_corretor', '$senha_corretor', '$idpai_gravar','$telefone','$rg','$cpf', '$creci','$cod')");

}}}




include_once "conexao.php";


?>
<script>
window.location ="relatorio_corretor.php";
 </script>
 <?php } ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->


<head>
  <meta charset="utf-8" />
  <title>Immobile | Business  </title>
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
  
  <?php include "topo.php" ?>
    
    <!-- begin #content -->
    <div id="content" class="content">
      <!-- begin breadcrumb -->
      
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header">Cadastro de Corretores</h1>
      <!-- end page-header -->
      <!-- begin profile-container -->
            <div class="profile-container">
                <!-- begin profile-section -->
                <div class="profile-section">
                    <!-- begin profile-left -->
                    <div class="profile-left">
                        <!-- begin profile-image -->
                        <div class="profile-image">
                            <img src="fotos/<?php if($idpai == 0){echo $img;}else{echo $imgc;} ?>" />
                            <i class="fa fa-user hide"></i>
                        </div>
                        <!-- end profile-image -->
                       
                        <!-- begin profile-highlight -->
                        
                        <!-- end profile-highlight -->
                    </div>
                    <!-- end profile-left -->
                    <!-- begin profile-right -->
                    <div class="profile-right">
                        <!-- begin profile-info -->
                        <div class="profile-info">
                            <!-- begin table -->
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>

                                        <tr>
                                            <th></th>
                                            <th>
                                              

                                                <h4><?php if($idpai == 0){

                echo $nome_imob;
                }else{
                  echo $nome_imobc;


                  } ?></h4>
                                            </th>
                                        </tr>
                                    </thead>

                                  <form action="corretor.php" method="POST" enctype="multipart/form-data">
                                    <tbody>
                                        <tr class="highlight">
                                            <td class="field">Nome:</td>
                                            <td><input type="text" name="nome"/>
                                            <input type="hidden" name="idpai" value="<?php echo $imobiliaria_idimobiliaria ?>">
                                            </td>
                                        </tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Telefone:</td>
                                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> <input type="text" name="telefone"></td>
                                        </tr>
                                        <tr>
                                            <td class="field">CRECI</td>
                                            <td><a href="#"><input type="text" name="creci" required=""></a></td>
                                        </tr>
                                        <tr>
                                            <td class="field">CPF</td>
                                            <td><a href="#"><input type="text" name="cpf"></a></td>
                                        </tr>
                                        <tr>
                                            <td class="field">RG</td>
                                            <td><input type="text" name="rg"></td>
                                        </tr>
                                         <tr>
                                            <td class="field">Email</td>
                                            <td><a href="#"><input type="text" name="email_corretor" required=""></a></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Senha</td>
                                            <td><input type="text" name="senha_corretor" required=""></td>
                                        </tr>
                                         <tr>
                                            <td class="field" colspan="2">  <input type="file"  name="img[]">   </td>
                                          
                                        </tr>
                                         <tr>
                                            <td class="field" colspan="2">  <input type="submit" class="btn btn-success m-r-5 m-b-5" value="Cadastrar">   </td>
                                          
                                        </tr>
                                    </tbody>
                                    </form>
                                </table>
                            </div>
                            <!-- end table -->
                        </div>
                        <!-- end profile-info -->
                    </div>
                    <!-- end profile-right -->
                </div>
                <!-- end profile-section -->
            
            </div>
      <!-- end profile-container -->
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
