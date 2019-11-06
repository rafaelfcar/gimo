function CarregaHistoricoImovel(){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");      
    $.post('../../Controller/Imovel/ImovelController.php',
           {
               method: 'CarregaHistoricoImovel',
               codImovel: $("#codImovel").val()
           },
           function(Historico){
                Historico = eval ('('+Historico+')');
                if (Historico[0]==true){
                    MontaTabelaHistoricoImovel(Historico[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListaImovels[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }
           }
    );
}
function MontaTabelaHistoricoImovel(Historico){
    var theme = 'energyblue';
    var nomeGrid = 'listaHistoricoImovel';
    var source =
    {
        localdata: Historico,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [            
            { name: 'NME_PESSOA', type: 'string' },            
            { name: 'DTA_INICIO', type: 'string' },
            { name: 'DTA_FIM', type: 'string' },
            { name: 'VLR_TRANSACAO', type: 'string' },
            { name: 'TPO_TRANSACAO', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: 600,
        height: 250, 
        source: dataAdapter,
        theme: theme,
        selectionmode: 'singlerow',
        sortable: true,
        filterable: true,
        pageable: true,
        columnsresize: true,
        columns: [          
          { text: 'Nome', datafield: 'NME_PESSOA', columntype: 'textbox', width: 200}, 
          { text: 'In&iacute;cio', datafield: 'DTA_INICIO', columntype: 'textbox', width: 100} ,          
          { text: 'T&eacute;rmino', datafield: 'DTA_FIM', columntype: 'textbox', width: 100} ,          
          { text: 'Valor', datafield: 'VLR_TRANSACAO', columntype: 'textbox', width: 100},
          { text: 'Tipo', datafield: 'TPO_TRANSACAO', columntype: 'textbox', width: 100}
        ]
    });
    // apply localization.
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#'+nomeGrid).jqxGrid({ pagesizeoptions: ['40', '50', '60']});
    
    $("#dialogInformacao" ).jqxWindow("close");  
}
