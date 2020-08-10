 var $orcamento = $('select#orcamento');
 $('h3#data_oc').text('Franca , '+DiaExtenso());
 

 //Função para abrir várias modals uma depois da outra "Efeito Windows"
 $(document).on('show.bs.modal', '.modal', function (event) {
     var zIndex = 1040 + (10 * $('.modal:visible').length);
     $(this).css('z-index', zIndex);
     setTimeout(function() {
         $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
     }, 0);
 });

function encode_utf8(s) {
  return unescape(encodeURIComponent(s));
}

function decode_utf8(s) {
  return decodeURIComponent(escape(s));
}

function isEmpty(obj){
	return JSON.stringify(obj) === '{}';
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}


function DiaExtenso() {

	let meses = new Array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	let semana = new Array("Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sábado");
	let hoje = new Date();

	let dia = hoje.getDate();
	let dias = hoje.getDay();
	let mes = hoje.getMonth();
	let ano = hoje.getYear();

	if (navigator.appName == "Netscape"){
	  ano = ano + 1900;
	}

	let diaext = semana[dias] + ", " + dia + " de " + meses[mes] + " de " + ano;
	return diaext;
}

function auto_complete(){
	var mySource = [];
	$("select#select_especie").children("option").map(function() {
		mySource.push($(this).text());
	});

	$("#input_especie").autocomplete({
		source: mySource,
		minLength: 0
	}).focus(function () {
		$(this).autocomplete('search', $(this).val())
	});
}	

//Calculo o Total de cada fornecedor e o melhor preço de cada um e de cada insumo separadamente
function calc_total(){

	$('#table_principal > tbody#myTable').find('> tr.forma_pgt').show();
	$('#table_principal > tbody#myTable').find('> tr.desconto').show();
	$('#table_principal > tbody#myTable').find('> tr.total').show();
	$('#table_principal > tbody#myTable').find('> tr.oc').show();

	let $body = $('#table_principal > tbody#myTable');
	var total = [];
	let valor;

	//menor armazena o id-fornecedor do menor valor
	let menor;
	let id_menor;
	let melhor_compra = 0;

	$body.find('> tr:not(tr.hidden, tr.total, tr.oc, tr.forma_pgt, tr.desconto)').each(function(i){

		menor = 0;
		id_menor = null;

		parseFloat($(this).find('> td').eq(2).text()) < parseFloat($(this).find('> td').eq(4).text()) ? $(this).find('> td').eq(4).addClass('estorou') : $(this).find('> td').eq(4).removeClass('estorou'); 

		//Seto as opções no objeto total
		if(i == 0){
			$(this).find('> td').each(function(j){
				if(j > 4){
					total[j-5] = 0;
				}
			});
		}

		$(this).find('> td').each(function(j){
			if(j > 4){
				isNaN(parseFloat($(this).text().replace(/[R$. ]/g, '').replace(/,/g, '.'))) ? valor = 0 : valor = parseFloat($(this).text().replace(/[R$. ]/g, '').replace(/,/g, '.'));

				total[j-5] +=  valor;

				//Adiciono a clase zerado caso o valor total esteja zerado
				valor == 0 ? $(this).addClass('zerado') : $(this).removeClass('zerado'); 

				//console.log(valor);
				//console.log(total);
				if(menor == 0 && valor != 0){
					menor = valor;
					id_menor = $(this).attr('id-fornecedor');
				}else if(valor != 0 && valor < menor){
					menor = valor;
					id_menor = $(this).attr('id-fornecedor');
				}

				valor = null;
			}
		});

		//console.log(id_menor);
		//console.log(menor);

		if(menor != 0 && id_menor != null){
			melhor_compra += menor;

			$(this).find('> td').each(function(i){
				$(this).attr('id-fornecedor') == id_menor ? $(this).addClass('menor_preco') : $(this).removeClass('menor_preco');
			});
		}
	});

	//Calculo o menor valor geral
	menor = 0;
	id_menor = null;

	for(let i = 0; i < total.length; i++){
		if(menor == 0 && total[i] != 0){
			menor = total[i];
			id_menor = i;
		}else if(total[i] != 0 && total[i] < menor){
			menor = total[i];
			id_menor = i;
		}
	}

	//console.log(id_menor);
	//console.log(total.length);

	//Faço a substração do total  pelo desconto
	$body.find('> tr.desconto > td').each(function(i){
		if(i > 0){
			total[ i - 1] -= parseFloat($(this).text().replace(/[R$. ]/g, '').replace(/,/g, '.'));
		}
	});

	//Insiro o menor valor no tr.total
	$body.find('> tr.total > td').each(function(i){

		if(i == 1 && $(this).attr('id') == 'melhor_compra'){
			$(this).text(melhor_compra.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
			$(this).addClass('melhor_compra');
		}else if(i > 1){
			if(id_menor != null && (i-2) == id_menor){
				$(this).text(total[i-2].toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
				$(this).addClass('menor_preco');
			}else{
				$(this).text(total[i-2].toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
				$(this).removeClass('menor_preco');
			}
		}
	});
}

//Calculo o Total de cada linha e se a qnt nao é maior que o Orçado
function calc_total_oc(){
	let $body = $('tbody#tbody_oc');
	let total;

	$body.each(function(){

		total = 0;

		$(this).find('> tr:not(tr.hidden, tr.total, tr.desconto)').each(function(){

			total +=  parseFloat($(this).find('> td').eq(2).text().replace(/[R$. ]/g, '').replace(/,/g, '.'));

			if(parseFloat($(this).find('> td').eq(2).text().replace(/[R$. ]/g, '').replace(/,/g, '.')) == 0){
				$(this).find('> td').eq(2).addClass('zerado');
			}

			if(parseFloat($(this).find('> td').eq(1).text()) > parseFloat($('tbody#myTable > tr[id-insumo="'+$(this).attr('id-insumo')+'"] > td').eq(2).text())){
				$(this).find('> td').eq(1).addClass('estorou');
			}else{
				$(this).find('> td').eq(1).removeClass('estorou');
			}
		});

		total -= parseFloat($(this).find('> tr.desconto > td').eq(1).text().replace(/[R$. ]/g, '').replace(/,/g, '.'));

		$(this).find('> tr.total > td').eq(1).text(total.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).addClass('melhor_compra');
	});
}

//Monto o ContextMenu para todas as linhas da tabela principal
$(document).contextmenu({
	delegate: "div#table tr",
	menu: [{
		title: "Excluir Linha",
		cmd: "delete_insumo",
		uiIcon: "ui-icon-pencil",
	}
	],
	select: function(event, ui) {
		//console.log(ui.target.parents('tr').attr('id-insumo'));

    	let id_insumo = ui.target.parents('tr').attr('id-insumo');
    	let cotacao = $('select#orcamento').find('option:selected').val();

    	$('button#remove-tr').attr('id-insumo', id_insumo);
    	$('button#remove-tr').attr('cotacao', cotacao);

    	$("a[data-target='#dialog-remove-tr']").click();
    }
});

// Input para busca da tabela principal
$("#myInput").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("#myTable tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
	});
});

// Input para busca da modal de fornecedores
$("#input_fornecedor").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("#table_fornecedor tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
});

// Input para busca da tabela de Ordem de compras
$("input#pesquisa_oc").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("tbody#table_oc > tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
});

// Input para busca da modal de Espécieis
$("#input_especie").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("#table_especie tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
});

//Salva todos os itens da tabela de cotacao na tabela const_itens_cotacao e grava as colunas na tabela const_fornecedor_cotacao
// e grava também os descontos na tabela conts_desconto_cotacao e a forma pagamento na tabela const_foma_pgt_cotacao
$('button#salva_cotacao').click(function(){
	let cotacao = $orcamento.find('> option:selected').val();

	if(cotacao != -1){

		let dados = [];
		let dado = [];
		let colunas = [];
		let desconto = [];
		let forma_pgt = [];
		let valida_ajax = 1;	

		let aux = [];

		//Aramazeno os dados forma pagamento
		$('table#table_principal').find('> tbody#myTable > tr.forma_pgt > td').each(function(i){
			if(i > 0){
				aux = [];

				aux.push($(this).attr('id-fornecedor'));
				aux.push($(this).find('> select > option:selected').val());

				forma_pgt.push(aux);
			}
		});

		//Aramazeno os dados Desconto
		$('table#table_principal').find('> tbody#myTable > tr.desconto > td').each(function(i){
			if(i > 0){
				aux = [];

				aux.push($(this).attr('id-fornecedor'));
				aux.push($(this).text().replace(/[R$. ]/g, '').replace(/,/g, '.'));

				desconto.push(aux);
			}
		});

		$('table#table_principal').find('> tbody#myTable > tr:not(.hidden, .total, .oc)').each(function(i){
			let id_insumo = $(this).attr('id-insumo');
			let qnt = $(this).find('> td').eq(4).text();
			let status;

			$(this).hasClass('naoOrcado') ? status = 0 : status = 1;

			$(this).find('> td').each(function(j){
				if(j > 4){

					dado.push(qnt);
					dado.push($(this).attr('valor_unitario'));
					dado.push($(this).attr('id-fornecedor'));
					dado.push(id_insumo);
					dado.push(cotacao);
					dado.push(status);

					dados.push(dado);
					dado = [];
				}
			});
		});

		$('thead#thead_principal').find('> tr > th').each(function(i){
			if(i > 4){
				colunas.push($(this).attr('id-fornecedor'));
			}
		});

		//console.log(dados);
		//console.log(colunas);
		//console.log(forma_pgt);
		//console.log(desconto);

		$.ajax({
			url:   'const_grava_cotacao.php',
			type:  'POST',
       		data: {dados:dados, colunas:colunas, forma_pgt:forma_pgt, desconto:desconto, valida_ajax:valida_ajax}, //essa e o padrao x-www-form-urlencode
       		dataType:'json',  

       		error: function(request, status, erro) {
       			alert("Problema ocorrido: " + status + "\nDescição: " + erro);
       			$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Salvar a Tabela!!</h4>");
       			$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
       		},
       		success: function(data) { 

       			if(data != 0 ){
       				$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Salvo com Sucesso!</h4>");
       				$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
       			}else{
       				$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Adicione Material / Fornecedor !</h4>");
       				$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
       			}

       			
       		},
       		beforeSend: function() {
       			$("div#dialog-body").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
       			$("div#dialog-footer").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
       			$("button#dialog").click();
       		}
       	});


	}else{
		alert("Preencha uma cotação!");
	}
});

