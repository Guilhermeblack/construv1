<?php
//error_reporting(0);
//ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]-->


<head>
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
            padding: 6px 20px;
        }
    </style>


</head>


<script type="text/javascript">
    function ShowHideDIV(id) {

        // if (id=="8") 
        // {
        //     document.getElementById('corretor32').style.display    = "block"
        //     document.getElementById('creci32').style.display       = "block"
        // }

        if (id == "14") {
            //funcionario
            document.getElementById('func1').style.display = "block"
        }

    }


    function label(id) {


        if (id == "1") {
            document.getElementById('label_nome').style.display = "block"
            document.getElementById('label_cpf').style.display = "block"
            document.getElementById('label_rg').style.display = "block"
            document.getElementById('label_nascimento').style.display = "block"
            document.getElementById('label_estado_civil').style.display = "block"
            document.getElementById('label_profissao').style.display = "block"
            document.getElementById('masked-input-cpf').style.display = "block"
            document.getElementById('masked-input-cpf').disabled = ""


            document.getElementById('cpf_rfb').style.display = "none"
            document.getElementById('label_razao').style.display = "none"
            document.getElementById('label_cnpj').style.display = "none"
            document.getElementById('label_insc_esta').style.display = "none"
            document.getElementById('label_insc_muni').style.display = "none"
            document.getElementById('masked-input-cnpj').disabled = "disabled"
            document.getElementById('masked-input-cnpj').style.display = "none"


        }

        if (id == "2") {

            document.getElementById('label_razao').style.display = "block"
            document.getElementById('label_razao').style.display = "block"
            document.getElementById('label_cnpj').style.display = "block"
            document.getElementById('label_insc_esta').style.display = "block"
            document.getElementById('label_insc_muni').style.display = "block"
            document.getElementById('masked-input-cnpj').disabled = ""
            document.getElementById('masked-input-cnpj').style.display = "block"
            document.getElementById('cpf_rfb').style.display = "block"


            document.getElementById('label_nome').style.display = "none"
            document.getElementById('label_cpf').style.display = "none"
            document.getElementById('label_rg').style.display = "none"
            document.getElementById('label_nascimento').style.display = "none"
            document.getElementById('label_estado_civil').style.display = "none"
            document.getElementById('label_profissao').style.display = "none"
            document.getElementById('masked-input-cpf').style.display = "none"
            document.getElementById('masked-input-cpf').disabled = "disabled"

        }

    }
