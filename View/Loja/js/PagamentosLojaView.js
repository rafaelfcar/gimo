$(function(){
    $("#EnvioEmailPagamentoView").jqxWindow({
        autoOpen: false,
        height: "300px",
        width: "450px",
        maxHeight: 600,
        maxWidth: 1000,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Envio de Email'
    });
});
function CarregaGridPagamentos(){
    $("#tdListaPagamentosLoja").html('');
    $("#tdListaPagamentosLoja").html('<div id="ListaPagamentosLoja"></div>');
    $('#ListaPagamentosLoja').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Pagamentos!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Loja/LojaController.php',
           {
               method: 'CarregaGridPagamentos',
               codLoja: $("#codLoja").val()
           },
           function(listaLoja){
                listaLoja = eval ('('+listaLoja+')');
                if (listaLoja[0]==true){
                    MontaTabelaListaPagamentos(listaLoja[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+listaLoja[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}

function MontaTabelaListaPagamentos(listaLoja){
    var theme = 'energyblue';
    var nomeGrid = 'ListaPagamentosLoja';
    var rowIDGrid = '';
    var contextMenu = $("#MenuPagamentos").jqxMenu({ width: 200, height: 58, autoOpenPopup: false, mode: 'popup', theme: theme });
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
            { name: 'DTA_BOLETO', type: 'date' },
            { name: 'DTA_PAGAMENTO', type: 'date' },
            { name: 'VLR_BOLETO', type: 'string' },
            { name: 'IND_VISUALIZA', type: 'string' },
            { name: 'NRO_NOSSO_NUMERO', type: 'string' },
            { name: 'TXT_EMAIL', type: 'string' } 
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
          { text: 'Data do Boleto', datafield: 'DTA_BOLETO', cellsformat: "dd/MM/yyyy", width: 150},
          { text: 'Data da Baixa', datafield: 'DTA_PAGAMENTO', cellsformat: 'dd/MM/yyyy', width: 150 },
          { text: 'Valor do Pagamento', datafield: 'VLR_BOLETO', columntype: 'textbox', width: 150 },
          { text: 'Nosso N&uacute;mero', datafield: 'NRO_NOSSO_NUMERO', columntype: 'textbox', width: 150 }
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
    });
    
    $("#"+nomeGrid).on('contextmenu', function () {
        return false;
    });
    
    $("#MenuPagamentos").on('itemclick', function (event) {        
        var args = event.args;                
        if ($.trim($(args).text()) == "Enviar por email") {            
            $("#txtEmailEmail").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowIDGrid).TXT_EMAIL);
            $("#dscLojaEmail").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowIDGrid).DSC_LOJA);
            $("#codLojaEmail").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowIDGrid).COD_LOJA);
            $("#dtaBoletoEmail").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowIDGrid).DTA_BOLETO);
            $("#nroBoletoEmail").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowIDGrid).NRO_NOSSO_NUMERO);
            $("#EnvioEmailPagamentoView").jqxWindow('open');            
        }else {             
            DetalhamentoPedido($('#listaPedidos').jqxGrid('getrowdatabyid', rowIDGrid).COD_PEDIDO);
        }
    });
    $("#"+nomeGrid).on('rowclick', function (event) {
        if (event.args.rightclick) {
            var args = event.args;
            var rows = $('#'+nomeGrid).jqxGrid('getdisplayrows');
            var rowData = rows[args.visibleindex];
            var rowID = rowData.uid;
            rowIDGrid = rowID;
            $("#"+nomeGrid).jqxGrid('selectrow', rowID);                       
            var scrollTop = $(window).scrollTop();
            var scrollLeft = $(window).scrollLeft();
            contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
            return false;
        }
    });    
    $( "#dialogInformacao" ).jqxWindow("close");     
}