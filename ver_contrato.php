<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
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
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
<?php
function dados_cliente($idcliente)
{
  include "conexao.php";
  $query_amigo323 = "SELECT * FROM cliente where idcliente = '$idcliente'";
  $executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar dados cliente");
                
                
            while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            
            $nome_cli         = $buscar_amigo323['nome_cli'];
            $telefone1_cli    = $buscar_amigo323['telefone1_cli'];
            $telefone2_cli    = $buscar_amigo323['telefone2_cli'];
            $cpf_cli          = $buscar_amigo323['cpf_cli'];
            $rg_cli           = $buscar_amigo323['rg_cli'];
            $email_cli        = $buscar_amigo323['email_cli'];

            $dados['nome_cli']      = $nome_cli;
            $dados['telefone1_cli'] = $telefone1_cli;
            $dados['telefone2_cli'] = $telefone2_cli;
            $dados['cpf_cli']       = $cpf_cli;
            $dados['rg_cli']        = $rg_cli;
            $dados['email_cli']     = $email_cli;

            }

            return $dados;
}


 ?> 
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
	
	<?php  include "topo.php"; ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		<?php 

		$idlocacao = $_GET["idlocacao"];
		include "conexao.php";
			$query_amigo =  "SELECT * FROM locacao
                       INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
                       WHERE idlocacao = $idlocacao";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Locador");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
                       
                  $iptu                                       = $buscar_amigo["iptu"];
                  $vencimento_iptu                            = $buscar_amigo["vencimento_iptu"];
                  $qtd_parcelas_iptu                          = $buscar_amigo["qtd_parcelas_iptu"];
                  $valor_aluguel                              = $buscar_amigo["valor_aluguel"];
                  $prazo_contrato                             = $buscar_amigo["prazo_contrato"];
                  $primeira_parcela                           = $buscar_amigo["primeira_parcela"];
                  $condominio                                 = $buscar_amigo["condominio"];
                  $vencimento_condominio                      = $buscar_amigo["vencimento_condominio"];
                  $qtd_parcelas_condominio                    = $buscar_amigo["qtd_parcelas_condominio"];
                  $taxa_administrativa                        = $buscar_amigo["taxa_administrativa"];
                  $meses_repasse                              = $buscar_amigo["meses_repasse"];
                  $valor_repasse                              = $buscar_amigo["valor_repasse"];
                  $dia_repasse                                = $buscar_amigo["dia_repasse"];
                  $valor_alugueis                             = $buscar_amigo["valor_alugueis"];
                  $vencimento_garantia_aluguel                = $buscar_amigo["vencimento_garantia_aluguel"];
                  $qtd_parcelas_garantia_aluguel              = $buscar_amigo["qtd_parcelas_garantia_aluguel"];
                  $valor_danos                                = $buscar_amigo["valor_danos"];
                  $vencimento_garantia_danos                  = $buscar_amigo["vencimento_garantia_danos"];
                  $qtd_parcelas_garantia_danos                = $buscar_amigo["qtd_parcelas_garantia_danos"];
                  $terreno                                    = $buscar_amigo["terreno"];
                  $area_construida                            = $buscar_amigo["area_construida"];
                  $endereco                                   = $buscar_amigo["endereco"];
                  $numero                                     = $buscar_amigo["numero"];
                  $cidade                                     = $buscar_amigo["cidade_idcidade"];
                  $estado                                     = $buscar_amigo["estado"];
                  $matricula                                  = $buscar_amigo["matricula"];
                  $idlocacao                                  = $buscar_amigo["idlocacao"];                
                  $ref                                        = $buscar_amigo["idimovel"];
                  $data_cadastro                              = $buscar_amigo["data_venda"];
                  $tipo                                       = $buscar_amigo["tipo"];
                  $finalidade                                 = $buscar_amigo["finalidade"];
                  $bairro                                     = $buscar_amigo["bairro"];
                  $img_principal                              = $buscar_amigo["img_principal"];
                  $endereco                                   = $buscar_amigo["endereco"]; 				  
                  $numero                                     = $buscar_amigo["numero"];
                  $cidade                                     = $buscar_amigo["cidade"];
                  $estado                                     = $buscar_amigo["estado"];
                  $locador_idlocador                          = $buscar_amigo["locador_idlocador"];
                  $locatario_id                               = $buscar_amigo["cliente_idcliente"];
                  $b_indice_correcao                          = $buscar_amigo["indice_correcao"];

                  $cadastrado_feito_por                       = $buscar_amigo["cadastrado_por"];
                  $data_cadastro_feito                        = $buscar_amigo["data_cadastro"];
                  $data_venda                                 = $buscar_amigo["data_venda"];
            

             }



             $dados_locador   = dados_cliente($locador_idlocador);
             $dados_locatario = dados_cliente($locatario_id);




