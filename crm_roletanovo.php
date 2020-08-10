<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br">
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
  
  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->
  
  <!-- ================== BEGIN BASE JS ================== -->
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
  <!-- ================== END BASE JS ================== -->



</head>
<body>
  

    <!-- begin #page-loader -->
    <div id="page-loader" class="fade"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">


      <?php include "topo.php"; ?>

      <!-- begin #content -->
      <div id="content" class="content">
        <!-- begin breadcrumb -->

        <!-- CONFIRMAÇÃO ENVIO -->
  


    <!-- FIM CONFIRMAÇÃO ENVIO -->

        

        <h1 class="page-header">Cadastro na Roleta</h1>
        <!-- end page-header -->
        
        <!-- begin row -->
        <div class="row">

          <!-- begin col-10 -->
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
                <h4 class="panel-title">Roleta</h4>
              </div>

              <div class="panel-body">
      <form class="form-vertical form-bordered" name="myForm1" method="POST" action="crm_roletanovo.php?data=2">
                  <button type="submit" class="btn btn-sm btn-primary">DataCombo</button> 

      </form>

                <form class="form-vertical form-bordered" name="myForm" method="POST" action="crm_roletanovo.php?filtro=2">

                  <div class="form-group">
        <div class="col-md-2">
          <button type="submit" class="btn btn-sm btn-primary">MASTERCOMBO</button> 
          </div> 
        </div>
          <!-- #modal-dialog -->

<?php  

if(isset($_GET["filtro"])) { 

              include "conexao.php";
                          $query_slide = mysqli_query($db,"SELECT * FROM crm_cli") or die ("Erro ao listar grupo dos clientes, tente mais tarde");


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

              $iid          = $buscar_slide["crm_id"];
              
              $query_slide4 = mysqli_query($db,"SELECT crm_idcli FROM crm_roleta_corretor WHERE crm_idcli = $iid");
              
              if ($buscar_slide9 = mysqli_fetch_assoc($query_slide4)) {
echo "Clientes atualizados com sucesso!";
               } else { $query_slide2 = ("INSERT INTO crm_roleta_corretor (crm_idcli) 
                values ('$iid')") or die ("Erro ao editar grupo dos clientes, tente mais tarde");

              $query_slide3 = ("INSERT INTO crm_roleta_imob (crm_idcli) 
                values ('$iid')") or die ("Erro ao editar grupo dos clientes, tente mais tarde");

              @mysqli_query($db,$query_slide3);
              @mysqli_query($db,$query_slide2);}

                

                

              }  
             /*  */



               }

              if(isset($_GET["data"])) {  
  $querydata = mysqli_query($db,"SELECT crm_data_cadastro as data, crm_id AS id FROM crm_cli") or die ("Erro ao listar grupo dos clientes, tente mais tarde");

  while ($buscar_slide2 = mysqli_fetch_assoc($querydata)) {
    $dataatual = $buscar_slide2["data"];
    $id = $buscar_slide2["id"];

    $querydata2 = mysqli_query($db,"UPDATE crm_cli SET crm_statusdata = '$dataatual' WHERE crm_id = '$id'") or die ("Erro ao listar grupo dos clientes, tente mais tarde");
  }

              }
 ?>
        
</form>



</div>
</div>
<!-- end panel -->
</div>
<!-- end col-10 -->



<!-- SEGUNDO BLOCO DE INFORMAÇÃO CHAMADO PELO FILTRO -->



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
  <script src="https://immobilebusiness.com.br/admin/assets/js/ui-modal-notification.demo.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->
<script type="text/javascript"> 

  document.getElementById('menucrm').style.display="block";

</script>
  <script>
    $(document).ready(function() {
      App.init();
      TableManageButtons.init();
      Notification.init();
    });
  </script>


</body>


</html>
