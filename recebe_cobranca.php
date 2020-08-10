<?php

$contrato_id 		= $_POST["contrato_id"];
$tipo_venda 		= $_POST["tipo_venda"];
$titulo 			= $_POST["titulo"];
$descricao 			= $_POST["descricao"];
$cadastrado_por 	= $_POST["cadastrado_por"];
$data_cobranca 		= date('d-m-Y H:i:s');

include "conexao.php";

$inserir = "INSERT INTO cobranca (contrato_id, tipo_venda, titulo, descricao, cadastrado_por, data_cobranca) values ('$contrato_id', '$tipo_venda','$titulo','$descricao','$cadastrado_por','$data_cobranca')";

$executa_query = mysqli_query ($db, $inserir);

echo "Gravado com Sucesso!";
 ?>