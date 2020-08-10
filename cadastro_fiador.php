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

           $idcliente = $_GET["idcliente"];
             ?>
			<!-- begin page-header -->
			<h1 class="page-header">Cadastro de Fiador</h1>
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
                            <form class="form-horizontal form-bordered" action="recebe_fiador.php" method="POST">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nome / Razão Social</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nome_cli" placeholder="Nome" />

                                        <input type="hidden" name="cliente_id" value="<?php echo $idcliente; ?>">
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
                                        <input type="text" class="form-control"   name="nascionalidade_con" placeholder="Nascionalidade" />
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
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Dados do Imovel</h4>
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                                    <label class="col-md-3 control-label">Nº Matricula </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="imovel_matricula" placeholder="Nº Matricula " />
                                    </div>
                                </div>



                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Endereço do imóvel</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="endereco_imovel" placeholder="Endereço do imóvel" />
                                    </div>
                                </div>




                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Terreno m²</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="terreno_imovel" placeholder="Terreno m²" />
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Construção M² </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"   name="construcao_imovel" placeholder="Construção M²" />
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
                            <h4 class="panel-title">Fiadores Cadastrados</h4>
                        </div>
                      
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                   <th>Código</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Telefone</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>

<?php

            
          
                                  

                      include_once "conexao.php";


                $query_amigo = "SELECT * FROM fiador WHERE cliente_id = $idcliente";
                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $idfiador              = $buscar_amigo['idcliente'];
            $nome_cli              = $buscar_amigo["nome_cli"];
            $cpf_cli               = $buscar_amigo["cpf_cli"];
            $telefone1_cli         = $buscar_amigo["telefone1_cli"];
             
            
             ?>


                                    <tr class="odd gradeX">
                                       <td><?php echo $idcliente ?></td>
                                        <td><?php echo $nome_cli ?></td>
                                        <td><?php echo $cpf_cli ?></td>
                                        <td><?php echo $telefone1_cli ?></td>
                                       <td>
                
                                    
 <a href="alterar_fiador.php?idcliente=<?php echo $idcliente ?>&idfiador=<?php echo $idfiador ?>">  <span class="label label-success">Ver / Alterar</span></a>

                                     

                                            </td>
                                    </tr>
                                     <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>



            </div>
            <!-- end row -->
       
		</div>
	
     
		
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
 <script type='text/javascript' src='cep.js'></script>
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
