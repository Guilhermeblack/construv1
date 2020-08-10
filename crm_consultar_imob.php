<?php
 
 
#$dados[0] = 'Selecione';
$imobb = $_POST['id'];

      include "conexao.php";

                $query_amigo = "SELECT * FROM empreendimento_imob 
                          	INNER JOIN cliente ON idcliente = imobiliaria_id 
                          	WHERE empreendimento_id = $imobb";


                 $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idlote       = $reg["imobiliaria_id"];
             $lote          = $reg["nome_cli"];
             #$datapts = contapts($imobb, $idlote);
          
            $dados[$idlote] =  $lote;

            

} 

echo json_encode($dados);



?>