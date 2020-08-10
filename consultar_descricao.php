<?php
 
$insumo_categoria = $_POST['idcategoria'];
$dados[0] = 'Escolha';
      include "conexao.php";
                $query_familia = "SELECT * FROM insumo_categoria_descricao
                				  INNER JOIN insumo_descricao ON insumo_categoria_descricao.descricao_id = insumo_descricao.idinsumo_descricao
                                where categoria_id = $insumo_categoria 
                                order by descricao_insumo Asc";

                $executa_familia = mysqli_query ($db,$query_familia) or die ("Erro ao listar Insumo Familia");
                
                
            while ($reg_familia = mysqli_fetch_assoc($executa_familia)) {//--verifica se são amigos
           
             $descricao_insumo     = $reg_familia["descricao_insumo"];
             $idinsumo_descricao   = $reg_familia["idinsumo_descricao"];
          		


 

$dados[$idinsumo_descricao] =  $descricao_insumo;

}


echo json_encode($dados);



?>