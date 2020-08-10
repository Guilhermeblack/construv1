<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/extra_profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:20:33 GMT -->
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
  <?php 




           $idimobiliaria = $_GET["idcorretor"];
             
                                  $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];

                      include_once "conexao.php";
                $query_amigo = "SELECT * FROM imobiliaria
               
                WHERE idimobiliaria = $idimobiliaria AND idpai = $imobiliaria_idimobiliaria";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Você Não Possui Autorização");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                  $idimobiliaria    = $buscar_amigo['idimobiliaria'];
                  $nome_imob        = $buscar_amigo["nome_imob"];
                  $telefone         = $buscar_amigo["telefone"];
                  $cpf              = $buscar_amigo["cpf"];
                  $creci            = $buscar_amigo["creci"];
                  $rg               = $buscar_amigo["rg"];
                  $email_imob       = $buscar_amigo["email_imob"];
                  $senha_imob       = $buscar_amigo["senha_imob"];
$imgc       = $buscar_amigo["img"];
               

             }
            
             ?>
                            <img src="fotos/corretor/<?php echo $imgc; ?>" />
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
                                            








                                              
                                            </th>
                                        </tr>
                                    </thead>

                                  <form action="recebe_alterar_corretor.php" method="POST" enctype="multipart/form-data">
                                    <tbody>
                                        <tr class="highlight">
                                            <td class="field">Nome:</td>
                                            <td><input type="text" name="nome_imob" value="<?php echo $nome_imob?>"/>
                                            <input type="hidden" name="idimobiliaria" value="<?php echo $idimobiliaria ?>" >
                                            </td>
                                        </tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Telefone:</td>
                                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> <input type="text" name="telefone" value="<?php echo $telefone?>"></td>
                                        </tr>
                                        <tr>
                                            <td class="field">CRECI</td>
                                            <td><a href="#"><input type="text" name="creci" value="<?php echo $creci ?>" required=""></a></td>
                                        </tr>
                                        <tr>
                                            <td class="field">CPF</td>
                                            <td><a href="#"><input type="text" value="<?php echo $cpf ?>" name="cpf"></a></td>
                                        </tr>
                                        <tr>
                                            <td class="field">RG</td>
                                            <td><input type="text" name="rg" value="<?php echo $rg ?>"></td>
                                        </tr>
                                         <tr>
                                            <td class="field">Email</td>
                                            <td><a href="#"><input type="text" value="<?php echo $email_imob ?>" name="email_imob" required=""></a></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Senha</td>
                                            <td><input type="text" name="senha_imob" value="<?php echo $senha_imob ?>" required=""></td>
                                        </tr>
                                         <tr>
                                            <td class="field" colspan="2">  <input type="file"  name="img[]">   </td>
                                          
                                        </tr>
                                         <tr>
                                            <td class="field" colspan="2">  <input type="submit" class="btn btn-success m-r-5 m-b-5" value="Alterar">   </td>
                                          
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

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/extra_profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:20:34 GMT -->
</html>
