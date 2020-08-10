<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

function busca_primeira($idvenda){
  include "conexao.php";
  $query = "SELECT data_vencimento_parcela FROM parcelas where venda_idvenda = $idvenda AND tipo_venda = 2 AND descricao = 'Financiamento' order by idparcelas ASC limit 1";
  $executa_query = mysqli_query($db, $query);
  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)){
    $data_vencimento_parcela = $buscar_amigo["data_vencimento_parcela"];
  }
  return $data_vencimento_parcela;
}


function valor_convertido($id, $idvenda, $tipo){
	  include "conexao.php";
	$hoje = date('Y-m-d');
    $query_amigo = "SELECT venda_idvenda,descricao, data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];
      $descricao                = $buscar_amigo["descricao"];
      $venda_idvenda            = $buscar_amigo["venda_idvenda"];

 	}

$busca_primeira = busca_primeira($venda_idvenda);
$busca_primeira = geraTimestamp($busca_primeira);

$carencia = strtotime($busca_primeira) - strtotime($hoje);

if($carencia > 0){
  $time_inicial = $busca_primeira;
}else{
  $time_inicial = $hoje;
}

$time_final_tratar = geraTimestamp($data_vencimento_parcela);
$time_final = $time_final_tratar;

$diferenca = strtotime($time_final) - strtotime($time_inicial); 


if($diferenca > 0){

if($descricao == 'Financiamento'){


$divt = (int)floor($diferenca / (60 * 60 * 24 * 30)); // 225 dias
$juros = valor_taxa($idvenda, $tipo) /100 +1;


$potencia = pow($juros,$divt);

$valor_convertido = $valor_parcelas / $potencia;

}else{
  $valor_convertido = $valor_parcelas;
}



}else{

   $diferenca2 = strtotime($hoje) - strtotime($time_final); 

    $dias2 = (int)floor( $diferenca2 / (60 * 60 * 24)); // 225 dias

    $multa2 = ($valor_parcelas * (2/100));
    $juros2 = ($valor_parcelas * (0.033/100) * $dias2);

    $valor_convertido = $valor_parcelas + $multa2 + $juros2;


}

   
return $valor_convertido;
}

?>


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
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	

	<?php include "topo.php" ?>

	 	 <?php 
              $idvenda = $_POST["idvenda"];
              $tipo = $_POST["tipo"];
              ?>
	

<?php
function valor_taxa($idvenda, $tipo_venda){
	  include "conexao.php";
    $query_amigo = "SELECT taxa_financiamento FROM venda where idvenda = $idvenda";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $taxa_financiamento           = $buscar_amigo["taxa_financiamento"];
    }
    return $taxa_financiamento;
}
function valor($id){
	  include "conexao.php";
    $query_amigo = "SELECT empreendimento_id_novo, cliente_id_novo FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $empreendimento_id_novo    = $buscar_amigo["empreendimento_id_novo"];
      $cliente_id_novo           = $buscar_amigo["cliente_id_novo"];

      $dados["empreendimento_id_novo"] = $empreendimento_id_novo;
      $dados["cliente_id_novo"]        = $cliente_id_novo;
    }
    return $dados;
}

function data_vencimento_parcela($id){
	  include "conexao.php";
    $query_amigo = "SELECT data_vencimento_parcela FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $data_vencimento_parcela           = $buscar_amigo["data_vencimento_parcela"];
    }
    return $data_vencimento_parcela;
}

function geraTimestamp($data) {
$partes = explode('-', $data);
$tratada = $partes[2].'-'.$partes[1].'-'.$partes[0];
return $tratada;
}






// Cria uma função que retorna o timestamp de uma data no formato DD/MM/AAAA


 ?>




		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Renegociação de Contrato</h1>
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
                        <form action="recebe_renegociacao.php" method="POST" name="nome" id="nome">
                         
                               
                     
