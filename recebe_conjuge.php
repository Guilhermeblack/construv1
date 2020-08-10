<?php
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>"; 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";




if(isset($_POST['cpf_conj']) && !empty($_POST['cpf_conj'])){


// echo "<pre>";
// print_r($_POST);
// echo "</pre>"; die();
$cpf_conj          = $_POST["cpf_conj"];
$rg_conj          = $_POST["rg_conj"];
$nome_conj            = $_POST["nome_conj"];
$nacionalidade_conj   = $_POST["nacionalidade_conj"];
$profissao_conj = $_POST["profissao_conj"];
$nascimento_conj = $_POST["nascimento_conj"];
$cadastrado_por = $_POST["cadastrado_por"];
$telefone1 = $_POST["telefone1_conj"];

if(!isset($_POST['telefone2_conj'])){
	$telefone2 = "";
}else{
	$telefone2 = $_POST["telefone2_conj"];
}

if(!isset($_POST['telefone3_conj'])){
	$telefone3 = "";
}else{
	$telefone3 = $_POST["telefone3_conj"];
}

if(!isset($_POST['email_conj'])){
	$email = "";
}else{
	$email = $_POST["email_conj"];
}

if($nascimento_conj != ""){
$nascimento_conj = date("d-m-Y", strtotime($nascimento_conj));
}
   

 include "conexao.php";


 $inserir_conjuge = ("INSERT INTO cliente (
nome_cli,
cpf_cli,    
rg_cli,
nascimento_cli,    
nacionalidade_cli,    
profissao_cli,
cadastrado_por,
telefone1_cli,
telefone2_cli,
telefone3_cli,
email_cli
) 
values(
'$nome_conj',
'$cpf_conj',
'$rg_conj',
'$nascimento_conj',
'$nacionalidade_conj',
'$profissao_conj',
'$cadastrado_por',
'$telefone1',
'$telefone2',
'$telefone3',
'$email'
    
)") ;   


$executa_query_conjuge = mysqli_query($db,$inserir_conjuge);


$pega_ultimo_cliente = ("SELECT * FROM cliente ORDER BY idcliente DESC LIMIT 1");
$executa_ultimo = mysqli_query($db,$pega_ultimo_cliente);
$ultimo = mysqli_fetch_assoc($executa_ultimo);
$ultimo_id = $ultimo['idcliente'];

$idtipo = 6;

$insert_cliente_tipo =  ("INSERT INTO cliente_tipo (
idcliente,
idtipo )   

values(
'$ultimo_id',
'$idtipo'   
)") ;   

$executa_cli_tipo = mysqli_query($db,$insert_cliente_tipo);

// var_dump($executa_cli_tipo);

// var_dump($executa_query_conjuge); die();


$ultimo_cliente = array('idcliente' => $ultimo['idcliente'], 'nome_cli' => $ultimo['nome_cli']);

echo json_encode($ultimo_cliente);

}

