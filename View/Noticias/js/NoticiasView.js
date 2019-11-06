$(function(){
    $("#CadNoticias").jqxWindow({
        autoOpen: false,
        height: 450,
        width: 850,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Cadastro de Not&iacute;cias'
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
    $("#btnNovo").jqxButton({ width: '100', theme: 'energyblue' });
    $("#btnSalvar").jqxButton({ width: '100', theme: 'energyblue' });
    $("#btnNovo").click(function(){
        $("#method").val("InsertNoticias");
        $("#codNoticias").val(0);
        $("#dscNoticias").val('');
        $("#dscTitulo").val('');
        $("#indAtivo").prop("checked", false);
        $("#CadNoticias").jqxWindow("open");
    });
});

function CarregaGridNoticias(){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando not&iacute;cias!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");            
    $.post('../../Controller/Noticias/NoticiasController.php',
           {
               method: 'ListarNoticias'
           },
           function(listaNoticias){
                listaNoticias = eval ('('+listaNoticias+')');
                MontaTabelaNoticias(listaNoticias[1]);
           }
    );
}

function MontaTabelaNoticias(listaNoticias){
    var theme = 'energyblue';
    var nomeGrid = 'listaNoticias';
    var rowIDGrid = '';
    var source =
    {
        localdata: listaNoticias,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'COD_NOTICIAS', type: 'string' },
            { name: 'TXT_NOTICIAS', type: 'string' },
            { name: 'TXT_OBSERVACAO', type: 'string' },
            { name: 'DTA_NOTICIA', type: 'string' }
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
          { text: 'C&oacute;digo', columntype: 'textbox', datafield: 'COD_NOTICIAS', width: 80},
          { text: 'T&iacute;tulo', datafield: 'TXT_NOTICIAS', columntype: 'textbox', width: 180},
          { text: 'Data', datafield: 'DTA_NOTICIA', columntype: 'textbox', width: 90 }
        ]
    });
    $("#"+nomeGrid).jqxGrid('hidecolumn', 'COD_Noticias');
    // events
    $("#"+nomeGrid).on('rowdoubleclick', function (event)
    {
        var args = event.args;
        // gets all rows loaded from the data source.
        var rows = $('#'+nomeGrid).jqxGrid('getdisplayrows');
        var rowData = rows[args.rowindex];
        var rowID = rowData.uid;
        rowIDGrid = rowID;
        $("#codNoticias").val($("#"+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_NOTICIAS);
        $("#dscTitulo").val($("#"+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).TXT_NOTICIAS);
        $("#dscNoticias").val($("#"+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).TXT_OBSERVACAO);
        $("#method").val("UpdateNoticia");
        $("#CadNoticias").jqxWindow("open");
    });
    $("#"+nomeGrid).on('contextmenu', function () {
        return false;
    });
    $("#dialogInformacao" ).jqxWindow("close");
}
$(document).ready(function(){
    $('#listaNoticias').html('<img src="../../Resources/images/carregando.gif" width="200" height="30">');
    CarregaGridNoticias();
});

