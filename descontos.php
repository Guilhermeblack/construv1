<?php
 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
 ?>
<?php

if(isset($_POST["centrocusto_id"]))
{
	$centrocusto_id 		 = $_POST["centrocusto_id"];
	$contacorrente_id 		 = $_POST["contacorrente"];
	$idempreendimento        = $_GET["idempreendimento"];
	$idempreendimento_cadastro        = $_GET["idempreendimento_cadastro"];
	$taxa_administrativa_empreendimento        = $_POST["taxa_administrativa_empreendimento"];

	include "conexao.php";

	$inserir = mysqli_query($db,"INSERT INTO empreendimento_centrocusto (empreendimento_id, centrocusto_id, contacorrente_id) values('$idempreendimento_cadastro','$centrocusto_id','$contacorrente_id')");

	$inserir_taxa_adm = "UPDATE empreendimento set taxa_administrativa = '$taxa_administrativa_empreendimento' WHERE idempreendimento = '$idempreendimento'";

 		$executa_query = mysqli_query ($db, $inserir_taxa_adm);
}


if(isset($_POST["descricao_custo"]))
{
	$descricao_custo   = $_POST["descricao_custo"];
	$percentual_custo  = $_POST["percentual_custo"];
	$impacto_custo     = $_POST["impacto_custo"];
	$cadastro          = $_GET["cadastro"];

	include "conexao.php";

	$inserir = mysqli_query($db,"INSERT INTO custo_distrato (descricao_custo, percentual_custo, impacto_custo, empreendimento_id) values('$descricao_custo', '$percentual_custo', '$impacto_custo', '$cadastro')");
}

if(isset($_POST["imobiliaria_id"]))
{
	$imobiliaria_id 		 			 = $_POST["imobiliaria_id"];
	$idempreendimento        		     = $_GET["idempreendimento"];
	$cadastro        		     = $_GET["cadastro"];
	$comissao_imob_empreendimento        = $_POST["comissao_imob_empreendimento"];
	$dias_repasse        				 = $_POST["dias_repasse"];

	include "conexao.php";

	$inserir = mysqli_query($db,"INSERT INTO empreendimento_imob (empreendimento_id, imobiliaria_id, dias_repasse) values('$cadastro','$imobiliaria_id','$dias_repasse')");
}

if(isset($_POST["desconto_empreendimento"]))
{
	$desconto_empreendimento = $_POST["desconto_empreendimento"];
	$idempreendimento        = $_GET["idempreendimento"];

	include "conexao.php";

	$inserir = mysqli_query($db,"INSERT INTO desconto_empreendimento (empreendimento_id, desconto_empreendimento) values('$idempreendimento','$desconto_empreendimento')");
}



if(isset($_POST["parcelamento_entrada"]))
{
	$parcelamento_entrada = $_POST["parcelamento_entrada"];
	$idempreendimento        = $_GET["idempreendimento"];

	include "conexao.php";

	$inserir = mysqli_query($db,"INSERT INTO parcelamento_entrada (empreendimento_id, parcelamento_entrada) values('$idempreendimento','$parcelamento_entrada')");
}


if(isset($_POST["percentual_entrada"]))
{
	$percentual_entrada = $_POST["percentual_entrada"];
	$idempreendimento        = $_GET["idempreendimento"];

	include "conexao.php";

	$inserir = mysqli_query($db,"INSERT INTO entrada_minima (empreendimento_id, percentual_entrada) values('$idempreendimento','$percentual_entrada')");
}


if(isset($_POST["plano_pagamento"]))
{
	$plano_pagamento = $_POST["plano_pagamento"];
	$idempreendimento        = $_GET["idempreendimento"];

	include "conexao.php";

	$inserir = mysqli_query($db,"INSERT INTO plano_pagamento (empreendimento_id, plano_pagamento) values('$idempreendimento','$plano_pagamento')");
}



