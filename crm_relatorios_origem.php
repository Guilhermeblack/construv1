<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php"; ?>
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

  <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/css/multiple-select.css" rel="stylesheet"/>

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
      <h1 class="page-header">Relatório - Origem</h1>
      <!-- end page-header -->
      
      <?php if(isset($_GET["cad"])){ 

        $resposta = $_GET["cad"];
        if($resposta == 1){ ?>
          <div class="alert alert-danger fade in m-b-15">
            <strong><font><font>Acesso Negado!!! </font></font></strong><font><font>
              Selecione apenas um campo, ou "Todos" na categoria.
            </font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
          </div>
        <?php }} ?> 
        
        <div class="col-md-12">
          <div class="panel panel-inverse">
            <div class="panel-heading">
              <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
              </div>
              <h4 class="panel-title">Filtro Relatório</h4>
            </div>
            <div class="panel-body">
             <form class="form-vertical form-bordered" name="myForm" method="POST" action="contratolocacao/crm_relatorios_origem.php">
              <div class="row">             

                <div class="form-group">

                  <label class="col-md-2 control-label">Categoria</label>
                  <div class="col-md-3">
                    <div class="input-group col-md-12">
                     <select class="form-control" name="categoria" id="cat" >
                      <option value="Todos">Todos</option>
                      <option value="1">Empreendimento</option>
                      <option value="2">Venda/Locação</option>
                    </select>
                  </div>
                </div>

                <label class="col-md-2 control-label">Empreendimento</label>
                <div class="col-md-5">
                  <div class="input-group">
                    <select class="default-select2 form-control" name="empreendimento_id" id="os" >
                      <option value="Todos">Todos</option>
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

      <div class="row">
        <div class="form-group">
          <label class="col-md-2 control-label">Locação / Venda</label>
          <div class="col-md-10">
            <div class="input-group">
             <select class="default-select2 form-control" name="idlocacao">
              <option value="Todos">Todos</option>
              <?php 
              include "conexao.php";
              $query_c = "SELECT * FROM imovel";

              $executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento mesmo");               

            while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos

              $idimovel             = $buscar_amigoc['idimovel'];
              $descricao             = $buscar_amigoc['endereco'];
              $num             = $buscar_amigoc['numero'];

              ?>
              <option value="<?php echo"$idimovel" ;?>"><?php echo "$descricao, $num" ;?></option>
            <?php }  ?>
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="form-group">
      <label class="col-md-2 control-label">Período</label>
      <div class="col-md-8">
        <div class="input-group">
          <input type="date" class="form-control" name="inicio" placeholder="Data Inicial" />
          <span class="input-group-addon">Até</span>
          <input type="date" class="form-control" name="fim" placeholder="Data Final"  />
        </div>
      </div>
    </div>

  </div>

  <div class="row">

    <div class="form-group">
      <label class="col-md-2 control-label">Origem</label>
      <div class="col-md-3">

        <select name="origemfil" class="form-control">
          <option value="">Todos</option>
          <?php 

          include "conexao.php";
          $query_slide = mysqli_query($db,"SELECT * FROM crm_origem
            GROUP by crm_idorigem Asc") or die ("Erro ao listar grupo dos clientes, tente mais tarde");


                                    while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

                                      $id          = $buscar_slide["crm_idorigem"];
                                      $origem          = $buscar_slide["crm_origemnome"];
                                      



                                      ?> 
                                      <option value="<?php echo $id ?>"><?php echo $origem ?></option>

                                    <?php } ?> 
                                  </select>

                                </div>
