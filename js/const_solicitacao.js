//Acrinson

//Mudar Tema da tabela
$('#tema').change(function() {
    if($(this).prop('checked')){
        $('.thead-dark').each(function(){
            $(this).removeClass('thead-dark');
        });
    }else{
        $('thead').each(function(){
            $(this).addClass('thead-dark');
        });
    }
});

var _validFileExtensions = [".jpg"];    
function validate(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    alert("Desculpe, " + sFileName + " é inválido, extensão não permitida: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }
  
    return true;
}

function removeAcento (text)
{       
    text = text.toLowerCase();                                                         
    text = text.replace(new RegExp('[ÁÀÂÃ]','gi'), 'a');
    text = text.replace(new RegExp('[ÉÈÊ]','gi'), 'e');
    text = text.replace(new RegExp('[ÍÌÎ]','gi'), 'i');
    text = text.replace(new RegExp('[ÓÒÔÕ]','gi'), 'o');
    text = text.replace(new RegExp('[ÚÙÛ]','gi'), 'u');
    text = text.replace(new RegExp('[Ç]','gi'), 'c');
    return text;                 
}

function sleep(milliseconds) {
              var start = new Date().getTime();
              for (var i = 0; i < 1e7; i++) {
                if ((new Date().getTime() - start) > milliseconds){
                  break;
                }
              }
}

function table(source) {
    var glyph_opts = {
         preset: "bootstrap3",
         map: {
         }
       };
    

    $("#tree").fancytree({

        types: {
            "file": {
                "icon": "glyphicon"
            },
            "folder": {
                "icon": "glyphicon"
            }
        },

        icon: function(event, data) {
            // data.typeInfo contains tree.types[node.type] (or {} if not found)
            // Here we will return the specific icon for that type, or `undefined` if
            // not type info is defined (in this case a default icon is displayed).
            return data.typeInfo.icon;
        },

        glyph: glyph_opts,
        checkbox: true,
        titlesTabbable: true, // Add all node titles to TAB chain

        extensions: ["edit", "table", "gridnav", "filter"],
        quicksearch: true,

        filter: {
            counter: false, // No counter badges
            mode: "hide",  // "dimm": Grayout unmatched nodes, "hide": remove unmatched nodes
            autoExpand: true,
            nodata: true, 
        },

        source: {url : source},

        table: {
            checkboxColumnIdx: 0, // render the checkboxes into the this column index (default: nodeColumnIdx)
            indentation: 16, // indent every node level by 16px
            nodeColumnIdx: 2 // render node expander, icon, and title to this column (default: #0)
        },
        gridnav: {
            autofocusInput: false, // Focus first embedded input if node gets activated
            handleCursorKeys: true // Allow UP/DOWN in inputs to move to prev/next node
        },
        edit: {

            triggerStart: [''],
            beforeEdit: function(){
                return false;
            },

            beforeClose: function(event, data){
              return true;

            },

            close: function(event, data) {
                if (data.save && data.isNew) {
                    
                }else{

                }

                let tree = $("#tree").fancytree("getTree");
                let fn = tree.getActiveNode();

                fn.render(true);
            },
        },

        createNode: function(event, data) {
            var node = data.node,
                $tdList = $(node.tr).find(">td");

            // Span the remaining columns if it's a folder.
            // We can do this in createNode instead of renderColumns, because
            // the `isFolder` status is unlikely to change later
            if (node.hasChildren()) {
                $tdList.eq(2).prop("colspan", 2).nextAll("#no_input").remove();

                $tdList.eq(3).prop("colspan", 3).empty().append('<span class="glyphicon glyphicon-plus" style="font-size: 15px; color:#ff5b57!important; cursor: pointer;" title="Adicionar Insumo Não Orçado" id="add_insumo"></span>');

                //Altero o icone do no se o elemento nao estiver cadastrado na tabela insumo/Plano de contas
                //console.log(node.data);

                if(node.data.tabela == 3 || node.data.tabela == null){
                    $tdList.eq(2).find("> span.fancytree-node > span.fancytree-custom-icon").addClass("erro").addClass("glyphicon-folder-open");
                }else{
                    $tdList.eq(2).find("> span.fancytree-node > span.fancytree-custom-icon").addClass("glyphicon-folder-open");
                }
            }else{
                //Altero o icone do no se o elemento nao estiver cadastrado na tabela insumo/Plano de contas
                if(node.data.tabela == 3 || node.data.tabela == null){
                    $tdList.eq(2).find("> span.fancytree-node > span.fancytree-custom-icon").addClass("glyphicon-exclamation-sign erro");
                }else{
                    $tdList.eq(2).find("> span.fancytree-node > span.fancytree-custom-icon").addClass("glyphicon-ok");
                }

                //Adiciono classe caso ele nao seja orçado
                if(node.data.status == 0){
                    node.addClass('nao-orcado');
                }

            }
        },

        renderColumns: function(event, data) {
            var node = data.node, $tdList = $(node.tr).find(">td");

            //console.log(node);
            
            if(!node.hasChildren()){

                var aux = parseFloat(node.data.valor_unitario);

                isNaN(aux) ? aux = 0 : '';

                $tdList.eq(1).text(node.getIndexHier());
                $tdList.eq(3).find("input").val(node.data.quantidade);
                $tdList.eq(4).find("input").val(node.data.unidade);
                $tdList.eq(5).find("input").val((parseFloat(node.data.qnt_solicitada) - parseFloat(node.data.qnt_devolvida)).toFixed(2));
                $tdList.eq(6).find("input").val((parseFloat(node.data.qnt_recebida) - parseFloat(node.data.qnt_devolvida)).toFixed(2));

                if(parseFloat((node.data.qnt_solicitada - node.data.qnt_devolvida)) > parseFloat(node.data.quantidade)){
                    $tdList.eq(5).find("input").addClass('estorou');
                }
            }else{

                node.toggleClass("pai" ,true);
                $tdList.eq(1).text(node.getIndexHier());
            }
        }
    }).on("nodeCommand", function(event, data) {

        if($('select#orcamento option:selected').attr('editable') == '0'){
            // Custom event handler that is triggered by keydown-handler and
            // context menu:
            var data_finalizado = $('select#orcamento option:selected').attr('data-finalizado'); 
            var refNode, moveMode,
                tree = $("#tree").fancytree("getTree"),
                node = tree.getActiveNode();

            switch (data.cmd) {

                case "data_orc":
                    $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Data de Fechamento da Tabela: "+data_finalizado+"</h4>");
                    $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                    $('button#dialog').click();
                    break;
                default:
                    alert("aLONSO command: " + data.cmd);
                    return;
            }
        }else{
            var refNode, moveMode,
                tree = $("#tree").fancytree("getTree"),
                node = tree.getActiveNode();

            switch (data.cmd) {
                case "rename":
                    //refNode = node.getParent();
                    //refNode.render(true);
                    node.editStart();
                    node.render();

                    break;
                case "remove":
                    refNode = node.getParent();
                    node.remove();
                    //renderizando a arvore depois da exclusão, para solucionar os id dos nós
                    refNode.render(true);
                    if (refNode) {
                        refNode.setActive();
                    }
                    break;
                case "addChild":
                    let pai = node.getParent();

                    node.editCreateNode("child", "");

                    let filho = node.getLastChild();
                    $tdList = $(filho.tr).find(">td");

                    filho.type = "file";
                    filho.data.id_insumo_plano = null;
                    filho.data.id_orcamento = $("select#orcamento").find('option:selected').val();
                    filho.data.tabela = null;

                    filho.render();
                    break;
                case "addSibling":
                    //atualizando a criação de filhos subsequentes
                    let aux = node.getParent();
                    if (aux != null) {
                        aux.getLastChild().editCreateNode("after", "");

                        let filho = aux.getLastChild();
                        $tdList = $(filho.tr).find(">td");

                        filho.type = "folder";
                        filho.data.id_insumo_plano = null;
                        filho.data.id_orcamento = $("select#orcamento").find('option:selected').val();
                        filho.data.tabela = null;

                        filho.render();
                    }
                    else {
                        node.editCreateNode("after", "");

                        let filho = node.getNextSibling();
                        $tdList = $(filho.tr).find(">td");

                        filho.type = "folder";
                        filho.data.id_insumo_plano= null;
                        filho.data.tabela = null;
                        filho.data.id_orcamento = $("select#orcamento").find('option:selected').val();

                        filho.render();
                    }
                    break;
                case "cut":
                    CLIPBOARD = {
                        mode: data.cmd,
                        data: node
                    };
                    break;
                case "copy":
                    CLIPBOARD = {
                        mode: data.cmd,
                        data: node.toDict(function(n) {
                            delete n.key;
                        })
                    };
                    break;
                case "clear":
                    CLIPBOARD = null;
                    break;
                case "paste":
                    if (CLIPBOARD.mode === "cut") {
                        // refNode = node.getPrevSibling();
                        CLIPBOARD.data.moveTo(node, "child");
                        CLIPBOARD.data.setActive();
                    }
                    else if (CLIPBOARD.mode === "copy") {
                        node.addChildren(CLIPBOARD.data).setActive();
                    }
                    break;
                case "novo_insumo":
                    $("input#cad_insumo_desc").val(node.title);
                    $("button#cad_insumo").click();
                    break;

                case "novo_plano": 
                    $("input#cad_plano_desc").val(node.title);
                    $("button#cad_plano").click();
                    break;

                default:
                    alert("Unhandled command: " + data.cmd);
                    return;
            }

            // renderizo o pai novamento para tirar os campos de preenchimento

            // }).on("click dblclick", function(e){
            //   console.log( e, $.ui.fancytree.eventToString(e) );
        }
    }).on("keydown", function(e) {

        if($('select#orcamento option:selected').attr('editable') == '0'){
            var cmd = null;

            // console.log(e.type, $.ui.fancytree.eventToString(e));
            switch ($.ui.fancytree.eventToString(e)) {
                /*
                case "ctrl+up":
                    cmd = "moveUp";
                    break;
                */
            }
            if (cmd) {
                $(this).trigger("nodeCommand", {
                    cmd: cmd
                });
            }
        }else{
            var cmd = null;

            // console.log(e.type, $.ui.fancytree.eventToString(e));
            switch ($.ui.fancytree.eventToString(e)) {
                case "alt+shift+n":
                case "meta+shift+n": // mac: cmd+shift+n
                    cmd = "addChild";
                    break;
                case "ctrl+c":
                case "meta+c": // mac
                    cmd = "copy";
                    break;
                case "ctrl+v":
                case "meta+v": // mac
                    cmd = "paste";
                    break;
                case "shift+x":
                case "meta+x": // mac
                    cmd = "cut";
                    break;
                case "shift+n":
                case "meta+n": // mac
                    cmd = "addSibling";
                    break;
                case "del":
                case "meta+backspace": // mac
                    cmd = "remove";
                    break;
            }
            if (cmd) {
                $(this).trigger("nodeCommand", {
                    cmd: cmd
                });
                //e.preventDefault();
                //e.stopPropagation();
                //return false;
            }
        }
    }).on("click keydown", function(event){

        if($('select#orcamento option:selected').attr('editable') == '0'){
            //Linhas para debug, onde mostra toda a estruura de um nó da tabela
            let aux = event;
            let fn = $.ui.fancytree.getNode(event);             
            //console.log(fn);          

            setTimeout(function(aux){

                if($.ui.fancytree.getEventTargetType(event) == "checkbox" || event.keyCode == 32){
                    if (fn.isSelected() && fn.hasChildren()) {
                        fn.visit(function(aux) {
                            aux.setSelected(true);
                        });
                    // caso todos os elementos filhos estiverem selecionados eu deseleciono todos
                    }else if (!fn.isSelected()  && fn.hasChildren()) {
                        fn.visit(function(aux) {
                            aux.setSelected(false);
                        });
                    }
                }
            }, 20);
        }else{
            //Linhas para debug, onde mostra toda a estruura de um nó da tabela
            let aux = event;
            let fn = $.ui.fancytree.getNode(event);             
            //console.log(fn);          

            setTimeout(function(aux){

                if($.ui.fancytree.getEventTargetType(event) == "checkbox" || event.keyCode == 32){
                    if (fn.isSelected() && fn.hasChildren()) {
                        fn.visit(function(aux) {
                            aux.setSelected(true);
                        });
                    // caso todos os elementos filhos estiverem selecionados eu deseleciono todos
                    }else if (!fn.isSelected()  && fn.hasChildren()) {
                        fn.visit(function(aux) {
                            aux.setSelected(false);
                        });
                    }
                }else if($.ui.fancytree.getEventTargetType(event) == "icon" && fn.data.tabela == 3){
                    if(!fn.hasChildren()){
                        let tree = $("#tree").fancytree("getTree");
                        let fn = tree.getActiveNode();
                        $("input#cad_insumo_desc").val(fn.title);

                        $("button#cad_insumo").click();
                    }else if(fn.hasChildren()){
                        let tree = $("#tree").fancytree("getTree");
                        let fn = tree.getActiveNode();
                        $("input#cad_plano_desc").val(fn.title);

                        $("button#cad_plano").click();
                    }
                }
            }, 20);
        }
    });

    $("#search").on("keyup", function(e){
        var n = 0,
        tree = $.ui.fancytree.getTree(),
        match = $(this).val();

        n = tree.filterNodes(match);

        n > 1 ? n : n = 0;

        $("button#btnResetSearch").attr("disabled", false);
        $("span#matches").text("(" + n + " Encontrados)");
    }).focus();

    $("button#btnResetSearch").click(function(e){
        var tree = $.ui.fancytree.getTree();

        $("#search").val("");
        $("span#matches").text("");
        tree.clearFilter();
    });
}

function define_contextMenu(option = 0){
    if(option == 1){

        var CLIPBOARD = null;

        $("#tree").contextmenu({
            delegate: "td",
            menu: [{
                    title: "Editar <kbd>[F2]</kbd>",
                    cmd: "rename",
                    uiIcon: "ui-icon-pencil"
                },
                {
                    title: "Deletar <kbd>[Del]</kbd>",
                    cmd: "remove",
                    uiIcon: "ui-icon-trash"
                },
                {
                    title: "Novo Plano de Conta <kbd>[Shift+N]</kbd>",
                    cmd: "addSibling",
                    uiIcon: "ui-icon-plus"
                },
                {
                    title: "Novo Insumo <kbd>[Alt+Shift+N]</kbd>",
                    cmd: "addChild",
                    uiIcon: "ui-icon-arrowreturn-1-e"
                },
                {
                    title: "Copiar <kbd>Ctrl-C</kbd>",
                    cmd: "copy",
                    uiIcon: "ui-icon-copy"
                },
                {
                    title: "Colar Insumo / Plano <kbd>Ctrl+V</kbd>",
                    cmd: "paste",
                    uiIcon: "ui-icon-clipboard",
                    disabled: true
                },
                {
                    title: "Cadastrar Insumo ",
                    cmd: "novo_insumo",
                    uiIcon: "ui-icon-insumo",
                },
                {
                    title: "Cadastrar Plano de Contas ",
                    cmd: "novo_plano",
                    uiIcon: "ui-icon-plano",
                } 
            ],
            beforeOpen: function(event, ui) {
                var node = $.ui.fancytree.getNode(ui.target);
                $("#tree").contextmenu("enableEntry", "paste", !!CLIPBOARD);

                $("#tree").contextmenu("showEntry", "novo_insumo", false);
                $("#tree").contextmenu("showEntry", "novo_plano", false);

                $("#tree").contextmenu("showEntry", "addSibling", true);
                $("#tree").contextmenu("showEntry", "addChild", true);
                $("#tree").contextmenu("showEntry", "copy", true);
                $("#tree").contextmenu("showEntry", "paste", true);

                if(!node.hasChildren() &&  node.data.tabela == 3){
                    $("#tree").contextmenu("showEntry", "novo_insumo", true);

                    $("#tree").contextmenu("showEntry", "addSibling", false);
                    $("#tree").contextmenu("showEntry", "addChild", false);
                    $("#tree").contextmenu("showEntry", "copy", false);
                    $("#tree").contextmenu("showEntry", "paste", false);

                }else if(node.hasChildren() && node.data.tabela == 3){
                    $("#tree").contextmenu("showEntry", "novo_plano", true);

                    $("#tree").contextmenu("showEntry", "addSibling", false);
                    $("#tree").contextmenu("showEntry", "addChild", false);
                    $("#tree").contextmenu("showEntry", "copy", false);
                    $("#tree").contextmenu("showEntry", "paste", false);

                }else if(!node.hasChildren()){
                    $("#tree").contextmenu("showEntry", "addSibling", false);
                }

                node.setActive();
            },
            select: function(event, ui) {
                var that = this;
                // delay the event, so the menu can close and the click event does
                // not interfere with the edit control
                setTimeout(function() {
                    $(that).trigger("nodeCommand", {
                        cmd: ui.cmd
                    });
                }, 100);
            }
        });
    }else{
        var CLIPBOARD = null;

        $("#tree").contextmenu({
            delegate: "td",
            menu: [{
                    title: "Ver Data Orçamento",
                    cmd: "data_orc",
                    uiIcon: "ui-icon-pencil",
                }
            ],
            beforeOpen: function(event, ui) {
                var node = $.ui.fancytree.getNode(ui.target);
                node.setActive();
            },
            select: function(event, ui) {
                var that = this;

                setTimeout(function() {
                    $(that).trigger("nodeCommand", {
                        cmd: ui.cmd
                    });
                }, 100);
            }
        });
    }
}

function mascara_money() {
    $("input[id='money']").each(function() {
        $(this).maskMoney({
            prefix: 'R$ ',
            thousands: '.',
            decimal: ',',
            affixesStay: true
        });
    });
}

function atualiza_no(){
    let tree = $("#tree").fancytree("getTree");
    let fn = tree.getActiveNode();

    if(fn != null){
        // renderizo o pais
        // renderizo o style do pai
        if(!fn.isEditing() && fn.getParent().getLastChild() == fn && fn.getLevel() > 1){
            if(fn.getParent().extraClasses.indexOf("pai") == -1){
                fn.getParent().render(true, false);
            }
        }

        var $tdList = $(fn.tr).find(">td");
            
        if(!(fn.hasChildren())){

            fn.toggleClass("pai", false);
            let total_f = 0;

            // Validacao e armazenamento dos campos quantidade e valor Unitario
            if($tdList.eq(3).find("input").val() != null && $tdList.eq(5).val() != null ){

                isNaN(parseFloat($tdList.eq(3).find("input").val().replace(',', '.'))) ? fn.data.quantidade = 0 : fn.data.quantidade = parseFloat($tdList.eq(3).find("input").val().replace(',', '.'));
                isNaN(parseFloat($tdList.eq(5).find("input").val().replace(/[R$. ]/g, '').replace(/,/g, '.'))) ? fn.data.valor_unitario = 0 : fn.data.valor_unitario = parseFloat($tdList.eq(5).find("input").val().replace(/[R$. ]/g, '').replace(/,/g, '.'));

                total_f = fn.data.quantidade  * fn.data.valor_unitario;
            }

            if(total_f > 0){
                $tdList.eq(6).find("input").val(total_f.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
            }else{
                $tdList.eq(6).find("input").val(total_f.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
            }

            // Atualizando o total dos pais do nó
            let pais = fn.getParentList();
            for(let i = 0; i < pais.length; i++){
                let $tdpai = $(pais[i].tr).find(">td");

                $tdpai.eq(3).find("input").val(calc_total(pais[i]).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
            }
        }else{
            fn.toggleClass("pai", true);
            $tdList.eq(3).find("input").val(calc_total(fn).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        }

        // fazendo o calculo do total selecionado
        let selecionados = tree.getSelectedNodes(), total_final = 0;

        for (let i = 0; i < selecionados.length; i++) {
            if(!selecionados[i].hasChildren()){
                total_final += selecionados[i].data.quantidade * selecionados[i].data.valor_unitario;
            }
        }

        $("#total").val(total_final.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
    }
}

function calc_total(no){

    let total = 0;

    if(!no.hasChildren()){
        total += parseFloat(no.data.quantidade) * parseFloat(no.data.valor_unitario);
    }else{
        no.visit(function(fn){
            if(!fn.hasChildren()){
                total += parseFloat(fn.data.quantidade) * parseFloat(fn.data.valor_unitario);
            }
        });
    }

    if(isNaN(total)){
        return 0;
    }else{
        return total;
    }
}

function isEmpty(obj){
    return JSON.stringify(obj) === '{}';
}

//Rotina para preencher o select do orçamento de acordo com o empreendimento selecionado
$('select#empre').change(function(){

    let empreendimento = $(this).find('> option:selected').val();

    //Limpo as opções do select de orçamento
    $("select#orcamento").find('> option:not(option[value="-1"])').each(function(){
        $(this).detach();
    });

    if(empreendimento != -1){
        $.ajax({
           url:   'const_grava_tabela.php',
           type:  'POST',
           //cache: false,
           //data:  { ok : 'deu certo!'},
            data: {lista_orcamento:empreendimento}, //essa e o padrao x-www-form-urlencode
            dataType:'json',  

           success: function(data) { 
                
                if(data != 0){
                    for(let i in data){
                        $("select#orcamento").append('<option value="'+data[i].id+'" editable="'+data[i].status_editar+'"  data-finalizado="'+data[i].data_finalizado+'">'+data[i].titulo+'</option>');
                    }
                }
           },
           error: function() {
                console.log(0);
           }
        });
    }
});

//Função para abrir várias modals uma depois da outra "Efeito Windows"
$(document).on('show.bs.modal', '.modal', function (event) {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});




//Atualiza toda a tabela de insumos de acordo com as opções selecionadas
$("a#atualizar").click(function(){

    var $TABLE = $('#table_insumos > table');
    var $FORM_PRINCI = $('#form_principal');

    var $clone = $TABLE.find('> tbody > tr.hide').clone(true);
    $TABLE.find('> tbody').empty();
    $TABLE.find('> tbody').append($clone);
    
    var aux = {};

    // pega a categoria e especie selecionada
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
            $('div#modal7').modal('show');
        },
        success: dados => 
        {   
            //console.log(dados);
            $('div#modal7').modal('hide');

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
            }
        },
        error: erro => {
            $('div#modal7').modal('hide');
            console.log("Erro")
        },  
    });
}); 

//Atualiza toda a tabela de insumos de acordo com as o campo a ser buscado
$("a#pesquisar").click(function(){

    var $TABLE = $('#table_insumos > table');
    var $FORM_PRINCI = $('#form_principal');

    var $clone = $TABLE.find('> tbody > tr.hide').clone(true);
    $TABLE.find('> tbody').empty();
    $TABLE.find('> tbody').append($clone);
    
    var aux = {};

    aux['pesquisa'] = $('input#input_add_insumo').val();

    $.ajax({  
        url:'const_grava_insumo.php',  
        method:'POST', 
        data: aux,
        dataType:'json', 
        beforeSend: function(){
            $("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
            $("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
            $('div#modal7').modal('show');
        },
        success: dados => 
        {   
            //console.log(dados);
            $('div#modal7').modal('hide');
            $('input#input_add_insumo').val('');
            $('input#input_add_insumo').keyup();

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
            }
        },
        error: erro => {
            $('div#modal7').modal('hide');
            console.log("Erro")
        },  
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























// Input para busca da modal de insumos
$("input#input_add_insumo").on("keyup", function() {

    var value = $(this).val().toLowerCase();

    $("div#table_insumos> table > tbody#myTable > tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
})

// Input para busca da modal de fornecedores
$("#input_solicitacao").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tbody_solicitacao > tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

// Input para busca da modal de fornecedores
$("#input-solicitao-feita").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tbody_solicitacao_feita > tr ").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

//Realiza uma ação de acordo com o orçamento selecionado
$("select#orcamento").change(function() {

    // Caso o orçamento seja valido
    if($('select#orcamento option:selected').val() != -1){

        let orcamento = removeAcento($('select#orcamento option:selected').text()).toUpperCase();
        let editable = $('select#orcamento option:selected').attr('editable'); // Status de edição da tabela 0 = fachado, 1 = aberto
        let tree = $("#tree").fancytree("getTree");
        let id_orcamento = $('select#orcamento option:selected').val();

        if(editable == "0"){
            //Desmonto a tabela atual
            //Ajax para remontar o Json da tabela e recarregar todos as solicitações já efetuadas
            $.ajax({
               url:   'const_grava_solicitacao.php',
               type:  'POST',
               //cache: false,
               //data:  { ok : 'deu certo!'},
                data: {id_orcamento:id_orcamento}, //essa e o padrao x-www-form-urlencode
                dataType:'json',  
               error: function() {
                    $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Carregar a Tabela!!</h4>");
                    $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
               },
               success: function(data) { 
                    //console.log(data);

                    setTimeout(function(){
                        $('tbody#tbody_solicitacao_feita > tr:not(.hidden)').each(function(){
                            $(this).detach();
                        });

                        for(let i = 0; i < data.length; i++){

                            let tr = $('tbody#tbody_solicitacao_feita > tr.hidden').clone(true).removeClass('hidden');

                            tr.attr('id-solicitacao',data[i].id);

                            tr.find('> td').eq(0).text(data[i].id);
                            tr.find('> td').eq(1).text(data[i].nome_usuario);
                            tr.find('> td').eq(2).text(data[i].data);

                            // -1  pendende de aprovacao
                            //  0  cancelado
                            //  1  OC emitida
                            //  2  Solicitação recebida Completa
                            //  3  Solicitação recebida parcial

                            if(data[i].id_oc == -1){
                                tr.find('> td').eq(3).text('Pendente de OC').css('color', '#000000!important');
                                tr.find('> td').eq(4).append('<a class="btn btn-danger btn-sm" id="cancelar_solicitacao">Cancelar</a>');

                            }else if(data[i].id_oc == 0){
                                tr.find('> td').eq(3).text('Cancelado').css('color', '#ff3547!important');
                                tr.find('> td').eq(4).html('');

                            }else if(data[i].id_oc == 1){
                                tr.find('> td').eq(3).text('Oc emitida').css('color', '#3a92ab!important');
                                tr.find('> td').eq(4).append('<a class="btn btn-success btn-sm" id="oc_solicitacao">Ver Oc</a>');

                            }else if(data[i].id_oc == 2){
                                tr.find('> td').eq(3).text('Recebido').css('color', '#00acac!important');
                                tr.find('> td').eq(4).append('<a class="btn btn-success btn-sm" id="oc_solicitacao">Ver Oc</a>');

                            }else if(data[i].id_oc == 3){
                                tr.find('> td').eq(3).text('Recebido Parcialmente').css('color', 'rgb(244, 128, 36)');
                                tr.find('> td').eq(4).append('<a class="btn btn-success btn-sm" id="oc_solicitacao">Ver Oc</a>');

                            }

                            $('tbody#tbody_solicitacao_feita').append(tr);

                        }

                        $('button.close').click();
                    }, 1500);
                    
               },
               beforeSend: function() {
                    $("div#dialog-body").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
                    $("div#dialog-footer").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
                    $("button#dialog").click();
               }
            });


            setTimeout(function(){
                tree.reload({
                    url: "orcamentos/"+orcamento+".json"

                }).done(function() {
                    define_contextMenu();

                    tree.expandAll();

                    //Caso o status do orçamento seja 0, Visito todos os inputs da tabela e acrescento o atributo disabled
                    $('table#tree > tbody').find('> tr:not(tr.nao-orcado)').each(function(i){
                        $(this).find('td#no_input').each(function(j){
                            $(this).find('input').attr('disabled', '');
                        });
                    });

                    $('table#tree > tbody').find('> tr.nao-orcado').each(function(i){
                        $(this).find('td#no_input').each(function(j){
                            $(this).find('input[name="unidade"]').removeAttr('disabled');
                        });
                    });

                    tree.expandAll(false);
                });
            }, 1500);

        }else{


            setTimeout(function(){

                $.ajax({
                    url:   'const_grava_solicitacao.php',
                    type:  'POST',
                    //cache: false,
                    //data:  { ok : 'deu certo!'},
                     data: {id_orcamento:id_orcamento}, //essa e o padrao x-www-form-urlencode
                     dataType:'json',  
                    error: function() {
                        // console.log('wtf', data);

                         $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Carregar a Tabela!!</h4>");
                         $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                    },
                    success: function(data) { 
                        // console.log('wtf2', data);
     
                         setTimeout(function(){
                             $('tbody#tbody_solicitacao_feita > tr:not(.hidden)').each(function(){
                                 $(this).detach();
                             });
     
                             for(let i = 0; i < data.length; i++){
     
                                 let tr = $('tbody#tbody_solicitacao_feita > tr.hidden').clone(true).removeClass('hidden');
     
                                 tr.attr('id-solicitacao',data[i].id);
     
                                 tr.find('> td').eq(0).text(data[i].id);
                                 tr.find('> td').eq(1).text(data[i].nome_usuario);
                                 tr.find('> td').eq(2).text(data[i].data);
     
                                 // -1  pendende de aprovacao
                                 //  0  cancelado
                                 //  1  OC emitida
                                 //  2  Solicitação recebida Completa
                                 //  3  Solicitação recebida parcial
     
                                 if(data[i].id_oc == -1){
                                     tr.find('> td').eq(3).text('Pendente de OC').css('color', '#000000!important');
                                     tr.find('> td').eq(4).append('<a class="btn btn-danger btn-sm" id="cancelar_solicitacao">Cancelar</a>');
     
                                 }else if(data[i].id_oc == 0){
                                     tr.find('> td').eq(3).text('Cancelado').css('color', '#ff3547!important');
                                     tr.find('> td').eq(4).html('');
     
                                 }else if(data[i].id_oc == 1){
                                     tr.find('> td').eq(3).text('Oc emitida').css('color', '#3a92ab!important');
                                     tr.find('> td').eq(4).append('<a class="btn btn-success btn-sm" id="oc_solicitacao">Ver Oc</a>');
     
                                 }else if(data[i].id_oc == 2){
                                     tr.find('> td').eq(3).text('Recebido').css('color', '#00acac!important');
                                     tr.find('> td').eq(4).append('<a class="btn btn-success btn-sm" id="oc_solicitacao">Ver Oc</a>');
     
                                 }else if(data[i].id_oc == 3){
                                     tr.find('> td').eq(3).text('Recebido Parcialmente').css('color', 'rgb(244, 128, 36)');
                                     tr.find('> td').eq(4).append('<a class="btn btn-success btn-sm" id="oc_solicitacao">Ver Oc</a>');
     
                                 }
     
                                 $('tbody#tbody_solicitacao_feita').append(tr);
     
                             }
                             $('button.close').click();
                         }, 1500);
                         
                    },
                    beforeSend: function() {
                         $("div#dialog-body").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
                         $("div#dialog-footer").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
                         $("button#dialog").click();
                    },

                    

                 });


                tree.reload({
                    url: "orcamentos/"+orcamento+".json"

                }).done(function() {
                    define_contextMenu();

                    tree.expandAll();

                    //Caso o status do orçamento seja 0, Visito todos os inputs da tabela e acrescento o atributo disabled
                    $('table#tree > tbody').find('> tr').each(function(i){
                        $(this).find('td#no_input').each(function(j){
                            $(this).find('input').attr('disabled', '');
                        });
                    });

                    tree.expandAll(false);
                });
            }, 1500);

            
        }
    }else{

        //Apago todas as linhas da lista de Solicitação ja feitas
        $('tbody#tbody_solicitacao_feita > tr:not(.hidden)').each(function(){
            $(this).detach();
        });


        var tree = $("#tree").fancytree("getTree");

        tree.reload({
            url: "orcamentos/default.json"
        }).done(function() {
            define_contextMenu();
        });
    }
});

//Rotina de criação da tabela de insumos selecionados para formacao de solicitacao
$('a#solicita_insumo').click(function(){

    let tree = $("#tree").fancytree("getTree"); 
    let fn = tree.getActiveNode();
    let nodes = $('#tree').fancytree('getTree').getSelectedNodes();

    if(fn != null && nodes.length > 0){

        $('tbody#tbody_solicitacao > tr:not(.hidden)').detach();

        for(let i in nodes){
            if(!nodes[i].hasChildren()){
                let id_no = nodes[i].data.id,
                    qnt_solicitada = (nodes[i].data.qnt_solicitada - nodes[i].data.qnt_devolvida),
                    quantidade_orcado = nodes[i].data.quantidade,
                    unidade = nodes[i].data.unidade,
                    tabela = nodes[i].data.tabela,
                    id_insumo = nodes[i].data.id_insumo_plano;


                let tr = $('tbody#tbody_solicitacao > tr.hidden').clone(true);

                tr.removeClass('hidden');
                tr.attr('id-insumo', id_insumo);
                tr.attr('id-no', id_no);
                tr.attr('id-orc', nodes[i].data.id_orcamento);
                tr.attr('quantidade_orcado', quantidade_orcado);
                tr.attr('qnt_solicitada', qnt_solicitada);

                tr.find('> td').eq(0).text(nodes[i].title);
                tr.find('> td').eq(3).text(quantidade_orcado);
                tr.find('> td').eq(4).text((quantidade_orcado - qnt_solicitada).toFixed(2));

                $('tbody#tbody_solicitacao').append(tr);

                //console.log(nodes[i]);

                $('tbody#tbody_solicitacao > tr:last-child > td').eq(5).blur();

            }
        }

        $('tbody#tbody_solicitacao > tr:last-child > td').eq(2).blur();
        $('div#modal-solicitao').modal('show');

    }else{
        $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Selecione um item!</h4>");
        $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");

        $('div#modal7').modal('show');
    }
});

//Rotina para preencher a quantidade disponivel de acordo com o deposito selecionados
$(document).on('change', 'select.depositos_qnt_disponivel', function(){
    let id_deposito = $(this).find('> option:selected').val();

    if(parseFloat(id_deposito) > 0){

        let id_insumo = $(this).parents('tr').attr('id-insumo');

        $.ajax({  
            url:'const_grava_solicitacao.php',  
            method:'POST', 
            data: {id_deposito:id_deposito, id_insumo:id_insumo},
            dataType:'json',  
            success: dados =>   
            {  
                $(this).parents('tr').find('> td').eq(2).text(dados);

                if(dados == 0){
                    $(this).parents('tr').find('> td').eq(2).addClass('zerado');
                }else{
                    $(this).parents('tr').find('> td').eq(2).removeClass('zerado');
                }
            },
            error: erro => {console.log(1)}
        }); 
    }else if(parseFloat(id_deposito) == 0){
        $(this).parents('tr').find('> td').eq(2).text('#');
        $(this).parents('tr').find('> td').eq(2).removeClass('zerado');
        $(this).parents('tr').find('> td').eq(2).removeClass('maior_estoque');
    }else{
        $(this).parents('tr').find('> td').eq(2).text('#');
        $(this).parents('tr').find('> td').eq(2).removeClass('zerado');
        $(this).parents('tr').find('> td').eq(2).removeClass('maior_estoque');
    }
});

//Rotina de criação da tabela de despacho a partir dos insumos selecionados 
$('a#despacha_material').click(function(){

    let nodes = $('#tree').fancytree('getTree').getSelectedNodes();

    if(nodes.length > 0){

        $('tbody#tbody_despacho > tr:not(.hidden)').detach();

        for(let i in nodes){

            if(!nodes[i].hasChildren()){
                let id_insumo = nodes[i].data.id_insumo_plano;

                let tr = $('tbody#tbody_despacho > tr.hidden').clone(true);

                tr.removeClass('hidden');
                tr.attr('id-insumo', id_insumo);
                tr.attr('id-no', nodes[i].data.id);

                tr.find('> td').eq(0).text(nodes[i].title);
                tr.find('> td').eq(1).text('0');

                $('tbody#tbody_despacho').append(tr);

                //console.log(nodes[i]);

            }
        }

        $('tbody#tbody_despacho > tr:last-child > td').eq(2).blur();
        $('div#modal-despacho').modal('show');

    }else{
        $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Selecione um item!</h4>");
        $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");

        $('div#modal7').modal('show');
    }
});

//Rotina para gravar a solicitação no banco
$('a#gera_solicitacao').click(function(){

    let valida = 1;

    $('tbody#tbody_solicitacao > tr:not(.hidden)').each(function(){
        if($(this).find('> td').eq(2).hasClass('zerado') || $(this).find('> td').eq(5).hasClass('zerado') || $(this).find('> td').eq(1).find(' > select > option:selected').val() == -1 ){
            valida = 0;
            return;
        }
    });

    if(valida != 0){

        //Habilito a modal de carregamento
        $("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
        $("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
        $("div#modal7").modal('show');


        let fornecedores = Array();

        //Pego todos os fornecedores selecionados e taco num array menos o compras
        $('tbody#tbody_solicitacao > tr:not(.hidden)').each(function(){
            let id_fornecedor = parseFloat($(this).find('> td').eq(1).find('> select > option:selected').val());
            
            if(id_fornecedor != 0 && jQuery.inArray(id_fornecedor, fornecedores) == -1){
                fornecedores.push(parseFloat($(this).find('> td').eq(1).find('> select > option:selected').val()));
            }           
        });

        var id_orcamento_solicitacao = $('tbody#tbody_solicitacao > tr:not(.hidden)').attr('id-orc');
        var id_user = $('a#id_usuario').attr('id-user');

        var linha_compras = Array();
        var aprovacao;
        var linhas = Array();
        var linha = [];

        //console.log(fornecedores);

        for (let index = 0; index < fornecedores.length; index++) {
            
            var fornecedor = fornecedores[index];
            aprovacao = 1;

            $('tbody#tbody_solicitacao > tr:not(.hidden) > td.origem').each(function(){
                if(parseFloat($(this).find('> select > option:selected').val()) == fornecedor){

                    linha = [];

                    var id_insumo = $(this).parents('tr').attr('id-insumo');
                    var id_insumo_orcamento = $(this).parents('tr').attr('id-no');
                    var qnt = $(this).parents('tr').find('> td').eq(5).text();


                    //Função para atualizar a quantidade ja pedida
                    $("#tree").fancytree("getTree").findAll(function(node) {
                        if(node.data.id == id_insumo_orcamento){
                            node.data.qnt_solicitada = (parseFloat(node.data.qnt_solicitada) + parseFloat(qnt));

                            node.render(true);
                        };
                    });

                    //Aprovação do insumo não orçado
                    // if($(this).parents('tr').attr('quantidade_orcado') == '0'){
                    //     aprovacao = -1;
                    // }

                    //Vejo se a quantidade solicitada é maior que a disponivel em estoque
                    if($(this).parents('tr').find('> td').eq(2).hasClass('maior_estoque')){
                        var qnt_amais = (parseFloat($(this).parents('tr').find('> td').eq(5).text()) - parseFloat($(this).parents('tr').find('> td').eq(2).text()));

                        linha.push(id_insumo);
                        linha.push(id_insumo_orcamento);
                        linha.push(qnt_amais);

                        linha_compras.push(linha);

                        //Coloco o restante na solicitação referente ao fornecedor
                        linha.push(id_insumo);
                        linha.push(id_insumo_orcamento);
                        linha.push(parseFloat($(this).parents('tr').find('> td').eq(2).text()));

                        linhas.push(linha);
                    }else{
                        linha.push(id_insumo);
                        linha.push(id_insumo_orcamento);
                        linha.push(parseFloat($(this).parents('tr').find('> td').eq(5).text()));

                        linhas.push(linha);
                    }



                }
            });

            //console.log(id_orcamento_solicitacao, id_user, fornecedor,aprovacao);

            //Ajax para gravar as solicitações dos estoques
            $.ajax({  
                url:'const_grava_solicitacao.php',  
                method:'POST', 
                data: {id_orcamento_solicitacao:id_orcamento_solicitacao, id_user:id_user, linhas:linhas, fornecedor:fornecedor, aprovacao:aprovacao},
                dataType:'json',  
                success: dados =>   
                {   
                    if(dados != 0){
                        console.log('sucesso deposito');
                    }else{
                        console.log('erro sucesso');
                    }
                },
                error: erro => {
                    console.log('erro');
                }  
    
            });

        }

        aprovacao = 1;
        //Percorro todas as linhas direcionadas para o compras
        $('tbody#tbody_solicitacao > tr:not(.hidden) > td.origem').each(function(){
            if($(this).find('> select > option:selected').val() == '0'){

                linha = [];

                var id_insumo = $(this).parents('tr').attr('id-insumo');
                var id_insumo_orcamento = $(this).parents('tr').attr('id-no');
                var qnt = $(this).parents('tr').find('> td').eq(5).text();

                //Função para atualizar a quantidade ja pedida
                $("#tree").fancytree("getTree").findAll(function(node) {
                    if(node.data.id == id_insumo_orcamento){
                        node.data.qnt_solicitada = (parseFloat(node.data.qnt_solicitada) + parseFloat(qnt));

                        node.render(true);
                    };
                });

                //Aprovação do insumo não orçado
                // if($(this).parents('tr').attr('quantidade_orcado') == '0'){
                //     aprovacao = -1;
                // }

                linha.push(id_insumo);
                linha.push(id_insumo_orcamento);
                linha.push(parseFloat($(this).parents('tr').find('> td').eq(5).text()));

                linha_compras.push(linha);

            }
        });

        linhas = linha_compras;
        fornecedor = 0;
        if(linhas.length > 0){
            //Ajax para gravar as solicitações do Compras
            $.ajax({  
                url:'const_grava_solicitacao.php',  
                method:'POST', 
                data: {id_orcamento_solicitacao:id_orcamento_solicitacao, id_user:id_user, linhas:linhas, fornecedor:fornecedor, aprovacao:aprovacao},
                dataType:'json',  
                success: dados =>   
                {   
                    if(dados != 0){
                        console.log('sucesso compras');
                    }else{
                        console.log('erro sucesso');
                    }
                },
                error: erro => {
                    console.log('erro');
                }  
    
            });
        }

        //Transferencia de variavel
        let id_orcamento = id_orcamento_solicitacao;
        //Ajax para recarregar as solicitações já feitas
        $.ajax({
           url:   'const_grava_solicitacao.php',
           type:  'POST',
           //cache: false,
           //data:  { ok : 'deu certo!'},
            data: {id_orcamento:id_orcamento}, //essa e o padrao x-www-form-urlencode
            dataType:'json',  
           error: function() {
                console.log('erro att solicitações');
           },
           success: function(data) { 
                //console.log(data);

                $('tbody#tbody_solicitacao_feita > tr:not(.hidden)').each(function(){
                    $(this).detach();
                });

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
           },
        });


        //Fecho a modal de carregamento 
        $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Sucesso ao solicitar Insumo!</h4>");
        $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");

        $('div#modal-solicitao').modal('hide');

        //Recarrego a tabela para atualizar as solicitações já feitas
        //$('select#orcamento').val(id_orcamento_solicitacao).change();
        
    }else{
        alert("Por favor Preencha toda a tabela !");
    }
});

//ROTINA PARA VALIDAR A TABELA DE DEVOLUÇÃO DE MATERIAL
$('a#despacha_material_def').click(function(){
    let valida = 1;

    $('tbody#tbody_despacho > tr:not(.hidden) > td:last-child').each(function(){
        if($(this).text() == '' || parseFloat($(this).text()) == 0 ){
            valida = 0;
        }
    });

    if($('select#select_deposito > option:selected').val() == -1){
        valida = 0 ;
    }

    if(valida != 0 ){
        //Capturo todas as variaveis necessarias
        let id_orcamento_despacho = $('select#orcamento > option:selected').val();
        let id_user = $('a#id_usuario').attr('id-user');
        let estoque = $('select#select_deposito > option:selected').val();

        let linhas = [];
        let linha = [];

        $('tbody#tbody_despacho > tr:not(.hidden)').each(function(){
            linha = [];

            linha.push($(this).attr('id-insumo'));
            linha.push(parseFloat($(this).find('> td:last-child').text()));

            linhas.push(linha);


            //Atualizo a quantidade na tabela de acorde com a quantidade despachada
            $("#tree").fancytree("getTree").findAll(function(node) {
                if(node.data.id == $(this).attr('id-no')){
                    node.data.qnt_solicitada = (parseFloat(node.data.qnt_solicitada) - parseFloat($(this).find('> td:last-child').text()));

                    node.render(true);
                };
            });
        });

        $.ajax({  
            url:'const_grava_solicitacao.php',  
            method:'POST', 
            data: { id_orcamento_despacho:id_orcamento_despacho, id_user:id_user, estoque:estoque, linhas:linhas },

            dataType:'json',  

            beforeSend: function(){
                $('button.close').click();
                $("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
                $("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
                $("div#modal7").modal('show');
            },
            success: dados =>   
            {   
                if(dados != 0){
                    $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Sucesso ao Despachar material!</h4>");
                    $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");

                    //Recarrego a tabela para atualizar as solicitações já feitas
                    $('select#orcamento').val(id_orcamento_despacho).change();

                }else{
                    $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Despachar material!</h4>");
                    $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                }
            },
            error: erro => {
                $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro do Erro</h4>");
                $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
            }  

        });

    }else{
        alert('Preencha todos os campos de quantidade');
    }
});

//Rotina para validar as quantidade ao fazer o requerimento dos insumos
$(document).on('blur keypress keyup', "td.qnt_solicitada", function(){
    $('tbody#tbody_solicitacao > tr:not(.hidden) > td.qnt_solicitada').each(function(){
        //Vejo se o valor solicitado é maior que a quantidade restante se nao for eu adicono a class estorou
        parseFloat($(this).text()) > (parseFloat($(this).parents('tr').attr('quantidade_orcado')) - parseFloat($(this).parents('tr').attr('qnt_solicitada'))) ? $(this).addClass('estorou') : $(this).removeClass('estorou');

        //Vejo se o valor solicitado é maior que a quantidade disponivel no estoque se for eu adiciono a classe maior_estoque
        parseFloat($(this).text()) >  parseFloat($(this).parents('tr').find('> td').eq(2).text())? $(this).parents('tr').find('> td').eq(2).addClass('maior_estoque') :$(this).parents('tr').find('> td').eq(2).removeClass('maior_estoque');

        parseFloat($(this).text()) == 0 ? $(this).addClass('zerado') : $(this).removeClass('zerado');
    })
});

//Rotina para abrir multi modal para listar os itens ja solicitados
$(document).on('click', 'a#ver_solicitacao', function(){

    let id_solicitacao = $(this).parents('tr').find('> td').eq(0).text();

    console.log(id_solicitacao);
    
    $.ajax({  
        url:'const_grava_solicitacao.php',  
        method:'POST', 
        data: { id_solicitacao:id_solicitacao },

        dataType:'json',  

        beforeSend: function(){
            $("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
            $("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
            $("div#modal7").modal('show');
        },
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
            $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro do Erro</h4>");
            $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
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
















//Função para pegar dados referentes a categoria do insumo a ser inserido
$(document).on('click', 'span#add_insumo', function(){

    // pega um id > de onde 
    let id_no = $(this).parents('tr').find('> td[id="id"]').text();

    let no  = $("#tree").fancytree("getTree").findAll(function(node) {
        if(node.data.id_tarefa == id_no){
            return node;
        };
    });

    $('input#id_pai').val(no[0].data.id_tarefa);

    //console.log($('input#id_pai').val());

    $('div#modal-insumos').modal('show');
});



//Função para adicionar definitivamente um insumo não orçado
$(document).on('click', 'a.add_insumo_unico', function(){

    let id_insumo = $(this).parents('tr').attr('id-insumo-solo');
    let id_orcamento = $('select#orcamento').find('> option:selected').val();
    let nome_insumo = $(this).parents('tr').find('td').eq(1).text();

    let id_pai = $('input#id_pai').val();

    if(id_orcamento != -1){

        //Pego o pai do no a ser criado e logo em seguida pego o id de sequencia do no criado
        let no  = $("#tree").fancytree("getTree").findAll(function(node) {
            if(node.data.id_tarefa == id_pai){
                return node;
            };
        });

        node = no[0];

        // console.log(node);

        node.editCreateNode('child', nome_insumo);

        let filho = node.getLastChild();

        //node.addNode(filho);
        filho.addClass('nao-orcado');

        filho.title = nome_insumo;
        filho.type = "file";
        filho.data.id_insumo_plano = id_insumo;
        filho.data.id_orcamento = $("select#orcamento").find('option:selected').val();
        filho.data.tabela = 2;
        filho.data.qnt_solicitada = 0;
        filho.data.quantidade = 0;
        filho.data.unidade = '';

        filho.render(true);

        let id_no_criado = filho.getIndexHier();
        id_orc_ins = id_orcamento;

        //console.log(id_no_criado, id_orcamento,  id_insumo);
        //Faço o ajax para gravar na tabela de cotação com status 0 de não orçado
        $.ajax({  
            url:'const_grava_solicitacao.php',  
            method:'POST', 
            data: {id_no_criado:id_no_criado, id_orc_ins:id_orc_ins, id_insumo:id_insumo},
            success: data =>    
            {   
                console.log(1);
                document.location.reload(true);
            },
            error: erro => {
                console.log(0);
                window.location.reload(true);
            } 
        });


        $('div#modal-insumos').modal('hide');

    }else{
        alert('Selecione o Orçamento!');
    }
});



















//Rotina para listar as OC referentes a solicitacao clicada
$(document).on('click', 'a#oc_solicitacao', function(){

    let lista_oc_emitidas = $(this).parents('tr').attr('id-solicitacao');

    //Limpo a tabela de OC
    $('tbody#table_oc > tr:not(tr.hidden)').each(function(){
        $(this).detach();
    });

    $.ajax({  
        url:'const_grava_solicitacao.php',  
        method:'POST', 
        data: {lista_oc_emitidas:lista_oc_emitidas},
        dataType: 'json',
        success: data =>    
        {   
            if(data != 0){

                for(let i in data){

                    let tr = $('tbody#table_oc > tr.hidden').clone(true).removeClass('hidden');

                    tr.find('> td').eq(0).text(data[i].id);
                    tr.find('> td').eq(1).text(data[i].nome_fornecedor);
                    tr.find('> td').eq(2).text(data[i].data_entrega);

                    if(data[i].foto_recibo != null && data[i].foto_recibo.length){
                        tr.find('> td').eq(4).find('> a.receber_oc').addClass('hidden');
                        tr.find('> td').eq(4).find('> a.ver_recibo').removeClass('hidden');

                        tr.find('> td').eq(4).attr('id-recebimento', data[i].foto_recibo);
                    }

                    tr.attr('id-oc',data[i].id );

                    $('tbody#table_oc').append(tr);
                }
                
                $('div#modal-lista-oc').modal('show');
                //console.log(data);

            }else{
                alert('erro');
            }
        },
        error: erro => {
            console.log(0);
        } 
    });
});

//Rotina para re-imprimir uma OC
$(document).on('click', 'a.ver_oc', function(){
    let re_imprimir_id_oc =  $(this).parents('tr').attr('id-oc');

    $.ajax({  
        url:'const_grava_cotacao.php',  
        method:'POST', 
        data: { re_imprimir_id_oc:re_imprimir_id_oc },

        dataType:'json',  

        beforeSend: function(){
            //$('button.close').click();
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
                $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao mostrar Ordem de Compra</h4>");
                $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
            }
        },
        error: erro => {
            $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao mostrar Ordem de Compra</h4>");
            $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
        }  

    });
});

//Rotina para montar a modal de recebimento de material a partir da OC
$(document).on('click', 'a.receber_oc', function(){

    let recebe_oc = $(this).parents('tr').attr('id-oc');

    //Limpo a tabela competa
    $('tbody#tbody_recebe_material > tr:not(tr.hidden)').each(function(){
        $(this).detach();
    });

    //Limpo os outros campos
    $('input#input_num_recebimento').val('');
    $('input#up_imagem_recibo').val('');

    $.ajax({  
        url:'const_grava_solicitacao.php',  
        method:'POST', 
        data: {recebe_oc:recebe_oc},
        dataType: 'json',
        success: data =>    
        {   

            if(data != 0){

                for(let i in data){

                    let tr = $('tbody#tbody_recebe_material > tr.hidden').clone(true).removeClass('hidden');

                    tr.attr('id-insumo', data[i].id_insumo);

                    tr.find('> td').eq(1).text(data[i].nome_insumo);
                    tr.find('> td').eq(2).text(data[i].qnt);

                    $('tbody#tbody_recebe_material').append(tr);
                }

                $('a#id-oc').attr('id-oc', recebe_oc);

                $('div#receber_oc').modal('show');
            }else{
                alert('Erro ao listar Itens OC!');
            }
            //console.log(data);
        },
        error: erro => {
            console.log(0);
        } 
    });
});

$('input#up_imagem_recibo').change( function() {
    var filename = $(this).val();
    if ( ! /\.jpg$/.test(filename)) {
        $(this).val('');
        alert('Por favor selecione um aquivo .JPG');
    }
});

//Rotina para Validar os campos listar os itens recebidos e efetuar de fato o recebimento do material
$(document).on('click', 'a#confirma_recebe_def', function(){
    
    let form = new FormData($('.up_img')[0]);
    let id_user = $('a#id_usuario').attr('id-user');
    let id_oc = $('a#id-oc').attr('id-oc');
    let num_recibo = $('input#input_num_recebimento').val();
    let tipo_recibo = $('select#select_documento > option:selected').text();
    let img = $('input#up_imagem_recibo').val();

    //var file = $('input#up_imagem_recibo')[0].files[0];;

    // console.log(id_user);
    // console.log(id_oc);
    // console.log(num_recibo);
    // console.log(tipo_recibo);
    // console.log(img);
    
    
    if(!(num_recibo == '' || tipo_recibo == 'Selecione')){

        let dados = Array();
        let dado;
        
        //Pegos os itens selecionados recebidos juntamente com a quantidade
        $('tbody#tbody_recebe_material > tr:not(tr.hidden)').each(function(){
            let check = $(this).find('> td:first-child > input');

            if(check.attr('checked') == 'checked'){

                dado = Array();

                dado.push(check.parents('tr').attr('id-insumo'));
                dado.push(check.parents('tr').find('> td.qnt').text());

                dados.push(dado);
            }
        });

        //variavel para servir de chave para o upload da imagens e das informações 
        let valida_recebimento = 1;

        $.ajax({  
            url:'const_grava_solicitacao.php',  
            method:'POST', 
            data: {valida_recebimento:valida_recebimento, id_user:id_user, id_oc:id_oc, num_recibo:num_recibo, tipo_recibo:tipo_recibo, dados:dados},
            dataType: 'json',
            beforeSend: function(){
                //$('button.close').click();
                $("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
                $("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
                $("div#modal7").modal('show');
            },
            success: data =>    
            {   
                //Rotina para enviar o formulario com a foto e o id do recebimento via ajax
                $('input#id_recebimento').val(data);
                //console.log($('input#id_recebimento').val());

                $.ajax({
                    url: "const_grava_solicitacao.php",
                    type: "POST",
                    data: form,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    processData:false,
                    success: function (data) {

                        //$("div#modal7").modal('hide');    
                        $('div#receber_oc').modal('hide');
                        $('div#modal-lista-oc').modal('hide');
                        $('div#modal-solicitao-feita').modal('hide');

                        if(data != 0){


                            $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Sucesso ao Receber a Ordem de Compra</h4>");
                            $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal'  onclick='$('select#orcamento').change();'>Fechar</button>");
                            
                                //$("div#modal7").modal('show');

                            //$("select#orcamento").change();

                        }else{

                            $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Receber a Ordem de Compra</h4>");
                            $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                            //$("div#modal7").modal('show');
                        }
                    },

                    error: function(erro){
                        console.log('erouuu');
                    }
                });

                //console.log(data);
            },
            error: erro => {
                console.log('erro recebimento!');
            } 
        });

        

    }else{
        alert('Preencha corretamente todos os campos!');
    }
});

//Rotina para buscar o path da foto do recibo de acordo com o 
$(document).on('click', 'a.ver_recibo', function(){
    let id_recebimento = $(this).parents('td').attr('id-recebimento');

    $.ajax({  
        url:'const_grava_solicitacao.php',  
        method:'POST', 
        data: {id_recebimento:id_recebimento},
        dataType: 'json',
        success: data =>    
        {   
            if(data != 0){
                if(Array.isArray(data)){

                    $("div#salvar").html("<h4 class='modal-title' align='center' id='comprovante'>Comprovante <b>"+data[0]+": \n"+data[1]+"</b></h4>");
                    $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                    $("div#modal7").modal('show');

                }else{

                    $("div#salvar").html("<img src='"+data+"'  style='text-align: center; width:100%; height:100%; '>");
                    $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                    $("div#modal7").modal('show');
                }
                
            }else{
                $("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao exibir comprovante</h4>");
                $("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
                $("div#modal7").modal('show');
            }
        },
        error: erro => {
            console.log(0);
        } 
    });
});

//cria e manipula o auto-complete
$( function() {
    $.widget( "custom.combobox", {
        _create: function() {
            this.wrapper = $( "<span>" )
            .addClass( "custom-combobox" )
            .insertAfter( this.element );

            this.element.hide();
            this._createAutocomplete();
            this._createShowAllButton();
        },

        _createAutocomplete: function() {
            var selected = this.element.children( ":selected" ),
            value = selected.val() ? selected.text() : "";

            this.input = $( "<input>" )
            .appendTo( this.wrapper )
            .val( value )
            .attr("title", "Digite para pesquisar")
            .attr("required", "")
            .attr("id", "cad_especie")
            .addClass( "form-control" )
            .autocomplete({
                delay: 0,
                minLength: 0,
                source: $.proxy( this, "_source" )
            })
            .tooltip({
                classes: {
                    "ui-tooltip": "ui-state-highlight"
                }
            });

            this._on( this.input, {
                autocompleteselect: function( event, ui ) {
                    ui.item.option.selected = true;
                    this._trigger( "select", event, {
                        item: ui.item.option
                    });
                },

                autocompletechange: "_removeIfInvalid"
            });
        },

        _createShowAllButton: function() {
            var input = this.input,
            wasOpen = false

            $( "<a>" )
            .attr( "id", "botao_pesquisa" )
            .appendTo( this.wrapper )
            .button({
                icons: {
                    primary: "ui-icon-triangle-1-s"
                },
                text: "false"
            })
            .addClass( "btn btn-defaut" )
            .removeClass("ui-button ui-corner-all ui-widget")
            .on( "click", function() {
                input.trigger( "focus" );

                // Close if already visible
                if ( wasOpen ) {
                    return;
                }

                // Pass empty string as value to search for, displaying all results
                input.autocomplete( "search", "" );
            });
        },

        _source: function( request, response ) {
            var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
            response( this.element.children( "option" ).map(function() {
                var text = $( this ).text();
                if ( this.value && ( !request.term || matcher.test(text) ) )
                    return {
                        label: text,
                        value: text,
                        option: this
                    };
                }) );
        },

        _removeIfInvalid: function( event, ui ) {

            // Selected an item, nothing to do
            if ( ui.item ) {
                return;
            }

            // Search for a match (case-insensitive)
            var value = this.input.val(),
            valueLowerCase = value.toLowerCase(),
            valid = false;
            this.element.children( "option" ).each(function() {
                if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                    this.selected = valid = true;
                    return false;
                }
            });

            // Found a match, nothing to do
            if ( valid ) {
                return;
            }

            // Remove invalid value
            this.input
            .val( "" )
            .attr( "title", value + " Item não encontrado !" )
            .tooltip( "open" );
            this.element.val( "" );
            this._delay(function() {
                this.input.tooltip( "close" ).attr( "title", "" );
            }, 2500 );
            this.input.autocomplete( "instance" ).term = "";
        },

        _destroy: function() {
            this.wrapper.remove();
            this.element.show();
        }
    });


    $( "#combobox" ).combobox();
    $( "#toggle" ).on( "click", function() {
        $( "#combobox" ).toggle();
    });
});

$('input[name="unidade"]').blur(function(){

    let id_no = $(this).parents('tr').find('> td[id="id"]').text();
    let id_orcamento = $('select#orcamento > option:selected').val();
    let valor_att = $(this).val();

    $.ajax({  
        url:'const_grava_solicitacao.php',  
        method:'POST', 
        data: {att_insumo_no:id_no, id_orc_att_no: id_orcamento, valor_att:valor_att},
        success: data =>    
        {   
            console.log(1);
        },
        error: erro => {
            console.log(0);
        } 
    });
   
});