/*  aksjdkas d asdkjas dkajs d klajsdklasjd alsk */ 
if(isset($_POST["taxa_inter"]))
{
	$taxa_inter  		= $_POST["taxa_inter"];
	$percen_lote 		= $_POST["percen_lote"];
	$idempreendimento   = $_GET["idempreendimento"];

	include "conexao.php";

	$inserir = mysqli_query($db,"INSERT INTO empreendimento_inter (empreendimento_id, percen_lote, taxa_inter) values('$idempreendimento','$percen_lote','$taxa_inter')");
}










if(isset($_POST["taxa_entrada"]) or isset($_POST["taxa_financiamento"]))
{
	$taxa_entrada 			= $_POST["taxa_entrada"];
	$taxa_financiamento 	= $_POST["taxa_financiamento"];
	$idempreendimento       = $_GET["idempreendimento"];
	$correcao_finan_fixo    = $_POST["correcao_finan_fixo"];


	if($taxa_entrada == '')
	{
		$taxa_entrada = 0;
	}

	if($taxa_financiamento == '')
	{
		$taxa_financiamento = 0;
	}

	if($correcao_finan_fixo == '')
	{
		$correcao_finan_fixo = 0;
	}

	include "conexao.php";

	$inserir = mysqli_query($db,"INSERT INTO correcao (empreendimento_id, taxa_financiamento, taxa_entrada,correcao_finan_fixo) values('$idempreendimento','$taxa_financiamento','$taxa_entrada','$correcao_finan_fixo')");
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
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	   <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->

	<!-- ================== END BASE JS ================== -->

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
		

		<?php include "topo.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
		
	

<?php
function taxa_inter($idempreendimento)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM empreendimento_inter where empreendimento_id = $idempreendimento";

                $executa_query = mysqli_query ($db,$query_amigo);
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $percen_lote   = $buscar_amigo["percen_lote"];           
                  $taxa_inter    = $buscar_amigo["taxa_inter"];                 
                            
			}
  		$dados["percen_lote"] = $percen_lote;
  		$dados["taxa_inter"]  = $taxa_inter;
  	return $dados;

}
function percentual_entrada($idempreendimento)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM entrada_minima where empreendimento_id = $idempreendimento order by identrada_minima desc limit 1";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $percentual_entrada           = $buscar_amigo["percentual_entrada"];                 
                            
			}
  	
  	return $percentual_entrada;

}



function plano_pagamento($idempreendimento)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM plano_pagamento where empreendimento_id = $idempreendimento order by idplano desc limit 1";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $plano_pagamento           = $buscar_amigo["plano_pagamento"];                 
                            
			}
  	
  	return $plano_pagamento;

}
function centrocusto_empreendimento($idempreendimento)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM  empreendimento
       				   INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro 
       				   INNER JOIN empreendimento_centrocusto ON empreendimento_centrocusto.empreendimento_id = empreendimento_cadastro.idempreendimento_cadastro

        where idempreendimento = $idempreendimento";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $centrocusto_id           = $buscar_amigo["centrocusto_id"];                 
                  $contacorrente_id           = $buscar_amigo["contacorrente_id"]; 

                  $dados['centrocusto_id'] 	 = $centrocusto_id;
                  $dados['contacorrente_id'] = $contacorrente_id;               
                            
			}
  	
  	return $dados;

}

function empreendimento($idempreendimento)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM empreendimento
       				   INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro

        				where idempreendimento = $idempreendimento";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $descricao            = $buscar_amigo["descricao_empreendimento"];                 
                  $taxa_administrativa  = $buscar_amigo["taxa_administrativa"];   
                  $idempreendimento_cadastro  = $buscar_amigo["idempreendimento_cadastro"];   

                  $dados['descricao']   = $descricao;
                  $dados['taxa_administrativa']   = $taxa_administrativa;
                  $dados['idempreendimento_cadastro']   = $idempreendimento_cadastro;

			}
  	
  	return $dados;

}

