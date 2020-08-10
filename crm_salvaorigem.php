<?php 


$crm_origem		   = $_POST["nome_origem"];


include "conexao.php";

if(isset($_GET["edit"])){ 

 	
$idd = $_GET["edit"];

 		
 		$inserir = ("UPDATE crm_origem SET
	crm_origemnome = '$crm_origem'
	WHERE crm_idorigem = $idd
");

$locationn = '"crm_cadorigem2.php?edt=2"';
 	} else {

$inserir = ("INSERT INTO crm_origem (
	crm_origemnome
)
values (
'$crm_origem'
)
");
$locationn = '"crm_cadorigem2.php?cad=1"'; 
}
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

