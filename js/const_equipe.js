


//Rotina para inserção provisória de um funcionario em uma nova equipe
$(document).on('click', 'a.adiocionar_func', function(){

	let linha = $(this).parents('tr').clone(true);

	linha.find('> td:last-child > a').removeClass('btn-info').removeClass('adiocionar_func');
	linha.find('> td:last-child > a').addClass('btn-danger').addClass('excluir_provisorio_func').text('Excluir');

	$('tbody#cad_equip').append(linha);

	$('div#modal-funcionario').modal('hide');
});

//Rotina para excluir um funcionario provisoriamente
$(document).on('click', 'a.excluir_provisorio_func', function(){
	$(this).parents('tr').detach();
});

//Realiza a gravação definitiva no banco de dados 
$(document).on('click', 'button#cad_equipe', function(){

	let nome_equipe = $('input#equipe').val();
	let id_funcionario = Array();

	$('tbody#cad_equip > tr:not(tr.hidden)').each(function(){
		id_funcionario.push($(this).attr('id-funcionario'));
	});

	//console.log(nome_equipe);
	//console.log(id_funcionario);

	if(nome_equipe != '' && id_funcionario.length != 0){

		
		$.ajax({  
		    url:'const_cad_equipe.php',  
		    method:'POST', 
		    data: {nome_equipe:nome_equipe, id_funcionario:id_funcionario},
		    dataType:'json',  
		    success: dados => 
		    {   
		    	window.location.href = 'const_equipe.php';

		    },
		    error: erro => {
		        console.log('erouuuu');
		    }  
		});
	}else{
		alert("Por Favor preencher todas informações corretamente!");
	}
});

//Rotina para Excluir uma Equipe 
$(document).on('click', 'a.excluir_equipe', function(){

	let id_equipe = $(this).parents('tr').attr('id-equipe');

	if(id_equipe != ''){
				
		$.ajax({  
		    url:'const_cad_equipe.php',  
		    method:'POST', 
		    data: {exclui_equipe:id_equipe},
		    dataType:'json',  
		    success: dados => 
		    {   
		    	if(dados == 1){

		    		$(this).parents('tr').detach();

		    		$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Sucesso ao Excluir a Equipe</h4>");
		    		$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		    		$("div#modal7").modal('show');
		    	}else{
		    		$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Excluir a Equipe</h4>");
		    		$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		    		$("div#modal7").modal('show');
		    	}
		    },
		    error: erro => {
		        console.log('erouuuu');
		    }  
		});
	}else{
		alert("Por Favor preencher todas informações corretamente!");
	}
});

//Rotina para listar os funcionarios pertecentes a uma Equipe
$(document).on('click', 'a.ver_funcionario', function(){

	let id_equipe = $(this).parents('tr').attr('id-equipe');

	if(id_equipe != ''){
				
		$.ajax({  
		    url:'const_cad_equipe.php',  
		    method:'POST', 
		    data: {lista_funcionario:id_equipe},
		    dataType:'json',  
		    success: dados => 
		    {   
		    	if(dados != 0){

		    		for(let i in dados){

		    			let tr = $('tbody#lista_funcionario > tr.hidden').clone(true).removeClass('hidden');

		    			tr.find('> td').eq(0).text(dados[i].nome_cli);
		    			tr.find('> td').eq(1).text(dados[i].nascimento_cli);
		    			tr.find('> td').eq(2).text('R$ '+dados[i].salario_base.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
		    			tr.find('> td').eq(3).text(dados[i].cargo);

		    			$('tbody#lista_funcionario').append(tr);
		    		}

		    		$('div#modal-lista-funcionario').modal('show');

		    	}else{
		    		$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Listar a Equipe</h4>");
		    		$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		    		$("div#modal7").modal('show');
		    	}
		    },
		    error: erro => {
		        console.log('erouuuu');
		    }  
		});
	}else{
		alert("Por Favor preencher todas informações corretamente!");
	}
});
