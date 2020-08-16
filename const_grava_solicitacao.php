
<?php 
	//error_reporting(0);
	//ini_set(“display_errors”, 0 );
	set_time_limit(0);

	//include "protege_professor.php";

	ini_set("upload_max_filesize", "10M");
	ini_set("max_execution_time", "-1");
	ini_set("memory_limit", "-1");
	ini_set("realpath_cache_size", "-1");
?>
<?php 
	
	include "conexao.php";
	date_default_timezone_set('America/Sao_Paulo');

	function busca_nome_insumo($id){
		include "conexao.php";

		$query = mysqli_query($db, "SELECT `descricao` FROM `const_insumos` WHERE `id`= $id")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			return $assoc['descricao'];
		}else{
			return false;
		}
	}

	function sanitizeString($str) {
		$str = preg_replace('/[ñ]/u', 'n', $str);
		$str = preg_replace('/[áàãâä]/u', 'a', $str);
		$str = preg_replace('/[éèêë]/u', 'e', $str);
		$str = preg_replace('/[íìîï]/u', 'i', $str);
		$str = preg_replace('/[óòõôö]/u', 'o', $str);
		$str = preg_replace('/[úùûü]/u', 'u', $str);
		$str = preg_replace('/[ç]/u', 'c', $str);
		$str = preg_replace('/[Ñ]/u', 'N', $str);
		$str = preg_replace('/[ÁÀÃÂÄ]/u', 'A', $str);
		$str = preg_replace('/[ÉÈÊË]/u', 'E', $str);
		$str = preg_replace('/[ÍÌÎÏ]/u', 'I', $str);
		$str = preg_replace('/[ÓÒÔÕÖ]/u', 'O', $str);
		$str = preg_replace('/[ÚÙÛÜ]/u', 'U', $str);
		$str = preg_replace('/[Ç]/u', 'C', $str);
		return $str;
	}

	function busca_nome_fornecedor($id){
		include 'conexao.php';

		$query = mysqli_query($db, "SELECT `nome_cli` FROM `cliente` WHERE `idcliente` = $id");

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			return addslashes($assoc['nome_cli']);
		}else{
			return false;
		}
	}

	function busca_nome_usuario($id){
		include 'conexao.php';

		$query = mysqli_query($db, "SELECT `nome_cli` FROM `cliente` WHERE `idcliente` = $id");

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			return addslashes($assoc['nome_cli']);
		}else{
			return false;
		}
	}

	function busca_id_insumo($nomeInsumo){
		include "conexao.php";

		$query = mysqli_query($db, "SELECT id FROM `const_insumos` WHERE descricao = '$nomeInsumo' LIMIT 1")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			return $assoc['id'];
		}else{
			return false;
		}
	}

	function existe_categoria($categoria){
		include "conexao.php";

		$query = mysqli_query($db, "SELECT * FROM `const_categoria` WHERE `descricao` = '$categoria' ")or die(mysqli_error($db));

		if($aux = mysqli_fetch_assoc($query)){
			return true;
		}

		return false;
	}

	function id_categoria($categoria){
		include "conexao.php";

		$query = mysqli_query($db, "SELECT * FROM `const_categoria` WHERE `descricao` = '$categoria' ")or die(mysqli_error($db));

		if($aux = mysqli_fetch_assoc($query)){
			return $aux['id'];
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

	    return 1;
	}

	function escreve_array($pais, $matrix, $nivel){

		$vetor = array();

		foreach ($pais as $key => $value) {

			// if(is_string($value['pasta'])){
			// 	$value['pasta'] = sanitizeString($value['pasta']);
			// };


			if(isset($matrix[($nivel+1)])){
				if(has_children($value['id_tarefa'], $matrix[($nivel+1)])){

					$aux = escreve_array(get_children($value['id_tarefa'], $matrix[($nivel+1)]), $matrix, ($nivel+1));

					$value['children'] = $aux;

					array_push($vetor, $value);
				}else{
					array_push($vetor, $value);
				}
			}else{
				
				
				array_push($vetor, $value);
			}
		}

		return $vetor;
	}

	function monta_json($orcamento = 0){

		include "conexao.php";

		$query = mysqli_query($db, "SELECT * FROM const_orcamento WHERE id = $orcamento");

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);
			$titulo = utf8_decode($assoc['titulo']);
		}else{
			$titulo = 'tabela';
		}

		$query = mysqli_query($db, "SELECT * FROM tabela_orcamento WHERE id_orcamento = $orcamento ORDER BY id ")or die(mysqli_error($db));

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
				default:
					echo "deu ruim";
					die();
					break;
			}


			//Bloco para pegar a quantidade Já solicitada
			$aux_query = mysqli_query($db, "SELECT * FROM `const_item_solicitacao_material` WHERE `id_insumo_orc` = ".$executa_query['id']."")or die(mysqli_error($db));
			$total =0;

			
			// rotina para definir as quantidades orçadas, recebidas e devolvidas \/

			if(mysqli_num_rows($aux_query) > 0){
				while ($assoc = mysqli_fetch_assoc($aux_query)) {
					$total += $assoc['qnt'];
				}

				$executa_query['qnt_solicitada'] = $total;
			}else{
				$executa_query['qnt_solicitada'] = 0;
			}

			//Bloco para pegar a quantidade ja devolvida
			$aux_query = mysqli_query($db, "SELECT `qnt` FROM `const_deposito_entrada` WHERE `id_orcamento` = ".$executa_query['id_orcamento']." AND `id_insumo` = ".$executa_query['id_insumo_plano']."")or die(mysqli_error($db));
			
			$total = 0;

			if(mysqli_num_rows($aux_query) > 0){
				while ($assoc = mysqli_fetch_assoc($aux_query)) {
					$total += $assoc['qnt'];
				}

				$executa_query['qnt_devolvida'] = $total;
			}else{
				$executa_query['qnt_devolvida'] = 0;
			}


			//Bloco para pegar a quantidade ja Recebida
			$aux_query = mysqli_query($db, "SELECT CRI.id_insumo, CRI.qnt FROM const_recebimento_insumo AS CRI INNER JOIN const_recebimento_material AS CRM ON CRI.id_recebimento = CRM.id INNER JOIN const_solicitacao_oc AS CSO ON CSO.id_oc = CRM.id_oc INNER JOIN const_solicitacao_material AS CSM ON CSM.id = CSO.id_solicitacao WHERE CSM.id_orcamento = ".$executa_query['id_orcamento']." AND CRI.id_insumo = ".$executa_query['id_insumo_plano']." ")or die(mysqli_error($db));
			
			$total = 0;

			if(mysqli_num_rows($aux_query) > 0){
				while ($assoc = mysqli_fetch_assoc($aux_query)) {
					$total += $assoc['qnt'];
				}

				$executa_query['qnt_recebida'] = $total;
			}else{
				$executa_query['qnt_recebida'] = 0;
			}


			// $executa_query['pasta'] = utf8_encode($executa_query['pasta']);
			//$executa_query['pasta'] = $executa_query['pasta'];

			array_push($matrix[$nivel], $executa_query);
		}		

		$aux = escreve_array($matrix[0], $matrix, 0);
		
		$aux = json_encode($aux);

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
		}*/

		$aux = str_replace('pasta', 'title', $aux);

		$aux_gravar = gravar($aux, $titulo);
	}

	function formata_valor($valor){
		$valor = explode(' ', $valor);
	    $aux = str_replace(',', '.', $valor[1]);

	    //OBS: vard_dump na $linha para ver como vem a informação
	    //$aux = str_replace('.', '', $aux[0]);
	    //$aux = str_replace(',', '', $aux[1]);

	    //$aux = number_format($aux[0], 2, '.', '');

	    return $aux;
	}


	//var_dump($_POST);
	//var_dump($_FILES);

	// Remonto o Json de acordo com o id do orçamento
	if(isset($_POST['id_orcamento'])){
		$id_orcamento = $_POST['id_orcamento'];

		monta_json($id_orcamento);


		$query = mysqli_query($db, "SELECT * FROM `const_solicitacao_material` WHERE `id_orcamento` = $id_orcamento ORDER BY id DESC")or die(mysqli_error($db));

		//teste nao possui solicitacao
		if(mysqli_num_rows($query) > 0){

			$dados = [];

			//Rotina para verificar se essa solicitacao ja foi recebida, se sim completa ou nao!
			while($assoc = mysqli_fetch_assoc($query)) {

				// $query_aux = mysqli_query($db, "SELECT CRM.recebimento_completo AS completo FROM const_solicitacao_material AS CSM INNER JOIN const_solicitacao_oc AS CSC ON CSM.id = CSC.id_solicitacao INNER JOIN const_ordem_compra AS COC ON CSC.id_oc = COC.id INNER JOIN const_recebimento_material AS CRM ON COC.id = CRM.id_oc WHERE CSM.id = ".$assoc['id']."")or die(mysqli_error($db));

				$completo = $assoc['id_oc'];

				// $query_aux = mysqli_query($db, "SELECT COC.id FROM const_solicitacao_material AS CSM INNER JOIN const_solicitacao_oc AS CSC ON CSM.id = CSC.id_solicitacao INNER JOIN const_ordem_compra AS COC ON CSC.id_oc = COC.id WHERE CSM.id = ".$assoc['id']."")or die(mysqli_error($db));

				$query_aux = mysqli_query($db, "SELECT CRM.recebimento_completo AS completo FROM const_solicitacao_material AS CSM INNER JOIN const_solicitacao_oc AS CSC ON CSM.id = CSC.id_solicitacao INNER JOIN const_ordem_compra AS COC ON CSC.id_oc = COC.id INNER JOIN const_recebimento_material AS CRM ON COC.id = CRM.id_oc WHERE CSM.id = ".$assoc['id']."")or die(mysqli_error($db));


				if(mysqli_num_rows($query_aux) > 0){

					while ($assoc_aux = mysqli_fetch_assoc($query_aux)) {

						$assoc_aux['completo'] == 0 ? $completo = 3 : $completo = 2;


						// // $query_aux2 = mysqli_query($db, "SELECT CRM.recebimento_completo AS completo FROM const_recebimento_material AS CRM INNER JOIN const_ordem_compra AS COC ON COC.id = CRM.id_oc WHERE COC.id = ".$assoc_aux['id']." ")or die(mysqli_error($db));

						// if(mysqli_num_rows($query_aux2) > 0){

						// 	$completo = 2;

						// 	while ($assoc_aux2 = mysqli_fetch_assoc($query_aux2)) {
						// 		$assoc_aux2['completo'] == 0 ? $completo = 3 : '';
						// 	}

						// }else{
						// 	$completo = 3;
						// }
					}
				}

				$assoc['id_oc'] = $completo;
				$assoc['nome_usuario'] = busca_nome_usuario($assoc['id_user']); 

				$dados[] = $assoc;
			}

			// print_r($dados);
			// die();

			echo json_encode($dados);
		}else{
			echo json_encode(1);
		}
	}else if(isset($_POST['id_orcamento_solicitacao']) && isset($_POST['id_user']) && isset($_POST['linhas'])){ //Função para gravar Solicitação e itens solicitados no banco

		$orcamento = $_POST['id_orcamento_solicitacao'];
		$user = $_POST['id_user'];
		$linhas = $_POST['linhas'];
		$fornecedor = $_POST['fornecedor'];
		$aprovacao = $_POST['aprovacao'];
		$id_oc = -1;

		$today = date("d-m-Y"); 
		$hora = date("H-i-s");

		$query = mysqli_query($db, "INSERT INTO `const_solicitacao_material`(`id_user`, `id_orcamento`, `id_oc`, `id_destino`, `aprovado`, `data`, `hora`) VALUES ($user,$orcamento, $id_oc, $fornecedor, $aprovacao,'$today', '$hora' )")or die(mysqli_error($db));


		$id_solicitacao = mysqli_insert_id($db);

		foreach ($linhas as $key => $value) {
			$query = mysqli_query($db, "INSERT INTO `const_item_solicitacao_material`( `id_solicitacao_mat`, `id_insumo`, `id_insumo_orc`, `qnt`) VALUES ($id_solicitacao,$value[0],$value[1], '$value[2]')")or die(mysqli_error($db));
		}

		echo json_encode(1);
	}else if(isset($_POST['id_solicitacao'])){ //Função para buscar todos os itens da referda solicitação

		$id = $_POST['id_solicitacao'];


		$query = mysqli_query($db, "SELECT CISM.qnt, CI.descricao FROM `const_item_solicitacao_material` AS CISM INNER JOIN const_insumos AS CI ON CISM.id_insumo = CI.id WHERE CISM.id_solicitacao_mat = $id")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){

			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {
				$assoc['descricao'] = $assoc['descricao'];
				$dados[] = $assoc;
			}

			echo json_encode($dados);

		}else{

			echo json_encode(0);

		}
		
	}else if(isset($_POST['cancela_solicitacao']) && isset($_POST['motivo']) && isset($_POST['id_user'])){ // Realizo o cancelamento da solicitação

		$id_solicitacao = $_POST['cancela_solicitacao'];
		$motivo = addslashes($_POST['motivo']);
		$user = $_POST['id_user'];

		$today = date("d-m-Y"); 

		$query = mysqli_query($db, "INSERT INTO `const_cancela_solicitacao`(`id_solicitacao`, `id_usuario`, `data`, `motivo`) VALUES ($id_solicitacao, $user, '$today', '$motivo')")or die(mysqli_error($db));

		$query = mysqli_query($db, "UPDATE `const_solicitacao_material` SET `id_oc`= 0  WHERE `id` = $id_solicitacao")or die(mysqli_error($db));

		echo json_encode(1);

	}else if(isset($_POST['id_no_criado']) && isset($_POST['id_orc_ins']) && isset($_POST['id_insumo'])){ //Realizo a inserção do insumo nao orcado na tabela tabela_orcamento

		// echo "aqui";
		$num_seq = $_POST['id_no_criado'];
		$id_orc = $_POST['id_orc_ins'];
		$id_insumo = $_POST['id_insumo'];

		$query = mysqli_query($db, "INSERT INTO `tabela_orcamento`(`id_tarefa`, `quantidade`, `unidade`, `valor_unitario`, `id_orcamento`, `id_insumo_plano`, `tabela`, `status`) VALUES ('$num_seq', '0', '', '0.00' , $id_orc , $id_insumo, 2, 0)")or die(mysqli_error($db));
	}else if(isset($_POST['id_orcamento_despacho'])){ // Gravo o despacho do material na tabela de entrada do deposito  == const_deposito_entrada

		$orcamento = $_POST['id_orcamento_despacho'];
		$user = $_POST['id_user'];
		$linhas = $_POST['linhas'];
		$estoque = $_POST['estoque'];

		// var_dump($orcamento);
		// var_dump($user);
		// var_dump($linhas);
		// var_dump($estoque);

		$today = date("d-m-Y"); 
		$hora = date("H-i-s");


		foreach ($linhas as $key => $value) {
			$query = mysqli_query($db, "INSERT INTO `const_deposito_entrada`(`id_user`, `id_insumo`, `id_orcamento`, `id_estoque`, `qnt`, `valor_insumo`,`data`, `hora`) VALUES ($user, $value[0],	$orcamento, $estoque, '$value[1]', '0.00' , '$today', '$hora')")or die(mysqli_error($db));
		}

		echo json_encode(1);

	}else if(isset($_POST['id_insumo']) && isset($_POST['id_deposito'])){  //Rotina para fazer a consulta da quantidade disponivel no estoque de acordo com o Insumo e o estoque escolhido
		$insumo = $_POST['id_insumo'];
		$deposito = $_POST['id_deposito'];

		$query = mysqli_query($db, "SELECT * FROM `const_deposito_entrada` WHERE `id_estoque` = $deposito AND id_insumo = $insumo  ORDER BY id DESC " )or die(mysqli_error($db));
		if(mysqli_num_rows($query) > 0){

			$total_mestre = 0;


			while ($assoc = mysqli_fetch_assoc($query)) {

				$total_restante = 0;
				$entrada[] = $assoc;

				$query_saida = mysqli_query($db, "SELECT * FROM `const_deposito_saida` WHERE `id_entrada` = ".$assoc['id']." ")or die(mysqli_error($db));
				if(mysqli_num_rows($query_saida) > 0){
					while ($assoc_saida = mysqli_fetch_assoc($query_saida)) {

						$saida[] = $assoc_saida;

						$total_restante += $assoc_saida['qnt'];
					}
				}

				$query_extravio = mysqli_query($db, "SELECT * FROM `const_deposito_extravio` WHERE `id_entrada` = ".$assoc['id']." ")or die(mysqli_error($db));
				if(mysqli_num_rows($query_extravio) > 0){
					while ($assoc_extravio = mysqli_fetch_assoc($query_extravio)) {

						$extravio[] = $assoc_extravio;

						$total_restante += $assoc_extravio['qnt'];
					}
				}

				if((($assoc['qnt'] - $total_restante) > 0)){

					$total_mestre += ($assoc['qnt'] - $total_restante);

				}

			}
			
			echo json_encode($total_mestre);
 		}else{
			echo json_encode(0);
		}
	}else if(isset($_POST['lista_oc_emitidas'])){  // Rotina para buscar a partir do id_solicitacao as ordens de compra ja emitida para essa solicitacao

		$id_solicitacao = $_POST['lista_oc_emitidas'];

		$query = mysqli_query($db, "SELECT * FROM `const_solicitacao_oc` WHERE `id_solicitacao` = ".$id_solicitacao."")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {

				$query_oc = mysqli_query($db, "SELECT * FROM `const_ordem_compra` WHERE `id`= ".$assoc['id_oc']."")or die(mysqli_error($db));

				$assoc_oc['foto_recibo'] = '';
				if(mysqli_num_rows($query_oc) > 0){

					$assoc_oc = mysqli_fetch_assoc($query_oc);

					// var_dump($assoc_oc['id']);
					$query_recebimento = mysqli_query($db, "SELECT `id` FROM `const_recebimento_material` WHERE `id_oc` = ".$assoc_oc['id']."")or die(mysqli_num_rows($db));

					$assoc_recebimento = mysqli_fetch_assoc($query_recebimento);
					if(isset($assoc_recebimento)){
						$assoc_oc['foto_recibo'] = $assoc_recebimento['id'];
					}else{
						$assoc_oc['foto_recibo']= '';
					}
					

					$assoc_oc['nome_fornecedor'] = busca_nome_fornecedor($assoc_oc['id_fornecedor']);

					$dados[] = $assoc_oc;
				}

			}
			
			echo json_encode($dados);
		}else{
			echo json_encode(0);
		}
	}else if(isset($_POST['recebe_oc'])){ //rotina para listar os itens da OC para recebimento da OC

		$id_oc = $_POST['recebe_oc'];

		$query = mysqli_query($db, "SELECT * FROM `const_insumo_oc` WHERE `id_oc` = $id_oc")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){

			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {
				
				$assoc['nome_insumo'] = busca_nome_insumo($assoc['id_insumo']);

				$dados[] = $assoc;

			}

			echo json_encode($dados);

		}else{
			echo json_encode(0);
		}
	}else if(isset($_POST['valida_recebimento'])){ //Rotina para fazer o cadastro do recebimento da OC e registro dos materiais recebidos

		$id_user = $_POST['id_user'];
		$id_oc = $_POST['id_oc'];
		$numero_doc = addslashes($_POST['num_recibo']);
		$tipo_doc = addslashes($_POST['tipo_recibo']);
		$dados = $_POST['dados'];

		$today = date("d-m-Y"); 
		$hora = date("H-i-s");


		//Rotina para inserir o recebimento do material
		$query = mysqli_query($db, "INSERT INTO `const_recebimento_material`(`id_user`, `id_oc`, `numero_doc`, `descricao_doc`, `path_doc`, `recebimento_completo`, `data`, `hora`) VALUES ($id_user, $id_oc, '$numero_doc', '$tipo_doc', '' , 0, '$today', '$hora')")or die(mysqli_error($db));

		$id_recebimento = mysqli_insert_id($db);

		//Rotina para registar os itens recebidos
		foreach ($dados as $key => $value) {
			
			$query = mysqli_query($db, "SELECT `qnt` FROM `const_insumo_oc` WHERE `id_oc` = $id_oc AND `id_insumo` = ".$value[0]." ")or die(mysqli_error($db));

			if(mysqli_num_rows($query) > 0){

				$assoc = mysqli_fetch_assoc($query);

				$assoc['qnt'] == $value[1] ? $completo = 1 : $completo = 0; 

			}else{
				$completo = 0;
			}

			$query_insert = mysqli_query($db, "INSERT INTO `const_recebimento_insumo`(`id_insumo`, `id_recebimento`, `status_completo`, `qnt`) VALUES (".$value[0].", $id_recebimento,$completo, '".$value[1]."')")or die(mysqli_error($db));
		}


		//Rotina para verificar so o recebimento como todo esta completo e atualiza o recebimento
		$query = mysqli_query($db, "SELECT * FROM `const_recebimento_insumo` WHERE `id_recebimento` = $id_recebimento AND `status_completo` = 0 ")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$query = mysqli_query($db, "UPDATE `const_recebimento_material` SET `recebimento_completo`= 0 WHERE `id` = $id_recebimento ")or die(mysqli_error($db));
		}else{
			$query = mysqli_query($db, "UPDATE `const_recebimento_material` SET `recebimento_completo`= 1 WHERE `id` = $id_recebimento ")or die(mysqli_error($db));
		}


		echo json_encode($id_recebimento);

		// var_dump($id_user);
		// var_dump($id_oc);
		// var_dump($numero_doc);
		// var_dump($tipo_doc);
		// var_dump($dados);
	}else if(isset($_FILES['image'])){ //Faço o upload da imagen e gravo o path dela no recebimento de material
		// require_once("Image.php");

		//var_dump($_FILES);

		//Verifico se a imagen ja esta no chache do servidor
		if($_FILES['image']['tmp_name'] != ''){
			$id_recebimento = $_POST['id_recebimento'];

			$form_field = "image";
			$upload_path = "comprovante_recebimento/";

			//assume uploading a jpeg image file, this can be determined by file type while uploading and here we do not care about the image since it's not a big deal here.
			$image_name = uniqid().".jpg";

			//Create an object of <strong>'Image'</strong> class and call to <strong>'upload_image'</strong> function which we are going to use here for our process.
			$imgObj = new Image();

			$dimensao = $imgObj->get_image_width_height('jpg', $_FILES['image']['tmp_name']);

			//var_dump($dimensao);
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
				//Atualizo o recebimento do material com o path da foto salva
				$query = mysqli_query($db, "UPDATE `const_recebimento_material` SET `path_doc`= 'comprovante_recebimento/$image_name' WHERE `id` = $id_recebimento ")or die(mysqli_error($db));
				echo json_encode(1);
			}
			else
			{
				echo json_encode(0);
			}
		}else{
			echo json_encode(2);
		}
	}else if(isset($_POST['id_recebimento'])){ // Busco o path da foto do recibo de acordo com o recebiment passado

		$id = $_POST['id_recebimento'];
		$query = mysqli_query($db, "SELECT * FROM `const_recebimento_material` WHERE `id` = $id ")or die(mysqli_error($db));

		if(mysqli_num_rows($query)){
			$assoc = mysqli_fetch_assoc($query); 
			if(!$assoc['path_doc'] == ''){  //verifica se a imagem existe

				$path = $assoc['path_doc'];
				echo json_encode($path);

			}else{

				$comprovante= [];
				array_push($comprovante, $assoc['descricao_doc'], $assoc['numero_doc']);
				echo json_encode($comprovante);
			}
			
			
		}else{
			echo json_encode(0);
		}
	}

	/* funcao para consultar o nome do orcamento
	if($_POST['id_orcamento']){

		$id = $_POST['id_orcamento'][0];

		$query = mysqli_query($db, "SELECT * FROM const_orcamento WHERE id = $id")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			echo json_encode($assoc['titulo']);
		}else{
			echo json_encode("0");
		}
	}
	*/
?>