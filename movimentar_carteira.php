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
  <script type="text/javascript">


function movimentar_cadastros(){

document.nome.action = "receber_movimentar_cadastros.php";
document.nome.submit();

}

function marcarTodos(nome){
   for (i=0;i<nome.form.elements.length;i++)
    if(nome.form.elements[i].type == "checkbox")
     nome.form.elements[i].checked=0
}
 
function desmarcarTodos(nome){
   for (i=0;i<nome.form.elements.length;i++)
    if(nome.form.elements[i].type == "checkbox")
     nome.form.elements[i].checked=1
}

    function verificaStatus(nome){
  if(nome.form.tudo.checked == 0)
    {
      nome.form.tudo.checked = 1;
      marcarTodos(nome);
    }
  else
    {
      nome.form.tudo.checked = 0;
      desmarcarTodos(nome);
    }
}


</script>


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
		<ol class="breadcrumb pull-right">
       
        

        <?php if (in_array('7', $idrota)) { ?>
        <li><a href="#" onclick="movimentar_cadastros()"><span class="label label-success">MOVIMENTAR CADASTROS</span></a></li>
        <?php } ?>
        
      
        
      </ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Movimentação de Cadastros </h1>
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
                            <h4 class="panel-title">Informe os dados</h4>
                        </div>
                        <div class="panel-body">
                        	 <form class="form-vertical form-bordered" name="myForm" method="GET" action="movimentar_carteira.php">
                       
                            <div class="form-group">
                                    <label class="col-md-2 control-label">Imobiliaria</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-daterange">
                                             <select class="default-select2 form-control" name="imobiliaria_id" id="imobiliaria_id" required="">
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
                                        <div class="input-group input-daterange">
                                             <select class="default-select2 form-control" name="corretor_id" id="corretor_id" required="">
                                       

                                           
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






			    

<?php if(isset($_GET["imobiliaria_id"])){ ?>
   <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Relação de Clientes cadastrados</h4>
                        </div>
                        <div class="panel-body">

                        <form action="#" method="POST" id="nome" name="nome">
<?php 
      
      $imobiliaria_id  = $_GET["imobiliaria_id"];
      $corretor_id     = $_GET["corretor_id"];

      $where = "cliente.idcliente > 0";


      if($corretor_id != 0){
        $where .= " AND idcorretor =".$corretor_id;
      }else{
        $where .= " AND idcorretor =".$imobiliaria_id;
      }
      
?>
            
                        	 <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th> <input type='checkbox' name='tudo' onclick="verificaStatus(this)" /></th>
                                       <th>Cod</th>
                                       <th>Nome</th>                                      
                                       <th>CPF</th>                                         
                                      
                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>




<?php 
      
    

				include "conexao.php";
				$query = "SELECT cliente.idcliente, cliente.nome_cli, cliente.cpf_cli
                  FROM cliente
                  INNER JOIN vinculo ON vinculo.idcliente = cliente.idcliente
                  WHERE $where";
                  $executa_query = mysqli_query($db, $query);

                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $idcliente   = $buscar_amigo["idcliente"];
                  $nome_cli    = $buscar_amigo["nome_cli"];
                  $cpf_cli     = $buscar_amigo["cpf_cli"];  

		     ?>

                                    <tr class="odd gradeX">
                                        <td>
                                        
                                        <input type="checkbox" name="antecipar[]" value="<?php echo $idcliente ?>">
                                    
                                        </td>
                                         <td><?php echo $idcliente ?></td>
                                         <td><?php echo $nome_cli ?></td>
                                         <td><?php echo $cpf_cli ?></td>

                                     
                                    </tr>
                                     <?php   }?>

                                   
                                </tbody>
                            </table>
                          
</form>


                        </div>
                    </div>
			    </div>

<?php } ?>


			</div>
		</div>
		<!-- end #content -->
		

		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
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

  <script src="produtos_pagar.js"></script>
  <script src="lote_pagar.js"></script>
  <script src="etapa_pagar.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->
  
  <script>
    $(document).ready(function() {
      App.init();
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