function taxa_entrada($idempreendimento)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM correcao where empreendimento_id = $idempreendimento order by idcorrecao desc limit 1";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $taxa_entrada           = $buscar_amigo["taxa_entrada"];                 
                            
			}
  	
  	return $taxa_entrada;

}
function taxa_financiamento($idempreendimento)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM correcao where empreendimento_id = $idempreendimento order by idcorrecao desc limit 1";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $taxa_financiamento           = $buscar_amigo["taxa_financiamento"];                 
                            
			}
  	
  	return $taxa_financiamento;

}
function correcao_finan_fixo($idempreendimento)
{


    include "conexao.php";
       $query_amigo = "SELECT * FROM correcao where empreendimento_id = $idempreendimento order by idcorrecao desc limit 1";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $correcao_finan_fixo           = $buscar_amigo["correcao_finan_fixo"];                 
                            
			}
  	
  	return $correcao_finan_fixo;

}
?>
	<!-- begin page-header -->
			
			<!-- end page-header -->
			<?php 	$idempreendimento = $_GET["idempreendimento"]; 
			
			$descricao_empreendimento = empreendimento($idempreendimento);
			$idempreendimento_cadastro = $descricao_empreendimento['idempreendimento_cadastro'];

			?>
<h1 class="page-header">Configurações de Contrato - <?php echo $descricao_empreendimento['descricao']; ?></h1>

			<div class="row">
			   
			  <div class="col-md-12">
					<ul class="nav nav-tabs">
						<li class=""><a href="#default-tab-1" data-toggle="tab" aria-expanded="false">Descontos</a></li>
						<li class=""><a href="#default-tab-2" data-toggle="tab" aria-expanded="false">Parcelamento Entrada</a></li>
						<li class=""><a href="#default-tab-4" data-toggle="tab" aria-expanded="false">% Minima da Entrada</a></li>
						<li class=""><a href="#default-tab-3" data-toggle="tab" aria-expanded="false">Plano de Pagamento</a></li>
						<li class=""><a href="#default-tab-5" data-toggle="tab" aria-expanded="false">Correção de Entrada / Saldo</a></li>
						<li class=""><a href="#default-tab-6" data-toggle="tab" aria-expanded="false">Imobiliarias</a></li>
						<li class=""><a href="#default-tab-7" data-toggle="tab" aria-expanded="false">Centro de Receita / Despesa</a></li>
						<li class=""><a href="#default-tab-8" data-toggle="tab" aria-expanded="false">Distrato</a></li>

					</ul>
					<div class="tab-content">
						<div class="tab-pane fade" id="default-tab-1">
							<h3 class="m-t-10"><i class="fa fa-cog"></i> Cadastre os percentuais de descontos</h3>
							<form action="descontos.php?idempreendimento=<?php echo $idempreendimento ?>" method="POST">
							  <div class="form-group">
                                    <label class="col-md-3 control-label">% Desconto</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="desconto_empreendimento" name="desconto_empreendimento">
                                    </div>
                                </div>
							<p class="text-right m-b-0">
							
								<input type="submit" value="Cadastrar" class="btn btn-primary">
							</p>

							</form>

							  <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Desconto</th>
                                        
                                       
                                      
                                          <th>Ações</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM desconto_empreendimento
                	where empreendimento_id = $idempreendimento
                    order by iddesconto desc") or die ("Erro ao listar imoveis, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $desconto_empreendimento      = $buscar_slide["desconto_empreendimento"];
             $iddesconto             = $buscar_slide["iddesconto"];
         
          

                    ?> 
                                
                                   <tr class="odd gradeX">
                                       
                                        <td><?php echo "$desconto_empreendimento " ?></td>
                                       

                                         <td><a href="excluir_desconto.php?iddesconto=<?php echo $iddesconto ?>&idempreendimento=<?php echo $idempreendimento ?>"> <span class="label label-danger">Excluir</span> </a></td>                        

                                      

                                    </tr>

                                    <?php } ?>


                                   





                                 
                                </tbody>

                            </table>
						</div>
						<div class="tab-pane fade active in" id="default-tab-2">
								<h3 class="m-t-10"><i class="fa fa-cog"></i> Cadastre as opções de parcelamento da entrada</h3>
							<form action="descontos.php?idempreendimento=<?php echo $idempreendimento ?>" method="POST">
							  <div class="form-group">
                                    <label class="col-md-3 control-label">Opções de Parcelamento</label>
                                    <div class="col-md-9">
                                        <input type="number" min="0" class="form-control" name="parcelamento_entrada">
                                    </div>
                                </div>
							<p class="text-right m-b-0">
							
								<input type="submit" value="Cadastrar" class="btn btn-primary">
							</p>

							</form>

							  <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Parcelas</th>
                                        
                                       
                                      
                                          <th>Ações</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM parcelamento_entrada
                	where empreendimento_id = $idempreendimento
                    order by idparcelamento_entrada desc") or die ("Erro ao listar imoveis, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $parcelamento_entrada      = $buscar_slide["parcelamento_entrada"];
             $idparcelamento_entrada             = $buscar_slide["idparcelamento_entrada"];
         
          

                    ?> 
                                
                                   <tr class="odd gradeX">
                                       
                                        <td><?php echo "$parcelamento_entrada " ?></td>
                                       

                                        <td><a href="excluir_parcelas.php?idparcelamento_entrada=<?php echo $idparcelamento_entrada ?>&idempreendimento=<?php echo $idempreendimento ?>"> <span class="label label-danger">Excluir</span> </a></td>                      

                                      

                                    </tr>

                                    <?php } ?>


                                   





                                 
                                </tbody>

                            </table>
						</div>
						<div class="tab-pane fade" id="default-tab-4">
							<h3 class="m-t-10"><i class="fa fa-cog"></i> Informe o percentual minimo da Entrada</h3>
							<form action="descontos.php?idempreendimento=<?php echo $idempreendimento ?>" method="POST">
							  <div class="form-group">
                                    <label class="col-md-3 control-label">% Minimo de Entrada</label>
                                    <div class="col-md-9">

                                    <?php  $percentual = percentual_entrada($idempreendimento); ?>

                                        <input type="text" class="form-control" id="percentual_entrada" name="percentual_entrada"

                                        <?php if($percentual != ''){ ?>
                                         value="<?php echo $percentual ?>" <?php } ?>>
                                    </div>
                                </div>
							<p class="text-right m-b-0">
							
								<input type="submit" value="Cadastrar" class="btn btn-primary">
							</p>

							</form>
						</div>
							<div class="tab-pane fade" id="default-tab-3">
							<h3 class="m-t-10"><i class="fa fa-cog"></i> Informe o plano de pagamento Maximo</h3>
							<form action="descontos.php?idempreendimento=<?php echo $idempreendimento ?>" method="POST">
							  <div class="form-group">
                                    <label class="col-md-3 control-label">Plano de Pagamento Maximo </label>
                                    <div class="col-md-9">

                                     <?php  $plano = plano_pagamento($idempreendimento); ?>
                                        <input type="number" min="0" class="form-control" name="plano_pagamento" 
                                            <?php if($percentual != ''){ ?>
                                          value="<?php echo $plano ?>" <?php } ?> >
                                    </div>
                                </div>
							<p class="text-right m-b-0">
							
								<input type="submit" value="Cadastrar" class="btn btn-primary">
							</p>

							</form>

						</div>


							<div class="tab-pane fade" id="default-tab-5">
							<h3 class="m-t-10"><i class="fa fa-cog"></i> Informe os percentuais para correção</h3>
							<form action="descontos.php?idempreendimento=<?php echo $idempreendimento ?>" method="POST">
							  <div class="form-group">
                                    <label class="col-md-3 control-label">Correção Entrada </label>
                                    <div class="col-md-9">

                                     <?php  $taxa_entrada = taxa_entrada($idempreendimento); ?>
                                        <input type="text" class="form-control" id="taxa_entrada" name="taxa_entrada" 
                                            <?php if($taxa_entrada != ''){ ?>
                                          value="<?php echo $taxa_entrada ?>" <?php } ?> >
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Correção Saldo Devedor </label>
                                    <div class="col-md-9">

                                     <?php  $taxa_financiamento = taxa_financiamento($idempreendimento); ?>
                                        <input type="text" class="form-control" id="taxa_financiamento" name="taxa_financiamento" 
                                            <?php if($taxa_financiamento != ''){ ?>
                                          value="<?php echo $taxa_financiamento ?>" <?php } ?> >
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Intermediarias % lote</label>
                                    <div class="col-md-9">

                                     <?php  $dados = taxa_inter($idempreendimento);
                                     $percen_lote  = $dados["percen_lote"];
                                     $taxa_inter   = $dados["taxa_inter"];


                                      ?>
                                        <input type="text" class="form-control" id="percen_lote" name="percen_lote" 
                                            <?php if($percen_lote != ''){ ?>
                                          value="<?php echo $percen_lote ?>" <?php } ?> >
                                    </div>
                                </div>
                                   <div class="form-group">
                                    <label class="col-md-3 control-label">Intermediarias Taxa de Juros</label>
                                    <div class="col-md-9">

                                    
                                        <input type="text" class="form-control" id="taxa_inter" name="taxa_inter" 
                                            <?php if($taxa_inter != ''){ ?>
                                          value="<?php echo $taxa_inter ?>" <?php } ?> >
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Correção Saldo Devedor Fixo?</label>
                                    <div class="col-md-9">

                                     <?php  $correcao_finan_fixo = correcao_finan_fixo($idempreendimento); ?>
                                        <input type="checkbox" id="correcao_finan_fixo" name="correcao_finan_fixo" 
                                           
                                          value="1"  <?php if($correcao_finan_fixo != 0){ ?> checked <?php } ?> >Sim
                                    </div>
                                </div>
							<p class="text-right m-b-0">
							
								<input type="submit" value="Cadastrar" class="btn btn-primary">
							</p>

							</form>

						</div>



					<div class="tab-pane fade" id="default-tab-6">
							<h3 class="m-t-10"><i class="fa fa-cog"></i> Informe as imobiliarias desse empreendimento</h3>
	<form action="descontos.php?idempreendimento=<?php echo $idempreendimento ?>&cadastro=<?php echo $idempreendimento_cadastro ?>" method="POST">
							  <div class="form-group">
                                    <label class="col-md-3 control-label">Imobiliaria </label>
                                    <div class="col-md-9">
                                    <select class="form-control" name="imobiliaria_id">
                                    <option value="">Selecione</option>
                                     <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM cliente_tipo
                								 INNER JOIN cliente ON cliente_tipo.idcliente = cliente.idcliente
                	where idtipo = 11
                    order by nome_cli Asc") or die ("Erro ao listar imoveis, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idcliente      = $buscar_slide["idcliente"];
             $nome_cli    	 = $buscar_slide["nome_cli"];        
          

                    ?> 

                    <option value="<?php echo $idcliente ?>"><?php echo $nome_cli ?></option>
                    <?php } ?>  
                    </select>
                                          
                                    </div>
                                </div>

                                
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">% Comissão </label>
                                    <div class="col-md-9">
                                   <input type="text" id="dias_repasse" name="dias_repasse" class="form-control">
                                          
                                    </div>
                                </div>

                                 
                                

                               

                                
							<p class="text-right m-b-0">
							
								<input type="submit" value="Cadastrar" class="btn btn-primary">
							</p>

							</form>
							  <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Imobiliaria</th>
                                         <th>Dias para Repasse</th>
                                          
                                       
                                      
                                          <th>Ações</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM empreendimento_imob
                								 INNER JOIN cliente ON empreendimento_imob.imobiliaria_id = cliente.idcliente
                	where empreendimento_id = $idempreendimento_cadastro
                    order by nome_cli desc") or die ("Erro ao listar imobiliaria, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $nome_cli      				   = $buscar_slide["nome_cli"];
             $idcliente     				   = $buscar_slide["idcliente"];
             $dias_repasse     				   = $buscar_slide["dias_repasse"];
         
          

                    ?> 
                                
                                   <tr class="odd gradeX">
                                       
                                        <td><?php echo "$nome_cli " ?></td>
                                        <td><?php echo "$dias_repasse " ?></td>
                                       

                                        <td><a href="excluir_imobiliaria_empreendimento.php?imobiliaria_id=<?php echo $idcliente ?>&empreendimento_id=<?php echo $idempreendimento ?>&cadastro=<?php echo $idempreendimento_cadastro ?>"> <span class="label label-danger">Excluir</span> </a></td>                      

                                      

                                    </tr>

                                    <?php } ?>


                                   





                                 
                                </tbody>

                            </table>
						</div>







