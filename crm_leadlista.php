<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br">
<!--<![endif]-->


<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" /> <!-- TESTE DE ACENTOS -->
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
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<script>
 $("#celular").mask("(00) 00000-0000");
 $("#fixo").mask("(00) 0000-0000");
 $("#cep").mask("00000-000");




function ShowHideDIV(){

  Valor = document.getElementById("tipo_cobranca").value;

  if (Valor=="2") 
  {
    document.getElementById('locacao').style.display    = "none"
    document.getElementById('teste').style.display      = "block"
    
  }
  else
  {
    document.getElementById('locacao').style.display    = "block"
    document.getElementById('teste').style.display      = "none"
    
   }
}


</script>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
		<!-- begin #header -->
		
		<?php 
		include "topo.php";
		//echo $_SERVER['HTTP_REFERER']; 

		?>


		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			
			
			


				<!-- begin row -->
				<div class="row">
					<!-- begin col-2 -->

					<!-- end col-2 -->
					<!-- begin col-10 -->
					<div class="col-md-12">
						<div class="panel panel-inverse m-b-0">
							<div class="panel-heading">
								<div class="panel-heading-btn">
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
								</div>
								<h4 class="panel-title">Cadastro Lead <small> Manual</small></h4>
							</div>
							<div class="panel-body">
								<form action="crm_salvaattform.php" method="POST">
									
									<div>
										<fieldset>
											<legend class="pull-left width-full">Identificação</legend>
											<!-- begin row -->
											<div class="row">
												<!-- begin col-4 -->
												<div class="col-md-5">
													<div class="form-group">
														<label>Nome*</label>
														<input type="text" name="primeironome" placeholder="Nome do Lead" class="form-control" required="" />
													</div>
												</div>
												<!-- end col-4 -->
													<!-- VALUE É O TOKEN PARA CADA ORIGEM 
														<input type="hidden" name="origem" value="4">-->

														<!-- begin col-4 -->
														<div class="col-md-3">
															<div class="form-group">
																<label>E-mail*</label>
																<input type="text" name="email" placeholder="Email do Lead" class="form-control" required="" />
															</div>
														</div>
														<!-- end col-4 -->
														<div class="col-md-2">
															<div class="form-group">
																<label>Telefone Celular*</label>
																<input type="text" name="celular" id="celular" placeholder="(99)99999-9999" required="" class="form-control" />
															</div>
														</div>

														<div class="col-md-2">
															<div class="form-group">
																<label>Telefone Fixo</label>
																<input type="text" name="fixo" id="fixo" placeholder="(99)3333-3333" class="form-control" />
															</div>
														</div>

													</div>

													<div class="row">

														<div class="col-md-2">
															<div class="form-group">
																<label>CEP*</label>
																<input type="text" id="cep" name="cep" placeholder="99999-999" required="" class="form-control" value="14400-750" />
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label>Endereço</label>
																<input type="text" name="rua" id="rua" placeholder="Rua/Av..."  class="form-control" /><input type="hidden" name="bairro" id="bairro">
															</div>
														</div>

														<div class="col-md-2">
															<div class="form-group">
																<label>Cidade</label>
																<input type="text" name="cidade" id="cidade" placeholder="Cidade do Lead" class="form-control" />
																<input type="hidden" name="uf" id="uf" value="">
															</div>
														</div>
														<!-- end col-6 -->

														<div class="col-md-2">
															<div class="form-group">
																<label>Número</label>
																<input type="text" name="numero" placeholder="número do endereço" class="form-control" />
															</div>
														</div>

														<div class="col-md-2">
															<div class="form-group">
																<label>complemento</label>
																<input type="text" name="complemento" placeholder="Casa / Apt" class="form-control" />
															</div>
														</div>
