<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<?php 

if(isset($_POST["finalidade"])){

$cod_imov_tipo      = $_POST['cod_imov_tipo'];
$cod_imov_subtipo   = $_POST['cod_imov_subtipo'];
$cod_imov_categoria = $_POST['cod_imov_categoria'];

$finalidade         = $_POST['finalidade'];
$preco              = $_POST['preco'];
$dormitorios        = $_POST['dormitorios'];
$banheiros          = $_POST['banheiros'];
$cozinhas           = $_POST['cozinhas'];
$terreno            = $_POST['terreno'];
$suites             = $_POST['suites'];
$garagens           = $_POST['garagens'];
$area_construida    = $_POST['area_construida'];
$descricao          = $_POST['descricao'];
$matricula          = $_POST['matricula'];
$locador_idlocador  = $_POST['locador_idlocador'];
$cartorio_idcartorio  = $_POST['cartorio_idcartorio'];
$percentual  = $_POST['percentual'];
$complemento_endereco  = $_POST['complemento_endereco'];



$cidade             = $_POST["cidade_cli"];
$endereco           = $_POST["endereco_cli"];
$numero             = $_POST["numero_cli"];
$bairro             = $_POST["bairro_cli"];
$cep                = $_POST["cep_cli"];
$estado             = $_POST["estado_cli"];
$lat                = $_POST['lat']; 
$lon                = $_POST['lon']; 

$imobiliaria_idimobiliaria           = $_POST['imobiliaria_idimobiliaria']; 
$data_cadastro                       = date('d-m-Y H:i:s'); 


$site                   = $_POST['site']; 
$utilizacao             = $_POST['utilizacao']; 
$imovel_urbano          = $_POST['imovel_urbano']; 

$ref_agua               = $_POST['ref_agua']; 
$ref_energia            = $_POST['ref_energia']; 
$ref_gas                = $_POST['ref_gas']; 
$ref_iptu               = $_POST['ref_iptu']; 

$seguradora             = $_POST['seguradora']; 
$numero_apolice         = $_POST['numero_apolice']; 
$vencimento_seguro      = $_POST['vencimento']; 
$valor_seguro           = $_POST['valor_seguro']; 
$quantidade_de_parcelas_seguro           = $_POST['quantidade_de_parcelas_seguro']; 

$exclusividade          = $_POST['exclusividade']; 
$data_exclusividade     = $_POST['data_exclusividade']; 
$data_exclusividade     = date("d-m-Y", strtotime($data_exclusividade));



$corretor_id            = $_POST['corretor_id']; 


 //////////////////////////////////////////


$pasta = "fotos/principal/";
if(!file_exists($pasta)){
mkdir($pasta);
}


 
include "conexao.php";


$teste = "INSERT INTO imovel (
cod_imov_tipo, 
cod_imov_subtipo, 
cod_imov_categoria, 
finalidade, 
preco, 
dormitorios, 
banheiros, 
cozinhas, 
terreno, 
suites, 
garagens, 
area_construida, 
utilizacao, 
bairro, 
descricao, 
site, 
cidade_idcidade, 
locador_idlocador, 
imobiliaria_idimobiliaria, 
lat, 
lon, 
endereco, 
estado, 
cep, 
numero, 
matricula,
ref_agua, 
ref_energia,
ref_gas, 
seguradora, 
numero_apolice, 
valor_seguro, 
vencimento_seguro,
exclusividade, 
data_exclusividade, 
cartorio_idcartorio, 
ref_iptu, 
quantidade_parcelas_seguro, 
corretor_id, 
data_cadastro, 
imovel_urbano,
complemento_endereco) 

