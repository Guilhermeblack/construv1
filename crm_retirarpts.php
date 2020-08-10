<?php
if (isset($_POST['ctr'])) {
	
$imobb = $_POST['ctr'];
$interesse = $_POST['int'];

      include "conexao.php";
      $html = "";
                $query_amigo = "SELECT * FROM cliente WHERE imob_id = $imobb";


                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idlote       = $reg["idcliente"];
             $lote          = $reg["nome_cli"];
          
            $querysoma = "SELECT SUM(crm_pontostatus) AS pontos, path_foto FROM crm_atendimento INNER JOIN crm_status ON crm_tratastatus = crm_idstatus INNER JOIN cliente ON crm_idcorretor = idcliente INNER JOIN crm_cli ON crm_id = crm_idcli WHERE crm_idcorretor = $idlote AND crm_tratadescricao != 'Alerta!!!' AND crm_tratadescricao NOT LIKE 'Editado em%' AND crm_interesse = $interesse";
            $execsoma = mysqli_query($db, $querysoma);
            $x = mysqli_fetch_assoc($execsoma);
            $pts = $x["pontos"];
			$foto = $x["path_foto"];

            if (is_null($foto) OR $foto == "") {
            	$foto = "img/perfil/foto_default.jpg";
            }

   $html.="<li ><img onclick='modalpts($idlote);' id='corretorpts' src='$foto' alt='$lote' /><h4 class='username text-ellipsis'>$lote<small class='badge badge-success' style='color: white;'> $pts Pontos</small></h4></li>";


} 


$dados["conteudo"] = $html;



} elseif (isset($_POST['id'])) {
	
	
$imobb = $_POST['id'];

      include "conexao.php";
      $html = "";
                $query_amigo = "SELECT * FROM empreendimento_imob 
                          	INNER JOIN cliente ON idcliente = imobiliaria_id 
                          	WHERE empreendimento_id = $imobb";


                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($reg2 = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idlote       = $reg2["idcliente"];
             $lote          = $reg2["nome_cli"];
          
            $querysoma = "SELECT SUM(crm_pontostatus) AS pontos, path_foto FROM crm_atendimento INNER JOIN crm_status ON crm_tratastatus = crm_idstatus INNER JOIN cliente ON crm_idcorretor = idcliente INNER JOIN crm_cli ON crm_id = crm_idcli WHERE (imob_id = $idlote OR idcliente = $idlote) AND crm_tratadescricao != 'Alerta!!!' AND crm_tratadescricao NOT LIKE 'Editado em%' AND crm_interesse = $imobb";

            $execsoma = mysqli_query($db, $querysoma);
            $x = mysqli_fetch_assoc($execsoma);
            $pts = $x["pontos"];
              if (is_null($pts)) {
              	$pts = "0";
              }

            $foto = $x["path_foto"];

            if (is_null($foto) OR $foto == "") {
            	$foto = "img/perfil/foto_default.jpg";
            }

$html.="<li ><img onclick='modalpts($idlote);' id='corretorpts' src='$foto' alt='$lote' /><h4 class='username text-ellipsis'>$lote<small class='badge badge-success' style='color: white;'> $pts Pontos</small></h4></li>";


} 


$dados["conteudo"] = $html;


}

echo json_encode($html);



?>