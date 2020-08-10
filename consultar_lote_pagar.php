<?php
 
$quadra = $_POST['quadra'];
$dados[0] = 'Escolha';
      include "conexao.php";
                $query_amigo = "SELECT * FROM lote where produto_idproduto = '$quadra' order by idlote Asc ";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idlote       = $reg["idlote"];
             $lote          = $reg["lote"];
          
         $frente          = $reg["frente"];
             
 

$dados[$idlote] =  $lote;

}


echo json_encode($dados);



?>