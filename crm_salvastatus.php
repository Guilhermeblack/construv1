<?php 


$crm_status		   = $_POST["nome_status"];
$crm_cor		   = $_POST['cadcor'];
$crm_dias		   = $_POST['timerd'];
$crm_horas		   = $_POST['timert'];
$crm_arquivo	   = $_POST["status"];
$crm_pontos 	   = $_POST["pts"];

include "conexao.php";
 if(isset($_GET["edit"])){ 

 	
$idd = $_GET["edit"];

 		$inserir = ("UPDATE crm_status SET
	crm_status = '$crm_status',    
	crm_cor = '$crm_cor',    
	crm_diasatt = '$crm_dias',    
	crm_horasatt = '$crm_horas',
	crm_pontostatus = '$crm_pontos'
	WHERE crm_idstatus = $idd
");

 		$deletar = ("DELETE FROM crm_statusvinculo WHERE crm_idstatus = $idd") OR die("Não foi possível deletar da tabela");
       mysqli_query($db, $deletar);



 foreach ($crm_arquivo as $idant) {
	$inserir2 = ("INSERT INTO crm_statusvinculo (
	crm_idstatus,
	crm_idant
)
values (
'$idd',
'$idant'
)
");

mysqli_query($db, $inserir2);

}


$locationn = '"crm_cadstatus.php?edt=2"';
 	} else {

 		$inserir = ("INSERT INTO crm_status (
	crm_status,
	crm_cor,
	crm_diasatt,
	crm_horasatt,
	crm_pontostatus
)
values (
'$crm_status',
'$crm_cor',
'$crm_dias',
'$crm_horas',
'$crm_pontos'
)
");




 	$locationn = '"crm_cadstatus.php?cad=1"'; }



//execução da query do mysql para inserção no banco!
//$executa_query = mysqli_query ($db,$inserir);

//mensagem de confirmação de envio do formulário!
if(@mysqli_query($db,$inserir)){

if(!isset($_GET["edit"])){
	


	$ultimo_id = mysqli_insert_id($db);
 
	$deletar2 = ("DELETE FROM crm_statusvinculo WHERE crm_idstatus = $ultimo_id") OR die("Não foi possível deletar da tabela");
       mysqli_query($db, $deletar2);

 		foreach ($crm_arquivo as $idant) {
			$inserir3 = ("INSERT INTO crm_statusvinculo (
				crm_idstatus,
				crm_idant
				)
				values (
				'$ultimo_id',
				'$idant'
				)
				");

mysqli_query($db, $inserir3);
}
}

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

