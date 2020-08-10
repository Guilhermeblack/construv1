<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

$idlote = $_GET["idlote"];

function busca_empreendimento($idlote){

 include "conexao.php";

 $query_amigo = "SELECT * FROM lote 
 inner join produto ON lote.produto_idproduto = produto.idproduto
 INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
 INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
 WHERE idlote = $idlote";
 $executa_query = mysqli_query ($db,$query_amigo);


            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

             $empreendimento_id          = $buscar_amigo['empreendimento_idempreendimento'];
             $produto_idproduto          = $buscar_amigo['produto_idproduto'];
             $m2          				 = $buscar_amigo['m2'];
             $valor          			 = $buscar_amigo['valor'];
             $descricao_empreendimento   = $buscar_amigo['descricao_empreendimento'];

             $quadra   = $buscar_amigo['quadra'];
             $lote     = $buscar_amigo['lote'];


             $dados["empreendimento_id"] = $empreendimento_id;
             $dados["produto_idproduto"] = $produto_idproduto;
             $dados["m2"] 			     = $m2;
             $dados["valor"] 			 = $valor;

             $dados["quadra"] 			 = $quadra;
             $dados["lote"] 			 = $lote;
             $dados["descricao_empreendimento"] 			 = $descricao_empreendimento;

           }

           return $dados;
         }


         ?>
         <!DOCTYPE html>
         <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
         <!--[if !IE]><!-->
         <html lang="en">
         <!--<![endif]-->


         <head>
           <meta charset="utf-8" />
           <title>Immobile Business</title>
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
  function validaCPF(cpf)
  {
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
          return false;
    for (i = 0; i < cpf.length - 1; i++)
          if (cpf.charAt(i) != cpf.charAt(i + 1))
                {
                digitos_iguais = 0;
                break;
                }
    if (!digitos_iguais)
          {
          numeros = cpf.substring(0,9);
          digitos = cpf.substring(9);
          soma = 0;
          for (i = 10; i > 1; i--)
                soma += numeros.charAt(10 - i) * i;
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(0))
                return false;
          numeros = cpf.substring(0,10);
          soma = 0;
          for (i = 11; i > 1; i--)
                soma += numeros.charAt(11 - i) * i;
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(1))
                return false;
          return true;
          }
    else
        return false;
  }
</script>

<script type="text/javascript">
function chamaCpf(id){
  //alert(id);
var cpf = document.getElementById(id).value

var cpf = cpf.replace(".","")
var cpf = cpf.replace(".","")
var cpf = cpf.replace(".","")
var cpf = cpf.replace("-","")

var resultado = validaCPF(cpf);

if(resultado == false){
document.getElementById(id).value ='';
document.getElementById("email_cli").focus(); 

alert('CPF Invalido.');

}else{

}


}






