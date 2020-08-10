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
<?php 

function propostas_recusadas($empreendimento_id){
    include "conexao.php";
    $query_amigo = "SELECT COUNT(idvenda) as total from venda 
                    INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                               
                    WHERE empreendimento_cadastro_id = '$empreendimento_id' and status_venda = '1'";
    $executa_query = mysqli_query($db, $query_amigo);

  while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }
    return $total;
}

function contratos($empreendimento_id){
    include "conexao.php";
    $query_amigo = "SELECT COUNT(idvenda) as total from venda
                    INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento                  
                    WHERE empreendimento_cadastro_id = $empreendimento_id and status_venda = 3";
    $executa_query = mysqli_query($db, $query_amigo);

  while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }
    return $total;
}

function lotes_reservados($empreendimento_id){
    include "conexao.php";
    $query_amigo = "SELECT COUNT(idlote) as total from lote
                    INNER JOIN produto ON lote.produto_idproduto = produto.idproduto
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento                  
                    WHERE empreendimento_cadastro_id = $empreendimento_id AND status = 0";
    $executa_query = mysqli_query($db, $query_amigo);

  while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }
    return $total;
}

function lotes($empreendimento_id){
    include "conexao.php";
    $query_amigo = "SELECT COUNT(idlote) as total from lote
                    INNER JOIN produto ON lote.produto_idproduto = produto.idproduto
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento                  
                    WHERE empreendimento_cadastro_id = $empreendimento_id";
    $executa_query = mysqli_query($db, $query_amigo);

  while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }
    return $total;
}

  function total_imobiliarias($empreendimento_id)
{

    include "conexao.php";
    $query_amigo = "SELECT COUNT(idempreendimento_imob) as total FROM empreendimento_imob 
                    WHERE empreendimento_id = '$empreendimento_id'";

    $executa_query = mysqli_query ($db, $query_amigo);
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
        $total             = $buscar_amigo["total"];


        }     
           return $total; 
             

}

  function total_corretores()
{

    include "conexao.php";
    $query_amigo = "SELECT COUNT(cliente.idcliente) as total FROM cliente 
                    inner join cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente                     
                    where idtipo = 8";

    $executa_query = mysqli_query ($db, $query_amigo);
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
        $total             = $buscar_amigo["total"];


        }     
           return $total; 
             

}

  function total_clientes()
{

    include "conexao.php";
    $query_amigo = "SELECT COUNT(cliente.idcliente) as total FROM cliente 
                    inner join cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente                     
                    where idtipo = 1 AND imob_id != '0'";

    $executa_query = mysqli_query ($db, $query_amigo);
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
        $total             = $buscar_amigo["total"];


        }     
           return $total; 
             

}

  function tem_contrato($idcliente)
{

    include "conexao.php";
    $query_amigo = "SELECT SUM(idparcelas) as TOTAL FROM parcelas                     
                    where cliente_id_novo = $idcliente";

    $executa_query = mysqli_query ($db, $query_amigo);
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
        $idparcelas             = $buscar_amigo["TOTAL"];

        

        }     
           return $idparcelas; 
             

}
?>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
				
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Imobiliarias</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">

            


<?php $cor = '#01b19d';   $cor2 = '#78c14e'; ?>








<?php
      include "conexao.php";
          $query_amigo = "SELECT * FROM empreendimento
                  INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                  WHERE exibir_painel = 1";

                $executa_query = mysqli_query ($db, $query_amigo);
                
            $cont = 1;    
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                 
                  $chave_empreendimento = $buscar_amigo["idempreendimento"];
                  $idempreendimento_cadastro = $buscar_amigo["idempreendimento_cadastro"];
                  $descricao           = $buscar_amigo["descricao_empreendimento"];


                 if($cont == 1){
                    $cor = '#5f5f5f';

                  }else{
                    $cor = '#047b6e';
                  }

                  ?>







  <div class="col-md-3 col-sm-6" onclick="location.href='relatorio_vendas.php?idempreendimento=<?php echo $chave_empreendimento ?>&status_venda=3';">
              <div class="widget widget-stats" style="background-color:<?php echo $cor ?>">
                  <div class="stats-icon stats-icon-lg"><i class="fa fa-check-square fa-fw"></i></div>
                  <div class="stats-title"><?php echo $descricao ?></div>
                  <div class="stats-number">

<?php echo "Vendas: ".contratos($idempreendimento_cadastro); ?>




</div>
                  <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                        <div class="stats-desc">*
</div>
              </div>
          </div>


 <div class="col-md-3 col-sm-6" onclick="location.href='relatorio_vendas.php?idempreendimento=<?php echo $chave_empreendimento ?>&status_venda=0';">
              <div class="widget widget-stats" style="background-color:<?php echo $cor ?>">
                  <div class="stats-icon stats-icon-lg"><i class="fa fa-check-square fa-fw"></i></div>
                  <div class="stats-title">Reservas</div>
                  <div class="stats-number">


<?php echo lotes_reservados($idempreendimento_cadastro); ?>


</div>
                  <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                        <div class="stats-desc">*
</div>
              </div>
          </div>







          <div class="col-md-3 col-sm-6" onclick="location.href='relatorio_vendas.php?idempreendimento=<?php echo $chave_empreendimento ?>&status_venda=1';">
              <div class="widget widget-stats" style="background-color:<?php echo $cor ?>">
                  <div class="stats-icon stats-icon-lg"><i class="fa fa-check-square fa-fw"></i></div>
                  <div class="stats-title">Propostas Recusadas</div>
                  <div class="stats-number">



<?php echo propostas_recusadas($idempreendimento_cadastro); ?>



</div>
                  <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                        <div class="stats-desc">*
</div>
              </div>
          </div>




  <div class="col-md-3 col-sm-6" onclick="location.href='#';">
              <div class="widget widget-stats" style="background-color:<?php echo $cor ?>">
                  <div class="stats-icon stats-icon-lg"><i class="fa fa-check-square fa-fw"></i></div>
                  <div class="stats-title">Total Imobiliarias</div>
                  <div class="stats-number">

<?php  echo total_imobiliarias($idempreendimento_cadastro); ?>





</div>
                  <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                        <div class="stats-desc">*

</div>
              </div>
          </div>



<?php 

if($cont == 2){
  $cont = 1;
}else{
  $cont = $cont + 1;
}

}
?>








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
                            <h4 class="panel-title">Imobiliarias</h4>
                        </div>
                      
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                   <th>Código</th>
                                   <th>Nome</th>
                                   <th>CNPJ</th>
                                   <th>Telefone</th>
                                   <th> </th>
                                    </tr>
                                </thead>
                                <tbody>

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
                $telefone1_cli              = $buscar_amigo["telefone1_cli"];
             ?>


                                    <tr class="odd gradeX">
                                       <td><?php echo $idcliente ?></td>
                                        <td><?php echo $nome_cli ?></td>
                                        <td><?php echo $cpf_cli ?></td>
                                        <td><?php echo $telefone1_cli ?></td>
                                       <td>
                                     
                                  
			

         
 <a href="imobiliaria_info.php?idcliente=<?php echo $idcliente ?>">  <span class="label label-success">VER +</span></a><br><br>



 



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