</script>
<script type="text/javascript">
    function validaCPF(cpf) {
        var numeros, digitos, soma, i, resultado, digitos_iguais;
        digitos_iguais = 1;
        if (cpf.length < 11)
            return false;
        for (i = 0; i < cpf.length - 1; i++)
            if (cpf.charAt(i) != cpf.charAt(i + 1)) {
                digitos_iguais = 0;
                break;
            }
        if (!digitos_iguais) {
            numeros = cpf.substring(0, 9);
            digitos = cpf.substring(9);
            soma = 0;
            for (i = 10; i > 1; i--)
                soma += numeros.charAt(10 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;
            numeros = cpf.substring(0, 10);
            soma = 0;
            for (i = 11; i > 1; i--)
                soma += numeros.charAt(11 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;
            return true;
        } else
            return false;
    }
</script>

<script type="text/javascript">
    function chamaCpf() {
        var cpf = document.getElementById('masked-input-cpf').value

        var cpf = cpf.replace(".", "")
        var cpf = cpf.replace(".", "")
        var cpf = cpf.replace(".", "")
        var cpf = cpf.replace("-", "")

        var resultado = validaCPF(cpf);

        if (resultado == false) {
            document.getElementById('masked-input-cpf').value = '';
            document.getElementById("email_cli").focus();

            alert('CPF Invalido.');

        } else {

        }


    }


    function chamaCpfconjuge() {
        var cpf = document.getElementById('masked-input-cpf_conjuge').value

        var cpf = cpf.replace(".", "")
        var cpf = cpf.replace(".", "")
        var cpf = cpf.replace(".", "")
        var cpf = cpf.replace("-", "")

        var resultado = validaCPF(cpf);

        if (resultado == false) {
            document.getElementById('masked-input-cpf_conjuge').value = '';
            document.getElementById("email_cli").focus();

            alert('CPF Invalido.');

        } else {

        }


    }
</script>
<script type="text/javascript">
    function validarCNPJ(cnpj) {

        cnpj = cnpj.replace(/[^\d]+/g, '');

        if (cnpj == '') return false;

        if (cnpj.length != 14)
            return false;

        // Elimina CNPJs invalidos conhecidos
        if (cnpj == "00000000000000" ||
            cnpj == "11111111111111" ||
            cnpj == "22222222222222" ||
            cnpj == "33333333333333" ||
            cnpj == "44444444444444" ||
            cnpj == "55555555555555" ||
            cnpj == "66666666666666" ||
            cnpj == "77777777777777" ||
            cnpj == "88888888888888" ||
            cnpj == "99999999999999")
            return false;

        // Valida DVs
        tamanho = cnpj.length - 2
        numeros = cnpj.substring(0, tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;

        tamanho = tamanho + 1;
        numeros = cnpj.substring(0, tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;

        return true;

    }
</script>
<script type="text/javascript">
    function chamaCnpj() {
        var cnpj = document.getElementById('masked-input-cnpj').value

        var cnpj = cnpj.replace(".", "")
        var cnpj = cnpj.replace(".", "")
        var cnpj = cnpj.replace(".", "")
        var cnpj = cnpj.replace("-", "")

        var resultado = validarCNPJ(cnpj);

        if (resultado == false) {
            document.getElementById('masked-input-cnpj').value = '';
            document.getElementById("email_cli").focus();

            alert('CNPJ Invalido.');

        } else {

        }


    }
</script>

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
            <h1 class="page-header">Cadastro Geral</h1>
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
                            <form action="recebe_cliente.php" method="POST" data-parsley-validate="true" name="form_wizard" enctype="multipart/form-data">
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

                                        <input type="hidden" name="grupo_acesso_logado" value="<?php echo $idgrupo_acesso ?>">


                                        <fieldset>
                                            <legend class="pull-left width-full">Informações Básicas</legend>
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Pessoa:</label>
                                                        <input type="radio" name="pessoa" value="1" checked onclick="label(1)">Física
                                                        <input type="radio" name="pessoa" value="2" onclick="label(2)" />Jurídica

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->



                                                <!-- end col-6 -->
                                            </div>
                                            <!-- begin row -->


                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label id="label_cpf" style="display:block">CPF</label>
                                                        <label id="label_cnpj" style="display:none">CNPJ</label>

                                                        <input type="text" class="form-control" id="masked-input-cpf" name="cpf_cli" style="display:block" onblur="chamaCpf()" value="">

                                                        <input type="text" class="form-control" id="masked-input-cnpj" name="cpf_cli" style="display:none" disabled="disabled" value="" onblur="chamaCnpj()">

                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label id="label_rg" style="display:block">RG</label>
                                                        <label id="label_insc_esta" style="display:none">Inscrição Estadual</label>
                                                        <input type="text" class="form-control" name="rg_cli" />
                                                    </div>
                                                </div>

                                                <div class="col-md-4" id="label_insc_muni" style="display:none">
                                                    <div class="form-group">
                                                        <label>Inscrição Municipal</label>
                                                        <input type="text" class="form-control" name="insc_municipal" placeholder="Inscrição Municipal" />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->

                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group block1">
                                                        <label id="label_nome" style="display:block">Nome</label>
                                                        <label id="label_razao" style="display:none">Razão Social</label>
                                                        <input type="text" class="form-control" name="nome_cli" placeholder="Nome" />

                                                        <input type="hidden" name="cadastrado_por" value="<?php echo $imobiliaria_idimobiliaria; ?>">
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" id="email_cli" name="email_cli" placeholder="Email" />
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Celular</label>
                                                        <input type="text" class="form-control" name="telefone1_cli" placeholder="Celular 1" id="masked-input-phone" />
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
                                                        <input type="text" class="form-control" name="telefone3_cli" placeholder="Celular 2" id="masked-input-phone3" />
                                                    </div>
                                                </div>



                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Telefone </label>
                                                        <input type="text" class="form-control" name="telefone2_cli" placeholder="Telefone 1" id="masked-input-phone2" />
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Senha:</label>
                                                        <input type="password" class="form-control" name="senha" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <?php if ($idgrupo_acesso != 7) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group block1">
                                                            <label>Grupo de Acesso:</label><br>
                                                            <select name="idgrupo" class="form-control">
                                                                <option value="">Selecione</option>
                                                                <?php

                                                                include "conexao.php";
                                                                $query_slide = mysqli_query($db, "SELECT * FROM grupo
                                                                    order by titulo_grupo Asc") or die("Erro ao listar grupo dos clientes, tente mais tarde");


                                                                while ($buscar_slide = mysqli_fetch_assoc($query_slide)) { //--While categoria

                                                                    // print_r($buscar_slide["titulo_grupo"]);


                                                                    $idgrupo       = $buscar_slide["idgrupo"];
                                                                    $titulo_grupo  = $buscar_slide["titulo_grupo"];



                                                                    if ($idgrupo == 5 and $idgrupo_acesso != 5) {
                                                                    } elseif ($idgrupo == 6 and $idgrupo_acesso != 5) {
                                                                    } else {
                                                                ?>
                                                                        <option value="<?php echo $idgrupo ?>"><?php echo ($titulo_grupo) ?></option>

                                                                <?php }
                                                                } ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <input id="grupo_cliente" name="grupo_cliente" value="<?php echo $titulo_grupo ?>" type="hidden"></input>
                                                <?php } ?>




                                                <div class="col-md-4" id="pperfil">
                                                    <div class="form-group">
                                                        <label>Foto Perfil</label><br>
                                                        <label id="sel_arquivo" for='selecao-arquivo' style="margin-top: -2px; margin-left: -2px; padding: 8px; width: 100%; text-align: center">Selecionar um arquivo &#187;</label>
                                                        <input id='selecao-arquivo' name='perfil_foto' type='file'>
                                                        <span id='file-name'></span>
                                                    </div>
                                                </div>





                                                <div class="row">
                                                    <div class="col-md-4" id="corretor32" style="display:none; margin-left: 10px;">
                                                        <div class="form-group">
                                                            <label>Imobiliaria:</label><br>
                                                            <select class="default-select2 form-control" style="width: 100%" name="imob_id">
                                                                <option value="">Escolha</option>
                                                                <?php

                                                                include "conexao.php";

                                                                // -=-=-==-=-=-=-=-=-=-=-=-  descontinuado -=-=-=-=-=-=-=-=-=-=-=-=-=--=
                                                                $query_amigo = "SELECT * FROM cliente
                                                                    INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente
                                                                    INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo
                                                                    where cliente_tipo.idtipo = 11  order by nome_cli Asc";


                                                                $executa_query = mysqli_query($db, $query_amigo) or die("Erro ao listar Locatário");
                                                                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) { //--verifica se são amigos

                                                                    $idcliente             = $buscar_amigo['idcliente'];
                                                                    $nome_cli              = $buscar_amigo["nome_cli"];
                                                                    $cpf_cli               = $buscar_amigo["cpf_cli"];



                                                                ?>
                                                                    <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli " ?> </option>
                                                                <?php } ?>


                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4" id="creci32" style="display:none">
                                                        <div class="form-group">
                                                            <label>CRECI:</label>
                                                            <input type="text" name="creci" class="form-control">

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row" id="func1" style="display:none">
                                                <div class="col-md-4" id="cargo">
                                                    <div class="form-group">
                                                        <label>Cargo:</label>
                                                        <input type="text" name="cargo" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-4" id="salario_base">
                                                    <div class="form-group">
                                                        <label>Salário Base:</label>
                                                        <input type="text" name="salario_base" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-4" id="data_contratacao">
                                                    <div class="form-group">
                                                        <label>Data de Contratação:</label>
                                                        <input type="date" name="data_contratacao" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- begin col-4 -->



                                                <div class="col-md-4" style="width: auto;">
                                                    <div class="form-group block1 ">
                                                        <label>Tipo de Cadastro:</label><p>

                                                        <?php

                                                        include "conexao.php";

                                                        if ($idgrupo_acesso == 5) {
                                                            $query_slide = mysqli_query($db, "SELECT * FROM tipo_cliente
                                                            order by idtipo desc") or die("Erro ao listar tipo dos clientes, tente mais tarde");
                                                        } else {
                                                            $query_slide = mysqli_query($db, "SELECT * FROM tipo_cliente
                                                            WHERE idtipo = 1 or idtipo = 11 or idtipo = 13 or idtipo = 4
                                                            order by idtipo desc") or die("Erro ao listar tipo dos clientes, tente mais tarde");
                                                                    }

                                                        while ($buscar_slide = mysqli_fetch_assoc($query_slide)) { //--While categoria

                                                            $descricao_tipo      = $buscar_slide["descricao_tipo"];
                                                            $idtipo              = $buscar_slide["idtipo"];
                                                        ?>

                                                            <label style="align-self: left; border-style: outset; margin: 5px; width:auto;">
                                                                <input type="checkbox" onchange="ShowHideDIV(<?php echo $idtipo; ?>)" data-style="slow"  id="<?php echo $idtipo; ?>" data-size="normal" data-toggle="toggle" value="<?php echo $idtipo; ?>" name="tipo_cliente[]" style="text-align: left;"><br><b> <?php echo $descricao_tipo; ?></b>
                                                            </label>

                                                        <?php } ?>
                                                    </div>
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

                                            <!-- end row -->
                                            <div class="row" id="cpf_rfb" style="display:none">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>CPF Responsavel Perante a RFB</label>
                                                        <input type="text" class="form-control" name="cpf_rfb" value="">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row" id="label_nascimento" style="display:block">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Renda Familiar</label>
                                                        <input type="text" class="form-control" name="renda_total" id="renda_total" />
                                                    </div>
                                                </div>
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Data de Nascimento</label>
                                                        <input type="date" class="form-control" name="nascimento_cli" />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nacionalidade</label>
                                                        <input type="text" class="form-control" name="nacionalidade_cli" placeholder="Nacionalidade" />

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
                                                            <option selected="selected" value="">Selecione</option>
                                                            <option value="Casado(a)-Comunhão Universal (Antes lei 6.515/77)">Casado(a)-Comunhão Universal (Antes lei 6.515/77)</option>
                                                            <option value="Casado(a)-Comunhão Universal (Apos lei 6.515/77)">Casado(a)-Comunhão Universal (Apos lei 6.515/77)</option>
                                                            <option value="Casado(a)-Comunhão Parcial">Casado(a)-Comunhão Parcial</option>
                                                            <option value="Casado(a)-Separação Convencional de Bens">Casado(a)-Separação Convencional de Bens</option>
                                                            <option value="Divorciado(a)">Divorciado(a)</option>
                                                            <option value="Separado(a) Judicialmente">Separado(a) Judicialmente</option>
                                                            <option value="Solteiro(a)">Solteiro(a)</option>
                                                            <option value="União Estável">União Estável</option>
                                                            <option value="Viúvo(a)">Viúvo(a)</option>
                                                        </select> </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-primary" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"><i class="fa fa-plus-circle"></i> Cadastrar Conjuge</button>

                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group block1" id="coloca-conjuge">
                                                        <label>Cônjuge</label>
                                                        <input type="text" name="nome_conj" class="form-control" disabled="">
                                                        <input type="hidden" name="conjuge_idconjuge" value="">
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="row" id="label_profissao" style="display:block">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Profissão</label>
                                                        <input type="text" class="form-control" name="profissao_cli" placeholder="Profissão" />
                                                    </div>
                                                </div>



                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Observação</label>
                                                        <textarea name="obs_cli" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
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
                                                            <input type="text" class="form-control" id="cep" name="cep_cli" placeholder="Cep" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Endereço</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control" id="rua" name="endereco_cli" placeholder="Rua" />
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Numero</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control" id="numero" name="numero_cli" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Complemento</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control" name="complemento_cli" />

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
                                                            <input type="text" class="form-control" id="bairro" name="bairro_cli" placeholder="Bairro" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cidade</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control" id="cidade" name="cidade_cli" placeholder="Cidade" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Estado</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control" id="estado" name="estado_cli" placeholder="Estado" />

                                                        </div>
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

        <!-- #####################################################################################
##################################################################################### -->

        <div class="modal fade" id="add_data_Modal" role="dialog">
            <div class="modal-dialog modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"></button>
                        <h4 class="modal-title">Cadastrar Conjuge</h4>
                    </div>

                    <div class="modal-body">
                        <!-- CORPO DA MODAL -->
                        <form method="POST" action="recebe_conjuge.php" id="insert_form">



                            <div class="row">
                                <!-- begin col-6 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label id="label_conj">CPF Cônjuge</label>

                                        <input type="text" class="form-control" id="masked-input-cpf_conjuge" required="" name="cpf_conj" onblur="chamaCpfconjuge(this.id)" value="">

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label id="label_rg">RG Cônjuge</label>
                                        <input type="text" class="form-control" id="rg_conj" name="rg_conj" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group block1">
                                        <label id="label_nome_conj">Nome Cônjuge</label>
                                        <input type="text" class="form-control" id="nome_conj" name="nome_conj" placeholder="Nome" />

                                        <input type="hidden" name="cadastrado_por" value="<?php echo $imobiliaria_idimobiliaria; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Data de Nascimento</label>
                                        <input type="date" class="form-control" name="nascimento_conj" />
                                    </div>
                                </div>
                                <!-- end col-6 -->
                                <!-- begin col-6 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nacionalidade</label>
                                        <input type="text" class="form-control" name="nacionalidade_conj" placeholder="Nacionalidade" />

                                    </div>
                                </div>

                                <div class="col-md-4 BLO">
                                    <div class="form-group">
                                        <label>Profissão</label>
                                        <input type="text" class="form-control" name="profissao_conj" placeholder="Profissão" />
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="email_conj" name="email_conj" placeholder="Email" />
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Celular</label>
                                        <input type="text" class="form-control" name="telefone1_conj" placeholder="Celular 1" id="masked-input-phone-conjuge" />
                                    </div>
                                </div>
                                <!-- end col-4 -->

                                <!-- begin col-4 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Celular</label>
                                        <input type="text" class="form-control" name="telefone3_conj" placeholder="Celular 2" id="masked-input-phone3-conjuge" />
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telefone </label>
                                        <input type="text" class="form-control" name="telefone2_conj" placeholder="Telefone 1" id="masked-input-phone2-conjuge" />
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <input type="submit" name="insert" id="insert" value="Cadastrar" class="btn btn-primary"><button type="button" class="btn btn-danger" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal">Fechar</button>

                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>




        <!-- #####################################################################################
##################################################################################### -->



        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#renda_total").maskMoney({
                symbol: 'R$ ',
                showSymbol: true,
                thousands: '.',
                decimal: ',',
                symbolStay: true
            });
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
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

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

    <script type='text/javascript' src='cep.js'></script>
    <script type='text/javascript' src='produtos.js'></script>
    <script type='text/javascript' src='lote.js'></script>
    <script type='text/javascript' src='medidas.js'></script>
    <script type='text/javascript' src='cep.js'></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script type="text/javascript">
        var $input = document.getElementById('selecao-arquivo'),
            $label = document.getElementById('sel_arquivo');
        $fileName = document.getElementById('file-name');
        $input.addEventListener('change', function() {
            $label.textContent = this.value;
            //  console.log($fileName);

        });






        $(document).ready(function() {
            /* Executa a requisição quando o campo CEP perder o foco */
            $('#masked-input-cpf').blur(function() {
                /* Configura a requisição AJAX */
                $.ajax({
                    url: 'consultar_cpf.php',
                    /* URL que será chamada */
                    type: 'POST',
                    /* Tipo da requisição */
                    data: 'cpf=' + $('#masked-input-cpf').val(),
                    /* dado que será enviado via POST */
                    dataType: 'json',
                    /* Tipo de transmissão */
                    success: function(data) {
                        if (data.sucesso == 1) {

                            // alert('Cliente já cadastrado. Grupo: ' + data.categoria_cliente);

                            $('#masked-input-cpf').val('');

                        }
                    }
                });
                return false;
            })
        });


        $(document).ready(function() {
            /* Executa a requisição quando o campo CEP perder o foco */
            $('#masked-input-cnpj').blur(function() {
                /* Configura a requisição AJAX */
                $.ajax({
                    url: 'consultar_cpf.php',
                    /* URL que será chamada */
                    type: 'POST',
                    /* Tipo da requisição */
                    data: 'cpf=' + $('#masked-input-cnpj').val(),
                    /* dado que será enviado via POST */
                    dataType: 'json',
                    /* Tipo de transmissão */
                    success: function(data) {
                        if (data.sucesso == 1) {

                            alert('Cliente já cadastrado.');

                            $('#masked-input-cnpj').val('');

                        }
                    }
                });
                return false;
            })
        });

        $(document).ready(function() {
            $("#masked-input-phone3").mask("(99) 99999-9999");
            App.init();


            FormWizardValidation.init();
            TableManageButtons.init();
            FormPlugins.init();
        });
    </script>

    <script type="text/javascript">
        //####################################################################


        $(document).ready(function() {
            $("#masked-input-cpf_conjuge").mask("999.999.999-99");
            $("#masked-input-phone3-conjuge").mask("(99) 9999-9999");
            $("#masked-input-phone-conjuge").mask("(99) 9999-9999");
            $("#masked-input-phone2-conjuge").mask("(99) 9999-9999");


            $('#insert_form').on("submit", function(event) {
                event.preventDefault();

                if ($('#masked-input-cpf_conjuge').val() == "") {
                    alert("Informe o numero do CPF do Conjuge");
                } else if ($("#rg_conj").val() == '') {
                    alert("Informe o numero do Rg do Conjuge");
                } else if ($("#nome_conj").val() == '') {
                    alert("Informe o Nome do Conjuge");
                } else if ($("#nascimento_conj").val() == '') {
                    alert("Informe a data de Nascimento do Conjuge");
                } else if ($("#nacionalidade_conj").val() == '') {
                    alert("Informe a Nacionalidade  do Conjuge");
                } else if ($("#nacionalidade_conj").val() == '') {
                    alert("Informe a Nacionalidade  do Conjuge");
                } else if ($("#telefone1_conj").val() == '') {
                    alert("Informe o Pelo menos um numero de Celular do Conjuge");
                } else {
                    $.ajax({
                        url: 'recebe_conjuge.php',
                        method: 'POST',
                        data: $('#insert_form').serialize(),
                        dataType: 'json',
                        beforeSend: function() {
                            $('#insert').val('Cadastrar');
                        },
                        success: dados => {
                            $('#insert_form')[0].reset();
                            $('#add_data_Modal').modal('hide');
                            $('#coloca-conjuge').html("<label>Cônjuge</label><input type='text' style='margin-top:2px' name='nome_conj' class='form-control' id='nome_conj' value='" + dados.nome_cli + "'><input type='hidden' name='conjuge_idconjuge' value='" + dados.idcliente + "'>");
                        },
                        error: erro => {
                            console.log(erro)
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>