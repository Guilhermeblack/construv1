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
        <script type="text/javascript">
function dimob(){



    document.getElementById('tem_dimob').style.display     = "block"
    document.getElementById('form_dimob').disabled         = ""
   
  }
    </script>
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
		
			<!-- begin page-header -->
			<h1 class="page-header"><?php 

            if(isset($_GET["venda"])){
                echo "Erro: Este Imovel já está com o status de Alugado!.";
            }

            ?>
            
                        
            
            Locação de Imóvel</h1>
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
                            <h4 class="panel-title">Gerar Contrato</h4>
                            
                        </div>
                        <div class="panel-body">
                            <form action="recebe_locacao.php" method="POST" data-parsley-validate="true" name="form_wizard">
                                <div id="wizard">
                                    <ol>
                                        <li>
                                            Identificação
                                            <small></small>
                                        </li>
                                        <li>
                                            Contrato
                                            <small> </small>
                                        </li>
                                         <li>
                                            Adicionais
                                            <small> </small>
                                        </li>
                                        <li>
                                            Garantia
                                            <small></small>
                                        </li>
                                         <li>
                                            Seguro
                                            <small></small>
                                        </li>
                                         <li>
                                            Administração
                                            <small></small>
                                        </li>
                                       
                                       
                                    </ol>
                                    <!-- begin wizard step-1 -->
                                    <div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">Identificação</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group block1">
                                                        <label>Locatário:</label>
                                                             <select class="default-select2 form-control" name="cliente_idcliente" required="">
                                        <option value="">Escolha</option>
                                          <?php

                      include "conexao.php";
                if($idgrupo_acesso == 5){   
                $query_amigo = "SELECT * FROM cliente
                                INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                where cliente_tipo.idtipo = 5  order by nome_cli Asc";
                }else{
                $query_amigo = "SELECT * FROM cliente
                                INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                INNER JOIN vinculo ON vinculo.idcliente = cliente.idcliente
                                where cliente_tipo.idtipo = 5 AND idcorretor = $imobiliaria_idimobiliaria order by nome_cli Asc";

                }                

                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar Locatário");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                $idcliente             = $buscar_amigo['idcliente'];
                $nome_cli              = $buscar_amigo["nome_cli"];
                $cpf_cli               = $buscar_amigo["cpf_cli"];
        
             
            
             ?>
               <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
                    <?php } ?>
                    
                                           
                                        </select>

                <input type="hidden" name="cadastrado_por" value="<?php echo $imobiliaria_idimobiliaria ?>">
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Fiadores:</label>
                                                           <select multiple="multiple" name="fiador[]" id="select">
                                       
                                          <?php

                      include "conexao.php";
                if($idgrupo_acesso == 5){   
                    $query_amigo = "SELECT * FROM cliente
                                    INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                    INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                    where cliente_tipo.idtipo = 3 order by nome_cli Asc";
                }else{
                    $query_amigo = "SELECT * FROM cliente
                                    INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente 
                                    INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo 
                                    INNER JOIN vinculo ON vinculo.idcliente = cliente.idcliente
                                    where cliente_tipo.idtipo = 3 AND idcorretor = $imobiliaria_idimobiliaria order by nome_cli Asc";

                }                    

                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar Fiadores");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcliente             = $buscar_amigo['idcliente'];
             $nome_cli              = $buscar_amigo["nome_cli"];
             $cpf_cli               = $buscar_amigo["cpf_cli"];
        
             
            
             ?>
               <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
                    <?php } ?>
                    
                                           
                                        </select>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Imóvel</label>
                                                          <select class="form-control" name="imovel_idimovel" id="imovel_idimovel" required="">
                                        <option value="">Escolha</option>
                                         <?php

                      include "conexao.php";
                $query_amigo = "SELECT * FROM imovel where finalidade ='Aluguel' order by idimovel Asc";
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idimovel       = $buscar_amigo['idimovel'];
             $ref            = $buscar_amigo["ref"];
             $endereco       = $buscar_amigo["endereco"];
             $numero         = $buscar_amigo["numero"];
        
             
            
             ?>
                    <option value="<?php echo "$idimovel" ?>"> Ref:<?php echo " $idimovel"." End. ".$endereco.", ".$numero ?> </option>
                    <?php } ?>

                    
                                           
                                        </select>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                            </div>
                                            <!-- end row -->
                                               <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Conta Corrente</label>
                                          <select class="form-control" name="contacorrente" required="">
                                        <option value="">Escolha</option>
                                         <?php

                      include "conexao.php";
                $query_conta = "SELECT * FROM contacorrente";
                $executa_conta = mysqli_query ($db,$query_conta) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_conta = mysqli_fetch_assoc($executa_conta)) {//--verifica se são amigos

             $idcontacorrente       = $buscar_conta['idcontacorrente'];          
             $agencia       = $buscar_conta['agencia'];
             $conta         = $buscar_conta["conta"];
             $dig_conta     = $buscar_conta["dig_conta"];
             $banco_cedente = $buscar_conta["banco"];

             
            
             ?>
                    <option value="<?php echo "$idcontacorrente" ?>"> <?php echo "$banco_cedente "."$agencia "."/ "."$conta"." - "."$dig_conta" ?> </option>
                    <?php } ?>

                    
                                           
                                        </select>

                                                    </div>
                                                </div>
                                                
                                                <!-- begin col-6 -->
                                              
                                                <!-- end col-6 -->
                                            </div>
                                               
                                        </fieldset>
                                    </div>
                                    <!-- end wizard step-1 -->
                                 
          


                              

                                    <!-- begin wizard step-2 -->
                                    <div class="wizard-step-2">
                                        <fieldset>
                                            <legend class="pull-left width-full">Contrato:</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Valor Aluguel</label>
                                        <input type="text" class="form-control" name="valor_aluguel" id="valor_aluguel2" required=""  />

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Prazo do Contrato:</label>
                                           <input type="text" class="form-control" name="prazo_contrato" id="prazo_contrato" required=""  placeholder="Prazo em meses" />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Data 1º Parcela</label>
                                                   <input type="date" class="form-control" name="primeira_parcela"  required=""  placeholder="Data da primeira parcela" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->

                                               <div class="row">
                            
                                              
                                                <!-- end col-6 -->
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>DIMOB</label>
     <input type="checkbox" name="lancar_dimob" value="1" onclick="dimob()" />
                                                    </div>
                                                </div>


                                                   <div class="col-md-6" style="display: none" id="tem_dimob">
                                                    <div class="form-group">
                                                        <label>DIMOB Municipio</label>
                                                          <select class="default-select2 form-control" name="codigo_municipio" style="width:100% !important" id="form_dimob" disabled="true">
                                        <option value="">Escolha</option>
                                         <?php

                      include "conexao.php";
                $query_amigo = "SELECT * FROM codigo_municipio";
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $codigo       = $buscar_amigo['codigo'];
             $descricao    = $buscar_amigo["descricao"];
           
        
             
            
             ?>
                    <option value="<?php echo "$codigo" ?>"><?php echo "$descricao" ?> </option>
                    <?php } ?>

                    
                                           
                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->

                                            

                                               
                                        </fieldset>
                                    </div>
                                    <!-- end wizard step-2 -->
                                    <!-- begin wizard step-3 -->
                                    <div class="wizard-step-3">
                                        <fieldset>
                                            <legend class="pull-left width-full">Adicionais:</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>IPTU (valor total)</label>
                                                        <div class="controls">
                              <input type="text" class="form-control" name="iptu" id="valor_iptu" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                             
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Quantidade de Parcelas</label>
                                                        <div class="controls">
                               <input type="text" class="form-control" name="qtd_parcelas_iptu" id="qtd_parcelas_iptu"  />
                                                        </div>
                                                    </div>
                                                </div>

                                                   <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Data Vencimento IPTU</label>
                                                        <div class="controls">
                               <input type="date" class="form-control" name="vencimento_iptu" />
                                                        </div>
                                                    </div>
                                                </div>
                                       
                                            </div>
                                            <!-- end row -->


                                                <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Condomínio</label>
                                                        <div class="controls">
                              <input type="text" class="form-control" name="condominio" id="valor_condominio" placeholder="Valor do Condominio" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Quantidade de Parcelas</label>
                                                        <div class="controls">
                               <input type="text" class="form-control" name="qtd_parcelas_condominio" id="qtd_parcelas_condominio" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Data Vencimento Condomínio</label>
                                                        <div class="controls">
                               <input type="date" class="form-control" name="vencimento_condominio" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                       
                                            </div>

                                              <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Administrar IPTU</label>
                                                        <div class="controls">
                              <input type="checkbox" name="lancar_iptu" value="1" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Administrar Condominio</label>
                                                        <div class="controls">
                              <input type="checkbox" name="lancar_condominio" value="1" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- begin col-4 -->
                                              
                                                
                                       
                                            </div>

                                               <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Dimob IPTU</label>
                                                        <div class="controls">
                              <input type="checkbox" name="dimob_iptu" value="1" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Dimob Condominio</label>
                                                        <div class="controls">
                              <input type="checkbox" name="dimob_condominio" value="1" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- begin col-4 -->
                                              
                                                
                                       
                                            </div>
                                             
                                        </fieldset>
                                        
                                    </div>
                            
                                   <div class="wizard-step-4">
                                        <fieldset>
                                            <legend class="pull-left width-full">Garantia:</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Garantia Aluguel</label>
                                        <input type="text" class="form-control" name="valor_alugueis" id="valor_alugueis"  />

                                                    </div>
                                                </div>

                                                   <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Quantidade de Parcelas</label>
                                        <input type="text" class="form-control" name="qtd_parcelas_garantia_aluguel" id="qtd_parcelas_garantia_aluguel"  />

                                                    </div>
                                                </div>

                                                   <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Vencimento Garantia Aluguel</label>
                                        <input type="date" class="form-control" name="vencimento_garantia_aluguel"   />

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                              
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->
                                                <div class="row">
                                                <!-- begin col-6 -->
                                               <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Garantia Danos:</label>
                                           <input type="text" class="form-control" name="valor_danos" id="valor_danos"  />
                                                    </div>
                                                </div>

                                                   <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Quantidade de Parcelas</label>
                                        <input type="text" class="form-control" name="qtd_parcelas_garantia_danos" id="qtd_parcelas_garantia_danos"  />

                                                    </div>
                                                </div>

                                                   <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Vencimento Garantia Danos</label>
                                        <input type="date" class="form-control" name="vencimento_garantia_danos"  />

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                              
                                                <!-- end col-6 -->
                                            </div>
                                     
 
                                               
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
                                                   <input type="text" class="form-control" name="qtd_parcelas_seguro" id="qtd_parcelas_seguro"  />
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                <div class="form-group">
                                                        <label>Vencimento</label>
                                                   <input type="date" class="form-control" name="vencimento"  />
                                                    </div>
                                                    </div>
                                                <!-- end col-6 -->
                                            </div>

                                               
                                        </fieldset>
                                    </div>

                                    <div class="wizard-step-6">
                                        <fieldset>
                                            <legend class="pull-left width-full">Administração</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Taxa Administrativa (%)</label>
                                        <input type="text" class="form-control" name="taxa_administrativa"  />

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Total meses do Repasse</label>
                                                <input type="text" class="form-control" name="meses_repasse" id="meses_repasse"  />

                                                    </div>
                                                </div>
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Valor Repasse</label>
                                                <input type="text" class="form-control" name="valor_repasse" id="valor_repasse"  />

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->
                                                 <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Dia do Repasse</label>
                                        <input type="date" class="form-control" name="dia_repasse"  />

                                                    </div>
                                                </div>
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>% Juros Atraso</label>
                                        <input type="text" class="form-control" name="juros_atraso" value="<?php echo '0.033' ?>"   />

                                                    </div>
                                                </div>
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>% Multa Atraso (0.033)</label>
                                        <input type="text" class="form-control" name="multa_atraso" value="<?php echo '10.0' ?>"  />

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                             
                                                 
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->
                                           <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Indice de Reajuste</label>
 <select class="default-select2 form-control" name="indice_correcao" required="">
                                        <option value="">Escolha</option>
                                          <?php

                      include "conexao.php";
                 
                $query_indice = "SELECT * FROM indice_correcao order by idindice_correcao desc";


                $executa_indice = mysqli_query ($db, $query_indice);
                while ($buscar_indice = mysqli_fetch_assoc($executa_indice)) {//--verifica se são amigos
           
                $idindice_correcao             = $buscar_indice['idindice_correcao'];
                $descricao_indice              = $buscar_indice["descricao_indice"];
              
             
            
             ?>
               <option value="<?php echo "$idindice_correcao" ?>"> <?php echo "$descricao_indice" ?> </option>
                    <?php } ?>
                    
                                           
                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <!-- end col-6 -->
                                             
                                                 
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
$("#valor_aluguel2").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_iptu").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_condominio").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_alugueis").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })
$(function(){
$("#valor_danos").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_seguro").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#valor_repasse").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })


$(function(){
$("#prazo_contrato").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#qtd_parcelas_iptu").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#qtd_parcelas_condominio").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#qtd_parcelas_garantia_aluguel").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#qtd_parcelas_garantia_danos").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#qtd_parcelas_seguro").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
 })

$(function(){
$("#meses_repasse").maskMoney({symbol:'', 
showSymbol:true, decimal:'.', symbolStay: true});
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

    
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            FormWizardValidation.init();
   FormPlugins.init();
            TableManageButtons.init();
        });
    </script>

</body>

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/form_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:13:18 GMT -->
</html>
