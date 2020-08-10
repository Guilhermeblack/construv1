<?php  ob_start(); 
error_reporting(0);
ini_set(“display_errors”, 0 ); 

function fotologo($id){
  include "../conexao.php";
  $query_amigo = "SELECT * FROM empreendimento_cadastro                           
  WHERE idempreendimento_cadastro = $id";

  $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
              $img   = $buscar_amigo['img_lote'];
            }

            return $img;
          } 

          function dados_locacao($locacao_id){
            include "../conexao.php";
            $query_amigo = "SELECT * FROM imovel WHERE idimovel = $locacao_id";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
              $endereco   = $buscar_amigo['endereco'];
              $numero     = $buscar_amigo['numero'];
              $cep        = $buscar_amigo['cep'];

            }

            $exibir = $endereco.", ".$numero;

            return $exibir;
          }

          function dados_imobiliaria($imob){
            include "../conexao.php";
            $query_amigo = "SELECT * FROM cliente                           
            WHERE idcliente = $imob";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
              $descricao_imob   = $buscar_amigo['nome_cli'];
            }

            return $descricao_imob;
          }
          function dados_cliente($idcli){
            include "../conexao.php";
            $query_amigo = "SELECT * FROM crm_cli                           
            WHERE crm_id = $idcli";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
              $nome   = $buscar_amigo['crm_nome'];
            }

            return $nome;
          }

          function dados_empreendimento($empreendimento_id){
            include "../conexao.php";
            $query_amigo = "SELECT * FROM empreendimento_cadastro                           
            WHERE idempreendimento_cadastro = $empreendimento_id";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
              $descricao_empreendimento   = $buscar_amigo['descricao_empreendimento'];
            }

            return $descricao_empreendimento;
          }

          function dados_imovel($id){
            include "../conexao.php";
            $query_amigo = "SELECT * FROM imovel                           
            WHERE idimovel = $id";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
              $descricao_empreendimento   = $buscar_amigo['endereco'] ;
            }

            return $descricao_empreendimento;
          }

          function converterdata($dateSql){
            $ano= substr($dateSql, 0,4);
            $mes= substr($dateSql, 5,2);
            $dia= substr($dateSql, 1,2);
            return $dia."-".$mes."-".$ano;
          }

          function tempo($idc, $sts){

            include "../conexao.php";

            $querytempo = "SELECT * FROM crm_atendimento where crm_tratadescricao != 'Alerta!!!' AND crm_trataid = $idc AND crm_tratastatus = '$sts' AND crm_tratadescricao NOT LIKE '%Editado em%' order by crm_trataid desc limit 1";

            $exectempo = mysqli_query($db, $querytempo);
            while ($buscatempo = mysqli_fetch_assoc($exectempo)) {

              $crm_data_agora = $buscatempo["crm_tempotransicao"];
              $dataanterior = $buscatempo["crm_tratadata"];
              $horaanterior = $buscatempo["crm_horacad"];

              $crm_data_anterior = $dataanterior." ".$horaanterior;        
              $tempo = gmdate('d H:i:s', abs(strtotime($crm_data_agora)-strtotime($crm_data_anterior)));

              return $tempo;
            }
          }

          function convertHoras($horasInteiras) {

    // Define o formato de saida
            $formato = '%02d:%02d:00';
    // Converte para minutos
            $minutos = $horasInteiras * 60;

    // Converte para o formato hora
            $horas = floor($minutos / 60);
            $minutos = ($minutos % 60);

    // Retorna o valor
            return sprintf($formato, $horas, $minutos);
          }


          date_default_timezone_set('America/Sao_Paulo');               
          $horario_relatorio = date('d-m-Y H:i:s');

          $data_venda = date("d-m-Y");
          $arrayData = explode("-",$data_venda);

