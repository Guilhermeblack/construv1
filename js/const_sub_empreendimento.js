//funcao de acao em caracteres especiais
function sanitizeString(str) {
    str = str.replace(/[áàãâä]/u, 'a');
    str = str.replace(/[éèêë]/u, 'e');
    str = str.replace(/[íìîï]/u, 'i');
    str = str.replace(/[óòõôö]/u, 'o');
    str = str.replace(/[úùûü]/u, 'u');
    str = str.replace(/[ç]/u, 'c');
    str = str.replace(/[ÁÀÃÂÄ]/u, 'A');
    str = str.replace(/[ÉÈÊË]/u, 'E');
    str = str.replace(/[ÍÌÎÏ]/u, 'I');
    str = str.replace(/[ÓÒÕÔÖ]/u, 'O');
    str = str.replace(/[ÚÙÛÜ]/u, 'U');
    str = str.replace(/[Ç]/u, 'C');
    return str;
  }

//Rotina para ca,mpo de busca
$("#input_busca").on("keyup", function() {
	//console.log('alos');

    var value = $(this).val().toLowerCase();
    $("tbody#empreendimento > tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  });
});

//Rotina para campo de busca
$("#input_busca2").on("keyup", function() {
	//console.log('alos');

    var value = $(this).val().toLowerCase();
    $("tbody#sub_empreendimento > tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  });
});

//Rotina para cadastro de Sub-Empreendimentos
$(document).on('click', 'a#salvar_sub_empreendimento', function(){


	let titulo = sanitizeString($('input#titulo_sub').val());
	let obs = sanitizeString($('input#obs_sub').val());

	let tipo_sub = $('select#tipo_sub > option:selected').val();
	let mestre_obra = $('select#mestre_obra > option:selected').val();
	let empreendimento = $('select#empreendimento > option:selected').val();

	obs == '' ? obs = 'Nenhuma Observação' : obs = obs;

	// console.log(empreendimento);

	if(titulo != '' && tipo_sub != -1 && mestre_obra != -1 && empreendimento != -1){

		let dados = {titulo:titulo, obs:obs, tipo_sub:tipo_sub, mestre_obra:mestre_obra, empreendimento:empreendimento};

		console.log(dados);

		$.ajax({  
			url:'const_grava_sub_empre.php',  
			method:'POST', 
			data: {grava_sub:dados},
			dataType:'json',  
			success: dados => 	
			{  	
				//console.log('sucesso');
				if(dados == 1){

					$('input#titulo_sub').val('');
					$('input#obs_sub').val('');

					$('div#modal-cad-sub').modal('hide');

					$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Sucesso ao Gravar Sub-Empreendimento!</h4>");
					$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
					$('div#modal7').modal('show');
				}
				
			},
			error: erro => {

				//console.log('erro');
				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao salvar tipo!</h4>");
				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
				$('div#modal7').modal('show');
			}  
		});
	}else{
		alert('Preencha corretamente Todos os campos!');
	}
});

//Rotina para listar os sub_empreendimentos de acordo com o empreendiemnto Selecionado
$(document).on('click', 'a.sub_empreendimento', function(){

	let id_empre = $(this).parents('tr').attr('id-emprendimento');

	// console.log(id_empre);
	
	//Rotina para limpar a tabela de sub-empreendimento
	$('tbody#sub_empreendimento > tr:not(tr.hidden)').each(function(){
		$(this).detach();
	});

	$.ajax({  
		url:'const_grava_sub_empre.php',  
		method:'POST', 
		data: {lista_sub_empre:id_empre},
		dataType:'json', 
		success: dados => 	
		{  	
		
			if(dados != 0){
				//console.log(dados);

				for(let i in dados){
					let tr = $('tbody#sub_empreendimento > tr.hidden').clone(true).removeClass('hidden');

					tr.attr('id-sub-empre', dados[i].id);

					tr.find('> td').eq(0).text(dados[i].id).attr('id','id_empre');
					tr.find('> td').eq(1).text(dados[i].titulo).attr("contenteditable", "true").attr('id','titulo_emp');
					// console.log(tr.find('> td').eq(1));
					tr.find('> td').eq(2).text(dados[i].nome_tipo);
					tr.find('> td').eq(3).text(dados[i].nome_resp);
					tr.find('> td').eq(4).text(dados[i].obs);

					$('tbody#sub_empreendimento').append(tr);
				}
				
				$('div#modal-sub-empreendimento').modal('show');

			}else{
				$('div#modal-sub-empreendimento').modal('show');
			}
			
		},
		error: erro => {
			//console.log('erro');
			$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Listar Sub-Empreendimentos!</h4>");
			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			$('div#modal7').modal('show');
		}  
	});
});


//Rotina para fazer a exclusão do sub-empreendimento selecionado
$(document).on('click', 'a.excluir_sub_empreendimento', function(){

	let id_sub_empre = $(this).parents('tr').attr('id-sub-empre');

	$.ajax({  
		url:'const_grava_sub_empre.php',  
		method:'POST', 
		data: {deleta_sub:id_sub_empre},
		dataType:'json',  
		success: dados => 	
		{  	
			$(this).parents('tr').detach();
			$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Sucesso ao Excluir Sub empreendimento!</h4>");
			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			$('div#modal7').modal('show');
		},
		error: erro => {

			//console.log('erro');
			$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Excluir Sub empreendimento!</h4>");
			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			$('div#modal7').modal('show');
		}  
	});
});

//Rotina para fazer a gravação de um tipo de sub empreendimento no banco de dados 
$(document).on('click', 'button#salvar_tipo', function(){


	let titulo = $('input#nome_tipo').val();
	let m2 = $('input#area_tipo').val();

	// console.log(1);

	if(titulo != '' && m2 != ''){

		$.ajax({  
			url:'const_grava_sub_empre.php',  
			method:'POST', 
			data: { grava_tipo:titulo, m2:m2 },
			dataType:'json',  
			success: dados => 	
			{  	

				$('input#nome_tipo').val('');
				$('input#area_tipo').val('');

				let tr = $('tbody#tipo_sub_empreendimento > tr.hidden').clone(true).removeClass('hidden');

				tr.find('> td').eq(0).text(dados);
				tr.find('> td').eq(1).text(titulo);
				tr.find('> td').eq(2).text(m2);

				$('tbody#tipo_sub_empreendimento').append(tr);

				$('div#modal-cad-tipo').modal('hide');
				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Sucesso ao salvar tipo!</h4>");
				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
				$('div#modal7').modal('show');
			},
			error: erro => {
				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao salvar tipo!</h4>");
				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
				$('div#modal7').modal('show');
			}  
		});	

	}else{
		alert('Preencha todos os campos para continuar!');
	}
});

$(document).on('click', 'a.exc_empreendimento', function(){

	let aux = $(this).parent().siblings('#nomemp').text();
	console.log(aux, ' oeoeoeoe');
	$('#emp_nome').text(aux);
	let val = $(this).parent().siblings('#idemp').text();
	console.log(val,' dpdpdpdpdpdp');

	$('#empreendimentoid').val(val);


});

$(document).on('submit', 'form#confirm_del_emp', function(){

	
	let val = $('input#empreendimentoid').val();
	// alert(val);
	$.ajax({  
		url:'const_grava_sub_empre.php',  
		method:'POST', 
		data: { empreendimentoid:val},
		dataType:'json',  
		success: dados => 	
		{
			setTimeout(function(){ location.reload(); }, 1000);
		},
		error: dados =>
		{
			alert('Não foi possível excluir o empreendimento.');
		}
	});
});

$(document).on('blur', '#nomemp', function(){

	let titulo = $(this).text();
	let emp = $(this).siblings('#idemp').text();
	// ajax salvando
	$.ajax({  
		url:'const_grava_sub_empre.php',  
		method:'POST', 
		data: { empreendimento_update:emp,titulo:titulo },
		dataType:'json',  
		success: dados => 	
		{
			setTimeout(function(){ location.reload(); }, 100);
		},
		error: dados =>
		{
		}
	});

});

$(document).on('blur', '#titulo_emp', function(){

	let titulo = $(this).text();
	let emp = $(this).siblings('#id_empre').text();
	// ajax salvando
	$.ajax({  
		url:'const_grava_sub_empre.php',  
		method:'POST', 
		data: { sub_update:emp,titulo:titulo},
		dataType:'json',  
		success: dados => 	
		{
			setTimeout(function(){ location.reload(); }, 100);
		},
		error: dados =>
		{
		}
	});

});