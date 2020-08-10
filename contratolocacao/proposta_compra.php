<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "../protege_professor.php";
?>


<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Immobile business</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="../assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="../assets/css/animate.min.css" rel="stylesheet" />
	<link href="../assets/css/style.min.css" rel="stylesheet" />
	<link href="../assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="../assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE CSS ================== -->
	
	<!-- ================== END PAGE CSS ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="../assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	 <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=shgcpb5mcjj2aclo6xy02pw1nff4235ewyrdu7x558wq6xcs"></script>
  <script>

  	tinymce.init({
  selector: "textarea",  // change this value according to your HTML
  plugins: "print",
  menubar: "file",
  toolbar: "print|newdocument| undo| redo| cut| copy| paste| selectall| bold| italic| underline|strikethrough| subscript| superscript| removeformat| formats | alignleft aligncenter alignright"

});

  	


	</script>


</head>
<body>

	<?php
function extenso($valor=0, $maiusculas=false) {
        // verifica se tem virgula decimal
        if (strpos($valor, ",") > 0) {
                // retira o ponto de milhar, se tiver
                $valor = str_replace(".", "", $valor);

                // troca a virgula decimal por ponto decimal
                $valor = str_replace(",", ".", $valor);
        }
        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões",
                "quatrilhões");

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
                "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
                "sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
                "dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis",
                "sete", "oito", "nove");

        $z = 0;

        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        $cont = count($inteiro);
        for ($i = 0; $i < $cont; $i++)
                for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
                $inteiro[$i] = "0" . $inteiro[$i];

        $fim = $cont - ($inteiro[$cont - 1] > 0 ? 1 : 2);
        $rt = '';
        for ($i = 0; $i < $cont; $i++) {
                $valor = $inteiro[$i];
                $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
                $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
                $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

                $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                        $ru) ? " e " : "") . $ru;
                $t = $cont - 1 - $i;
                $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
                if ($valor == "000"

                )$z++; elseif ($z > 0)
                $z--;
                if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
                $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
                if ($r)
                $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                        ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        if (!$maiusculas) {
                return($rt ? $rt : "zero");
        } elseif ($maiusculas == "2") {
                return (strtoupper($rt) ? strtoupper($rt) : "Zero");
        } else {
                return (ucwords($rt) ? ucwords($rt) : "Zero");
        }
        }

       $idvenda = $_GET["idvenda"];
                      include "../conexao.php";
                $query_amigo = "SELECT * FROM venda
                INNER JOIN cliente ON cliente.idcliente = venda.cliente_idcliente
                INNER JOIN lote ON lote.idlote = venda.lote_idlote
                INNER JOIN produto ON  lote.produto_idproduto = produto.idproduto
                INNER JOIN empreendimento ON  produto.empreendimento_idempreendimento = empreendimento.idempreendimento
                INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                
                where venda.idvenda = $idvenda";

                $executa_query = mysqli_query ($db, $query_amigo);
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            

$idcliente          = $buscar_amigo["idcliente"];
$nome_cli     = $buscar_amigo["nome_cli"];
$cpf_cli      = $buscar_amigo["cpf_cli"];
$rg_cli       = $buscar_amigo["rg_cli"];
$estadocivil_cli  = $buscar_amigo["estadocivil_cli"];
$nacionalidade_cli  = $buscar_amigo["nacionalidade_cli"];
$profissao_cli    = $buscar_amigo["profissao_cli"];
$nascimento_cli   = $buscar_amigo["nascimento_cli"];
$email_cli      = $buscar_amigo["email_cli"];
$cidade_cli     = $buscar_amigo["cidade_cli"];
$logradouro_cli   = $buscar_amigo["logradouro_cli"];
$endereco_cli   = $buscar_amigo["endereco_cli"];
$numero_cli     = $buscar_amigo["numero_cli"];
$complemento_cli  = $buscar_amigo["complemento_cli"];
$bairro_cli     = $buscar_amigo["bairro_cli"];
$complemento_cli  = $buscar_amigo["complemento_cli"];
$telefone1_cli    = $buscar_amigo["telefone1_cli"];
$telefone2_cli    = $buscar_amigo["telefone2_cli"];
$cep_cli        = $buscar_amigo["cep_cli"];
$estado_cli       = $buscar_amigo["estado_cli"];
$renda_total       = $buscar_amigo["renda_total"];
$renda_total =  'R$ ' . number_format($renda_total, 2, ',', '.');  

