<?php
 
$imobiliaria_id = $_POST['imobiliaria_id'];
$dados[0] = 'Escolha';
      include "conexao.php";
                $query_amigo = "SELECT * FROM cliente
                				INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                				where imob_id = '$imobiliaria_id' AND idtipo = '8' order by nome_cli Asc";

                $executa_query = mysqli_query ($db,$query_amigo);
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcliente       = $reg["idcliente"];
             $nome_cli        = $reg["nome_cli"];
          
        
             

$dados[$idcliente] =  $nome_cli;


}


echo json_encode($dados);



?>