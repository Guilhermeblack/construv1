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

   <script>

function descontoss(){


var valor = document.cad_venda.valor.value
var desconto = document.cad_venda.desconto.value


var result = (valor - ((desconto/100) * valor)) 
document.cad_venda.valor_desconto.value = result 
document.cad_venda.valor_desconto2.value = result 
}


function calcula(){



var entrada = document.cad_venda.entrada.value
var entrada2 = entrada.replace("R$","")
var entrada3 = entrada2.replace(".","")
var entrada4 = entrada3.replace(" ","")
var entrada5 = entrada4.replace(",",".")

var entrada_restante = document.cad_venda.entrada_restante.value
var entrada_restante2 = entrada_restante.replace("R$","")
var entrada_restante3 = entrada_restante2.replace(".","")
var entrada_restante4 = entrada_restante3.replace(" ","")
var entrada_restante5 = entrada_restante4.replace(",",".")


var valor = document.cad_venda.valor_desconto.value



var result = (valor - entrada5 - entrada_restante5)
document.cad_venda.valor_para_parcelamento.value = result 
document.cad_venda.valor_para_parcelamento2.value = result 



}

function entrada_demais(){


var entrada = document.cad_venda.entrada.value
var entrada2 = entrada.replace("R$","")
var entrada3 = entrada2.replace(".","")
var entrada4 = entrada3.replace(" ","")
var entrada5 = entrada4.replace(",",".")

var entrada_restante = document.cad_venda.entrada_restante.value
var entrada_restante2 = entrada_restante.replace("R$","")
var entrada_restante3 = entrada_restante2.replace(".","")
var entrada_restante4 = entrada_restante3.replace(" ","")
var entrada_restante5 = entrada_restante4.replace(",",".")


var valor = document.cad_venda.valor_desconto.value

var total_entrada = parseInt(entrada_restante5) + parseInt(entrada5)

var porcentagem = parseInt(valor)*15/100

if ( total_entrada < porcentagem){
document.cad_venda.entrada.value= "";
document.cad_venda.entrada_restante.value= "";
  alert( "O Valor da Entrada deve ser no Minimo 15% do valor do Lote" );

return false;
}
}


</script>

 

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
			
			<!-- begin page-header -->
			<h1 class="page-header">
			
			
			<?php 

			if(isset($_GET["venda"])){
				echo "Atencao, outra vendedor ja vendeu este lote antes de voce. Tente vender outro lote.";
			}

			?>
			
			
			Cadastro de Venda </h1>
			<!-- end page-header -->
			
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
                            <h4 class="panel-title">Informações da Venda</h4>
                            <?php

           $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];
             ?>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" action="recebe_venda.php" name="cad_venda" method="POST">
                                


                                     <div class="form-group">
                                    <label class="col-md-3 control-label">Cliente 1</label>
                                    <div class="col-md-9">
                         <select class="default-select2 form-control" name="cliente_idcliente" required="">
                                        <option value="">Escolha</option>
                      <?php

                      include_once "conexao.php";
                 if($idpai == 0){
                $query_amigo = "SELECT * FROM cliente
 INNER JOIN imobiliaria ON cliente.imobiliaria_idimobiliaria = imobiliaria.idimobiliaria

                WHERE imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria OR idpai = $imobiliaria_idimobiliaria order by nome_cli Asc";

}else{

 $query_amigo = "SELECT * FROM cliente
                WHERE imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria order by nome_cli Asc";

}

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcliente             = $buscar_amigo['idcliente'];
             $nome_cli              = $buscar_amigo["nome_cli"];
              $cpf_cli              = $buscar_amigo["cpf_cli"];
        
             
            
             ?>
                    <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
                    <?php } ?>

                                           
                                        </select>
                                    </div>
                                </div>

 <div class="form-group">
                                    <label class="col-md-3 control-label">Cliente 2</label>
                                    <div class="col-md-9">
                         <select class="default-select2 form-control" name="cliente_idcliente2">
                                        <option value="">Escolha</option>
                      <?php

                      include_once "conexao.php";
                 if($idpai == 0){
                $query_amigo = "SELECT * FROM cliente
 INNER JOIN imobiliaria ON cliente.imobiliaria_idimobiliaria = imobiliaria.idimobiliaria

                WHERE imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria OR idpai = $imobiliaria_idimobiliaria order by nome_cli Asc";

}else{

 $query_amigo = "SELECT * FROM cliente
                WHERE imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria order by nome_cli Asc";

}

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcliente             = $buscar_amigo['idcliente'];
             $nome_cli              = $buscar_amigo["nome_cli"];
              $cpf_cli              = $buscar_amigo["cpf_cli"];
        
             
            
             ?>
                    <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
                    <?php } ?>

                                           
                                        </select>
                                    </div>
                                </div>






