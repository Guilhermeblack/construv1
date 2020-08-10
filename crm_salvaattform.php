<?php 



#/////////////////////////////////////////////////////////////////////////////////////////////////////////
#//////////////////////////////////////ROLETA IMOBILIÁRIA////////////////////////////////////////////////
#////////////////////////////////////////////////////////////////////////////////////////////////////////

function roleta_e($interesse){

      include "conexao.php";

      $query_amigo = "SELECT * FROM empreendimento_imob WHERE empreendimento_id = $interesse ";

      $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos 11");
      
      

      $cont = 0;

            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
              $id_e                = $buscar_amigo['idempreendimento_imob'];
              
              $id_i        = $buscar_amigo["imobiliaria_id"];

              $dados[$cont] = $id_i;

              $cont += 1;

            } 

            return $dados;

    }


function roleta_v(){

      include "conexao.php";

      $query_amigo = "SELECT crm_equipe AS E FROM crm_equipe";

      $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos 22");
      
      

      $cont = 0;

            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                            
             

              $dados[$cont] = $buscar_amigo["E"];

              $cont += 1;

            } 

            return $dados;

    }

    function conta_ids($id, $interesse, $categoria){

      include "conexao.php";
      if($categoria == 2){
      $query_amigo = "SELECT COUNT(crm_idroleta) as total FROM crm_roleta_imob WHERE crm_idempreendimento = $interesse AND crm_idimob = $id";
  }else{
  	 $query_amigo = "SELECT COUNT(crm_idroleta) as total FROM crm_roleta_imob WHERE crm_idimovel = $interesse AND crm_idimob = $id";
  	}

      $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos 33");
      
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
              $total                = $buscar_amigo['total'];
              
            } 

            return $total;

    }


#/////////////////////////////////////////////////////////////////////////////////////////////////////////
#//////////////////////////////////////ROLETA IMOBILIÁRIA////////////////////////////////////////////////
#////////////////////////////////////////////////////////////////////////////////////////////////////////



#/////////////////////////////////////////////////////////////////////////////////////////////////////////
#//////////////////////////////////////ROLETA CORRETOR///////////////////////////////////////////////////
#////////////////////////////////////////////////////////////////////////////////////////////////////////

    function roleta_i($imob){

      include "conexao.php";

      $query_amigo = "SELECT * FROM cliente WHERE imob_id = $imob ";
      $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos 44");
      

      $cont = 0;
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

              $id_i                = $buscar_amigo['idcliente'];
              

              $dados[$cont] = $id_i;
              $cont += 1;

            } 
       
           return $dados;

    }


  

    function conta_idc($id, $imob, $interesse, $crm_categoria){
 
      include "conexao.php";
if ($crm_categoria == 2) {

      $query_amigo = "SELECT COUNT(crm_idroleta) as total FROM crm_roleta_corretor WHERE crm_idcorretor = $id AND crm_idimob = $imob AND crm_idempreendimento = $interesse";
} else {

      $query_amigo = "SELECT COUNT(crm_idroleta) as total FROM crm_roleta_corretor WHERE crm_idcorretor = $id AND crm_idimob = $imob";
}
      $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos 55");
      
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

              $total                = $buscar_amigo['total'];
              
            } 

            return $total;

    }
#/////////////////////////////////////////////////////////////////////////////////////////////////////////
#//////////////////////////////////////ROLETA CORRETOR///////////////////////////////////////////////////
#////////////////////////////////////////////////////////////////////////////////////////////////////////


header('Content-Type: text/html; charset=utf-8');
function remover_acentos($str) { 

	$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?', 'ç', 'Ç', "'"); 
	$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N','O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a','ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i','IJ','ij', 'J', 'j', 'K', 'k', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o','c','C', " "); 
	return str_replace($a, $b, $str); 
} 

date_default_timezone_set('America/Sao_Paulo');

$crm_nome 		   = utf8_decode($_POST["primeironome"]);

$crm_email 		   = $_POST["email"];
$crm_celular	   = $_POST["celular"];
$crm_fixo   	   = $_POST["fixo"];
$crm_cep		   = $_POST["cep"];
$crm_origem		   = $_POST["origemfil"];
$crm_lat		   = $_POST["lat"];
$crm_long		   = $_POST["lon"];
$crm_rua		   = $_POST["rua"];
$crm_cidade		   = $_POST["cidade"]; 
$crm_numero		   = $_POST["numero"];
$crm_complemento   = $_POST["complemento"];
$crm_status 		= $_POST['status'];
$crm_bairro			= $_POST["bairro"];
$crm_obs			= $_POST["obs"];
$uf 				= $_POST["uf"];




$crm_categoria 		= $_POST["categoria"];
 
$crm_idcorretor		= $_POST["imobiliaria_idimobiliaria"];

$crm_horacad       = date('H:i:s');
$crm_data_cadastro 	  = date('d-m-Y');
if ($crm_categoria == 2){
$crm_interesse 		= $_POST["interesse"];

} else $crm_interesse 		= $_POST["interesse1"];


/*$crm_nome 		= remover_acentos($crm_nome); 
$crm_rua		= remover_acentos($crm_rua);
$crm_cidade		= remover_acentos($crm_cidade); 
*/

