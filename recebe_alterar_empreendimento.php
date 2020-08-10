<?php
$idempreendimento 		= $_POST['idempreendimento'];
$status 		= $_POST['status'];
$cidade         = $_POST['cidade'];
$descricao 		= $_POST['descricao'];
$qtd_lotes		= $_POST['qtd_lotes'];
$medidas_lotes 	= $_POST['medidas_lotes'];
$outro_lote 	= $_POST['outro_lote'];
$m2_area_verde	= $_POST['m2_area_verde'];
$m2_lote_padrao = $_POST['m2_lote_padrao'];
$terraplanagem 	= $_POST['terraplanagem'];
$abertura_ruas 	= $_POST['abertura_ruas'];
$rede_esgoto 	= $_POST['rede_esgoto'];
$galeria_pluvial= $_POST['galeria_pluvial'];
$guias_sarjetas	= $_POST['guias_sarjetas'];
$pavimentacao  	= $_POST['pavimentacao']; 
$paisagismo  	= $_POST['paisagismo']; 
$rede_eletrica  = $_POST['rede_eletrica']; 
$exibir_site    = $_POST['exibir_site']; 

if($exibir_site == ''){
$exibir_site = 0;
}

include_once "conexao.php";

$inserir = ("UPDATE empreendimento set

status 			= '$status',
cidade          = '$cidade',
descricao 		= '$descricao',
qtd_lotes		= '$qtd_lotes',
medidas_lotes 	= '$medidas_lotes',
outro_lote 		= '$outro_lote',
m2_area_verde	= '$m2_area_verde',
m2_lote_padrao 	= '$m2_lote_padrao',
terraplanagem 	= '$terraplanagem',
abertura_ruas 	= '$abertura_ruas',
rede_esgoto 	= '$rede_esgoto',
galeria_pluvial	= '$galeria_pluvial',
guias_sarjetas	= '$guias_sarjetas',
pavimentacao  	= '$pavimentacao',
paisagismo  	= '$paisagismo',
rede_eletrica  	= '$rede_eletrica',
exibir_site      = '$exibir_site'

where idempreendimento = $idempreendimento ");

$alterar = mysqli_query($db,$inserir);

?>

 <script>
window.location="empreendimentos.php?cad=ok";
 </script>