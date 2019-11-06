$(function(){
    $("#CadBanco").jqxWindow({
        autoOpen: false,
        height: 300,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        position: {x:400, y:200},
        isModal: true,
        title: 'Cadastro de Bancos'
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
        $("#method").val("InsertBanco");
        $("#codBanco").val('');
        $("#nmeBanco").val('');  
        $("#dscArquivoBoleto").val('');       
        $("#CadBanco").jqxWindow("open");
    });
});

function CarregaGridBanco(){
    $("#tdListaBanco").html('');
    $("#tdListaBanco").html('<div id="listaBanco"></div>');
    $('#listaBanco').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Banco!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Banco/BancoController.php',
           {
               method: 'ListarBanco'
           },
           function(listaBanco){
                listaBanco = eval ('('+listaBanco+')');
                if (listaBanco[0]==true){
                    MontaTabelaBanco(listaBanco[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+listaBanco[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}

function MontaTabelaBanco(listaBanco){
    var theme = 'energyblue';
    var nomeGrid = 'listaBanco';
    var source =
    {
        localdata: listaBanco,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'COD_BANCO', type: 'string' },
            { name: 'NME_BANCO', type: 'string' },
            { name: 'NME_ARQUIVO_BOLETO', type: 'string' }
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
          { text: 'Cod.', columntype: 'textbox', datafield: 'COD_BANCO', width: 80},
          { text: 'Nome', datafield: 'NME_BANCO', columntype: 'textbox', width: 280}
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
        $("#codBanco").val($('#listaBanco').jqxGrid('getrowdatabyid', rowID).COD_BANCO);
        $("#nmeBanco").val($('#listaBanco').jqxGrid('getrowdatabyid', rowID).NME_BANCO);
        $("#dscArquivoBoleto").val($('#listaBanco').jqxGrid('getrowdatabyid', rowID).NME_ARQUIVO_BOLETO);        
        $("#method").val("UpdateBanco");
        $("#CadBanco").jqxWindow("open");
    });
    $( "#dialogInformacao" ).jqxWindow("close");     
}
$(document).ready(function(){
    CarregaGridBanco();
});

