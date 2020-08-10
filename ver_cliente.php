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

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/ui_tabs_accordions.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:11:38 GMT -->
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
			$query_amigo = "SELECT * FROM locacao
                 INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
                 INNER JOIN cliente ON imovel.locador_idlocador = cliente.idcliente
                 WHERE idlocacao = $idlocacao";


        
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
                  $idlocador          = $buscar_amigo["idcliente"];
                  $nome_loc           = $buscar_amigo["nome_cli"];
                  $cpf_loc            = $buscar_amigo["cpf_cli"];
                  $rg_loc             = $buscar_amigo["rg_cli"];
                  $estadocivil_loc    = $buscar_amigo["estadocivil_cli"];
                  $nacionalidade_loc  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_loc      = $buscar_amigo["profissao_cli"];
                  $nascimento_loc     = $buscar_amigo["nascimento_cli"];
                  $email_loc          = $buscar_amigo["email_cli"];
                  $cidade_loc         = $buscar_amigo["cidade_cli"];
                  $logradouro_loc     = $buscar_amigo["logradouro_cli"];
                  $endereco_loc       = $buscar_amigo["endereco_cli"];
                  $numero_loc         = $buscar_amigo["numero_cli"];
                  $complemento_loc    = $buscar_amigo["complemento_cli"];
                  $bairro_loc         = $buscar_amigo["bairro_cli"];
                  $complemento_loc    = $buscar_amigo["complemento_cli"];
                  $telefone1_loc      = $buscar_amigo["telefone1_cli"];
                  $telefone2_loc      = $buscar_amigo["telefone2_cli"];

                  $cep_loc            = $buscar_amigo["cep_cli"];
                  $estado_loc         = $buscar_amigo["estado_cli"];

          
                  $iptu                = $buscar_amigo["iptu"];
                  $vencimento_iptu     = $buscar_amigo["vencimento_iptu"];
                  $valor_aluguel       = $buscar_amigo["valor_aluguel"];
                  $prazo_contrato      = $buscar_amigo["prazo_contrato"];
                  $primeira_parcela    = $buscar_amigo["primeira_parcela"];

                  $terreno            = $buscar_amigo["terreno"];
                  $area_construida    = $buscar_amigo["area_construida"];
                  $endereco           = $buscar_amigo["endereco"];
                  $numero             = $buscar_amigo["numero"];
                  $cidade             = $buscar_amigo["cidade_idcidade"];
                  $estado             = $buscar_amigo["estado"];
                  $matricula          = $buscar_amigo["matricula"];

              
          ////////////////////////////////////////// imovel       
                  $idlocacao        = $buscar_amigo["idlocacao"];                
                  $ref              = $buscar_amigo["idimovel"];
                  $data_cadastro    = $buscar_amigo["data_venda"];
                  $tipo             = $buscar_amigo["tipo"];
                  $finalidade       = $buscar_amigo["finalidade"];
                  $bairro           = $buscar_amigo["bairro"];
                  $img_principal    = $buscar_amigo["img_principal"];
                  $endereco    = $buscar_amigo["endereco"];
 				  
                  $numero    = $buscar_amigo["numero"];
                              $cidade    = $buscar_amigo["cidade"];
                              $estado    = $buscar_amigo["estado"];

             }






            $query_amigo_con = "SELECT * FROM conjuge
                                INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                                WHERE cliente_idcliente = $idlocador";


        
                $executa_query_con = mysqli_query ($db,$query_amigo_con) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_con)) {//--verifica se são amigos
               
                 
                  $nome_con_loc           = $buscar_amigo["nome_cli"];
                  $cpf_con_loc            = $buscar_amigo["cpf_cli"];
                  $rg_con_loc             = $buscar_amigo["rg_cli"];
                  $nacionalidade_con_loc  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_con_loc      = $buscar_amigo["profissao_cli"];
                  $nascimento_con_loc     = $buscar_amigo["nascimento_cli"];
               
}












