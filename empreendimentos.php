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
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
	
<?php include "topo.php";

function imob_id($id){
    include "conexao.php";
    $query_igpm = "SELECT imob_id FROM cliente where idcliente = $id";

    $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar Nome User");
                
        while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $imob_id             = $buscar_amigoc['imob_id'];
		}
return $imob_id;

} 


 ?>

		
		<!-- begin #content -->
		<div id="content" class="content">
		
			<ol class="breadcrumb pull-right">
				
				
				<?php if (in_array('25', $idrota)) { ?>
				<li><a href="cadastro_empreendimento.php"><span class="label label-primary" style="font-size:100% !important">NOVA GESTÃO</span></a></li>
				<?php } ?>	
			</ol>

			<!-- begin page-header -->
			<h1 class="page-header">Empreendimentos</h1>
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
                            <h4 class="panel-title">Empreendimentos Cadastrados</h4>
                        </div>

                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Titular</th>
                                        <th>Empreendimento</th>
                                        <th>Quant. Lotes</th>
                                       
                                        <th>Contratos</th>
                                        <th>Espelho de Vendas</th>
                                          <th>Ações</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 

                include "conexao.php";
                if($idgrupo_acesso == 6){   

                $query_slide = "SELECT * FROM empreendimento
                								 INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                								 INNER JOIN empreendimento_imob ON empreendimento_cadastro.idempreendimento_cadastro = empreendimento_imob.empreendimento_id
                								 WHERE imobiliaria_id = $imobiliaria_idimobiliaria
                    group by idempreendimento_cadastro order by idempreendimento desc";
            }elseif($idgrupo_acesso == 7){
            	$imob_id = imob_id($imobiliaria_idimobiliaria);
            	 $query_slide = "SELECT * FROM empreendimento
                								 INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                								 INNER JOIN empreendimento_imob ON empreendimento_cadastro.idempreendimento_cadastro = empreendimento_imob.empreendimento_id
                								 WHERE imobiliaria_id = $imob_id
                    group by idempreendimento_cadastro order by idempreendimento desc";
            }else{
            	 $query_slide ="SELECT * FROM empreendimento
                								 INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                								
                    group by idempreendimento_cadastro order by idempreendimento desc";
            }
            $executa_query = mysqli_query($db, $query_slide);
            while ($buscar_slide = mysqli_fetch_assoc($executa_query)) {//--While categoria
           
             $idempreendimento      = $buscar_slide["idempreendimento"];
             $descricao             = $buscar_slide["descricao_empreendimento"];
             $qtd_lotes             = $buscar_slide["qtd_lotes"];
             $cliente_id            = $buscar_slide["cliente_id"];
          

                    ?> 
                                
                                   <tr class="odd gradeX">
                                       
                                        <td><?php echo nome_user($cliente_id); ?></td>
                                        <td><?php echo "$descricao " ?></td>
                                        <td><?php echo $qtd_lotes ?></td>

                                        
                                        <td>
                          					<?php if (in_array('27', $idrota)) { ?>
                                        	<a href="relatorio_vendas.php?idempreendimento=<?php echo "$idempreendimento"; ?>"><span class="badge badge-success">Contratos</span></a>
                                        	<?php } ?>

                                        </td>
                                       
                                         <td>
                                         	<?php if (in_array('30', $idrota)) { ?>
                                         	<a href="relatorio_lotes.php?idempreendimento=<?php echo "$idempreendimento"; ?>"><span class="badge badge-success">Espelho de Vendas</span></a>


                                         	<a href="lotes_mapa.php?empreendimento_id=<?php echo "$idempreendimento"; ?>"><span class="badge badge-success">Mapa do Empreendimento</span></a>




                                         	<?php } ?>
                                         	</td>

	      						<td>
	      						                               	<?php if (in_array('26', $idrota)) { ?>

                                    

														
										
											<a href="alterar_empreendimentos.php?idempreendimento=<?php echo $idempreendimento ?>">	<span class="label label-warning">Editar</span></a>
										   

										    <a href="descontos.php?idempreendimento=<?php echo $idempreendimento ?>">	<span class="label label-danger">Configurações</span>		</a>



							
							                                         <?php } ?>

                                         </td>                        
     

                                    </tr>

                                    <?php } ?>


                                   





                                 
                                </tbody>

                            </table>
                        </div>
                    </div>
               
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