</script>
<script type="text/javascript">
    function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
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
    numeros = cnpj.substring(0,tamanho);
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
    numeros = cnpj.substring(0,tamanho);
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
function chamaCnpj(){
var cnpj = document.getElementById('masked-input-cnpj').value

var cnpj = cnpj.replace(".","")
var cnpj = cnpj.replace(".","")
var cnpj = cnpj.replace(".","")
var cnpj = cnpj.replace("-","")

var resultado = validarCNPJ(cnpj);

if(resultado == false){
document.getElementById('masked-input-cnpj').value ='';
document.getElementById("email_cli").focus(); 

alert('CNPJ Invalido.');

}else{

}


}
</script>









         </head>
         <body>
           <script type="text/javascript">

            function label(){


             var id  = document.form_wizard.aparecer.value



             if (id=="1") 
             {

               document.getElementById('primeiro').style.display        = "block"
               document.getElementById('segundo').style.display        = "block"
               document.getElementById('terceiro').style.display        = "block"
               document.getElementById('quarto').style.display        = "block"
               document.getElementById('quinto').style.display        = "block"
               document.getElementById('sexto').style.display        = "block"
               document.getElementById('setimo').style.display        = "block"
               document.getElementById('oitavo').style.display        = "block"
               document.getElementById('nono').style.display        = "block"
               document.getElementById('decimo').style.display        = "block"
               document.getElementById('onze').style.display        = "block"

               document.form_wizard.aparecer.value  = "2";

             }

             if (id=="2") 
             {

              document.getElementById('primeiro').style.display        = "none"
              document.getElementById('segundo').style.display        = "none"
              document.getElementById('terceiro').style.display        = "none"
              document.getElementById('quarto').style.display        = "none"
              document.getElementById('quinto').style.display        = "none"
              document.getElementById('sexto').style.display        = "none"
              document.getElementById('setimo').style.display        = "none"
              document.getElementById('oitavo').style.display        = "none"
              document.getElementById('nono').style.display        = "none"
              document.getElementById('decimo').style.display        = "none"
              document.getElementById('onze').style.display        = "none"

              document.form_wizard.aparecer.value  = "1"



            }



          }



          function opcao(id){



            if (id=="1") 
            {

             document.getElementById('label_nome').style.display        = "block"
             document.getElementById('label_cpf').style.display         = "block"
             document.getElementById('label_rg').style.display          = "block"
             document.getElementById('masked-input-cpf').style.display  = "block"
             document.getElementById('masked-input-cpf').disabled     = ""
             document.getElementById('masked-input-cpf2').style.display  = "block"
             document.getElementById('masked-input-cpf2').disabled     = ""


             document.getElementById('label_razao').style.display      = "none"
             document.getElementById('label_cnpj').style.display       = "none"
             document.getElementById('label_insc_esta').style.display  = "none"
             document.getElementById('masked-input-cnpj').disabled     = "disabled"
             document.getElementById('masked-input-cnpj').style.display = "none"
             document.getElementById('label_insc_muni').style.display  = "none"


           }

           if (id=="2") 
           {

            document.getElementById('label_razao').style.display      = "block"
            document.getElementById('label_cnpj').style.display       = "block"
            document.getElementById('label_insc_esta').style.display  = "block"
            document.getElementById('label_insc_muni').style.display  = "block"
            document.getElementById('masked-input-cnpj').disabled     = ""
            document.getElementById('masked-input-cnpj').style.display = "block"


            document.getElementById('label_nome').style.display        = "none"
            document.getElementById('label_cpf').style.display         = "none"
            document.getElementById('label_rg').style.display          = "none"
            document.getElementById('masked-input-cpf').style.display  = "none"
            document.getElementById('masked-input-cpf').disabled     = "disabled"   
            document.getElementById('masked-input-cpf2').style.display  = "none"
            document.getElementById('masked-input-cpf2').disabled     = "disabled"   


          }



        }





      </script>
      <script>

        function zeracampossinal(){

  //////// inicio do zerar campos
///// resumo

document.form_wizard.resumo_valor_lote.value              = "";
document.form_wizard.resumo_parcelas_entrada.value        = "";
document.form_wizard.resumo_valor_parcelas_entrada.value  = "";

document.form_wizard.resumo_saldo_devedor.value           = "";
document.form_wizard.resumo_parcelas_financiamento.value  = "";
document.form_wizard.resumo_valor_parcelas_financiamento.value  = "";

///// financiamento

document.form_wizard.valor_para_parcelamento2.value  = "";
document.form_wizard.valor_para_parcelamento.value  = "";

document.form_wizard.plano_pagamento.value  = "";

//// entrada


document.form_wizard.entrada_restante.value  = "";
document.form_wizard.parcela_entrada.value  = "";
document.form_wizard.valor_parcela_entrada.value  = "";
document.form_wizard.valor_parcela_entrada2.value  = "";


///////// fim do zerar campos

}
function zeracamposdemais(){

  //////// inicio do zerar campos
///// resumo

document.form_wizard.resumo_valor_lote.value              = "";
document.form_wizard.resumo_parcelas_entrada.value        = "";
document.form_wizard.resumo_valor_parcelas_entrada.value  = "";

document.form_wizard.resumo_saldo_devedor.value           = "";
document.form_wizard.resumo_parcelas_financiamento.value  = "";
document.form_wizard.resumo_valor_parcelas_financiamento.value  = "";

///// financiamento

document.form_wizard.valor_para_parcelamento2.value  = "";
document.form_wizard.valor_para_parcelamento.value  = "";

document.form_wizard.plano_pagamento.value  = "";

//// entrada



document.form_wizard.parcela_entrada.value  = "";
document.form_wizard.valor_parcela_entrada.value  = "";
document.form_wizard.valor_parcela_entrada2.value  = "";


///////// fim do zerar campos

}

function resumo(){


  var valor_desconto          = document.form_wizard.valor_desconto.value
  var parcela_entrada         = document.form_wizard.parcela_entrada.value
  var valor_parcela_entrada   = document.form_wizard.valor_parcela_entrada.value
  var valor_para_parcelamento = document.form_wizard.valor_para_parcelamento.value
  var plano_pagamento         = document.form_wizard.plano_pagamento.value


  document.form_wizard.resumo_valor_lote.value              = valor_desconto 
  document.form_wizard.resumo_parcelas_entrada.value        = parcela_entrada 
  document.form_wizard.resumo_valor_parcelas_entrada.value  = valor_parcela_entrada 

  document.form_wizard.resumo_saldo_devedor.value           = valor_para_parcelamento 
  document.form_wizard.resumo_parcelas_financiamento.value  = plano_pagamento 

}
function descontoss(){


//////// inicio do zerar campos
///// resumo

document.form_wizard.resumo_valor_lote.value              = "";
document.form_wizard.resumo_parcelas_entrada.value        = "";
document.form_wizard.resumo_valor_parcelas_entrada.value  = "";

document.form_wizard.resumo_saldo_devedor.value           = "";
document.form_wizard.resumo_parcelas_financiamento.value  = "";
document.form_wizard.resumo_valor_parcelas_financiamento.value  = "";

///// financiamento

document.form_wizard.valor_para_parcelamento2.value  = "";
document.form_wizard.valor_para_parcelamento.value  = "";

document.form_wizard.plano_pagamento.value  = "";

//// entrada

document.form_wizard.entrada.value  = "";
document.form_wizard.entrada_restante.value  = "";
document.form_wizard.parcela_entrada.value  = "";
document.form_wizard.valor_parcela_entrada.value  = "";
document.form_wizard.valor_parcela_entrada2.value  = "";


///////// fim do zerar campos


var valor = document.form_wizard.valor.value
var desconto = document.form_wizard.desconto.value



var percentual_convertido =(desconto/100) 
var percentual_reais      =(valor * percentual_convertido) 
var result = (valor - percentual_reais) 


var result = parseFloat(result.toFixed(2));
document.form_wizard.valor_desconto.value = result 
document.form_wizard.valor_desconto2.value = result 


}


