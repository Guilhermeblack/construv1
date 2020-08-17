<?php 
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	set_time_limit(0);

	//include "protege_professor.php";
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


	function busca_nome_empreendimento($id_orcamento){
		include 'conexao.php';

		// echo 'id orcaaaa    .'.$id_orcamento;
		//query ta ok
		$query = mysqli_query($db, "SELECT empreendimento_cadastro.descricao_empreendimento FROM empreendimento_cadastro INNER JOIN const_orcamento ON empreendimento_cadastro.idempreendimento_cadastro = const_orcamento.id_empreendimento WHERE `const_orcamento`.`id` = $id_orcamento")or die(mysqli_query($db));


		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);
			// echo "chamale ".$assoc['descricao_empreendimento'];
			return $assoc['descricao_empreendimento'];
		}else{
			return ' N/E';
		}
	}

	function busca_nome_insumo($id_insumo){
		include 'conexao.php';

		// echo 'id ins '.$id_insumo.' <<   ';

		$query = mysqli_query($db, "SELECT `descricao`, `codigo` FROM `const_insumos` WHERE `id`= ".$id_insumo."")or die(mysqli_query($db));

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			return $assoc;
		}else{
			return ' N/C';
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

	function monta_ordem_compra($id_oc){
		include "conexao.php";

		$query = mysqli_query($db, "SELECT * FROM `const_ordem_compra` WHERE id = $id_oc")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			require_once __DIR__ . '/vendor/autoload.php';

			$mpdf = new \mPDF();
			

			$assoc = mysqli_fetch_assoc($query);

			$numero_oc = $assoc['id'];
			$data_oc = $assoc['data'];
			$data_entrega = $assoc['data_entrega'];
			$local_entrega = utf8_encode($assoc['local_entrega']);
			$desconto = $assoc['desconto'];

			$id_fornecedor = $assoc['id_fornecedor'];
			$query = mysqli_query($db, "SELECT * FROM `cliente` WHERE idcliente = $id_fornecedor")or die(mysqli_error($db));

			$assoc = mysqli_fetch_assoc($query);

			$nome = $assoc['nome_cli'];
			$endereco = $assoc['endereco_cli'].' , '.$assoc['numero_cli'];
			$cidade = $assoc['cidade_cli'];
			$cnpj = $assoc['cpf_cli'];
			$telefone = $assoc['telefone1_cli'];
			$cep = $assoc['cep_cli'];
			$foto = $assoc['path_foto '];

			$html = "<table style='width:100% !important' height='391' border='0' align='center'>
			<tbody>
			<tr>
			<td colspan='5' style='text-align: center; font-weight: BOLD; width:20% !important'>
			<img src='img/perfil/.png' style='width:200px !important'></td>
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
					  <td style='text-align: center' colspan='2'>".$assoc['qnt']."</td>
					  <td style='text-align: center'>".$assoc['unidade']."</td>
					  <td style='text-align: center'>$valor_insumo</td>
					  <td style='text-align: center'>$valor_total</td>
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

			//echo $html;
			$mpdf->WriteHTML($html);
			$mpdf->Output('pdf/ordem_compra.pdf', 'F');
		}
	}

	if(isset($_POST['deposito'])){ //Atualizo as listas de entrada, saida, saldo e extravio de acordo com o deposito solicitado

		$deposito = $_POST['deposito'];


		$dados = [];

		$entrada = [];
		$saida = [];
		$extravio = [];
		$saldo = [];

		
		// echo ' dep >>'.$deposito.'  >>>';
		$query = mysqli_query($db, "SELECT * FROM `const_deposito_entrada` WHERE `id_estoque` = ".$deposito."  ORDER BY `id` DESC " )or die(mysqli_error($db));
		if(mysqli_num_rows($query) > 0){

			while ($assoc = mysqli_fetch_assoc($query)) {

				$total_restante = 0;

				$assoc['nome_empresa'] = busca_nome_empreendimento($assoc['id_orcamento']);


				$assoc['insumo'] = busca_nome_insumo($assoc['id_insumo']);


				$entrada[] = $assoc;

				$query_saida = mysqli_query($db, "SELECT * FROM `const_deposito_saida` WHERE `id_entrada` = ".$assoc['id']." ORDER BY id DESC")or die(mysqli_error($db));
				if(mysqli_num_rows($query_saida) > 0){
					while ($assoc_saida = mysqli_fetch_assoc($query_saida)) {

						$assoc_saida['nome_empresa'] = $assoc['nome_empresa'];
						$assoc_saida['insumo'] = $assoc['insumo'];

						$saida[] = $assoc_saida;

						$total_restante += $assoc_saida['qnt'];
					}
				}

				$query_extravio = mysqli_query($db, "SELECT * FROM `const_deposito_extravio` WHERE `id_entrada` = ".$assoc['id']." ORDER BY id DESC ")or die(mysqli_error($db));
				if(mysqli_num_rows($query_extravio) > 0){
					while ($assoc_extravio = mysqli_fetch_assoc($query_extravio)) {

						$assoc_extravio['nome_empresa'] = $assoc['nome_empresa'];
						$assoc_extravio['insumo'] = $assoc['insumo'];

						$extravio[] = $assoc_extravio;

						$total_restante += $assoc_extravio['qnt'];
					}
				}

				if(!(($assoc['qnt'] - $total_restante) <= 0)){

					$assoc['qnt'] = ($assoc['qnt'] - $total_restante);

					$saldo[] = $assoc;
				}

			}

			$dados['entrada'] = $entrada;
			$dados['saida'] = $saida;
			$dados['extravio'] = $extravio;
			$dados['saldo'] = $saldo;

			// die();

			echo json_encode($dados);
		}else{

			$dados = [];

			$entrada = [];
			$saida = [];
			$extravio = [];
			$saldo = [];

			$dados['entrada'] = $entrada;
			$dados['saida'] = $saida;
			$dados['extravio'] = $extravio;
			$dados['saldo'] = $saldo;

			echo json_encode($dados);
		}
	}else if(isset($_POST['deposito_solicitacao'])){ //Atualizo a lista de solicitacao
		$deposito = $_POST['deposito_solicitacao'];

		// print_r($deposito);

		// aprovado = 1 -> aprovado 				id_oc // mesma coisa
		// aprovado = 0 -> não aprovado				id_oc // mesma coisa
		// aprovado = -1 -> pedente de aprovação	id_oc // mesma coisa

		$query = mysqli_query($db, "SELECT * FROM `const_solicitacao_material` WHERE `id_destino` = $deposito AND `aprovado` = 1 AND `id_oc` = -1 ORDER BY id DESC")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){

			$dados = [];

			while($assoc = mysqli_fetch_assoc($query)) {

				$assoc['nome_usuario'] = busca_nome_usuario($assoc['id_user']); 

				$dados[] = $assoc;
			}

			echo json_encode($dados);
		}else{
			echo json_encode(0);
		}
	}else if(isset($_POST['id_solicitacao'])){ //Rotina para gravar materias solicitados e gravar na tabela const_deposito_saida

		//#######  FORNECEDOR == DEPOSITO ###############

		$solicitacao = $_POST['id_solicitacao'];

		$user = $_POST['dados_all'][0];
		$fornecedor = $_POST['dados_all'][1];
		$cotacao = $_POST['dados_all'][2];
		$data_entrega = $_POST['dados_all'][3];
		$local_entrega = utf8_decode($_POST['dados_all'][4]);
		$desconto = $_POST['dados_all'][5];
		$today = date("d-m-Y"); 
		$hora = date("H-i-s");


		//Insiro a OC
		$query = mysqli_query($db, "INSERT INTO `const_ordem_compra`(`id_user`, `id_fornecedor`, `data_entrega`, `id_cotacao`, `data`, `status`, `local_entrega`, `desconto`,`fornecedor_deposito`) VALUES ($user,$fornecedor,'$data_entrega',$cotacao,'$today', 1, '$local_entrega', '$desconto', 2)")or die(mysqli_error($db));

		$id_ordem_compra = mysqli_insert_id($db);

		//Atualizo a OC gerada gravando na tabela const_solicitacao_oc o vincula da solicitacao com a oC  !!!! id_oc == 1 pois 1 é para solicitacao que pussuem OC
		$query = mysqli_query($db, "UPDATE `const_solicitacao_material` SET `id_oc`= 1  WHERE `id` = $solicitacao")or die(mysqli_error($db));

		//Cotacao 0 pois a OC veio deposito
		$query = mysqli_query($db, "INSERT INTO `const_solicitacao_oc`(`id_oc`, `id_solicitacao`, `id_cotacao`) VALUES ($id_ordem_compra,$solicitacao, 0)")or die(mysqli_error($db));


		//#########   DAR BAIXA NA SOLICITACAO  E GRAVAR  OS ITENS DA OC ########
		$entrada = null;

		$query = mysqli_query($db, "SELECT * FROM `const_item_solicitacao_material` WHERE `id_solicitacao_mat` =  $solicitacao")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			while ($assoc = mysqli_fetch_assoc($query)) {
				
				$query_entrada = mysqli_query($db, "SELECT * FROM `const_deposito_entrada` WHERE `id_insumo` = ".$assoc['id_insumo']." AND `id_estoque` = $fornecedor  ORDER BY id DESC LIMIT 1")or die(mysqli_error($db));
				$assoc_entrada = mysqli_fetch_assoc($query_entrada); 


				//Gravo na tabela deposito_saida
				$query_saida = mysqli_query($db, "INSERT INTO `const_deposito_saida`(`id_entrada`, `id_user`, `id_estoque`, `id_oc`, `id_solicitacao`, `qnt`, `data`, `hora`) VALUES (".$assoc_entrada['id'].", $user, $fornecedor, $id_ordem_compra, $solicitacao, '".$assoc['qnt']."','$today','$hora')")or die(mysqli_error($db));


				//Grava os itens da OC
				$query_grava = mysqli_query($db, "INSERT INTO `const_insumo_oc`(`id_insumo`, `id_oc`, `valor_unidade`, `qnt`) VALUES (".$assoc_entrada['id_insumo'].",$id_ordem_compra, '".$assoc_entrada['valor_insumo']."', '".$assoc['qnt']."')")or die(mysqli_error($db));

			}


			monta_ordem_compra($id_ordem_compra);
			echo json_encode(1);

		}else{
			echo json_encode(0);
		}
	}else if(isset($_POST['qnt']) && isset($_POST['motivo'])  && isset($_POST['id_insumo_extravio'])){ // Faço o estorno do insumo usando as mesma logica da gravação da tabela de saida

		$insumo = $_POST['id_insumo_extravio'];
		$user = $_POST['id_user_extravio'];
		$deposito = $_POST['id_deposito_extravio'];

		$qnt = $_POST['qnt'];
		$motivo = addslashes($_POST['motivo']);

		$today = date("d-m-Y"); 
		$hora = date("H-i-s");

		//rotina para pegar o id_insumo_entrada
		$query_entrada = mysqli_query($db, "SELECT * FROM `const_deposito_entrada` WHERE `id_insumo` = $insumo AND `id_estoque` = $deposito ORDER BY id DESC LIMIT 1")or die(mysqli_error($db));
		$assoc_entrada = mysqli_fetch_assoc($query_entrada); 

		$id_entrada = $assoc_entrada['id'];

		$query = mysqli_query($db, "INSERT INTO `const_deposito_extravio`(`id_user`, `id_insumo`, `id_entrada`, `id_deposito`, `qnt`, `motivo`, `data`, `hora`) VALUES ($user,$insumo,$id_entrada, $deposito, '$qnt', '$motivo', '$today', '$hora')")or die(mysqli_error($db));

		include "envia_notificacao.php";

		$dados = [];

		$query = mysqli_query($db, "SELECT idcliente FROM `cliente` WHERE `idgrupo` = 5")or die(mysqli_error($db));

		if(mysqli_num_rows($query)){
			while ($assoc = mysqli_fetch_assoc($query)) {
				$dado['id_user'] = $assoc['idcliente'];
				$dado['titulo'] = 'Novo Insumo Extraviado!';
				$dado['msg'] = 'Você tem um novo insumo Extraviado';
				$dado['icon'] = 'https://immobilebusiness.com.br/home/assets/img/icons/site/favicon.png';
				$dado['link_red'] =  $_SERVER['HTTP_HOST'].'/const_deposito.php';

				$dados[] = $dado;
			}
		}
		
		envia_notificacao($dados);

		echo json_encode(1);
	}


?>