<?php

	
$tp = $_POST['success'];


include "conexao.php";

                        $query_amigo = "SELECT * FROM crm_status";                      
                        $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar Fiadores");
                     $html =""; $sstatus[] = ""; 
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $ids             = $buscar_amigo['crm_idstatus'];
                  $nomes            = $buscar_amigo["crm_status"];             
                 
                  $qquery = "SELECT * FROM crm_painel WHERE crm_tipopainel = $tp";
                  $eexec = mysqli_query($db, $qquery) or die("Impossível localizar status."); 
                  while ($bbusca = mysqli_fetch_assoc($eexec)) {
                    $string = "";
                  $sstatus[] = $bbusca["crm_statuspainel"];
                  //if ($ids == $sstatus) { $string = "selected"; } else {$string = "";}
                }
                if (!is_null($sstatus)) {                
                  if (in_array($ids, $sstatus)) {
                    $string = "selected";
                  } else $string = "";
                  $html.="<option value='$ids' $string > $nomes </option>";
                }}

echo json_encode($html);

?>