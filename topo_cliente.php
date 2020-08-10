<?php

$idcliente = $_SESSION["id_usuario"];          

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

function nome_user($id){
    include "conexao.php";
     $query_igpm = "SELECT nome_cli FROM cliente where idcliente = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar Nome User");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $nome_cli             = $buscar_amigoc['nome_cli'];
}
return $nome_cli;

}              
                                  

            include "conexao.php";
            $query_amigo = "SELECT * FROM cliente
                			WHERE idcliente = $idcliente";

            $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro Cliente");
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {
           
             $nome_cli             = $buscar_amigo['nome_cli'];
      
          	}
function empreendimento_total($idcliente){
    include "conexao.php";
    $query_amigo = "SELECT * FROM empreendimento_cadastro WHERE cliente_id =$idcliente";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}
function locatario_total($idcliente){
    include "conexao.php";
    $query_amigo = "SELECT * FROM locacao WHERE cliente_idcliente = $idcliente";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}
function locador_total($idcliente){
    include "conexao.php";
    $query_amigo = "SELECT * FROM locacao 
    				INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
    				WHERE locador_idlocador = $idcliente";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}

?>
	<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="index.html" class="navbar-brand"><span class="navbar-logo"></span>IBusiness</a>
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
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							<i class="fa fa-bell-o"></i>
							
							
								
																	

							
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown">
						    <li class="dropdown-header"> </li>
                      




		  				
                          
                           
						</ul>
					</li>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							
					


							<img src="http://immobilebusiness.com.br/vendas/carteira/fotos/hr.png" /> 




							<span class="hidden-xs">
							<?php echo $nome_cli ?>



							</span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							
							<li><a href="logout.php">Sair</a></li>
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
							<a href="javascript:;"></a>
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
			<?php 	
			$empreendimento_total = empreendimento_total($idcliente);
			$locatario_total      = locatario_total($idcliente);
			$locador_total        = locador_total($idcliente);
			?>	



				<li class="has-sub">
						<a href="painel_cliente.php">
						    
						    <i class="fa fa-tachometer"></i>
						    <span>Painel Geral</span>
					    </a>
						
					</li>

				<li class="has-sub">
						<a href="sistema_ocorrencia_cliente.php">
						    
						    <i class="fa fa-exclamation-triangle"></i>
						    <span>Ocorrências</span>
					    </a>
						
					</li>




                   <?php if($locador_total != ''){ ?>                    
				
					<li class="has-sub">
						<a href="area_cliente_locacao.php">
						    
						    <i class="fa fa-users"></i>
						    <span>Locador</span>
					    </a>
						
					</li>
					<?php } ?>
					
					<?php if($locatario_total != ''){ ?>          
					<li class="has-sub">
						<a href="area_cliente_aluguel.php">
						    
						    <i class="fa fa-users"></i>
						    <span>Locatário</span>
					    </a>
						
					</li>
					<?php } ?>

					<?php if($empreendimento_total != ''){ ?>
					<li class="has-sub">
						<a href="area_cliente_empreendimentos.php">
						    
						    <i class="fa fa-users"></i>
						    <span>Empreendedor</span>
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