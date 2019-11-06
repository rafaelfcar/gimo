$(function(){
    $("#codImovelPesquisa").keyup(function(event){
        var codddd = $("#codImovelPesquisa").val();
        if (codddd.length>0){
            $("#nome").hide('slow');
            $("#bairro").hide('slow');
        }else{
            $("#nome").show('slow');
            $("#bairro").show('slow');            
        }
        if (event.keyCode==13){
            $("#btnPesquisaImovel").click();
        }
    });   
    $("#nmeProprietarioPesquisa").keyup(function(){
        var codddd = $("#nmeProprietarioPesquisa").val();
        if (codddd.length>0){
            $("#codigo").hide('slow');
            $("#bairro").hide('slow');
        }else{
            $("#codigo").show('slow');
            $("#bairro").show('slow');            
        }
        if (event.keyCode==13){
            $("#btnPesquisaImovel").click();
        }
    });    
    $("#btnPesquisaImovel").click(function(){
        $('#jqxWidget').html("");
        $('#jqxWidget').html("<div id='listaImovels'></div>");
        $('#listaImovels').html('<img src="../../Resources/images/carregando.gif" width="200" height="30">');
        CarregaGridImovel();
    });
    
    $("#btnNovoImovel").click(function(){
        CarregaTelaCadastro(true, null, null);
    });    
    $("#sglUfPesquisa").change(function(){
        CarregaComboCidadePesquisa($(this).val());
    });    
    $("#codCidadePesquisa").change(function(){
        CarregaComboBairroPesquisa($(this).val());
    });       
});


