<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";


if(isset($_POST["cliente_idcliente2"])){



	$idvenda 						= $_GET["idvenda"];
	$idempreendimento   		 	= $_GET["idempreendimento"];
	$cessionario 				    = $_POST["cliente_idcliente2"];

	$antiga_cessao 				    = $_POST["cod_cessao"];

	$total_cessao 				    = $_POST["total_cessao"];
	$vencimento_primeira 			= $_POST["vencimento_primeira"];

	$feito_por 				    	= $_POST["feito_por"];
	$imobiliaria_idimobiliaria 		= $_POST["imobiliaria_idimobiliaria"];
	$valor_cessao 				    = $_POST["valor_cessao"];
	$antigo_titular 				= $_POST["antigo_titular"];
	$percentual 					= $_POST["percentual"];

	$valor_cessao = str_replace("R$","", $valor_cessao);
	$valor_cessao = str_replace(".","",  $valor_cessao);
	$valor_cessao = str_replace(",",".", $valor_cessao);

	$hoje = date('d-m-Y');

		$cod_cessao = date('Y-m-d H:i:s');
        $cod_cessao = str_replace("-","", $cod_cessao);
        $cod_cessao = str_replace(":","", $cod_cessao);
        $cod_cessao = str_replace(" ","", $cod_cessao);
	include "conexao.php";


	// grava na tabela de cessão o historico das informações da cessao
	$insere_cessao_nova = mysqli_query($db, "INSERT INTO cessao (antigo_titular, novo_titular, valor_cessao, data_cessao, feito_por, venda_id, total_cessao, vencimento_primeira) values('$antigo_titular', '$cessionario', '$valor_cessao', '$hoje', '$feito_por', '$idvenda', '$total_cessao', '$vencimento_primeira')");

	$recebe_ultima_cessao = mysqli_insert_id($db);



	 $cont_cessao = 0;
        $query_total_vencer = "SELECT COUNT(idparcelas) as quantidade, SUM(valor_parcelas) as total ,descricao, valor_parcelas FROM parcelas
                      WHERE tipo_venda = '2' AND venda_idvenda = $idvenda and fluxo = 0 and situacao = 'Em Aberto' group by descricao";        
                $executa_total_vencer = mysqli_query ($db,$query_total_vencer);                
                
                while ($buscar_quant = mysqli_fetch_assoc($executa_total_vencer)) {//--verifica se são amigos
                                  
                      $ccquantidade           = $buscar_quant["quantidade"];
                      $cctotal                = $buscar_quant["total"];
                      $ccdescricao            = $buscar_quant["descricao"];
                      $ccvalor_parcelas       = $buscar_quant["valor_parcelas"];

                
	// Insere o novo titular na tabela
	$insere_parcelas_cessap = mysqli_query($db, "INSERT INTO cessao_parcelas (qtd_parcelas, valor_parcela_cessao, subtotal, cessao_id, descricao_parcela) values('$ccquantidade', '$ccvalor_parcelas', '$cctotal', '$recebe_ultima_cessao', '$ccdescricao')");



  
	}
  






?>

<script type="text/javascript">
	window.location="relatorio_vendas.php?idempreendimento=<?php echo $idempreendimento ?>";
</script>
<?php } ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->


<head>
	<meta charset="utf-8" />
	<title>Immobile Business</title>
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
	   <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>

 <?php    $idempreendimento = $_GET["idempreendimento"];       
  			$idvenda = $_GET["idvenda"];       
function centrocusto_empreendimento($idempreendimento)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM empreendimento_centrocusto where empreendimento_id = $idempreendimento";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $centrocusto_id       = $buscar_amigo["centrocusto_id"];                 
                  $contacorrente_id     = $buscar_amigo["contacorrente_id"];                 

                  $dados['centrocusto_id']    = $centrocusto_id;
                  $dados['contacorrente_id']  = $contacorrente_id;
                            
			}
  	
  	return $dados;

}
     function empreendimento($idempreendimento)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM empreendimento_cadastro where idempreendimento_cadastro = $idempreendimento";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $descricao           = $buscar_amigo["descricao_empreendimento"];                 
                            
            }
    
    return $descricao;

}


  function dados_contrato($idvenda)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM venda where idvenda = $idvenda";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar dados contrato");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $cliente_idcliente           = $buscar_amigo["cliente_idcliente"];                 
                                     
            }
    	

    		$dados["cliente_idcliente"] = $cliente_idcliente;
    return $dados;

}

 function cod_cessao($idvenda, $idtitular)
{


    include "conexao.php";
       $query_amigo = "SELECT cod_cessao from proprietarios_lote WHERE venda_id = $idvenda AND cliente_id = $idtitular";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar dados contrato");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $cod_cessao           = $buscar_amigo["cod_cessao"];                 
                                     
            }
    	

    return $cod_cessao;

}


