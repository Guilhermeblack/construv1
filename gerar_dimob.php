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
  <!-- ================== END BASE JS ================== -->
</head>
<body>




	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
<?php include "topo.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">DIMOB Empreendimentos</h1>
			<!-- end page-header -->
			
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
                            <h4 class="panel-title">Informações</h4>
                        </div>
                        <div class="panel-body">
                           <form class="form-vertical form-bordered" name="myForm" method="GET" action="teste_dimob.php">
          <div class="row">             
                            <div class="form-group">
                                    <label class="col-md-2 control-label">Cliente</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-daterange">
                                             <select class="default-select2 form-control" name="idempreendedor">
                                        <option value="">Selecione</option>
                      <?php

                      include "conexao.php";
                
        $query_amigo = "SELECT * FROM cliente
                        INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                        WHERE idtipo = 1 order by nome_cli Asc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Empreendedores");
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
                                </div>



                                      <div class="form-group">
                                    <label class="col-md-2 control-label">Empreendimento</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-daterange">
                                             <select class="default-select2 form-control" name="idempreendimento" >
                                        <option value="">Selecione</option>
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


</div>


  <div class="form-group">
                                    <label class="col-md-2 control-label">Ano Declaração</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-daterange">
                                             <select class="default-select2 form-control" name="ano_declaracao" >
                                        <option value="">Selecione</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                    

                                           
                                        </select>
                                           
                                        </div>
                                    </div>
                                </div>


                                  <div class="form-group">
                                    
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-sm btn-success" value="Consultar" />
                                    </div>
                                </div>

                       </form>



                        </div>
                    </div>
          </div>






			    

<?php if(isset($_GET["dimob"])){ ?>
   <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Arquivo para Importação</h4>
                        </div>
                        <div class="panel-body">

                        <form action="receber_parcelas_areceber.php" method="POST" id="nome" name="nome">

            
           
                        	 <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cod</th>
                                        <th>Download</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>




<?php 
      
       

        include "conexao.php";
        $query = "SELECT * from dimob order by iddimob desc limit 1";
                 
                  $executa_query = mysqli_query($db, $query);

                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $iddimob                  = $buscar_amigo["iddimob"];
                  $nome_arquivo             = $buscar_amigo["nome_arquivo"];
                 

                         
        ?>

                                    <tr class="odd gradeX">
                                        <td><?php echo $iddimob ?></td>
                                         <td><a href="dimob/<?php echo $nome_arquivo ?>" download><?php echo $nome_arquivo ?></a> </td>

                              
                                     
                                    </tr>
                                       <?php   }?>

                                    
                                </tbody>
                            </table>
                             
</form>


                        </div>
                    </div>
			    </div>

<?php } ?>


			</div>
		</div>
		<!-- end #content -->
		

		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
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
