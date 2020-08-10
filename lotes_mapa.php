<?php
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
 $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];
 $idrota                    = $_SESSION["idrota"];
 $idgrupo_acesso            = $_SESSION["idgrupo_acesso"];
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1


$empreendimento_id = $_GET["empreendimento_id"];

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .draggable {
    cursor: move;
}

    </style>


     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
function envia_dados(id){

window.location="reserva_lote.php?idlote="+ id;


}
</script>

    </head>
<body>
    <?php if (in_array('31', $idrota)) { ?>

    <?php if(isset($_GET["edit"])){ ?>

     <center>
    <input type="submit" name="editar" value="Finalizar Edição" class="btn btn-success" onclick="location.href='lotes_mapa.php?empreendimento_id=<?php echo $empreendimento_id ?>';"></center>

    <br>

<?php }else{ ?>
    <center>
    <input type="submit" name="editar" value="Editar Posições" class="btn btn-warning" onclick="location.href='lotes_mapa.php?edit=1&empreendimento_id=<?php echo $empreendimento_id ?>';"></center>

    <br>

    <?php } } ?>

    <?php

include "conexao.php";
    $query_to = "SELECT  img_mapa, idempreendimento_cadastro FROM empreendimento 
                    INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                    where idempreendimento = $empreendimento_id";

    $executa_to = mysqli_query ($db,$query_to);
                
                
    while ($buscar_to = mysqli_fetch_assoc($executa_to)) {//--verifica se são amigos
           
             $img_mapa                      = $buscar_to['img_mapa'];
             $empreendimento_cadastro_id    = $buscar_to['idempreendimento_cadastro'];


         }

?>






<?php
include "conexao.php";
    $query_total = "SELECT count(idlote) as total FROM produto 
                    INNER JOIN lote ON produto.idproduto = lote.produto_idproduto 
                    where empreendimento_idempreendimento = $empreendimento_id";

    $executa_total = mysqli_query ($db,$query_total);
                
                
    while ($buscar_total = mysqli_fetch_assoc($executa_total)) {//--verifica se são amigos
           
             $total       = $buscar_total['total'];

         }


 ?>

<svg id="svg" width="1800" height="1500" version="1.1"
  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
   <image xlink:href="/mapa/<?php echo $empreendimento_cadastro_id ?>/<?php echo $img_mapa ?>" height="100%" width="100%"/>

</svg>


<script type="text/javascript">

        $(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});
</script>



<script type="text/javascript">


        var svg = document.querySelector('svg');

//data to control drag'n drop 
var ddData = {
    element: null,
    initialX: 0,
    initialY: 0, 
    originalX: 0,
    originalY: 0,
    lineEnd: null,
    lineStart: null
};

//number of dots on the line
var steps = <?php echo $total ?>, originX = 60, originY = 450;

//distance between circles
var stepX = (450 - 60) / (steps + 1);
var stepY = stepX;

//create lines
var lines = [];

<?php     include "conexao.php";

    $query_amigo = "SELECT * FROM produto 
                     INNER JOIN lote ON produto.idproduto = lote.produto_idproduto
                     where empreendimento_idempreendimento = $empreendimento_id
                     order by idproduto, idlote Asc";

    $executa_query = mysqli_query ($db,$query_amigo);
                
          $i = 0;      
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idlote       = $buscar_amigo['idlote'];
             $quadra       = $buscar_amigo['quadra'];
             $lote         = $buscar_amigo["lote"];
             $status       = $buscar_amigo["status"];
             $m2           = $buscar_amigo["m2"];
             $valor        = $buscar_amigo["valor"];

             $cx        = $buscar_amigo["cx"];
             $cy        = $buscar_amigo["cy"];

             $valor = 'R$ ' . number_format($valor, 2, ',', '.'); 

           ?>



    var x = stepX * (<?php echo $i ?> + 1);
    var y = stepY * (<?php echo $i ?> + 1);
    
    //create circle
    var shape = document.createElementNS(
        "http://www.w3.org/2000/svg", "circle");

  

    <?php if($cx != 0 AND $cy != 0){ ?>

    shape.setAttributeNS(null, "cx", "<?php echo $cx ?>");
    shape.setAttributeNS(null, "cy", "<?php echo $cy ?>" );
    
    <?php }else{ ?>
    shape.setAttributeNS(null, "cx", "40");
    shape.setAttributeNS(null, "cy", "40");

    <?php } ?>

    shape.setAttributeNS(null, "id", "r<?php echo $idlote ?>" );
    shape.setAttributeNS(null, "data-value", <?php echo $idlote ?> );
    shape.setAttributeNS(null, "data-toggle", "popover" );
    shape.setAttributeNS(null, "data-html", "true" );
    shape.setAttributeNS(null, "data-title", "Quadra: <?php echo $quadra ?>/ Lote: <?php echo $lote ?> <button id='close'>x</button>" );
   


 if(<?php echo $status ?> == 1){
    shape.setAttributeNS(null, "data-content", "M²: <?php echo $m2 ?> <br> Valor: <?php echo $valor ?><br><input type='submit' value='Reservar Lote' class='btn btn-success m-r-5 m-b-5' onclick='envia_dados(<?php echo $idlote ?>)';'>");
 } 

 if(<?php echo $status ?> == 2){
    shape.setAttributeNS(null, "data-content", "M²: <?php echo $m2 ?> <br> Valor: <?php echo $valor ?><br><input type='submit' value='Vendido' class='btn btn-danger m-r-5 m-b-5'>");
 } 

 if(<?php echo $status ?> == 3){
    shape.setAttributeNS(null, "data-content", "M²: <?php echo $m2 ?> <br> Valor: <?php echo $valor ?><br><input type='submit' value='Bloqueado' class='btn btn-inverse m-r-5 m-b-5'>");
 } 

 if(<?php echo $status ?> == 0){
    shape.setAttributeNS(null, "data-content", "M²: <?php echo $m2 ?> <br> Valor: <?php echo $valor ?><br><input type='submit' value='Reservado' class='btn btn-warning m-r-5 m-b-5'>");
 } 






   
    shape.setAttributeNS(null, "data-container", "body" );
    shape.setAttributeNS(null, "r", 5);

    if(<?php echo $status ?> == 2){
    shape.setAttributeNS(null, "fill", "red");
    }

    if(<?php echo $status ?> == 0){
        shape.setAttributeNS(null, "fill", "orange");
    }

     if(<?php echo $status ?> == 1){
        shape.setAttributeNS(null, "fill", "green");
    }

         if(<?php echo $status ?> == 3){
        shape.setAttributeNS(null, "fill", "black");
    }

