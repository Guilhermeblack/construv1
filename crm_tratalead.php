<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br">
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
	function verifica_ultimo($id){

		include "conexao.php";

		$query = "SELECT * FROM crm_atendimento WHERE crm_idcli = $id ORDER BY crm_trataid desc limit 1";
	
		$executa = mysqli_query($db, $query);

		while ($buscar_amigo = mysqli_fetch_assoc($executa)) {//--verifica se são amigos
                
                $desc  			= $buscar_amigo["crm_tratadescricao"];
                
         }

         return $desc;

	}

	 ?>
	<script type="text/javascript"> 


		function excluir(){

			document.nome4.action = "crm_excluir_contato.php";
			document.nome4.submit();

		}
	</script>

		<!-- begin #page-loader -->
		<div id="page-loader" class="fade"><span class="spinner"></span></div>
		<!-- end #page-loader -->

		<!-- begin #page-container -->
		<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">


			<?php include "topo.php"; 

			include "conexao.php";

		$queryrota="SELECT crm_statusid FROM crm_grupostatus WHERE crm_idgrupo = '$idgrupo_acesso'"; 
		   
		  $execrota = mysqli_query($db, $queryrota) or die(mysqli_error());
		    
		    $controta = 0;
		 while($receberota = mysqli_fetch_assoc($execrota)) {
		   
		   $rotastatus[$controta]  = $receberota["crm_statusid"];
		   $controta ++;
		} 
?>
			<!-- begin #content -->
			<div id="content" class="content">
				<!-- begin breadcrumb -->

<?php if(isset($_GET["ex"])){ 

		$resposta = $_GET["ex"];
		if($resposta == 1){ ?>

			<div class="alert alert-success fade in m-b-15">
				<strong><font><font>Sucesso! </font></font></strong><font><font>
					Seus dados foram excluídos.
				</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
			</div>
<?php } else { ?>
			<div class="alert alert-danger fade in m-b-15">
				<strong><font><font>Erro! </font></font></strong><font><font>
					Seus dados não foram excluídos.
				</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
			</div>
<?php }} ?>
				<!-- CONFIRMAÇÃO ENVIO -->
	<?php if(isset($_GET["cad"])){ 

		$resposta = $_GET["cad"];
		if($resposta == 1){ ?>

			<div class="alert alert-success fade in m-b-15">
				<strong><font><font>Sucesso! </font></font></strong><font><font>
					Seus dados foram enviados.
				</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
			</div>
		<?php }else{ ?> 
			<div class="alert alert-danger fade in m-b-15">
				<strong><font><font>Erro! </font></font></strong><font><font>
					Seus dados não foram enviados.
				</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
			</div>

		<?php } } elseif (isset($_GET["edit"])) {

			$resposta = $_GET["edit"];
			if ($resposta == 1) { ?> 

				<div class="alert alert-success fade in m-b-15">
					<strong><font><font>Sucesso! </font></font></strong><font><font>
						Seus dados foram editados.
					</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
				</div>


				<?php }			# code...
		} ?>

		


		<!-- FIM CONFIRMAÇÃO ENVIO -->

				<ol class="breadcrumb pull-right">
     			<li><a href="crm_leadlista.php"><span class="label label-success">Novo Cadastro</span></a></li>
     			<?php if (in_array('61', $idrota)) { ?>
					<li><a href="#" onclick="javascript: if (confirm('Você realmente deseja excluir este cadastro?')) excluir()"><span class="label label-danger">EXCLUIR</span></a></li>
				<?php } ?> 
     			

        
      </ol>	

				<h1 class="page-header">Painel de Tratativas</h1>
				<!-- end page-header -->
				
				<!-- begin row -->
				<div class="row">

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
								<h4 class="panel-title">Filtro de Pesquisa</h4>
							</div>

							<div class="panel-body">
								<form class="form-vertical form-bordered" name="myForm" method="POST" action="crm_tratalead.php?filtro=2">

									<div class="form-group">
										<label class="col-md-2 control-label">Nome</label>
										<div class="col-md-4">
											<div class="">
												<input type="text" class="form-control" name="nomefil">

											</div>
										</div>
									</div>



									<div class="form-group">
										<label class="col-md-2 control-label">Origem</label>
										<div class="col-md-4">
											<div class="">
												<input type="text" class="form-control" name="origemfil">

											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Status</label>
										<div class="col-md-4">
											<div class="">
												<select name="statusfil" class="form-control">
													<option value="">Selecione</option>
													<?php 

													include "conexao.php";
													$query_slide = mysqli_query($db,"SELECT * FROM crm_status
														GROUP by crm_idstatus Asc") or die ("Erro ao listar grupo dos clientes, tente mais tarde");


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

            	$id          = $buscar_slide["crm_idstatus"];
            	$status          = $buscar_slide["crm_status"];
            	



            	?> 
            	<option value="<?php echo $id ?>"><?php echo $status ?></option>

            <?php } ?> 
        </select>

    </div>
