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
		 
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Relatorio de Lotes</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			   <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title"> Filtro</h4>
                        </div>
                        <div class="panel-body">
                        	 <form class="form-vertical form-bordered" name="myForm" method="GET" action="relatorio_lotes_disponiveis.php">
                       
                                <div class="row">

                                      <div class="form-group">
                                    <label class="col-md-2 control-label">Empreendimento</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-daterange">
                                             <select class="default-select2 form-control" name="empreendimento_id"  id="os">
                                        <option value="">Todos</option>
                      <?php

                      include "conexao.php";
                
        $query_amigo = "SELECT * FROM empreendimento_cadastro order by descricao_empreendimento Asc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
              $idempreendimento_cadastro             = $buscar_amigo['idempreendimento_cadastro'];
              $descricao_empreendimento              = $buscar_amigo["descricao_empreendimento"];
        
             
            
             ?>
                <option value="<?php echo $idempreendimento_cadastro ?>"> <?php echo $descricao_empreendimento ?> </option>
            <?php } ?>

                                           
                                        </select>
                                           
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Status</label>
                                    <div class="col-md-4">
                                             <div class="form-group">
                                   
                                
                                 <select name="status" class="form-control">
                                  <option value="4">Todos</option>
                                    <option value="1">Disponivel</option>
                                  <option value="0">Reservado</option>
                                  <option value="2">Vendido</option>
                                  <option value="3">Bloqueado</option>
                                 
                                 </select>

                               
                                </div>
                                           
                                     
                                    </div>
                                </div>
  


</div>
<div class="row">
                                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Quadra</label>
                                                                        <div class="col-md-4">

                                       <select name="quadra"  id="quadra" class="form-control">
                                       </select>

                                                    </div>
                                                </div>
  </div>




                                  <div class="form-group">
                                    
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-sm btn-success" name="busca_lote" value="Consultar" />
                                    </div>
                                </div>

                       </form>



                        </div>
                    </div>
			    </div>


<?php 
      if(isset($_GET["busca_lote"])){

      $empreendimento_id = $_GET["empreendimento_id"];
      $status            = $_GET["status"];
      $quadra_id         = $_GET["quadra"];
  


      $where = "idlote > 0";

     

      

      

      if($status != '4'){
        $where .= " AND status = ".$status;
      }
      
      if($quadra_id != '0' AND $quadra_id != ''){
        $where .= " AND produto_idproduto = ".$quadra_id;
      }

     
       if($empreendimento_id != ''){
        $where .= " AND empreendimento_cadastro_id = ".$empreendimento_id;
      }
 ?>

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
                            <h4 class="panel-title">Informações</h4>
                        </div>
                      
                        <div class="panel-body">
                      <form action="#" method="POST" id="nome" name="nome">

                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Empreendimento</th>
                                        
                                        <th>Quadra</th>
                                        <th>Lote</th>
                                        
                                        <th>M²</th>

                                        <th>Frente</th>
                                        <th>Fundo</th>
                                        <th>Direito</th>
                                        <th>Esquerdo</th>
                                          <th>M.Outros</th>

                                        <th>C. Frente</th>
                                        <th>C. Fundo</th>
                                        <th>C. Direito</th>
                                        <th>C. Esquerdo</th>
                                      
  <th>C. Outros</th>
                                        <th>Valor</th>
                                        <th>Status:</th>
                                    </tr>
                                </thead>
                                <tbody>

            <?php

            include "conexao.php";
            $query_amigo = "SELECT * FROM lote
                            INNER JOIN produto ON lote.produto_idproduto = produto.idproduto 
                            INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                            INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                            WHERE $where order by quadra, lote Asc";

            $executa_query = mysqli_query ($db,$query_amigo);
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $descricao_empreendimento       = $buscar_amigo['descricao_empreendimento'];
            $quadra             = $buscar_amigo["quadra"];
            $lote    = $buscar_amigo["lote"];
            $status    = $buscar_amigo["status"];
            $m2    = $buscar_amigo["m2"];
            $valor    = $buscar_amigo["valor"];
            $idlote    = $buscar_amigo["idlote"];
            $idproduto    = $buscar_amigo["idproduto"];
            $idempreendimento_cadastro    = $buscar_amigo["idempreendimento_cadastro"];

            $frente    = $buscar_amigo["frente"];
            $fundo     = $buscar_amigo["fundo"];
            $esquerda  = $buscar_amigo["esquerda"];
            $direita   = $buscar_amigo["direita"];

            $mld    = $buscar_amigo["mld"];
            $mle    = $buscar_amigo["mle"];
            $mfrente= $buscar_amigo["mfrente"];
            $mfundo = $buscar_amigo["mfundo"];

            $coutros = $buscar_amigo["coutros"];
            $moutros = $buscar_amigo["moutros"];


           if($status == 0){
  $status_desc = '<span class="label label-warning">Reservado</span>';
}
 if($status == 1){
  $status_desc = '<span class="label label-success">Disponivel</span>';
}
 if($status == 2){
  $status_desc = '<span class="label label-danger">Vendido</span>';
}
 if($status == 3){
  $status_desc = '<span class="label label-inverse">Bloqueado</span>';
}
 			
 			?>


                        <tr class="odd gradeX">
                            <td><?php echo $descricao_empreendimento ?></td>
                            
                            <td><?php echo $quadra ?></td>
                            <td><?php echo $lote ?></td>
                            
                            <td><?php echo $m2 ?></td>

                              <td><?php echo $frente ?></td>
                                <td><?php echo $fundo ?></td>
                                  <td><?php echo $direita ?></td>
                                    <td><?php echo $esquerda ?></td>
  <td><?php echo $moutros ?></td>
                                      <td><?php echo $mfrente ?></td>
                                        <td><?php echo $mfundo ?></td>
                                          <td><?php echo $mld ?></td>
                                            <td><?php echo $mle ?></td>
  <td><?php echo $coutros ?></td>




                            <td><?php echo 'R$ ' . number_format($valor, 2, ',', '.'); ?> </td>
                            <td> <?php echo $status_desc ?></td>
                           
                        </tr>
           
            <?php } ?>
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
            <?php } ?>
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




  <script src="produtos_pagar.js"></script>
  <script src="lote_pagar.js"></script>
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
