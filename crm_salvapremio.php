<?php 
include "conexao.php";


if(isset($_GET["edit"])){

	$idd = $_GET["edit"];

$descf = utf8_decode($_POST["descricao"]);
	$vlrf = $_POST["valorpts"];
	$interessef = $_POST["interessef"];
	$ativof = $_POST["ativof"];
	$nomef = utf8_decode($_POST["npremio"]);
	$estrelasf = $_POST["stars"];

	$inserir = ("UPDATE crm_premio SET
	crm_descricaopremio = '$descf',
	crm_vlrpremio = '$vlrf',
	crm_empid = 'interessef',
	crm_statuspremio = '$ativof',
	crm_titulopremio = '$nomef',
	crm_estrelaspremio = '$estrelasf'
	WHERE crm_idpremio = $idd
");

	$locationn = '"crm_cadpremio.php?edit=2"';

 } else {

$ds          = DIRECTORY_SEPARATOR;  

if (!empty($_FILES)) {


	$descf = utf8_decode($_POST["descricao"]);
	$vlrf = $_POST["valorpts"];
	$interessef = $_POST["interessef"];
	$ativof = $_POST["ativof"];
	$nomef = $_POST["npremio"];
	$estrelasf = $_POST["stars"];

	$storeFolder = "premios/";

	$pasta2 = "premios/";
	if(!file_exists($pasta2)){
		mkdir($pasta2);
	}

	if (is_null($ativof)) {
		$ativof = 0;
	}


    $tempFile = $_FILES['file']['tmp_name'];          //3             
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
    $img_wes = $pasta2. $_FILES['file']['name'];
    
if (is_file($targetFile)){

} else {move_uploaded_file($tempFile,$targetFile); }
//6
    include "conexao.php";

    $inserir = "INSERT INTO crm_premio (crm_descricaopremio, crm_vlrpremio, crm_fotopremio, crm_empid, crm_statuspremio, crm_titulopremio, crm_estrelaspremio) values ('$descf', '$vlrf', '$img_wes', '$interessef', '$ativof', '$nomef', '$estrelasf')";

$locationn = '"crm_cadpremio.php?cad=1"'; 
} }
//execução da query do mysql para inserção no banco!
//$executa_query = mysqli_query ($db,$inserir);




//mensagem de confirmação de envio do formulário!
if(@mysqli_query($db,$inserir)){

//echo '<script>alert("Dados cadastrados!");</script>';
	?>

	<script>
		window.location= <?php echo $locationn ?>;
	</script>

	<?php
}else{

	echo '<script>alert("Não foi possível cadastrar!");</script>';

}

?>
<!--<script>
 window.location="crm_leadform.php?cad=ok";
</script>-->