values (
'$cod_imov_tipo',
'$cod_imov_subtipo',
'$cod_imov_categoria',
'$finalidade',
'$preco',
'$dormitorios',
'$banheiros',
'$cozinhas',
'$terreno',
'$suites',
'$garagens',
'$area_construida',
'$utilizacao',
'$bairro',
'$descricao',
'$site',
'$cidade', 
'$locador_idlocador',
'$imobiliaria_idimobiliaria',
'$lat',
'$lon',
'$endereco',
'$estado',
'$cep',
'$numero',
'$matricula',
'$ref_agua',
'$ref_energia',
'$ref_gas',
'$seguradora',
'$numero_apolice',
'$valor_seguro',
'$vencimento_seguro',
'$exclusividade',
'$data_exclusividade',
'$cartorio_idcartorio',
'$ref_iptu',
'$quantidade_de_parcelas_seguro',
'$corretor_id',
'$data_cadastro',
'$imovel_urbano',
'$complemento_endereco')";
$gravar = mysqli_query($db, $teste);

 $id_res = mysqli_insert_id($db);

$insere_proprietario_titular = "INSERT INTO proprietarios(imovel_id, proprietario_id, percentual) values('$id_res','$locador_idlocador','$percentual')";
$executa_insere_proprietario_titular = mysqli_query($db, $insere_proprietario_titular);


?>

<script>
 window.location="imoveis.php?cad=ok";
 </script>

 <?php } ?>

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
       <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script> 
        <link href="https://immobilebusiness.com.br/admin/assets/css/multiple-select.css" rel="stylesheet"/>

    <!-- ================== END BASE JS ================== -->
</head>
<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
    <?php include "topo.php" ?>
        <!-- end #sidebar -->
        
        <!-- begin #content -->
        <div id="content" class="content">
            
                        
            
            Cadastro de Imóvel</h1>
            <!-- end page-header -->
            <div class="row">
                <!-- begin col-12 -->
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
                            <h4 class="panel-title">Imóvel</h4>
                             <?php

           $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];
             ?>
                        </div>
                        <div class="panel-body">
                            <form action="cadastro_imovel.php" method="POST" data-parsley-validate="true" name="form_wizard" enctype="multipart/form-data">
                                <div id="wizard">
                                    <ol>
                                        <li>
                                            Informações Básicas
                                            <small></small>
                                        </li>
                                        <li>
                                            Ficha do Imóvel
                                            <small> </small>
                                        </li>
                                         <li>
                                            Endereço
                                            <small> </small>
                                        </li>
                                        <li>
                                            Referencias
                                            <small></small>
                                        </li>
                                         <li>
                                            Seguro
                                            <small></small>
                                        </li>
                                       
                                       
                                    </ol>
                                    <!-- begin wizard step-1 -->
                                    <div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">Informações Báscias</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group block1">
                                                        <label>Proprietário (Titular)</label>
                                                               <select class="form-control" name="locador_idlocador" required>
                                            <option value="">Selecione</option>
                                        
                                       
                                        <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM cliente
                                                 INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                                 INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                                 where cliente_tipo.idtipo = 4 or cliente_tipo.idtipo = 3 group by cliente.idcliente
") or die ("Erro ao listar Locador, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {
           
             $idcliente  = $buscar_slide["idcliente"];
             $nome_cli   = $buscar_slide["nome_cli"];

                    ?> 
                                            <option value="<?php echo $idcliente ?>"><?php echo $nome_cli ?></option>
                                           <?php } ?>
                                           

                                        </select>
       <input type="hidden" name="imobiliaria_idimobiliaria" value="<?php echo $imobiliaria_idimobiliaria ?>">


                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                              
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>% Participação</label>
                                                        <input type="text" class="form-control" id="percentual" name="percentual">
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                            </div>
                                            <!-- end row -->
<div class="row">
      <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Finalidade</label>
                                                          <select class="form-control" name="finalidade">
                                            <option value="Venda">Venda</option>
                                            <option value="Aluguel" >Aluguel</option>
                                            <option value="Construcao" >Construção</option>
                                           
                                        </select>
                                                    </div>
                                                </div>
