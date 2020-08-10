$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#valor').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_valor.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'valor=' + $('#valor').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#rua').val(data.rua);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.cidade);
                        $('#estado').val(data.estado);
 
                        $('#numero').focus();
                    }
                }
           });   
   return false;    
   })
});