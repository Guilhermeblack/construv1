<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<META http-equiv="X-UA-Compatible" content="IE=8">
<TITLE>QuadroResumo-R-13.htm</TITLE>
<!-- #include virtual="/convert-pdf-to-html/includes/pdf-to-word-head-tag.htm" -->
<META name="generator" content="BCL easyConverter SDK 5.0.08">
<STYLE type="text/css">

body {margin-top: 0px;margin-left: 0px;}

#page_1 {position:relative; overflow: hidden;margin: 28px 0px 47px 55px;padding: 0px;border: none;width: 761px;}

#page_1 #p1dimg1 {position:absolute;top:0px;left:0px;z-index:-1;width:684px;height:800px;}
#page_1 #p1dimg1 #p1img1 {width:684px;height:800px;}




.dclr {clear:both;float:none;height:1px;margin:0px;padding:0px;overflow:hidden;}

.ft0{font: bold 15px 'Arial';line-height: 18px;}
.ft1{font: 1px 'Arial';line-height: 1px;}
.ft2{font: 15px 'Arial';line-height: 17px;}
.ft3{font: bold 15px 'Arial';line-height: 17px;}
.ft4{font: 1px 'Arial';line-height: 2px;}
.ft5{font: 15px 'Arial';line-height: 16px;}
.ft6{font: 1px 'Arial';line-height: 16px;}
.ft7{font: 15px 'Arial';margin-left: 4px;line-height: 17px;}
.ft8{font: 15px 'Calibri';line-height: 18px;}
.ft9{font: bold 16px 'Calibri';line-height: 19px;}
.ft10{font: bold 15px 'Calibri';line-height: 18px;}

