<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

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
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
<?php 

function contrato_ativo_loc($venda_id){
    include "conexao.php";
    $query_igpm = "SELECT COUNT(idparcelas) as total 
                    from parcelas 
                    where venda_idvenda = $venda_id 
                    and tipo_venda = 1 
                    AND fluxo = 0 
                    and situacao = 'Em Aberto'";


    $executa_igpm = mysqli_query ($db, $query_igpm);
    while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $total             = $buscar_amigoc['total'];
}
return $total;

} 

function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}   



function troca_placa($idimovel){

    include "conexao.php";
    $hoje = date('Y-m-d');
     $query_igpm = "SELECT * FROM placa_imovel
                    INNER JOIN imovel ON placa_imovel.imovel_idimovel = imovel.idimovel
                    WHERE imovel_idimovel = $idimovel order by idplaca_imovel desc limit 1";

                $executa_igpm = mysqli_query ($db,$query_igpm) or die ("Erro ao listar troca de placa");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $idimovel           = $buscar_amigoc['idimovel'];
            $endereco           = $buscar_amigoc['endereco'];
            $numero             = $buscar_amigoc['numero'];
            $cidade_idcidade    = $buscar_amigoc['cidade_idcidade'];
            $estado             = $buscar_amigoc['estado'];
            $data_placa         = $buscar_amigoc["data_placa"];

            $data_placa         = converterdata($data_placa);

            $time_inicial       = strtotime($hoje);
            $time_final         = strtotime($data_placa);

        
            $diferenca = $time_inicial - $time_final;

            $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

            
            if($dias >= 30){ 

           $dados = 1;
         }
}
return $data_placa;

}