$dados_contrato = dados_contrato($idvenda);
$cod_cessao = cod_cessao($idvenda, $dados_contrato['cliente_idcliente']);

$cod_cliente = $dados_contrato['cliente_idcliente'];


include "conexao.php";





$cont_cessao2 = 0;
        $query_total_vencer2 = "SELECT  SUM(valor_parcelas) as total FROM parcelas
                      WHERE tipo_venda = '2' AND venda_idvenda = $idvenda and fluxo = 0 and situacao = 'Em Aberto' group by descricao";        
                $executa_total_vencer2 = mysqli_query ($db,$query_total_vencer2);                
                
                while ($buscar_quant2 = mysqli_fetch_assoc($executa_total_vencer2)) {//--verifica se são amigos
                                  
                      $total2                = $buscar_quant2["total"];

                      $cont_cessao2 = $cont_cessao2 + $total2;




}


            $query_ven = "SELECT data_vencimento_parcela FROM parcelas
                      WHERE tipo_venda = '2' AND venda_idvenda = $idvenda and fluxo = 0 and situacao = 'Em Aberto' group by descricao order by idparcelas ASC";        
                $exe_ven = mysqli_query ($db,$query_ven);                
                
                while ($buscar_ven = mysqli_fetch_assoc($exe_ven)) {//--verifica se são amigos
                                  
                      $r_primeira           = $buscar_ven["data_vencimento_parcela"];
                }  







?>  
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php include "topo.php" ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		
			<!-- end breadcrumb -->
			<!-- begin page-header -->
				<h1 class="page-header">
			
			
					
			
			CESSÃO E TRANSFERÊNCIA DE DIREITOS E OBRIGAÇÕES  / <?php echo empreendimento($idempreendimento) ?>/</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
                <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Informações</h4>
             
                        </div>
                        <div class="panel-body">
                            <form action="cessao_contrato.php?idvenda=<?php echo $idvenda ?>&idempreendimento=<?php echo $idempreendimento ?>" method="POST" data-parsley-validate="true" name="form_wizard">
								<div id="wizard">
									<ol>
										<li>
										    Identificação 
										    <small>Informe o Cedente e o Cessionário</small>
										</li>
										
										
										
										
									</ol>
									<!-- begin wizard step-1 -->
									<div class="wizard-step-1">
                                     
								

                                        <fieldset>
                                            <legend class="pull-left width-full">Identificação</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
													<div class="form-group block1">
														<label>Cedente Titular:</label><br><br>
									<label> <?php
									$antigo_titular = $cod_cliente;
									 echo nome_user($antigo_titular); 

									 ?></label>
											<input type="hidden" name="antigo_titular" value="<?php echo $antigo_titular ?>">

			<input type="hidden" name="total_cessao" value="<?php echo $cont_cessao2 ?>">
			<input type="hidden" name="vencimento_primeira" value="<?php echo $r_primeira ?>">

													</div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
													<div class="form-group">
														<label>Cessionário Titular:</label>
														<input type="hidden" name="cod_cessao" value="<?php echo $cod_cessao ?>">
														  <select class="default-select2 form-control" name="cliente_idcliente2">
                                        <option value="">Escolha</option>
                      <?php

                include "conexao.php";
  			
 				$query_amigo = "SELECT * FROM cliente
                				INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                				WHERE idtipo = 1 order by nome_cli Asc";
                

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             	$idcliente             	= $buscar_amigo['idcliente'];
             	$nome_cli              	= $buscar_amigo["nome_cli"];
              	$cpf_cli              	= $buscar_amigo["cpf_cli"];
        
             
            
             ?>
                    <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
                    <?php } ?>

                                           
                                        </select>
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                     
                                                <!-- end col-4 -->
                                            </div>







                                                         <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
													<div class="form-group block1">
														<label>Valor da Cessão:</label>
									<input type="text" name="valor_cessao" class="form-control" id="valor_parcelas">
									<input type="hidden" name="feito_por" value="<?php echo $imobiliaria_idimobiliaria ?>">
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                 <div class="col-md-6">
													<div class="form-group block1">
														<label>% Titular:</label>
									<input type="text" name="percentual" class="form-control" id="percentual">
									
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                     
                                                <!-- end col-4 -->
                                            </div>







                                            <!-- end row -->
								<div class="row">
								   <div class="col-md-6">
													<div class="form-group block1">
														
									<input type="submit" class="btn btn-success" value="Confirmar" name="">
													</div>
                                                </div>									
								</div>

                                          

                                          

										</fieldset>
									</div>
									<!-- end wizard step-1 -->
									
     
        




									<!-- begin wizard step-2 -->
									
									<!-- end wizard step-2 -->
									<!-- begin wizard step-3 -->
									
									<!-- end wizard step-3 -->
									<!-- begin wizard step-4 -->
								      
									<!-- end wizard step-4 -->

                        
								</div>
							</form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->






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

                          
                            <h4 class="panel-title">Histórico de cessão</h4>



                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Cedente</th>
                                       	<th>Cessionário</th>
										<th>Data</th>                                      
                                        <th>Valor</th>
                                        <th>Feito por</th>
                                        <th></th>
                         

                                    </tr>
                                </thead>
                                <tbody>
