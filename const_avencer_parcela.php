<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

if(isset($_POST["idparcelas"])){
  date_default_timezone_set('America/Sao_Paulo');

  $hoje      = $_POST["data_pagamento"];;
  $hoje = date("d-m-Y", strtotime($hoje));

  $cod_baixa = date('Y-m-d H:i:s');

  $cod_baixa = str_replace("-","", $cod_baixa);
  $cod_baixa = str_replace(":","", $cod_baixa);
  $cod_baixa = str_replace(" ","", $cod_baixa);

  $data_baixa           = date('d-m-Y H:i:s');
  $baixado_por          = $_POST["baixado_por"];
  $contacorrente_id     = $_POST["contacorrente_id"];
  $talao_id 				    = $_POST["talao_id"];
  $cliente_idcliente    = $_POST["cliente_idcliente"];
  $situacao             = $_POST["situacao"];
  $inicio               = $_POST["inicio"];
  $fim                  = $_POST["fim"];

  $empreendimento_id    = $_POST["empreendimento_id"];
  $numero_lancamento    = $_POST["numero_lancamento"];
  $numero_baixa         = $_POST["numero_baixa"];
  $tipo_periodo         = $_POST["tipo_periodo"];

  $antecipar_t 		      = $_POST["idparcelas"];
  $forma_pagamento 	    = $_POST["forma_pagamento"];	


  include "conexao.php";
  foreach($antecipar_t as $id){

    $valor_recebido = $_POST[$id];

    $valor_parcelas = $_POST["valor_parcelas".$id];
    $data_venci     = $_POST["data_venci".$id];
    $data_pgto      = $_POST["data_pgto".$id];

    $desc           = $_POST["desc".$id];
    $acre           = $_POST["acre".$id];

    $desc = limpa_valor($desc);
    $acre = limpa_valor($acre);

    $valor_parcelas = limpa_valor($valor_parcelas);

    $inserir = ("UPDATE parcelas set		
     situacao 			    = 'Pago',
     data_recebimento 	= '$hoje',
     valor_recebido 		= '$valor_recebido',
     forma_pagamento 	= '$forma_pagamento',
     contacorrente_id 	= '$contacorrente_id',
     folhacheque_id 		= '$talao_id',
     cod_baixa         = '$cod_baixa',
     baixado_por       = '$baixado_por',
     data_baixa        = '$data_baixa',
     desc_parcela      = '$desc',
     acre_parcela      = '$acre',
     valor_parcelas   = '$valor_parcelas',
     data_vencimento_parcela  = '$data_venci',
     data_recebimento        = '$data_pgto'
     WHERE idparcelas 	= '$id'");

    $executa_query = mysqli_query ($db, $inserir);


	/////////////  Atualizar folha de cheque:
    if($talao_id != ''){
      $atualiza_folha = ("UPDATE folha_cheque set situacao_folha = '1' WHERE idfolha_cheque  = '$talao_id'");
      $executa_folha = mysqli_query ($db, $atualiza_folha);
    }

  }  
  ?>

  <script type="text/javascript">
   window.location="contas_apagar.php?cliente_idcliente=<?php echo $cliente_idcliente ?>&inicio=<?php echo $inicio ?>&fim=<?php echo $fim ?>&situacao=<?php echo $situacao ?>&empreendimento_id=<?php  echo $empreendimento_id ?>&numero_lancamento=<?php echo $numero_lancamento ?>&numero_baixa=<?php echo $numero_baixa ?>&tipo_periodo=<?php echo $tipo_periodo ?>";
 </script>
<?php 
} 
?>


<?php
	function dados_parcela($id){
		  include "conexao.php";
	    $query_amigo = "SELECT valor_parcelas, data_vencimento_parcela, data_recebimento FROM parcelas where idparcelas = $id";
	    $executa_query = mysqli_query ($db,$query_amigo);

	   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
	   	{
	      $valor_parcelas           = $buscar_amigo["valor_parcelas"];
		  $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
	      $data_recebimento         = $buscar_amigo["data_recebimento"];

	      $dados["valor_parcelas"]  		 = $valor_parcelas;
	      $dados["data_vencimento_parcela"]  = $data_vencimento_parcela;

	    }
	    return $dados;
	}

	function limpa_valor($valor){

		$valor = str_replace("R$","", $valor);
		$valor = str_replace(".","", $valor);
		$valor = str_replace(",",".", $valor);

		return $valor;
	}

	function geraTimestamp($data) {
	  $partes = explode('-', $data);
	  $tratada = $partes[2].'-'.$partes[1].'-'.$partes[0];
	  return $tratada;
	}

	function valor_corrigido($data_vencimento_tratada, $valor_parcelas, $tipo_venda){

	  $hoje = date('Y-m-d');
		$data_vencimento_tratada = geraTimestamp($data_vencimento_tratada);

		if($tipo_venda == 1){
			$valor_multa = (10 / 100);
		}else{
		$valor_multa = (2 / 100);
		}
		
		$valor_juros = (0.033 / 100);


		if(strtotime($data_vencimento_tratada) <= strtotime($hoje) ) { 

	    $time_inicial = strtotime($hoje);
	    $time_final   = strtotime($data_vencimento_tratada);

	    $diferenca = $time_inicial - $time_final; 

	    $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

			$multa = ($valor_parcelas * $valor_multa);
	 		$juros = ($valor_parcelas * $valor_juros * $dias);

	 		$valor_parcelas = $valor_parcelas + $multa + $juros;


		}else{
		
		$valor_parcelas = $valor_parcelas;
		
		}

		return $valor_parcelas;
	} 
?>



<?php 
	
	include "conexao.php";

	$antecipar = $_POST["antecipar"];

	foreach ($antecipar as $value) {
		$query = mysqli_query($db, "SELECT `situacao` FROM `parcelas` WHERE `idparcelas` = $value")or die(mysqli_error($db));

		if(mysqli_num_rows($query)){
			$assoc = mysqli_fetch_assoc($query);

			if($assoc['situacao'] != 'Previsao'){

				$aux = str_replace('#', '', $_POST['string_consulta']);

				header('Location: '.$aux.'&atencao=1');
				die();
			}
		}
	}
	
	




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
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->

</head>
<body>

<style type="text/css">
	
	input#valor_restante.incompleto{
		border: 2px solid red;
		color: red;
	}

	input#valor_restante.completo{
		border: 2px solid green;
		color: green;
	}

	input#valor_restante.estorado{
		border: 2px solid #f59c1a;
		color: #f59c1a;
	}