// Adiciona uma coluna de Fornecedor contendo com atributo 'id' do fornedor
$('a.add_fornecedor').click(function(){
	let cont = 0;
	let orc = $orcamento.find('option:selected').val();

	$('#table_principal > thead#thead_principal').find('> tr > th').each(function(i){
		cont++;
	});

	if(cont > 9){
		alert("Numero Máximo de 5 Fornecedores! ");
	}else if(orc != -1){
		let cpf_cnpj = $(this).parents('tr').find('td').eq(0).text();
		let nome = $(this).parents('tr').find('td').eq(1).text();
		let id_fornecedor = $(this).parents('tr').attr('id_cliente');

		nome = nome.split(' ');

		$(this).hide();

		$('#table_principal > thead#thead_principal').find('> tr').append("<th class='text-center' id-fornecedor='"+id_fornecedor+"'>"+nome[0]+"<a  id='remove-col' href='#dialog-remove' data-toggle='modal' data-target='#dialog-remove'><span class='glyphicon glyphicon-remove'></span></th>");

		$("#table_principal > tbody#myTable").find('> tr:not(tr.total, tr.oc, tr.forma_pgt)').each(function(){
			$(this).append("<td valor_unitario='0' id-fornecedor='"+id_fornecedor+"' contenteditable='true' style='text-align: center;'>R$ 0,00</td>");
			//$(this).find('> td:last-child').focus();
		});	

		//Faço a insercao do campo de pagamento de acordo com o fornecedor inserido
		let aux_select = $("#table_principal > tbody#myTable").find('> tr.forma_pgt > td:first-child > select.hidden').clone(true).removeClass('hidden');
		$("#table_principal > tbody#myTable").find('> tr.forma_pgt').append("<td id-fornecedor='"+id_fornecedor+"' style='text-align: center;'></td>");
		$("#table_principal > tbody#myTable").find('> tr.forma_pgt > td:last-child').append(aux_select);



		$("#table_principal > tbody#myTable").find('> tr.total').append("<td id-fornecedor='"+id_fornecedor+"' style='text-align: center;'>R$ 0,00</td>");

		$("#table_principal > tbody#myTable").find('> tr.oc').append("<td id-fornecedor='"+id_fornecedor+"' style='text-align: center;'><a class='btn btn-success btn-sm gerar_oc'>Gerar OC</a></td>");

		/*
		$.ajax({  
			url:'const_grava_cotacao.php',  
			method:'POST', 
			data: {orc:orc,id_fornecedor:id_fornecedor },
			dataType:'json',  
			success: dados => 	
			{  
				console.log(1);
			},
			error: erro => {console.log(0)}  
		}); 
		*/
	}else{
		alert('Selecione um Orçamento!');
	}
});

//Atualizo a tabela de espécie de acordo com a categoria selecionada
$('select#categoria_select').change(function(){
	let categoria = $(this).find('option:selected').attr('id');

	$.ajax({
		url:   'const_grava_cotacao.php',
		type:  'POST',
	   //cache: false,
   		data: {categoria:categoria}, //essa e o padrao x-www-form-urlencode
   		dataType:'json',  

   		beforeSend: function(){
   			//$('button.close').click();

			$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
			$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar' >Carregando, aguarde!</h4>");
			$("a#salvar").click();
		},
		success: dados => 
		{  	
			$('button#close').click();
			if(dados != '0'){

				$('tbody#table_especie').empty();

				for(var i in dados){
					$('tbody#table_especie').append("<tr id='"+dados[i].id+"'><td class='text-center'>"+dados[i].descricao+"</td><td class='text-center'><a class='btn btn-success btn-sm' id='add_especie'>Adicionar</a></td></tr>");
				}
			}
		},
		error: erro => {console.log("alonso")},  
   	});
});

//Adiciono Todas as epécies na tabela  ### PARCIALMENTE INUTILIZADO ###
$('a.add_all_especie').click(function(){
	if($('select#orcamento option:selected').val() != -1){
		let id_cot = $('select#orcamento > option:selected').val();
		let id_cat = $('select#categoria_select > option:selected').attr('id');

		//$(this).hide();

		//console.log(id_cot);
		//console.log(id_cat);

		if(id_cat != -1){
    		$.ajax({
    			url:   'const_grava_cotacao.php',
    			type:  'POST',
			   //cache: false,
			   //data:  { ok : 'deu certo!'},
           		data: {id_cot:id_cot, id_cat:id_cat}, //essa e o padrao x-www-form-urlencode
           		dataType:'json',  

           		beforeSend: function() {
           			$('button.close').click();

           			$("div#modal-dialog > div > div > div#dialog-body").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
           			$("div#modal-dialog > div > div > div#dialog-footer").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
           			$("button#dialog").click();
           		},
           		success: function(data) { 
			   		//console.log(data);
			   		if(data != 0){
			   			//Realocando a 'tr' TOTAL
			   			let total = $('#table_principal > tbody#myTable').find('> tr.total').clone(true);
			   			let oc = $('#table_principal > tbody#myTable').find('> tr.oc').clone(true);

			   			$('#table_principal > tbody#myTable').find('> tr.total').detach();
			   			$('#table_principal > tbody#myTable').find('> tr.oc').detach();			

			   			for(let i = 0; i < data.length; i++){

			   				//Verifico se o insumo ja existe na tabela, se nao existir eu o crio
			   				if(!$("tr[id-insumo='"+data[i].id+"']").length){
				   				let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();

				   				$('#table_principal > tbody#myTable').append(aux);

				   				$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
			   					.addClass('align-center').attr('id_especie', data[i].id_especie).attr('id-insumo', data[i].id);


				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].descricao).attr('title', 'CÓDIGO: '+data[i].codigo);
				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text(data[i].quantidade == '' ? 0 : data[i].quantidade).attr('title', 'UNIDADE MEDIDA: '+data[i].unidade);
				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text((data[i].quantidade * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'VALOR UNIDADE: '+parseFloat(data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(4).text(data[i].quantidade == '' ? 0 : data[i].quantidade); 

				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td[contenteditable='true']:not(td.quantidade_cotada)").each(function(){
				   					$(this).text('R$ 0,00');
				   				});
			   				}
			   			}

			   			$('#table_principal > tbody#myTable').find('> tr:last-child > td.quantidade_cotada').focus();
			   			$('#table_principal > tbody#myTable').append(total);
			   			$('#table_principal > tbody#myTable').append(oc);

			   			calc_total();
			   		}

			   		$('button.close').click();
			   	},
			   	error: function() {
			   		$('button.close').click();
			   		console.log(0);
			   	}
			});
		}else{
			alert("Selecione uma Categoria !");
		}
	}else{
		alert("Selecione um Orçamento !");
	}
});

