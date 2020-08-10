<?php	
	
	//Retorna um Array com dados ta tabela "dados_empreendimentos"
	function dados_empreendimento($parcela_id){
		include "conexao.php";
		$query_amigo = "SELECT  *  FROM parcelas INNER JOIN empreendimento_cadastro ON parcelas.empreendimento_id_novo = empreendimento_cadastro.idempreendimento_cadastro 
						INNER JOIN empreendimento_centrocusto ON empreendimento_cadastro.idempreendimento_cadastro = empreendimento_centrocusto.empreendimento_id 
						INNER JOIN contacorrente ON empreendimento_centrocusto.contacorrente_id = contacorrente.idcontacorrente
						where idparcelas = $parcela_id";

		$executa_query = mysqli_query($db, $query_amigo);

		$dados = null;
		
		while ($row = mysqli_fetch_assoc($executa_query)) {
			$contacorrente_id         = $row['contacorrente_id'];
			$descricao_empreendimento = $row['descricao_empreendimento'];
			$banco                    = $row['banco'];
			$img_lote                 = $row['img_lote'];
			$idempreendimento_cadastro = $row['idempreendimento_cadastro'];
			$status_envio 			=    $row['auto_email'];
			$valor_parcelas           = $row['valor_parcelas'];
			$data_vencimento_parcela  = $row['data_vencimento_parcela'];

			$dados["contacorrente_id"]         = $contacorrente_id;
			$dados["descricao_empreendimento"] = $descricao_empreendimento;
			$dados["banco"]                    = $banco;
			$dados["img_lote"]                 = $img_lote;
			$dados["idempreendimento_cadastro"]     = $idempreendimento_cadastro;
			$dados["status_envio"] 			= $status_envio;
			$dados["valor_parcelas"]     		= $valor_parcelas;
			$dados["data_vencimento_parcela"]   = $data_vencimento_parcela;
		}

		return $dados;
	}	


	//Faz a culsulta se já foi enviado um email para a parcela referenciadas no parametro $parcela_id
	function consulta_ja_enviou($parcela_id, $dias_id){
		include "conexao.php";
		$query_amigo = "SELECT * FROM parcela_cobranca where parcela_id = $parcela_id and dias_id = $dias_id and enviado = 1 and sucesso = 1";
		$executa_query = mysqli_query($db, $query_amigo)or die(mysqli_error($db));

		$total = mysqli_num_rows($executa_query);

		return $total;
	}

	// Função para trocar as tags "@tag" pelas variaveis no PHP
	function trocar_conteudo($conteudo, $falta, $nome_cli, $cpf_cli, $endereco_cli, $numero_cli, $bairro_cli, $cidade_cli, $telefone1_cli ,$nome_empreendimento, $data_venda, $email_cli, $data_vencimento ,$url, $idempreendimento_cadastro, $img_lote, $exibe_url, $parcela_id, $contacorrente_id) { 

	  $a = array('@falta_qnt_dias','@nome_cli', '@cpf_cli', '@endereco_cli', '@numero_casa_cli', '@bairro_cli', '@cidade_cli', '@telefone_cli', '@nome_empreendimento', '@data_venda', '@email_cli', '@data_vencimento', '$url', '$idempreendimento_cadastro', '$img_lote', '$exibe_url', '$parcela_id', '$conta'); 
	  $b = array($falta, $nome_cli, $cpf_cli, $endereco_cli, $numero_cli, $bairro_cli, $cidade_cli, $telefone1_cli, $nome_empreendimento, $data_venda, $email_cli, $data_vencimento, $url, $idempreendimento_cadastro, $img_lote, $exibe_url, $parcela_id, $contacorrente_id); 
	  return str_replace($a, $b, $conteudo); 
	} 

	include "conexao.php";
	$executaQuery = mysqli_query($db, "SELECT * FROM config_email")or die(mysqli_error($db));

	//Busco as informações de configuração do banco de dados
	while ($recebe = mysqli_fetch_assoc($executaQuery)) {
		$url = $recebe["url_cliente"];
		$host = $recebe["host"];
		$port = $recebe["port"];
		$username = $recebe["username"];
		$password = $recebe["password"];
		$remetente_desc = $recebe["remetente_desc"];
		$email_resposta = $recebe["resposta_email"];
		$desc_resposta = $recebe["resposta_desc"];
	}

    
	// Configuração do PHPMailer
	use PHPMailer\PHPMailer\PHPMailer;
	error_reporting(E_STRICT | E_ALL);
	date_default_timezone_set('Etc/UTC');
	require 'enviar_email/vendor/autoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = $host;
	$mail->SMTPAuth = true;
	$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
	$mail->Port = $port;
	$mail->Username = $username;
	$mail->Password = $password;
	$mail->setFrom($username, $remetente_desc);
	$mail->addReplyTo($email_resposta, $desc_resposta);
	$mail->Subject = "Sua parcela ja esta disponivel";
	//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
	$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
	//Connect to the database and select the recipients from your mailing list that have not yet been sent to
	//You'll need to alter this to match your database


    