$lote            = $buscar_amigo["lote"];
$m2              = $buscar_amigo["m2"];
$frente            = $buscar_amigo["frente"];
$fundo             = $buscar_amigo["fundo"];
$esquerda          = $buscar_amigo["esquerda"];
$direita           = $buscar_amigo["direita"];

$proposta_compra              = $buscar_amigo["proposta_compra"];
$matricula_empreendimento     = $buscar_amigo["matricula_empreendimento"];
$img_lote                     = $buscar_amigo["img_lote"];
$idempreendimento_cadastro    = $buscar_amigo["idempreendimento_cadastro"];
$descricao_empreendimento     = $buscar_amigo["descricao_empreendimento"];
$matricula                    = $buscar_amigo["matricula"];
$cadastro_prefeitura          = $buscar_amigo["cadastro_prefeitura"];
$confrontacao                 = $buscar_amigo["confrontacao"];
$quadra                       = $buscar_amigo["quadra"];
$valor                        = $buscar_amigo["valor"];
$data_venda                   = $buscar_amigo["data_venda"];
        
$valor_total_entrada3         = $buscar_amigo["valor_entrada"];  // SINAL
$valor_desconto               = $buscar_amigo["valor_desconto"];   // VALOR DO LOTE A SER FINANCI   
$valor_total_entrada4         = $buscar_amigo["entrada_restante"];  // ENTRADA NORMAL TOTAL

$qtd_parcelas_entrada         = $buscar_amigo["parcela_entrada"]; // QUANTIDADE ENTRADA NORMAL
$qtd_parcelas_financiamento   = $buscar_amigo["plano_pagamento"]; // QUANTIDADE FINANCIAMENTO
$valor_parcela_financiamento  = $buscar_amigo["valor_parcela_financiamento"];  // VALOR DA PARCELA DO FINAN
$valor_parcela_entrada        = $buscar_amigo["valor_parcela_entrada"]; // VALOR DA PARCELA JA NA PRICE

$inter_qtd                    = $buscar_amigo["inter_qtd"]; // Quantidade parcelas intermediarias
$inter_valor                  = $buscar_amigo["inter_valor"]; // valor da parcela intermediaria
$inter_data                   = $buscar_amigo["inter_data"]; // data da primeira intermediaria
$inter_periodo                = $buscar_amigo["inter_periodo"]; // data da primeira intermediaria

$imobiliaria_idimobiliaria    = $buscar_amigo["imobiliaria_idimobiliaria"]; 



      $data_venda    = explode("-", $data_venda);
      $dia_contrato        = $data_venda[0];
      $mes_contrato        = intval($data_venda[1]);
      $ano_contrato        = $data_venda[2];


      $dia_fin    = explode("-", $inter_data);
      $dia_vencimento_primeira_financiamento        = $dia_fin[0];
  

$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");


 $nome_mes = $meses[$mes_contrato];



$valor_entrada = 'R$ ' . number_format($valor_total_entrada4, 2, ',', '.'); 

$inter_valor_parcela = 'R$ ' . number_format($inter_valor, 2, ',', '.');  


$valor_parcela_financiamento  = 'R$ ' . number_format($valor_parcela_financiamento, 2, ',', '.');

$valor_sinal = 'R$ ' . number_format($valor_total_entrada3, 2, ',', '.');
$valor_parcela_entrada = 'R$ ' . number_format($valor_parcela_entrada, 2, ',', '.');

$vencimento_primeira          = $buscar_amigo["vencimento_primeira"];
$vencimento_restante          = $buscar_amigo["vencimento_restante"];
$idempreendimento             = $buscar_amigo["idempreendimento"]; 

