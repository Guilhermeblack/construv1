<?php 
    error_reporting(0);
    ini_set(“display_errors”, 0 );
    set_time_limit(0);

    include "protege_professor.php";

    ini_set("upload_max_filesize", "10M");
    ini_set("max_execution_time", "-1");
    ini_set("memory_limit", "-1");
    ini_set("realpath_cache_size", "-1");
    if (!isset($_SESSION)) {
      session_start();
    }
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/table_manage_combine.html by HTTrack Website Copier/3.x [XR&CO2014], Sun, 04 Mar 2018 17:24:02 GMT -->
<head>
	<meta charset="utf-8" />
	<title>Immobile business</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="https://immobilebusiness.com.br/admin//assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>

    <style type="text/css">
        tbody > tr > td{
            color: #000;
            border: 1px solid #343a40!important;
            text-align: center;
        }

        thead.thead-dark > tr > th.text-center{
            vertical-align:middle!important;
            font-size: 11px !important;
            padding: 5px !important;
            font-weight: normal;
            color: #fff;
            background-color: #343a40;
            text-transform: uppercase;
        }
    </style>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
    <div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
    <!-- begin #header -->
    <?php include "topo.php";?>

    <div class="sidebar-bg"></div>
		<div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading" style="">
                    <div class="row">
                        <div class="col-md-4">
                            <h2 class="panel-title" style="font-size: 14px;">Equipes de Funcionários</h2>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="pre-scrollable">
                        <table class="table" id="table_equip">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">Nº da Equipe</th>
                                    <th class="text-center">Nome da Equipe</th>
                                    <th class="text-center">Ver Funcionarios</th>
                                    <th class="text-center">Excluir Equipe</th>
                                </tr>
                            </thead>
                            <tbody>

                            	<tr class="hidden">
                            		<td></td>
                            		<td></td>
                            		<td><a class="btn btn-info btn-sm ver_funcionario">Ver Funcionarios</a></td>
                            		<td><a class="btn btn-info btn-sm excluir_equipe">Excluir Equipe</a></td>
                            	</tr>

                                <?php
                                    include "conexao.php";

                                    $query = mysqli_query($db, "SELECT * FROM `const_equipe` WHERE `status` = 1")or die(mysqli_error($db));

                                    if(mysqli_num_rows($query) > 0){
                                    	while ($assoc = mysqli_fetch_assoc($query)) {
                                        	?>
                                        		<tr id-equipe="<?php echo $assoc['id'] ?>">
                                        			<td><?php echo $assoc['id'] ?></td>
                                        			<td><?php echo $assoc['nome'] ?></td>
                                        			<td><a class="btn btn-info btn-sm ver_funcionario">Ver Funcionarios</a></td>
                                        			<td><a class="btn btn-danger btn-sm excluir_equipe">Excluir Equipe</a></td>
                                        		</tr>
                                        	<?php
                                    	}
                                    }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel-footer">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-cad-equipe">Nova Equipe</button>
                </div>
            </div>
		</div>

		<div id="modal-cad-equipe" class="modal fade" role="dialog">
		    <div class="modal-dialog modal-lg">
		        <div class="modal-content" >
		            <div class="modal-header" id="dialog-header">
		            	<h3 class="modal-title">Cadastro de Equipe</h3>
		                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
		            </div>
		            <div class="modal-body" id="dialog-body">
		                <div class="form-group">
		                	<label for="nome_quipe" style="font-weight: bold;">Nome Da Equipe</label>
		                	<input type="text"  class="form-control" id="equipe" placeholder="Digite o nome da Equipe Aqui ...">
		                </div>

		                <div class="row" align="right" style="padding-right: 15px; padding-bottom: 15px;">
		                	<a class="btn btn-sm btn-info" style="background-color:#4CAF50!important; border: none;" data-toggle="modal" data-target="#modal-funcionario">Inserir Funcionário</a>
		                </div>

		                <table class="table" id="cad_equip">
		                	<thead class="thead-dark">
		                		<tr>
		                			<th class="text-center">Nome</th>
		                			<th class="text-center">Nascimento</th>
		                			<th class="text-center">Salário</th>
		                			<th class="text-center">Remover</th>
		                		</tr>
		                	</thead>
		                	<tbody id="cad_equip">
		                		<tr class="hidden">
		                			<td></td>
		                			<td></td>
		                			<td></td>
		                			<td><a class="btn btn-danger btn-sm excluir_provisorio_func">Excluir</a></td>
		                		</tr>
		                	</tbody>
		                </table>

		            </div>
		            <div class="modal-footer" id="dialog-footer">
		            	<button type="button" class="btn btn-success btn-sm" id="cad_equipe">Cadastrar Equipe</button>
		                <button type="button" class="btn btn-defaut btn-sm" data-dismiss="modal" >Fechar</button>
		            </div>
		        </div>
		    </div>
		</div>

		<div id="modal-funcionario" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" >
                    <div class="modal-header">
                    	<h3 class="modal-title">Funcionários</h3>
                        <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
                    </div>
                    <div class="modal-body" align="center">
                    	<table class="table" id="funcionario">
                    		<thead class="thead-dark">
                    			<tr>
                    				<th class="text-center">Nome</th>
                    				<th class="text-center">Nascimento</th>
                    				<th class="text-center">Salário</th>
                    				<th class="text-center">Adicionar</th>
                    			</tr>
                    		</thead>
                    		<tbody id="funcionario">

                    			<?php 

                    				include "conexao.php";

                    				$query = mysqli_query($db, "SELECT * FROM cliente INNER JOIN cliente_tipo AS CT ON cliente.idcliente = CT.idcliente WHERE CT.idtipo = 14")or die(mysqli_error($db));

                    				if(mysqli_num_rows($query)){
                    					while ($assoc = mysqli_fetch_assoc($query)) {
                    						?>
                    						<tr class="" id-funcionario="<?php echo $assoc['idcliente'] ?>">
                    							<td><?php echo $assoc['nome_cli']; ?></td>
                    							<td><?php echo $assoc['nascimento_cli']; ; ?></td>
                    							<td><?php echo "R$ ".number_format($assoc['salario_base'], 2,",","."); ?></td>
                    							<td><a class="btn btn-info btn-sm adiocionar_func">Adicionar</a></td>
                    						</tr>
                    						<?php
                    					}
                    				}
                    			 ?>
                    			
                    		</tbody>
                    	</table>
                    </div>
                    <div class="modal-footer" >
                        <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
                    </div>
                </div>
            </div>
        </div>


        <div id="modal-lista-funcionario" class="modal fade" role="dialog">
        	<div class="modal-dialog">
        		<!-- Modal content-->
        		<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
        			</div>
        			<div class="modal-body"  align="center">
        				<table class="table" id="lista_funcionario">
                    		<thead class="thead-dark">
                    			<tr>
                    				<th class="text-center">Nome</th>
                    				<th class="text-center">Nascimento</th>
                    				<th class="text-center">Salário</th>
                    				<th class="text-center">Cargo</th>
                    			</tr>
                    		</thead>
                    		<tbody id="lista_funcionario">

        						<tr class="hidden">
        							<td></td>
        							<td></td>
        							<td></td>
        							<td></td>
        						</tr>
                    			
                    		</tbody>
                    	</table>
        			</div>
        			<div class="modal-footer">
        			    <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
        			</div>
        		</div>
        	</div>
        </div>


        <div id="modal7" class="modal fade" role="dialog">
        	<div class="modal-dialog">
        		<!-- Modal content-->
        		<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
        			</div>
        			<div class="modal-body" id="salvar" align="center">
        				<h4 class="modal-title" align="center" id="salvar">Salvo com sucesso!</h4>
        			</div>
        			<div class="modal-footer" id="footer_salvar">
        			    <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
        			</div>
        		</div>
        	</div>
        </div>


		
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	
	<script src="js/const_equipe.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();

            function isEmpty(obj){
                return JSON.stringify(obj) === '{}';
            }

            function sleep(milliseconds) {
              var start = new Date().getTime();
              for (var i = 0; i < 1e7; i++) {
                if ((new Date().getTime() - start) > milliseconds){
                  break;
                }
              }
            }
		});

	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/table_manage_combine.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Mar 2018 17:24:03 GMT -->
</html>
