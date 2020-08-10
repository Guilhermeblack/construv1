
<?php 
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	set_time_limit(0);

	//include "protege_professor.php";

	ini_set("upload_max_filesize", "10M");
	ini_set("max_execution_time", "-1");
	ini_set("memory_limit", "-1");
	ini_set("realpath_cache_size", "-1");
?>
<?php 

function sanitizeString($str) {    
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

function verifica_cat($categoria){
	include "conexao.php";
	$query = mysqli_query($db, "SELECT id FROM const_categoria WHERE `descricao` = '".($categoria)."'")or die(mysqli_error($db));

	if($query != null){
		$query = mysqli_fetch_assoc($query);
		return $query['id'];
	}

	return false;
}

function consulta_cat_id($id){
	include "conexao.php";

	$aux = mysqli_query($db, "SELECT descricao FROM const_categoria WHERE id = $id")or die(mysqli_error($db));
	if($aux != null){
		$aux = mysqli_fetch_assoc($aux);
		return $aux['descricao'];
	}
	return false;
}

function verifica_filho($idPai, $idFilho){

	$idPai = explode('.', $idPai);
	$idFilho = explode('.', $idFilho);

	foreach ($idPai as $key => $value) {

		if(strcmp($value, $idFilho[$key]) != 0){
			return false;
		}
	}

	return true;
}

function verifica_nivel($aux){
	return substr_count($aux, '.');
}

function has_children($id, $nivel){

	foreach ($nivel as $key => $value) {
		if(verifica_filho($id, $value['id_tarefa'])){
			return true;
		}
	}
	return false;
}

function get_children($id, $matrix){
	$aux = array();

	foreach ($matrix as $key => $value) {
		if(verifica_filho($id, $value['id_tarefa'])){
			array_push($aux, $value);
		}
	}
	return $aux;
}

function gravar($texto, $path = 'tabela'){
	//Variável arquivo armazena o nome e extensão do arquivo.
	$arquivo = "orcamentos/".$path.".json";
	 
	//Variável $fp armazena a conexão com o arquivo e o tipo de ação.
	$fp = fopen($arquivo, "w+");
 
	//Escreve no arquivo aberto.
	fwrite($fp, $texto);
	 
	//Fecha o arquivo.
	fclose($fp);
}

function escreve_array($pais, $matrix, $nivel){

	$vetor = array();

	foreach ($pais as $key => $value) {
		


		// de qualquer forma ele entra aqui pelo monta_json,
		// tanto para salvar tabela quanto para cadastrar insumo
		//   descobrir razao por que grava com letras nada a ve


		if(isset($matrix[($nivel+1)])){
			if(has_children($value['id_tarefa'], $matrix[($nivel+1)])){

				$aux = escreve_array(get_children($value['id_tarefa'], $matrix[($nivel+1)]), $matrix, ($nivel+1));

				$value['children'] = $aux;

				array_push($vetor, $value);
			}else{
				
				// se a string não tiver apenas caracteres comuns
				// if (preg_match('/^[a-zA-Z0-9]/', $value['pasta'])){

				// 	$value['pasta'] = utf8_decode($value['pasta']);
				// }


				array_push($vetor, $value);
			}
		}else{
			


			// se a string não tiver apenas caracteres comuns
			if (preg_match('/^[a-zA-Z]/', $value['pasta'])){

				$value['pasta'] = utf8_decode($value['pasta']);
			}

			$value['pasta'] = strtoupper(utf8_encode($value['pasta']));

			// print_r($value['pasta']);
			
			array_push($vetor, $value);
		}
	}

	return $vetor;
}

function monta_json($orcamento = 0){

	include "conexao.php";

	$query = mysqli_query($db, "SELECT * FROM const_orcamento WHERE id = $orcamento")or die(mysqli_error($db));

	if(mysqli_num_rows($query) > 0){

		$assoc = mysqli_fetch_assoc($query);

		$titulo = $assoc['titulo'];

	}else{
		$titulo = 'tabela';
	}

	$query = mysqli_query($db, "SELECT * FROM tabela_orcamento WHERE id_orcamento = $orcamento AND `status` = 1 ORDER BY id ")or die(mysqli_error($db));

	// Separo e monto a matrix com os niveis e os dados dos nós
	while ($executa_query = mysqli_fetch_assoc($query)) {

		$nivel = verifica_nivel($executa_query['id_tarefa']);

		if(!isset($matrix[$nivel])){
			$matrix[$nivel] = array();
		}

		//seto o parametro file, para exibição do icone
		if(empty($executa_query['quantidade']) && empty($executa_query['unidade']) && empty($executa_query['valor_unitario'])){
			$executa_query['type'] = 'folder';
		}else{
			$executa_query['type'] = 'file';
		}


		switch ($executa_query['tabela']) {
			case 1:
				$aux = mysqli_query($db, "SELECT * FROM `const_planocontas` WHERE `id` = ".$executa_query['id_insumo_plano']."")or die(mysqli_error($db));
				$aux = mysqli_fetch_assoc($aux);
				$executa_query['pasta'] = $aux['descricao'];
				break;
			case 2:
				$aux = mysqli_query($db, "SELECT * FROM `const_insumos` WHERE `id` = ".$executa_query['id_insumo_plano']."")or die(mysqli_error($db));
				$aux = mysqli_fetch_assoc($aux);
				$executa_query['pasta'] = $aux['descricao'];
				break;
			case 3:
				$aux = mysqli_query($db, "SELECT * FROM `const_temp` WHERE `id` = ".$executa_query['id_insumo_plano']."")or die(mysqli_error($db));
				$aux = mysqli_fetch_assoc($aux);
				$executa_query['pasta'] = $aux['descricao'];
				break;
			case 4:
				$aux = mysqli_query($db, "SELECT * FROM `const_tarefas` WHERE `id` = ".$executa_query['id_tarefa_plano']."")or die(mysqli_error($db));
				$aux = mysqli_fetch_assoc($aux);
				$executa_query['pasta'] = $aux['titulo'];
				break;
			default:
				echo "deu ruim";
				die();
				break;
		}


		array_push($matrix[$nivel], $executa_query);
	}		


	if(isset($matrix)){


		
		$aux = escreve_array($matrix[0], $matrix, 0);
		
		$aux = json_encode($aux);

		$aux = str_replace('pasta', 'title', $aux);

		gravar($aux, $titulo);
		
	}else{

		gravar('[{"id":"0","id_tarefa":"1","quantidade":"","unidade":"","valor_unitario":"","id_insumo_plano":"542","tabela":"1","status":"1","type":"folder","title":"Nova Tarefa"}]', $titulo);
	}

	$matrix = null;
	$aux = null;


	//Rotina para montar a tabela de tarefas
	$query = mysqli_query($db, "SELECT * FROM `const_item_tarefa_orcamento` WHERE id_orcamento = $orcamento AND `status` = 1 ORDER BY id ")or die(mysqli_error($db));

	// Separo e monto a matrix com os niveis e os dados dos nós
	while ($executa_query = mysqli_fetch_assoc($query)) {

		$nivel = verifica_nivel($executa_query['id_tarefa']);

		if(!isset($matrix[$nivel])){
			$matrix[$nivel] = array();
		}

		//seto o parametro file, para exibição do icone
		if(empty($executa_query['quantidade']) && empty($executa_query['unidade']) && empty($executa_query['valor_unitario'])){
			$executa_query['type'] = 'folder';
		}else{
			$executa_query['type'] = 'file';
		}


		switch ($executa_query['tabela']) {
			case 1:
				$aux = mysqli_query($db, "SELECT * FROM `const_planocontas` WHERE `id` = ".$executa_query['id_tarefa_plano']."")or die(mysqli_error($db));
				$aux = mysqli_fetch_assoc($aux);
				$executa_query['pasta'] = $aux['descricao'];
				break;
			case 2:
				$aux = mysqli_query($db, "SELECT * FROM `const_tarefas` WHERE `id` = ".$executa_query['id_tarefa_plano']."")or die(mysqli_error($db));
				$aux = mysqli_fetch_assoc($aux);
				$executa_query['pasta'] = $aux['descricao'];
				break;
			case 3:
				$aux = mysqli_query($db, "SELECT * FROM `const_temp` WHERE `id` = ".$executa_query['id_tarefa_plano']."")or die(mysqli_error($db));
				$aux = mysqli_fetch_assoc($aux);
				$executa_query['pasta'] = $aux['descricao'];
				break;
			case 4:
				$aux = mysqli_query($db, "SELECT * FROM `const_tarefas` WHERE `id` = ".$executa_query['id_tarefa_plano']."")or die(var_dump(123));
				$aux = mysqli_fetch_assoc($aux);
				$executa_query['pasta'] = $aux['titulo'];
				break;
			default:
				echo "deu ruim";
				die();
				break;
		}

		//$executa_query['pasta'] = utf8_encode($executa_query['pasta']);
		//$executa_query['pasta'] = $executa_query['pasta'];

		array_push($matrix[$nivel], $executa_query);
	}		


	if($matrix != null){
		$aux = escreve_array($matrix[0], $matrix, 0);
		
		$aux = json_encode($aux);

		$aux = str_replace('pasta', 'title', $aux);

		gravar($aux, $titulo."_tarefa");
	}else{

		gravar('[{"id":"0","id_tarefa":"1","quantidade":"","unidade":"","valor_unitario":"","id_insumo_plano":"542","tabela":"1","status":"1","type":"folder","title":"Nova Tarefa"}]', $titulo."_tarefa");
	}

}

	include "conexao.php";
	if(	isset($_POST['adiciona'])){	

		if(isset($_POST['adiciona'][0]) && isset($_POST['adiciona'][1])){

			$codigo = $_POST['adiciona'][0];
			$descricao = $_POST['adiciona'][1];

			//$aux = explode('.', $codigo);

			//$tipo_plano = $aux[0];
			$tipo_plano = 1;

			$query = mysqli_query($db, "SELECT * FROM `const_planocontas` WHERE `codigo` = '$codigo'");

			if(mysqli_num_rows($query) > 0){
				$aux_query = mysqli_fetch_assoc($query);
				$id_insumo_plano = $aux_query['id'];

				$query = mysqli_query($db, "UPDATE `const_planocontas` SET `descricao`='$descricao' WHERE `codigo`= '$codigo' ")or die(mysqli_error($db));
			}else{
				$query = mysqli_query($db, "INSERT INTO `const_planocontas`(`codigo`, `descricao`, `tipo_plano`) VALUES ('$codigo', '$descricao', $tipo_plano)")or die(mysqli_error($db));

				$id_insumo_plano = mysqli_insert_id($db);
			}

			// realizo a mundança de id para tabela respectiva
			//  1 para no PAI (plano de contas)
			//  2 para Filho (insumos)

			if(isset( $_POST['adiciona'][2]) && isset( $_POST['adiciona'][3])){
				//var_dump($aux);
				//echo "</br>";
				//var_dump($id_insumo_plano);
				$tabela = $_POST['adiciona'][3];
				$id = $_POST['adiciona'][2];
				$orc = $_POST['adiciona'][4];

				$query = mysqli_query($db, "UPDATE `tabela_orcamento` SET `id_insumo_plano`= $id_insumo_plano, `tabela`= $tabela WHERE `id` = $id ")or die(mysqli_error($db));


				monta_json($orc);

				$retorno['id'] = $id_insumo_plano;
				$retorno['tabela'] = $tabela;

				echo json_encode($retorno);
			}else{
				echo json_encode("1");
			}

			
		}else{
			echo json_encode(0);
		}

	}elseif(isset($_POST['remove'])){	

		$codigo = $_POST['remove'];
		
		if(mysqli_query($db, "DELETE FROM const_planocontas WHERE codigo = '$codigo'")or die(mysqli_error($db))){

			$codigo = $_POST['remove'][0];
			$query = mysqli_query($db, "DELETE FROM const_planocontas WHERE codigo = '$codigo'")or die(mysqli_error($db));

			echo json_encode(1);
		}else{
			echo json_encode(0);
		}
	}

 ?>