$(function(){     
    $("#btnNovaTransacao").click(function(){ 
        $("#method").val('InsertTransacaoImovel');
        $("#codPessoaTransacao").val(0);
        $("#nmePessoaTransacao").val('');
        $("#vlrTransacaoImovel").val('');
        $("#nroDiaVencimento").val('');
        $("#dtaInicio").val('');
        $("#dtaTermino").val('');
        $("#dtaCancelamento").val('');
        $("#codImovel").val(0); 
        $('#rbAluguel').jqxRadioButton('checked');
        $("#CadTransacaoImovel").jqxWindow("open");                
    });     
});
function CarregaGridImovelIndisponivel(){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");      
    $.post('../../Controller/TransacaoImovel/TransacaoImovelController.php',
           {
               method: 'ListarImovelInDisponivel'
           },
           function(ListaImovels){
                ListaImovels = eval ('('+ListaImovels+')');
                if (ListaImovels[0]==true){
                    MontaTabelaImovelIndisponivel(ListaImovels[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListaImovels[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }
           }
    );
}
function MontaTabelaImovelIndisponivel(ListaImovels){
    var theme = 'energyblue';
    var nomeGrid = 'listaImovelIndisponivel';
    var source =
    {
        localdata: ListaImovels,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'COD_IMOVEL', type: 'string' },
            { name: 'COD_PESSOA', type: 'string' },
            { name: 'NME_PESSOA', type: 'string' },
            { name: 'NRO_CPF', type: 'string' },
            { name: 'TXT_ENDERECO', type: 'string' },
            { name: 'COD_BAIRRO', type: 'string' },
            { name: 'NME_BAIRRO', type: 'string' },
            { name: 'COD_CIDADE', type: 'string' },
            { name: 'NME_CIDADE', type: 'string' },
            { name: 'SGL_UF', type: 'string' },
            { name: 'DSC_UF', type: 'string' },
            { name: 'NRO_CEP', type: 'string' },
            { name: 'TPO_TRANSACAO', type: 'string' },
            { name: 'VLR_TRANSACAO', type: 'string' },
            { name: 'NRO_DIA_PAGAMENTO', type: 'string' },
            { name: 'DTA_INICIO', type: 'string' },
            { name: 'DTA_FIM', type: 'string' },
            { name: 'DTA_CANCELAMENTO', type: 'string' }
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
          { text: 'C&oacute;digo', columntype: 'textbox', datafield: 'COD_IMOVEL', width: 80},
          { text: 'Nome', datafield: 'NME_PESSOA', columntype: 'textbox', width: 380}, 
          { text: 'CPF', datafield: 'NRO_CPF', columntype: 'textbox', width: 100} ,          
          { text: 'Bairro', datafield: 'NME_BAIRRO', columntype: 'textbox', width: 380}, 
          { text: 'End.', datafield: 'TXT_ENDERECO', columntype: 'textbox', width: 380}         
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
        $("#CadTransacaoImovel").jqxWindow("open"); 
        $("#codImovel").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).COD_IMOVEL);
        if ($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).TPO_TRANSACAO=='A'){
            $('#rbAluguel').jqxRadioButton('checked');
        }else{
            $('#rbVenda').jqxRadioButton('checked');
        }
        $("#codPessoaTransacao").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).COD_PESSOA);
        $("#nmePessoaTransacao").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).NME_PESSOA);
        $("#vlrTransacaoImovel").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).VLR_TRANSACAO);
        $("#nroDiaVencimento").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).NRO_DIA_PAGAMENTO);
        $("#dtaInicio").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).DTA_INICIO);
        $("#dtaTermino").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).DTA_FIM);
        $("#dtaCancelamento").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).DTA_CANCELAMENTO);
        $("#method").val('UpdateTransacaoImovel');
    });
    $("#dialogInformacao" ).jqxWindow("close");  
}
$(document).ready(function(){
   CarregaGridImovelIndisponivel(); 
});