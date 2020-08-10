<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";




function busca_indice_empreendimento($empreendimento_id){
include "conexao.php";
    $query_amigo = "SELECT indice_correcao FROM empreendimento where idempreendimento = $empreendimento_id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $indice_correcao  = $buscar_amigo["indice_correcao"];

  }

  return $indice_correcao;
}

function valor_convertido($id, $empreendimento_id){
include "conexao.php";
  $hoje = date('Y-m-d');
    $query_amigo = "SELECT data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];

  }
  $busca_indice_empreendimento = busca_indice_empreendimento($empreendimento_id);
  $indice_total = 0;
  $query_indice = "SELECT * FROM igpm
                   WHERE indice_correcao = $busca_indice_empreendimento
                   order by idigpm desc limit 12";
    $executa_indice = mysqli_query ($db, $query_indice);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_indice))
    {
      
      $indice       = $buscar_amigo["indice"];
     
     $indice_total = $indice_total + $indice;

  }

$porcem = ($indice_total / 100);


$valor_convertido = $valor_parcelas + ($valor_parcelas * $porcem);

   
return $valor_convertido;
}




if(isset($_POST["reajustar"])){
  $hoje = date('Y-m-d');
  $hoje_traveis = date('d-m-Y');
  include "conexao.php";
  $antecipar_t        = $_POST["reajustar"];
  $empreendimento_id  = $_POST["empreendimento_id"];


  foreach($antecipar_t as $id){

    $atualiza_igpm = mysqli_query($db, "UPDATE venda SET igpm = '$hoje_traveis' WHERE idvenda = $id");

    $query_parcelas = "SELECT idparcelas, valor_parcelas, STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') AS venc FROM parcelas
                       WHERE fluxo = 0 AND venda_idvenda = $id AND tipo_venda = 2 AND situacao = 'Em Aberto' AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') > '$hoje'";
    $executa_parcelas = mysqli_query ($db,$query_parcelas);

    while ($buscar_parcelas = mysqli_fetch_assoc($executa_parcelas))
    {
      $idparcelas               = $buscar_parcelas["idparcelas"];
      $data_vencimento_parcela  = $buscar_parcelas["venc"];
      $valor_parcelas           = $buscar_parcelas["valor_parcelas"];


      $valor_convertido = valor_convertido($idparcelas, $empreendimento_id);

      $atualiza = mysqli_query($db, "UPDATE parcelas SET valor_parcelas = '$valor_convertido' WHERE idparcelas = $idparcelas");


  }


    
}

}

?>
 <!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
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


function reajustar(){

document.nome.action = "reajustar_contrato.php";
document.nome.submit();

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

</script>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo.php"; ?>
		

<?php 

function verifica_venda_id($venda_id){

  date_default_timezone_set('America/Sao_Paulo'); 
$data_hoje = date('Y-m-d');
          include "conexao.php";
                   $query_igpm = "SELECT vencimento_primeira, igpm, idvenda FROM venda where idvenda = $venda_id";
$cont = 0;
                $executa_igpm = mysqli_query($db, $query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $vencimento_primeira         = $buscar_amigoc['vencimento_primeira'];
             $igpm                    = $buscar_amigoc['igpm'];
             $idvenda                 = $buscar_amigoc['idvenda'];

             if($igpm == ''){
              $data_para_calculo = $vencimento_primeira;
             }else{
              $data_para_calculo = $igpm;
             }

             $data_para_calculo_tratada = converterdataigpm($data_para_calculo);


        $time_inicial = strtotime($data_hoje);
    $time_final   = strtotime($data_para_calculo_tratada);

    
    $diferenca = $time_inicial - $time_final;

    $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

    $contrato_ativo = contrato_ativo($idvenda);

    if($dias >= 334 AND $contrato_ativo > 0){ 
 
$retorno_igpm[$cont] = $idvenda;

$cont = $cont + 1;


 
} }

return $retorno_igpm;
}

?>





		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		    <ol class="breadcrumb pull-right">
        <li><a href="#" onclick="reajustar()"><span class="label label-danger">CONFIRMAR CORREÇÃO</span></a></li>
  

      
        
      </ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Reajustar Contrato</h1>
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
                            <h4 class="panel-title"> Filtro</h4>
                        </div>
                        <div class="panel-body">
                        	 <form class="form-vertical form-bordered" name="myForm" method="GET" action="reajustar_contrato.php">
                       
                                <div class="row">

                                      <div class="form-group">
                                    <label class="col-md-2 control-label">Empreendimento</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-daterange">
                                             <select class="default-select2 form-control" name="empreendimento_id"  id="os">
                                        <option value="">Todos</option>
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





                                  <div class="form-group">
                                    
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-sm btn-success" name="busca_lote" value="Consultar" />
                                    </div>
                                </div>

                       </form>



                        </div>
                    </div>
			    </div>



<?php if(isset($_GET["empreendimento_id"])){

  $empreendimento_cadastro_id = $_GET["empreendimento_id"];


 ?>

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
                            <h4 class="panel-title">Proximos Vencimentos</h4>
                        </div>
                        
                        <div class="panel-body">
                       <form action="#" method="POST" id="nome" name="nome">
                            <table id="" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
  <th> <input type='checkbox' name='tudo' onclick="verificaStatus(this)" /></th>
                                        <th>Cod</th>
                                         <th>Cliente</th>
                                        <th>Q/L</th>
                                        <th>Ultimo Reajuste</th>
                                         
                                        
                                    </tr>
                                </thead>

                                      <tbody>
                                <?php 

                

        include "conexao.php";
        $query = "SELECT empreendimento.idempreendimento, venda.idvenda, venda.cliente_idcliente, produto.quadra, lote.lote,  STR_TO_DATE(igpm, '%d-%m-%Y') as venc FROM venda
          INNER JOIN lote ON venda.lote_idlote = lote.idlote
          INNER JOIN produto ON produto.idproduto = venda.produto_idproduto 
          INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 

                    WHERE empreendimento_cadastro_id = $empreendimento_cadastro_id order by venc Asc"; 


      $executa_reajuste = mysqli_query($db, $query);

        while ($buscar = mysqli_fetch_assoc($executa_reajuste)) {//--While categoria
       
         $idvenda             = $buscar["idvenda"];
         $cliente_idcliente   = $buscar["cliente_idcliente"];
         $quadra              = $buscar["quadra"];
         $lote                = $buscar["lote"];
         $venc                = $buscar["venc"];
         $idempreendimento    = $buscar["idempreendimento"];
     
       
    

$ja_passou = verifica_venda_id($idvenda);

if($ja_passou > 0){
$stilo = 'danger';


                          ?>

                          
               <tr class="<?php echo $stilo ?>">
                <td><input type="checkbox" name="reajustar[]" value="<?php echo $idvenda ?>"></td>
                                        <td><?php echo $idvenda ?></td>
                                        <td> <?php echo nome_user($cliente_idcliente); ?></td>


                                 <td><?php echo $quadra ?> / <?php echo $lote ?></td>
                                        <td> <?php

                                        $originalDate = $venc;
                                        $newDate = date("d-m-Y", strtotime($originalDate));
                                         echo $newDate ?></td>
                                    
                                    </tr>
                                   <?php } } ?>


                                </tbody>
                            </table>
                                                    <input type="hidden" name="empreendimento_id" value="<?php echo $idempreendimento ?>">

                          </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>



<?php } ?>












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
	<script src="https://immobilebusiness.com.br/admin/assets/js/ui-modal-notification.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>




  <script src="produtos_pagar.js"></script>
  <script src="lote_pagar.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
			Notification.init();
		});
	</script>

</body>


</html>
