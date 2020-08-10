<?php 
	
	$dados = [];

	for ($i=0; $i < 10 ; $i++) { 
		
		$dado = null;

		$dado['info'.$i] = $i;

		$dados[] = $dado;
	}

	var_dump($dados);
	echo "<br><br><br><br>";

	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL, 'https://notificacao.ibsystem.com.br/testa_curl.php');
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($curl, CURLOPT_POSTFIELDS, 
	http_build_query($dados));

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($curl);

	$aux = curl_getinfo($curl);

	//var_dump($aux);
	var_dump($result);
	//var_dump(curl_error($curl));

	curl_close($curl);

 ?>