//Atualizo a tabela de acordo com a Cotação selecionado
$('select#orcamento').change(function(){

	//Habilito todos os botoes da tabela de fornecedores
	$('a.add_fornecedor').each(function(i){
		$(this).show();
	});

	//Limpo o Cabeçalho da tabela - todas as colunas de Fronecedores
	$('#table_principal > thead#thead_principal').find("> tr > th").each(function(i){
		if(i > 4){
			$(this).detach();
		}
	});

	//Limpo as colunas de fornecedores da linha .hidden 
	$('#table_principal > tbody#myTable').find("> tr.hidden > td").each(function(i){
		if(i > 4){
			$(this).detach();
		}
	});

	//Limpo as colunas de fornecedores da linha .total 
	$('#table_principal > tbody#myTable').find("> tr.total > td").each(function(i){
		if(i == 1){
			$(this).text('R$ 0,00');
		}else if(i > 1){
			$(this).detach();
		}
	});

	//Limpo as colunas de fornecedores da linha .oc 
	$('#table_principal > tbody#myTable').find("> tr.oc > td").each(function(i){
	    if(i > 1){
			$(this).detach();
		}
	});

	//Limpo as colunas de fornecedores da linha .forma_pgt 
	$('#table_principal > tbody#myTable').find("> tr.forma_pgt > td").each(function(i){
	    if(i > 0){
			$(this).detach();
		}
	});

	//Limpo as colunas de fornecedores da linha .desconto 
	$('#table_principal > tbody#myTable').find("> tr.desconto > td").each(function(i){
	    if(i > 0 ){
			$(this).detach();
		}
	});

	let total = $('#table_principal > tbody#myTable').find('> tr.total').clone(true);
	let oc = $('#table_principal > tbody#myTable').find('> tr.oc').clone(true);
	let forma_pgt = $('#table_principal > tbody#myTable').find('> tr.forma_pgt').clone(true);
	let desconto = $('#table_principal > tbody#myTable').find('> tr.desconto').clone(true);

	//Limpo todas as linhas do tbody menos a linha .hidden
	$('#table_principal > tbody#myTable').find("> tr:not(tr.hidden)").each(function(){
		$(this).detach();
	});

	//Habilito os botoes das espécies
	$('tbody#table_especie > tr > td:last-child').find('a').each(function(){
		$(this).show();
	});

	//$('a.add_all_especie').show();

	let att_cotacao = $orcamento.find('> option:selected').val();

	// console.log(att_cotacao, 'att cotaceixon');

	if(att_cotacao != -1){

		id_cotacao_oc = att_cotacao;
		//Ajax para montar a tabela de OC ja emitidas
		$.ajax({  
			url:'const_grava_cotacao.php',  
			method:'POST', 
			data: {id_cotacao_oc:id_cotacao_oc},
			dataType:'json',  
			success: dados => 	
			{  	
				$('div#lista_oc > div > table > tbody > tr:not(tr.hidden)').each(function(){
					$(this).detach();
				});

				if(dados != '0'){
					//console.log(dados);
					for(let data in dados){
						let tr = $('div#lista_oc > div > table > tbody > tr.hidden').clone(true).removeClass('hidden');

						tr.find('> td').eq(0).text(dados[data].id);
						tr.find('> td').eq(1).text(dados[data].data);
						tr.find('> td').eq(2).text((dados[data].total).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
						tr.find('> td').eq(3).text($('tbody#table_fornecedor > tr[id_cliente="'+dados[data].id_fornecedor+'"] > td').eq(1).text());

						if(dados[data].status == '0'){
							tr.find('> td').eq(5).text('Cancelado').find('> a').hide();
						}

						$('div#lista_oc > div > table > tbody').append(tr);

						//tr.find('> td').eq(0).text(dados[data].id);
					}
				}
				
			},
			error: erro => {console.log(0)}  
		}); 


		//desconsidera
		id_cotacao = att_cotacao;
		//Ajax para atualizar o select de upload de planilhas da pagina




		

		$.ajax({  
			url:'const_grava_cotacao.php',  
			method:'POST', 
			data: {id_cotacao:id_cotacao},
			dataType:'json',  
			success: dados => 	
			{  	
				// console.log('forn ', dados);  ok
				$('select#fornecedor_up_excel > option:not(option[value="-1"])').detach();
				if(dados != '0'){
					for(let i = 0; i < dados.length; i++){
						$('select#fornecedor_up_excel').append('<option value="'+dados[i].id+'" style="text-transform: uppercase;">'+dados[i].nome+'</option>');
					}
				}

				$('input[name="cotacao"]').val(id_cotacao);
			},
			error: erro => {console.log(0)}  
		}); 

		console.log('att cot', att_cotacao);
		//Ajax para obter os dados da planilha

		// console.log(att_cotacao);
		$.ajax({
			url:   'const_grava_cotacao.php',
			type:  'POST',
	   		data: {att_cotacao:att_cotacao}, //essa e o padrao x-www-form-urlencode
	   		dataType:'json',  

	   		beforeSend: function() {
	   			$("div#dialog-body").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
	   			$("div#dialog-footer").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
	   			$("button#dialog").click();
	   		},
	   		error: function(data) {
	   			console.log('erro data',data);
	   			$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Carregar a Tabela!!</h4>");
	   			$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
	   		},
	   		success: function(data) { 

	   			if(data != 0){

	   				//Insiro as colunas na tabela
	   				if(data.length > 0 && data[0].table_header.length > 0){
	   					//For para inserir os th no cabeçalho da tabela 
	   					for(let i = 0; i < data[0].table_header.length; i++){

	   						//Linha para mostrar apenas o primeiro nome no titulo da coluna
	   						nome = data[0].table_header[i].nome_fornecedor.split(' ');

	   						$('#table_principal > thead#thead_principal').find('> tr').append("<th class='text-center' id-fornecedor='"+data[0].table_header[i].id_fornecedor+"'>"+nome[0]+"<a  id='remove-col' href='#dialog-remove' data-toggle='modal' data-target='#dialog-remove'><span class='glyphicon glyphicon-remove'></span></th>");

	   						$("#table_principal > tbody#myTable").find('> tr.hidden').append("<td id-fornecedor='"+data[0].table_header[i].id_fornecedor+"' contenteditable='true' style='text-align: center;'>R$ 0,00</td>");

	   						//$("#table_principal > tbody#myTable").find('> tr.total').append("<td id-fornecedor='"+data[0].table_header[i].id_fornecedor+"' style='text-align: center;'>R$ 0,00</td>");

	   						//Desabilito o botao de adicionar o fornecedor de acordo com os fornecedores da tabela
	   						$('tbody#table_fornecedor').find('> tr[id_cliente="'+data[0].table_header[i].id_fornecedor+'"] > td:last-child > a').hide();
						   }
						   
						   // ate aq ok
	   				}




	   				//$(this).find('> td:last-child').focus();

	   				//Insiro as celulas da tabela
	   				if(data.length > 0){
		   				//Faz para inserir os td na tbody
						   //data.length - 2 , pois eu nao percorro agora a forma_pgt e o desconto
						   
							// removo dados que ja estao na tabela
						//    $('#table_principal > tbody#myTable').find("> tr:last-child").remove();

		   				for(let i = 1; i < (data.length - 2); i++){
		   					//console.log(data[i]);

		   					let insumo = data[i].id_insumo;
		   					let fornecedor = data[i].id_fornecedor;
		   					
		   					let tr = "tr[id-insumo='"+insumo+"']";
		   					let td = "> td[id-fornecedor='"+fornecedor+"']";

		   					//Verificação para saber se a linha existe
		   					if($(tr).find(td).length){
		   						$(tr).find(td).text(parseFloat(data[i].valor * data[i].qnt_cotado).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
		   						$(tr).find(td).attr('valor_unitario', data[i].valor);

								   

		   						if(data[i].ultima_oc.id_oc != null){
		   							//Faço a inserção do último valor de uma oc com o respectivo fornecedor e Insumo como title de td 
		   							let aux_tilte = '#### ULTIMA VENDA ####&#013;';
		   							aux_tilte += 'Ordem de compra Nº: '+data[i].ultima_oc.id_oc+'&#013;';
		   							aux_tilte += 'Valor :'+parseFloat(data[i].ultima_oc.valor_unidade).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})+'&#013;';
		   							aux_tilte += 'Data de Venda: '+data[i].ultima_oc.data;

		   							$('#table_principal > tbody#myTable').find("> tr:last-child > td[id-fornecedor='"+fornecedor+"']").attr('title', $('<div/>').html(aux_tilte).text());
		   						}
		   						
		   					}else{
		   						let status ; 

		   						data[i].status == 1 ? status = '' : status = 'naoOrcado';

								//    console.log('chama nela >>> ', data);
		   						if(data[i].status == 1){

									console.log('status data >>> ',data[i].status);

									// $('#table_principal > tbody#myTable').empty();
									//    Passa os dados para a tabela
									// .find vai obter os elementos do conjunto
									// .clone cria uma copia do elemento
									//.append insere o conteúdo no final do elemento
									$('#table_principal > tbody#myTable').find("> tr:last-child > td").val("");
			   						let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();
									   $('#table_principal > tbody#myTable').append(aux);

									   //aqui retira o hiden e mostra a tabela
	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
	    		   					.addClass('align-center').attr('id-insumo', data[i].id_insumo);

									console.log('desc >> ',data[i].descricao);   
	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].descricao).attr('title', 'CÓDIGO: '+data[i].codigo);

	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text(data[i].qnt_orcado == '' ? 0 : data[i].qnt_orcado).attr('title', 'UNIDADE MEDIDA: '+data[i].unidade);

	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text((data[i].qnt_orcado * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'VALOR UNIDADE: '+parseFloat(data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(4).text(data[i].qnt_cotado);

	    		   					//Coloco o Valor cotado na nova linha criada
	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td[id-fornecedor='"+fornecedor+"']").text(parseFloat(data[i].valor * data[i].qnt_cotado).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td[id-fornecedor='"+fornecedor+"']").attr('valor_unitario', data[i].valor);


	    		   					if(data[i].ultima_oc.id_oc != null){
			   							//Faço a inserção do último valor de uma oc com o respectivo fornecedor e Insumo como title de td 
			   							let aux_tilte = '#### ULTIMA VENDA ####&#013;';
			   							aux_tilte += 'Ordem de compra Nº: '+data[i].ultima_oc.id_oc+'&#013;';
			   							aux_tilte += 'Valor :'+parseFloat(data[i].ultima_oc.valor_unidade).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})+'&#013;';
			   							aux_tilte += 'Data de Venda: '+data[i].ultima_oc.data;

			   							$('#table_principal > tbody#myTable').find("> tr:last-child > td[id-fornecedor='"+fornecedor+"']").attr('title', $('<div/>').html(aux_tilte).text());
			   						}
			   						
		   						}else{



			   						let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();
	    		   					$('#table_principal > tbody#myTable').append(aux);

	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
	    		   					.addClass('align-center').addClass('naoOrcado').attr('id-insumo', data[i].id_insumo).attr('title', 'Item nao Orçado');

	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].descricao).attr('title', 'CÓDIGO: '+data[i].codigo);

	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text(data[i].qnt_orcado == '' ? 0 : data[i].qnt_orcado).attr('title', 'Item nao Orçado');

	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text((data[i].qnt_orcado * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'Item nao Orçado');

	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(4).text(data[i].qnt_cotado);

	    		   					//Coloco o Valor cotado na nova linha criada
	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td[id-fornecedor='"+fornecedor+"']").text(parseFloat(data[i].valor * data[i].qnt_cotado).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

	    		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td[id-fornecedor='"+fornecedor+"']").attr('valor_unitario', data[i].valor);

	    		   					if(data[i].ultima_oc.id_oc != null){
			   							//Faço a inserção do último valor de uma oc com o respectivo fornecedor e Insumo como title de td 
			   							let aux_tilte = '#### ULTIMA VENDA ####&#013;';
			   							aux_tilte += 'Ordem de compra Nº: '+data[i].ultima_oc.id_oc+'&#013;';
			   							aux_tilte += 'Valor :'+parseFloat(data[i].ultima_oc.valor_unidade).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})+'&#013;';
			   							aux_tilte += 'Data de Venda: '+data[i].ultima_oc.data;

			   							$('#table_principal > tbody#myTable').find("> tr:last-child > td[id-fornecedor='"+fornecedor+"']").attr('title', $('<div/>').html(aux_tilte).text());
			   						}

		   						}
		   					}
		   				}
	   				}
	   				
	   				$('#table_principal > tbody#myTable').append(desconto);
	   				$('#table_principal > tbody#myTable').append(forma_pgt);
	   				$('#table_principal > tbody#myTable').append(total);
	   				$('#table_principal > tbody#myTable').append(oc);
	   				$('a#finaliza_cotacao').removeClass('hidden');

	   				if(data.length > 0 && data[0].table_header.length > 0){
	   					//For para inserir as colunas nas linhas especiais
		   				for(let i = 0; i < data[0].table_header.length; i++){
		   					$("#table_principal > tbody#myTable").find('> tr.total').append("<td id-fornecedor='"+data[0].table_header[i].id_fornecedor+"' style='text-align: center;'>R$ 0,00</td>");

		   					$("#table_principal > tbody#myTable").find('> tr.oc').append("<td id-fornecedor='"+data[0].table_header[i].id_fornecedor+"' style='text-align: center;'>"+oc.find('td[id-fornecedor]').html()+"</td>");

		   					$("#table_principal > tbody#myTable").find('> tr.desconto').append("<td id-fornecedor='"+data[0].table_header[i].id_fornecedor+"' contenteditable='true' style='text-align: center;' class='desconto'>R$ 0,00</td>");

		   					$("#table_principal > tbody#myTable").find('> tr.forma_pgt').append("<td id-fornecedor='"+data[0].table_header[i].id_fornecedor+"' style='text-align: center;'></td>");
		   					$("#table_principal > tbody#myTable").find('> tr.forma_pgt > td:last-child').append(forma_pgt.find('> td').eq(0).find('> select').clone(true).removeClass('hidden'));
		   				}
	   				}

	   				if(data.length > 2 && data[(data.length - 2)].desconto.length > 0){
	   					//For para inserir valor para a linha desconto
		   				// (data.length - 2) , para parar em cima do desconto
						for(let j = 0; j < data[(data.length - 2)].desconto.length; j++){

							let td = 'td[id-fornecedor="'+data[(data.length - 2)].desconto[j].id_fornecedor+'"]';

							$("tr.desconto > "+td).text(parseFloat(data[(data.length - 2)].desconto[j].desconto).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
						}
	   				}
	   				
					if(data.length > 2 && data[(data.length - 1)].forma_pgt.length > 0){
						//For para inserir valor para a linha desconto
		   				// data.length - 1 , para parar em cima do forma_pgt
	   					//console.log(data[i]);
						for(let j = 0; j < data[(data.length - 1)].forma_pgt.length; j++){

							let td = 'td[id-fornecedor="'+data[(data.length - 1)].forma_pgt[j].id_fornecedor+'"]';

							$("tr.forma_pgt > "+td).find('> select > option[value="'+data[(data.length - 1)].forma_pgt[j].id_forma_pgt+'"]').attr('selected' , 'selected');
						}
	   				}
	   				
	   				
	   				calc_total();
	   				$("button.close").click();
	   			}else{
	   				//console.log(data);

	   				$('#table_principal > tbody#myTable').append(desconto);
	   				$('#table_principal > tbody#myTable').append(forma_pgt);
	   				$('#table_principal > tbody#myTable').append(total);
	   				$('#table_principal > tbody#myTable').append(oc);
	   				$('a#finaliza_cotacao').addClass('hidden');

	   				//calc_total();
	   				$("button.close").click();
	   				//console.log('aqui');
	   			}
	   		}
	   		
	   	});
	}else{
		$('select#fornecedor_up_excel > option:not(option[value="-1"])').detach();
		$('#table_principal > tbody#myTable').append(total);
		$('#table_principal > tbody#myTable').append(oc);
		$('#table_principal > tbody#myTable').find('> tr.total').hide();
		$('#table_principal > tbody#myTable').find('> tr.oc').hide();
		$('a#finaliza_cotacao').addClass('hidden');
	}
});

