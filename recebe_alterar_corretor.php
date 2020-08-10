<?php
if(isset($_FILES["img"])){
foreach($_FILES["img"]["error"] as $key => $error){
 
 if($error == UPLOAD_ERR_OK){
 $tmp_name = $_FILES["img"]["tmp_name"][$key];
 $cod     = $_FILES["img"]["name"][$key];
 ////////////////////////////////////////

$idimobiliaria 		= $_POST["idimobiliaria"];
$nome_imob 			= $_POST["nome_imob"];
$cpf 				= $_POST["cpf"];
$rg 				= $_POST["rg"];


$creci 			    = $_POST["creci"];
$email_imob 		= $_POST["email_imob"];
$senha_imob 		= $_POST["senha_imob"];
$telefone 			= $_POST["telefone"];





 //////////////////////////////////////////


$pasta = "fotos/corretor/";
if(!file_exists($pasta)){
mkdir($pasta);
}

 
 
 $nome    = $_FILES["img"]["name"][$key];
 $uploadfile = $pasta . basename($cod);
 
if(move_uploaded_file($tmp_name, $uploadfile)){
include "conexao.php";


include "conexao.php";


 $inserir = ("UPDATE imobiliaria set
nome_imob 		='$nome_imob',
cpf  			='$cpf',    
rg   			='$rg',    
creci 			='$creci',
email_imob 		='$email_imob',    
senha_imob 		='$senha_imob',    
telefone 		='$telefone',
img 			= '$cod'   

WHERE idimobiliaria = '$idimobiliaria'   



");

 $executa_query = mysqli_query ($db,$inserir);

}}}

}else{



$idimobiliaria 		= $_POST["idimobiliaria"];
$nome_imob 			= $_POST["nome_imob"];
$cpf 				= $_POST["cpf"];
$rg 				= $_POST["rg"];


$creci 			    = $_POST["creci"];
$email_imob 		= $_POST["email_imob"];
$senha_imob 		= $_POST["senha_imob"];
$telefone 			= $_POST["telefone"];



   
   
   
   
 include "conexao.php";


 $inserir = ("UPDATE imobiliaria set
nome_imob 		='$nome_imob',
cpf  			='$cpf',    
rg   			='$rg',    
creci 			='$creci',
email_imob 		='$email_imob',    
senha_imob 		='$senha_imob',    
telefone 		='$telefone'   

WHERE idimobiliaria = '$idimobiliaria'   



");

 $executa_query = mysqli_query ($db,$inserir);

}
 ?>

 
 <script>
window.location="relatorio_corretor.php";
 </script>