

<?php
// Funcao para Calcular valor da Parcela - Tabela Price
$saldo_devedor 		 = $_GET["saldo_devedor"];
$entrada_renegociar  = $_GET["entrada_renegociar"];
$qtd_renegociar 	 = $_GET["qtd_renegociar"];
$taxa_renegociar 	 = $_GET["taxa_renegociar"];
$tarifas 	         = $_GET["tarifas"];

if($tarifas != ''){

$tarifas = str_replace("R$","", $tarifas);
$tarifas = str_replace(".","",  $tarifas);
$tarifas = str_replace(",",".", $tarifas);

}else{
	$tarifas = 0;
}



if($entrada_renegociar != ''){

$entrada_renegociar = str_replace("R$","", $entrada_renegociar);
$entrada_renegociar = str_replace(".","",  $entrada_renegociar);
$entrada_renegociar = str_replace(",",".", $entrada_renegociar);

}else{
	$entrada_renegociar = 0;
}



$Valor 		= $saldo_devedor - $entrada_renegociar + $tarifas;
$Parcelas   = $qtd_renegociar;
$Juros 		= $taxa_renegociar;


if($Parcelas == 1){



echo round($Valor, 2);


}else{

	$Juros 		= bcdiv($Juros,100,15);

$E 		=1.0;
$cont	=1.0;



for($k=1;$k<=($Parcelas);$k++)
	{
		$cont	= bcmul($cont, bcadd($Juros,1,15),15);
		$E 		= bcadd($E,$cont,15);
	}

$E 		= bcsub($E,$cont,15);
$Valor 	= bcmul($Valor,$cont,15);
$result = bcdiv($Valor,$E,15);

echo round($result, 2);

}




?>