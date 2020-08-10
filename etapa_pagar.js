$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#os').click(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_etapa.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'os=' + $('#os').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
var $etapa = $('#etapa');
            $etapa.empty();

                  

            $.each(data, function(id, nome){
                   $etapa.append('<option value=' + id + '>' + nome + '</option>');
            });

              $etapa.change();        
                              
    
    
                    
                       
                 
                }
           });   
   return false;    
   })
});