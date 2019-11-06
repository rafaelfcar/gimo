$(function(){ 
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
});

function CarregaGridPagamento(){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");      
    $.post('../../Controller/Pagamento/PagamentoController.php',
           {
               method: 'ListarPagamentoAbertosPorCliente',
               dscPagamento: $("#txtPesquisa").val()
           },
           function(ListaPagamentos){
                ListaPagamentos = eval ('('+ListaPagamentos+')');
                if (ListaPagamentos[0]==true){
                    MontaTabelaPagamentos(ListaPagamentos[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListaPagamentos[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }
           }
    );
}
function MontaTabelaPagamentos(ListaPagamentos){
    var theme = 'energyblue';
    var nomeGrid = 'listaPagamentos';
    var source =
    {
        localdata: ListaPagamentos,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'DTA_VENCIMENTO', type: 'string' },
            { name: 'NRO_NOSSO_NUMERO', type: 'string' },
            { name: 'NRO_DOCUMENTO', type: 'string' },
            { name: 'VLR_MENSALIDADE', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: $(document).width()-50,
        
        source: dataAdapter,
        theme: theme,
        selectionmode: 'singlerow',
        sortable: true,
        filterable: true,
        pageable: true,
        columnsresize: true,
        columns: [
          { text: 'Data', columntype: 'textbox', datafield: 'DTA_VENCIMENTO', width: 80},
          { text: 'Nosso N&uacute;mero', datafield: 'NRO_NOSSO_NUMERO', columntype: 'textbox', width: 100},          
          { text: 'Documento', datafield: 'NRO_DOCUMENTO', columntype: 'textbox', width: 100},          
          { text: 'Valor', datafield: 'VLR_MENSALIDADE', columntype: 'textbox', width: 100}      
        ]
    });
    // apply localization.
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#'+nomeGrid).jqxGrid({ pagesizeoptions: ['40', '50', '60']});
    
    // events
    $("#"+nomeGrid).on('rowdoubleclick', function (event)
    {
        var args = event.args;
        // gets all rows loaded from the data source.
        var rows = $('#'+nomeGrid).jqxGrid('getdisplayrows');
        var rowData = rows[args.rowindex];
        var rowID = rowData.uid;
        window.open('../../Controller/Pagamento/PagamentoController.php?method=GerarBoletoGeral&nossoNumero='+$('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).NRO_NOSSO_NUMERO);
    });
    $("#dialogInformacao" ).jqxWindow("close");  
}
$(document).ready(function(){
    CarregaGridPagamento();
});

