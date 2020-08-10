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
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />

	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE CSS ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/summernote/summernote.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<style>
      /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
      	height: 320px;
      	width: 100%;
      }
      /* Optional: Makes the sample page fill the window. 
       {
        height: 100%;
        margin: 0;
        padding: 0;
        }*/
    </style>

</head>
<body>


	<?php 

	function total_origem($id_origem, $idgrupo_acesso, $imobiliaria_idimobiliaria) {

		include "conexao.php";

							if ($idgrupo_acesso == 7) { //Corretor
								# code...
								$where = 'WHERE crm_roleta_corretor.crm_idcorretor = ' . $imobiliaria_idimobiliaria;
							} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 11|| $idgrupo_acesso == 13) { //imobiliária
								# code...
							$where = 'WHERE crm_roleta_corretor.crm_idimob = ' . $imobiliaria_idimobiliaria;

							} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9) { //Administrador
								# code...
								$where = '';

							} else echo "não encontrado";

                    //inner join para mostrar o nome da origem e nao o ID.
		$query_amigo = "SELECT count(crm_id) as total FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_cli.crm_id = crm_roleta_corretor.crm_idcli $where AND crm_origem = $id_origem";
		
		$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	$total                 = $buscar_amigo['total'];

}
return $total;
}
?>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
	<!-- begin #header -->

	<?php 
	include "topo.php";
		//echo $_SERVER['HTTP_REFERER']; 

	function conta_status($id_status, $idgrupo_acesso, $imobiliaria_idimobiliaria){
	include "conexao.php";
	if ($idgrupo_acesso == 7) { //Corretor
								# code...
								$where = 'WHERE crm_roleta_corretor.crm_idcorretor = ' . $imobiliaria_idimobiliaria;
							} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 11|| $idgrupo_acesso == 13) { //imobiliária
								# code...
							$where = 'WHERE crm_roleta_corretor.crm_idimob = ' . $imobiliaria_idimobiliaria;

							} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9) { //Administrador
								# code...
								$where = '';

							} else { echo "Permissão de grupo não encontrada!"; $where = ' WHERE crm_trataid = 00';}

	$query_amigo = "SELECT count(crm_trataid) as id, crm_tratastatus FROM crm_atendimento INNER JOIN crm_roleta_corretor ON crm_atendimento.crm_idcli = crm_roleta_corretor.crm_idcli $where AND crm_tratastatus = $id_status AND crm_tratadescricao != 'Alerta!!!'";

	$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");
	
while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	$id                 = $buscar_amigo['id'];
	
}

return $id;

}

function cont_status($id_status, $idgrupo_acesso, $imobiliaria_idimobiliaria){
	include "conexao.php";
	if ($idgrupo_acesso == 7) { //Corretor
								# code...
								$where = 'WHERE crm_idcorretor = ' . $imobiliaria_idimobiliaria;
							} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 11|| $idgrupo_acesso == 13) { //imobiliária
								# code...
							$where = 'WHERE crm_idimob = ' . $imobiliaria_idimobiliaria;

							} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9) { //Administrador
								# code...
								$where = '';

							} else echo "Permissão de grupo não encontrada!";

	$query_amigo = "SELECT count(crm_id) as id, crm_statuscli FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_cli.crm_id = crm_roleta_corretor.crm_idcli $where AND crm_statuscli = $id_status group by crm_statuscli";
					$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");
	
while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	$id                 = $buscar_amigo['id'];
	
}

return $id;

}

include "conexao.php";
$query_amigo = "SELECT * FROM crm_status order by crm_posicaofunil asc";
$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");
	
while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	$id                 = $buscar_amigo['crm_idstatus'];
	$crm_status     = $buscar_amigo['crm_status'];

	$total =  conta_status($id, $idgrupo_acesso, $imobiliaria_idimobiliaria);
	$total2 = cont_status($id, $idgrupo_acesso, $imobiliaria_idimobiliaria);

	$array[$id] = ['descricao' => $crm_status, 'total' => $total, 'atual' => $total2];

}

$query = "SELECT * FROM crm_status WHERE crm_funil = 0";

$executa = mysqli_query ($db,$query) or die ("Erro ao listar contatos");
while ($buscar_amigo = mysqli_fetch_assoc($executa)) {

	$id                 = $buscar_amigo['crm_idstatus'];
	
	unset($array[$id]);

}

