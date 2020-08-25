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

<?php } ?>
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




		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Baixa de Parcelas</h1>
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
                        <form action="receber_parcelas_apagar.php" method="POST" name="nome">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID / Nosso Numero</th>            
                                        <th>Valor </th>
                                        <th>Data Vencimento</th>
                                          <th>Data Pagamento</th>
                                        <th>Descontos</th>
                                        <th>Acréscimos</th>
                                        <th>Valor Pago</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php               

              include "conexao.php";

              $cliente_idcliente 		= $_POST["cliente_idcliente"];
              $situacao 				    = $_POST["situacao"];
              $inicio	 				      = $_POST["inicio"];
              $fim                  = $_POST["fim"];

              $empreendimento_id    = $_POST["empreendimento_id"];
              $numero_lancamento    = $_POST["numero_lancamento"];
              $numero_baixa         = $_POST["numero_baixa"];
              $tipo_periodo         = $_POST["tipo_periodo"];

              $antecipar 				= $_POST["antecipar"];
                
             $cont = 0; 

             foreach($antecipar as $id){

              // busca todos os dados da parcela
              $dados_parcela 			= dados_parcela($id);


              // alimenta as variaveis 
              $valor_parcelas 			= $dados_parcela["valor_parcelas"];
              $data_vencimento_parcela	= $dados_parcela["data_vencimento_parcela"];


              // calcula o valor atualizado da parcela com as taxas
            //  $valor_parcelas			= valor_corrigido($data_vencimento_parcela, $valor_parcelas, $tipo);

              $cont = $cont + $valor_parcelas;



             ?>






                                    <tr>

<td> <body onload="CalcularDescontoApagar(<?php echo $id ?>)"></body>
            <input type="hidden" name="cliente_idcliente" value="<?php echo $cliente_idcliente ?>">
            <input type="hidden" name="empreendimento_id" value="<?php echo $empreendimento_id ?>">
            <input type="hidden" name="numero_lancamento" value="<?php echo $numero_lancamento ?>">
            <input type="hidden" name="numero_baixa" value="<?php echo $numero_baixa ?>">
            <input type="hidden" name="tipo_periodo" value="<?php echo $tipo_periodo ?>">
            <input type="hidden" name="inicio" value="<?php echo $inicio ?>">
            <input type="hidden" name="fim" value="<?php echo $fim ?>">
            <input type="hidden" name="situacao" value="<?php echo $situacao ?>">


 	                                     <input type="hidden" name="idparcelas[]" value="<?php echo $id ?>"> 

        <input type="hidden" name="baixado_por" value="<?php echo $imobiliaria_idimobiliaria ?>">

 <td><input type="text" name="valor_parcelas<?php echo $id ?>" id="valor_normal<?php echo $id ?>" class="form-control valor_parcelas" value="<?php echo  number_format($valor_parcelas, 2, ',', '.'); ?>" onblur="CalcularDescontoApagar(<?php echo $id ?>)"></td>

<td><input type="text" name="data_venci<?php echo $id ?>" class="form-control masked-input-date6" value="<?php echo $data_vencimento_parcela ?>" id="masked-input-date6"></td>
<td><input type="text" name="data_pgto<?php echo $id ?>" class="form-control masked-input-date6"></td>
  
<td><input type="text" name="desc<?php echo $id ?>" class="form-control valor_parcelas" onblur="CalcularDescontoApagar(<?php echo $id ?>)" id="desc<?php echo $id ?>"> </td>

<td><input type="text" name="acre<?php echo $id ?>" id="acre<?php echo $id ?>" class="form-control valor_parcelas"  onblur="CalcularDescontoApagar(<?php echo $id ?>)"> </td>



<td>
  <?php 

    $result_parcial = $valor_parcelas + $valor_parcelas_acrescimo;

   ?>

  <input type="text" name="n<?php echo $id ?>" id="n<?php echo $id ?>" value="<?php echo number_format($result_parcial, 2, ',', '.'); ?>" class="form-control valor_parcelas" disabled >
    <input type="hidden" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo $result_parcial ?>" class="form-control valor_parcelas"> </td>
                                    
                                      
                                    </tr>
                               <?php } ?>
                               <tr>
                               <td> Valor Total: <?php echo ' R$ ' . number_format($cont, 2, ',', '.');  ?></td>
                                <td></td>
                                <td> </td>
                                <td></td>
                               	
                               </tr>
                                
                              

                               <tr>
                               			 <td> <select name="forma_pagamento" id="forma_pagamento" class="form-control" required="" onchange="ShowHideDIV()" 
                                >
                                <?php 

     						include "conexao.php";
                            $query_amigo = "SELECT * FROM forma_pagamento";

                            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
					$idforma_pagamento            = $buscar_amigo["idforma_pagamento"];
					$descricao_forma_pagamento    = $buscar_amigo["descricao"];

					?>
                                	<option value="<?php echo $idforma_pagamento ?>"><?php echo $descricao_forma_pagamento ?></option>
                                <?php } ?>
                                </select></td>
                               	 			<td></td>
                                			<td></td> 
                                			<td></td>
                                       <td></td>
                                        <td></td>
                                        <td></td>
                                </tr>







    							<tr>
                               			 <td> <select class="form-control" name="contacorrente_id"  required="" id="contacorrente_id" >
                                        <option value="">Escolha</option>
                                         <?php

                      include "conexao.php";
                $query_conta = "SELECT * FROM contacorrente";
                $executa_conta = mysqli_query ($db,$query_conta) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_conta = mysqli_fetch_assoc($executa_conta)) {//--verifica se são amigos

             $idcontacorrente       = $buscar_conta['idcontacorrente'];          
             $agencia       = $buscar_conta['agencia'];
             $conta         = $buscar_conta["conta"];
             $dig_conta     = $buscar_conta["dig_conta"];
             $banco_cedente = $buscar_conta["banco"];

             
            
             ?>
                    <option value="<?php echo "$idcontacorrente" ?>">
                    <?php echo "$banco_cedente "."$agencia "."/ "."$conta"." - "."$dig_conta" ?> 
                    </option>
                    <?php } ?>

                    
                                           
                                        </select>


                                        </td>
                               	 			<td></td>
                                			<td></td> 
                                			<td></td>
                                       <td></td>
                                        <td></td>
                                                                                <td></td>

                                </tr>


                                <!-- <tr>
                               			 <td> 
                               			 <select class="form-control" name="talao_id"  required="" id="talao_id" style="display:none">
                                        <option value="">Escolha</option>
                                        </select>

                                        </td>
                               	 			<td></td>
                                			<td></td> 
                                			<td></td>
                                       <td></td>
                                        <td></td>
                                                                                <td></td>

                                </tr> -->




                                 <tr>
                               			 <td><input type="submit" class="btn btn-success" value="Confirmar Recebimento" /></td>
                               	 			<td></td>
                                			<td></td> 
                                			<td></td>
                                       <td></td>
                                        <td></td>
                                                                                <td></td>

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
});
		$(document).ready(function() {
			App.init();


            FormWizardValidation.init();
            TableManageButtons.init();
              FormPlugins.init();
		});
	</script>

</body>

</html>
