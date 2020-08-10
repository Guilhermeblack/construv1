<?php ob_start();
 error_reporting(0);
ini_set(“display_errors”, 0 );
require_once("dompdf/dompdf_config.inc.php");
 
/* Cria a instância */
$dompdf = new DOMPDF();
 function busca_preco($idfornecedor, $idinsumo)
{

    include "../conexao.php";
    $query_amigo = "SELECT * FROM cotacao
                            where fornecedor_id = $idfornecedor AND insumo_id = $idinsumo 
                            order by id desc limit 1";
    $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar preco do fornecedor");
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
        $valorCusto             = $buscar_amigo["valorCusto"];
        
        }     
           return $valorCusto; 
             

}
  $html = " ";

           $lista_cotacao_id = $_GET["lista_cotacao"];
           $fornecedor_id    = $_GET["idcliente"];
             
                                  

                      include "../conexao.php";

            
            $query_fornecedor = "SELECT * FROM vencedor_cotacao
                                 INNER JOIN cliente ON vencedor_cotacao.fornecedor_id = cliente.idcliente
                                 WHERE lista_cotacao_id = $lista_cotacao_id AND fornecedor_id = $fornecedor_id
                                 group by fornecedor_id";
        
            $executa_fornecedor = mysqli_query ($db,$query_fornecedor) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_fornecedor = mysqli_fetch_assoc($executa_fornecedor)) {//--verifica se são amigos
               
                  $idlocador          = $buscar_fornecedor["idcliente"];
                  $nome_loc           = $buscar_fornecedor["nome_cli"];
                  $cpf_loc            = $buscar_fornecedor["cpf_cli"];
                  $rg_loc             = $buscar_fornecedor["rg_cli"];
                  $estadocivil_loc    = $buscar_fornecedor["estadocivil_cli"];
                  $nacionalidade_loc  = $buscar_fornecedor["nacionalidade_cli"];
                  $profissao_loc      = $buscar_fornecedor["profissao_cli"];
                  $nascimento_loc     = $buscar_fornecedor["nascimento_cli"];
                  $email_loc          = $buscar_fornecedor["email_cli"];
                  $cidade_loc         = $buscar_fornecedor["cidade_cli"];
                  $logradouro_loc     = $buscar_fornecedor["logradouro_cli"];
                  $endereco_loc       = $buscar_fornecedor["endereco_cli"];
                  $numero_loc         = $buscar_fornecedor["numero_cli"];
                  $complemento_loc    = $buscar_fornecedor["complemento_cli"];
                  $bairro_loc         = $buscar_fornecedor["bairro_cli"];
                  $complemento_loc    = $buscar_fornecedor["complemento_cli"];
                  $telefone1_loc      = $buscar_fornecedor["telefone1_cli"];
                  $telefone2_loc      = $buscar_fornecedor["telefone2_cli"];

                  $cep_loc            = $buscar_fornecedor["cep_cli"];
                  $estado_loc         = $buscar_fornecedor["estado_cli"];

          
         



$html .= "<table width='400' border='1' align='center'>
  <tbody>
    <tr>
      <td colspan='6' style='text-align: center; font-weight: BOLD;'>ORDEM DE FORNECIMENTO Nº </td>
    </tr>
    <tr>
      <td colspan='5'><span style='font-weight: bold'>Orgão Emissor</span>:<br>
     Immobile Business sistema de gestão imobiliario</td>
      <td width='194'><span style='font-weight: bold'>CNPJ:</span><br>
        12.132.456-0001-00
      </p></td>
    </tr>
    <tr>
      <td colspan='5'><span style='font-weight: bold'>Endereço:</span><br>
      Osório Arantes, 763 </td>
      <td><span style='font-weight: bold'>CEP:</span><br>
      14400-480</td>
    </tr>
    <tr>
      <td colspan='5'>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan='5'><span style='font-weight: bold'>Fornecedor</span><br>
     $nome_loc</td>
      <td><span style='font-weight: bold'>CNPJ:</span><br>
12.132.456-0001-00
  </p></td>
    </tr>
    <tr>
      <td colspan='5'><span style='font-weight: bold'>Endereço:</span><br>
        Osório Arantes, 763 </td>
      <td><span style='font-weight: bold'>CEP:</span><br>
        14400-480</td>
    </tr>
    <tr>
      <td colspan='5'>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan='5'><span style='font-weight: bold'>Data da Entrega:</span><br>
      01/11/2017 - As 17:00 hrs  </td>
      <td><span style='font-weight: bold'>Local da Entrega:</span><br>
Almoxarifado </td>
    </tr>
    <tr>
      <td colspan='6' style='text-align: center; font-weight: bold;'>Autorizamos o fornecimento dos materiais abaixo discriminados mediante condições constantes desta ORDEM DE FORNECIMENTO.</td>
    </tr>
    <tr>
      <td width='182' rowspan='2' style='text-align: center'>PRODUTO</td>
      <td width='35' rowspan='2' style='text-align: center'>UN</td>
      <td width='50' rowspan='2' style='text-align: center'>QTD</td>
      <td colspan='3' style='text-align: center'>PREÇO</td>
    </tr>
    <tr>
      <td colspan='2' style='text-align: center'>UNITÁRIO</td>
      <td style='text-align: center'>PREÇO  TOTAL</td>
    </tr>";

            $query_insumo  = "SELECT * FROM vencedor_cotacao
                                 INNER JOIN insumo ON vencedor_cotacao.insumo_id = insumo.id
                                 WHERE lista_cotacao_id = $lista_cotacao_id AND fornecedor_id = $fornecedor_id
                                 ";
        
            $executa_insumo = mysqli_query ($db,$query_insumo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_insumo = mysqli_fetch_assoc($executa_insumo)) {//--verifica se são amigos
               
                  $insumo_id          = $buscar_insumo["insumo_id"];
                  $descricao          = $buscar_insumo["descricao"];
                  $qtd_insumo_cotacao          = $buscar_insumo["qtd_insumo_cotacao"];
                  $un          = $buscar_insumo["un"];


                  $buscar_preco = busca_preco($fornecedor_id, $insumo_id);
                  $total = $qtd_insumo_cotacao * $buscar_preco;

                  $exibir_unitario =  'R$ ' . number_format($buscar_preco, 2, ',', '.'); 
                  $exibir_total    =  'R$ ' . number_format($total, 2, ',', '.'); 

    $html .="<tr>
      <td>$descricao</td>
      <td>$un</td>
      <td>$qtd_insumo_cotacao</td>
      <td colspan='2'>$exibir_unitario</td>
      <td>$exibir_total</td>
    </tr>";

}
  $html .="</tbody>
</table>";


}
/* Carrega seu HTML */
$dompdf->load_html($html);
 
/* Renderiza */
$dompdf->render();
 
/* Exibe */
$dompdf->stream(
    "saida.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);
?>
