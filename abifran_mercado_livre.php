<?php 
$dom = new DOMDocument("1.0", "UTF-8"); 
$dom->preserveWhiteSpace = false; 
$dom->formatOutput = true;
#criando o nó principal (root)

$ListingDataFeed = $dom->createElement("ListingDataFeed");

$ListingDataFeed->setAttribute( "xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance" );
$ListingDataFeed->setAttribute( "xsi:noNamespaceSchemaLocation", "http://dev-test.mercadolibre.com/apps/validator.xsd" );





$imoveis = $dom->createElement("imoveis");
$emailx     = $dom->createElement("email", "hamilton@hrsantos.com.br");
$imoveis->appendChild($emailx);


function nome_imov_tipo($idtipo){
                include "conexao.php";
                $query_amigo = "SELECT * FROM imov_tipo
                                WHERE idtipo = $idtipo";
                $executa_query = mysqli_query ($db,$query_amigo);

                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {           
                $descricao_zap  = $buscar_amigo['descricao_mercadolivre'];
                }

return $descricao_zap;
}
function nome_imov_subtipo($idsubtipo){
                include "conexao.php";
                $query_amigo = "SELECT * FROM imov_subtipo
                                WHERE idsubtipo = $idsubtipo";
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar tipo");

                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {           
                $descricao_zap  = $buscar_amigo['descricao_abifran'];
                }

return $descricao_zap;
}


$imovel_id = $_GET["idimovel"];
 					  include "conexao.php";
			          $query_amigo = "SELECT * FROM imovel
                                      WHERE mercado_livre = 3 AND site = 1";

       
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Locador");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
               
                
                  $titulo_imovel      = $buscar_amigo["titulo_imovel"];
                  $idimovel           = $buscar_amigo["idimovel"];
                  $terreno            = $buscar_amigo["terreno"];
                  $area_construida    = $buscar_amigo["area_construida"];

                  $dormitorios        = $buscar_amigo["dormitorios"];
                  $banheiros          = $buscar_amigo["banheiros"];
                  $cozinhas           = $buscar_amigo["cozinhas"];
                  $suites             = $buscar_amigo["suites"];
                  $garagens           = $buscar_amigo["garagens"];

                  $cep                = $buscar_amigo["cep"];
                  $endereco           = $buscar_amigo["endereco"];
                  $numero             = $buscar_amigo["numero"];
                  $cidade             = $buscar_amigo["cidade_idcidade"];
                  $bairro             = $buscar_amigo["bairro"];
                  $estado             = $buscar_amigo["estado"];
                  $lat                = $buscar_amigo["lat"];
                  $lon                = $buscar_amigo["lon"];

                  $tipo               = $buscar_amigo["tipo"];
                  $finalidade         = $buscar_amigo["finalidade"];

                  $data_cadastro      = $buscar_amigo["data_cadastro"];
                  $data_exclusividade = $buscar_amigo["data_exclusividade"];
                  $exclusividade      = $buscar_amigo["exclusividade"];
                  
                  $preco              = $buscar_amigo["preco"];
                  $video_cod              = $buscar_amigo["video_cod"];

                  $descricao          = $buscar_amigo["descricao"];
                  $img_principal      = $buscar_amigo["img_principal"];

                  $cod_imov_tipo      = $buscar_amigo["cod_imov_tipo"];
                  $cod_imov_subtipo   = $buscar_amigo["cod_imov_subtipo"];

                  $nome_imov_tipo     =nome_imov_tipo($cod_imov_tipo);
               //   $nome_imov_subtipo  =nome_imov_subtipo($cod_imov_subtipo);


                  $titulo_imovel = 'Imovel a Venda em Franca';

                     $cep  = str_replace(".", "", $cep);
                     $cep  = str_replace("-", "", $cep);


                      $preco   = str_replace("R$", "", $preco);
                      $preco   = str_replace(".", "", $preco);
                      $preco   = str_replace(",00", "", $preco);
                       $preco   = str_replace(" ", "", $preco);


                      if($finalidade == 'Aluguel'){

                        $preco_aluguel = $preco;
                        $preco_venda = '';

                      }else{
                        $preco_aluguel = '';
                        $preco_venda = $preco;
                      }

                      $data_exclusividade = date("d-m-Y", strtotime($data_exclusividade));

                      $data_exclusividade = explode("-", $data_exclusividade);
                      $parte1_exclusive =  $data_exclusividade[0]; 
                      $parte2_exclusive =  $data_exclusividade[1];                       
                      $parte3_exclusive =  $data_exclusividade[2];  

                      $data_exclusividade =  $parte3_exclusive."-".$parte2_exclusive."-".$parte1_exclusive;


                      $data_cadastro = date("d-m-Y", strtotime($data_cadastro));

                      $data_cadastro = explode("-", $data_cadastro);
                      $parte1_cad =  $data_cadastro[0]; 
                      $parte2_cad =  $data_cadastro[1];                       
                      $parte3_cad =  $data_cadastro[2];  

                      $data_cadastro =  $parte3_cad."-".$parte2_cad."-".$parte1_cad;                    


                        $exibir_cat = $nome_imov_tipo.">".$finalidade;

                      if($exclusividade == 0){
                        $tem_exclusividade = 'false';
                        $data_exclusividade = '';
                        $data_cadastro  = '';
                      }else{
                        $tem_exclusividade = 'true';
                      }





