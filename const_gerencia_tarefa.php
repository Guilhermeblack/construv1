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


    function busca_nome_usuario($id){
        include 'conexao.php';

        $query = mysqli_query($db, "SELECT `nome_cli` FROM `cliente` WHERE `idcliente` = $id");

        if(mysqli_num_rows($query) > 0){
            $assoc = mysqli_fetch_assoc($query);

            return addslashes($assoc['nome_cli']);
        }else{
            return false;
        }
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

        /* CSS para estilo da nav bar nas modals da pagina*/
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
            color: #428bca!important;
            cursor: default!important;
            background-color: #fff!important;
            border: 1px solid #ddd!important;
            border-bottom-color: transparent!important;
        }

        .nav-tabs>li>a {
            margin-right: 2px!important;
            line-height: 1.42857143!important;
            border: 1px solid #ddd!important;
            border-radius: 4px 4px 0 0!important;
        }

        .nav-tabs{
            background-color: #FFF!important;
        }

        .nav>li>a {
            position: relative!important;
            display: block!important;
            padding: 10px 15px!important;
        }

        
        input#myInput{
            margin: 5px;
            border-radius: 3px;
            width: 80%;
        }

        tbody > tr > td{
            color: #000;
            border: 1px solid #343a40!important;
            text-align: center;
        }

        thead.thead-dark > tr > th{
            vertical-align:middle!important;
            font-size: 11px !important;
            padding: 5px !important;
            font-weight: normal;
            color: #fff;
            background-color: #343a40;
            text-transform: uppercase;
            text-align: center;
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

            <!-- <h3 class="page-header">Orçamento Geral</h3> -->

            <div class="panel panel-inverse">
                <div class="panel-heading" style="">
                    <div class="row" align="center">
                        <h2 class="panel-title" style="font-size: 14px;">GERENCIAMENTO DE TAREFAS</h2>
                    </div>
                </div>

                <div class="panel-body">

                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs " role="tablist">
                            <li role="presentation" class="active"><a href="#em_andamento" aria-controls="em_andamento" role="tab" data-toggle="tab" style="font-weight: bold;">Tarefas em Andamento</a></li>

                            <li role="presentation" ><a href="#concluido" aria-controls="concluido" role="tab" data-toggle="tab" style="font-weight: bold;">Tarefas Concluidas</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="em_andamento">
                                <div class="row" style="margin-bottom: 10px!important;">
                                    <div class="col-md-6" id="empre">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for='empre' style="color: #000; font-weight:500; font-size: x-small; text-transform: uppercase; ">Selecione o Empreendimento</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control" id="empre">
                                                    <option value="-1" editable="0">Selecione</option>
                                                    <?php 
                                                        include "conexa.php";

                                                        $query = mysqli_query($db, "SELECT * FROM `empreendimento_cadastro`")or die(mysqli_error($db));

                                                        if(mysqli_num_rows($query)){
                                                            while ($assoc = mysqli_fetch_assoc($query)) {
                                                                ?>
                                                                    <option value="<?php echo $assoc['idempreendimento_cadastro'] ?>"><?php echo $assoc['descricao_empreendimento'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="titulo_orc">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for='orcamento' style="color: #000; font-weight:500; font-size: x-small; text-transform: uppercase; ">Selecione o Sub-Empreendimento</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control" id="orcamento">
                                                    <option value="-1" editable="0">Selecione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" >
                                    <input class="form-control" id="input_tarefas_fazer" type="text" placeholder="Pesquise Aqui ...">
                                </div>
                                
                                <div id="table" class="table-editable pre-scrollable">
                                    <table id="data-table" class="table table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="5%" class="text-center">Código</th>
                                                <th width="15%" class="text-center">Tarefa</th>
                                                <th width="15%" class="text-center">Sub-Empreendimento</th>
                                                <th width="10%" class="text-center">Data Inicio</th>
                                                <th width="10%" class="text-center">Valor da Tarefa</th>
                                                <th width="10%" class="text-center">Medida</th>
                                                <th width="10%" class="text-center">Equipe</th>
                                                <!-- <th width="10%" class="text-center">Total Fazer</th>
                                                <th width="10%" class="text-center">Valor Total</th> -->
                                                <th width="10%" class="text-center">Acao</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            <tr class="hidden">
                                                <td>123</td>
                                                <td>DESCRIÇÃO AQUI</td>
                                                <td>123</td>
                                                <td>DESCRIÇÃO AQUI</td>
                                                <td>123</td>
                                                <td>DESCRIÇÃO AQUI</td>
                                                <td>DESCRIÇÃO AQUI</td> 
                                                <td>DESCRIÇÃO AQUI</td>
                                                <td>
                                                    <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remover</button></span>
                                                </td>
                                            </tr>

                                            <?php
                                            include "conexao.php";

                                            $query = mysqli_query($db, "SELECT CTS.id, CTS.data_inicio, CTS.valor_total, CTS.data_fim, CTS.valor_tarefa, CTS.total_a_fazer, CTS.unidade_medida, CSE.titulo AS nome_sub, CE.nome, CE.id AS id_equipe, CT.titulo FROM `const_tarefa_sub_empre` AS CTS INNER JOIN const_sub_empreendimento AS CSE ON CTS.id_sub_empre = CSE.id INNER JOIN const_equipe AS CE ON CTS.id_equipe = CE.id INNER JOIN const_tarefas AS CT ON CTS.id_tarefa = CT.id WHERE CTS.status = 1 ORDER BY CTS.id")or die(mysqli_error($db));

                                            if(mysqli_num_rows($query) > 0){
                                                while ($exeQuery = mysqli_fetch_assoc($query)) {

                                                    $funcionarios = '#### FUNCIONARIOS DA EQUIPE ####&#013;';

                                                    $query_aux = mysqli_query($db, "SELECT nome_cli FROM cliente INNER JOIN const_funcionario_equipe AS CFE ON cliente.idcliente = CFE.id_funcionario INNER JOIN const_equipe AS CE ON CFE.id_equipe = CE.id WHERE CE.id = ".$exeQuery['id_equipe']." ")or die(mysqli_error($db));

                                                    if(mysqli_num_rows($query_aux) > 0){

                                                        while ($assoc = mysqli_fetch_assoc($query_aux)) {
                                                            $funcionarios .= $assoc['nome_cli'].'&#013;';
                                                        }
                                                    }
                                                    ?>
                                                        <tr class="" id-tarefa="<?php echo $exeQuery['id'] ?>">
                                                            <td><?php echo $exeQuery['id'] ?></td>
                                                            <td><?php echo $exeQuery['titulo'] ?></td>
                                                            <td><?php echo $exeQuery['nome_sub'] ?></td>
                                                            <td><?php echo $exeQuery['data_inicio'] ?></td>
                                                            <td>R$ <?php echo $exeQuery['valor_tarefa'] ?></td>
                                                            <td><?php echo $exeQuery['unidade_medida'] ?></td>
                                                            <td title="<?php echo $funcionarios; ?>"><?php echo $exeQuery['nome']?></td>
                                                            <!-- <td><?php $exeQuery['total_a_fazer'] ?></td> -->
                                                            <!-- <td><?php $exeQuery['valor_total'] ?></td> -->
                                                             
                                                            
                                                            <td>
                                                                <a class="btn btn-info btn-sm" id="medicao">Medição</a>
                                                            </td>
                                                        </tr>
                                                   <?php
                                                }
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row" style="margin-top: 3%;">
                                    <div class="col-md-12">
                                        <button class="table-add  btn btn-success" data-toggle="modal" data-target="#modal-cad-tarefa" style="text-align: left;">Novo Tarefa</button>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="concluido">
                                <div class="row" style="margin-bottom: 10px!important;">
                                    <div class="col-md-6" id="empre">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for='empre' style="color: #000; font-weight:500; font-size: x-small; text-transform: uppercase; ">Selecione o Empreendimento</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control" id="empre">
                                                    <option value="-1" editable="0">Selecione</option>
                                                    <?php 
                                                        include "conexao.php";

                                                        $query = mysqli_query($db, "SELECT * FROM `empreendimento_cadastro`")or die(mysqli_error($db));

                                                        if(mysqli_num_rows($query)){
                                                            while ($assoc = mysqli_fetch_assoc($query)) {
                                                                ?>
                                                                    <option value="<?php echo $assoc['idempreendimento_cadastro'] ?>"><?php echo $assoc['descricao_empreendimento'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="titulo_orc">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for='orcamento' style="color: #000; font-weight:500; font-size: x-small; text-transform: uppercase; ">Selecione o Sub-Empreendimento</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control" id="orcamento">
                                                    <option value="-1" editable="0">Selecione</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" >
                                    <input class="form-control" id="input_tarefas_fazer" type="text" placeholder="Pesquise Aqui ...">
                                </div>
                                
                                <div id="table" class="table-editable pre-scrollable">
                                    <table id="data-table" class="table table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="5%" class="text-center">Código</th>
                                                <th width="15%" class="text-center">Tarefa</th>
                                                <th width="15%" class="text-center">Sub-Empreendimento</th>
                                                <th width="10%" class="text-center">Data Inicio</th>
                                                <th width="10%" class="text-center">Valor da Tarefa</th>
                                                <th width="10%" class="text-center">Medida</th>
                                                <th width="10%" class="text-center">Equipe</th>
                                                <!-- <th width="10%" class="text-center">Total Fazer</th>
                                                <th width="10%" class="text-center">Valor Total</th> -->
                                                <th width="10%" class="text-center">Acao</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            <tr class="hidden">
                                                <td>123</td>
                                                <td>DESCRIÇÃO AQUI</td>
                                                <td>123</td>
                                                <td>DESCRIÇÃO AQUI</td>
                                                <td>123</td>
                                                <td>DESCRIÇÃO AQUI</td>
                                                <td>DESCRIÇÃO AQUI</td> 
                                                <td>DESCRIÇÃO AQUI</td> 
                                                <td>
                                                    <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remover</button></span>
                                                </td>
                                            </tr>

                                            <?php
                                            include "conexao.php";

                                            $query = mysqli_query($db, "SELECT CTS.id, CTS.data_inicio, CTS.data_fim, CTS.valor_tarefa, CTS.total_a_fazer, CTS.unidade_medida, CSE.titulo AS nome_sub, CE.nome, CE.id AS id_equipe, CT.titulo FROM `const_tarefa_sub_empre` AS CTS INNER JOIN const_sub_empreendimento AS CSE ON CTS.id_sub_empre = CSE.id INNER JOIN const_equipe AS CE ON CTS.id_equipe = CE.id INNER JOIN const_tarefas AS CT ON CTS.id_tarefa = CT.id WHERE CTS.status = 0 ORDER BY CTS.id")or die(mysqli_error($db));

                                            if(mysqli_num_rows($query) > 0){
                                                while ($exeQuery = mysqli_fetch_assoc($query)) {

                                                    $funcionarios = '#### FUNCIONARIOS DA EQUIPE ####&#013;';

                                                    // $exeQuery['titulo'] = utf8_encode(strval($exeQuery['titulo']));
                                                    $query_aux = mysqli_query($db, "SELECT nome_cli FROM cliente INNER JOIN const_funcionario_equipe AS CFE ON cliente.idcliente = CFE.id_funcionario INNER JOIN const_equipe AS CE ON CFE.id_equipe = CE.id WHERE CE.id = ".$exeQuery['id_equipe']." ")or die(mysqli_error($db));

                                                    if(mysqli_num_rows($query_aux) > 0){

                                                        while ($assoc = mysqli_fetch_assoc($query_aux)) {
                                                            $funcionarios .= $assoc['nome_cli'].'&#013;';
                                                        }
                                                    }
                                                    ?>
                                                        <tr class="" id-tarefa="<?php echo $exeQuery['id'] ?>" finalizado='1'>
                                                        <td><?php echo $exeQuery['id'] ?></td>
                                                            <td><?php echo $exeQuery['titulo'] ?></td>
                                                            <td><?php echo $exeQuery['nome_sub'] ?></td>
                                                            <td><?php echo $exeQuery['data_inicio'] ?></td>
                                                            <td>R$ <?php echo $exeQuery['valor_tarefa'] ?></td>
                                                            <!-- <td></td> -->
                                                            <td><?php echo $exeQuery['unidade_medida'] ?></td> 
                                                             
                                                            <td title="<?php echo $funcionarios; ?>"><?php echo $exeQuery['nome']?></td>
                                                            <td>
                                                                <a class="btn btn-info btn-sm" id="medicao">Medição</a>
                                                            </td>
                                                        </tr>
                                                   <?php
                                                }
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
                <div class="panel-footer">
                    
                </div>
            </div>
		</div>
    </div>


    <!-- MODAL PARA FAZER O RECARREGAMENTO DA PÁGINA MOSTRANDO ASSIM TODAS AS TAREFAS ABERTAS -->
    <div id="modal-dialog" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header" id="dialog-header">
                    <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
                </div>
                <div class="modal-body" id="dialog-body" align="center">
                    <h4 class="modal-title" align="center" id="salvar">Salvo com sucesso!</h4>
                </div>
                <div class="modal-footer" id="dialog-footer">
                    <button type="button" class="btn btn-defaut" data-dismiss="modal" onClick="window.location.reload();" >Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ######  MODAL PARA CADASTRO DE TAREFAS - SUB_EMPREENDIMENTO ######### -->
    <div id="modal-cad-tarefa"  class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="font-size: 16px; font-weight: bold; text-transform: uppercase;">Cadastrar Tarefa</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" id="cad_tarefa_sub_empre">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Selecione a Tarefa</label>
                                    <select class="form-control" id="select_tarefa" name="select_tarefa">
                                        <option value="-1">Selecione</option>
                                        <?php 

                                            include "conexao.php";

                                            $query = mysqli_query($db, "SELECT * FROM `const_tarefas` ")or die(mysqli_error($db));


                                            if(mysqli_num_rows($query)){
                                                while ($assoc = mysqli_fetch_assoc($query)) {
                                                    ?>

                                                    <option value="<?php echo $assoc['id'] ?>"><?php echo $assoc['titulo']; ?></option>

                                                    <?php
                                                }
                                            }
                                         ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="select_equipe">
                                    <label style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Selecione a equipe</label>
                                    <select class="form-control" name="select_equipe" id="select_equipe">
                                        <option value="-1">Selecione</option>
                                        <?php 

                                            include "conexao.php";

                                            $query = mysqli_query($db, "SELECT * FROM `const_equipe` WHERE `status` = 1")or die(mysqli_error($db));


                                            if(mysqli_num_rows($query)){
                                                while ($assoc = mysqli_fetch_assoc($query)) {

                                                    $texto = '';


                                                    $query_aux = mysqli_query($db, "SELECT * FROM cliente INNER JOIN const_funcionario_equipe AS CFE ON cliente.idcliente = CFE.id_funcionario INNER JOIN const_equipe AS CE ON CFE.id_equipe = CE.id WHERE CE.id = ".$assoc['id']." ")or die(mysqli_error($db));

                                                    if(mysqli_num_rows($query_aux)){
                                                        $texto .= '#### FUNCIONARIOS DA EQUIPE ####&#013;';

                                                        while($assoc_aux = mysqli_fetch_assoc($query_aux)){
                                                            $texto .= $assoc_aux['nome_cli'].'&#013;';
                                                        }
                                                    }


                                                    ?>

                                                    <option value="<?php echo $assoc['id'] ?>" title = "<?php echo $texto; ?>" ><?php echo $assoc['nome']; ?></option>

                                                    <?php
                                                }
                                            }
                                         ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                       <div class="row">
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Selecione o Sub-Empreendimento</label>
                                    <select class="form-control" id="select_sub_empre" name="select_sub_empre">
                                        <option value="-1">Selecione</option>
                                        <?php 

                                            include "conexao.php";

                                            $query = mysqli_query($db, "SELECT CSE.id, CSE.titulo FROM const_sub_empreendimento AS CSE INNER JOIN const_orcamento AS CO ON CSE.id = CO.id_empreendimento WHERE CO.status_editar = 1")or die(mysqli_error($db));

                                            if(mysqli_num_rows($query)){
                                                while ($assoc = mysqli_fetch_assoc($query)) {
                                                    ?>

                                                    <option value="<?php echo $assoc['id'] ?>"><?php echo $assoc['titulo']; ?></option>

                                                    <?php
                                                }
                                            }
                                         ?>
                                    </select>
                                </div>
                           </div>

                           <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Valor Unitário da Tarefa</label>
                                    <input type="text" name="valor_tarefa" id="valor_tarefa" class="form-control" value="R$ 0,00" >
                                </div>
                           </div>
                               
                       </div>

            
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Selecione a data de inicio da Tarefa</label>
                                   <input type="date" id="input_data_inicio" class="form-control" name="input_data_inicio" placeholder="Data de Inicio Aqui" required="">
                               </div>
                           </div>

                           <div class="col-md-6">
	                       		<div class="form-group">
	                       			<label style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Unidade de medida</label>
	                       			<input type="text" id="unidade" class="form-control" name="unidade" placeholder="Unidade Medida" required="">
	                       		</div>
	                       	</div>
                       </div>

                       <div class="row">

                                            <!-- //IMPLEMENTAR ESSA PARTE -->

	                       	<!-- <div class="col-md-6">
	                       		<div class="form-group">
	                       			<label style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Quantidade a ser Feita</label>
	                       			<input type="number" id="qnt_fazer" class="form-control" name="qnt_fazer" placeholder="Quantidade Total a fazer (Opcional)">
	                       		</div>
	                       	</div>

	                       	<div class="col-md-6">
	                       		<div class="form-group">
	                       			<label style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Valor Máximo</label>
	                       			<input type="text" id="unidade" class="form-control" name="valor_total" placeholder="Valor total  (Opcional)">
	                       		</div>
	                       	</div> -->
                       </div>

                        <div class="modal-footer" style="text-align: right;">
                            <a type="submit"  class="btn btn-success" id="salvar_tarefa" >Salvar</a>
                            <button type="reset" value="reset" class="hide" id="reset" ></button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>

    <!--- MODAL PARA LISTAR AS MEDIÇÕES JA FEITAS DESSA TAREFA  --->
    <div id="medicao_tarefa" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 style="text-align: center;">Medição de Tarefas / Serviços</h4>
                </div>
                <div class="modal-body pre-scrollable">
                    <h5>TOTAL MEDIDO: <span id="total"></span></h5>
                    <table id="table_lista_medicao" class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Número</th>
                                <th>Usuário</th>
                                <th>Data Medição</th>
                                <th>Qnt Medida</th>
                                <th>Valor da Medição</th>
                                <th>Valor Total </th>
                                <th>Fotos</th>
                            </tr>
                        </thead>
                        <tbody id="lista_medicao">
                            <tr class="hidden">
                                <td>Número</td>
                                <td>Usuário</td>
                                <td>Data Medição</td>
                                <td>Qnt Medição</td>
                                <td>Valor da Medição</td>
                                <td>Valor medições</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" id="exibe_foto">Fotos</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger btn-sm" id="finaliza_tarefa">Finalizar Tarefa</a>
                    <a class="btn btn-success btn-sm" id="fazer_medicao">Fazer Nova Medição</a>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA FAZER UMA NOVA MEDICAO DE TAREFA -->
    <div id="modal-medicao" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-body">

                    <div class="form-group">
                        <label style="font-size: 14px; text-transform: uppercase; font-weight: bold;" >Digite a Quantidade Feita</label>
                        <input type="number" class="form-control" id="qnt_medida" name="qnt_medida" required>
                    </div>
                    <form class="up_img" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Selecione a Imagem</label>
                            <input type="file" name="image" id="up_imagem_recibo" accept="image/jpeg">
                            <input type="text" name="id_recebimento" class="hidden" id="id_recebimento">
                            <span> Apenas Imagens ".jpg"</span>
                        </div>
                    </form>
                   
                </div>
                <div class="modal-footer" >
                    <a class="btn btn-sm btn-success" id="salva_medicao">Salvar</a>
                    <a class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA MOSTRAR FOTOS DE UMA MEDICAO DE TAREFA -->
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
	

    <script type="text/javascript">
        var id_user_master = <?php echo $imobiliaria_idimobiliaria;  ?>
    </script>
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
    <script src="js/const_modifica.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();

            var aux = ($(window).height() - 200);
            $("div#table").css('max-height', aux);

            //Defino o tamanho da tabela de acordo com o tamanho da tela do usuario
            //var aux = ($(window).height() - 300);
            //$("div.pre-scrollable").css('height', aux);

			//TableManageCombine.init();
            //$('#data-table').dataTable();
            $("input#input_tarefas_fazer").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
            });

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

</html>
