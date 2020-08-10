<?php 

$ver 				= $_POST["ver"];
                
            
include "conexao.php";
        
             foreach($ver as $id){
             

$atualiza_vista = mysqli_query($db, "DELETE FROM crm_origem WHERE crm_idorigem='$id'");

}
  



?>
<script>
window.location ="crm_cadorigem2.php";
</script>