// Imprimindo os dados:
          $dia = $arrayData[0];
          $mes = intval($arrayData[1]);
          $ano = $arrayData[2];


          $dia_hoje = $dia;
          $ano_hoje = $ano;

          $hoje = getdate();

          $meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 0 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

          $nome_mes = $meses[$mes];

          $inicio                   = $_POST["inicio"];
          $fim                      = $_POST["fim"];

          $empreendimento_id        = $_POST["empreendimento_id"];
          $categoria                = $_POST["categoria"];

          $locacao_id               = $_POST["idlocacao"];
          $imob                     = $_POST["imob"];
          $corretor                 = $_POST["corretor"];
          $status                   = $_POST["status3"];
          $chk                      = $_POST["chk"];

          $gp = "";
          if ($empreendimento_id != 'Todos' && $locacao_id != 'Todos' && $categoria != 'Todos') { ?> 
            <script>
              window.location= "../crm_relatorios_tempo.php?cad=1";
            </script>
            <?php
          } elseif($empreendimento_id != 'Todos'){
            $gp .= "AND crm_interesse ='".$empreendimento_id."'"; 
          } elseif($locacao_id != 'Todos'){
           $gp .= " AND crm_interesse ='". $locacao_id."'";

         } 

         if($inicio != '' AND $fim != ''){
          $gp .=" AND STR_TO_DATE(crm_data_cadastro, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";
        }


        if ($status != "") {
          echo "entrei";
          $gp .=" AND crm_tratastatus = '".$status."'";
        }

        if ($imob != "") {
          $gp .=" AND imob_id = '".$imob."'";
        }
        if ($corretor != "") {
          $gp .=" AND idcliente = '".$corretor."'";
        }

        require_once("dompdf/dompdf_config.inc.php");

        /* Cria a instância */
        $dompdf = new DOMPDF();
        if($inicio != '' AND $fim != ''){


          $inicio = date("d-m-Y", strtotime($inicio));

          $fim = date("d-m-Y", strtotime($fim));

          $data = "De $inicio até $fim";

        } 
        else {

          $data = "Todos";

        }



        if ($empreendimento_id != 'Todos') {
          $idemp = $empreendimento_id;
          $empreendimento_id = dados_empreendimento($empreendimento_id);
          $logo = fotologo($idemp);
        }
        if ($locacao_id != 'Todos') {
          $locacao_id = dados_locacao($locacao_id);
        }


        if(isset($_POST["chk"])){
          if ($chk == '1') {

          } else {
            $gp .= " GROUP BY crm_status";
          }
        }


        include "../conexao.php";


        $html .= "<table style='width:100%' border='0'>
        <tr>";

        if ($empreendimento_id == 'Todos' || is_null($empreendimento_id)){ 
          $html .= "<td colspan='2'>

          </td>";
        } else {
          $html .= "<td colspan='2'>

          <img src='../img/$idemp/$logo' height='110' />

          </td>";
        }
        $html .= "<td colspan='2' style='text-align: center'>Caldas Novas, $dia_hoje de $nome_mes de $ano_hoje</td>
        </tr>
        <tr>
        <td colspan='4' style='text-align: center; font-weight: bold;'>RELATÓRIO DE TEMPO DE ATENDIMENTO</td>
        </tr>
        <tr>
        <td colspan='2'><span style='font-weight: bold'>Data Período</span>: $data</td>
        <td colspan='2'><span style='font-weight: bold'>Locação</span>: $locacao_id</td>
        </tr>
        <tr>
        <td colspan='2'><span style='font-weight: bold'>Empreendimento</span>: $empreendimento_id</td>
        <td colspan='2'><span style='font-weight: bold'>Venda</span>: $locacao_id</td>
        </tr>
        </table>";

        $html .="<table style='width:100%; font-size:10px;' height='127' border='0'>";
date_default_timezone_set('America/Sao_Paulo');

        $querytimer = "SELECT * FROM crm_status";
        $exectimer = mysqli_query($db, $querytimer) or die("Impossível buscar status.");

        while ($buscatimer = mysqli_fetch_assoc($exectimer)) {
          $idstatus = $buscatimer["crm_idstatus"];

          $querytimer2 = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( crm_tempoatt ) ) ),'%H:%i:%s') AS totalhr, COUNT(crm_tempoatt) AS cont FROM crm_atendimento WHERE crm_tratastatus = '$idstatus' AND crm_tratadescricao != 'Alerta!!!' AND crm_tratadescricao NOT LIKE '%Editado em%' AND crm_tempotransicao != ''";

          $exectimer2 = mysqli_query($db, $querytimer2) or die("Impossível buscar atendimento");

          $buscatimer2 = mysqli_fetch_assoc($exectimer2);
          $totalhoras = $buscatimer2["totalhr"];
          $cnt1 = $buscatimer2["cont"];

          //if (is_null($totalhoras) || $totalhoras == '0') {

          //} else {
          $separa = explode(':',$totalhoras);

          $horas = $separa[0] * 3600;
          $segundos = $separa[2];
          $minutos = $separa[1]*60;

          $totalhoras =  $horas + $minutos +$segundos;

          $totalhoras = $totalhoras / $cnt1;

//não sei porque diabos ele me retorna 21horas a mais. TA FUNCIONANDO!!!
        
          $totalhoras = date('H:i:s', strtotime("- 21 hours", $totalhoras));
          //$horas = floor($totalhoras / 60);

          //$minutos = $totalhoras % 60;

          //$segundos = floor($totalhoras *60);
          //$segundos = round($segundos, 2);  // 1.96
         //$totalhoras = $segundos;

