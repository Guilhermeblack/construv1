<?php
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>"; 

$diretorio = 'img/perfil/';

if(!is_dir("$diretorio")) {

mkdir ("$diretorio", 0755 ); // criar o diretorio

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


$nome_cli 			   = $_POST["nome_cli"];
$cpf_cli 			     = $_POST["cpf_cli"];
$rg_cli 			     = $_POST["rg_cli"];
$estadocivil_cli	 = $_POST["estadocivil_cli"];
$nacionalidade_cli = $_POST["nacionalidade_cli"];
$profissao_cli 		 = $_POST["profissao_cli"];
$nascimento_cli 	 = $_POST["nascimento_cli"];
$email_cli 			   = $_POST["email_cli"];
$cidade_cli 		   = $_POST["cidade_cli"];
$endereco_cli 		 = $_POST["endereco_cli"];
$numero_cli 		   = $_POST["numero_cli"];
$bairro_cli 		   = $_POST["bairro_cli"];
$cep_cli 			     = $_POST["cep_cli"];
$telefone1_cli 		 = $_POST["telefone1_cli"];
$telefone2_cli 		 = $_POST["telefone2_cli"];
$telefone3_cli     = $_POST["telefone3_cli"];

$estado_cli 	 	   = $_POST["estado_cli"];
$senha_cli_cad		 = $_POST["senha"];
$idgrupo           = $_POST["idgrupo"];



//?
$grupo_cliente     = $_POST["grupo_cliente"];
$imob_id 	         = $_POST["imob_id"];
$creci             = $_POST["creci"];
$insc_municipal    = $_POST["insc_municipal"];
$cadastrado_por    = $_POST["cadastrado_por"];
$complemento_cli   = $_POST["complemento_cli"];
$pessoa            = $_POST["pessoa"];
$obs_cli           = $_POST["obs_cli"];
$cargo             = $_POST["cargo"];
$salario_base      = $_POST["salario_base"];
$data_contratacao  = $_POST["data_contratacao"];



//?
// $data_demissao     = $_POST["data_demissao"];
$cpf_rfb           = $_POST["cpf_rfb"];
$renda_total       = $_POST["renda_total"];

$renda_total = str_replace("R$","", $renda_total);
$renda_total = str_replace(".","",  $renda_total);
$renda_total = str_replace(",",".", $renda_total);

$grupo_acesso_logado  = $_POST["grupo_acesso_logado"];

$data_cadastro 	  = date('d-m-Y H:i:s');
   
$nome_cli2 		  = remover_acentos($nome_cli);
$endereco_cli2 	= remover_acentos($endereco_cli);
$bairro_cli2 	  = remover_acentos($bairro_cli);
$cidade_cli2 	  = remover_acentos($cidade_cli);
$estado_cli2 	  = remover_acentos($estado_cli);

if($nascimento_cli != ""){
  $nascimento_cli = date("d-m-Y", strtotime($nascimento_cli));
}
   
  


   
 include "conexao.php";

 //para validar nome repetidos
 $nome = mysqli_query($db, "SELECT 'nome_cli' FROM cliente")or die(mysqli_error($db));
 while( $name = mysqli_fetch_assoc($nome)){
   $v =0;
    while($name['nome_cli'] == $nome_cli2  ){
      $v++;
      $nome_cli2 = $nome_cli2.$v;
    }

 }

 $inserir = ("INSERT INTO cliente (
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
  telefone3_cli,    
  telefone2_cli,
  data_cadastro,
  imob_id,
  estado_cli,
  senha,
  idgrupo, 
  creci,
  insc_municipal,
  cadastrado_por,
  complemento_cli,
  fisico_juridico,
  categoria_cliente,
  obs_cli,
  cargo,
  salario_base,
  data_contratacao,
  cpf_rfb,
  renda_total,
  path_foto
  ) values (
  '$nome_cli2',
  '$cpf_cli',    
  '$rg_cli',    
  '$estadocivil_cli',    
  '$nacionalidade_cli',    
  '$profissao_cli',    
  '$nascimento_cli',    
  '$email_cli',    
  '$cidade_cli2',    
  '$endereco_cli2',    
  '$numero_cli',    
  '$bairro_cli2',    
  '$cep_cli',    
  '$telefone1_cli',    
  '$telefone2_cli',
  '$telefone3_cli',   
  '$data_cadastro',
  '$imob_id',
  '$estado_cli2',
  '$senha_cli_cad',
  '$idgrupo',
  '$creci',
  '$insc_municipal',
  '$cadastrado_por',
  '$complemento_cli',
  '$pessoa',
  '$grupo_cliente',
  '$obs_cli',
  '$cargo',
  '$salario_base',
  '$data_contratacao',
  '$cpf_rfb',
  '$renda_total',
  '$path_foto'

  )

");




 $executa_query = mysqli_query ($db,$inserir)or die(mysqli_error($db));

 $id_ultimo_cliente = mysqli_insert_id($db);


//  testar parametros enviados da query 
 //tipo cliente
  $tipo_cliente = $_POST["tipo_cliente"];
                
              
include "conexao.php";
             foreach($tipo_cliente as $tipo){
                print_r('tipo cliente', $tipo);
                $inserir_tipo = mysqli_query($db,"INSERT INTO cliente_tipo (idcliente, idtipo) values ('$id_ultimo_cliente','$tipo')")or die(mysqli_error($db));
          }




  $conjuge_idconjuge = $_POST["conjuge_idconjuge"];


  $inserir_con = mysqli_query($db,"INSERT INTO conjuge (cliente_idcliente, conjuge_idconjuge) values ('$id_ultimo_cliente','$conjuge_idconjuge')");




/////////////  Vincular cadastro com outros usuarios

  $inserir_vinculo = mysqli_query($db,"INSERT INTO vinculo (idcliente, idcorretor, data_vinculo, vinculado_por) values ('$id_ultimo_cliente','$cadastrado_por','$data_cadastro','$cadastrado_por')");


if($grupo_acesso_logado == 7){

  include "conexao.php";
  $query_amigo = mysqli_query($db, "SELECT imob_id FROM cliente WHERE idcliente = $cadastrado_por");
  while ($buscar_amigo = mysqli_fetch_assoc($query_amigo)) {//--verifica se são amigos
            
            $minha_imob        = $buscar_amigo['imob_id'];
} 
$inserir_vinculo = mysqli_query($db,"INSERT INTO vinculo (idcliente, idcorretor, data_vinculo, vinculado_por) values ('$id_ultimo_cliente','$minha_imob','$data_cadastro','$cadastrado_por')");
}


 ?>

 <script>
 window.location="clientes.php?cad=ok";
 </script>