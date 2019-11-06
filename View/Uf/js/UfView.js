$(function(){
    $("#CadUf").jqxWindow({
        autoOpen: false,
        height: 300,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        position: {x:400, y:200},
        isModal: true,
        title: 'Cadastro de Unidades Federativas'
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
    $("#listaUf").jqxTooltip({
        content: 'D&ecirc; um duplo clique para editar',
        position: 'mouse',
        name: 'movieTooltip',
        theme: 'energyblue' });    
    $("#btnNovo").click(function(){
        $("#method").val("InsertUf");
        $("#sglUf").val('');
        $("#dscUf").val('');        
        $("#CadUf").jqxWindow("open");
    });
    $("#btnSalvar").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando UF!");
        $( "#dialogInformacao" ).jqxWindow("open");           
        $.post('../../Controller/Uf/UfController.php',
            {method: $("#method").val(),
            sglUf: $("#sglUf").val(),
            sglUfAnt: $("#sglUfAnt").val(),
            dscUf: $("#dscUf").val()}, function(data){

            data = eval('('+data+')');
            if (data[0]==1){
                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                CarregaGridUf();
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    $( "#CadUf" ).jqxWindow("close");
                },"2000");
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar Menu!'+data[1]);
            }
        });
    });
});

function CarregaGridUf(){
    $("#tdListaUf").html('');
    $("#tdListaUf").html('<div id="listaUf"></div>');
    $('#listaUf').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando UFs!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Uf/UfController.php',
           {
               method: 'ListarUf'
           },
           function(listaUf){
                listaUf = eval ('('+listaUf+')');
                if (listaUf[0]==true){
                    MontaTabelaUf(listaUf[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+listaUf[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}

function MontaTabelaUf(listaUf){
    var theme = 'energyblue';
    var nomeGrid = 'listaUf';
    var source =
    {
        localdata: listaUf,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'SGL_UF', type: 'string' },
            { name: 'DSC_UF', type: 'string' }
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
          { text: 'UF', columntype: 'textbox', datafield: 'SGL_UF', width: 80},
          { text: 'Estado', datafield: 'DSC_UF', columntype: 'textbox', width: 280}
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
        $("#sglUf").val($('#listaUf').jqxGrid('getrowdatabyid', rowID).SGL_UF);
        $("#sglUfAnt").val($('#listaUf').jqxGrid('getrowdatabyid', rowID).SGL_UF);
        $("#dscUf").val($('#listaUf').jqxGrid('getrowdatabyid', rowID).DSC_UF);        
        $("#method").val("UpdateUf");
        $("#CadUf").jqxWindow("open");
    });
    $( "#dialogInformacao" ).jqxWindow("close");     
}
$(document).ready(function(){
    CarregaGridUf();
});

