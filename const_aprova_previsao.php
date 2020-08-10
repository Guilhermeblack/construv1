<?php 

	// var_dump($_POST);
	// die();
	
	include "conexao.php";
	$user = $_POST['user'];
	$parcelas_previsao = $_POST['dados'][0];
	$valida = 1;
	$_MASTER['fornecedor'] = 0;

	foreach ($parcelas_previsao as $qnt_parcelas => $value) {
		
		$query = mysqli_query($db, "SELECT CP.fornecedor_idfornecedor, CP.empreendimento_id FROM contrato_pagar AS CP INNER JOIN parcelas ON CP.idcontrato_pagar = parcelas.venda_idvenda WHERE parcelas.idparcelas = $value")or die(mysqli_error($db));

		if(mysqli_num_rows($query)){
			while ($assoc = mysqli_fetch_assoc($query)) {
				
				if($_MASTER['fornecedor'] == 0){
					$_MASTER['fornecedor'] = $assoc['fornecedor_idfornecedor'];
					$_MASTER['empreendimento'] = $assoc['empreendimento_id'];
				}else{
					if($_MASTER['fornecedor'] != $assoc['fornecedor_idfornecedor']){
						$valida = 0;
						break;
					}
				}

			}
		}
	}
	
	//CONTINUAR DAQUI PARA FAZER A VALIDACAO SE TODAS AS PARCELAS SAO REFERENTES A UM UNICO FORNECEDOR
	if($valida == 1){

		foreach ($parcelas_previsao as $qnt_parcelas => $value) {
			
			$query = mysqli_query($db, "UPDATE `parcelas` SET `fluxo`= 666 WHERE `idparcelas` = $value")or die(mysqli_error($db));
		}

		$data = date('d-m-Y');

		foreach ($_POST['dados'] as $key => $value) {
			if($key > 0){

				//Tratativa dos valores
				$value['Valor_parcela'] = explode("R$", $value['Valor_parcela']);
				$value['desconto'] = explode("R$", $value['desconto']);
				$value['acrescimo'] = explode("R$", $value['acrescimo']);
				
				$value['acrescimo'] = str_replace(',','.',  substr($value['acrescimo'][1], 2));
				$value['desconto'] = str_replace(',','.',  substr($value['desconto'][1], 2));
				$value['Valor_parcela'] = str_replace(',','.',  substr($value['Valor_parcela'][1], 2));

				$value['venc_parcela'] = date("d-m-Y", strtotime($value['venc_parcela'])); 

				if($key == 1){
					//Insert na contrato_pagar
					$query = mysqli_query($db, "INSERT INTO `contrato_pagar`( `fornecedor_idfornecedor`, `data_vencimento`, `qtd_parcelas`, `valor_parcelas`, `data_lancamento`, `centrocusto_id`, `empreendimento_id`, `quadra_id`, `lote_id`, `tipo_venda`, `imovel_id`, `insumo_id`, `insumo_especie`, `insumo_familia`, `insumo_categoria`, `insumo_descricao`) 
											VALUES (".$_MASTER['fornecedor'].", '".$value['venc_parcela']."','$qnt_parcelas','".$value['Valor_parcela']."','".$data."',0,".$_MASTER['empreendimento'].",0,0,3,0,0,0,0,0,0)")or die(mysqli_error($db));
					$id_contrato_pagar = mysqli_insert_id($db);
				}


				for ($i=0; $i < $value['qnt_parcela']; $i++) { 

					if($i > 0){
						$value['venc_parcela'] = date('d-m-Y', strtotime("+".$value['intervalo']." days",strtotime($value['venc_parcela'])));
					}
					

					$query = mysqli_query($db, "INSERT INTO `parcelas`( `venda_idvenda`, `valor_parcelas`, `data_vencimento_parcela`, `situacao`, `descricao`, `remessa`, `data_remessa`, `tipo_venda`, `numero_sequencia`, `repasse_feito`, `data_recebimento`, `valor_recebido`, `desc_parcela`, `acre_parcela`, `forma_pagamento`, `fluxo`, `centrocusto_id`, `codigo_repasse`, `contacorrente_id`, `folhacheque_id`, `empreendimento_id_novo`, `cliente_id_novo`, `cod_baixa`, `obs_estorno`, `estornado_por`, `data_lancamento_sistema`, `lancamento_por`, `baixado_por`, `data_baixa`, `vinculo`, `data_boleto`, `numero_boleto`, `juros_mora`, `juros_multa`, `juros_outros`, `obs_caldas`, `nosso_numero_old`, `obs_parcela`, `import_mora`, `import_multa`) 
						VALUES ($id_contrato_pagar,'".$value['Valor_parcela']."', '".$value['venc_parcela']."', 'Em Aberto','Contas a Pagar',0,'',3,'',0,'','','".$value['desconto']."','".$value['acrescimo']."','',1,0,0,0,0,".$_MASTER['empreendimento'].",".$_MASTER['fornecedor'].",'','',0,'$data',$user,0,'','','','','','','','','','','','')")or die(mysqli_error($db));
				}
			}
		}

		echo json_encode(1);
	}else{
		echo json_encode(0);
	}


 ?>