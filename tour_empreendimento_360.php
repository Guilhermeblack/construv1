<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<?php 
if(isset($_POST["idempreendimento"])){

    $idempreendimento = $_POST["idempreendimento"];
    $titulo = $_POST["titulo"];

$pasta  = "tour_empreendimento/fotos/".$idempreendimento."/";
$pasta2 = "tour_empreendimento/small/".$idempreendimento."/";

if(!file_exists($pasta)){
mkdir($pasta);
}

if(!file_exists($pasta2)){
mkdir($pasta2);
}

 foreach($_FILES["img"]["error"] as $key => $error){
 
 if($error == UPLOAD_ERR_OK){
 $tmp_name = $_FILES["img"]["tmp_name"][$key];
 $cod     = $_FILES["img"]["name"][$key];
 ////////////////////////////////////////

 //////////////////////////////////////////



 
 $nome    = $_FILES["img"]["name"][$key];
 $uploadfile = $pasta . basename($cod);
 
if(move_uploaded_file($tmp_name, $uploadfile)){
include "conexao.php";

    
$inserir = mysqli_query ($db, "INSERT INTO tour_empreendimento (empreendimento_id, img_tour, titulo_tour) values ('$idempreendimento','$cod','$titulo')") or die ("Erro ao cadastrar imagem tour 360!.");

$uploadfile2 = $pasta2 . basename($cod);
$teste = move_uploaded_file($tmp_name, $uploadfile2);
 
}}}


}   

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
			<h1 class="page-header">Cadastro <small>Imóvel</small></h1>
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

                        <?php 

                    

                           $idempreendimento = $_GET["idempreendimento"]; ?>
                        <div class="panel-body">
                                   <form class="form-horizontal" action="tour_empreendimento_360.php?idempreendimento=<?php echo $idempreendimento ?>" method="POST" enctype="multipart/form-data">
                                 
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Titulo:</label>
                                    <div class="col-md-9">
                                        <input type="text" name="titulo" class="form-control">
                                        <input type="hidden" name="idempreendimento" value="<?php echo $idempreendimento ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Selecione a Imagem:</label>
                                    <div class="col-md-9">
                                        <input type="file" name="img[]" multiple="">
                                        
                                    </div>
                                </div>
                               

                               



                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-sm btn-success">Gravar</button>
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
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">QR CODE</h4>
                        </div>
                      
                        <div class="panel-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                   <th>QR CODE</th>
                                    <th>Obs:</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>




                                    <tr class="odd gradeX">
                                       <td> 

                                        <?php

$idempreendimento = $_GET["idempreendimento"];

include('qrcode/phpqrcode/qrlib.php');
QRcode::png("http://sevenplan.com.br/detalhes_empreendimento.php?idempreendimento=".$idempreendimento, "qrcode/QR_code.png");
?>
<img src="qrcode/QR_code.png">


                                                 </td>

                                                 <td><h4>Para Salvar:</h4><p>1. Clique com o botão direito do mouse sobre o código</p><p>2. Escolha a opção "Salvar Imagem Como"</p>
                                                 </td>
                                     
                                
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->































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
            include 'arquivos_tour_empreendimento/db.php';
                        $db = new DB();
            //Fetch all images from database
            $images = $db->getRows();
            if(!empty($images)){
                foreach($images as $row){
        ?>
            <li id="image_li_<?php echo $row['idtour_empreendimento']; ?>" class="ui-sortable-handle"><a href="javascript:void(0);" style="float:none;" class="image_link"><img src="tour_empreendimento/fotos/<?php echo $idempreendimento ?>/<?php echo $row['img_tour']; ?>" alt=""></a><br><center>


            <a href="excluir_foto_tour_empreendimento.php?idtour_empreendimento=<?php echo $row['idtour_empreendimento']; ?>&idempreendimento=<?php echo $idempreendimento ?>&img=<?php echo $row['img_tour']; ?>"><span class="label label-danger">Remover</span></a><center></li>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script> 

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
      

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
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
                    url: "arquivos_tour_empreendimento/orderUpdate.php",
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
                TableManageButtons.init();
		});
	</script>

</body>


</html>
