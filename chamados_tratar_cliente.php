<?php
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";


	$idocorrencia = $_GET["idocorrencia"];



if(isset($_POST["status"])){

	date_default_timezone_set('America/Sao_Paulo');

	$descricao_tratar  	= $_POST["descricao_tratar"];
	$status_ocorrencia  = $_POST["status"]; 
	$atendente_id       = $_POST["atendente_id"];

	$data_tratar 	    = date('d-m-Y H:i:s');

   

 
	include "conexao2.php";

	$inserir = mysqli_query($db, "INSERT INTO chamado_tratar (ocorrencia_id, descricao_tratar, atendente_id, data_tratar, status_tratar) values ('$idocorrencia','$descricao_tratar','$atendente_id','$data_tratar','$status_ocorrencia')");

	$ultimo_id = mysqli_insert_id($db);
                                                                          //################
	$atualiza = mysqli_query($db, "UPDATE chamado SET status_chamado = $status_ocorrencia where idocorrencia = $idocorrencia");




$pasta = "ocorrencias/".$idocorrencia."/".$ultimo_id."/";
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

$inserir = mysqli_query ($db,"INSERT INTO chamado_arquivos (ocorrencia_tratar_id, descricao, url_anexo) values ('$ultimo_id','$descricao_tratar','$pasta_g')") or die ("ERRO AO ANEXAR ARQUIVO.");

 
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
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
	
	<?php  include "topo.php"; 
		   $idocorrencia = $_GET["idocorrencia"];

		   function dados_ocorrencia($idocorrencia){
		   	include "conexao2.php";
            $query_amigo = "SELECT * FROM chamado
            				WHERE idocorrencia = $idocorrencia";

           
            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro Ocorrencias");
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $cadastrado_por       = $buscar_amigo['cadastrado_por'];
        	}

        	return $cadastrado_por;
		   }

		   $dados_ocorrencia = dados_ocorrencia($idocorrencia);






           function email_original_abertura($idocorr){

            include "conexao2.php";
            $query_email = "SELECT email_usuario FROM chamado
                            WHERE cadastrado_por = $idocorr";

           
            $executa_query = mysqli_query ($db,$query_email) or die ("Erro Ocorrencias");
                
            while ($buscar_email_cliente = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $email_cliente       = $buscar_email_cliente['email_usuario'];
            }

            return $email_cliente;

           }



         

           








           



	?>


    <?php


 
        function busca_email_setor($idchamado_tratar){
            include "conexao2.php";


             
            $query_email = "SELECT * FROM chamado_tratar INNER JOIN chamado_status
            on chamado_tratar.status_tratar = chamado_status.idstatus
            WHERE idcorrencia_tratar = $idchamado_tratar";

            $executa_email = mysqli_query ($db,$query_email) or die ("Erro Ocorrencias");

            ($buscar_email = mysqli_fetch_assoc($executa_email));
            
            $email_dest  = $buscar_email['email_setor'];

            return $email_dest;


        }


        function nome_usuario($id_ocorrencia){

            include "conexao2.php";


            $query_nome = "SELECT nome_usuario FROM chamado WHERE idocorrencia = $id_ocorrencia";

            $executa_nome = mysqli_query ($db,$query_nome) or die ("Erro Ocorrencias");

            ($buscar_nome = mysqli_fetch_assoc($executa_nome));
            
            $nome_cliente  = $buscar_nome['nome_usuario'];

            return $nome_cliente;


        }










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
                            <h4 class="panel-title">Chamados</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" action="chamados_tratar_cliente.php?idocorrencia=<?php echo $idocorrencia ?>" 
                              method="POST" enctype="multipart/form-data">
                               
                 <input type="hidden" name="atendente_id" value="<?php echo $idcliente ?>">

                          		  <div class="form-group">
                                    <label class="col-md-3 control-label">Descrição</label>
                                    <div class="col-md-9">
                                  <textarea class="form-control" name="descricao_tratar"></textarea>

                                      
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-9">
                                
                                  <tr>
                                         <td> <select name="status" id="forma_pagamento" class="form-control" required="" onchange="ShowHideDIV()" 
                                >
                                <?php 

                            include "conexao2.php";
                            $query_amigo = "SELECT * FROM chamado_status";

                            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar status");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                    $idstatus          = $buscar_amigo["idstatus"];
                    $descricao         = $buscar_amigo["descricao"];

                    ?>
                                    <option value="<?php echo $idstatus ?>"><?php echo $descricao ?></option>
                                <?php } ?>
                                </select></td>
                                            <td></td>
                                            <td></td> 
                                            <td></td>
                                       <td></td>
                                        <td></td>
                                        <td></td>
                                </tr>










                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">E-mail</label>
                            <div class="col-md-9">
                                <input type="checkbox" id="email" name="email_cliente"
                                checked>
                                <label for="email_cliente">Envia email Cliente?</label>
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
                  
                                       <input type="submit" class="btn btn-success m-r-5 m-b-5" value="Cadastrar"   />


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
                            <h4 class="panel-title">Tratativas do Chamado</h4>
                        </div>
                        
                        <div class="panel-body">
                            <table id="" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cod</th>
                                        <th>Descrição</th>
                                        <th>Usuario</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                        <th>Anexo</th>                                     
                                        
                                    </tr>
                                </thead>

                                      <tbody>
                               <?php

            include "conexao2.php";
            $query_amigo = "SELECT * FROM chamado_tratar
            				WHERE ocorrencia_id = $idocorrencia
            				order by idcorrencia_tratar desc";
            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro Ocorrencias");

            $cont = 0;
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $idocorrencia_tratar  = $buscar_amigo['idcorrencia_tratar'];
            $descricao_tratar     = $buscar_amigo["descricao_tratar"];
            $atendente_id    	  = $buscar_amigo["atendente_id"];
          	$data_tratar     	  = $buscar_amigo["data_tratar"];
          	$status_ocorrencia    = $buscar_amigo["status_tratar"];

            //pegar somente ultima tratativa cadastrada
            if($cont == 0){
              
               $email_cod_trat         = $idocorrencia_tratar;
               $email_desc_trat        = $descricao_tratar;
               $email_stat_trat        = $status_ocorrencia;
               $email_data_trat        = $data_tratar;

               $email_status_chamado   = $email_stat_trat;

                //se o status for 0 = aberto manda email para default
                    if($email_status_chamado == 0){
                        $email_destinatario = "jeanjr.silvasousa@gmail.com";
                    }else{

                        $email_destinatario = busca_email_setor($idocorrencia_tratar);

                    };

            }

            


            


           
  		
            			
 			?>



                          
                <tr class="odd gradeX">
                    <td><?php echo $idocorrencia_tratar ?></td>
                    <td><?php echo $descricao_tratar ?></td>
                    <td><?php echo nome_user($atendente_id) ?></td>
                    <td><?php echo $data_tratar ?></td>
                    <td>



       


       <?php  
        $query_status = "SELECT * FROM chamado_status WHERE idstatus = $status_ocorrencia";
        $executa_status = mysqli_query ($db,$query_status) or die ("Erro Ocorrencias");
                
        while ($buscar_status = mysqli_fetch_assoc($executa_status)) {//--verifica se são amigos
           
                $status_mostrar  = $buscar_status['descricao'];
                $cor             = $buscar_status['cor'];

           if($cont == 0){
                 $email_stat_trat   = $status_mostrar;

            }

            $cont++;
               

        ?>







                        <label class="label" style="background-color: <?php echo $cor; ?> "><?php echo $status_mostrar ?></label>

                        
                            




                    </td>







                      <td>
    <?php	
        $query_anexo = "SELECT * FROM chamado_arquivos WHERE ocorrencia_tratar_id = $idocorrencia_tratar";
        $executa_anexo = mysqli_query ($db,$query_anexo) or die ("Erro Ocorrencias");
                
        while ($buscar_anexo = mysqli_fetch_assoc($executa_anexo)) {//--verifica se são amigos
           
            	$url_anexo       = $buscar_anexo['url_anexo'];
            	if($url_anexo != ''){

        ?>    	
        		<a href="ocorrencias/<?php echo $idocorrencia  ?>/<?php echo $idocorrencia_tratar  ?>/<?php echo $url_anexo ?>">
<i class="fa fa-file" aria-hidden="true"></i></a>
	<?php } } } ?>

                            </td>
                                    
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

    <?php
    ############## PEGANDO DADOS DO CHAMADO ORIGINAL ##########################
     $email_cod_chamado  = $_GET["idocorrencia"]; 


     $query_anexo = "SELECT * FROM chamado WHERE idocorrencia = $email_cod_chamado";

        $executa_anexo = mysqli_query ($db,$query_anexo) or die ("Erro Ocorrencias");
                
        $buscar_anexo = mysqli_fetch_assoc($executa_anexo);
           
                $email_titulo_chamado       = $buscar_anexo['titulo'];
                $email_desc_chamado         = $buscar_anexo['descricao'];
                $email_data_ab_chamado      = $buscar_anexo['data_hora'];    
                $email_ip_chamado           = $buscar_anexo['ip'];
                $email_dominio_chamado      = $buscar_anexo['dominio'];
                $email_abtpor_chamado       = $buscar_anexo['cadastrado_por'];
                $email_tipo_chamado         = $buscar_anexo['tipo_chamado'];            
                $email_abtpor_chamado       = nome_usuario($email_cod_chamado); 
                $idcadastrado_por           = $buscar_anexo['cadastrado_por'];
                $email_abertura             = email_original_abertura($idcadastrado_por);

             

       
    ################ ENVIO DE EMAIL ############################################


    //verificando checkbox se envia email para cliente
    
                if(isset($_POST['email_cliente']))
                {
                    $envia_email_cliente = "S";
                }
                else
                {
                    $envia_email_cliente = "N";
                }            




                
      
     //verifica se tem nova tratativa para enviar email
      if(!is_null($_POST["descricao_tratar"])){
            var_dump(1);
           include_once("chamado_email.php");
           envia_email($email_cod_chamado,$email_titulo_chamado, $email_desc_chamado,$email_ip_chamado,$email_dominio_chamado, $email_abtpor_chamado,$email_data_ab_chamado, $email_tipo_chamado,$email_destinatario, $email_cod_trat, $email_desc_trat, $email_stat_trat, $email_data_trat,$email_abertura,$envia_email_cliente);
      }

     



      
                              

   ?>








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

</body>


</html>
