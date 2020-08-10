//EFEITOS PARA APLICAR MASCARA DE DINHEIRO 
$(document).on('blur', '#valor_tarefa', function(){

	let aux = $(this).val();

	aux = parseFloat(aux.replace(/[R$. ]/g, '').replace(/,/g, '.'));

	isNaN(aux) ? aux = 0 : '';

	aux = aux.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

	// console.log(aux);
	$(this).val(aux);
});


//EFEITOS PARA APLICAR MASCARA DE DINHEIRO
$(document).on('focus', '#valor_tarefa', function(){
	$(this).val('');
});

//ROTINA PARA ABRIR VARIAS MODALS
$("#modal-dialog").on('hide.bs.modal', function () {  
	return false
});

//ROTINA PARA GRAVAR NOVA TAREFA PARA UM SUB EMPREENDIMENTO
$('a#salvar_tarefa').click(function(e){

	e.preventDefault();

	let dados_serealize = $('#cad_tarefa_sub_empre').serialize();

	let tarefa = $('select#select_tarefa > option:selected').val();
	let equipe = $('select#select_equipe > option:selected').val();
	let sub_empre = $('select#select_sub_empre > option:selected').val();
	let data_inicio = $('input#input_data_inicio').val();
	let data_fim = $('input#input_data_fim').val();


	if(tarefa != -1 && equipe != -1 && sub_empre != -1 && data_inicio != '' && data_fim != ''){

		$.ajax({  
			url:'const_grava_gerencia.php',  
			method:'POST', 
			data: dados_serealize,
			dataType: 'html',
			success: dados => 	
			{  	
				// console.log(1);

				$('button#reset').click();

				$('div#modal-cad-tarefa').modal('hide');
				$('div#modal-dialog').modal('show');

			},
			error: erro => {console.log(0)}  
		}); 


	}else{	
		alert('Preencha todos os campos corretamente!');
	}
});

//ROTINA PARA ADICIONAR OS SUB-EMPREENDIMENTOS NO SELECT CORRESPONDENTE E FILTRAR APENAS TAREFAS DESSE EMPREENDIMENTO
$('select#empre').change(function(){

	let empreendimento = $(this).find('> option:selected').val();

	//Limpo as opções do select de orçamento
	$("select#orcamento").find('> option:not(option[value="-1"])').each(function(){
		$(this).detach();
	});

    if(empreendimento != -1){

    	$('tbody#myTable > tr:not(tr.hidden)').each(function(){
    		$(this).hide();
    	});

        $.ajax({
           url:   'const_grava_gerencia.php',
           type:  'POST',
           //cache: false,
           //data:  { ok : 'deu certo!'},
            data: {lista_orcamento:empreendimento}, //essa e o padrao x-www-form-urlencode
            dataType:'json',  

           success: function(data) { 
                if(data != 0){
                    for(let i in data){
                        $("select#orcamento").append('<option value="'+data[i].id+'" data-finalizado="'+data[i].data_finalizado+'">'+data[i].titulo+'</option>');                        
                    }
                }
           },
           error: function() {
                console.log(0);
           }
        });

        setTimeout(function(){
        	$.ajax({
        	   url:   'const_grava_gerencia.php',
        	   type:  'POST',
        	   //cache: false,
        	   //data:  { ok : 'deu certo!'},
        	    data: {filtra_empreendimento:empreendimento}, //essa e o padrao x-www-form-urlencode
        	    dataType:'json',  

        	   success: function(data) { 
        	        // console.log(data);
        	        
        	   		for(let i in data){

        	   			if($('tbody#myTable > tr[id-tarefa="'+data[i].id+'"]').length){
        	   				$('tbody#myTable > tr[id-tarefa="'+data[i].id+'"]').show();
        	   			}

        	   		}

        	   },
        	   error: function(error) {
        	        console.log("oi");
        	   }
        	});
        }, 500);

    }else{
    	$('tbody#myTable > tr:not(tr.hidden)').each(function(){
    		$(this).show();
    	});
    }
});

//FILTRAR APENAS TAREFAS DESSE EMPREENDIMENTO
$('select#orcamento').change(function(){

	let orc = $(this).find('> option:selected').val();

	$('tbody#myTable > tr:not(tr.hidden)').each(function(){
		$(this).hide();
	});

	setTimeout(function(){
		$.ajax({
		   url:   'const_grava_gerencia.php',
		   type:  'POST',
		   //cache: false,
		   //data:  { ok : 'deu certo!'},
		    data: {filtra_empreendimento_vdd:orc}, //essa e o padrao x-www-form-urlencode
		    dataType:'json',  

		   success: function(data) { 
		        // console.log(data);
		        
		   		for(let i in data){

		   			if($('tbody#myTable > tr[id-tarefa="'+data[i].id+'"]').length){
		   				$('tbody#myTable > tr[id-tarefa="'+data[i].id+'"]').show();
		   			}

		   		}

		   },
		   error: function(error) {
		        console.log("oi");
		   }
		});
	}, 500);
});