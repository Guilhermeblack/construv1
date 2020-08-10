<?php 

$ver 				= $_POST["ver2"];
                
            
include "conexao.php";
        
             foreach($ver as $id){

$queryex = "DELETE FROM crm_cli WHERE crm_id='$id'";


$queryatt = "DELETE FROM crm_atendimento WHERE crm_trataid='$id'";

$queryimob = "DELETE FROM crm_roleta_imob WHERE crm_idcli='$id'";

$querycorr = "DELETE FROM crm_roleta_corretor WHERE crm_idcli='$id'";



$execex = mysqli_query($db, $queryex) or die("Impossível excluir!") . header('Location: crm_tratalead.php?ex=2');
$execatt = mysqli_query($db, $queryatt) or die("Impossível excluir!") . header('Location: crm_tratalead.php?ex=2');
$execatt = mysqli_query($db, $queryimob) or die("Impossível excluir!") . header('Location: crm_tratalead.php?ex=2');
$execatt = mysqli_query($db, $querycorr) or die("Impossível excluir!") . header('Location: crm_tratalead.php?ex=2');

}
  



?>
<script>
window.location ="crm_tratalead.php?ex=1";
</script>