$valor_total_entrada          = $valor_total_entrada3 + $valor_total_entrada4;

if($valor_total_entrada3 != ''){
    $data_vencimento_primeira_financiamento = date('d-m-Y', strtotime("+".($parcela_entrada)." month", strtotime($vencimento_restante)));
}else{
       $data_vencimento_primeira_financiamento  = date('d-m-Y', strtotime("+".($parcela_entrada-1)." month", strtotime($vencimento_restante)));

           }
}


 $query_amigo_cli = "SELECT * FROM conjuge
                     INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                     WHERE cliente_idcliente = $idcliente";


        
                $executa_query_cli = mysqli_query ($db,$query_amigo_cli);
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {//--verifica se são amigos
               
                 
                  $nome_con           = $buscar_amigo["nome_cli"];
                  $cpf_con            = $buscar_amigo["cpf_cli"];
                  $rg_con             = $buscar_amigo["rg_cli"];
                  $nacionalidade_con  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_con      = $buscar_amigo["profissao_cli"];
                  $nascimento_con     = $buscar_amigo["nascimento_cli"];
               
}

 function nome_quem_vendeu($idcliente){

  include "../conexao.php";
  $query_amigo_cli = "SELECT * FROM cliente
                      WHERE idcliente = $idcliente";
        
  $executa_query_cli = mysqli_query ($db,$query_amigo_cli);
  while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {
               
      $nome_cli           = $buscar_amigo["nome_cli"];
      $cpf_cli            = $buscar_amigo["cpf_cli"];
      $creci              = $buscar_amigo["creci"];
  }

      $dados["nome_cli"] = $nome_cli;
      $dados["cpf_cli"]  = $cpf_cli;
      $dados["creci"]    = $creci;
  return $dados;
}
                     
function quem_vendeu($id_vendeu){

  include "../conexao.php";
  $query_amigo_cli = "SELECT * FROM cliente
                      WHERE idcliente = $id_vendeu";
        
  $executa_query_cli = mysqli_query ($db,$query_amigo_cli);
  while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {
               
      $imob_id           = $buscar_amigo["imob_id"];
  }
  return $imob_id;
}


$quem_vendeu = quem_vendeu($imobiliaria_idimobiliaria);

if($quem_vendeu == 0){
  $dados_vendeu = nome_quem_vendeu($imobiliaria_idimobiliaria);
  $vendedora  = $dados_vendeu["nome_cli"];
  $cpf_exibe   = $dados_vendeu["cpf_cli"];
  $creci_exibe = $dados_vendeu["creci"];
}else{
  $dados_vendeu = nome_quem_vendeu($quem_vendeu);
  $vendedora  = $dados_vendeu["nome_cli"];
  $cpf_exibe   = $dados_vendeu["cpf_cli"];
  $creci_exibe = $dados_vendeu["creci"];
}