</div>


                                    <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group block1">
                                                        <label>Tipo</label>
                                                               <select class="form-control" name="cod_imov_tipo" id="cod_imov_tipo" required>
                                            <option value="">Selecione</option>
                                        
                                       
                                        <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM imov_tipo");


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idtipo          = $buscar_slide["idtipo"];
             $descricao_zap   = $buscar_slide["descricao_zap"];

                    ?> 
                                            <option value="<?php echo $idtipo ?>"><?php echo $descricao_zap ?></option>
                                           <?php } ?>
                                           

                                        </select>


                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                              
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Subtipo</label>
                                                          <select class="form-control" name="cod_imov_subtipo" id="cod_imov_subtipo">
                                         
                                           
                                        </select>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->




                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Categoria</label>
                                                          <select class="form-control" name="cod_imov_categoria" id="cod_imov_categoria">
                                          
                                           
                                        </select>
                                                    </div>
                                                </div>
                                            </div>

























                                            <div class="row">

                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Cartório</label>
   <select class="form-control" name="cartorio_idcartorio">
                                            <option value="">Selecione</option>
                                        
                                       
                                        <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM cliente
                                                 INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                                 INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                                 where cliente_tipo.idtipo = 10 group by cliente.idcliente
") or die ("Erro ao listar Locador, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idcliente  = $buscar_slide["idcliente"];
             $nome_cli   = $buscar_slide["nome_cli"];

                    ?> 
                                            <option value="<?php echo $idcliente ?>"><?php echo $nome_cli ?></option>
                                           <?php } ?>
                                           

                                        </select>   
                                                    </div>
                                                </div>
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group block1">
                                                        <label>Nº Matricula</label>
                                             <input type="text" name="matricula" class="form-control">



                                                    </div>
                                                </div>
                                                
                                                <!-- end col-4 -->
                                            </div>






                                            <Div class="row">
                                                <!-- begin col-4 -->
                                             
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Valor:</label>
                                               <input type="text" name="preco" id="preco" class="form-control">

                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                             
                                                <!-- end col-4 -->
                                            </div>



                                        <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group block1">
                                                        <label>Exclusividade</label>
                                             <select class="form-control" name="exclusividade" required="">
                                              <option value="">Selecione</option>
                                            <option value="1">Sim</option>
                                            <option value="0" >Não</option>
                                           

                                        </select>




                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Data Exclusividade</label>
                                             <input type="date" class="form-control" name="data_exclusividade"  />

                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                               
                                                <!-- end col-4 -->
                                            </div>

                                               <div class="row">
                                                <!-- begin col-4 -->
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Corretor Resp:</label>
                                             <select class="form-control" name="corretor_id">
                                            <option value="">Selecione</option>
                                        
                                       
                                        <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM cliente
                                                 INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                                 INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                                 where cliente_tipo.idtipo = 8  group by cliente.idcliente
