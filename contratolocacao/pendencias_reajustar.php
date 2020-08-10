<?php ob_start();
error_reporting(0);
ini_set(“display_errors”, 0 );


set_time_limit(0);
ini_set("upload_max_filesize", "10M");
ini_set("max_execution_time", "800");
ini_set("memory_limit", "-1");
ini_set("realpath_cache_ttl", "120");

// echo "<pre>";
// print_r($_GET);
// echo "</pre>"; die();
            $teste = $_GET['teste'];
            $inicio = '1900-01-01';
            $fim = date('Y-m-d');

           $mes_inicial = 01;
           $mes_final = 12;


global $teste;
global $inicio;
global $fim;  
global $mes_inicial;
global $mes_final;          




$pesquisa = verifica_mes($mes_inicial, $mes_final);

//print_r($pesquisa);

$n_meses = count($pesquisa);
//echo $n_meses; die();

function verifica_mes($mes_inicial, $mes_final){
       $cont = $mes_inicial;
       //echo $cont;
       $pesquisa = array();
       while($cont < $mes_final){
          
           array_push($pesquisa, $cont++);

       }
       array_push($pesquisa, $mes_final);
      
        return $pesquisa;

}






function verifica_reajuste($idvenda, $data_venda, $igpm){
           global $teste;
           global $inicio;
           global $fim;
           global $mes_inicial;
           global $mes_final;




           // echo "MES INICIAL DA PESQUISA " . $mes_inicial . "<br>";
           // echo "MES FINAL DA PESQUISA " . $mes_final . "<br>";


           $data_inicio = date('Y-m-d',strtotime("-365 day", strtotime($inicio)));
           $data_fim = date('Y-m-d',strtotime("-365 day", strtotime($fim)));
             // echo $data_inicio . "<br>";
             // echo $data_fim . "<br>";
           
           $inicio_em_dias = strtotime($data_inicio);
           $final_em_dias = strtotime($data_fim);


           $data_venda = date('Y-m-d', strtotime($data_venda));
           $data_venda = strtotime($data_venda);
           

           if($igpm != ""){
                  $igpm = date('Y-m-d', strtotime($igpm));
                  $igpm = strtotime($igpm);
           }else{
                  $igpm = NULL;
           }
         
         
           include "../conexao.php";
            
            //SE CONTRATO ESTA NO PERIODO DA PESQUISA ENTRE DATA INICIO E DATA FIM

             
            
            //vefificando quem nao faz parte do relatorio
             // if($igpm < $inicio_em_dias && $igpm != NULL){
             //  echo "igpm igual a.: " . $igpm . "<br>";
             //  echo "data inicio igual .: "  . $inicio_em_dias . "<br>" ;
             //     echo $idvenda . " SOU MERNOR QUE A DATA PESQUISADA ... <br>" ;
             // }


             if($igpm > $inicio_em_dias && $igpm < $final_em_dias){
                      //echo "igpm dentro da data pesquisada <br>";
                    return true;
             }elseif($igpm == NULL){
                        //echo "igpm igual a null <br>";
                      if($data_venda > $inicio_em_dias && $data_venda < $final_em_dias){
                            //echo "data_venda dentro da data pesquisada <br>";
                            return true;
                      }else{
                         // echo "data_venda fora do periodo pesquisado <br>";
                          return false;
                      }
              }else{
                  return false;
              }
            

             

}

    

require_once("dompdf/dompdf_config.inc.php");
 

/* Cria a instância */
$dompdf = new DOMPDF();
  include "../conexao.php";







  $por_cadastro = "DE : &nbsp;&nbsp;  " . date('d/m/Y', strtotime($inicio)) . " &nbsp;&nbsp; ate &nbsp;&nbsp; "  . date('d/m/Y', strtotime($fim));




             
