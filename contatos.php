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
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
  <script type="text/javascript">


function excluir(){

document.nome.action = "excluir_contatos.php";
document.nome.submit();

}

function baixar(){

document.nome.action = "baixar_contatos.php";
document.nome.submit();

}

</script>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			   <ol class="breadcrumb pull-right">
     
        <li><a href="#" onclick="excluir()"><span class="label label-danger">EXCLUIR</span></a></li>
 
     
        <li><a href="#" onclick="baixar()"><span class="label label-success">BAIXAR </span></a></li>
 
     
 
      
        
      </ol>	
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Contatos Site</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			   
			    <!-- begin col-10 -->
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
                            <h4 class="panel-title">Informações dos Contatos:</h4>
                        </div>
                      
                        <div class="panel-body">
                      <form action="#" method="POST" id="nome" name="nome">

                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                   <th></th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>Corretor Imovel</th>
                                        <th>Tipo</th>
                                        <th>Código</th>
                                         <th>Data /Hora</th>
                                               <th>Baixado</th>
                                                
                                    </tr>
                                </thead>
                                <tbody>

              <?php

                include "conexao.php";
                $query_amigo = "SELECT * FROM contatos order by id desc";
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $id               	= $buscar_amigo['id'];
            $nome              	= $buscar_amigo["nome"];
            $email              = $buscar_amigo["email"];
            $telefone           = $buscar_amigo["telefone"];
          	$mensagem_contato   = $buscar_amigo["mensagem_contato"];
            $idimovel           = $buscar_amigo["idimovel"];
            $data_contato       = $buscar_amigo["data_contato"];
            $tipo_contato       = $buscar_amigo["tipo_contato"];
            $visto              = $buscar_amigo["visto"];
             
 





                $query_imovel = "SELECT * FROM imovel
                                 INNER JOIN imobiliaria ON imovel.imobiliaria_idimobiliaria = imobiliaria.idimobiliaria  				
                WHERE idimovel = $idimovel";


                $executa_imovel = mysqli_query ($db, $query_imovel) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_imovel = mysqli_fetch_assoc($executa_imovel)) {//--verifica se são amigos
           
        
          $corretor_id      = $buscar_imovel["corretor_id"];
}
        
        if($corretor_id != 0){
        $verifica_cc =  nome_user($corretor_id);
      }

             ?>


                                    <tr class="odd gradeX">
                                      <td><input type="checkbox" name="ver[]" value="<?php echo $id ?>"></td>
                                       <td><?php echo $nome ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><?php echo $telefone ?></td>
                                        <td><?php
                                        
                                        if($verifica_cc == 0){
                                        echo "HR SANTOS";

                                        }else{

                                         echo $verifica_cc;

                                        }


                                         ?>

                                        </td>
                                       <td><?php echo $tipo_contato ?></td>
                                       <td><?php echo $idimovel ?></td>
                                       <td><?php echo $data_contato ?></td>
                                       <td><?php echo $visto ?></td>
                                   
                                    </tr>
                                     <?php $cont = $cont + 1;

                                      } ?>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->
		
     
		
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
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
			Notification.init();
		});
	</script>

</body>


</html>