function calcula(){

  var entrada = document.form_wizard.entrada.value
  var entrada2 = entrada.replace("R$","")
  var entrada3 = entrada2.replace(".","")
  var entrada4 = entrada3.replace(" ","")
  var entrada5 = entrada4.replace(",",".")

  var entrada_inter = document.form_wizard.valor_parcela_intermediaria.value
  var entrada_inter = entrada_inter.replace("R$","")
  var entrada_inter = entrada_inter.replace(".","")
  var entrada_inter = entrada_inter.replace(" ","")
  var entrada_inter = entrada_inter.replace(",",".")

  var entrada_restante = document.form_wizard.entrada_restante.value
  var entrada_restante2 = entrada_restante.replace("R$","")
  var entrada_restante3 = entrada_restante2.replace(".","")
  var entrada_restante4 = entrada_restante3.replace(" ","")
  var entrada_restante5 = entrada_restante4.replace(",",".")

  var qtd_inter = document.form_wizard.qtd_parcelas_intermediarias.value

  var correcao_finan_fixo = document.form_wizard.correcao_finan_fixo.value
  var correcao_taxa = document.form_wizard.correcao_taxa_financiamento.value

  var parcela_entrada = document.form_wizard.parcela_entrada.value

  var valor = document.form_wizard.valor_desconto.value

  var total_inter = entrada_inter * qtd_inter




  var result = (valor - entrada_restante5 - entrada5 - total_inter)


  if(correcao_finan_fixo == 1){

    var divcem = 1+(parseFloat(correcao_taxa)/100);
    var parcela_entrada2 = 1;
    var expoente = Math.pow(divcem, parcela_entrada2);

    var corrigido = parseFloat(result)*parseFloat(expoente);

    var corrigido = parseFloat(corrigido.toFixed(2));

    document.form_wizard.valor_para_parcelamento.value = corrigido; 
    document.form_wizard.valor_para_parcelamento2.value = corrigido;

  }else{

    if(correcao_taxa != '')
    {

      var divcem = 1+(parseFloat(correcao_taxa)/100);
      var parcela_entrada2 = parcela_entrada - 1;
      var expoente = Math.pow(divcem, parcela_entrada2);

      var corrigido = parseFloat(result)*parseFloat(expoente);

      var corrigido = parseFloat(corrigido.toFixed(2));

      document.form_wizard.valor_para_parcelamento.value = corrigido; 
      document.form_wizard.valor_para_parcelamento2.value = corrigido;


    }else{

      var result = parseFloat(result.toFixed(2));
      document.form_wizard.valor_para_parcelamento.value = result; 
      document.form_wizard.valor_para_parcelamento2.value = result; 
    }
  }



}

function entrada_demais(){


  var entrada = document.form_wizard.entrada.value
  if(entrada == ''){
    var entrada = 'R$ 0.00';
  }

  var entrada2 = entrada.replace("R$","")
  var entrada3 = entrada2.replace(".","")
  var entrada4 = entrada3.replace(" ","")
  var entrada5 = entrada4.replace(",",".")

  var entrada_restante = document.form_wizard.entrada_restante.value
  var entrada_restante2 = entrada_restante.replace("R$","")
  var entrada_restante3 = entrada_restante2.replace(".","")
  var entrada_restante4 = entrada_restante3.replace(" ","")
  var entrada_restante5 = entrada_restante4.replace(",",".")


  var valor = document.form_wizard.valor_desconto.value

  var total_entrada = parseFloat(entrada_restante5) + parseFloat(entrada5)

  var porcem = document.form_wizard.porcem.value

  var porcentagem = parseFloat(valor)*parseFloat(porcem)/100

  var str2 = '%'


  if ( total_entrada < porcentagem){
    alert( "O Valor da Entrada deve ser no Minimo ".concat(porcem, str2));
    document.form_wizard.entrada.value= "";
    document.form_wizard.entrada_restante.value= "";
    document.form_wizard.entrada.focus();


    return false;
  }

  calcula()


}


