<?php 

function formata_data($data){
    $aux = explode('-', $data);

    $aux1 = $aux[1];
    $aux[1] = $aux[0];
    $aux[0] = $aux1;

    if($aux[2] > 90){
        $aux[2] = "19".$aux[2];
    }else{
        $aux[2] = "20".$aux[2];
    }

    $aux = implode('-', $aux);

    return $aux;
}
	
function validaCPF($cpf) {

	// Verifica se um número foi informado
	if(empty($cpf)) {
		return false;
	}

	// Elimina possivel mascara
	$cpf = preg_replace("/[^0-9]/", "", $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($cpf) != 11) {
		return false;
	}
	// Verifica se nenhuma das sequências invalidas abaixo 
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cpf == '00000000000' || 
		$cpf == '11111111111' || 
		$cpf == '22222222222' || 
		$cpf == '33333333333' || 
		$cpf == '44444444444' || 
		$cpf == '55555555555' || 
		$cpf == '66666666666' || 
		$cpf == '77777777777' || 
		$cpf == '88888888888' || 
		$cpf == '99999999999') {
		return false;
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	}
	 else {   

		for ($t = 9; $t < 11; $t++) {

			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}

		return true;
	}
}

function validaCNPJ($cnpj) {

	// Verifica se um número foi informado
	if(empty($cnpj)) {
		return false;
	}

	// Elimina possivel mascara
	$cnpj = preg_replace("/[^0-9]/", "", $cnpj);
	$cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
	
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($cnpj) != 14) {
		return false;
	}
	
	// Verifica se nenhuma das sequências invalidas abaixo 
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cnpj == '00000000000000' || 
		$cnpj == '11111111111111' || 
		$cnpj == '22222222222222' || 
		$cnpj == '33333333333333' || 
		$cnpj == '44444444444444' || 
		$cnpj == '55555555555555' || 
		$cnpj == '66666666666666' || 
		$cnpj == '77777777777777' || 
		$cnpj == '88888888888888' || 
		$cnpj == '99999999999999') {
		return false;
		
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	 } else {   
	 
		$j = 5;
		$k = 6;
		$soma1 = "";
		$soma2 = "";

		for ($i = 0; $i < 13; $i++) {

			$j = $j == 1 ? 9 : $j;
			$k = $k == 1 ? 9 : $k;

			$soma2 += ($cnpj{$i} * $k);

			if ($i < 12) {
				$soma1 += ($cnpj{$i} * $j);
			}

			$k--;
			$j--;

		}

		$digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
		$digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

		return (($cnpj{12} == $digito1) and ($cnpj{13} == $digito2));
	 
	}
}

function consulta_cpf($cpf){
	//Consulta CPF no banco de dados
	include "conexao.php";

	$query = mysqli_query($db, "SELECT cpf_cli FROM cliente");

	while ($executa_query = mysqli_fetch_assoc($query)) {
		if($cpf == $executa_query["cpf_cli"]){
			return true;
		}
	}

	return false;
}

function cpf_cnpj($num){
	// return 1 = CPF,  return 2 = CNPJ, ruturn 3 = INVÁLIDO

	$arr = array(".","-","/");

	$aux = str_replace($arr,"",$num);

	if(strlen($aux) == 11){
		return 1;
	}elseif (strlen($aux) == 14) {
		return 2;
	}
}


