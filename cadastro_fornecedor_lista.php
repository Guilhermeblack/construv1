<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";


if(isset($_POST["fornecedor"]))
{
    $fornecedor = $_POST["fornecedor"];
    $insumos    = $_POST["insumos"];
    $projeto_id = $_GET["projeto_id"];
    $data_cotacao = date('d-m-Y');


    include "conexao.php";

    $insere_lista = mysqli_query($db, "INSERT INTO lista_cotacao (projeto_id, data_cotacao) values ('$projeto_id','$data_cotacao')");

    $lista_id = mysqli_insert_id($db);

    foreach($fornecedor as $idfornecedor){

              $inserir_tipo = mysqli_query($db,"INSERT INTO fornecedor_lista (lista_cotacao_id, fornecedor_id) 
                values ('$lista_id','$idfornecedor')");
          }
    

    foreach($insumos as $idinsumos){

              $inserir_tipo2 = mysqli_query($db,"INSERT INTO itens_cotacao (projeto_id, lista_cotacao_id, insumo_id) values ('$projeto_id','$lista_id','$idinsumos')");
          }

    ?>

<script type="text/javascript">window.location="quantidade_itens_cotacao.php?projeto_id=<?php echo $projeto_id ?>&lista_cotacao_id=<?php echo $lista_id ?>";</script>


<?php 


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

<script type="text/javascript">
function receber(){

document.nome.action = "fornecedores_lista.php";
document.nome.submit();

}
    function verificaStatus(nome){
    if(nome.form.tudo.checked == 0)
        {
            nome.form.tudo.checked = 1;
            marcarTodos(nome);
        }
    else
        {
            nome.form.tudo.checked = 0;
            desmarcarTodos(nome);
        }
}
 
function marcarTodos(nome){
   for (i=0;i<nome.form.elements.length;i++)
      if(nome.form.elements[i].type == "checkbox")
         nome.form.elements[i].checked=0
}
 
function desmarcarTodos(nome){
   for (i=0;i<nome.form.elements.length;i++)
      if(nome.form.elements[i].type == "checkbox")
         nome.form.elements[i].checked=1
}
</script>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
    <?php include "topo.php" ?>
        <!-- end #sidebar -->
        
        <!-- begin #content -->
        <div id="content" class="content">
           
            <!-- begin page-header -->
            <h1 class="page-header">Locação de Imóvel</h1>
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
                            <h4 class="panel-title">Gerar Contrato</h4>
              <?php 

              $projeto_id = $_GET["projeto_id"];

              ?>              
                        </div>
                        <div class="panel-body">
                            <form action="cadastro_fornecedor_lista.php?projeto_id=<?php echo $projeto_id ?>" method="POST" data-parsley-validate="true" id="nome" name="nome">
                                <div id="wizard">
                                    <ol>
                                        <li>
                                            Identificação
                                            <small></small>
                                        </li>
                                      
                                       
                                       
                                    </ol>
                                    <!-- begin wizard step-1 -->
                                    <div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">Identificação</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                       <div class="col-md-4">
                                                   
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Fornecedores:</label>
                                                           <select multiple="multiple" name="fornecedor[]" id="select">
                                       
                                          <?php

                      include "conexao.php";
               
                    $query_amigo = "SELECT * FROM cliente
                                    INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                    INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                    where cliente_tipo.idtipo = 2 order by nome_cli Asc";

                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar Fiadores");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcliente             = $buscar_amigo['idcliente'];
             $nome_cli              = $buscar_amigo["nome_cli"];
             $cpf_cli               = $buscar_amigo["cpf_cli"];
        
             
            
             ?>
               <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
                    <?php } ?>
                    
                                           
                                        </select>
                                                    </div>
                                                </div>
                                           
                                            </div>
                                  <div class="row">
               <?php if (in_array('38', $idrota)) { ?>
                <!-- begin col-10 -->
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
                            <h4 class="panel-title">Lista de Insumos </h4>
                        </div>
                      
                        <div class="panel-body">
                         
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th> 
                                    <input type='checkbox' name='tudo' onclick="verificaStatus(this)" /></th>
                                        <th>INSUMO </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                                      


<?php

            
                                  
        
                include "conexao.php";    

                $query_amigo2 = "SELECT * FROM projeto_etapa
                                INNER JOIN pacotes ON pacotes.id = projeto_etapa.pacotes_id
                                WHERE projeto_id = $projeto_id order by nome";
                $executa_query2 = mysqli_query ($db,$query_amigo2) or die ("Erro ao listar itebs da lista");
                
                
            while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query2)) {//--verifica se são amigos
           
            $nome               = $buscar_amigo2['nome'];
            $pacotes_id2            = $buscar_amigo2['id'];


?>

<tr class="odd gradeX">
                                        
                                          <td colspan="2"><span class="label label-primary" style="font-size:100% !important"><?php echo $nome ?></span></td>
                                       
                                   
                                         
                                      
                                    </tr>






<?php
               
                $query_amigo = "SELECT * FROM itens_lista
                                INNER JOIN insumo ON insumo.id = itens_lista.insumo_id
                                WHERE projeto_id = $projeto_id AND pacotes_id = $pacotes_id2 order by descricao";
                                
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar itebs da lista");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $descricao              = $buscar_amigo['descricao'];
            $insumo_id              = $buscar_amigo['insumo_id'];
         

           
          
             ?>


                                    <tr class="odd gradeX">
                                        <td><input type="checkbox" name="insumos[]" value="<?php echo $insumo_id ?>"> </td>
                                        <td><?php echo $descricao ?></td>
                                       <td></td>
                                         
                                         
                                      
                                    </tr>
                                     <?php } } ?>
                                </tbody>
                                </form>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->


<?php } ?>






            </div>
                                               
                                               
                                        </fieldset>
                                           <p><input type="submit" class="btn btn-success btn-lg" role="button" value="Cadastrar" /></p>
                                    </div>
                        
                            
                                   



                                     

                                    

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
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
$("#valor_aluguel2").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_iptu").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_condominio").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_alugueis").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })
$(function(){
$("#valor_danos").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_seguro").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_repasse").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })


$(function(){
$("#prazo_contrato").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#qtd_parcelas_iptu").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#qtd_parcelas_condominio").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#qtd_parcelas_garantia_aluguel").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#qtd_parcelas_garantia_danos").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#qtd_parcelas_seguro").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#meses_repasse").maskMoney({symbol:'', 
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
