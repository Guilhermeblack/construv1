<?php 










include "conexao.php";


if(isset($_GET["pag"]) && !empty($_GET["pag"] && isset($_GET["idanexar_documentos"]) && !empty($_GET['idanexar_documentos']) )){



	//$pagina_origem  = $_GET["pag"];
	$idvenda          = $_GET['idvenda'];
	$idempreendimento = $_GET['idempreendimento'];
	$anexo 	   		  = $_GET["anexo"];



	$deleta_album = mysqli_query($db,"DELETE FROM anexar_documentos WHERE idanexar_documentos='$idanexar_documentos'");


	unlink('anexar_documentos/'.$idcliente.'/'.$anexo);

	rmdir('anexar_documentos/'.$idcliente);

	header("Location: documentos_empreendimento.php?idempreendimento=$idempreendimento&idvenda=$idvenda");
	

}

if(isset($_GET["pag"]) && !empty($_GET["pag"] && isset($_GET["iddoc"]) && !empty($_GET['iddoc']) )){


	$idvenda          = $_GET['idvenda'];
	$idempreendimento = $_GET['idempreendimento'];
	$iddoc            = $_GET['iddoc'];
	$anexo            = $_GET["anexo"];
   
    $anexo = explode(",", $anexo);
     
    
    
	$deleta_album = mysqli_query($db,"DELETE FROM documentos_arquivos WHERE documentos_id ='$iddoc'");
    $deleta_album1 = mysqli_query($db, "DELETE FROM documentos WHERE iddocumentos = '$iddoc'");

    foreach ($anexo as $arquivo) {
       unlink('documentos_arquivos/'. $iddoc .'/' . $arquivo );
    }

	rmdir('documentos_arquivos/'.$iddoc);

	header("Location: documentos_empreendimento.php?idempreendimento=$idempreendimento&idvenda=$idvenda");

}




$idanexar_documentos   = $_GET["idanexar_documentos"];
$idcliente  		   = $_GET["idcliente"];
$anexo 	   			   = $_GET["anexo"];



$deleta_album = mysqli_query($db,"DELETE FROM anexar_documentos WHERE idanexar_documentos='$idanexar_documentos'");


unlink('anexar_documentos/'.$idcliente.'/'.$anexo);




?>
<script>
	window.location ="anexar_documentos.php?idcliente=<?php echo $idcliente ?>";
</script>