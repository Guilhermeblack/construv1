<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
?>


<?php
if(isset($_GET["edicao"])){
  $idproduto = $_GET["idproduto"];
  $idlote      = $_GET["lote"];

  $lote      = $_POST["lote"];
  $m2        = $_POST["m2"];
  $valor     = $_POST["valor"];

  $matricula               = $_POST["matricula"];
  $cadastro_prefeitura     = $_POST["cadastro_prefeitura"];
  $endereco                = $_POST["endereco"];


  $frente        = $_POST["frente"];
  $fundo         = $_POST["fundo"];
  $direito       = $_POST["direito"];
  $esquerdo      = $_POST["esquerdo"];
  $moutros       = $_POST["moutros"];
  $cfrente       = $_POST["cfrente"];
  $cfundo        = $_POST["cfundo"];
  $cesquerdo     = $_POST["cesquerdo"];
  $cdireito      = $_POST["cdireito"];
  $coutros       = $_POST["coutros"];


  $valor = str_replace("R$","", $valor);
  $valor = str_replace(".","", $valor);
  $valor = str_replace(",",".", $valor);
  $valor = str_replace(" ","", $valor);


  include "conexao.php";

  $atualiza = "UPDATE lote SET 
  lote  = '$lote',
  m2    = '$m2',
  valor = '$valor',
  matricula = '$matricula',
  cadastro_prefeitura = '$cadastro_prefeitura',
  endereco = '$endereco',
  frente = '$frente',
  fundo = '$fundo', 
  direita = '$direito', 
  esquerda = '$esquerdo', 
  moutros = '$moutros', 
  mfrente = '$cfrente', 
  mfundo = '$cfundo', 
  mle = '$cesquerdo', 
  mld = '$cdireito', 
  coutros = '$coutros'
  WHERE idlote = $idlote";

  $update = mysqli_query($db, $atualiza);
  ?>
  <script type="text/javascript">
    window.location="cadastro_lote.php?idproduto=<?php echo $idproduto ?>&lote=<?php echo $idlote ?>"
  </script>
<?php } ?>
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







</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->


		
   <?php include "topo.php" ?>

   <!-- begin #content -->
   <div id="content" class="content">

     <!-- begin page-header -->
     <h1 class="page-header">


      <?php


      $idproduto   = $_GET["idproduto"]; 
      $idlote      = $_GET["lote"]; 

      include "conexao.php";
      $query_slide = mysqli_query($db, "SELECT * FROM lote
       where idlote = $idlote
       ") or die ("Erro ao listar lote, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

             $lote                = $buscar_slide["lote"];
             $m2                  = $buscar_slide["m2"];
             $valor               = $buscar_slide["valor"];
             $matricula           = $buscar_slide["matricula"];
             $cadastro_prefeitura = $buscar_slide["cadastro_prefeitura"];
             $confrontacao        = $buscar_slide["confrontacao"];
             $endereco            = $buscar_slide["endereco"];
             $frente              = $buscar_slide["frente"];
             $fundo               = $buscar_slide["fundo"];
             $direito             = $buscar_slide["direita"];
             $esquerdo            = $buscar_slide["esquerda"];
             $moutros             = $buscar_slide["moutros"];
             $cfrente             = $buscar_slide["mfrente"];
             $cfundo              = $buscar_slide["mfundo"];
             $cesquerdo           = $buscar_slide["mle"];
             $cdireito            = $buscar_slide["mld"];
             $coutros             = $buscar_slide["coutros"];
           }
           ?>	

           Editar Lote: <?php echo " $lote"; ?> </h1>
           <!-- end page-header -->

           <!-- begin row -->
           <div class="row">
            <!-- begin col-6 -->
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
                <h4 class="panel-title">Informações</h4>

              </div>

              <div class="panel-body panel-form">

                <form class="form-horizontal form-bordered" action="editar_lote.php?idproduto=<?php echo $idproduto ?>&lote=<?php echo $idlote ?>&edicao=1" name="cad_venda" method="POST">





                 <div class="form-group">
                  <label class="col-md-3 control-label">Lote</label>
                  <div class="col-md-9">
                    <input type="text" name="lote" class="form-control" value="<?php echo $lote ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">M²</label>
                  <div class="col-md-9">
                    <input type="text" name="m2" class="form-control" value="<?php echo $m2 ?>">

                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">Valor</label>
                  <div class="col-md-9">
                    <input type="text" name="valor" id="valor_inicial2" value="<?php echo 'R$' . number_format($valor, 2, ',', '.'); ?>" class="form-control">

                  </div>
                </div>



                <div class="form-group">
                  <label class="col-md-3 control-label">Matricula</label>
                  <div class="col-md-9">
                    <input type="text" name="matricula"  value="<?php echo $matricula ?>" class="form-control">

                  </div>
                </div>


                <div class="form-group">
                  <label class="col-md-3 control-label">Cadastro na Prefeitura</label>
                  <div class="col-md-9">
                    <input type="text" name="cadastro_prefeitura"  value="<?php echo $cadastro_prefeitura ?>" class="form-control">

                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">Endereço</label>
                  <div class="col-md-9">
                    <input type="text" name="endereco" value="<?php echo $endereco ?>" class="form-control">

                  </div>
                </div>


                <div class="form-group">
                  <label class="col-md-3 control-label">Frente</label>
                  <div class="col-md-9">
                    <input type="text" name="frente" value="<?php echo $frente ?>" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Fundo</label>
                  <div class="col-md-9">
                    <input type="text" name="fundo" value="<?php echo $fundo ?>" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Direito</label>
                  <div class="col-md-9">
                    <input type="text" name="direito" value="<?php echo $direito ?>" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Esquerdo</label>
                  <div class="col-md-9">
                    <input type="text" name="esquerdo" value="<?php echo $esquerdo ?>" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">M. Outros</label>
                  <div class="col-md-9">
                    <input type="text" name="moutros" value="<?php echo $moutros ?>" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">C. Frente</label>
                  <div class="col-md-9">
                    <input type="text" name="cfrente" value="<?php echo $cfrente ?>" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">C. Fundo</label>
                  <div class="col-md-9">
                    <input type="text" name="cfundo" value="<?php echo $cfundo ?>" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">C. Direito</label>
                  <div class="col-md-9">
                    <input type="text" name="cdireito" value="<?php echo $cdireito ?>" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">C. Esquerdo</label>
                  <div class="col-md-9">
                    <input type="text" name="cesquerdo" value="<?php echo $cesquerdo ?>" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">C. Outros</label>
                  <div class="col-md-9">
                    <input type="text" name="coutros" value="<?php echo $coutros ?>" class="form-control">
                    
                  </div>
                </div>

              </div>
            </div>
            <!-- end panel -->
          </div>






          <div class="col-md-12">
           <!-- begin panel -->
           <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
            <div class="panel-heading">


            </div>
            <div class="panel-body">
             <div class="form-group">

              <div class="col-md-9">
               <input type="submit" class="btn btn-success m-r-5 m-b-5" value="Cadastrar" />
             </div>
           </div>









         </div>
       </div>
       <!-- end panel -->

     </form>
   </div>






 </div>
 <!-- end row -->

</div>



<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>

<script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

<script type="text/javascript">
  $(function(){
    $("#valor_inicial2").maskMoney({symbol:'R$ ', 
      showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
  })

  $(function(){
    $("#valor_aluguel2").maskMoney({symbol:'R$ ', 
      showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
  })
</script>


<!-- ================== BEGIN BASE JS ================== -->

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
