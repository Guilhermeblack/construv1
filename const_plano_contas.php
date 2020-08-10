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
            $resultado = grava_plano_contas($nome); // recebo os dados da gravação
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
        <?php 
            if((!isset($resultado["error"])) && isset($resultado["ok"])){
              if(empty($resultado["ok"])){
                ?>
                <div class="alert alert-warning" role="alert">
                  <p class="font-weight-bold">Falha ao gravar o arquivo, Por favor verifique e tente novamente !</p></br>
                </div>
                <?php
              }
            }

            if(isset($resultado) && (count($resultado["ok"]) !== 0)){       ?>
              <div class="alert alert-success" role="alert">
                <strong><font>Sucesso!</font></strong>
                <font><?php  echo "Foram gravadas ".count($resultado["ok"])." Linhas !";  ?></font>
              </div>
              <?php
            }   
            ?>

            <?php   
            if(isset($resultado["error"]) && $_GET["planilha"] == 1){
              ?>
              <div class="alert alert-danger" role="alert">
               <font><?php echo "Falha ao gravar algumas linhas, por gentileza verifique e tente novamente!"; ?></font>
               <a href="planilhas/falhas.xlsx"><span class="label label-danger" style="font-size:100% !important">BAIXAR PLANILHA DE DADOS NÃO CADASTRADOS!</span></a>
             </div>
             <?php 
           }elseif (isset($resultado["error"]) && $_GET["planilha"] == 2) { ?>
             <div class="alert alert-danger" role="alert">
              <font><?php echo "Falha ao gravar algumas linhas, por gentileza verifique e tente novamente!"; ?></font>
              <a href="planilhas/falhas.xlsx"><span class="label label-danger" style="font-size:100% !important">BAIXAR PLANILHA DE DADOS NÃO CADASTRADOS!</span></a>
            </div>
       <?php }
       ?>
            <div class="panel panel-inverse">
                <div class="panel-heading" style="">
                    <div class="row">
                        <div class="col-md-4">
                            <h2 class="panel-title" style="font-size: 14px;">Tabela de Etapas de Obra</h2>
                        </div>
                        <div class="col-md-6">
                        	<input class="form-control" id="myInput" type="text" placeholder="Pesquise Aqui..">
                        </div>
                        <div class="col-md-2" style="text-align: right;">
                            <div class="dropdown">
                                <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Planilhas <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="planilhas_mod/modelo_planoContas.xlsx">Baixar Planilha Modelo</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#modal-message" data-toggle="modal">Subir Planilha Modelo</a></li>
                                    <li class="hide"><a href="#modal3" data-toggle="modal" data-target="#modal3" id="salvar"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body">

                	<div class="row alert" role="alert" style="padding: 0px;">
                		<div class="col-md-11" style="text-align: center;">
                			<h3 style="text-align: center; text-transform: uppercase; ">Cadastro de Etapa de Obra</h3>
                		</div>
                		<div class="col-md-1">
                			<button type="button" class="close col-md-1" data-dismiss="alert" aria-label="Close">
                				<span aria-hidden="true">&times;</span>
                			</button>
                		</div>
                	</div>

                	<div id="table" class="table-editable pre-scrollable">
                		<table id="data-table" class="table table-striped table-bordered">
                			<thead class="thead-dark">
                				<tr>
                					<th width="20%" class="text-center">Código </th>
                					<th width="60%" class="text-center">Descrição Etapa</th>
                					<th width="20%" class="text-center">Remover</th>
                				</tr>
                			</thead>
                			<tbody id="myTable">
                				<tr class="hidden">
                					<td>123</td>
                					<td>DESCRIÇÃO AQUI</td>
                					<td>
                						<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remover</button></span>
                					</td>
                				</tr>

                				<?php
                				include "conexao.php";

                				$query = mysqli_query($db, "SELECT * FROM const_planocontas")or die(mysqli_error($db));

                				if(mysqli_num_rows($query) > 0){
                					while ($exeQuery = mysqli_fetch_assoc($query)) {

                						$aux_query = mysqli_query($db, "SELECT * FROM `tabela_orcamento` WHERE `id_insumo_plano` = ".$exeQuery['id']." AND tabela = 1 ")or die(mysqli_error($db));

                						if(mysqli_num_rows($aux_query) >  0){
                							?>
                							<tr class="">
                								<td><?php echo $exeQuery['codigo']; ?></td>
                								<td colspan="2"><?php echo $exeQuery['descricao']; ?></td>
                							</tr>
                							<?php
                						}else{
                							?>
                							<tr class="">
                								<td><?php echo $exeQuery['codigo']; ?></td>
                								<td><?php echo $exeQuery['descricao']; ?></td>
                								<td>
                									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remover</button></span>
                								</td>
                							</tr>

                							<?php
                						}
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
                            <button class="table-add  btn btn-success" style="text-align: left;">Nova Etapa</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade"  id="modal-message" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Subir Planilha de Etapas</h4>
                        </div>
                        <form class="form-action" action="const_plano_contas.php" method="POST" enctype="multipart/form-data" name="envia_xlsx">
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


            <button href="#modal-dialog" data-toggle="modal" data-target="#modal-dialog" class="hidden" id="dialog">alo</button>
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
                            <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
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
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
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
            $("#myInput").on("keyup", function() {
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

            var $TABLE = $('#data-table');
            var $FORM_PRINCI = $('#form_principal');

            //Adiciona linha a tabela
            $('button.table-add').click(function () {

                var $clone = $TABLE.find('tr.hidden').clone(true).removeClass('hidden');
                $TABLE.append($clone);

                $TABLE.find('tbody > tr:last-child > td').each(function(i){
                    if(i == 0){
                        $(this).attr("contenteditable", "true");
                    }else if(i == 1){
                        $(this).attr("contenteditable", "true");
                    }else if(i == 2){
                        $(this).find("span.table-remove").toggle();
                        $(this).append("<span id='salvar'><button type='button' class='btn btn-defaut btn-rounded btn-sm my-0 alonso' style='background: #388e3c!important; color: #FFF;'>Salvar</button></span>");
                    }
                });

                $TABLE.find('tbody > tr:last-child > td:first-child').focus();
            });

            //função para salvar a nova linha inserida no banco de dados
            $(document).on('click', '#salvar', function(){  

                var adiciona = [];

                $(this).toggle();
                $(this).parent().find("span.table-remove").toggle();

                $(this).parent().parent().find('td').each(function(i){
                    if(i == 0){
                        $(this).attr("contenteditable", "false");
                        $(this).text($(this).text().toUpperCase());
                        adiciona.push($(this).text());
                    }else if(i == 1){
                        $(this).attr("contenteditable", "false");
                        $(this).text($(this).text().toUpperCase());
                        adiciona.push($(this).text());
                    }
                });

                $.ajax({  
                    url:'const_grava_planoContas.php',  
                    method:'POST', 
                    data: {adiciona},
                    dataType:'json',  
                    success: dados => 
                    {   
                      if(dados != 0){
                        $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Salvo com Sucesso!</h4>");
                        $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                        $('button#dialog').click();
                      }else{
                        $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao salvar!</h4>");
                        $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                        $('button#dialog').click();
                      }

                    },
                    error: erro => {
                        $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao salvar!</h4>");
                        $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                        $('button#dialog').click();
                    }  
                });
            });
            
            $('.table-remove').click(function () {
                $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Deseja realmente excluir o Plano de Contas?</h4>");
                $("div#dialog-footer").html(" <button type='button' class='btn btn-success' id='confirmar' >Confirmar</button>");
                $("div#dialog-footer").append("<button type='button' class='btn btn-danger' id='cancelar' data-dismiss='modal'>Cancelar</button>");
                $("div#dialog-footer").append("<button type='button' class='hidden' id='codigo' data-cod='"+$(this).parents('tr').find('td:first-child').text()+"'></button>");
                $('button#dialog').click();
            });

            //função para excluir a nova linha inserida no banco de dados
            $(document).on('click', '#confirmar', function(){  

               var remove = $(this).parents('div').find('button#codigo').attr('data-cod');

               $.ajax({  
                    url:'const_grava_planoContas.php',  
                    method:'POST', 
                    data: {remove},
                    dataType:'json',  
                    success: dados => 
                    {   
                      if(dados == 1){

                        $('tr').find('td:first-child').each(function(){
                            if($(this).text() == remove){
                                $(this).parents('tr').detach();
                                return ;
                            }
                        });

                        $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Excluido com com Sucesso!</h4>");
                        $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                      }

                    },
                    error: erro => {
                        $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>alonso!</h4>");
                        $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                    }  
                });
            });

		});

	</script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/table_manage_combine.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Mar 2018 17:24:03 GMT -->
</html>
