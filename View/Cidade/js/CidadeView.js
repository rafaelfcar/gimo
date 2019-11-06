$(function(){
    $("#CadCidade").jqxWindow({
        autoOpen: false,
        height: 300,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        position: {x:400, y:200},
        isModal: true,
        title: 'Cadastro de Cidades'
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
    $("#listaCidade").jqxTooltip({
        content: 'D&ecirc; um duplo clique para editar',
        position: 'mouse',
        name: 'movieTooltip',
        theme: 'energyblue' });    
    $("#btnNovo").click(function(){
        $("#method").val("InsertCidade");
        $("#nmeCidade").val('');
        $("#codCidade").val('0');
        $("#sglUf").val('');
        $("#CadCidade").jqxWindow("open");
    });
});

function CarregaGridCidade(){
    $("#tdListaCidade").html('');
    $("#tdListaCidade").html('<div id="listaCidade"></div>');
    $('#listaCidade').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando cidades!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Cidade/CidadeController.php',
           {
               method: 'ListarCidade'
           },
           function(listaCidade){
                listaCidade = eval ('('+listaCidade+')');
                if (listaCidade[0]==true){
                    MontaTabelaCidade(listaCidade[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+listaCidade[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}

function MontaTabelaCidade(listaCidade){
    var theme = 'energyblue';
    var nomeGrid = 'listaCidade';
    var source =
    {
        localdata: listaCidade,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'SGL_UF', type: 'string' },
            { name: 'DSC_UF', type: 'string' },
            { name: 'NME_CIDADE', type: 'string' },
            { name: 'COD_CIDADE', type: 'string' },
            { name: 'ATIVO', type: 'boolean' },
            { name: 'IND_ATIVO', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: 785,
        source: dataAdapter,
        theme: theme,
        selectionmode: 'singlerow',
        sortable: true,
        filterable: true,
        pageable: true,        
        columnsresize: true,
        columns: [
          { text: 'Codigo', columntype: 'textbox', datafield: 'SGL_UF', width: 80},
          { text: 'Cidade', datafield: 'NME_CIDADE', columntype: 'textbox', width: 280},
          { text: 'Estado', datafield: 'DSC_UF', columntype: 'textbox', width: 280},
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
        $("#codCidade").val($('#listaCidade').jqxGrid('getrowdatabyid', rowID).COD_CIDADE);
        $("#sglUf").val($('#listaCidade').jqxGrid('getrowdatabyid', rowID).SGL_UF);
        $("#nmeCidade").val($('#listaCidade').jqxGrid('getrowdatabyid', rowID).NME_CIDADE);     
        if ($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).IND_ATIVO=='S'){            
            $("#indAtivo").jqxCheckBox('check');
        }else{            
            $("#indAtivo").jqxCheckBox('uncheck');
        }             
        $("#method").val("UpdateCidade");
        $("#CadCidade").jqxWindow("open");
    });
    $( "#dialogInformacao" ).jqxWindow("close");     
}
$(document).ready(function(){
    CarregaGridCidade();
});