<div hidden="">
                                <label class="col-md-2 control-label">Status</label>
                                <div class="col-md-3">

                                  <select name="status3" class="form-control">
                                    <option value="">Todos</option>
                                    <?php 


                                    include "conexao.php";
                                    $query_slide = mysqli_query($db,"SELECT a.crm_idstatus as id, a.crm_status as nome  FROM crm_status as a GROUP BY a.crm_idstatus ORDER BY a.crm_status Asc") or die ("Erro ao listar grupo dos clientes, tente mais tarde");

            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

              $idstatus          = $buscar_slide["id"];
              $status2      = $buscar_slide["nome"];

              ?> 
              <option value="<?php echo $idstatus ?>"><?php echo $status2 ?></option>

            <?php } ?>

          </select>

        </div>
      </div>
    </div>
    </div>

    <div class="row" hidden="">
      <div class="form-group">
        <label class="col-md-2 control-label">Estado</label>
        <div class="col-sm-3">
          <select name="estado" class="form-control">
            <option value="">Todos</option>
            <?php 


            include "conexao.php";
            $query_slide = mysqli_query($db,"SELECT crm_uf AS uf, crm_id FROM crm_cli GROUP BY uf ORDER BY uf Asc") or die ("Erro ao listar grupo dos clientes, tente mais tarde");

            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

              $idstatus          = $buscar_slide["crm_id"];
              $status2      = $buscar_slide["uf"];

              ?> 
              <option value="<?php echo $status2 ?>"><?php echo $status2 ?></option>

            <?php } ?>
          </select>
        </div>

        <label class="col-sm-2 control-label">Cidade</label>
        <div class="col-sm-3">
          <select name="cidade" class="form-control">
            <option value="">Todos</option>

            <?php 


            include "conexao.php";
            $query_slide = mysqli_query($db,"SELECT crm_cidade AS cidade, crm_id FROM crm_cli GROUP BY cidade ORDER BY cidade Asc") or die ("Erro ao listar grupo dos clientes, tente mais tarde");

            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

              $idstatus          = $buscar_slide["crm_id"];
              $status2      = $buscar_slide["cidade"];

              ?> 
              <option value="<?php echo $status2 ?>"><?php echo $status2 ?></option>

            <?php } ?>

          </select>
        </div>
      </div>
    </div>

    <div class="row" hidden="">
      <div class="form-group">
        <label class="col-sm-2 control-label">Bairro</label>
        <div class="col-sm-3">
          <select name="bairro" class="form-control">
            <option value="">Todos</option>
             <?php 


                                    include "conexao.php";
                                    $query_slide = mysqli_query($db,"SELECT crm_bairro AS bairro, crm_id FROM crm_cli GROUP BY bairro ORDER BY bairro Asc") or die ("Erro ao listar grupo dos clientes, tente mais tarde");

            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

              $idstatus          = $buscar_slide["crm_id"];
              $status2      = $buscar_slide["bairro"];

              if (is_null($status2)) {
                $status2 = "centro";
              }
              ?> 
              <option value="<?php echo $status2 ?>"><?php echo $status2 ?></option>

            <?php } ?>
          </select>
        </div>
      </div>
    </div>

    <div class="row" hidden="">
      
        
      <div class="form-group">
        <label class="col-sm-2 control-label">Imobiliária</label>
        <div class="col-sm-3">
          <select name="imob" id="imob" class="form-control">
            <option value="">Todos</option>
             <?php 


                                    include "conexao.php";
                                    $query_slide = mysqli_query($db,"SELECT * FROM empreendimento_imob 
                            INNER JOIN cliente ON idcliente = imobiliaria_id group by imobiliaria_id") or die ("Erro ao listar grupo dos clientes, tente mais tarde");

            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

              $idstatus          = $buscar_slide["imobiliaria_id"];
              $status2      = $buscar_slide["nome_cli"];

              ?> 
              <option value="<?php echo $idstatus ?>"><?php echo $status2 ?></option>

            <?php } ?>
          </select>
        </div>

        <label class="col-sm-2 control-label">Corretor</label>
        <div class="col-sm-3">
          <select name="corretor" id="corretor2" class="form-control">
            <option value="">Todos</option>
             

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


  <script src="produtos_pagar.js"></script>
  <script src="lote_pagar.js"></script>
  <script type="text/javascript"> 
    $('#imob').on('change', function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'crm_editarroleta.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'id=' + $('#imob').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
      var $corretor2 = $('#corretor2');
            $corretor2.empty(); 
$corretor2.append("<option value=''> Todos </option>");
            $.each(data, function(idcliente, nome){
                   $corretor2.append('<option value=' + idcliente + '>' + nome + '</option>');
            }



            );

              $corretor2.change();       
                       
                 
                }
           });   
   return false;    
   });

  </script>
  <script type="text/javascript">
    document.getElementById('menucrm').style.display="block";
  </script>
  <script>
    $(document).ready(function() {
      App.init();
      TableManageButtons.init();
      FormPlugins.init();

    });
  </script>

</body>


</html>
