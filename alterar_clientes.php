<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

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
       <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />

    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script> 
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <!-- ================== END BASE JS ================== -->
  <style type="text/css">
        
        /* Esconde o input */
        input[type='file'] {
        display: none
}

        /* Aparência que terá o seletor de arquivo */
        #sel_arquivo {
            background-color: #3498db;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            margin: 10px;
            padding: 6px 20px
}
    </style>


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
		
<?php
            $idcliente = $_GET["idcliente"];

                      include "conexao.php";
                $query_amigo = "SELECT * FROM cliente
                WHERE idcliente = $idcliente";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
$nome_cli            = $buscar_amigo["nome_cli"];
$cpf_cli             = $buscar_amigo["cpf_cli"];
$rg_cli              = $buscar_amigo["rg_cli"];
$estadocivil_cli     = $buscar_amigo["estadocivil_cli"];
$nacionalidade_cli   = $buscar_amigo["nacionalidade_cli"];
$profissao_cli       = $buscar_amigo["profissao_cli"];
$nascimento_cli      = $buscar_amigo["nascimento_cli"];
$email_cli           = $buscar_amigo["email_cli"];
$cidade_cli          = $buscar_amigo["cidade_cli"];
$endereco_cli        = $buscar_amigo["endereco_cli"];
$numero_cli          = $buscar_amigo["numero_cli"];
$complemento_cli     = $buscar_amigo["complemento_cli"];
$bairro_cli          = $buscar_amigo["bairro_cli"];
$cep_cli             = $buscar_amigo["cep_cli"];
$telefone1_cli       = $buscar_amigo["telefone1_cli"];
$telefone2_cli       = $buscar_amigo["telefone2_cli"];
$telefone3_cli       = $buscar_amigo["telefone3_cli"];
$estado_cli          = $buscar_amigo["estado_cli"];
$senha_cli_cad       = $buscar_amigo["senha"];
$idgrupo_busca       = $buscar_amigo["idgrupo"];

$imob_id             = $buscar_amigo["imob_id"];
$creci               = $buscar_amigo["creci"];
$fisico_juridico     = $buscar_amigo["fisico_juridico"];
$insc_municipal      = $buscar_amigo["insc_municipal"];

$cadastrado_por      = $buscar_amigo["cadastrado_por"];
$data_cadastro       = $buscar_amigo["data_cadastro"];
$alterado_por        = $buscar_amigo["alterado_por"];
$data_alterado       = $buscar_amigo["data_alterado"];

$categoria_cliente   = $buscar_amigo["categoria_cliente"];
$obs_cli             = $buscar_amigo["obs_cli"];

$cargo               = $buscar_amigo["cargo"];
$salario_base        = $buscar_amigo["salario_base"];
$data_contratacao    = $buscar_amigo["data_contratacao"];
$data_demissao       = $buscar_amigo["data_demissao"];
$renda_total         = $buscar_amigo["renda_total"];



        }


  function tem_contrato($idcliente)
{

    include "conexao.php";
    $query_amigo = "SELECT SUM(idparcelas) as TOTAL FROM parcelas                     
                    where cliente_id_novo = $idcliente";

    $executa_query = mysqli_query ($db, $query_amigo);
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
        $idparcelas             = $buscar_amigo["TOTAL"];

        

        }     
           return $idparcelas; 
             

}
      
function verifica_tipo_user($idcliente, $idtipo){
    

                
                include "conexao.php";
                $query_amigo = "SELECT * FROM cliente_tipo
                                WHERE idcliente = $idcliente AND idtipo = $idtipo";



                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar tipo");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcliente_tipo  = $buscar_amigo['idcliente_tipo'];

         }
         return $idcliente_tipo;


}
function carrega_tipo($idcliente){
                include "conexao.php";
                $query_amigo = "SELECT * FROM cliente_tipo
                                WHERE idcliente = $idcliente";



                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar tipo");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcliente_tipo  = $buscar_amigo['idcliente_tipo'];


}
return $idcliente_tipo;
}

function consulta_conjuge($idcliente){
                include "conexao.php";
                $query_amigo = "SELECT * FROM conjuge
                                INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                                WHERE cliente_idcliente = $idcliente";


                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar tipo");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idconjuge  = $buscar_amigo['conjuge_idconjuge'];


}

return $idconjuge;
}

function dados_cliente($idcliente){
                include "conexao.php";
                $query_amigo = "SELECT * FROM cliente
                                WHERE idcliente = $idcliente";


                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar tipo");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $nome_cli  = $buscar_amigo['nome_cli'];


}

return $nome_cli;
}

