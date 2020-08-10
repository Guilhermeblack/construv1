<?php
 
$os = $_POST['os'];

      include "conexao.php";
                $query_amigo = "SELECT * FROM produto where empreendimento_idempreendimento = '$os' order by idproduto Desc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idproduto       = $reg["idproduto"];
             $quadra          = $reg["quadra"];
          
        
             

$dados[$idproduto] =  $quadra;


}


echo json_encode($dados);



?>