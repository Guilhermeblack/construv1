<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

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
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
  <!-- ================== END BASE CSS STYLE ================== -->
  
  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->
  
  <!-- ================== BEGIN BASE JS ================== -->
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>

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
                            <form class="form-horizontal form-bordered" action="recebe_venda_imovel.php" name="cad_venda" method="POST">
                                


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

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
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

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
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
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
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
                                    <label class="col-md-3 control-label">Imovel</label>
                                    <div class="col-md-9">
                         <select class="form-control" name="imovel_idimovel" id="imovel_idimovel" required="">
                                        <option value="">Escolha</option>
                      <?php

                      include_once "conexao.php";
                $query_amigo = "SELECT * FROM imovel order by idimovel Asc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idimovel       = $buscar_amigo['idimovel'];
             $endereco       = $buscar_amigo["endereco"];
             $numero         = $buscar_amigo["numero"];
        
             
            
             ?>
                    <option value="<?php echo "$idimovel" ?>">  Ref:<?php echo "$idimovel" ?> / End. <?php echo " $endereco"." $numero" ?>  </option>
                    <?php } ?>

                                           
                                        </select>
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
    });
  </script>

</body>


</html>
