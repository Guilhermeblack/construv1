<?php
 


$celular = $_POST['celular'];


                include "conexao.php";
                $query_amigo = "SELECT sum(crm_id) as TOTAL FROM crm_cli                		
                				        where crm_celular = '$celular'";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcliente               = $reg["TOTAL"];          
                    

             
             
 }
       if($idcliente == ''){ 

       $dados['sucesso'] = 2;
             

     }else{
      $dados['sucesso'] = 1;      
            
     }

echo json_encode($dados);



?>
