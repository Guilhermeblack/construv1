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

    <meta http-equiv="content-type" content="text/html;charset=utf-8" /> <!-- TESTE DE ACENTOS -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <style>
      /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
        height: 320px;
        width: 100%;
    }
      /* Optional: Makes the sample page fill the window. 
       {
        height: 100%;
        margin: 0;
        padding: 0;
        }*/
    </style>
</head>
<body>

<script>
 $("#hora").mask("00:00");
 



    function voltar(){

        document.nome.action = "crm_tratalead.php";
        document.nome.submit();

    }

        




</script>
   <!-- begin #page-loader -->
   <div id="page-loader" class="fade in"><span class="spinner"></span></div>
   <!-- end #page-loader -->

   <!-- begin #page-container -->
   <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
      <!-- begin #header -->
      <?php include "topo.php";?>

      <div class="sidebar-bg"></div>
      <!-- end #sidebar -->

      <!-- begin #content -->
      <div id="content" class="content">
        <!-- PRIMEIRA JANELA DA TELA -->

        <ol class="breadcrumb pull-right">
                <?php if (in_array('61', $idrota)) { ?>
                <li><a href="crm_tratalead.php"><span class="label label-primary" style="font-size:100% !important">Voltar</span></a></li>
                <?php } ?>
            </ol>

        <!-- begin page-header -->
        <h1 class="page-header">Ficha Atendimento <small>LEADS</small></h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
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
                    <h4 class="panel-title">Dados do LEAD</h4>
                </div>

                <div class="panel-body">
                    <!--INICIO FORMULARIO-->
                    <form class="form-horizontal" action="" method="" name="wysihtml5" enctype="multipart/form-data">


                        <?php

                        include "conexao.php";

                        $idcli = $_GET["numero"];

                        $crm_dataatt    = date('d-m-Y H:i:s');


                    /*if (1 == 0){
                        $status = 1;


                        $query_amigo1 = "INSERT INTO crm_atendimento (crm_tratadescricao, crm_tratadata, crm_idcli, crm_tratastatus, crm_idcorretor) values ('$descricao', '$crm_dataatt', '$idcli', '$status')";
                        $executa_query1 = mysqli_query ($db,$query_amigo1) or die ("Erro ao listar contatos");
                    }*/
                    $query_amigo = "SELECT * FROM crm_cli 
                    INNER JOIN crm_atendimento ON crm_atendimento.crm_idcli = crm_cli.crm_id
                    INNER JOIN crm_origem ON crm_origem.crm_idorigem = crm_cli.crm_origem
                    WHERE crm_id = $idcli";

                    $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");



                    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {

                        $id                 = $buscar_amigo['crm_id'];
                        $nome               = utf8_encode($buscar_amigo["crm_nome"]);
                        $celular            = $buscar_amigo["crm_celular"];
                        $fixo               = $buscar_amigo["crm_fixo"];
                        $email              = $buscar_amigo["crm_email"];
                        $cidade             = utf8_encode($buscar_amigo["crm_cidade"]);
                        $origem             = $buscar_amigo["crm_origem"];
                        $origemnome         = $buscar_amigo["crm_origemnome"];
                        $data_retorno       = $buscar_amigo["crm_dataretorno"];
                        $crm_obs            = $buscar_amigo["crm_obs"];
                        $statusatual        = $buscar_amigo["crm_statuscli"];
                        if ($data_retorno != "") {
                            # code...
                            $data_retorno2 = $data_retorno;
                        }
                        $hora_retorno       = $buscar_amigo["crm_horaretorno"];
                        if ($hora_retorno != "") {
                            # code...
                            $hora_retorno2 = $hora_retorno;
                        }
                        $categoria = $buscar_amigo["crm_categoria"];

                        $interesse          = $buscar_amigo["crm_interesse"];

                    }

                    include "conexao.php";
