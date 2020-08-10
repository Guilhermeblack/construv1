<?php


require 'vendor/vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


 function envia_email($cod_chamado,$titulo_chamado,$desc_chamado,$ip_chamado, $dominio_chamado, $aberto_por_chamado,$data_chamado, $tipo_chamado ,$email_dest,$id_chamado_tratar, $desc_chamado_tratar, $stat_chamado_tratar, $data_tratativa, $email_abertura, $env_email_para_cliente){




//tratamento data e hora chamado
  $data = substr($data_chamado,0, -13).substr($data_chamado,8, -8);

  $hora = substr($data_chamado,-8);


//tratamento data e hora tratativa chamado

  $data_trat = substr($data_tratativa,0, -13).substr($data_tratativa,8, -8);

  $hora_trat = substr($data_tratativa,-8);


  

  $id_cliente = $_SESSION["id_usuario"];


  include "conexao.php";

  $query_email_cliente = "SELECT * FROM cliente where idcliente = $id_cliente";

  $executa_email = mysqli_query($db, $query_email_cliente)or die(mysqli_error('alindo'));


           $buscar_email = mysqli_fetch_assoc($executa_email);
             
           $email_usuario             = $buscar_email['email_cli'];           
           


           



  
 // Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function


//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host = 'br918.hostgator.com.br';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username = 'correio@immobileb.com.br';
	  $mail->Password = 'pao123';                              // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    


    //Recipients
    $mail->setFrom('correio@immobile.com.br', 'IMMOBILE');
    $mail->addAddress($email_dest, '');     // Add a recipient
    $mail->addAddress($email_usuario, '');

    if($email_abertura <> "" && $env_email_para_cliente == "S"){
       $mail->addAddress($email_abertura, $aberto_por_chamado);
    }

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Chamados do sistema';

  //  $mail->Body = $descricao_tratar;
    $mail->Body    = "
      <!doctype html>
      <html>
         <head> 
            <meta charset='utf-8'>
            <style>

            table, th, td {
              border: 1px solid black;
              border-collapse: collapse;
          }


          th, td {
              padding: 15px;
          }


          th, td {
              text-align: left;
          }

          th{
             background-color: #CCCCCC;
          }


          table {
              border-spacing: 5px;
          }


            </style>


         <head>
         <body>

         <table style='width:100%'>
          <tr>
           <th><b>Codigo Chamado:</b></th>
           <th><b>Titulo Chamado:</b></th>
           <th><b>Descricao Chamado:</b></th>
           <th><b>Ip Maquina:</b></th>
           <th><b>Dominio Chamado:</b></th>
           <th><b>Aberto por:</b></th>
           <th><b>Data Abertura:</b></th>
           <th><b>Tipo Chamado:</b></th>
       
         </tr>

         <tr>



           <td><p><span>". $cod_chamado  ."</span></p></td>
           <td><p><span>". $titulo_chamado  ."</span></p></td>
           <td><p><span>". $desc_chamado  ."</span></p></td>
           <td><p><span>". $ip_chamado  ."</span></p></td>
           <td><p><span>". $dominio_chamado  ."</span></p></td>
           <td><p><span>". $aberto_por_chamado  ."</span></p></td>
           <td><p><span>". $data . "<br>". $hora  ."</span></p></td>
           <td><p><span>". $tipo_chamado  ."</span></p></td>
         </tr>
       
        </table>

        <br>
        <br>
      

         <table style='width:100%' >
          <tr>
           <th><b>Codigo Tratativa:</b></th>
           <th><b>Descricao Tratativa:</b></th> 
           <th><b>Data Tratativa:</b></th> 
           <th><b>Status Chamado:</b></th>
         </tr>
         <tr>
           <td><p><span>". $id_chamado_tratar  ."</span></p></td>
           <td><p><span>". $desc_chamado_tratar  ."</span></p></td> 
           <td><p><span>". $data_trat . "<br>". $hora_trat  ."</span></p></td>
           <td><p><span>". $stat_chamado_tratar  ."</span></p></td>
         </tr>
       
        </table>
                  

    </body>

      </html>   " ;


    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
   echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


 
}
  




?>
