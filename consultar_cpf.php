<?php
 
function busca_grupo($idgrupo){
  $descricao_grupo_cliente = 0;
     include "conexao.php";
                $query_slide = mysqli_query($db,"SELECT * FROM grupo_cliente
                                                WHERE idgrupo_cliente = $idgrupo"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $descricao_grupo_cliente  = $buscar_slide["descricao"];

            }
return $descricao_grupo_cliente;
}

$cpf = $_POST['cpf'];


                include "conexao.php";
                $query_amigo = "SELECT sum(idcliente) as TOTAL, categoria_cliente FROM cliente                		
                				        where cpf_cli = '$cpf'";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcliente               = $reg["TOTAL"];          
             $categoria_cliente       = $reg["categoria_cliente"]; 

             if($categoria_cliente != ''){  

             $categoria_cliente =  busca_grupo($categoria_cliente);   
             }else{
              $categoria_cliente = '0';
             }
             
 }
       if($idcliente == ''){ 

       $dados['sucesso'] = 2;
       $dados['categoria_cliente'] = $categoria_cliente;      

     }else{
      $dados['sucesso'] = 1;      
      $dados['categoria_cliente'] = $categoria_cliente;      
     }

echo json_encode($dados);



?>