foreach ($array as $key => $value) {
	//if ($array[$key]["total"]) {//quem tem 0 ou null fica fora do funil automaticamente
		# code...
	
	$dataPoints[] = 

		array("label" => $array[$key]["descricao"] , "y" => $array[$key]["total"])

	;
    //}

}

/*
$dataPoints = array( 

	array("label"=>"Total LEADs", "y"=>	$total),
	array("label"=>"Apresentado", "y"=>	$apresentado),
	array("label"=>"Orçamento", "y"=>	$orcamento),
	array("label"=>"Convertido", "y"=>	$convertido)
); 
*/
	?>

	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->

		<!-- begin page-header -->
		<h1 class="page-header">CRM | Immoblie</h1>
		<!-- end page-header -->

		<!-- ##############################################CHART DONNUTS############################################################ -->
		<!-- ##############################################CHART DONNUTS############################################################ -->
		<!-- ##############################################CHART DONNUTS############################################################ -->

		<!-- begin row -->
		<div class="row">
			<!-- begin col-2 -->

			<!-- end col-2 -->
			<!-- begin col-10 -->
			<div class="col-md-4">
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

						<div id="chart_div" style="width: 100%; height: 320px;"></div>

					</div>

				</div>

			</div>


			
			<!-- ##############################################CHART DONNUTS############################################################ -->
			<!-- ##############################################CHART DONNUTS############################################################ -->
			<!-- ##############################################CHART DONNUTS############################################################ -->
			<!-- ##############################################CHART DONNUTS############################################################ -->

			<!-- begin col-6 -->
			<div class="col-md-4">

				<!-- TERCEIRA JANELA DA TELA -->
				<div class="panel panel-inverse">
					<div class="panel-heading">
						<div class="panel-heading-btn">
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
						</div>
						<h4 class="panel-title">Mapeamento do Lead</h4>
					</div>

					<div class="panel-body">

						<div id="map"></div>

						<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
						</script>
						<script async defer
						src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdVRY-Suj8VPsCebuqFss-bKooLiRjkAs&callback=initMap">
					</script>
					<?php

							if ($idgrupo_acesso == 7) { //Corretor
								# code...
								$where = 'WHERE crm_idcorretor = ' . $imobiliaria_idimobiliaria;
							} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 11|| $idgrupo_acesso == 13) { //imobiliária
								# code...
							$where = 'WHERE crm_idimob = ' . $imobiliaria_idimobiliaria;

							} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9) { //Administrador
								# code...
								$where = '';

							} else echo "Permissão de grupo não encontrada!";
					include "conexao.php";

                    //inner join para mostrar o nome da origem e nao o ID.
					$query_amigo = "SELECT * FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_cli.crm_id = crm_roleta_corretor.crm_idcli $where order by crm_id";

					$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");
					?>

					<script>

						function initMap() {

							var map = new google.maps.Map(document.getElementById('map'), {
								zoom: 2,
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
 	<?php $contt += 1; } ?>

 	]

 </script>
</div>

</div>

</div><!-- FIM COLUNA -->

<!-- ##############################################CHART DONNUTS############################################################ -->
<!-- ##############################################CHART DONNUTS############################################################ -->
<!-- ##############################################CHART DONNUTS############################################################ -->
<!-- ##############################################CHART DONNUTS############################################################ -->

<!-- begin col-6 -->
<div class="col-md-4">
	<div class="panel panel-inverse" data-sortable-id="flot-chart-8">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			</div>
			<h4 class="panel-title">Gráfico Origem</h4>
		</div>
		<div class="panel-body">
			<div id="donutchart" style="width: 100%; height: 320px;"></div>
		</div>
	</div>
</div>

</div>

<!-- begin row -->
<div class="row">
	<!-- begin col-2 -->
	<!-- begin col-6 -->
	<div class="col-md-12">
		<div class="panel panel-inverse" data-sortable-id="flot-chart-8">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Funil Vendas</h4>
			</div>
			<div class="panel-body">
				<div id="chartContainer" style="height: 390px; width: 100%;"></div>
			</div>
		</div>
	</div>
</div> <!-- ROW ROW ROW -->
<!-- ##############################################CHART DONNUTS############################################################ -->
<!-- ##############################################CHART DONNUTS############################################################ -->
<!-- ##############################################CHART DONNUTS############################################################ --><!-- ##############################################CHART DONNUTS############################################################ -->
<!-- ##############################################CHART DONNUTS############################################################ -->
<!-- ##############################################CHART DONNUTS############################################################ -->
<!-- begin col-3 -->

<?php

					include "conexao.php";

                    //inner join para mostrar o nome da origem e nao o ID.
					$query_amigo = "SELECT count(crm_id) as id, crm_statuscli FROM crm_cli group by crm_statuscli";
					$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

					?>

 <?php while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

 	$id                 = $buscar_amigo['id'];
 	$nome               = $buscar_amigo["crm_statuscli"];

}
 	?>