<?php               

                      include "conexao.php";
              $antecipar = $_POST["antecipar"];
                
              

             foreach($antecipar as $id){

              $valor_convertido = valor_convertido($id, $idvenda, $tipo);
              $empreendimento_id = valor($id);

              $cont = $cont + $valor_convertido;
              $cont2 = $cont2 + $valor;

             ?>
             <input type="hidden" name="renegociar[]" value="<?php echo $id ?>">
                                   
                               <?php } ?>


                                <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                         
                                       <th>Saldo Devedor</th>
                                      
                                        <th> <span class="btn btn-success"><?php echo 'R$' . number_format($cont, 2, ',', '.'); ?></span>


                              <input type="hidden" name="empreendimento_id" value="<?php echo $empreendimento_id["empreendimento_id_novo"] ?>">
                              <input type="hidden" name="cliente_id" value="<?php echo $empreendimento_id["cliente_id_novo"] ?>">
                              <input type="hidden" name="saldo_devedor" id="saldo_devedor" value="<?php echo $cont ?>">
                              <input type="hidden" name="idvenda"  value="<?php echo $idvenda ?>">
                              <input type="hidden" name="tipo"  value="<?php echo $tipo ?>">
                              <input type="hidden" name="feito_por"  value="<?php echo $imobiliaria_idimobiliaria ?>">


                                        </th>
                                       
                                    

                                    </tr>
                                </thead>
                                <tbody>
                               <tr>
                                <td>Entrada</td>
                                <td><input type="text" name="entrada_renegociar" id="entrada_renegociar" class="form-control"></td>
                               
                               </tr>
                                 <tr>
                                <td>Tarifas e Taxas Renegociação</td>
                                <td><input type="text" name="tarifas" id="tarifas" class="form-control"></td>
                               
                               </tr>

                                <tr>
                                <td>Quantidade de Parcelas</td>
                                <td><input type="text" name="qtd_renegociar" id="qtd_renegociar" class="form-control" required=""></td>
                               
                               </tr>

                                  <tr>
                                <td>Taxa de Juros</td>
                                <td><input type="text" name="taxa_renegociar" id="taxa_renegociar" class="form-control" required=""></td>
                               
                               </tr>

                               <tr>
                                <td>Data Vencimento 1º</td>
                                <td><input type="date" name="venc_primeira_renegociar" class="form-control" required=""></td>
                               
                               </tr>

                                <tr>
                                <td>Data Vencimento Restante</td>
                                <td><input type="date" name="venc_restante_renegociar" class="form-control" required=""></td>
                               
                               </tr>

                                 <tr>
                                <td>Data do Contrato</td>
                                <td><input type="date" name="data_contrato" class="form-control" required=""></td>
                               
                               </tr>
                                  <tr>
                                <td>Valor da Parcela</td>
                                <td>
                             <input type="text" name="parcela" class="form-control" id="parcela_id" value="" disabled="" required="">
                             <input type="hidden" name="parcela2" class="form-control" id="parcela_id2" value="" required="">


                         </td>
                               
                               </tr>
                                </tbody>
                            </table>
                            <input type="submit" name="Confirmar" class="btn btn-success">
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

$("#entrada_renegociar").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 
$("#tarifas").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});

$("#entrada2").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});

$("#taxa_renegociar").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

</script>

<script type="text/javascript">
	$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#taxa_renegociar').blur(function(){

           /* Configura a requisição AJAX */
           $.ajax({
                url : 'price3.php', /* URL que será chamada */ 
                type : 'GET', /* Tipo da requisição */ 
                data: 'saldo_devedor='+ $('#saldo_devedor').val()+'&entrada_renegociar='+ $('#entrada_renegociar').val()+'&qtd_renegociar='+ $('#qtd_renegociar').val()+'&taxa_renegociar='+ $('#taxa_renegociar').val()+'&tarifas='+ $('#tarifas').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
                    
 $('#parcela_id').val(data);     
 $('#parcela_id2').val(data);     
              
                }
           });   
   return false;    
   })
});
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

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
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
