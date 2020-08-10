<?php 
    error_reporting(0);
    ini_set(“display_errors”, 0 );
    set_time_limit(0);

    include "protege_professor.php";


    if(!empty($_POST)){

        include 'conexao.php';

        $date = date('d-m-Y');

        $query = mysqli_query($db, "insert into `const_presenca`(`id_func`, `id_tipo`, `id_user`, `data`, `staus`, `hora_entrada`, `hora_saida`, `id_empreendimento`) values (".$_POST['id_user'].",".$_POST['periodo'].",".$_POST['id_user_log'].",'$date','".$_POST['status']."','".$_POST['entrada']."', '".$_POST['saida']."', ".$_POST['id_empre'].")")or die(mysqli_error($db));
    }

    //Gravar Aqui no banco 

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

            <h2 class="page-title">Diario de Obra</h2>
                            
            <div class="panel panel-inverse">
                <div class="panel-heading" style="">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Filtro de dados</h4>
                </div>

                <div class="panel-body">
                    <?php 

                        include "conexao.php";
                        $query_periodo = mysqli_query($db, "SELECT * FROM `const_tipo_presenca`")or die(mysqli_error($db));
                        if(mysqli_num_rows($query_periodo)){
                            $dado_periodo = [];

                            while ($assoc = mysqli_fetch_assoc($query_periodo)) {
                                $dado_periodo[] = $assoc;
                            }
                        }
                     ?>

                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs " role="tablist">
                            <li role="presentation"><a href="#lista_presenca" aria-controls="lista_presenca" role="tab" data-toggle="tab" style="font-weight: bold;">Lista de Presença</a></li>

                            <li role="presentation" class="active"><a href="#historico" aria-controls="historico" role="tab" data-toggle="tab" style="font-weight: bold;">Histórico de Presença</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="historico">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Selecione a Data</label>
                                        <input type="date" class="form-control" id="data_historico">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Selecione o Empreendimento</label>
                                        <select class="form-control" id="empresa_historico">
                                            <option value="-1">Selecione</option>
                                            <?php 

                                                $query = mysqli_query($db, "SELECT `idempreendimento_cadastro` AS id, `descricao_empreendimento` AS descricao FROM `empreendimento_cadastro` ")or die(mysqli_num_rows($db));
                                                if(mysqli_num_rows($query)){
                                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                                       ?>  
                                                      <option value="<?php echo($assoc['id']); ?>"><?php echo utf8_encode($assoc['descricao']); ?></option>
                                                      <?php
                                                    }
                                                }
                                                   
                                             ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="form-group" align="center">
                                    <input class="form-control" id="historico" type="text" placeholder="Pesquise Aqui ..." >
                                </div> -->
                                <div class="pre-scrollable">
                                    <table class="table table-bordered table-responsive-md table-striped text-center" id="historico">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center">CODIGO</th>
                                                <th class="text-center">NOME FUNCIONARIO</th>
                                                <th class="text-center">EMPREENDIMENTO</th>
                                                <th class="text-center">DATA</th>
                                                <th class="text-center">PERIODO</th>
                                                <th class="text-center">ENTRADA</th>
                                                <th class="text-center">SAIDA</th>
                                                <th class="text-center">STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody id="historico">

                                            <?php 
                                                include 'conexao.php';

                                                $query = mysqli_query($db, "SELECT CP.id, CP.data, CP.staus, CP.hora_entrada, CP.hora_saida, cliente.nome_cli, EC.descricao_empreendimento, EC.idempreendimento_cadastro, CTP.descricao FROM const_presenca AS CP INNER JOIN cliente ON CP.id_func = cliente.idcliente INNER JOIN const_tipo_presenca AS CTP ON CP.id_tipo = CTP.id INNER JOIN empreendimento_cadastro AS EC ON CP.id_empreendimento = EC.idempreendimento_cadastro ")or die(mysqli_error($db));

                                                if(mysqli_num_rows($query)){
                                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                                        ?>
                                                        <tr data="<?php echo $assoc['data']; ?>" empresa='<?php echo($assoc['idempreendimento_cadastro']); ?>'>
                                                            <td class="text-center"><?php echo $assoc['id']; ?></td>
                                                            <td class="text-center"><?php echo utf8_encode($assoc['nome_cli']); ?></td>
                                                            <td class="text-center"><?php echo utf8_encode($assoc['descricao_empreendimento']); ?></td>
                                                            <td class="text-center"><?php echo date('d-m-Y', strtotime($assoc['data'])); ?></td>
                                                            <td class="text-center"><?php echo utf8_encode($assoc['descricao']); ?></td>
                                                            <td class="text-center"><?php echo $assoc['hora_entrada']; ?></td>
                                                            <td class="text-center"><?php echo $assoc['hora_saida']; ?></td>
                                                            <td class="text-center" style="font-weight: bold; font-size: 14px; color: <?php if($assoc['staus']){echo "#33b5e5";}else{ echo "#cc0000";} ?> "><?php if($assoc['staus']){echo "Presente";}else{ echo "Ausente";} ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }

                                             ?>

                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="lista_presenca" >

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Selecione o Periodo</label>
                                        <select class="form-control" id="periodo">
                                            <option value="-1">Selecione</option>
                                            <?php 
                                                foreach ($dado_periodo as $value) {
                                                    ?>  
                                                    <option value="<?php echo($value['id']); ?>"><?php echo utf8_encode($value['descricao']); ?></option>
                                                    <?php
                                                }
                                             ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Selecione o Empreendimento</label>
                                        <select class="form-control" id="empresa">
                                            <option value="-1">Selecione</option>
                                            <?php 

                                                $query = mysqli_query($db, "SELECT `idempreendimento_cadastro` AS id, `descricao_empreendimento` AS descricao FROM `empreendimento_cadastro` ")or die(mysqli_num_rows($db));
                                                if(mysqli_num_rows($query)){
                                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                                       ?>  
                                                      <option value="<?php echo($assoc['id']); ?>"><?php echo utf8_encode($assoc['descricao']); ?></option>
                                                      <?php
                                                    }
                                                }
                                                   
                                             ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="form-group" align="center">
                                    <input class="form-control" id="lista_presenca" type="text" placeholder="Pesquise Aqui ..." >
                                </div> -->
                                <div class="pre-scrollable">
                                    <table class="table table-bordered table-responsive-md table-striped text-center" id="lista_presenca">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center">NOME FUNCIOINARIO</th>
                                                <th class="text-center">EMPREENDIMENTO</th>
                                                <th class="text-center">ENTRADA</th>
                                                <th class="text-center">SAIDA</th>
                                                <th class="text-center">STATUS</th>
                                                <th class="text-center">AÇÂO</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lista_presenca">
                                            <?php 
                                                //CONTINUAR DAQUI A FAZER A TABELA MASTER
                                                $today = date('Y-m-d');

                                                $query = mysqli_query($db, "SELECT EC.idempreendimento_cadastro, cliente.idcliente, cliente.nome_cli, EC.descricao_empreendimento FROM const_tarefa_sub_empre AS CTSE INNER JOIN const_equipe AS CE ON CTSE.id_equipe = CE.id INNER JOIN const_funcionario_equipe AS CFE ON CE.id = CFE.id_equipe INNER JOIN cliente ON CFE.id_funcionario = cliente.idcliente INNER JOIN const_sub_empreendimento AS CSE ON CTSE.id_sub_empre = CSE.id INNER JOIN const_tarefas AS CT ON CTSE.id_tarefa = CT.id INNER JOIN empreendimento_cadastro AS EC ON CSE.id_empreendimento = EC.idempreendimento_cadastro WHERE CTSE.status = 1 GROUP BY cliente.idcliente, EC.descricao_empreendimento")or die(mysqli_error($db));

                                                if(mysqli_num_rows($query)){
                                                    while ($assoc = mysqli_fetch_assoc($query)) {

                                                        $query_aux = mysqli_query($db, "SELECT CTP.id, CTP.descricao, CP.id AS presenca FROM const_tipo_presenca AS CTP LEFT JOIN (SELECT * FROM const_presenca WHERE const_presenca.data = '$today' AND const_presenca.id_func = ".$assoc['idcliente'].") AS CP ON (CTP.id = CP.id_tipo) WHERE CP.id IS NULL")or die(mysqli_error($db));


                                                        if(mysqli_num_rows($query_aux)){
                                                            while ($assoc_aux = mysqli_fetch_assoc($query_aux)) {
                                                                ?>
                                                                <form action="const_diario_obra.php" method="POST" class="table">
                                                                    <div class="form-group">
                                                                        <tr periodo='<?php echo($assoc_aux['id']) ?>' empreendimento="<?php echo($assoc['idempreendimento_cadastro']) ?>" class='hidden'>
                                                                            <td class="hidden">
                                                                                <input  name="id_user" class="" value="<?php echo($assoc['idcliente']) ?>">
                                                                                <input  name="periodo" class="" value="<?php echo($assoc_aux['id']) ?>">
                                                                                <input  name="id_empre" class="" value="<?php echo($assoc['idempreendimento_cadastro']) ?>">
                                                                                <input  name="id_user_log" class="" value="<?php echo($imobiliaria_idimobiliaria) ?>">
                                                                            </td>
                                                                            <td><?php echo $assoc['nome_cli']; ?></td>

                                                                            <td><?php echo $assoc['descricao_empreendimento']; ?></td>

                                                                            <td>
                                                                                <input type="time" class="form-control" id="entrada" name="entrada" min="00:00" max="22:00" required>
                                                                            </td>

                                                                             <td>
                                                                                <input type="time" class="form-control" id="saida" name="saida" min="00:00" max="22:00" required>
                                                                            </td>

                                                                            <td>
                                                                                <select class="form-control" required name="status">
                                                                                    <option value="1">Presente</option>
                                                                                    <option value="0">Ausente</option>
                                                                                </select>
                                                                            </td>

                                                                            <td>
                                                                                <button class="btn btn-success btn-sm" type="submit">Salvar</button>
                                                                            </td>
                                                                        </tr>
                                                                    </div>
                                                                </form>
                                                                                                                            
                                                                <?php
                                                            }
                                                        }
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
                    <div class="row">
                        <div class="col-md-12">
                            <button class="table-add  btn btn-success" style="text-align: left;">Nova Etapa</button>
                        </div>
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
	
    <script type="text/javascript" src="https://raw.githubusercontent.com/RobinHerbots/jquery.inputmask/2.x/js/jquery.inputmask.js"></script>
    <script type="text/javascript" src="https://raw.githubusercontent.com/RobinHerbots/jquery.inputmask/2.x/js/jquery.inputmask.extensions.js" ></script>
    <script type="text/javascript" src="https://raw.githubusercontent.com/RobinHerbots/jquery.inputmask/2.x/js/jquery.inputmask.date.extensions.js"></script>
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();

            // var aux = ($(window).height() - 200);
            // $("div#table").css('max-height', aux);

            function esconde(){
                $('#lista_presenca > tr').each(function(){
                    $(this).hasClass('hidden') ? '' : $(this).addClass('hidden');
                });
            }

            function esconde_historico(){
                $('#historico > tr').each(function(){
                    $(this).hasClass('hidden') ? '' : $(this).addClass('hidden');
                });
            }

            function monta_tabela(periodo, empresa){

                esconde();

                let aux;

                if(periodo != -1 && empresa != -1){
                    aux = 'tr[periodo="'+periodo+'"][empreendimento="'+empresa+'"]';
                }else if(periodo != -1 && empresa == -1){
                    aux = 'tr[periodo="'+periodo+'"]';
                }else if(periodo == -1 && empresa != -1){
                    aux = 'tr[empreendimento="'+empresa+'"]';
                }else{
                    aux = '';
                }

                if(aux != ''){
                    $(aux).each(function(){
                        $(this).removeClass('hidden');
                    });
                }

                // console.log(aux);
            }

            function monta_tabela_historico(data, empresa){

                esconde_historico();

                let aux;

                if(data != '' && empresa != -1){
                    aux = 'tr[data="'+data+'"][empresa="'+empresa+'"]';
                }else if(data != '' && empresa == -1){
                    aux = 'tr[data="'+data+'"]';
                }else if(data == '' && empresa != -1){
                    aux = 'tr[empresa="'+empresa+'"]';
                }else{
                    aux = '';
                }

                if(aux != ''){
                    $('tbody#historico > '+aux).each(function(){
                        $(this).removeClass('hidden');
                    });
                }

                console.log(aux);
            }

            $('select#periodo').change(function(){

                let periodo = $(this).find('> option:selected').val();
                let empresa = $('select#empresa > option:selected').val();

                monta_tabela(periodo, empresa);
            });

            $('select#empresa').change(function(){

                let empresa = $(this).find('> option:selected').val();
                let periodo = $('select#periodo > option:selected').val();

                monta_tabela(periodo, empresa);
            });

            $('#data_historico').blur(function(){
                let date = $(this).val();
                let empresa_h = $('#empresa_historico > option:selected').val();

                monta_tabela_historico(date, empresa_h);
            });

            $('#empresa_historico').change(function(){
                let empresa_h = $(this).find('> option:selected').val();
                let date = $('#data_historico').val();

                monta_tabela_historico(date, empresa_h);
            });

            $('form.table').submit(function(e){
                // alert('ola mundo');
                // e.preventDefault();


            });

		});

	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/table_manage_combine.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Mar 2018 17:24:03 GMT -->
</html>