<!-- ##############################################CHART DONNUTS############################################################ --><!-- ##############################################CHART DONNUTS############################################################ -->
<!-- ##############################################CHART DONNUTS############################################################ -->
<!-- ##############################################CHART DONNUTS############################################################ -->
<div class="row">
<div class="col-md-12">
	<div class="panel panel-inverse" data-sortable-id="flot-chart-8">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			</div>
			<h4 class="panel-title">Status Agora</h4>
		</div>
		<div class="panel-body">

       					<div id="chart_div2"></div>

		</div>
	</div>
</div>

</div>
</div>

<?php
//FILTRO
						 if ($idgrupo_acesso == 7) { //Corretor
								$where = 'WHERE crm_idcorretor = ' . $imobiliaria_idimobiliaria;
							} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 13 ) { //imobiliária
									$where = 'WHERE crm_idimob = ' . $imobiliaria_idimobiliaria;
								} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9 || $idgrupo_acesso == 11) { //Administrador
										$where = 'WHERE crm_id > 0';

									} else echo "Permissão de grupo não encontrada!";

############################################^^^^^^###################################################################################################ORGANIZER#################################################################################################################################################################
 function vinculo($id) {

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
}

?>

<script type="text/javascript">
	      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');
<?php 
$query3 = ("SELECT COUNT(crm_statuscli) as c FROM crm_cli
	INNER JOIN crm_roleta_corretor ON crm_roleta_corretor.crm_idcli = crm_cli.crm_id
 $where AND crm_statuscli = 20");
$executa_query3 = mysqli_query ($db,$query3) or die ("Erro ao listar contatos"); 
	while ($buscar_amigo3 = mysqli_fetch_assoc($executa_query3)) {
		$idaa = $buscar_amigo3["c"];
	}

?>
        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([ [{v:'20', 
          	f:'Aguardando Atendimento <div font-style:italic"><?php echo $idaa ?></div>'},
          	'', 'Aguardando Atendimento'],

        <?php  
        	include "conexao.php";
         $query_amigo = "SELECT * FROM crm_status ORDER BY crm_idstatus asc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

                    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) { 
                    	$id = $buscar_amigo["crm_idstatus"];
                    	$cor = $buscar_amigo["crm_cor"];
                    	$nome = $buscar_amigo["crm_status"];
                    	
                    	$dados = vinculo($id);

                    	$query = ("SELECT COUNT(crm_statuscli) as c FROM crm_cli INNER JOIN crm_roleta_corretor ON crm_roleta_corretor.crm_idcli = crm_cli.crm_id
 $where AND crm_statuscli = $id");
                    	$executa_query2 = mysqli_query ($db,$query) or die ("Erro ao listar contatos");
                    	while ($buscar_amigo = mysqli_fetch_assoc($executa_query2)) {
                    		$idcont = $buscar_amigo["c"];

                    	}

foreach ($dados as $key) {

                    	?>
          [{v:'<?php echo $id ?>', 
          	f:'<?php echo $nome ?><div font-style:italic"><?php echo $idcont ?></div>'},
          	'<?php echo $key ?>', '<?php echo $nome ?>'],
           
       <?php } } ?> ]);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div2'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {allowHtml:true});
      }
</script>


<?php

############################################^^^^^^###################################################################################################ORGANIZER#################################################################################################################################################################

								//FUNCAO PARA CRIAR GRAFICO LEADS