//########################   ROTINA PARA PARCELAS A VENCER   ##################
	$busca_hoje = date('Y-m-d');  

	for($i=1; $i<=3; $i++){

		if($i == 1){
			// Busco o Html do email de acordo com os dias a vencer do vencimento do boleto
			$executa = mysqli_query($db,"SELECT avencer_10 FROM config_email")or die(mysqli_error($db));
			$busca = mysqli_fetch_assoc($executa);
			$email_html = $busca['avencer_10'];

			$busca_fim  = date('Y-m-d',strtotime($busca_hoje . "+10 days"));
			$falta = 'daqui 10 dias';
		}else if($i == 2){
			// Busco o Html do email de acordo com os dias a vencer do vencimento do boleto
			$executa = mysqli_query($db,"SELECT avencer_5 FROM config_email")or die(mysqli_error($db));
			$busca = mysqli_fetch_assoc($executa);
			$email_html = $busca['avencer_5'];

			$busca_fim  = date('Y-m-d',strtotime($busca_hoje . "+5 days"));
			$falta = 'daqui 5 dias';
		}else{
			// Busco o Html do email de acordo com os dias a vencer do vencimento do boleto
			$executa = mysqli_query($db,"SELECT avencer_0 FROM config_email")or die(mysqli_error($db));
			$busca = mysqli_fetch_assoc($executa);
			$email_html = $busca['avencer_0'];

			$busca_fim  = date('Y-m-d',strtotime($busca_hoje . "+0 days"));
			$falta = 'hoje';
		}

		$result = mysqli_query($db, "SELECT * from parcelas 
					INNER JOIN venda ON parcelas.venda_idvenda = venda.idvenda 
					INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente 
					WHERE remessa = 0 AND fluxo = 0 AND tipo_venda = 2 AND situacao = 'Em aberto' AND email_cli != ''  AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$busca_hoje."' and '".$busca_fim."' ")or die(mysqli_error($db));
        
        
        if(mysqli_num_rows($result) !== 0){
		    foreach ($result as $row) {
			//Pegos os dados do cliente para trocar no html do email
			$nome_cli           = $row["nome_cli"];
			$cpf_cli            = $row["cpf_cli"];
			$cidade_cli         = $row["cidade_cli"];
			$email_cli          = $row["email_cli"];
			$endereco_cli       = $row["endereco_cli"];
			$numero_cli         = $row["numero_cli"];
			$bairro_cli         = $row["bairro_cli"];
			$telefone1_cli      = $row["telefone1_cli"];
			$data_venda			= $row["data_venda"];

			$parcela_id = $row['idparcelas'];
            
			$consulta_ja_enviou   = consulta_ja_enviou($parcela_id, $i);
			$dados_empreendimento = dados_empreendimento($parcela_id);
			$status_envio		= $dados_empreendimento["status_envio"];
			$data_vencimento 	= $dados_empreendimento["data_vencimento_parcela"];
			$nome_empreendimento = $dados_empreendimento["descricao_empreendimento"];
			$contacorrente_id    = $dados_empreendimento["contacorrente_id"];
			$banco               = $dados_empreendimento["banco"];

			$idempreendimento_cadastro = $dados_empreendimento["idempreendimento_cadastro"];
			$img_lote               = $dados_empreendimento["img_lote"];
			
			$img_lote = str_replace(" " ,"%20", $img_lote);
			
			if($banco == '033'){
				$exibe_url = 'boleto_santander_banespa-mes';
			}elseif($banco == '341'){
				$exibe_url = 'boleto_itau';
			}elseif ($banco == '756') {
				$exibe_url = 'boleto_sicob_mes';
			}elseif ($banco == '001') {
				$exibe_url = 'boleto_bb_mes';
			}elseif ($banco == '237') {
				$exibe_url = 'boleto_bradesco_mes';
			}elseif ($banco == '104') {
				$exibe_url = 'boleto_cef_sigcb_mes';
			}elseif ($banco == '748') {
				$exibe_url = 'boleto_sicredi_mes';
			}

			//$consulta_ja_enviou == 0 && $status_envio == 1
			if($consulta_ja_enviou == 0 && $status_envio == 1){
				$body = trocar_conteudo($email_html, $falta, $nome_cli, $cpf_cli, $endereco_cli, $numero_cli, $bairro_cli, $cidade_cli, $telefone1_cli,$nome_empreendimento, $data_venda, $email_cli, $data_vencimento, $url, $idempreendimento_cadastro, $img_lote, $exibe_url, $parcela_id, $contacorrente_id );

				$mail->msgHTML($body);


				$mail->addAddress($email_cli, $nome_cli);
				if (!empty($row['photo'])) {
	        		$mail->addStringAttachment($row['photo'], 'YourPhoto.jpg'); //Assumes the image data is stored in the DB
				}
				if (!$mail->send()) {
					mysqli_query($db,"INSERT INTO parcela_cobranca (dias_id, enviado, erro,parcela_id) VALUES ('$i', '1','1', '$parcela_id')"); 
					$resultado = 0;
				} else {
			        //Mark it as sent in the DB
					mysqli_query($db,"INSERT INTO parcela_cobranca (dias_id, enviado, sucesso, parcela_id) VALUES ('$i', '1','1', '$parcela_id')");
					$resultado = 1; 
				}
	    			// Clear all addresses and attachments for next loop
				$mail->clearAddresses();
				$mail->clearAttachments();
			}

		}
        }
	}


