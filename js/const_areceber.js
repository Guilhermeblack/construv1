//Rotina para listar os empreendimentos ao selecionar categoria

$('#tipo_cobranca').change(function(){
    // pegar o valor e mostrar os empreendimentos no select
    let tipoc = $('select#orcamento option:selected').val();
    console.log(tipoc);

}


//rotina para listar os clientes no select
$('#select2-cliente_idcliente-v6-container').change(function(){
    // pegar o valor e mostrar os clientes a serem vinculados

}