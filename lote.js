$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#quadra').click(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_lote.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'quadra=' + $('#quadra').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
var $lote = $('#lote');
            $lote.empty();

                  

            $.each(data, function(idlote, lote){
                   $lote.append('<option value=' + idlote + '>' + lote + '</option>');
            });

              $lote.change();        
                              
    
    
                    
                       
                 
                }
           });   
   return false;    
   })
});