<?php
 
$os = $_POST['os'];
$dados[0] = 'Escolha';
      include_once "conexao.php";
                $query_amigo = "SELECT * FROM projeto_etapa
                				INNER JOIN pacotes ON projeto_etapa.pacotes_id = pacotes.id
                				INNER JOIN projetos ON projeto_etapa.projeto_id = projetos.id
                				INNER JOIN empreendimento_cadastro ON projetos.empreendimento_id = empreendimento_cadastro.idempreendimento_cadastro
                				where idempreendimento_cadastro = '$os' order by nome Asc ";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $nome       = $reg["nome"];
             $id         = $reg["pacotes_id"];        
       
             
 

$dados[$id] =  $nome;

}


echo json_encode($dados);



?>