<?php
 
$imobb = $_POST['id'];

      include "conexao.php";

                $query_amigo = "SELECT * FROM cliente where imob_id = $imobb";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idlote       = $reg["idcliente"];
             $lote          = $reg["nome_cli"];
          
            
             
 

$dados[$idlote] =  $lote;

} $teste = "";

$dados[$teste] = 'Todos';
echo json_encode($dados);



?>