<div class="tab-pane fade" id="default-tab-7">
							<h3 class="m-t-12"><i class="fa fa-cog"></i> Dados Administrativos</h3>
							<form action="descontos.php?idempreendimento=<?php echo $idempreendimento ?>&idempreendimento_cadastro=<?php echo $idempreendimento_cadastro ?>" method="POST">
							  <div class="form-group">
                                    <label class="col-md-3 control-label">Centro de Custo</label>
                                    <div class="col-md-9">

                    <select class="default-select2" name="centrocusto_id" required="" >
                                        <option style="width: 300px !important" value="        ">Escolha</option>
                                         <?php

                      include "conexao.php";
                $query_conta = "SELECT * FROM centrocobranca";
                $executa_conta = mysqli_query ($db,$query_conta) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_conta = mysqli_fetch_assoc($executa_conta)) {//--verifica se são amigos

             $idcentrocobranca       = $buscar_conta['idcentrocobranca'];          
             $ref                    = $buscar_conta['ref'];
             $descricaocentro        = $buscar_conta["descricaocentro"];
            
             $cadastrado = centrocusto_empreendimento($idempreendimento);
            
             ?>
                    <option style="width: 300px !important" value="<?php echo "$idcentrocobranca" ?>" <?php if($cadastrado['centrocusto_id'] == $idcentrocobranca){ ?> selected <?php } ?>> <?php echo "$ref "."/ "."$descricaocentro" ?> </option>
                    <?php } ?>

                    
                                           
                                        </select>
 
                                    </div>
                                </div>



                              	  <div class="form-group">
                                    <label class="col-md-3 control-label">Conta Corrente</label>
                                    <div class="col-md-9">

                     <select class="form-control" name="contacorrente" required="">
                                        <option value="">Escolha</option>
                                         <?php

                      include "conexao.php";
                $query_conta = "SELECT * FROM contacorrente";
                $executa_conta = mysqli_query ($db,$query_conta) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_conta = mysqli_fetch_assoc($executa_conta)) {//--verifica se são amigos

             $idcontacorrente       = $buscar_conta['idcontacorrente'];          
             $agencia       = $buscar_conta['agencia'];
             $conta         = $buscar_conta["conta"];
             $dig_conta     = $buscar_conta["dig_conta"];
             $banco_cedente = $buscar_conta["banco"];

             
            
             ?>
                    <option value="<?php echo "$idcontacorrente" ?>"

                     <?php 
                     if($cadastrado['contacorrente_id'] == $idcontacorrente){ ?> selected <?php } ?>


                    > <?php echo "$banco_cedente "."$agencia "."/ "."$conta"." - "."$dig_conta" ?> </option>
                    <?php } ?>

                    
                                           
                                        </select>
 
                                    </div>
                                </div>


                                   	  <div class="form-group">
                                    <label class="col-md-3 control-label">Taxa de Administração Empreendimento</label>
                                    <div class="col-md-9">

                     <input type="text" name="taxa_administrativa_empreendimento" value="<?php echo $descricao_empreendimento['taxa_administrativa'] ?>" class="form-control">
 
                                    </div>
                                </div>
                                
							<p class="text-right m-b-0">
							
								<input type="submit" value="Cadastrar" class="btn btn-primary">
							</p>

							</form>
						</div>