if ($categoria == 2) {
                       
                    $query_amigo2 = "SELECT idempreendimento_cadastro, descricao_empreendimento FROM empreendimento_cadastro WHERE idempreendimento_cadastro = $interesse ";

                    $executa_query2 = mysqli_query ($db,$query_amigo2) or die ("Erro ao listar contatos");

                    while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query2)) {

                        $ide                 = $buscar_amigo2['idempreendimento_cadastro'];
                        $desc               = utf8_encode($buscar_amigo2["descricao_empreendimento"]);

                    }
} else {
    $query_c = "SELECT endereco, numero FROM imovel WHERE idimovel = $interesse";



         $executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento mesmo");               
         
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos
             
              
                $desc             = $buscar_amigoc['endereco'];
                $num             = $buscar_amigoc['numero'];
               }  
}
                    ?>
<div class="col-md-6">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Nome: </label>

                        <div class="col-md-6">
                            <?php echo $nome; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Interesse</label>
                        
                        <div class="col-md-6">
                            <?php echo "$desc, $num"; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">E-mail: </label>
                        <div class="col-md-6">
                            <?php echo $email; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Celular: </label>
                        <div class="col-md-6">
                          <?php echo $celular; ?>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Fixo: </label>
                    <div class="col-md-6">
                        <?php echo $fixo; ?>
                    </div>
                </div>
</div>
<div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-3 control-label">Cidade: </label>
                    <div class="col-md-6">
                        <?php echo $cidade; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Origem: </label>
                    <div class="col-md-6">
                        <?php echo $origemnome; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Contato em: </label>
                    <div class="col-md-6">
                        <?php echo $data_retorno2." - ".$hora_retorno2; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Observação: </label>
                    <div class="col-md-9">
                        <?php echo $crm_obs; ?>
                    </div>
                </div>
</div>
            </form>
        </div>
    </div>
</div><!-- FIM COLUNA -->


</div><!-- FIM ROW PRIMEIRA JANELA -->


<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-6">
        <!-- SEGUNDA JANELA DA TELA -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Tratativas LEAD</h4>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" action="crm_salvatrata.php" method="POST" name="wysihtml5" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Descrição Atendimento</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="descricao" required=""></textarea>
                            <input type="hidden" name="cad" value="<?php echo $id ?>">
                            <input type="hidden" name="imobiliaria_idimobiliaria" class="form-control" value="<?php echo $imobiliaria_idimobiliaria ; ?>">
                        </div>
                    </div>

                    

    <div class="form-group">
        <label class="col-md-3 control-label">Status</label>
        <div class="col-md-4">
            <div class="">
                <select name="status3" class="form-control"  required="">
                    <option value="">Selecione</option>
                    <?php 


                    include "conexao.php";
                    $query_slide = mysqli_query($db,"SELECT a.crm_idstatus as id, a.crm_status as nome  FROM crm_status as a INNER JOIN crm_statusvinculo as b ON a.crm_idstatus = b.crm_idstatus WHERE b.crm_idant = $statusatual GROUP BY a.crm_idstatus ORDER BY a.crm_status Asc") or die ("Erro ao listar grupo dos clientes, tente mais tarde");
                    
            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

                $idstatus          = $buscar_slide["id"];
                $status2      = $buscar_slide["nome"];
                
                ?> 
                <option value="<?php echo $idstatus ?>"><?php echo $status2 ?></option>

            <?php } ?>

        </select>

    </div>
</div>
</div>


                    

                    <div class="form-group">
                        <label class="col-md-3 control-label">Reagendar Data: </label>
                        <div class="col-md-4">
                            <input type="date" name="data_retorno" class="form-control" min="2018-04-01" value="<?php echo date('Y-m-d'); ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                                        <label class="col-md-3 control-label">Hora: </label>
                                        <div class="col-md-2">
                                            
                                            <input type="text" class="form-control" name="hora_retorno" id="hora"  />
                                        </div>
                                    </div>



<div class="form-group">
    <div class="col-md-9">
        <button type="submit" class="btn btn-sm btn-primary">Enviar</button>    
        <!-- #modal-dialog -->

    </div>
</div>

</form>
</div>
</div>
</div><!-- FIM COLUNA -->