$consulta_conjuge = consulta_conjuge($idcliente);


                    
             ?>
             <form id="verifica" name="verifica">
  <input type="hidden" class="form-control" value="<?php echo $fisico_juridico ?>" id="pessoa" name="pessoa"  />
</form>

 
		<!-- begin #content -->
		<div id="content" class="content">
			    <ol class="breadcrumb pull-right">

                 <li><a href="historico_alteracoes_cliente.php?idcliente=<?php echo $idcliente ?>"><span class="label label-primary" style="font-size:100% !important">Historico de Alterações</span></a></li>


                <?php if (in_array('46', $idrota)) { ?>
                <li><a href="vincular_cadastro.php?idcliente=<?php echo $idcliente ?>"><span class="label label-primary" style="font-size:100% !important">Vincular Cadastro</span></a></li>
                <?php } ?>
            </ol>
			<!-- begin page-header -->
			<h1 class="page-header">Ver / Alterar Cliente</h1>
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
                            <h4 class="panel-title">Informações</h4>
               
                        </div>
                        <div class="panel-body">
                            <form action="recebe_alterar_cliente.php" method="POST" data-parsley-validate="true" name="form_wizard" enctype="multipart/form-data">
                                <div id="wizard">
                                    <ol>
                                        <li>
                                            Informáções Básicas 
                                            <small></small>
                                        </li>
                                        <li>
                                            Informações Pessoais
                                            <small> </small>
                                        </li>
                                        <li>
                                            Endereço
                                            <small></small>
                                        </li>
                                         
                                       
                                       
                                    </ol>
                                    <!-- begin wizard step-1 -->
                                    <div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">Informações Básicas</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group block1">
                                                     <label id="label_nome" style="display:block">Nome</label>
                                                        <label id="label_razao" style="display:none">Razão Social</label>
                                    <input type="text" class="form-control" value="<?php echo $nome_cli ?>" name="nome_cli" placeholder="Nome" />
                                    <input type="hidden" class="form-control" value="<?php echo $idcliente ?>" name="idcliente"  />

                                    <input type="hidden" class="form-control" value="<?php echo $imobiliaria_idimobiliaria ?>" name="alterado_por"  />



                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                        <input type="text" class="form-control" value="<?php echo $email_cli ?>"  name="email_cli" placeholder="Email" />
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Celular</label>
                                        <input type="text" class="form-control" value="<?php echo $telefone1_cli ?>" id="celular1" name="telefone1_cli" placeholder="Celular(1)" />
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                            </div>
                                            <!-- end row -->

                                               <div class="row">
                                                <!-- begin col-4 -->
                                                      <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Celular</label>
                                                         <input type="text" class="form-control" value="<?php echo $telefone3_cli ?>" id="celular2" name="telefone3_cli" placeholder="Telefone2" />
                                                    </div>
                                                </div>



                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Telefone </label>
                                        <input type="text" class="form-control" value="<?php echo $telefone2_cli ?>" id="masked-input-phone2" name="telefone2_cli" placeholder="Telefone2" />
                                                    </div>
                                                </div>
                                               
                                                    <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Senha:</label>
                                                <input type="password" class="form-control"  name="senha" value="<?php echo $senha_cli_cad ?>" />
                                                    </div>
                                                </div>


                                               
                                            </div>






                                         <div class="row">
                                                <!-- begin col-4 -->
   <div class="col-md-4">
                                                    <div class="form-group block1">
                                                        <label>Grupo de Acesso:</label><br>
                                                        <select name="idgrupo" class="form-control">
                                                        <option value="">Selecione</option>
                                                       <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM grupo
                                                  order by titulo_grupo Asc") or die ("Erro ao listar grupo dos clientes, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idgrupo       = $buscar_slide["idgrupo"];
             $titulo_grupo  = $buscar_slide["titulo_grupo"];
           
          

                    ?> 
                        <option value="<?php echo $idgrupo ?>" <?php if($idgrupo_busca == $idgrupo){ ?> selected <?php } ?>><?php echo $titulo_grupo ?></option>
                                                       
                                                       <?php } ?> 
                                                       </select>
                                                    </div>
                                                </div>






                                                 


                <div class="col-md-4" id="corretor32">
                                        <div class="form-group">
                                            <label>Imobiliaria:</label>
                                             <select class="default-select2 form-control" name="imobiliaria_id">
                                        <option value="">Escolha</option>
                                          <?php

                            include "conexao.php";
                                    
                            $query_amigo = "SELECT * FROM cliente
                            INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                            WHERE idtipo = 11 order by nome_cli Asc";

                            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                                
                                    $idclientee             = $buscar_amigo['idcliente'];
                                    $nome_clie              = $buscar_amigo["nome_cli"];
                                    // $cpf_cli              = $buscar_amigo["cpf_cli"];
                                    
        
        
        ?>
                                      <option value="<?php echo $idclientee ?>"> <?php echo $nome_clie ?>
                                      </option>
                                      <?php } ?>
                    
                                           
                                        </select>
                                        </div>
                                    </div>


                                                        </div><br>



                                <div class="row">


                                     <div class="col-md-4" id="creci32" >
                                        <div class="form-group">
                                            <label>CRECI:</label>
                                            <input type="text" name="creci" value="<?php echo $creci ?>" class="form-control">
                                          
                                        </div>
                                    </div>



                                                        <div class="col-md-4" id="pperfil">
                                                    <div class="form-group">
                                                        <label>Foto Perfil</label><br>
                                                      <label id="sel_arquivo" for='selecao-arquivo' style="margin-top: -2px; margin-left: -2px; padding: 8px; width: 100%; text-align: center">Selecionar um arquivo &#187;</label>
                                                    <input id='selecao-arquivo' name='perfil_foto' type='file'>
                                                     <span id='file-name'></span>
                                                        </div>
                                                    </div>

