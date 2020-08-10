<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>



<?php
$ds          = DIRECTORY_SEPARATOR;  //1
 
   //2
 
if (!empty($_FILES)) {

    $idempreendimento = $_POST["idempreendimento"];
    $storeFolder = "img/".$idempreendimento."/";

    if(!file_exists($storeFolder)){
	mkdir($storeFolder);
	}

    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5

    $img_wes = $_FILES['file']['name'];
 
    move_uploaded_file($tempFile,$targetFile); //6
    include "conexao.php";
	$inserir = mysqli_query ($db,"INSERT INTO fotos_empreendimento (empreendimento_idempreendimento, url_img) values ('$idempreendimento','$img_wes')") or die ("ERRO NO SISTEMA TENTE MAIS TARDE!.");
   $insert = mysqli_query($db, $inserir);
     
}
?>  


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Aug 2016 20:37:38 GMT -->
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

	<link href="posicionar/style.css" rel="stylesheet" type="text/css" />

		    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css">

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
<?php
    
    function imagem_imovel($idempreendimento)
    {
               include "conexao.php";
               $query = mysqli_query($db,"SELECT img_lote FROM empreendimento_cadastro                                     
                                          where idempreendimento_cadastro = $idempreendimento") or die ("Erro ao listar img_lote, tente mais tarde"); 


            while ($buscar = mysqli_fetch_assoc($query)) {//--While categoria

            $img_lote               = $buscar['img_lote'];

            }

            return $img_lote;
    }
    
 ?>
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
			<h1 class="page-header">Adicionar Fotos </h1>
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

                        <?php    $idempreendimento = $_GET["idempreendimento"];

                           $imagem_lote = imagem_imovel($idempreendimento);?>
                      <div class="panel-body">
                             <form class="dropzone"
                                  id="addImages"
                                  action="fotos_empreendimentos.php"
                                  method="POST"
                                  enctype="multipart/form-data">
                               
                               
                              <div class="fallback"> 
     <input name="fileToUpload" type="file" multiple /> 
  </div> 
                               
                                 <input type="hidden" id="idempreendimento" name="idempreendimento" value="<?php echo $idempreendimento ?>">


                              
                            </form>

                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->


                                  <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="ui-general-3">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Imagens Cadastradas</h4>
                        </div>
                        <div class="panel-body">
                          <div style="margin-top:50px;">
    <a href="javascript:void(0);" class="btn outlined mleft_no reorder_link" id="save_reorder">ALTERAR ORDEM</a>
    <div id="reorder-helper" class="light_box" style="display:none;">1. Clique e arraste a foto.<br>2. Clique em Salvar.</div>
    <div class="gallery">
        <ul class="reorder_ul reorder-photos-list">
        <?php 
            include 'posicionar_empreendimento/db.php';
                        $db = new DB();
            //Fetch all images from database
            $images = $db->getRows();
            if(!empty($images)){
                foreach($images as $row){
        ?>
            <li id="image_li_<?php echo $row['idfotos_empreendimento']; ?>" class="ui-sortable-handle">
                <a href="javascript:void(0);" style="float:none;" class="image_link">
                    <img src="img/<?php echo $idempreendimento ?>/<?php echo $row['url_img']; ?>" alt="">
                </a><br>
                <center>
                    <a href="excluir_foto_empreendimento.php?idfotos=<?php echo $row['idfotos_empreendimento']; ?>&idempreendimento=<?php echo $idempreendimento ?>&img=<?php echo $row['url_img']; ?>"><span class="label label-danger">Remover</span>
                    </a>

                     <input type="radio" id="<?php echo $idempreendimento ?>" name="principal" value="<?php echo $row['url_img']; ?>" onclick="grava_dados('<?php echo $row['url_img']; ?>')"  
                    <?php if($row['url_img'] == $imagem_lote ){ ?> checked <?php } ?>
                    >Principal

                <center>
            </li>
        <?php } } ?>
        </ul>
    </div>
</div>
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
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

		<script src="https://immobilebusiness.com.br/admin/assets/dropzone.js"></script> 

	<!-- ================== END PAGE LEVEL JS ================== -->
	<script type="text/javascript">
$(document).ready(function(){
    $('.reorder_link').on('click',function(){
        $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
        $('.reorder_link').html('SALVAR');
        $('.reorder_link').attr("id","save_reorder");
        $('#reorder-helper').slideDown('slow');
        $('.image_link').attr("href","javascript:void(0);");
        $('.image_link').css("cursor","move");
        $("#save_reorder").click(function( e ){
            if( !$("#save_reorder i").length ){
                $(this).html('').prepend('<img src="posicionar/images/refresh-animated.gif"/>');
                $("ul.reorder-photos-list").sortable('destroy');
                $("#reorder-helper").html( "Alterando Ordem, Por Favor Aguarde essa solicitação terminar." ).removeClass('light_box').addClass('notice notice_error');
    
                var h = [];
                $("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                
                $.ajax({
                    type: "POST",
                    url: "posicionar_empreendimento/orderUpdate.php",
                    data: {ids: " " + h + ""},
                    success: function(){
                        window.location.reload();
                    }
                }); 
                return false;
            }   
            e.preventDefault();     
        });
    });
});
</script>
<script type="text/javascript">
function grava_dados(principal) {

var idempreendimento  = $("#idempreendimento").val();


  $.ajax({
    url: 'definir_principal_empreendimento.php',
    type: 'POST',
    data: 'idfoto=' + principal + '&idempreendimento=' + idempreendimento,
   
    success: function(data) {
     
    }
  });

  return false;
};
</script>
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>

</body>


</html>