//Exporto a tabela para PDF
$('a#export_pdf').click(function(){

	//var pdf = "<style type='text/css'>"+$('style#page_style').html()+"</style>";
	var pdf = $('div#table').clone(true);
	var cabecalho = $('div#alert').clone(true);
	var tr_hidden = $('table#table_principal > tbody > tr.hidden').clone(true);
	var total;

	var id_cotacao = $('select#orcamento > option:selected').val();

	//console.log(cabecalho.html());

	cabecalho.html("<h2 style='font-size: 16px; text-align: center; text-transform:uppercase; font-weight:bold'>Relátorio de Cotação</h2>");

	cabecalho.append("<p style='font-size: 14px; text-align: left; text-transform:uppercase; font-weight:bold'>Cotação : "+$('li[id="'+id_cotacao+'"]').text()+"</p>");

	cabecalho.append("<p style='font-size: 12px; text-align: left; text-transform:uppercase; '>"+DiaExtenso()+"</p>");
	
	cabecalho.css({
		'margin' : '15px',
	});

	pdf.find('table#table_principal > thead > tr > th').each(function(i){
		if(i == 0 ){
			$(this).detach();
		}else{
			$(this).css({
				'vertical-align' : 'center',
				'font-size' : '13px',
				'padding' : '5px',
				'font-weight': 'bold',
				'color' : '#fff',
				'background-color' : '#343a40',
				'text-transform' : 'uppercase',
			});
		}
	});

	pdf.find('table#table_principal > tbody > tr').each(function(i){

		if($(this).hasClass('total')){
			$(this).find('> td').eq(0).attr('colspan', '3');
		}
		if($(this).hasClass('forma_pgt')){
			$(this).detach();
		}
		if($(this).hasClass('desconto')){
			$(this).detach();
		}

		$(this).find('> td').each(function(j){
			if(j == 0 && !$(this).parents('tr').hasClass('total')){
				$(this).detach();
			}else if($(this).hasClass('menor_preco')){
				$(this).css('background-color', '#97DB9B!important');
				$(this).css('border', 'solid 1px #FFF');
			}else if($(this).hasClass('melhor_compra')){
				$(this).css('background-color', '#33b5e5!important');
				$(this).css('border', 'solid 1px #FFF');
			}
		});

		if($(this).hasClass('hidden') || $(this).hasClass('oc')){
			$(this).detach();
		}else if($(this).hasClass('naoOrcado')){
			$(this).css({
				'border' : 'solid 1px #cc0000',
				'background-color' : '#ffc107',
			});
		}else if(i % 2 == 0){

			$(this).css({
				'border' : 'solid 1px #000',
				'background-color' : '#ccc',
			});
		}
	});

	pdf = (cabecalho.html() + pdf.html());
	//console.log(pdf);

	$.ajax({
		url:   'const_grava_cotacao.php',
		type:  'POST',
	   //cache: false,
	   //data:  { ok : 'deu certo!'},
   		data: {pdf:pdf}, //essa e o padrao x-www-form-urlencode
   		//dataType:'json',  

   		beforeSend: function(){
			$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
			$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar' >Carregando, aguarde!</h4>");
			$("a#salvar").click();
		},
		success: dados => 
		{  	
			$("div#salvar").html("<a href='pdf/filename.pdf' class='btn btn-success' target='_blank' style='text-align: center;'>Abrir PDF</a>");
			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		},
		error: erro => {console.log("alonso")},  
   	});
});

