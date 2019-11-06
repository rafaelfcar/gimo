$(function(){
    $("#CadBairro").jqxWindow({
        autoOpen: false,
        height: 300,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        position: {x:400, y:200},
        isModal: true,
        title: 'Cadastro de Bairros'
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
    $("#listaBairro").jqxTooltip({
        content: 'D&ecirc; um duplo clique para editar',
        position: 'mouse',
        name: 'movieTooltip',
        theme: 'energyblue' });    
    $("#btnNovo").click(function(){
        $("#method").val("InsertBairro");
        $("#nmeBairro").val('');
        $("#codBairro").val('');
        $("#sglUf").val('');
        $("#CadBairro").jqxWindow("open");
    });
});
function CarregaGridBairro(){
    $("#tdListaBairro").html('');
    $("#tdListaBairro").html('<div id="listaBairro"></div>');
    $('#listaBairro').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando bairros!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Bairro/BairroController.php',
           {
               method: 'ListarBairro'
           },
           function(listaBairro){
                listaBairro = eval ('('+listaBairro+')');
                if (listaBairro[0]==true){
                    MontaTabelaBairro(listaBairro[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+listaBairro[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}

function MontaTabelaBairro(listaBairro){
    var theme = 'energyblue';
    var nomeGrid = 'listaBairro';
    var source =
    {
        localdata: listaBairro,
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
            { name: 'NME_BAIRRO', type: 'string' },
            { name: 'COD_BAIRRO', type: 'string' },
            { name: 'ATIVO', type: 'boolean' },
            { name: 'IND_ATIVO', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: 1085,
        source: dataAdapter,
        theme: theme,
        selectionmode: 'singlerow',
        sortable: true,
        filterable: true,
        pageable: true,        
        columnsresize: true,
        columns: [
          { text: 'Codigo', columntype: 'textbox', datafield: 'COD_BAIRRO', width: 80},
          { text: 'Bairro', datafield: 'NME_BAIRRO', columntype: 'textbox', width: 280},
          { text: 'Cidade', datafield: 'NME_CIDADE', columntype: 'textbox', width: 280},
          { text: 'Estado', datafield: 'DSC_UF', columntype: 'textbox', width: 280},
          { text: 'Ativo', datafield: 'ATIVO', columntype: 'checkbox', width: 80}
        ]
    });
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    // events
    $('#'+nomeGrid).on('rowdoubleclick', function (event)
    {
        $("#CadBairro").jqxWindow("open");
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, carregando!");
        $( "#dialogInformacao" ).jqxWindow("open");
        var args = event.args;
        var rows = $('#'+nomeGrid).jqxGrid('getdisplayrows');
        var rowData = rows[args.visibleindex];
        var rowID = rowData.uid;
        $("#codBairro").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).COD_BAIRRO);
        $("#sglUf").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).SGL_UF);
        $("#nmeBairro").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).NME_BAIRRO);  
        CarregaComboCidade($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).SGL_UF, $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).COD_CIDADE);    
        if ($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).IND_ATIVO=='S'){            
            $("#indAtivo").jqxCheckBox('check');
        }else{            
            $("#indAtivo").jqxCheckBox('uncheck');
        }       
        $("#method").val("UpdateBairro");        
    });       
    $( "#dialogInformacao" ).jqxWindow("close"); 
}
$(document).ready(function(){
    CarregaGridBairro();
});

