$(function(){
    $("#CadPessoa").jqxWindow({
        autoOpen: false,
        height: 650,
        width: 850,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Cadastro de Pessoas'
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
    $("#btnPesquisaPessoa").click(function(){
        $('#jqxWidget').html("");
        $('#jqxWidget').html("<div id='listaPessoas'></div>");
        $('#listaPessoas').html('<img src="../../Resources/images/carregando.gif" width="200" height="30">');
        CarregaGridPessoa();
    });
    $("#btnNovo").click(function(){
        CarregaTelaCadastro(true, null, null);
    });
    $("#btnSalvar").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando departamento!");
        $( "#dialogInformacao" ).jqxWindow("open");
        if ($('#indAtivo').is(":checked")){
            indAtivo = "S";
        }else{
            indAtivo = "N";
        }
        $.post('../../Controller/Departamento/CadastroDepartamentoController.php',
            {method: $("#method").val(),
            codDepartamento: $('#codDepartamento').val(),
            dscDepartamento: $('#dscDepartamento').val(),
            indAtivo: indAtivo},
            function(result){
                if (result===true){
                    $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                    CarregaGridDepartamento();
                    setTimeout(function(){
                        $( "#dialogInformacao" ).jqxWindow("close");
                        $( "#CadDepartamentos" ).jqxWindow("close");
                    },"2000");
                }
            }
        );
    }); 
    
});

function CarregaGridPessoa(){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");      
    $.post('../../Controller/Pessoa/PessoaController.php',
           {
               method: 'ListarPessoaPorNome',
               nmePessoa: $("#txtPesquisa").val()
           },
           function(ListaPessoas){
                ListaPessoas = eval ('('+ListaPessoas+')');
                if (ListaPessoas[0]==true){
                    MontaTabelaPessoas(ListaPessoas[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListaPessoas[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }
           }
    );
}
function MontaTabelaPessoas(ListaPessoas){
    var theme = 'energyblue';
    var nomeGrid = 'listaPessoas';
    var source =
    {
        localdata: ListaPessoas,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
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
            { name: 'NRO_RG', type: 'string' },
            { name: 'TXT_ORGAO_EXPEDIDOR', type: 'string' },
            { name: 'SGL_UF_ORGAO_EXPEDIDOR', type: 'string' },
            { name: 'TXT_EMAIL', type: 'string' }
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
          { text: 'C&oacute;digo', columntype: 'textbox', datafield: 'COD_PESSOA', width: 80},
          { text: 'Nome', datafield: 'NME_PESSOA', columntype: 'textbox', width: 380},          
          { text: 'CPF', datafield: 'NRO_CPF', columntype: 'textbox', width: 100}          
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
        CarregaTelaCadastro(false, rowID, ListaPessoas);
    });
    $("#dialogInformacao" ).jqxWindow("close");  
}
function CarregaTelaCadastro(novoPessoa, index, listaPessoas){
    $("#CadPessoa").jqxWindow("open");
    //$("#tdUf").html('');
    //$("#tdUf").html('<div id="sglUf" class="comboUf"></div>');
    if (!novoPessoa){
        $("#codPessoa").val(listaPessoas[index].COD_PESSOA);
        $("#nmePessoa").val(listaPessoas[index].NME_PESSOA);
        $("#nroCpf").val(listaPessoas[index].NRO_CPF);
        $("#nroCep").val(listaPessoas[index].NRO_CEP);
        $("#txtEndereco").val(listaPessoas[index].TXT_ENDERECO);
        if (listaPessoas[index].SGL_UF=='-1'){
            $("#sglUf").jqxDropDownList('selectIndex', -1 ); 
        }else{
            $("#sglUf").val(listaPessoas[index].SGL_UF); 
        }
        CarregaComboCidade(listaPessoas[index].SGL_UF, listaPessoas[index].COD_CIDADE, listaPessoas[index].COD_BAIRRO); 
        //CarregaComboBairro(listaPessoas[index].COD_CIDADE, listaPessoas[index].COD_BAIRRO);                        
        $("#nroRg").val(listaPessoas[index].NRO_RG);
        $("#txtOrgaoExpedidor").val(listaPessoas[index].TXT_ORGAO_EXPEDIDOR);
        $("#sglUfOrgaoExpedidor").val(listaPessoas[index].SGL_UF_ORGAO_EXPEDIDOR);
        $("#txtEmail").val(listaPessoas[index].TXT_EMAIL);
        
        $("#method").val("UpdatePessoa");

    }else{
        $("#codPessoa").val(0);
        $("#nmePessoa").val("");
        $("#nroCpf").val('');
        $("#txtEndereco").val('');
        $("#sglUf").val('');
        $("#codCidade").val('');
        $("#codBairro").val('');
        $("#nroRg").val('');
        $("#txtOrgaoExpedidor").val('');
        $("#sglUfOrgaoExpedidor").val('');
        $("#txtEmail").val('');       
        CarregaComboCidade('DF', -1);     
        $("#method").val("InsertPessoa");
    }    

}
$(document).ready(function(){
    $("#btnPrecoPessoa").hide();
    $("#btnComporPessoa").hide();
    CarregaComboUF('DF');
});