//$totalhoras = $horas.":".$minutos.":".$segundos;
//}
//$totalhoras /= 60;


          //echo "<>".(date("H:i:s", strtotime($totalhoras) / $cnt1));

          //$totalhoras = date("H:i:s", strtotime("$totalhoras"));


//echo "$totalhoras <<";

$x[$idstatus] = $totalhoras;

}

if ($categoria == '1' || $categoria == 'Todos') {



  $html .="<tr bgcolor='#b8b8b8'>
  <td style='text-align: center'><strong>Cliente</strong></td>
  <td style='text-align: center'><strong>Corretor</strong></td>
  <td style='text-align: center'><strong>Imobiliária</strong></td>
  <td style='text-align: center'><strong>Interesse</strong></td>
  <td style='text-align: center'><strong>Status</strong></td>
  <td style='text-align: center'><strong>Tempo Determinado D/H</strong></td>
  <td style='text-align: center'><strong>Tempo Médio Atendimento</strong></td>
  </tr>";

#######################################LISTAGEM DOS EMPREENDIMENTOS########################################
###########################################################################################################
  include "../conexao.php";
  $query22 = "SELECT * FROM cliente AS c INNER JOIN cliente_tipo AS t ON c.idcliente = t.idcliente  WHERE t.idtipo = 8";
  $exec22 = mysqli_query($db, $query22) or die("Não foi possível encontrar os Corretores.");
  $total = 0;
  while ($busca22 = mysqli_fetch_assoc($exec22)) {

    $idc = $busca22["idcliente"];

    $querystatus = "SELECT * FROM crm_atendimento INNER JOIN crm_status ON crm_idstatus = crm_tratastatus INNER JOIN cliente ON crm_idcorretor = idcliente INNER JOIN crm_cli ON crm_idcli = crm_id WHERE idcliente = '$idc' AND crm_tratadescricao != 'Alerta!!!' AND crm_tratadescricao NOT LIKE '%Editado em%' AND crm_tempotransicao != '' AND crm_categoria = 2 $gp";

    $execstatus = mysqli_query($db, $querystatus) or die("impossível localizar atendimento.");

    while ($buscastatus = mysqli_fetch_assoc($execstatus)) {

      $nomect           = $buscastatus["crm_idcli"];
      $nomet            = utf8_encode($buscastatus["nome_cli"]);
      $statust          = $buscastatus["crm_status"];
      $horast           = $buscastatus["crm_horasatt"];
      $diast            = $buscastatus["crm_diasatt"];
      $interesseg       = $buscastatus["crm_interesse"];
      $imobt            = $buscastatus["imob_id"];
      $interesset       = $interesseg;
      $imobt            = utf8_encode(dados_imobiliaria($imobt));
      $interesset       = utf8_encode(dados_empreendimento($interesset));
      $tratastatus      = $buscastatus["crm_tratastatus"];
      $datacad          = $buscastatus["crm_tratadata"];
      $horacad          = $buscastatus["crm_horacad"];
      $tempo            = $buscastatus["crm_horasatt"];
      $dias             = $buscastatus["crm_diasatt"];
      $trataid          = $buscastatus["crm_trataid"];

      $tempofinal = tempo($trataid, $tratastatus);

      $tf = explode(" ", $tempofinal);
      $tf1 = $tf[0];
      $tf2 = $tf[1];
      $tf1 -= 1;

      $tempofinal = $tf1." ".$tf2;
      $separar = explode(":", $horast);
      $horas = $separar[0];
      $minutos = $separar[1];
      $totalminutos = ($diast * 24) * 60 + ($horas * 60) +  $minutos;

      $totalminutos = $totalminutos / 60;
      $totalminutos = convertHoras($totalminutos);



//retorno do tempo tem q ser ajustado.


      if (is_null($interesset) || $interesset == "") {
        $interesset = dados_imovel($interesseg);
      }
      $nomect = utf8_encode(dados_cliente($nomect));


      $html .="<tr>
      <td style='text-align: center'>$nomect</td>        
      <td style='text-align: center'>$nomet</td>
      <td style='text-align: center'>$imobt</td>
      <td style='text-align: center'>$interesset</td>
      <td style='text-align: center'>$statust</td>
      <td style='text-align: center'>$totalminutos</td>
      <td style='text-align: center'>$x[$tratastatus] </td>

      </tr>";

      $total ++;
    }
  }
} 

################################################FIM EMPREENDIMENTOS########################################
###########################################################################################################

