<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );

function valor_futuro($n, $taxa){
$P = 1;
$M ='';
$i =($taxa/100);

$parte1 = (1+$i)**$n-1;
$parte2 = $P*(1+$i)**$n;
$F = $parte2 + $M*$parte1/$i;
$result = $F -1;

$result_mesmo = $result*100;

return $result_mesmo;
}
/*
F = valor futuro (também chamado VF ou FV)
P = valor presente (também chamado VA ou PV)
M = mensalidade (ou outro pagamento periódico, também chamado PGTO ou PMT)
n = número de períodos (em dias, meses, anos, ..., também chamado NPER)
i = taxa de juros (normalmente na forma percentual, também chamado TAXA ou RATE)
*/

function Price($Valor, $Parcelas, $Juros) {



$Juros = bcdiv($Juros,100,15);
$E=1.0;
$cont=1.0;

for($k=1;$k<=$Parcelas;$k++)
{
$cont= bcmul($cont,bcadd($Juros,1,15),15);
$E=bcadd($E,$cont,15);
}
$E=bcsub($E,$cont,15);

$Valor = bcmul($Valor,$cont,15);
return bcdiv($Valor,$E,15);
}


$percen_inter = $_GET["percen_inter"];
$taxa_inter   = $_GET["taxa_inter"];

$valor_lote   = $_GET["valor_lote"];
$qtd_inter    = $_GET["qtd_inter"];
$tipo_periodo = $_GET["tipo_periodo"];

$valor_inter = ($percen_inter /100)*$valor_lote;

$result_mesmo = valor_futuro($tipo_periodo, $taxa_inter);
$valor_parcela_intermediaria = Price($valor_inter, $qtd_inter, $result_mesmo);
$valor_parcela_intermediaria = number_format($valor_parcela_intermediaria, 2, '.', '');
echo $valor_parcela_intermediaria;


?>