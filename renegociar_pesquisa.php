<?php

$idvenda = $_GET["idvenda"];


                include_once "conexao.php";
                $query_amigo = "SELECT * FROM venda where idvenda = $idvenda";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
             	  $idvenda           	= $buscar_amigo["idvenda"];
			 



$dados["idvenda"] = $idvenda;
}
echo json_encode($dados);

                 
                