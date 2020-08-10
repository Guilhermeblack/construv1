<?php 




    function roleta_i($imob){

      include "conexao.php";


      $query_amigo = "SELECT * FROM cliente WHERE imob_id = $imob ";

      $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");
      
      

      $cont = 0;

            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

              $id_i                = $buscar_amigo['idcliente'];
              

              $dados[$cont] = $id_i;

              $cont += 1;

            } 
       

           return $dados;

    }


  

    function conta_idc($id, $imob){
 
      include "conexao.php";

      $query_amigo = "SELECT COUNT(crm_idroleta) as total FROM crm_roleta_corretor WHERE crm_idcorretor = $id AND crm_idimob = $imob";

      $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");
      
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

              $total                = $buscar_amigo['total'];
              
            } 

            return $total;

    }




$e = roleta_i(1);


$cont2 = 0;
$menor2 = 10000;
foreach ($e as $id2) {
	# code... 7 9 da imobi 3 - 8 da imob 2 - 2 3 da imob 1   
echo "$id2"; die();
	$total2 = conta_idc($id2, 1);

    $resultado[] = array($cont2, $id2, $total2);


if ($total2 <= $menor2) {

	$menor2 = $total2;

}

	$cont2 ++;

}



foreach ($resultado as $val => $chave ) {

	$var = $chave[2];

	if ($menor2 == $var ) {
		
		$todosmenor2[] = $chave[1];
	}

}

$otra2 = $todosmenor2;

$otra2 = array_rand($todosmenor2, 1);

$ganhador2 = $todosmenor2[$otra2];

echo "$ganhador2"; die();

/*$inserirganhador = ("INSERT INTO crm_roleta_corretor (
	crm_idcorretor,
	crm_idcli,    
	crm_idimob

)
values (
'$id2',   
'$ultimoid',    
'$ganhador2'
)
");

@mysqli_query($db,$inserirganhador);*/


die();
	?>

	<script>
		window.location="crm_tratalead.php?cad=1";
	</script>

<!--<script>
 window.location="crm_leadform.php?cad=ok";
</script>-->

