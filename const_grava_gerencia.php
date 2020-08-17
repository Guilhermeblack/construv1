<?php 
	
	// var_dump($_POST);

	include "conexao.php";


	date_default_timezone_set('America/Sao_Paulo');

	$today = date("d-m-Y"); 
	$hora = date("H-i-s");

	function busca_nome_usuario($id){
		include 'conexao.php';

		// echo 'ooo id >',$id;
		$query = mysqli_query($db, "SELECT `nome_cli` FROM `cliente` WHERE `idcliente` = $id");

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			return addslashes($assoc['nome_cli']);
		}else{
			return false;
		}
	}

















	//ROTINA PARA GRAVAR UMA NOVA TAREFA_SUB_EMPREENDIEMNTO
	if(isset($_POST['select_tarefa']) && isset($_POST['select_equipe'])){


		var_dump($_POST);
		
		$tarefa = $_POST['select_tarefa'];
		$equipe = $_POST['select_equipe'];
		$sub_empre = $_POST['select_sub_empre'];

		$valor_tarefa = str_replace('R$', '', $_POST['valor_tarefa']);
		$valor_tarefa = str_replace(' ', '', $_POST['valor_tarefa']);
		$valor_tarefa = str_replace(',', '.', $valor_tarefa); 
		// $valor_tarefa = substr($valor_tarefa, 2);

		$valor_total = str_replace('R$', '', '0,00');
		$qnt_a_fazer = 'Indefinido';

		if($_POST['valor_total']){
			$valor_total = str_replace('R$', '', $_POST['valor_total']);
			$valor_total = str_replace(',', '.', $valor_total); 
			// $valor_total = substr($valor_total, 2);

		}
		
		if($_POST['qnt_fazer']){

			$qnt_a_fazer = $_POST['qnt_fazer'];
		}


		$data_inicio = $_POST['input_data_inicio'];
		$data_fim = $_POST['input_data_fim'];
		
		$unidade = $_POST['unidade'];


		// STATUS 1 PARA TAREFAS EM ANDAMENTO	
		$query = mysqli_query($db, "INSERT INTO `const_tarefa_sub_empre`( `id_tarefa`, `id_equipe`, `id_sub_empre`, `status`, `tempo_previsto`, `data_inicio`, `data_fim`, `data_criacao_tarefa`, `valor_tarefa`, `total_a_fazer`, `unidade_medida`, `valor_total`) VALUES ($tarefa,$equipe,$sub_empre,1,'0','$data_inicio','$data_fim', '$today' ,'$valor_tarefa','$qnt_a_fazer','$unidade', '$valor_total')")or die(mysqli_error($db));
	}else


















	//ROTINA PARA FILTRAR TODOS AS TAREFAS EM ANDAMENTO DE ACORDO COM O EMPREENDIMENTO SELECIONADO
	if(isset($_POST['filtra_empreendimento'])){

		$empreendimento = $_POST['filtra_empreendimento'];

		$query = mysqli_query($db, "SELECT CTSE.id FROM const_tarefa_sub_empre AS CTSE INNER JOIN const_sub_empreendimento AS CSE ON CTSE.id_sub_empre = CSE.id INNER JOIN empreendimento_cadastro AS EC ON CSE.id_empreendimento = EC.idempreendimento_cadastro WHERE EC.idempreendimento_cadastro = $empreendimento")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){

			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {
				$dados[] = $assoc;
			}

			echo json_encode($dados);
		}else{
			echo json_encode(0);
		}
	}else

	//ROTINA PARA FILTRAR TODOS AS TAREFAS EM ANDAMENTO DE ACORDO COM O ORÇAMENTO SELECIONADO
	if(isset($_POST['filtra_empreendimento_vdd'])){

		$orc = $_POST['filtra_empreendimento_vdd'];

		$query = mysqli_query($db, "SELECT CTSE.id FROM const_tarefa_sub_empre AS CTSE INNER JOIN const_sub_empreendimento AS CSE ON CTSE.id_sub_empre = CSE.id INNER JOIN const_orcamento AS CO ON CSE.id = CO.id_empreendimento WHERE CO.id = $orc")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){

			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {
				$dados[] = $assoc;
			}

			echo json_encode($dados);
		}else{
			echo json_encode(0);
		}
	}else

	//Rotina para listar os orçamentos de acordo com o empreendimento selecionado
	if(isset($_POST['lista_orcamento'])){

		$id = $_POST['lista_orcamento'];







		// retorna apenas orçamentos fechados

		$query = mysqli_query($db, "SELECT const_orcamento.id, const_orcamento.titulo, const_orcamento.status_editar, const_orcamento.data_finalizado FROM const_orcamento INNER JOIN const_sub_empreendimento ON const_orcamento.id_empreendimento = const_sub_empreendimento.id WHERE const_sub_empreendimento.id_empreendimento = $id AND const_orcamento.status_editar = 0")or die(mysqli_error($db));






		
		if(mysqli_num_rows($query) > 0){
			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {
				$dados[] = $assoc;
			}

			echo json_encode($dados);
				
		}else{
			echo json_encode(0);
		}
	}else
























	// ROTINA PARA LISTAR TODAS AS MEDIÇÕES FEITAS DESSA TAREFAS
	if(isset($_POST['lista_medicao'])){

		include 'conexao.php';
		$id_tarefa = $_POST['lista_medicao'];

		// echo $id_tarefa;

		// chama a mediçao de acordo com a tarefa
		$query = mysqli_query($db, "SELECT * FROM `const_medicao` WHERE `id_tarefa_sub` = ".$id_tarefa."")or die(mysqli_error($db));
		$query2 = mysqli_query($db, "SELECT `valor_tarefa` FROM `const_tarefa_sub_empre` WHERE `id` = ".$id_tarefa."")or die(mysqli_error($db));
		$quer = mysqli_fetch_assoc($query2);
		$vlr= $quer['valor_tarefa'];
		// echo $vlr.' | ';
		$pos = strrpos($vlr, '.');

		if($pos !== false)
		{

			if($vlr[1] == "/[\d.]/"){
			
				$vlr = ' 0'.$vlr;
			}
			$vlr = substr($vlr,2);
			// $vlr = substr_replace($vlr,',',$pos,1 );
			$npontos = substr_count($vlr,'.');
			if($npontos>1){
				
				
				
				$vlr =  preg_replace("/[^0-9]/", "",$vlr);
				$vlr = substr_replace($vlr,'.', -2, 0);
			}
			

		}

		// echo $vlr;
		if(mysqli_num_rows($query) > 0){

			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {

				if(empty($assoc['vlr_total_medicoes'])){
					$assoc['vlr_total_medicoes'] =0;
				}

				if(empty($assoc['tot_medido'])){
					$assoc['tot_medido'] =0;
				}
				
				$assoc['vlr_med'] = $vlr;
				$assoc['tot_medido'] += abs($assoc['qnt_medida']);

				$assoc['vlr_total_medicoes']= (abs($vlr) * $assoc['tot_medido']);
				$assoc['nome_cli'] = busca_nome_usuario($assoc['id_user']);
				$dados[] = $assoc;
			}

			echo json_encode($dados);
		}else{
			echo json_encode(1);
		}
	}else





















	//ROTINA PARA GRAVAR UMA NOVA MEDICAO REFERENTE A UMA TAREFA
	if(isset($_POST['qnt_medida'])){

		$qnt = $_POST['qnt_medida'];
		$user = $_POST['user_medida'];
		$tarefa =  $_POST['tarefa'];

		$query = mysqli_query($db, "SELECT * FROM `const_tarefa_sub_empre` WHERE `id` = ".$tarefa."")or die(mysqli_error($db));

		if(mysqli_num_rows($query)){

			$assoc = mysqli_fetch_assoc($query);

			if($assoc['total_a_fazer'] > 0){

				$total = (floatval($assoc["total_a_fazer"]) - floatval($qnt) );
				if($total > 0){

					$query = mysqli_query($db, "UPDATE `const_tarefa_sub_empre` SET `total_a_fazer`= `".$total."` WHERE `id` = ".$tarefa."")or die(mysqli_error($db));

				}

			}
			

			$query = mysqli_query($db, "INSERT INTO `const_medicao`(`id_user`, `id_tarefa_sub`, `qnt_medida`, `data_medicao`, `obs`) VALUES ($user, $tarefa, $qnt,'$today','')")or die(mysqli_error($db));

			$id = mysqli_insert_id($db);

			$vlr = mysqli_query($db, "SELECT `valor_tarefa` FROM `const_tarefa_sub_empre` WHERE `id` = ".$tarefa."");
			$vlr = mysqli_fetch_assoc($vlr);
			$vlr = $vlr['valor_tarefa'];

			$pos = strrpos($vlr, '.');

			if($pos !== false)
			{

				if($vlr[1] == "/[\d.]/"){
			    
					$vlr = ' 0'.$vlr;
				}
				$vlr = substr($vlr,2);
				// $vlr = substr_replace($vlr,',',$pos,1 );
				$npontos = substr_count($vlr,'.');
				if($npontos>1){
					
					
					
					$vlr =  preg_replace("/[^0-9]/", "",$vlr);
					$vlr = substr_replace($vlr,'.', -2, 0);
				}
				

			}
			// echo $vlr;
			// echo ' valoraaao';

			$query = mysqli_query($db, "SELECT * FROM `const_medicao` WHERE `id` = ".$id."")or die(mysqli_error($db));

			if(mysqli_num_rows($query)){
				$dados = [];

				while ($assoc = mysqli_fetch_assoc($query)) {

					if(empty($assoc['vlr_total_medicoes'])){
						$assoc['vlr_total_medicoes'] =0;
					}
	
					if(empty($assoc['tot_medido'])){
						$assoc['tot_medido'] =0;
					}
					
					$assoc['vlr_med'] = $vlr;
					$assoc['tot_medido'] += abs($assoc['qnt_medida']);
	
					$assoc['vlr_total_medicoes']= (abs($vlr) * $assoc['tot_medido']);
					$assoc['nome_cli'] = busca_nome_usuario($assoc['id_user']);
					$dados[] = $assoc;
				}


				echo json_encode($dados);
			}else{
				echo json_encode(0);
			}
		}	
	}else























	
	// ROTINA PARA GRAVAR IMAGEN DA MEDICAO REALIZADA
	if(isset($_FILES['image'])){ 
		require_once("Image.php");


		//Verifico se a imagen ja esta no chache do servidor
		if($_FILES['image']['tmp_name'] != ''){
			$id_recebimento = $_POST['id_recebimento'];


			// var_dump($id_recebimento);
			// die();
			$form_field = "image";
			$upload_path = "fotos_medicao/";

			//assume uploading a jpeg image file, this can be determined by file type while uploading and here we do not care about the image since it's not a big deal here.
			$image_name = uniqid().".jpg";

			//Create an object of <strong>'Image'</strong> class and call to <strong>'upload_image'</strong> function which we are going to use here for our process.
			$imgObj = new Image();

			$dimensao = $imgObj->get_image_width_height('jpg', $_FILES['image']['tmp_name']);

			// var_dump($dimensao);
			// die();
			//com os dados em posse vamos achar o ratio (proporçao da imagem) 
			$ratio = $dimensao[0]/$dimensao[1];
			$width = 1366;
			$height = 768;

			//indica que a largura da imagem original esta maior que o que queremos entao vamos reduzir a largura
			if($width / $height > $ratio){
			    $width = $height * $ratio;
			}else{
			    $height = $width / $ratio; //se nao a algura que sera reduzida
			}

			$upload = $imgObj->upload_image($form_field, $upload_path, $image_name, $width, $height);

			if($upload)
			{
				// echo 'entrou insert';
				// die();

				//Atualizo a medicao com o path da foto salva
				$query = mysqli_query($db, "INSERT INTO `const_fotos_medicao`( `path_foto`, `id_medicao`) VALUES ('fotos_medicao/$image_name', $id_recebimento)")or die(mysqli_error($db));
				echo json_encode(1);
			}
			else
			{
				echo json_encode(0);
			}
		}else{
			echo json_encode(0);
		}
	}else

	// ROTINA PARA MOSTRAR A FOTO DA MEDICAO
	if(isset($_POST['foto_medicao'])){ // Busco o path da foto do recibo de acordo com o recebiment passado

		$id = $_POST['foto_medicao'];
		$query = mysqli_query($db, "SELECT * FROM `const_fotos_medicao` WHERE `id_medicao` =  $id ")or die(mysqli_error($db));

		if(mysqli_num_rows($query)){
			$assoc = mysqli_fetch_assoc($query);
			$path = $assoc['path_foto'];

			echo json_encode($path);
		}else{
			echo json_encode(000);
		}
	}else

	//ROTINA PARA FINALIZAR UMA MEDICAO
	if(isset($_POST['finaliza_tarefa'])){

		$id_tarefa = $_POST['finaliza_tarefa'];

		$query = mysqli_query($db, "UPDATE `const_tarefa_sub_empre` SET `status`= 0  WHERE `id` = $id_tarefa")or die(mysqli_error($db));

		echo json_encode(1);
	}

 ?>