//Exporto os dados para o excel
$('a#export_excel').click(function(){

	let excel = [];
	let dado = [];

	$('table#table_principal').find('> tbody > tr:not(tr.hidden, tr.total, tr.oc, tr.forma_pgt, tr.desconto)').each(function(i){
		dado.push($(this).find('> td').eq(1).text());
		dado.push($(this).find('> td').eq(4).text());

		excel.push(dado);

		dado = [];
	});

	//console.log(excel);

	$.ajax({
		url:   'const_grava_cotacao.php',
		type:  'POST',
	   //cache: false,
	   //data:  { ok : 'deu certo!'},
   		data: {excel:excel}, //essa e o padrao x-www-form-urlencode
   		//dataType:'json',  

   		beforeSend: function(){
			$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
			$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar' >Carregando, aguarde!</h4>");
			$("a#salvar").click();
		},
		success: dados => 
		{  	
			$("div#salvar").html("<a href='pdf/cotacao.xlsx' class='btn btn-success' style='text-align: center;'>Baixar EXCEL</a>");
			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		},
		error: erro => {console.log("alonso")},  
   	});
});

//Atualiza os campos do select de acordo com a categoria selecionada
$("select#select_categoria").change(function(data){

	//Pego o elemento selecionado
	var aux = {opcao_select : $(this).find('option:selected').val()};

	$.ajax({  
		url:'const_grava_insumo.php',  
		method:'POST', 
		data: aux,
		dataType:'json',  
		success: dados => 	
		{  
			if(dados != 1){
				//limpo todas as opções
				var selecione = $("select#select_especie").find('> option#selecione').clone(true);
				$("select#select_especie").empty();
				$("select#select_especie").append(selecione);

				for(var i = 0; i < dados.length; i++){
					//insiro as opções que peguei no banco
					$("select#select_especie").append('<option value="'+dados[i]+'">'+dados[i]+'</option>');
				}
			}else{
				var selecione = $("select#select_especie").find('> option#selecione').clone(true);
				$("select#select_especie").empty();
				$("select#select_especie").append(selecione);
			}
		},
		error: erro => {console.log(1)}  
	});  
});

//Atualiza toda a tabela de insumos de acordo com as opções selecionadas
$("a#atualizar").click(function(){

	var $TABLE = $('#table_insumos > table');
	var $FORM_PRINCI = $('#form_principal');

	var $clone = $TABLE.find('> tbody > tr.hide').clone(true);
	$TABLE.find('> tbody').empty();
	$TABLE.find('> tbody').append($clone);
	
	var aux = {};

	aux['categoria'] = $FORM_PRINCI.find('select#select_categoria > option:selected').val();
	aux['especie'] = $FORM_PRINCI.find('select#select_especie > option:selected').val();

	$.ajax({  
		url:'const_grava_insumo.php',  
		method:'POST', 
		data: aux,
		dataType:'json', 
		beforeSend: function(){
			$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
			$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
			$("a#salvar").click();
		},
		success: dados => 
		{  	
			//console.log(dados);
			$("button#close").click();

			if(!isEmpty(dados)){

				for(var data in dados ){

					var $clone = $TABLE.find('> tbody > tr.hide').clone(true).removeClass('hide table-line').attr('id-insumo-solo', dados[data].id);
					$TABLE.find('> tbody').append($clone);

					$TABLE.find('> tbody > tr:last-child > td').each(function(i){
						if(i == 0){
							$(this).text(dados[data].codigo);

						}else if(i == 1){
							$(this).text(dados[data].desc);
						}
					});
				}
			}else{
				$TABLE.find('> tbody').empty();
				if ($('> tbody').is(':empty')){

					$('> tbody').html("<tr colspan='4' align='center'><td>Sem conteudo !</td></tr>");
				}
			}
		},
		error: erro => {
			$("button#close").click();
			console.log("Erro")
		},  
	});
});	

 //Adiciono um nova Cotacao e faz a inserção no banco de dados
$('button#add_cotacao').click(function(){
	let orcamento = $('select#select_add_cotacao').find('option:selected').attr('id');
	let titulo = $('input[name="titulo_cotacao"]').val();

	console.log(orcamento);
	console.log(titulo);

	//console.log(orcamento);
	if(orcamento != -1 && titulo != ''){
		$.ajax({  
			url:'const_grava_cotacao.php',  
			method:'POST', 
			data: {orcamento:orcamento, titulo:titulo},
			dataType:'json',  
			success: dados => 	
			{  
				if(dados == '1'){
					window.location.replace("const_cotacao.php");
				}
			},
			error: erro => {console.log(1)}  
		}); 
	}else{
		alert('Selecione Um Orçamento! / Digite um titulo!');
	}
});

//Faço a exclusão da linha selecionada 
$('button#remove-tr').click(function(){
	let insumo = $(this).attr('id-insumo');
	let cotacao = $(this).attr('cotacao');

	$.ajax({
		url:   'const_grava_cotacao.php',
		type:  'POST',
   		data: {insumo:insumo, cotacao:cotacao}, //essa e o padrao x-www-form-urlencode
   		dataType:'json',  

		success: dados => 
		{  	
			if(dados = '1'){
				$("tr[id-insumo='"+insumo+"']").detach();

    			$("button#dialog").click();
    			$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Excluido com Sucesso!</h4>");
           		$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			}else{
				$("button#dialog").click();
				$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Excluir!!</h4>");
				$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			}
			calc_total();
		},
		error: erro => {
			$("button#dialog").click();
			$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Excluir!!</h4>");
			$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		},  
   	});
});

//Habilito ou desabilito todos os check box da tabela principal 
$('input#input_master').click(function(){

	let check;

	$(this).attr("checked") == 'checked' ? check = true : check = false; 

	$('tbody#myTable > tr > td:first-child > input.input_tr').each(function(i){
		$(this).attr("checked", check);
	});
});

//Atualizo a lista de cotações de acordo com o Orçamento Selecionado
$('select#select_orcamento').change(function(){
	let orc_cotacao = $('select#select_orcamento').find('option:selected').val();

	let list = $('ul#list_cotacao');

	list.empty();

	$.ajax({
		url:   'const_grava_cotacao.php',
		type:  'POST',
	   //cache: false,
   		data: {orc_cotacao:orc_cotacao}, //essa e o padrao x-www-form-urlencode
   		dataType:'json',  

		success: dados => 
		{  	
			//console.log(dados);

			if(dados != '0'){
				for(let dado in dados){
					list.append("<li id='"+dados[dado].id+"' class='list-group-item lista_cotacao' style='text-align:center; text-transform: uppercase; font-weight: bold; font-size: 15px;'>"+(dados[dado].titulo)+"</li>");
				}
			}
		},
		error: erro => {console.log("alonso")},  
   	});
});

//Atualizo a tabela de acordo com a Cotação Selecionada
$(document).on('click', 'li.lista_cotacao', function(){
	let id = $(this).attr('id');

	$('button.close').click();

	$('select#orcamento').find('option[value="'+id+'"]').attr('selected', 'selected').change();

	$('h2.panel-title').text($(this).text());
});

