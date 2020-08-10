<?php 
	

	$dados = [];

	$dado['id_user'] = 1665;
	$dado['titulo'] = 'ola Mundo';
	$dado['msg'] = 'Hoje é segunda feira';
	$dado['icon'] = 'aqui jas um icon';
	$dado['link_red'] = 'aqui jas um link';


	$dados[] = $dado;

	function envia_notificacao($dados){

		include "conexao.php";

		$notificacoes = [];
		$notifica_linha;

		foreach ($dados as $key => $value) {
			
			if($value['id_user']){

				$query = mysqli_query($db, "SELECT `endpoint`, `auth`, `p256dh` FROM `subscribers` WHERE `id_user` = ".$value['id_user']." ")or die(mysqli_error($db));

				if(mysqli_num_rows($query)){

					while ($assoc = mysqli_fetch_assoc($query)) {

						$notifica_linha = null;
						
						$notifica_linha['auth'] = $assoc;
						$notifica_linha['dados'] = $value;

						$notificacoes[] = $notifica_linha;
					}
				}

			}	
		}


		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, 'https://notificacao.ibsystem.com.br/testa_curl.php');
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($curl, CURLOPT_POSTFIELDS, 
		http_build_query($notificacoes));

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($curl);

		$aux = curl_getinfo($curl);

		//var_dump($aux);
		var_dump($result);
		//var_dump(curl_error($curl));

		curl_close($curl);
	}


	envia_notificacao($dados);


 ?>