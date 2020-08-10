<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:13:18 GMT -->
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
		<!-- begin #header -->
	<?php include "topo.php" ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<?php

           $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];
             ?>
			<!-- begin page-header -->
			<h1 class="page-header">Cadastro de Locador</h1>
			<!-- end page-header -->
			
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
                            <form class="form-horizontal form-bordered" action="recebe_locador.php" method="POST">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nome / Razão Social</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nome_loc" placeholder="Nome" />

                                        <input type="hidden" name="imobiliaria_idimobiliaria" value="<?php echo $imobiliaria_idimobiliaria; ?>">
                                    </div>
                                </div>

                          		<div class="form-group">
                                    <label class="col-md-3 control-label">CPF / CNPJ</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="cpf_loc" placeholder="CPF" />
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label class="col-md-3 control-label">RG / Insc Est</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="rg_loc" placeholder="Rg" />
                                    </div>
                                </div>
                                     <div class="form-group">
                                    <label class="col-md-3 control-label">Estado Civil</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="estadocivil_loc">
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
                                        <input type="text" class="form-control" name="nacionalidade_loc" placeholder="Nacionalidade" />
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Profissão</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="profissao_loc" placeholder="Profissão" />
                                    </div>
                                </div>



                                 <div class="form-group">
									<label class="control-label col-md-3">Data de Nascimento</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="nascimento_loc" id="masked-input-date" placeholder="dd/mm/yyyy" />
									</div>
								</div>


                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="email_loc" placeholder="Email" />
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
                                        <input type="text" class="form-control" id="cep"  name="cep_loc" placeholder="Cep" />
                                    </div>
                                </div>



                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Cidade</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="cidade"  name="cidade_loc" placeholder="Cidade" />
                                    </div>
                                </div>




                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Estado</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="estado"  name="estado_loc" placeholder="Estadp" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Rua</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="rua"   name="endereco_loc" placeholder="Rua" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">bairro</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="bairro"  name="bairro_loc" placeholder="Bairro" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Numero</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="numero"  name="numero_loc" placeholder="Numero" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Telefone 1</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="telefone1_loc" placeholder="Telefone 1" />
                                    </div>
                                </div>

								<div class="form-group">
                                    <label class="col-md-3 control-label">Telefone 2</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="telefone2_loc" placeholder="Telefone2" />
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
                                        <input type="text" class="form-control"  name="nome_con_loc" placeholder="Nome" />
                                    </div>
                                </div>



                                 <div class="form-group">
                                    <label class="col-md-3 control-label">CPF</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="cpf_con_loc" placeholder="CPF" />
                                    </div>
                                </div>




                                 <div class="form-group">
                                    <label class="col-md-3 control-label">RG</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="rg_con_loc" placeholder="RG" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Nacionalidade</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"   name="nascionalidade_con_loc" placeholder="Nascionalidade" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Data Nascimento</label>
                                    <div class="col-md-9">
                              <input type="text" class="form-control" name="nascimento_con_loc" id="masked-input-date2" placeholder="dd/mm/yyyy" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Profissão</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="profissao_con_loc" placeholder="Profissão" />
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

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:13:18 GMT -->
</html>
