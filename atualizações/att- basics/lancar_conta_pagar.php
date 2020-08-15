<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";



if(isset($_POST["fornecedor_idfornecedor"]))
{
    date_default_timezone_set('America/Sao_Paulo');

    include "conexao.php";
    $lancamento_por          = $_POST["lancamento_por"];
    $insumo_id               = $_POST["insumo_id"];
    $tipo_venda              = $_POST["tipo_venda"];
    $fornecedor_idfornecedor = $_POST["fornecedor_idfornecedor"];
    $centrocusto_id          = $_POST["centrocusto_id"];
    $valor_parcelas          = $_POST["valor_parcelas"];
    $qtd_parcelas            = $_POST["qtd_parcelas"];
    $insumo_especie          = $_POST["insumo_especie"];
    $insumo_familia          = $_POST["insumo_familia"];
    $insumo_categoria        = $_POST["insumo_categoria"];
    $insumo_descricao        = $_POST["insumo_descricao"];
    $data_vencimento         = $_POST["data_vencimento"];
    $data_lancamento         = date('d-m-Y H:i:s');


    $oc_ci                   = $_POST["oc_ci"];
    $numero_ci               = $_POST["numero_ci"];
    $numero_boleto           = $_POST["numero_boleto"];


    $data_vencimento = date("d-m-Y", strtotime($data_vencimento));

    $valor_parcelas = str_replace("R$","", $valor_parcelas);
    $valor_parcelas = str_replace(".","", $valor_parcelas);
    $valor_parcelas = str_replace(",",".", $valor_parcelas);


    

    $idempreendimento    = $_POST["empreendimento_id"];
    $quadra              = $_POST["quadra"];
    $lote                = $_POST["lote"];

      $inseir = "INSERT INTO contrato_pagar(numero_boleto, insumo_id,fornecedor_idfornecedor, centrocusto_id, valor_parcelas, qtd_parcelas, data_vencimento, data_lancamento, empreendimento_id, quadra_id, lote_id, tipo_venda, insumo_especie, insumo_familia, insumo_categoria, insumo_descricao) values('$numero_boleto','$insumo_id','$fornecedor_idfornecedor','$centrocusto_id','$valor_parcelas','$qtd_parcelas','$data_vencimento','$data_lancamento','$idempreendimento','$quadra','$lote', '$tipo_venda','$insumo_especie','$insumo_familia','$insumo_categoria','$insumo_descricao')";

    //echo $inseir; die();


$executar = mysqli_query($db, $inseir);



$venda_idvenda = mysqli_insert_id($db);


for($i = 0; $i <= ($qtd_parcelas - 1); $i++){

if($i == 0){
    $vencimento = $data_vencimento;
}else{
$vencimento = date('d-m-Y', strtotime("+".$i." month",strtotime($data_vencimento)));
}

////// tipo de venda:   1 para aluguel,   2 para terreno,   3 para venda
$receber_aluguel = mysqli_query($db, "INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
empreendimento_id_novo,
cliente_id_novo,
data_lancamento_sistema,
lancamento_por,
numero_boleto
)

values (
'$venda_idvenda',
'$valor_parcelas',
'$vencimento',
'Em Aberto',
'Contas a Pagar',
'3',
'$centrocusto_id',
'1',
'$idempreendimento',
'$fornecedor_idfornecedor',
'$data_lancamento',
'$lancamento_por',
'$numero_boleto'

)");


} ?>


<script type="text/javascript">window.location="contas_apagar.php";</script>

 <?php } ?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]-->


