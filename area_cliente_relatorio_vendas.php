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
  
<?php include "topo_cliente.php"; ?>

   <?php    $idempreendimento = $_GET["idempreendimento"];     

   function empreendimento($idempreendimento)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM empreendimento
                       INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                       where idempreendimento = $idempreendimento";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $descricao           = $buscar_amigo["descricao_empreendimento"];                 
                            
      }
    
    return $descricao;

}

 function nome_imob($idcliente)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM cliente where idcliente = $idcliente";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar nome da imobiliaria");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $nome_cli           = $buscar_amigo["nome_cli"];                 
                            
      }
    
    return $nome_cli;

}


?>    <!-- begin #content -->
    <div id="content" class="content">
      
<ol class="breadcrumb pull-right">
    <?php if (in_array('28', $idrota)) { ?>
    <li><a href="gerar_contrato_empreendimento.php?idempreendimento=<?php echo $idempreendimento ?>"><span class="label label-success" style="font-size:100% !important">NOVO CONTRATO</span></a></li>
    <?php } ?>
</ol>
      <!-- begin page-header -->
      <h1 class="page-header">Relatório de Vendas de Lotes / <?php echo empreendimento($idempreendimento) ?></h1>
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
                            <h4 class="panel-title">Informações de Venda de Lotes</h4>
                        </div>
                      
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
<th>Nº Ficha</th>
                                        <th>Imobiliaria</th>
                                        <th>Cliente</th>
                                        <th>Data Venda</th>
                                        <th>Quadra</th>
                                        <th>Lote</th>
                                        <th>Parcelas</th>
                                          
                                          <th><p>Proposta</p>Compra</th>
 <th>Ações</th>
  <th>Documentos</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php

                $tipo_user = verifica_tipo($idcliente);
             
                $idempreendimento = $_GET["idempreendimento"];                       

                      include "conexao.php";
  
      $query_amigo = "SELECT venda.imobiliaria_idimobiliaria, idcliente, idvenda, idlote, nome_cli, lote, quadra, libera_proposta, status_venda, data_venda FROM venda
                INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente
                INNER JOIN lote    ON venda.lote_idlote = lote.idlote 
                INNER JOIN produto ON produto.idproduto = lote.produto_idproduto
                WHERE empreendimento_idempreendimento = $idempreendimento  
                order by idvenda desc";
    

  

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                 
            $idcliente        = $buscar_amigo['idcliente'];
            $idvenda          = $buscar_amigo["idvenda"];
            $idlote           = $buscar_amigo["idlote"];
            $nome_cli         = $buscar_amigo["nome_cli"];
            $lote             = $buscar_amigo["lote"];
            $quadra           = $buscar_amigo["quadra"];
            $libera_proposta  = $buscar_amigo["libera_proposta"];
            $status_venda     = $buscar_amigo["status_venda"];
            $data_venda       = $buscar_amigo["data_venda"];
            $idvenda_imob2       = $buscar_amigo["imobiliaria_idimobiliaria"];
            
             ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $idvenda ?></td>
                                        <td><?php 

                                       $nome_imob_v = nome_imob($idvenda_imob2);
                                        echo $nome_imob_v ?>
                                          


                                        </td>
                                        <td><?php echo $nome_cli ?></td>
                                        <td><?php echo $data_venda ?></td>
                                        <td><?php echo $quadra ?></td>
                                        <td><?php echo $lote ?></td>
                                        <td>
                                           <?php if($status_venda != 0){ ?>
                                       

                                      <a href="area_cliente_parcelas.php?idvenda=<?php echo $idvenda ?>&tipo=2">  <span class="label label-primary">Parcelas</span></a>
                                      <?php }  ?>
                                          </td>

                                          <td>
                                      
                                                                                
                                      <a href="proposta_compra/proposta_compra.php?idvenda=<?php echo $idvenda ?>"> <i class="fa fa-2x fa-file-pdf-o"></i></a>
                               
                                     
                                     
                                     </td>
                                    
                  <?php if($status_venda == 1){ ?>


                                  <td>
                                 

                                  <span class="label label-danger">Proposta Recusada</span>
                                     </td>


            <?php }else if($status_venda == 3) { ?>

                          <td>
                                 
                                  <span class="label label-success">Proposta Aprovada</span><br><br>

                                  <span class="label label-success">Contrato Lançado</span>

                                       
                                     </td>


                    <?php }else if($status_venda == 2) { ?>
              

                          <td>
                                 
                                  <span class="label label-success">Proposta Aprovada</span><br><br>
                                       <?php if (in_array('29', $idrota)) { ?>
                                       <a href="lancar_contrato_empreendimento.php?idlote=<?php echo $idlote?>&idvenda=<?php echo $idvenda ?>&idempreendimento=<?php echo $idempreendimento ?>"><span class="label label-primary" id="<?php echo $idvenda ?>">Lançar Contrato </span></a>
                                          <?php } ?>

                                     </td>
                  <?php }else{ ?>
                                      <?php if (in_array('29', $idrota)) { ?>                                           


                                      <td>
                                   <a href="confirmar_proposta.php?idlote=<?php echo $idlote?>&idvenda=<?php echo $idvenda ?>&idempreendimento=<?php echo $idempreendimento ?>"><span class="label label-success" id="<?php echo $idvenda ?>">Aprovar Proposta </span></a>
<br><br>
                                   <a href="cancelar.php?idlote=<?php echo $idlote?>&idvenda=<?php echo $idvenda ?>&idempreendimento=<?php echo $idempreendimento ?>"><span class="label label-danger" id="C<?php echo $idvenda ?>">Recusar Proposta</span></a>
                        </td>
                        <?php }else{ ?>
                        <td>
                        <span class="label label-warning">Em Negociação</span>
                      </td>



                        <?php  } } ?>
                            <td>

                              <?php if($idvenda <= 187){ ?>
                              <a href="area_cliente_ocorrencias_empreendimento.php?idempreendimento=<?php echo $idempreendimento ?>&idvenda=<?php echo $idvenda ?>"><span class="label label-success">Ver Documentos</span></a>
                              <?php }else{ ?>
                               <a href="area_cliente_documentos_empreendimento.php?idempreendimento=<?php echo $idempreendimento ?>&idvenda=<?php echo $idvenda ?>"><span class="label label-success">Ver Documentos</span></a>
                              <?php } ?>
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

 <script type="text/javascript">

$(function(){
$("#valor").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
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

    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/masked-input/masked-input.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/password-indicator/js/password-indicator.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/js/form-plugins.demo.min.js"></script>

  <!-- ================== END BASE JS ================== -->

  <!-- ================== END BASE JS ================== -->
  
  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/masked-input/masked-input.min.js"></script>
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
      FormPlugins.init();
      TableManageButtons.init();
    });
  </script>

</body>

</html>