function dados_proponente($idcliente){
  include "../conexao.php";
   $query_amigo_cli = "SELECT * FROM cliente
                       WHERE idcliente = $idcliente";


        
                $executa_query_cli = mysqli_query ($db,$query_amigo_cli);
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {//--verifica se são amigos
               
                 
                  $nome_cli           = $buscar_amigo["nome_cli"];
                  $cpf_cli            = $buscar_amigo["cpf_cli"];
                  $rg_cli             = $buscar_amigo["rg_cli"];
                  $nacionalidade_cli  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_cli      = $buscar_amigo["profissao_cli"];
                  $nascimento_cli     = $buscar_amigo["nascimento_cli"];

                  $email_cli          = $buscar_amigo["email_cli"];
                  $cidade_cli         = $buscar_amigo["cidade_cli"];
                  $endereco_cli       = $buscar_amigo["endereco_cli"];
                  $numero_cli         = $buscar_amigo["numero_cli"];
                  $complemento_cli    = $buscar_amigo["complemento_cli"];
                  $bairro_cli         = $buscar_amigo["bairro_cli"];
                  $telefone1_cli      = $buscar_amigo["telefone1_cli"];
                  $telefone2_cli      = $buscar_amigo["telefone2_cli"];
                  $estado_cli         = $buscar_amigo["estado_cli"];
               
}
                  $dados["nome_cli"]           = $nome_cli;
                  $dados["cpf_cli"]            = $cpf_cli;
                  $dados["rg_cli"]             = $rg_cli;
                  $dados["nacionalidade_cli"]  = $nacionalidade_cli;
                  $dados["profissao_cli"]      = $profissao_cli;
                  $dados["nascimento_cli"]     = $nascimento_cli;
                  $dados["email_cli"]          = $email_cli;
                  $dados["cidade_cli"]         = $cidade_cli;
                  $dados["endereco_cli"]       = $endereco_cli;
                  $dados["numero_cli"]         = $numero_cli;
                  $dados["complemento_cli"]    = $complemento_cli;
                  $dados["bairro_cli"]         = $bairro_cli;
                  $dados["telefone1_cli"]      = $telefone1_cli;
                  $dados["telefone2_cli"]      = $telefone2_cli;
                  $dados["estado_cli"]         = $estado_cli;

                  return $dados;
}



