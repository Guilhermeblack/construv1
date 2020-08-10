<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

     function dados_cliente($venda_id){

  include "conexao.php";
  $busca_conta = mysqli_query($db, "SELECT nome_cli, quadra, lote, idcliente, empreendimento_cadastro_id
                    FROM venda
                    INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente
                    INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
                    INNER JOIN lote ON venda.lote_idlote = lote.idlote
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento
                    WHERE idvenda = '$venda_id'");

  while ($conta = mysqli_fetch_assoc($busca_conta)) {


            $nome_cli = $conta["nome_cli"];
            $quadra   = $conta["quadra"];
            $lote     = $conta["lote"];
            $idcliente                      = $conta["idcliente"];
            $empreendimento_cadastro_id     = $conta["empreendimento_cadastro_id"];

            $dados["nome_cli"] = $nome_cli;
            $dados["quadra"]   = $quadra;
            $dados["lote"]     = $lote;
            $dados["idcliente"]     = $idcliente;
            $dados["empreendimento_cadastro_id"]     = $empreendimento_cadastro_id;

    }

    return $dados;
}
if(isset($_POST["valor_parcelas"]))
{
    date_default_timezone_set('America/Sao_Paulo');

    include "conexao.php";
   
    $imobiliaria_idimobiliaria                = $_POST["imobiliaria_idimobiliaria"];
    $venda_id                = $_POST["venda_id"];
    $tipo_venda              = $_POST["tipo_venda"];
    $descricao_parcela       = $_POST["descricao_parcela"];
    $numero_sequencia        = $_POST["numero_sequencia"];

    $valor_parcelas          = $_POST["valor_parcelas"];
    $qtd_parcelas            = $_POST["qtd_parcelas"];   
    $data_vencimento         = $_POST["data_vencimento"];
    $observ             = $_POST['obss'];
    $data_lancamento         = date('d-m-Y H:i:s');

    $data_vencimento = date("d-m-Y", strtotime($data_vencimento));

    $valor_parcelas = str_replace("R$","", $valor_parcelas);
    $valor_parcelas = str_replace(".","", $valor_parcelas);
    $valor_parcelas = str_replace(",",".", $valor_parcelas);

    $dados_cliente = dados_cliente($venda_id);
    $cliente_id = $dados_cliente["idcliente"];
    $empreendimento_cadastro_id = $dados_cliente["empreendimento_cadastro_id"];

    




for($i = 0; $i <= ($qtd_parcelas - 1); $i++){

if($i == 0){
    $vencimento = $data_vencimento;
}else{
$vencimento = date('d-m-Y', strtotime("+".$i." month",strtotime($data_vencimento)));
}


$inseir = mysqli_query($db, "INSERT INTO parcelas(venda_idvenda, tipo_venda, data_vencimento_parcela, valor_parcelas, situacao, descricao, numero_sequencia, fluxo, centrocusto_id, empreendimento_id_novo, cliente_id_novo, lancamento_por, data_lancamento_sistema, obs_parcela) values('$venda_id', '$tipo_venda', '$vencimento', '$valor_parcelas', 'Em Aberto', '$descricao_parcela', '$numero_sequencia', 0, 1, '$empreendimento_cadastro_id', '$cliente_id', '$imobiliaria_idimobiliaria', '$data_lancamento', '$observ')");

$numero_sequencia = $numero_sequencia + 1;


} 


?>


<script type="text/javascript">window.location="parcelas.php?idvenda=<?php echo $venda_id ?>&tipo=<?php echo $tipo_venda ?>";</script>

 <?php } ?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
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
	<?php include "topo.php" ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<?php

                        $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];

                        $venda_id    = $_POST["idvenda"];
                        $tipo_venda  = $_POST["tipo"];
                            ?>
			<!-- begin page-header -->
			<h1 class="page-header">
            
                        
            
            Adicionar Parcelas </h1>
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
 <?php $dados_cliente = dados_cliente($venda_id); ?>
                            <h4 class="panel-title"><?php echo $dados_cliente["nome_cli"] ?> - <?php echo $dados_cliente["quadra"] ?>/<?php echo $dados_cliente["lote"] ?></h4>
                            
                        </div>
                        <div class="panel-body">
                            <form action="parcelas_adicionar.php" method="POST" data-parsley-validate="true" name="form_wizard">
                                <input type="hidden" name="imobiliaria_idimobiliaria" value="<?php echo $imobiliaria_idimobiliaria ?>">

                                 <input type="hidden" name="venda_id" value="<?php echo $venda_id; ?>">
                        <input type="hidden" name="tipo_venda" value="<?php echo $tipo_venda; ?>">
                                <div id="wizard">
                                    <ol>
                                        <li>
                                            Informações
                                            <small></small>
                                        </li>
                                     
                                       
                                       
                                    </ol>
                                           <div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">Identificação</legend>
                                            <!-- begin row -->
                                         

                                   

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
                                           <input type="number" class="form-control" name="qtd_parcelas" id="prazo_contrato" required=""  />
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Descrição</label>
                                        <input type="text" class="form-control" name="descricao_parcela"  required=""  />

                                                    </div>
                                                </div>

                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Numero da Parcela</label>
                                        <input type="text" class="form-control" name="numero_sequencia"  required=""  />

                                                    </div>
                                                </div>

                                         <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Observaçoes</label>
                                        <input type="text" class="form-control" name="obss"/>

                                                    </div>
                                                </div>




                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                              
                                                <!-- end col-6 -->
                                              
                                            </div>
                                                  

                                                   
                                        </fieldset>
                                         <p><input type="submit" class="btn btn-success btn-lg" role="button" value="Cadastrar" /></p>
                                    </div>
                                    <!-- end wizard step-1 -->
                                 
          
                                 
          


                              

                            
                                   




                                     

                                    

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


//$(function(){
// $("#prazo_contrato").maskMoney({symbol:'', 
// showSymbol:true, decimal:'.', symbolStay: true});
//  })

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