?>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
<?php include "topo.php" ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			
			<!-- begin page-header -->
			<h1 class="page-header">Notificações</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <div class="result-container">
			          
                        <ul class="result-list">
                       	<?php 

    $hoje = date('Y-m-d');

                include "conexao.php";
     			$query_igpm = "SELECT * FROM reserva
                               INNER JOIN imovel ON reserva.imovel_idimovel = imovel.idimovel                           
                               WHERE status_reserva != '1'";

                $executa_igpm = mysqli_query ($db,$query_igpm) or die ("Erro ao listar imoveis em visita");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $idimovel           = $buscar_amigoc['idimovel'];
             $endereco           = $buscar_amigoc['endereco'];
             $numero             = $buscar_amigoc['numero'];
             $cidade_idcidade    = $buscar_amigoc['cidade_idcidade'];
             $estado             = $buscar_amigoc['estado'];
             $img_principal      = $buscar_amigoc['img_principal'];


                       	    
                       	?>


                            <li>
                                <div class="result-image">
                                    <a href="javascript:;"><img src="fotos/<?php echo $idimovel ?>/<?php echo $img_principal ?>" alt="" /></a>
                                </div>
                                <div class="result-info">
                                    <h4 class="title"><a href="javascript:;">Imóvel com Visita em Andamento.</p></a></h4>
                                    <p class="desc">
                                        <?php echo "Endereço: ".$endereco.", ".$numero ?>   <br>
                                        Ref.: <?php echo $idimovel ?>
                                    </p>
                                    
                                </div>
                                <div class="result-price">
                                    <small></small>
                                    <a href="ver_imovel.php?idimovel=<?php echo $idimovel ?>" class="btn btn-inverse btn-block">Detalhes</a>
                                </div>
                            </li>
                         

                            <?php } ?>

				<?php 
				/// Aviso de vencimento de Exclusividade
				$query_igpm = "SELECT * FROM imovel where exclusividade = '1'";
                $executa_igpm = mysqli_query ($db,$query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $idimovel           = $buscar_amigoc['idimovel'];
            $endereco           = $buscar_amigoc['endereco'];
            $numero             = $buscar_amigoc['numero'];
            $cidade_idcidade    = $buscar_amigoc['cidade_idcidade'];
            $estado             = $buscar_amigoc['estado'];
            $data_exclusividade = $buscar_amigoc["data_exclusividade"];
            $img_principal      = $buscar_amigoc['img_principal'];
            $data_exclusividade = converterdata($data_exclusividade);

			$time_inicial 		= strtotime($hoje);
			$time_final   		= strtotime($data_exclusividade);

		
			$diferenca = $time_final - $time_inicial;

			$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

			
			if($dias <= 10){   ?>

					  <li>
                                <div class="result-image">
                                    <a href="javascript:;"><img src="fotos/<?php echo $idimovel ?>/<?php echo $img_principal ?>" alt="" /></a>
                                </div>
                                <div class="result-info">
                                    <h4 class="title"><a href="javascript:;">Vencimento de Exclusividade.</p></a></h4>
                                    <p class="desc">
                                        <?php echo "Endereço: ".$endereco.", ".$numero ?>   <br>
                                        Ref.: <?php echo $idimovel ?>
                                    </p>
                                    
                                </div>
                                <div class="result-price">
                                    <small></small>
                                    <a href="ver_imovel.php?idimovel=<?php echo $idimovel ?>" class="btn btn-inverse btn-block">Detalhes</a>
                                </div>
                            </li>
                         

                            <?php }
                        }
                             ?>



                       	<?php 


                 /// aviso de troca de placa do imovel
                include "conexao.php";
     			$query_igpm = "SELECT * FROM placa_imovel
                                INNER JOIN imovel ON placa_imovel.imovel_idimovel = imovel.idimovel";

                $executa_igpm = mysqli_query ($db,$query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $idimovel           = $buscar_amigoc['idimovel'];
            $endereco           = $buscar_amigoc['endereco'];
            $numero             = $buscar_amigoc['numero'];
            $cidade_idcidade    = $buscar_amigoc['cidade_idcidade'];
            $estado             = $buscar_amigoc['estado'];
            //$data_placa			= $buscar_amigoc["data_placa"];




            $data_placa         = troca_placa($idimovel);
          
            $time_inicial       = strtotime($hoje);
            $time_final         = strtotime($data_placa);

        
            $diferenca = $time_inicial - $time_final;

            $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias


            
            if($dias >= 30){ 
               ?>

					  <li>
                                <div class="result-image">
                                    <a href="javascript:;"><img src="fotos/<?php echo $idimovel ?>/<?php echo $img_principal ?>" alt="" /></a>
                                </div>
                                <div class="result-info">
                                    <h4 class="title"><a href="javascript:;">Troca de Placa Imóvel.</p></a></h4>
                                    <p class="desc">
                                        <?php echo "Endereço: ".$endereco.", ".$numero ?>   <br>
                                        Ref.: <?php echo $idimovel ?>
                                    </p>
                                    
                                </div>
                                <div class="result-price">
                                    <small></small>
                                    <a href="ver_imovel.php?idimovel=<?php echo $idimovel ?>" class="btn btn-inverse btn-block">Detalhes</a>
                                </div>
                            </li>
                         

                            <?php }
                        }
                             ?>

				<?php 
				/// Aviso de vencimento de Contrato
				$query_igpm = "SELECT * FROM locacao";
                $executa_igpm = mysqli_query ($db,$query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $idimovel          = $buscar_amigoc['imovel_idimovel'];
            $idlocacao         = $buscar_amigoc['idlocacao'];
            $endereco           = $buscar_amigoc['endereco'];
            $numero             = $buscar_amigoc['numero'];
            $cidade_idcidade    = $buscar_amigoc['cidade_idcidade'];
            $estado             = $buscar_amigoc['estado'];
            $img_principal      = $buscar_amigoc['img_principal'];            
            $primeira_parcela   = $buscar_amigoc['primeira_parcela'];
	        $prazo_contrato     = $buscar_amigoc['prazo_contrato'];

            $contrato_ativo_loc = contrato_ativo_loc($idlocacao);

			
			if($contrato_ativo_loc == 1){   ?>

	  <li>
                                <div class="result-image">
                                    <a href="javascript:;"><img src="fotos/<?php echo $idimovel ?>/<?php echo $img_principal ?>" alt="" /></a>
                                </div>
                                <div class="result-info">
                                    <h4 class="title"><a href="javascript:;">Aviso de Vencimento de Contrato</p></a></h4>
                                    <p class="desc">
                                        <?php echo "Endereço: ".$endereco.", ".$numero ?>   <br>
                                        Nº Contrato.: <?php echo $idlocacao ?>
                                    </p>
                                    
                                </div>
                                <div class="result-price">
                                    <small></small>
                                    <a href="ver_contrato.php?idlocacao=<?php echo $idlocacao ?>" class="btn btn-inverse btn-block">Detalhes</a>
                                </div>
                            </li>
                <?php } }?>




    <?php 
                /// Aviso de vencimento de Contrato
                $query_igpm = "SELECT * FROM venda
                               INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente
                               INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                               INNER JOIN lote ON venda.lote_idlote = lote.idlote 
                               INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                               INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro";
                $executa_igpm = mysqli_query ($db,$query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $idvenda            = $buscar_amigoc['idvenda'];
            $nome_cli           = $buscar_amigoc['nome_cli'];
            $quadra             = $buscar_amigoc['quadra'];
            $lote               = $buscar_amigoc['lote'];
            $descricao_empreendimento             = $buscar_amigoc['descricao_empreendimento'];
          

            $contrato_ativo = contrato_ativo($idvenda);

            
            if($contrato_ativo == 1){   ?>

      <li>
                                <div class="result-image">
                                    <a href="javascript:;"><img src="fotos/<?php echo $idimovel ?>/<?php echo $img_principal ?>" alt="" /></a>
                                </div>
                                <div class="result-info">
                                    <h4 class="title"><a href="javascript:;">Aviso de Vencimento de Contrato</p></a></h4>
                                    <p class="desc">
                                        <?php echo "Empreendimento: ".$descricao_empreendimento.", Quadra:".$quadra."/Lote: ".$lote ?>   <br>
                                        Nº Contrato.: <?php echo $idvenda ?> / <?php echo $nome_cli ?>
                                    </p>
                                    
                                </div>
                                <div class="result-price">
                                    <small></small>
                                    <a href="ver_contrato_empreendimento.php?venda_idvenda=<?php echo $idvenda ?>" class="btn btn-inverse btn-block">Detalhes</a>
                                </div>
                            </li>
                <?php } }?>







    <?php 
                /// Aviso de aprovação de proposta
                $query_igpm = "SELECT * FROM venda
                               INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente
                               INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                               INNER JOIN lote ON venda.lote_idlote = lote.idlote 
                               INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                               INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                               WHERE status_venda = 0";
                $executa_igpm = mysqli_query ($db,$query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
            $idvenda            = $buscar_amigoc['idvenda'];
            $nome_cli           = $buscar_amigoc['nome_cli'];
            $quadra             = $buscar_amigoc['quadra'];
            $lote               = $buscar_amigoc['lote'];
            $descricao_empreendimento             = $buscar_amigoc['descricao_empreendimento'];
            $empreendimento_id             = $buscar_amigoc['idempreendimento'];
          


            
         ?>

      <li>
                                <div class="result-image">
                                    <a href="javascript:;"><img src="fotos/<?php echo $idimovel ?>/<?php echo $img_principal ?>" alt="" /></a>
                                </div>
                                <div class="result-info">
                                    <h4 class="title"><a href="javascript:;">Contrato Para Aprovação</p></a></h4>
                                    <p class="desc">
                                        <?php echo "Empreendimento: ".$descricao_empreendimento.", Quadra:".$quadra."/Lote: ".$lote ?>   <br>
                                        Nº Contrato.: <?php echo $idvenda ?> / <?php echo $nome_cli ?>
                                    </p>
                                    
                                </div>
                                <div class="result-price">
                                    <small></small>
                                    <a href="relatorio_vendas.php?idempreendimento=<?php echo $empreendimento_id ?>&quadra=&lote=&nome_cliente=&numero_ficha=&status_venda=0&imobiliaria_id=Todos&corretor_id=0" class="btn btn-inverse btn-block">Detalhes</a>
                                </div>
                            </li>
                <?php  }?>
























                        </ul>
                        
                    </div>
			    </div>
			    <!-- end col-12 -->
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
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>

</html>