function CarregaComboUFPesquisa(){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Combo!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Uf/UfController.php',
           {
               method: 'ListarUf'
           },
           function(ListarUf){
                ListarUf = eval ('('+ListarUf+')');
                if (ListarUf[0]==true){
                    MontaComboUfPesquisa(ListarUf[1]);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarUf[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboUfPesquisa(ListarUf){    
    var source =
    {
        localdata: ListarUf,
        datatype: "json",
        datafields:
        [
            { name: 'SGL_UF', type: 'string' },
            { name: 'DSC_UF', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);    
    $("#sglUfPesquisa").jqxDropDownList(
    {
        source: dataAdapter,
        theme: theme,
        width: 200,
        height: 25,
        selectedIndex: -1,
        displayMember: 'DSC_UF',
        valueMember: 'SGL_UF'
    });                
}

function CarregaComboCidadePesquisa(sglUf){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Combo!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Cidade/CidadeController.php',
           {
               method: 'SelecionaCidades',
               sglUf: sglUf
           },
           function(ListarCidade){
                ListarCidade = eval ('('+ListarCidade+')');
                if (ListarCidade[0]==true){
                    MontaComboCidadePesquisa(ListarCidade[1]);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarCidade[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboCidadePesquisa(ListarCidade){    
    var source =
    {
        localdata: ListarCidade,
        datatype: "json",
        datafields:
        [
            { name: 'COD_CIDADE', type: 'string' },
            { name: 'NME_CIDADE', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);    
    $("#codCidadePesquisa").jqxDropDownList(
    {
        source: dataAdapter,
        theme: theme,
        width: 200,
        height: 25,
        selectedIndex: -1,
        displayMember: 'NME_CIDADE',
        valueMember: 'COD_CIDADE'
    });                
}

function CarregaComboBairroPesquisa(codCidade){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Combo!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Bairro/BairroController.php',
           {
               method: 'SelecionaBairro',
               codCidade: codCidade
           },
           function(ListarBairro){
                ListarBairro = eval ('('+ListarBairro+')');
                if (ListarBairro[0]==true){
                    MontaComboBairroPesquisa(ListarBairro[1]);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarBairro[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboBairroPesquisa(ListarBairro){    
    var source =
    {
        localdata: ListarBairro,
        datatype: "json",
        datafields:
        [
            { name: 'COD_BAIRRO', type: 'string' },
            { name: 'NME_BAIRRO', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);    
    $("#codBairroPesquisa").jqxDropDownList(
    {
        source: dataAdapter,
        theme: theme,
        width: 200,
        height: 25,
        selectedIndex: -1,
        displayMember: 'NME_BAIRRO',
        valueMember: 'COD_BAIRRO'
    });                
}
function CarregaGridImovel(){    
    $("#tdListaImovel").html('');
    $("#tdListaImovel").html('<div id="listaImovels"></div>');
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");      
    $.post('../../Controller/Imovel/ImovelController.php',
           {
               method: 'ListarImovel',
               codImovelPesquisa: $("#codImovelPesquisa").val(),
               sglUfPesquisa: $("#sglUfPesquisa").val(),
               codCidadePesquisa: $("#codCidadePesquisa").val(),
               codBairroPesquisa: $("#codBairroPesquisa").val(),
               nmeProprietarioPesquisa: $("#nmeProprietarioPesquisa").val()
           },
           function(ListaImovels){
                ListaImovels = eval ('('+ListaImovels+')');
                if (ListaImovels[0]==true){
                    MontaTabelaImovels(ListaImovels[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListaImovels[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }
           }
    );
}
function MontaTabelaImovels(ListaImovels){
    var theme = 'energyblue';
    var nomeGrid = 'listaImovels';
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
            { name: 'NME_PESSOA', type: 'string' },
            { name: 'NRO_CPF', type: 'string' },
            { name: 'TXT_ENDERECO', type: 'string' },
            { name: 'COD_BAIRRO', type: 'string' },
            { name: 'NME_BAIRRO', type: 'string' },
            { name: 'COD_CIDADE', type: 'string' },
            { name: 'NME_CIDADE', type: 'string' },
            { name: 'SGL_UF', type: 'string' },
            { name: 'DSC_UF', type: 'string' },
            { name: 'NRO_CEP', type: 'string' }
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
        CarregaTelaCadastro(false, rowID, ListaImovels);
    });
    $("#dialogInformacao" ).jqxWindow("close");  
}
function CarregaTelaCadastro(novoImovel, rowID, ListaImovels){ 
    $("#CadImovel").jqxWindow("open");
    if (!novoImovel){
        $("#CadImovel").jqxWindow("open");
        $("#btnDetalheImovel").show();  
        $("#codImovel").val(ListaImovels[rowID].COD_IMOVEL);
        $("#codProprietario").val(ListaImovels[rowID].COD_PROPRIETARIO);
        $("#nmeProprietario").val(ListaImovels[rowID].NME_PESSOA);
        $("#nroCep").val(ListaImovels[rowID].NRO_CEP);
        $("#txtEndereco").val(ListaImovels[rowID].TXT_ENDERECO);
        CarregaComboCidadeImovel(ListaImovels[rowID].SGL_UF, ListaImovels[rowID].COD_CIDADE);                       
        CarregaComboBairroImovel(ListaImovels[rowID].COD_CIDADE, ListaImovels[rowID].COD_BAIRRO);        
        $("#vlrTamanho").val(ListaImovels[rowID].VLR_TAMANHO);
        $("#vlrImovel").val(ListaImovels[rowID].VLR_IMOVEL);  
    }else{
        $("#btnDetalheImovel").hide();        
        $("#codProprietario").val('');
        $("#nmeProprietario").val('');  
        $("#codImovel").val(0);
        $("#txtEndereco").val('');
        $("#sglUf").val('DF');
        CarregaComboCidadeImovel('DF', -1);        
        $("#vlrTamanho").val('');
        $("#vlrImovel").val('');
        $("#nroCep").val('');
    }   
}
$(document).ready(function(){    
    CarregaComboUFPesquisa();   
    CarregaComboUFImovel('DF'); 
    CarregaComboUF('DF');
    CarregaComboCidade('DF', -1); 
});