") or die ("Erro ao listar Locador, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idcorretor      = $buscar_slide["idcliente"];
             $nome_corretor   = $buscar_slide["nome_cli"];

                    ?> 
                                            <option value="<?php echo $idcorretor ?>"><?php echo $nome_corretor ?></option>
                                           <?php } ?>
                                           

                                        </select>

                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Exibir no Site?</label><br>
                                      <input type="checkbox" value="1" name="site" />Sim
   
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                            </div>










                                       


                                        </fieldset>
                                    </div>
                                    <!-- end wizard step-1 -->
                                 
          


                              

                                    <!-- begin wizard step-2 -->
                                    <div class="wizard-step-2">
                                        <fieldset>
                                            <legend class="pull-left width-full">Ficha do Imóvel:</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Dormitórios</label>
                                        <select class="form-control" name="dormitorios">
                                             <option value="">Selecione</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>

                                        </select>

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Suite:</label>
                                          <select class="form-control" name="suites">
                                             <option value="">Selecione</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>

                                        </select>
                                                    </div>
                                                </div>

                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Banheiro:</label>
                                         <select class="form-control" name="banheiros">
                                             <option value="">Selecione</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>

                                        </select>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->

                                             <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cozinha:</label>
                                          <select class="form-control" name="cozinhas">
                                             <option value="">Selecione</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                      

                                        </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Garagem:</label>
                                        <select class="form-control" name="garagens">
                                             <option value="">Selecione</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                           

                                        </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Àrea do Terreno:</label>
                                        <input type="text" name="terreno" class="form-control">
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                              
                                                <!-- end col-6 -->
                                            </div>

                                        

                                              <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Àrea Construida:</label>
                                       <input type="text" name="area_construida" class="form-control">

                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Utilização:</label>
                                        <select class="form-control" name="utilizacao">
                                            <option value="Novo">Novo</option>
                                            <option value="Usado">Usado</option>
                                        
                                           

                                        </select>
                                                    </div>
                                                </div>
                                               
                                                <!-- end col-6 -->
                                                  <div class="col-md-4">
                                                    <div class="form-group block1">
                                                        <label>Descrição</label>
                                             <textarea name="descricao" class="form-control"></textarea>




                                                    </div>
                                                </div>
                                                <!-- begin col-6 -->
                                              
                                                <!-- end col-6 -->
                                            </div>



                                                <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Imóvel</label><br>
                                       <input type="radio" name="imovel_urbano" value="U" required=""> Urbano <br>
                                       <input type="radio" name="imovel_urbano" value="R"> Rural <br>

                                                    </div>
                                                </div>
                                               
                                               
                                                <!-- end col-6 -->
                                              
                                                <!-- begin col-6 -->
                                              
                                                <!-- end col-6 -->
                                            </div>


                                        </fieldset>
                                    </div>
                                    <!-- end wizard step-2 -->
                                    <!-- begin wizard step-3 -->
                                    <div class="wizard-step-3">
                                        <fieldset>
                                            <legend class="pull-left width-full">Endereço:</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                 <div class="col-md-4">
                                                <div class="form-group">
                                                        <label>CEP</label>
                                                        <div class="controls">
                               <input type="text" class="form-control" id="cep"  name="cep_cli" placeholder="Cep" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Endereço</label>
                                                        <div class="controls">
                                                          <input type="text" class="form-control" id="rua"   name="endereco_cli" placeholder="Rua" />   
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Numero</label>
                                                        <div class="controls">
                         <input type="text" class="form-control" id="numero"  name="numero_cli" placeholder="Numero" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                               
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->


                                             <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Bairro</label>
                                                        <div class="controls">
                     <input type="text" class="form-control" id="bairro"  name="bairro_cli" placeholder="Bairro" />
                 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cidade</label>
                                                        <div class="controls">
                               <input type="text" class="form-control" id="cidade"  name="cidade_cli" placeholder="Cidade" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Estado</label>
                                                        <div class="controls">
                     <input type="text" class="form-control" id="estado"  name="estado_cli" placeholder="Estado" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>

                                              <div class="row">
                                                
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Complemento:</label>
                                                        <div class="controls">
                                      <input type="text" name="complemento_endereco" class="form-control">
                 
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Latitude:</label>
                                                        <div class="controls">
                                      <input type="text" name="lat" id="lat" class="form-control">
                 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Longitude:</label>
                                                        <div class="controls">
                                      <input type="text" name="lon" id="lon" class="form-control">

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                
                                                <!-- end col-6 -->
                                            </div>

                                             
                                        </fieldset>
                                        
                                    </div>
                            
                                   <div class="wizard-step-4">
                                        <fieldset>
                                            <legend class="pull-left width-full">Referencias:</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Referencia Agua:</label>
                                        <input type="text" class="form-control" name="ref_agua" />

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Referencia Energia:</label>
                                           <input type="text" class="form-control" name="ref_energia"   />
                                                    </div>
                                                </div>

                                                
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->

                                         <div class="row">
                                                <!-- begin col-6 -->
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Referencia Gás:</label>
                                           <input type="text" class="form-control" name="ref_gas"   />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Referencia IPTU:</label>
                                           <input type="text" class="form-control" name="ref_iptu"   />
                                                    </div>
                                                </div>

                                                 
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->                                     

                                               
                                        </fieldset>
                                    </div>




                                     <div class="wizard-step-5">
                                        <fieldset>
                                            <legend class="pull-left width-full">Seguro:</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Seguradora</label>
                                        <input type="text" class="form-control" name="seguradora"  />

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nº Apolice:</label>
                                           <input type="text" class="form-control" name="numero_apolice" />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->

                                             <div class="row">
                                                <!-- begin col-6 -->
                                              
                                              <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Valor do Seguro</label>
                                                   <input type="text" class="form-control" name="valor_seguro" id="valor_seguro" />
                                                    </div>
                                                </div>
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Quantidade de Parcelas</label>
                                                   <input type="text" class="form-control" name="quantidade_de_parcelas_seguro" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Vencimento</label>
                                                   <input type="text" class="form-control" name="vencimento" id="masked-input-date4" />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>

                                               
                                        </fieldset>
                                          <p><input type="submit" class="btn btn-success btn-lg" role="button" value="Cadastrar" /></p>
                                    </div>

                        
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- begin row -->
        
            <!-- end row -->
       
        </div>
    
     
        
        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->
