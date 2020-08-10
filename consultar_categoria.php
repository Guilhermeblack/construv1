<?php
 
$insumo_familia = $_POST['idfamilia'];
$dados[0] = 'Escolha';
      include "conexao.php";
                $query_familia = "SELECT * FROM insumo_familia_categoria
                				  INNER JOIN insumo_categoria ON insumo_familia_categoria.categoria_id = insumo_categoria.iddescricao_categoria
                                where familia_id = $insumo_familia 
                                order by descricao_categoria Asc";

                $executa_familia = mysqli_query ($db,$query_familia) or die ("Erro ao listar Insumo Familia");
                
                
            while ($reg_familia = mysqli_fetch_assoc($executa_familia)) {//--verifica se são amigos
           
             $descricao_categoria     = $reg_familia["descricao_categoria"];
             $iddescricao_categoria   = $reg_familia["iddescricao_categoria"];
          		


 

$dados[$iddescricao_categoria] =  $descricao_categoria;

}


echo json_encode($dados);



?>