<div class="col-md-8">
	<div class="form-group">
		<label>Observação</label>
               <textarea placeholder="Observação sobre contato com Lead." class="form-control" name="obs" ></textarea>
           </div>
       </div>

       <div class="col-md-2">
													<div class="form-group">
														<label>Latitude</label>
														<input type="text" name="lat" id="lat" value="-22.8864698" placeholder="" class="form-control" required="" />
													</div>
												</div>

												<div class="col-md-2">
													<div class="form-group">
														<label>Longitude</label>
														<input type="text" name="lon" id="lon" value="-48.4426632" 
														placeholder="" class="form-control" required="" />
													</div>
												</div>



													</div>


						<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label >Origem*</label>


																<select name="origemfil" class="form-control" required="">
																	<option value="">Selecione</option>
																	<?php 

																	include "conexao.php";
																	$query_slide = mysqli_query($db,"SELECT * FROM crm_origem
																		GROUP by crm_idorigem Asc") or die ("Erro ao listar grupo dos clientes, tente mais tarde");


												            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

												            	$id          = $buscar_slide["crm_idorigem"];
												            	$origem          = $buscar_slide["crm_origemnome"];
												            	



												            	?> 
												            	<option value="<?php echo $id ?>"><?php echo $origem ?></option>

												            <?php } ?> 
												        </select>

												    </div>
												</div>

<div class="col-md-2">
												<div class="form-group">
													
														<label >Categoria*</label>

														<select required="" class="form-control" name="categoria" id="tipo_cobranca" onchange="ShowHideDIV()">


															<option value="">Escolha</option>
															<option value="1">Locação</option>
															<option value="3">Venda</option> 
															<option value="2">Empreendimento</option>
														</select>


													</div>
												</div>
<div class="col-md-3">
												<div class="form-group" id="teste" style="display:none">
													

														<label>Interesse</label>

														<select class="form-control" name="interesse" id="interesse" >
															<option value="">Escolha</option>


															<?php 
					include "conexao.php";
					$query_c = "SELECT empreendimento_cadastro_id as id, descricao_empreendimento 
					FROM empreendimento
					INNER JOIN empreendimento_cadastro ON empreendimento_cadastro_id = idempreendimento_cadastro

					order by idempreendimento_cadastro desc";
															$executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento mesmo");


            while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos

            	$id             = $buscar_amigoc['id'];
            	$descricao                   = $buscar_amigoc['descricao_empreendimento'];
            	?>
            	<option value="<?php echo $id ?> "><?php echo $descricao ?></option>
            <?php }  ?>
        </select>


    </div>
</div>

<div class="form-group" name="venda" id="locacao" required style="display:none">
     
      <label class="col-md-7 control-label">Imóvel</label>
<div class="col-md-7">
       <select class="default-select2 form-control" name="interesse1" id="interesse1" style="width: 300px">
         <option value="">Escolha</option>

         <?php 
         include "conexao.php";
         $query_c = "SELECT * FROM imovel";



         $executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento mesmo");               
         
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos
             
              $idimovel             = $buscar_amigoc['idimovel'];
              $descricao             = $buscar_amigoc['endereco'];
              $num             = $buscar_amigoc['numero'];
                            
              ?>
              <option value="<?php echo"$idimovel" ;?>"><?php echo "$idimovel --- $descricao, $num" ;?></option>
            <?php }  ?>
          </select>
          
        </div>
      </div>


      

