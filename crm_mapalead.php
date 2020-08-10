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
	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
 </script>
 <script async defer
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdVRY-Suj8VPsCebuqFss-bKooLiRjkAs&callback=initMap">
</script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<style>
      /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
      	height: 520px;
      }
      
  </style>

</head>
<body>


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
							<h4 class="panel-title">Mapeamento dos Leads</h4>
						</div>

						<div class="panel-body">

							<div id="map"></div>

							
 
<?php

							include "conexao.php";

							

							if ($idgrupo_acesso == 7) { //Corretor
								# code...
								$where = 'WHERE crm_idcorretor = ' . $imobiliaria_idimobiliaria;
							} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 11|| $idgrupo_acesso == 13){ //imobiliária
								# code...
							$where = 'WHERE crm_idimob = ' . $imobiliaria_idimobiliaria;

							} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9) { //Administrador
								
							} else echo "Grupo de acesso não identificado";

                    //inner join para mostrar o nome da origem e nao o ID.
							$query_amigo = "SELECT * FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_cli.crm_id = crm_roleta_corretor.crm_idcli $where order by crm_id";
							$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

							?>

							<script>

								function initMap() {

									var map = new google.maps.Map(document.getElementById('map'), {
										zoom: 4,
										center: {lat: -20.548642, lng: -47.418556}
									});

        // Create an array of alphabetical characters used to label the markers.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function(location, i) {
        	return new google.maps.Marker({
        		position: location,
        		//label: labels[i % labels.length],
        		icon: 'img/pin site.png'
        	});
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
        	{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }
    

    var locations = [
 <?php while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

 	$id                 = $buscar_amigo['crm_id'];
 	$nome               = $buscar_amigo["crm_nome"];
 	$lat                = $buscar_amigo["crm_lat"];
 	$long               = $buscar_amigo["crm_long"];
 	?>
 	{lat: <?php echo $lat; ?>, lng: <?php echo $long; ?>},
 	<?php } ?>

 	]



 </script>

</div>

</div>
</div>
<!-- end col-10 -->
</div>
<!-- end row -->
</div>
<!-- end #content -->

<!-- begin theme-panel -->

<!-- end theme-panel -->

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
		<script src="https://immobilebusiness.com.br/admin/assets/plugins/summernote/summernote.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/js/form-summernote.demo.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
		<!-- ================== END PAGE LEVEL JS ================== -->
<script type="text/javascript"> 

	document.getElementById('menucrm').style.display="block";

</script>
		<script>
			 
			$(document).ready(function() {
				App.init();
				FormSummernote.init();
			});
		</script>

	</body>


	</html>