</div>
</div>


<div class="form-group">
                    <label class="col-md-2 control-label">Imobiliária</label>
                    <div class="col-md-4">
                      <div class="">
                        <select name="imobb" id="imobb" class="form-control">
                          <option value="">Selecione</option>
                          <?php 

                          include "conexao.php";
                          $query_slide = mysqli_query($db,"SELECT * FROM crm_roleta_corretor
                            INNER JOIN cliente ON crm_idimob = idcliente
                            INNER JOIN crm_cli ON crm_idcli = crm_id
                            GROUP BY crm_idimob") or die ("Erro ao listar grupo dos clientes, tente mais tarde");


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

              $id          = $buscar_slide["crm_idimob"];
              $status          = $buscar_slide["nome_cli"];
              



              ?> 
              <option value="<?php echo $id ?>"><?php echo $status ?></option>
            <?php } ?> 
        </select>

    </div>
</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Corretor</label>
    	<div class="col-md-4">
        	<div class="">
            	<select name="corretores" id="corretorid" class="form-control">
                <option value="">Selecione</option>
                        <!--  <?php /*
                          include "conexao.php";
                          $query_slide = mysqli_query($db,"SELECT * FROM crm_roleta_corretor
                            INNER JOIN cliente ON crm_idcorretor = idcliente
                            INNER JOIN crm_cli ON crm_idcli = crm_id
                            GROUP BY crm_idcorretor") or die ("Erro ao listar grupo dos clientes, tente mais tarde");


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

              $id          = $buscar_slide["crm_idcorretor"];
              $status          = $buscar_slide["nome_cli"];
              



              ?> 
              <option value="<?php echo $id ?>"><?php echo $status ?></option>
            <?php } */ ?> -->
        </select>

    	</div>
	</div>
</div>

		<div class="form-group">
			<label class="col-md-2 control-label">Celular</label>
				<div class="col-md-4">
					<div class="">
						<input type="text" name="celular" id="celular" class="form-control" />

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
<!-- end panel -->
</div>
<!-- end col-10 -->



<!-- SEGUNDO BLOCO DE INFORMAÇÃO CHAMADO PELO FILTRO -->


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
			<h4 class="panel-title">Informações dos Leads</h4>
		</div>

		<div class="panel-body">
			<form action="#" method="POST" id="nome4" name="nome4">

				<table id="data-table" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Código</th>
							<th>Nome</th>
							<th>Status</th>
							<th>Email</th>
							<th>Celular</th>
							<th>Origem</th>
							<th>Data Att</th>
							<th>Imobiliária</th>
							<th>Corretor</th>
							<th>Ações</th>

						</tr>
					</thead>
					<tbody>

						<?php
//FILTRO
						 if ($idgrupo_acesso == 7) { //Corretor
								$where = 'WHERE crm_idcorretor = ' . $imobiliaria_idimobiliaria;
							} elseif ($idgrupo_acesso == 6 || $idgrupo_acesso == 13 ) { //imobiliária
									$where = 'WHERE crm_idimob = ' . $imobiliaria_idimobiliaria;
								} elseif ($idgrupo_acesso == 5 || $idgrupo_acesso == 9 || $idgrupo_acesso == 11) { //Administrador
										$where = 'WHERE crm_id > 0';

									} else echo "Permissão de grupo não encontrada!";

						//$where = 'crm_id > 0';
            if(isset($_GET["filtro"])) { 

              $nomefil         = $_POST["nomefil"];
              $origemfil       = $_POST["origemfil"];
              $statusfil     = $_POST["statusfil"];
              $imob           = $_POST["imobb"];
              $corretor1    = $_POST["corretores"];
              $celular 		= $_POST["celular"];



              if($nomefil != ''){
                $where .= " AND crm_nome LIKE '%".$nomefil."%'";
              }

              if($statusfil != ''){
                $where .= " AND crm_statuscli = ".$statusfil;

              }

              if($origemfil != ''){
                $where .= " AND crm_origemnome LIKE '%".$origemfil."%'";
              }

              if($imob != ''){
                $where .= " AND crm_idimob = ".$imob;
              }
              if($corretor1 != ''){
                $where .= " AND crm_idcorretor = ".$corretor1;
              }
              if($celular != ''){
                $where .= " AND crm_celular LIKE '%".$celular."%'";
              }
} //FIM FILTRO

