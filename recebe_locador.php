<?php

$nome_loc 				= $_POST["nome_loc"];
$cpf_loc 				= $_POST["cpf_loc"];
$rg_loc 				= $_POST["rg_loc"];
$estadocivil_loc		= $_POST["estadocivil_loc"];
$nacionalidade_loc 		= $_POST["nacionalidade_loc"];
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

$nome_con_loc 				= $_POST["nome_con_loc"];
$cpf_con_loc 				= $_POST["cpf_con_loc"];
$rg_con_loc 				= $_POST["rg_con_loc"];
$profissao_con_loc 			= $_POST["profissao_con_loc"];
$nascionalidade_con_loc 	= $_POST["nascionalidade_con_loc"];
$nascimento_con_loc 		= $_POST["nascimento_con_loc"];

$imobiliaria_idimobiliaria 		= $_POST["imobiliaria_idimobiliaria"];

$data_cadastro 			= date('d-m-Y');
   
   
   
   
 include "conexao.php";


 $inserir = ("INSERT INTO locador (
nome_loc,
cpf_loc,    
rg_loc,    
estadocivil_loc,    
nacionalidade_loc,    
profissao_loc,    
nascimento_loc,    
email_loc,    
cidade_loc,    
endereco_loc,    
numero_loc,    
bairro_loc,    
cep_loc,    
telefone1_loc,    
telefone2_loc,    
nome_con_loc,    
cpf_con_loc,    
rg_con_loc,    
profissao_con_loc,    
nascionalidade_con_loc,    
nascimento_con_loc,    
data_cadastro_loc,
imobiliaria_idimobiliaria,
estado_loc    
)


Values (
'$nome_loc',
'$cpf_loc',    
'$rg_loc',    
'$estadocivil_loc',    
'$nacionalidade_loc',    
'$profissao_loc',    
'$nascimento_loc',    
'$email_loc',    
'$cidade_loc',    
'$endereco_loc',    
'$numero_loc',    
'$bairro_loc',    
'$cep_loc',    
'$telefone1_loc',    
'$telefone2_loc',    
'$nome_con_loc',    
'$cpf_con_loc',    
'$rg_con_loc',    
'$profissao_con_loc',    
'$nascionalidade_con_loc',    
'$nascimento_con_loc',    
'$data_cadastro',
'$imobiliaria_idimobiliaria',
'$estado_loc'

)


");

 $executa_query = mysqli_query ($db,$inserir);


 ?>

 <script>
 window.location="locadores.php?cad=ok";
 </script>