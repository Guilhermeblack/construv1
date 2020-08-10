<?php
 
$idtipo = $_POST['idtipo'];
$dados[0] = 'Escolha';
      include "conexao.php";
                $query_amigo = "SELECT * FROM imov_subtipo where tipo_id = $idtipo order by descricao_zap Asc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");               
         
          
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           

             $idsubtipo       = $reg["idsubtipo"];
             $descricao_zap   = $reg["descricao_zap"];
          
             
 

$dados[$idsubtipo] =  $descricao_zap;

}


echo json_encode($dados);



?>