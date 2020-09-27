
<?php 

	include "conexao.php";
	date_default_timezone_set('America/Sao_Paulo');

	//var_dump($_POST);

	function sanitizeString($str) {        // validaçao de CE esta sendo feita no js
		$str = preg_replace('/[áàãâä]/u', 'a', $str);
		$str = preg_replace('/[éèêë]/u', 'e', $str);
		$str = preg_replace('/[íìîï]/u', 'i', $str);
		$str = preg_replace('/[óòõôö]/u', 'o', $str);
		$str = preg_replace('/[úùûü]/u', 'u', $str);
		$str = preg_replace('/[ç]/u', 'c', $str);
		$str = preg_replace('/[ÁÀÃÂÄ]/u', 'A', $str);
		$str = preg_replace('/[ÉÈÊË]/u', 'E', $str);
		$str = preg_replace('/[ÍÌÎÏ]/u', 'I', $str);
		$str = preg_replace('/[ÓÒÔÕÖ]/u', 'O', $str);
		$str = preg_replace('/[ÚÙÛÜ]/u', 'U', $str);
		$str = preg_replace('/[Ç]/u', 'C', $str);
		return $str;
	}

	function busca_nome_usuario($id){
		//id = id_mestre obra
		include 'conexao.php';

		$query = mysqli_query($db, "SELECT `nome_cli` FROM `cliente` WHERE `idcliente` = $id");

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			return addslashes($assoc['nome_cli']);
		}else{
			return false;
		}
	}

	function busca_nome_tipo_sub($id){

		//id = id nome tipo
		include 'conexao.php';

		$query = mysqli_query($db, "SELECT * FROM `const_tipo_sub_empre` WHERE `id` =  $id");

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			return addslashes($assoc['titulo']);
		}else{
			return false;
		}
	}

	//Rotina para garavar um tipo de sub-empreendimento no banco
	if(isset($_POST['grava_tipo'])){

		include 'conexao.php';
		$titulo = addslashes($_POST['grava_tipo']);
		$m2 = addslashes($_POST['m2']);

		$query = mysqli_query($db, "INSERT INTO `const_tipo_sub_empre`(`titulo`, `area`) VALUES ('$titulo', '$m2')")or die(mysqli_error($db));

		echo json_encode(mysqli_insert_id($db));

	}

	//Rotina para gravar uma sub-empreendimento
	if(isset($_POST['grava_sub'])){

		include 'conexao.php';
		$dados = $_POST['grava_sub'];

		$titulo = sanitizeString($dados['titulo']);
		$obs = sanitizeString($dados['obs']);

		$titulo = addslashes($titulo);
		$obs = addslashes($obs);
		$tipo_sub = abs($dados['tipo_sub']);
		$mestre_obra = abs($dados['mestre_obra']);
		$empreendimento = abs($dados['empreendimento']);

		$query = mysqli_query($db, "INSERT INTO `const_sub_empreendimento`(`id_tipo`, `id_mestre_obra`,  `id_empreendimento`, `titulo`, `obs`) VALUES ($tipo_sub, $mestre_obra, $empreendimento ,'$titulo','$obs')")or die(mysqli_error($db));

		echo json_encode(1);
	}

	//Rotina para listar um sub-empreendimento
	if(isset($_POST['lista_sub_empre'])){

		$id_empreendimento = $_POST['lista_sub_empre'];
		include 'conexao.php';
		// var_dump($id_empreendimento);
		// 	die();

		$query = mysqli_query($db, "SELECT * FROM `const_sub_empreendimento` WHERE `id_empreendimento` = $id_empreendimento")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){

			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {

				//pega i tipo do subempreendimento pelo id
				$assoc['nome_tipo'] = busca_nome_tipo_sub($assoc['id_tipo']);
				$assoc['nome_resp'] = busca_nome_usuario($assoc['id_mestre_obra']);

				$dados[] = $assoc;
				
			}
			// var_dump($dados);
			// die();
			echo json_encode($dados);

		}else{
			echo json_encode(0);
		}
	}

	//DELETO SUB PELO BOTAO DA TABELA
	if(isset($_POST['deleta_sub'])){

		include 'conexao.php';
		$id_sub = $_POST['deleta_sub'];

		$query = mysqli_query($db, "DELETE FROM `const_sub_empreendimento` WHERE `id` = $id_sub")or die(mysqli_error($db));

		echo json_encode(1);
	}

	//DELETO PELO BOTAO DA TABELA
	if(isset($_POST['empreendimentoid'])){

		include 'conexao.php';
		$id_emp = $_POST['empreendimentoid'];
		$query = mysqli_query($db, "DELETE FROM `empreendimento_cadastro` WHERE `idempreendimento_cadastro` = $id_emp")or die(mysqli_error($db));

		echo json_encode(1);
	}



	//ATUALIZO O NOME DO EMPREENDIMENTO PELO CAMPO EDITAVEL NA TABELA
	if(isset($_POST['empreendimento_update'])){

		include 'conexao.php';
		$id_emp = abs($_POST['empreendimento_update']);
		$titulo = addslashes($_POST['titulo']);
		// var_dump($id_emp, $titulo);
		$query = mysqli_query($db, "UPDATE `empreendimento_cadastro` SET  `descricao_empreendimento` = '".$titulo."'  WHERE `idempreendimento_cadastro` = ".$id_emp."")or die(mysqli_error($db));
		// echo json_encode(1);
	};

	//ATUALIZO O NOME DO SUB PELO CAMPO EDITAVEL NA TABELA
	if(isset($_POST['sub_update'])){

		include 'conexao.php';
		$id_emp = abs($_POST['sub_update']);
		$titulo = addslashes($_POST['titulo']);
		$query = mysqli_query($db, "UPDATE `const_sub_empreendimento` SET titulo = '".$titulo."'  WHERE `id` = ".$id_emp."")or die(mysqli_error($db));
		// echo json_encode(1);
	};
	

 ?>