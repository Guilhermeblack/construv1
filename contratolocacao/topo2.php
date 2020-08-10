 <link rel="shortcut icon" href="https:/immobilebusiness.com.br/home/favicon.ico">

<?php
 $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];
 $idrota 					= $_SESSION["idrota"];
 $idgrupo_acesso 			= $_SESSION["idgrupo_acesso"];
        
             
                                  

   
                 


function nome_user($id){
    include "conexao.php";
     $query_igpm = "SELECT nome_cli FROM cliente where idcliente = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $nome_cli             = $buscar_amigoc['nome_cli'];
}
return $nome_cli;

} 

function verifica_tipo($idcliente){
				include "conexao.php";
	 			$query_amigo = "SELECT * FROM cliente_tipo
	 							INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo
                WHERE idcliente = $idcliente";


$cont = 0;
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Tipo");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $descricao_tipo             = $buscar_amigo['descricao_tipo'];

$dados[$cont] = $descricao_tipo;
$cont = $cont + 1;
}

return $dados;
}

function nome_cli($id){
    include "conexao.php";
     $query_igpm = "SELECT nome_cli FROM locacao
     				INNER JOIN cliente ON locacao.cliente_idcliente = cliente.idcliente

      where idlocacao = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar cliente");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $nome_cli             = $buscar_amigoc['nome_cli'];
}
return $nome_cli;

} 
function nome_cli_empreendimento($id){
    include "conexao.php";
     $query_igpm = "SELECT nome_cli FROM venda
     				INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente

      where idvenda = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar cliente");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $nome_cli             = $buscar_amigoc['nome_cli'];
}
return $nome_cli;

} 
function contrato_ativo($venda_id){
    include "conexao.php";
    $query_igpm = "SELECT COUNT(idparcelas) as total 
                    from parcelas 
                    where venda_idvenda = $venda_id 
                    and tipo_venda = 2 
                    AND fluxo = 0 
                    and situacao = 'Em Aberto'";


    $executa_igpm = mysqli_query ($db, $query_igpm);
    while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $total             = $buscar_amigoc['total'];
}
return $total;

} 
function nome_cli_imovel($id){
    include "conexao.php";
     $query_igpm = "SELECT nome_cli FROM venda_imovel
     				INNER JOIN cliente ON venda_imovel.cliente_idcliente = cliente.idcliente

      where idvenda_imovel = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar cliente");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $nome_cli             = $buscar_amigoc['nome_cli'];
}
return $nome_cli;

} 
function converterdataigpm($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}  

////////////////  Abaixo verificação da necessidade de reajuste do IGPM nos contratos de locação


function verifica_locacao(){

	date_default_timezone_set('America/Sao_Paulo'); 
$data_hoje = date('Y-m-d');
					include "conexao.php";
                   $query_igpm = "SELECT primeira_parcela, igpm, idlocacao FROM locacao";
$cont = 0;
                $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $primeira_parcela_igpm             = $buscar_amigoc['primeira_parcela'];
             $igpm            					= $buscar_amigoc['igpm'];
             $idlocacao         				= $buscar_amigoc['idlocacao'];

             if($igpm == ''){
             	$data_para_calculo = $primeira_parcela_igpm;
             }else{
             	$data_para_calculo = $igpm;
             }

             $data_para_calculo_tratada = converterdataigpm($data_para_calculo);


        $time_inicial = strtotime($data_hoje);
		$time_final   = strtotime($data_para_calculo_tratada);

		
		$diferenca = $time_inicial - $time_final;

		$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

		if($dias >= 334){ 
 
$retorno_igpm[$cont] = $idlocacao;

$cont = $cont + 1;


 
} }

