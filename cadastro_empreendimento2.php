<?php 
error_reporting(0);
 //ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<?php 

if(isset($_POST["cliente_id"])){
$projetos           = $_POST['projetos'];
$demolicoes         = $_POST['demolicoes'];
$terraplanagem      = $_POST['terraplanagem'];
$alvenarias         = $_POST['alvenarias'];
$impermeabilizacao  = $_POST['impermeabilizacao'];
$pisos              = $_POST['pisos'];
$canteiros          = $_POST['canteiros'];
$contencao          = $_POST['contencao'];
$superestrutura     = $_POST['superestrutura'];
$eletrica           = $_POST['eletrica'];
$revestimentos      = $_POST['revestimentos'];
$hidraulicas        = $_POST['hidraulicas'];
$descricao               = $_POST['descricao'];
$cliente_id              = $_POST['cliente_id']; 
$tipo_empreendimento     = $_POST['tipo_empreendimento']; 
$participacao            = $_POST['participacao']; 

$descricao_site          = $_POST['descricao_site']; 
$cidade_site             = $_POST['cidade_site']; 
$estado_site             = $_POST['estado_site']; 
$qtd_lotes_site          = $_POST['qtd_lotes_site']; 
$lote_padrao_site        = $_POST['lote_padrao_site']; 
$area_verde_site         = $_POST['area_verde_site']; 
$exibir_site             = $_POST['exibir_site']; 
$matricula_empreendimento             = $_POST['matricula_empreendimento']; 


$url_video              = $_POST["video_site"];
$categoria              = $_POST["categoria"];


    $url_video = explode("watch?v=", $url_video);
    $url_video[0]; // piece1
    $cod_video =  $url_video[1]; // piece2

    $cod_2_video = explode("&t=", $cod_video);
    $parte_certa = $cod_2_video[0]; // piece1
    $cod_3_video =  $cod_2_video[1]; // piece2

include "conexao.php";
$teste = mysqli_query ($db,"INSERT INTO empreendimento_cadastro (categoria, projetos, demolicoes, terraplanagem, alvenarias, impermeabilizacao, pisos, canteiros, contencao, superestrutura, eletrica, revestimentos, hidraulicas, descricao_empreendimento, cliente_id,tipo_empreendimento, descricao_site, cidade_site, estado_site, qtd_lotes_site, lote_padrao_site, area_verde_site, video_site, exibir_site, matricula_empreendimento) values ('$categoria','$projetos', '$demolicoes', '$terraplanagem', '$alvenarias', '$impermeabilizacao', '$pisos', '$canteiros', '$contencao', '$superestrutura', '$eletrica', '$revestimentos', '$hidraulicas','$descricao', '$cliente_id','$tipo_empreendimento','$descricao_site', '$cidade_site', '$estado_site','$qtd_lotes_site','$lote_padrao_site','$area_verde_site','$parte_certa','$exibir_site','$matricula_empreendimento')");
$empreendimento_id = mysqli_insert_id($db);

$insere_proprietario = mysqli_query($db, "INSERT INTO proprietarios (empreendimento_id, proprietario_id, percentual) values ('$empreendimento_id', '$cliente_id','$participacao')");



?>
<script type="text/javascript">
    window.location="empreendimento_lista.php";
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
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php include "topo.php"; ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Cadastro <small>Empreendimentos</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Preencha os campos!</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="cadastro_empreendimento2.php" method="POST" enctype="multipart/form-data">
                               
                                 





     <div class="form-group">
                              
                              
                                    <label class="col-md-3 control-label">Proprietário (Titular):</label>
                                    <div class="col-md-9">
                                       <select class="default-select2 form-control" name="cliente_id" required="">
                                        <option value="">Escolha</option>
                                          <?php

                      include "conexao.php";
                 
                $query_amigo = "SELECT * FROM cliente
                                INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                where cliente_tipo.idtipo = 1  order by nome_cli Asc";


                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar Locatário");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                $idcliente             = $buscar_amigo['idcliente'];
                $nome_cli              = $buscar_amigo["nome_cli"];
                $cpf_cli               = $buscar_amigo["cpf_cli"];
        
             
            
             ?>
               <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
                    <?php } ?>
                    
                                           
                                        </select>
                                    </div>
                                </div>

                                    <div class="form-group">
                                    <label class="col-md-3 control-label">% Participação Titular</label>
                                    <div class="col-md-9">
                                        <input type="text" name="participacao" id="participacao" class="form-control">
                                    </div>
                                </div>


                             <div class="form-group">
                                    <label class="col-md-3 control-label">Tipo de Empreendimento</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="tipo_empreendimento" value="0">
                                           Próprio
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="tipo_empreendimento" value="1">
                                           Administração
                                        </label>
                                         <label class="radio-inline">
                                            <input type="radio" name="tipo_empreendimento" value="2">
                                           Terceiros
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nº Matricula Empreendimento</label>
                                    <div class="col-md-9">
                                        <input type="text" name="matricula_empreendimento" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Titulo</label>
                                    <div class="col-md-9">
                                        <input type="text" name="descricao" class="form-control">
                                    </div>
                                </div>
                                

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Categoria</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="categoria" required="">
                                            <option value="">Escolha</option>
                                            <option value="pre-lancamento">Pré-Lançamento</option>
                                            <option value="lancamento">Lançamento</option>
                                            <option value="em-obras">Em Obras</option>
                                            <option value="prontos-para-morar">Prontos para morar</option>
                                           

                                        </select>
                                    </div>
                                </div> 



                                <div class="form-group">
                                    <label class="col-md-3 control-label">Descrição (Site)</label>
                                    <div class="col-md-9">
                                        <textarea name="descricao_site" class="form-control"></textarea>
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Cidade</label>
                                    <div class="col-md-9">
                                        <input type="text" name="cidade_site" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Estado</label>
                                    <div class="col-md-9">
                                        <input type="text" name="estado_site" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Quantidade de Lotes</label>
                                    <div class="col-md-9">
                                        <input type="text" name="qtd_lotes_site" class="form-control">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">M² Lote Padrão</label>
                                    <div class="col-md-9">
                                        <input type="text" name="lote_padrao_site" class="form-control">
                                    </div>
                                </div>
                           
                                <div class="form-group">
                                    <label class="col-md-3 control-label">M² Area Verde</label>
                                    <div class="col-md-9">
                                        <input type="text" name="area_verde_site" class="form-control">
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Vídeo (link YouTube)</label>
                                    <div class="col-md-9">
                                        <input type="text" name="video_site" class="form-control">
                                    </div>
                                </div>


                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Exibir no Site.</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="exibir_site" value="1"> Sim
                                    </div>
                                </div>
                                
                              
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->

 <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Andamento da Obra</h4>
                        </div>
                        <div class="panel-body">





                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Projetos/Consultorias/Taxas</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="projetos">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Demolições e Remoções</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="demolicoes">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Terraplanagem</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="terraplanagem">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alvenarias/Fechamentos/Divisórias</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="alvenarias">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Impermeabilizações</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="impermeabilizacao">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Pisos</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="pisos">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div> 
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Canteiro/Serviços Preliminares</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="canteiros">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Contenção/Fundação/Infra-Estrutura</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="contencao">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div> 


                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Superestrutura</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="superestrutura">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div> 


                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Instalações Elétricas</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="eletrica">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div> 

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Revest. paredes internas e arremates</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="revestimentos">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div> 



                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Instalações hidráulicas</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="hidraulicas">
                                            <option value="0">0%</option>
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                            <option value="60">60%</option>
                                            <option value="70">70%</option>
                                            <option value="80">80%</option>
                                            <option value="90">90%</option>
                                            <option value="100">100%</option>

                                        </select>
                                    </div>
                                </div> 


                                    <div class="form-group">
                                    <div class="col-md-9">
                                       <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success">
                                    </div>
                                </div> 



</div>
</div>
</div>
                                      </form>

          
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

    <!-- ================== END PAGE LEVEL JS ================== -->
        <script type="text/javascript">
           
$(function(){

//$("#participacao").maskMoney({symbol:'',showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});
 

 





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

    <!-- ================== END PAGE LEVEL JS ================== -->
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
