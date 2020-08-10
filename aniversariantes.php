<?php
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
$idcliente = $_GET["idcliente"];
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

			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Aniversariantes</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">

            <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Filtro de dados</h4>
                        </div>
                        <div class="panel-body">
                           <form class="form-vertical form-bordered" name="myForm" method="GET" action="aniversariantes.php">
                       
                            <div class="form-group">
                                    <label class="col-md-2 control-label">Periodo</label>
                                    <div class="col-md-4">
                                        <div class="">
                                   <input type="radio" name="periodo"  value="1" required=""> Do Mês <br><br>

                                    <input type="radio" name="periodo" value="2" required=""> Do Dia <br><br>
                                           
                                        </div>
                                    </div>
                                </div>



                                


                                 

                                     

                            

                             

                                

                                  <div class="form-group">
                                    
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-sm btn-success" value="Consultar" />
                                    </div>
                                </div>

                       </form>



                        </div>
                    </div>
          </div>

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
                            <h4 class="panel-title">Informações</h4>
                        </div>
                      
                        <div class="panel-body">
                          

<?php     
          $periodo = $_GET["periodo"];

         if($periodo == 1){
            $hoje = date('m');
          }else{
            $hoje = date('d-m');
          }
?>




                        <?php  if($periodo == 1){ ?>
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                 
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone 1</th>
                                        <th>Telefone 2</th>
                                        <th>Data de Nascimento</th>
                                    </tr>
                                </thead>
                                <tbody>


<?php
         



        include "conexao.php"; 
 				$query_amigo = mysqli_query($db, "SELECT nome_cli, email_cli, telefone1_cli, telefone2_cli, nascimento_cli FROM cliente"); 
 				
        while ($buscar_amigo = mysqli_fetch_assoc($query_amigo)) {//--verifica se são amigos
           
          $nome_cli        = $buscar_amigo['nome_cli'];
          $email_cli       = $buscar_amigo["email_cli"];
          $telefone1_cli   = $buscar_amigo["telefone1_cli"];
          $telefone2_cli   = $buscar_amigo["telefone2_cli"];
          $nascimento_cli  = $buscar_amigo["nascimento_cli"];

        
          
          $data_nascimento = explode("-", $nascimento_cli);
          $dia = $data_nascimento[0]; // piece1
          $mes = $data_nascimento[1]; // piece2
          $ano = $data_nascimento[2]; // piece3

          if($hoje == $mes){

             ?>


                                    <tr class="odd gradeX">
                                       <td><?php echo $nome_cli ?></td>
                                       <td><?php echo $email_cli ?></td>
                                       <td><?php echo $telefone1_cli ?></td>
                                       <td><?php echo $telefone2_cli ?></td>
                                       <td><?php echo $nascimento_cli ?></td>
                                     
                                    </tr>
                                     <?php } } ?>
                                </tbody>
                            </table>

                            <?php } ?>


  <?php  if($periodo == 2){ ?>
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                 
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone 1</th>
                                        <th>Telefone 2</th>
                                        <th>Data de Nascimento</th>
                                    </tr>
                                </thead>
                                <tbody>


<?php
         



        include "conexao.php"; 
        $query_amigo = mysqli_query($db, "SELECT nome_cli, email_cli, telefone1_cli, telefone2_cli, nascimento_cli FROM cliente"); 
        
        while ($buscar_amigo = mysqli_fetch_assoc($query_amigo)) {//--verifica se são amigos
           
          $nome_cli        = $buscar_amigo['nome_cli'];
          $email_cli       = $buscar_amigo["email_cli"];
          $telefone1_cli   = $buscar_amigo["telefone1_cli"];
          $telefone2_cli   = $buscar_amigo["telefone2_cli"];
          $nascimento_cli  = $buscar_amigo["nascimento_cli"];

        
          
          $data_nascimento = explode("-", $nascimento_cli);
          $dia = $data_nascimento[0]; // piece1
          $mes = $data_nascimento[1]; // piece2
          $ano = $data_nascimento[2]; // piece3

          $dia_mes = $dia."-".$mes;

          if($hoje == $dia_mes){

             ?>


                                    <tr class="odd gradeX">
                                       <td><?php echo $nome_cli ?></td>
                                       <td><?php echo $email_cli ?></td>
                                       <td><?php echo $telefone1_cli ?></td>
                                       <td><?php echo $telefone2_cli ?></td>
                                       <td><?php echo $nascimento_cli ?></td>
                                     
                                    </tr>
                                     <?php } } ?>
                                </tbody>
                            </table>

                            <?php } ?>








                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->









            </div>
            <!-- end row -->
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
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
		});
	</script>

</body>


</html>