<div class="tab-pane fade" id="default-tab-8">
							<h3 class="m-t-10"><i class="fa fa-cog"></i> Informe os dados sobre Distrato</h3>
	<form action="descontos.php?idempreendimento=<?php echo $idempreendimento ?>&cadastro=<?php echo $idempreendimento_cadastro ?>" method="POST">
							  <div class="form-group">
                                    <label class="col-md-3 control-label">Descrição Custo </label>
                                    <div class="col-md-9">
  <input type="text" id="descricao_custo" name="descricao_custo" class="form-control" required="">                                          
                                    </div>
                                </div>

                                
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">% de desconto </label>
                                    <div class="col-md-9">
                                   <input type="text" id="percentual_custo" name="percentual_custo" class="form-control" required="">
                                          
                                    </div>
                                </div>

                                   <div class="form-group">
                                    <label class="col-md-3 control-label">Impacto do Custo </label>
                                    <div class="col-md-9">
                                  <select class="form-control" name="impacto_custo" required="">
                                        <option value="">Escolha</option>
                                        <option value="1">Valor do Contrato</option>
                                        <option value="2">Valor Pago</option>  
                                  </select>
                                          
                                    </div>
                                </div>

                                 
                                

                               

                                
							<p class="text-right m-b-0">
							
								<input type="submit" value="Cadastrar" class="btn btn-primary">
							</p>

							</form>
							  <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Descrição do Custo</th>
                                        <th>% de custo</th>
                                        <th>Impacto do Custo</th>                                      
                                         <th>Ações</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM custo_distrato
                								 WHERE empreendimento_id = $idempreendimento_cadastro order by idcusto_distrato desc"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idcusto_distrato    	= $buscar_slide["idcusto_distrato"];
             $descricao_custo      	= $buscar_slide["descricao_custo"];
             $percentual_custo     	= $buscar_slide["percentual_custo"];
             $impacto_custo     	= $buscar_slide["impacto_custo"];


             if($impacto_custo == 1){
             	$exibir_impacto = "Valor do Contrato";

             }else{
             	$exibir_impacto = "Valor Pago";
             }
         
          

                    ?> 
                                
                                   <tr class="odd gradeX">
                                       
                                        <td><?php echo "$descricao_custo " ?></td>
                                        <td><?php echo "$percentual_custo " ?></td>
                                        <td><?php echo "$exibir_impacto " ?></td>
                                       

                                        <td><a href="excluir_item_distrato.php?empreendimento_id=<?php echo $idempreendimento ?>&idcusto_distrato=<?php echo $idcusto_distrato ?>"> <span class="label label-danger">Excluir</span> </a></td>                      

                                      

                                    </tr>

                                    <?php } ?>


                                   





                                 
                                </tbody>

                            </table>
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

$("#desconto_empreendimento").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});
 

$("#percentual_entrada").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});

$("#parcelamento_entrada").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});

$("#comissao_imob_empreendimento").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});

$("#dias_repasse").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});




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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>

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
        <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	  
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	   <script src="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/js/select2.min.js"></script>
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
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
			FormPlugins.init();
		});
	</script>
</body>


</html>