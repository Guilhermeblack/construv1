<?php 
    error_reporting(0);
    ini_set(“display_errors”, 0 );
    set_time_limit(0);

    //include "protege_professor.php";
    if (!isset($_SESSION)) {
      session_start();
    }

    include "conexao.php";

    if(isset($_POST['Enviar'])){

        switch ($_POST['situacao']) {
            case '1':
                $situacao = ' AND CTSE.status = 1';
                break;

            case '2':
                $situacao = ' AND CTSE.status = 0';
                break;

            case '3':
                $situacao = '';
                break;
            
        }

        $_POST['empreendimento'] != -1 ? $empreendimento = ' AND CSE.id_empreendimento = '.$_POST['empreendimento'] : $empreendimento = '';
        $_POST['sub_empreendimento'] != -1 ? $sub_empreendimento = ' AND CTSE.id_sub_empre = '.$_POST['sub_empreendimento'] : $sub_empreendimento = '';
        $_POST['tarefa'] != -1 ? $tarefa = ' AND CTSE.id_tarefa = '.$_POST['tarefa'] : $tarefa = '';

        $_POST['start'] != '' ? $start = ' AND STR_TO_DATE(data_inicio, "%Y-%m-%d") >= '.$_POST['start'] : $start = '';
        $_POST['end'] != '' ? $end = ' AND STR_TO_DATE(data_inicio, "%Y-%m-%d") <= '.$_POST['tarefa'] : $end = '';

        $where = $empreendimento.$sub_empreendimento.$tarefa.$start.$end.$situacao;

        $sql = "SELECT *, CTSE.id AS id_tarefa FROM const_tarefa_sub_empre AS CTSE INNER JOIN const_sub_empreendimento AS CSE ON CTSE.id_sub_empre = CSE.id INNER JOIN empreendimento_cadastro AS EC ON CSE.id_empreendimento = EC.idempreendimento_cadastro INNER JOIN const_equipe AS CE ON CTSE.id_equipe = CE.id LEFT JOIN (SELECT SUM(qnt_medida) AS total, id_tarefa_sub FROM `const_medicao` GROUP BY id_tarefa_sub) AS medida ON CTSE.id = medida.id_tarefa_sub INNER JOIN (SELECT id, titulo AS nome_tarefa FROM const_tarefas) AS CT ON CTSE.id_tarefa = CT.id WHERE CTSE.id > 0 ".$where;


        // echo $sql;
        // die();


        $query = mysqli_query($db, $sql)or die(mysqli_error($db));

        $dados = [];

        
        while ($assoc = mysqli_fetch_assoc($query)) {
            $dados[] = $assoc;
        }
    }

?>

<!DOCTYPE html>
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
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>

    <style type="text/css">
        

        tbody > tr > td, th{
            color: #000;
            font-size: 12px;
            /*border: 1px solid #343a40!important;*/
        }

