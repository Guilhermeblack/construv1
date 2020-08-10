<?php
 error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
 ?>

 <!DOCTYPE html>

<html>


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

function busca_preco($idfornecedor, $idinsumo)
{

    include "conexao.php";
    $query_amigo = "SELECT * FROM cotacao
                            where fornecedor_id = $idfornecedor AND insumo_id = $idinsumo 
                            order by id desc limit 1";

    $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar preco do fornecedor");
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
        $valorCusto             = $buscar_amigo["valorCusto"];
        
        }     
           return $valorCusto; 
             

}


function total_fornecedor($fornecedor_id, $projeto_id, $lista_id)
{
  

                                 
        
                include "conexao.php";            
                $total = 0;
                $query_amigo = "SELECT * FROM itens_cotacao
                                INNER JOIN insumo ON itens_cotacao.insumo_id = insumo.id                               
                                WHERE projeto_id = $projeto_id AND lista_cotacao_id = $lista_id";
                               
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar pacotes");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
            $insumo_id              = $buscar_amigo["insumo_id"];
         
            $busca_preco = busca_preco($fornecedor_id, $insumo_id);

            $total = $total + $busca_preco;

          }

          return $total;
          
            
}


function menor_preco($idfornecedor, $idinsumo, $lista)
{

    include "conexao.php";
    $menor = 100000000000.00;   
    $query_amigo = "SELECT * FROM fornecedor_lista
                    WHERE lista_cotacao_id = '$lista'";

    $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar preco do fornecedor");
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
        $fornecedor_id        = $buscar_amigo["fornecedor_id"];
    

    $query_busca_menor = "SELECT * FROM cotacao
                    	  WHERE insumo_id = $idinsumo  AND fornecedor_id = $fornecedor_id";

    $executa_query_busca_menor = mysqli_query ($db, $query_busca_menor) or die ("Erro no preco fornecedor");
    $num_rows = mysqli_num_rows($executa_query_busca_menor);

    while ($buscar_menor = mysqli_fetch_assoc($executa_query_busca_menor)) {//--verifica se são amigos
           
        $valorCusto        = $buscar_menor["valorCusto"];
    
        if($valorCusto == '' or $valorCusto == null or $valorCusto == 0 or $valorCusto == ' ' or $num_rows == 0){
          $valorCusto = 100000000000000000000000000000.00; 
        }





        
        } 

        if($valorCusto < $menor){
        	$menor = $valorCusto;
        	$idmenor = $fornecedor_id;
        }

}

		   if($idmenor == $idfornecedor){
		   	$retorno = 1;
		   }else{
		   	$retorno = 0;
		   }
           return $retorno; 
             

}

