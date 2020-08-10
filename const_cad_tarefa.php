
<?php 
	include "conexao.php";
	date_default_timezone_set('America/Sao_Paulo');

	//Rotina para fazer o cadastro de uma nova tarefa
	if(isset($_POST['cod'])){

		$codigo = addslashes($_POST['cod']);
		$desc = strtoupper($_POST['desc']);
		$desc = addslashes($desc);
		$query = mysqli_query($db, "INSERT INTO `const_tarefas`( `codigo`, `titulo`) VALUES ('$codigo', '$desc')")or die(mysqli_error($db));

		echo json_encode(mysqli_insert_id($db));
	}	

	//Rotina para fazer a exclusão de uma tarefa
	if(isset($_POST['id_tarefa'])){

		$id_tarefa = $_POST['id_tarefa']; 

		$query = mysqli_query($db, "DELETE FROM `const_tarefas` WHERE `id`= $id_tarefa")or die(mysqli_error($db));

		echo json_encode(1);
	}

?>