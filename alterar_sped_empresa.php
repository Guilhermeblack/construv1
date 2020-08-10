<?php
ob_start();
error_reporting(0);
ini_set(“display_errors”, 0 );
if (!isset($_SESSION)) {
  session_start();
}


if(isset($_POST['status']) && !empty($_POST['status']) && !isset($_POST['cpf_contador']) ){


    $idempresa = addslashes($_POST['idempresa']);  

    if($_POST['status'] === "cadastrado"){
       // echo "entrei aqui"; die();
        header("Location: alterar_sped_empresa.php?idempresa=$idempresa&status=cadastroOk");
    }
}

?>


<?php
if(isset($_GET['idempresa']) && !empty($_GET['idempresa'])){
    include "conexao.php";


    if(isset($_GET['status']) === 'Ok'){
        header("Location: gerar_sped.php?idempresa=$idempresa&status=Ok");
    }



    $idempresa = addslashes($_GET['idempresa']);  

    $consultaemp = mysqli_query($db,"SELECT * FROM sped_config WHERE empresa_id = '$idempresa'");

    $numrows = mysqli_num_rows($consultaemp);

    if($numrows > 0 ){
        //header("Location: relatorio_empresa_sped.php?idempresa=$idempresa&status=Existe");
        header("Location: alterar_sped.php?idempresa=$idempresa&status=alterar");

    }

}