return $retorno_igpm;
}
function verifica_empreendimento(){

	date_default_timezone_set('America/Sao_Paulo'); 
$data_hoje = date('Y-m-d');
					include "conexao.php";
                   $query_igpm = "SELECT vencimento_primeira, igpm, idvenda FROM venda";
$cont = 0;
                $executa_igpm = mysqli_query($db, $query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $vencimento_primeira         = $buscar_amigoc['vencimento_primeira'];
             $igpm            			  = $buscar_amigoc['igpm'];
             $idvenda         			  = $buscar_amigoc['idvenda'];

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
	<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="../index.html" class="navbar-brand"><span class="navbar-logo"></span>IBusiness</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form class="navbar-form full-width">
							<div class="form-group">
								<input type="text" class="form-control" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>
				<li class="dropdown">
						<a href="../javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							<i class="fa fa-bell-o"></i>
							
							
							
																	

							
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown">
                                                   
      

                          
                           
						</ul>
					</li>
					<li class="dropdown navbar-user">
						<a href="../javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							

							 <?php 
						    include "conexao.php";
						 	$query_path_foto = "SELECT path_foto FROM cliente WHERE idcliente = $imobiliaria_idimobiliaria";
						 	$executa_path_foto = mysqli_query($db, $query_path_foto);
						 	$buscar_path = mysqli_fetch_assoc($executa_path_foto);
						   

						 	if(!empty($buscar_path['path_foto'])){

						  ?>
							<img src="<?php echo $buscar_path['path_foto']?>" /> 

								<?php 

							}else{
								?>
							<img src="../img/foto_default.jpg" /> 

								<?php
							}


								?>



						<span class="hidden-xs"> <?php echo nome_user($imobiliaria_idimobiliaria) ?>	</span> 



							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							
							<li><a href="../logout.php">Sair</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<a href="../javascript:;"></a>
						</div>
						<div class="info">
							Immobile
							<small>Business</small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Menu</li>
					<li class="has-sub">
						<a href="../painel.php">
							<span class="badge pull-right"></span>
							
							 <i class="fa fa-dashboard"></i>
							<span>Painel Geral</span>
						</a>
						
					</li>  
<!--
						<li class="has-sub">
						<a href="../javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-code"></i>
						    <span>Site</span>
					    </a>
						<ul class="sub-menu">
						 
						 <li><a href="../contatos.php">Contatos</a></li> 
						 <li><a href="../adicionar_slide.php">Destaques</a></li> 
  						 <li><a href="../empreendimento_lista_site.php">Empreendimentos</a></li> 
  						 <li><a href="../parceiros.php">Portifólio</a></li> 
 					

 					
 							
			
						</ul>
					</li> -->












<?php if (in_array('42', $idrota)) { ?>
					  <li class="has-sub">
						<a href="../notificacoes.php">
							<span class="badge pull-right"></span>
							
							 <i class="fa fa-clipboard"></i>
							<span>Pendências</span>
						</a>
						
					</li>
      <?php } ?>

<?php if (in_array('47', $idrota)) { ?>
					  <li class="has-sub">
						<a href="../sistema_ocorrencia.php">
							<span class="badge pull-right"></span>
							
							 <i class="fa fa-exclamation-triangle"></i>
							<span>Ocorrências</span>
						</a>
						
					</li>
      <?php } ?>	
      <?php if (in_array('48', $idrota)) { ?>
					  <li class="has-sub">
						<a href="../cadastro_documentos.php">
							<span class="badge pull-right"></span>
							
							 <i class="fa fa-file-pdf-o"></i>
							<span>Documentos</span>
						</a>
						
					</li>
      <?php } ?>				

<?php if (in_array('4', $idrota)) { ?>
	<li class="has-sub">
						<a href="../javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-money"></i>
						    <span>Financeiro</span>
					    </a>
						<ul class="sub-menu">
						   
						   <?php if (in_array('5', $idrota)) { ?>
                                <li><a href="../contas_apagar.php">Contas a Pagar</a></li> 
                            <?php } ?>
                            
                            <?php if (in_array('8', $idrota)) { ?>
                                <li><a href="../contas_areceber.php">Contas a Receber</a></li>
                            <?php } ?>   

                             <?php if (in_array('8', $idrota)) { ?>
                                <li><a href="../retorno_santander1.php">Retorno Sicredi</a></li>
                            <?php } ?>    

                            <?php if (in_array('8', $idrota)) { ?>
                                <li><a href="../movimentacao_bancaria.php">Movimentação Bancária</a></li>
                            <?php } ?>    


                            <?php if (in_array('11', $idrota)) { ?>    
 								<li><a href="../repasse.php">Repasse</a></li> 
 							<?php } ?>  

 							
 							
			
						</ul>
					</li>


<?php } ?>















                      
				
					<li class="has-sub">
						<a href="../clientes.php">
						    
						    <i class="fa fa-users"></i>
						    <span>Cadastro Geral</span>
					    </a>
						
					</li>
					
					
					<?php if (in_array('15', $idrota)) { ?>
			<!--		<li class="has-sub">
						<a href="../javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-home"></i>
						    <span>Imóveis /Locação</span>
					    </a>
						<ul class="sub-menu">
						     <li><a href="../captacao_imovel.php">Formulários</a></li>
						    
						    <?php if (in_array('16', $idrota)) { ?>
						    <li><a href="../imoveis.php">Imóveis</a></li>
						    <?php } ?>

						    <?php if (in_array('20', $idrota)) { ?>

			 				<li><a href="../relatorio_locacoes.php">Contratos Locação</a></li>
			 				<?php } ?>
						</ul>
					</li>
		-->
					<?php } ?>

					 <?php if (in_array('53', $idrota)) { ?>

						<li>
						<a href="../imobiliarias.php">
						   
						    <i class="fa fa-home"></i> 
						    <span>Imobiliárias</span>
						</a>
						
					</li>
					<?php } ?>


						    <?php if (in_array('22', $idrota)) { ?>

						<li>
						<a href="../empreendimento_lista.php">
						   
						    <i class="fa fa-building-o"></i> 
						    <span>Empreendimentos</span>
						</a>
						
					</li>
					<?php } ?>

					   <?php if (in_array('24', $idrota)) { ?>
					<li>
						<a href="../empreendimentos.php">
						   
						    <i class="fa fa-align-left"></i> 
						    <span>Gestão de Vendas</span>
						</a>
						
					</li>
					<?php } ?>
                                      
					
					
 

		

				
				



			





			
					

		
					<?php if (in_array('33', $idrota)) { ?>

						<li class="has-sub">
						<a href="../javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-file-pdf-o"></i>
						    <span>Relatórios</span>
					    </a>
						<ul class="sub-menu">
						
   						<li><a href="../relatorio_vendas_imprimir.php">Relatório de Vendas</a></li> 
   						<li><a href="../relatorio_contas_apagar.php">Contas a Pagar</a></li> 
   						<li><a href="../recebimentos.php">Recebimentos</a></li> 
   						<li><a href="../comissao.php">Comissão</a></li> 
   						<li><a href="../relatorio_carta_cobranca.php">Carta Cobrança</a></li> 
   						<li><a href="../relatorio_extrato_cliente.php">Extrato Cliente</a></li> 
   						<li><a href="../gerenciador_inadimplencia.php">Inadimplência Empreendimentos</a></li> 
 <!--					<li><a href="../gerenciador_inadimplencia_locacao.php">Inadimplência Locação</a></li>-->
 						<li><a href="../cont_pend_reajustar.php">Contratos Pendentes à Reajustar</a></li>
						<li><a href="../cont_reajustar.php">Contratos à Reajustar</a></li> 
						<li><a href="../relatorio_tipo_cadastro.php">Tipo - Cadastro</a></li> 

						
						<li><a href="../relatorio_clientes_completo.php">Clientes - Completo</a></li>
						<li><a href="../contratolocacao/imobiliarias.php">Imobiliárias</a></li>
						<li><a href="../relatorio_lotes_disponiveis.php">Lotes</a></li>
						<li><a href="../juridico.php">Jurídico</a></li>
						<li><a href="../gerar_dimob.php">DIMOB Empreendimentos</a></li>
<!--						<li><a href="../gerar_dimob_locacao.php">DIMOB Locação</a></li>-->
						<li><a href="../aniversariantes.php">Aniversariantes</a></li>

						   
					
						</ul>
					</li>
					<?php } ?>

					<?php if (in_array('33', $idrota)) { ?>
					<li class="has-sub">
						<a href="../javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-cog"></i>
						    <span>Configurações</span>
					    </a>
						<ul class="sub-menu">
						<li><a href="../empreendimento_lista_contratos.php">Modelos de Contratos</a></li>
						<li><a href="../reajustar_contrato.php">Reajustar Contratos</a></li>
						<li><a href="../movimentar_carteira.php">Movimentação de Clientes</a></li>
						    <li><a href="../relatorio_conta_corrente.php">Conta Corrente</a></li>
						

  <li><a href="../centro_cobranca.php">Centro de Receita</a></li>
 <li><a href="../forma_pagamento.php">Formas de Pagamento</a></li>

						    <li><a href="../relatorio_grupos.php">Grupos de Acesso</a></li>
					

					
						    <li><a href="../indices.php">Indice Reajuste</a></li>
					
						    <li><a href="../pacotes.php">Etapas de Projeto</a></li>
					

						    <li><a href="../insumos.php">Insumos</a></li>
					
						    <li><a href="../grupo_clientes.php">Grupo de Clientes</a></li>
				
						    <li><a href="../impostos.php">Impostos</a></li>
					
						    <li><a href="../talao_cheque.php">Cheques</a></li>
					
						</ul>
					</li>


							 <?php if (in_array('32', $idrota)) { ?>
<!--
					<li>
						<a href="../projetos.php">
							<span class="badge pull-right"></span>
							 
							<i class="fa fa-home"></i> 
							<span>Projetos</span>
						</a>
						
					</li>
 -->
					<?php } ?>

						<li class="has-sub">
						<a href="../simulador_price.php">
							<span class="badge pull-right"></span>
							
							<i class="fa fa-calculator"></i> 
							<span>Simulador Price</span>
						</a>
						
					</li>

<?php } ?>
					
				
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>