</div>
<?php if (in_array('62', $idrota)) { ?>
<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label >Imobiliária</label>


																<select name="imobb" id="imobb" class="form-control">
                          <option value="">Selecione</option>
                          <!-- <?php /* 

                          include "conexao.php";
                          $query_slide = mysqli_query($db,"SELECT * FROM empreendimento_imob 
                          	INNER JOIN cliente ON idcliente = imobiliaria_id 
                          	WHERE empreendimento_id = 1") or die ("Erro ao listar grupo dos clientes, tente mais tarde");


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

              $id          = $buscar_slide["imobiliaria_id"];
              $status          = $buscar_slide["nome_cli"];
              



              ?> 
              <option value="<?php echo $id ?>"><?php echo $status ?></option>
            <?php } */ ?> -->
        </select>

												    </div>
												</div>

<div class="col-md-2">
												<div class="form-group">
													
														<label >Corretor</label>

														<select name="corretores" id="corretorid" class="form-control">
                          <option value="">Selecione</option>
                        <!--  <?php /*
                          include "conexao.php";
                          $query_slide = mysqli_query($db,"SELECT * FROM crm_roleta_corretor
                            INNER JOIN cliente ON crm_idcorretor = idcliente
                            INNER JOIN crm_cli ON crm_idcli = crm_id
                            GROUP BY crm_idcorretor") or die ("Erro ao listar grupo dos clientes, tente mais tarde");


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

              $id          = $buscar_slide["crm_idcorretor"];
              $status          = $buscar_slide["nome_cli"];
              



              ?> 
              <option value="<?php echo $id ?>"><?php echo $status ?></option>
            <?php } */ ?> -->
        </select>


													</div>
												</div>
     

</div>
<?php } ?>
<!-- #$#$#$#$#$#$#$$#$#$#$#$#$#$#$##$#$$#$#$#$#$#$#$#$#$#$$#$#-->




											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<!-- LATITUDE -->
														<div class="controls">
															
															<input type="hidden" name="imobiliaria_idimobiliaria" class="form-control" value="<?php echo $imobiliaria_idimobiliaria ; ?>">
															<input type="hidden" name="status" class="form-control" value="20">
														</div>
													</div>

												</div>
												<!-- end col-4 -->


											</div>
										</fieldset>
									</div>

									<div>
										<fieldset>

											<div class="row">

												<br/>                                                                                               
												<div class="form-group">
													<div class="col-md-9">
														<button type="submit" class="btn btn-sm btn-primary">Cadastrar</button>	
														<!-- #modal-dialog -->

													</div>
												</div>
											</div>
										</fieldset>
									</div>
								</form>
							</div>

						</div>
					</div>




				</div>

				<!-- end #content -->
			</div>



			<!-- begin scroll to top btn -->
			<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
			<!-- end scroll to top btn -->
		</div>
		<!-- end page container -->

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
	<script src="https://immobilebusiness.com.br/admin/assets/js/ui-modal-notification.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>


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
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script type="text/javascript"> 

	document.getElementById('menucrm').style.display="block";

</script>
	<script>

		
  $(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#imobb').on('change', function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'crm_editarroleta.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'id=' + $('#imobb').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
			var $corretor2 = $('#corretorid');
            $corretor2.empty(); 
$corretor2.append("<option value=''> Selecione </option>");
            $.each(data, function(idcliente, nome){
                   $corretor2.append('<option value=' + idcliente + '>' + nome + '</option>');
            }



            );

              $corretor2.change();       
                       
                 
                }
           });   
   return false;    
   })
});

  $(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#interesse').on('change', function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'crm_consultar_imob.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'id=' + $('#interesse').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
			var $corretor2 = $('#imobb');
            $corretor2.empty(); 
$corretor2.append("<option value=''> Selecione </option>");
            $.each(data, function(idcliente, nome){
                   $corretor2.append('<option value=' + idcliente + '>' + nome + '</option>');
            }



            );

              $corretor2.change();       
                       
                 
                }
           });   
   return false;    
   })
});

  $(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#interesse1').on('change', function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'crm_consultar_imob2.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'id=' + $('#interesse1').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
			var $corretor2 = $('#imobb');
            $corretor2.empty(); 
$corretor2.append("<option value=''> Selecione </option>");
            $.each(data, function(idcliente, nome){
                   $corretor2.append('<option value=' + idcliente + '>' + nome + '</option>');
            }



            );

              $corretor2.change();       
                       
                 
                }
           });   
   return false;    
   })
});



		$(document).ready( function() {
			/* Executa a requisição quando o campo CEP perder o foco */
			$('#cep').blur(function(){
				/* Configura a requisição AJAX */
				$.ajax({
					url : 'crm_consultarcep.php', /* URL que será chamada */ 
					type : 'GET', /* Tipo da requisição */ 
					data: 'cep=' + $('#cep').val(), /* dado que será enviado via POST */
					dataType: 'json', /* Tipo de transmissão */
					success: function(data){
						if(data.sucesso == 1){
							$('#lat').val(data.lat);
							$('#lon').val(data.lon);
							$('#rua').val(data.rua);
							$('#bairro').val(data.bairro);
							$('#cidade').val(data.cidade);
							$('#uf').val(data.estado);


						}
					}
				});  

				return false;    
			})
		});

		$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#celular').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'crm_duplicado.php', /* quando sair do campo celular verifica se ja foi cadastrado */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'celular=' + $('#celular').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){               
 
                    alert('Cliente já cadastrado.');
                    
                    $('#celular').val('');
                    $('#celular').focus();

                    }
                }
           });   
   return false;    
   })
});


		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
			Notification.init();
			FormPlugins.init();

		});
	</script>

	
	

</body>


</html>
