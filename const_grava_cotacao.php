
<?php 
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	set_time_limit(0);

	include "protege_professor.php";
	ini_set("max_input_time", "60");
	ini_set("max_input_vars", "10000");
	ini_set("upload_max_filesize", "10M");
	ini_set("max_execution_time", "-1");
	ini_set("memory_limit", "-1");
	ini_set("realpath_cache_size", "-1");
?>
<?php
	
	include "conexao.php";
	date_default_timezone_set('America/Sao_Paulo');

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

	function busca_nome_insumo($id){
		include 'conexao.php';

		$query = mysqli_query($db, "SELECT `descricao` FROM `const_insumos` WHERE `id` = $id");

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			return addslashes($assoc['descricao']);
		}else{
			return false;
		}
	}

	function busca_codigo_insumo($id){
		include 'conexao.php';

		$query = mysqli_query($db, "SELECT `codigo` FROM `const_insumos` WHERE `id` = $id");

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			return addslashes($assoc['codigo']);
		}else{
			return false;
		}
	}

	function monta_ordem_compra($id_oc){
		include "conexao.php";



		$query = mysqli_query($db, "SELECT * FROM `const_ordem_compra` WHERE id = $id_oc")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			require_once __DIR__ . '/vendor/autoload.php';

			$mpdf = new \mPDF();
			

			$assoc = mysqli_fetch_assoc($query);

			$numero_oc = utf8_encode($assoc['id']);
			$data_oc = utf8_encode($assoc['data']);
			$data_entrega = utf8_encode($assoc['data_entrega']);
			$local_entrega = utf8_decode($assoc['local_entrega']);
			$desconto = utf8_encode($assoc['desconto']);

			$id_fornecedor = $assoc['id_fornecedor'];
			$query = mysqli_query($db, "SELECT * FROM `cliente` WHERE idcliente = $id_fornecedor")or die(mysqli_error($db));

			$assoc = mysqli_fetch_assoc($query);

			$nome = $assoc['nome_cli'];
			$endereco = utf8_encode($assoc['endereco_cli'].' , '.$assoc['numero_cli']);
			$cidade = utf8_encode($assoc['cidade_cli']);
			$cnpj = utf8_encode($assoc['cpf_cli']);
			$telefone = utf8_encode($assoc['telefone1_cli']);
			$cep = utf8_encode($assoc['cep_cli']);
			$foto = utf8_encode($assoc['path_foto ']);

			$html = "<table style='width:100% !important' height='391' border='0' align='center'>
			<tbody>
			<tr>
			<td colspan='5' style='text-align: center; font-weight: BOLD; width:20% !important'>
			<img src='img/icon_pwa.png' style='width:100px!important;'></td>
			<td colspan='2' style='text-align: left; font-weight: BOLD; width=60% !important'><strong>Emissor:</strong><br>
			AC Torres Empreendimentos Imobiliarios Ltda <br>
			CNPJ: 17.552.478/0001-27 <br>
			Endereço: R Estevao Leao Bourroul, 1922, Sala 03 <br>
			Centro, Franca, SP, 14400-750</td>
			<td style='text-align: center; font-weight: BOLD; width:20% !important'>ORDEM DE COMPRA Nº $numero_oc
			<br>
			<strong> Emissão: </strong> <br> $data_oc
			</td>
			</tr>

			<tr>
			<td colspan='5'>&nbsp;</td>
			<td colspan='3'>&nbsp;</td>
			</tr>
			</tbody>
			</table>



			<table style='width:100% !important' height='391' border='1' align='center'>
			<tr>
			<td colspan='6'><span style='font-weight: bold'>Fornecedor</span><br>
			$nome<br>
			<strong>Endereço:</strong><br>
			$endereco , $numero_loc <br>
			<strong>Cidade:</strong>
			$cidade </td>
			<td colspan='2'><span style='font-weight: bold'>CNPJ:</span><br>
			$cnpj<br>
			<strong>Telefone:</strong>
			$telefone <br>
			<strong>CEP:</strong>
			$cep <br>
			</p></td>
			</tr>

			<tr>
			<td colspan='3'><span style='font-weight: bold'>Data da Entrega:</span><br>
			$data_entrega</td>
			<td colspan='5'><span style='font-weight: bold'>Local da Entrega:</span><br>
			$local_entrega</td>
			</tr>
			</table>

			<table style='width:100% !important' height='391' border='0' align='center'>
			<tr>
			<td height='23' colspan='8' style='text-align: center; font-weight: bold;'>Autorizamos o fornecimento dos materiais abaixo <br> discriminados mediante condições constantes desta ORDEM DE COMPRA.</td>
			</tr>
			</table>


			<table style='width:100% !important' height='391' border='1' align='center'>
			<tr>
			<td colspan='3'  style='text-align: center'><strong>PRODUTO</strong></td>

			<td colspan='2' style='text-align: center'><strong>UN</strong></td>
			<td style='text-align: center'><strong>QTD</strong></td>
			<td style='text-align: center'><strong>VALOR UNITÁRIO</strong></td>
			<td style='text-align: center'><strong>VALOR TOTAL</strong></td>
			</tr>
			";


			$query = mysqli_query($db, "SELECT DISTINCT CIOC.id, CIOC.valor_unidade, CIOC.qnt, CI.descricao, TORC.unidade FROM const_insumo_oc AS CIOC INNER JOIN tabela_orcamento AS TORC ON CIOC.id_insumo = TORC.id_insumo_plano INNER JOIN const_insumos AS CI ON CIOC.id_insumo = CI.id WHERE CIOC.id_oc = $id_oc AND TORC.tabela= 2")or die(mysqli_error($db));


			$total = 0;

			if(mysqli_num_rows($query) > 0){

				while ($assoc = mysqli_fetch_assoc($query)) {
					
					$total += ($assoc['valor_unidade'] * $assoc['qnt']);

					$valor_insumo = 'R$ '.number_format($assoc['valor_unidade'], 2, ',', '.'); 
					$valor_total = 'R$ '.number_format(($assoc['valor_unidade'] * $assoc['qnt']), 2, ',', '.');

					$html .="<tr>
					  <td style='text-align: center' colspan='3'>".$assoc['descricao']."</td>
					  <td style='text-align: center' colspan='2'>".utf8_encode($assoc['unidade'])."</td>
					  <td style='text-align: center'>".utf8_encode($assoc['qnt'])."</td>
					  <td style='text-align: center'>".utf8_encode($valor_insumo)."</td>
					  <td style='text-align: center'>".utf8_encode($valor_total)."</td>
					</tr>
					";
				}
			}

			$desconto = str_replace(' ', '', $desconto);

			$total = ($total - ($desconto));

			//var_dump(($desconto));

			$total = 'R$ '.number_format($total, 2, ',', '.');
			$desconto =  'R$ '.number_format(($desconto), 2, ',', '.');

			$html .="<tr>
			     <td style='text-align: center' colspan='3'></td>
			     <td style='text-align: center' colspan='2'></td>
			     <td style='text-align: center'></td>
			     <td style='text-align: center'></td>
			     <td style='text-align: center'></td>
			   </tr>

			   <tr>
   			      <td style='text-align: center' colspan='8'>DESCONTO: $desconto</td>
   			   
   			    </tr>
			   ";

			$html .="<tr>
			     <td style='text-align: center' colspan='3'></td>
			     <td style='text-align: center' colspan='2'></td>
			     <td style='text-align: center'></td>
			     <td style='text-align: center'></td>
			     <td style='text-align: center'></td>
			   </tr>

			   <tr>
   			      <td style='text-align: center' colspan='8'>TOTAL: $total</td>
   			   
   			    </tr>
   			    </tbody>
   			    </table>
			   ";

			// $html =  utf8_encode($html);
			//die();

			// echo mb_detect_encoding($html);
			// die();

			$mpdf->WriteHTML($html);
			$mpdf->Output('pdf/ordem_compra.pdf', 'F');
			

		}
	}

	function calc_total_oc($id_oc){
		include "conexao.php";

		$query = mysqli_query($db, "SELECT * FROM `const_ordem_compra` WHERE `id`= $id_oc")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			$desconto = $assoc['desconto'];
		}

		$query = mysqli_query($db, "SELECT * FROM `const_insumo_oc` WHERE id_oc = $id_oc")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){

			$total = 0;

			while ($assoc = mysqli_fetch_assoc($query)) {
				$total += (floatval($assoc['valor_unidade']) * floatval($assoc['qnt']));
			}

			$total -= $desconto;

			return $total;
		}else{
			return false;
		}
	}

	function monta_oc_emitida($id_cotacao){
		include "conexao.php";

		$query = mysqli_query($db, "SELECT * FROM `const_ordem_compra` WHERE id_cotacao = $id_cotacao ORDER BY id DESC ")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){

			$dados = [];
			$linha;

			while ($assoc = mysqli_fetch_assoc($query)) {
				$linha = null;

				$linha['id'] = $assoc['id'];
				$linha['data'] = $assoc['data'];
				$linha['total'] = calc_total_oc($linha['id']);
				$linha['status'] = $assoc['status'];
				$linha['id_fornecedor'] = $assoc['id_fornecedor'];
				$linha['desconto'] = $assoc['desconto'];

				$dados[] = $linha;

			}

			echo json_encode($dados);
		}else{
			echo json_encode('0');
		}
	}

	//var_dump($_POST);

	//adicionado os insumos selecionados de acordo com a especie
	//pertencentes ao orçamento selecionado na tabela de cotacao
	if(isset($_POST['id_orc']) && isset($_POST['id_especie'])){

		$id_orc = $_POST['id_orc'];
		$id_especie = $_POST['id_especie'];

		/*Tabela de insumos == 2
		$query = mysqli_query($db, "SELECT orc.quantidade, orc.unidade, orc.valor_unitario, insumo.id, insumo.descricao, insumo.codigo FROM tabela_orcamento AS orc INNER JOIN const_insumos AS insumo ON orc.id_insumo_plano = insumo.id WHERE orc.id_orcamento = $id_orc AND orc.tabela = 2 AND insumo.id_especie = $id_especie")or die(mysqli_error($db));
		*/

		$query = mysqli_query($db, "SELECT ORC.quantidade, ORC.unidade, ORC.valor_unitario, INS.id, INS.descricao, INS.codigo FROM const_cotacao AS COT INNER JOIN tabela_orcamento AS ORC ON COT.id_orc = ORC.id_orcamento INNER JOIN const_insumos AS INS ON ORC.id_insumo_plano = INS.id WHERE ORC.tabela = 2 AND INS.id_especie = $id_especie AND COT.id = $id_orc ");

		if(mysqli_num_rows($query) > 0){

			$dados = [];

			while($assoc = mysqli_fetch_assoc($query)) {
				$insumo = null;

				$insumo['quantidade'] = $assoc['quantidade'];
				$insumo['unidade'] = $assoc['unidade'];
				$insumo['valor_unitario'] = $assoc['valor_unitario'];
				$insumo['descricao'] = $assoc['descricao'];
				$insumo['codigo'] = $assoc['codigo'];
				$insumo['id'] = $assoc['id'];

				$dados[] = $insumo;
			}

			echo json_encode($dados);
		}else{

			echo json_encode('0');
		}
	//Faço a inserção de todos os materiais
	}else if(isset($_POST['id_cot']) && isset($_POST['id_cat'])){

		$id_cot = $_POST['id_cot'];
		$id_cat = $_POST['id_cat'];
		
		//Tabela de insumos == 2
		$query = mysqli_query($db, "SELECT TORC.quantidade, TORC.unidade, TORC.valor_unitario, CI.id, CI.descricao, CI.codigo FROM tabela_orcamento AS TORC INNER JOIN const_insumos AS CI ON TORC.id_insumo_plano = CI.id INNER JOIN const_cotacao AS CC ON TORC.id_orcamento = CC.id_orc WHERE CC.id = $id_cot AND TORC.tabela = 2 AND CI.id_categoria = $id_cat")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){

			$dados = [];

			while($assoc = mysqli_fetch_assoc($query)) {
				$insumo = null;

				$insumo['quantidade'] = $assoc['quantidade'];
				$insumo['unidade'] = $assoc['unidade'];
				$insumo['valor_unitario'] = $assoc['valor_unitario'];
				$insumo['descricao'] = $assoc['descricao'];
				$insumo['codigo'] = $assoc['codigo'];
				$insumo['id'] = $assoc['id'];

				$dados[] = $insumo;
			}

			echo json_encode($dados);
		}else{

			echo json_encode('0');
		}
	//Exporto a Tebela mostrada na Tela em PDF	
	}else if(isset($_POST['pdf'])){
 		require_once __DIR__ . '/vendor/autoload.php';

		$mpdf = new \mPDF();
		$mpdf->WriteHTML($_POST['pdf']);
		$mpdf->Output('pdf/filename.pdf', 'F');
	//Retorno uma lista de Espécies a partir de uma categoria fornecida
	}else if(isset($_POST['categoria'])){

		$categoria = $_POST['categoria'];

		$query = mysqli_query($db, "SELECT * FROM `const_categoria` WHERE `categoria_pai` = $categoria")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {
				$dado = null;

				$dado['id'] = $assoc['id'];
				$dado['descricao'] = $assoc['descricao'];

				$dados[] = $dado;
			}

			echo json_encode($dados);
		}else{
			echo json_encode('0');
		}
	//Gravo uma nova Cotacao
	}else if(isset($_POST['orcamento']) && isset($_POST['titulo'])){

		//var_dump($_POST);
		$id_orc = $_POST['orcamento'];
		$titulo = utf8_decode($_POST['titulo']);

		$today = date("d-m-Y");     

		$query = mysqli_query($db, "INSERT INTO `const_cotacao`(`id_orc`, `titulo`, `data_cotacao`) VALUES ($id_orc, '$titulo' , '$today')") or die(mysqli_error($db));
		echo "1";
	//faço a inserção de fornecedores na tabela const_fornecedor_cotacao ######INUTILIZADO#######	
	}else if(isset($_POST['orc']) && isset($_POST['id_fornecedor'])){

		$orc = $_POST['orc'];
		$fornecedor = $_POST['id_fornecedor'];

		$query = mysqli_query($db, "INSERT INTO `const_fornecedor_cotacao`(`id_cotacao`, `id_fornecedor`) VALUES ( $orc, $fornecedor)")or die(mysql_error($db));

		echo "1";
	//faço a exclusão do fornecedor da cotação selecionada da tabela 'const_fornecedor_cotacao' ######INUTILIZADO#######
	}else if(isset($_POST['cotacao']) && isset($_POST['id_fornecedor'])){

		$orc = $_POST['cotacao'];
		$fornecedor = $_POST['id_fornecedor'];

		$query = mysqli_query($db, "DELETE FROM `const_fornecedor_cotacao` WHERE `id_cotacao` = $orc AND `id_fornecedor` = $fornecedor")or die(mysql_error($db));

		echo "1";
	//Salvos os itens cotados junto a data e a referida cotação
	}else if(isset($_POST['valida_ajax'])){

		if(isset($_POST['dados']) && isset($_POST['colunas']) && isset($_POST['forma_pgt']) && isset($_POST['desconto'])){

			//echo "entrei";

			$dados = $_POST['dados'];
			$colunas = $_POST['colunas'];

			$forma_pgt = $_POST['forma_pgt'];
			$desconto = $_POST['desconto'];

			$today = date("d-m-Y"); 
			$id_cotacao = $dados[0][4];

			$query = mysqli_query($db, "DELETE FROM `const_item_cotacao` WHERE `data` =  '$today' AND id_cotacao = $id_cotacao")or die(mysqli_error($db));
			$query = mysqli_query($db, "DELETE FROM `const_fornecedor_cotacao` WHERE `id_cotacao` = $id_cotacao")or die(mysqli_error($db));
			$query = mysqli_query($db, "DELETE FROM `const_desconto_cotacao` WHERE `id_cotacao`= $id_cotacao")or die(mysqli_error($db));
			$query = mysqli_query($db, "DELETE FROM `const_forma_pgt_cotacao` WHERE `id_cotacao` = $id_cotacao")or die(mysqli_error($db));

			//Insiro as linhas da cotação
			foreach ($dados as $key => $value) {
				//var_dump($value);

				$status = $value[5];
				$id_cotacao = $value[4];
				$id_insumo = $value[3];
				$id_fornecedor = $value[2];

				//$valor = explode('$', $value[1]);
				//$valor = str_replace(',', '.', $valor[1]);

				$valor = $value[1];
				$qnt = $value[0];

				$query = mysqli_query($db, "INSERT INTO `const_item_cotacao`(`id_cotacao`, `id_insumo`, `id_fornecedor`, `quantidade`, `valor`, `data`, `status`) VALUES ($id_cotacao,$id_insumo,$id_fornecedor,'$qnt','$valor','$today', $status)")or die(mysqli_error($db));
			}

			//Insiro as Colunas da cotação
			foreach ($colunas as $key => $value) {
				$query = mysqli_query($db, "INSERT INTO `const_fornecedor_cotacao`(`id_cotacao`, `id_fornecedor`) VALUES ($id_cotacao, $value)")or die(mysqli_error($db));
			}

			//Insiro as formas de pagamento da cotação
			foreach ($forma_pgt as $key => $value) {
				$query = mysqli_query($db, "INSERT INTO `const_forma_pgt_cotacao`(`id_cotacao`, `id_fornecedor`, `id_forma_pgt`) VALUES ($id_cotacao,$value[0],$value[1])")or die(mysqli_error($db));
			}

			//Insiro os descontos da cotação
			foreach ($desconto as $key => $value) {
				$query = mysqli_query($db, "INSERT INTO `const_desconto_cotacao`(`id_cotacao`, `id_fornecedor`, `desconto`) VALUES ($id_cotacao,$value[0],'$value[1]')")or die(mysqli_error($db));
			}

			echo json_encode(1);

		}else{

			echo json_encode(0);

		}
	//Função para montar a tabela de cotação de acordo com a cotação selecionada
	}else if(isset($_POST['att_cotacao'])){

		$cotacao = $_POST['att_cotacao'];
		$linha;
		$dados = [];		

		//Pego a última data de atualização da tabela
		$query =  mysqli_query($db, "SELECT STR_TO_DATE(data, '%d-%m-%Y') AS data_cot FROM `const_item_cotacao` WHERE `id_cotacao` = $cotacao ORDER BY data_cot DESC LIMIT 1")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){

			$data_preocurada = mysqli_fetch_assoc($query);


			$data_preocurada = date("d-m-Y", strtotime($data_preocurada['data_cot']));

			$query = mysqli_query($db, "SELECT * FROM `const_fornecedor_cotacao` WHERE `id_cotacao` = $cotacao")or die(mysqli_error($db));

			$dado['table_header'] = [];
			if(mysqli_num_rows($query) > 0){

				while ($assoc = mysqli_fetch_assoc($query)) {

					$linha['id_fornecedor'] = $assoc['id_fornecedor'];
					$linha['nome_fornecedor'] = busca_nome_fornecedor($assoc['id_fornecedor']);

					$dado['table_header'][] = $linha;
				}
			}

			$dados[] = $dado;
			$linha = null;
			$ultima_oc = null;

			// var_dump($data_preocurada);

			//Seleciono todos os itens que nao foram orçados
			$query = mysqli_query($db, "SELECT DISTINCT CIC.id, CIC.id_cotacao, CIC.id_insumo, CIC.id_fornecedor, CIC.quantidade AS qnt_cotado, CIC.valor, CIC.status, INS.descricao, INS.codigo FROM const_item_cotacao AS CIC INNER JOIN const_cotacao AS CC ON CIC.id_cotacao = CC.id INNER JOIN const_orcamento AS CO ON CC.id_orc = CO.id INNER JOIN const_insumos AS INS ON INS.id = CIC.id_insumo WHERE CC.id = $cotacao AND CIC.data = '$data_preocurada' AND CIC.status = 0 ORDER BY CIC.id ASC")or die(mysqli_error($db));

			if(mysqli_num_rows($query) > 0){
				while ($assoc = mysqli_fetch_assoc($query)) {

					$linha = null;

					$linha['status'] = $assoc['status'];
					$linha['id'] = $assoc['id'];
					$linha['id_insumo'] = $assoc['id_insumo'];
					$linha['id_fornecedor'] = $assoc['id_fornecedor'];
					$linha['qnt_cotado'] = $assoc['qnt_cotado'];
					$linha['valor'] = $assoc['valor'];
					$linha['qnt_orcado'] = '0';
					$linha['unidade'] = '';
					$linha['valor_unitario'] = '0';
					$linha['descricao'] = $assoc['descricao'];
					$linha['codigo'] = $assoc['codigo'];

					$query_aux = mysqli_query($db, "SELECT STR_TO_DATE(data, '%d-%m-%Y') AS data_oc, CIOC.valor_unidade, COC.id FROM const_insumo_oc AS CIOC INNER JOIN const_ordem_compra AS COC ON CIOC.id_oc = COC.id WHERE COC.id_fornecedor = ".$linha['id_fornecedor']." AND CIOC.id_insumo = ".$linha['id_insumo']."  ORDER BY `data_oc` DESC LIMIT 1")or die(mysqli_error($db));


					$assoc_aux = mysqli_fetch_assoc($query_aux);

					$ultima_oc['id_oc'] = $assoc_aux['id'];
					$ultima_oc['valor_unidade'] = $assoc_aux['valor_unidade'];
					$ultima_oc['data'] = $assoc_aux['data_oc'];

					$linha['ultima_oc'] = $ultima_oc;

					$dados[] = $linha;
				}
			}


			//Seleciono todos os itens que foram orçados
			$query = mysqli_query($db, "SELECT DISTINCT CIC.id, CIC.id_cotacao, CIC.id_insumo, CIC.id_fornecedor, CIC.quantidade AS qnt_cotado, CIC.valor, CIC.status, TORC.quantidade AS qnt_orcado, TORC.unidade, TORC.valor_unitario, INS.descricao, INS.codigo FROM const_item_cotacao AS CIC INNER JOIN const_cotacao AS CC ON CIC.id_cotacao = CC.id INNER JOIN const_orcamento AS CO ON CC.id_orc = CO.id INNER JOIN const_insumos AS INS ON INS.id = CIC.id_insumo INNER JOIN tabela_orcamento AS TORC ON TORC.id_insumo_plano = INS.id WHERE CC.id = $cotacao AND CIC.data = '$data_preocurada'AND TORC.tabela = 2 ORDER BY CIC.id ASC")or die(mysqli_error($db));

			if(mysqli_num_rows($query) > 0){
				while ($assoc = mysqli_fetch_assoc($query)) {

					$linha = null;

					$linha['status'] = $assoc['status'];
					$linha['id'] = $assoc['id'];
					$linha['id_insumo'] = $assoc['id_insumo'];
					$linha['id_fornecedor'] = $assoc['id_fornecedor'];
					$linha['qnt_cotado'] = $assoc['qnt_cotado'];
					$linha['valor'] = $assoc['valor'];
					$linha['qnt_orcado'] = $assoc['qnt_orcado'];
					$linha['unidade'] = $assoc['unidade'];
					$linha['valor_unitario'] = preg_replace('/[^0-9.,]/u', "",utf8_encode($assoc['valor_unitario']));
					// $linha['valor_unitario'] = $assoc['valor_unitario'];
					$linha['descricao'] = $assoc['descricao'];
					$linha['codigo'] = $assoc['codigo'];

					// var_dump($linha);
					// die();
					//query nao bate com parametros
					$query_aux = mysqli_query($db, "SELECT STR_TO_DATE(data, '%d-%m-%Y') AS data_oc, CIOC.valor_unidade, COC.id FROM const_insumo_oc AS CIOC INNER JOIN const_ordem_compra AS COC ON CIOC.id_oc = COC.id WHERE COC.status = 1 AND COC.id_fornecedor = ".$linha['id_fornecedor']." AND CIOC.id_insumo = ".$linha['id_insumo']."  ORDER BY `data_oc` DESC LIMIT 1")or die(mysqli_error($db));



					$assoc_aux = mysqli_fetch_assoc($query_aux);

					$ultima_oc['id_oc'] = $assoc_aux['id'];
					$ultima_oc['valor_unidade'] = $assoc_aux['valor_unidade'];
					$ultima_oc['data'] = $assoc_aux['data_oc'];

					$linha['ultima_oc'] = $ultima_oc;


					$dados[] = $linha;
				}
			}


			$dado = [];
			$dado['desconto'] = [];

			//Seleciono todos os itens da tabela conts_desconto_cotacao
			$query = mysqli_query($db, "SELECT * FROM `const_desconto_cotacao` WHERE `id_cotacao` = $cotacao")or die(mysqli_error($db));

			if(mysqli_num_rows($query) > 0){
				while ($assoc = mysqli_fetch_assoc($query)) {
					$linha = null;

					$linha['id_fornecedor'] = $assoc['id_fornecedor'];
					$linha['desconto'] = $assoc['desconto'];

					$dado['desconto'][] = $linha;
					$linha = [];
				}

				$dados[] = $dado;
			}

			$dado = [];
			$dado['forma_pgt'] = [];
			//Seleciono todos os itens da tabela const_forma_pgt_cotacao
			$query = mysqli_query($db, "SELECT * FROM `const_forma_pgt_cotacao` WHERE `id_cotacao` = $cotacao")or die(mysqli_error($db));

			if(mysqli_num_rows($query) > 0){
				while ($assoc = mysqli_fetch_assoc($query)) {

					$linha = null;

					$linha['id_fornecedor'] = $assoc['id_fornecedor'];
					$linha['id_forma_pgt'] = $assoc['id_forma_pgt'];

					$dado['forma_pgt'][] = $linha;
					$linha = [];
				}

				$dados[] = $dado;


			}

			// $data = utf8_encode($dados);

			// print_r($dados);
			// die();
			// retornando null
			echo json_encode($dados);

		}else{
			echo json_encode(1);
		}
	//Exporto a Tabela para o Excel para preenchimento de Preços
	}else if(isset($_POST['excel'])){
		
		require('spreadsheet-reader-master/PHPExcel.php');
		require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');

		$today = date("d-m-Y");
		$dados = $_POST['excel'];
		//$tabela = new PHPExcel();
		$colunas = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q","R"];


		// Read the file
		$objReader = PHPExcel_IOFactory::createReaderForFile('planilhas_mod/cotacao.xlsx');
		$objPHPExcel = $objReader->load('planilhas_mod/cotacao.xlsx');

		// Change the file
		$objPHPExcel->setActiveSheetIndex(0);
		           
		$tabela = $objPHPExcel;

		/*Mesclo as Células do cabeçalho
		$tabela->getActiveSheet(0)->mergeCells('A1:D1');
		$tabela->setActiveSheetIndex(0)->setCellValue("A1", "PLANILHA DE COTAÇÃO ".$today);
		$tabela->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(14);
		$tabela->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		//Defino padrões do documento
		$tabela->getDefaultStyle()->getFont()->setName('Arial');
		$tabela->getDefaultStyle()->getFont()->setSize(10); 

		//$tabela->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$tabela->getActiveSheet()->getColumnDimension('A')->setWidth(50);
		$tabela->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$tabela->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$tabela->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

		$tabela->setActiveSheetIndex(0)->getStyle('A2')->getFont()->setSize(14);
		$tabela->setActiveSheetIndex(0)->getStyle('B2')->getFont()->setSize(14);
		$tabela->setActiveSheetIndex(0)->getStyle('C2')->getFont()->setSize(14);
		$tabela->setActiveSheetIndex(0)->getStyle('D2')->getFont()->setSize(14);

		$tabela->setActiveSheetIndex(0)->setCellValue("A2", "Descricao do Insumo");
		$tabela->setActiveSheetIndex(0)->setCellValue("B2", "Quantidade Cotada");
		$tabela->setActiveSheetIndex(0)->setCellValue("C2", "Valor unitario");
		$tabela->setActiveSheetIndex(0)->setCellValue("D2", "Valor Total");
		*/

		$linha = 3;

		foreach ($dados as $key => $value) {
			$tabela->getActiveSheet()->getStyle("A".$linha)->getAlignment()->setWrapText(true);
			$tabela->setActiveSheetIndex(0)->setCellValue("A".$linha, $value[0]);
			//$tabela->setActiveSheetIndex(0)->setCellValue("B".$linha, $value[1]);
			$linha++;
		}

		$file = $objWriter = PHPExcel_IOFactory::createWriter($tabela, 'Excel2007');
		$file->save("pdf/cotacao.xlsx");
	//Fução para excluir um item já cotado da cotacao selecionada
	}else if(isset($_POST['insumo']) && isset($_POST['cotacao'])){
		$insumo = $_POST['insumo'];
		$cotacao = $_POST['cotacao'];

		//Pego a última data de atualização da tabela
		$query =  mysqli_query($db, "SELECT STR_TO_DATE(data, '%d-%m-%Y') AS data_cot FROM `const_item_cotacao` WHERE `id_cotacao` = $cotacao ORDER BY data_cot DESC LIMIT 1")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$data_preocurada = mysqli_fetch_assoc($query);
			$data_preocurada = date("d-m-Y", strtotime($data_preocurada['data_cot']));

			$query = mysqli_query($db, "DELETE FROM `const_item_cotacao` WHERE `id_cotacao` = $cotacao AND `id_insumo`= $insumo AND `data` = '$data_preocurada'")or die(mysqli_error($db));

			echo json_encode('1');
		}else{
			echo json_encode('0');
		}
	//Insiro um novo Insumo ta tabela de Cotação, mas antes faço a verificação se ele já foi cotado
	}else if(isset($_POST['id_insumo_adicionar']) && isset($_POST['cotacao'])){
		$insumo = $_POST['id_insumo_adicionar'];
		$cotacao = $_POST['cotacao'];

		$query = mysqli_query($db, "SELECT TORC.quantidade, TORC.unidade, TORC.valor_unitario, CI.id, CI.descricao, CI.codigo FROM const_cotacao AS CC INNER JOIN tabela_orcamento AS TORC ON CC.id_orc = TORC.id_orcamento INNER JOIN const_insumos AS CI ON TORC.id_insumo_plano = CI.id WHERE TORC.tabela = 2 AND TORC.id_insumo_plano = $insumo AND CC.id = $cotacao")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$dados = [];

			while($assoc = mysqli_fetch_assoc($query)) {
				$insumo = null;

				$insumo['valida'] = '1';
				$insumo['quantidade'] = $assoc['quantidade'];
				$insumo['unidade'] = $assoc['unidade'];
				$insumo['valor_unitario'] = $assoc['valor_unitario'];
				$insumo['descricao'] = $assoc['descricao'];
				$insumo['codigo'] = $assoc['codigo'];
				$insumo['id'] = $assoc['id'];

				$dados[] = $insumo;
			}

			echo json_encode($dados);
		}else{
			$query = mysqli_query($db, "SELECT * FROM const_insumos WHERE id = $insumo");

			if(mysqli_num_rows($query) > 0){
				while($assoc = mysqli_fetch_assoc($query)) {
					$insumo = null;

					$insumo['valida'] = '0';
					$insumo['quantidade'] = '0';
					$insumo['unidade'] = '0';
					$insumo['valor_unitario'] = '0';
					$insumo['descricao'] = $assoc['descricao'];
					$insumo['codigo'] = $assoc['codigo'];
					$insumo['id'] = $assoc['id'];

					$dados[] = $insumo;
				}
				echo json_encode($dados);
			}else{

				echo json_encode('0');
			}
		}
	//Atualizo a lista de fornecedores de acordo com a cotacao selecioniada
	}else if(isset($_POST['id_cotacao'])){



		$cotacao = $_POST['id_cotacao'];
		$dados = [];

		$query = mysqli_query($db, "SELECT cliente.nome_cli, cliente.idcliente FROM const_fornecedor_cotacao AS CFC INNER JOIN cliente ON CFC.id_fornecedor = cliente.idcliente WHERE CFC.id_cotacao = $cotacao")or die(mysqli_error($db));

		//query nao esta retornando um resultado
		//acredito que por nao ter fornecedor salvo

		if(mysqli_num_rows($query) > 0){
			while ($assoc = mysqli_fetch_assoc($query)) {
				$linha['nome'] = utf8_encode($assoc['nome_cli']);
				$linha['id'] = $assoc['idcliente'];

				$dados[] = $linha;

				$linha = null;
			}

			// var_dump($dados); OK
			echo json_encode($dados);
		}else{
			echo json_encode('0');
		}
	//Atualizo a lista de Cotação de acordo com o Orcamento selecionado
	}else if(isset($_POST['orc_cotacao'])){

		$cotacao = $_POST['orc_cotacao'];

		$query = mysqli_query($db, "SELECT CC.titulo, CC.id FROM const_cotacao AS CC INNER JOIN const_orcamento AS CO ON CC.id_orc = CO.id WHERE CC.id_orc = $cotacao ")or die(mysqli_error($db));	

		$dados = [];
		$dado;

		if(mysqli_num_rows($query) > 0){
			while ($assoc = mysqli_fetch_assoc($query)) {
				$dado = null;

				$dado['id'] = $assoc['id'];
				$dado['titulo'] = $assoc['titulo'];

				$dados[] = $dado; 			
			}

			echo json_encode($dados);
		}else{
			echo json_encode('0');
		}
	//Grava a ordem de compra no banco e o pdf de acordo com as informações passadas
	}else if(isset($_POST['dados']) && isset($_POST['dados_all'])){

		$dados = $_POST['dados'];
		$user = $_POST['dados_all'][0];
		$fornecedor = $_POST['dados_all'][1];
		$cotacao = $_POST['dados_all'][2];
		$data_entrega = $_POST['dados_all'][3];
		$local_entrega = utf8_decode($_POST['dados_all'][4]);
		$desconto = $_POST['dados_all'][5];
		$forma_pgt = $_POST['dados_all'][6];
		$today = date("d-m-Y");  
		


		//Busco o id da solicitação para fazer a atualizacao OC/solicitacao
		$query = mysqli_query($db, "SELECT `id_solicitacao` FROM `const_cotacao` WHERE `id` = $cotacao ")or die(mysqli_error($db));
		$assoc = mysqli_fetch_assoc($query);

		$id_solicitacao = $assoc['id_solicitacao'];


		//Do um update na solicitacao atualizando o 'id_oc' para 1 == efetuado
		$query = mysqli_query($db, "UPDATE `const_solicitacao_material` SET `id_oc`= 1 WHERE `id` = $id_solicitacao")or die(mysqli_error($db));

		// ate aq ok
		//Pegar o id do empreendimento
		$query = mysqli_query($db, "SELECT EC.idempreendimento_cadastro, CSE.id_mestre_obra FROM empreendimento_cadastro AS EC INNER JOIN const_sub_empreendimento AS CSE ON EC.idempreendimento_cadastro = CSE.id_empreendimento INNER JOIN const_orcamento AS CO ON CSE.id = CO.id_empreendimento INNER JOIN const_cotacao AS CC ON CO.id = CC.id_orc WHERE CC.id = $cotacao")or die(mysqli_error($db));


		// query retorna vazia 
		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			include "envia_notificacao.php";

			//Acho que nao vou utilizar esse campo pois sera possivel comprar para mais de uma obra em uma mesma ordem de compra
			$id_empreendimento = $assoc['idempreendimento_cadastro'];
			$id_mestre_obre = $assoc['id_mestre_obra'];

			$dados_aux = [];

			//Rotina para disparar uma notificação
			$dado['id_user'] = $id_mestre_obra;
			$dado['titulo'] = 'Ordem de Compra Emitida!';
			$dado['msg'] = 'Uma Nova Ordem de Compra foi Gerada';
			$dado['icon'] = 'https://immobilebusiness.com.br/home/assets/img/icons/site/favicon.png';
			$dado['link_red'] =  $_SERVER['HTTP_HOST'].'/const_solicitacao_material.php';

			$dados_aux[] = $dado;
			envia_notificacao($dados_aux);

			$query = mysqli_query($db, "INSERT INTO `const_ordem_compra`(`id_user`, `id_fornecedor`, `data_entrega`, `id_cotacao`, `data`, `status`, `local_entrega`, `desconto`,`fornecedor_deposito`, `forma_pgt`) VALUES ($user,$fornecedor,'$data_entrega',$cotacao,'$today', 1, '$local_entrega', '$desconto', 1, '$forma_pgt')")or die(mysqli_error($db));

			$id_ordem_compra = mysqli_insert_id($db);

			foreach ($dados as $key => $value) {
				$query = mysqli_query($db, "INSERT INTO `const_insumo_oc`(`id_insumo`, `id_oc`, `valor_unidade`, `qnt`) VALUES ($value[0],$id_ordem_compra,'$value[2]', '$value[1]')")or die(mysqli_error($db));
			}


			//Insiro um novo registro na tabela 'const_solicitacao_oc'
			$query = mysqli_query($db, "INSERT INTO `const_solicitacao_oc`(`id_oc`, `id_solicitacao`, `id_cotacao`) VALUES ($id_ordem_compra, $id_solicitacao, $cotacao)")or die(mysqli_error($db));


			//Rotina para gravar um novo registro na tabela contrato_pagar	

			//Primeiro eu pego O valor total da OC a forma de pagamento A data de Entrega E o Desconto
			$query = mysqli_query($db, "SELECT SUM(CIOC.valor_unidade * CIOC.qnt) AS total, data_entrega, COC.id_fornecedor, COC.desconto, FP.qnt_vezes, FP.prazo FROM const_ordem_compra AS COC INNER JOIN const_insumo_oc AS CIOC ON COC.id = CIOC.id_oc LEFT JOIN forma_pagamento AS FP ON COC.forma_pgt = FP.idforma_pagamento WHERE COC.id = $id_ordem_compra")or die(mysqli_error($db));

			$assoc = mysqli_fetch_assoc($query);

			//pego a qnt_vezes se nao tiver metodo de pagamento coloco apenas 1 vezes
			empty($assoc['qnt_vezes']) ? $qnt_vezes = 1 : $qnt_vezes = $assoc['qnt_vezes'];

			//Rotina para pegar o Valor da parcela
			$valor_parcela = (($assoc['total'] - $desconto) / $qnt_vezes);

			// DV Data de Vencimento 
			empty($assoc['prazo']) ? $DV = date('d-m-Y', strtotime($data_entrega)) : $DV = date('d-m-Y', strtotime("+".$assoc['prazo']." days",strtotime($today)));

			//Rotina para inserir contas a pagar
			$query = mysqli_query($db, "INSERT INTO `contrato_pagar`(`fornecedor_idfornecedor`, `data_vencimento`, `qtd_parcelas`, `valor_parcelas`, `data_lancamento`, `centrocusto_id`, `empreendimento_id`, `quadra_id`, `lote_id`, `tipo_venda`, `imovel_id`, `insumo_id`, `insumo_especie`, `insumo_familia`, `insumo_categoria`, `insumo_descricao`) VALUES ($fornecedor,'$DV','$qnt_vezes','".($assoc['total'] - $desconto)."','$today',0,$id_empreendimento,0,0,3,0,0,0,0,0,0)");

			$id_contas_apagar = mysqli_insert_id($db);

			//Rotina para inserir Parcelas
			for ($i = 0; $i < $qnt_vezes ; $i++) { 

				if($i != 0){
					$DV = date('d-m-Y', strtotime("+1 month",strtotime($DV)));
				}

				$query = mysqli_query($db, "INSERT INTO `parcelas`(`venda_idvenda`, `valor_parcelas`, `data_vencimento_parcela`, `situacao`, `descricao`, `remessa`, `data_remessa`, `tipo_venda`, `numero_sequencia`, `repasse_feito`, `data_recebimento`, `valor_recebido`, `desc_parcela`, `acre_parcela`, `forma_pagamento`, `fluxo`, `centrocusto_id`, `codigo_repasse`, `contacorrente_id`, `folhacheque_id`, `empreendimento_id_novo`, `cliente_id_novo`, `cod_baixa`, `obs_estorno`, `estornado_por`, `data_lancamento_sistema`, `lancamento_por`, `baixado_por`, `data_baixa`, `vinculo`, `data_boleto`, `numero_boleto`, `juros_mora`, `juros_multa`, `juros_outros`, `obs_caldas`, `nosso_numero_old`, `obs_parcela`, `import_mora`, `import_multa`) VALUES ($id_contas_apagar,'$valor_parcela','$DV','Previsao','Contas a Pagar',0,'',3,'',0,'','','','','',1,0,0,0,0,$id_empreendimento, $fornecedor,'','',0,'$today',$user,0,'','','','','','','','','','','','')");
			}

			monta_ordem_compra($id_ordem_compra);

			monta_oc_emitida($cotacao);

		}else{
			echo json_encode('0');
		}
	//Monta a tabela de OC já emitidas
	}else if(isset($_POST['id_cotacao_oc'])){

		$cotacao = $_POST['id_cotacao_oc'];

		monta_oc_emitida($cotacao);
	//Imprimo novamente uma ordem de compra ja gerada
	}else if(isset($_POST['re_imprimir_id_oc'])){
		$id_oc = $_POST['re_imprimir_id_oc'];

		monta_ordem_compra($id_oc);

		echo json_encode('1');
	//Faço o cancelamento da Ordem de Compra e recarrego a lista de OC
	}else if(isset($_POST['cancela_oc']) && isset($_POST['motivo'])){
		$id_oc = $_POST['cancela_oc'];
		$motivo = $_POST['motivo'];
		$id_user = $_POST['id_user'];
		$today = date("d-m-Y");


		$query = mysqli_query($db, "UPDATE `const_ordem_compra` SET `status`= 0 WHERE `id` = $id_oc")or die(mysqli_error($db));

		$query = mysqli_query($db, "INSERT INTO `const_oc_cancelado`(`id_user`, `data`, `motivo`) VALUES ($id_user,'$today','$motivo')")or die(mysqli_error($db));

		//Capturo o id da Cotacao para recarregar a lista de OC
		$query = mysqli_query($db, "SELECT `id_cotacao` FROM `const_ordem_compra` WHERE `id` = $id_oc")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			monta_oc_emitida($assoc['id_cotacao']);
		}else{
			echo json_encode('0');
		}
	//Faço a trasposição da solicitação para a ordem de compra e adiciono os itens solicitados a cotacao criada
	}else if(isset($_POST['id_solicitacao'])){

		$solicitacao = $_POST['id_solicitacao'];
		$today = date("d-m-Y");

		

		//Rotina para pegar o id do orcamento
		$query = mysqli_query($db, "SELECT `id_orcamento` FROM `const_solicitacao_material` WHERE id = $solicitacao")or die(mysqli_error($db));
		$assoc = mysqli_fetch_assoc($query);

		$id_orc = $assoc['id_orcamento'];


		//adicionou a cotaçao no banco
		$query = mysqli_query($db, "INSERT INTO `const_cotacao`(`id_orc`, `titulo`, `data_cotacao`, `status`, `id_solicitacao`) VALUES ($id_orc,'','$today',-1,$solicitacao)")or die(mysqli_error($db));


		//pegou id da cotaçao adicionada
		$id_cotacao = mysqli_insert_id($db);


		// pegou a cotaçao
		$query = mysqli_query($db, "SELECT * FROM const_cotacao WHERE  id = $id_cotacao ")or die(mysqli_error($db));

		$var = mysqli_fetch_assoc($query);

		//se a cotaçao existir
		if(mysqli_num_rows($query) > 0){
			//ok
			echo json_encode($var);
		}else{
			echo json_encode(0);
		}
	//Rotina para adicionar os itens solicitados na cotacao
	}else if(isset($_POST['add_material_cotacao'])){

		$id_cotacao = $_POST['add_material_cotacao'];

		//Rotina para pegar o id da solicitacao
		$query = mysqli_query($db, "SELECT `id_solicitacao` FROM `const_cotacao` WHERE `id` = ".$id_cotacao."")or die(mysqli_error($db));
		$asso = mysqli_fetch_assoc($query);

		$id_solicitacao = $asso['id_solicitacao'];


		//Pego todos os itens solcitados para fazer a busca na tabela 'tabela_orcamento' e 'const_insumo'
		$query = mysqli_query($db, "SELECT * FROM `const_item_solicitacao_material` WHERE `id_solicitacao_mat` = $id_solicitacao")or die(mysqli_error($db));


		if(mysqli_num_rows($query) > 0){

			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {
				$insumo = null;
				$insumo['qnt_solicitada'] = $assoc['qnt'];
				$insumo['id'] = $assoc['id_insumo'];

				//Busco os dados orcados na tabela_orc
				$query_orcado = mysqli_query($db, "SELECT * FROM `tabela_orcamento` WHERE `id`= ".$assoc['id_insumo_orc']." ")or die(mysqli_error($db));
				$assoc_orcado = mysqli_fetch_assoc($query_orcado);

				$insumo['qnt_orcado'] = ($assoc_orcado['quantidade']);
				$insumo['unidade'] = ($assoc_orcado['unidade']);
				$insumo['valor_unitario'] = ($assoc_orcado['valor_unitario']);

				$query_insumo = mysqli_query($db, "SELECT * FROM `const_insumos` WHERE `id`= ".$assoc['id_insumo']." ")or die(mysqli_error($db));
				$assoc_insumo = mysqli_fetch_assoc($query_insumo);

				$insumo['descricao'] = $assoc_insumo['descricao'];
				$insumo['codigo'] = $assoc_insumo['codigo'];
				$insumo['id_especie'] = ($assoc_insumo['id_especie']);

				$dados[] = $insumo;
			}

			// var_dump($dados);
			// die();

			echo json_encode($dados);
		}else{
			echo json_encode(0);
		}
	//Rotina para finalizar uma cotação
	}else if(isset($_POST['finaliza_cotacao'])){

		$id_cotacao = $_POST['finaliza_cotacao'];

		//Status == 1 pois ja foi finalizado
		$query = mysqli_query($db, "UPDATE `const_cotacao` SET `status`= 1 WHERE `id` = $id_cotacao ")or die(mysqli_error($db));

		echo json_encode(1);
	}

?>