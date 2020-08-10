<?php
 
$contacorrente_id = $_POST['contacorrente_id'];
      include "conexao.php";
                $query_amigo = "SELECT * FROM folha_cheque
                				INNER JOIN cheque ON folha_cheque.cheque_id = cheque.idcheque
                				where contacorrente_id = '$contacorrente_id' AND situacao_folha = 0
                				order by idfolha_cheque Asc limit 1";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idfolha_cheque    		= $reg["idfolha_cheque"];
             $numero_cheque    		    = $reg["numero_cheque"];

             $descricao_folha = "Folha Nº: ".$numero_cheque;
            
             

$dados[$idfolha_cheque] =  $descricao_folha;


}


echo json_encode($dados);



?>