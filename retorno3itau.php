	<tr>
		<td>
			<?php 
			$nome_cliente_buscado = nome_user($dados_parcela_retorno["cliente_id_novo"]);

			if($nome_cliente_buscado == ''){
				$bg_color = 'danger';
			}

			if($dados_parcela_retorno["situacao"] != 'Pago' AND $nome_cliente_buscado != ''){ ?>
			<input type="checkbox" name="idparcelas[]" value="<?php echo $nosso_numero_buscar ?>">
			<?php } ?>
		</td>
		<td class="<?php echo $bg_color;?>"><div align="center">&nbsp;<?php
 if($dados_parcela_retorno["situacao"] != 'Pago'  AND $nome_cliente_buscado != ''){ 
$new_data_form = datacx_databr($data_ocorrencia);
$new_data_form =str_replace("/","-",$new_data_form);
		$dados_gerais["idparcelas"] = $nosso_numero_buscar;
		$dados_gerais["data_pagamento"] = $data_ocorrencia;
		$dados_gerais["valor_pago"] = $valor_pago;
		$dados_gerais["acrescimos"] = $juros_multa;
		$dados_gerais["descontos"] = $desconto;

$_SESSION["dados_gerais".$nosso_numero_buscar] = $dados_gerais;
}
echo $nosso_numero_buscar;
		?>&nbsp;</div>


		<input type="hidden" name="baixado_por" value="<?php echo $imobiliaria_idimobiliaria ?>">

	</td>
		<td class="<?php echo $bg_color;?>"><div align="center"><?php echo $cod_movimento; echo "<br>".$xfrase_movimento;?></div></td>
		<td class="<?php echo $bg_color;?>"><div align="center"><?php echo $cod_motivo; echo "<br>".$frase_motivo;?></div></td>
		<td class="<?php echo $bg_color;?>"><div align="left">
		<?php
			if($nome_cliente_buscado == ''){
				echo "CLIENTE NÃO ENCONTRADO";
			}else{
			echo $nome_cliente_buscado;
			} ?></div></td>
		<td class="<?php echo $bg_color;?>"><div align="center"><?php echo datacx_databr($vencimento);?></div></td>
		<td class="<?php echo $bg_color;?>"><div align="center"><?php echo datacx_databr($data_ocorrencia); ?></div></td>
		<td class="<?php echo $bg_color;?>"><div align="right"><?php echo php_fnumber($dados_parcela_retorno["valor_parcelas"]); $total_valor_nominal+=$valor_nominal;?></div></td>
		<td class="<?php echo $bg_color;?>"><div align="right"><?php echo php_fnumber($valor_pago); $total_valor_pago+=$valor_pago;?></div></td>
		<td class="<?php echo $bg_color;?>"><div align="right"><?php echo $juros_multa; $total_juros_multa+=$juros_multa;?></div></td>
		<td class="<?php echo $bg_color;?>"><div align="right"><?php echo php_fnumber($desconto); $total_desconto+=$desconto;?></div></td>
	</tr>
