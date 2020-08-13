//Função para abrir várias modals uma depois da outra "Efeito Windows"
$(document).on('show.bs.modal', '.modal', function (event) {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});

//Atualiza a tabela de acordo com o orçamento selecionado
function att_lista_solicitacao(){
	let deposito = $('select#select_deposito > option:selected').val();

	let deposito_solicitacao = deposito;

	if(deposito != -1){
		$.ajax({
		   url:   'const_grava_deposito.php',
		   type:  'POST',
		   //cache: false,
		   //data:  { ok : 'deu certo!'},
	   		data: {deposito_solicitacao:deposito_solicitacao}, //essa e o padrao x-www-form-urlencode
	   		dataType:'json',  
		   error: function() {
		        console.log(0);
		   },
		   success: function(data) { 

	   			$('tbody#tbody_solicitacao_feita > tr:not(.hidden)').each(function(){
	   				$(this).detach();
	   			});

	   			if(data != 0){
	   				for(let i = 0; i < data.length; i++){

	   					let tr = $('tbody#tbody_solicitacao_feita > tr.hidden').clone(true).removeClass('hidden');

	   					tr.attr('id-solicitacao',data[i].id);

	   					tr.find('> td').eq(0).text(data[i].id);
	   					tr.find('> td').eq(1).text(data[i].nome_usuario);
	   					tr.find('> td').eq(2).text(data[i].data);

	   					if(data[i].id_oc == -1){
	   						tr.find('> td').eq(3).text('Pendente de OC').css('color', '#ff3547!important');
	   						tr.find('> td').eq(4).append('<a class="btn btn-danger btn-sm" id="cancelar_solicitacao">Cancelar</a>');
	   					}else if(data[i].id_oc == 0){
	   						tr.find('> td').eq(3).text('Cancelado').css('color', '#ff3547!important');
	   						tr.find('> td').eq(4).html('');
	   					}else{
	   						tr.find('> td').eq(3).text('Oc emitida').css('color', '#5fba7d!important');
	   						tr.find('> td').eq(4).append('<a class="btn btn-success btn-sm" id="oc_solicitacao">Ver Oc</a>');
	   					}

	   					$('tbody#tbody_solicitacao_feita').append(tr);

	   				}
	   			}
		   },
		});
	}else{
		//Apago todas as linhas da lista de Solicitação ja feitas
		$('tbody#tbody_solicitacao_feita > tr:not(.hidden)').each(function(){
   			$(this).detach();
   		});
	}
}

// Input para busca da tabela Saldo
$("input#saldo_material").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("tbody#saldo_material > tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
	});
});

// Input para busca da tabela Saldo
$("input#lista_entrada").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("tbody#lista_entrada > tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
	});
});

// Input para busca da tabela Saldo
$("input#lista_saida").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("tbody#lista_saida > tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
	});
});

// Input para busca da tabela Saldo
$("input#extravios").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("tbody#extravios > tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
	});
});

// Input para busca da tabela Saldo
$("input#input-solicitao-feita").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("tbody#tbody_solicitacao_feita > tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
	});
});

// Input para busca da tabela Saldo
$("input#input_solicitacao_item").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("tbody#tbody_solicitacao_item > tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
	});
});


