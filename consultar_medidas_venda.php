<?php
 
$imovel_idimovel = $_POST['imovel_idimovel'];

      include_once "conexao.php";
                $query_amigo = "SELECT * FROM imovel where idimovel = '$imovel_idimovel'";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
         
         $valor          = $reg["preco_venda"];
              
 
$dados['sucesso'] =  1;

$dados['valor'] =  $valor;

}


echo json_encode($dados);



?>