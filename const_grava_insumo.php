
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
	include "conexao.php";

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

		// var_dump($categoria);
		// die();
		$query = mysqli_query($db, "SELECT id FROM const_categoria WHERE `descricao` = '$categoria'")or die(mysqli_error($db));

		if($query != null){
			$query = mysqli_fetch_assoc($query);
			//aqui da aquele retorno
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

		// var_dump($vetor);
		// die();

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

		/*
		switch (json_last_error()) {
			case JSON_ERROR_NONE:
			echo ' - No errors';
			break;
			case JSON_ERROR_DEPTH:
			echo ' - Maximum stack depth exceeded';
			break;
			case JSON_ERROR_STATE_MISMATCH:
			echo ' - Underflow or the modes mismatch';
			break;
			case JSON_ERROR_CTRL_CHAR:
			echo ' - Unexpected control character found';
			break;
			case JSON_ERROR_SYNTAX:
			echo ' - Syntax error, malformed JSON';
			break;
			case JSON_ERROR_UTF8:
			echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
			break;
			default:
			echo ' - Unknown error';
			break;
		}
		*/

		//$aux = str_replace('pasta', 'title', $aux);

		//gravar($aux, $titulo);
	}

	//faço o cadastro de 1 linha da tabela
	if(isset($_POST['adiciona'])){

		$aux = $_POST['adiciona'];

		include "conexao.php";

		// die();


		$query = mysqli_query($db, "SELECT * FROM `const_insumos` WHERE `codigo`= $aux[0]")or die(mysqli_error($db));
		
		$aux[1] = addslashes($aux[1]);
		$valid = preg_match('//u', $aux[1]);
		if(empty($valid)){
			$aux[1] = utf8_encode($aux[1]);
		}

		$categoria = verifica_cat($aux[2]);
		$especie = verifica_cat($aux[3]);


		if(mysqli_num_rows($query) > 0){
			$aux_query = mysqli_fetch_assoc($query);
			$id_insumo_plano = $aux_query['id'];
			// echo 'mudo  --- ';
			//echo "UPDATE `const_insumos` SET `descricao`='".$aux[1]."',`id_categoria`= $categoria,`id_especie`= $especie
		 	//					WHERE `codigo`= '".$aux[0]."'";

			$query = mysqli_query($db, "UPDATE `const_insumos` SET `descricao`='".$aux[1]."',`id_categoria`= $categoria,`id_especie`= $especie
		 						WHERE `codigo`= $aux[0]")or die(mysqli_error($db));
			
		}else{
			// echo 'inseriu  --- ';
			//echo "INSERT INTO `const_insumos`(`codigo`, `descricao`, `id_categoria`, `id_especie`) 
			//					VALUES ('".$aux[0]."','".$aux[1]."', $categoria, $especie)";

			$query = mysqli_query($db, "INSERT INTO `const_insumos`(`codigo`, `descricao`, `id_categoria`, `id_especie`) 
								VALUES ($aux[0],'$aux[1]', $categoria, $especie)")or die(mysqli_error($db));
			

			$id_insumo_plano = mysqli_insert_id($db);
		}


		// realizo a mundança de id para tabela respectiva
		//  1 para no PAI (plano de contas)
		//  2 para Filho (insumos)
		if(isset($aux[4]) && isset($aux[5])){
			//var_dump($aux);
			//echo "</br>";
			//var_dump($id_insumo_plano);

			$query = mysqli_query($db, "UPDATE `tabela_orcamento` SET `id_insumo_plano`= $id_insumo_plano, `tabela`= $aux[5] WHERE `id` = $aux[4]")or die(mysqli_error($db));

			monta_json($aux[6]);


		}

		$retorno['id'] = $id_insumo_plano;
		$retorno['tabela'] = $aux[5];


		// var_dump($retorno);
		// die();

		echo json_encode($retorno);


	//Faço o cadastro da categoria
	}else if(isset($_POST['descricao_categoria'])){
		
		$categoria = ($_POST['descricao_categoria']);

		$query = mysqli_query($db, "INSERT INTO `const_categoria`(`descricao`, `categoria_pai`) VALUES ('$categoria', 0)")or die(mysqli_error($db));

		//tirar utf8 no servidor, pois ele buga o json encode
		$aux;
		$query = mysqli_query($db, "SELECT descricao FROM const_categoria WHERE `categoria_pai` = 0")or die(mysqli_error($db));
		while ($associa = mysqli_fetch_assoc($query)) {
			$aux[] = $associa['descricao'];
		}


		echo json_encode($aux);

	//Faço o cadastro da especie
	}else if(isset($_POST['descricao_especie'])){

		$especie = ($_POST['descricao_especie']);

		//Seleciono o Id da categoria da espécie
		$categoria = mysqli_fetch_assoc(mysqli_query($db, "SELECT id FROM const_categoria WHERE `descricao` = '".($_POST['select_categoria'])."'"));

		$query = mysqli_query($db, "INSERT INTO `const_categoria`(`descricao`, `categoria_pai`) VALUES ('$especie', ".$categoria['id'].")")or die(mysqli_error($db));

		echo "1";

	//Atualizo a lista de especie
	}else if(isset($_POST['opcao_select'])){


		//Seleciono o Id da categoria
		$categoria = mysqli_fetch_assoc(mysqli_query($db, "SELECT id FROM const_categoria WHERE `descricao` = '".($_POST['opcao_select'])."'"));

		if(!empty($categoria)){
			$aux = array();
			$query = mysqli_query($db, "SELECT descricao FROM const_categoria WHERE `categoria_pai` = '".$categoria['id']."'")or die(mysqli_error($db));
			
			while ($associa = mysqli_fetch_assoc($query)) {

				$san = $associa['descricao'];
				$aux[] = $san;
				
			}
			

				//ok
			echo json_encode($aux);

		}else{
			echo json_encode("1");
		}

	//Faço a atualização da tabela de acordo com a seleção dos select
	}else if(isset($_POST['categoria'])){
		$aux['categoria'] = verifica_cat($_POST['categoria']);
		$aux['especie'] =  verifica_cat($_POST['especie']);
		$insumo = array();

		if($aux['categoria'] != null && $aux['especie'] != null ){
			$query = mysqli_query($db, "SELECT * FROM `const_insumos` WHERE `id_categoria` = '".$aux['categoria']."' AND `id_especie`= '".$aux['especie']."'")or die(mysqli_error($db));

			if(mysqli_num_rows($query) > 0){
				$aux = null;
				while ($associa = mysqli_fetch_assoc($query)) {

					$aux_query = mysqli_query($db, "SELECT * FROM `tabela_orcamento` WHERE id_insumo_plano = ".$associa['id']." AND tabela = 2");
					if(mysqli_num_rows($aux_query) > 0){
						$aux['valida'] = 1;
					}else{
						$aux['valida'] = 0;
					}

					$aux['id'] = $associa['id'];
					$aux['codigo'] = $associa['codigo'];
					$aux['desc'] = $associa['descricao'];
					$aux['cat'] = (consulta_cat_id($associa['id_categoria']));
					$aux['esp'] = (consulta_cat_id($associa['id_especie']));

					

					array_push($insumo, $aux);
				}
			}
		}
		

		echo json_encode($insumo);
		/*switch (json_last_error()) {
			case JSON_ERROR_NONE:
			echo ' - No errors';
			break;
			case JSON_ERROR_DEPTH:
			echo ' - Maximum stack depth exceeded';
			break;
			case JSON_ERROR_STATE_MISMATCH:
			echo ' - Underflow or the modes mismatch';
			break;
			case JSON_ERROR_CTRL_CHAR:
			echo ' - Unexpected control character found';
			break;
			case JSON_ERROR_SYNTAX:
			echo ' - Syntax error, malformed JSON';
			break;
			case JSON_ERROR_UTF8:
			echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
			break;
			default:
			echo ' - Unknown error';
			break;
		}*/

	//faço a exclusão da linha selecionada
	}else if(isset($_POST['remove'])){
		$aux = $_POST['remove'];

		if($query = mysqli_query($db, "DELETE FROM `const_insumos` WHERE codigo = '$aux'")or die(mysqli_error($db))){
			echo json_encode("1");
		}else{
			echo json_encode("0");
		}	

	//faço a pesquisa no banco pela string apresentada
	}else if(isset($_POST['pesquisa'])){
		$pesquisa = $_POST['pesquisa'];
		$insumo = array();

		$query = mysqli_query($db, "SELECT * FROM `const_insumos` WHERE `descricao` LIKE '%$pesquisa%' OR `codigo` LIKE '%$pesquisa%' ")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			while ($associa = mysqli_fetch_assoc($query)) {

				$aux_query = mysqli_query($db, "SELECT * FROM `tabela_orcamento` WHERE id_insumo_plano = ".$associa['id']." AND tabela = 2");
				if(mysqli_num_rows($aux_query) > 0){
					$aux['valida'] = 1;
				}else{
					$aux['valida'] = 0;
				}

				$aux['codigo'] = $associa['codigo'];
				$aux['desc'] = ($associa['descricao']);
				$aux['cat'] = (consulta_cat_id($associa['id_categoria']));
				$aux['esp'] = (consulta_cat_id($associa['id_especie']));

				array_push($insumo, $aux);
			}
			echo json_encode($insumo);
		}else{
			echo json_encode('0');
		}
	}

	//alteração da tabela de Plano de Contas
	//fazer aqui
	

?>