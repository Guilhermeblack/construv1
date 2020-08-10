<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

function busca_imovel($venda_id){
	include "conexao.php";

	$query_amigo = "SELECT imovel_idimovel FROM locacao where idlocacao = $venda_id";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $imovel_idimovel           = $buscar_amigo["imovel_idimovel"];
    }

    return $imovel_idimovel;
}

if(isset($_POST["motivo"])){

        date_default_timezone_set('America/Sao_Paulo');
        $hoje           = date('d-m-Y H:i:s');
		
		$motivo 		= $_POST["motivo"];
  		$venda_id 		= $_POST["venda_id"];       
        $estornado_por  = $_POST["estornado_por"];

  		
  		include "conexao.php";

  		$estornar = "UPDATE parcelas SET 
  					 fluxo = 14, 
  					 obs_estorno = '$motivo', 
  					 estornado_por = '$estornado_por'
  					 WHERE venda_idvenda = $venda_id AND tipo_venda = 1";
  		$executa_estorno = mysqli_query($db, $estornar);



  		$inserir_estorno = "INSERT INTO estorno_contrato(data_hora, estornado_por, motivo, venda_id, tipo_venda) values('$hoje', '$estornado_por', '$motivo', '$venda_id','1')";
  		$executa_inserir = mysqli_query($db, $inserir_estorno);

  		$busca_imovel = busca_imovel($venda_id);

  		$deleta_venda = mysqli_query($db, "DELETE FROM locacao WHERE idlocacao = $venda_id");
  		$liberar_lote = mysqli_query($db, "UPDATE imovel SET status = 1 WHERE idimovel = $busca_imovel");
?>
             

<script type="text/javascript">
  window.location="relatorio_locacoes.php";
</script>


<?php  } ?>
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
function dados_parcela($id){
	  include "conexao.php";
    $query_amigo = "SELECT valor_parcelas, data_vencimento_parcela, data_recebimento, fluxo FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];
	  $data_vencimento_parcela    = $buscar_amigo["data_vencimento_parcela"];
      $data_recebimento         = $buscar_amigo["data_recebimento"];
      $fluxo                    = $buscar_amigo["fluxo"];

      $dados["valor_parcelas"]  		     = $valor_parcelas;
      $dados["data_vencimento_parcela"]  = $data_vencimento_parcela;
      $dados["fluxo"]                    = $fluxo;

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
			<h1 class="page-header">Estorno de Locação</h1>
			<!-- end page-header -->
			<?php 

			$venda_id 		   = $_GET["venda_id"];


			 ?>
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
                            <h4 class="panel-title">Locação</h4>
                        </div>
                        <div class="panel-body">
                        <form action="recebe_estorno_locacao.php" method="POST" name="nome">
                          <input type="hidden" name="venda_id" value="<?php echo $venda_id ?>">
                          <input type="hidden" name="estornado_por" value="<?php echo $imobiliaria_idimobiliaria ?>">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                         
                                       <th>Motivo</th>
                                 
                                      
                                   
                                    

                                    </tr>
                                </thead>
                                <tbody>




                               <tr>
                               			 <td> 

                                     Motivo:
                                     <textarea name="motivo" class="form-control" required=""> </textarea>
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