<!-- corretor -->
  <div class="form-group">
                                    <label class="col-md-3 control-label">Corretor</label>
                                    <div class="col-md-9">
                         <select class="default-select2 form-control" name="imobiliaria_idimobiliaria" required="">
                                        <option value="">Escolha</option>
                      <?php

                      include_once "conexao.php";
                
                $query_amigo = "SELECT * FROM imobiliaria
                 WHERE idimobiliaria = $imobiliaria_idimobiliaria OR idpai = $imobiliaria_idimobiliaria order by nome_imob Asc";
                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idimobiliaria          = $buscar_amigo['idimobiliaria'];
             $nome_imob              = $buscar_amigo["nome_imob"];
              
        
             
            
             ?>
                    <option value="<?php echo "$idimobiliaria" ?>"> <?php echo "$nome_imob" ?> </option>
                    <?php } ?>

                                           
                                        </select>
                                    </div>
                                </div>
<!-- fim corretor -->
                                     <div class="form-group">
                                    <label class="col-md-3 control-label">Empreendimento</label>
                                    <div class="col-md-9">
                         <select class="form-control" name="os" id="os" required="">
                                        <option value="">Escolha</option>
                      <?php

                      include_once "conexao.php";
                $query_amigo = "SELECT * FROM empreendimento order by idempreendimento Desc";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idempreendimento       = $buscar_amigo['idempreendimento'];
             $descricao              = $buscar_amigo["descricao"];
        
             
            
             ?>
                    <option value="<?php echo "$idempreendimento" ?>"> <?php echo "$descricao" ?> </option>
                    <?php } ?>

                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Quadra</label>
                                    <div class="col-md-9">
                                        <select name="quadra" id="quadra" class="form-control" required="">
                                          

                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Lote</label>
                                    <div class="col-md-9">
                                        <select name="lote" required="" id="lote" class="form-control">
                                          

                                        </select>
                                    </div>
                                </div>



                                 <div class="form-group">
									<label class="control-label col-md-3">Medidas</label>
									<div class="col-md-8">
									M² <input type="text" class="form-control" name="idproduto" id="m2" /><br>
                                    
									</div>
								</div>


                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Valor</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="valor" disabled="disabled" />
                                    </div>
                                </div>

 <div class="form-group">
                                    <label class="col-md-3 control-label">Desconto</label>
                                    <div class="col-md-9">
                                       <select class="form-control" id="desconto" onblur="descontoss()" name="desconto" required="">
                                       
                    <option value="">Selecione</option> 
                  <option value="0.0">0%</option>
                   
                  
                    <option value="15.0">15%</option>
                  
                                         
                                        </select>
                                    </div>
                               </div>
                          <div class="form-group">
                                    <label class="col-md-3 control-label">Valor Com Desconto</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="valor_desconto2" disabled="disabled" />
                                        <input type="hidden" class="form-control" name="valor_desconto" id="valor_desconto" />
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
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Entrada</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                    <label class="col-md-3 control-label">Entrada / Sinal</label>
                                    <div class="col-md-9">
                                        <input type="text"  class="form-control" id="entrada"  name="entrada" onblur="calcula()" placeholder="(Somente Números: ex 8000)" />

                               
                                    </div>
                                </div>


                             <div class="form-group">
                                    <label class="col-md-3 control-label">Entrada</label>
                                    <div class="col-md-9">
                                        <input type="text" required=""  class="form-control" id="entrada_restante"  name="entrada_restante" onblur="calcula()" placeholder="(Somente Números: ex 8000)" />

                               
                                    </div>
                                </div>


                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Parcelamento Entrada</label>
                                    <div class="col-md-9">
                         <select class="form-control" required="" name="parcela_entrada" onClick="entrada_demais()">
                                       
                    <option value="">Selecione</option> 
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                  <option value="9">9</option>
 <option value="10">10</option>
                                           
                                        </select>
                                    </div>
                                </div>


                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Vencimento 1º Parcela </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="vencimento_primeira" id="masked-input-date" required=""  placeholder="Vencimento 1º Parcela" />
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Vencimento Restante das Parcelas </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="vencimento_demais" id="masked-input-date2" required=""  placeholder="Vencimento Restante das Parcelas" />
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
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Financiamento</h4>
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                                    <label class="col-md-3 control-label">Valor para Parcelamento </label>
                                    <div class="col-md-9">
                   <input type="text" class="form-control" disabled="disabled"  name="valor_para_parcelamento2" placeholder="Valor para Parcelamento" />
                    <input type="hidden" class="form-control"  name="valor_para_parcelamento" placeholder="Valor para Parcelamento" />

                                        </div>
                                </div>



                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Plano de Pagamento</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="plano_pagamento" placeholder="Plano de Pagamento " />
                                    </div>
                                </div>




                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Taxa de Financiamento</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="1.0" name="taxa_financiamento" placeholder="Taxa de Financiamento" />
                                    </div>
                                </div>



                                 

                            
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
    	
                  <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                          
                         
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                            
                                    <div class="col-md-9">
                                       <input type="submit" class="btn btn-success m-r-5 m-b-5" value="Cadastrar" />
                                    </div>
                                </div>



                               



                                

                        </div>
                    </div>
                    <!-- end panel -->

                       </form>
                </div>




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
 })

$(function(){
$("#entrada_restante").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
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
          <script type='text/javascript' src='produtos.js'></script>
	 <script type='text/javascript' src='lote.js'></script>
         <script type='text/javascript' src='medidas.js'></script>

	<script>
		$(document).ready(function() {
			App.init();
			FormPlugins.init();
		});
	</script>

</body>

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:13:18 GMT -->
</html>
