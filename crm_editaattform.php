<?php 



#/////////////////////////////////////////////////////////////////////////////////////////////////////////
#//////////////////////////////////////ROLETA IMOBILIÁRIA////////////////////////////////////////////////
#////////////////////////////////////////////////////////////////////////////////////////////////////////


header('Content-Type: text/html; charset=utf-8');
function remover_acentos($str) { 

	$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?', 'ç', 'Ç', "'"); 
	$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N','O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a','ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i','IJ','ij', 'J', 'j', 'K', 'k', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o','c','C', " "); 
	return str_replace($a, $b, $str); 
} 

date_default_timezone_set('America/Sao_Paulo');

$crm_nome 		   = utf8_decode($_POST["primeironome"]);

$crm_email 		   = $_POST["email"];
$crm_celular	   = $_POST["celular"];
$crm_fixo   	   = $_POST["fixo"];
$crm_cep		   = $_POST["cep"];
$crm_origem		   = $_POST["origemfil"];
$crm_lat		   = $_POST["lat"];
$crm_long		   = $_POST["lon"];
$crm_rua		   = $_POST["rua"];
$crm_cidade		   = $_POST["cidade"]; 
$crm_numero		   = $_POST["numero"];
$crm_complemento   = $_POST["complemento"];
$crm_status 		= $_POST['status'];
$iid 		= $_POST['iid'];
$crm_idcorretor		= $_POST["imobiliaria_idimobiliaria"];

$crm_horacad       = date('H:i:s');
$crm_data_cadastro 	  = date('d-m-Y');
if ($_POST["interesse"]) {
	# code...
$crm_interesse 		= $_POST["interesse"];

} else $crm_interesse 		= $_POST["interesse1"];

$crm_categoria 		= $_POST["categoria"];
$crm_imobiliaria 		= $_POST["imobb"];
$crm_corretor 		= $_POST["corretores"];
$crm_obs 			= $_POST["obs"];
/*$crm_nome 		= remover_acentos($crm_nome); 
$crm_rua		= remover_acentos($crm_rua);
$crm_cidade		= remover_acentos($crm_cidade); 
*/

include "conexao.php";

	$inserir = ("UPDATE crm_cli SET
	crm_nome = '$crm_nome',    
	crm_email = '$crm_email',    
	crm_celular = '$crm_celular',    
	crm_fixo = '$crm_fixo',
	crm_cep = '$crm_cep',
	crm_origem = '$crm_origem',
	crm_rua = '$crm_rua',
	crm_cidade = '$crm_cidade',
	crm_numeroend = '$crm_numero',
	crm_complemento = '$crm_complemento',
	crm_interesse = '$crm_interesse',
	crm_categoria ='$crm_categoria',
	crm_obs = '$crm_obs' 
	WHERE crm_id = $iid
");


	
//}
//execução da query do mysql para inserção no banco!
//$executa_query = mysqli_query ($db,$inserir);
	
//mensagem de confirmação de envio do formulário!
if(@mysqli_query($db,$inserir)){

$ultimoid = mysqli_insert_id($db);

$inserir2 = ("INSERT INTO crm_atendimento (
	crm_tratadescricao,    
	crm_tratadata,    
	crm_idcli,    
	crm_tratastatus,
	crm_idcorretor

)
values (
'Editado em $crm_data_cadastro - $crm_horacad',   
'$crm_data_cadastro',    
'$iid',    
'$crm_status',
'$crm_idcorretor'
)
");


@mysqli_query($db,$inserir2);
if ($crm_imobiliaria) {



	$inserir_i = ("UPDATE crm_roleta_imob SET  
	crm_idimob = '$crm_imobiliaria',    
	crm_idempreendimento = '$crm_interesse'    
	WHERE crm_idcli = $iid
");

} else { die ("Imobiliária não selecionada"); }
	





if ($crm_corretor) {

	$inserir_c = ("UPDATE crm_roleta_corretor SET
	crm_idcorretor = '$crm_corretor',    
	crm_idimob = '$crm_imobiliaria',    
	crm_idempreendimento = '$crm_interesse'    
	WHERE crm_idcli = $iid
");

} else { die ("Corretor não selecionado"); }


@mysqli_query($db,$inserir_i);
@mysqli_query($db,$inserir_c);

	?>

	<script>
		window.location="crm_tratalead.php?edit=1";
	</script>

	<?php
}else{

	echo '<script>alert("Não foi possível cadastrar!");</script>';

}

?>
<!--<script>
 window.location="crm_leadform.php?cad=ok";
</script>-->

