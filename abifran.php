<?php 
$dom = new DOMDocument("1.0", "UTF-8"); 
$dom->preserveWhiteSpace = false; 
$dom->formatOutput = true;
#criando o nó principal (root)
$root 	 = $dom->createElement("Carga");
$Imoveis = $dom->createElement("Imoveis");

function nome_imov_tipo($idtipo){
                include "conexao.php";
                $query_amigo = "SELECT * FROM imov_tipo
                                WHERE idtipo = $idtipo";
                $executa_query = mysqli_query ($db,$query_amigo);

                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {           
                $descricao_zap  = $buscar_amigo['descricao_abifran'];
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
                                      WHERE abifran = 2 AND site = 1";

       
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Locador");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
               
                
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
                  $nome_imov_subtipo  =nome_imov_subtipo($cod_imov_subtipo);

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




                      if($exclusividade == 0){
                        $tem_exclusividade = 'false';
                        $data_exclusividade = '';
                        $data_cadastro  = '';
                      }else{
                        $tem_exclusividade = 'true';
                      }





#nó filho (contato)
$Imovel = $dom->createElement("Imovel");

#setanto nomes e atributos dos elementos xml (nós)
$CodigoImovel     = $dom->createElement("CodigoImovel", $idimovel);
$TipoImovel       = $dom->createElement("TipoImovel", $nome_imov_subtipo);
$SubTipoImovel    = $dom->createElement("SubTipoImovel", "");
$FinalidadeImovel  = $dom->createElement("FinalidadeImovel", $nome_imov_tipo);

$Localizacao      = $dom->createElement("Localizacao");
  $UF             = $dom->createElement("UF", $estado);
  $Cidade         = $dom->createElement("Cidade", $cidade);
  $Rua         = $dom->createElement("Rua", $endereco);
  $Bairro         = $dom->createElement("Bairro", $bairro);
  $Numero           = $dom->createElement("Numero", $numero);
  $Latitude         = $dom->createElement("Latitude", $lat);
  $Longitude        = $dom->createElement("Longitude", $lon);
  $Complemento      = $dom->createElement("Complemento", "");
  $CEP              = $dom->createElement("CEP", $cep);

$Comercializacao    = $dom->createElement("Comercializacao");

  $PrecoCondominio  = $dom->createElement("PrecoCondominio", "");
  $PrecoTemporada   = $dom->createElement("PrecoTemporada", "");
  $PrecoIptu        = $dom->createElement("PrecoIptu", "");
  $PrecoVenda       = $dom->createElement("PrecoVenda", $preco_venda);
  $PrecoLocacao     = $dom->createElement("PrecoLocacao", $preco_aluguel);


$AreaUtil         = $dom->createElement("AreaUtil", $area_construida);
$AreaTotal        = $dom->createElement("AreaTotal", $terreno);
$UnidadeMetrica   = $dom->createElement("UnidadeMetrica", "");

$QtdDormitorios   = $dom->createElement("QtdDormitorios", $dormitorios);
$QtdSuites        = $dom->createElement("QtdSuites", $suites);
$QtdBanheiros     = $dom->createElement("QtdBanheiros", $banheiros);
$QtdSalas     	  = $dom->createElement("QtdSalas", "1");
$QtdVagas         = $dom->createElement("QtdVagas", $garagens);
$QtdElevador      = $dom->createElement("QtdElevador", $garagens);
$QtdAndar         = $dom->createElement("QtdAndar", "");
$Observacao         = $dom->createElement("Observacao", $descricao);

$Fotos     = $dom->createElement("Fotos");

 $Foto             = $dom->createElement("Foto");
 $URLArquivo       = $dom->createElement("URLArquivo", "http://hrsantos.com.br/carteira/fotos/".$idimovel."/".$img_principal);
  $Principal       = $dom->createElement("Principal", "1");
  $NomeArquivo       = $dom->createElement("NomeArquivo", "1");

               $Foto->appendChild($URLArquivo);
               $Foto->appendChild($Principal);
               $Foto->appendChild($NomeArquivo);


              $Fotos->appendChild($Foto);

                $cont = 1;
                $query_foto = "SELECT * FROM fotos
                                      WHERE imovel_idimovel = $idimovel";

       
                $executa_foto = mysqli_query ($db,$query_foto) or die ("Erro ao listar Locador");
                $total = mysqli_num_rows($executa_foto);

             

                while ($buscar_foto = mysqli_fetch_assoc($executa_foto)) {//--verifica se são amigos
                
                $img           = $buscar_foto["img"];

                
                $Foto             = $dom->createElement("Foto");
                $URLArquivo       = $dom->createElement("URLArquivo", "http://hrsantos.com.br/carteira/fotos/".$idimovel."/".$img);
                $NomeArquivo       = $dom->createElement("NomeArquivo", $img);

              $Foto->appendChild($URLArquivo);
              $Foto->appendChild($NomeArquivo);


              $Fotos->appendChild($Foto);


              }


$URLSite       = $dom->createElement("URLSite", "http://hrsantos.com.br/detalhes_imovel.php?idimovel=".$idimovel);


$Videos    = $dom->createElement("Videos");

  $Video  = $dom->createElement("video", $video_cod);

$Recursos    = $dom->createElement("Recursos");

  $Recurso  = $dom->createElement("Recurso", "");

$Exclusividade     = $dom->createElement("Exclusividade");
	$Ativa      	  = $dom->createElement("Ativa", $tem_exclusividade);
	$DataInicio       = $dom->createElement("DataInicio", $data_cadastro);
	$DataFim      	  = $dom->createElement("DataFim", $data_exclusividade);

$Contato     = $dom->createElement("Contato");
  $Email     = $dom->createElement("Email", "contato@hrsantos.com.br");
  $Nome      = $dom->createElement("Nome", "HR SANTOS");
  $Phone     = $dom->createElement("Phone", "16999669765");


$Areas     = $dom->createElement("Areas");
  $AreaUtil        = $dom->createElement("AreaUtil", "");
  $AreaTotal       = $dom->createElement("AreaTotal", "");
  $AreaConstruida   = $dom->createElement("AreaConstruida", $area_construida);
  $AreaTerreno     = $dom->createElement("AreaTerreno", $terreno);


  $AnoConstrucao     = $dom->createElement("AnoConstrucao", "");


$Imovel->appendChild($CodigoImovel);
$Imovel->appendChild($TipoImovel);
$Imovel->appendChild($SubTipoImovel);
$Imovel->appendChild($FinalidadeImovel);
 
  $Localizacao->appendChild($UF);
  $Localizacao->appendChild($Cidade);
  $Localizacao->appendChild($Rua);
  $Localizacao->appendChild($Bairro);
  $Localizacao->appendChild($Numero);
  $Localizacao->appendChild($Latitude);
  $Localizacao->appendChild($Longitude);
  $Localizacao->appendChild($Complemento);
  $Localizacao->appendChild($CEP);

$Imovel->appendChild($Localizacao);

  $Comercializacao->appendChild($PrecoCondominio);
  $Comercializacao->appendChild($PrecoTemporada);
  $Comercializacao->appendChild($PrecoIptu);
  $Comercializacao->appendChild($PrecoVenda);
  $Comercializacao->appendChild($PrecoLocacao);


$Imovel->appendChild($Comercializacao);

$Imovel->appendChild($AreaUtil);
$Imovel->appendChild($AreaTotal);
$Imovel->appendChild($UnidadeMetrica);
$Imovel->appendChild($QtdDormitorios);
$Imovel->appendChild($QtdSuites);
$Imovel->appendChild($QtdBanheiros);
$Imovel->appendChild($QtdSalas);
$Imovel->appendChild($QtdVagas);
$Imovel->appendChild($QtdElevador);
$Imovel->appendChild($QtdAndar);
$Imovel->appendChild($Observacao);



$Imovel->appendChild($Fotos);

  $Videos->appendChild($Video);
$Imovel->appendChild($Videos);


  $Recursos->appendChild($Recurso);
$Imovel->appendChild($Recursos);

$Exclusividade->appendChild($Ativa);
$Exclusividade->appendChild($DataInicio);
$Exclusividade->appendChild($DataFim);

$Imovel->appendChild($Exclusividade);



$Contato->appendChild($Email);
$Contato->appendChild($Nome);
$Contato->appendChild($Phone);

$Imovel->appendChild($Contato);

$Areas->appendChild($AreaUtil);
$Areas->appendChild($AreaTotal);
$Areas->appendChild($AreaConstruida);
$Areas->appendChild($AreaTerreno);

$Imovel->appendChild($Areas);




$Imovel->appendChild($AnoConstrucao);




#adiciona o nó contato em (root) agenda


$Imoveis->appendChild($Imovel);
}
$root->appendChild($Imoveis);

$dom->appendChild($root);

# Para salvar o arquivo, descomente a linha
$dom->save("../imoveis.xml");?>
<script type="text/javascript">
  window.location="integracao.php?idimovel=<?php echo $imovel_id ?>";

</script>


