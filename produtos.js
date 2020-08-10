$(document).click( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#os').blur(function(){


           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_produto.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'os=' + $('#os').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
var $quadra = $('#quadra');
            $quadra.empty();
                  
            $.each(data, function(idproduto, quadra){
                   $quadra.append('<option value=' + idproduto + '>' + quadra + '</option>');
            });

              $quadra.change();        
                              
    
    
                    
                       
                 
                }
           });   
   return false;    
   })
});