</style>

<script type="text/javascript">

function ShowHideDIV(){

  Valor = document.getElementById("forma_pagamento").value;

  if (Valor=="4") 
  {
    document.getElementById('talao_id').style.display    = "block"
    document.getElementById('talao_id').disabled=false



  }
  else
  {
    document.getElementById('talao_id').style.display    = "none"
    document.getElementById('talao_id').disabled=true



   }
}
function numberParaReal(numero){
    var formatado = "R$ " + numero.toFixed(2).replace(".",",");
    return formatado;
}

function CalcularDescontoApagar(id){

  var valor_normal = document.getElementById('valor_normal'+id).value
  var desc = document.getElementById('desc'+id).value
  var acre = document.getElementById('acre'+id).value


  var valor_normal = valor_normal.replace("R$","")
  var valor_normal = valor_normal.replace(".","")
  var valor_normal = valor_normal.replace(" ","")
  var valor_normal = valor_normal.replace(",",".")

  var desc = desc.replace("R$","")
  var desc = desc.replace(".","")
  var desc = desc.replace(" ","")
  var desc = desc.replace(",",".")

  var acre = acre.replace("R$","")
  var acre = acre.replace(".","")
  var acre = acre.replace(" ","")
  var acre = acre.replace(",",".")

  if(desc == ''){
    desc = 0;
  }

  if(acre == ''){
    acre = 0;
  }
  var corrigido = parseFloat(valor_normal) + parseFloat(acre) - parseFloat(desc);

  corrigidoFormato = numberParaReal(corrigido)


  document.getElementById(''+id).value=corrigido
  document.getElementById('n'+id).value=corrigidoFormato
}
</script>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">


