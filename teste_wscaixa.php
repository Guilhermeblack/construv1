<?php 

	$ch = curl_init("http://gazzoliempreendimentos.com.br/");
	// $fp = fopen("altera_repasse.php", "rb");

	// $conteudo = fread($fp, filesize('altera_repasse.php'));

	// curl_setopt($ch, CURLOPT_FILE, $fp);
	// curl_setopt($ch, CURLOPT_POST , true);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
	// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER  , false);

	$aux = curl_exec($ch);

	curl_close($ch);

	// fclose($fp);

	var_dump($aux);

	die();
	// var_dump($conteudo);

 ?>