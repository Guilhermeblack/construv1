<?php 

include "protege_professor.php";

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO2014], Wed, 21 Sep 2016 21:13:18 GMT -->
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
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
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
		<!-- begin #header -->
	<?php include "topo.php" ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<?php

           $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];
             ?>
			<!-- begin page-header -->
			<h1 class="page-header">Ver / Alterar Cliente</h1>
			<!-- end page-header -->


            <?php

      
           $idcliente  = $_GET["idcliente"];
             
                                  

                      include_once "conexao.php";
                $query_amigo = "SELECT * FROM cliente
                WHERE idcliente = $idcliente";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar Cliente");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcliente             = $buscar_amigo["idcliente"];
             $nome_cli              = $buscar_amigo["nome_cli"];
              $cpf_cli              = $buscar_amigo["cpf_cli"];
         $telefone1_cli              = $buscar_amigo["telefone1_cli"];
         $nome_cli,
$cpf_cli,    
$rg_cli,    
$estadocivil_cli,    
$nacionalidade_cli,    
$profissao_cli,    
$nascimento_cli,    
$email_cli,    
$cidade_cli,    
$endereco_cli,    
$numero_cli,    
$bairro_cli,    
$cep_cli,    
$telefone1_cli,    
$telefone2_cli,    
$nome_con,    
$cpf_con,    
$rg_con,    
$profissao_con,    
$nascionalidade_con,    
$nascimento_con,    
$data_cadastro,
             
            
             ?>



			
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-11">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Informações da Pessoa</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" action="recebe_cliente.php" method="POST">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nome / Razão Social</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nome_cli" placeholder="Nome" />

                                        <input type="hidden" name="imobiliaria_idimobiliaria" value="<?php echo $imobiliaria_idimobiliaria; ?>">
                                    </div>
                                </div>

                          		<div class="form-group">
                                    <label class="col-md-3 control-label">CPF / CNPJ</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="cpf_cli" placeholder="CPF" />
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label class="col-md-3 control-label">RG / Insc Est</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="rg_cli" placeholder="Rg" />
                                    </div>
                                </div>
                                     <div class="form-group">
                                    <label class="col-md-3 control-label">Estado Civil</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="estadocivil_cli">
                                            <option selected="selected" value="-1">Selecione</option>
		<option value="Casado(a)-Comunhão Universal (Antes lei 6.515/77)">Casado(a)-Comunhão Universal (Antes lei 6.515/77)</option>
		<option value="Casado(a)-Comunhão Universal (Apos lei 6.515/77)">Casado(a)-Comunhão Universal (Apos lei 6.515/77)</option>
		<option value="Casado(a)-Comunhão Parcial">Casado(a)-Comunhão Parcial</option>
		<option value="Casado(a)-Separação Convencional de Bens">Casado(a)-Separação Convencional de Bens</option>
		<option value="Divorciado(a)">Divorciado(a)</option>
		<option value="Separado(a) Judicialmente">Separado(a) Judicialmente</option>
		<option value="Solteiro(a)">Solteiro(a)</option>
		<option value="União Estável">União Estável</option>
		<option value="Viúvo(a)">Viúvo(a)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nacionalidade</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nacionalidade_cli" placeholder="Nacionalidade" />
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Profissão</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="profissao_cli" placeholder="Profissão" />
                                    </div>
                                </div>



                                 <div class="form-group">
									<label class="control-label col-md-3">Data de Nascimento</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="nascimento_cli" id="masked-input-date" placeholder="dd/mm/yyyy" />
									</div>
								</div>


                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="email_cli" placeholder="Email" />
                                    </div>
                                </div>




                              






                         
                        </div>
                    </div>
                    <!-- end panel -->
                </div>

                 <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Endereço</h4>
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                                    <label class="col-md-3 control-label">Cep (somente numeros)</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="cep"  name="cep_cli" placeholder="Cep" />
                                    </div>
                                </div>



                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Cidade</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="cidade"  name="cidade_cli" placeholder="Cidade" />
                                    </div>
                                </div>




                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Estado</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="estado"  name="estado_cli" placeholder="Estadp" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Rua</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="rua"   name="endereco_cli" placeholder="Rua" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">bairro</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="bairro"  name="bairro_cli" placeholder="Bairro" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Numero</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="numero"  name="numero_cli" placeholder="Numero" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Telefone 1</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="telefone1_cli" placeholder="Telefone 1" />
                                    </div>
                                </div>

								<div class="form-group">
                                    <label class="col-md-3 control-label">Telefone 2</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="telefone2_cli" placeholder="Telefone2" />
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>


                 <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Conjuge</h4>
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                                    <label class="col-md-3 control-label">Nome </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="nome_con" placeholder="Nome" />
                                    </div>
                                </div>



                                 <div class="form-group">
                                    <label class="col-md-3 control-label">CPF</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="cpf_con" placeholder="CPF" />
                                    </div>
                                </div>




                                 <div class="form-group">
                                    <label class="col-md-3 control-label">RG</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="rg_con" placeholder="RG" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Nacionalidade</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"   name="nascionalidade_con" placeholder="Rua" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Data Nascimento</label>
                                    <div class="col-md-9">
                              <input type="text" class="form-control" name="nascimento_con" id="masked-input-date2" placeholder="dd/mm/yyyy" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Profissão</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="profissao_con" placeholder="Profissão" />
                                    </div>
                                </div>

                            
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
    	
                  <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                          
                         
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                            
                                    <div class="col-md-9">
                                       <input type="submit" class="btn btn-success m-r-5 m-b-5" value="Cadastrar" />
                                    </div>
                                </div>



                               



                                

                        </div>
                    </div>
                    <!-- end panel -->

                       </form>
                </div>




            </div>
            <!-- end row -->
       
		</div>
	
     
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
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

        <script type="text/javascript" src="cep.js"></script>
	
	<script>
		$(document).ready(function() {
			App.init();
			FormPlugins.init();
		});
	</script>

</body>

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO2014], Wed, 21 Sep 2016 21:13:18 GMT -->
</html>
