<?php 

$ver 				= $_POST["ver"];
                
include "conexao.php";

       $deletar = ("DELETE FROM crm_equipe");
       mysqli_query($db, $deletar);

             foreach($ver as $id){

$inserir = ("INSERT INTO crm_equipe (   
	crm_equipe

)
values (   
'$id'


)
");
mysqli_query($db, $inserir);
}

?>
<script>
window.location ="crm_equipe.php";
</script>