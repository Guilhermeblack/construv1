<?php
 
$os = $_POST['os'];
$dados[0] = 'Escolha';
      include "conexao.php";
                $query_amigo = "SELECT * FROM produto
                				INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                				INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                				where idempreendimento_cadastro = '$os' order by idproduto Desc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idproduto       = $reg["idproduto"];
             $quadra          = $reg["quadra"];
          
        
             

$dados[$idproduto] =  $quadra;


}


echo json_encode($dados);



?>