<?php include "topo.php" ?>


<div id="content" class="content">
	<!-- begin breadcrumb -->
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Aprovação de Parcelas</h1>
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
					<h4 class="panel-title">Descrição</h4>
				</div>
				<div class="panel-body">
					<?php               

					include "conexao.php";

					$antecipar = $_POST["antecipar"];

					$cont = 0; 

					foreach($antecipar as $id){
						$dados_parcela 			= dados_parcela($id);
						$valor_parcelas 			= $dados_parcela["valor_parcelas"];
						$data_vencimento_parcela	= $dados_parcela["data_vencimento_parcela"];

						$cont = $cont + $valor_parcelas;
					} 

					?>

					<div class="row">
						<div class="form-group col-md-6">
							<label style="color: #000; font-size: 14px;">Valor Restante</label>
							<input type="text" class="form-control incompleto" style=" font-size: 18px; font-weight: bold;" name="valor_restante" id="valor_restante" disabled value="<?php echo  'R$ '.number_format($cont, 2, ',', '.'); ?>" valor-total="<?php echo $cont ;?>">
						</div>
						<div class="col-md-6" style="padding-top: 2%;">
							<a href="#" class="btn btn-success" id="add_parcela">Adicionar Parcela</a>
						</div>
					</div>

					<div class="row" style="overflow-x: scroll;">
						<table class="table table-striped" >
							<thead>
								<tr>           
									<th>Valor Total</th>
									<th>Vencimento Parcela</th>
									<th>Descontos</th>
									<th>Acréscimos</th>
									<th>Quantidade Parcelas</th>
									<th>Intervalo</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody id="principal">
								
								<tr class="hidden">
									<td>
										<input type="text" name="valor_parcela" class="form-control money" value="R$ 0,00">
									</td>

									<td>
										<input type="date" class="form-control date" name="venc_parcela" value="R$ 0,00" placeholder="Vencimento Parcela" />
									</td>

									<td>
										<input type="text" name="desconto" class="form-control money" value="R$ 0,00">
									</td>

									<td>
										<input type="text" name="acrescimo" class="form-control money" value="R$ 0,00">
									</td>

									<td>
										<input type="number" name="qnt" class="form-control" value="1">
									</td>

									<td>
										<input type="number" name="intervalo" class="form-control" value="30">
									</td>

									<td>
										<a href="#" class="btn btn-danger remove" >Excluir</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					
				</div>

				<div class="panel-footer">
					<a href="#" class="btn btn-info" id="aprovar_parcela">Aprovar Parcelas </a>
				</div>
			</div>
		</div>
	
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->

		<!--- Modal para status de aprovacao ---->
		<div id="dialog" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
					</div>
					<div class="modal-body"  align="center">
						<h4 class="modal-title" align="center">Erro ao Aprovar parcelas!</h4>
					</div>
					<div class="modal-footer">
					    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(function(){
			$(".valor_parcelas").maskMoney({symbol:'R$ ', 
				showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
		})
	</script>

	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/parsley/dist/parsley.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/form-wizards-validation.demo.min.js"></script>
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready( function() {
			App.init();
			FormWizardValidation.init();
			TableManageButtons.init();
			FormPlugins.init();

			let aux = 0;

			let url_pai = "<?php echo  $_POST['string_consulta']; ?>";


			$('input[name="valor_parcela"]').val(aux.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
			$('input[name="desconto"]').val(aux.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
			$('input[name="acrescimo"]').val(aux.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

			/* Executa a requisição quando o campo CEP perder o foco */
			$('#contacorrente_id').change(function(){
				/* Configura a requisição AJAX */
				$.ajax({
					url : 'consultar_talao.php', /* URL que será chamada */ 
					type : 'POST', /* Tipo da requisição */ 
					data: 'contacorrente_id=' + $('#contacorrente_id').val(), /* dado que será enviado via POST */
					dataType: 'json', /* Tipo de transmissão */
					success: function(data){

						var $etapa = $('#talao_id');
						$etapa.empty();
						$etapa.append("<option value=''>Escolha</option>");

						$.each(data, function(id, nome){
							$etapa.append('<option value=' + id + '>' + nome + '</option>');
						});

						$etapa.change();        
					}
				});   
				return false;    
			})


			function addDays(myDate,days) {
				return new Date(myDate.getTime() + days*24*60*60*1000);
			}

			function formatDate(date) {
			    var d = new Date(date),
			        month = '' + (d.getMonth() + 1),
			        day = '' + d.getDate(),
			        year = d.getFullYear();

			    if (month.length < 2) month = '0' + month;
			    if (day.length < 2) day = '0' + day;

			    return [year, month, day].join('-');
			}

			function att_date(){
				let ultimo_date = '2000-01-01';

				$('input.date').each(function(){
					
					if($(this).attr('min') != '' && $(this).val() < ultimo_date){
						$(this).val(ultimo_date);
						$(this).attr('min', ultimo_date);

						let intervalo = parseFloat($(this).parents('tr').find('> td').eq(5).find('> input').val());
						let qnt = parseFloat($(this).parents('tr').find('> td').eq(4).find('> input').val());
						let date = new Date($(this).val());
						let date_new = formatDate(addDays(date, (intervalo * qnt)));
						
						ultimo_date = date_new;
					}else if($(this).attr('min') == ''){

						let intervalo = parseFloat($(this).parents('tr').find('> td').eq(5).find('> input').val());
						let qnt = parseFloat($(this).parents('tr').find('> td').eq(4).find('> input').val());
						let date = new Date($(this).val());
						let date_new = formatDate(addDays(date, (intervalo * qnt)));

						ultimo_date = date_new;
					}else{
						$(this).attr('min', ultimo_date);

						let intervalo = parseFloat($(this).parents('tr').find('> td').eq(5).find('> input').val());
						let qnt = parseFloat($(this).parents('tr').find('> td').eq(4).find('> input').val());
						let date = new Date($(this).val());
						let date_new = formatDate(addDays(date, (intervalo * qnt)));

						ultimo_date = date_new;
					}
				});
			}

			function cal_total(){
				let total = 0;

				$('tr:not(tr.hidden) input[name="valor_parcela"]').each(function(){

					let valor = ($(this).val().replace(/[R$. ]/g, '').replace(/,/g, '.'));
					valor = parseFloat(valor.substr(1));

					let qnt = parseFloat($(this).parents('tr').find('> td').eq(4).find('> input').val());
					

					// console.log(total, qnt, valor);
					if(!(isNaN(valor) && isNaN(qnt))){
						total += (valor * qnt);
					}

				});
				
				
				$('input#valor_restante').val((parseFloat($('input#valor_restante').attr('valor-total')) - total).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

				if((parseFloat($('input#valor_restante').attr('valor-total')) - total) == 0){
					$('input#valor_restante').removeClass('incompleto').removeClass('estorado').addClass('completo');
				}else if((parseFloat($('input#valor_restante').attr('valor-total')) - total) < 0){
					$('input#valor_restante').removeClass('incompleto').removeClass('completo').addClass('estorado');
				}else{
					$('input#valor_restante').removeClass('estorado').removeClass('completo').addClass('incompleto');
				}
			}

			//EFEITOS PARA APLICAR MASCARA DE DINHEIRO 
			$(document).on('blur', '.money', function(){

				let aux = $(this).val();

				aux = parseFloat(aux.replace(/[R$. ]/g, '').replace(/,/g, '.'));

				isNaN(aux) ? aux = 0 : '';

				aux = aux.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

				// console.log(aux);
				$(this).val(aux);
			});

			//EFEITOS PARA APLICAR MASCARA DE DINHEIRO
			$(document).on('focus', '.money', function(){
				$(this).val('');
			});
			$('a#add_parcela').click(function(){

				let tr = $('tbody#principal > tr.hidden').clone(true).removeClass('hidden');

				$('tbody#principal').append(tr);
			});

			//Rotina para validar o valor das parcelas de acordo com o valor restante 
			$('input[name="valor_parcela"]').blur(function(){
				cal_total();
			});

			//Rotina para validar o valor das parcelas de acordo com o valor restante 
			$('input[name="qnt"]').blur(function(){
				cal_total();
				att_date();					
			});

			//Rotina para remover a linha seleciopnada
			$('a.remove').click(function(){
				$(this).parents('tr').detach();
				cal_total();
			});

			//Rotina para aprovar as parcelas
			$('a#aprovar_parcela').click(function(){

				if($('input#valor_restante').hasClass('completo')){

					let dados = Array();

					let id_parcelas = Array(); 
					<?php 
						foreach($antecipar as $id){
							?>
							id_parcelas.push(<?php echo $id; ?>);							
							<?php
						} 
					 ?>


					dados.push(id_parcelas);
					let valida = 1;

					//Faço a validação das parcelas
					$('tbody#principal > tr:not(tr.hidden)').each(function(){

						let dado = {};

						dado['Valor_parcela'] = $(this).find('> td').eq(0).find('> input').val();
						dado['venc_parcela'] = $(this).find('> td').eq(1).find('> input').val();
						dado['desconto'] = $(this).find('> td').eq(2).find('> input').val();
						dado['acrescimo'] = $(this).find('> td').eq(3).find('> input').val();
						dado['qnt_parcela'] = $(this).find('> td').eq(4).find('> input').val();
						dado['intervalo'] = $(this).find('> td').eq(5).find('> input').val();


						if( (dado['Valor_parcela'] == '' && dado['Valor_parcela'] != ' R$ 0,00' )|| (dado['venc_parcela'] == '') || (dado['qnt_parcela'] == '' && dado['qnt_parcela'] != '0' )){
							valida = 0;
							return;
						}else{
							dados.push(dado);
						}
					});


					//Se estiver validado faço a aprovação das parcelas e o estorno 
					if(valida != 0){
						console.log(dados);

						$.ajax({  
							url:'const_aprova_previsao.php',  
							method:'POST', 
							data: { dados:dados, user:<?php echo $imobiliaria_idimobiliaria; ?>},

							dataType:'json',  

							success: dados => 	
							{  	
								if(dados == 1){
									window.location.replace(url_pai);
								}else{
									$('div#dialog').modal('show');
								}
							},
							error: erro => {
								console.log(0);
							}  

						});	
					}else{
						alert('Preencha todos os campos De acordo!');
					}
				}else{
					alert('Preencha corretamente os valores das Parcelas!');
				}
			});	

			$(document).on("blur", "input.date", function(){

				if($(this).attr('min') != '' && $(this).val() < $(this).attr('min') ){
					$(this).val($(this).attr('min'));

					let intervalo = parseFloat($(this).parents('tr').find('> td').eq(5).find('> input').val());
					let qnt = parseFloat($(this).parents('tr').find('> td').eq(4).find('> input').val());
					let date = new Date($(this).val());
					let date_new = formatDate(addDays(date, (intervalo * qnt)));
				}else{
					let intervalo = parseFloat($(this).parents('tr').find('> td').eq(5).find('> input').val());
					let qnt = parseFloat($(this).parents('tr').find('> td').eq(4).find('> input').val());
					let date = new Date($(this).val());
					let date_new = formatDate(addDays(date, (intervalo * qnt)));
				}

				att_date();
			});

			$(document).on('blur', 'input[name="intervalo"]', function(){
				att_date();
			});
		});
	</script>

</body>

</html>
