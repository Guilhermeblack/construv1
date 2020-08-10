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
      
<!--  inclusao para select dinamico
 -->    <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
          <link href="https://immobilebusiness.com.br/admin/assets/css/multiple-select.css" rel="stylesheet"/>


   <!--     <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" /> -->
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
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
	
<?php

function retorna_tipo($idimobiliaria)
{           include "conexao.php";
            $query_amigo_cli = "SELECT * FROM cliente
                                WHERE idcliente = $idimobiliaria";
        
            $executa_query_cli = mysqli_query($db,$query_amigo_cli);
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {//--verifica se são amigos
               
                 
                $imob_id           = $buscar_amigo["imob_id"];
                
           
               
            }

            return $imob_id;


}









 $idvenda = $_GET["idvenda"];
                      include "conexao.php";
                $query_amigo = "SELECT * FROM venda                
                INNER JOIN lote ON lote.idlote = venda.lote_idlote
                INNER JOIN produto ON  lote.produto_idproduto = produto.idproduto
                INNER JOIN empreendimento ON  produto.empreendimento_idempreendimento = empreendimento.idempreendimento
                
                where venda.idvenda = $idvenda";

                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar cliente");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            

$idimobiliaria                = $buscar_amigo["imobiliaria_idimobiliaria"];
$idlote                       = $buscar_amigo["lote_idlote"];
$lote                         = $buscar_amigo["lote"];
$m2                           = $buscar_amigo["m2"];
$frente                       = $buscar_amigo["frente"];
$fundo                        = $buscar_amigo["fundo"];
$esquerda                     = $buscar_amigo["esquerda"];
$direita                      = $buscar_amigo["direita"];

$quadra                       = $buscar_amigo["quadra"];
$valor                        = $buscar_amigo["valor"];
        
$valor_total_entrada3         = $buscar_amigo["valor_entrada"]; 
$valor_desconto               = $buscar_amigo["valor_desconto"];      
$valor_total_entrada4         = $buscar_amigo["entrada_restante"]; 
$parcela_entrada              = $buscar_amigo["parcela_entrada"];
$plano_pagamento              = $buscar_amigo["plano_pagamento"];
$valor_parcela_financiamento  = $buscar_amigo["valor_parcela_financiamento"];
$valor_parcela_entrada        = $buscar_amigo["valor_parcela_entrada"];

$vencimento_primeira          = $buscar_amigo["vencimento_primeira"];
$vencimento_restante          = $buscar_amigo["vencimento_restante"];
$idempreendimento             = $buscar_amigo["empreendimento_idempreendimento"]; 

$valor_total_entrada          = $valor_total_entrada3 + $valor_total_entrada4;

   

   
   
   
           }




            $query_amigo_cli = "SELECT * FROM empreendimento_imob
                                WHERE empreendimento_id = $idempreendimento AND imobiliaria_id = $idcliente ";
        
            $executa_query_cli = mysqli_query ($db,$query_amigo_cli);
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {//--verifica se são amigos
               
                 
                $dias_repasse           = $buscar_amigo["dias_repasse"];
                
                $dia_final_repasse = date('d-m-Y', strtotime("+".$dias_repasse." day",strtotime($vencimento_primeira)));
               
            }



           
             ?>	
		<!-- begin #content -->
		<div id="content" class="content">
			
			<!-- begin page-header -->
			<h1 class="page-header">Lançar Contrato Empreendimento</h1>
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
                            <h4 class="panel-title"><?php echo "$quadra "."/ "."$lote" ?></h4>
               
                        </div>
                        <div class="panel-body">
                            <form action="confirmar.php?idvenda=<?php echo $idvenda ?>&idempreendimento=<?php echo $idempreendimento ?>&idlote=<?php echo $lote_idlote ?>" method="POST" data-parsley-validate="true" name="form_wizard">
                                <div id="wizard">

<input type="hidden" name="lancado_por" value="<?php echo $imobiliaria_idimobiliaria ?>">

                                    <ol>
                                        
                                         <li>
                                           Informações de Comissão / Repasse

                                            <small></small>
                                        </li>
                                       
                                       
                                    </ol>
                                   


                                    <div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full"> Informações de Comissão da Venda do lote
</legend>
                                                <div class="row">
                                            
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                      
                                    <?php 
                                    $imob_id = retorna_tipo($idimobiliaria);

                                    if($imob_id != ''){
                                        if($imob_id == '958'){
                                            $comissao = $idimobiliaria;
                                        }else{
                                            $comissao = $imob_id;
                                        }
                                    }else{
                                        $comissao = $idimobiliaria;
                                    }

                                     ?>                 
                                            <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label>Comissão Para</label>
                <select class="default-select2 form-control" name="comissao_para">
                                        <option value="">Escolha</option>
                      <?php

                      include "conexao.php";
                
           
                $query_amigo = "SELECT * FROM cliente
                                INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                                WHERE idtipo = 8 or idtipo = 11 group by cliente.idcliente order by nome_cli Asc";
            

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                $idcliente              = $buscar_amigo['idcliente'];
                $nome_cli               = $buscar_amigo["nome_cli"];
              
        
             
            
             ?>
                    <option value="<?php echo "$idcliente" ?>" <?php if($idcliente == $comissao){ ?> selected  <?php } ?> > <?php echo "$nome_cli" ?> </option>
                    <?php } ?>

                                           
                                        </select>
                                              
                                                <!-- end col-4 -->





                                
                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                   <div class="col-md-6">
                                                    <div class="form-group">

                                                       
                                                        <div class="controls">
 <div class="alert alert-danger m-b-0">
 Valor do Lote:

<input type="hidden" name="valor_venda" value="<?php echo $valor_desconto ?>">


                                <h4 class="block"> <?php echo ' R$' . number_format($valor_desconto, 2, ',', '.'); ?></h4>
                                
                            </div>
                                                    

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- begin col-4 -->
                                              
                                                
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                               
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- begin row -->
                                            <div class="row">

                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>% de Comissão</label>
                                                        <div class="controls">
                               <input type="text" class="form-control" id="comissao_imob_empreendimento"   name="comissao_imob_empreendimento" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Quantidade  de Parcelas</label>
                                                        <div class="controls">
                                                          <input type="text" id="quantidade_parcelas_repasse" class="form-control" name="quantidade_parcelas_repasse" />   
                                                        </div>
                                                    </div>
                                                </div>
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Vencimento 1º Comissão</label>
                                                        <div class="controls">
                                                          <input type="date" class="form-control" name="vencimento_primeira_repasse" value="<?php echo $dia_final_repasse ?>" />   
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                               
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->

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
        <script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

         <script type="text/javascript">
$(function(){



$("#comissao_imob_empreendimento").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});

$("#quantidade_parcelas_repasse").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});

$("#repasse_venda").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});

$("#repasse_parcelas").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});



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
    <script src="https://immobilebusiness.com.br/admin/assets/js/table-manage-buttons.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

        <script src="https://immobilebusiness.com.br/admin/assets/plugins/parsley/dist/parsley.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/form-wizards-validation.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

           <script type='text/javascript' src='cep.js'></script>
          <script type='text/javascript' src='produtos.js'></script>
     <script type='text/javascript' src='lote.js'></script>
         <script type='text/javascript' src='medidas.js'></script>
 <script type='text/javascript' src='cep.js'></script>



    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            FormWizardValidation.init();
            TableManageButtons.init();
             FormPlugins.init();
        });
    </script>

</body>

</html>