<?php if(isset($_GET["edit"])){ ?>
    shape.setAttributeNS(null, "class", "draggable");
    <?php } ?>
    shape.setAttributeNS(null, "order", <?php echo $i ?>);


    svg.appendChild(shape);


<?php if(isset($_GET["edit"])){ ?>
    
    //start moving circle
    shape.onmousedown = function(evt) {
        var evt = evt || window.event;
        ddData.element = evt.target || evt.srcElement;
        ddData.initialX = evt.clientX;
        ddData.initialY = evt.clientY;
        ddData.originalX = parseFloat(
            ddData.element.getAttributeNS(null, "cx"));
        ddData.originalY = parseFloat(
            ddData.element.getAttributeNS(null, "cy"));
        var order = parseInt(
            ddData.element.getAttributeNS(null, "order"));
        ddData.lineEnd = lines[order];
        ddData.lineStart = lines[order+1];
    };

<?php } ?>


<?php $i = $i + 1; } ?>

//handle mouse movement to drag circles
svg.onmousemove = function(evt) {
    var evt = evt || window.event;
    if (ddData.element) {
        var posX = ddData.originalX + evt.clientX - ddData.initialX;
        var posY = ddData.originalY + evt.clientY - ddData.initialY;
        //move object





        ddData.element.setAttributeNS(null, "cx", posX);
        ddData.element.setAttributeNS(null, "cy", posY);

        ddData.element.setAttributeNS(null, "data-cx", posX);
        ddData.element.setAttributeNS(null, "data-cy", posY);  



    }
};

//stops drag movement
svg.onmouseup = function(evt) {
    var evt = evt || window.event;
    ddData.element = null;
}


<?php if(isset($_GET["edit"])){ ?>

$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
<?php     include "conexao.php";

    $query_amigo = "SELECT * FROM produto 
                     INNER JOIN lote ON produto.idproduto = lote.produto_idproduto
                     where empreendimento_idempreendimento = $empreendimento_id
                     order by idproduto, idlote Asc";

    $executa_query = mysqli_query ($db,$query_amigo);
                
          $i = 0;      
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $idlote       = $buscar_amigo['idlote'];

           ?>



    $("#r<?php echo $idlote ?>").click(function(){

  //  var data = $(this).data("value");

  //  var numcx = $(this).data("cx");
  //  var numcy = $(this).data("cy");


var element = document.querySelector('#r<?php echo $idlote ?>');

var data = element.dataset.value;
var numcx = element.dataset.cx;
var numcy = element.dataset.cy;


           /* Configura a requisição AJAX */
           $.ajax({
                url : 'grava_xy.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'idlote=' + data + '&cx=' + numcx + '&cy=' + numcy, /* dado que será enviado via POST */
                dataType: 'json'
            
           });   
   return false;    
   })


<?php } ?>


});

<?php } ?>
    </script>




    <script type="text/javascript">
        $(document).on('click', 'button#close', function () {


    $('.popover').popover('hide');
});
    </script>
</body>
</html>