</script>
<?php    $dados_lote = busca_empreendimento($idlote); 
$idempreendimento  = $dados_lote["empreendimento_id"];
$descricao_empreendimento  = $dados_lote["descricao_empreendimento"];
$quadra  = $dados_lote["quadra"];
$lote    = $dados_lote["lote"];
function centrocusto_empreendimento($idempreendimento)
{


  include "conexao.php";
  $query_amigo = "SELECT * FROM empreendimento_centrocusto where empreendimento_id = $idempreendimento";

  $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");


  while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
  {                 
    $centrocusto_id       = $buscar_amigo["centrocusto_id"];                 
    $contacorrente_id     = $buscar_amigo["contacorrente_id"];                 

    $dados['centrocusto_id']    = $centrocusto_id;
    $dados['contacorrente_id']  = $contacorrente_id;

  }

  return $dados;

}
function empreendimento($idempreendimento)
{


  include "conexao.php";
  $query_amigo = "SELECT * FROM empreendimento where idempreendimento = $idempreendimento";

  $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");


  while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
  {                 
    $descricao           = $buscar_amigo["descricao"];                 

  }

  return $descricao;

}
?>  
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
  <!-- begin #header -->
  <?php include "topo.php" ?>
  <div class="sidebar-bg"></div>
  <!-- end #sidebar -->

  <!-- begin #content -->
  <div id="content" class="content">
   <!-- begin breadcrumb -->

   <!-- end breadcrumb -->
   <!-- begin page-header -->
   <h1 class="page-header">




     <?php if(isset($_GET["erro"])){ ?>
     <div class="alert alert-danger fade in m-b-15">
      <strong><font><font>Atenção! </font></font></strong><font><font>
        Não foi possivel concluir a venda, Esse lote não está mais Disponivel
      </font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
    </div>
    <?php } ?>


    Cadastro de Venda / <?php echo $descricao_empreendimento ?></h1>

    <h4>Quadra: <?php echo $quadra ?><br>
     Lote: <?php echo $lote ?></h4>
     <!-- end page-header -->

     <!-- begin row -->
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
          <?php

          $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];
          ?>
        </div>
        <div class="panel-body">
          <form action="recebe_proposta.php" method="POST" data-parsley-validate="true" name="form_wizard">
            <div id="wizard">
             <ol>
              <li>
                Identificação 
                <small>Informe os clientes e vendedores</small>
              </li>

              <li>
                Entrada
                <small>Informe a negociação da Entrada</small>
              </li>
              <li>
                Parcelas Intermediárias
                <small>Informe as parcelas bimestrais ou semestrais</small>
              </li>
              <li>
                Financiamento
                <small>Informe a negociação do Financiamento.</small>
              </li>
              <li>
                Resumo dos Dados
                <small>Confirme os dados</small>
              </li>
            </ol>
            <!-- begin wizard step-1 -->
            <div class="wizard-step-1">

             <input type="hidden" name="cadastrado_por" value="<?php echo $imobiliaria_idimobiliaria ?>">

             <fieldset>
              <legend class="pull-left width-full">Identificação Titular</legend>
              <!-- begin row -->
              <div class="row">
                <!-- begin col-4 -->
                <div class="col-md-6">
                 <div class="form-group block1">
                  <label>Selecione o Cliente (Titular) ou <button type="button" class="btn btn-inverse" onclick="label()"><i class="fa fa-plus-circle"></i> Cadastrar Novo Cliente</button></label>
                  <select class="default-select2 form-control" name="cliente_idcliente">
                    <option value="">Escolha</option>
                    <?php

                    include "conexao.php";
                    if (in_array('49', $idrota)) { 
                     $query_amigo = "SELECT * FROM cliente
                     INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                     WHERE idtipo = 1 order by nome_cli Asc";
                   }else{
                    $query_amigo = "SELECT * FROM cliente
                    INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                    INNER JOIN vinculo ON vinculo.idcliente = cliente.idcliente

                    WHERE idtipo = 1 AND idcorretor = $imobiliaria_idimobiliaria  order by nome_cli Asc";


                  }

                  $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $idcliente             = $buscar_amigo['idcliente'];
                  $nome_cli              = $buscar_amigo["nome_cli"];
                  $cpf_cli              = $buscar_amigo["cpf_cli"];



                  ?>
                  <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
                  <?php } ?>


                </select>
              </div>
            </div>
            <!-- end col-4 -->
            <!-- begin col-4 -->

            <!-- end col-4 -->
            <!-- begin col-4 -->
            <div class="col-md-6">
             <div class="form-group">
              <label>Corretor</label>
              <select class="default-select2 form-control" name="imobiliaria_idimobiliaria" required="">
                <option value="">Escolha</option>
                <?php

                include "conexao.php";
                
                if (in_array('49', $idrota)) { 
                  $query_amigo = "SELECT * FROM cliente
                  INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                  WHERE idtipo = 8 order by nome_cli Asc";
                }else{
                  $query_amigo = "SELECT * FROM cliente
                  INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                  INNER JOIN vinculo ON vinculo.idcliente = cliente.idcliente
                  WHERE idtipo = 8 AND (vinculo.idcorretor = $imobiliaria_idimobiliaria or cliente.idcliente = $imobiliaria_idimobiliaria) order by nome_cli Asc";	
                }

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

            	$idcliente             	= $buscar_amigo['idcliente'];
              $nome_cli              	= $buscar_amigo["nome_cli"];
              



              ?>
              <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli" ?> </option>
              <?php } ?>


            </select>
          </div>
        </div>
        <!-- end col-4 -->
      </div>

      <!-- end row -->




      <?php 
      $centro_custo_id =  centrocusto_empreendimento($idempreendimento);
      ?>

      <input type="hidden" name="centrocusto_id"
      value="<?php echo $centro_custo_id['centrocusto_id'] ?>"
      >

      <input type="hidden" name="contacorrente" 
      value="<?php echo $centro_custo_id['contacorrente_id'] ?>"
      >

      <input type="hidden" name="aparecer" id="aparecer" value="1">


      <div class="row" id="primeiro" style="display: none;">
        <!-- begin col-6 -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Pessoa:</label>
            <input type="radio" name="pessoa" value="1" checked onclick="opcao(1)">Física 
            <input type="radio" name="pessoa" value="2" onclick="opcao(2)" />Jurídica

          </div>
        </div>
        <!-- end col-6 -->
        <!-- begin col-6 -->



        <!-- end col-6 -->
      </div>
      <!-- begin row -->


      <!-- begin row -->
      <div class="row" id="segundo" style="display: none;">
        <!-- begin col-6 -->
        <div class="col-md-4">
          <div class="form-group">
            <label id="label_cpf" style="display:block">CPF</label>
            <label id="label_cnpj" style="display:none">CNPJ</label>

            <input type="text" class="form-control" id="masked-input-cpf" required="" name="cpf_cli" style="display:block" onblur="chamaCpf(this.id)" value="">

            <input type="text" class="form-control" id="masked-input-cnpj" name="cpf_cli" style="display:none" disabled="disabled" value="" onblur="chamaCnpj()">

          </div>
        </div>
        <!-- end col-6 -->
        <!-- begin col-6 -->
        <div class="col-md-4">
          <div class="form-group">
            <label id="label_rg" style="display:block">RG</label>
            <label id="label_insc_esta" style="display:none">Inscrição Estadual</label>
            <input type="text" class="form-control" name="rg_cli"  />
          </div>
        </div>

        <div class="col-md-4" id="label_insc_muni" style="display:none">
          <div class="form-group">
            <label>Inscrição Municipal</label>
            <input type="text" class="form-control" name="insc_municipal" placeholder="Inscrição Municipal" />
          </div>
        </div>
        <!-- end col-6 -->

        <div class="col-md-4">
          <div class="form-group block1">
            <label id="label_nome" style="display:block">Nome</label>
            <label id="label_razao" style="display:none">Razão Social</label>
            <input type="text" class="form-control" name="nome_cli" placeholder="Nome" />

            <input type="hidden" name="cadastrado_por" value="<?php echo $imobiliaria_idimobiliaria; ?>">
          </div>
        </div>
      </div>
      <!-- end row -->


      <div class="row" id="terceiro" style="display: none;">
        <!-- begin col-4 -->

        <!-- end col-4 -->
        <!-- begin col-4 -->
        <div class="col-md-4">
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control"  id="email_cli" name="email_cli" placeholder="Email" />
          </div>
        </div>
        <!-- end col-4 -->
        <!-- begin col-4 -->
        <div class="col-md-4">
          <div class="form-group">
            <label>Celular</label>
            <input type="text" class="form-control"  name="telefone1_cli" placeholder="Telefone 1" id="masked-input-phone" />
          </div>
        </div>
        <!-- end col-4 -->

        <div class="col-md-4">
          <div class="form-group">
            <label>Telefone </label>
            <input type="text" class="form-control"  name="telefone2_cli" placeholder="Telefone 2" id="masked-input-phone2" />
          </div>
        </div>
      </div>
      <!-- end row -->

      <div class="row" id="quarto" style="display: none;">

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



    <div class="row" id="quinto" style="display: none;">
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
          </select>                                                    </div>
        </div>

        <!-- end col-6 -->
        <!-- begin col-6 -->

        <div class="col-md-6">
          <div class="form-group">
            <label>Profissão</label>
            <input type="text" class="form-control"  name="profissao_cli" placeholder="Profissão" />
          </div>
        </div>
        <!-- end col-6 -->
      </div>




      <div class="row" id="sexto" style="display: none;">
        <!-- begin col-4 -->
        <div class="col-md-6">
          <div class="form-group">
            <label>CEP</label>
            <div class="controls">
             <input type="text" class="form-control" id="cep"  name="cep_cli" placeholder="Cep" />

           </div>
         </div>
       </div>
       <!-- end col-4 -->
       <!-- begin col-4 -->
       <div class="col-md-6">
        <div class="form-group">
          <label>Endereço</label>
          <div class="controls">
            <input type="text" class="form-control" id="rua"   name="endereco_cli" placeholder="Rua" />   
          </div>
        </div>
      </div>

      <!-- end col-4 -->
      <!-- begin col-4 -->

      <!-- end col-6 -->
    </div>
    <!-- end row -->
    <div class="row" id="setimo" style="display: none;">
      <!-- begin col-4 -->
      <div class="col-md-6">
        <div class="form-group">
          <label>Numero</label>
          <div class="controls">
           <input type="text" class="form-control" id="numero"  name="numero_cli"  />

         </div>
       </div>
     </div>
     <!-- end col-4 -->
     <!-- begin col-4 -->
     <div class="col-md-6">
      <div class="form-group">
        <label>Complemento</label>
        <div class="controls">
         <input type="text" class="form-control"  name="complemento_cli"  />

       </div>
     </div>
   </div>
   <!-- end col-4 -->
   <!-- begin col-4 -->

   <!-- end col-6 -->
 </div>

 <div class="row" id="oitavo" style="display: none;">
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