<!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
     <script src="https://immobilebusiness.com.br/admin/assets/js/multiple-select.js"></script>
    <script>
        $('#select').multipleSelect();
    </script>
<script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

 <script type="text/javascript">

$(function(){
$("#preco").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#preco_venda").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_seguro").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$("#percentual").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});


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
     <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/masked-input/masked-input.min.js"></script>
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
    <script src="https://immobilebusiness.com.br/admin/assets/js/table-manage-buttons.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
      <script src="https://immobilebusiness.com.br/admin/assets/plugins/masked-input/masked-input.min.js"></script>


        <script src="https://immobilebusiness.com.br/admin/assets/plugins/parsley/dist/parsley.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/form-wizards-validation.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
    <script type='text/javascript' src='cep.js'></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script type="text/javascript">
        

        $(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#numero').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_lat.php', /* URL que será chamada */ 
                type : 'GET', /* Tipo da requisição */ 
                data: 'endereco=' + $('#rua').val()+'&numero='+ $('#numero').val()+'&cidade='+ $('#cidade').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#lat').val(data.lat);
                        $('#lon').val(data.lon);
                       
                    }
                }
           });   
   return false;    
   })
});


/*  Busca os subtipos dos imoveis  */
$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#cod_imov_tipo').click(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_tipo.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'idtipo=' + $('#cod_imov_tipo').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
var $cod_imov_subtipo = $('#cod_imov_subtipo');
            $cod_imov_subtipo.empty();

                  

            $.each(data, function(idsubtipo, subtipo){
                   $cod_imov_subtipo.append('<option value=' + idsubtipo + '>' + subtipo + '</option>');
            });

              $cod_imov_subtipo.change();        
                              
    
    
                    
                       
                 
                }
           });   
   return false;    
   })
});


$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#cod_imov_subtipo').click(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_subtipo.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'idsubtipo=' + $('#cod_imov_subtipo').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
var $cod_imov_categoria = $('#cod_imov_categoria');
            $cod_imov_categoria.empty();

                  

            $.each(data, function(idcategoria, categoria){
                   $cod_imov_categoria.append('<option value=' + idcategoria + '>' + categoria + '</option>');
            });

              $cod_imov_categoria.change();        
                              
    
    
                    
                       
                 
                }
           });   
   return false;    
   })
});




    </script>
          
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            FormWizardValidation.init();
            TableManageButtons.init();
        });
    </script>

</body>

</html>
