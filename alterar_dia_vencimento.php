<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

function busca_data($idparcelas){
include "conexao.php";
    $query_amigo = "SELECT data_vencimento_parcela FROM parcelas where idparcelas = $idparcelas";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $data_vencimento_parcela           = $buscar_amigo["data_vencimento_parcela"];
    }
    return $data_vencimento_parcela;
}


if(isset($_POST["idparcelas"])){
	include "conexao.php";
	
	$antecipar_t 	= $_POST["idparcelas"];
	$novo_dia 	    = $_POST["dia_vencimento"];

	$idvenda 	 	= $_POST["idvenda"];
	$tipo 		 	= $_POST["tipo"];

	$novo_dia = date("d-m-Y", strtotime($novo_dia));



$cont = 0;
	foreach($antecipar_t as $id){

		 $busca_data    = busca_data($id);
		 $vencimento_novo  = date('d-m-Y', strtotime("+".$cont." month",strtotime($novo_dia)));

		 if($cont == 0){
		 	$vencimento_novo = $novo_dia;
		 }

		$inserir = mysqli_query($db, "UPDATE parcelas set data_vencimento_parcela ='$vencimento_novo' WHERE idparcelas = '$id'");

		$cont = $cont + 1;
             
	}

?>

<script type="text/javascript">window.location="parcelas.php?idvenda=<?php echo $idvenda ?>&tipo=<?php echo $tipo ?>";</script>

 <?php } ?>


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
	

	<?php include "topo.php" ?>



		<!-- begin #content -->
		<div id="content" class="content">
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Alterar dia do Vencimento</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			
			    <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-4">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Alterar dia do vencimento</h4>
                        </div>
                        <div class="panel-body">
                        <form action="alterar_dia_vencimento.php" method="POST" name="nome">
                <?php 
              $idvenda = $_POST["idvenda"];
              $tipo = $_POST["tipo"];
              ?>
                        <input type="hidden" name="idvenda" value="<?php echo $idvenda; ?>">
                        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                         
                                       <th></th>
                                      
                              
                                    

                                    </tr>
                                </thead>
                                <tbody>
			<?php               

              include "conexao.php";
              $antecipar = $_POST["antecipar"];

              foreach($antecipar as $id){  ?>
                
                    <input type="hidden" name="idparcelas[]" value="<?php echo $id ?>"></td>
                 
           <?php } ?>
           <tr>
           	<td><input type="date" name="dia_vencimento" class="form-control"></td>
           </tr>



                               <tr>
                                <td colspan="4"><input type="submit" name="corrigir" class="btn btn-success" value="Confirmar Alteração"></td>
                               
                               </tr>

                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
			      
			    </div>
			    <!-- end col-6 -->
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