<legend class="pull-left width-full" style="display: none" id="onze">Identificação Conjuge</legend>


<div class="row" id="nono" style="display: none;">
  <!-- begin col-6 -->
  <div class="col-md-4">
    <div class="form-group">
      <label id="label_cpf">CPF Cônjuge</label>

      <input type="text" class="form-control" id="masked-input-cpf2" style="display:block" name="cpf_con" onblur="chamaCpf(this.id)" value="">


    </div>
  </div>
  <!-- end col-6 -->
  <!-- begin col-6 -->
  <div class="col-md-4">
    <div class="form-group">
      <label id="label_rg">RG Cônjuge</label>
      <input type="text" class="form-control" name="rg_con"  />
    </div>
  </div>


  <div class="col-md-4">
    <div class="form-group block1">
      <label id="label_nome">Nome Cônjuge</label>
      <input type="text" class="form-control" name="nome_con" placeholder="Nome" />

    </div>
  </div>
</div>
<!-- end row -->





<div class="row" id="decimo" style="display: none;">


  <!-- begin col-6 -->
  <div class="col-md-4">
    <div class="form-group">
      <label>Data de Nascimento Cônjuge</label>
      <input type="date" class="form-control" name="nascimento_con" />
    </div>
  </div>
  <!-- end col-6 -->
  <!-- begin col-6 -->
  <div class="col-md-4">
    <div class="form-group">
      <label>Nacionalidade Cônjuge</label>
      <input type="text" class="form-control" name="nacionalidade_con" placeholder="Nacionalidade" />

    </div>
  </div>
  <!-- end col-6 -->
  <div class="col-md-4">
    <div class="form-group">
      <label>Profissão Cônjuge</label>
      <input type="text" class="form-control"  name="profissao_con" placeholder="Profissão" />
    </div>
  </div>
</div>










