<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php"; 
function dados_contabil($parcela_id, $imposto_id){
    include "conexao.php";
    $query_amigo = "SELECT * FROM contabil where parcela_id_receber = $parcela_id AND imposto_id = $imposto_id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $valor_imposto           = $buscar_amigo["valor_imposto"];

      $dados["valor_imposto"]       = $valor_imposto;
     

    }
    return $dados;
}

function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}

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
           INNER JOIN lote ON contrato_pagar.lote_id = lote.idlote
           INNER JOIN produto ON contrato_pagar.quadra_id = produto.idproduto
           INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
           INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
 $tabela_inner = 'contrato_pagar.fornecedor_idfornecedor';
 $juros_hr 	= '0200';
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
           INNER JOIN lote ON contrato_receber.lote_id = lote.idlote
           INNER JOIN produto ON contrato_receber.quadra_id = produto.idproduto
           INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
           INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';

 $tabela_inner = 'contrato_receber.cliente_idcliente';
 $juros_hr  = '0200';
}

$wes_hoje = date('dmy');
				include "conexao.php";
  				$query_amigo323 = "SELECT * FROM parcelas ".$inner."  
                
                INNER JOIN cliente ON ".$tabela_inner." = cliente.idcliente
                WHERE idparcelas = $id";

        
               // echo $query_amigo323; die();
                $executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar dados cliente");
                
                
            while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            $idcliente                  = $buscar_amigo323['idcliente'];
            $nome_cli                   = $buscar_amigo323['nome_cli'];
            $descricao_empreendimento   = $buscar_amigo323['descricao_empreendimento'];
            $quadra                     = $buscar_amigo323['quadra'];
            $lote                       = $buscar_amigo323['lote'];
            
            if($tipo_venda == 4 or $tipo_venda == 3 or $tipo_venda == 2){
            $lote_idlote                = $buscar_amigo323['lote_idlote'];
            $produto_idproduto          = $buscar_amigo323['produto_idproduto'];
            $idempreendimento_cadastro           = $buscar_amigo323['idempreendimento_cadastro'];
          }


            }
            $dados['nome_cli']                 = $nome_cli;
            $dados['descricao_empreendimento'] = $descricao_empreendimento;
            $dados['quadra']                   = $quadra;
            $dados['lote']                     = $lote;
            $dados['idcliente']                = $idcliente;
            
            if($tipo_venda == 4 or $tipo_venda == 3 or $tipo_venda == 2){
            
            $dados['lote_idlote']             = $lote_idlote;
            $dados['produto_idproduto']       = $produto_idproduto;
            $dados['idempreendimento_cadastro']        = $idempreendimento_cadastro;

            }


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
<script>
function ShowHideDIV(){

  Valor = document.getElementById("tipo_cobranca").value;

  if (Valor=="2") 
  {
    document.getElementById('locacao').style.display    = "none"
    document.getElementById('teste').style.display      = "block"
    document.getElementById('quadra2').style.display    = "block"
    document.getElementById('lote32').style.display     = "block"
    document.getElementById('etapa32').style.display    = "block"

  }
  else
  {
    document.getElementById('locacao').style.display    = "block"
    document.getElementById('teste').style.display      = "none"
    document.getElementById('quadra2').style.display    = "none"
    document.getElementById('lote32').style.display     = "none"
    document.getElementById('etapa32').style.display    = "none"

   }
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
    



      
        
      </ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Impostos</h1>
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
                            <h4 class="panel-title">Informe o Período</h4>
                        </div>
                        <div class="panel-body">
                        	 <form class="form-horizontal form-bordered" name="myForm" method="GET" action="contabil.php">
                         
                         






                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Período</label>
                                    <div class="col-md-8">
                                        <div class="input-group input-daterange">
                                            <input type="date" class="form-control" name="inicio" placeholder="Data Inicial" required="" />
                                            <span class="input-group-addon">Até</span>
                                            <input type="date" class="form-control" name="fim" placeholder="Data Final" required="" />
                                        </div>
                                    </div>
                                </div>

                              

                              
                                   <div class="form-group">
                                    <label class="col-md-4 control-label">Empreendimento</label>
                                    <div class="col-md-8">
                                          <select class="form-control" name="empreendimento_id" id="os" required="">
      <option value="">Escolha</option>

     
<?php 
             include "conexao.php";
             $query_c = "SELECT * FROM empreendimento
                         INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                         order by idempreendimento desc";
             $executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento mesmo");
             while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos
           
              $idempreendimento   = $buscar_amigoc['idempreendimento_cadastro'];
              $descricao          = $buscar_amigoc['descricao_empreendimento'];
        ?>
            
            <option value="<?php echo $idempreendimento ?>"><?php echo $descricao ?></option>
      <?php }  ?>
                                        </select>

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






			    

