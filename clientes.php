<?php
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
?>
<?php
    include "cadastro_planilha_cliente.php";
    $aux = 0;

    class Upload
    {
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
                    $this->tamanho=number_format($arquivo["size"]/1024, 2) . "KB";
                    return true; 
                }else{ 
                    return false;
                } 
            }
        } 
    }


    if(isset($_FILES["userfile"])){

        $upArquivo = new Upload;
        if($upArquivo->UploadArquivo($_FILES["userfile"], "planilhas/"))
        {   
            $nome = $upArquivo->nome;
            $tamanho = $upArquivo->tamanho;
            $caminho = "planilhas/".$nome;
            $resultado = grava_banco($nome); // recebo os dados da gravação
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
<html>
<!--<![endif]-->


<head>
    <meta charset="utf-8" />
    <title>Immobile | Business</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css"
        rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css"
        rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css"
        rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css"
        rel="stylesheet" />
    <link
        href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css"
        rel="stylesheet" />
    <link
        href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"
        rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>

<body>
    <?php 
  function grupo_cliente($idcliente)
  {

    include "conexao.php";
    $query_amigo = "SELECT * FROM grupo_cliente                    	
    where idgrupo_cliente = $idcliente";

    $executa_query = mysqli_query ($db, $query_amigo);
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
     
      $descricao = $buscar_amigo["descricao"];

      $dados["descricao"] = $descricao;

    }     
    return $dados; 
    

  }


  function tem_contrato($idcliente)
  {

    include "conexao.php";
    $query_amigo = "SELECT SUM(idparcelas) as TOTAL FROM parcelas                     
    where cliente_id_novo = $idcliente";

    $executa_query = mysqli_query ($db, $query_amigo);
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
      $idparcelas             = $buscar_amigo["TOTAL"];
    }     
    return $idparcelas; 
    

  }
  ?>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">


        <?php include "topo.php"; ?>

        <!-- begin #content -->
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
                <strong>
                    <font>Sucesso!</font>
                </strong>
                <font><?php  echo "Foram gravadas ".count($resultado["ok"])." Linhas !";  ?></font>
            </div>
            <?php
        }   
        ?>

            <?php   
        if(isset($resultado["error"])){
          ?>
            <div class="alert alert-danger" role="alert">
                <font><?php echo "Falha ao gravar algumas linhas, por gentileza verifique e tente novamente!"; ?></font>
                <a href="planilhas/falhas.xlsx"><span class="label label-danger"
                        style="font-size:100% !important">BAIXAR PLANILHA DE DADOS NÃO CADASTRADOS!</span></a>
            </div>
            <?php 
        } 
    ?>

            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <?php if (in_array('85', $idrota)) { ?>
                <li><a href="planilhas_mod/cad_cliente.xlsx"><span class="label label-primary"
                            style="font-size:100% !important">BAIXAR PLANILHA MODELO</span></a></li>
                <li><a href="#modal-message" data-toggle="modal"><span class="label label-primary"
                            style="font-size:100% !important">SUBIR PLANILHA MODELO</span></a></li>
                <?php }
         if (in_array('2', $idrota)) { ?>
                <li><a href="cadastro_cliente.php"><span class="label label-primary"
                            style="font-size:100% !important">NOVO CADASTRO</span></a></li>

                <?php } ?>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Cadastro Geral</h1>
            <!-- end page-header -->

            <!-- begin row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                    data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                    data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                    data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                                    data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Filtro de dados</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-vertical form-bordered" name="myForm" method="POST"
                                action="clientes.php?filtro=1">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Nome</label>
                                    <div class="col-md-4">
                                        <div class="">
                                            <input type="text" class="form-control" name="nome_cliente">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">CPF/CNPJ</label>
                                    <div class="col-md-4">
                                        <div class="">
                                            <input type="text" class="form-control" name="cpf_cliente"
                                                id="masked-input-cpf">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Código</label>
                                    <div class="col-md-4">
                                        <div class="">
                                            <input type="text" name="codigo_cliente" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Imobiliaria</label>
                                    <div class="col-md-4">
                                        <div class="">
                                            <select class="form-control" name="imobiliaria_id" id="imobiliaria_id">
                                                <option value="Todos">Todos</option>
                                                <?php

                                                    include "conexao.php";
                                                    
                                                    $query_amigo = "SELECT * FROM cliente
                                                    INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                                                    WHERE idtipo = 11 order by nome_cli Asc";

                                                    $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                                                          while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                                                          
                                                            $idcliente             = $buscar_amigo['idcliente'];
                                                            $nome_cli              = $buscar_amigo["nome_cli"];
                                                            $cpf_cli              = $buscar_amigo["cpf_cli"];
                                                            
                                                            
                                                            
                                                            ?>
                                                          <option value="<?php echo $idcliente ?>"> <?php echo $nome_cli ?>
                                                </option>
                                                <?php } ?>


                                            </select>


                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    
                                </div>





                                <div class="form-group">

                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-sm btn-success" value="Consultar" />
                                    </div>
                                </div>

                            </form>



                        </div>
                    </div>
                </div>














                <?php if (in_array('1', $idrota)) { 

 if(isset($_GET["filtro"])){


   ?>


                <!-- begin col-10 -->
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                    data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                    data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                    data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                                    data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Informações de Clientes</h4>
                        </div>

                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Grupo</th>
                                        <th>Tipo</th>
                                        <th>CPF/CNPJ</th>
                                        <th>Telefone</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php


          $nome_cliente   = $_POST["nome_cliente"];
          $cpf_cliente    = $_POST["cpf_cliente"];
          $codigo_cliente = $_POST["codigo_cliente"];

          $imobiliaria_id = $_POST["imobiliaria_id"];



          $where = 'cliente.idcliente > 0';

          if($nome_cliente != ''){
            $where .= " AND nome_cli LIKE '%".$nome_cliente."%'";
          }
          
          if($cpf_cliente != ''){
            $where .= " AND cpf_cli = '$cpf_cliente'";
          }

          if($codigo_cliente != ''){
            $where .= " AND cliente.idcliente =".$codigo_cliente;
          }

          if($imobiliaria_id != 'Todos'){
            $where .= " AND idcorretor =".$imobiliaria_id;
            $inner_j = " INNER JOIN vinculo ON vinculo.idcliente = cliente.idcliente";

          }else{
            $inner_j = "";

          }


          include "conexao.php";

            if (in_array('49', $idrota)) {       //  Administrador Lista todos os clientes
               $query_amigo = "SELECT cliente.idcliente, cliente.nome_cli, cliente.cpf_cli, cliente.telefone1_cli, cliente.idgrupo             FROM cliente

               $inner_j
               where $where group by idcliente"; 
               
               
            }else{    
              
               
              $query_amigo = "SELECT cliente.idcliente, cliente.nome_cli, cliente.cpf_cli, cliente.telefone1_cli, vinculo.idcorretor, cliente.idgrupo 
              FROM cliente
              INNER JOIN vinculo ON vinculo.idcliente = cliente.idcliente
              WHERE $where AND idcorretor = $imobiliaria_idimobiliaria group by idcliente";
              

            }
            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
            $idg = mysqli_fetch_assoc($executa_query);
            
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
             
                $idgrup         = $buscar_amigo['idgrupo'];
              $idcliente        = $buscar_amigo['idcliente'];
              $nome_cli         = $buscar_amigo["nome_cli"];
              $cpf_cli          = $buscar_amigo["cpf_cli"];
              $telefone1_cli    = $buscar_amigo["telefone1_cli"];
              $categoria_cliente    = $buscar_amigo["categoria_cliente"];

              $grup = mysqli_query($db,"SELECT `titulo_grupo` FROM grupo WHERE `idgrupo` = $idgrup") or die("erro grupo");
                $grup = mysqli_fetch_assoc($grup);
              $grupi = $grup['titulo_grupo'];
              //de onde vem esse verifica tipo maldito
              $tipo_cliente 	  = verifica_tipo($idcliente);
              ?>


                                    <tr class="odd gradeX">
                                        <td><?php echo $idcliente ?></td>
                                        <td><?php echo $nome_cli ?></td>
                                        <td><?php echo $grupi ?></td>
                                        <td><?php
                                                foreach($tipo_cliente as $tipo){
                                                echo $tipo.", " ;


                                                }?></td>
                                        <td><?php echo $cpf_cli ?></td>
                                        <td><?php echo $telefone1_cli ?></td>
                                        <td>


                                            <?php if (in_array('3', $idrota)) { ?>


                                            <a href="alterar_clientes.php?idcliente=<?php echo $idcliente ?>"> <span
                                                    class="label label-success">Ver / Editar</span></a><br><br>

                                            <a href="anexar_documentos.php?idcliente=<?php echo $idcliente ?>"> <span
                                                    class="label label-primary">Anexar Documentos</span></a><br><br>

                                            <?php }  ?>

                                            <?php if (in_array('45', $idrota)) { 

              $tem_contrato = tem_contrato($idcliente);

              if($tem_contrato == null){


                ?>

                                            <a href="excluir_cliente.php?idcliente=<?php echo $idcliente ?>"> <span
                                                    class="label label-danger">Excluir</span></a><br><br>
                                            <?php } } ?>

                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->


                <?php } } ?>

            </div>
            <!-- end row -->

            <div class="modal modal-message fade" id="modal-message" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Subir Planilha de Clientes</h4>
                        </div>
                        <form class="form-action" action="clientes.php" method="POST" enctype="multipart/form-data"
                            name="envia_xlsx">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1"> Selecione seu arqiuvo .xlsx</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" required="required">
                                    <input name="userfile" type="file" class="form-control-file"
                                        id="exampleFormControlFile1" required="required">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end #content -->



        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
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
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/js/jquery.dataTables.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js">
    </script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js">
    </script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js">
    </script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js">
    </script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js">
    </script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js">
    </script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js">
    </script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/table-manage-buttons.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js">
    </script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js">
    </script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/masked-input/masked-input.min.js"></script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/password-indicator/js/password-indicator.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-select/bootstrap-select.min.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
    </script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script
        src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/form-plugins.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/parsley/dist/parsley.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/form-wizards-validation.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
    $(document).ready(function() {
        App.init();
        TableManageButtons.init();
        FormPlugins.init();
    });
    </script>
    <script type="text/javascript">
    $(document).click(function() {
        /* Executa a requisição quando o campo CEP perder o foco */
        $('#imobiliaria_id').click(function() {


            /* Configura a requisição AJAX */
            $.ajax({
                url: 'consultar_corretor.php',
                /* URL que será chamada */
                type: 'POST',
                /* Tipo da requisição */
                data: 'imobiliaria_id=' + $('#imobiliaria_id').val(),
                /* dado que será enviado via POST */
                dataType: 'json',
                /* Tipo de transmissão */
                success: function(data) {

                    var $corretor = $('#corretor_id');
                    $corretor.empty();

                    $.each(data, function(idcorretor, corretor) {
                        $corretor.append('<option value=' + idcorretor + '>' +
                            corretor + '</option>');
                    });

                    $corretor.change();






                }
            });
            return false;
        })
    });
    </script>
</body>


</html>