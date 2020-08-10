<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<?php 

if(isset($_POST["cliente_id"])){



$descricao                    = $_POST['descricao'];
$cliente_id                   = $_POST['cliente_id']; 
$tipo_empreendimento          = $_POST['tipo_empreendimento']; 
$idempreendimento_cadastro    = $_GET['idempreendimento']; 
$representada_por             = $_POST['representada_por']; 

$participacao                 = $_POST['participacao']; 
$proposta_compra              = $_POST['proposta_compra']; 
$contrato_venda               = $_POST['contrato_venda']; 
$aditamento_contrato          = $_POST['aditamento_contrato']; 
$cessao                       = $_POST['cessao']; 
$distrato                     = $_POST['distrato']; 
$cessao_quitado               = $_POST['cessao_quitado']; 
$matricula_empreendimento     = $_POST['matricula_empreendimento']; 




   


include "conexao.php";
$atualiza = ("UPDATE empreendimento_cadastro set


descricao_empreendimento  ='$descricao',
cliente_id                ='$cliente_id',    
tipo_empreendimento       ='$tipo_empreendimento',
matricula_empreendimento  = '$matricula_empreendimento',
proposta_compra           ='$proposta_compra',
contrato_venda            ='$contrato_venda',
aditamento_contrato       ='$aditamento_contrato',
representada_por          ='$representada_por',
cessao                    ='$cessao',
distrato                  ='$distrato',
cessao_quitado            ='$cessao_quitado',
categoria                 ='$categoria'

WHERE idempreendimento_cadastro = $idempreendimento_cadastro
");

$executa_atualizar = mysqli_query($db, $atualiza);




$atualiza_proprietario = ("UPDATE proprietarios set percentual  ='$participacao'
                           WHERE empreendimento_id = '$idempreendimento_cadastro'
                           AND proprietario_id = '$cliente_id'");

$executa_proprietario = mysqli_query($db, $atualiza_proprietario);






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

                <ol class="breadcrumb pull-right">
  
        <li><a href="proprietario_empreendedor.php?idempreendimento=<?php echo $idempreendimento ?>"><span class="label label-primary">ADICIONAR PROPRIETÁRIOS</span></a></li>

      
        
      </ol>
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
 
            $exibir_site             = $buscar_slide['exibir_site']; 
            $matricula_empreendimento             = $buscar_slide['matricula_empreendimento']; 
            $proposta_compra        = $buscar_slide['proposta_compra']; 
            $contrato_venda         = $buscar_slide['contrato_venda']; 
            $aditamento_contrato    = $buscar_slide['aditamento_contrato']; 
            $cessao                 = $buscar_slide['cessao']; 
            $distrato                = $buscar_slide['distrato']; 
            $cessao_quitado          = $buscar_slide['cessao_quitado']; 



$categoria        = $buscar_slide['categoria'];


            $busca_percentual = busca_percentual($idempreendimento, $cliente_id);
           
          }

             
     ?>		
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Alterar <small>Empreendimento</small></h1>
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
                            <form class="form-horizontal" action="editar_empreendimento_lista.php?idempreendimento=<?php echo $idempreendimento ?>" method="POST" name="wysihtml5" enctype="multipart/form-data">
                               
                                 





     <div class="form-group">
                              
                              
                                    <label class="col-md-3 control-label">Empresa:</label>
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
               <option value="<?php echo "$idcliente" ?>" 

               <?php
                    if($cliente_id == $idcliente) {
                ?>
                selected

                <?php
                    }
                 ?>
               > <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
                    <?php } ?>
                    
                                           
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                              
                              
                                    <label class="col-md-3 control-label">Representada por:</label>
                                    <div class="col-md-9">
                                       <select class="default-select2 form-control" name="representada_por" required="">
                                        <option value="">Escolha</option>
                                          <?php

                      include "conexao.php";
                 
                $query_amigo = "SELECT * FROM cliente
                                INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                where cliente_tipo.idtipo = 1  order by nome_cli Asc";


                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar Locatário");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                $idcliente_rep             = $buscar_amigo['idcliente'];
                $nome_cli_rep              = $buscar_amigo["nome_cli"];
                $cpf_cli_rep               = $buscar_amigo["cpf_cli"];
        
             
            
             ?>
               <option value="<?php echo "$idcliente_rep" ?>" 

               <?php
                    if($representada_por == $idcliente_rep) {
                ?>
                selected

                <?php
                    }
                 ?>
               > <?php echo "$nome_cli_rep "."CPF: "."$cpf_cli_rep" ?> </option>
                    <?php } ?>
                    
                                           
                                        </select>
                                    </div>
                                </div>


                                   <div class="form-group">
                                    <label class="col-md-3 control-label">% Participação</label>
                                    <div class="col-md-9">
                                        <input type="text" name="participacao" id="participacao" value="<?php echo $busca_percentual ?>" class="form-control">
                                    </div>
                                </div>

                                           <div class="form-group">
                                    <label class="col-md-3 control-label">Tipo de Empreendimento</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="tipo_empreendimento" value="0"
                                            <?php
                                                if($tipo_empreendimento == 0){
                                             ?>
                                             checked
                                             <?php
                                                }
                                             ?>
                                            >
                                           Próprio
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="tipo_empreendimento" value="1"
                                            <?php
                                                if($tipo_empreendimento == 1){
                                             ?>
                                             checked
                                             <?php
                                                }
                                             ?>
                                            >
                                           Administração
                                        </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="tipo_empreendimento" value="2"
                                            <?php
                                                if($tipo_empreendimento == 2){
                                             ?>
                                             checked
                                             <?php
                                                }
                                             ?>
                                            >
                                           Terceiro
                                        </label>
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nº Matricula Empreendimento</label>
                                    <div class="col-md-9">
                                        <input type="text" name="matricula_empreendimento" value="<?php echo $matricula_empreendimento ?>" class="form-control">
                                    </div>
                                </div>


                                   


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Titulo</label>
                                    <div class="col-md-9">
                                        <input type="text" name="descricao" value="<?php echo $descricao_empreendimento ?>" class="form-control">
                                    </div>
                                </div>
                                                        
                                                    
                                    
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Proposta de Compra</label>
                                    <div class="col-md-9">
                                        <textarea class="textarea form-control wysihtml5" name="proposta_compra" id=""  rows="12"><?php echo $proposta_compra ?></textarea>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Contrato de Compra e Venda</label>
                                    <div class="col-md-9">
                                        <textarea class="textarea form-control wysihtml5" name="contrato_venda" id=""  rows="12"><?php echo $contrato_venda ?></textarea>
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Aditamento e Renegociação</label>
                                    <div class="col-md-9">
                                        <textarea class="textarea form-control wysihtml5" name="aditamento_contrato" id=""  rows="12"><?php echo $aditamento_contrato ?></textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Cessão e transferência de direitos</label>
                                    <div class="col-md-9">
                                        <textarea class="textarea form-control wysihtml5" name="cessao" id=""  rows="12"><?php echo $cessao ?></textarea>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Cessão e transferência de direitos<br> LOTE QUITADO</label>
                                    <div class="col-md-9">
                                        <textarea class="textarea form-control wysihtml5" name="cessao_quitado" id=""  rows="12"><?php echo $cessao_quitado ?></textarea>
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Distrato </label>
                                    <div class="col-md-9">
                                        <textarea class="textarea form-control wysihtml5" name="distrato" id=""  rows="12"><?php echo $distrato ?></textarea>
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
                        
                        </div>
                        <div class="panel-body">

                      
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
