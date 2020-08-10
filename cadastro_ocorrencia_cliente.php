<?php 
//error_reporting(0);
//ini_set(“display_errors”, 0 );
include "protege_professor.php";

if(isset($_POST["titulo"])){
	include "conexao.php";
	date_default_timezone_set('America/Sao_Paulo');
	$descricao  	   = $_POST["descricao"];
	$titulo            = $_POST["titulo"];
	$cadastrado_por    = $_POST["cadastrado_por"];
	$data_ocorrencia   = date('d-m-Y H:i:s');
	$status_ocorrencia = '1';

	$inserir = mysqli_query($db, "INSERT INTO ocorrencia(titulo, descricao, cadastrado_por, data_ocorrencia, status_ocorrencia) values ('$titulo','$descricao','$cadastrado_por','$data_ocorrencia','$status_ocorrencia')");

	$ultimo_id = mysqli_insert_id($db);

$pasta = "ocorrencias/".$ultimo_id."/";
if(!file_exists($pasta)){
mkdir($pasta);
}


 foreach($_FILES["img"]["error"] as $key => $error){
 
 if($error == UPLOAD_ERR_OK){
 $tmp_name = $_FILES["img"]["tmp_name"][$key];
 $cod     = $_FILES["img"]["name"][$key];
 ////////////////////////////////////////

 //////////////////////////////////////////

$extensao = explode(".", $cod);
$parte1   =  $extensao[0]; // piece1
$parte2   =  ".".$extensao[1]; // piece2


$novo_nome =  rand(1, 15);
$pasta_g   = $novo_nome.$parte2;
$pasta2    = $pasta.$novo_nome.$parte2;
 
 $nome    = $_FILES["img"]["name"][$key];
 $uploadfile = $pasta . basename($cod);
 
$mover = move_uploaded_file($tmp_name, $uploadfile);

$trocando_nome = rename($uploadfile, $pasta2);

$inserir = mysqli_query ($db,"INSERT INTO ocorrencia_arquivos (ocorrencia_id, descricao, url_anexo) values ('$ultimo_id','$descricao','$pasta_g')") or die ("ERRO AO ANEXAR ARQUIVO.");

 
}}


   ?>



<script type="text/javascript">
	window.location="sistema_ocorrencia_cliente.php";
</script>
<?php  } ?>

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
	
	<!-- ================== BEGIN BASE JS ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
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
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
	
	<?php  include "topo_cliente.php"; 	?>
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
                            <h4 class="panel-title">Nova Ocorrência</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" action="cadastro_ocorrencia_cliente.php" method="POST" enctype="multipart/form-data">
                              <?php 
                              	$cadastrado_por = $_SESSION["id_usuario"];
                              ?>

                               <input type="hidden" name="cadastrado_por" value="<?php echo $cadastrado_por ?>">





                                   <div class="form-group">
                                    <label class="col-md-3 control-label">Categoria</label>
                                    <div class="col-md-9">
                                 <select class="form-control" name="tipo_venda" id="tipo_cobranca" onchange="ShowHideDIV()">
     

      <option value="">Escolha</option>
    <option value="1">Locação</option>
      <option value="2">Empreendimento</option>
                                        </select>

                                      
                                    </div>
                                </div>


                                   <div class="form-group" id="teste" style="display:none">
                                    <label class="col-md-3 control-label">Empreendimento</label>
                                    <div class="col-md-9">
                                 <select class="form-control" name="empreendimento_id" id="os">
      <option value="">Escolha</option>

     
<?php 
             include "conexao.php";
             $query_c = "SELECT * FROM empreendimento
                                                 INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                                                 WHERE cliente_id = $idcliente
                    order by idempreendimento desc";
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

                                   <div class="form-group" id="locacao" style="display:none">
                                    <label class="col-md-3 control-label">Imovel</label>
                                    <div class="col-md-9">
                                 <select class="form-control" name="imovel_id">
           <option value="">Escolha</option>

<?php 
            include "conexao.php";
            if($locador_total != '' AND $locatario_total != ''){ 

            $query_c = "SELECT * FROM imovel WHERE locador_idlocador = $idcliente";
            }elseif($locador_total != ''){
            $query_c = "SELECT * FROM imovel WHERE locador_idlocador = $idcliente";
            }else{
            $query_c = "SELECT * FROM locacao WHERE cliente_idcliente = $idcliente";
            }
            $executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento mesmo");               
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos
           
            $idimovel             = $buscar_amigoc['idimovel'];
            $endereco             = $buscar_amigoc['endereco'];
            $numero               = $buscar_amigoc['numero'];
        ?>
            <option value="<?php echo $idimovel ?> "><?php echo $endereco.", ".$numero ?></option>
      <?php }  ?>
                                        </select>

                                      
                                    </div>
                                </div>
                                  




                                   <div class="form-group" id="quadra2" style="display:none">
                                    <label class="col-md-3 control-label">Quadra</label>
                                    <div class="col-md-9">
                                   <select name="quadra_id" id="quadra" class="form-control">
                                       </select>

                                      
                                    </div>
                                </div>


 <div class="form-group" id="lote32" style="display:none">
                                    <label class="col-md-3 control-label">Lote</label>
                                    <div class="col-md-9">
                                    <select name="lote_id"  id="lote" class="form-control">
                                       </select>

                                      
                                    </div>
                                </div>























                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Titulo</label>
                                    <div class="col-md-9">
                                  <textarea class="form-control" name="titulo"></textarea>

                                      
                                    </div>
                                </div>
                          		  <div class="form-group">
                                    <label class="col-md-3 control-label">Descrição</label>
                                    <div class="col-md-9">
                                  <textarea class="form-control" name="descricao"></textarea>

                                      
                                    </div>
                                </div>

                                   <div class="form-group">
                                    <label class="col-md-3 control-label">Anexar Arquivo</label>
                                    <div class="col-md-9">
                                 <input type="file" name="img[]" multiple="">

                                      
                                    </div>
                                </div>
                            
                                  <div class="form-group">
                            
                                    <div class="col-md-9">
                                       <input type="submit" class="btn btn-success m-r-5 m-b-5" value="Cadastrar" />
                                    </div>
                                </div>

                             




                              





                              






                         
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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	
<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
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


	        <script src="produtos_pagar.js"></script>
  <script src="lote_pagar.js"></script>
  <script src="etapa_pagar.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
		});
	</script>

</body>


</html>
