<?php
 

#$dados[0] = 'Selecione';
$imobb = $_POST['id'];

      include "conexao.php";

                $query_amigo = "SELECT * FROM crm_equipe 
                          	INNER JOIN cliente ON idcliente = crm_equipe 
                          	";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idlote       = $reg["crm_equipe"];
             $lote          = $reg["nome_cli"];
          
            
             
 

$dados[$idlote] =  $lote;

} 

echo json_encode($dados);



?>