<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
  function busca_preco($idfornecedor, $idinsumo)
{

    include "conexao.php";
    $query_amigo = "SELECT * FROM cotacao
                                    where fornecedor_id = $idfornecedor AND insumo_id = $idinsumo 
                                    order by id desc limit 1";

    $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar preco do fornecedor");
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
        $valorCusto             = $buscar_amigo["valorCusto"];
        $updated_at             = $buscar_amigo["updated_at"];

        $dados["valorCusto"] = $valorCusto;
        $dados["updated_at"] = $updated_at;

        }     
           return $dados; 
             

}



if(isset($_POST["cadastrar"]))
{
    $projeto_id     = $_GET["projeto_id"];
    $pacotes_id     = $_GET["pacotes_id"];
    $lista_cotacao_id       = $_GET["lista_cotacao"];

    $fornecedor_id  = $_POST["fornecedor_id"]; 
    $data_hoje = date('d-m-Y'); 
    
    include "conexao.php";            
                   
                 
               
                $query_amigo = "SELECT * FROM itens_cotacao
                                INNER JOIN insumo ON itens_cotacao.insumo_id = insumo.id                               
                                WHERE projeto_id = $projeto_id AND lista_cotacao_id = $lista_cotacao_id";
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar pacotes");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
            $insumo_id              = $buscar_amigo["insumo_id"];

           
                 $valorCusto = $_POST[$insumo_id];
           
                if($valorCusto == '' or $valorCusto == null or $valorCusto == 0 or $valorCusto == ' '){
          $valorCusto = 0; 
        }
           
            $verifica = busca_preco($fornecedor_id, $insumo_id);

            if($verifica == ''){
                $inserir = mysqli_query($db, "INSERT INTO cotacao(insumo_id, fornecedor_id, valorCusto, updated_at ) values('$insumo_id','$fornecedor_id','$valorCusto','$data_hoje')");
            }else{
                $update = mysqli_query($db, "UPDATE cotacao set valorCusto ='$valorCusto', updated_at ='$data_hoje' WHERE insumo_id = $insumo_id AND fornecedor_id = $fornecedor_id");
            }


}

}







?>
<!DOCTYPE html>

<html lang="en">


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
       <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script> 
        <link href="https://immobilebusiness.com.br/admin/assets/css/multiple-select.css" rel="stylesheet"/>

    <!-- ================== END BASE JS ================== -->
</head>
<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
    <?php include "topo.php";

    $projeto_id         = $_GET["projeto_id"];
    $lista_cotacao_id   = $_GET["lista_cotacao"];





?>




        <!-- end #sidebar -->
        
        <!-- begin #content -->
        <div id="content" class="content">
           
            <!-- begin page-header -->
            <h1 class="page-header">Preencher Orçamento</h1>
            <!-- end page-header -->
            <div class="row">
                <!-- begin col-12 -->
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
                            <h4 class="panel-title">Preencher Orçamento Material</h4>
                            
                        </div>
                        <div class="panel-body">
                            <form action="preencher_orcamento.php?projeto_id=<?php echo $projeto_id ?>&lista_cotacao=<?php echo $lista_cotacao_id ?>" method="POST" data-parsley-validate="true" name="form_wizard">


                                <div id="wizard">
                                    <ol>
                                        <li>
                                            Informações Báscias
                                            <small></small>
                                        </li>
                                       
                                       
                                       
                                    </ol>
                                    <!-- begin wizard step-1 -->
                                    <div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">  Informações Báscias</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group block1">
                                                        <label>Fornecedor:</label>
                                                             <select class="default-select2 form-control" name="fornecedor_id" required="">
                                        <option value="">Escolha</option>
                                          <?php

                      include "conexao.php";
                 
                $query_amigo = "SELECT * FROM fornecedor_lista
                                INNER JOIN cliente ON fornecedor_lista.fornecedor_id = cliente.idcliente
                                WHERE lista_cotacao_id = $lista_cotacao_id 
                               order by nome_cli Asc";


                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar Locatário");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                $idcliente     = $buscar_amigo['idcliente'];
                $nome_cli      = $buscar_amigo["nome_cli"];
             
        
             
            
             ?>
               <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli" ?> </option>
                    <?php } ?>
                    
                                           
                                        </select>
                                                    </div>
                                                </div>

                                                
                                  
                                            </div>
                                    
                                               
                                               
                                        </fieldset>
                                              <p><input type="submit" class="btn btn-success btn-lg" role="button" value="Carregar Lista" /></p>
                                    </div>
                           
                                    
                            
                                   




                                     

                                    

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->

<?php if(isset($_POST["fornecedor_id"])){ ?>
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
                            <h4 class="panel-title">Lista Cadastrada</h4>
                        </div>
                      
                        <div class="panel-body">
                        <form action="preencher_orcamento.php?projeto_id=<?php echo $projeto_id ?>&lista_cotacao=<?php echo $lista_cotacao_id ?>" method="POST">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Material</th>    
                                         <th>Ultimo Orçamento</th>                                           
                                        <th>Valor por Unidade </th>
                                         <th> </th>
                                    </tr>
                                </thead>
                                <tbody>

<?php

            $fornecedor_id = $_POST["fornecedor_id"];
                                  
        
                include "conexao.php";            
               
                $query_amigo = "SELECT * FROM itens_cotacao
                                INNER JOIN insumo ON itens_cotacao.insumo_id = insumo.id                               
                                WHERE projeto_id = $projeto_id AND lista_cotacao_id = $lista_cotacao_id";
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar pacotes");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
            $insumo_id              = $buscar_amigo["insumo_id"];
            $iditens_lista          = $buscar_amigo["iditens_cotacao"];
            $descricao              = $buscar_amigo["descricao"];
         
            $busca_preco = busca_preco($fornecedor_id, $insumo_id);

            $valorCusto = $busca_preco["valorCusto"];
            $updated_at = $busca_preco["updated_at"];


          
             ?>


                                    <tr class="odd gradeX">
                                        <td><?php echo $descricao ?></td>
                                         <td><?php echo $updated_at ?></td>
                                          <td><input type="text" name="<?php echo $insumo_id ?>"
                                          value="<?php echo $valorCusto ?>" class="form-control"></td>
                                         
                                       
                                         
                                      
                                    </tr>
                                     <?php } ?>

                                     <tr>
                                     <td>
                                     <input type="hidden" name="fornecedor_id" value="<?php echo $fornecedor_id ?>">   
                                     <input type="submit" name="cadastrar" value="Salvar Lista" class="btn btn-success"></td>
                                     </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->

<?php } ?>




            </div>
            <!-- begin row -->
        
            <!-- end row -->
       
        </div>
    
     
        
        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->
<!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
     <script src="https://immobilebusiness.com.br/admin/assets/js/multiple-select.js"></script>
    <script>
        $('#select').multipleSelect();
    </script>
<script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

 <script type="text/javascript">



$(function(){
$("#qta_insumo").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

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
    <script src="https://immobilebusiness.com.br/admin/assets/js/table-manage-buttons.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
      <script src="https://immobilebusiness.com.br/admin/assets/plugins/masked-input/masked-input.min.js"></script>


        <script src="https://immobilebusiness.com.br/admin/assets/plugins/parsley/dist/parsley.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/form-wizards-validation.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

    
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            FormWizardValidation.init();
   FormPlugins.init();
            TableManageButtons.init();
        });
    </script>

</body>


</html>
