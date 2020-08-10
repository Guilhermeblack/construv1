<?php
$idlocador 				= $_POST["idlocador"];
$nome_loc 				= $_POST["nome_loc"];
$cpf_loc 				= $_POST["cpf_loc"];
$rg_loc 				= $_POST["rg_loc"];


$profissao_loc 			= $_POST["profissao_loc"];
$nascimento_loc 		= $_POST["nascimento_loc"];
$email_loc 				= $_POST["email_loc"];
$cidade_loc 			= $_POST["cidade_loc"];
$endereco_loc 			= $_POST["endereco_loc"];
$numero_loc 			= $_POST["numero_loc"];
$bairro_loc 			= $_POST["bairro_loc"];
$cep_loc 				= $_POST["cep_loc"];
$telefone1_loc 			= $_POST["telefone1_loc"];
$telefone2_loc 			= $_POST["telefone2_loc"];
$estado_loc 			= $_POST["estado_loc"];

$nome_con 				= $_POST["nome_con"];
$cpf_con 				= $_POST["cpf_con"];
$rg_con 				= $_POST["rg_con"];
$profissao_con 			= $_POST["profissao_con"];
$nascionalidade_con 	= $_POST["nascionalidade_con"];
$nascimento_con 		= $_POST["nascimento_con"];



   
   
   
   
 include "conexao.php";


 $inserir = ("UPDATE locador set
nome_loc 				='$nome_loc',
cpf_loc  				='$cpf_loc',    
rg_loc   				='$rg_loc',    
profissao_loc 			='$profissao_loc',
nascimento_loc 			='$nascimento_loc',    
email_loc 				='$email_loc',    
cidade_loc 				='$cidade_loc',    
endereco_loc 			='$endereco_loc',    
numero_loc 				='$numero_loc',    
bairro_loc 				='$bairro_loc',    
cep_loc 				='$cep_loc',    
telefone1_loc 			='$telefone1_loc',    
telefone2_loc 			='$telefone2_loc',    
nome_con_loc 				='$nome_con',    
cpf_con_loc 				='$cpf_con',    
rg_con_loc 					='$rg_con',    
profissao_con_loc 			='$profissao_con',    
nascionalidade_con_loc 		='$nascionalidade_con',    
nascimento_con_loc 			='$nascimento_con',    
estado_loc 				='$estado_loc'
WHERE idlocador = '$idlocador'   



");

 $executa_query = mysqli_query ($db,$inserir);


 ?>

 <script>
window.location="locadores.php";
 </script>