<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";


function sanitizeString($str) {
    $str = preg_replace('/[áàãâä]/u', 'a', $str);
    $str = preg_replace('/[éèêë]/u', 'e', $str);
    $str = preg_replace('/[íìîï]/u', 'i', $str);
    $str = preg_replace('/[óòõôö]/u', 'o', $str);
    $str = preg_replace('/[úùûü]/u', 'u', $str);
    $str = preg_replace('/[ç]/u', 'c', $str);
    $str = preg_replace('/[ÁÀÃÂÄ]/u', 'A', $str);
    $str = preg_replace('/[ÉÈÊË]/u', 'E', $str);
    $str = preg_replace('/[ÍÌÎÏ]/u', 'I', $str);
    $str = preg_replace('/[ÓÒÔÕÖ]/u', 'O', $str);
    $str = preg_replace('/[ÚÙÛÜ]/u', 'U', $str);
    $str = preg_replace('/[Ç]/u', 'C', $str);
    return $str;
}
?>
<?php 

if(isset($_POST["cliente_id"])){

    $descricao               = addslashes(sanitizeString($_POST['descricao'])); //necessário tratar caracteres especiais aqui? 
    $cliente_id              = $_POST['cliente_id']; 
    $tipo_empreendimento     = $_POST['tipo_empreendimento']; 
    $participacao            = $_POST['participacao']; 
    $matricula_empreendimento             = $_POST['matricula_empreendimento']; 




    include "conexao.php";
    $teste = mysqli_query ($db,"INSERT INTO empreendimento_cadastro (descricao_empreendimento, cliente_id,tipo_empreendimento, matricula_empreendimento) values ('$descricao', '$cliente_id','$tipo_empreendimento','$matricula_empreendimento')");
    $empreendimento_id = mysqli_insert_id($db);

?>

<?php } ?>


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
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
</head>
<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span>
    </div>
    <!-- end #page-loader -->
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
        <?php include "topo.php"; ?>
        <div class="sidebar-bg"></div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Cadastro <small>Empreendimentos</small></h1>
            <!-- end page-header -->
            <!-- begin row -->
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Preencha os campos!</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="const_cadastro_empreendimento.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Empresa:</label>
                                    <div class="col-md-9">
                                        <select class="default-select2 form-control" name="cliente_id" required="">
                                            <option value="">Escolha</option>
                                            <?php 
                                                include "conexao.php"; 
                                                $query_amigo="SELECT * FROM cliente inner join `cliente_tipo` on cliente.idcliente = cliente_tipo.idcliente  where cliente_tipo.idtipo= 12  order by cliente.nome_cli Asc" ;
                                                
                                                $executa_query= mysqli_query ($db, $query_amigo) or die ( "Erro ao listar Locatário"); 

                                                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos $idcliente=$ buscar_amigo[ 'idcliente']; $nome_cli=$ buscar_amigo[ "nome_cli"]; $cpf_cli=$ buscar_amigo[ "cpf_cli"]; ?>
                                                    <option value="<?php echo $buscar_amigo['idcliente']; ?>">
                                                        <?php echo $buscar_amigo['nome_cli']." CPF/CNPJ: ".$buscar_amigo['cpf_cli'] ?>
                                                    </option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">% Participação Titular</label>
                                    <div class="col-md-9">
                                        <input type="text" name="participacao" id="participacao" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tipo de Empreendimento</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="tipo_empreendimento" value="0">Próprio</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="tipo_empreendimento" value="1">Administração</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="tipo_empreendimento" value="2">Terceiros</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nº Matricula Empreendimento</label>
                                    <div class="col-md-9">
                                        <input type="text" name="matricula_empreendimento" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Titulo</label>
                                    <div class="col-md-9">
                                        <input type="text" name="descricao" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar">
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->
                </form>
            </div>
            <!-- end #content -->
            <!-- begin scroll to top btn -->    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
            <!-- end scroll to top btn -->
        </div>

        <div id="modal7" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
                    </div>
                    <div class="modal-body" id="salvar" align="center">
                        <h4 class="modal-title" align="center" id="salvar">Empreendimento Cadastrado com Sucesso!</h4>
                    </div>
                    <div class="modal-footer" id="footer_salvar">
                        <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page container -->
        <!-- ================== BEGIN BASE JS ================== -->
        <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
        <script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>
        <!-- ================== END PAGE LEVEL JS ================== -->
        <script type="text/javascript">
            $(function(){
            
                $("#participacao").maskMoney({symbol:'', 
                showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});
             });
        </script>


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
        <!-- ================== END PAGE LEVEL JS ================== -->
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


                <?php 
                    if(isset($_POST["cliente_id"])){
                        ?>
                        $('div#modal7').modal('show');
                        <?php
                    }
                 ?>
            });
        </script>
</body>


</html>
