<?php 

$ver 				= $_POST["ver"];
                
            
include "conexao.php";
        
             foreach($ver as $id){
             
if ($id != 20) {
	# code...

$atualiza_vista = mysqli_query($db, "DELETE FROM crm_status WHERE crm_idstatus = '$id'");
} else die ("Não é permitido excluir este status." . header('Location: crm_cadstatus.php?stt=1' ));

}
  



?>
<script>
window.location ="crm_cadstatus.php?stt=2";
</script>