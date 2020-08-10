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
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
	
	<?php  include "topo.php"; ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
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

            $dados['nome_cli']      = $nome_cli;
            $dados['telefone1_cli'] = $telefone1_cli;
            $dados['telefone2_cli'] = $telefone2_cli;
            $dados['cpf_cli']       = $cpf_cli;
            $dados['rg_cli']        = $rg_cli;

            }

            return $dados;
}


 ?>	
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		<?php 

		$idimovel = $_GET["idimovel"];

		            include "conexao.php";
			          $query_amigo = "SELECT * FROM imovel
                                WHERE idimovel = $idimovel";

       
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Locador");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
               
                  $locador_idlocador  = $buscar_amigo["locador_idlocador"];
                  $terreno            = $buscar_amigo["terreno"];
                  $area_construida    = $buscar_amigo["area_construida"];
                  $dormitorios        = $buscar_amigo["dormitorios"];
                  $banheiros          = $buscar_amigo["banheiros"];
                  $cozinhas           = $buscar_amigo["cozinhas"];
                  $suites             = $buscar_amigo["suites"];

                  $endereco           = $buscar_amigo["endereco"];
                  $numero             = $buscar_amigo["numero"];
                  $cidade             = $buscar_amigo["cidade_idcidade"];
                  $estado             = $buscar_amigo["estado"];
                  $matricula          = $buscar_amigo["matricula"];

                  $ref_energia        = $buscar_amigo["ref_energia"];
                  $ref_agua           = $buscar_amigo["ref_agua"];
                  $ref_gas            = $buscar_amigo["ref_gas"];

          ////////////////////////////////////////// imovel       
                  $tipo             = $buscar_amigo["tipo"];
                  $finalidade       = $buscar_amigo["finalidade"];
                  
                  $preco            = $buscar_amigo["preco"];
                  $cadastrado_por_imo   = $buscar_amigo["imobiliaria_idimobiliaria"];
                  $data_cadastro    = $buscar_amigo["data_cadastro"];
                  $alterado_por     = $buscar_amigo["alterado_por"];
                  $data_alterado    = $buscar_amigo["data_alterado"];

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
<li class=""><a href="visita_imovel.php?idimovel=<?php echo $idimovel ?>">Visitas</a></li>
<li class=""><a href="adicionar_imagem.php?idimovel=<?php echo "$idimovel"; ?>">Galeria de Fotos</a></li>
<li class=""><a href="tour_360.php?idimovel=<?php echo "$idimovel"; ?>">Tour 360</a></li>
<li class=""><a href="video_imovel.php?idimovel=<?php echo "$idimovel"; ?>">Vídeo</a></li>
<li class=""><a href="integracao.php?idimovel=<?php echo "$idimovel"; ?>">Integração Portais</a></li>


<li class=""><a href="ocorrencias_imovel.php?idimovel=<?php echo $idimovel?>">Ocorrências</a></li>
<li class=""><a href="placa_imovel.php?idimovel=<?php echo $idimovel?>">Placa</a></li>
<li class=""><a href="proprietario_imovel.php?idimovel=<?php echo $idimovel?>">Proprietários</a></li>



					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="default-tab-1">
							 
							<div class="invoice">
                <div class="invoice-company">
                    <span class="pull-right hidden-print">
                          <a href="contratolocacao/proposta_imovel.php?idimovel=<?php echo $idimovel ?>" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Imprimir Proposta</a>


                     <a href="#modal-dialog" class="btn btn-sm btn-success m-b-10" data-toggle="modal"><i class="fa fa-print m-r-5"></i> Agendar Visita</a>
               
                   <?php if (in_array('18', $idrota)) { ?>
                     <a href="editar_imoveis.php?idimovel=<?php echo "$idimovel"; ?>" class="btn btn-sm btn-warning m-b-10"><i class="fa fa-print m-r-5"></i> Editar Dados</a>
                     <?php } ?>
                     <?php if (in_array('19', $idrota)) { ?>
                    <a href="excluir_imovel.php?idimovel=<?php echo "$idimovel"; ?>" class="btn btn-sm btn-danger m-b-10"><i class="fa fa-download m-r-5"></i> Excluir Imóvel</a>
                   <?php } ?>
                    </span>
                    <?php echo "$endereco".", "."$numero "."$cidade"."/ "."$estado" ?>
                </div>
                <div class="invoice-header">
                    <div class="invoice-from">
                        <small>Proprietário:</small>
                       <?php  $dados_cliente =  dados_cliente($locador_idlocador); ?>
                        <address class="m-t-5 m-b-5">
                          <strong><?php echo $dados_cliente['nome_cli']; ?></strong><br />
                           <strong> CPF:</strong> <?php echo $dados_cliente['cpf_cli']; ?><br />
                         <strong>   RG:</strong> <?php echo $dados_cliente['rg_cli']; ?><br />
                          <strong>   Tel: </strong><?php echo $dados_cliente['telefone1_cli']; ?><br />
                         <strong>   Tel 2:</strong> <?php echo $dados_cliente['telefone2_cli']; ?>
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>Imóvel:</small>
                        <address class="m-t-5 m-b-5">
                            <strong>Ref: </strong><?php echo $idimovel ?></strong><br />
                         <strong>   Valor :</strong> <?php echo" $preco" ?><br />
                         <strong>    Tipo: </strong><?php echo " $tipo" ?><br />
                         <strong>   Finalidade: </strong><?php echo " $finalidade" ?>
                        </address>
                    </div>
                     <div class="invoice-to">
                        <small>Ficha:</small>
                        <address class="m-t-5 m-b-5">
                       <strong>     Dormitório:</strong> <?php echo $dormitorios ?><br />
                        <strong>    Suite: </strong><?php echo" $suites" ?><br />
                        <strong>    Banheiro: </strong><?php echo " $banheiros" ?><br />
                       <strong>      Area Terreno: </strong><?php echo " $area_terreno" ?><br />
                      <strong>      Area Construida: </strong><?php echo " $area_construida" ?>
                        </address>
                    </div>
                      <div class="invoice-to">
                        <small>Referencias:</small>
                        <address class="m-t-5 m-b-5">
                       <strong>     Ref Agua: </strong><?php echo " $ref_agua" ?><br />
                      <strong>      Ref Energia: </strong><?php echo" $ref_energia" ?><br />
                      <strong>      Ref Gas: </strong><?php echo " $ref_gas" ?><br />
                      Cadastrado por: <?php echo nome_user($cadastrado_por_imo); ?> - <?php echo $data_cadastro ?> <br>
                      <?php if($alterado_por != '0'){  ?>
                      Alterado por: <?php echo nome_user($alterado_por); ?> - <?php echo $data_alterado ?>
                            <?php } ?>
                        </address>
                    </div>
                   
                </div>
                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Ultimas Ocorrencias:</th>
                                    <th>Data:</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