if ($categoria == 2 OR $categoria == 'Todos') {


  $html .="<tr bgcolor='#b8b8b8'>
  <td style='text-align: center'><strong>Cliente</strong></td>
  <td style='text-align: center'><strong>Corretor</strong></td>
  <td style='text-align: center'><strong>Imobiliária</strong></td>
  <td style='text-align: center'><strong>Interesse</strong></td>
  <td style='text-align: center'><strong>Status</strong></td>
  <td style='text-align: center'><strong>Tempo Determinado D/H</strong></td>
  <td style='text-align: center'><strong>Tempo Médio Atendimento</strong></td>

  </tr>";
#########################################VENDA / LOCAÇÃO###################################################
###########################################################################################################
  include "../conexao.php";
  $query22 = "SELECT * FROM cliente AS c INNER JOIN cliente_tipo AS t ON c.idcliente = t.idcliente  WHERE t.idtipo = 8";
  $exec22 = mysqli_query($db, $query22) or die("Não foi possível encontrar os Corretores.");

  while ($busca22 = mysqli_fetch_assoc($exec22)) {

    $idc = $busca22["idcliente"];

    $querystatus = "SELECT * FROM crm_status INNER JOIN crm_atendimento ON crm_idstatus = crm_tratastatus INNER JOIN cliente ON crm_idcorretor = idcliente INNER JOIN crm_cli ON crm_idcli = crm_id WHERE crm_idcorretor = '$idc' AND crm_tratadescricao != 'Alerta!!!' AND crm_tratadescricao NOT LIKE '%Editado em%' AND crm_tempotransicao != '' AND crm_categoria != 2 $gp";

    $execstatus = mysqli_query($db, $querystatus) or die("impossível localizar atendimento.");

    while ($buscastatus = mysqli_fetch_assoc($execstatus)) {

      $tratastatus2 = $buscastatus["crm_tratastatus"];
      $nomect = $buscastatus["crm_idcli"];
      $nomet = utf8_encode($buscastatus["nome_cli"]);
      $statust = $buscastatus["crm_status"];
      $horast = $buscastatus["crm_horasatt"];
      $diast = $buscastatus["crm_diasatt"];
      $interesseg = $buscastatus["crm_interesse"];
      $imobt = $buscastatus["imob_id"];
      $trataid2 = $buscastatus["crm_trataid"];


      $interesset = $interesseg;
      $imobt = utf8_encode(dados_imobiliaria($imobt));
      $interesset = utf8_encode(dados_empreendimento($interesset));
      if (is_null($interesset) || $interesset == "") {
        $interesset = dados_imovel($interesseg);
      }
      $tempofinal = tempo($trataid2, $tratastatus2);

      $tf = explode(" ", $tempofinal);
      $tf1 = $tf[0];
      $tf2 = $tf[1];
      $tf1 -= 1;

      $tempofinal = $tf1." ".$tf2;
      $nomect = utf8_encode(dados_cliente($nomect));

      $separar = explode(":", $horast);
      $horas = $separar[0];
      $minutos = $separar[1];
      $totalminutos = ($diast * 24) * 60 + ($horas * 60) +  $minutos;

      $totalminutos = $totalminutos / 60;

      $totalminutos = convertHoras($totalminutos);


      $html .="<tr>
      <td style='text-align: center'>$nomect</td>        
      <td style='text-align: center'>$nomet</td>
      <td style='text-align: center'>$imobt</td>
      <td style='text-align: center'>$interesset</td>
      <td style='text-align: center'>$statust</td>
      <td style='text-align: center'>$totalminutos</td>
      <td style='text-align: center'>$x[$tratastatus2] </td>

      </tr>";

      $total ++;
    }
  }
}
#########################################FIM VENDA / LOCAÇÃO###############################################
###########################################################################################################        

$html .="<tr bgcolor='#b8b8b8'>
<td style='text-align: center'><strong></strong></td>
<td style='text-align: center'><strong></strong></td>
<td style='text-align: center'><strong></strong></td>
<td style='text-align: center'><strong></strong></td>
<td style='text-align: center'><strong></strong></td>
<td style='text-align: center'><strong></strong></td>
<td style='text-align: center'><strong>Total Cadastrados: $total</strong></td>

</tr>";

$html .="</table>";

print_r($html);


        $dompdf->load_html($html);


        $dompdf->set_paper("A4", "landscape");
        ob_clean();

        $pdf = $dompdf->render();
        $canvas = $dompdf->get_canvas(); 
        $font = Font_Metrics::get_font("helvetica", "bold"); 
        $canvas->page_text(510, 18, "", $font, 6, array(0,0,0)); 
        $canvas->page_text(270, 792, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); 
        header("Content-type: application/pdf");     


        $dompdf->stream(
          "saida.pdf", 
          array(
            "Attachment" => false 
          )
        );


        ?>
