<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>

<?php
    //include "cad_planilha_lote.php";
    include "cadastro_planilha_lote.php";

    $aux = 0;

    class Upload
    {
        var $tipo;
        var $nome;
        var $tamanho;
         
        function Upload(){
        //Criando objeto
        }
         
        function UploadArquivo($arquivo, $pasta){ 
            if(isset($arquivo)){
                $nomeOriginal = $arquivo["name"]; 
                $tamanho = $arquivo["size"];
                 
                if (move_uploaded_file($arquivo["tmp_name"], $pasta . $nomeOriginal)){ 

                    $this->nome=$pasta . $nomeOriginal;
                    $this->tamanho=number_format($arquivo["size"]/1024, 2) . "KB";
                    return true; 
                }else{ 
                    return false;
                } 
            }
        } 
    }


    if(isset($_FILES["userfile"])){

        $upArquivo = new Upload;
        if($upArquivo->UploadArquivo($_FILES["userfile"], "planilhas/"))
        {   
            $nome = $upArquivo->nome;
            $tamanho = $upArquivo->tamanho;
            $caminho = "planilhas/".$nome;
            $resultado = grava_planilha_lote($nome, $_GET['idempreendimento']); // recebo os dados da gravação
            $aux = 1;
        }else{
            $aux = 5;
        }
        unlink($nome);
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
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/isotope/isotope.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/lightbox/css/lightbox.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<?php
			$idempreendimento = $_GET["idempreendimento"];
		?>	

		
		<!-- begin #content -->
		<div id="content" class="content">

			<!-- begin breadcrumb -->
			<?php include "topo.php" ?>

			<?php 
			    if((!isset($resultado["error"])) && isset($resultado["ok"])){
			        if(empty($resultado["ok"])){
			            ?>
			            <div class="alert alert-warning" role="alert">
			           		<p class="font-weight-bold">Falha ao gravar o arquivo, Por favor verifique e tente novamente !</p></br>
			            </div>
			            <?php
			        }
			    }

			    if(isset($resultado) && (count($resultado["ok"]) !== 0)){       ?>
			    	<div class="alert alert-success" role="alert">
			    	 	<strong><font>Sucesso!</font></strong>
			          	<font><?php  echo "Foram gravadas ".count($resultado["ok"])." Linhas !";  ?></font>
			    	</div>
			    <?php
			    }   
			?>

			<?php   
			    if(isset($resultado["error"])){
			      ?>
			      	<div class="alert alert-danger" role="alert">
				      	 <font><?php echo "Falha ao gravar algumas linhas, por gentileza verifique e tente novamente!"; ?></font>
				      	 <a href="planilhas/falhas_lotes.xlsx"><span class="label label-danger" style="font-size:100% !important">BAIXAR PLANILHA DE DADOS NÃO CADASTRADOS!</span></a>
			      	</div>
			<?php 
			    }
			?>

			<?php if (in_array('85', $idrota)) { ?>                                           
				<ol class="breadcrumb pull-right">
					<li><a href="planilhas_mod/cad_lote.xlsx"><span class="label label-primary" style="font-size:100% !important">BAIXAR PLANILHA QUADRA/LOTE</span></a></li>
					<li><a href="#modal-message" data-toggle="modal"><span class="label label-primary" style="font-size:100% !important">SUBIR PLANILHA QUADRA/LOTE</span></a></li>
				</ol>
		    <?php } 
			     if (in_array('31', $idrota)) { ?>
			     <ol class="breadcrumb pull-right">
					<li><a href="cadastro_quadra.php?idempreendimento=<?php echo $idempreendimento ?>"><span class="label label-primary" style="font-size:100% !important">CADASTRAR QUADRA / LOTE</span></a></li>
				</ol>
			<?php } ?>

			

			<!-- end breadcrumb -->
			<!-- begin page-header -->
			
			<!-- end page-header -->
			Legenda: 
			<span class="label label-danger">Vendido</span>
			<span class="label label-warning">Reservado</span>
			<span class="label label-success">Disponivel</span>
			<span class="label label-inverse">Bloqueado</span>
			<br><br>

			<h1 class="page-header">Selecione a Quadra </h1>
			<div id="options" class="m-b-10">
				<span class="gallery-option-set" id="filter" data-option-key="filter">
					<a href="#show-all" class="btn btn-default btn-xs active" data-option-value="*">
						Todos
					</a>
					<?php

					include "conexao.php";
					$query_amigo = "SELECT * FROM produto
					where empreendimento_idempreendimento = $idempreendimento  order by quadra Asc";

					$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");


		            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

		            	$quadra       = $buscar_amigo['quadra'];


            	?>
            	<a href="#<?php echo $quadra ?>" class="btn btn-default btn-xs" data-option-value=".<?php echo $quadra ?>">
            		<?php echo $quadra ?>
            	</a>
            <?php }?>

        </span>
    </div>
    <div id="gallery" class="gallery">

    	<?php

    	include "conexao.php";
    	$query_amigo = "SELECT * FROM produto 
    	INNER JOIN lote ON produto.idproduto = lote.produto_idproduto
    	where empreendimento_idempreendimento = $idempreendimento
    	order by idproduto, lote Asc";

    	$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");


            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

            	$quadra       = $buscar_amigo['quadra'];
            	$lote         = $buscar_amigo["lote"];
            	$status       = $buscar_amigo["status"];
            	$m2       = $buscar_amigo["m2"];
            	$valor       = $buscar_amigo["valor"];


            	if($status == 0){

            		$style = 'background-color:#f59c1a !important; color:#FFFFFF !important';
            	}else if($status == 1){
            		$style = 'background-color:#00acac !important; color:#FFFFFF !important';

            	}else if($status == 2){
            		$style = 'background-color:#ff5b57 !important; color:#FFFFFF !important';

            	}else if($status == 3){
            		$style = 'background-color:#2d353c !important; color:#FFFFFF !important';

            	}

            	?>


            	<div class="image <?php echo " $quadra" ?>">
            		<div class="image-inner">

            			<p class="image-caption">
            				Quadra: <?php echo " $quadra" ?>
            			</p>
            		</div>
            		<div class="image-info" style="<?php echo $style; ?>">
            			<h5 class="title"> <br></h5>
            			<div class="pull-right">
            				<big> Lote: <?php echo " $lote" ?></big>
            			</div>
            			<div class="rating">
            				<br>
            			</div>
            			<div class="desc">
            				M²:  <?php echo " $m2" ?> <br>
            				Valor: <?php echo 'R$ ' . number_format($valor, 2, ',', '.');  ?> <br>
            			</div>
            		</div>
            	</div>
            <?php } ?>
        </div>
    </div>


    <?php   
        if(isset($resultado["error"])){
          ?>
                <strong><font>Falha!</font></strong>

                <font>
                    <?php echo "Falha ao gravar algumas linhas, por gentileza verifique e tente novamente!"; ?>
                </font>

                <span class="close" data-dismiss="alert" ><font>X</font></span>
                <a href="planilhas/falhas.xlsx"><span class="label label-danger" style="font-size:100% !important">BAIXAR PLANILHA DE DADOS NÃO CADASTRADOS!</span></a>
    <?php 
        }
    ?>

    <div class="modal modal-message fade" id="modal-message" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Subir Planilha de Lotes</h4>
                </div>
                <form class="form-action" action="relatorio_lotes.php?idempreendimento=<?php echo $_GET['idempreendimento'] ?>" method="POST" enctype="multipart/form-data" name="envia_xlsx">
                    <div class="modal-body">
                          <div class="form-group">
                            <label for="exampleFormControlFile1"> Selecione seu arqiuvo .xlsx</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="30000000" required="required">
                            <input name="userfile" type="file" class="form-control-file" id="exampleFormControlFile1" required="required">
                          </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/isotope/jquery.isotope.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/lightbox/js/lightbox-2.6.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/gallery.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			Gallery.init();
		});
	</script>

</body>

</html>