if ($idgrupo_acesso == 7) { //Corretor
								# code...
								$where = 'WHERE crm_idcorretor = ' . $imobiliaria_idimobiliaria;
							} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 11|| $idgrupo_acesso == 13) { //imobiliária
								# code...
							$where = 'WHERE crm_idimob = ' . $imobiliaria_idimobiliaria;

							} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9) { //Administrador
								# code...
								$where = '';

							} else die ("Permissão de grupo não encontrada!");

include "conexao.php";

                    //inner join para mostrar o nome da origem e nao o ID.
$query_amigo = "SELECT count(crm_id) as id, crm_statusdata as data, crm_statuscli 
FROM crm_cli 
INNER JOIN crm_roleta_corretor ON crm_cli.crm_id = crm_roleta_corretor.crm_idcli 
$where group by 
SUBSTR( data, 7, 4), 
SUBSTR( data, 4, 2)

ORDER BY 
SUBSTR( data, 7, 4), 
SUBSTR( data, 4, 2) ";

$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatosss");


$total = 0;
?>

<script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {


		var data = google.visualization.arrayToDataTable([




			['Data', 'Cadastros', 'Convertido', 'Total', 'Cancelado'],
<?php while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	$id                 = $buscar_amigo['id'];
	$dataa               = date('m-Y', strtotime($buscar_amigo['data']));
	$status 			= $buscar_amigo['crm_statuscli'];
	$total += $id; 
	?>

	[
	<?php echo "'".$dataa."'" ?>, 
	<?php echo $id ?>, 
	<?php if ($status == 18) { echo $id;} else {echo 0;} ?>, 
	<?php echo $total; ?>, 
	<?php if ($status == 21) {echo $id;} else echo 0;  ?>
	],


<?php } ?>
]);

		var options = {
			title: 'Captação LEADs',
			hAxis: {title: 'Tempo',  titleTextStyle: {color: '#343'}},
			vAxis: {minValue: 0, title: 'Nº de LEADs'}
		};

		var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
		chart.draw(data, options);


	}



</script>
<!-- ################################################ CHARTS ############################################################### -->
<!-- ##############################################CHART DONNUTS############################################################ -->
<!-- ##############################################CHART DONNUTS############################################################ -->
<!-- ##############################################CHART DONNUTS############################################################ -->

<script type="text/javascript">
	google.charts.load("current", {packages:["corechart"]});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = google.visualization.arrayToDataTable([



			<?php

			include "conexao.php";

                    //inner join para mostrar o nome da origem e nao o ID.
			$query_amigo = "SELECT crm_idorigem as id, crm_origemnome as nome FROM crm_origem";
			$query_amigo2 = "SELECT count(crm_id) as id, crm_origem as origem FROM crm_cli 
			INNER JOIN crm_roleta_corretor on crm_id = crm_idcli $where group by SUBSTR( origem, 1, 2)";

			$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");
			$executa_query2 = mysqli_query ($db,$query_amigo2) or die ("Erro ao listar contatos");
			?>

			['Origem', 'Cadastros'],

<?php while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	$id                 = $buscar_amigo['id'];
	$status 			= $buscar_amigo['nome'];
	$total = total_origem($id, $idgrupo_acesso, $imobiliaria_idimobiliaria);

	?>	
	[

	'<?php echo $status; ?>', 

	<?php echo "$total"; ?>
	
	],


<?php } ?>

]);

		var options = {
			title: 'Origem dos LEADs',
			pieHole: 0.5
		};

		var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
		chart.draw(data, options);
	}


	
</script>

<!-- ##############################################CHART DONNUTS############################################################ -->

 <script>
    	window.onload = function() {

    		var chart = new CanvasJS.Chart("chartContainer", {
    			theme: "light2",
    			animationEnabled: true,
    			title: {
    				text: "Funil de LEADs"
    			},
    			data: [{
    				type: "funnel",
    				indexLabel: "{label} - {y}",
    				yValueFormatString: "#,##0",
    				showInLegend: true,
    				legendText: "{label}",
    				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    			}]
    		});
    		chart.render();

    	}
    </script>
<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>




<!-- end scroll to top btn -->
</div>
<!-- end page container -->





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
	<script type="text/javascript"> 

	document.getElementById('menucrm').style.display="block";

</script>
	<script>
		$(document).ready(function() {
			App.init();
			Chart.init();
		});
	</script>
</body>


</html>