<?php if(isset($_GET["inicio"])){ ?>
   <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Relatório de Recebimentos no período</h4>
                        </div>
                        <div class="panel-body">

                        <form action="receber_parcelas_contabil.php" method="POST" id="nome" name="nome">
<?php 
      
      $inicio                             = $_GET["inicio"];
      $fim                                = $_GET["fim"];

      $inicio = date("d-m-Y", strtotime($inicio));
      $fim    = date("d-m-Y", strtotime($fim));

      $situacao                           = $_GET["situacao"];
      $empreendimento_id                  = $_GET["empreendimento_id"];


 
                              
      $cont_contrato  = 0;
      $cont_cancelado = 0;



     


?>


   <div class="form-group">
                                    <label class="col-md-4 control-label">Imposto</label>
                                    <div class="col-md-8">
                                          <select class="form-control" name="imposto_id" required="required">
      <option value="">Escolha</option>

     
<?php 
             include "conexao.php";
             $query_c = "SELECT * FROM impostos";
             $executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento mesmo");
             while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos
           
              $idimposto            = $buscar_amigoc['idimposto'];
              $descricao_imposto    = $buscar_amigoc['descricao_imposto'];
        ?>
            
            <option value="<?php echo $idimposto ?>"><?php echo $descricao_imposto ?></option>
      <?php }  ?>
                                        </select>

                                    </div>
                                </div>



            
            <input type="hidden" name="empreendimento_id" value="<?php echo $empreendimento_id ?>">
            <input type="hidden" name="inicio" value="<?php echo $inicio ?>">
            <input type="hidden" name="fim" value="<?php echo $fim ?>">
            <input type="hidden" name="situacao" value="<?php echo $situacao ?>">
                        	 <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                     <th><input type='checkbox' name='tudo' onclick="verificaStatus(this)" /></th>
                                        <th>Cliente</th>
                                         <th>Descrição</th>
                                          <th>Empreendimento</th>
                                          <th>Q/L </th>
                                        <th>Valor Recebido</th>
                                        <th>Data Recebimento</th>
                                        <?php 
             include "conexao.php";
             $query_c = "SELECT * FROM impostos";
             $executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento mesmo");
             while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos
           
              $idimposto            = $buscar_amigoc['idimposto'];
              $descricao_imposto    = $buscar_amigoc['descricao_imposto'];
        ?>
             <th><?php echo $descricao_imposto ?></th>
      <?php }  ?>

                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>





<?php 
      
          $inicio  = converterdata($inicio);
          $fim     = converterdata($fim);

				include "conexao.php";
				$query = mysqli_query($db,"SELECT idparcelas, tipo_venda, venda_idvenda, valor_recebido,  descricao,situacao, STR_TO_DATE(data_recebimento, '%d-%m-%Y') as venc 
                                  FROM parcelas 
                                  WHERE fluxo = 0 AND data_recebimento != ''  order by venc Asc") or die ("ERRO ao listar parcelas"); 

                while ($buscar_amigo = mysqli_fetch_assoc($query)) {//--verifica se são amigos

                  $idparcelas                  = $buscar_amigo["idparcelas"];
                  $tipo_venda                  = $buscar_amigo["tipo_venda"];
                  $venda_idvenda               = $buscar_amigo["venda_idvenda"];
                  $valor_recebido              = $buscar_amigo["valor_recebido"];
                  $data_vencimento_parcela     = $buscar_amigo["venc"];
                  $descricao		     	         = $buscar_amigo["descricao"];
                  $situacao_parcela            = $buscar_amigo["situacao"];

               


           
    if((strtotime($data_vencimento_parcela) >= strtotime($inicio)) AND (strtotime($data_vencimento_parcela) <= strtotime($fim)) )
         {        

        

		    $dados_cli = retorna_dados_cliente($idparcelas, $venda_idvenda, $tipo_venda);

        if($empreendimento_id == $dados_cli["idempreendimento_cadastro"]) {



		     ?>

                                    <tr class="odd gradeX">
                                        <td>
                                     
                                        <input type="checkbox" name="antecipar[]" value="<?php echo $idparcelas ?>"><br><?php echo $idparcelas ?>
                                   
                                        </td>

                                        <td><?php echo $dados_cli['nome_cli'] ?></td>
                                        <td><?php echo $descricao ?></td>
                                        <td><?php echo $dados_cli['descricao_empreendimento'] ?></td>
                                        <td><?php echo $dados_cli['quadra'] ?> / <?php echo $dados_cli['lote'] ?> </td>
                                        <td><?php echo 'R$' . number_format($valor_recebido, 2, ',', '.'); ?></td>
                                        <td><?php 
                                          $newDate = date("d-m-Y", strtotime($data_vencimento_parcela));

                                          echo $newDate;

                                          ?></td>
                                       
                                         <?php 
             include "conexao.php";
             $query_c = "SELECT * FROM impostos";
             $executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento mesmo");
             while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos
           
              $idimposto            = $buscar_amigoc['idimposto'];
              $descricao_imposto    = $buscar_amigoc['descricao_imposto'];
        
             $valor_imposto = dados_contabil($idparcelas, $idimposto);


             ?>
             <td>
             <?php if($valor_imposto != ''){ ?>

             <span class="label label-success"><?php echo 'R$' . number_format($valor_imposto['valor_imposto'], 2, ',', '.'); ?></span>

             <?php } ?>

             </td>
      <?php }  ?>  
                                       
                                       
                                     
                                    </tr>
                            

                                 

            



       <?php        }  }    }   ?>

                                    
                                </tbody>
                            </table>
                            <input type="submit" name="Cadastrar" value="Cadastrar" class=" btn btn-success">

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

</body>


</html>
