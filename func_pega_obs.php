

    <?php 
   
 		if(isset($_POST['idpar']) &&  !empty($_POST['idpar'])){

  
              $idparcela = $_POST['idpar'];
             
              $dados =  verificaRemessaParcela($idparcela);

              echo json_encode($dados);

  
          }
  


   function verificaRemessaParcela($idparcela){
              include "conexao.php";
            
              $query = mysqli_query($db, "SELECT obs_parcela FROM parcelas where idparcelas = '$idparcela'");
              $busca = mysqli_fetch_assoc($query);

              $remessa =  html_entity_decode($busca['obs_parcela']);
              //$remessa = "DEU CERTO";

              return $remessa;

        }


  ?>







