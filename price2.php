

<?php
// Funcao para Calcular valor da Parcela - Tabela Price




$Valor 		= $_GET["valor"];
$Parcelas   = $_GET["parcelas"];
$Juros 		= $_GET["juros"];


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