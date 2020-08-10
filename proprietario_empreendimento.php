<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

	$venda_idvenda = $_GET["venda_idvenda"];
		$idempreendimento_cadastro = $_GET["idempreendimento"];




if(isset($_POST["percentual"])){
;
	$percentual 	    = $_POST["percentual"];
	$cliente_id 	    = $_POST["cliente_id"];
	$cod_cessao 	    = $_POST["cod_cessao"];

 
	include "conexao.php";

	$inserir = mysqli_query($db, "INSERT INTO proprietarios_lote (venda_id, cliente_id, percentual, cod_cessao) values ('$venda_idvenda','$cliente_id','$percentual','$cod_cessao')");
}







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
    
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
          <link href="https://immobilebusiness.com.br/admin/assets/css/multiple-select.css" rel="stylesheet"/>


	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />









	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
	
	<?php  include "topo.php"; ?>

	<?php

	function busca_locador($venda_idvenda){

		include "conexao.php";
		$busca = "SELECT cliente_idcliente FROM venda WHERE idvenda = $venda_idvenda";
		$executa = mysqli_query($db, $busca);

		 while ($row_comissao = mysqli_fetch_assoc($executa)) {
        
        $cliente_idcliente = $row_comissao['cliente_idcliente'];

    	} 

    	return $cliente_idcliente;

	}
 function cod_cessao($idvenda, $idtitular)
{


    include "conexao.php";
       $query_amigo = "SELECT cod_cessao from proprietarios_lote WHERE venda_id = $idvenda AND cliente_id = $idtitular";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar dados contrato");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $cod_cessao           = $buscar_amigo["cod_cessao"];                 
                                     
            }
    	

    return $cod_cessao;

}
$idtitular  = busca_locador($venda_idvenda);
$cod_cessao = cod_cessao($venda_idvenda, $idtitular);
	?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		
				
			<!-- end breadcrumb -->
			<!-- begin page-header -->
		
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">



			    <!-- begin col-6 -->
			    <div class="col-md-12">
				<ul class="nav nav-tabs">
						<li class=""><a href="ver_contrato_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>" >Resumo</a></li>
<li class=""><a href="cessao_contrato.php?idvenda=<?php echo $venda_idvenda ?>&idempreendimento=<?php echo $idempreendimento_cadastro ?>">Cessão</a></li>
<li class=""><a href="#">Distrato</a></li>
<li class=""><a href="ocorrencias_empreendimento.php?idempreendimento=<?php echo $idempreendimento_cadastro ?>&idvenda=<?php echo $venda_idvenda ?>">Ocorrências</a></li>
<li class=""><a href="documentos_empreendimento.php?idempreendimento=<?php echo $idempreendimento_cadastro ?>&idvenda=<?php echo $venda_idvenda ?>">Documentos</a></li>
<li class="active"><a href="proprietario_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>&idempreendimento=<?php echo $idempreendimento_cadastro ?>">Proprietários</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="default-tab-1">



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
                            <h4 class="panel-title">Cadastro de Proprietários</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" action="proprietario_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>" method="POST">
                               
                                                        		  

                                  <div class="form-group">
                            
                                    <div class="col-md-9">
                                    	<input type="hidden" name="cod_cessao" value="<?php echo $cod_cessao ?>">
                                         <select class="default-select2 form-control" name="cliente_id" required>
                                            <option value="">Selecione</option>
                                        
                                       
                                        <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM cliente
                                                 INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                                 INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                                 where cliente_tipo.idtipo = 4 or cliente_tipo.idtipo = 3 group by cliente.idcliente
") or die ("Erro ao listar Locador, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {
           
             $idcliente  = $buscar_slide["idcliente"];
             $nome_cli   = $buscar_slide["nome_cli"];

                    ?> 
                                            <option value="<?php echo $idcliente ?>"><?php echo $nome_cli ?></option>
                                           <?php } ?>
                                           

                                        </select>
                                    </div>
                                </div>


                                  <div class="form-group">
                            
                                    <div class="col-md-9">
                                       <input type="text" class="form-control" name="percentual" id="percentual"  placeholder="Percentual de participação" required="" />
                                    </div>
                                </div>

                            
                                  <div class="form-group">
                            
                                    <div class="col-md-9">
                                       <input type="submit" class="btn btn-success m-r-5 m-b-5" name="atualiza" value="Cadastrar" />
                                    </div>
                                </div>

                             




                              





                              






                         
                        </div>
                    </div>
                    <!-- end panel -->
                </div>




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
                            <h4 class="panel-title">Proprietários do Lote</h4>
                        </div>
                        
                        <div class="panel-body">
                            <table id="" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nome </th>
                                          <th>% de Participação </th> 
                                           <th> </th>
                                         
                                         
                                        
                                    </tr>
                                </thead>

                                      <tbody>
                              	<?php 

								

				include "conexao.php";
				$query = mysqli_query($db,"SELECT * FROM proprietarios_lote
									  WHERE venda_id = $venda_idvenda") or die ("ERRO ao listar proprietarios"); 


		    while ($buscar = mysqli_fetch_assoc($query)) {//--While categoria
		   
		     $idproprietarios_lote 		= $buscar["idproprietarios_lote"];
		     $cliente_id 				= $buscar["cliente_id"];
		     $percentual 				= $buscar["percentual"];
		      
		

		     $verifica_titular = busca_locador($venda_idvenda);


													?>

                          
                                    <tr class="odd gradeX">
                                        <td><?php echo nome_user($cliente_id) ?></td>
                                        <td><?php echo $percentual ?>%</td>
                                         <td>

                                         	<?php if($verifica_titular != $cliente_id){ ?>

                                         	<a href="excluir_proprietario_lote.php?idproprietarios=<?php echo $idproprietarios_lote ?>&venda_idvenda=<?php echo $venda_idvenda ?>"><span class="btn btn-danger">Remover</span></a>



                                         	<a href="editar_proprietario_empreendimento.php?idproprietarios=<?php echo $idproprietarios_lote ?>&venda_idvenda=<?php echo $venda_idvenda ?>"><span class="btn btn-warning">Editar</span></a></td>
                                      		
                                      		<?php }else{ ?>

                                      		<span class="btn btn-primary">Proprietário Titular</span>

                                      		<?php } ?>

                                    </tr>
                                   <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
						</div>




<!-- inicio da aba de parcelas -->


						<div class="tab-pane fade" id="default-tab-2">
							


						</div>
						<div class="tab-pane fade" id="default-tab-3">
							
						</div>
					</div>
					
				</div>
			    <!-- end col-6 -->
			 
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
        <!-- begin theme-panel -->
     
        <!-- end theme-panel -->
		
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
$("#preco").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$("#percentual").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});


</script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	
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
			  FormPlugins.init();

		});
	</script>

</body>


</html>