<?php 
                            include "conexao.php";
      $query_amigo = "SELECT * FROM ocorrencia_imovel
                      WHERE idimovel = $idimovel limit 5";


        
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
                  $titulo              = $buscar_amigo["titulo"];
                  $descricao           = $buscar_amigo["descricao"];
                  $data_ocorrencia     = $buscar_amigo["data_ocorrencia"];
                  $cadastrado_por      = $buscar_amigo["cadastrado_por"];
                  ?>
                                <tr>
                                    <td>
                                        <?php echo $titulo ?><br />
                                        <small><?php echo $descricao ?></small>
                                    </td>
                                    <td><?php echo $data_ocorrencia ?> - <?php echo nome_user($cadastrado_por);  ?></td>
                                   
                                </tr>
                           
<?php } ?>


                            </tbody>
                        </table>
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
      <div class="modal fade" id="modal-dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Agendar Visita</h4>
                    </div>
                    <div class="modal-body">


              <form class="form-group" id="formmodal" action="visita_imovel.php?idimovel=<?php echo $idimovel ?>" method="POST">
                               <div class="form-group">
                                    <label class="col-md-3 control-label">Interessado:</label>
                                    <div class="col-md-9">
                                         <select class="form-control" name="cliente_idcliente">
                                            <option value="">Selecione</option>
                                        
                                       
                                        <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM cliente
                                                 INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                                 INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                                 where cliente_tipo.idtipo = 7 
") or die ("Erro ao listar Interessados, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idcliente  = $buscar_slide["idcliente"];
             $nome_cli   = $buscar_slide["nome_cli"];

                    ?> 
                                            <option value="<?php echo $idcliente ?>"><?php echo $nome_cli ?></option>
                                           <?php } ?>
                                           

                                        </select>
                                        
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Corretor:</label>
                                    <div class="col-md-9">
                                          <select class="form-control" name="corretor_idcorretor">
                                            <option value="">Selecione</option>
                                        
                                       
                                        
                                        <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM cliente
                                                 INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                                 INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                                 where cliente_tipo.idtipo = 8  group by cliente.idcliente
") or die ("Erro ao listar Locador, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idcorretor      = $buscar_slide["idcliente"];
             $nome_corretor   = $buscar_slide["nome_cli"];

                    ?> 
                                            <option value="<?php echo $idcorretor ?>"><?php echo $nome_corretor ?></option>
                                           <?php } ?>
                                           

                                        </select>

                                        
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Retirada</label>
                                    <div class="col-md-9"><br>Data:
                                        <input type="text" class="form-control" name="data_reserva" id="masked-input-date" placeholder="Retirada das Chaves" /><br>Hora:
                                        <input type="text" class="form-control" name="hora_inicio" id="masked-input-hora_inicio"  />
                                        
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label"> Entrega </label>
                                    <div class="col-md-9"><br>Data:
                                        <input type="text" class="form-control" name="data_entrega" id="masked-input-date2" placeholder="Entrega das Chaves" /><br>Hora:
                                        <input type="text" class="form-control" name="hora_fim" id="masked-input-hora_fim"  />

                                          <input type="hidden" name="cadastrado_por" value="<?php echo $imobiliaria_idimobiliaria ?>"  />

                                    </div>
                                </div>
                                 

                              
                                
                           
                    </div>
                    <div class="modal-footer">
                      <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancelar</a>
                      <input type="submit" class="btn btn-sm btn-success" value="Confirmar Agendamento"/>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
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
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
         FormPlugins.init();
			TableManageButtons.init();
		});
	</script>

</body>

</html>