include "conexao.php";

	$inserir = ("INSERT INTO crm_cli (
	crm_nome,    
	crm_email,    
	crm_celular,    
	crm_fixo,
	crm_cep,
	crm_data_cadastro,
	crm_origem,
	crm_lat,
	crm_long,
	crm_rua,
	crm_cidade,
	crm_statuscli,
	crm_numeroend,
	crm_complemento,
	crm_horacad,
	crm_statusdata,
	crm_interesse,
	crm_categoria,
	crm_bairro,
	crm_uf,
	crm_obs

)
values (
'$crm_nome',   
'$crm_email',    
'$crm_celular',    
'$crm_fixo',
'$crm_cep',
'$crm_data_cadastro',
'$crm_origem',
'$crm_lat',
'$crm_long',
'$crm_rua',
'$crm_cidade',
'$crm_status',
'$crm_numero',
'$crm_complemento',
'$crm_horacad',
'$crm_data_cadastro',
'$crm_interesse',
'$crm_categoria',
'$crm_bairro',
'$uf',
'$crm_obs'


)
");
//}
//execução da query do mysql para inserção no banco!
//$executa_query = mysqli_query ($db,$inserir);
	
//mensagem de confirmação de envio do formulário!
if(@mysqli_query($db,$inserir)){

$ultimoid = mysqli_insert_id($db);
$inserir2 = ("INSERT INTO crm_atendimento (
	crm_tratadescricao,    
	crm_tratadata,
	crm_horacad,    
	crm_idcli,    
	crm_tratastatus,
	crm_idcorretor

)
values (
'Autoatendimento feito pelo sistema',   
'$crm_data_cadastro', 
'$crm_horacad',   
'$ultimoid',    
'$crm_status',
'$crm_idcorretor'
)
");

@mysqli_query($db,$inserir2);


#/////////////////////////////////////////////////////////////////////////////////////////////////////////
#//////////////////////////////////////ROLETA IMOBILIÁRIA////////////////////////////////////////////////
#////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($crm_categoria == 2) {
	$i = roleta_e($crm_interesse); //IMOBILIARIAS VINCULADAS AO EMPREENDIMENTO X.
} else {
	$i = roleta_v();
}


$cont = 0;
$menor = 10000;
foreach ($i as $id) {
	# code...

	$total = conta_ids($id, $crm_interesse, $crm_categoria);

    
    $resultado[] = array($cont,$id,$total);

if ($total <= $menor) {

	$menor = $total;

	
}

	$cont += 1;



}


foreach ($resultado as $val => $chave ) {

	$var = $chave[2];

	if ($menor == $var ) {
		
		$todosmenor[] = $chave[1];
	}

}


$otra = array_rand($todosmenor, 1);

if ($crm_roletaimob   = $_POST["imobb"]) {

	$ganhador = $crm_roletaimob;

} else 
{ $ganhador = $todosmenor[$otra]; }

if ($crm_categoria == 2) {
$inserirganhador = ("INSERT INTO crm_roleta_imob (
	crm_idimob,    
	crm_idcli,    
	crm_idempreendimento

)
values (
'$ganhador',   
'$ultimoid',    
'$crm_interesse'
)
");

} else {
	$inserirganhador = ("INSERT INTO crm_roleta_imob (
	crm_idimob,    
	crm_idcli,    
	crm_idimovel

)
values (
'$ganhador',   
'$ultimoid',    
'$crm_interesse'
)
");
}






#/////////////////////////////////////////////////////////////////////////////////////////////////////////
#//////////////////////////////////////ROLETA IMOBILIÁRIA////////////////////////////////////////////////
#////////////////////////////////////////////////////////////////////////////////////////////////////////



#/////////////////////////////////////////////////////////////////////////////////////////////////////////
#//////////////////////////////////////ROLETA CORRETOR///////////////////////////////////////////////////
#////////////////////////////////////////////////////////////////////////////////////////////////////////


$e = roleta_i($ganhador);


$cont2 = 0;
$menor2 = 10000;
foreach ($e as $id2) {
	# code... 456

	$total2 = conta_idc($id2, $ganhador, $crm_interesse, $crm_categoria);

    
    $resultado2[] = array($cont2, $id2, $total2);

if ($total2 <= $menor2) {

	$menor2 = $total2;

}

	$cont2 += 1;

} 


foreach ($resultado2 as $val => $chave ) {

	$var = $chave[2];

	if ($menor2 == $var ) {
		
		$todosmenor2[] = $chave[1];
	}

}



$otra2 = array_rand($todosmenor2, 1);

if ($crm_roletaimob   = $_POST["imobb"]) {
	
	$crm_roletacorretor		= $_POST['corretores'];
	
	$ganhador2 = $crm_roletacorretor;

} else  $ganhador2 = $todosmenor2[$otra2]; 

if ($crm_categoria == 2) {
$inserirganhador2 = ("INSERT INTO crm_roleta_corretor (
	crm_idcorretor,
	crm_idcli,    
	crm_idimob,
	crm_idempreendimento

)
values (
'$ganhador2',   
'$ultimoid',    
'$ganhador',
'$crm_interesse'
)
");
} else {
	$inserirganhador2 = ("INSERT INTO crm_roleta_corretor (
	crm_idcorretor,
	crm_idcli,    
	crm_idimob,
	crm_idimovel

)
values (
'$ganhador2',   
'$ultimoid',    
'$ganhador',
'$crm_interesse'
)
");
}
@mysqli_query($db,$inserirganhador);
@mysqli_query($db,$inserirganhador2);

#/////////////////////////////////////////////////////////////////////////////////////////////////////////
#//////////////////////////////////////ROLETA CORRETOR///////////////////////////////////////////////////
#////////////////////////////////////////////////////////////////////////////////////////////////////////

//echo '<script>alert("Dados cadastrados!");</script>';
//echo "$id2 $ultimoid $ganhador"; die();
	?>
	<script>
		window.location="crm_tratalead.php?cad=1";
	</script>

	<?php
}else{

	echo '<script>alert("Não foi possível cadastrar!");</script>';

}

?>
<!--<script>
 window.location="crm_leadform.php?cad=ok";
</script>-->

