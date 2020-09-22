<?php 
    error_reporting(0);
    ini_set(“display_errors”, 1 );
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

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/table_manage_combine.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Mar 2018 17:24:02 GMT -->
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
        
        input#myInput{
            margin: 5px;
            border-radius: 3px;
            width: 80%;
        }

        tbody > tr > td{
            color: #000;
            border: 1px solid #343a40!important;
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
                        <h2 class="panel-title" style="font-size: 14px;">Empreendimentos</h2>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <input class="form-control" id="input_busca" type="text" placeholder="Pesquise Aqui.." style="margin-bottom: 10px!important;">

                <div id="table_empreendimentos" class="table-editable pre-scrollable">
                    <table class="table table-bordered table-responsive-md table-striped text-center" id="empreendimento">
                        <colgroup>
                            <col width="10%"></col>
                            <col width="40%"></col>
                            <col width="20%"></col>
                            <col width="18%"></col>
                            <col width="8%"></col>
                            <col width="4%"></col>
                        </colgroup>
                        <thead class="thead-dark" id="empreendimento">
                            <tr>
                                <th class="text-center">Nº</th>
                                <th class="text-center">Nome Empreendimento</th>
                                <th class="text-center">Responsável</th>
                                <th class="text-center">Ação</th>
                                <th class="text-center">Excluir</th>
                            </tr>
                        </thead>
                        <tbody id="empreendimento">
                            <tr class="hide">
                                <td >123</td>
                                <td >123</td>
                                <td >Nome do Insumo</td>
                                <td>
                                    <a class="btn btn-info btn-rounded btn-sm sub_empreendimento">Sub-Empreendimento</button>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-rounded btn-sm exc_empreendimento">Excluir</button>
                                </td>
                            </tr>

                            <?php 
                                include "conexao.php";

                                $query = mysqli_query($db, "SELECT cliente.nome_cli, EC.descricao_empreendimento, EC.idempreendimento_cadastro FROM empreendimento_cadastro AS EC INNER JOIN cliente ON EC.cliente_id = cliente.idcliente")or die(mysqli_error($db));

                                if(mysqli_num_rows($query) > 0){
                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr idemprendimento ="<?php echo $assoc['idempreendimento_cadastro'] ?>">
                                            <td id='idemp'><?php echo $assoc['idempreendimento_cadastro'] ?></td>
                                            <td id='nomemp'><?php echo $assoc['descricao_empreendimento']; ?></td>
                                            <td><?php echo $assoc['nome_cli']; ?></td>
                                            <td>
                                                <!-- onclick do ajax -->
                                                <a class="btn btn-info btn-rounded btn-sm sub_empreendimento">Sub-Empreendimentos</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-rounded btn-sm exc_empreendimento" data-toggle="modal" data-target="#exc_emp">Excluir</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }

                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="modal" tabindex="-1" role="dialog" id='exc_emp'>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Excluir Empreendimento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type='hidden' id='empreendimentoid'>
                                <p>Deseja mesmo excluir o empreendimento:</p>
                                <p> <b><label id='emp_nome'></label></b></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#modal-cad-sub">Novo Sub Empreendimento</a>
                        <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tipo-sub" >Tipos Sub-Empreendimento</a>
                    </div>
                </div>
            </div>
        </div>
	</div>

    <div id="modal-cad-sub" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Cadastro de Sub-Empreendimentos</h3>
                    <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titulo_sub">Titulo</label>
                        <input type="text" id="titulo_sub" class="form-control" placeholder="Digite o Titulo do Sub-Empreendimento..." >
                    </div>

                    <div class="form-group">
                        <label for="obs_sub">Observação</label>
                        <input type="text" id="obs_sub" class="form-control" placeholder="Digite Observação do Sub-Empreendimento..." >
                    </div>

                    <div class="form-group">
                        <label for="tipo_sub">Tipo Sub-Empreendimento</label>
                        <select class="form-control" id="tipo_sub">
                            <option value="-1">Selecione</option>
                            <?php 

                                include "conexao.php";

                                $query = mysqli_query($db, "SELECT * FROM `const_tipo_sub_empre`")or die(mysqli_error($db));

                                if(mysqli_num_rows($query) > 0){
                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <option value="<?php echo $assoc['id'] ?>"><?php echo $assoc['titulo']; ?></option>
                                        <?php
                                    }
                                }

                             ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mestre_obra">Mestre de Obra</label>
                        <select class="form-control" id="mestre_obra">
                            <option value="-1">Selecione</option>
                            <?php 

                                include "conexao.php";


                                //Grupo_rota 14 == mestre de Obra
                                $query = mysqli_query($db, "SELECT * FROM `cliente` WHERE `idgrupo` = 19")or die(mysqli_error($db));

                                if(mysqli_num_rows($query) > 0){
                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <option value="<?php echo $assoc['idcliente'] ?>"><?php echo $assoc['nome_cli']; ?></option>
                                        <?php
                                    }
                                }

                             ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mestre_obra">Empreendimento</label>
                        <select class="form-control" id="empreendimento">
                            <option value="-1">Selecione</option>
                            <?php 

                                include "conexao.php";

                                $query = mysqli_query($db, "SELECT `idempreendimento_cadastro`, `descricao_empreendimento` FROM `empreendimento_cadastro` WHERE 1")or die(mysqli_error($db));

                                if(mysqli_num_rows($query) > 0){
                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <option value="<?php echo $assoc['idempreendimento_cadastro'] ?>"><?php echo $assoc['descricao_empreendimento']; ?></option>
                                        <?php
                                    }
                                }

                             ?>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer" >
                    <a class="btn btn-success" id="salvar_sub_empreendimento">Salvar</a>
                    <a class="btn btn-default" data-dismiss="modal">Fechar</a>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-sub-empreendimento" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Sub-Empreendimentos</h3>
                    <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
                </div>
                <div class="modal-body" align="center">
                    <input class="form-control" id="input_busca2" type="text" placeholder="Pesquise Aqui.." style="margin-bottom: 10px!important;">
                    <table class="table table-bordered table-responsive-md text-center" id="sub_empreendimento">
                        <thead class="thead-dark" id="thead_principal_oc">
                            <tr>
                                <th class="text-center">Nº</th>
                                <th class="text-center">Descrição </th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Responsável</th>
                                <th class="text-center" style="max-width: 20%;">OBS</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody id="sub_empreendimento">
                            <tr class="hidden">
                                <td>#</td>
                                <td>Desc</td>
                                <td>Tipo</td>
                                <td>Respo</td>
                                <td style="font-size: x-small; color: #000;"></td>
                                <td><a class="btn btn-sm btn-danger excluir_sub_empreendimento">Excluir</a></td>
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


    <div id="modal-tipo-sub" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Sub-Empreendimentos</h3>
                    <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
                </div>
                <div class="modal-body" align="center">
                    <table class="table table-bordered table-responsive-md text-center" id="tipo_sub_empreendimento">
                        <thead class="thead-dark" id="tipo_sub_empreendimento">
                            <tr>
                                <th class="text-center">Nº</th>
                                <th class="text-center">Descrição </th>
                                <th class="text-center">M²</th>
                            </tr>
                        </thead>
                        <tbody id="tipo_sub_empreendimento">
                            <tr class="hidden">
                                <td>#</td>
                                <td>Desc</td>
                                <td>Tipo</td>
                            </tr>

                            <?php 
                                include "conexao.php";


                                $query = mysqli_query($db, "SELECT `id`, `titulo`, `area` FROM `const_tipo_sub_empre` ")or die(mysqli_error($db));

                                if(mysqli_num_rows($query) > 0){

                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                        ?>

                                        <tr id-tipo="<?php echo $assoc['id'] ?>">
                                            <td><?php echo $assoc['id'] ?></td>
                                            <td><?php echo $assoc['titulo'] ?></td>
                                            <td><?php echo $assoc['area'] ?></td>
                                        </tr>

                                        <?php
                                    }

                                }

                             ?>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <div class="col-md-6" align="left">
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-cad-tipo">Adicionar Tipo</a>
                        <a class="btn btn-default btn-sm" data-dismiss="modal" >Fechar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-cad-tipo" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-titel">Cadastro Tipo Sub-Empreendimento</h3>
                    <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="nome_tipo">Titulo</label>
                        <input type="text" id="nome_tipo" class="form-control" placeholder="Digite o Titulo do tipo aqui...">
                    </div>

                    <div class="form-group">
                        <label for="area_tipo">Área (M²)</label>
                        <input type="text" id="area_tipo" class="form-control" placeholder="Digite a área aqui...">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="salvar_tipo">Salvar</button>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Fechar</button>
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
	
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
    <script src="js/const_sub_empreendimento.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});

	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/table_manage_combine.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Mar 2018 17:24:03 GMT -->
</html>
