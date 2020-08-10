<?php 

function verifica_quadra($quadra, $empreendimento){
    include "conexao.php";

    $query = mysqli_query($db, "SELECT idproduto FROM produto WHERE empreendimento_idempreendimento = '$empreendimento' AND quadra = '$quadra' ");

    $executa_query = mysqli_fetch_assoc($query);

    if(empty($executa_query)){
        return false;
    }else{
        return $executa_query['idproduto'];
    }
}

function formata_lote($lote){
    $aux = strlen($lote);

    for($i = 1; $i < 10; $i++){
        $aux1 = str_replace(('-'.$i), ('-0'.$i), $lote);

        if(strlen($aux1) > $aux){
            break;
        }
    }
    return $aux1;
}

function formata_m2($m2){
    return str_replace(',', '.', $m2);
}

function formata_valor($valor){
    $aux = explode(" ", $valor);

/*    $aux = explode(".", $aux[1]);

    $aux = str_replace('.', '', $aux[0]);
    $aux = str_replace(',', '.', $aux);*/

    return $aux[1];
}


function grava_planilha_lote($arquivo, $empreendimento){// Passando o caminho do arquivo

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
			if($cont == 10 && $registro !== 2 && $registro !== 1){
				break;
			}

			//Esse bloco verifica o titulo da planilha
			if ($registro == 0) {
				$aux = 0;
				foreach ($linha as $valor) {
    				if ($valor == "TABELA PARA CADASTRO DE LOTES") {
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
    			// quadra = 0			endereco = 6							
    			// lote = 1				matricula = 7					
    			// m2 = 2				cadastro_prefeitura = 8						
    			// valor = 3			Confrontacao_texto = 9	
    			// status = 4			
    			// esquina = 5				
    			

    			$lote;
    			$valida = 1;
    			for($i = 0; $i < count($linha); $i++){

    				// Validação da quadra
    				if ($i == 0) {	
    					if (empty($linha[$i])) {
    						$valida = 0;
    						break;
    					}else{
    						$lote['quadra'] = formata_lote($linha[$i]);
    					}
    				}

    				// Validação do Lote
    				elseif ($i == 1) {
    					if (empty($linha[$i])) {
    						$valida = 0;
    						break;
    					}else{
                            $lote['lote'] = formata_lote($linha[$i]);
                        }
    				}

    				// armazenamento m²
    				elseif ($i == 2) {
    					if (empty($linha[$i])) {
                            $valida = 0;
                            break;
                        }else{
                            $lote['m2'] = formata_m2($linha[$i]);
                        }
    				}

    				// armazenamento valor do lote
    				elseif ($i == 3) {
    					if (empty($linha[$i])) {
                            $valida = 0;
                            break;
                        }else{
                            $lote['valor'] = formata_valor($linha[$i]);
                            $lote['valor'] = number_format($lote['valor'], 2, '.', '');
                        }
    				}
                    
    				// armazenamento Status do lote
    				elseif ($i == 4) {
    					if (empty($linha[$i] )) { // para nenhum valor inserido o valor 0 é atribuido a variavel.
    					   $lote['status'] = '0';
                        }elseif($linha[$i] >= 0 && $linha[$i] <= 3){
                            $lote['status'] = $linha[$i];
                        }else{
                            $valida = 0;
                            break;
                        }
    				}

    				// armazenamento esquina lote
    				elseif ($i == 5) {
    					if (!empty($linha[$i])) {
    						$lote["esquina"] = utf8_decode($linha[$i]);
    					}else{
    						$lote["esquina"] = "";
    					}
    				}

    				// armazenamento endereço do lote
    				elseif ($i == 6) {
    					if (!empty($linha[$i])) {
    						$lote["endereco"] = utf8_decode($linha[$i]);
    					}else{
    						$lote["endereco"] = "";
    					}
    				}

    				// armazenamento matricula do lote
    				elseif ($i == 7) {
    					if (!empty($linha[$i])) {
    						$lote["matricula"] = utf8_decode($linha[$i]);
    					}else{
    						$lote["matricula"] = "";
    					}
    				}

    				// armazenamento cadastro prefeitura do lote
    				elseif ($i == 8) {
    					if (!empty($linha[$i])) {
    						$lote["cadastro_prefeitura"] = utf8_decode($linha[$i]);
    					}else{
    						$lote["cadastro_prefeitura"] = "";
    					}
    				}

    				// armazenamento confrontação do lote
    				elseif ($i == 9) {
    					if (!empty($linha[$i])) {
    						$lote["confrontacao"] = utf8_decode($linha[$i]);
    					}else{
    						$lote["confrontacao"] = "";
    					}
    				}
    			}
                
    			if ($valida == 1) {
                    // Faço a verificação se o lote já existe no banco de dados
    				if(verifica_quadra($lote['quadra'], $empreendimento) == false){
                        $query = mysqli_query($db, "INSERT INTO `produto`(`empreendimento_idempreendimento`, `quadra`) VALUES ($empreendimento ,'".$lote['quadra']."')");
                        $id_lote = verifica_quadra($lote['quadra'], $empreendimento);
                    }else{
                        $id_lote = verifica_quadra($lote['quadra'], $empreendimento);
                    }

                    $query = mysqli_query($db, "INSERT INTO `lote`(`lote`, `m2`, `valor`, `produto_idproduto`, `status`, `frente`, `fundo`, `direita`, `esquerda`, `esquina`, `endereco`, `matricula`, `cadastro_prefeitura`, `confrontacao`, `cx`, `cy`,`mld`, `mle`, `mfrente`, `mfundo`, `coutros`, `moutros`) 
                                                VALUES (".$lote['lote'].",'".$lote['m2']."','".$lote['valor']."','$id_lote','".$lote['status']."', 0, 0, 0, 0,'".$lote['esquina']."','".$lote['endereco']."','".$lote['matricula']."','".$lote['cadastro_prefeitura']."','".$lote['confrontacao']."','','', '', '', '', '', '', '')");
                    array_push($retorno['ok'], $registro);
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
