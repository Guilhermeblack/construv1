<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:13:18 GMT -->
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
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
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
             ?>
			<!-- begin page-header -->
			<h1 class="page-header">Simulador Price</h1>
			<!-- end page-header -->
			<?php if(isset($_POST["valor_total"])){

                    $valor_total = $_POST["valor_total"];
                    $entrada     = $_POST["entrada"];
                    $prestacoes  = $_POST["prestacoes"];
                    $taxa_juros  = $_POST["taxa_juros"];
                }
                    ?>
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-11">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Informações:</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" action="simulador_price.php" method="POST">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Valor</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?php echo $valor_total ?>" id="entrada" name="valor_total" placeholder="Valor" />

                                       
                                    </div>
                                </div>

                          		<div class="form-group">
                                    <label class="col-md-3 control-label">Entrada</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?php echo $entrada ?>" id="entrada2" name="entrada" placeholder="Entrada" />
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label class="col-md-3 control-label">Nº Prestações</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php echo $prestacoes ?>" class="form-control" name="prestacoes" placeholder="Nº Prestações" />
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Taxa de Juros</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="entrada3" value="<?php echo $taxa_juros ?>" name="taxa_juros" placeholder="Taxa de Juros (%) ao Mês" />
                                    </div>
                                </div>




                              






                         
                        </div>
                    </div>
                    <!-- end panel -->
                </div>

                


                 
    	
                  <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                          
                         
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                            
                                    <div class="col-md-9">
                                       <input type="submit" class="btn btn-success m-r-5 m-b-5" value="Calcular" />
                                    </div>
                                </div>



                               



                                

                        </div>
                    </div>
                    <!-- end panel -->

                       </form>
                </div>

                <?php if(isset($_POST["valor_total"])){

                    $valor_total = $_POST["valor_total"];
                    $entrada     = $_POST["entrada"];
                    $prestacoes  = $_POST["prestacoes"];
                    $taxa_juros  = $_POST["taxa_juros"];


$valor_total1 = str_replace("R$","", $valor_total);
$valor_total2 = str_replace(".","", $valor_total1);
$valor_total3 = str_replace(",00","", $valor_total2);   


$entrada2 = str_replace("R$","", $entrada);
$entrada3 = str_replace(".","", $entrada2);
$entrada4 = str_replace(",00","", $entrada3);
include "price.php";

$valor = ($valor_total3 - $entrada4);
$parcelas = $prestacoes;
$Juros    =  $taxa_juros;

$pgto = Price($valor, $parcelas, $Juros);



$juros = ($taxa_juros/100);




                 ?>
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-4">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Valor da Parcela: <?php echo ' R$ ' . number_format(Price($valor, $parcelas, $Juros), 2, ',', '.'); ?> </h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Prestação</th>
                                        <th>Juros</th>
                                        <th>Amortização</th>
                                        <th>Saldo Devedor</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php 
                            for($i = 0; $i <= $parcelas; $i++){
    
    if($i == 0){
        $saldo_devedor = $valor;
        $pgto = 0;
        $juros_amort = 0;
        $amort = 0;


    }else{

        $pgto = Price($valor, $parcelas, $Juros);

        $juros_amort = $saldo_devedor * $juros;
        $saldo_devedor = $saldo_devedor - $pgto + $juros_amort;
        
        $amort = $pgto - $juros_amort;


        $cont_prestacao = $cont_prestacao + $pgto;
        $cont_juros = $cont_juros + $juros_amort;
        $cont_amort = $cont_amort + $amort;

    } ?>

                                    <tr>
    <td> <?php echo $i; ?></td>
    <td> <?php echo 'R$' . number_format($pgto, 2, ',', '.'); ?></td>
    <td> <?php echo 'R$' . number_format($juros_amort, 2, ',', '.'); ?></td>
    <td>  <?php echo 'R$' . number_format($amort, 2, ',', '.'); ?> </td>
    <td> <?php echo 'R$' . number_format($saldo_devedor, 2, ',', '.'); ?></td>
</tr>

<?php } ?>
        <tr>
    <td>TOTAL</td>
    <td> <?php echo 'R$' . number_format($cont_prestacao, 2, ',', '.'); ?></td>
    <td> <?php echo 'R$' . number_format($cont_juros, 2, ',', '.'); ?></td>
    <td>  <?php echo 'R$' . number_format($cont_amort, 2, ',', '.'); ?> </td>
    <td> <?php echo 'R$' . number_format(0, 2, ',', '.'); ?></td>
</tr>                           

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                 
                </div>
                <?php } ?>

            </div>
            <!-- end row -->
       
		</div>
	
     
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

 <script type="text/javascript">
$(function(){

$("#entrada").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 

$("#entrada2").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});

$("#entrada3").maskMoney({symbol:'', 
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
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

        <script type='text/javascript' src='cep.js'></script>
	
	<script>
		$(document).ready(function() {
			App.init();
			FormPlugins.init();
		});
	</script>

</body>

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:13:18 GMT -->
</html>