if(isset($_POST['idempresa']) && isset($_POST['idempresa']) 
    && !empty($_POST['idcontador']) && !empty($_POST['nomecontador']) ){
    //echo "to aqui";

    include "conexao.php";
$idconf = '';
$idempresa = $_POST['idempresa'];
$idcontador = $_POST['idcontador'];

$consultaemp = mysqli_query($db,"SELECT nome_cli FROM cliente WHERE idcliente = '$idempresa'");
$emp = mysqli_fetch_assoc($consultaemp);

$consultacont = mysqli_query($db,"SELECT nome_cli FROM cliente WHERE idcliente = '$idcontador'");
$contador = mysqli_fetch_assoc($consultacont);



//print_r($emp);
//print_r($contador);
$empresa = $emp['nome_cli'];
$codmuncli = $_POST['cod_municipio_cli'];
$nomecontador = $contador['nome_cli'];
$idcontador = $_POST['idcontador'];
$codmuncont = $_POST['cod_municipio_contab'];
$indtributario = $_POST['indicador_tributario'];
$indapropriacao = $_POST['indicador_apropriacao'];
$apurcontribuicao = $_POST['apuracao_contribuicao'];
$incidtributaria = $_POST['incidencia_tributaria'];
$crccontador = $_POST['crc_contador'];
$cpfcontador = $_POST['cpf_contador'];
$codatividade = $_POST['cod_atividade'];
$aliquotaatividade = $_POST['aliquota_atividade'];
$apropriacaocredito = $_POST['apropriacao_credito'];
//echo $cpfcontador ; die();


if($apropriacaocredito == 1){
    $pis =  '1,6500';
    $cofins = '7,6000';
    $codM205 = '08';
}elseif($apropriacaocredito == 2){
    $pis =  '0,6500';
    $cofins = '3,0000';
    $codM205 = '12';

}

        //$valreceitabpj = $_POST['valor_receitabruta_pj']; //foi excluido devera vir do relatorio este campo
// $valativpj = $_POST['valor_atividade_pj'];
// $valativnpj = $_POST['valor_atividaden_pj'];


$inserir = mysqli_query($db,"INSERT INTO sped_config (idconf, empresa_id, empresa,
    cod_municipio_cli, nome_contador, cliente_id_contador, cod_municipio_contador, cpf_contador, crc_contador, indicador_tributario, indicador_apropriacao, apuracao_contribuicao, incidencia_tributaria, pis, cofins, cod_atividade, aliquota_atividade, apropriacao_credito, codM205) values('$idconf', '$idempresa', '$empresa', '$codmuncli', '$nomecontador', '$idcontador', '$codmuncont', $cpfcontador, '$crccontador' , '$indtributario', '$indapropriacao', '$apurcontribuicao', '$incidtributaria', '$pis', '$cofins', '$codatividade', '$aliquotaatividade', '$apropriacaocredito', '$codM205')") or die("Erro ao Configurar o Sped");


$status = $_POST['status'];
//echo $status; 
if($status == 'configurar' && $inserir == true){
// echo "entrei no if o status"; die();
 header("Location: alterar_sped_empresa.php?idempresa=$idempresa&status=cadastrado");        
} 



if($inserir){
    header("Location: gerar_sped.php?idempresa=$idempresa&status=Ok");
}else{
    header("Location: alterar_speed_empresa.php?idempresa=$idempresa&status=Erro");
}


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
    
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script type="text/javascript">
        String.prototype.reverse = function(){
            return this.split('').reverse().join(''); 
        };

        function mascaraMoeda(campo,evento){
            var tecla = (!evento) ? window.event.keyCode : evento.which;
            var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
            var resultado  = "";
            var mascara = "##.###.###,##".reverse();
            for (var x=0, y=0; x<mascara.length && y<valor.length;) {
                if (mascara.charAt(x) != '#') {
                    resultado += mascara.charAt(x);
                    x++;
                } else {
                    resultado += valor.charAt(y);
                    y++;
                    x++;
                }
            }
            campo.value = resultado.reverse();
        }

    </script>


</head>
<body>
 begin #page-loader -->
 <div id="page-loader" class="fade"><span class="spinner"></span></div>
 <!-- end #page-loader -->

 <!-- begin #page-container -->
 <div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">


    <?php include "topo.php"; ?>

    <!-- begin #content -->
    <div id="content" class="content">
      <div class="form-control" style="height: 120%">

        <?php 
        if(isset($_GET['status']) && !empty($_GET['status'])){
            if($_GET['status'] === 'cadastroOk'){
               // echo "entrei aqui no cadastroOk"; die();
                ?>
                <h3 class="m-t-12"><i class="fa fa-cog"></i> Configurações do Sped  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<font style="color: green">   (Cadastrado Com Sucesso !!! )</font></h3>

                <?php
            }else if($_GET['status'] == 'cadastrar'){
                ?>
                <h3 class="m-t-12"><i class="fa fa-cog"></i> Configurações do Sped  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<font style="color: red">   (Empresa ainda nao possui configurações do Sped !!! )</font></h3>

                <?php

            }else if($_GET['status'] == 'Existe'){
                ?>
                <h3 class="m-t-12"><i class="fa fa-cog"></i> Configurações do Sped  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<font style="color: red">   (Empresa Ja possui Configurações do Sped !!!)</font></h3>

                <?php




            }else if($_GET['status'] == 'configurar'){
                ?>
                <h3 class="m-t-12"><i class="fa fa-cog"></i> Configurações do Sped</h3>

                <?php




            }else{
                ?>
                <h3 class="m-t-12"><i class="fa fa-cog"></i> Configurações do Sped &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<font style="color: red">   (Nao foi possivel Cadastrar !!!)</font></h3>

                <?php
            }

        }else{
            ?>
            <h3 class="m-t-12"><i class="fa fa-cog"></i> Configurações do Sped</h3>

            <?php

        }

        ?>



        <form action="alterar_sped_empresa.php"  method="POST">
          <?php // empresa=<?php echo $empresa &nomecontador=<?php echo $nomecontador ?> 

          <label class="col-md-12"><strong>Dados Empresa.:</strong></label>

          <div class="form-group">

             <label class="col-md-4 control-label">Empresa:</label>
             <div class="col-md-7">
               <?php

               include "conexao.php";

               $query_amigo = "SELECT * FROM cliente WHERE idcliente = $idempresa";


               $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar Locatário");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                	$idempresa             = $buscar_amigo['idcliente'];
                	$empresa               = $buscar_amigo["nome_cli"];
                	$cpf_cli               = $buscar_amigo["cpf_cli"];

                	?>
                	<label><?php echo "$empresa "?></label>

                	<?php } ?>

                </select>
                <input type="hidden"  name="idempresa" value="<?php echo $idempresa?>">
                <input type="hidden"  name="empresa" value="<?php echo $empresa?>">
                <input type="hidden"  name="status" value="cadastrado">


            </div>
        </div>


        <div class="form-group">		
        	<label class="col-md-4 control-label">Código Municipio</label>
        	<div class="col-md-7">
        		<input type="number" id="cod_municipio_cli" name="cod_municipio_cli" maxlength="7" class="form-control" required="" placeholder="Código de 7 digitos , Somente Numeros...">                                          
        	</div>
        </div>

 <!--        <div class="form-group">        
            <label class="col-md-4 control-label">Código Atividade Receita Bruta conforme (TABELA 5.1.1)</label>
            <div class="col-md-7">
                <input type="number" id="cod_atividade" name="cod_atividade" maxlength="8"  class="form-control" required="" placeholder="Campo nao Obrigatorio...">                                          
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Aliquota Correspondente Atividade Conf.(TABELA 5.1.1)</label>
            <div class="col-md-7">
                <input type="text" id="aliquota_atividade" name="aliquota_atividade" class="form-control"  value="2,0000" >

            </div>

        </div>
 -->

        <label><strong>Dados Contabilista.:</strong></label>

        <div class="form-group">


        	<label class="col-md-4 control-label">Nome Contador:</label>
        	<div class="col-md-7">
        		<select class="form-control" name="idcontador" required="">
        			<option value="">Escolha</option>
        			<?php

        			include "conexao.php";

        			$query_amigo = "SELECT cliente.nome_cli, cliente_tipo.idcliente, cliente_tipo.idtipo 				
        			FROM cliente
        			INNER JOIN cliente_tipo 
        			ON cliente.idcliente = cliente_tipo.idcliente
        			WHERE idtipo = '15' order by nome_cli Asc";


        			$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Contador");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                	$nomecontador             = $buscar_amigo['nome_cli'];
                	$idcontador            = $buscar_amigo["idcliente"];
                	$cliente_tipo         = $buscar_amigo["cliente_tipo"];

                	?>
                	<option value="<?php echo $idcontador ?>" > <?php echo $nomecontador?> </option>
                	<?php } ?>


                </select>
                <input type="hidden"  name="nomecontador" value="<?php echo $nomecontador?>">

            </div>
        </div>

        <div class="form-group">
        	<label class="col-md-4 control-label">Código Municipio</label>
        	<div class="col-md-7">
        		<input type="number" id="cod_municipio_contab" name="cod_municipio_contab" class="form-control"  placeholder="Código de 7 digitos , Somente Numeros..." maxlength="7" >

        	</div>

        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">CPF contador</label>
            <div class="col-md-7">
                <input type="number" id="cpf_contador" name="cpf_contador" class="form-control"  placeholder="Somente Numeros..."  >

            </div>

        </div>


        <div class="form-group">
            <label class="col-md-4 control-label">CRC contador</label>
            <div class="col-md-7">
                <input type="text" id="crc_contador" name="crc_contador" class="form-control"  placeholder="Inscrição Conselho Regional de Contabilidade.." maxlength="15" >

            </div>

        </div>

        <div>
        	<br>
        	<label><strong><br>Regimes de Apuração da Contribuição Social e de Apropriação de Crédito</strong></label>
        </div>

        <div class="form-group">
        	<div class="col-md-12">

        		<label class="col-md-4 control-label" style="margin-left: -15px;">Código Indicador Tributario:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        		<input type="radio" name="indicador_tributario" value="1" checked />Regime Nao-Cumulativo
        		&nbsp;&nbsp;<input type="radio" name="indicador_tributario" value="2"  />Regime Cumulativo
        		&nbsp;&nbsp;<input type="radio" name="indicador_tributario" value="3" />Regime Nao-Cumulativo e Cumulativo

        	</div>
        </div>

        <div class="form-group">
        	<div class="col-md-12">
        		<label class="col-md-4 control-label" style="margin-left: -15px;">Metodo apropriaçao credito comuns:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        		<input type="radio" name="indicador_apropriacao" value="1" checked >Apropriaçao Direta 
        		&nbsp;&nbsp;<input type="radio" name="indicador_apropriacao" value="2" />Rateio Proporcional(Receita Bruta)

        	</div>
        </div>


        <div class="form-group">
        	<div class="col-md-12">
        		<label class="col-md-4 control-label" style="margin-left: -15px;">Contribuição Apurada Periodo:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        		<input type="radio" name="apuracao_contribuicao" value="1" checked >Exclusivamente a Aliquota Básica
        		&nbsp;&nbsp;<input type="radio" name="apuracao_contribuicao" value="2" />Aliquotas Especificas (Diferenciadas e/ou por Unidade de Medida de Produto)

        	</div>
        </div>

        <div>
        	<br>
        	<label><strong><br>Regime de Apuraçao da Contribuição Previdenciaria Sobre a Receita Bruta :</strong></label>
        </div>

        <div class="form-group">
        	<div class="col-md-12">
        		<label class="col-md-4 control-label" style="margin-left: -15px;" >Indicador Incidência Tributária Periodo </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        		<input type="radio" name="incidencia_tributaria" value="1" checked >Com Base na Receita Bruta
        		&nbsp;&nbsp;<input type="radio" name="incidencia_tributaria" value="2" />Com Base na Receita Bruta e nas Remunerações Pagas

        	</div>
        </div>

        <div>
            <br>
            <label><strong><br>Regime de Apuração da Contribuição Social e de Apropriação de Crédito</strong></label>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label class="col-md-4 control-label" style="margin-left: -15px;" >Indicador Incidência Tributária Periodo </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="apropriacao_credito" value="2" checked="" />Incidência exclusivamente no Regime Cumulativo
                &nbsp;&nbsp;<input type="radio" name="apropriacao_credito" value="1" />Incidência exclusivamente no Regime Não Cumulativo

            </div>
        </div>





  <!--       <div class="form-group">
            <label class="col-md-4 control-label">PIS</label>
            <div class="col-md-7">
                <input type="text" id="pis" name="pis" class="form-control"  value="0,6500" >

            </div>

        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">CONFIS</label>
            <div class="col-md-7">
                <input type="text" id="cofins" name="cofins" class="form-control" value="3,0000" >

            </div>

        </div>

    -->



<!--         <div class="form-group">
        	<label class="col-md-4 control-label" >Valor Receita Bruta (Pessoa Juridica) Periodo</label>
        	<div class="col-md-7">
        		<input type="Text" id="valor_rb_pj" name="valor_receitabruta_pj" class="form-control"  placeholder="Ex 0,00" size="12" onKeyUp="mascaraMoeda(this, event)" value="" >

        	</div>
        </div>
    -->

    <div style="float: flex; margin-top: 6%;">        

       <p class="text-right m-b-0">

          <input type="submit" value="Cadastrar" class="btn btn-primary">
      </p>
  </div>


</form>

<!-- 
#######################################################################################
#######################################################################################




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