/*        thead.thead-dark > tr > th.text-center{
            vertical-align:middle!important;
            font-size: 11px !important;
            padding: 5px !important;
            font-weight: normal;
            color: #fff;
            background-color: #343a40;
            text-transform: uppercase;
        }*/
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

            <h3 class="page-header">Relátório de Tarefas</h3>

            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Preencha Todos os dados</h4>
                </div>
                <div class="panel-body">
                    
                    <form action="relatorio_tarefa.php" method="POST">

                       <div class="form-group col-md-12">
                           <label class="col-md-4" for="empreendimento">Selecione o Empreendimento</label>

                           <div class="col-md-8">
                               <select class="form-control" id="empreendimento" name="empreendimento">
                                    <option value="-1">Selecione</option>
                                   <?php 

                                        $query = mysqli_query($db, "SELECT * FROM `empreendimento_cadastro`")or die(mysqli_error($db));

                                        if(mysqli_num_rows($query)){
                                            while ($assoc = mysqli_fetch_assoc($query)) {
                                                ?>
                                                <option value="<?php echo $assoc['idempreendimento_cadastro']; ?>"><?php echo $assoc['descricao_empreendimento']; ?></option>
                                                <?php
                                            }
                                        }

                                    ?>
                               </select>
                           </div>
                       </div>

                       <div class="form-group col-md-12">
                           <label class="col-md-4" for="sub_empreendimento">Selecione o Sub-Empreendimento</label>

                           <div class="col-md-8">
                               <select class="form-control" id="sub_empreendimento" name="sub_empreendimento">
                                    <option value="-1">Selecione</option>
                                   <?php 

                                        $query = mysqli_query($db, "SELECT * FROM `const_sub_empreendimento`")or die(mysqli_error($db));

                                        if(mysqli_num_rows($query)){
                                            while ($assoc = mysqli_fetch_assoc($query)) {
                                                ?>
                                                <option value="<?php echo $assoc['id']; ?>" emp="<?php echo $assoc['id_empreendimento']; ?>" class="hidden"><?php echo $assoc['titulo']; ?></option>
                                                <?php
                                            }
                                        }

                                    ?>
                               </select>
                           </div>
                       </div>

                       <div class="form-group col-md-12">
                           <label class="col-md-4" for="tarefa">Selecione a Tarefa</label>

                           <div class="col-md-8">
                               <select class="form-control default-select2" id="tarefa" name="tarefa">
                                    <option value="-1">Selecione</option>
                                   <?php 

                                        $query = mysqli_query($db, "SELECT * FROM `const_tarefas`")or die(mysqli_error($db));

                                        if(mysqli_num_rows($query)){
                                            while ($assoc = mysqli_fetch_assoc($query)) {
                                                ?>
                                                <option value="<?php echo $assoc['id']; ?>"><?php echo $assoc['titulo']; ?></option>
                                                <?php
                                            }
                                        }

                                    ?>
                               </select>
                           </div>
                       </div>

                       <div class="form-group col-md-12">
                           <label class="col-md-4" for="periodo">Selecione o Período</label>

                           <div class="col-md-8">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="start" placeholder="Data Inicial" />
                                    <span class="input-group-addon">Até</span>
                                    <input type="date" class="form-control" name="end" placeholder="Data Final" />
                                </div>
                            </div>
                       </div>

                       <div class="form-group col-md-12">
                            <label class="col-md-4" for="status">Selecione o Status</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="radio" name="situacao" value="1" required="">Em andamento
                                    <input type="radio" name="situacao" value="2" required="">Concluido
                                    <input type="radio" name="situacao" value="3" required="">Todos
                                </div>
                            </div>
                       </div>

                       <div class="form-group col-md-12" align="right">
                            <button type="submit" class="btn btn-success" name="Enviar">Pesquisar</button >
                       </div>
                    </form>   

                    <div class="row <?php if(!isset($_POST['Enviar'])){echo 'hidden'; }?>" id="relatorio" style="padding-top: 3%;">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nº Tarefa</th>
                                    <th>Empreedimento</th>
                                    <th>Sub-Empreendimento</th>
                                    <th>Equipe</th>
                                    <th>Tarefa</th>
                                    <th>Qnt Feita</th>
                                    <th>Medida</th>
                                    <th>Valor da Tarefa</th>
                                    <th>Valor Total Feito</th>
                                    <th>Data de Inicio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                    foreach ($dados as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $value['id_tarefa']; ?></td>
                                            <td><?php echo $value['descricao_empreendimento']; ?></td>
                                            <td><?php echo $value['titulo']; ?></td>
                                            <td><?php echo $value['nome']; ?></td>
                                            <td><?php echo $value['nome_tarefa']; ?></td>
                                            <td><?php echo $value['total']; ?></td>
                                            <td><?php echo $value['unidade_medida']; ?></td>
                                            <td><?php echo 'R$ '.number_format($value['valor_tarefa'],2, '.', ''); ?></td>
                                            <td><?php echo 'R$ '.number_format(($value['valor_tarefa'] * $value['total']),2, '.', ''); ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($value['data_inicio'])); ?></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>                 
                </div>
            </div>
		</div>
		
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>


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
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
            FormPlugins.init();
            TableManageButtons.init();

            $('select#empreendimento').change(function(){

                var id_emp = $(this).find('> option:selected').val();

                $('select#sub_empreendimento > option').each(function(){

                    if($(this).attr('emp') == id_emp){
                        $(this).removeClass('hidden');
                    }else{
                        $(this).addClass('hidden');
                    }
                });

            }); 
		});   

	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/table_manage_combine.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Mar 2018 17:24:03 GMT -->
</html>
