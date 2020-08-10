<?php 
    error_reporting(0);
    ini_set(“display_errors”, 0 );
    set_time_limit(0);

    //include "protege_professor.php";

    ini_set("upload_max_filesize", "10M");
    ini_set("max_execution_time", "-1");
    ini_set("memory_limit", "-1");
    ini_set("realpath_cache_size", "-1");
    if (!isset($_SESSION)) {
      session_start();
    }
?>
<?php 

    class Upload {
        var $tipo;
        var $nome;
        var $tamanho;
         
        function Upload(){
        //Criando objeto
        }
         
        function UploadArquivo($arquivo, $pasta){ 
            if(isset($arquivo)){
                $nomeOriginal = $arquivo["name"]; 
                $tamanho = $arquivo["size"];
                 
                if (move_uploaded_file($arquivo["tmp_name"], $pasta . $nomeOriginal)){ 

                    $this->nome=$pasta . $nomeOriginal;
                    $this->tamanho = number_format($arquivo["size"]/1024, 2) . "KB";
                    return true; 
                }else{ 
                    return false;
                } 
            }
        } 
    }


    if(isset($_FILES["userfile"])){

        include "const_grava_tabela.php";

        $upArquivo = new Upload;
        if($upArquivo->UploadArquivo($_FILES["userfile"], "planilhas/"))
        {   
            $nome = $upArquivo->nome;
            $tamanho = $upArquivo->tamanho;
            $caminho = "planilhas/".$nome;
            $resultado = grava_tarefa($nome); // recebo os dados da gravação
            $aux = 1;
        }else{
            $aux = 5;
        }

        unlink($nome);
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
                        <div class="col-md-10">
                            <h2 class="panel-title" style="font-size: 14px;">Tabela de Tarefas</h2>
                        </div>
                        <div class="col-md-2">
                            <div class="dropdown">
                                <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Planilhas <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="planilhas_mod/modelo_tarefas.xlsx">Baixar Planilha Modelo</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#modal-message" data-toggle="modal">Subir Planilha Modelo</a></li>
                                    <li class="hide"><a href="#modal3" data-toggle="modal" data-target="#modal3" id="salvar"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <input class="form-control" id="input_busca" type="text" placeholder="Pesquise Aqui.." style="margin-bottom: 10px!important;">


                	<div id="table" class="table-editable pre-scrollable">
                		<table id="data-table" class="table table-striped table-bordered">
                			<thead class="thead-dark">
                				<tr>
                					<th width="20%" class="text-center">Código </th>
                					<th width="60%" class="text-center">Descrição</th>
                					<th width="20%" class="text-center">Remover</th>
                				</tr>
                			</thead>
                			<tbody id="myTable">
                				<tr class="hidden">
                					<td>123</td>
                					<td>DESCRIÇÃO AQUI</td>
                					<td>
                						<span class="table-remove">
                                            <a class="btn btn-danger btn-sm remove_tarefa">Remover</a>
                                        </span>
                					</td>
                				</tr>

                                <?php 
                                    include "conexao.php";

                                    $query = mysqli_query($db, "SELECT * FROM `const_tarefas` ")or die(mysqli_error($db));

                                    if(mysqli_num_rows($query) > 0){
                                        while ($assoc = mysqli_fetch_assoc($query)) {
                                            ?>
                                                <tr id-tarefa="<?php echo $assoc['id'] ?>">
                                                    <td><?php echo $assoc['codigo'] ?></td>
                                                    <td><?php echo $assoc['titulo'] ?></td>
                                                    <td>
                                                        <a class="btn btn-danger btn-sm remove_tarefa">Remover</a>
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
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success" style="text-align: left;" data-toggle="modal" data-target="#cad_tarefa">Nova Tarefa</button>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	

    <!--- Modal para cadastrar uma nova tarefa ---->
    <div id="cad_tarefa" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Cadastro de Tarefa</h3>
                    <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="codigo">Codigo da Tarefa</label>
                        <input type="text" class="form-control" id="codigo" placeholder="Digite o Código aqui...">
                    </div>

                    <div class="form-group">
                        <label for="desc">Descrição da Tarefa</label>
                        <input type="text" style="text-transform: uppercase" class="form-control" id="desc" placeholder="Digite a Descrição aqui...">
                    </div>
                </div>
                <div class="modal-footer" >
                    <a class="btn btn-primary cad_tarefa">Cadastrar Tarefa</a>
                    <a class="btn btn-default" data-dismiss="modal">Fechar</a>
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

    <div class="modal fade"  id="modal-message" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Subir Planilha de Tarefas</h4>
                </div>
                <form class="form-action" action="const_tarefas.php" method="POST" enctype="multipart/form-data" name="envia_xlsx">
                    <div class="modal-body">
                          <div class="form-group">
                            <label for="exampleFormControlFile1"> Selecione seu arquivo .xlsx</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="30000000" required="required">
                            <input name="userfile" type="file" class="form-control-file" id="exampleFormControlFile1" required="required">
                          </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success"/>
                    </div>
                </form>
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
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();

            //Rotina para campo de busca
            $("input#input_busca").on("keyup", function() {
                console.log('alos');

                var value = $(this).val().toLowerCase();
                $("tbody#myTable > tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
            });

            //Rotina para fazer o cadastro da tarefa
            $(document).on('click', 'a.cad_tarefa', function(){

                let cod = $('input#codigo').val();
                let desc = $('input#desc').val();

                if(cod != '' && desc != ''){

                    $.ajax({  
                        url:'const_cad_tarefa.php',  
                        method:'POST', 
                        data: {cod:cod, desc:desc},
                        dataType:'json',  
                        success: dados => 
                        {   
                           if(dados != 0 ){
                                let tr = $('tbody#myTable > tr.hidden').clone(true).removeClass('hidden');

                                tr.find('> td').eq(0).text(cod);
                                tr.find('> td').eq(1).text(desc);

                                tr.attr('id-tarefa', dados);

                                $('input#codigo').val('');
                                $('input#desc').val('');

                                $('tbody#myTable').append(tr);

                                $('div#cad_tarefa').modal('hide');

                                $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Sucesso ao Gravar Tarefa!</h4>");
                                $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                                $('div#modal7').modal('show');
                           }else{
                                $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Gravar Tarefa!</h4>");
                                $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                                $('div#modal7').modal('show');
                           }

                        },
                        error: erro => {

                            $('div#cad_tarefa').modal('hide');

                            $('input#codigo').val('');
                            $('input#desc').val('');

                            $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Gravar Tarefa!</h4>");
                            $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                            $('div#modal7').modal('show');
                        }  
                    });


                }else{
                    alert('Preencha todos os campos!');
                }
            });

            //Rotina para fazer a exclusão da tarefa
            $(document).on('click', 'a.remove_tarefa', function(){

                let id_tarefa = $(this).parents('tr').attr('id-tarefa');


                $.ajax({  
                    url:'const_cad_tarefa.php',  
                    method:'POST', 
                    data: {id_tarefa:id_tarefa},
                    dataType:'json',  
                    success: dados => 
                    {   
                       if(dados == 1 ){

                            $(this).parents('tr').detach();

                            $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Sucesso ao Excluir a Tarefa!</h4>");
                            $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                            $('div#modal7').modal('show');

                           
                       }else{
                            $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Excluir a Tarefa!</h4>");
                            $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                            $('div#modal7').modal('show');
                       }

                    },
                    error: erro => {

                        $('div#cad_tarefa').modal('hide');

                        $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Excluir a Tarefa!</h4>");
                        $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                        $('div#modal7').modal('show');
                    }  
                });

            });

		});

	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/table_manage_combine.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Mar 2018 17:24:03 GMT -->
</html>
