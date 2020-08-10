<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>



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
	<link href="posicionar/style.css" rel="stylesheet" type="text/css" />

	    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css">
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
		<!-- begin #header -->
		<?php include "topo.php"; ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
    <h1 class="page-header">Destaque Empreendimentos</h1>
<h2 class="page-header">Tamanho Recomendado: 1350 x 460 px</h2>			<!-- end page-header -->
			
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
                                  <form class="form-horizontal" action="adicionar_slide_recebe.php" method="POST" enctype="multipart/form-data">
                               <div class="form-group">
                                    <label class="col-md-3 control-label">Empreendimento (Link Ao Clicar)</label>
                                    <div class="col-md-9">
                                        <select name="empreendimento" class="default-select2 form-control" required="">
                                             <option value="">Escolha</option>
                                          <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM empreendimento_cadastro
                    order by idempreendimento_cadastro desc");


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idempreendimento_cadastro      = $buscar_slide["idempreendimento_cadastro"];
             $descricao_empreendimento             = $buscar_slide["descricao_empreendimento"];
        
          

                    ?> 
                                
                                            <option value="<?php echo $idempreendimento_cadastro ?>"><?php echo $descricao_empreendimento ?></option>
                                            <?php } ?>
                                        </select>
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Imagem Destaque:</label>
                                    <div class="col-md-9">
                                        <input type="file" name="img[]" multiple>
                                       
                                    </div>
                                </div>
                               

                               



                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-sm btn-success">Adicionar Imagens</button>
                                    </div>
                                </div>
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
            include 'posicionar_slide/db.php';
                        $db = new DB();
            //Fetch all images from database
            $images = $db->getRows();
            if(!empty($images)){
                foreach($images as $row){
        ?>
            <li id="image_li_<?php echo $row['idslide_empreendimentos']; ?>" class="ui-sortable-handle">
                <a href="javascript:void(0);" style="float:none;" class="image_link">
                    <img src="../img/slide/<?php echo $row['img_slide']; ?>" alt="">
                </a><br>

                <center>
                 <a href="excluir_slide.php?idslide_empreendimentos=<?php echo $row['idslide_empreendimentos']; ?>&img_slide=<?php echo $row['img_slide']; ?>">
                        <span class="label label-danger">Remover</span>
                    </a>

                   
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
                $(this).html('').prepend('<img src="posicionar_slide/images/refresh-animated.gif"/>');
                $("ul.reorder-photos-list").sortable('destroy');
                $("#reorder-helper").html( "Alterando Ordem, Por Favor Aguarde essa solicitação terminar." ).removeClass('light_box').addClass('notice notice_error');
    
                var h = [];
                $("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                
                $.ajax({
                    type: "POST",
                    url: "posicionar_slide/orderUpdate.php",
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




	<script>

		$(document).ready(function() {
			App.init();
		});
	</script>

</body>


</html>
