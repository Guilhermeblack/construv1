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
    $query_amigo = "SELECT venda_idvenda, descricao, data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
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

if($diferenca >= 0){

if($descricao == 'Financiamento'){


$divt = (int)floor( $diferenca / (60 * 60 * 24 * 30)); // 225 dias


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





if(isset($_POST["idparcelas"])){




	$hoje = date('d-m-Y');
	include "conexao.php";
	$antecipar_t 	= $_POST["idparcelas"];
	$idvenda 	 	= $_POST["idvenda"];
	$tipo 		 	= $_POST["tipo"];

	


	foreach($antecipar_t as $id){


		
		 $valor_convertido = valor_convertido($id, $idvenda, $tipo);



		$inserir = mysqli_query($db, "UPDATE parcelas set valor_parcelas ='$valor_convertido' WHERE idparcelas = '$id'");
             
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
    $query_amigo = "SELECT valor_parcelas FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];
    }
    return $valor_parcelas;
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
			<ol class="breadcrumb pull-right">
				<li><a href="remessa/remessa.php?idvenda=<?php echo $idvenda ?>&tipo=<?php echo $tipo_venda ?>"><span class="label label-warning">Gerar Remessa</span></a></li>
				<li><a href="boletos/boleto_santander_banespa.php?idcontrato=<?php echo $idcontrato ?>"><span class="label label-warning">Imprimir Boletos</span></a></li>
				
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Antecipação de Parcelas</h1>
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
                        <form action="recebe_antecipar.php" method="POST" name="nome">
                          <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                         
                                       <th>ID / Nosso Numero</th>
                                      
                                        <th>Valor </th>
                                        <th>Data Vencimento</th>
                                        <th> Valor Convertido</th>
                                    

                                    </tr>
                                </thead>
                                <tbody>
                               
                     
<?php               

                      include "conexao.php";
              $antecipar = $_POST["antecipar"];
                
              

             foreach($antecipar as $id){

              $valor_convertido = valor_convertido($id, $idvenda, $tipo);
              $valor = valor($id);

              $cont = $cont + $valor_convertido;
              $cont2 = $cont2 + $valor;

             ?>






                                    <tr>
                                     <td>


   <input type="hidden" name="idvenda" value="<?php echo $idvenda; ?>">
                        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">

                                     	<?php echo $id ?>
                                  <input type="hidden" name="idparcelas[]" value="<?php echo $id ?>">

                                     </td>
                                    <td><?php echo 'R$' . number_format($valor, 2, ',', '.'); ?></</td>
                                        <td><?php echo data_vencimento_parcela($id) ?></td>
                                        <td class="success"><?php 
                                      echo 'R$' . number_format($valor_convertido, 2, ',', '.');



                                         ?></td>
                                    
                                      
                                    </tr>
                               <?php } ?>
                               <tr>
                                <td class="danger">Total Nominal:</td>
                               	<td class="danger" style="font-weight: bold"> <?php echo 'R$' . number_format($cont2, 2, ',', '.'); ?></td>
                               	<td class="success">Total Convertido:</td>
                               	<td class="success" style="font-weight: bold"> <?php echo 'R$' . number_format($cont, 2, ',', '.'); ?></td>
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
