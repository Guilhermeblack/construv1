<?php
$diretorio = 'img/perfil/';

if(!is_dir("$diretorio")) {

mkdir ("$diretorio", 0700 ); // criar o diretorio

}

$nome_foto = $_FILES['perfil_foto']['name'];


move_uploaded_file($_FILES['perfil_foto']['tmp_name'], $diretorio.$nome_foto);
$path_foto = $diretorio.$nome_foto; 



function remover_acentos($str) { 

  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?', 'ç', 'Ç', "'"); 
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N','O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a','ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i','IJ','ij', 'J', 'j', 'K', 'k', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o','c','C', " "); 
  return str_replace($a, $b, $str); 
} 
date_default_timezone_set('America/Sao_Paulo');

$idcliente 				= $_POST["idcliente"];
$nome_cli 				= $_POST["nome_cli"];
$cpf_cli 				= $_POST["cpf_cli"];
$rg_cli 				= $_POST["rg_cli"];
$senha_cli_cad 			= $_POST["senha"];


$estadocivil_cli 		= $_POST["estadocivil_cli"];
$profissao_cli 			= $_POST["profissao_cli"];
$nascimento_cli 		= $_POST["nascimento_cli"];
$email_cli 				= $_POST["email_cli"];
$cidade_cli 			= $_POST["cidade_cli"];
$endereco_cli 			= $_POST["endereco_cli"];
$numero_cli 			= $_POST["numero_cli"];
$complemento_cli 		= $_POST["complemento_cli"];
$bairro_cli 			= $_POST["bairro_cli"];
$cep_cli 				= $_POST["cep_cli"];
$telefone1_cli 			= $_POST["telefone1_cli"];
$telefone2_cli 			= $_POST["telefone2_cli"];
$telefone3_cli          = $_POST["telefone3_cli"];
$estado_cli 			= $_POST["estado_cli"];
$obs_cli 			    = $_POST["obs_cli"];

$idgrupo 				= $_POST["idgrupo"];
$tipo_cliente 			= $_POST["tipo_cliente"];
$conjuge_idconjuge  	= $_POST["conjuge_idconjuge"];
$renda_total  	        = $_POST["renda_total"];
$nacionalidade_cli  	= $_POST["nacionalidade_cli"];

// $grupo_cliente  		= $_POST["grupo_cliente"];
$imobiliaria_id  		= $_POST["imobiliaria_id"];
$creci  				= $_POST["creci"];
$insc_municipal  		= $_POST["insc_municipal"];
$alterado_por  			= $_POST["alterado_por"];
$data_alterado          = date('d-m-Y H:i:s');

$renda_total = str_replace("R$","", $renda_total);
$renda_total = str_replace(".","",  $renda_total);
$renda_total = str_replace(",",".", $renda_total);

$nome_cli2 		= remover_acentos($nome_cli);
$endereco_cli2 	= remover_acentos($endereco_cli);
$bairro_cli2 	= remover_acentos($bairro_cli);
$cidade_cli2 	= remover_acentos($cidade_cli);
$estado_cli2 	= remover_acentos($estado_cli);
   
   
// var_dump($idgrupo );
// var_dump($tipo_cliente);
// die();

if($nascimento_cli != ""){
$nascimento_cli = date("d-m-Y", strtotime($nascimento_cli));
}   
   
 include "conexao.php";


 $inserir = ("UPDATE cliente set
nome_cli 				='$nome_cli2',
cpf_cli  				='$cpf_cli',    
rg_cli   				='$rg_cli',    
profissao_cli 			='$profissao_cli',
nascimento_cli 			='$nascimento_cli',    
email_cli 				='$email_cli',    
cidade_cli 				='$cidade_cli2',    
endereco_cli 			='$endereco_cli2',    
numero_cli 				='$numero_cli',    
bairro_cli 				='$bairro_cli2',    
cep_cli 				='$cep_cli',    
telefone1_cli 			='$telefone1_cli',    
telefone2_cli 			='$telefone2_cli', 
telefone3_cli           ='$telefone3_cli', 
estado_cli 			    ='$estado_cli2',
imob_id 				='$imobiliaria_id',
creci 					='$creci',
alterado_por            ='$alterado_por',
data_alterado           ='$data_alterado',
insc_municipal          ='$insc_municipal',
senha                   ='$senha_cli_cad',
complemento_cli         ='$complemento_cli',
categoria_cliente       ='$grupo_cliente',
idgrupo                 ='$idgrupo',
obs_cli                 ='$obs_cli',
estadocivil_cli         ='$estadocivil_cli',
renda_total             ='$renda_total',
nacionalidade_cli       ='$nacionalidade_cli',
path_foto               ='$path_foto'  

WHERE idcliente = '$idcliente'   



");
 $executa_query = mysqli_query ($db,$inserir);
 $deleta_tipo   = mysqli_query($db,"DELETE FROM cliente_tipo WHERE idcliente='$idcliente'")or die(mysqli_error($db));
 echo "a";


  foreach($tipo_cliente as $tipo){

              $inserir_tipo = mysqli_query($db,"INSERT INTO cliente_tipo (idcliente, idtipo) values ('$idcliente','$tipo')")or die(mysqli_error($db));
               echo "b";
          }

 
 $deleta_con   = mysqli_query($db,"DELETE FROM conjuge WHERE conjuge_idconjuge='$conjuge_idconjuge'")or die(mysqli_error($db));
  echo "c";
 $inserir_con = mysqli_query($db,"INSERT INTO conjuge (cliente_idcliente, conjuge_idconjuge) values ('$idcliente','$conjuge_idconjuge')")or die(mysqli_error($db));
  echo "d";


$auditoria_alteracao_cliente = mysqli_query($db,"INSERT INTO alteracao_cadastro_cliente (cliente_id, data_alterado, alterado_por) values ('$idcliente','$data_alterado','$alterado_por')")or die(mysqli_error($db));
 	echo "e";
 	
 	// die();
 ?>


 <script>
window.location="clientes.php";
 </script>