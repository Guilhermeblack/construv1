<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

function dados_parcela($id){
    include "conexao.php";
    $query_amigo = "SELECT valor_parcelas, data_vencimento_parcela, data_recebimento, fluxo, data_recebimento, forma_pagamento, cod_baixa, valor_recebido FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];
      $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
      $data_recebimento         = $buscar_amigo["data_recebimento"];
      $fluxo                    = $buscar_amigo["fluxo"];

      $forma_pagamento          = $buscar_amigo["forma_pagamento"];
      $cod_baixa                = $buscar_amigo["cod_baixa"];
      $valor_recebido           = $buscar_amigo["valor_recebido"];


      $dados["valor_parcelas"]           = $valor_parcelas;
      $dados["data_vencimento_parcela"]  = $data_vencimento_parcela;
      $dados["fluxo"]                    = $fluxo;

      $dados["data_recebimento"]     = $data_recebimento;
      $dados["forma_pagamento"]      = $forma_pagamento;
      $dados["cod_baixa"]            = $cod_baixa;
      $dados["valor_recebido"]       = $valor_recebido;

    }
    return $dados;
}

if(isset($_POST["idparcelas"])){

        date_default_timezone_set('America/Sao_Paulo');
        $hoje      = date('d-m-Y H:i:s');
        $cod_baixa = date('Y-m-d H:i:s');

        $cod_baixa = str_replace("-","", $cod_baixa);
        $cod_baixa = str_replace(":","", $cod_baixa);
        $cod_baixa = str_replace(" ","", $cod_baixa);
  				
  			$contacorrente_id 		= $_POST["contacorrente_id"];
  			$cliente_idcliente 		= $_POST["cliente_idcliente"];
        $situacao             = $_POST["situacao"];



        $inicio	 				      = $_POST["inicio"];
        $fim                  = $_POST["fim"];
        $fluxo                = $_POST["fluxo"];
        $obs_estorno          = $_POST["obs_estorno"];
        $estornado_por        = $_POST["estornado_por"];

       
				$antecipar_t 		      = $_POST["idparcelas"];
			


	include "conexao.php";
	foreach($antecipar_t as $id){

		$valor_recebido = $_POST[$id];

    $dados_parcela = dados_parcela($id);

      $valor_parcelas           = $dados_parcela["valor_parcelas"];
      $data_vencimento_parcela  = $dados_parcela["data_vencimento_parcela"];
      $data_recebimento         = $dados_parcela["data_recebimento"];
      $valor_recebido           = $dados_parcela["valor_recebido"];

      $inserir_estorno = mysqli_query($db, "INSERT INTO estorno_parcelas(parcelas_id, obs_estorno, estornado_por, data_estorno, fluxo, tipo, valor_parcelas, valor_recebido, data_vencimento_parcela, data_recebimento) values('$id','$obs_estorno','$estornado_por','$hoje','$fluxo','2','$valor_parcelas','$valor_recebido','$data_vencimento_parcela','$data_recebimento')");

		$inserir = ("UPDATE parcelas set		
					
          data_recebimento  = '',
          forma_pagamento   = '',
          cod_baixa         = '', 
          valor_recebido    = '', 
          situacao          = 'Em Aberto' 

					WHERE idparcelas = '$id'");

 		$executa_query = mysqli_query ($db, $inserir);
             
	}  

  if($fluxo == '1'){
?>

<script type="text/javascript">
	window.location="contas_apagar.php?cliente_idcliente=<?php echo $cliente_idcliente ?>&inicio=<?php echo $inicio ?>&fim=<?php echo $fim ?>&situacao=<?php echo $situacao ?>";
</script>
<?php }else{ ?>
<script type="text/javascript">
  window.location="contas_areceber.php?cliente_idcliente=<?php echo $cliente_idcliente ?>&inicio=<?php echo $inicio ?>&fim=<?php echo $fim ?>&situacao=<?php echo $situacao ?>";
</script>


<?php } } ?>
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
<script>
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


</script>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	

	<?php include "topo.php" ?>
	

<?php


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

function forma_pagamento($id){
include "conexao.php";
    $query_amigo = "SELECT * FROM forma_pagamento where idforma_pagamento = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $descricao           = $buscar_amigo["descricao"];
    }
    return $descricao;
}


