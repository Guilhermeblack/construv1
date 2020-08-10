<?php
 
$numero_boleto = $_POST['numero_boleto'];
      include "conexao.php";
              $query_amigo = "SELECT sum(idparcelas) as TOTAL FROM parcelas                		
                				        where numero_boleto = '$numero_boleto'";

                $executa_query = mysqli_query ($db,$query_amigo);
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcliente       = $reg["TOTAL"];          
             
 }

   if($idcliente == null){ 

       $dados['sucesso'] = 2;
     }else{
      $dados['sucesso'] = 1;      
     }


echo json_encode($dados);



?>