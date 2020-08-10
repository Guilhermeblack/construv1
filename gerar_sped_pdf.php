<?php 
ob_start();
ob_clean();
error_reporting(0);
ini_set(“display_errors”, 0 );
if (!isset($_SESSION)) {
  session_start();
} 
      
  include "conexao.php";
      
      $empresa = $_GET['passaid'];
      $arquivo = $_GET['arquivo'];
      //echo $empresa ." - " . $arquivo; die();

                  $query_amigo = "SELECT * FROM sped_arquivos WHERE id_empresa = '$empresa' 
                     AND nome_arquivo = '$arquivo'  order by id_arq DESC "; 

                  $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar arquivo do sped");


            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

              $arquivo    = $buscar_amigo["nome_arquivo"];
              $datacriacao  = $buscar_amigo["data_geracao"];
              $path  = $buscar_amigo['path_arq'];
              $htmlarquivo = $buscar_amigo['html_arquivo'];
          
  }

  require_once("contratolocacao/dompdf/dompdf_config.inc.php");
  $html = html_entity_decode($htmlarquivo);
  //echo $html;
  $exten = DATE('dmY');
  $filename = 'sped-'. $exten .'.pdf';
  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->set_paper("A4","landscape");
  $pdf = $dompdf->render();
  $canvas = $dompdf->get_canvas(); 
  $font = Font_Metrics::get_font("helvetica", "bold"); 
  $canvas->page_text(510, 18, "", $font, 6, array(0,0,0)); 
  $canvas->page_text(270, 792, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); 
  header("Content-type: application/pdf"); 
  $dompdf->stream($filename, 
    array(
      "Attachment" => true
    )  
  ); 

      $url = $_SERVER['SERVER_NAME'];

?>

