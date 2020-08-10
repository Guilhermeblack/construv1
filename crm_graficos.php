<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );

include "protege_professor.php";


?>


<!DOCTYPE html>
<html lang="pt-br">

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
	
	<!-- ================== BEGIN PAGE CSS ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/summernote/summernote.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    
      


</head>
<body>

<?php function vinculo($id) {

	include "conexao.php";
         $query_amigo = "SELECT * FROM crm_statusvinculo WHERE crm_idstatus = $id ORDER BY crm_idant asc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");
$cont = 0;
                    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) { 
                    	$ids = $buscar_amigo["crm_idstatus"];
                    	$idant = $buscar_amigo["crm_idant"];

                    	$dados[$cont] = $idant;
$cont ++;
} 
return $dados;
}?>
	
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
	<!-- begin #header -->

	<?php 
	include "topo.php";
		//echo $_SERVER['HTTP_REFERER']; 
?>


	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->

		<!-- begin page-header -->
		<h1 class="page-header">CRM | Immoblie</h1>
		<!-- end page-header -->

		

		<!-- begin row -->
		<div class="row">
			<!-- begin col-2 -->

			<!-- end col-2 -->
			<!-- begin col-10 -->
			<div class="col-md-12">
				<div class="panel panel-inverse m-b-0">
					<div class="panel-heading">
						<div class="panel-heading-btn">
							
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
						</div>
						<h4 class="panel-title">Gestão Lead's</h4>
					</div>
					<div class="panel-body">

					<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
       					<div id="chart_div"></div>
   
					</div>

				</div>

			</div>
			
			
<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>




<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<script type="text/javascript">
	      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');


        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([ [{v:'20', 
          	f:'Aguardando Atendimento <div font-style:italic">53</div>'},
          	'', 'Teste'],
          	           
       
        <?php  
        	include "conexao.php";
         $query_amigo = "SELECT * FROM crm_status ORDER BY crm_idstatus asc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

                    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) { 
                    	$id = $buscar_amigo["crm_idstatus"];
                    	$cor = $buscar_amigo["crm_cor"];
                    	$nome = $buscar_amigo["crm_status"];
                    	
                    	
                    	$dados = vinculo($id);
foreach ($dados as $key) {
	


                    	?>


          
          [{v:'<?php echo $id ?>', 
          	f:'<?php echo $nome ?><div font-style:italic"><?php echo asd ?></div>'},
          	'<?php echo $key ?>', '<?php echo $nome ?>'],
           
       <?php } } ?> ]);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {allowHtml:true});
      }
</script>



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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/flot/jquery.flot.stack.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/flot/jquery.flot.crosshair.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/flot/jquery.flot.categories.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/chart-flot.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			Chart.init();
		});
	</script>
</body>


</html>