###########  ROTINA PARA PARCELAS JÁ VENCIDAS  #######################
	$busca_hoje 	= date('Y-m-d');  
	$busca_inicio   = date('Y-m-d',strtotime($busca_hoje . "-5 days"));

	for($i=4; $i<=6; $i++){
		if($i == 4){
			// Busco o Html do email de acordo com os dias vencidos do boleto
			$executa = mysqli_query($db,"SELECT venceu_5 FROM config_email");
			$busca = mysqli_fetch_assoc($executa);
			$email_html = $busca['venceu_5'];

			$falta = 'Venceu a 5 dias!';
			$busca_fim  = date('Y-m-d',strtotime($busca_hoje . "-10 days"));
		}elseif($i == 5){
			// Busco o Html do email de acordo com os dias vencidos do boleto
			$executa = mysqli_query($db,"SELECT venceu_10 FROM config_email");
			$busca = mysqli_fetch_assoc($executa);
			$email_html = $busca['venceu_10'];

			$falta = 'Venceu a 10 dias!';
			$busca_fim  = date('Y-m-d',strtotime($busca_hoje . "-15 days"));
		}else{
			// Busco o Html do email de acordo com os dias vencidos do boleto
			$executa = mysqli_query($db,"SELECT venceu_15 FROM config_email");
			$busca = mysqli_fetch_assoc($executa);
			$email_html = $busca['venceu_15'];

			$falta = 'Venceu a mais 15 dias!';
			$busca_fim  = date('Y-m-d',strtotime($busca_hoje . "-25 days"));
		}

		$result = mysqli_query($db, "SELECT * FROM parcelas 
					INNER JOIN venda ON parcelas.venda_idvenda = venda.idvenda 
					INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente 
					WHERE remessa = 1 AND fluxo = 0 AND tipo_venda = 2 AND situacao = 'Em aberto' AND email_cli != ''  AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$busca_fim."' and '".$busca_inicio."' ");

        
        if(mysqli_num_rows($result) !== 0){
		    foreach ($result as $row) {
			//Pegos os dados do cliente para trocar no html do email
			$nome_cli           = $row["nome_cli"];
			$cpf_cli            = $row["cpf_cli"];
			$cidade_cli         = $row["cidade_cli"];
			$email_cli          = $row["email_cli"];
			$endereco_cli       = $row["endereco_cli"];
			$numero_cli         = $row["numero_cli"];
			$bairro_cli         = $row["bairro_cli"];
			$telefone1_cli      = $row["telefone1_cli"];
			$data_venda			= $row["data_venda"];

			$parcela_id = $row['idparcelas'];

			//Consulta se ja foi enviado o e-mail
			$consulta_ja_enviou   = consulta_ja_enviou($parcela_id, $i);

			//captura os dados do empreendimento e do cliente
			$dados_empreendimento = dados_empreendimento($parcela_id);
			$status_envio		= $dados_empreendimento["status_envio"];
			$data_vencimento 	= $dados_empreendimento["data_vencimento_parcela"];
			$nome_empreendimento = $dados_empreendimento["descricao_empreendimento"];
			$contacorrente_id    = $dados_empreendimento["contacorrente_id"];
			$banco               = $dados_empreendimento["banco"];

			$idempreendimento_cadastro = $dados_empreendimento["idempreendimento_cadastro"];
			$img_lote               = $dados_empreendimento["img_lote"];
			
			$img_lote = str_replace(" ", "%20", $img_lote);
			
			if($banco == '033'){
				$exibe_url = 'boleto_santander_banespa-mes';
			}elseif($banco == '341'){
				$exibe_url = 'boleto_itau_mes';
			}

			if($consulta_ja_enviou == 0 && $status_envio == 1){

				$body = trocar_conteudo($email_html, $falta, $nome_cli, $cpf_cli, $endereco_cli, $numero_cli, $bairro_cli, $cidade_cli, $telefone1_cli,$nome_empreendimento, $data_venda, $email_cli, $data_vencimento, $url, $idempreendimento_cadastro, $img_lote, $exibe_url, $parcela_id, $contacorrente_id );


				$mail->msgHTML($body);


				$mail->addAddress($email_cli, $nome_cli);
				if (!empty($row['photo'])) {
	        		$mail->addStringAttachment($row['photo'], 'YourPhoto.jpg'); //Assumes the image data is stored in the DB
				}
				if (!$mail->send()) {
					mysqli_query($db,"INSERT INTO parcela_cobranca (dias_id, enviado, erro,parcela_id) VALUES ('$i', '1','1', '$parcela_id')"); 
					$resultado = 0;
				} else {
			        //Mark it as sent in the DB
					mysqli_query($db,"INSERT INTO parcela_cobranca (dias_id, enviado, sucesso, parcela_id) VALUES ('$i', '1','1', '$parcela_id')"); 
					$resultado = 1;
				}
	    			// Clear all addresses and attachments for next loop
				$mail->clearAddresses();
				$mail->clearAttachments();
			}

		}
        }
    
        
	}
	
?>