</fieldset>
</div>
<!-- end wizard step-1 -->
<?php     include "conexao.php";
$query_amigo = "SELECT * FROM entrada_minima where empreendimento_id = $idempreendimento order by identrada_minima desc limit 1";

$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");


while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
{                 
  $percentual_entrada           = $buscar_amigo["percentual_entrada"];                 

}

?>
<?php     include "conexao.php";
$query_amigo = "SELECT * FROM correcao where empreendimento_id = $idempreendimento order by idcorrecao desc limit 1";

$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");


while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
{                 
  $correcao_taxa_financiamento     = $buscar_amigo["taxa_financiamento"];     
  $correcao_taxa_entrada           = $buscar_amigo["taxa_entrada"];
  $correcao_finan_fixo             = $buscar_amigo["correcao_finan_fixo"];                   


}

?>
<input type="hidden" name="correcao_taxa_financiamento" id="correcao_taxa_financiamento" value="<?php echo $correcao_taxa_financiamento ?>">
<input type="hidden" name="correcao_taxa_entrada" id="correcao_taxa_entrada" value="<?php echo $correcao_taxa_entrada ?>">
<input type="hidden" name="correcao_finan_fixo" id="correcao_finan_fixo" value="<?php echo $correcao_finan_fixo ?>">



<!-- entrada minima para financiamento -->
<input type="hidden" id="porcem" name="porcem" value="<?php echo $percentual_entrada ?>">
<!-- Fim da entrada Minima -->




<!-- ID do empreeendimento -->
<input type="hidden" name="os" value="<?php echo $idempreendimento ?>">

<?php 

$quadra_id 			   = $dados_lote["produto_idproduto"];
$valor_desconto_result = $dados_lote["valor"];
$lote_id   			   = $idlote;



?>

<input type="hidden" name="quadra" value="<?php echo $quadra_id ?>">
<input type="hidden" name="lote" value="<?php echo $lote_id ?>" >

<input type="hidden" name="valor" id="valor" value="<?php echo $valor_desconto_result ?>" >
<!-- Fim do ID do empreendimento -->


<!-- begin wizard step-3 -->
<div class="wizard-step-2">
  <fieldset>
   <legend class="pull-left width-full">Entrada</legend>
   <!-- begin row -->

<div class="row">
     <div class="col-md-6">
                          <div class="form-group">
                            <label>Descontos</label>
                             <select class="form-control" id="desconto" onblur="descontoss()" name="desconto">
                                       
                       <option value="">Escolha</option>
                      <?php

                      include "conexao.php";
                
                $query_amigo = "SELECT * FROM desconto_empreendimento
                 WHERE empreendimento_id = $idempreendimento order by iddesconto Asc";
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $desconto_empreendimento          = $buscar_amigo['desconto_empreendimento'];
            
              
        
             
            
             ?>
                    <option value="<?php echo "$desconto_empreendimento" ?>"> <?php echo "$desconto_empreendimento" ?>% </option>
                    <?php } ?>
                  
                                         
                                        </select>
                          </div>
                                                </div>






  <div class="col-md-6">
                          <div class="form-group">
                            <label>Valor com Desconto:</label>
                    <input type="text" class="form-control" id="valor_desconto2" disabled="disabled" value="<?php echo $valor_desconto_result ?>" />
                                        <input type="hidden" class="form-control" name="valor_desconto" id="valor_desconto" value="<?php echo $valor_desconto_result ?>" />
                          </div>
                                                </div>


</div>


   <div class="row">
    <!-- begin col-4 -->
    <div class="col-md-6">
      <div class="form-group">
        <label>Entrada /Sinal</label>
        <div class="controls">
         <input type="text"  class="form-control" id="entrada" onblur="zeracampossinal()"  name="entrada"  placeholder="(Somente Números: ex 8000)" />
       </div>
     </div>
   </div>
   <!-- end col-4 -->
   <!-- begin col-4 -->
   <div class="col-md-6">
    <div class="form-group">
      <label>Entrada</label>
      <div class="controls">
       <input type="text" required=""  class="form-control" id="entrada_restante"  name="entrada_restante" onblur="zeracamposdemais()" placeholder="(Somente Números: ex 8000)" />
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
      <label>Parcelamento Entrada</label>
      <div class="controls">
        <select class="form-control" id="parcela_entrada" required="" name="parcela_entrada" onchange="entrada_demais()">

         <option value="">Escolha</option>
         <?php

         include "conexao.php";

         $query_amigo = "SELECT * FROM parcelamento_entrada
         WHERE empreendimento_id = $idempreendimento order by idparcelamento_entrada Asc";
         $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");


            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

             $parcelamento_entrada          = $buscar_amigo['parcelamento_entrada'];



             

             ?>
             <option value="<?php echo "$parcelamento_entrada" ?>"> <?php echo "$parcelamento_entrada" ?>x </option>
             <?php } ?>

           </select>
         </div>
       </div>
     </div>
     <!-- end col-4 -->
     <!-- begin col-4 -->
     <div class="col-md-6">
      <div class="form-group">
        <label>Valor Parcela Entrada</label>
        <div class="controls">
         <input type="text" class="form-control" name="valor_parcela_entrada" id="valor_parcela_entrada" disabled=""/>
         <input type="hidden" class="form-control" name="valor_parcela_entrada2" id="valor_parcela_entrada2"/>
       </div>
     </div>
   </div>
   <!-- end col-4 -->
   <!-- begin col-4 -->

   <!-- end col-6 -->
 </div>

 <div class="row">
  <!-- begin col-4 -->
  <div class="col-md-6">
    <div class="form-group">
      <label>Vencimento 1º Parcela</label>
      <div class="controls">
        <input type="date" class="form-control" name="vencimento_primeira"  required=""  placeholder="Vencimento 1º Parcela" />
      </div>
    </div>
  </div>
  <!-- end col-4 -->
  <!-- begin col-4 -->
  <div class="col-md-6">
    <div class="form-group">
      <label>Vencimento Restante Parcelas</label>
      <div class="controls">
       <input type="date" class="form-control" name="vencimento_demais"  required=""  placeholder="Vencimento Restante das Parcelas" />
     </div>
   </div>
 </div>
 <!-- end col-4 -->
 <!-- begin col-4 -->

 <!-- end col-6 -->
