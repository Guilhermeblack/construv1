<?php 

$idparcelas_cheque  	= $_GET["idparcelas_cheque"];
$antecipar   			= $_GET["antecipar"];



include "conexao.php";


$deleta_album = mysqli_query($db, "DELETE FROM parcelas_cheque WHERE idparcelas_cheque='$idparcelas_cheque'");


?>


 <form action="receber_parcelas_areceber.php" method="GET" name="nome">

                                <?php  foreach($antecipar as $id){  ?>
                    <input type="hidden" name="antecipar[]"    value="<?php echo $id ?>">  
                    <?php } ?>   

 </form>

 <script type="text/javascript">
 	document.nome.submit();
 </script>