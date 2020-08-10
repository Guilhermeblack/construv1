$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#lote').click(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_medidas.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'lote=' + $('#lote').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#frente').val(data.frente);
                        $('#fundo').val(data.fundo);
                        $('#direita').val(data.direita);
                        $('#esquerda').val(data.esquerda);
                        $('#valor').val(data.valor);
                        $('#m2').val(data.m2);
$('#valor_desconto2').val(data.valor);
$('#valor_desconto').val(data.valor);


                       
                    }
                }
           });   
   return false;    
   })
});