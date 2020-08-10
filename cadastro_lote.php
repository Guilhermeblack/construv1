<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
?>


<?php
if(isset($_POST["idproduto"])){
  $idproduto = $_POST["idproduto"];
  $lote      = $_POST["lote"];
  $m2        = $_POST["m2"];
  $valor     = $_POST["valor"];

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



  $valor_inicial2 = str_replace("R$","", $valor);
  $valor_inicial3 = str_replace(".","", $valor_inicial2);
  $valor_inicial4 = str_replace(",",".", $valor_inicial3);


  include "conexao.php";

  $inserir = "INSERT INTO lote(lote, m2, valor, produto_idproduto, status, frente, fundo, direita, esquerda, moutros, mfrente, mfundo, mle, mld, coutros)values('$lote','$m2','$valor_inicial4','$idproduto','1', '$frente', '$fundo', '$direito', '$esquerdo', '$moutros', '$cfrente', '$cfundo', '$cesquerdo', '$cdireito', '$coutros')";

  $insert = mysqli_query($db, $inserir);
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

  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>







</head>
<body>
  <?php 

  function tem_contrato($idvenda)
  {

    include "conexao.php";
    $query_amigo = "SELECT SUM(idvenda) as TOTAL FROM venda                     
    where lote_idlote = $idvenda";

    $executa_query = mysqli_query ($db, $query_amigo);
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

      $idvenda             = $buscar_amigo["TOTAL"];



    }     
    return $idvenda; 


  }

  ?>
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


      $idproduto = $_GET["idproduto"]; 

      include "conexao.php";
      $query_slide = mysqli_query($db, "SELECT * FROM produto

        where idproduto = $idproduto
        ") or die ("Erro ao listar imoveis, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

             $quadra      = $buscar_slide["quadra"];
           }
           ?>	

           Cadastro de Lote: <?php echo " $quadra"; ?> </h1>
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
                <?php $idproduto = $_GET["idproduto"]; ?>
                <form class="form-horizontal form-bordered" action="cadastro_lote.php?idproduto=<?php echo $idproduto ?>" name="cad_venda" method="POST">





                 <div class="form-group">
                  <label class="col-md-3 control-label">Lote</label>
                  <div class="col-md-9">
                    <input type="text" name="lote" class="form-control">
                    <input type="hidden" name="idproduto" value="<?php echo $idproduto ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">M²</label>
                  <div class="col-md-9">
                    <input type="text" name="m2" class="form-control">

                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Valor</label>
                  <div class="col-md-9">
                    <input type="text" name="valor" id="valor_inicial2" class="form-control">

                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">Frente</label>
                  <div class="col-md-9">
                    <input type="text" name="frente" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Fundo</label>
                  <div class="col-md-9">
                    <input type="text" name="fundo" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Direito</label>
                  <div class="col-md-9">
                    <input type="text" name="direito" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Esquerdo</label>
                  <div class="col-md-9">
                    <input type="text" name="esquerdo" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">M. Outros</label>
                  <div class="col-md-9">
                    <input type="text" name="moutros" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">C. Frente</label>
                  <div class="col-md-9">
                    <input type="text" name="cfrente" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">C. Fundo</label>
                  <div class="col-md-9">
                    <input type="text" name="cfundo" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">C. Direito</label>
                  <div class="col-md-9">
                    <input type="text" name="cdireito" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">C. Esquerdo</label>
                  <div class="col-md-9">
                    <input type="text" name="cesquerdo" class="form-control">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">C. Outros</label>
                  <div class="col-md-9">
                    <input type="text" name="coutros" class="form-control">
                    
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
        <h4 class="panel-title">Lotes Cadastrados</h4>
      </div>

      <div class="panel-body">
        <table id="data-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Quadra</th>
              <th>Lote</th>
              <th>M2</th>
              <th>Status</th>
              <th>Valor</th>
              <th>Matricula</th>
              <th>Cad. Prefeitura</th>
              <th>Confrontação</th>
              <th>Endereço</th>

              <th>Ações</th>

            </tr>
          </thead>
          <tbody>

            <?php 

            include "conexao.php";
            $query_slide = mysqli_query($db, "SELECT * FROM lote
              INNER join produto on produto.idproduto = lote.produto_idproduto
              where produto_idproduto = $idproduto
              order by idlote desc") or die ("Erro ao listar imoveis, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
             $idlote      = $buscar_slide["idlote"];
             $quadra      = $buscar_slide["quadra"];
             $lote        = $buscar_slide["lote"];
             $m2          = $buscar_slide["m2"];
             $status          = $buscar_slide["status"];
             $valor       = $buscar_slide["valor"];

             $matricula           = $buscar_slide["matricula"];
             $cadastro_prefeitura = $buscar_slide["cadastro_prefeitura"];
             $confrontacao        = $buscar_slide["confrontacao"];
             $endereco            = $buscar_slide["endereco"];

             $idproduto       = $buscar_slide["produto_idproduto"];


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

              <td><?php echo "$quadra" ?></td>
              <td><?php echo "$lote" ?></td>
              <td><?php echo "$m2" ?></td>
              <td><?php echo "$status_desc" ?></td>
              <td><?php echo 'R$ ' . number_format($valor, 2, ',', '.');  ?> </td>

              <td><?php echo "$matricula" ?></td>
              <td><?php echo "$cadastro_prefeitura" ?></td>
              <td><?php echo "$confrontacao" ?></td>
              <td><?php echo "$endereco" ?></td>


              <td>
                <a href="editar_lote.php?lote=<?php echo $idlote ?>&idproduto=<?php echo $idproduto ?>">  <span class="label label-warning">Editar Lote</span></a><br><br>
                <?php 
                $tem_contrato = tem_contrato($idlote);
                if($tem_contrato == null){

                  if (in_array('52', $idrota)) { 
                    ?>
                    <a href="excluir_lote.php?idlote=<?php echo $idlote ?>&idproduto=<?php echo $idproduto ?>">  <span class="label label-danger">Excluir</span></a><br><br>

                  <?php } ?>


                  <?php if($status != 3){  ?>


                    <a href="recebe_bloqueio.php?lote=<?php echo $idlote ?>&idproduto=<?php echo $idproduto ?>">  <span class="label label-inverse">Bloquear Lote</span></a><br><br>
                  <?php }else{ ?>
                    <a href="recebe_desbloqueio.php?lote=<?php echo $idlote ?>&idproduto=<?php echo $idproduto ?>">  <span class="label label-success">Desbloquear Lote</span></a>
                  <?php } ?>


                <?php } ?>
              </td>                        



            </tr>

          <?php } ?>









        </tbody>

      </table>
    </div>
  </div>

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
