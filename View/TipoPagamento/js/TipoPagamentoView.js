$(function(){
    $("#indAtivo").jqxCheckBox({ width: 120, height: 25, theme: theme });
    $("#CadTipoPagamento").jqxWindow({
        autoOpen: false,
        height: 300,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Cadastro de Status Im&oacute;vel'
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
    $("#btnNovo").click(function(){
        $("#method").val("InsertTipoPagamento");
        $("#codTipoPagamento").val(0);
        $("#dscTipoPagamento").val('');
        $("#CadTipoPagamento").jqxWindow("open");
    });
});

function CarregaGridTipoPagamento(){
    $("#tdListaTipoPagamento").html('');
    $("#tdListaTipoPagamento").html('<div id="listaTipoPagamento"></div>');
    $('#listaTipoPagamento').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Status Im&oacute;vel!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/TipoPagamento/TipoPagamentoController.php',
           {
               method: 'ListarTipoPagamento'
           },
           function(listaTipoPagamento){
                listaTipoPagamento = eval ('('+listaTipoPagamento+')');
                if (listaTipoPagamento[0]==true){
                    MontaTabelaTipoPagamento(listaTipoPagamento[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+listaTipoPagamento[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}

function MontaTabelaTipoPagamento(listaTipoPagamento){
    var theme = 'energyblue';
    var nomeGrid = 'listaTipoPagamento';
    var source =
    {
        localdata: listaTipoPagamento,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'COD_TIPO_PAGAMENTO', type: 'string' },
            { name: 'DSC_TIPO_PAGAMENTO', type: 'string' },
            { name: 'ATIVO', type: 'boolean' },
            { name: 'IND_ATIVO', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: 885,
        source: dataAdapter,
        theme: theme,
        selectionmode: 'singlerow',
        sortable: true,
        filterable: true,
        pageable: true,        
        columnsresize: true,
        columns: [
          { text: 'Codigo', columntype: 'textbox', datafield: 'COD_TIPO_PAGAMENTO', width: 80},
          { text: 'Descri&ccedil;&atilde;o', datafield: 'DSC_TIPO_PAGAMENTO', columntype: 'textbox', width: 280},
          { text: 'Ativo', datafield: 'ATIVO', columntype: 'checkbox', width: 80}
        ]
    });
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    // events
    $('#'+nomeGrid).on('rowdoubleclick', function (event)
    {
        $("#CadTipoPagamento").jqxWindow("open");
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, carregando!");
        $( "#dialogInformacao" ).jqxWindow("open");
        var args = event.args;
        var rows = $('#'+nomeGrid).jqxGrid('getdisplayrows');
        var rowData = rows[args.visibleindex];
        var rowID = rowData.uid;
        $("#codTipoPagamento").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).COD_TIPO_PAGAMENTO);
        $("#dscTipoPagamento").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).DSC_TIPO_PAGAMENTO);  
        if ($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).IND_ATIVO=='S'){            
            $("#indAtivo").jqxCheckBox('check');
        }else{            
            $("#indAtivo").jqxCheckBox('uncheck');
        }        
        $("#method").val("UpdateTipoPagamento");        
        $( "#dialogInformacao" ).jqxWindow("close");
    });       
    $( "#dialogInformacao" ).jqxWindow("close"); 
}
$(document).ready(function(){
    CarregaGridTipoPagamento();
});