function consultar_cessao($venda_id, $cliente_id){

  include "../conexao.php";
  $query_amigo_cli = "SELECT * FROM proprietarios_lote
                      WHERE cliente_id = $cliente_id AND venda_id = $venda_id";
        
  $executa_query_cli = mysqli_query ($db,$query_amigo_cli);
  while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {
               
      $cod_cessao           = $buscar_amigo["cod_cessao"];
  }
  return $cod_cessao;
}
function conta_socio($codigo_cessao){

  include "../conexao.php";
  $query_cessao = mysqli_query($db, "SELECT * FROM proprietarios_lote
                      WHERE cod_cessao = $codigo_cessao");
        
    $total = mysqli_num_rows($query_cessao);
  
  return $total;
}

function tem_conjuge($cliente_id){
 include "../conexao.php";
   $query_conjuge = mysqli_query($db, "SELECT COUNT(idconjuge) as total, conjuge_idconjuge FROM conjuge
                     INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                     WHERE cliente_idcliente = $cliente_id");

  while ($buscar_amigo = mysqli_fetch_assoc($query_conjuge)) {
               
      $conjuge_idconjuge  = $buscar_amigo["conjuge_idconjuge"];
      $total              = $buscar_amigo["total"];
  }
        
        $dados["conjuge_idconjuge"] = $conjuge_idconjuge;
        $dados["total"] = $total;

                

return $dados;
}

 include "../conexao.php";
   $query_contrato = mysqli_query($db, "SELECT conteudo FROM modelo_contrato");

  while ($buscar_amigo = mysqli_fetch_assoc($query_contrato)) {
               
      $conteudo  = $buscar_amigo["conteudo"];
  }

function trocar_conteudo($conteudo, $nome_cli, $rg_cli, $cpf_cli, $nacionalidade_cli, $profissao_cli, $nascimento_cli, $estadocivil_cli, $renda_total,$cep_cli, $endereco_cli, $numero_cli, $bairro_cli, $cidade_cli, $estado_cli, $telefone1_cli, $telefone2_cli, $nome_con, $rg_con, $cpf_con, $nacionalidade_con, $profissao_con, $nascimento_con, $descricao_empreendimento, $matricula_empreendimento, $quadra, $lote, $m2, $cadastro_prefeitura, $matricula, $confrontacao, $valor_sinal, $valor_entrada, $qtd_parcelas_entrada, $valor_parcela_entrada, $vencimento_primeira,$qtd_parcelas_financiamento, $valor_parcela_financiamento, $data_vencimento_primeira_financiamento, $vendedora, $dia_contrato, $mes_contrato, $ano_contrato, $dia_vencimento_primeira_financiamento, $email_cli) { 

  $a = array('@nome_cli', '@rg_cli', '@cpf_cli', '@nacionalidade_cli', '@profissao_cli', '@nascimento_cli', '@estadocivil_cli', '@renda_total','@cep_cli', '@endereco_cli', '@numero_cli', '@bairro_cli', '@cidade_cli', '@estado_cli', '@telefone1_cli', '@telefone2_cli', '@nome_con', '@rg_con', '@cpf_con', '@nacionalidade_con', '@profissao_con', '@nascimento_con', '@descricao_empreendimento', '@matricula_empreendimento', '@quadra', '@lote', '@m2', '@cadastro_prefeitura', '@matricula', '@confrontacao', '@valor_sinal', '@valor_entrada', '@qtd_parcelas_entrada', '@valor_parcela_entrada', '@vencimento_primeira','@qtd_parcelas_financiamento', '@valor_parcela_financiamento', '@data_vencimento_primeira_financiamento', '@vendedora', '@dia_contrato', '@mes_contrato', '@ano_contrato','@dia_vencimento_primeira_financiamento', '@email_cli'); 
  $b = array($nome_cli, $rg_cli, $cpf_cli, $nacionalidade_cli, $profissao_cli, $nascimento_cli, $estadocivil_cli, $renda_total,$cep_cli, $endereco_cli, $numero_cli, $bairro_cli, $cidade_cli, $estado_cli, $telefone1_cli, $telefone2_cli, $nome_con, $rg_con, $cpf_con, $nacionalidade_con, $profissao_con, $nascimento_con, $descricao_empreendimento, $matricula_empreendimento, $quadra, $lote, $m2, $cadastro_prefeitura, $matricula, $confrontacao, $valor_sinal, $valor_entrada, $qtd_parcelas_entrada, $valor_parcela_entrada, $vencimento_primeira,$qtd_parcelas_financiamento, $valor_parcela_financiamento, $data_vencimento_primeira_financiamento, $vendedora, $dia_contrato, $mes_contrato, $ano_contrato, $dia_vencimento_primeira_financiamento, $email_cli); 
  return str_replace($a, $b, $conteudo); 
} 

$trocar = trocar_conteudo($conteudo, $nome_cli, $rg_cli, $cpf_cli, $nacionalidade_cli, $profissao_cli, $nascimento_cli, $estadocivil_cli, $renda_total,$cep_cli, $endereco_cli, $numero_cli, $bairro_cli, $cidade_cli, $estado_cli, $telefone1_cli, $telefone2_cli, $nome_con, $rg_con, $cpf_con, $nacionalidade_con, $profissao_con, $nascimento_con, $descricao_empreendimento, $matricula_empreendimento, $quadra, $lote, $m2, $cadastro_prefeitura, $matricula, $confrontacao, $valor_sinal, $valor_entrada, $qtd_parcelas_entrada, $valor_parcela_entrada, $vencimento_primeira,$qtd_parcelas_financiamento, $valor_parcela_financiamento, $inter_data, $vendedora, $dia_contrato, $nome_mes, $ano_contrato, $dia_vencimento_primeira_financiamento, $email_cli);

$codigo_cessao = consultar_cessao($idvenda, $idcliente);
$conta_socio   = conta_socio($codigo_cessao);

$html ="<p style='text-align: center'><img height='90' src='../img/$idempreendimento_cadastro/$img_lote'>

$trocar</p>
";


?>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
		<!-- begin #header -->
<?php include "../topo.php" ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Contrato </h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			   
			   
			    <!-- begin col-10 -->
			    <div class="col-md-12">
                    <div class="panel panel-inverse m-b-0">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">IMPRIMIR</h4>
                        </div>
                        <div class="panel-body p-0">
                                <textarea name="conteudo" rows="200"><?php echo $html ?></textarea>
                                
                            </form>
                        </div>
                    </div>
			    </div>
			    <!-- end col-10 -->
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
	<script src="../assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="../assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="../assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="../assets/crossbrowserjs/html5shiv.js"></script>
		<script src="../assets/crossbrowserjs/respond.min.js"></script>
		<script src="../assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->

	<script src="../assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		
		});
	</script>

</body>


</html>
