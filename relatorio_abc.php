<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
set_time_limit(0);

//include "protege_professor.php";
include "conexao.php";

if (!isset($_SESSION)) {
	session_start();
}


?>

<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Relatório Orcado X Realizado</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="https://immobilebusiness.com.br/admin//assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />

	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>

	<style type="text/css">
		.class-a > td{
			background-color: #97DB9B!important;
			color: #000;
		}
		.class-b > td{
			background-color: #33b5e5!important;
			color: #FFF;
		}
		.class-c > td{
			background-color: #cc4946!important;
			color: #FFF;
		}
	</style>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
		<!-- begin #header -->
		<?php include "topo.php";?>



		<div class="sidebar-bg"></div>
		<div id="content" class="content">
			<div class="panel panel-inverse">
				<div class="panel-heading" style="">
					<h3 class="panel-title">
						Relatório de gastos curva ABC
					</h3>
				</div>

				<div class="panel-body">
					<form class="form" action="relatorio_abc.php" method="POST" name="orcado-realizado">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="orcamento">Selecione o Orçamento</label>
								<select class="form-control" id="orcamento" name="orcamento">
									<option value="-1">TODOS</option>
									<?php 

									$query = mysqli_query($db, "SELECT * FROM `const_orcamento` WHERE `status_editar` = 0")or die(mysqli_error($db));

									if(mysqli_num_rows($query)){
										while ($assoc = mysqli_fetch_assoc($query)) {
											?>
											<option value="<?php echo($assoc['id']) ?>"><?php echo($assoc['titulo']) ?></option>
											<?php
										}
									}
									?>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<button type="submit" class="btn btn-success" style="float: right;">Enviar</button>
							</div>
						</div>
						
					</form>

					<?php 
						if(isset($_POST['orcamento']) && $_POST['orcamento'] != -1){

							$orcamento = $_POST['orcamento'];

							$query_master = mysqli_query($db, "SELECT (((100 * insumo.total_insumo) / (total.total_orc))) AS porcentagem, ROUND(insumo.total_insumo, 2) AS TOTAL_INSUMO, insumo.id_insumo_plano, insumo.tabela, const_insumos.descricao, insumo.quantidade, const_orcamento.titulo FROM (SELECT (quantidade * valor_unitario) AS total_insumo, id_insumo_plano, tabela, id, id_orcamento, quantidade FROM tabela_orcamento ORDER BY total_insumo DESC) AS insumo INNER JOIN (SELECT SUM(quantidade * valor_unitario) AS total_orc, id_insumo_plano, tabela, id, id_orcamento as orc FROM tabela_orcamento GROUP BY orc) AS total ON insumo.id_orcamento = total.orc INNER JOIN const_insumos ON insumo.id_insumo_plano = const_insumos.id INNER JOIN const_orcamento ON insumo.id_orcamento = const_orcamento.id WHERE insumo.id_orcamento = ".$orcamento." AND insumo.tabela = 2 GROUP BY insumo.id ORDER BY `insumo`.`total_insumo` DESC")or die(mysqli_error($db));

							if(mysqli_num_rows($query_master)){

								$dados = [];

								while ($assoc = mysqli_fetch_assoc($query_master)) {
									$dados[] = $assoc;
								}
							}

							?>	
							<div class="contanei-fluid" style="padding-top: 5%;">
								<table id="data-table" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="15%">Orçamento</th>
											<th width="20%">Insumo</th>
											<th width="5%">Qnt Orçado</th>
											<th width="15%">Valor total</th>
											<th width="5%">Porcentagem Do Item</th>
											<th width="15%">Porcentagem Acumulada</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$total_orcado = 0; 
											$acumulado = 0;

											foreach ($dados as $key => $value) {

												$total_orcado += $value['TOTAL_INSUMO'];
												$acumulado += $value['porcentagem'];

												switch ($acumulado) {
													case $acumulado < 80:
														$classe = 'class-a';
														array_push($ca= $value['descricao']);
														$pa+= 1;
														break;
													case $acumulado < 95 && $acumulado >= 80:
														$classe = 'class-b';
														array_push($cb= $value['descricao']);
														$pb+= 1;
														break;
													case $acumulado >= 95:
														$classe = 'class-c';
														array_push($cc= $value['descricao']);
														$pc+= 1;
														break;
													
													default:
														# code...
														break;
												}
												array_push($eixo,[$cc,$pc]);
												array_push($eixo,[$cb,$pb]);
												array_push($eixo,[$ca,$pa]);

												?>
												<tr class="<?php echo($classe); ?>">
													<td><?php echo $value['titulo']; ?></td>
													<td><?php echo $value['descricao']; ?></td>
													<td><?php echo $value['quantidade']; ?></td>
													<td><?php echo 'R$ '.number_format($value['TOTAL_INSUMO'], 2, ',', '.'); ?></td>
													<td><?php echo round($value['porcentagem'],2).'%'; ?></td>
													<td><?php echo round($acumulado,2).'%'; ?></td>
												</tr>
												<?php
												
											}

											?>
											<tr>
												<td><?php echo $value['titulo']; ?></td>
												<td><?php echo '#'; ?></td>
												<td><?php echo '#'; ?></td>
												<td><?php echo 'R$ '.number_format($total_orcado, 2, ',', '.'); ?></td>
												<td><?php echo '#'; ?></td>
												<td><?php echo $acumulado.'%'; ?></td>
											</tr>
											<?php
										?>
									</tbody>
								</table>
							</div>

                            <div style='margin: 5px;' >
							 <canvas id="myChart" width="800px" height="600px"></canvas>
                            <script>
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {

                                type: 'doughnut',
                                data: {
                                    labels: ['80% valor do total','15% valor do total','5% valor do total'],

                                    datasets: [{
                                        label: 'Curva ABC',
                                        data: [
                                        <?php echo $pc ?>,
                                        <?php echo $pb ?>,
                                        <?php echo $pa ?>
                                         ],
                                        backgroundColor: [

                                            'rgb(245, 85, 79)',
                                            'rgb(33, 152, 79)',
                                            'rgb(11, 135, 198)'
                                        ],
                                        borderColor: [
                                            'rgb(7, 27, 26)',
                                            'rgb(7, 27, 26)',
                                            'rgb(7, 27, 26)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {


                                    responsive: false,
                                    scales: {
                                        yAxes: [{
                                            ticks:{
                                                display: false
                                            },


                                            gridLines: {

                                                display: false
                                            },


                                        }],
                                        xAxes: [{
                                            ticks:{
                                                display: false
                                            },

                                            gridLines: {

                                                display: false
                                            },

                                        }]

                                    },
                                    tooltips: {
                                        callbacks: {
                                            label: function(tooltipItem, data) {

                                                return data['datasets'][0]['data'][tooltipItem['index']]+ ' Produtos';
                                            },
                                            afterLabel: function(tooltipItem, data) {
                                              return 'Correspondem a : '+data['labels'][tooltipItem['index']];
                                            }


                                        }
                                    }
                                }
                            });




                            </script>

							<?php
						}
					?>

				</div>
			</div>
		</div>

		<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>


    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/masked-input/masked-input.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/password-indicator/js/password-indicator.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/form-plugins.demo.min.js"></script>


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
				FormPlugins.init();
				TableManageButtons.init();
			});

		</script>
	</body>
	</html>
