﻿<?php 

$ver 				= $_POST["ver"];
                
            
include "conexao.php";
        
             foreach($ver as $id){

$atualiza_vista = mysqli_query($db, "DELETE FROM contatos  WHERE id='$id'");

}
  



?>
<script>
window.location ="contatos.php";
</script>