</div>
</fieldset>
</div>
<!-- end wizard step-3 -->


<div class="wizard-step-3">
  <fieldset>
    <legend class="pull-left width-full">Parcelas Intermediárias:</legend>
    <!-- begin row -->
    <div class="row">
      <!-- begin col-4 -->
      <div class="col-md-6">
        <div class="form-group">
          <label>Período</label>
          <div class="controls">
           <select name="periodo_parcela" class="form-control">
            <option value="">Escolha</option>
            <option value="2">Bimestral</option>
            <option value="3">Trimestral</option>
            <option value="6">Semestral</option>
            <option value="12">Anual</option>
          </select>
        </div>
      </div>
    </div>
    <!-- end col-4 -->
    <!-- begin col-4 -->
    <div class="col-md-6">
      <div class="form-group">
        <label>Quantidade de Parcelas</label>
        <div class="controls">
         <input type="text" class="form-control" id="qtd_parcelas_intermediarias" name="qtd_parcelas_intermediarias"/>
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
      <label>Valor Parcela</label>
      <div class="controls">
       <input type="text" class="form-control" name="valor_parcela_intermediaria" id="valor_parcela_intermediaria"   />
     </div>
   </div>
 </div>
 <!-- end col-4 -->
 <div class="col-md-6">
  <div class="form-group">
    <label>Data 1º Parcela</label>
    <div class="controls">
     <input type="date" class="form-control" name="data_primeira_intermediaria" id="data_primeira_intermediaria" onchange="entrada_demais()"  />
   </div>
 </div>
</div>
<!-- begin col-4 -->

<!-- end col-4 -->
<!-- begin col-4 -->

<!-- end col-6 -->
</div>


</fieldset>
</div>















<!-- begin wizard step-4 -->
<div class="wizard-step-4">
  <fieldset>
    <legend class="pull-left width-full">Financiamento:</legend>
    <!-- begin row -->
    <div class="row">
      <!-- begin col-4 -->
      <div class="col-md-6">
        <div class="form-group">
          <label>Valor Para Parcelamento:</label>
          <div class="controls">
           <input type="text" class="form-control" disabled="disabled"  name="valor_para_parcelamento2" placeholder="Valor para Parcelamento" />
           <input type="hidden" class="form-control" id="valor_para_parcelamento"  name="valor_para_parcelamento" placeholder="Valor para Parcelamento" />
         </div>
       </div>
     </div>
     <!-- end col-4 -->
     <!-- begin col-4 -->
     <div class="col-md-6">
      <div class="form-group">
        <label>Plano de Pagamento</label>
        <div class="controls">
         <input type="text" class="form-control" id="plano_pagamento" name="plano_pagamento" onblur="resumo()" placeholder="Plano de Pagamento " />
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
      <label>Taxa do Financiamento</label>
      <div class="controls">
       <input type="text" class="form-control" value="1.0" name="taxa_financiamento" id="taxa_financiamento" placeholder="Taxa de Financiamento" />
     </div>
   </div>
 </div>
 <!-- end col-4 -->
 <!-- begin col-4 -->

 <!-- end col-4 -->
 <!-- begin col-4 -->

 <!-- end col-6 -->
</div>


</fieldset>
</div>
<!-- end wizard step-4 -->

<div class="wizard-step-5">
 <fieldset>
  <legend class="pull-left width-full">Resumo do Contrato:</legend>
  <!-- begin row -->
  <div class="row">
    <!-- begin col-4 -->
    <div class="col-md-4">
      <div class="form-group">
        <label>Valor do Lote:</label>
        <div class="controls">
         <input type="text" class="form-control" disabled="disabled"  name="resumo_valor_lote" id="resumo_valor_lote" />

       </div>
     </div>
   </div>
   <!-- end col-4 -->
   <!-- begin col-4 -->
   <div class="col-md-4">
    <div class="form-group">
      <label>Total Parcelas Entrada:</label>
      <div class="controls">
       <input type="text" class="form-control" disabled="disabled"  name="resumo_parcelas_entrada" id="resumo_parcelas_entrada" />
     </div>
   </div>
 </div>
 <div class="col-md-4">
  <div class="form-group">
    <label>Valor Parcelas Entrada:</label>
    <div class="controls">
      <input type="text" class="form-control" disabled="disabled"  name="resumo_valor_parcelas_entrada" id="resumo_valor_parcelas_entrada" />
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
      <label>Saldo Devedor Corrigido</label>
      <div class="controls">
        <input type="text" class="form-control" disabled="disabled"  name="resumo_saldo_devedor" id="resumo_saldo_devedor" />
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Total Parcelas Financiamento</label>
      <div class="controls">
        <input type="text" class="form-control" disabled="disabled"  name="resumo_parcelas_financiamento" id="resumo_parcelas_financiamento" />
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Valor Parcelas Financiamento</label>
      <div class="controls">
       <input type="text" class="form-control" disabled="disabled"  name="resumo_valor_parcelas_financiamento" id="resumo_valor_parcelas_financiamento" />
     </div>
   </div>
 </div>
 <!-- end col-4 -->
 <!-- begin col-4 -->

 <!-- end col-4 -->
 <!-- begin col-4 -->

 <!-- end col-6 -->
