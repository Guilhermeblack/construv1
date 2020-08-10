<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

if(isset($_POST["idclientes"])){
        
        date_default_timezone_set('America/Sao_Paulo');

          $hoje             = date('d-m-Y H:i:s');
  				$imobiliaria_id 	= $_POST["imobiliaria_id"];
  				$corretor_id 			= $_POST["corretor_id"];  			
          $antecipar_t      = $_POST["idclientes"];
          $imobiliaria_idimobiliaria      = $_POST["imobiliaria_idimobiliaria"];

          if($corretor_id != 0){
            
            $corretor_id_def = $corretor_id;
          
          }else{
            
            $corretor_id_def = $imobiliaria_id;
          }

	include "conexao.php";
	foreach($antecipar_t as $id){

		

		$inserir = "INSERT INTO vinculo (idcliente, idcorretor, data_vinculo, vinculado_por, obs_vinculo) values ('$id', '$corretor_id_def', '$hoje', '$imobiliaria_idimobiliaria','Movimentação de Carteira')";

 		$executa_query = mysqli_query ($db, $inserir);

            
	}  
?>

<script type="text/javascript">
	window.location="movimentar_carteira.php";
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
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->

</head>
<body>

	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	

	<?php include "topo.php";

function dados_cliente($idcliente)
{
  include "conexao.php";
  $query_amigo323 = "SELECT idcliente, nome_cli, cpf_cli FROM cliente where idcliente = '$idcliente'";
  $executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar dados cliente");
                
                
            while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            
            $nome_cli         = $buscar_amigo323['nome_cli'];          
            $cpf_cli          = $buscar_amigo323['cpf_cli'];
          
            $dados['nome_cli']      = $nome_cli;           
            $dados['cpf_cli']       = $cpf_cli;
          

            }

            return $dados;
}


  ?>
	

		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Movimentação de Cadastros</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			
			    <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-4">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Clientes</h4>
                        </div>
                        <div class="panel-body">
                        <form action="receber_movimentar_cadastros.php" method="POST" name="nome">
                            <table class="table table-striped">
                                <thead>

                                    <tr>
                                      <th>Cod</th>
                                      <th>Nome </th>
                                      <th>CPF</th>
                                    </tr>

                                </thead>

                                <tbody>
      <?php               

              include "conexao.php";            

              $antecipar 				= $_POST["antecipar"];

              foreach($antecipar as $id){

                $dados_cliente = dados_cliente($id);
              ?>

                                <tr>
                                    <td>
            <input type="hidden" name="idclientes[]" value="<?php echo $id ?>">
            <input type="hidden" name="vinculado_por" value="<?php echo $imobiliaria_idimobiliaria ?>">
                                    <?php echo $id ?></td>
                                    <td><?php echo $dados_cliente["nome_cli"]; ?></td>
                                    <td><?php echo $dados_cliente["cpf_cli"]; ?></td>
                                   
                                </tr>
                               <?php } ?>

                                <tr>
                               			<td>   <select class="default-select2 form-control" name="imobiliaria_id" id="imobiliaria_id" required="">
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

                                           
                                        </select></td>
                               	 			<td> <select class="default-select2 form-control" name="corretor_id" id="corretor_id" required="">
                                       

                                           
                                        </select></td>
                                			<td></td> 
                                			
                                </tr>




                                 <tr>
                               			 <td><input type="submit" class="btn btn-success" value="Confirmar Movimentação" /></td>
                               	 			<td></td>
                                			<td></td> 
                                		
                                </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
			      
			    </div>
			    <!-- end col-6 -->
			</div>
		
			
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
$(".valor_parcelas").maskMoney({symbol:'R$ ', 
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
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
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


		$(document).ready(function() {
			App.init();
		});
	</script>

</body>

</html>
