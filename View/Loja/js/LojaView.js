$(function(){
    $("#CadLoja").jqxWindow({
        autoOpen: false,
        height: "700px",
        width: "1250px",
        maxHeight: 600,
        maxWidth: 1000,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Cadastro de Lojas'
    });
    $("#PagamentosLojaView").jqxWindow({
        autoOpen: false,
        height: "700px",
        width: "1250px",
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Cadastro de Lojas'
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
    //$("#btnNovo").jqxButton({ width: '150', theme: 'energyblue' });
    $("#listaLoja").jqxTooltip({
        content: 'D&ecirc; um duplo clique para editar',
        position: 'mouse',
        name: 'movieTooltip',
        theme: 'energyblue' });
    //$("#btnSalvar").jqxButton({ width: '100', theme: 'energyblue' });
    $("#btnNovo").click(function(){
        $("#method").val("InsertLoja");
        $("#codLoja").val(0);
        $("#nmeLoja").val('');
        $("#indAtivo").prop("checked", true);
        $("#CadLoja").jqxWindow("open");
    });
});

function CarregaGridLoja(){
    $("#tdListaLoja").html('');
    $("#tdListaLoja").html('<div id="listaLoja"></div>');
    $('#listaLoja').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando clientes!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Loja/LojaController.php',
           {
               method: 'ListarLoja'
           },
           function(listaLoja){
                listaLoja = eval ('('+listaLoja+')');
                if (listaLoja[0]==true){
                    MontaTabelaLoja(listaLoja[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+listaLoja[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}

function MontaTabelaLoja(listaLoja){
    var theme = 'energyblue';
    var nomeGrid = 'listaLoja';
    var source =
    {
        localdata: listaLoja,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'COD_LOJA', type: 'string' },
            { name: 'DSC_LOJA', type: 'string' },
            { name: 'CEP', type: 'string' },
            { name: 'ENDERECO', type: 'string' },
            { name: 'COMPLEMENTO', type: 'string' },
            { name: 'BAIRRO', type: 'string' },
            { name: 'CENTRAL', type: 'string' },
            { name: 'COD_CLIENTE', type: 'string' },
            { name: 'SGL_UF', type: 'string' },
            { name: 'NRO_DIA_PAGAMENTO', type: 'string' },
            { name: 'NRO_CNPJ', type: 'string' },
            { name: 'VLR_MENSALIDADE', type: 'string' },
            { name: 'ATIVA', type: 'boolean' }           
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
          { text: 'C&oacute;digo', columntype: 'textbox', datafield: 'COD_LOJA', width: 80},
          { text: 'Nome', datafield: 'DSC_LOJA', columntype: 'textbox', width: 280},
          { text: 'Ativa', datafield: 'ATIVA', columntype: 'checkbox', width: 67 }
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
        $("#codLoja").val($('#listaLoja').jqxGrid('getrowdatabyid', rowID).COD_LOJA);
        $("#nmeLoja").val($('#listaLoja').jqxGrid('getrowdatabyid', rowID).DSC_LOJA);
        $("#nroCep").val($('#listaLoja').jqxGrid('getrowdatabyid', rowID).CEP);
        $("#txtEndereco").val($('#listaLoja').jqxGrid('getrowdatabyid', rowID).ENDERECO);
        $("#txtComplemento").val($('#listaLoja').jqxGrid('getrowdatabyid', rowID).COMPLEMENTO);
        $("#txtBairro").val($('#listaLoja').jqxGrid('getrowdatabyid', rowID).BAIRRO);
        $("#indCentral").prop("checked", $('#listaLoja').jqxGrid('getrowdatabyid', rowID).CENTRAL);
        $("#sglUF").val($('#listaLoja').jqxGrid('getrowdatabyid', rowID).SGL_UF);
        $("#nroDiaPagamento").val($('#listaLoja').jqxGrid('getrowdatabyid', rowID).NRO_DIA_PAGAMENTO);
        $("#nroCnpj").val($('#listaLoja').jqxGrid('getrowdatabyid', rowID).NRO_CNPJ);
        $("#vlrMensalidade").val($('#listaLoja').jqxGrid('getrowdatabyid', rowID).VLR_MENSALIDADE);
        $("#indAtiva").prop("checked", $('#listaLoja').jqxGrid('getrowdatabyid', rowID).ATIVA);
        $("#codCliente").val($('#listaLoja').jqxGrid('getrowdatabyid', rowID).COD_CLIENTE);
        $("#method").val("UpdateLoja");
        $("#CadLoja").jqxWindow("open");
    });
    $( "#dialogInformacao" ).jqxWindow("close");     
}
$(document).ready(function(){
    CarregaGridLoja();
});

