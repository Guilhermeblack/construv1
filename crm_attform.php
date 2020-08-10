


<?php 

function grava_alerta($id, $idcli, $idstatus, $idcorretor){

	include "conexao.php";
$data = date('d-m-Y');
$hora = date('H:i:s');

	$query = "INSERT INTO crm_atendimento (crm_tratadescricao, crm_tratadata, crm_horacad, crm_idcli, crm_tratastatus, crm_idcorretor) VALUES ('Alerta!!!', '$data', '$hora', $idcli, $idstatus, $idcorretor)";

	$executa = mysqli_query($db, $query);

	return 1;
}



        include "conexao.php";

$query_amigo = "SELECT * FROM crm_cli";
date_default_timezone_set('America/Sao_Paulo');

$crm_data_agora 	  = date('d-m-Y H:i:s');

$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                
                $id  			= $buscar_amigo["crm_id"];
$query_amigo4 = "SELECT * FROM crm_atendimento inner join crm_status on crm_tratastatus = crm_idstatus WHERE crm_idcli = $id ORDER BY crm_trataid desc limit 1";
$executa_query4 = mysqli_query ($db,$query_amigo4) or die ("Erro ao listar contatos");

                while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query4)) {

                $id_att             = $buscar_amigo2["crm_trataid"];
                $tempo                = $buscar_amigo2["crm_horasatt"];
                $dias                = $buscar_amigo2["crm_diasatt"];
                $horascad                = $buscar_amigo2["crm_horacad"];
                $data1                = $buscar_amigo2["crm_tratadata"];
                $idcli                = $buscar_amigo2["crm_idcli"];
                $tratastatus                = $buscar_amigo2["crm_tratastatus"];
                $idcorretor                = $buscar_amigo2["crm_idcorretor"];

                
        $separar = explode(":", $tempo);
        $horas = $separar[0];
        $minutos = $separar[1];
        $datacad = $data1 . " " . $horascad;
      
        $totalminutos = ($dias * 24) * 60 + ($horas * 60) +  $minutos;

         $vencimento = date('d-m-Y H:i:s', strtotime("+".$totalminutos." minutes",strtotime($datacad)));
if ($tratastatus == 18 || $tratastatus == 21) {

} elseif (strtotime($vencimento) < strtotime($crm_data_agora)) {
         	
         	$teste2 = grava_alerta($id_att, $idcli, $tratastatus, $idcorretor);
         }
}
}
   
 ?>

                