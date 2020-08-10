<?php
 
$lote = $_POST['lote'];

      include_once "conexao.php";
                $query_amigo = "SELECT * FROM lote where idlote = '$lote'";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idlote       = $reg["idlote"];
          
          
         $frente          = $reg["frente"];
         $fundo          = $reg["fundo"];
         $direita          = $reg["direita"];
         $esquerda          = $reg["esquerda"];
         $valor          = $reg["valor"];
               $m2          = $reg["m2"];
 
$dados['sucesso'] =  1;
$dados['frente'] =  $frente;
$dados['fundo'] =  $fundo;
$dados['direita'] =  $direita;
$dados['esquerda'] =  $esquerda;
$dados['valor'] =  $valor;
$dados['m2'] =  $m2;
}


echo json_encode($dados);



?>