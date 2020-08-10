<?php 
if(isset($_POST["empreendimento"])){

    $empreendimento = $_POST["empreendimento"];

$pasta = "../img/slide/";
if(!file_exists($pasta)){
mkdir($pasta);
}


 foreach($_FILES["img"]["error"] as $key => $error){
 
 if($error == UPLOAD_ERR_OK){
 $tmp_name = $_FILES["img"]["tmp_name"][$key];
 $cod     = $_FILES["img"]["name"][$key];
 ////////////////////////////////////////

 //////////////////////////////////////////



 
 $nome    = $_FILES["img"]["name"][$key];
 $uploadfile = $pasta . basename($cod);
 
if(move_uploaded_file($tmp_name, $uploadfile)){
include "conexao.php";

    
$inserir = mysqli_query ($db,"INSERT INTO slide_empreendimentos (categoria, img_slide) values ('$empreendimento','$cod')") or die ("ERRO NO SISTEMA TENTE MAIS TARDE!.");

 
}}}


}   

?>
<script type="text/javascript">
	window.location='adicionar_slide.php';
</script>