?>




			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"> </small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-6 -->
			    <div class="col-md-12">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#default-tab-1" data-toggle="tab">Resumo</a></li>
<li class=""><a href="vistoria.php?idlocacao=<?php echo $idlocacao ?>">Vistoria</a></li>
<li class=""><a href="ocorrencias.php?idlocacao=<?php echo $idlocacao ?>">Ocorrências</a></li>
<li class=""><a href="cobranca.php?idlocacao=<?php echo $idlocacao ?>">Cobrança</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="default-tab-1">
							 
							<div class="invoice">
                <div class="invoice-company">
                    <span class="pull-right hidden-print">
                  
                    <a href="parcelas.php?idvenda=<?php echo $idlocacao ?>&tipo=1" class="btn btn-sm btn-success m-b-10"><i class="fa fa-money m-r-5"></i> Parcelas</a>
               
           
                    <a href="contratolocacao/index.php?idimovel=<?php echo $ref ?>" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Imprimir Contrato</a>
           
                  
                    <a href="contratolocacao/vistoria.php?idimovel=<?php echo $ref ?>" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Imprimir Vistoria</a>

                      <?php if (in_array('50', $idrota)) { ?>

                     <a href="recebe_estorno_locacao.php?venda_id=<?php echo $idlocacao ?>" class="btn btn-sm btn-danger m-b-10"><i class="fa fa-trash m-r-5"></i> Estornar Contrato</a>

                     <?php } ?>
          
                    </span>
                    <?php echo "$endereco".", "."$numero "."$cidade"."/ "."$estado" ?>
                </div>
                <div class="invoice-header">
                    <div class="invoice-from">
                        <small>Locatário:</small>
                        <address class="m-t-5 m-b-5">
                            <strong><?php echo $dados_locatario['nome_cli']; ?></strong><br />
                            CPF: <?php echo $dados_locatario['cpf_cli']; ?><br />
                            RG: <?php echo $dados_locatario['rg_cli']; ?><br />
                             Tel: <?php echo $dados_locatario['telefone1_cli']; ?><br />
                            Tel 2: <?php echo $dados_locatario['telefone2_cli']; ?>
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>Locador:</small>
                         <address class="m-t-5 m-b-5">
                            <strong><?php echo $dados_locador['nome_cli']; ?></strong><br />
                            CPF: <?php echo $dados_locador['cpf_cli']; ?><br />
                            RG: <?php echo $dados_locador['rg_cli']; ?><br />
                             Tel: <?php echo $dados_locador['telefone1_cli']; ?><br />
                            Tel 2: <?php echo $dados_locador['telefone2_cli']; ?><br />
                            E-mail: <?php echo $dados_locador['email_cli']; ?>
                        </address>
                    </div>
                    <div class="invoice-date">
                        <small>Data Inicio </small>
                        <div class="date m-t-5"><?php echo $data_cadastro ?></div>
                        <div class="invoice-detail">
                            Código do Contrato:<?php echo "#".$idlocacao ?><br />
                            Código do Imóvel:<?php echo "#".$ref ?><br />
                            Cadastrado por:<?php echo nome_user($cadastrado_feito_por); ?><br />
                           
                        </div>
                    </div>
                </div>
                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Descrição Adicionais</th>
                                    <th>Valor</th>
                                    <th>Quantidade Parcelas</th>                                  
                                </tr>
                            </thead>
                            <tbody>

                            <?php if($iptu != '') { ?>
                                <tr>
                                   <td> IPTU </td>
                                   <td> <?php echo $iptu ?> </td>
                                   <td> <?php echo $qtd_parcelas_iptu ?>  </td>                                   
                                </tr>
                           <?php } ?>

                              <?php if($condominio != '') { ?>
                                <tr>
                                   <td> Condominio </td>
                                   <td> <?php echo $condominio ?> </td>
                                   <td> <?php echo $qtd_parcelas_condominio ?>  </td>                                   
                                </tr>
                           <?php } ?>

                              <?php if($valor_alugueis != '') { ?>
                                <tr>
                                   <td> Garantia Aluguel </td>
                                   <td> <?php echo $valor_alugueis ?> </td>
                                   <td> <?php echo $qtd_parcelas_garantia_aluguel ?>  </td>                                   
                                </tr>
                           <?php } ?>

                             <?php if($valor_danos != '') { ?>
                                <tr>
                                   <td> Garantia Danos </td>
                                   <td> <?php echo $valor_danos ?> </td>
                                   <td> <?php echo $qtd_parcelas_garantia_danos ?>  </td>                                   
                                </tr>
                           <?php } ?>






                            </tbody>
                        </table>

                        

                       
                          

                                 <?php if($taxa_administrativa != ''){ ?>

                         <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Taxa Administrativa</th>
                                    <th>Total Meses Repasse</th>
                                    <th>Valor Repasse</th> 
                                    <th>Dia do Repasse</th> 
                                                           
                                </tr>
                            </thead>
                            <tbody>
                             <tr>
                                   <td> <?php echo $taxa_administrativa ?> </td>
                                   <td> <?php echo $meses_repasse ?> </td>
                                   <td> <?php echo $valor_repasse ?>  </td>    
                                   <td> <?php echo $dia_repasse ?>  </td>                                   
                                </tr>

                            </tbody>
                            </table>

                            <?php } ?>
                            <form action="altera_indice_locacao.php?idlocacao=<?php echo $idlocacao ?>" method="POST">
                                <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Índice Reajuste</th>
                                    <th></th>
                                   
                                                           
                                </tr>
                            </thead>
                            <tbody>
                             <tr>
                                   <td>   

                                    <select class="default-select2 form-control" name="indice_correcao">
                                        <option value="">Escolha</option>
                                          <?php

                      include "conexao.php";
                 
                $query_indice = "SELECT * FROM indice_correcao order by idindice_correcao desc";


                $executa_indice = mysqli_query ($db, $query_indice);
                while ($buscar_indice = mysqli_fetch_assoc($executa_indice)) {//--verifica se são amigos
           
                $idindice_correcao             = $buscar_indice['idindice_correcao'];
                $descricao_indice              = $buscar_indice["descricao_indice"];
              
             
            
             ?>
               <option value="<?php echo "$idindice_correcao" ?>"

                     <?php if($b_indice_correcao == $idindice_correcao){ ?> selected <?php } ?>

> <?php echo "$descricao_indice" ?> </option>
                    <?php } ?>
                    
                                           
                                        </select> </td>

                                        <td><input type="submit" name="Gravar" value="Gravar" class="btn btn-success"></td>
                                                                   
                                </tr>

                            </tbody>
                            </table>

                  </form>



                    <form action="altera_data_venda.php?idlocacao=<?php echo $idlocacao ?>" method="POST">
                                <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Data do Contrato: <?php echo $data_venda ?></th>
                                    <th></th>
                                   
                                                           
                                </tr>
                            </thead>
                            <tbody>
                             <tr>
                                   <td>   
                                    <input type="date" name="data_venda" class="form-control" value="<?php echo $data_venda ?>">
                                    </td>

                                        <td><input type="submit" name="Gravar" value="Gravar" class="btn btn-success"></td>
                                                                   
                                </tr>

                            </tbody>
                            </table>

                  </form>

                    </div>
                  
            </div>


						</div>




<!-- inicio da aba de parcelas -->


						<div class="tab-pane fade" id="default-tab-2">
							


						</div>
						<div class="tab-pane fade" id="default-tab-3">
							
						</div>
					</div>
					
				</div>
			    <!-- end col-6 -->
			 
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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	
<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
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