function total_menor_preco($lista)
{

    include "conexao.php";
    $menor = 100000000000.00; 
    $total = 0;  
    $query_amigo = "SELECT * FROM fornecedor_lista
                    WHERE lista_cotacao_id = '$lista'";

    $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar menor preco geral 1");
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
        $fornecedor_id        = $buscar_amigo["fornecedor_id"];
    

    $query_busca_menor = "SELECT * FROM cotacao
                        WHERE fornecedor_id = $fornecedor_id";

    $executa_query_busca_menor = mysqli_query ($db, $query_busca_menor) or die ("Erro ao listar menor preco geral 2");
    $num_rows = mysqli_num_rows($executa_query_busca_menor);

    while ($buscar_menor = mysqli_fetch_assoc($executa_query_busca_menor)) {//--verifica se são amigos
           
        $insumo_id         = $buscar_menor["insumo_id"];
        $valorCusto        = $buscar_menor["valorCusto"];
    
       $menor_preco = menor_preco($fornecedor_id, $insumo_id, $lista);

       $total = $total + $menor_preco;
        
        } 

        

}

       
           return $total; 
             

}
?>











	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo.php"; 

    $projeto_id     = $_GET["projeto_id"];
    $idlista_cotacao  = $_GET["lista_cotacao"];


		?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
				<ol class="breadcrumb pull-right">
				<?php if (in_array('32', $idrota)) { ?>
				<li><a href="preencher_orcamento.php?projeto_id=<?php echo $projeto_id ?>&lista_cotacao=<?php echo $idlista_cotacao ?>"><span class="label label-primary" style="font-size:100% !important">
      Preencher Cotação</span></a></li>


       <?php

            
                   include "conexao.php";
    
                      
               
      $query_vencedor = "SELECT * FROM vencedor_cotacao
                 INNER JOIN cliente ON vencedor_cotacao.fornecedor_id = cliente.idcliente
                 WHERE projeto_id = $projeto_id AND lista_cotacao_id = $idlista_cotacao group by fornecedor_id";
      $executa_vencedor = mysqli_query ($db,$query_vencedor) or die ("Erro ao listar lista de cotacoes");               
            $num_rows = mysqli_num_rows($executa_vencedor);    
            while ($buscar_vencedor = mysqli_fetch_assoc($executa_vencedor)) {//--verifica se são amigos
           
            $nome_cli             = $buscar_vencedor['nome_cli'];
         
          }
           
      if($num_rows > 1){
        $situacao = '';
      }elseif($num_rows == 0){
        $situacao = '<li><a href="finalizar_cotacao.php?projeto_id='.$projeto_id.'&lista_cotacao='.$idlista_cotacao.'"><span class="label label-primary" style="font-size:100% !important">
      Finalizar Cotação</span></a></li>';
      }else{
        $situacao = '';
      }           
          

      echo $situacao;


             ?>
  




       

				

				<?php } ?>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">INSUMOS</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			 


           
			    <!-- begin col-10 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                       <div class="panel-heading">
                            <div class="btn-group pull-right">
                                
                                    
                                
                             
                                 
                            </div>
                            <h4 class="panel-title">Cod.: <?php echo $idlista_cotacao ?></h4>
                        </div>
                      
                        <div class="panel-body">
                            <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                   		
                                        <th>Materiais</th>
                                        <th>Quantidade</th>
                                         <th>Unidade</th>
                                      <?php 
                                      

                include "conexao.php";            
               
                $query_amigo_item = "SELECT * FROM fornecedor_lista
                                INNER JOIN cliente ON cliente.idcliente = fornecedor_lista.fornecedor_id                              
                                WHERE lista_cotacao_id = $idlista_cotacao";
                                
                $executa_query_item = mysqli_query ($db,$query_amigo_item) or die ("Erro ao listar fornecedor lista");
                
            $cont_item = 0;    
            while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query_item)) {//--verifica se são amigos
            $nome_cli     	   		= $buscar_amigo2["nome_cli"];
            $idcliente              = $buscar_amigo2['idcliente'];
           
         	

           
          
             ?>
                                        <th><?php echo $nome_cli ?></th>
                                       <?php } ?>
                                       
                                    </tr>
                                </thead>
                                <tbody>
   <?php

            
                                  
        
                include "conexao.php";            
               
                $query_amigo_item = "SELECT * FROM itens_cotacao
                                     INNER JOIN insumo ON itens_cotacao.insumo_id = insumo.id
                                     WHERE projeto_id = $projeto_id AND lista_cotacao_id = $idlista_cotacao";

                $executa_query_item = mysqli_query ($db,$query_amigo_item) or die ("Erro ao listar itens cotacao");
                
                
            while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query_item)) {//--verifica se são amigos
            $insumo_id     	   	   = $buscar_amigo2["insumo_id"];
            $iditens_lista     	   = $buscar_amigo2["iditens_lista"];
            $qta_insumo            = $buscar_amigo2['qtd_insumo_cotacao'];
            $descricao             = $buscar_amigo2["descricao"];
            $un             	   = $buscar_amigo2["un"];
         

           
          
             ?>



                                    <tr class="odd gradeX">
                                       <td><?php echo $descricao ?></td>
                                        <td><?php echo $qta_insumo ?></td>
                                        <td><?php echo $un ?></td>
                                  
                                             <?php 
                                      

                include "conexao.php";            
               
                $query_amigo_item2 = "SELECT * FROM fornecedor_lista
                                      INNER JOIN cliente ON cliente.idcliente = fornecedor_lista.fornecedor_id
                                      WHERE lista_cotacao_id = $idlista_cotacao";


                $executa_query_item2 = mysqli_query ($db,$query_amigo_item2) or die ("Erro ao listar fornecedor_lista 2");
                
            $cont_item = 0;  
            $num_rows = mysqli_num_rows($executa_query_item2);  
            while ($buscar_amigo22 = mysqli_fetch_assoc($executa_query_item2)) {//--verifica se são amigos
            
            $idcliente2             = $buscar_amigo22['idcliente'];
           
         	  
         	

          $retorno =  menor_preco($idcliente2, $insumo_id, $idlista_cotacao);
          if($retorno == 1){
          	$stilo = 'style="background-color: #00acac !important; color:#FFFFFF !important; font-weight:bold !important"';
          }else{
          	$stilo = '';
          }
             ?> 

                                        <td <?php echo " $stilo" ?>>

                                        <?php  $valorCusto = busca_preco($idcliente2, $insumo_id);

                                       echo 'R$ ' . number_format($valorCusto, 2, ',', '.'); 
                                          ?> 

                                         </td>
                                    
                                      <?php } ?>
                                         
                                         
                                      
                                    </tr>
                                  <?php } ?>



                                  <tr>
                                  <td colspan="3"><center>Total por Fornecedor</center></td>
                                  


                                            <?php 
                                      

                include "conexao.php";            
               
                $query_amigo_item3 = "SELECT * FROM fornecedor_lista
                                INNER JOIN cliente ON cliente.idcliente = fornecedor_lista.fornecedor_id                              
                                WHERE lista_cotacao_id = $idlista_cotacao";
                $executa_query_item3 = mysqli_query ($db,$query_amigo_item3) or die ("Erro ao listar pacotes");
                
            $cont_item = 0;  
            while ($buscar_amigo33 = mysqli_fetch_assoc($executa_query_item3)) {//--verifica se são amigos
            
            $idcliente3             = $buscar_amigo33['idcliente'];

            $total_fornecedor = total_fornecedor($idcliente3, $projeto_id, $idlista_cotacao);

            ?>
           

            <td> <?php  echo 'R$ ' . number_format($total_fornecedor, 2, ',', '.'); ?> </td>



<?php } ?>




                                  </tr>


                       









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