// Aplica mascara de money sempre que ocorre um evento Blur em alguma das celulas editaveis
$(document).on('blur', "td[contenteditable='true']:not(.quantidade_cotada)", function(){
	let valor;
	let qnt = $(this).parents('tr').find('>td.quantidade_cotada').text();

	isNaN(parseFloat($(this).text().replace(/[R$. ]/g, '').replace(/,/g, '.'))) ? valor = 0 : valor = parseFloat($(this).text().replace(/[R$. ]/g, '').replace(/,/g, '.'));

	$(this).text(valor.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

	if(!$(this).parents('tr').hasClass("desconto")){
		//Realizo o calculo do valor unitario e armazeno a informação no atributo valor_unitario dentro da td
		$(this).attr('valor_unitario', (valor / qnt));	
	}
		        	
	calc_total();
});

// Realiza o calculo do valor Total toda vez que ocorre o evento blur em algum td de qnt cotada
$(document).on('blur', "td.quantidade_cotada", function(){
	let qnt = parseFloat($(this).text()); 
	let valor_unitario;

	$(this).parents('tr').find('> td[id-fornecedor]').each(function(){
		valor_unitario = $(this).attr('valor_unitario');

		$(this).text((qnt * valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
	});

	calc_total();
	calc_total_oc();
});

// Salva o cpf a ser excluido no botao de exclusao da modal dialog-remove
$(document).on('click', "a#remove-col", function(){
	let cpf = $(this).parents('th').attr('cpf-fornecedor');
	let id_fornecedor = $(this).parents('th').attr('id-fornecedor');
	$('button#remove-col').attr('cpf-fornecedor', cpf);
	$('button#remove-col').attr('id-fornecedor', id_fornecedor);
});

// Remove a coluna selecionada após a confirmação e faz a exclusao na tabela conts_fornecedor_cotacao
$(document).on('click', "button#remove-col", function(){
	let id_fornecedor = $(this).attr('id-fornecedor');
	let cotacao = $orcamento.find('option:selected').val();

	//console.log(cotacao);
	//console.log(id_fornecedor);

	/*
	$.ajax({  
		url:'const_grava_cotacao.php',  
		method:'POST', 
		data: {cotacao:cotacao, id_fornecedor:id_fornecedor },
		dataType:'json',  
		success: dados => 	
		{  	
			console.log(1);
		},
		error: erro => {console.log(0)}  
	}); 
	*/

	$('thead#thead_principal').find('> tr > th[id-fornecedor="'+id_fornecedor+'"]').detach();

	$("tbody#myTable").find('> tr > td[id-fornecedor="'+id_fornecedor+'"]').each(function(){
		$(this).detach();
	});

	$('tbody#table_fornecedor > tr[id_cliente="'+id_fornecedor+'"]').find('> td:last-child > a').show();
});

// Adiciona a espécie de MATERIAL selecionada de acordo com o orçamento selecionado
$(document).on('click', "a#add_especie", function(){
	//console.log('ola');
	if($('select#orcamento option:selected').val() != -1){
		let id_orc = $('select#orcamento option:selected').val();
		let id_especie = $(this).parents('tr').attr('id');
		$(this).hide();

		//console.log(id_orc);
		//console.log(id_especie);
		
		$.ajax({
		   url:   'const_grava_cotacao.php',
		   type:  'POST',
		   //cache: false,
		   //data:  { ok : 'deu certo!'},
       		data: {id_orc:id_orc, id_especie:id_especie}, //essa e o padrao x-www-form-urlencode
       		dataType:'json',  

		   success: function(data) { 
		   		//console.log(data);

		   		if(data != 0){
		   			let total = $('#table_principal > tbody#myTable').find('> tr.total').clone(true);
		   			let oc = $('#table_principal > tbody#myTable').find('> tr.oc').clone(true);

		   			$('#table_principal > tbody#myTable').find('> tr.total').detach();
		   			$('#table_principal > tbody#myTable').find('> tr.oc').detach();

		   			for(let i = 0; i < data.length; i++){
		   				if(!$("tr[id-insumo='"+data[i].id+"']").length){
			   				let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();

			   				$('#table_principal > tbody#myTable').append(aux);

			   				$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
		   					.addClass('align-center').attr('id_especie', data[i].id_especie).attr('id-insumo', data[i].id);


			   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].descricao).attr('title', 'CÓDIGO: '+data[i].codigo);
			   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text(data[i].quantidade == '' ? 0 : data[i].quantidade).attr('title', 'UNIDADE MEDIDA: '+data[i].unidade);
			   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text((data[i].quantidade * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'VALOR UNIDADE: '+parseFloat(data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

			   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(4).text(data[i].quantidade == '' ? 0 : data[i].quantidade);

			   				$('#table_principal > tbody#myTable').find("> tr:last-child > td[contenteditable='true']:not(td.quantidade_cotada)").each(function(){
			   					$(this).text('R$ 0,00');
			   				});
		   				}
		   			}

		   			$('#table_principal > tbody#myTable').append(total);
		   			$('#table_principal > tbody#myTable').append(oc);

		   			calc_total();
		   		}
		   },
			   error: function() {
			        console.log(0);
			   }
		});
		
	}else{
		alert("Selecione um Orçamento !");
	}
});

//Adiciona um novo unico insumo, e faz a verificação se ele foi orçado
$(document).on('click', 'button.add_insumo_unico', function(){
	let id_insumo_adicionar = $(this).parents('tr').attr('id-insumo-solo');
	let cotacao = $orcamento.find('> option:selected').val();

	if(cotacao != -1){

    	$.ajax({
    		url:   'const_grava_cotacao.php',
    		type:  'POST',
		   //cache: false,
       		data: {id_insumo_adicionar:id_insumo_adicionar, cotacao:cotacao}, //essa e o padrao x-www-form-urlencode
       		dataType:'json',  

    		success: data => 
    		{  	
		   		if(data != 0){

		   			let total = $('#table_principal > tbody#myTable').find('> tr.total').clone(true);
		   			let oc = $('#table_principal > tbody#myTable').find('> tr.oc').clone(true);

		   			$('#table_principal > tbody#myTable').find('> tr.total').detach();
		   			$('#table_principal > tbody#myTable').find('> tr.oc').detach();

		   			for(let i = 0; i < data.length; i++){

		   				if(!$("tr[id-insumo='"+data[i].id+"']").length){

		   					if(data[i].valida == '1'){
				   				let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();

				   				$('#table_principal > tbody#myTable').append(aux);

				   				$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
			   					.addClass('align-center').attr('id_especie', data[i].id_especie).attr('id-insumo', data[i].id);


				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].descricao).attr('title', 'CÓDIGO: '+data[i].codigo);
				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text(data[i].quantidade == '' ? 0 : data[i].quantidade).attr('title', 'UNIDADE MEDIDA: '+data[i].unidade);
				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text((data[i].quantidade * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'VALOR UNIDADE: '+parseFloat(data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(4).text(data[i].quantidade == '' ? 0 : data[i].quantidade);

				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td[contenteditable='true']:not(td.quantidade_cotada)").each(function(){
				   					$(this).attr('valor_unitario', data[i].valor_unitario);
				   					$(this).text((data[i].quantidade * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
				   				});
		   					}else{
				   				let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone(true);

				   				$('#table_principal > tbody#myTable').append(aux);

				   				$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
			   					.addClass('align-center').attr('id_especie', data[i].id_especie).attr('id-insumo', data[i].id).addClass('naoOrcado').attr('title', 'Item Não Orçado');


				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].descricao).attr('title', 'CÓDIGO: '+data[i].codigo);
				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text(data[i].quantidade == '' ? 0 : data[i].quantidade).attr('title', 'Item Não Orçado');
				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text((data[i].quantidade * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'Item Não Orçado');

				   				$('#table_principal > tbody#myTable').find("> tr:last-child > td[contenteditable='true']:not(td.quantidade_cotada)").each(function(){
				   					$(this).attr('valor_unitario', data[i].valor_unitario);
				   					$(this).text((data[i].quantidade * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
				   				});
		   					}
		   				}
		   			}

		   			$('#table_principal > tbody#myTable').find('> tr:last-child > td.quantidade_cotada').focus();


		   			$('#table_principal > tbody#myTable').append(total);
		   			$('#table_principal > tbody#myTable').append(oc);

		   			$('.close').click();
		   		}else{
		   			alert('Insumo Não encontrado!');
		   		}
    			//console.log(dados);
    		},
    		error: erro => {console.log("alonso")},  
       	});

		//console.log(id_insumo);
	}else{
		alert('Selecione Uma Cotação!');
	}
});

//Lista todos os itens selecionados para gerar OC de acordo com o fornecedor selecionado
$(document).on('click', 'a.gerar_oc', function(){
	let id_fornecedor = $(this).parents('td').attr('id-fornecedor');
	let verifica_check = 0;

	//Validacao se todos os itens preenchidos possuem valores preenchidos
	let valida = 1;

	//Removo Class active de todos os itens da modal de OC
	$('ul.nav-tabs > li').each(function(){
		$(this).removeClass('active');
	});
	$('div.tab-content > div').each(function(){
		$(this).removeClass('active');
	});

	//Verifico se ha alguma linha selecionada
	$('tbody#myTable > tr > td:first-child > input.input_tr').each(function(i){
		if($(this).attr('checked') == 'checked'){
			verifica_check = 1;
			return;
		}
	});


	if(verifica_check == 0){
		$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Selecione um item!</h4>");
		$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		$("a#salvar").click();

	}else if(id_fornecedor != 'melhor_compra'){

		//Pegando o Nome do fornecedor
		let nome_fornecedor = $('tbody#table_fornecedor > tr[id_cliente="'+id_fornecedor+'"] > td').eq(1).text();

		//Clono nav da modal de OC
		let li_nav = $('ul.nav-tabs > li.hidden').clone(true).removeClass('hidden').addClass('active');
		li_nav.find('> a').attr('href', '#id'+id_fornecedor).attr('aria-controls', 'id'+id_fornecedor).attr('id-fornecedor', id_fornecedor).text('OC: '+nome_fornecedor);
		//$('ul.nav-tabs').append(li_nav);

		//Clono o content da modal de oc
		let div_content = $('div.tab-content > div.hidden').clone(true).removeClass('hidden').addClass('active').attr('id', 'id'+id_fornecedor).attr('id-fornecedor', id_fornecedor);
		//$('div.tab-content').append(div_content);

		$('tbody#myTable > tr > td:first-child > input.input_tr').each(function(i){
			if($(this).attr('checked') == 'checked'){
				let tr_aux = $(this).parents('tr').clone(true);

				//Limpo as colunas nao usadas da linha selecionada
				tr_aux.find('> td').each(function(i){
					//Retiro a class estorou
					//$(this).hasClass('estorou') ? $(this).removeClass('estorou'): '';

					if(i == 0 || i == 2 || i == 3){
						$(this).detach();
					}else if(i > 4 && $(this).attr('id-fornecedor') != id_fornecedor){
						$(this).detach();
					}else if($(this).attr('id-fornecedor') == id_fornecedor && !($(this).attr('valor_unitario') == 0 || $(this).attr('valor_unitario') == '') ){
						$(this).attr('contenteditable', 'false').removeClass('menor_preco');
					}else if($(this).attr('id-fornecedor') == id_fornecedor && ($(this).attr('valor_unitario') == 0 || $(this).attr('valor_unitario') == '')){
						valida = 0;
						return;
					}
				});

				if(valida == 0){
					return;
				}

				tr_aux.hasClass('hidden') ? tr_aux.detach() : '';

				div_content.find('tbody').append(tr_aux);
			}
    	});


    	if(valida != 0){
    		div_content.find('tbody').append("<tr class='desconto'><td style='text-align: center; font-size: 12px!important;'>DESCONTO : </td><td style='text-align: center;' colspan='2' class='desconto'>"+$('#myTable > tr.desconto > td[id-fornecedor="'+id_fornecedor+'"]').text()+"</td></tr>");
			div_content.find('tbody').append("<tr class='total'><td style='text-align: center; font-size: 12px!important;'>TOTAL : </td><td style='text-align: center;' colspan='2'> </td></tr>");

			$('ul.nav-tabs.nav_oc').append(li_nav);
			$('div.tab-content.div_oc').append(div_content);

			//Desabilito o botao de gerar OC clicado, e o de gerar OC melhor compra
			$(this).hide();
			$(this).parents('tr').find('> td[id-fornecedor="melhor_compra"] > a').hide();

			//Exibo a modal
    		$('div#OC').modal('show');

    		calc_total_oc();
    	}else{
			console.log('essaqui');
			$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Por favor preencher todos os valores dos itens selecionados!</h4>");
			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			$("a#salvar").click();
    	}
	}else{

		//Verifico se ha alguma linha selecionada que contem valor == 0
		$('tbody#myTable > tr > td:first-child > input.input_tr').each(function(i){
			if($(this).attr('checked') == 'checked'){
				$(this).parents('tr').find('> td').each(function(i){
					if(i > 4 && ($(this).attr('valor_unitario') == 0 || $(this).attr('valor_unitario') == '')){
						valida = 0;
						return;
					}
				});
			}

			if(valida == 0)
				return;
    	});

    	if(valida != 0){

    		//Desabilito todos os botões de OC
    		$(this).parents('tr').find('a').each(function(){
    			$(this).hide();
    		});

    		$('tbody#myTable > tr:not(tr.hidden, tr.oc, tr.total) > td:first-child > input.input_tr').each(function(i){
				if($(this).attr('checked') == 'checked'){
					let tr_aux = $(this).parents('tr').clone(true);
					id_fornecedor = 0;

					//Limpo as colunas nao usadas da linha selecionada
					tr_aux.find('> td').each(function(i){
						//Retiro a class estorou
						//$(this).hasClass('estorou') ? $(this).removeClass('estorou'): '';

						if(i == 0 || i == 2 || i == 3){
							$(this).detach();

						}else if(i > 4 && $(this).hasClass('menor_preco')){
							$(this).attr('contenteditable', 'false').removeClass('menor_preco');

							id_fornecedor = $(this).attr('id-fornecedor');

						}else if(i > 4){
							$(this).detach();
						}
					});

					tr_aux.hasClass('hidden') ? tr_aux.detach() : '';
					//div_content.find('tbody').append(tr_aux);

					if($('a[aria-controls="id'+id_fornecedor+'"]').length){

						//Verifico se ja existe uma navbar com o id achado
						$('div#id'+id_fornecedor+'.tab-pane').find('tbody#tbody_oc').append(tr_aux);
					}else{

						nome_fornecedor = $('tbody#table_fornecedor > tr[id_cliente="'+id_fornecedor+'"] > td').eq(1).text();

						//Clono nav da modal de OC
						let li_nav = $('ul.nav-tabs > li.hidden').clone(true).removeClass('hidden');
						li_nav.find('> a').attr('href', '#id'+id_fornecedor).attr('aria-controls', 'id'+id_fornecedor).attr('id-fornecedor', id_fornecedor).text('OC: '+nome_fornecedor);
						//$('ul.nav-tabs').append(li_nav);


						let div_content = $('div.tab-content > div.hidden').clone(true).removeClass('hidden').attr('id', 'id'+id_fornecedor).attr('id-fornecedor', id_fornecedor);
						//$('div.tab-content').append(div_content);

						$('ul.nav-tabs.nav_oc').append(li_nav);
						$('div.tab-content.div_oc').append(div_content);

						$('div#id'+id_fornecedor+'.tab-pane').find('tbody#tbody_oc').append(tr_aux);
					}
				}
        	});

        	//Insiro o total em todas as navs criadas
        	$('div.div_oc > div.tab-pane:not(div.hidden)').each(function(){
        		$(this).find('tbody#tbody_oc').append("<tr class='desconto'><td style='text-align: center; font-size: 12px!important;'>DESCONTO : </td><td class='desconto' style='text-align: center;' colspan='2'>"+$('#myTable > tr.desconto> td[id-fornecedor="'+$(this).attr('id-fornecedor')+'"]').text()+"</td></tr>");
        		$(this).find('tbody#tbody_oc').append("<tr class='total'><td style='text-align: center; font-size: 12px!important;'>TOTAL : </td><td style='text-align: center;' colspan='2'> </td></tr>");
        	});

			//Exibo a modal
    		$('div#OC').modal('show');
    		calc_total_oc();

    	}else{
			console.log('nao e aquele');

    		$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Por favor preencher todos os valores dos itens selecionados!</h4>");
			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			$("a#salvar").click();
    	}
	}
});

//Cancela a emissao de OC, enquanto é gerada
$(document).on('click', 'a#cancela_oc', function(){
	let id = $(this).parents('div.tab-pane').attr('id-fornecedor');

	$(this).parents('div.tab-pane').detach();
	$('a[aria-controls="id'+id+'"]').parents('li').detach();


	$('tbody#myTable > tr.oc').find('> td[id-fornecedor="'+id+'"] > a').show();
	$('tbody#myTable > tr.oc').find('> td[id-fornecedor="melhor_compra"] > a').show();

	$('div#OC').modal('hide');
});

//le a tabela de OC salva e gera a Ordem de Compra
$(document).on('click', 'a#gerar_oc', function(){
	let id_user = $('a#id_usuario').attr('id-user');
	let id_fornecedor = $(this).parents('div[role="tabpanel"]').attr('id-fornecedor');
	let panel = $(this).parents('div[role="tabpanel"]').clone(true);
	let id_cotacao = $('select#orcamento').find('option:selected').val();

	let data_entrega = panel.find('input#input_data').val();
	let local_entrega = panel.find('input#input_local_entrega').val();

	let dados = Array();
	let dados_all = Array();

	dados_all.push(id_user);
	dados_all.push(id_fornecedor);
	dados_all.push(id_cotacao);

	//Insiro a data de entrega e o local entrega
	dados_all.push(data_entrega);
	dados_all.push(local_entrega);
	dados_all.push(parseFloat(panel.find('> div.card-body > div > table > tbody#tbody_oc > tr.desconto > td:last-child').text().replace(/[R$. ]/g, '').replace(/,/g, '.')));
	dados_all.push($('tbody#myTable > tr.forma_pgt > td[id-fornecedor="'+id_fornecedor+'"] > select > option:selected').val());

	//Rodo as linhas da planilha a ser gerada a OC
	panel.find('> div.card-body > div > table > tbody#tbody_oc > tr:not(tr.hidden, tr.total, tr.desconto)').each(function(){
		let linha = Array();

		linha.push($(this).attr('id-insumo'));
		linha.push($(this).find('> td').eq(1).text());
		linha.push($(this).find('> td').eq(2).attr('valor_unitario'));

		dados.push(linha);

	});

	// console.log(dados);
	//console.log(id_user);	
	//console.log(id_fornecedor);
	//console.log(id_cotacao);
	//console.log(panel.find('> div.row > div.col-md-4 > input').val());

	console.log(dados, ' dodado');
	console.log(dados_all,' do all');
	console.log(data_entrega);
	
	if(data_entrega != ''){
		
		$.ajax({  
    		url:'const_grava_cotacao.php',  
    		method:'POST', 
    		data: { 
    			dados:dados,
    			dados_all:dados_all,
    		},

    		dataType:'json',  

    		beforeSend: function(){
    			$('button.close').click();
    			$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
    			$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
    			$("a#salvar").click();
    		},
    		success: dados => 	
    		{  	
    			if(dados != 0){
    				$("div#salvar").html("<a href='pdf/ordem_compra.pdf' class='btn btn-success' target='_blank' style='text-align: center;'>Abrir Ordem de Compra</a>");
    				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");


    				 $(this).parents('div.tab-pane').detach();
    				 $('a[aria-controls="id'+id_fornecedor+'"]').parents('li').detach();

    				 $('tbody#myTable > tr.oc').find('> td[id-fornecedor="'+id_fornecedor+'"] > a').show();
    				 $('tbody#myTable > tr.oc').find('> td[id-fornecedor="melhor_compra"] > a').show();


    				 //Remonto a lista de Oc já emitidas
    				 $('div#lista_oc > div > table > tbody > tr:not(tr.hidden)').each(function(){
    				 	$(this).detach();
    				 });

    				 for(let data in dados){
    				 	let tr = $('div#lista_oc > div > table > tbody > tr.hidden').clone(true).removeClass('hidden');

    				 	tr.find('> td').eq(0).text(dados[data].id);
 						tr.find('> td').eq(1).text(dados[data].data);
 						tr.find('> td').eq(2).text((dados[data].total).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
 						tr.find('> td').eq(3).text($('tbody#table_fornecedor > tr[id_cliente="'+dados[data].id_fornecedor+'"] > td').eq(1).text());

 						if(dados[data].status == '0'){
 							tr.find('> td').eq(5).text('Cancelado').find('> a').hide();
 						}

    				 	$('div#lista_oc > div > table > tbody').append(tr);

    				 	//tr.find('> td').eq(0).text(dados[data].id);
    				 }

    			}else{
    				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao emitir Ordem de Compra 1</h4>");
    				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    			}
    		},
    		error: erro => {
    			$("button.close").click();
    			console.log(dados);
    		}  
    	}); 
	}else{
		alert('Preencha a Data de Entrega! ');
	}
});

//Imprime novamente uma Ordem de compra ja gerada
$(document).on('click', 'a.imprimir_oc', function(){
	let re_imprimir_id_oc =  $(this).parents('tr').find('> td').eq(0).text();

	$.ajax({  
		url:'const_grava_cotacao.php',  
		method:'POST', 
		data: { re_imprimir_id_oc:re_imprimir_id_oc },

		dataType:'json',  

		beforeSend: function(){
			$('button.close').click();
			$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
			$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
			$("a#salvar").click();
		},
		success: dados => 	
		{  	
			if(dados != 0){
				$("div#salvar").html("<a href='pdf/ordem_compra.pdf' class='btn btn-success' target='_blank' style='text-align: center;'>Abrir Ordem de Compra</a>");
				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");

			}else{
				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao emitir Ordem de Compra 2</h4>");
				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			}
		},
		error: erro => {
			$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao emitir Ordem de Compra 3</h4>");
			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		}  

	});
});

//Chama a modal de Motivo de cancelamento e salva o id da cotacaono botao cancelar
$(document).on('click', 'a.cancelar_oc', function(){
	let cancela_oc =  $(this).parents('tr').find('> td').eq(0).text();

	$('button#cancela_oc_def').attr('id-oc', cancela_oc);

	$('button.close').click();

	$('div#cancela_oc').modal('show');
});

//Realizo o cancelamento da OC e regarrego a lista de OC
$(document).on('click', 'button#cancela_oc_def', function(){

	let cancela_oc = $(this).attr('id-oc');
	let motivo = $('textarea#motivo_cancela_oc').val();
	let id_user = $('a#id_usuario').attr('id-user');

	console.log(motivo);

	if(motivo != ''){

		$('div#cancela_oc').modal('hide');

		$.ajax({  
    		url:'const_grava_cotacao.php',  
    		method:'POST', 
    		data: { cancela_oc:cancela_oc, motivo:motivo, id_user:id_user },
    		dataType:'json',  

    		success: dados => 	
    		{  	
    			if(dados != 0){
    				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Ordem de Compra Cancelada Com Sucesso! </h4>");
    				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    				$("a#salvar").click();

    				//Remonto a lista de Oc já emitidas
    				$('div#lista_oc > div > table > tbody > tr:not(tr.hidden)').each(function(){
    					$(this).detach();
    				});

    				for(let data in dados){
    					let tr = $('div#lista_oc > div > table > tbody > tr.hidden').clone(true).removeClass('hidden');

    					tr.find('> td').eq(0).text(dados[data].id);
    					tr.find('> td').eq(1).text(dados[data].data);
    					tr.find('> td').eq(2).text((dados[data].total).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

    					if(dados[data].status == '0'){
    						tr.find('> td').eq(4).text('Cancelado').find('> a').hide();
    					}

    					$('div#lista_oc > div > table > tbody').append(tr);

    					//tr.find('> td').eq(0).text(dados[data].id);
    				}

    			}else{
    				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Cancelar Ordem de Compra</h4>");
    				$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    				$("a#salvar").click();
    			}
    		},
    		error: erro => {
    			$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Cancelar Ordem de Compra</h4>");
    			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    			$("a#salvar").click();
    		} 
    	});

	}else{
		alert("Escreva o Motivo !");
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
	let motivo = $('textarea#motivo_cancela_solicitacao').val();
	let id_user = $('a#id_usuario').attr('id-user');


	if(motivo != ''){














		$.ajax({  
    		url:'const_grava_solicitacao.php',  
    		method:'POST', 
    		data: { cancela_solicitacao:cancela_solicitacao, motivo:motivo, id_user:id_user},
    		dataType:'json',
    		success: data => {  	

				console.log(' deu baaaao', data);

    			if(data != 0){

					console.log(data,'   ', cancela_solicitacao);

    				$('tbody#tbody_solicitacao_feita').find('> tr[id-solicitacao="'+cancela_solicitacao+'"]').detach();

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

		console.log("deu ajax");

    	$('div#cancela_solicitacao').modal('hide');

	}else{
		alert("Escreva o Motivo !");
	}
});

//Rotina para passar um solicitação para Cotação de material
$(document).on('click', 'a.fazer_cotacao', function(){

	let id_solicitacao = $(this).parents('tr').attr('id-solicitacao');

	// console.log(id_solicitacao);

	$(this).parents('tr').detach();

	$.ajax({  
		url:'const_grava_cotacao.php',  
		method:'POST', 
		data: {id_solicitacao:id_solicitacao},
		dataType:'json',  


		//envia mais retorna erro
		success: data => 	
		{  	
			if(data != 0){
				//console.log(data);

				//insiro o id da cotacao inserida e aplico o evento change()
				$('select#orcamento').append("<option value='"+data.id+"'></option>");
				$('select#orcamento').find('> option:last-child').attr('selected', 'true');
				$('select#orcamento').change();

				let tr = $('table#lista_cotacao').find('> tbody#lista_cotacao > tr.hidden').clone(true);

				tr.find('> td').eq(0).text(data.id);
				tr.find('> td').eq(1).text(data.data_cotacao);
				tr.find('> td').eq(2).html('<a class="btn btn-sm btn-info abrir_cotacao">ABRIR</a>');

				tr.attr('id-cotacao', data.id);

				tr.removeClass('hidden');
				$('table#lista_cotacao').find('> tbody#lista_cotacao').append(tr);

			}else{
				$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Fazer Cotacao</h4>");
    			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    			$("a#salvar").click();

			}
		},
		error: erro => {
			console.log('erro');
		} 
	});  
});

//Rotina para abrir cotacao
$(document).on('click', 'a.abrir_cotacao', function(){

	//vai pegar o id da cotacao
	let id = $(this).parents('tr').attr('id-cotacao');

	$('div#modal_cotacao').modal('hide');

	$('select#orcamento').find('> option').attr( 'value', id).attr('selected', 'true');
	$('select#orcamento').change();
});

//Rotina para adicionar os materias solicitados na cotacao criada
$(document).on('click', 'a#add_material', function(){

	let add_material_cotacao = $('select#orcamento').find('> option:selected').val();

	if(add_material_cotacao != -1){

		$.ajax({  
			url:'const_grava_cotacao.php',  
			method:'POST', 
			data: { add_material_cotacao:add_material_cotacao},
			dataType:'json',  

			success: data => 	
			{  	
		   		if(data != 0){

					console.log(data);

		   			let total = $('#table_principal > tbody#myTable').find('> tr.total').clone(true);
		   			let oc = $('#table_principal > tbody#myTable').find('> tr.oc').clone(true);
		   			let desconto = $('#table_principal > tbody#myTable').find('> tr.desconto').clone(true);
		   			let forma_pgt = $('#table_principal > tbody#myTable').find('> tr.forma_pgt').clone(true);

		   			$('#table_principal > tbody#myTable').find('> tr.total').detach();
		   			$('#table_principal > tbody#myTable').find('> tr.oc').detach();
		   			$('#table_principal > tbody#myTable').find('> tr.desconto').detach();
		   			$('#table_principal > tbody#myTable').find('> tr.forma_pgt').detach();


					// console.log('coe   ',data);


		   			for(let i = 0; i < data.length; i++){

		   				if(!$("tr[id-insumo='"+data[i].id+"']").length){


			   				let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();

							// console.log('aux >>>',aux);

			   				$('#table_principal > tbody#myTable').append(aux);

			   				$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
		   					.addClass('align-center').attr('id_especie', data[i].id_especie).attr('id-insumo', data[i].id);


			   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].descricao).attr('title', 'CÓDIGO: '+data[i].codigo);
			   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text(data[i].qnt_orcado == '' ? 0 : data[i].qnt_orcado).attr('title', 'UNIDADE MEDIDA: '+data[i].unidade);
			   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text((data[i].qnt_orcado * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'VALOR UNIDADE: '+parseFloat(data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

			   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(4).text(data[i].qnt_solicitada == '' ? 0 : data[i].qnt_solicitada);
		   				}
		   			}

		   			$('#table_principal > tbody#myTable').find('> tr:last-child > td.quantidade_cotada').focus();


		   			$('#table_principal > tbody#myTable').append(desconto);
		   			$('#table_principal > tbody#myTable').append(forma_pgt);
		   			$('#table_principal > tbody#myTable').append(total);
		   			$('#table_principal > tbody#myTable').append(oc);

		   			$('.close').click();
		   		}else{
		   			alert('Insumo Não encontrado!');
		   		}
			},
			error: erro => {
				console.log('erro');
			} 
		});  

	}else{
		alert('Selecione Uma Cotação!');
	}

	//console.log(cotacao);
});

//Rotina para fechar uma cotacao de acordo com o botão clicado
$(document).on('click', 'a#finaliza_cotacao', function(){
	let finaliza_cotacao = $('select#orcamento').find('> option:selected').val();

	$.ajax({  
		url:'const_grava_cotacao.php',  
		method:'POST', 
		data: {finaliza_cotacao:finaliza_cotacao},
		dataType:'json',  

		success: data => 	
		{  	
			window.location.replace("const_cotacao.php");
		},
		error: erro => {
			console.log('erro');
		} 
	});
});