</div>


</fieldset>
<p><input type="submit" class="btn btn-success btn-lg" role="button" value="Confirmar Lançamento" /></p>
</div>
</div>
</form>
</div>
</div>
<!-- end panel -->
</div>
<!-- end col-12 -->
</div>
<!-- end row -->
</div>
<!-- end #content -->

<!-- begin theme-panel -->

<!-- end theme-panel -->

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
    $("#entrada").maskMoney({symbol:'R$ ', 
      showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
  })

  $(function(){
    $("#valor_parcela_intermediaria").maskMoney({symbol:'R$ ', 
      showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
  })

  $(function(){
    $("#qtd_parcelas_intermediarias").maskMoney({symbol:'R$ ', 
      showSymbol:false, thousands:'', decimal:'.', symbolStay: true});
  })

  $(function(){
    $("#entrada_restante").maskMoney({symbol:'R$ ', 
      showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
  })

  $(function(){
    $("#percentual").maskMoney({symbol:'', 
      showSymbol:true, decimal:'.', symbolStay: true});
  })

  $(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#parcela_entrada').click(function(){

    var entrada_restante = document.form_wizard.entrada_restante.value
    var entrada_restante2 = entrada_restante.replace("R$","")
    var entrada_restante3 = entrada_restante2.replace(".","")
    var entrada_restante4 = entrada_restante3.replace(" ","")
    var entrada_restante5 = entrada_restante4.replace(",",".")
    /* Configura a requisição AJAX */
    $.ajax({
      url : 'price2.php', /* URL que será chamada */ 
      type : 'GET', /* Tipo da requisição */ 
      data: 'valor=' + entrada_restante5 +'&parcelas='+ $('#parcela_entrada').val()+'&juros='+ $('#correcao_taxa_entrada').val(), /* dado que será enviado via POST */
      dataType: 'json', /* Tipo de transmissão */
      success: function(data){


        $('#valor_parcela_entrada').val(data);     
        $('#valor_parcela_entrada2').val(data);      

      }
    });   
    return false;    
  })
 });


  $(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#plano_pagamento').blur(function(){

    var entrada_restante = document.form_wizard.entrada_restante.value
    var entrada_restante2 = entrada_restante.replace("R$","")
    var entrada_restante3 = entrada_restante2.replace(".","")
    var entrada_restante4 = entrada_restante3.replace(" ","")
    var entrada_restante5 = entrada_restante4.replace(",",".")
    /* Configura a requisição AJAX */
    $.ajax({
      url : 'price2.php', /* URL que será chamada */ 
      type : 'GET', /* Tipo da requisição */ 
      data: 'valor='+ $('#valor_para_parcelamento').val()+'&parcelas='+ $('#plano_pagamento').val()+'&juros='+ $('#taxa_financiamento').val(), /* dado que será enviado via POST */
      dataType: 'json', /* Tipo de transmissão */
      success: function(data){


       $('#resumo_valor_parcelas_financiamento').val(data);     

     }
   });   
    return false;    
  })
 });
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
  <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
  <!-- ================== END BASE JS ================== -->

  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/parsley/dist/parsley.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/js/form-wizards-validation.demo.min.js"></script>
  <script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

  <script type='text/javascript' src='cep.js'></script>
  <script type='text/javascript' src='produtos.js'></script>
  <script type='text/javascript' src='lote.js'></script>
  <script type='text/javascript' src='medidas.js'></script>
  <!-- ================== END PAGE LEVEL JS ================== -->

  <script>
    $(document).ready( function() {
     /* Executa a requisição quando o campo CEP perder o foco */
     $('#masked-input-cpf').blur(function(){
       /* Configura a requisição AJAX */
       $.ajax({
        url : 'consultar_cpf.php', /* URL que será chamada */ 
        type : 'POST', /* Tipo da requisição */ 
        data: 'cpf=' + $('#masked-input-cpf').val(), /* dado que será enviado via POST */
        dataType: 'json', /* Tipo de transmissão */
        success: function(data){
          if(data.sucesso == 1){               

            alert('Cliente já cadastrado. Grupo: '+ data.categoria_cliente);

            $('#masked-input-cpf').val('');

          }
        }
      });   
       return false;    
     })
   });


 $(document).ready( function() {
  $("#masked-input-cpf2").mask("999.999.999-99"),
     /* Executa a requisição quando o campo CEP perder o foco */
     $('#masked-input-cpf2').blur(function(){
       /* Configura a requisição AJAX */
       $.ajax({
        url : 'consultar_cpf.php', /* URL que será chamada */ 
        type : 'POST', /* Tipo da requisição */ 
        data: 'cpf=' + $('#masked-input-cpf2').val(), /* dado que será enviado via POST */
        dataType: 'json', /* Tipo de transmissão */
        success: function(data){
          if(data.sucesso == 1){               

            alert('Cliente já cadastrado. Grupo: '+ data.categoria_cliente);

            $('#masked-input-cpf2').val('');

          }
        }
      });   
       return false;    
     })
   });



    $(document).ready(function() {
     App.init();
     FormWizardValidation.init();
     FormPlugins.init();

   });
 </script>

</body>


</html>