<head>
	<meta charset="latin1" />
	<title>Immobile | Business</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
   <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
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
<script>
function ShowHideDIV(){

  Valor = document.getElementById("tipo_cobranca").value;

  if (Valor=="2") 
  {
    document.getElementById('locacao').style.display    = "none"
    document.getElementById('teste').style.display      = "block"
    document.getElementById('quadra2').style.display    = "block"
    document.getElementById('lote32').style.display     = "block"
    document.getElementById('etapa32').style.display    = "block"

  }
  else
  {
    document.getElementById('locacao').style.display    = "block"
    document.getElementById('teste').style.display      = "none"
    document.getElementById('quadra2').style.display    = "none"
    document.getElementById('lote32').style.display     = "none"
    document.getElementById('etapa32').style.display    = "none"

   }
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
			<?php

                        $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];
                            ?>
			<!-- begin page-header -->
			<h1 class="page-header">
            
                        
            
            Contas A Pagar</h1>
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
                            <h4 class="panel-title">Gerar Contas a Pagar</h4>
                            
                        </div>
                        <div class="panel-body">
                            <form action="lancar_conta_pagar.php" method="POST" data-parsley-validate="true" name="form_wizard">
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
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group block1">
                                                        <label>Fornecedor:</label>
                                <input type="hidden" name="lancamento_por" value="<?php echo $imobiliaria_idimobiliaria ?>">
                                                             <select class="default-select2 form-control" name="fornecedor_idfornecedor" required="">
                                        <option value="">Escolha</option>
                                          <?php

                      include "conexao.php";
                 
                $query_amigo = "SELECT * FROM cliente
                                INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                where cliente_tipo.idtipo = 2  order by nome_cli Asc";


                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar Locatário");
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

  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nº Nota Fiscal</label>
                                        <input type="text" class="form-control" name="numero_boleto" id="numero_boleto" required=""  />

                                                    </div>
                                                </div>


                                                  
                                            
                                            </div>


   <div class="row">
                                                <!-- begin col-6 -->
      <div class="col-md-12">
                                                    <div class="form-group block1">
                                                        <label>Centro de Despesa:</label>
                                        <select class="default-select2 form-control" name="centrocusto_id" required="">
                                        <option value="">Escolha</option>
                                      <?php

            
                                  

                      include "conexao.php";


                $query_amigo = "SELECT * FROM centrocobranca order by ref asc";
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Centro de cobrança");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                    $idcentro               = $buscar_amigo["idcentrocobranca"];
                    $ref                    = $buscar_amigo["ref"];
                    $desc_centro            = $buscar_amigo["descricaocentro"];
                    
            
             ?>
               <option value="<?php echo "$idcentro" ?>"> <?php echo "$ref "."/ "."$desc_centro" ?> </option>
                    <?php } ?>
                    
                                           
                                        </select>
                                                    </div>
                                                </div>                                        
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                             


                                                <!-- end col-6 -->
                                               

                                                 
                                            </div>

                                            






                                            <!-- end row -->
                                                 <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Valor da Parcela</label>
                                        <input type="text" class="form-control" name="valor_parcelas" id="valor_aluguel2" required=""  />

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Quantidade de Parcelas:</label>
                                           <input type="number" min="0" class="form-control" name="qtd_parcelas" required=""  />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Vencimento 1º Parcela</label>
                                                   <input type="date" class="form-control" name="data_vencimento"  required=""  placeholder="Data da primeira parcela" />
                                                    </div>
                                                </div>
                                            </div>
                                                  <div class="row">
                                                <!-- begin col-6 -->
                                              
                                        <div class="col-md-4" id="teste">
                                                    <div class="form-group">
                                                        <label>Empreendimento</label>
                                        <select class="form-control" name="empreendimento_id" id="os">
                                            <option value="">Escolha</option>

     
<?php 
             include "conexao.php";
             $query_c = "SELECT * FROM  empreendimento_cadastro 
                        order by idempreendimento_cadastro desc";
                        $executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento mesmo");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos
           
                $idempreendimento             = $buscar_amigoc['idempreendimento_cadastro'];
                $descricao                   = $buscar_amigoc['descricao_empreendimento'];
        ?>
                <option value="<?php echo $idempreendimento ?> "><?php echo $descricao ?></option>
      <?php }  ?>
                                        </select>


                                                    </div>
                                                </div>


                              
            
                                                 </div>


                                                   
                                        </fieldset>
                                         <p><input type="submit" class="btn btn-success btn-lg" role="button" value="Cadastrar" /></p>
                                    </div>
                                    <!-- end wizard step-1 -->
                                 
          


                              

                                    <!-- begin wizard step-2 -->
                             

                                    <!-- end wizard step-2 -->
                                    <!-- begin wizard step-3 -->
                                
                            
                                   




                                     

                                    

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


<script type="text/javascript">
    $(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#oc').change(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_oc.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'oc=' + $('#oc').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
var $lote = $('#numero_ci');
            $lote.empty();

                  

            $.each(data, function(idordem_compra){
                   $lote.append('<option value=' + idordem_compra + '>O.C: ' + idordem_compra + '</option>');
            });

              $lote.change();        
                              
    
    
                    
                       
                 
                }
           });   
   return false;    
   })
});
</script>



<script type="text/javascript">
    $(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#ci').change(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_ci.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'ci=' + $('#ci').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
var $lote = $('#numero_ci');
            $lote.empty();

                  

            $.each(data, function(idci){
                   $lote.append('<option value=' + idci + '>C.I: : ' + idci + '</option>');
            });

              $lote.change();        
                              
    
    
                    
                       
                 
                }
           });   
   return false;    
   })
});
</script>

    <script type="text/javascript">
     

$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#numero_boleto').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_boleto.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'numero_boleto=' + $('#numero_boleto').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){               
 
                    alert('Boleto já cadastrado.');
                    
                    $('#numero_boleto').val('');

                    }
                }
           });   
   return false;    
   })
});
    </script>
    <script>
        $(document).ready(function() {
            App.init();
            FormWizardValidation.init();
            TableManageButtons.init();
        });
    </script>






</body>


</html>
