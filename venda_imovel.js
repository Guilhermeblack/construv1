$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#imovel_idimovel').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_medidas_venda.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'imovel_idimovel=' + $('#imovel_idimovel').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                 
                        $('#valor').val(data.valor);
                  
                       
                    }
                }
           });   
   return false;    
   })
});