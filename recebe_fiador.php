<?php

$nome_cli 				= $_POST["nome_cli"];
$cpf_cli 				= $_POST["cpf_cli"];
$rg_cli 				= $_POST["rg_cli"];
$estadocivil_cli		= $_POST["estadocivil_cli"];
$nacionalidade_cli 		= $_POST["nacionalidade_cli"];
$profissao_cli 			= $_POST["profissao_cli"];
$nascimento_cli 		= $_POST["nascimento_cli"];
$email_cli 				= $_POST["email_cli"];
$cidade_cli 			= $_POST["cidade_cli"];
$endereco_cli 			= $_POST["endereco_cli"];
$numero_cli 			= $_POST["numero_cli"];
$bairro_cli 			= $_POST["bairro_cli"];
$cep_cli 				= $_POST["cep_cli"];
$telefone1_cli 			= $_POST["telefone1_cli"];
$telefone2_cli 			= $_POST["telefone2_cli"];
$estado_cli 			= $_POST["estado_cli"];

$nome_con 				= $_POST["nome_con"];
$cpf_con 				= $_POST["cpf_con"];
$rg_con 				= $_POST["rg_con"];
$profissao_con 			= $_POST["profissao_con"];
$nascionalidade_con 	= $_POST["nascionalidade_con"];
$nascimento_con 		= $_POST["nascimento_con"];

$imovel_matricula 		= $_POST["imovel_matricula"];
$endereco_imovel 		= $_POST["endereco_imovel"];
$terreno_imovel 		= $_POST["terreno_imovel"];
$construcao_imovel 		= $_POST["construcao_imovel"];

$cliente_id 		= $_POST["cliente_id"];

$data_cadastro 			= date('d-m-Y');
   
   
   
   
 include "conexao.php";


 $inserir = ("INSERT INTO fiador (
nome_cli,
cpf_cli,    
rg_cli,    
estadocivil_cli,    
nacionalidade_cli,    
profissao_cli,    
nascimento_cli,    
email_cli,    
cidade_cli,    
endereco_cli,    
numero_cli,    
bairro_cli,    
cep_cli,    
telefone1_cli,    
telefone2_cli,    
nome_con,    
cpf_con,    
rg_con,    
profissao_con,    
nascionalidade_con,    
nascimento_con,    
data_cadastro,
cliente_id,
estado_cli,
imovel_matricula,
endereco_imovel,
terreno_imovel,
construcao_imovel    
)


Values (
'$nome_cli',
'$cpf_cli',    
'$rg_cli',    
'$estadocivil_cli',    
'$nacionalidade_cli',    
'$profissao_cli',    
'$nascimento_cli',    
'$email_cli',    
'$cidade_cli',    
'$endereco_cli',    
'$numero_cli',    
'$bairro_cli',    
'$cep_cli',    
'$telefone1_cli',    
'$telefone2_cli',    
'$nome_con',    
'$cpf_con',    
'$rg_con',    
'$profissao_con',    
'$nascionalidade_con',    
'$nascimento_con',    
'$data_cadastro',
'$cliente_id',
'$estado_cli',
'$imovel_matricula',
'$endereco_imovel',
'$terreno_imovel',
'$construcao_imovel' 

)


");

 $executa_query = mysqli_query ($db,$inserir);


 ?>


 <script>
 window.location="clientes.php?cad=ok";
 </script>