#nó filho (contato)
$imovel = $dom->createElement("imovel");

#setanto nomes e atributos dos elementos xml (nós)
$imovelId         = $dom->createElement("imovelId", $idimovel);
$title            = $dom->createElement("title", $titulo_imovel);

$category         = $dom->createElement("category", $exibir_cat);
$price            = $dom->createElement("price", $preco);
$listingType      = $dom->createElement("listingType", "silver");
$video            = $dom->createElement("video", $video_cod);


$pictures     = $dom->createElement("pictures");

                $cont = 1;
                $query_foto = "SELECT * FROM fotos
                                      WHERE imovel_idimovel = $idimovel limit 14";

       
                $executa_foto = mysqli_query ($db,$query_foto) or die ("Erro ao listar Locador");
                $total = mysqli_num_rows($executa_foto);

             

                while ($buscar_foto = mysqli_fetch_assoc($executa_foto)) {//--verifica se são amigos
                
                $img           = $buscar_foto["img"];

                
                $imageURL       = $dom->createElement("imageURL", "http://hrsantos.com.br/carteira/fotos/".$idimovel."/".$img);

              $pictures->appendChild($imageURL);

              }




$sellerContact    = $dom->createElement("sellerContact");
  $contact             = $dom->createElement("contact", "HR SANTOS Empreendimentos Imobiliarios");
  $otherInfo           = $dom->createElement("otherInfo", "");
  $areaCode            = $dom->createElement("areaCode", "16");
  $phone               = $dom->createElement("phone", "99966-9765");
  $areaCode2           = $dom->createElement("areaCode2", "16");
  $phone2              = $dom->createElement("phone2", "3721-1688");
  $email               = $dom->createElement("email", "contato@hrsantos.com.br");
  $webpage             = $dom->createElement("webpage", "http://hrsantos.com.br");




  $location      = $dom->createElement("location");
    $addressLine         = $dom->createElement("addressLine", $endereco);
    $zipCode              = $dom->createElement("zipCode", $cep);
    $neighborhood         = $dom->createElement("neighborhood", $bairro);
    $city                 = $dom->createElement("city", $cidade);
    $state                = $dom->createElement("state", $estado);
    $country              = $dom->createElement("country", "Brasil");
    $latitude             = $dom->createElement("latitude", $lat);
    $longitude            = $dom->createElement("longitude", $lon);