</div>



                                            <div class="row" style="width: auto;">
                                                <!-- begin col-4 -->
                                                 


                                                  <div class="col-md-4" style="width: 90%;">
                                                    <div class="form-group">
                                                        <label>Tipo de Cadastro:</label><br>
                                                        <table style="align-self: center;">
                                                            <tr >
                                              <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM tipo_cliente
                                                  order by idtipo desc") or die ("Erro ao listar tipo dos clientes, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
                $descricao_tipo      = $buscar_slide["descricao_tipo"];
                $idtipo              = $buscar_slide["idtipo"];
           
                $verifica = verifica_tipo_user($idcliente, $idtipo);

                    ?>
                
                        <td style="width: min-content;">
                            <div>
                                <label style="align-self: left; border-style: outset; margin: 5px;">
                                    <input type="checkbox" name="tipo_cliente[]" data-style="slow"  id="<?php echo $idtipo; ?>" data-size="normal" data-toggle="toggle" value="<?php echo $idtipo; ?>" style="text-align: left;"
                                    <?php if($verifica > 0){ ?> checked  <?php }  ?>> <b><?php echo $descricao_tipo; ?></b>
                                </label>
                            </div>
                        </td>
                                                        
        <?php } ?> 

                                                        
        </div>
        </div>
                        
                    </tr>
                </table>
                            <div class="row" style="align-self: center;">


                                <div class="col-md-4">
                                    <br>
                                    <br>
                                        <b><div class="form-group">
                                            <label>Cadastrado Por:</label>

                                          <?php 
                                            $cadastrado_por = dados_cliente($cadastrado_por);
                                            echo $cadastrado_por;

                                          ?> / <?php echo $data_cadastro ?>
                                          
                                        </div></b>
                                    </div>

                                    <?php if($alterado_por != 0){ ?>
                                       <div class="col-md-4"  >
                                        <div class="form-group">
                                            <label>Editado Por:</label>
                                           <?php 
                                            $alterado_por = dados_cliente($alterado_por);
                                            echo $alterado_por;

                                          ?> / <?php echo $data_alterado ?>
                                          
                                        </div>
                                    </div>
                                    <?php } ?>


                                            </div>
                            </div>



                                        </fieldset>
                                    </div>
                                    <!-- end wizard step-1 -->
                                 
          


                              

                                    <!-- begin wizard step-2 -->
                                    <div class="wizard-step-2">
                                        <fieldset>
                                            <legend class="pull-left width-full">Informações Pessoais</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                     <label id="label_cpf" style="display:block">CPF</label>
                                                    <label id="label_cnpj" style="display:none">CNPJ</label>
                                        <input type="text" class="form-control" value="<?php echo $cpf_cli ?>" name="cpf_cli" placeholder="CPF" />

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                         <label id="label_rg" style="display:block">RG</label>
                                                    <label id="label_insc_esta" style="display:none">Inscrição Estadual</label>
                                        <input type="text" class="form-control" value="<?php echo $rg_cli ?>" name="rg_cli" placeholder="Rg" />
                                                    </div>
                                                </div>

                                                   <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                         <label id="label_rg" style="display:block">Renda Familiar</label>
                                                    <label id="label_insc_esta" style="display:none">Renda Familiar</label>
                                        <input type="text" class="form-control" value="<?php echo $renda_total ?>" id="renda_total" name="renda_total"  />
                                                    </div>
                                                </div>

                                                    <div class="col-md-4" id="label_insc_muni" style="display:none">
                                                    <div class="form-group">
                                                        <label>Inscrição Municipal</label>
                                                        <input type="text" class="form-control" name="insc_municipal" value="<?php echo $insc_municipal ?>" />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->

                                             <div class="row" id="label_nascimento" style="display:block">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Data de Nascimento: </label>
                                        <input type="text" class="form-control" value="<?php echo $nascimento_cli ?>" name="nascimento_cli" id="masked-input-date" />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                              <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nacionalidade</label>
                                                          <input type="text" class="form-control" name="nacionalidade_cli" placeholder="Nacionalidade" value="<?php echo $nacionalidade_cli ?>" />
                                                      
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>

                                               <div class="row" id="label_estado_civil" style="display:block">
                                                <!-- begin col-6 -->
                                                   <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Estado Civil</label>
 <select class="form-control" name="estadocivil_cli">
                                            <option selected="selected" value="-1">Selecione</option>

        <option value="Casado(a)-Comunhão Universal (Antes lei 6.515/77)"

         <?php if($estadocivil_cli == 'Casado(a)-Comunhão Universal (Antes lei 6.515/77)') { ?> selected <?php } ?>
         >Casado(a)-Comunhão Universal (Antes lei 6.515/77)</option>

        <option value="Casado(a)-Comunhão Universal (Apos lei 6.515/77)"

        <?php if($estadocivil_cli == 'Casado(a)-Comunhão Universal (Apos lei 6.515/77)') { ?> selected <?php } ?>
        >Casado(a)-Comunhão Universal (Apos lei 6.515/77)</option>

        <option value="Casado(a)-Comunhão Parcial"

        <?php if($estadocivil_cli == 'Casado(a)-Comunhão Parcial'){ ?> selected <?php } ?>
        >Casado(a)-Comunhão Parcial</option>


        <option value="Casado(a)-Separação Convencional de Bens"

        <?php if($estadocivil_cli == 'Casado(a)-Separação Convencional de Bens') { ?> selected <?php } ?>
        >Casado(a)-Separação Convencional de Bens</option>


        <option value="Divorciado(a)"

        <?php if($estadocivil_cli == 'Divorciado(a)'){ ?> selected <?php } ?>
        >Divorciado(a)</option>


        <option value="Separado(a) Judicialmente"

        <?php if($estadocivil_cli == 'Separado(a) Judicialmente') { ?> selected <?php } ?>
        >Separado(a) Judicialmente</option>


        <option value="Solteiro(a)"

        <?php if($estadocivil_cli == 'Solteiro(a)'){ ?> selected <?php } ?>
        >Solteiro(a)</option>


        <option value="União Estável"

        <?php if($estadocivil_cli =='União Estável'){ ?> selected <?php } ?>
        >União Estável</option>


        <option value="Viúvo(a)"
        <?php if($estadocivil_cli == 'Viúvo(a)') { ?> selected <?php } ?>
        >Viúvo(a)</option>
                                        </select>                                                    </div>
                                                </div>
                                               
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->

                                                  <div class="col-md-4">
                                                    <div class="form-group block1">
                                                        <label>Conjuge</label>
                                   <select class="form-control" name="conjuge_idconjuge">
                        <option value="">Escolha</option>
                                                       <?php 

                include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT cliente.nome_cli, cliente.idcliente FROM cliente
                                                 INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente
                                                  where idtipo = 6") or die ("Erro ao listar Conjuge do cliente, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $nome_cli_con      = $buscar_slide["nome_cli"];
             $idcliente_con     = $buscar_slide["idcliente"];
           
          

                    ?> 
                                            <option value="<?php echo $idcliente_con ?>"

                                            <?php if($consulta_conjuge == $idcliente_con){ ?> selected <?php } ?>

                                            ><?php echo $nome_cli_con ?></option>
                                                       
                                                       <?php } ?> 
                                                       </select>
                                                                          </div>
                                                </div> 
                                                <!-- end col-6 -->
                                            </div>

                                                <div class="row" id="label_profissao" style="display:block">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Profissão</label>
                                        <input type="text" class="form-control" value="<?php echo $profissao_cli ?>"  name="profissao_cli" placeholder="Profissão" />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->

                                                   <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Observação</label>
                                        <textarea name="obs_cli" class="form-control"><?php echo $obs_cli ?></textarea>
                                                    </div>
                                                </div>
                                                <!-- begin col-6 -->
                                            
                                            </div>

                                        </fieldset>
                                    </div>
                                    <!-- end wizard step-2 -->
                                    <!-- begin wizard step-3 -->
                                    <div class="wizard-step-3">
                                        <fieldset>
                                            <legend class="pull-left width-full">Endereço</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>CEP</label>
                                                        <div class="controls">
                                        <input type="text" class="form-control" value="<?php echo $cep_cli ?>" id="cep"  name="cep_cli" placeholder="Cep" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Rua</label>
                                                        <div class="controls">
                                        <input type="text" class="form-control" value="<?php echo $endereco_cli ?>" id="rua"   name="endereco_cli" placeholder="Rua" />
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
                                             
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                           
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Numero</label>
                                                        <div class="controls">
                                        <input type="text" class="form-control" value="<?php echo $numero_cli ?>" id="numero"  name="numero_cli" placeholder="Numero" />

                                                        </div>
                                                    </div>
                                                </div>


                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Complemento</label>
                                                        <div class="controls">
                                        <input type="text" class="form-control" value="<?php echo $complemento_cli ?>" id="numero"  name="complemento_cli"  />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                               
                                                <!-- end col-6 -->
                                            </div>

                                             <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Bairro</label>
                                                        <div class="controls">
                                        <input type="text" class="form-control" value="<?php echo $bairro_cli ?>" id="bairro"  name="bairro_cli" placeholder="Bairro" />
                 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cidade</label>
                                                        <div class="controls">
                                        <input type="text" class="form-control" value="<?php echo $cidade_cli ?>" id="cidade"  name="cidade_cli" placeholder="Cidade" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Estado</label>
                                                        <div class="controls">
                                        <input type="text" class="form-control" value="<?php echo $estado_cli ?>" id="estado"  name="estado_cli" placeholder="Estadp" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>

                                             
                                        </fieldset>
                                        <?php if (in_array('44', $idrota)) { 
                                            $tem_contrato = tem_contrato($idcliente);
                                            if($tem_contrato == null or $idgrupo_acesso == 5){
                                        ?>
                                          <p><input type="submit" class="btn btn-success btn-lg" role="button" value="Alterar" /></p>
                                          <?php } } ?>

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
 <script type="text/javascript">

  var id          = document.verifica.pessoa.value

      if (id=="1") 
  {
    document.getElementById('label_nome').style.display        = "block"
    document.getElementById('label_cpf').style.display         = "block"
    document.getElementById('label_rg').style.display          = "block"
    document.getElementById('label_nascimento').style.display  = "block"
    document.getElementById('label_estado_civil').style.display= "block"
    document.getElementById('label_profissao').style.display   = "block"

    document.getElementById('label_razao').style.display      = "none"
    document.getElementById('label_cnpj').style.display       = "none"
    document.getElementById('label_insc_esta').style.display  = "none"
    document.getElementById('label_insc_muni').style.display  = "none"



  }

   if (id=="2") 
  {

    document.getElementById('label_razao').style.display      = "block"
    document.getElementById('label_razao').style.display      = "block"
    document.getElementById('label_cnpj').style.display       = "block"
    document.getElementById('label_insc_esta').style.display  = "block"
    document.getElementById('label_insc_muni').style.display  = "block"

    document.getElementById('label_nome').style.display        = "none"
    document.getElementById('label_cpf').style.display         = "none"
    document.getElementById('label_rg').style.display          = "none"
    document.getElementById('label_nascimento').style.display  = "none"
    document.getElementById('label_estado_civil').style.display= "none"
    document.getElementById('label_profissao').style.display   = "none"



  }
  </script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
        <script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

       <script type="text/javascript">
$(function(){
$("#renda_total").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
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
        <script src="https://immobilebusiness.com.br/admin/assets/plugins/parsley/dist/parsley.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/form-wizards-validation.demo.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script type='text/javascript' src='cep.js'></script>
    <script type='text/javascript' src='produtos.js'></script>
    <script type='text/javascript' src='lote.js'></script>
    <script type='text/javascript' src='medidas.js'></script>
    <script type='text/javascript' src='cep.js'></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
       <script type="text/javascript">
           var $input    = document.getElementById('selecao-arquivo'),
              $label = document.getElementById('sel_arquivo');
            $fileName = document.getElementById('file-name');
            $input.addEventListener('change', function(){
            $label.textContent = this.value;
                     //  console.log($fileName);

            });
    </script>

    <script>

        $(document).ready(function() {
        
 
            App.init();
            FormWizardValidation.init();
            TableManageButtons.init();
            FormPlugins.init();
                $("#celular1").mask("(99) 99999-9999").val("<?php echo $telefone1_cli ?>");
                $("#celular2").mask("(99) 99999-9999").val("<?php echo $telefone3_cli ?>");

        });
    </script>

</body>

</html>