$('select#select_deposito').change(function(){

	let deposito = $('select#select_deposito > option:selected').val();

	if(deposito != -1){

		//Limpo todas as tabelas
		$('tbody#saldo_material > tr:not(.hidden)').each(function(){
			$(this).detach();
		});
		$('tbody#lista_entrada > tr:not(.hidden)').each(function(){
			$(this).detach();
		});
		$('tbody#lista_saida > tr:not(.hidden)').each(function(){
			$(this).detach();
		});
		$('tbody#extravios > tr:not(.hidden)').each(function(){
			$(this).detach();
		});

		$.ajax({
			url:   'const_grava_deposito.php',
			type:  'POST',
		   //cache: false,
	   		data: {deposito:deposito}, //essa e o padrao x-www-form-urlencode
	   		dataType:'json',  

	   		beforeSend: function(){
	   			//$('button.close').click();

				$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
				$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar' >Carregando, aguarde!</h4>");
				$("div#modal7").modal('show');
			},
			success: dados => 
			{  	

				//console.log(dados);

				//Preencho a tabela do saldo de acordo com os dados retornados do banco de dados
				for(let i = 0; i < dados.saldo.length; i++){

					// console.log(dados.saldo);
					//Verifico se o insumo já existe na tabela do saldo
					if($('tbody#saldo_material > tr[id-insumo="'+dados.saldo[i].id_insumo+'"]').length){

						let total = (parseFloat($('tbody#saldo_material > tr[id-insumo="'+dados.saldo[i].id_insumo+'"] > td').eq(2).text()) + parseFloat(dados.saldo[i].qnt));

						$('tbody#saldo_material > tr[id-insumo="'+dados.saldo[i].id_insumo+'"] > td').eq(2).text(total);
						$('tbody#saldo_material > tr[id-insumo="'+dados.saldo[i].id_insumo+'"] > td').eq(4).text(dados.saldo[i].data);

					}else{

						let tr = $('tbody#saldo_material > tr.hidden').clone(true).removeClass('hidden');

						tr.attr('id-insumo', dados.saldo[i].id_insumo);

						tr.find('> td').eq(0).text(dados.saldo[i].insumo.codigo);
						
						

						tr.find('> td').eq(1).text(dados.saldo[i].insumo.descricao);
						
						tr.find('> td').eq(2).text(dados.saldo[i].qnt);
						tr.find('> td').eq(3).text(dados.saldo[i].nome_empresa);
						tr.find('> td').eq(4).text(dados.saldo[i].data);

						$('tbody#saldo_material').append(tr);
					}
				}

				//Preencho a tabela de entrada de insumos com os dados retornados do banco de dados
				for(let i = 0; i < dados.entrada.length; i++){

					let tr = $('tbody#lista_entrada > tr.hidden').clone(true).removeClass('hidden');

					tr.attr('id-insumo', dados.entrada[i].id_insumo);

					tr.find('> td').eq(0).text(dados.entrada[i].insumo.codigo);
					tr.find('> td').eq(1).text(dados.entrada[i].insumo.descricao);
					tr.find('> td').eq(2).text(dados.entrada[i].qnt);
					tr.find('> td').eq(3).text(dados.entrada[i].nome_empresa);
					tr.find('> td').eq(4).text(dados.entrada[i].data);

					$('tbody#lista_entrada').append(tr);
				}

				//Preencho a tabela de saida de insumos com os dados retornados do banco de dados
				for(let i = 0; i < dados.saida.length; i++){

					let tr = $('tbody#lista_saida > tr.hidden').clone(true).removeClass('hidden');

					tr.attr('id-insumo', dados.saida[i].id_insumo);

					tr.find('> td').eq(0).text(dados.saida[i].insumo.codigo);
					tr.find('> td').eq(1).text(dados.saida[i].insumo.descricao);
					tr.find('> td').eq(2).text(dados.saida[i].qnt);
					tr.find('> td').eq(3).text(dados.saida[i].nome_empresa);
					tr.find('> td').eq(4).text(dados.saida[i].data);

					$('tbody#lista_saida').append(tr);
				}

				//Preencho a tabela de Extravios de insumos com os dados retornados do banco de dados
				for(let i = 0; i < dados.extravio.length; i++){

					let tr = $('tbody#extravios > tr.hidden').clone(true).removeClass('hidden');

					tr.attr('id-insumo', dados.extravio[i].id_insumo);

					tr.find('> td').eq(0).text(dados.extravio[i].insumo.codigo);
					tr.find('> td').eq(1).text(dados.extravio[i].insumo.descricao);
					tr.find('> td').eq(2).text(dados.extravio[i].qnt);
					tr.find('> td').eq(3).text(dados.extravio[i].nome_empresa);
					tr.find('> td').eq(4).text(dados.extravio[i].data);
					tr.find('> td').eq(5).text(dados.extravio[i].motivo);

					$('tbody#extravios').append(tr);
				}

				$("div#modal7").modal('hide');

			},
			error: erro => {console.log("alonso")},  
	   	});

	   	att_lista_solicitacao();

	}else{
		//Limpo todas as tabelas
		$('tbody#saldo_material > tr:not(.hidden)').each(function(){
			$(this).detach();
		});
		$('tbody#lista_entrada > tr:not(.hidden)').each(function(){
			$(this).detach();
		});
		$('tbody#lista_saida > tr:not(.hidden)').each(function(){
			$(this).detach();
		});
		$('tbody#extravios > tr:not(.hidden)').each(function(){
			$(this).detach();
		});

		att_lista_solicitacao();
	}
});

