<?php
 
$idlote = $_POST['idlote'];
$cx = $_POST['cx'];
$cy = $_POST['cy'];
   
     include "conexao.php";
                $query_amigo = "UPDATE lote SET cx ='$cx', cy = '$cy' WHERE idlote = '$idlote'";
                echo $query_amigo;
                $executa_query = mysqli_query ($db,$query_amigo);
                

?>