// $where =  " venda.idvenda = $idvenda AND (STR_TO_DATE(igpm, '%d-%m-%Y') BETWEEN  '".$data_inicio."' and '".$data_fim."' OR STR_TO_DATE(venda.data_venda, '%d-%m-%Y') = STR_TO_DATE(igpm, '%d-%m-%Y') OR STR_TO_DATE(venda.igpm, '%d-%m-%Y') = NULL)";


 
            $query_amigo = "SELECT venda.idvenda , empreendimento_cadastro.descricao_empreendimento, produto.quadra, lote.lote, cliente.nome_cli, venda.data_venda, venda.igpm, empreendimento_cadastro.idempreendimento_cadastro, empreendimento_cadastro.img_lote FROM venda INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
              INNER JOIN lote ON lote.idlote = venda.lote_idlote INNER JOIN empreendimento_cadastro ON empreendimento_cadastro.idempreendimento_cadastro = produto.empreendimento_idempreendimento INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente WHERE venda.idvenda > 0 AND empreendimento_cadastro.idempreendimento_cadastro = $teste GROUP BY venda.igpm ORDER BY venda.igpm ASC";



            $executa_query = mysqli_query ($db,$query_amigo);
                  
            while ($busca_dados = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           

                  $idvenda        = $busca_dados['idvenda'];
                  $empreendimento = $busca_dados['descricao_empreendimento'];
                  $lote           = $busca_dados['lote']; 
                  $cliente        = $busca_dados['nome_cli'];                 
                  $data_venda     = $busca_dados['data_venda'];
                  $igpm  = $busca_dados['igpm'];
                  $quadra         = $busca_dados['quadra'];
                  $img = $busca_dados["img_lote"];
                  $empreendimento_id = $busca_dados["idempreendimento_cadastro"];
                  $reajustar      = verifica_reajuste($idvenda, $data_venda, $igpm);
                  if($igpm == null){
                     $mes_igpm    = date('m', strtotime($data_venda));

                  }else{
                      $mes_igpm       = date('m' , strtotime($igpm));

                  }
                  
                  $busca_dados['mes_igpm'] = $mes_igpm;

           if($reajustar){
                   $dados[] = $busca_dados; 
                  // $dados['mes_data_venda'] = $mes_data_venda;

           }

  

          }

          $empreendimento = $dados[0]['descricao_empreendimento'];

           $html = "<table style='width:100%' border='0' align='center'>

    <tr>
      <td style='width:20%'><img src='../img/$empreendimento_id/$img' height='110' /></td>
      <td style='width:80%'><center><h4>RELATÓRIO CONTRATOS PENDENTES À REAJUSTAR <br><strong>Empreendimento.: </strong>&nbsp;&nbsp;  $empreendimento</h4>

              </center>
      </td></tr>
    
    

</table>";


           // echo "<pre>";
           // print_r($dados);
           // echo "</pre>";
        
        

  //echo $i. "<br>";
 
             
              $puxa_mes = $i-1;
            //$html .= "<label>Referente :<strong> $mes_do_ano[$puxa_mes]</strong></label><br>";
            $html .= "<table border='0' style='width:100%'>";

                $html .= "<tr  bgcolor='#b8b8b8'>
                          <th>Numero Contrato</th>
                          <th>Cliente</th>
                          <th>Data Venda</th>
                          <th>Quadra</th>
                          <th>Lote</th>
                          <th>Último Reajuste</th>
                          </tr>";
          
          

           foreach ($dados as $dado ) {
                     $contrato = $dado['idvenda'];
                     $nome_cliente = $dado['nome_cli'];
                     $data_venda = $dado['data_venda'];
                     $quadra = $dado['quadra'];
                     $lote = $dado['lote'];
                     $igpm = $dado['igpm'];

                    $html .= "<tr>    
                                      <td><center>$contrato</center></td>
                                      <td>$nome_cliente</td>
                                      <td><center>$data_venda</center></td>
                                      <td><center>$quadra</center></th>
                                      <td><center>$lote</center></td>
                                      <td><center>$igpm</center></font></td>
                              </tr>";
               
                }
                

      




    $html .="</table>";

   $html .="<hr style='width:100%'></hr><br>";


   








 //echo $html;



$dompdf->load_html($html);
  $dompdf->set_paper("A4","landscape");
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
