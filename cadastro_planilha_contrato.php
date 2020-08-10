<?php 

//Query para selecionar todos os dados da tabela lote.
/*
SELECT * FROM `lote` 
INNER JOIN produto ON lote.produto_idproduto = produto.idproduto
INNER JOIN empreendimento ON empreendimento.idempreendimento = produto.empreendimento_idempreendimento
WHERE lote.lote = 9 AND produto.idproduto = 29 AND empreendimento.idempreendimento = 4
*/

// Query para recuperar o nome do empreendimento
/*SELECT * FROM `empreendimento` 
INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
WHERE idempreendimento = 4  */



/*

    Fazer a validação dos lotes e quadras de 1-9

*/
function consulta_imobiliaria($imobliaria){
    include "conexao.php";

    $query = mysqli_query($db, "SELECT idcliente FROM `cliente` WHERE `nome_cli`= '$imobliaria' ")or die(mysqli_error($db));

    $executa_query = mysqli_fetch_assoc($query)or die(mysqli_error($db));

    if(!empty($executa_query)){
        return $executa_query['idcliente'];
    }else{
        return false;
    }

    mysqli_close($db);
}

function consulta_quadra($empreendimento, $quadra){
    include "conexao.php";

    $query = mysqli_query($db, "SELECT produto.idproduto FROM produto
                                INNER JOIN empreendimento ON empreendimento.idempreendimento = produto.empreendimento_idempreendimento
                                WHERE produto.quadra ='$quadra' AND empreendimento.idempreendimento = '$empreendimento'  ")or die(mysqli_error($db));

    $executa_query = mysqli_fetch_assoc($query)or die(mysqli_error($db));

    if(!empty($executa_query)){
        return $executa_query['idproduto'];
    }else{
        return false;
    }
    mysqli_close($db);
}

function consulta_lote($empreendimento, $quadra, $lote){
    include "conexao.php";

    $query = mysqli_query($db, "SELECT lote.idlote FROM lote INNER JOIN produto 
                                ON produto.idproduto = lote.produto_idproduto INNER JOIN empreendimento 
                                ON empreendimento.idempreendimento = produto.empreendimento_idempreendimento 
                                WHERE lote.lote = $lote AND produto.idproduto = $quadra AND empreendimento.idempreendimento = $empreendimento ")or die(mysqli_error($db));

    $executa_query = mysqli_fetch_assoc($query)or die(mysqli_error($db));

    if(!empty($executa_query)){
        return $executa_query['idlote'];
    }else{
        return false;
    }
    mysqli_close($db);
}

function consulta_cliente($cliente){
    include "conexao.php";
    
    $query = mysqli_query($db, "SELECT idcliente FROM `cliente` WHERE `nome_cli`= '$cliente' ")or die(mysqli_error($db));

    $executa_query = mysqli_fetch_assoc($query)or die(mysqli_error($db));

    if(!empty($executa_query)){
        return $executa_query['idcliente'];
    }else{
        return false;
    }
    mysqli_close($db);

}

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

function formata_valor($valor){
    $aux = explode(" ", $valor);

    $aux = explode(".", $aux[1]);

    //OBS: vard_dump na $linha para ver como vem a informação
    //$aux = str_replace('.', '', $aux[0]);
    //$aux = str_replace(',', '', $aux[1]);

    $aux = number_format($aux[0], 2, '.', '');

    return $aux;
}

function formata_quadra_lote($quadra){

    if($quadra > 0 && $quadra < 10){
        $aux = $quadra;

        $quadra = '0'.$aux;
    }

    return $quadra;
}

function formata_percentual($taxa){
    $aux = str_replace('%', '', $taxa);
    $aux = str_replace(',', '.', $aux);

    return $aux;
}

function consulta_venda($lote, $quadra, $cliente){
    include "conexao.php";

    $aux = mysqli_query($db, "SELECT idvenda FROM `venda` 
                                INNER JOIN cliente ON cliente.idcliente = venda.cliente_idcliente
                                INNER JOIN produto ON produto.idproduto = venda.produto_idproduto
                                INNER JOIN lote ON lote.idlote = venda.lote_idlote
                                WHERE cliente.idcliente = $cliente AND produto.idproduto = $quadra AND lote.idlote = $lote")or die(mysqli_error($db));

    $executa_query = mysqli_fetch_assoc($aux)or die(mysqli_error($db));

    if(!empty($executa_query)){
        return $executa_query['idvenda'];
    }else{
        return false;
    }
    mysqli_close($db);
}

function consulta_empreendimento($empreendimento){
    include "conexao.php";

    $query = mysqli_query($db, "SELECT `empreendimento_cadastro_id` FROM `empreendimento` WHERE `idempreendimento` = $empreendimento")or die(mysqli_error($db));

    $executa_query = mysqli_fetch_assoc($query)or die(mysqli_error($db));

    if(!empty($executa_query)){
        return $executa_query['empreendimento_cadastro_id'];
    }else{
        return false;
    }
    mysqli_close($db);
}

function grava_planilha_parcela($arquivo, $empreendimento){// Passando o caminho do arquivo
    

    include "conexao.php";

    $retorno["ok"] = Array();

    // If you need to parse XLS files, include php-excel-reader
    require('spreadsheet-reader-master/PHPExcel.php');
    require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
    require('spreadsheet-reader-master/SpreadsheetReader.php');


    $tabela_erro = new PHPExcel();
    $colunas = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X"];

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
            if($cont == 20 && $registro > 3){
                break;
            }

            //Esse bloco verifica o titulo da planilha
            if ($registro == 0) {
                $aux = 0;
                foreach ($linha as $valor) {
                    if ($valor == "TABELA PARA CADASTRO DE PARCELAS") {
                        $aux = 1;
                    }
                }
                if ($aux !== 1) {
                    break;
                }
            }
            if($registro == 3){
                for($i = 0; $i <= count($linha); $i++){
                    if($i == count($linha)){
                        $tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", "Problema(s)");
                        break;
                    }
                    $tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", $linha[$i]);
                }
            }

        
            // Verifico se já passou as linhas de informação no começo do arquivo
            if ($registro > 4){

                // Validação dos dados da linha atual, segue abaixo os Index de cada coluna dentro da $linha

                // Cliente = 0               Valor recebido = 7               
                // Quadra = 1                Valor desconto = 8                     
                // Lote = 2                  Valor Acréscimo = 9        
                // Número sequencia = 3                              
                // Valor parcela = 4                 
                // Data vencimento = 5                           
                // Data de recebimento = 6   
                $problema = '';
                $parcela;
                $valida = 1;
                for($i = 0; $i < count($linha); $i++){

                    // Validação do cliente
                    if ($i == 0) {  
                        if (empty($linha[$i])) {
                            $valida = 0;
                            break;

                        }elseif (consulta_cliente($linha[$i]) !== false) {
                            $parcela['cliente'] = consulta_cliente($linha[$i]);
                        }else{
                            $problema .= "Cliente Não encontrado";
                            $valida = 0;
                            break;                                
                        }
                    }

                    // Validação da quadra
                    elseif ($i == 1) {
                        if (empty($linha[$i])) {
                            $problema .= "Quadra Não preenchida";
                            $valida = 0;
                            break;
                        }else{
                            $aux = formata_quadra_lote($linha[$i]);
                        }

                        if (consulta_quadra($empreendimento, $aux) !== false) {
                            $parcela['quadra'] = consulta_quadra($empreendimento, $aux);
                        }else{
                            $problema .= "Quadra Não encontrada";
                            $valida = 0;
                            break;  
                        }
                    }

                    // Validação do lote
                    elseif ($i == 2) {
                        if(empty($linha[$i])){
                            $problema .= "Lote Não preenchido";
                            $valida = 0;
                            break; 
                        }else {
                            $aux = formata_quadra_lote($linha[$i]);
                        }

                        if (consulta_lote($empreendimento, $parcela['quadra'], $aux) !== false) {           // faço a validação do lote mediante ao id do 
                            $parcela['lote'] = consulta_lote($empreendimento, $parcela['quadra'], $aux);    // empreendimento, id da quadra e o nome do lote !
                        }else{
                            $problema .= "Lote Não encontrado";
                            $valida = 0;
                            break; 
                        }
                    }

                    // Armazenamento numero sequencia
                    elseif ($i == 3) {
                        if (!empty($linha[$i])) {
                            $parcela['numero_seq'] = $linha[$i];
                        }else{
                            $parcela['numero_seq'] = '';
                        }
                    }

                    // Armazenamento Valor da Parcela
                    elseif ($i == 4) {
                        if (empty($linha[$i])) {
                            $valida = 0;
                            break;
                        }else{
                            $parcela['valor_parcela'] = formata_valor($linha[$i]);
                        }
                           
                    }

                    // Validação data vencimento parcela
                    elseif ($i == 5) {
                        if (!empty($linha[$i])) {
                            $parcela['data_vencimento'] = formata_data($linha[$i]);
                        }else{
                            $valida = 0;
                            break;
                        }
                    }

                    // Armazenamento data Recebimento da parcela
                    elseif ($i == 6) {
                        if (!empty($linha[$i])) {
                            $parcela['data_recebimento'] = formata_data($linha[$i]);
                        }else{
                            $parcela['data_recebimento'] = '';
                        }
                    }

                    // armazenamento Valor recebido
                    elseif ($i == 7) {
                        if (!empty($linha[$i])) {
                            $parcela['valor_recebido'] =formata_valor($linha[$i]);
                        }else{
                            $parcela['valor_recebido'] = '';
                        }
                    }

                    // armazenamento Desconto R$
                    elseif ($i == 8) {
                        if (!empty($linha[$i])) {
                            $parcela['desconto'] = formata_valor($linha[$i]);
                        }else{
                            $parcela['desconto'] = '';
                        }
                    }

                    // armazenamento Acréscimo
                    elseif ($i == 9) {
                        if (!empty($linha[$i])) {
                            $parcela['acrescimo'] = formata_valor($linha[$i]);
                        }else{
                            $parcela['acrescimo'] = '';
                        }
                    }
                }

                // calculo outras variaveis para inserção no banco
                if ($valida == 1) {
                    // consulto a venda
                    if(consulta_venda($parcela['lote'], $parcela['quadra'], $parcela['cliente'] ) !== NULL ){
                        $parcela['id_venda'] = consulta_venda($parcela['lote'], $parcela['quadra'], $parcela['cliente'] );
                    }else{
                        $valida = 0;
                        $problema .= 'Venda não encontrada !';
                    }

                    // consulto a situação
                    if ((!empty($parcela['data_recebimento'])) || (!empty($parcela['valor_recebido']))) {
                        $parcela['situacao'] = 'Pago';
                    }else{
                        $parcela['situacao'] = 'Em Aberto';
                    }

                    //consulto o empreendimento_id_novo tabela parcelas
                    if(consulta_empreendimento($empreendimento) !== 0){
                        $parcela['id_empreendimento'] = consulta_empreendimento($empreendimento);
                    }else{
                        $parcela['id_empreendimento'] = '';
                    }
                }

                //var_dump($parcela);
                //die();

                if ($valida == 1) {
                    include "conexao.php";
                    $aux = mysqli_query($db, "INSERT INTO `parcelas`(`venda_idvenda`, `valor_parcelas`, `data_vencimento_parcela`, `situacao`, `descricao`, `remessa`, `data_remessa`, `tipo_venda`, `numero_sequencia`, `repasse_feito`, `data_recebimento`, `valor_recebido`, `desc_parcela`, `acre_parcela`, `forma_pagamento`, `fluxo`, `centrocusto_id`, `codigo_repasse`, `contacorrente_id`, `folhacheque_id`, `empreendimento_id_novo`, `cliente_id_novo`, `cod_baixa`, `obs_estorno`, `estornado_por`, `data_lancamento_sistema`, `lancamento_por`, `baixado_por`, `data_baixa`, `vinculo`, `data_boleto`, `numero_boleto`, `juros_mora`, `juros_multa`, `juros_outros`, `obs_caldas`, `nosso_numero_old`, `obs_parcela`, `import_mora`, `import_multa`) 
                                            VALUES ('".$parcela['id_venda']."','".$parcela['valor_parcela']."','".$parcela['data_vencimento']."','".$parcela['situacao']."','Financiamento', 0 ,'', 2,'".$parcela['numero_seq']."', 0,'".$parcela['data_recebimento']."','".$parcela['valor_recebido']."','".$parcela['desconto']."','".$parcela['acrescimo']."','' , 0, 0, 0, 0, 0, '".$parcela['id_empreendimento']."','".$parcela['cliente']."', 0, '', 0, '', 0, 10, '', '', '', '', '', '', '', '', '', '', '', '') ") or die(mysqli_error($db));
                    
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

function grava_planilha_venda($arquivo, $empreendimento){// Passando o caminho do arquivo

  include "conexao.php";

  $retorno["ok"] = Array();

    // If you need to parse XLS files, include php-excel-reader
    require('spreadsheet-reader-master/PHPExcel.php');
    require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
    require('spreadsheet-reader-master/SpreadsheetReader.php');


    $tabela_erro = new PHPExcel();
    $colunas = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X"];

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
      if($cont == 20 && $registro > 3){
        break;
      }

      //Esse bloco verifica o titulo da planilha
      if ($registro == 0) {
        $aux = 0;
        foreach ($linha as $valor) {
            if ($valor == "TABELA PARA CADASTRO DE CONTRATOS") {
              $aux = 1;
            }
        }
        if ($aux !== 1) {
          break;
        }
      }
      if($registro == 4){
        for($i = 0; $i <= count($linha); $i++){
                    if($i == count($linha)){
                        $tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", "Problema(s)");
                        break;
                    }
                    $tabela_erro->setActiveSheetIndex(0)->setCellValue("".$colunas[$i]."1", $linha[$i]);
        }
      }

    
      // Verifico se já passou as linhas de informação no começo do arquivo
      if ($registro > 5){

        // Validação dos dados da linha atual, segue abaixo os Index de cada coluna dentro da $linha

          // imobiliaria = 0           Entrada/Sinal = 7               Valor da parcela inter = 14
                // Quadra = 1                Entrada = 8                     Data 1 parcela = 15
                // Lote = 2                  Parcelamento Entrada = 9        Valor para financiamento = 16
                // Cliente = 3               Vencimento 1 = 10               Valor da Parcela fin = 17
                // Data da Venda = 4         Vencimento Restante = 11        Plano de pagamento = 18
                // Número da Ficha = 5       Periodo = 12                    Taxa = 19
                // Desconto = 6              Qntd Parcelas = 13


                //var_dump($linha);
                //die();
                $problema = '';
          $venda;
          $valida = 1;
          for($i = 0; $i < count($linha); $i++){

            // Validação da Imobiliaria
            if ($i == 0) {  
              if (empty($linha[$i])) {
                $valida = 0;
                break;

                        // Validação da imobiliaria no banco.
              }elseif (consulta_imobiliaria($linha[$i]) !== false) {
                            $venda['imobiliaria'] = consulta_imobiliaria($linha[$i]);
                        }else{
                            $problema .= "Imobiliaria Não encontrada";
                            $valida = 0;
                            break;                                
              }
            }

            // Validação da quadra
            elseif ($i == 1) {
              if (empty($linha[$i])) {
                $problema .= "Quadra Não encontrado";
                            $valida = 0;
                            break;
              }else{
                            $aux = formata_quadra_lote($linha[$i]);
                        }

                        if (consulta_quadra($empreendimento, $aux) !== false) {
                            $venda['quadra'] = consulta_quadra($empreendimento, $aux);
                        }else{
                            $problema .= "Quadra Não encontrada";
                            $valida = 0;
                            break;  
                        }
            }

            // Validação do lote
            elseif ($i == 2) {
                        if(empty($linha[$i])){
                            $problema .= "Lote Não encontrado";
                            $valida = 0;
                            break; 
                        }else {
                            $aux = formata_quadra_lote($linha[$i]);
                        }

                        if (consulta_lote($empreendimento, $venda['quadra'], $aux) !== false) {
                            $venda['lote'] = consulta_lote($empreendimento, $venda['quadra'], $aux);
                        }else{
                            $problema .= "Lote Não encontrado";
                            $valida = 0;
                            break; 
                        }
            }

            // Validação Cliente
            elseif ($i == 3) {
              if (empty($linha[$i])) {
                            $valida = 0;
                            break;
                        }elseif (consulta_cliente($linha[$i]) !== false) {
                            $nome_cliente = $linha[$i];
                            $venda['cliente'] = consulta_cliente($linha[$i]);                             
                        }else{
                            $problema .= "Cliente Não encontrado";
                            $valida = 0;
                            break; 
                        }
                           
            }

            // Validação data Venda
            elseif ($i == 4) {
              if (empty($linha[$i])) {
                            $valida = 0;
                            break;
                        }else{
                            $venda['data_venda'] = formata_data($linha[$i]);
                        }
            }

            // armazenamento Número Ficha
            elseif ($i == 5) {
              if (!empty($linha[$i])) {
                $venda['numero_ficha'] = $linha[$i];
              }else{
                $venda['numero_ficha'] = '';
              }
            }

            // armazenamento Desconto
            elseif ($i == 6) {
              if (!empty($linha[$i])) {
                $venda['desconto'] = formata_percentual($linha[$i]);
              }else{
                $venda['desconto'] = '';
              }
            }

            // armazenamento Entrada/Sinal
            elseif ($i == 7) {
              if (!empty($linha[$i])) {
                $venda['entrada_sinal'] = formata_valor($linha[$i]);
              }else{
                $venda['entrada_sinal'] = '';
              }
            }

            // armazenamento Entrada
            elseif ($i == 8) {
              if (!empty($linha[$i])) {
                $venda['entrada'] = formata_valor($linha[$i]);
              }else{
                $venda['entrada'] = '';
              }
            }

            // armazenamento parcelamento Entrada
            elseif ($i == 9) {
              if (!empty($linha[$i])) {
                $venda['parcelamento_entrada'] = $linha[$i];
              }else{
                $venda['parcelamento_entrada'] = '';
              }
            }

                    // armazenamento vencimento primeira
                    elseif ($i == 10) {
                        if (!empty($linha[$i])) {
                            $venda['vencimento_primeira'] = formata_data($linha[$i]);
                        }else{
                            $venda['vencimento_primeira'] = '';
                        }
                    }

                    // armazenamento vencimento restante
                    elseif ($i == 11) {
                        if (!empty($linha[$i])) {
                            $venda['vencimento_restante'] = formata_data($linha[$i]);
                        }else{
                            $venda['vencimento_restante'] = '';
                        }
                    }

                    // armazenamento Periodo Inter
                    elseif ($i == 12) {
                        if (!empty($linha[$i])) {
                            $venda['periodo_inter'] = $linha[$i];
                        }else{
                            $venda['periodo_inter'] = '';
                        }
                    }

                    // armazenamento Qntd parcelas Inter
                    elseif ($i == 13) {
                        if (!empty($linha[$i])) {
                            $venda['qntd_parcelas_inter'] = $linha[$i];
                        }else{
                            $venda['qntd_parcelas_inter'] = '';
                        }
                    }

                    // armazenamento Valor Parcela Inter
                    elseif ($i == 14) {
                        if (!empty($linha[$i])) {
                            $venda['valor_parcela_inter'] = formata_valor($linha[$i]);
                        }else{
                            $venda['valor_parcela_inter'] = '';
                        }
                    }

                    // armazenamento data 1 parcela Inter
                    elseif ($i == 15) {
                        if (!empty($linha[$i])) {
                            $venda['data_primeira_inter'] = formata_data($linha[$i]);
                        }else{
                            $venda['data_primeira_inter'] = '';
                        }
                    }

                    // armazenamento Valor para financiamento
                    elseif ($i == 16) {
                        if (!empty($linha[$i])) {
                            $venda['valor_fin'] = formata_valor($linha[$i]);
                        }else{
                            $venda['valor_fin'] = '';
                        }
                    }

                    // armazenamento valor da parcela financiamento
                    elseif ($i == 17) {
                        if (!empty($linha[$i])) {
                            $venda['valor_parcela_fin'] = formata_valor($linha[$i]);
                        }else{
                            $venda['valor_parcela_fin'] = '';
                        }
                    }

                    // armazenamento plano de pagamento
                    elseif ($i == 18) {
                        if (!empty($linha[$i])) {
                            $venda['plano_pagamento'] = $linha[$i];
                        }else{
                            $venda['plano_pagamento'] = '';
                        }
                    }

                    // armazenamento Taxa fin
                    elseif ($i == 19) {
                        if (!empty($linha[$i])) {
                            $venda['taxa_fin'] = formata_percentual($linha[$i]);
                        }else{
                            $venda['taxa_fin'] = '';
                        }
                    }
          }

                    
          if ($valida == 1) {
                    include "conexao.php";
                    $aux = mysqli_query($db, "INSERT INTO `venda`(`imobiliaria_idimobiliaria`, `produto_idproduto`, `cliente_idcliente`, `numero_ficha`, `desconto`, `valor_desconto`, `valor_entrada`, `vencimento_primeira`, `valor_para_parcelamento`, `plano_pagamento`, `taxa_financiamento`, `data_venda`, `parcela_entrada`, `lote_idlote`, `vencimento_restante`, `status_venda`, `cliente_idcliente2`, `entrada_restante`, `libera_proposta`, `igpm`, `centrocusto_id`, `contacorrente`, `valor_parcela_financiamento`, `valor_parcela_entrada`, `cadastrado_por`, `inter_periodo`, `inter_qtd`, `inter_valor`, `inter_data`, `spc`) 
                                                VALUES ( '".$venda['imobiliaria']."', '".$venda['quadra']."', '".$venda['cliente']."', '".$venda['numero_ficha']."', '".$venda['desconto']."', '' , '".$venda['entrada_sinal']."', '".$venda['vencimento_primeira']."', '".$venda['valor_fin']."', '".$venda['plano_pagamento']."', '".$venda['taxa_fin']."', '".$venda['data_venda']."', '".$venda['parcelamento_entrada']."' , '".$venda['lote']."', '".$venda['vencimento_restante']."', 3, 0,'".$venda['entrada']."',NULL,'', 2 , 0 ,'".$venda['valor_parcela_fin']."','".$venda['entrada_sinal']."',0,'".$venda['periodo_inter']."','".$venda['qntd_parcelas_inter']."','".$venda['valor_parcela_inter']."','".$venda['data_primeira_inter']."', '')");
                    
                    //Rotina para pegar o ID do último elemento inserido na tabela venda, e insere na tabela venda.
                    $id_venda = mysqli_fetch_assoc(mysqli_query($db, "SELECT idvenda FROM venda ORDER BY idvenda DESC LIMIT 1"));
                    $id_venda = $id_venda['idvenda'];
    
                    $cod_cessao = date('YmdHis').$registro;

                    $aux = mysqli_query($db, "INSERT INTO `proprietarios_lote`(`venda_id`, `cliente_id`, `percentual`, `cod_cessao`, `situacao_cessao`) VALUES ('$id_venda','".$venda['cliente']."','','$cod_cessao','')" );                        
                    
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

?>
