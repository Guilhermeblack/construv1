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

	console.log(dados_serealize);
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

		console.log(empreendimento,' <<<< aq');

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



























// ROTINA PARA ABRIR A TABELA DE MEDIÇÕES JA FEITAS
$('a#medicao').click(function(){

	$('tbody#lista_medicao > tr:not(tr.hidden)').each(function(){
		$(this).detach();
	});

	let id_tarefa = $(this).parents('tr').attr('id-tarefa');
	let fechado = $(this).parents('tr').attr('finalizado');

	let unidade = $(this).parents('tr').find('> td').eq(6).text();

	$('div#medicao_tarefa').attr('id-tarefa-sub', id_tarefa);

	console.log(id_tarefa);

	$.ajax({  
		url:'const_grava_gerencia.php',  
		method:'POST', 
		data: {lista_medicao:id_tarefa},
		dataType: 'json',
		success: dados => 	
		{  	

			// console.log(dados);
			// if(dados == invalid){

			// 	alert('ação inválida');
			// }

			if(dados != 1){

				let tmed =0;
				let total = 0;
				let vlr= 0;

				//monta tabela das mediçoes
				for(let i in dados){

					//dados ja traz os tudo da lista de medição daquele id
					total += Number(dados[i].qnt_medida);
					
					vlr = Number(dados[i].vlr_med);
					// tot_medido += dados[i].qnt_medida;
					// dados[i].qnt_medida ultima medida
					console.log(vlr);


					let tr = $('tbody#lista_medicao > tr.hidden').clone(true).removeClass('hidden');

					tr.attr('id-medicao', dados[i].id);

					tr.find('> td').eq(0).text(dados[i].id);
					tr.find('> td').eq(1).text(dados[i].nome_cli);
					tr.find('> td').eq(2).text(dados[i].data_medicao);
					tr.find('> td').eq(3).text(dados[i].qnt_medida);
					// tr.find('> td').eq(4).text(tot_medido);

					tr.find('> td').eq(4).text(vlr.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
					tr.find('> td').eq(5).text((dados[i].qnt_medida * vlr).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

					$('tbody#lista_medicao').append(tr);
				}
				// console.log(total);
				// tmed = total * vlr;

				total > 0 ? $('span#total').html('<b>'+total+'</b> Pela equipe <b>'+unidade+'</b> no valor de <b>'+ (total* vlr).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})+'</b>'): '';
			}
		},
		error: erro => {console.log(0)}  
	}); 

	if(fechado == 1){
		$('a#finaliza_tarefa').hide();
		$('a#fazer_medicao').hide();
	}else{
		$('a#finaliza_tarefa').show();
		$('a#fazer_medicao').show();
	}


	$('div#medicao_tarefa').modal('show');
});

































// ROTINA PARA FAZER UMA NOVA MEDICAO DE ACORDO COM A TAREFAS SELECIONADA
$('a#fazer_medicao').click(function(){

	let id_tarefa_sub =  $(this).parents('div#medicao_tarefa').attr('id-tarefa-sub');

	$('div#modal-medicao').attr('id-tarefa-sub', id_tarefa_sub).modal('show');
});


//Rotina para finalizar uma medicao
$('a#salva_medicao').click(function(){

	//quantidade da medida
	var qnt = $('input#qnt_medida').val();

	//id que veio do view 
	let user = id_user_master;


	var tarefa = $(this).parents('div#modal-medicao').attr('id-tarefa-sub');

	console.log(tarefa, ' << tarefa');

	if(qnt != ''){

		$.ajax({  
			url:'const_grava_gerencia.php',  
			method:'POST', 
			data: {qnt_medida:qnt, user_medida:user, tarefa:tarefa},
			dataType: 'json',
			success: dados => 	
			{  	
				// console.log($('input#up_imagem_recibo').val());

				if(dados != 0){
					// console.log(' tem dados');
					for(let i in dados){

						let tr = $('tbody#lista_medicao > tr.hidden').clone(true).removeClass('hidden');

						tr.attr('id-medicao', dados[i].id);

						tr.find('> td').eq(0).text(dados[i].id);
						tr.find('> td').eq(1).text(dados[i].nome_cli);
						tr.find('> td').eq(2).text(dados[i].data_medicao);
						tr.find('> td').eq(3).text(dados[i].qnt_medida);
						tr.find('> td').eq(4).text(dados[i].vlr_med.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
						tr.find('> td').eq(5).text((dados[i].vlr_med * dados[i].qnt_medida).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
						// tr.find('> td').eq(6).text(dados[i].vlr_total_medicoes);

						$('tbody#lista_medicao').append(tr);
					}

					// console.log(' imagem a seguir  ',$('input#id_recebimento').val(dados[0].id));
					$('input#id_recebimento').val(dados[0].id);
					let form = new FormData($('.up_img')[0]);

					console.log(form);
				    $.ajax({
				        url: "const_grava_gerencia.php",
				        type: "POST",
				        data: form,
				        mimeType: "multipart/form-data",
				        contentType: false,
				        processData:false,
				        success: function (data) {
				        	$('div#modal-medicao').modal('hide');
				        	console.log("ok");
				        },

				        error: function(erro){
				        	console.log('erouuu');
				        }
				    });
				}
			},
			error: erro => {console.log(00)}  
		}); 

		// console.log(tarefa);
		// console.log($('table#data-table > tbody > tr[id-tarefa="'+tarefa+'"]').length);


		//Atualizo a quantidade restante na tabela de tarefas
		if($('table#data-table > tbody > tr[id-tarefa="'+tarefa+'"]').length){

			let atual = $('table#data-table > tbody > tr[id-tarefa="'+tarefa+'"]').find('> td').eq(5).text();

			// let total = (parseFloat(atual) - parseFloat(qnt));

			$('table#data-table > tbody > tr[id-tarefa="'+tarefa+'"]').find('> td').eq(5).text(atual);
		}

	}else{
		alert('Por favor preencha a Quantidade medida!');
	}
});

$('a#exibe_foto').click(function(){

	let medicao = $(this).parents('tr').attr('id-medicao');

	$.ajax({  
		url:'const_grava_gerencia.php',  
		method:'POST', 
		data: {foto_medicao:medicao},
		dataType: 'json',
		success: data => 	
		{  	
			if(data != 0){
				$("div#salvar").html("<img src='"+data+"'  style='text-align: center; width:100%; height:100%; '>");
				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
				$("div#modal7").modal('show');
			}else{
				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao exibir Fotos</h4>");
				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
				$("div#modal7").modal('show');
			}
		},
		error: erro => {
			console.log(0);
		} 
	});
});

// ROTINA PARA FINALIZAR UMA TAREFA
$('a#finaliza_tarefa').click(function(){
	let id_tarefa_sub =  $(this).parents('div#medicao_tarefa').attr('id-tarefa-sub');

	$.ajax({  
		url:'const_grava_gerencia.php',  
		method:'POST', 
		data: {finaliza_tarefa:id_tarefa_sub},
		dataType: 'json',
		success: dados => 	
		{  	
			console.log(1);

			if(dados = 1){
				$('div#medicao_tarefa').modal('hide');
				$('div#modal-dialog').modal('show');
			}
		},
		error: erro => {console.log(0)}  
	}); 
});