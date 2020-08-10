<?php
 
$idsubtipo = $_POST['idsubtipo'];
$dados[0] = 'Escolha';
      include "conexao.php";
                $query_amigo = "SELECT * FROM imov_categoria where subtipo_id = $idsubtipo order by descricao_zap Asc ";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idcategoria     = $reg["idcategoria"];
             $descricao_zap   = $reg["descricao_zap"];
          
             
 

$dados[$idcategoria] =  $descricao_zap;

}


echo json_encode($dados);



?>