$(function(){
    $("#CadCliente").jqxWindow({
        autoOpen: false,
        height: 300,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        position: {x:400, y:200},
        isModal: true,
        title: 'Cadastro de Classifica&ccedil;&otilde;es'
    });
    $( "#dialogInformacao" ).jqxWindow({
        autoOpen: false,
        height: 150,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        title: 'Mensagem',
        isModal: true
    });       
    $("#btnNovo").jqxButton({ width: '150', theme: 'energyblue' });
    $("#listaCliente").jqxTooltip({
        content: 'D&ecirc; um duplo clique para editar',
        position: 'mouse',
        name: 'movieTooltip',
        theme: 'energyblue' });
    $("#btnSalvar").jqxButton({ width: '100', theme: 'energyblue' });
    $("#btnNovo").click(function(){
        $("#method").val("InsertCliente");
        $("#codCliente").val(0);
        $("#nmeCliente").val('');
        $("#indAtivo").prop("checked", true);
        $("#CadCliente").jqxWindow("open");
    });
    $("#btnSalvar").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando cliente!");
        $( "#dialogInformacao" ).jqxWindow("open");
        if ($('#codCliente').val()==0){
            method = 'InsertCliente';
        }else{
            method = 'UpdateCliente';
        }
        if ($("#indAtivo").is(":checked")){
            var check = 'S';
        }else{
            var check = 'N';
        }
        if ($("#imagem").val()!=""){
            var formData = new FormData($('form')[0]);
            $.ajax({
                url: '../../Controller/Cliente/ClienteController.php?method=uploadArquivo',
                type: 'POST',
                // Form data
                data: formData,
                //Options to tell JQuery not to process data or worry about content-type
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    data = eval('('+data+')');
                    if(data.sucesso == true){
                        $("#dscCaminhoImagem").val(data.msg);
                        $.post('../../Controller/Cliente/ClienteController.php',
                            {method: method,
                            codCliente: $("#codCliente").val(),
                            nmeCliente: $("#nmeCliente").val(),
                            indAtivo: check,
                            dscCaminhoImagem: $("#dscCaminhoImagem").val()}, function(result){                            
                            result = eval('('+result+')');
                            if (result[0]==true){
                                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                                CarregaGridCliente();
                                setTimeout(function(){
                                    $( "#dialogInformacao" ).jqxWindow("close");
                                    $( "#CadCliente" ).jqxWindow("close");
                                },"2000");
                            }else{                                
                                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar Menu!'+result[1]);
                            }
                        });
                        $('#resposta').html('<img src="'+ data.msg +'" />');
                    }
                    else{
                        $('#resposta').html(data.msg);
                    }
                }
            });
        }else{
            arquivo='';
            $.post('../../Controller/Cliente/ClienteController.php',
                {method: method,
                codCliente: $("#codCliente").val(),
                nmeCliente: $("#nmeCliente").val(),
                indAtivo: check,
                dscCaminhoImagem: $("#dscCaminhoImagem").val()}, function(data){

                data = eval('('+data+')');
                if (data[0]==1){
                    $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                    CarregaGridCliente();
                    setTimeout(function(){
                        $( "#dialogInformacao" ).jqxWindow("close");
                        $( "#CadMenus" ).jqxWindow("close");
                    },"2000");
                }else{
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar Menu!'+data[1]);
                }
            });
        }
    });
});

function CarregaGridCliente(){
    $("#tdListaCliente").html('');
    $("#tdListaCliente").html('<div id="listaCliente"></div>');
    $('#listaCliente').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando clientes!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Cliente/ClienteController.php',
           {
               method: 'ListarCliente'
           },
           function(listaCliente){
                listaCliente = eval ('('+listaCliente+')');
                if (listaCliente[0]==true){
                    MontaTabelaCliente(listaCliente[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+listaCliente[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}

function MontaTabelaCliente(listaCliente){
    var theme = 'energyblue';
    var nomeGrid = 'listaCliente';
    var source =
    {
        localdata: listaCliente,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'COD_CLIENTE', type: 'string' },
            { name: 'NME_CLIENTE', type: 'string' },
            { name: 'ATIVO', type: 'boolean' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: 685,
        source: dataAdapter,
        theme: theme,
        selectionmode: 'singlerow',
        sortable: true,
        filterable: true,
        pageable: true,        
        columnsresize: true,
        columns: [
          { text: 'C&oacute;digo', columntype: 'textbox', datafield: 'COD_CLIENTE', width: 80},
          { text: 'Nome', datafield: 'NME_CLIENTE', columntype: 'textbox', width: 280},
          { text: 'Ativo', datafield: 'ATIVO', columntype: 'checkbox', width: 67 }
        ]
    });
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    // events
    $('#'+nomeGrid).on('rowdoubleclick', function (event)
    {
        var args = event.args;
        var rows = $('#'+nomeGrid).jqxGrid('getdisplayrows');
        var rowData = rows[args.visibleindex];
        var rowID = rowData.uid;
        $("#codCliente").val($('#listaCliente').jqxGrid('getrowdatabyid', rowID).COD_CLIENTE);
        $("#nmeCliente").val($('#listaCliente').jqxGrid('getrowdatabyid', rowID).NME_CLIENTE);
        $("#indAtivo").prop("checked", $('#listaCliente').jqxGrid('getrowdatabyid', rowID).ATIVO);
        $("#method").val("UpdateCliente");
        $("#CadCliente").jqxWindow("open");
    });
    $( "#dialogInformacao" ).jqxWindow("close");     
}
$(document).ready(function(){
    CarregaGridCliente();
});

