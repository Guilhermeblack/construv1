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
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>

  <!-- ================== END BASE JS ================== -->
</head>
<body>
  <!-- begin #page-loader -->
  <div id="page-loader" class="fade"><span class="spinner"></span></div>
  <!-- end #page-loader -->
  
  <!-- begin #page-container -->
    <div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
  
<?php include "topo.php"; ?>

   <?php       

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
                  $empreendimento_id           = $buscar_amigo["empreendimento_cadastro_id"];                 
                            
      }

      $dados["descricao_empreendimento"] = $descricao;
      $dados["empreendimento_id"] = $empreendimento_id;

    return $dados;

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


 function renegociacao($idvenda)
{

       include "conexao.php";
       $query_amigo = "SELECT * FROM venda_renegociacao where venda_id = $idvenda and status = 0";
       $executa_query = mysqli_query ($db,$query_amigo);
       $total = mysqli_num_rows($executa_query);    
           
      return $total;

}


?>    <!-- begin #content -->
    <div id="content" class="content">
      

      <!-- begin page-header -->
      <h1 class="page-header">Relatório de Vendas </h1>
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
                            <h4 class="panel-title">Filtro de dados</h4>
                        </div>
                        <div class="panel-body">
                           <form class="form-vertical form-bordered" name="myForm" method="GET" action="contratolocacao/vendas.php">
                   <div class="row">    
  <div class="form-group">
                                    <label class="col-md-2 control-label">Empreendimento</label>
                                    <div class="col-md-4">
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
                                   <div class="form-group">
                                    <label class="col-md-2 control-label">Quadra</label>
                                    <div class="col-md-4">
                                        <div class="">
  <select name="idquadra"  id="quadra" class="form-control">
                                       </select>                                
                                           
                                        </div>
                                    </div>
                                </div>

                                   <div class="form-group">
                                    <label class="col-md-2 control-label">Lote</label>
                                    <div class="col-md-4">
                                        <div class="">
<select name="lote"  id="lote" class="form-control">
<option value="">Escolha</option>
                                          

                                        </select>                                          
                                           
                                        </div>
                                    </div>
                                </div>


                                  
                                                                   

                                  
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Status</label>
                                    <div class="col-md-4">
                                        <div class="">
                                            <select name="status_venda" class="form-control">
                        <option value="Todos">Todos</option>                                                    
                        <option value="0">Proposta em Analise</option>
                        <option value="1">Proposta Recusada</option>
                        <option value="2">Proposta Aprovada</option>
                        <option value="3">Contrato Ativo/Concluido</option>
                                                       
                                                    
                                                       </select>
                                          
                                           
                                        </div>
                                    </div>
                                </div>

                                     <div class="form-group">
                                    <label class="col-md-2 control-label">Imobiliaria</label>
                                    <div class="col-md-4">
                                        <div class="">
                                            <select class="form-control" name="imobiliaria_id" id="imobiliaria_id">
                                        <option value="Todos">Todos</option>
                      <?php

                      include "conexao.php";
                
        $query_amigo = "SELECT * FROM cliente
                        INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                        WHERE idtipo = 11 order by nome_cli Asc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
              $idcliente             = $buscar_amigo['idcliente'];
              $nome_cli              = $buscar_amigo["nome_cli"];
                $cpf_cli              = $buscar_amigo["cpf_cli"];
        
             
            
             ?>
                <option value="<?php echo $idcliente ?>"> <?php echo $nome_cli ?> </option>
            <?php } ?>

                                           
                                        </select>
                                          
                                           
                                        </div>
                                    </div>
                                </div>

                              <div class="form-group">
                                    <label class="col-md-2 control-label">Corretor</label>
                                    <div class="col-md-4">
                                        <div class="">
                                            <select class="form-control" name="corretor_id" id="corretor_id">
                                        <option value="0">Escolha</option>

                                           
                                        </select>
                                          
                                           
                                        </div>
                                    </div>
                                </div>
</div>
                             <div class="row">
                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Período</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="inicio" placeholder="Data Inicial" />
                                            <span class="input-group-addon">Até</span>
                                            <input type="date" class="form-control" name="fim" placeholder="Data Final"  />
                                        </div>
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

           <script type='text/javascript' src='produtos_pagar.js'></script>
   <script type='text/javascript' src='lote_pagar.js'></script>
  <!-- ================== END PAGE LEVEL JS ================== -->
  
  <script>
    $(document).ready(function() {
      App.init();
      FormPlugins.init();
      TableManageButtons.init();
    });
  </script>
 <script type="text/javascript">
  $(document).click( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#imobiliaria_id').click(function(){


           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_corretor.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'imobiliaria_id=' + $('#imobiliaria_id').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
            
            var $corretor = $('#corretor_id');
            $corretor.empty();
                  
            $.each(data, function(idcorretor, corretor){
                   $corretor.append('<option value=' + idcorretor + '>' + corretor + '</option>');
            });

              $corretor.change();        
                              
    
    
                    
                       
                 
                }
           });   
   return false;    
   })
});
</script>
</body>

</html>