.p0{text-align: left;padding-left: 285px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p1{text-align: left;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p2{text-align: left;padding-left: 2px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p3{text-align: left;padding-left: 60px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p4{text-align: left;padding-left: 1px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p5{text-align: left;padding-left: 288px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p6{text-align: left;padding-left: 58px;margin-top: 16px;margin-bottom: 0px;}
.p7{text-align: left;padding-left: 60px;margin-top: 0px;margin-bottom: 0px;}
.p8{text-align: left;padding-left: 2px;margin-top: 19px;margin-bottom: 0px;}
.p9{text-align: left;padding-left: 56px;margin-top: 0px;margin-bottom: 0px;}
.p10{text-align: left;padding-left: 2px;margin-top: 0px;margin-bottom: 0px;}
.p11{text-align: left;padding-left: 2px;margin-top: 1px;margin-bottom: 0px;}
.p12{text-align: left;padding-left: 2px;padding-right: 79px;margin-top: 0px;margin-bottom: 0px;}
.p13{text-align: left;padding-left: 2px;padding-right: 80px;margin-top: 2px;margin-bottom: 0px;}
.p14{text-align: left;padding-left: 2px;margin-top: 18px;margin-bottom: 0px;}
.p15{text-align: left;padding-left: 14px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p16{text-align: left;padding-left: 16px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p17{text-align: left;padding-left: 292px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p18{text-align: right;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}

.td0{padding: 0px;margin: 0px;width: 421px;vertical-align: bottom;}
.td1{padding: 0px;margin: 0px;width: 263px;vertical-align: bottom;}
.td2{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 421px;vertical-align: bottom;}
.td3{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 263px;vertical-align: bottom;}
.td4{padding: 0px;margin: 0px;width: 403px;vertical-align: bottom;}
.td5{padding: 0px;margin: 0px;width: 278px;vertical-align: bottom;}

.tr0{height: 20px;}
.tr1{height: 18px;}
.tr2{height: 17px;}
.tr3{height: 2px;}
.tr4{height: 16px;}
.tr5{height: 35px;}
.tr6{height: 44px;}
.tr7{height: 36px;}

.t0{width: 684px;margin-top: 72px;font: 15px 'Arial';}
.t1{width: 681px;margin-left: 2px;margin-top: 31px;font: 15px 'Arial';}

</STYLE>
</HEAD>
<SCRIPT>
window.print();
</SCRIPT>
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
?>
<BODY>
<!-- #include virtual="/convert-pdf-to-html/includes/pdf-to-word-body-tag-02242014.htm" -->
<DIV id="page_1">


 <?php
 $idvenda = $_GET["idvenda"];
                      include_once "conexao.php";
                $query_amigo = "SELECT * FROM venda 
                INNER JOIN cliente ON cliente.idcliente = venda.cliente_idcliente
                INNER JOIN lote ON lote.idlote = venda.lote_idlote
                INNER JOIN produto ON  lote.produto_idproduto = produto.idproduto
                where venda.idvenda = $idvenda";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar cliente");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            


$nome_cli			= $buscar_amigo["nome_cli"];
$cpf_cli			= $buscar_amigo["cpf_cli"];
$rg_cli				= $buscar_amigo["rg_cli"];
$estadocivil_cli	= $buscar_amigo["estadocivil_cli"];
$nacionalidade_cli	= $buscar_amigo["nacionalidade_cli"];
$profissao_cli		= $buscar_amigo["profissao_cli"];
$nascimento_cli		= $buscar_amigo["nascimento_cli"];
$email_cli			= $buscar_amigo["email_cli"];
$cidade_cli			= $buscar_amigo["cidade_cli"];
$logradouro_cli		= $buscar_amigo["logradouro_cli"];
$endereco_cli		= $buscar_amigo["endereco_cli"];
$numero_cli			= $buscar_amigo["numero_cli"];
$complemento_cli	= $buscar_amigo["complemento_cli"];
$bairro_cli			= $buscar_amigo["bairro_cli"];
$complemento_cli 	= $buscar_amigo["complemento_cli"];
$telefone1_cli		= $buscar_amigo["telefone1_cli"];
$telefone2_cli		= $buscar_amigo["telefone2_cli"];

$nome_con			= $buscar_amigo["nome_con"];
$cpf_con			= $buscar_amigo["cpf_con"];
$rg_con				= $buscar_amigo["rg_con"];
$profissao_con		= $buscar_amigo["profissao_con"];
$nascionalidade_con	= $buscar_amigo["nascionalidade_con"];
$nascimento_con		= $buscar_amigo["nascimento_con"];

$cep_cli		= $buscar_amigo["cep_cli"];
$nascimento_con		= $buscar_amigo["nascimento_con"];

$lote		= $buscar_amigo["lote"];
$m2			= $buscar_amigo["m2"];
$frente		= $buscar_amigo["frente"];
$fundo		= $buscar_amigo["fundo"];
$esquerda	= $buscar_amigo["esquerda"];
$direita 	= $buscar_amigo["direita"];

$quadra 	= $buscar_amigo["quadra"];

$valor 	= $buscar_amigo["valor"];
        
             
            }
             ?>










<DIV class="dclr"></DIV>
<TABLE cellpadding=0 cellspacing=0 class="t0">
<TR>
	<TD class="tr0 td0"><P class="p0 ft0">Proposta de Compra</P></TD>
	<TD class="tr0 td1"><P class="p1 ft1">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr1 td2"><P class="p2 ft2">Nº Ficha: <?php echo " $idvenda"; ?></P></TD>
	<TD class="tr1 td3"><P class="p1 ft1"></P></TD>
</TR>
<TR>
	<TD class="tr2 td0"><P class="p2 ft3">Item 1: Qualificação do Contratante</P></TD>
	<TD class="tr2 td1"><P class="p1 ft1">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td2"><P class="p1 ft4">&nbsp;</P></TD>
	<TD class="tr3 td3"><P class="p1 ft4">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr4 td0"><P class="p3 ft5">Nome:<?php echo " $nome_cli"; ?></P></TD>
	<TD class="tr4 td1"><P class="p1 ft6">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr2 td0"><P class="p3 ft2">Endereço:<?php echo " $endereco_cli"; ?>, <?php echo " $numero_cli"; ?>,</P></TD>
	<TD class="tr2 td1"><P class="p1 ft1">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr2 td0"><P class="p3 ft2">Bairro:<?php echo " $bairro_cli"; ?></P></TD>
	<TD class="tr2 td1"><P class="p1 ft2">CEP: <NOBR><?php echo " $cep_cli"; ?></NOBR></P></TD>
</TR>
<TR>
	<TD class="tr4 td0"><P class="p3 ft5">Cidade:<?php echo " $cidade_cli"; ?></P></TD>
	<TD class="tr4 td1"><P class="p1 ft5"></P></TD>
</TR>
<TR>
	<TD class="tr2 td0"><P class="p3 ft2"><NOBR>CPF:<?php echo " $cpf_cli"; ?></NOBR></P></TD>
	<TD class="tr2 td1"><P class="p4 ft2">RG:<?php echo " $rg_cli"; ?></P></TD>
</TR>
<TR>
	<TD class="tr2 td0"><P class="p3 ft2">Profissão: <?php echo " $profissao_cli"; ?></P></TD>
	<TD class="tr2 td1"><P class="p1 ft1">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr2 td0"><P class="p3 ft2">Nacionalidade: BRASILEIRO</P></TD>
	<TD class="tr2 td1"><P class="p1 ft1">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr2 td0"><P class="p3 ft2">Estado Civil: <?php echo " $estadocivil_cli"; ?></P></TD>
	<TD class="tr2 td1"><P class="p1 ft1">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr5 td0"><P class="p5 ft0">Dados Cônjuge</P></TD>
	<TD class="tr5 td1"><P class="p1 ft1">&nbsp;</P></TD>
</TR>
</TABLE>
<P class="p6 ft2">Nome: <?php echo " $nome_con"; ?></P>
<P class="p7 ft2">CPF : <NOBR><?php echo " $cpf_con"; ?></NOBR><SPAN style="padding-left:155px;">RG: <?php echo " $rg_con"; ?></SPAN></P>
<P class="p7 ft2">Nacionalidade: BRASILEIRO</P>
<P class="p8 ft0">Item 2: Descrição do Produto: Lote</P>
<P class="p9 ft2">Código produto: <?php echo " $idvenda"; ?></P>
<P class="p9 ft2">Quadra:<?php echo " $quadra"; ?> Lote:<?php echo " $lote"; ?> Àrea Total: <?php echo " $m2"; ?> m2</P>

<P class="p10 ft3">Dimensão</P>
<P class="p10 ft2">À frente: <?php echo " $frente"; ?> m</P>
<P class="p10 ft5">Ao fundo: <?php echo " $fundo"; ?> m</P>
<P class="p10 ft2"><SPAN class="ft2"></SPAN><SPAN class="ft7">direita: <?php echo " $direita"; ?> m</SPAN></P>
<P class="p10 ft2"><SPAN class="ft2"></SPAN><SPAN class="ft7">esquerda: <?php echo " $esquerda"; ?> m</SPAN></P>





<P class="p8 ft0">Item 3: Preços e Formas de Pagamento</P>
<?php

//$texto_valor = extenso($valor_total);


?>

<P class="p11 ft2">Valor Total:<?php echo 'R$' . number_format($valor, 2, ',', '.');  ?></P>




<P class="p12 ft5">Entrada: 
 <?php

                      include_once "conexao.php";
                $query_amigo = "SELECT * FROM parcelas 
               
                where venda_idvenda = $idvenda AND descricao = 'Parcelamento Entrada'";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar cliente");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            


$valor_parcelas			= $buscar_amigo["valor_parcelas"];
$data_vencimento_parcela			= $buscar_amigo["data_vencimento_parcela"];


?>
 de <?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.');  ?> no dia <?php echo "$data_vencimento_parcela" ?>,

 <?php } ?>



</P>
<P class="p13 ft2">



 <?php

                      include_once "conexao.php";
                $query_amigo = "SELECT data_vencimento_parcela, valor_parcelas, count(idparcelas) as total_parcelas FROM parcelas 
               
                where venda_idvenda = $idvenda AND descricao = 'Financiamento'";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar cliente");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            


$total_parcelas			= $buscar_amigo["total_parcelas"];
$valor_parcelas			= $buscar_amigo["valor_parcelas"];
$data_vencimento_parcela			= $buscar_amigo["data_vencimento_parcela"];
}
$texto_valor = extenso($valor_parcelas);


$dia_vencimento =  substr("$data_vencimento_parcela", 0, 2);

?>




<?php echo "$total_parcelas"; ?> prestações mensais de <?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.');  ?> (<?php echo "$texto_valor"; ?>), pagáveis no dia <?php echo $dia_vencimento; ?>  de cada mês.</P>
<P class="p14 ft0">Item 4: Índice de Correção e Periodicidade do Reajuste</P>
<P class="p11 ft2">ANUAL - INCC</P>
<TABLE cellpadding=0 cellspacing=0 class="t1">
<TR>
	<TD class="tr0 td4"><P class="p1 ft2">_______________________________</P></TD>
	<TD class="tr0 td5"><P class="p15 ft2">_______________________________</P></TD>
</TR>
<TR>
	<TD class="tr4 td4"><P class="p1 ft5">Vendedor:</P></TD>
	<TD class="tr4 td5"><P class="p16 ft5">Comprador:</P></TD>
</TR>
<TR>
	<TD class="tr2 td4"><P class="p1 ft2"> Empreendimentos Imobiliários Ltda.</P></TD>
	<TD class="tr2 td5"><P class="p16 ft2"></P></TD>
</TR>
<TR>
	<TD class="tr6 td4"><P class="p17 ft8">Quadro Resumo</P></TD>
	<TD class="tr6 td5"><P class="p1 ft1">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr7 td4"><P class="p1 ft1">&nbsp;</P></TD>
	<TD class="tr7 td5"><P class="p18 ft10">1<SPAN class="ft9">/</SPAN>1</P></TD>
</TR>
</TABLE>
</DIV>
<DIV style="padding: 50px 0px 15px 20px; font-family: Arial, Helvetica, sans-serif; font-size: 8px;">
	
</DIV>
<!-- #include virtual="/convert-pdf-to-html/includes/pdf-to-word-body-tag-between-content.htm" --></BODY>
</HTML>