function grava_banco($arquivo){// Passando o caminho do arquivo

	include "conexao.php";

	$retorno["ok"] = Array();

    // If you need to parse XLS files, include php-excel-reader
    require('spreadsheet-reader-master/PHPExcel.php');
    require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
    require('spreadsheet-reader-master/SpreadsheetReader.php');


    $tabela_erro = new PHPExcel();
    $colunas = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q","R"];

    $Reader = new SpreadsheetReader($arquivo); // Crio o objeto do arquivo
    $Sheets = $Reader -> Sheets(); // Obtenho as planilhas do arquivo

    foreach ($Sheets as $Index => $Name){// Para percorrer as planilhas do arquivo
    	$aux_erro = 2;
		$Reader -> ChangeSheet($Index);  // Habilito a página atual para edição

		foreach ($Reader as $registro => $linha ){  //Para percorrer as linhas dentro da planilha

			$cont = 0;

			//Verifico se a linha está completamente vazia 
			foreach ($linha as $valor) {
				if(empty($valor)){
					$cont++;
				}
			}

			//Se a linha estiver vazia o script para a varredura
			if($cont == 17 && $registro !== 2 && $registro !== 1){
				break;
			}

			//Esse bloco verifica o titulo da planilha
			if ($registro == 0) {
				$aux = 0;
				foreach ($linha as $valor) {
    				if ($valor == "Tabela para cadastro de Clientes") {
    					$aux = 1;
    				}
				}
				if ($aux !== 1) {
					break;
				}
			}

			if($registro == 4){
				for($i = 0; $i < count($linha); $i++){
					$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", $linha[($i)]);
				}
			}

		
			// Verifico se já passou as linhas de informação no começo do arquivo
			if ($registro > 5){

				// Validação dos dados da linha atual, segue abaixo os Index de cada coluna dentro da $linha
    			// Nome = 0						E-mail = 7				Complemento = 14
    			// CPF/CNPJ = 1					Estado = 8				Telenofe1 = 15
    			// RG = 2						CEP = 9					Telefone2 = 16
    			// Estado Civil = 3				Cidade = 10
    			// Nacionalidade = 4			Bairro = 11
    			// Profissão = 5				Rua = 12
    			// Data Nascimento = 6			Núemero Casa = 13

    			$cliente;
    			$valida = 1;
    			for($i = 0; $i < count($linha); $i++){

    				// Validação do Nome e armazenamento na variável $cliente
    				if ($i == 0) {	
    					if (empty($linha[$i])) {
    						$valida = 0;
    						break;
    					}else{
    						$cliente["nome"] =utf8_decode($linha[$i]);
    					}
    				}

    				// Validação do CPF/CNPJ e armazenamento na variável $cliente

    				elseif ($i == 1) {

    					if (empty($linha[$i])) {
    						$valida = 0;
    						break;

    					}elseif ((!consulta_cpf($linha[$i]))) {

    						switch (cpf_cnpj($linha[$i])) {
    							case 1:
    								if(validaCPF($linha[$i])){
    									$cliente["cpf_cnpj"] = $linha[$i];
    									$cliente["tipo_doc"] = 1; // 1 significa pessoa fisica
    								}else{
    									$valida = 0;
    								}
    								break;
    							case 2:
    								if (validaCNPJ($linha[$i])) {
    									$cliente["cpf_cnpj"] = $linha[$i];
    									$cliente["tipo_doc"] = 2; // 2 significa pessoa Jurídica
    								}else{
    									$valida = 0;
    								}
    								
    								break;
    						}
    					}else{
    						$valida = 0;
    					}
    				}

    				// armazenamento estado civil na variável $cliente
    				elseif ($i == 2) {
    					if (!empty($linha[$i])) {
    						$cliente["rg"] = $linha[$i];
    					}else{
    						$cliente["rg"] = "";
    					}
    				}

    				// armazenamento estado civil na variável $cliente
    				elseif ($i == 3) {
    					if (!empty($linha[$i])) {
    						$cliente["estado_civil"] = $linha[$i];
    					}else{
    						$cliente["estado_civil"] = "";
    					}
    				}

    				// armazenamento nacionalidade na variável $cliente
    				elseif ($i == 4) {
    					if (!empty($linha[$i])) {
    						$cliente["nacionalidade"] = $linha[$i];
    					}else{
    						$cliente["nacionalidade"] = "";
    					}
    				}

    				// armazenamento profissão na variável $cliente
    				elseif ($i == 5) {
    					if (!empty($linha[$i])) {
    						$cliente["profissao"] = $linha[$i];
    					}else{
    						$cliente["profissao"] = "";
    					}
    				}

    				// armazenamento Data Nascimento na variável $cliente
    				elseif ($i == 6) {
    					if (!empty($linha[$i])) {
    						$cliente["data_nascimento"] = formata_data($linha[$i]);
    					}else{
    						$cliente["data_nascimento"] = "";
    					}
    				}

    				// armazenamento email na variável $cliente
    				elseif ($i == 7) {
    					if (!empty($linha[$i])) {
    						$cliente["email"] = $linha[$i];
    					}else{
    						$cliente["email"] = "";
    					}
    				}

    				// armazenamento estado na variável $cliente
    				elseif ($i == 8) {
    					if (!empty($linha[$i])) {
    						$cliente["estado"] = $linha[$i];
    					}else{
    						$valida = 0;
    						break;
    					}
    				}

    				// armazenamento cep na variável $cliente
    				elseif ($i == 9) {
    					if (!empty($linha[$i])) {
    						$cliente["cep"] = $linha[$i];
    					}else{
    						$valida = 0;
    						break;
    					}
    				}

    				// armazenamento cidade na variável $cliente
    				elseif ($i == 10) {
    					if (!empty($linha[$i])) {
    						$cliente["cidade"] = $linha[$i];
    					}else{
    						$valida = 0;
    						break;
    					}
    				}

    				// armazenamento bairro na variável $cliente
    				elseif ($i == 11) {
    					if (!empty($linha[$i])) {
    						$cliente["bairro"] = $linha[$i];
    					}else{
    						$valida = 0;
    						break;
    					}
    				}

    				// armazenamento rua na variável $cliente
    				elseif ($i == 12) {
    					if (!empty($linha[$i])) {
    						$cliente["rua"] = utf8_decode($linha[$i]);
    					}else{
    						$valida = 0;
    						break;
    					}
    				}

    				// armazenamento numero na variável $cliente
    				elseif ($i == 13) {
    					if (!empty($linha[$i])) {
    						$cliente["numero"] = $linha[$i];
    					}else{
    						$valida = 0;
    						break;
    					}
    				}

    				// armazenamento complemento na variável $cliente
    				elseif ($i == 14) {
    					if (!empty($linha[$i])) {
    						$cliente["complemento"] = $linha[$i];
    					}else{
    						$cliente["complemento"] = "";
    					}
    				}

    				// armazenamento Telefone1 na variável $cliente
    				elseif ($i == 15) {
    					if (!empty($linha[$i])) {
    						$cliente["telefone1"] = $linha[$i];
    					}else{
    						$cliente["telefone1"] = "";
    					}
    				}

    				// armazenamento Telefone2 na variável $cliente
    				elseif ($i == 16) {
    					if (!empty($linha[$i])) {
    						$cliente["telefone2"] = $linha[$i];
    					}else{
    						$cliente["telefone2"] = "";
    					}
    				}
    			}

    			if ($valida == 1) {
    				$cliente["data_atual"] = date('d-m-Y');
    				$query = mysqli_query($db, "INSERT INTO cliente (`nome_cli`, `cpf_cli`, `rg_cli`, `estadocivil_cli`, `nacionalidade_cli`, `profissao_cli`, `nascimento_cli`, `email_cli`, `cidade_cli`, `logradouro_cli`, `endereco_cli`, `numero_cli`, `complemento_cli`, `bairro_cli`, `cep_cli`, `telefone1_cli`, `telefone2_cli`, `obs_cli`, `estado_cli`, `senha`, `idgrupo`, `imob_id`, `creci`, `insc_municipal`, `cadastrado_por`, `data_cadastro`, `alterado_por`, `data_alterado`, `fisico_juridico`, `categoria_cliente`, `cargo`, `salario_base`, `data_contratacao`, `data_demissao`, `foto_cli`, `cpf_rfb`, `renda_total`, `telefone3_cli`, `path_foto`) VALUES
												('".$cliente['nome']."', '".$cliente['cpf_cnpj']."', '".$cliente['rg']."', '".$cliente['estado_civil']."', '".$cliente['nacionalidade']."', '".$cliente['profissao']."', '".$cliente['data_nascimento']."', '".$cliente['email']."', '".$cliente['cidade']."', NULL, '".$cliente['rua']."', '".$cliente['numero']."', '".$cliente['complemento']."', '".$cliente['bairro']."', '".$cliente['cep']."', '".$cliente['telefone1']."', '".$cliente['telefone2']."', '', '".$cliente['estado']."', '', 0, 0, '0', '', 0, '".$cliente['data_atual']."', 0, '', '".$cliente['tipo_doc']."', 0, '', '', '', '', '', '', '', NULL, NULL)");

    				//Rotina para pegar o ID do último elemento inserido na tabela cliente, e insere na tabela cliente_tipo;
    				$id = mysqli_fetch_assoc(mysqli_query($db, "SELECT idcliente FROM cliente ORDER BY idcliente DESC LIMIT 1"));
    				$query = mysqli_query($db, "INSERT INTO `cliente_tipo`(`idcliente`, `idtipo`) VALUES (".$id['idcliente'].", 1) "); 

    				array_push($retorno["ok"], $registro);

    			}else{	
    				// Insere as linha incorretas na tabela de erros
    				for($i = 0; $i < count($linha); $i++){
    					$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i].$aux_erro."", $linha[($i)]);
    				}
    				$aux_erro++;

    				$retorno["error"] = 1;
    			}
			}
		}


    }

    $file = $objWriter = PHPExcel_IOFactory::createWriter($tabela_erro, 'Excel2007');
    $file->save("planilhas/falhas.xlsx");

    return $retorno;
}

?>
