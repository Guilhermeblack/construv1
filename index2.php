<?php
if (isset($_SESSION)) {
  header('Location: painel.php');
} else {
  session_start();

  if (!empty($_SESSION)) {
    header('Location: painel.php');
  }
}

error_reporting(0);
ini_set(“display_errors”, 0);

if (!function_exists("GetSQLValueString")) {
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
  {
    if (PHP_VERSION < 6) {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }
    include('Connections/BancoEscola.php');

    $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($BancoEscola, $theValue) : mysqli_escape_string($BancoEscola, $theValue);

    switch ($theType) {
      case "text":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "long":
      case "int":
        $theValue = ($theValue != "") ? intval($theValue) : "NULL";
        break;
      case "double":
        $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
        break;
      case "date":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "defined":
        $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
        break;
    }
    return $theValue;
  }
}

// *** Validate request to login to this site.

include('Connections/BancoEscola.php');

if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}


if (isset($_GET['email'])) {
  $_POST['email'] = $_GET['email'];
  $_POST['senha'] = $_GET['senha'];
}

if (isset($_POST['email'])) {
  $loginUsername = addslashes($_POST['email']);
  $password     = addslashes($_POST['senha']);

  


  $MM_fldUserAuthorization = "tipo";

  $MM_redirecttoReferrer = false;
  //mysqli_select_db($database_BancoEscola, $BancoEscola);

  $LoginRS__query = sprintf(
    "SELECT idcliente, email_cli, senha, idgrupo FROM cliente WHERE email_cli= %s AND senha= %s",
    GetSQLValueString($loginUsername, "text"),
    GetSQLValueString($password, "text")
  );



  $LoginRS = mysqli_query($BancoEscola, $LoginRS__query) or die(mysqli_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);


  if ($loginFoundUser) {



    $array_result  = mysqli_fetch_assoc($LoginRS);

    $loginStrGroup = $array_result['idgrupo'];
    $id_usuario    = $array_result['idcliente'];

    $LoginRota__query = "SELECT idrota FROM grupo_rota WHERE idgrupo = '$loginStrGroup'";

    $LoginRota = mysqli_query($BancoEscola, $LoginRota__query) or die(mysqli_error());
    $cont = 0;
    while ($rota = mysqli_fetch_assoc($LoginRota)) {
      $idrota[$cont]  = $rota['idrota'];
      $cont = $cont + 1;
    }



    if (PHP_VERSION >= 5.1) {
      session_regenerate_id(true);
    } else {
      session_regenerate_id();
    }

    //declare two session variables and assign them
    $_SESSION['MM_Username']     = $loginUsername;
    $_SESSION['MM_UserGroup']    = $idrota;
    $_SESSION['id_usuario']      = $id_usuario;
    $_SESSION['idrota']          = $idrota;
    $_SESSION['idgrupo_acesso']  = $loginStrGroup;


    $MM_redirectLoginSuccess = "painel.php";
    $MM_redirectLoginFailed = "index.php";


    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
    }
    if ($loginStrGroup > 1) {

      $MM_redirectLoginSuccess = "painel.php";
    }
    header("Location: " . $MM_redirectLoginSuccess);
  } else {

    header("Location: " . $MM_redirectLoginFailed);
  }
}
?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/login_v3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:24:28 GMT -->

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

  <style type="text/css">
    @media (max-width: 767px) {
      img#background {
        max-width: initial !important;
        max-height: 100% !important;
      }
    }

    @media (min-width: 1024px) {
      img#background {
        width: 100% !important;
      }
    }


    img#logo {
      max-width: 300px;
      max-height: 200px;
      width: auto;
      height: auto;
    }
  </style>
  <!-- ================== END BASE JS ================== -->
</head>

<body class="pace-top bg-white" style="overflow: hidden;">
  <!-- begin #page-loader -->
  <div id="page-loader" class="fade in"><span class="spinner"></span></div>
  <!-- end #page-loader -->


  <div class="login-cover">
    <div class="login-cover-image"><img src="img/background.jpg" id="background" data-id="login-cover-image" alt="" /></div>
    <div class="login-cover-bg"></div>
  </div>

  <!-- begin #page-container -->
  <div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login  login-v2" data-pageload-addclass="animated fadeIn">
      <!-- begin news-feed -->


      <!-- end news-feed -->
      <!-- begin right-content -->
      <div class="right-content">
        <!-- begin login-header -->

        <div class="login-header">
          <div class="brand">
            <img id="logo" src="img/logo_index.jpg">
          </div>
          <div class="icon">
            <i class="fa fa-sign-in"></i>
          </div>
        </div>

        <!-- end login-header -->
        <!-- begin login-content -->
        <div class="login-content">
          <form action="index2.php" method="POST" class="margin-bottom-0">
            <div class="form-group m-b-15">
              <input type="text" class="form-control input-lg" name="email" placeholder="Email" />
            </div>
            <div class="form-group m-b-15">
              <input type="password" class="form-control input-lg" name="senha" placeholder="Senha" />
            </div>

            <div class="login-buttons">
              <button type="submit" class="btn btn-success btn-block btn-lg">Entrar</button>
            </div>
            <?php

            if (isset($_GET["erro"])) {

              echo "Usuario ou Senha Inválido, Tente Novamente!";
            }

            ?>
            <hr />
            <p class="text-center text-inverse" style="color: #FFF!important;">
              &copy; Immobile Business - Todos os direitos Reservados
            </p>
          </form>
        </div>
        <!-- end login-content -->
      </div>
      <!-- end right-container -->
    </div>
    <!-- end login -->

    <!-- begin theme-panel -->

    <!-- end theme-panel -->
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