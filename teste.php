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
		
		<!-- begin #content -->
		<div id="content" class="content">
			
			<!-- begin page-header -->
			<h1 class="page-header">
			<?php 

			if(isset($_GET["venda"])){
				echo "Erro: Este Imovel já está com o status de Alugado!.";
			}

			?>
			
						
			
			Locação de Imóvel</h1>
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
                            <h4 class="panel-title">Informações</h4>
                            <?php

                        $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];
                            ?>
                                                    </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" action="recebe_locacao.php" name="cad_venda" method="POST">
                                


                                     <div class="form-group">
                                    <label class="col-md-3 control-label">LOCATÁRIO(A):</label>
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
                                    <label class="col-md-3 control-label">Fiador 1</label>
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


  <div class="form-group">
                                    <label class="col-md-3 control-label">Fiador 2</label>
                                    <div class="col-md-9">
                         <select class="default-select2 form-control" name="cliente_idcliente3">
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
                                    <label class="col-md-3 control-label">Imóvel</label>
                                    <div class="col-md-9">
                         <select class="form-control" name="imovel_idimovel" id="imovel_idimovel" required="">
                                        <option value="">Escolha</option>
                                         <?php

                      include_once "conexao.php";
                $query_amigo = "SELECT * FROM imovel where finalidade ='Aluguel' order by ref Asc";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idimovel       = $buscar_amigo['idimovel'];
             $ref            = $buscar_amigo["ref"];
        
             
            
             ?>
                    <option value="<?php echo "$idimovel" ?>"> <?php echo "$ref" ?> </option>
                    <?php } ?>

                    
                                           
                                        </select>
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
                            <h4 class="panel-title">Contrato</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                    <label class="col-md-3 control-label">Valor Inicial</label>
                                    <div class="col-md-9">
                            <input type="text"  class="form-control" id="valor_inicial2"  name="valor_inicial" placeholder="Valor das primeiras mensalidades" />

                               
                                    </div>
                                </div>


                             <div class="form-group">
                                    <label class="col-md-3 control-label">Prazo Inicial</label>
                                    <div class="col-md-9">
                                        <input type="text" required=""  class="form-control" id="prazo_inicial"  name="prazo_inicial" placeholder="Prazo em meses das mensalidades iniciais" />

                               
                                    </div>
                                </div>


                                 
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Valor Aluguel </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="valor_aluguel" id="valor_aluguel2" required=""  placeholder="Valor da mensalidade do Aluguel" />
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Prazo do Contrato </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="prazo_contrato" id="prazo_contrato" required=""  placeholder="Prazo em meses do contrato" />
                                    </div>
                                </div>
                                                        <div class="form-group">
                                    <label class="col-md-3 control-label">Data 1º Parcela </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="primeira_parcela" id="masked-input-date" required=""  placeholder="Data da primeira parcela" />
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
$("#valor_inicial2").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_aluguel2").maskMoney({symbol:'R$ ', 
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

        

	<script>
		$(document).ready(function() {
			App.init();
			FormPlugins.init();
		});
	</script>

</body>

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:13:18 GMT -->
</html>
