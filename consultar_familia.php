<?php
 
$insumo_especie = $_POST['idespecie'];
$dados[0] = 'Escolha';
      include "conexao.php";
                $query_familia = "SELECT * FROM insumo_especie_familia
                				  INNER JOIN insumo_familia ON insumo_especie_familia.familia_id = insumo_familia.idfamilia_descricao 
                                where especie_id = $insumo_especie 
                                order by descricao_familia Asc";

                $executa_familia = mysqli_query ($db,$query_familia) or die ("Erro ao listar Insumo Familia");
                
               
            while ($reg_familia = mysqli_fetch_assoc($executa_familia)) {//--verifica se são amigos
           
             $descricao_familia     = $reg_familia["descricao_familia"];
             $idfamilia_descricao   = $reg_familia["idfamilia_descricao"];
          		


 

$dados[$idfamilia_descricao] =  $descricao_familia;

}


echo json_encode($dados);



?>