<?php 
header('Content-Type: text/html; charset=utf-8');
function tempo($idc, $sts, $d, $h){

            include "conexao.php";

            $querytempo = "SELECT * FROM crm_atendimento where crm_tratadescricao != 'Alerta!!!' AND crm_trataid = $idc AND crm_tratastatus = '$sts' AND crm_tratadescricao NOT LIKE '%Editado em%' order by crm_trataid desc limit 1";

            $exectempo = mysqli_query($db, $querytempo);
            while ($buscatempo = mysqli_fetch_assoc($exectempo)) {

              $crm_data_agora = $d." ".$h;
              $dataanterior = $buscatempo["crm_tratadata"];
              $horaanterior = $buscatempo["crm_horacad"];

              $crm_data_anterior = $dataanterior." ".$horaanterior;        
              $tempo = gmdate('d H:i:s', abs(strtotime($crm_data_agora)-strtotime($crm_data_anterior)));

              return $tempo;
            }
          }
function remover_acentos($str) { 

	$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?', 'ç', 'Ç', "'"); 
	$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N','O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a','ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i','IJ','ij', 'J', 'j', 'K', 'k', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o','c','C', " "); 
	return str_replace($a, $b, $str); 
} 

date_default_timezone_set('America/Sao_Paulo');

$crm_idcli		    = utf8_decode($_POST["cad"]);
$crm_descricao		= utf8_decode($_POST["descricao"]);
$crm_status		    = utf8_decode($_POST["status3"]);
$crm_idcorretor 	= $_POST["imobiliaria_idimobiliaria"];
#$crm_interesse	 	= $_POST["interesse"];
$crm_dataatt 	    = date('d-m-Y');
$crm_dataretorno 	= $_POST["data_retorno"];
$crm_horaretorno 	= $_POST["hora_retorno"];
$crm_horacad       = date('H:i:s');
$crm_dataretorno    = date("d-m-Y", strtotime($crm_dataretorno));
$crm_dataatt    = date("d-m-Y", strtotime($crm_dataatt));
/*$crm_nome 		= remover_acentos($crm_nome); 
$crm_rua		= remover_acentos($crm_rua);
$crm_cidade		= remover_acentos($crm_cidade); 
*/

include "conexao.php";

$queryanterior = "SELECT * FROM crm_atendimento WHERE crm_idcli = $crm_idcli AND crm_tratadescricao != 'Alerta!!!' AND crm_tratadescricao NOT LIKE '%Editado em%' ORDER BY crm_trataid desc limit 1";


$execanterior = mysqli_query($db, $queryanterior);

while ($buscaanterior = mysqli_fetch_assoc($execanterior)) {
	
	$trataid  =  $buscaanterior["crm_trataid"];
	$tratastatus = $buscaanterior["crm_tratastatus"];
	$tempo = tempo($trataid, $tratastatus, $crm_dataatt, $crm_horacad);

	$tf = explode(" ", $tempo);
              $tf1 = $tf[0];
              $tf2 = $tf[1];
              $tf1 -= 1;

              $tempo = $tf1." ".$tf2;


$queryupdate = "UPDATE crm_atendimento SET crm_tempotransicao = '$crm_dataatt $crm_horacad', crm_tempoatt = '$tempo' WHERE crm_trataid = $trataid";

$execupdate = mysqli_query($db, $queryupdate) or die("Impossível marcar data antecessora.");
}

$inserir = ("INSERT INTO crm_atendimento (
	crm_tratadescricao,    
	crm_tratadata,
	crm_horacad,    
	crm_idcli,    
	crm_tratastatus,
	crm_idcorretor,
	crm_dataretorno,
	crm_horaretorno

)
values (
'$crm_descricao',   
'$crm_dataatt',
'$crm_horacad',    
'$crm_idcli',    
'$crm_status',
'$crm_idcorretor',
'$crm_dataretorno',
'$crm_horaretorno'


)
");

//execução da query do mysql para inserção no banco!
//$executa_query = mysqli_query ($db,$inserir);
	



//mensagem de confirmação de envio do formulário!
if(@mysqli_query($db,$inserir)){
//echo '<script>alert("Dados cadastrados!");</script>';
	$inserir = ("
UPDATE crm_cli
SET crm_statuscli = '$crm_status',
crm_statusdata = '$crm_dataretorno'
WHERE crm_id = $crm_idcli
");

	
mysqli_query($db,$inserir)
	?>

	<script>
		window.location="crm_fichalead.php?numero=<?php echo $crm_idcli ?>";
	</script>

	<?php
}else{

	echo '<script>alert("Não foi possível cadastrar!");</script>';

}

?>
<!--<script>
 window.location="crm_tratalead.php?cad=ok";
</script>-->

