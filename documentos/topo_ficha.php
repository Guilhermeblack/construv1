<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
if (!isset($_SESSION)) {
  session_start();
}

?>
<tr>
       <?php 
include "../conexao.php";
                  $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];

         $query_amigo = "SELECT * FROM imobiliaria
                         WHERE idimobiliaria = $imobiliaria_idimobiliaria";



                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $nome_corretor      = $buscar_amigo['nome_imob'];
             $telefone_corretor  = $buscar_amigo["telefone"];
             $creci_corretor     = $buscar_amigo["creci"];
        } 

        ?>

            <td>
                <img src="../../s3-us-west-2.amazonaws.com/imagens.tecimob.com.br/_imagens/imobiliarias/logo/300_300/4732.png" alt="Hr Santos Emp.e Negocios Imb.ltda Me" width="120" height="60">
            </td>
            <td colspan="3">
                <strong>
                   <?php echo $nome_corretor; ?>
                </strong>
                <br>
                Telefone:  <?php echo $telefone_corretor; ?>
                - Creci: <?php echo $creci_corretor; ?>
                
                <br>
               
               <?php $data_hoje = date('d/m/Y'); ?>
                Data:
                 <?php echo $data_hoje; ?>
            </td>
            <td>
                Captador:
            </td>
            <td style="width: 238px" colspan="" rowspan="">
            </td>
        </tr>