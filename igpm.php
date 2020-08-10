<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

function busca_indice_locacao($idvenda){
include "conexao.php";
    $query_amigo = "SELECT indice_correcao FROM locacao where idlocacao = $idvenda";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $indice_correcao  = $buscar_amigo["indice_correcao"];

  }

  return $indice_correcao;
}

function busca_indice_empreendimento($empreendimento_id){
include "conexao.php";
    $query_amigo = "SELECT indice_correcao FROM empreendimento where idempreendimento = $empreendimento_id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $indice_correcao  = $buscar_amigo["indice_correcao"];

  }

  return $indice_correcao;
}

function busca_empreendimento($venda_id){
include "conexao.php";
    $query_amigo = "SELECT empreendimento_idempreendimento FROM venda
                    INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                    where idvenda = $venda_id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $empreendimento_idempreendimento  = $buscar_amigo["empreendimento_idempreendimento"];

  }

  return $empreendimento_idempreendimento;
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
include "conexao.php";
$partes = explode('-', $data);
$tratada = $partes[2].'-'.$partes[1].'-'.$partes[0];
return $tratada;
}

function valor_convertido($id, $idvenda, $tipo){
	include "conexao.php";
	$hoje = date('Y-m-d');
    $query_amigo = "SELECT data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];

 	}

 	if($tipo == 2){
 	$busca_empreendimento        = busca_empreendimento($idvenda);
 	$busca_indice_empreendimento = busca_indice_empreendimento($busca_empreendimento);
 	}else{
 		$busca_indice_empreendimento = busca_indice_locacao($idvenda);
 	}
 	$indice_total = 0;
 	$query_indice = "SELECT * FROM igpm where indice_correcao = $busca_indice_empreendimento order by idigpm desc limit 12";
    $executa_indice = mysqli_query ($db, $query_indice);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_indice))
   	{
      
      $indice  		  = $buscar_amigo["indice"];
     
     $indice_total = $indice_total + $indice;

 	}

$porcem = ($indice_total / 100);


$valor_convertido = $valor_parcelas + ($valor_parcelas * $porcem);

   
return $valor_convertido;
}




// Cria uma função que retorna o timestamp de uma data no formato DD/MM/AAAA






if(isset($_POST["idparcelas"])){
	$hoje = date('d-m-Y');
	include "conexao.php";
	$antecipar_t 	= $_POST["idparcelas"];
	$idvenda 	 	= $_POST["idvenda"];
	$tipo 		 	= $_POST["tipo"];

	if($tipo == 1){
		$tabela 	= 'locacao';
		$idtabela 	= 'idlocacao';
	}
	if($tipo == 2){
		$tabela 	= 'venda';
		$idtabela 	= 'idvenda';
	}
	if($tipo == 3){
		$tabela 	= 'venda_imovel';
		$idtabela 	= 'idvenda_imovel';
	}


	foreach($antecipar_t as $id){
		
		 $valor_convertido = valor_convertido($id, $idvenda, $tipo);

		$inserir = mysqli_query($db, "UPDATE parcelas set valor_parcelas ='$valor_convertido' WHERE idparcelas = '$id'");
             
	}
		$inserir = mysqli_query($db, "UPDATE $tabela set igpm ='$hoje' WHERE $idtabela = '$idvenda'");    

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



		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="remessa/remessa.php?idvenda=<?php echo $idvenda ?>&tipo=<?php echo $tipo_venda ?>"><span class="label label-warning">Gerar Remessa</span></a></li>
				<li><a href="boletos/boleto_santander_banespa.php?idcontrato=<?php echo $idcontrato ?>"><span class="label label-warning">Imprimir Boletos</span></a></li>
				
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Reajuste do IGPM</h1>
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
                        <form action="igpm.php" method="POST" name="nome">
                <?php 
              $idvenda = $_POST["idvenda"];
              $tipo = $_POST["tipo"];
              ?>
                        <input type="hidden" name="idvenda" value="<?php echo $idvenda; ?>">
                        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
                            <table class="table table-striped">
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

             


             ?>






                                    <tr>
                                     <td>
                                     <input type="hidden" name="idparcelas[]" value="<?php echo $id ?>">
                                     <?php echo $id ?></td>
                                    <td><?php echo 'R$' . number_format(valor($id), 2, ',', '.'); ?></</td>
                                        <td><?php echo data_vencimento_parcela($id) ?></td>
                                        <td class="success"><?php echo 'R$' . number_format(valor_convertido($id, $idvenda, $tipo), 2, ',', '.'); ?></td>
                                    
                                      
                                    </tr>
                               <?php } ?>
                               <tr>
                                <td colspan="4"><input type="submit" name="corrigir" class="btn btn-success" value="Confirmar Reajuste"></td>
                               
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
