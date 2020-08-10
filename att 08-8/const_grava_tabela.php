
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

	function busca_id_insumo($nomeInsumo){

		$nomeInsumo = utf8_decode($nomeInsumo);
		include "conexao.php";
		$query = mysqli_query($db, "SELECT id FROM const_insumos WHERE descricao = '".$nomeInsumo."' LIMIT 1")or die(mysqli_error($db));


			if(mysqli_num_rows($query) > 0){
				
				$assoc = mysqli_fetch_assoc($query);

				return $assoc['id'];
			}else{

				return false;
			};
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

	// separa o indice e verifica se o indice do pai contem o indice do filho
	function verifica_filho($idPai, $idFilho){

		$idPai = explode('.', $idPai);
		$idFilho = explode('.', $idFilho);

		foreach ($idPai as $key => $value) {
			//corre array do indice pai
			if(strcmp($value, $idFilho[$key]) != 0){
				return false;
			}
		}

		return true;
	}

	function verifica_nivel($aux){
		return substr_count($aux, '.');
	}

	// pega o indice e a matrix para verificar o filho
	function has_children($id, $nivel){

		// nivel sao os itens a serem verificados como filhos
		foreach ($nivel as $key => $value) {

			//se o verifica filho for veraddeiro

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

		// var_dump($pais);
		// echo '<br></br>';
		// var_dump($matrix);
		// echo '<br></br>';
		// var_dump($nivel);
		// die();

		foreach ($pais as $key => $value) {
			


			// se houver esse nivel na matriz
			if(isset($matrix[($nivel+1)])){
				// se a matrix com esse id tiver o filho
				if(has_children($value['id_tarefa'], $matrix[($nivel+1)])){

					$aux = escreve_array(get_children($value['id_tarefa'], $matrix[($nivel+1)]), $matrix, ($nivel+1));

					$value['children'] = $aux;

					array_push($vetor, $value);
				}else{


					
					array_push($vetor, $value);
				}
			}else{
				


				// $value['pasta'] = utf8_encode($value['pasta']);

				// print_r($value['pasta']);
				
				array_push($vetor, $value);
			}
		}

		
		return $vetor;
	}

	function monta_json($orcamento = 0){

		include "conexao.php";

		// pega o que foi inserido para o orcamento 

		$query = mysqli_query($db, "SELECT * FROM const_orcamento WHERE id = $orcamento")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){

			$assoc = mysqli_fetch_assoc($query);

			// echo $orcamento;
			// echo '<br> 2 </br>';
			// // var_dump($assoc);
			// die();

			$titulo = $assoc['titulo'];

		}else{
			$titulo = 'tabela';
		}

		$query = mysqli_query($db, "SELECT * FROM tabela_orcamento WHERE id_orcamento = $orcamento AND `status` = 1 ORDER BY id ")or die(mysqli_error($db));

		// Separo e monto a matrix com os niveis e os dados dos nós
		while ($executa_query = mysqli_fetch_assoc($query)) {

			// echo '<br> a </br>';
			// var_dump($executa_query);
			// die();

			// conta os pontos para definir o nivel;
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

			// echo '<br> 1 </br>';
			// var_dump($aux);
			// die();
			$aux = json_encode($aux);

			// var_dump($aux);
			// die();

			$aux = str_replace('pasta', 'title', $aux);
			// echo '<br> 2 </br>';
			// echo $titulo;
			// echo '<br> 3 </br>';
			// var_dump($aux);
			// die();

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

	function virgulaemponto($str){

		$str = str_replace(',', '.', $str);
		return $str;
	}

	function formata_valor($valor){


		$valor =preg_split("/[\s]+/", $valor);

		// var_dump($valor);
		// echo '<br> explode </br>';
	    $aux = str_replace(',', '.', $valor[1]);

	    //OBS: vard_dump na $linha para ver como vem a informação

		// var_dump($aux);
		// echo '<br> fim </br>';


	    return strval($aux);
	}














	function verifica_planilha($arquivo, $orcamento){

		include 'conexao.php';
		// verificar se nome da planilha ja existe

		$nomeorca = mysqli_query($db,"SELECT titulo FROM `const_orcamento` WHERE `id` = $orcamento") or (die($db));
		$nomeorc = mysqli_fetch_Assoc($nomeorca);

		
		if($nomeorc){

			$nome_arq= $nomeorc['titulo'].'.json';

			$path = "./orcamentos/";
			// echo $path;

			$diretorio = dir($path);

			
			// echo '<br>'.$nome_arq.'</br>';

			while($arquivo = $diretorio -> read()){

				// SE EU ACHAR O MESMO NOME DE ORÇAMENTO
				if(strval($nome_arq) == strval($arquivo)){

					// verificar se tem verifica_filho
					// alinhar com o indice
					// echo $path.$arquivo;

					// echo '<br> - </br>';
					$irma= file_get_contents($path.$arquivo);
					
					// é o arquivo json como objeto
					$dec= json_decode($irma);
					// echo json_encode($dec);

					
					foreach($dec[0] as $k =>$arq){

					}
					// print_r($irma);
					$diretorio -> close();

					// retorno array do orcamento
					return $dec;
				}
				// echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
			}

			


		}
		
		return json_encode(1);
	}


	function grava_planilha_orcamento($arquivo, $orcamento, $tipo_planilha){ // Passando o caminho do arquivo

		include "conexao.php";

		// json receebe a orcamento com mesmo nome
		//tem que ler planilha e categorizar indices

		// $json= verifica_planilha($arquivo, $orcamento);
		//aray do orcamento
		//normalizar indice
		// echo '<br> 1 </br>';
		// var_dump($json);

		// die();

	    $retorno["ok"] = Array();

		

	    // If you need to parse XLS files, include php-excel-reader
	    require('spreadsheet-reader-master/PHPExcel.php');
	    require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
	    require('spreadsheet-reader-master/SpreadsheetReader.php');


	    $tabela_erro = new PHPExcel();
	    $colunas = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J"];

	    $Reader = new SpreadsheetReader($arquivo); // Crio o objeto do arquivo
	    $Sheets = $Reader -> Sheets(); // Obtenho as planilhas do arquivo

		$var = [];
		foreach ($Sheets as $Index => $Name){// Para percorrer as planilhas do arquivo
			

			


			// pegar o nome do orçaento e fonferir na tebela de orcamento

			
			//se tiver eu alinho o indice















	        $aux_erro = 2; // linha que eu começo a escrever na planilha de erro
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
	            if($cont == 5 && $registro > 3){
	                break;
	            }

	            //Esse bloco verifica o titulo da planilha
	            if ($registro == 0) {
	                $aux = 0;
	                foreach ($linha as $valor) {
	                    if ($valor == "TABELA DE ORÇAMENTO") {
	                        $aux = 1;
	                    }
	                }
	                if ($aux !== 1) {
	                    break;
	                }
	            }

	            // escrevo na planilha de erro as colunas
	            if($registro == 3){
	                for($i = 0; $i <= count($linha); $i++){
	                    if($i == count($linha)){
	                        $tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", "Problema(s)");
	                        break;
	                    }
	                    $tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", $linha[$i]);
	                }
	            }

			
				//começa a ler da 4 linha da planilha
				//pula a linha de exemplo da planilha

	            // Verifico se já passou as linhas de informação no começo do arquivo
	            if ($registro > 4){

	                // Validação dos dados da linha atual, segue abaixo os Index de cada coluna dentro da $linha

	                // ID = 0                             
	                // Descrição = 1                                    
	                // Quantidade = 2             
	                // Unidade Medida = 3                              
	                // Valor Unitario = 4                 
	            
	                $problema = '';
	                $no;
					$valida = 1;
					
					// colunas da linha
	                for($i = 0; $i < count($linha); $i++){


						// $i é a coluna


						//pegar indice planilha mesmo nome
						//se tiver corro ate a ultima linha e verifico o indice
						//comparar indice com planilha existente
						// se ja existir o indice atual na planilha eu faço a agregaçao continuando do indice que ja existe






	                    // Validação do Id do no
	                    if ($i == 0) {  
	                        if (empty($linha[$i])) {
	                            $valida = 0;
								$problema .= 'id invalido';
								array_push($vare,[' errooooo']);
	                            break;
	                        }else{

								//indice pae
								$no['id'] = virgulaemponto($linha[$i]);
								
								array_push($vare,[$linha[$i]. '  <>  '. $no['id']]);
								echo $no['id'];
								//se ja tive indice reescrever de acordo com a existente
	                        }
	                    }


						//comparar nome com planilha existente

	                    // Validação da Descrição
	                    elseif ($i == 1) {
	                        if (empty($linha[$i])) {
	                            $no['descricao'] = '';
	                        }else{

								//condicao se o nome ja existir no orcamento
								//nome da planilha que vem
	                            $no['descricao'] = addslashes($linha[$i]);
								//$no['descricao'] = utf8_decode($linha[$i]);
								
								// echo $no['descricao'];
								// echo '<br></br>';
								// var_dump($json[0]);
								// die();









								
								// if(in_array($no['descricao'], $json[0])){
								// 	// echo 'deixe';
								// 	// die();

								// }
	                        }
	                    }

	                    // armazenamento Quantidade
	                    elseif ($i == 2) {
	                        if(empty($linha[$i])){
	                        	$no['qnt'] = '';
	                        }else {
	                            $no['qnt'] = $linha[$i];
	                        }
	                    }

	                    // Armazenamento Unidade medida
	                    elseif ($i == 3) {
	                        if (!empty($linha[$i])) {
	                            $no['uni_medida'] = $linha[$i];
	                        }else{
	                            $no['uni_medida'] = '';
	                        }
	                    }

	                    // Armazenamento Valor Unitario
	                    elseif ($i == 4) {
	                        if (empty($linha[$i])) {
								$no['valor_uni'] = 0;
								array_push($var,' -=-=-=-=-=-=-=-=-=-=-=-=- ');
	                        }else{
								

								$no['valor_uni'] = formata_valor($linha[$i]);
								array_push($var,[$no['valor_uni'],$linha[$i]]);
	                        }
	                    }

	                    // Armazenamento codigo
	                    elseif ($i == 5) {
	                        if (empty($linha[$i])) {
	                            $no['cod_insumo'] = '';
	                        }else{
	                            $no['cod_insumo'] = $linha[$i];
	                        }
	                    }

	                }
					 
					
	                // Verifico se estão preenchidos pelo menos 1 campo de identificação
	                if(empty($no['cod_insumo']) && empty($no['descricao'])){
	                	$valida = 0;
                        $problema .= 'descricao ou codigo não preenchidos';
	                }


	                if ($valida == 1) {
	                    include "conexao.php";

	                    // Faço a verificação para saber a qual tabela o plano pertence
	                    if(empty($no['qnt']) && empty($no['uni_medida']) && empty($no['valor_unitario'])){
	                    	$query = mysqli_query($db, "SELECT `id` FROM `const_planocontas` WHERE `codigo` = '".$no['cod_insumo']."' OR `descricao` = '".$no['descricao']."'")or die(mysqli_error($db));

	                    	if(mysqli_num_rows($query) > 0){
	                    		$aux = mysqli_fetch_assoc($query);
	                    		$no['cod_insumo'] = $aux['id'];
	                    		$tabela = 1;
	                    	}else{
	                    		$query = mysqli_query($db, "INSERT INTO `const_temp`(`descricao`) VALUES ('".$no['descricao']."')")or die(mysqli_error($db));
	                    		$no['cod_insumo']= mysqli_insert_id($db);
	                    		$tabela = 3;
	                    	}
	                    // Faço a verificação paa saber a qual tabela o insumo pertence
	                    }else{

	                    	if($tipo_planilha == 2){
	                    		$query = mysqli_query($db, "SELECT * FROM `const_tarefas` WHERE `codigo` = ".$no['cod_insumo']." OR `titulo` = '".$no['descricao']."'");

	                    		if(mysqli_num_rows($query) > 0){
	                    			$aux = mysqli_fetch_assoc($query);
	                    			$no['cod_insumo'] = $aux['id'];
	                    			$tabela = 4;
	                    		}else{
	                    			$query = mysqli_query($db, "INSERT INTO `const_temp`(`descricao`) VALUES ('".$no['descricao']."')")or die(mysqli_error($db));
	                    			$no['cod_insumo']= mysqli_insert_id($db);
	                    			$tabela = 3;
	                    		}
	                    	}else{
	                    		$query = mysqli_query($db, "SELECT `id` FROM `const_insumos` WHERE `codigo` = ".$no['cod_insumo']." OR `descricao` = '".$no['descricao']."'");

	                    		if(mysqli_num_rows($query) > 0){
	                    			$aux = mysqli_fetch_assoc($query);
	                    			$no['cod_insumo'] = $aux['id'];
	                    			$tabela = 2;
	                    		}else{
	                    			$query = mysqli_query($db, "INSERT INTO `const_temp`(`descricao`) VALUES ('".$no['descricao']."')")or die(mysqli_error($db));
	                    			$no['cod_insumo']= mysqli_insert_id($db);
	                    			$tabela = 3;
	                    		}
	                    	}
	                    }	

	                    if($tipo_planilha == 1){
    	                    $aux = mysqli_query($db, "INSERT INTO `tabela_orcamento`(`id_tarefa`, `quantidade`, `unidade`, `valor_unitario`, `id_orcamento`, `id_insumo_plano`, `tabela`, `status`) VALUES (".$no['id'].", '".$no['qnt']."' , '".$no['uni_medida']."' , '".$no['valor_uni']."' , $orcamento , ".$no['cod_insumo'].", $tabela, 1 )") or die(mysqli_error($db));
    	                    
	                    }elseif($tipo_planilha == 2){
	                    	$aux = mysqli_query($db, "INSERT INTO `const_item_tarefa_orcamento`(`id_tarefa`, `quantidade`, `unidade`, `valor_unitario`, `id_orcamento`, `id_tarefa_plano`, `tabela`, `status`) VALUES (".$no['id'].", '".$no['qnt']."' , '".$no['uni_medida']."' , '".$no['valor_uni']."' , $orcamento , ".$no['cod_insumo'].", $tabela, 1 )") or die(mysqli_error($db));
	                    }
	                    
	                    

	                    mysqli_close($db);

						array_push($retorno['ok'], $registro);


	                }else{  

	                    // Insere as linha incorretas na tabela de erros
	                    for($i = 0; $i <= count($linha) ; $i++){
	                        if($i == count($linha)){
	                            $tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i].$aux_erro."", $problema);
	                            break;
	                        }
	                        $tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i].$aux_erro."", $linha[$i]);
	                    }
	                    $aux_erro++;

	                    $retorno["error"] = 1;
	                }
				}
				
			}




























			
			var_dump($vare);
			die(); 
			
	    }

		

	    $file = $objWriter = PHPExcel_IOFactory::createWriter($tabela_erro, 'Excel2007');
	    $file->save("planilhas/falhas.xlsx");

		// itens ja foram inseridos no orcamento
	    monta_json($orcamento);

	    return $retorno;
	}

	function grava_planilha_insumos($arquivo){ // Passando o caminho do arquivo

		include "conexao.php";

		$retorno["ok"] = Array();

		    // If you need to parse XLS files, include php-excel-reader
		require('spreadsheet-reader-master/PHPExcel.php');
		require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
		require('spreadsheet-reader-master/SpreadsheetReader.php');


		$tabela_erro = new PHPExcel();
		$colunas = ["A", "B", "C", "D", "E", "F"];

		    $Reader = new SpreadsheetReader($arquivo); // Crio o objeto do arquivo
		    $Sheets = $Reader -> Sheets(); // Obtenho as planilhas do arquivo

		    foreach ($Sheets as $Index => $Name){// Para percorrer as planilhas do arquivo

		        $aux_erro = 2; // linha que eu começo a escrever na planilha de erro
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
		        	if($cont == 4 && $registro > 3){
		        		break;
		        	}

		            //Esse bloco verifica o titulo da planilha
		        	if ($registro == 0) {
		        		$aux = 0;
		        		foreach ($linha as $valor) {
		        			if ($valor == "TABELA DE INSUMOS") {
		        				$aux = 1;
		        			}
		        		}
		        		if ($aux != 1) {
		        			break;
		        		}
		        	}

		            // escrevo na planilha de erro as colunas
		        	if($registro == 2){
		        		for($i = 0; $i <= count($linha); $i++){
		        			if($i == count($linha)){
		        				$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", "Problema(s)");
		        				break;
		        			}
		        			$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", $linha[$i]);
		        		}
		        	}


		            // Verifico se já passou as linhas de informação no começo do arquivo
		        	if ($registro > 3){

		                // Validação dos dados da linha atual, segue abaixo os Index de cada coluna dentro da $linha

		                // Código = 0                             
		                // Descrição = 1                                    
		                // Categoria = 2             
		                // Espécie = 3                              
		                /*
		            	if($registro == 7){
		            		var_dump($linha);
		            		die();
		            	}*/

		            	$problema = '';
		            	$insumo;
		            	$valida = 1;
		            	for($i = 0; $i < count($linha); $i++){

							//            LINHA
							
							
		                    // Validação do Código do insumo
		            		if ($i == 0) {  
		            			if (empty($linha[$i])) {
		            				$valida = 0;
		            				$problema .= 'Codigo invalido';
		            				break;
		            			}else{
		            				$insumo["codigo"] = addslashes($linha[$i]);
		            			}
		            		}

		                    // Validação da Descrição
		            		elseif ($i == 1) {
		            			if (empty($linha[$i])) {
		            				$problema .= "Descrição não encontrada";
		            				$valida = 0;
		            				break;
		            			}else{
		            				$insumo["descricao"] = addslashes($linha[$i]);
		                            //$no['descricao'] = utf8_decode($linha[$i]);
		            			}
		            		}

		                    // Validação categoria
		            		elseif ($i == 2) {
		            			if(empty($linha[$i])){
		            				$problema .= "Categoria não encontrada";
		            				$valida = 0;
		            				break;
		            			}else {
		            				$insumo["categoria"] = addslashes($linha[$i]);
		            			}
		            		}

		                    // Validação Especie
		            		elseif ($i == 3) {
		            			if (empty($linha[$i])) {
		            				$problema .= "Espécie não encontrada";
		            				$valida = 0;
		            				break;
		            			}else{
		            				$insumo["especie"] = addslashes($linha[$i]);
		            			}
		            		}
						}
						

						//                       LINHA


		            	if ($valida == 1) {

		            		if(!existe_categoria($insumo['categoria'])){

		            			include "conexao.php";
		            			$query = mysqli_query($db, "INSERT INTO `const_categoria`(`descricao`, `categoria_pai`) VALUES ('".$insumo['categoria']."', 0)")or die(mysqli_error($db));

		            			$insumo['categoria'] = id_categoria($insumo['categoria']);

		            			if(!existe_categoria($insumo['especie'])){

		            				$query = mysqli_query($db, "INSERT INTO `const_categoria`(`descricao`, `categoria_pai`) VALUES ('".$insumo['especie']."', '".$insumo['categoria']."')")or die(mysqli_error($db));
		            				$insumo['especie'] = id_categoria($insumo['especie']);

		            			}else{
		            				$insumo['especie'] = id_categoria($insumo['especie']);
		            			}
		            		}else{
		            			include "conexao.php";

	            				if(!existe_categoria($insumo['especie'])){

	            					$insumo['categoria'] = id_categoria($insumo['categoria']);

	            					$query = mysqli_query($db, "INSERT INTO `const_categoria`(`descricao`, `categoria_pai`) VALUES ('".$insumo['especie']."', '".$insumo['categoria']."')")or die(mysqli_error($db));
	            					$insumo['especie'] = id_categoria($insumo['especie']);

	            				}else{
	            					$insumo['especie'] = id_categoria($insumo['especie']);
	            					$insumo['categoria'] = id_categoria($insumo['categoria']);
	            				}
		            		}

		            		include "conexao.php";

		            		$aux = mysqli_query($db, "INSERT INTO `const_insumos`(`codigo`, `descricao`, `id_categoria`, `id_especie`) 
		            									VALUES ('".$insumo['codigo']."','".$insumo['descricao']."',".$insumo['categoria'].",".$insumo['especie']." )") or die(mysqli_error($db));
		            		mysqli_close($db);

		            		array_push($retorno['ok'], $registro);
		            	}else{  

		                    // Insere as linha incorretas na tabela de erros
		            		for($i = 0; $i <= count($linha) ; $i++){
		            			if($i == count($linha)){
		            				$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i].$aux_erro."", $problema);
		            				break;
		            			}
		            			$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i].$aux_erro."", $linha[$i]);
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

	function grava_plano_contas($arquivo){
		include "conexao.php";

		$retorno["ok"] = Array();

			    // If you need to parse XLS files, include php-excel-reader
		require('spreadsheet-reader-master/PHPExcel.php');
		require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
		require('spreadsheet-reader-master/SpreadsheetReader.php');


		$tabela_erro = new PHPExcel();
		$colunas = ["A", "B", "C", "D", "E", "F"];

	    $Reader = new SpreadsheetReader($arquivo); // Crio o objeto do arquivo
	    $Sheets = $Reader -> Sheets(); // Obtenho as planilhas do arquivo

	    foreach ($Sheets as $Index => $Name){// Para percorrer as planilhas do arquivo

	        $aux_erro = 2; // linha que eu começo a escrever na planilha de erro
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
	        	if($cont == 2 && $registro > 1){
	        		break;
	        	}

	            //Esse bloco verifica o titulo da planilha
	        	if ($registro == 0) {
	        		$aux = 0;
	        		foreach ($linha as $valor) {
	        			if ($valor == "TABELA DE PLANO DE CONTAS") {
	        				$aux = 1;
	        			}
	        		}
	        		if ($aux != 1) {
	        			break;
	        		}
	        	}

	            // escrevo na planilha de erro as colunas
	        	if($registro == 1){
	        		for($i = 0; $i <= count($linha); $i++){
	        			if($i == count($linha)){
	        				$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", "Problema(s)");
	        				break;
	        			}
	        			$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", $linha[$i]);
	        		}
	        	}


	            // Verifico se já passou as linhas de informação no começo do arquivo
	        	if ($registro > 1){

	                // Validação dos dados da linha atual, segue abaixo os Index de cada coluna dentro da $linha

	                // Código = 0                             
	                // Descrição = 1                                    
	                // Categoria = 2             
	                // Espécie = 3                              
	                /*
	            	if($registro == 7){
	            		var_dump($linha);
	            		die();
	            	}*/

	            	$problema = '';
	            	$plano;
	            	$valida = 1;
	            	for($i = 0; $i < count($linha); $i++){

	                    // Validação do Código do insumo
	            		if ($i == 0) {  
	            			if (empty($linha[$i])) {
	            				$valida = 0;
	            				$problema .= 'Codigo invalido';
	            				break;
	            			}else{
	            				$plano["codigo"] = addslashes($linha[$i]);
	            			}
	            		}

	                    // Validação da Descrição
	            		elseif ($i == 1) {
	            			if (empty($linha[$i])) {
	            				$problema .= "Descrição não encontrada";
	            				$valida = 0;
	            				break;
	            			}else{
	            				$plano["descricao"] = addslashes($linha[$i]);
	            			}
	            		}
	            	}

	            	if ($valida == 1) {
	            		// Valido o tipo do Plano
	            		if(strpos($plano['codigo'], '.')){
	            			$aux = explode('.', $plano['codigo']);
	            			$plano['tipo_plano'] = $aux[0];
	            		}else{
	            			$plano['tipo_plano'] = $plano['codigo'];
	            		}

	            		$query = mysqli_query($db, "INSERT INTO `const_planocontas`(`codigo`, `descricao`, `tipo_plano`) VALUES ('".$plano['codigo']."','".$plano['descricao']."',".$plano['tipo_plano'].")");


	            		array_push($retorno['ok'], $registro);
	            	}else{  

	                    // Insere as linha incorretas na tabela de erros
	            		for($i = 0; $i <= count($linha) ; $i++){
	            			if($i == count($linha)){
	            				$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i].$aux_erro."", $problema);
	            				break;
	            			}
	            			$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i].$aux_erro."", $linha[$i]);
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

	function grava_tarefa($arquivo){
		include "conexao.php";

		$retorno["ok"] = Array();

			    // If you need to parse XLS files, include php-excel-reader
		require('spreadsheet-reader-master/PHPExcel.php');
		require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
		require('spreadsheet-reader-master/SpreadsheetReader.php');


		$tabela_erro = new PHPExcel();
		$colunas = ["A", "B", "C", "D", "E", "F"];

	    $Reader = new SpreadsheetReader($arquivo); // Crio o objeto do arquivo
	    $Sheets = $Reader -> Sheets(); // Obtenho as planilhas do arquivo

	    foreach ($Sheets as $Index => $Name){// Para percorrer as planilhas do arquivo

	        $aux_erro = 2; // linha que eu começo a escrever na planilha de erro
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
	        	if($cont == 2 && $registro > 1){
	        		break;
	        	}

	            //Esse bloco verifica o titulo da planilha
	        	if ($registro == 0) {
	        		$aux = 0;
	        		foreach ($linha as $valor) {
	        			if ($valor == "TABELA DE TAREFAS") {
	        				$aux = 1;
	        			}
	        		}
	        		if ($aux != 1) {
	        			break;
	        		}
	        	}

	            // escrevo na planilha de erro as colunas
	        	if($registro == 1){
	        		for($i = 0; $i <= count($linha); $i++){
	        			if($i == count($linha)){
	        				$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", "Problema(s)");
	        				break;
	        			}
	        			$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", $linha[$i]);
	        		}
	        	}


	            // Verifico se já passou as linhas de informação no começo do arquivo
	        	if ($registro > 1){

	                // Validação dos dados da linha atual, segue abaixo os Index de cada coluna dentro da $linha

	                // Código = 0                             
	                // Descrição = 1                                    
	                // Categoria = 2             
	                // Espécie = 3                              
	                /*
	            	if($registro == 7){
	            		var_dump($linha);
	            		die();
	            	}*/

	            	$problema = '';
	            	$plano;
	            	$valida = 1;
	            	for($i = 0; $i < count($linha); $i++){

	                    // Validação do Código do insumo
	            		if ($i == 0) {  
	            			if (empty($linha[$i])) {
	            				$valida = 0;
	            				$problema .= 'Codigo invalido';
	            				break;
	            			}else{
	            				$plano["codigo"] = addslashes($linha[$i]);
	            			}
	            		}

	                    // Validação da Descrição
	            		elseif ($i == 1) {
	            			if (empty($linha[$i])) {
	            				$problema .= "Descrição não encontrada";
	            				$valida = 0;
	            				break;
	            			}else{
	            				$plano["descricao"] = addslashes($linha[$i]);
	            			}
	            		}
	            	}

	            	if ($valida == 1) {
	            		// Valido o tipo do Plano
	            		// if(strpos($plano['codigo'], '.')){
	            		// 	$aux = explode('.', $plano['codigo']);
	            		// 	$plano['tipo_plano'] = $aux[0];
	            		// }else{
	            		// 	$plano['tipo_plano'] = $plano['codigo'];
	            		// }

	            		$query = mysqli_query($db, "INSERT INTO `const_tarefas`(`codigo`, `titulo`) VALUES ('".$plano['codigo']."','".$plano['descricao']."' )");


	            		array_push($retorno['ok'], $registro);
	            	}else{  

	                    // Insere as linha incorretas na tabela de erros
	            		for($i = 0; $i <= count($linha) ; $i++){
	            			if($i == count($linha)){
	            				$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i].$aux_erro."", $problema);
	            				break;
	            			}
	            			$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i].$aux_erro."", $linha[$i]);
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

	function grava_planilha_cotacao($arquivo, $cotacao, $fornecedor){
		include "conexao.php";

		$retorno["ok"] = Array();

			    // If you need to parse XLS files, include php-excel-reader
		require('spreadsheet-reader-master/PHPExcel.php');
		require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
		require('spreadsheet-reader-master/SpreadsheetReader.php');


		$tabela_erro = new PHPExcel();
		$colunas = ["A", "B", "C", "D", "E", "F"];

	    $Reader = new SpreadsheetReader($arquivo); // Crio o objeto do arquivo
	    $Sheets = $Reader -> Sheets(); // Obtenho as planilhas do arquivo

	    foreach ($Sheets as $Index => $Name){// Para percorrer as planilhas do arquivo

	        $aux_erro = 2; // linha que eu começo a escrever na planilha de erro
	        $Reader -> ChangeSheet($Index);  // Habilito a página atual para edição

	        foreach ($Reader as $registro => $linha ){  //Para percorrer as linhas dentro da planilha

				// echo ('reg'. $registro);
	        	$cont = 0;

	            //Verifico se a linha está completamente vazia 
	        	foreach ($linha as $valor) {

	        		if(empty($valor)){
	        			$cont++;
	        		}
				}



	            //Se a linha estiver vazia o script para a varredura
	        	if($cont == 4 && $registro > 1){
	        		break;
	        	}

	            //Esse bloco verifica o titulo da planilha
	        	if ($registro == 0) {
	        		$aux = 0;
	        		foreach ($linha as $valor) {
	        			if ($valor == "PLANILHA DE COTAÇÃO") {
	        				$aux = 1;
	        			}
	        		}
	        		if ($aux != 1) {
	        			break;
	        		}
	        	}

	            // escrevo na planilha de erro as colunas
	        	if($registro == 1){
	        		for($i = 0; $i <= count($linha); $i++){
	        			if($i == count($linha)){
	        				$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", "Problema(s)");
	        				break;
	        			}
	        			$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", $linha[$i]);
	        		}
	        	}


	            // Verifico se já passou as linhas de informação no começo do arquivo
	        	if ($registro > 1){

	                // Validação dos dados da linha atual, segue abaixo os Index de cada coluna dentro da $linha

	                // Código = 0                             
	                // Descrição = 1                                    
	                // Categoria = 2             
	                // Espécie = 3                              
	                /*
	            	if($registro == 7){
	            		var_dump($linha);
	            		die();
	            	}*/

	            	$problema = '';
	            	$plano = null;
	            	$valida = 1;
	            	$today = date("d-m-Y"); 

					// echo ( ' te antes '. $t);
					// echo count($linha);
	            	for($t=0; $t<count($linha); $t++){


						// ta dando muita merda vo refazer
						if($linha[1]){
							$val= formata_valor($linha[1]);
						}
						
	                    // Validação do Descricao do insumo
	            		if ($t == 0) {
							// echo($linha[$t]);
							


	            			if (empty($linha[$t])) {
	            				$valida = 0;
								$problema .= 'Descricao invalido';
								break;
								
	            			}else{
								$plano["descricao"] = addslashes($linha[$t]);
								// echo '<br></br>';
								// echo $plano['descricao'];
	            				if(busca_id_insumo($plano["descricao"])){
									
									$plano["id"] = busca_id_insumo($plano["descricao"]);
									// echo $plano['id'];
	            				}else{
									// echo 'falho';
	            					$valida = 0;
									$problema .= 'Insumo Não encontrado';
	            					break;
	            				}
	            			}
						}
						if($t == 1){

							// echo($linha[$t]);
							// echo '<br> valor linha </br>';
							// echo '<br> </br>';
							

	            			if (empty($linha[$t])) {
								$plano["valor_t"] = '0.0';
								
	            			}else{

								$valor = formata_valor($linha[$t]);
								// echo ('vlr ');


	            				//Pego a última data de atualização da tabela
        						$query =  mysqli_query($db, "SELECT STR_TO_DATE(data, '%d-%m-%Y') AS data_cot FROM `const_item_cotacao` WHERE `id_cotacao` = $cotacao ORDER BY data_cot DESC LIMIT 1")or die(mysqli_error($db));

        						if(mysqli_num_rows($query) > 0){
        							//Pego a data
        							$data_preocurada = mysqli_fetch_assoc($query);
        							$data_preocurada = date("d-m-Y", strtotime($data_preocurada['data_cot']));

        							//vejo se o item ja existe na requerida cotacao 
        							$query = mysqli_query($db, "SELECT * FROM `const_item_cotacao` WHERE `id_cotacao`= $cotacao AND `id_insumo`= ".$plano["id"]." AND `id_fornecedor`= $fornecedor AND `data`= '$data_preocurada' LIMIT 1")or die(mysqli_error($db));

        							if(mysqli_num_rows($query) > 0){
        								$assoc = mysqli_fetch_assoc($query);

        								//$plano["valor_t"] = ($valor * $assoc['quantidade']);
        								$plano["valor_t"] = $valor;
										$id = $assoc['id'];

										

        								$query = mysqli_query($db, "UPDATE `const_item_cotacao` SET `valor`= '".$plano["valor_t"]."' WHERE id = $id")or die(mysqli_error($db));

        								//Confirmo o registro
										array_push($retorno['ok'], $registro);

        							}else{
        								$valida = 0;
        								$problema .= 'Insumo nao consta na cotação!';
        								break;
        							}


        						}
	            			}
						}


					}
			
	            	
	            	
	            	if ($valida == 1) {
	            		/*
	            		var_dump($plano["valor_t"]);

	            		$query = mysqli_query($db, "DELETE FROM `const_item_cotacao` WHERE `id_cotacao` = $cotacao AND `id_insumo` = ".$plano["id"]."  AND `id_fornecedor`=$fornecedor  AND `data` = '$today'")or die(mysqli_error($db));

	            		$query = mysqli_query($db, "UPDATE `const_item_cotacao` SET `quantidade` = '".$plano["qnt"]."' WHERE `id_cotacao` = $cotacao AND `id_insumo`= ".$plano["id"]." AND `data`= '$today' ")or die(mysqli_error($db));

	            		$query = mysqli_query($db, "INSERT INTO `const_item_cotacao`(`id_cotacao`, `id_insumo`, `id_fornecedor`, `quantidade`, `valor`, `data`, `status`) VALUES ($cotacao,".$plano["id"].",$fornecedor,'".$plano['qnt']."','".$plano['valor_t']."','$today', 1)")or die(mysqli_error($db));



	            		array_push($retorno['ok'], $registro);
	            		*/
	            	}else{  

	                    // Insere as linha incorretas na tabela de erros
	            		for($i = 0; $i <= count($linha) ; $i++){
	            			if($i == count($linha)){
	            				$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i].$aux_erro."", $problema);
	            				break;
	            			}
	            			$tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i].$aux_erro."", $linha[$i]);
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

	// apagar e inserir os dados da tabela
	if(isset($_POST['nos_material'])){


		// id do orcamento
		$orcamento = $_POST['orcamento'];
		$nos_material = $_POST['nos_material'];
		$nos_tarefa = $_POST['nos_tarefa'];


		//Rotina para fazer a gravacao dos Materiais
		$query = mysqli_query($db, "DELETE FROM `tabela_orcamento` WHERE `id_orcamento` = $orcamento AND `status` = 1")or die(mysqli_error($db));;

		foreach($nos_material as $key => $value) {


			if(count($value) < 6){

				$value[1]= strtoupper($value[1]);

				$value[1] = addslashes($value[1]);

				if(empty($value[3]) && empty($value[4])){

					$query = mysqli_query($db, "SELECT id FROM `const_planocontas` WHERE `descricao` = '$value[1]' ")or die(mysqli_error($db));

					if(mysqli_num_rows($query) > 0){
						$aux_query = mysqli_fetch_assoc($query);

						$value[3] = $aux_query['id'];
						$value[4] = 1;

					}else{
						$query = mysqli_query($db, "INSERT INTO `const_temp`(`descricao`) VALUES ('$value[1]')")or die(mysqli_error($db));

						$value[3] = mysqli_insert_id($db);
						$value[4] = 3;

					}
				}

				//Status sempre 1, pois só salvo os itens cotados
				$query = mysqli_query($db, "INSERT INTO `tabela_orcamento`(`id_tarefa`, `quantidade`, `unidade`, `valor_unitario`, `id_orcamento`, `id_insumo_plano`, `tabela`, `status`) 
										 VALUES ('$value[0]', '' , '' , '' , $value[2] , $value[3], $value[4], 1)")or die(mysqli_error($db));
			}else{

				$value[1]= strtoupper($value[1]);

				$value[1] = addslashes($value[1]);

				if(empty($value[6]) && empty($value[7])){

					$query = mysqli_query($db, "SELECT id FROM `const_insumos` WHERE `descricao` = '$value[1]' ")or die(mysqli_error($db));

					if(mysqli_num_rows($query) > 0){
						$aux_query = mysqli_fetch_assoc($query);

						$value[6] = $aux_query['id'];
						$value[7] = 2;
					}else{
						$query = mysqli_query($db, "INSERT INTO `const_temp`(`descricao`) VALUES ('$value[1]')")or die(mysqli_error($db));

						$value[6] = mysqli_insert_id($db);
						$value[7] = 3;
					}
				}

				//Status sempre 1, pois só salvo os itens cotados
				$query = mysqli_query($db, "INSERT INTO `tabela_orcamento`(`id_tarefa`, `quantidade`, `unidade`, `valor_unitario`, `id_orcamento`, `id_insumo_plano`, `tabela`, `status`) 
										 VALUES ('$value[0]', '$value[2]' , '$value[3]' , '$value[4]' , $value[5] , $value[6], $value[7], 1)")or die(mysqli_error($db));
			}
		}


		//Rotina para fazer a gravação de Tarefas
		$query = mysqli_query($db, "DELETE FROM `const_item_tarefa_orcamento` WHERE `id_orcamento` = $orcamento AND `status` = 1")or die(mysqli_error($db));;

		foreach($nos_tarefa as $key => $value) {
			//var_dump(count($value));

			if(count($value) < 6){

				$value[1]= strtoupper($value[1]);

				$value[1] = addslashes($value[1]);

				if(empty($value[3]) && empty($value[4])){

					$query = mysqli_query($db, "SELECT id FROM `const_planocontas` WHERE `descricao` = '$value[1]' ")or die(mysqli_error($db));

					if(mysqli_num_rows($query) > 0){
						$aux_query = mysqli_fetch_assoc($query);

						$value[3] = $aux_query['id'];
						$value[4] = 1;
					}else{
						$query = mysqli_query($db, "INSERT INTO `const_temp`(`descricao`) VALUES ('$value[1]')")or die(mysqli_error($db));

						$value[3] = mysqli_insert_id($db);
						$value[4] = 3;
					}
				}

				//echo "1";
				$aux = "INSERT INTO `const_item_tarefa_orcamento`(`id_tarefa`, `quantidade`, `unidade`, `valor_unitario`, `id_orcamento`, `id_tarefa_plano`, `tabela`, `status`) VALUES ('$value[0]','','','',$value[2], $value[3], $value[4], 1)";

				//echo $aux;
				//Status sempre 1, pois só salvo os itens cotados
				$query = mysqli_query($db, "INSERT INTO `const_item_tarefa_orcamento`(`id_tarefa`, `quantidade`, `unidade`, `valor_unitario`, `id_orcamento`, `id_tarefa_plano`, `tabela`, `status`) VALUES ('$value[0]','','','',$value[2], $value[3], $value[4], 1)")or die(mysqli_error($db));

				

			}else{

				$value[1]= strtoupper($value[1]);

				$value[1] = addslashes($value[1]);

				if(empty($value[6]) && empty($value[7])){

					$query = mysqli_query($db, "SELECT `id` FROM `const_tarefas` WHERE `titulo` = '$value[1]' ")or die(mysqli_error($db));

					if(mysqli_num_rows($query) > 0){
						$aux_query = mysqli_fetch_assoc($query);

						$value[6] = $aux_query['id'];
						$value[7] = 2;
					}else{
						$query = mysqli_query($db, "INSERT INTO `const_temp`(`descricao`) VALUES ('$value[1]')")or die(mysqli_error($db));

						$value[6] = mysqli_insert_id($db);
						$value[7] = 3;
					}
				}

				echo "2";
				//Status sempre 1, pois só salvo os itens cotados
				$query = mysqli_query($db, "INSERT INTO `const_item_tarefa_orcamento`(`id_tarefa`, `quantidade`, `unidade`, `valor_unitario`, `id_orcamento`, `id_tarefa_plano`, `tabela`, `status`) VALUES ('$value[0]', '$value[2]' , '$value[3]' , '$value[4]' , $value[5] , $value[6], $value[7], 1)")or die(mysqli_error($db));
				
			}
		}

		monta_json($orcamento);
	}	

	// Cadastra um novo orçamento
	if(isset($_POST['plano_desc'])){

		$aux = $_POST['plano_desc'];

		$aux[0] = sanitizeString($aux[0]);


		$query = mysqli_query($db, "INSERT INTO `const_orcamento`( `titulo`, `id_empreendimento`, `status_editar`, `data_finalizado`) VALUES ('$aux[0]', $aux[2], 1, '') ")or die(mysqli_error($db));

		$aux = mysqli_insert_id($db);

		echo json_encode($aux);
	}

	// Finaliza um orçamento aberto
	if(isset($_POST['id_orc']) && isset($_POST['editable'])){
		$id_orc = $_POST['id_orc'];
		$editable = $_POST['editable'];

		$query = mysqli_query($db, "SELECT * FROM const_orcamento WHERE id = $id_orc AND status_editar = $editable")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$today = date("d-m-Y");  

			//echo json_encode($today);

			$query = mysqli_query($db, "UPDATE const_orcamento SET status_editar = 0, data_finalizado = '$today' WHERE id = $id_orc")or die(mysqli_error($db));

			echo json_encode('1');
		}else{
			echo json_encode('0');
		}
	}

	// Remonto o Json de acordo com o id do orçamento
	if(isset($_POST['id_orcamento'])){
		$id_orcamento = $_POST['id_orcamento'];

		monta_json($id_orcamento);
	}

	//Rotina para listar os orçamentos de acordo com o empreendimento selecionado
	if(isset($_POST['lista_orcamento'])){

		$id = $_POST['lista_orcamento'];

		$query = mysqli_query($db, "SELECT const_orcamento.id, const_orcamento.titulo, const_orcamento.status_editar, const_orcamento.data_finalizado FROM const_orcamento INNER JOIN const_sub_empreendimento ON const_orcamento.id_empreendimento = const_sub_empreendimento.id WHERE `const_sub_empreendimento`.`id_empreendimento` = $id")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {
				$dados[] = $assoc;
			}

			echo json_encode($dados);
				
		}else{
			echo json_encode(0);
		}
	}

	//Rotina para listar todos sub-empreendimentos na hora de cadastrar um novo orçamento
	if(isset($_POST['lista_sub_empre'])){

		$empreendimento = $_POST['lista_sub_empre'];



		$query = mysqli_query($db, "SELECT * FROM `const_sub_empreendimento` WHERE `id_empreendimento` = $empreendimento")or die(mysqli_error($db));

		if(mysqli_num_rows($query) > 0){
			$dados = [];

			while ($assoc = mysqli_fetch_assoc($query)) {

				$query_aux = mysqli_query($db, "SELECT * FROM `const_orcamento` WHERE `id_empreendimento` = ".$assoc['id']."")or die(mysqli_num_rows($db));

				if(!mysqli_num_rows($query_aux)){
					$dados[] = $assoc;
				}
			}

			echo json_encode($dados);
				
		}else{
			echo json_encode(0);
		}
	}

	//Rotina para adicionar uma nova tarefa
	if(isset($_POST['adiciona'])){

		$cod = $_POST['adiciona'][0];
		$titulo = addslashes($_POST['adiciona'][1]);

		$query = mysqli_query($db, "INSERT INTO `const_tarefas`(`codigo`, `titulo`) VALUES ('$cod', '$titulo')")or die(mysqli_error($db));

		echo json_encode(mysqli_insert_id($db));
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