?>




		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Estorno de Parcelas</h1>
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
                            <h4 class="panel-title">Parcelas do Contrato</h4>
                        </div>
                        <div class="panel-body">
                        <form action="recebe_estorno_pagamento.php" method="POST" name="nome">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                         
                                       <th>ID / Nosso Numero</th>
                                      
                                        <th>Valor </th>
                                        <th>Data Vencimento</th>
                                        <th>Valor Recebido</th>
                                          <th>Data de Pagamento</th>
                                          <th>Forma de  Pagamento</th>
                                          <th>Cod. Baixa</th>
                                    

                                    </tr>
                                </thead>
                                <tbody>
<?php               

              include "conexao.php";

              $cliente_idcliente = $_POST["cliente_idcliente"];
              $situacao 				 = $_POST["situacao"];
              $inicio	 				   = $_POST["inicio"];
              $fim 						   = $_POST["fim"];
              $antecipar 				 = $_POST["antecipar"];
                
              $cont = 0; 
              $cont_fluxo = 0;

             foreach($antecipar as $id){

              // busca todos os dados da parcela
              $dados_parcela 			= dados_parcela($id);


              // alimenta as variaveis 
              $valor_parcelas 			    = $dados_parcela["valor_parcelas"];
              $data_vencimento_parcela  = $dados_parcela["data_vencimento_parcela"];
              $fluxo                    = $dados_parcela["fluxo"];

              $data_recebimento         = $dados_parcela["data_recebimento"];    
              $forma_pagamento          = $dados_parcela["forma_pagamento"];     
              $cod_baixa                = $dados_parcela["cod_baixa"];          
              $valor_recebido           = $dados_parcela["valor_recebido"];      


              $cont = $cont + $valor_parcelas;



             ?>






                                    <tr>

                                     <td>
 	                                     <input type="hidden" name="cliente_idcliente" value="<?php echo $cliente_idcliente ?>">
 	                                     <input type="hidden" name="situacao" value="<?php echo $situacao ?>">
 	                                     <input type="hidden" name="inicio" value="<?php echo $inicio ?>">
                                       <input type="hidden" name="fim" value="<?php echo $fim ?>">
                                       <?php if($cont_fluxo == 0){ ?>
                                       <input type="hidden" name="fluxo" value="<?php echo $fluxo ?>">
                                       <input type="hidden" name="estornado_por" value="<?php echo $imobiliaria_idimobiliaria ?>">

                                        <input type="hidden" name="data_vencimento_parcela" value="<?php echo $data_vencimento_parcela ?>">
                                         <input type="hidden" name="valor_recebido" value="<?php echo $valor_recebido ?>">
                                          <input type="hidden" name="data_recebimento" value="<?php echo $data_recebimento ?>">
                                           <input type="hidden" name="valor_parcelas" value="<?php echo $valor_parcelas ?>">
                                       <?php } ?>

 	                                     <input type="hidden" name="idparcelas[]" value="<?php echo $id ?>">

                                     <?php echo $id ?></td>
                                    <td><?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.'); ?></</td>
                                        <td><?php echo $data_vencimento_parcela; ?></td>
                                        <td><?php echo $valor_recebido; ?> </td>
                                        <td><?php echo $data_recebimento; ?> </td>
                                       <td><?php echo forma_pagamento($forma_pagamento); ?> </td>
                                       <td><?php echo $cod_baixa; ?> </td>
                                    </tr>
                               <?php
                               $cont_fluxo = $cont_fluxo + 1;
                                } ?>
                               <tr>
                               <td> Valor Total: <?php echo ' R$ ' . number_format($cont, 2, ',', '.');  ?></td>
                                <td></td>
                                <td> </td>
                                <td></td>
                               	
                               </tr>
                               <tr>
                               			 <td> 

                                     Motivo:
                                     <textarea name="obs_estorno" class="form-control"> </textarea>
                                     </td>
                               	 			<td></td>
                                			<td></td> 
                                			<td></td>
                                </tr>


                                    <tr>
                                     <td><input type="submit" class="btn btn-success" value="Confirmar Estorno" /></td>
                                      <td></td>
                                      <td></td> 
                                      <td></td>
                                </tr>




    						

                              



                                
                                </tbody>
                            </table>
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
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>

</body>

</html>
