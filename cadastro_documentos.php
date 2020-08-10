<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
if (!isset($_SESSION)) {
  session_start();
}

if(isset($_POST["titulo"])){
	include "conexao.php";
	date_default_timezone_set('America/Sao_Paulo');
  $imovel_id          = $_POST["imovel_id"];
  $empreendimento_id  = $_POST["empreendimento_id"];
  $quadra_id          = $_POST["quadra_id"];
  $lote_id            = $_POST["lote_id"];
  $descricao          = $_POST["descricao"];
	$titulo             = $_POST["titulo"];
	$cadastrado_por     = $_POST["cadastrado_por"];
	$data_ocorrencia    = date('d-m-Y H:i:s');
	$status_ocorrencia  = '1';

	$inserir = mysqli_query($db, "INSERT INTO documentos(titulo, descricao, cadastrado_por, data_ocorrencia, status_ocorrencia, imovel_id, empreendimento_id, quadra_id, lote_id) values ('$titulo','$descricao','$cadastrado_por','$data_ocorrencia','$status_ocorrencia','$imovel_id','$empreendimento_id','$quadra_id','$lote_id')");

	$ultimo_id = mysqli_insert_id($db);


$pasta = "documentos_arquivos/".$ultimo_id."/";
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

$inserir = mysqli_query ($db,"INSERT INTO documentos_arquivos (documentos_id, descricao, url_anexo) values ('$ultimo_id','$descricao','$pasta_g')") or die ("ERRO AO ANEXAR ARQUIVO.");

 
}}

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

  }
  else
  {
    document.getElementById('locacao').style.display    = "block"
    document.getElementById('teste').style.display      = "none"
    document.getElementById('quadra2').style.display    = "none"
    document.getElementById('lote32').style.display     = "none"

   }
}


</script>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
	
	<?php  include "topo.php"; 	?>
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
                            <form class="form-horizontal form-bordered" action="cadastro_documentos.php" method="POST" enctype="multipart/form-data">
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
            $query_c = "SELECT * FROM imovel";



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
                            <h4 class="panel-title">Documentos Cadastrados</h4>
                        </div>
                      
                        <div class="panel-body">
                      <form action="#" method="POST" id="nome" name="nome">

                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Descrição</th>
                                        <th>Cadastrado por</th>
                                        <th>Anexo</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>

            <?php

            include "conexao.php";

              if(in_array('64', $idrota)){
                    $query_amigo = "SELECT * FROM documentos order by iddocumentos desc";
                }else{


                       $query_amigo1 = "SELECT idgrupo FROM cliente WHERE idcliente = $imobiliaria_idimobiliaria";
                        
                      $executa_query1 = mysqli_query($db,$query_amigo1) or die ("Erro ao listar clientes");
                              
                              $buscar_amigo1 = mysqli_fetch_assoc($executa_query1);
                                      $e_imobiliaria = $buscar_amigo1['idgrupo'];
                                 

                      if($e_imobiliaria != '6'){
                              $query_amigo = "SELECT * FROM documentos WHERE cadastrado_por = $imobiliaria_idimobiliaria order by iddocumentos desc";


                      }else{
                                $query_amigo = "SELECT documentos.iddocumentos, documentos.titulo, documentos.descricao, documentos.cadastrado_por, documentos.data_ocorrencia FROM documentos, cliente WHERE documentos.cadastrado_por = $imobiliaria_idimobiliaria or cliente.imob_id = $imobiliaria_idimobiliaria  order by documentos.iddocumentos desc";

                      }


}
                
            


            $executa_query = mysqli_query ($db,$query_amigo);
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $iddocumentos     = $buscar_amigo['iddocumentos'];
            $titulo           = $buscar_amigo['titulo'];
            $descricao        = $buscar_amigo["descricao"];
            $cadastrado_por   = $buscar_amigo["cadastrado_por"];
            $data_ocorrencia  = $buscar_amigo["data_ocorrencia"];
    


     
      ?>


                        <tr class="odd gradeX">
                            <td><?php echo $titulo ?></td>
                            <td><?php echo $descricao ?></td>
                            <td><?php echo nome_user($cadastrado_por) ?>/<?php echo $data_ocorrencia ?></td>
                                                       <td>
    <?php 
        $query_anexo = "SELECT * FROM documentos_arquivos WHERE documentos_id = $iddocumentos";
        $executa_anexo = mysqli_query ($db,$query_anexo);
                
        while ($buscar_anexo = mysqli_fetch_assoc($executa_anexo)) {//--verifica se são amigos
           
              $url_anexo       = $buscar_anexo['url_anexo'];
              if($url_anexo != ''){

        ?>      
            <a href="documentos_arquivos/<?php echo $iddocumentos  ?>/<?php echo $url_anexo ?>">
<i class="fa fa-file" aria-hidden="true"></i></a>
  <?php } } ?>

                            </td>                           
                        </tr>
           
            <?php } ?>
                                </tbody>
                            </table>
                            </form>
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



	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>

		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
		});
	</script>
<script type="text/javascript">
  $(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#os').click(function(){


           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_produto_pagar.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'os=' + $('#os').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
var $quadra = $('#quadra');
            $quadra.empty();
                  
            $.each(data, function(idproduto, quadra){
                   $quadra.append('<option value=' + idproduto + '>' + quadra + '</option>');
            });

              $quadra.change();        
                              
    
    
                    
                       
                 
                }
           });   
   return false;    
   })
});
</script>
<script type="text/javascript">
  $(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#quadra').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_lote_pagar.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'quadra=' + $('#quadra').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
var $lote = $('#lote');
            $lote.empty();

                  

            $.each(data, function(idlote, lote){
                   $lote.append('<option value=' + idlote + '>' + lote + '</option>');
            });

              $lote.change();        
                              
    
    
                    
                       
                 
                }
           });   
   return false;    
   })
});
</script>
</body>


</html>