//Rotina para abrir multi modal para listar os itens ja solicitados
$(document).on('click', 'a#ver_solicitacao', function(){

	let id_solicitacao = $(this).parents('tr').find('> td').eq(0).text();

	$.ajax({  
		url:'const_grava_solicitacao.php',  
		method:'POST', 
		data: { id_solicitacao:id_solicitacao },

		dataType:'json',  

		success: dados => 	
		{  	
			if(dados != 0){
				$("div#modal7").modal('hide');

				$('tbody#tbody_solicitacao_item > tr:not(tr.hidden)').each(function(){
					$(this).detach();
				});

				//console.log(dados);

				for(let i in dados){

					let tr = $('tbody#tbody_solicitacao_item > tr.hidden').clone(true).removeClass('hidden');

					tr.find('> td').eq(0).text(id_solicitacao);
					tr.find('> td').eq(1).text(dados[i].descricao);
					tr.find('> td').eq(2).text(dados[i].qnt);

					 $('tbody#tbody_solicitacao_item').append(tr);
				}

				$('div#modal-lista-item-solicitacao').modal('show');

			}else{
				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Listar Insumo!</h4>");
				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			}
		},
		error: erro => {
			console.log(0);
		}  

	});	
});

//Rotina para salvar o id da solicitacao no botao de cancelar solicitação
$(document).on('click', 'a#cancelar_solicitacao', function(){

	let id_solicitacao = $(this).parents('tr').find('> td').eq(0).text();

	$('button#cancela_solicitacao_def').attr('id-solicitacao', id_solicitacao);


	$('div#cancela_solicitacao').modal('show');
});

//Rotina para efetuar o cancelamento definitivo
$(document).on('click', 'button#cancela_solicitacao_def', function(){
	let cancela_solicitacao = $(this).attr('id-solicitacao');
	let motivo = $('textarea#motivo_cancela').val();
	let id_user = $('a#id_usuario').attr('id-user');


	if(motivo != ''){

		$.ajax({  
    		url:'const_grava_solicitacao.php',  
    		method:'POST', 
    		data: { cancela_solicitacao:cancela_solicitacao, motivo:motivo, id_user:id_user},
    		dataType:'json',  

    		success: data => 	
    		{  	
    			if(data != 0){

    				$('tbody#tbody_solicitacao_feita > tr[id-solicitacao="'+cancela_solicitacao+'"] > td').eq(3).text('Cancelado').css('color', '#ff3547!important');
    				$('tbody#tbody_solicitacao_feita > tr[id-solicitacao="'+cancela_solicitacao+'"] > td').eq(4).find('> a').hide();

    				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Solicitação de Insumo Cancelada Com Sucesso! </h4>");
    				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    				$("a#salvar").click();

    			}else{
    				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Cancelar Solicitação</h4>");
    				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    				$("a#salvar").click();
    			}
    		},
    		error: erro => {
    			$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Cancelar Solicitação</h4>");
    			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    			$("a#salvar").click();
    		} 
    	});

    	$('div#cancela_oc').modal('hide');

	}else{
		alert("Escreva o Motivo !");
	}
});

