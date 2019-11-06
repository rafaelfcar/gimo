$(function(){
    $("#indAtivo").jqxCheckBox({ width: 120, height: 25, theme: theme });
    $("#CadDetalhe").jqxWindow({
        autoOpen: false,
        height: 300,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        position: {x:400, y:200},
        isModal: true,
        title: 'Cadastro de Detalhes'
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
    $("#listaDetalhe").jqxTooltip({
        content: 'D&ecirc; um duplo clique para editar',
        position: 'mouse',
        name: 'movieTooltip',
        theme: 'energyblue' });    
    $("#btnNovo").click(function(){
        $("#method").val("InsertDetalhe");
        $("#codDetalhe").val('');
        $("#dscDetalhe").val('');        
        $("#indAtivo").jqxCheckBox('uncheck');
        $("#CadDetalhe").jqxWindow("open");
    });
});

function CarregaGridDetalhe(){
    $("#tdListaDetalhe").html('');
    $("#tdListaDetalhe").html('<div id="listaDetalhe"></div>');
    $('#listaDetalhe').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando detalhes!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Detalhe/DetalheController.php',
           {
               method: 'ListarDetalhe'
           },
           function(listaDetalhe){
                listaDetalhe = eval ('('+listaDetalhe+')');
                if (listaDetalhe[0]==true){
                    MontaTabelaDetalhe(listaDetalhe[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+listaDetalhe[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}

function MontaTabelaDetalhe(listaDetalhe){
    var theme = 'energyblue';
    var nomeGrid = 'listaDetalhe';
    var source =
    {
        localdata: listaDetalhe,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'COD_DETALHE', type: 'string' },
            { name: 'DSC_DETALHE', type: 'string' },
            { name: 'ATIVO', type: 'boolean' },
            { name: 'IND_ATIVO', type: 'string' }
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
          { text: 'C&oacute;digo', columntype: 'textbox', datafield: 'COD_DETALHE', width: 80},
          { text: 'Descri&ccedil;&atilde;o', datafield: 'DSC_DETALHE', columntype: 'textbox', width: 280},
          { text: 'Ativo', datafield: 'ATIVO', columntype: 'checkbox', width: 80}
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
        $("#codDetalhe").val($('#listaDetalhe').jqxGrid('getrowdatabyid', rowID).COD_DETALHE);
        $("#codDetalheAnt").val($('#listaDetalhe').jqxGrid('getrowdatabyid', rowID).COD_DETALHE);
        $("#dscDetalhe").val($('#listaDetalhe').jqxGrid('getrowdatabyid', rowID).DSC_DETALHE); 
        if ($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).IND_ATIVO=='S'){            
            $("#indAtivo").jqxCheckBox('check');
        }else{            
            $("#indAtivo").jqxCheckBox('uncheck');
        }             
        $("#method").val("UpdateDetalhe");
        $("#CadDetalhe").jqxWindow("open");
    });
    $( "#dialogInformacao" ).jqxWindow("close");     
}
$(document).ready(function(){
    CarregaGridDetalhe();
    $(document).on('contextmenu', function (e) {
        return false;
    });
});