if(isset($_GET["dsh"])) { 
	$dta = strtotime($_GET["dsh"]);
	$dta = date("d-m-Y", $dta);
	$where .= " AND crm_statusdata = '$dta'";
 }
if(isset($_GET["org"])) { 
	$dtao = $_GET["org"];
		
	$where .= " AND crm_origem = '$dtao'";
	} 
	
 
if(isset($_GET["pp"])) { 

	$where .= " AND crm_origem != '1' AND crm_origem != '2' AND crm_origem != '19' AND crm_origem != '1' AND crm_origem != '16'";
	} 
	
	 
if(isset($_GET["dshb0"])){ 
	$cntget = count($_GET);
	$conntt = 0;
	$wheredshb = "AND (";
	foreach ($_GET as $value) {
		
		$wheredshb .= " crm_statuscli = '$value'";
		if ($conntt < ($cntget -1)) {
			$wheredshb .= " OR";
		}
		$conntt++;

		if ($value == 20) {
			$aux = true;
		}
	}
	$wheredshb .= ")";
	if ($aux) {
		$wheredshatt = "";
	} else $wheredshatt = "AND crm_id < 0";
}
	
 
 

 if (in_array('20', $rotastatus)) { 
include "conexao.php";

$query_amigo = "SELECT crm_id, crm_nome, crm_statusdata, crm_statuscli, crm_idstatus, crm_status, crm_cor, crm_email, crm_celular, crm_origemnome, crm_data_cadastro as venc, crm_idcorretor, crm_idimob  
FROM crm_cli 

INNER JOIN crm_origem ON crm_cli.crm_origem = crm_origem.crm_idorigem 
INNER JOIN crm_status ON crm_cli.crm_statuscli = crm_status.crm_idstatus 
INNER JOIN crm_roleta_corretor ON crm_roleta_corretor.crm_idcli = crm_cli.crm_id
 $where $wheredshatt AND crm_statuscli = 20 
ORDER BY SUBSTR( venc, 7, 4), SUBSTR( venc, 4, 2), SUBSTR( venc, 1, 2), crm_horacad";

$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

            	$id               	= $buscar_amigo['crm_id'];
            	$nome               = utf8_encode($buscar_amigo["crm_nome"]);
            	$idstatus 			= $buscar_amigo["crm_idstatus"];
            	$status          	= $buscar_amigo["crm_status"];
            	$email              = $buscar_amigo["crm_email"];
            	$celular            = $buscar_amigo["crm_celular"];
            	$origem       		= $buscar_amigo["crm_origemnome"];
            	$data1       		= $buscar_amigo["venc"];
            	$cor 				= $buscar_amigo["crm_cor"];
            	$imobiliaria    = $buscar_amigo["crm_idimob"];
              $corretor       = $buscar_amigo["crm_idcorretor"];

              $imobiliaria = nome_user($imobiliaria);

              $corretor    = nome_user($corretor);

              $alerta = verifica_ultimo($id);



            	?>

            	<tr class="odd gradeX <?php  if($alerta == 'Alerta!!!'){echo 'danger';} ?> ">
            		<td><input type="checkbox" name="ver2[]" value="<?php echo $id ?>"></td>
            		
            		<td><?php echo $nome ?></td>
            		<td><label class="label" style="background-color: <?php echo $cor;?>"> <?php echo $status; ?></label></td>
            		<td><?php echo $email ?></td>
            		<td><?php echo $celular ?></td>
            		<td><?php echo $origem ?></td>
            		<td><?php echo $data1 ?></td>
            		<td><?php echo $imobiliaria ?></td>
                <td><?php echo $corretor ?></td>


            		<td>

            			<input type="hidden" name="trataid" value="<?php echo $id ?>"><a href="crm_fichalead.php?numero=<?php echo $id ?>"><span class="label label-success">Abrir</span></a>
            			
<?php if (in_array('60', $idrota)) { ?>
                   <input type="hidden" name="editaid" value="<?php echo $id ?>"><a href="crm_leadlista_editar.php?id=<?php echo $id ?>"><span class="label label-warning">Editar</span></a>         
<?php } ?>
            			

            		</td>

            	</tr>
            	<?php $cont = $cont + 1;

            } 
			}							//inner join para mostrar o nome da origem e nao o ID.

            $query_amigo = "SELECT crm_id, crm_nome, crm_statuscli, crm_idstatus, crm_status, crm_cor, crm_email, crm_celular, crm_origemnome, crm_statusdata, crm_idcorretor, crm_idimob  
            FROM crm_cli 
            
            INNER JOIN crm_origem ON crm_cli.crm_origem = crm_origem.crm_idorigem 
            INNER JOIN crm_status ON crm_cli.crm_statuscli = crm_status.crm_idstatus
            INNER JOIN crm_roleta_corretor ON crm_roleta_corretor.crm_idcli = crm_cli.crm_id
             
           $where $wheredshb AND crm_statuscli != 20 #<<<<<<<<<<<<<<<<<<ID AGUARDANDO ATENDIMENTO
          ORDER BY SUBSTR( crm_statusdata, 7, 4), SUBSTR( crm_statusdata, 4, 2), SUBSTR( crm_statusdata, 1, 2)";
					$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");



            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

            	$id               	= $buscar_amigo['crm_id'];
            	$nome               = utf8_encode($buscar_amigo["crm_nome"]);
            	$status          	= $buscar_amigo["crm_status"];
            	$email              = $buscar_amigo["crm_email"];
            	$celular            = $buscar_amigo["crm_celular"];
            	$origem       		= $buscar_amigo["crm_origemnome"];
            	$data2       		= $buscar_amigo["crm_statusdata"];
            	$cor 				= $buscar_amigo["crm_cor"];
            	$imobiliaria    = $buscar_amigo["crm_idimob"];
            	$statusatual	= $buscar_amigo["crm_statuscli"];
              $corretor       = $buscar_amigo["crm_idcorretor"];

              $imobiliaria = nome_user($imobiliaria);

              $corretor    = nome_user($corretor);

              $alerta = verifica_ultimo($id);


            	if (in_array($statusatual, $rotastatus)){
            		
            	
            	?>

            	<tr class="odd gradeX <?php if($alerta == 'Alerta!!!'){echo 'danger';} ?> ">
            		<td><input type="checkbox" name="ver2[]" value="<?php echo $id ?>"></td>
            		
            		<td><?php echo $nome ?></td>
            		<td><label class="label" style="background-color: <?php echo $cor; ?>"> <?php echo $status ?></label></td>
            		<td><?php echo $email ?></td>
            		<td><?php echo $celular ?></td>
            		<td><?php echo $origem ?></td>
            		<td><?php echo $data2 ?></td>
            		<td><?php echo $imobiliaria ?></td>
                	<td><?php echo $corretor ?></td>


            		<td>

            			<input type="hidden" name="trataid" value="<?php echo $id ?>"><a href="crm_fichalead.php?numero=<?php echo $id ?>"><span class="label label-success">Abrir</span></a>
<?php if (in_array('60', $idrota)) { 
            	 ?>
            			<input type="hidden" name="editaid" value="<?php echo $id ?>"><a href="crm_leadlista_editar.php?id=<?php echo $id ?>"><span class="label label-warning">Editar</span></a>
<?php }  ?>
            			<input type="hidden" name="idcorretor" class="form-control" value="<?php echo $imobiliaria_idimobiliaria ; ?>">

            		</td>

            	</tr>
            
            	<?php } $cont = $cont + 1;

            } ?>
        </tbody> 
    </table>
</form>
</div>
</div>
<!-- end panel -->
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
	<!-- ================== END PAGE LEVEL JS ================== -->
<script type="text/javascript"> 

	document.getElementById('menucrm').style.display="block";

</script>
	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
			Notification.init();
		});
	</script>

	<script type="text/javascript">
  $(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#imobb').on('change', function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'crm_consultar_corretor.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'id=' + $('#imobb').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
			var $corretor2 = $('#corretorid');
            $corretor2.empty(); 

            $.each(data, function(idcliente, nome){
                   $corretor2.append('<option value=' + idcliente + '>' + nome + '</option>');
            }



            );

              $corretor2.change();       
                       
                 
                }
           });   
   return false;    
   })
});
</script>


</body>


</html>
