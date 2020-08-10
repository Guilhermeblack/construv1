<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<?php 

if(isset($_POST["descricao_site"])){
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


$idempreendimento_cadastro    = $_GET['idempreendimento']; 


$descricao_site          = $_POST['descricao_site']; 
$cidade_site             = $_POST['cidade_site']; 
$estado_site             = $_POST['estado_site']; 
$qtd_lotes_site          = $_POST['qtd_lotes_site']; 
$lote_padrao_site        = $_POST['lote_padrao_site']; 
$area_verde_site         = $_POST['area_verde_site']; 
$exibir_site             = $_POST['exibir_site']; 

$url_video              = $_POST["video_site"];
$categoria              = $_POST["categoria"];


    $url_video = explode("watch?v=", $url_video);
    $url_video[0]; // piece1
    $cod_video =  $url_video[1]; // piece2

    $cod_2_video = explode("&t=", $cod_video);
    $parte_certa = $cod_2_video[0]; // piece1
    $cod_3_video =  $cod_2_video[1]; // piece2


include "conexao.php";
$atualiza = ("UPDATE empreendimento_cadastro set


projetos        ='$projetos',
demolicoes      ='$demolicoes',
terraplanagem   ='$terraplanagem',
alvenarias      ='$alvenarias',
impermeabilizacao='$impermeabilizacao',
pisos           ='$pisos',
canteiros       ='$canteiros',
contencao       ='$contencao',
superestrutura  ='$superestrutura',
eletrica        ='$eletrica',
revestimentos   ='$revestimentos',
hidraulicas     ='$hidraulicas',
descricao_site            ='$descricao_site',
cidade_site               ='$cidade_site',
estado_site               ='$estado_site',
qtd_lotes_site            ='$qtd_lotes_site',
lote_padrao_site          ='$lote_padrao_site',
area_verde_site           ='$area_verde_site',
video_site                ='$parte_certa',
exibir_site               ='$exibir_site',
categoria                 ='$categoria'

WHERE idempreendimento_cadastro = $idempreendimento_cadastro
");

$executa_atualizar = mysqli_query($db, $atualiza);



?>
<script type="text/javascript">
    window.location="empreendimento_lista_site.php";
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
    
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.min.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
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
		<?php include "topo.php"; 

           $idempreendimento = $_GET["idempreendimento"];


        ?>

<?php

function busca_percentual($empreendimento_id, $proprietario_id){



    include "conexao.php";

   $query_amigo = "SELECT percentual FROM proprietarios                         
                   where empreendimento_id = '$empreendimento_id' AND proprietario_id = '$proprietario_id'";

                   $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar proprietario");
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $percentual            = $buscar_amigo["percentual"];
                  
                  }
            


return $percentual;
}


?>

		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">

			<!-- begin breadcrumb -->
	<?php
     

            include "conexao.php";
            $query_slide = mysqli_query($db,"SELECT * FROM empreendimento_cadastro
                    WHERE idempreendimento_cadastro = $idempreendimento") or die ("Erro ao listar Empreendimento, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idempreendimento_cadastro     = $buscar_slide["idempreendimento_cadastro"];
             $descricao_empreendimento      = $buscar_slide["descricao_empreendimento"];
             $cliente_id                    = $buscar_slide["cliente_id"];
             $tipo_empreendimento           = $buscar_slide["tipo_empreendimento"];


            $representada_por        = $buscar_slide['representada_por']; 
            $descricao_site          = $buscar_slide['descricao_site']; 
            $cidade_site             = $buscar_slide['cidade_site']; 
            $estado_site             = $buscar_slide['estado_site']; 
            $qtd_lotes_site          = $buscar_slide['qtd_lotes_site']; 
            $lote_padrao_site        = $buscar_slide['lote_padrao_site']; 
            $area_verde_site         = $buscar_slide['area_verde_site']; 
            $video_site              = $buscar_slide['video_site']; 
            $exibir_site             = $buscar_slide['exibir_site']; 
            $matricula_empreendimento             = $buscar_slide['matricula_empreendimento']; 
            $proposta_compra        = $buscar_slide['proposta_compra']; 
            $contrato_venda         = $buscar_slide['contrato_venda']; 
            $aditamento_contrato    = $buscar_slide['aditamento_contrato']; 
            $cessao                 = $buscar_slide['cessao']; 
            $distrato                = $buscar_slide['distrato']; 
            $cessao_quitado          = $buscar_slide['cessao_quitado']; 


            $projetos           = $buscar_slide['projetos'];
$demolicoes         = $buscar_slide['demolicoes'];
$terraplanagem      = $buscar_slide['terraplanagem'];
$alvenarias         = $buscar_slide['alvenarias'];
$impermeabilizacao  = $buscar_slide['impermeabilizacao'];
$pisos              = $buscar_slide['pisos'];
$canteiros          = $buscar_slide['canteiros'];
$contencao          = $buscar_slide['contencao'];
$superestrutura     = $buscar_slide['superestrutura'];
$eletrica           = $buscar_slide['eletrica'];
$revestimentos      = $buscar_slide['revestimentos'];
$hidraulicas        = $buscar_slide['hidraulicas'];


$categoria        = $buscar_slide['categoria'];


            $busca_percentual = busca_percentual($idempreendimento, $cliente_id);
           
          }

             
     ?>		
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Alterar <small>Empreendimento (Site)</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-wysiwyg-2">
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
                            <form class="form-horizontal" action="editar_empreendimento_lista_site.php?idempreendimento=<?php echo $idempreendimento ?>" method="POST" name="wysihtml5" enctype="multipart/form-data">
                               
                                 
                                       
                          


                                     <div class="form-group">
                                    <label class="col-md-3 control-label">Categoria</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="categoria" required="">
                                            <option value="">Escolha</option>
                                            <option value="pre-lancamento" <?php if($categoria == 'pre-lancamento'){ ?> selected <?php } ?>>Pré-Lançamento</option>
                                            <option value="lancamento" <?php if($categoria == 'lancamento'){ ?> selected <?php } ?>>Lançamento</option>
                                            <option value="em-obras" <?php if($categoria == 'em-obras'){ ?> selected <?php } ?>>Em Obras</option>
                                            <option value="prontos-para-morar" <?php if($categoria == 'prontos-para-morar'){ ?> selected <?php } ?>>Prontos para morar</option>
                                           

                                        </select>
                                    </div>
                                </div> 


                             

                               <div class="form-group">
                                    <label class="col-md-3 control-label">Descrição (Site)</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="descricao_site" required=""><?php echo $descricao_site ?></textarea>
                                        
                                    </div>
                                </div>
                        
                               <div class="form-group">
                                    <label class="col-md-3 control-label">Cidade</label>
                                    <div class="col-md-9">
                                        <input type="text" name="cidade_site" value="<?php echo $cidade_site ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Estado</label>
                                    <div class="col-md-9">
                                        <input type="text" name="estado_site" value="<?php echo $estado_site ?>" class="form-control">
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Quantidade Lotes</label>
                                    <div class="col-md-9">
                                        <input type="text" name="qtd_lotes_site" value="<?php echo $qtd_lotes_site ?>" class="form-control">
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">M² Lote Padrão</label>
                                    <div class="col-md-9">
                                        <input type="text" name="lote_padrao_site" value="<?php echo $lote_padrao_site ?>" class="form-control">
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">M² Area Verde</label>
                                    <div class="col-md-9">
                                        <input type="text" name="area_verde_site" value="<?php echo $area_verde_site ?>" class="form-control">
                                    </div>
                                </div>

                                   <div class="form-group">
                                    <label class="col-md-3 control-label">Vídeo (link YouTube)</label>
                                    <div class="col-md-9">

                                      <?php 

                                      $value_tube = 'https://www.youtube.com/watch?v='.$video_site;

                                      ?>

                                        <input type="text" name="video_site" value="<?php echo $value_tube ?>" class="form-control">
                                    </div>
                                </div>
                              
                                         <div class="form-group">
                                    <label class="col-md-3 control-label">Exibir no Site?</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="checkbox" name="exibir_site" value="1"
                                            <?php
                                                if($exibir_site == 1){
                                             ?>
                                             checked
                                             <?php
                                                }
                                             ?>
                                            >
                                           Sim
                                        </label>
                                   
                                     
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
                                    <label class="col-md-3 control-label">Projetos</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="projetos">
                                    <option value="0" <?php if($projetos == 0){ ?> selected <?php } ?>>0%</option>
                                     <option value="10" <?php if($projetos == 10){ ?> selected <?php } ?>>10%</option>
                                     <option value="20" <?php if($projetos == 20){ ?> selected <?php } ?>>20%</option>
                                     <option value="30" <?php if($projetos == 30){ ?> selected <?php } ?>>30%</option>
                                     <option value="40" <?php if($projetos == 40){ ?> selected <?php } ?>>40%</option>
                                     <option value="50" <?php if($projetos == 50){ ?> selected <?php } ?>>50%</option>
                                     <option value="60" <?php if($projetos == 60){ ?> selected <?php } ?>>60%</option>
                                     <option value="70" <?php if($projetos == 70){ ?> selected <?php } ?>>70%</option>
                                     <option value="80" <?php if($projetos == 80){ ?> selected <?php } ?>>80%</option>
                                     <option value="90" <?php if($projetos == 90){ ?> selected <?php } ?>>90%</option>
                                     <option value="100" <?php if($projetos == 100){ ?> selected <?php } ?>>100%</option>

                                        </select>
                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Demolições e Remoções</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="demolicoes">
                                     <option value="0" <?php if($demolicoes == 0){ ?> selected <?php } ?>>0%</option>
                                     <option value="10" <?php if($demolicoes == 10){ ?> selected <?php } ?>>10%</option>
                                     <option value="20" <?php if($demolicoes == 20){ ?> selected <?php } ?>>20%</option>
                                     <option value="30" <?php if($demolicoes == 30){ ?> selected <?php } ?>>30%</option>
                                     <option value="40" <?php if($demolicoes == 40){ ?> selected <?php } ?>>40%</option>
                                     <option value="50" <?php if($demolicoes == 50){ ?> selected <?php } ?>>50%</option>
                                     <option value="60" <?php if($demolicoes == 60){ ?> selected <?php } ?>>60%</option>
                                     <option value="70" <?php if($demolicoes == 70){ ?> selected <?php } ?>>70%</option>
                                     <option value="80" <?php if($demolicoes == 80){ ?> selected <?php } ?>>80%</option>
                                     <option value="90" <?php if($demolicoes == 90){ ?> selected <?php } ?>>90%</option>
                                     <option value="100" <?php if($demolicoes == 100){ ?> selected <?php } ?>>100%</option>      

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Terraplanagem</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="terraplanagem">
                                    <option value="0" <?php if($terraplanagem == 0){ ?> selected <?php } ?>>0%</option>
                                    <option value="10" <?php if($terraplanagem == 10){ ?> selected <?php } ?>>10%</option>
                                    <option value="20" <?php if($terraplanagem == 20){ ?> selected <?php } ?>>20%</option>
                                    <option value="30" <?php if($terraplanagem == 30){ ?> selected <?php } ?>>30%</option>
                                    <option value="40" <?php if($terraplanagem == 40){ ?> selected <?php } ?>>40%</option>
                                    <option value="50" <?php if($terraplanagem == 50){ ?> selected <?php } ?>>50%</option>
                                    <option value="60" <?php if($terraplanagem == 60){ ?> selected <?php } ?>>60%</option>
                                    <option value="70" <?php if($terraplanagem == 70){ ?> selected <?php } ?>>70%</option>
                                    <option value="80" <?php if($terraplanagem == 80){ ?> selected <?php } ?>>80%</option>
                                    <option value="90" <?php if($terraplanagem == 90){ ?> selected <?php } ?>>90%</option>
                                    <option value="100" <?php if($terraplanagem == 100){ ?> selected <?php } ?>>100%</option>








                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alvenarias/Fechamentos/Divisórias</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="alvenarias">
                                    <option value="0" <?php if($alvenarias == 0){ ?> selected <?php } ?>>0%</option>
                                    <option value="10" <?php if($alvenarias == 10){ ?> selected <?php } ?>>10%</option>
                                    <option value="20" <?php if($alvenarias == 20){ ?> selected <?php } ?>>20%</option>
                                    <option value="30" <?php if($alvenarias == 30){ ?> selected <?php } ?>>30%</option>
                                    <option value="40" <?php if($alvenarias == 40){ ?> selected <?php } ?>>40%</option>
                                    <option value="50" <?php if($alvenarias == 50){ ?> selected <?php } ?>>50%</option>
                                    <option value="60" <?php if($alvenarias == 60){ ?> selected <?php } ?>>60%</option>
                                    <option value="70" <?php if($alvenarias == 70){ ?> selected <?php } ?>>70%</option>
                                    <option value="80" <?php if($alvenarias == 80){ ?> selected <?php } ?>>80%</option>
                                    <option value="90" <?php if($alvenarias == 90){ ?> selected <?php } ?>>90%</option>
                                    <option value="100" <?php if($alvenarias == 100){ ?> selected <?php } ?>>100%</option>

                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Impermeabilizações</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="impermeabilizacao">
                                    <option value="0" <?php if($impermeabilizacao == 0){ ?> selected <?php } ?>>0%</option>
                                    <option value="10" <?php if($impermeabilizacao == 10){ ?> selected <?php } ?>>10%</option>
                                    <option value="20" <?php if($impermeabilizacao == 20){ ?> selected <?php } ?>>20%</option>
                                    <option value="30" <?php if($impermeabilizacao == 30){ ?> selected <?php } ?>>30%</option>
                                    <option value="40" <?php if($impermeabilizacao == 40){ ?> selected <?php } ?>>40%</option>
                                    <option value="50" <?php if($impermeabilizacao == 50){ ?> selected <?php } ?>>50%</option>
                                    <option value="60" <?php if($impermeabilizacao == 60){ ?> selected <?php } ?>>60%</option>
                                    <option value="70" <?php if($impermeabilizacao == 70){ ?> selected <?php } ?>>70%</option>
                                    <option value="80" <?php if($impermeabilizacao == 80){ ?> selected <?php } ?>>80%</option>
                                    <option value="90" <?php if($impermeabilizacao == 90){ ?> selected <?php } ?>>90%</option>
                                    <option value="100" <?php if($impermeabilizacao == 100){ ?> selected <?php } ?>>100%</option>

                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Pisos</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="pisos">
                                    <option value="0" <?php if($pisos == 0){ ?> selected <?php } ?>>0%</option>
                                    <option value="10" <?php if($pisos == 10){ ?> selected <?php } ?>>10%</option>
                                    <option value="20" <?php if($pisos == 20){ ?> selected <?php } ?>>20%</option>
                                    <option value="30" <?php if($pisos == 30){ ?> selected <?php } ?>>30%</option>
                                    <option value="40" <?php if($pisos == 40){ ?> selected <?php } ?>>40%</option>
                                    <option value="50" <?php if($pisos == 50){ ?> selected <?php } ?>>50%</option>
                                    <option value="60" <?php if($pisos == 60){ ?> selected <?php } ?>>60%</option>
                                    <option value="70" <?php if($pisos == 70){ ?> selected <?php } ?>>70%</option>
                                    <option value="80" <?php if($pisos == 80){ ?> selected <?php } ?>>80%</option>
                                    <option value="90" <?php if($pisos == 90){ ?> selected <?php } ?>>90%</option>
                                    <option value="100" <?php if($pisos == 100){ ?> selected <?php } ?>>100%</option>
                                        </select>
                                    </div>
                                </div> 
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Canteiro/Serviços Preliminares</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="canteiros">
                                    <option value="0" <?php if($canteiros == 0){ ?> selected <?php } ?>>0%</option>
                                    <option value="10" <?php if($canteiros == 10){ ?> selected <?php } ?>>10%</option>
                                    <option value="20" <?php if($canteiros == 20){ ?> selected <?php } ?>>20%</option>
                                    <option value="30" <?php if($canteiros == 30){ ?> selected <?php } ?>>30%</option>
                                    <option value="40" <?php if($canteiros == 40){ ?> selected <?php } ?>>40%</option>
                                    <option value="50" <?php if($canteiros == 50){ ?> selected <?php } ?>>50%</option>
                                    <option value="60" <?php if($canteiros == 60){ ?> selected <?php } ?>>60%</option>
                                    <option value="70" <?php if($canteiros == 70){ ?> selected <?php } ?>>70%</option>
                                    <option value="80" <?php if($canteiros == 80){ ?> selected <?php } ?>>80%</option>
                                    <option value="90" <?php if($canteiros == 90){ ?> selected <?php } ?>>90%</option>
                                    <option value="100" <?php if($canteiros == 100){ ?> selected <?php } ?>>100%</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Contenção/Fundação/Infra-Estrutura</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="contencao">
                                    <option value="0" <?php if($contencao == 0){ ?> selected <?php } ?>>0%</option>
                                    <option value="10" <?php if($contencao == 10){ ?> selected <?php } ?>>10%</option>
                                    <option value="20" <?php if($contencao == 20){ ?> selected <?php } ?>>20%</option>
                                    <option value="30" <?php if($contencao == 30){ ?> selected <?php } ?>>30%</option>
                                    <option value="40" <?php if($contencao == 40){ ?> selected <?php } ?>>40%</option>
                                    <option value="50" <?php if($contencao == 50){ ?> selected <?php } ?>>50%</option>
                                    <option value="60" <?php if($contencao == 60){ ?> selected <?php } ?>>60%</option>
                                    <option value="70" <?php if($contencao == 70){ ?> selected <?php } ?>>70%</option>
                                    <option value="80" <?php if($contencao == 80){ ?> selected <?php } ?>>80%</option>
                                    <option value="90" <?php if($contencao == 90){ ?> selected <?php } ?>>90%</option>
                                    <option value="100" <?php if($contencao == 100){ ?> selected <?php } ?>>100%</option>

                                        </select>
                                    </div>
                                </div> 
                                

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Superestrutura</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="superestrutura">
                                    <option value="0" <?php if($superestrutura == 0){ ?> selected <?php } ?>>0%</option>
                                    <option value="10" <?php if($superestrutura == 10){ ?> selected <?php } ?>>10%</option>
                                    <option value="20" <?php if($superestrutura == 20){ ?> selected <?php } ?>>20%</option>
                                    <option value="30" <?php if($superestrutura == 30){ ?> selected <?php } ?>>30%</option>
                                    <option value="40" <?php if($superestrutura == 40){ ?> selected <?php } ?>>40%</option>
                                    <option value="50" <?php if($superestrutura == 50){ ?> selected <?php } ?>>50%</option>
                                    <option value="60" <?php if($superestrutura == 60){ ?> selected <?php } ?>>60%</option>
                                    <option value="70" <?php if($superestrutura == 70){ ?> selected <?php } ?>>70%</option>
                                    <option value="80" <?php if($superestrutura == 80){ ?> selected <?php } ?>>80%</option>
                                    <option value="90" <?php if($superestrutura == 90){ ?> selected <?php } ?>>90%</option>
                                    <option value="100" <?php if($superestrutura == 100){ ?> selected <?php } ?>>100%</option>

                                        </select>
                                    </div>
                                </div> 

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Instalações Elétricas</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="eletrica">
                                    <option value="0" <?php if($eletrica == 0){ ?> selected <?php } ?>>0%</option>
                                    <option value="10" <?php if($eletrica == 10){ ?> selected <?php } ?>>10%</option>
                                    <option value="20" <?php if($eletrica == 20){ ?> selected <?php } ?>>20%</option>
                                    <option value="30" <?php if($eletrica == 30){ ?> selected <?php } ?>>30%</option>
                                    <option value="40" <?php if($eletrica == 40){ ?> selected <?php } ?>>40%</option>
                                    <option value="50" <?php if($eletrica == 50){ ?> selected <?php } ?>>50%</option>
                                    <option value="60" <?php if($eletrica == 60){ ?> selected <?php } ?>>60%</option>
                                    <option value="70" <?php if($eletrica == 70){ ?> selected <?php } ?>>70%</option>
                                    <option value="80" <?php if($eletrica == 80){ ?> selected <?php } ?>>80%</option>
                                    <option value="90" <?php if($eletrica == 90){ ?> selected <?php } ?>>90%</option>
                                    <option value="100" <?php if($eletrica == 100){ ?> selected <?php } ?>>100%</option>

                                        </select>
                                    </div>
                                </div> 

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Revest. paredes internas e arremates</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="revestimentos">
                                    <option value="0" <?php if($revestimentos == 0){ ?> selected <?php } ?>>0%</option>
                                    <option value="10" <?php if($revestimentos == 10){ ?> selected <?php } ?>>10%</option>
                                    <option value="20" <?php if($revestimentos == 20){ ?> selected <?php } ?>>20%</option>
                                    <option value="30" <?php if($revestimentos == 30){ ?> selected <?php } ?>>30%</option>
                                    <option value="40" <?php if($revestimentos == 40){ ?> selected <?php } ?>>40%</option>
                                    <option value="50" <?php if($revestimentos == 50){ ?> selected <?php } ?>>50%</option>
                                    <option value="60" <?php if($revestimentos == 60){ ?> selected <?php } ?>>60%</option>
                                    <option value="70" <?php if($revestimentos == 70){ ?> selected <?php } ?>>70%</option>
                                    <option value="80" <?php if($revestimentos == 80){ ?> selected <?php } ?>>80%</option>
                                    <option value="90" <?php if($revestimentos == 90){ ?> selected <?php } ?>>90%</option>
                                    <option value="100" <?php if($revestimentos == 100){ ?> selected <?php } ?>>100%</option>

                                        </select>
                                    </div>
                                </div> 

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Instalações hidráulicas</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="hidraulicas">
                                    <option value="0" <?php if($hidraulicas == 0){ ?> selected <?php } ?>>0%</option>
                                    <option value="10" <?php if($hidraulicas == 10){ ?> selected <?php } ?>>10%</option>
                                    <option value="20" <?php if($hidraulicas == 20){ ?> selected <?php } ?>>20%</option>
                                    <option value="30" <?php if($hidraulicas == 30){ ?> selected <?php } ?>>30%</option>
                                    <option value="40" <?php if($hidraulicas == 40){ ?> selected <?php } ?>>40%</option>
                                    <option value="50" <?php if($hidraulicas == 50){ ?> selected <?php } ?>>50%</option>
                                    <option value="60" <?php if($hidraulicas == 60){ ?> selected <?php } ?>>60%</option>
                                    <option value="70" <?php if($hidraulicas == 70){ ?> selected <?php } ?>>70%</option>
                                    <option value="80" <?php if($hidraulicas == 80){ ?> selected <?php } ?>>80%</option>
                                    <option value="90" <?php if($hidraulicas == 90){ ?> selected <?php } ?>>90%</option>
                                    <option value="100" <?php if($hidraulicas == 100){ ?> selected <?php } ?>>100%</option>

                                        </select>
                                    </div>
                                </div> 

                              
                                 

                                


                                
                                


                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-sm btn-success">Alterar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                     </form>
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->

          
          
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

$("#participacao").maskMoney({symbol:'', 
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
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/ckeditor/ckeditor.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/form-wysiwyg.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
                        FormWysihtml5.init();

        });
    </script>

</body>


</html>
