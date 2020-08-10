<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

            $idempreendimento = $_GET["idempreendimento"];


if(isset($_POST["empreendimento_cadastro_id"])){

    $empreendimento_cadastro_id     = $_POST["empreendimento_cadastro_id"];
    $comissao_entrada               = $_POST["comissao_entrada"];
    $comissao_restante              = $_POST["comissao_restante"];
    $pis                            = $_POST["pis"];
    $cofins                         = $_POST["cofins"];
    $multa_atraso                   = $_POST["multa_atraso"];
    $juros_atraso                   = $_POST["juros_atraso"];
    $dimob                          = $_POST["dimob"];
    $indice_correcao                = $_POST["indice_correcao"];
    $exibir_painel                  = $_POST["exibir_painel"];


    include "conexao.php";

    $atualiza = "UPDATE empreendimento SET 
                 empreendimento_cadastro_id = '$empreendimento_cadastro_id',
                 comissao_entrada           = '$comissao_entrada',
                 comissao_restante          = '$comissao_restante',
                 pis                        = '$pis',
                 cofins                     = '$cofins', 
                 multa_atraso               = '$multa_atraso', 
                 juros_atraso               = '$juros_atraso',
                 dimob                      = '$dimob',
                 indice_correcao            = '$indice_correcao',
                 exibir_painel              = '$exibir_painel'

                 WHERE idempreendimento = $idempreendimento";

    $executa_atualiza = mysqli_query($db, $atualiza);

    ?>
<script type="text/javascript">
    window.location="empreendimentos.php";
</script>
<?php } ?>









?>
<?php 





                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM empreendimento
                    where idempreendimento = $idempreendimento") or die ("Erro ao listar imoveis, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While cat



$empreendimento_cadastro_id     = $buscar_slide['empreendimento_cadastro_id'];
$comissao_entrada               = $buscar_slide['comissao_entrada'];
$comissao_restante              = $buscar_slide['comissao_restante'];
$pis                            = $buscar_slide['PIS'];
$cofins                         = $buscar_slide['COFINS'];
$multa_atraso                   = $buscar_slide['multa_atraso'];
$juros_atraso                   = $buscar_slide['juros_atraso'];
$dimob                          = $buscar_slide['dimob'];
$b_indice_correcao              = $buscar_slide['indice_correcao'];
$exibir_painel                  = $buscar_slide['exibir_painel'];


}




?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Aug 2016 20:37:38 GMT -->
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
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php include "topo.php"; ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Editar <small> Empreendimentos</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
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
                            <h4 class="panel-title">Preencha os campos!</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="alterar_empreendimentos.php?idempreendimento=<?php echo $idempreendimento ?>" method="POST" enctype="multipart/form-data">
                               
                                 

                             
                            
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Empreendimento</label>
                                    <div class="col-md-9">
                                         <select class="default-select2 form-control" name="empreendimento_cadastro_id" required="">
                                        <option value="">Escolha</option>
                                          <?php

                      include "conexao.php";
                 
                $query_amigo = "SELECT * FROM empreendimento_cadastro order by idempreendimento_cadastro desc";


                $executa_query = mysqli_query ($db, $query_amigo);
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                $idempreendimento_cadastro             = $buscar_amigo['idempreendimento_cadastro'];
                $descricao_empreendimento              = $buscar_amigo["descricao_empreendimento"];
              
             
            
             ?>
               <option value="<?php echo "$idempreendimento_cadastro" ?>"

                <?php if($idempreendimento_cadastro == $empreendimento_cadastro_id){ ?> selected <?php } ?>

                > <?php echo "$descricao_empreendimento " ?> </option>
                    <?php } ?>
                    
                                           
                                        </select>

                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Taxa Adm Parcelas Entrada</label>
                                    <div class="col-md-9">
                                        <input type="text" name="comissao_entrada" id="comissao_entrada" value="<?php echo $comissao_entrada ?>" class="form-control">


                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Taxa Adm Parcelas Financiamento</label>
                                    <div class="col-md-9">
                                        <input type="text" name="comissao_restante" id="comissao_restante" value="<?php echo $comissao_restante ?>" class="form-control">


                                    </div>
                                </div>
                              
                               <div class="form-group">
                                    <label class="col-md-3 control-label">PIS</label>
                                    <div class="col-md-9">
                                        <input type="text" name="pis" id="pis" value="<?php echo $pis ?>" class="form-control">


                                    </div>
                                </div>
                              
                              
                               <div class="form-group">
                                    <label class="col-md-3 control-label">COFINS</label>
                                    <div class="col-md-9">
                                        <input type="text" name="cofins" id="cofins" value="<?php echo $cofins ?>" class="form-control">


                                    </div>
                                </div> 
                                         

                            <div class="form-group">
                                    <label class="col-md-3 control-label">% Multa Atraso</label>
                                    <div class="col-md-9">
                                        <input type="text" name="multa_atraso" id="multa_atraso" value="<?php echo $multa_atraso ?>" class="form-control">


                                    </div>
                                </div> 


                            <div class="form-group">
                                    <label class="col-md-3 control-label">% Juros Atraso</label>
                                    <div class="col-md-9">
                                        <input type="text" name="juros_atraso" id="juros_atraso" value="<?php echo $juros_atraso ?>" class="form-control">


                                    </div>
                                </div> 
                             
                                <div class="form-group">
                                    <label class="col-md-3 control-label">DIMOB</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="dimob" value="1"
                                        <?php if($dimob == 1){ ?>  checked <?php } ?>
                                        >


                                    </div>
                                </div>
                            
                                          <div class="form-group">
                                    <label class="col-md-3 control-label">Indice Reajuste</label>
                                    <div class="col-md-9">
                                         <select class="default-select2 form-control" name="indice_correcao" required="">
                                        <option value="">Escolha</option>
                                          <?php

                      include "conexao.php";
                 
                $query_indice = "SELECT * FROM indice_correcao order by idindice_correcao desc";


                $executa_indice = mysqli_query ($db, $query_indice);
                while ($buscar_indice = mysqli_fetch_assoc($executa_indice)) {//--verifica se são amigos
           
                $idindice_correcao             = $buscar_indice['idindice_correcao'];
                $descricao_indice              = $buscar_indice["descricao_indice"];
              
             
            
             ?>
               <option value="<?php echo "$idindice_correcao" ?>"

                <?php if($b_indice_correcao == $idindice_correcao){ ?> selected <?php } ?>

                > <?php echo "$descricao_indice" ?> </option>
                    <?php } ?>
                    
                                           
                                        </select>

                                    </div>
                                </div>
                                
                             
                              
                              
                             
                              <div class="form-group">
                                    <label class="col-md-3 control-label">Exibir no Painel</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="exibir_painel" value="1"
                                        <?php if($exibir_painel == 1){ ?>  checked <?php } ?>
                                        >


                                    </div>
                                </div>

                            

                                


                                
                                


                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-sm btn-success">Alterar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->


          
          
		</div>
		<!-- end #content -->
		
     
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>

       <script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

    <!-- ================== END PAGE LEVEL JS ================== -->
        <script type="text/javascript">
           
$(function(){

$("#comissao_entrada").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});
 

$("#comissao_restante").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});

$("#pis").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});

$("#cofins").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});
 
$("#multa_atraso").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});




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

    <!-- ================== END PAGE LEVEL JS ================== -->
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
