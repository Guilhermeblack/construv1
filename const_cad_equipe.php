<?php 

	date_default_timezone_set('America/Sao_Paulo');
	$today = date("d-m-Y"); 
	$hora = date("H-i-s");
	include "conexao.php";

	
	//Rotina para gravar uma nova equipe e seus respectivos funcionarios
	if(isset($_POST['nome_equipe'])){

		$nome_equipe = strtoupper($_POST['nome_equipe']);
		$funcionarios = $_POST['id_funcionario'];

		$query = mysqli_query($db, "INSERT INTO `const_equipe`(`nome`, `data`, `status`) VALUES ('$nome_equipe', '$today', 1)")or die(mysqli_error($db));

		$id_equipe = mysqli_insert_id($db);

		foreach ($funcionarios as $key => $value) {
			$query = mysqli_query($db, "INSERT INTO `const_funcionario_equipe`(`id_equipe`, `id_funcionario`) VALUES ($id_equipe, $value)")or die(mysqli_error($db));
		}

		echo json_encode(1);
	}

	//Rotina para Excluir lógicamente uma equipe 
	elseif(isset($_POST['exclui_equipe'])){
		$id_equipe = $_POST['exclui_equipe'];

		$query = mysqli_query($db, "SELECT * FROM `const_equipe` WHERE `id` = $id_equipe")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$query = mysqli_query($db, "UPDATE `const_equipe` SET `status` = 0   WHERE `id` = $id_equipe")or die(mysqli_error($db));

			echo json_encode(1);
		}else{
			echo json_encode(0);
		}
	}

	//Rotina para listar todos os funcionarios pertencentes a uma Equipe
	elseif(isset($_POST['lista_funcionario'])){
		$id_equipe = $_POST['lista_funcionario'];

		$query = mysqli_query($db, "SELECT * FROM cliente INNER JOIN const_funcionario_equipe AS CFE ON cliente.idcliente = CFE.id_funcionario WHERE CFE.id_equipe = $id_equipe")or die(mysqli_error($db));


		if(mysqli_num_rows($query) > 0 ){

			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {
				$dados[] = $assoc;
			}

			echo json_encode($dados);
		}else{
			echo json_encode(0);
		}

	}



 ?>