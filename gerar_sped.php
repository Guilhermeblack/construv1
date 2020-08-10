<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
if (!isset($_SESSION)) {
  session_start();
} 

  // echo "<pre>";
  // print_r($_SERVER); die();
  // echo "</pre>";

require_once("contratolocacao/dompdf/dompdf_config.inc.php");

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
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
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

  <?php 
  

  if(isset($_GET['acao'])){


    include "conexao.php";

    $empresa = $_GET['empresa'];
    $arquivo = $_GET['nome_arquivo'];
      //echo $empresa ." - " . $arquivo;

    $query_amigo = "SELECT * FROM sped_arquivos WHERE id_empresa = '$empresa' 
    AND nome_arquivo = '$arquivo'  order by id_arq DESC "; 




    $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar arquivo do sped");


            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

              $arquivo    = $buscar_amigo["nome_arquivo"];
              $datacriacao  = $buscar_amigo["data_geracao"];
              $path  = $buscar_amigo['path_arq'];
              $htmlarquivo = $buscar_amigo['html_arquivo'];








            }

            $html = html_entity_decode($htmlarquivo);
  //echo $html;
            $exten = DATE('dmY');
            $filename = 'sped-'. $exten .'.pdf';

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("A4","landscape");
            ob_clean();

            $pdf = $dompdf->render();
            $canvas = $dompdf->get_canvas(); 
            $font = Font_Metrics::get_font("helvetica", "bold"); 
            $canvas->page_text(510, 18, "", $font, 6, array(0,0,0)); 
            $canvas->page_text(270, 792, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); 
            header("Content-type: application/pdf"); 


            $dompdf->stream($filename, 
              array(
                "Attachment" => 1
              )
            );

          }


          ?>




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

           <?php



           if(isset($_GET['status']) && !empty($_GET['status'])){ 

            if($_GET['status'] == 'Ok'){
              ?>
              <h1 class="page-header">SPED  </font></h1>

              <?php

            }

          }else{

            ?>
            <h1 class="page-header">SPED</h1>

            <?php

          }
          ?>




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
                <form class="form-vertical form-bordered" name="myForm" method="GET" action="contratolocacao/sped-exports.php">

            <!--  <div class="row" style="margin-top:10px !important">
            -->
            <div class="row"> 
              <div class="form-group" style="margin-left: 10px;">
                <label class="col-md-2 control-label">Empresa:</label>
                <div class="col-md-8 input-group">
                  <select class="form-control" name="idcliente" required="">
                    <option value="">Escolha</option>
                    <?php

                    include "conexao.php";

                    // $query_amigo = "SELECT * FROM cliente
                    // INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                    // INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                    // where cliente_tipo.idtipo = 1  order by nome_cli Asc";
                    $query_amigo = "SELECT DISTINCT cliente.nome_cli, cliente.idcliente FROM `empreendimento_cadastro` INNER JOIN cliente ON empreendimento_cadastro.cliente_id = cliente.idcliente";



                    $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar Locatário");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $idcliente             = $buscar_amigo['idcliente'];
                  $empresa              = $buscar_amigo["nome_cli"];
                  $cpf_cli               = $buscar_amigo["cpf_cli"];

                  ?>
                  <option value="<?php echo "$idcliente" ?>"> <?php echo "$empresa " ?> </option>
                  <?php } ?>

                </select>
                <input type="hidden"  name="empresa" value="<?php echo $empresa?>">

              </div>
            </div>


            
          </div>

          <br>







          <div class="form-group">
            <label class="col-md-2 control-label">Período</label>
            <div class="col-md-10">
              <div class="input-group">
                <input type="date" required="" class="form-control" name="inicio" placeholder="Data Inicial" />
                <span class="input-group-addon">Até</span>
                <input type="date" required="" class="form-control" name="fim" placeholder="Data Final"  />
              </div>
            </div>
          </div>

        </div>                                   </div>
      </div>


      <div class="form-group">

        <div class="col-md-12">
          <input type="submit" class="btn btn-sm btn-success" value="Gerar" />
        </div>
      </div>

    </form>



  </div>
</div>
</div>

<?php 
if(isset($_GET['passaid']) && !empty($_GET['passaid'])){
  $idrecebido = $_GET['passaid'];

  $query_amigo = "SELECT  nome_cli FROM cliente WHERE idcliente = $idrecebido"; 




  $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar cliente");
  $buscar_amigo = mysqli_fetch_assoc($executa_query);
  $nome_empresa = $buscar_amigo['nome_cli'];

  ?>


  <div class="row">
   <div class="col-md-6" style="margin-left: 18%; width: 77%">
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <div class="panel-heading-btn">
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
        <h4 class="panel-title">SPED DA EMPRESA - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php  echo $nome_empresa; ?></h4>
      </div>
      <div>
        <table  class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Arquivo</th>                                        
              <th>Data</th>
              <th>Download</th>

            </tr>
          </thead>
          <tbody>

            <?php


            include "conexao.php";


            $query_amigo = "SELECT * FROM sped_arquivos WHERE id_empresa = $idrecebido   order by id_arq DESC "; 




            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar cliente");


            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

              $arquivo    = $buscar_amigo["nome_arquivo"];
              $datacriacao  = $buscar_amigo["data_geracao"];
              $path  = $buscar_amigo['path_arq'];
              $htmlarquivo = $buscar_amigo['html_arquivo'];


              ?>
              <?php
              
              ?>
              <tr class="odd gradeX">
                <td><?php echo $arquivo ?></td>
                <td><?php echo date('d/m/Y H:i:s',strtotime($datacriacao)) ?></td>
                <td>   
                  <a href="<?php echo $path;?>" target="_blank" download >  <span class="label label-success"> Download TXT</span></a>&nbsp;&nbsp;
                  <a href="gerar_sped_pdf.php?passaid=<?php echo $idrecebido;?>&arquivo=<?php echo $arquivo;?>" target="_blank" download >  <span class="label label-danger"> Download PDF</span></a>&nbsp;&nbsp;


                </td>
              </tr>
              <?php } ?>


            </tbody>
          </table>
        </div>
      </div>
      <!-- end panel -->
    </div>
    <!-- end col-10 -->







  </div>
  <!-- end row -->
  <!-- end #content -->

  <?php

}

?>




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
    <?php
    $url = $_SERVER['SERVER_NAME'];

    ?>


    $(document).ready(function() {
      App.init();
      TableManageButtons.init();
    });
  </script>

</body>


</html>