<?php 
	$idvenda = $_GET["idvenda"];

                     
                $query_amigo = "SELECT * from cessao where venda_id = $idvenda order by idcessao desc";
                $executa_query = mysqli_query ($db, $query_amigo);
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
            
            $n_antigo_titular     = $buscar_amigo["antigo_titular"];
	    	$n_novo_titular       = $buscar_amigo["novo_titular"];
            $n_valor_cessao 	  = $buscar_amigo["valor_cessao"];
            $n_data_cessao        = $buscar_amigo["data_cessao"];
            $n_feito_por          = $buscar_amigo["feito_por"];
            

             ?>

 


                      <tr>
                        
                        <td><?php echo nome_user($n_antigo_titular); ?> </td>
                        <td><?php echo nome_user($n_novo_titular); ?> </td>
                        <td><?php echo $n_data_cessao ?> </td>
                       
                        <td><?php echo 'R$' . number_format($n_valor_cessao, 2, ',', '.'); ?></td>

                        <td><?php echo nome_user($n_feito_por); ?> </td>
                        <td> 

                <div class="btn-group m-r-5 m-b-5">
                <a href="javascript:;" class="btn btn-primary">Imprimir Cessão</a>
                <a href="javascript:;" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu pull-right">
                  <?php 
                  	
                    $query_cessao =  "SELECT * FROM modelo_contrato                      
                                     WHERE tipo_doc = 4 AND empreendimento_id = $idempreendimento";

                $executa_cessao = mysqli_query ($db,$query_cessao) or die ("Erro ao listar Locador");
                while ($buscar_cessao = mysqli_fetch_assoc($executa_cessao)) {//--verifica se são amigos
               
                       
                  $descricao_modelo    = $buscar_cessao["descricao_modelo"];
                  $modelo_id           = $buscar_cessao["idmodelo_contrato"];

                  ?>
                  <li><a href="contratolocacao/cessao.php?idvenda=<?php echo $idvenda ?>&modelo_id=<?php echo $modelo_id ?>"><?php echo $descricao_modelo ?></a></li>

                <?php } ?>
                 
                </ul>
              </div>


                        </td>

                        
                      
                      </tr>
                      
               <?php } ?>

                  
                       
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
			      
			    </div>





















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
	<script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>
	 <script type="text/javascript">
$(function(){
$("#percentual").maskMoney({symbol:'', 
showSymbol:false, thousands:'', decimal:'.', symbolStay: true});
 })

$(function(){
$("#valor_parcelas").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })


$(function(){
$("#valor_taxa").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#quantidade_parcelas").maskMoney({symbol:'R$ ', 
showSymbol:false, thousands:'', decimal:'.', symbolStay: true});
 })

$(function(){
$("#quantidade_parcelas_entrada").maskMoney({symbol:'R$ ', 
showSymbol:false, thousands:'', decimal:'.', symbolStay: true});
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
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/parsley/dist/parsley.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/form-wizards-validation.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

	       <script type='text/javascript' src='cep.js'></script>
          <script type='text/javascript' src='produtos.js'></script>
	 <script type='text/javascript' src='lote.js'></script>
         <script type='text/javascript' src='medidas.js'></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			FormWizardValidation.init();
			FormPlugins.init();

		});
	</script>

</body>


</html>
