<?php
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

function retorna_dados_cliente($id, $idvenda, $tipo_venda){





if($tipo_venda == 2)
{
 $inner = 'INNER JOIN venda ON venda.idvenda = parcelas.venda_idvenda
           INNER JOIN lote ON venda.lote_idlote = lote.idlote
           INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
           INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
           INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
 $tabela_inner = 'venda.cliente_idcliente';
 $juros_hr = '0200';

}
if($tipo_venda == 3)
{
 $inner = 'INNER JOIN contrato_pagar ON contrato_pagar.idcontrato_pagar = parcelas.venda_idvenda
          
           INNER JOIN empreendimento ON contrato_pagar.empreendimento_id = empreendimento.idempreendimento 
           INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
 $tabela_inner = 'contrato_pagar.fornecedor_idfornecedor';
 $juros_hr  = '0200';
}
if($tipo_venda == 1)
{
 $inner = 'INNER JOIN locacao ON locacao.idlocacao = parcelas.venda_idvenda';
 $tabela_inner = 'locacao.cliente_idcliente';
 $juros_hr = '1000';
}
if($tipo_venda == 4)
{
 $inner = 'INNER JOIN contrato_receber ON contrato_receber.idcontrato_receber = parcelas.venda_idvenda
         
           INNER JOIN empreendimento ON contrato_receber.empreendimento_id = empreendimento.idempreendimento 
           INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';

 $tabela_inner = 'contrato_receber.cliente_idcliente';
 $juros_hr  = '0200';
}

$wes_hoje = date('dmy');
        include "conexao.php";
          $query_amigo323 = "SELECT * FROM parcelas ".$inner."  
                
                INNER JOIN cliente ON ".$tabela_inner." = cliente.idcliente
                WHERE idparcelas = $id";

        

                $executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar dados cliente");
                
                
            while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            $idcliente                  = $buscar_amigo323['idcliente'];
            $nome_cli                   = $buscar_amigo323['nome_cli'];
            $descricao_empreendimento   = $buscar_amigo323['descricao_empreendimento'];
            $quadra                     = $buscar_amigo323['quadra'];
            $lote                       = $buscar_amigo323['lote'];


            }
            $dados['nome_cli']                 = $nome_cli;
            $dados['descricao_empreendimento'] = $descricao_empreendimento;
            $dados['quadra']                   = $quadra;
            $dados['lote']                     = $lote;
            $dados['idcliente']                = $idcliente;

           return $dados;
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
	<!-- ================== END BASE JS ================== -->
</head>
<body>

	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo_cliente.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->

			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Jurídico</h1>
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
                            <h4 class="panel-title">Informações de Clientes</h4>
                        </div>
                      
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                   <th>Cliente</th>
                                        <th>Empreendimento</th>
                                          <th>Q/L</th>
                                         <th>Quantidade Parcelas</th>
                                      
                                       
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>

<?php

$empreendimento_id = $_GET["empreendimento_id"];

   date_default_timezone_set('America/Sao_Paulo');

    $hoje = date('Y-m-d');
    $inicio = '1900-01-01';

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' group by cliente_id_novo";

    include "conexao.php";
$cont = 0;
   $query_amigo = "SELECT  COUNT(idparcelas) as total, cliente_id_novo, empreendimento_id_novo, idparcelas, tipo_venda, venda_idvenda FROM parcelas                         
                   where  situacao = 'Em Aberto' AND empreendimento_id_novo = $empreendimento_id AND fluxo = 0 $where";

                   $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $cliente_id_novo            = $buscar_amigo["cliente_id_novo"];
                   $empreendimento_id_novo     = $buscar_amigo["empreendimento_id_novo"];
                   $total                      = $buscar_amigo["total"];
                   $idparcelas                 = $buscar_amigo["idparcelas"];
                   $venda_idvenda              = $buscar_amigo["venda_idvenda"];
                   $tipo_venda                 = $buscar_amigo["tipo_venda"];

                   if($total >= 3){
                    
                   
                  
                  $dados_cli = retorna_dados_cliente($idparcelas, $venda_idvenda, $tipo_venda);

            


             ?>


                                    <tr class="odd gradeX">
                                       <td><?php echo nome_user($cliente_id_novo); ?></td>
                                       <td><?php echo $dados_cli['descricao_empreendimento'] ?> </td>
                                       <td>  <?php echo $dados_cli['quadra'] ?>/<?php echo $dados_cli['lote'] ?> </td>
                                     
                                      <td><?php echo $total ?></td>
                                      <td><a href="area_cliente_parcelas.php?idvenda=<?php echo $venda_idvenda ?>&tipo=<?php echo $tipo_venda ?>"><span class="btn btn-success">Abrir Parcelas</span></a></td>

                                    </tr>
                                     <?php } } ?>
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
        <script src="https://immobilebusiness.com.br/admin/assets/plugins/parsley/dist/parsley.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/form-wizards-validation.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
      FormPlugins.init();
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