<!-- begin col-6 -->
<div class="col-md-6">

    <!-- TERCEIRA JANELA DA TELA -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Mapeamento do Lead</h4>
        </div>

        <div class="panel-body">

            <div id="map"></div>


            <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
            </script>
            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdVRY-Suj8VPsCebuqFss-bKooLiRjkAs&callback=initMap">
        </script>
        <?php

        include "conexao.php";  

        $query_amigo = "SELECT * FROM crm_cli WHERE crm_id = $idcli";
        $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

        ?>

        <script>

            function initMap() {

                var locations = [
         <?php while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

            $id                 = $buscar_amigo['crm_id'];
            $nome               = utf8_encode($buscar_amigo["crm_nome"]);
            $lat                = $buscar_amigo["crm_lat"];
            $long               = $buscar_amigo["crm_long"];
            $celular            = $buscar_amigo["crm_celular"];
            $fixo               = $buscar_amigo["crm_fixo"];
            $email              = $buscar_amigo["crm_email"];
            
            ?>
            {lat: <?php echo $lat; ?>, lng: <?php echo $long; ?>},
        <?php } ?>

        ]

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: {lat: <?php echo $lat; ?>, lng: <?php echo $long; ?>}
            
        });

        // Create an array of alphabetical characters used to label the markers.
        //var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function(location, i) {
            return new google.maps.Marker({
                position: location,
                //label: labels[i % labels.length],
                icon: 'img/pin site.png'
            });
        });

                // Add a marker clusterer to manage the markers.
                var markerCluster = new MarkerClusterer(map, markers,
                    {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
            }
            

            


        </script>

    </div>

</div>

</div><!-- FIM COLUNA -->


</div><!-- FIM ROW terceira JANELA 2 COLUNS DENTRO DA ROW-->

<!-- begin row -->
<div class="row">
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
            <h4 class="panel-title">Histórico de Atendimento</h4>
        </div>

        <div class="panel-body">
            <!--INICIO FORMULARIO-->
            <table id="data-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descrição do Atendimento</th>
                        <th>Data do Atendimento</th>
                        <th>Status</th>
                        <th>Atendente</th>


                    </tr>
                </thead>
                <tbody>

                    <?php

                    include "conexao.php";

                    
                                        //inner join para mostrar o nome da origem e nao o ID.
                    $query_amigo = "SELECT * FROM crm_cli 
                    INNER JOIN crm_origem ON crm_cli.crm_origem = crm_origem.crm_idorigem 
                    INNER JOIN crm_atendimento ON crm_cli.crm_id = crm_atendimento.crm_idcli 
                    INNER JOIN crm_status ON crm_atendimento.crm_tratastatus = crm_status.crm_idstatus
                    WHERE crm_id = $id 
                    order by crm_trataid desc";

                    $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                $id                 = $buscar_amigo['crm_id'];
                $nome               = utf8_encode($buscar_amigo["crm_nome"]);
                $status             = $buscar_amigo["crm_tratastatus"];
                $statusdesc         = $buscar_amigo["crm_status"];
                $email              = $buscar_amigo["crm_email"];
                $celular            = $buscar_amigo["crm_celular"];
                $origem             = $buscar_amigo["crm_origemnome"];
                $descricao          = utf8_encode($buscar_amigo["crm_tratadescricao"]);
                $dataatt            = $buscar_amigo["crm_tratadata"];
                $corretor           = $buscar_amigo["crm_idcorretor"];
                $cor                = $buscar_amigo["crm_cor"];



                ?>

                <tr class="odd gradeX">
                    <td><input type="checkbox" name="ver[]" value="<?php echo $id ?>"></td>
                    
                    <td><?php echo $descricao ?></td>
                    <td><?php echo $dataatt ?></td>
                    <td><label class="label" style="background-color: <?php echo $cor; ?>"> <?php echo $statusdesc ?></label></td>
                    <td><?php echo nome_user($corretor) ?></td>
                </tr>
                <?php $cont = $cont + 1;

            } ?>
        </tbody> 
    </table>

</div>
</div>
</div><!-- FIM COLUNA -->

</div><!-- FIM ROW QUARTA JANELA -->

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
<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/masked-input/masked-input.min.js"></script>
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
      <script src="https://immobilebusiness.com.br/admin/assets/js/form-plugins.demo.min.js"></script>

         <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/password-indicator/js/password-indicator.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/js/form-plugins.demo.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

    <!-- ================== END PAGE LEVEL JS ================== -->
<script type="text/javascript"> 

    document.getElementById('menucrm').style.display="block";

</script>
    <script>
        $(document).ready(function() {
            App.init();
            
            TableManageButtons.init();
            
        });
    </script>

</body>


</html>