$atttributes    = $dom->createElement("atttributes");

  $atttribute    = $dom->createElement("atttribute");
    $area_t         = $dom->createElement("name", "Área total");
    $area_tv        = $dom->createElement("value", $terreno);

    $atttribute->appendChild($area_t);
    $atttribute->appendChild($area_tv);


$atttributes->appendChild($atttribute);


  $atttribute2    = $dom->createElement("atttribute");
    $area_u         = $dom->createElement("name", "Área útil");
    $area_uv        = $dom->createElement("value", $area_construida);

    $atttribute2->appendChild($area_u);
    $atttribute2->appendChild($area_uv);


  $atttribute3    = $dom->createElement("atttribute");
    $banheiros_b         = $dom->createElement("name", "Banheiros");
    $banheiros_bv        = $dom->createElement("value", $banheiros);

    $atttribute3->appendChild($banheiros_b);
    $atttribute3->appendChild($banheiros_bv);


  $atttribute4    = $dom->createElement("atttribute");
    $garagens_g         = $dom->createElement("name", "Garagens");
    $garagens_gv        = $dom->createElement("value", $garagens);

    $atttribute4->appendChild($garagens_g);
    $atttribute4->appendChild($garagens_gv);


  $atttribute5    = $dom->createElement("atttribute");
    $quartos_q         = $dom->createElement("name", "Quartos");
    $quartos_qv        = $dom->createElement("value", $dormitorios);

    $atttribute5->appendChild($quartos_q);
    $atttribute5->appendChild($quartos_qv);


  $atttribute6    = $dom->createElement("atttribute");
    $academia_a         = $dom->createElement("name", "Academia");
    $academia_av        = $dom->createElement("value", "");

    $atttribute6->appendChild($academia_a);
    $atttribute6->appendChild($academia_av);


  $atttribute7    = $dom->createElement("atttribute");
    $armarios_a         = $dom->createElement("name", "Armários embutidos");
    $armarios_av        = $dom->createElement("value", "");

    $atttribute7->appendChild($armarios_a);
    $atttribute7->appendChild($armarios_av);


$description         = $dom->createElement("description", $descricao);



$imovel->appendChild($imovelId);
$imovel->appendChild($title);
$imovel->appendChild($category);
$imovel->appendChild($price);
$imovel->appendChild($listingType);
$imovel->appendChild($video);
$imovel->appendChild($pictures);

 
  $sellerContact ->appendChild($contact);
  $sellerContact->appendChild($otherInfo);
  $sellerContact->appendChild($areaCode);
  $sellerContact->appendChild($phone);
  $sellerContact->appendChild($areaCode2);
  $sellerContact->appendChild($phone2);
  $sellerContact->appendChild($email);
  $sellerContact->appendChild($webpage);

$imovel->appendChild($sellerContact);

  $location->appendChild($addressLine);
  $location->appendChild($zipCode);
  $location->appendChild($neighborhood);
  $location->appendChild($city);
  $location->appendChild($state);
  $location->appendChild($country);
  $location->appendChild($latitude);
  $location->appendChild($longitude);

$imovel->appendChild($location);

  $atttributes->appendChild($atttribute);
  $atttributes->appendChild($atttribute2);
  $atttributes->appendChild($atttribute3);
  $atttributes->appendChild($atttribute4);
  $atttributes->appendChild($atttribute5);
  $atttributes->appendChild($atttribute6);
  $atttributes->appendChild($atttribute7);

$imovel->appendChild($atttributes);

$imovel->appendChild($description);



$imoveis->appendChild($imovel);
}

$ListingDataFeed->appendChild($imoveis);
$dom->appendChild($ListingDataFeed);



# Para salvar o arquivo, descomente a linha
$dom->save("../imoveis_mercado_livre.xml");?>
<script type="text/javascript">
  window.location="integracao.php?idimovel=<?php echo $imovel_id ?>";

</script>