//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$query_amigo_dif = "SELECT * FROM locacao
                 INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
                 INNER JOIN cliente ON locacao.cliente_idcliente = cliente.idcliente
                 WHERE idimovel = $idimovel";


        
                $executa_query_dif = mysqli_query ($db,$query_amigo_dif) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_dif)) {//--verifica se são amigos


                  $idcliente          = $buscar_amigo["cliente_idcliente"];
                  $nome_cli           = $buscar_amigo["nome_cli"];
                  $cpf_cli            = $buscar_amigo["cpf_cli"];
                  $rg_cli             = $buscar_amigo["rg_cli"];
                  $estadocivil_cli    = $buscar_amigo["estadocivil_cli"];
                  $nacionalidade_cli  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_cli      = $buscar_amigo["profissao_cli"];
                  $nascimento_cli     = $buscar_amigo["nascimento_cli"];
                  $email_cli          = $buscar_amigo["email_cli"];
                  $cidade_cli         = $buscar_amigo["cidade_cli"];
                  $logradouro_cli     = $buscar_amigo["logradouro_cli"];
                  $endereco_cli       = $buscar_amigo["endereco_cli"];
                  $numero_cli         = $buscar_amigo["numero_cli"];
                  $complemento_cli    = $buscar_amigo["complemento_cli"];
                  $bairro_cli         = $buscar_amigo["bairro_cli"];
                  $complemento_cli    = $buscar_amigo["complemento_cli"];
                  $telefone1_cli      = $buscar_amigo["telefone1_cli"];
                  $telefone2_cli      = $buscar_amigo["telefone2_cli"];

                  $cep_cli            = $buscar_amigo["cep_cli"];
                  $estado_cli         = $buscar_amigo["estado_cli"];


}

  $query_amigo_cli = "SELECT * FROM conjuge
                                INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                                WHERE cliente_idcliente = $idcliente";


        
                $executa_query_cli = mysqli_query ($db,$query_amigo_cli) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {//--verifica se são amigos
               
                 
                  $nome_con           = $buscar_amigo["nome_cli"];
                  $cpf_con            = $buscar_amigo["cpf_cli"];
                  $rg_con             = $buscar_amigo["rg_cli"];
                  $nacionalidade_con  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_con      = $buscar_amigo["profissao_cli"];
                  $nascimento_con     = $buscar_amigo["nascimento_cli"];
               
}


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
						<li class=""><a href="parcelas.php?idlocacao=<?php echo $idlocacao ?>">Garantias</a></li>
						<li class=""><a href="historico.php?idlocacao=<?php echo $idlocacao ?>">Seguro</a></li>
						<li class=""><a href="historico.php?idlocacao=<?php echo $idlocacao ?>">Reservas</a></li>
						<li class=""><a href="historico.php?idlocacao=<?php echo $idlocacao ?>">Vistoria</a></li>
						<li class=""><a href="historico.php?idlocacao=<?php echo $idlocacao ?>">Galeria de Fotos</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="default-tab-1">
							 
							<div class="invoice">
                <div class="invoice-company">
                    <span class="pull-right hidden-print">
                     
                    <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Parcelas</a>
                     <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Imprimir Contrato</a>

                    <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Imprimir Vistoria</a>
                   
                    </span>
                    <?php echo "$endereco".", "."$numero "."$cidade"."/ "."$estado" ?>
                </div>
                <div class="invoice-header">
                    <div class="invoice-from">
                        <small>Locatário:</small>
                        <address class="m-t-5 m-b-5">
                            <strong><?php echo $nome_cli ?></strong><br />
                            CPF: <?php " $cpf_cli" ?><br />
                            RG: <?php " $rg_cli" ?><br />
                             Tel: <?php " $telefone1_cli" ?><br />
                            Tel 2: <?php " $telefone2_cli" ?>
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>Locador:</small>
                        <address class="m-t-5 m-b-5">
                            <strong><?php echo $nome_loc ?></strong><br />
                            CPF: <?php " $cpf_loc" ?><br />
                            RG: <?php " $rg_loc" ?><br />
                             Tel: <?php " $telefone1_loc" ?><br />
                            Tel 2: <?php " $telefone2_loc" ?>
                        </address>
                    </div>
                    <div class="invoice-date">
                        <small>Data Inicio </small>
                        <div class="date m-t-5"><?php echo $data_venda ?></div>
                        <div class="invoice-detail">
                            <?php echo "#".$idlocacao ?><br />
                            Código do Contrato
                        </div>
                    </div>
                </div>
                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>TASK DESCRIPTION</th>
                                    <th>RATE</th>
                                    <th>HOURS</th>
                                    <th>LINE TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Website design &amp; development<br />
                                        <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id sagittis arcu.</small>
                                    </td>
                                    <td>$50.00</td>
                                    <td>50</td>
                                    <td>$2,500.00</td>
                                </tr>
                                <tr>
                                    <td>
                                        Branding<br />
                                        <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id sagittis arcu.</small>
                                    </td>
                                    <td>$50.00</td>
                                    <td>40</td>
                                    <td>$2,000.00</td>
                                </tr>
                                <tr>
                                    <td>
                                        Redesign Service<br />
                                        <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id sagittis arcu.</small>
                                    </td>
                                    <td>$50.00</td>
                                    <td>50</td>
                                    <td>$2,500.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <div class="invoice-price-row">
                                <div class="sub-price">
                                    <small>SUBTOTAL</small>
                                    $4,500.00
                                </div>
                                <div class="sub-price">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="sub-price">
                                    <small>PAYPAL FEE (5.4%)</small>
                                    $108.00
                                </div>
                            </div>
                        </div>
                        <div class="invoice-price-right">
                            <small>TOTAL</small> $4508.00
                        </div>
                    </div>
                </div>
                <div class="invoice-note">
                    * Make all cheques payable to [Your Company Name]<br />
                    * Payment is due within 30 days<br />
                    * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
                </div>
                <div class="invoice-footer text-muted">
                    <p class="text-center m-b-5">
                        THANK YOU FOR YOUR BUSINESS
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-globe"></i> matiasgallipoli.com</span>
                        <span class="m-r-10"><i class="fa fa-phone"></i> T:016-18192302</span>
                        <span class="m-r-10"><i class="fa fa-envelope"></i> rtiemps@gmail.com</span>
                    </p>
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

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/ui_tabs_accordions.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:11:38 GMT -->
</html>