//Rotina para salvar o id da solicitacao no botao de emitir materias da solicitação
$(document).on('click', 'a.aprovar_solicitacao', function(){

	let id_solicitacao = $(this).parents('tr').attr('id-solicitacao');

	$('button#aprova_solicitacao').attr('id-solicitacao', id_solicitacao);

	$('div#aprova_solicitacao').modal('show');
});

//Despacha os materias definitivamente e grava na tabela despacho e gera uma ordem de compra
$(document).on('click', 'button#aprova_solicitacao', function(){

	let id_user = $('a#id_usuario').attr('id-user');
	let id_deposito = $('select#select_deposito > option:selected').val();
	let id_solicitacao = $(this).attr('id-solicitacao');

	let dados = Array();
	let dados_all = Array();

	dados_all.push(id_user);
	dados_all.push(id_deposito);
	dados_all.push(-1);

	//Insiro a data de entrega e o local entrega
	dados_all.push('');
	dados_all.push('');
	dados_all.push(0.00);

	$.ajax({  
		url:'const_grava_deposito.php',  
		method:'POST', 
		data: {dados_all:dados_all ,  id_solicitacao:id_solicitacao},
		dataType:'json',  

		beforeSend: function(){
			$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
			$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
			$("div#modal7").modal('show');
			
		},
		success: dados => 	
		{  	
			if(dados != 0){
				$("div#salvar").html("<a href='pdf/ordem_compra.pdf' class='btn btn-success' target='_blank' style='text-align: center;'>Abrir Ordem de Compra</a>");
				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");

			}else{
				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao emitir Ordem de Compra</h4>");
				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			}
		},
		error: erro => {
			$("div#modal7").modal('hide');
			//console.log('alindo');
		}
	});

	setTimeout(function(){
		$('div#aprova_solicitacao').modal('hide');

		$('select#select_deposito').val(-1).change();
		$('select#select_deposito').val(id_deposito).change();
	}, 500);
});

//Salvo o id do insumo para fazer o extravio do insumo
$(document).on('click', 'a.extravio_item', function(){

	let id_insumo = $(this).parents('tr').attr('id-insumo');

	$('button#extravio_insumo_def').attr('id-insumo', id_insumo);

	$('div#extravio_insumo').modal('show');
});

//Realizo o extravio definitivo
$(document).on('click', 'button#extravio_insumo_def', function(){

	let id_insumo_extravio = $(this).attr('id-insumo');
	let id_user_extravio = $('a#id_usuario').attr('id-user');
	let id_deposito_extravio = $('select#select_deposito > option:selected').val();

	let qnt  = $(this).parents('div.modal-content').find('> div.modal-body > div:first-child > input#qnt_extravio').val();
	let motivo = $(this).parents('div.modal-content').find('> div.modal-body > div:last-child > textarea#extravio_insumo').val();

	if(!(qnt == '' || motivo == '')){

		$.ajax({  
			url:'const_grava_deposito.php',  
			method:'POST', 
			data: {qnt:qnt ,  motivo:motivo, id_insumo_extravio:id_insumo_extravio, id_deposito_extravio:id_deposito_extravio, id_user_extravio:id_user_extravio },
			dataType:'json',  

			success: dados => 	
			{  	
				$("div#salvar").html("<h4 class='modal-title'>Insumo Extraviado com Sucesso!</h4>");
				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");

				$('div#extravio_insumo').modal('hide');
				$('div#modal7').modal('show');


				//Funcao para atualizar as tabelas listadas
				setTimeout(function(){
					$('select#select_deposito').val(id_deposito_extravio).change();
				}, 500);

			},
			error: erro => {
				$("div#modal7").modal('hide');
				//console.log('alindo');
			}
		});

	}else{
		alert('Preencha todos os campos!');
	}


	//console.log(qnt, motivo);
});