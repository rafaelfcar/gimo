$(function(){ 
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
    $( "#CadInformaPagamento" ).jqxWindow({
        autoOpen: false,
        height: 350,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        title: 'Informe de pagamento',
        isModal: true
    });      
    $("#btnGerarBoleto").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, gerando Boletos!");
        $( "#dialogInformacao" ).jqxWindow("open"); 
        $.post('../../Controller/Boleto/BoletoController.php',
            {method: 'GerarBoletosMensal',
            nroAnoReferencia: $("#nroAnoReferencia").val(),
            nroMesReferencia: $("#nroMesReferencia").val()}, function(data){

            data = eval('('+data+')');
            if (data[0]==1){
                CarregaGridPagamento();
                $( "#dialogInformacao" ).jqxWindow('setContent', "Boletos gerados com sucesso!");
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    $( "#CadUf" ).jqxWindow("close");
                },"2000");
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao gerar boleto!'+data[1]);
            }
        });
    });       
    $("#btnEnviarEmail").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, gerando Boletos!");
        $( "#dialogInformacao" ).jqxWindow("open"); 
        $.post('../../Controller/Pagamento/PagamentoController.php',
            {method: 'EnviarEmail',
            nroAnoReferencia: $("#nroAnoReferencia").val(),
            nroMesReferencia: $("#nroMesReferencia").val()}, function(data){

            data = eval('('+data+')');
            if (data['retorno']){                
                $( "#dialogInformacao" ).jqxWindow('setContent', "Boletos enviados com sucesso!");
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    $( "#CadUf" ).jqxWindow("close");
                },"2000");
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao gerar boleto!'+data['msg']);
            }
        });
    });
    $("#nroAnoReferencia").change(function(){
       CarregaGridPagamento(); 
    });
    $("#nroMesReferencia").change(function(){
       CarregaGridPagamento(); 
    });
});

function MontaComboMes(){ 
    var data = new Array();
    var NRO_MES_REFERENCIA = [1,2,3,4,5,6,7,8,9,10,11,12];
    var DSC_MES_REFERENCIA = ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
    var k =0;
    for (var i = 0; i < NRO_MES_REFERENCIA.length; i++) { 
        var row = {};
        row["NRO_MES_REFERENCIA"] = NRO_MES_REFERENCIA[k]; 
        row["DSC_MES_REFERENCIA"] = DSC_MES_REFERENCIA[k];
        data[i] = row;
        k++;
    }   
    var source =
    {
        datatype: "array",
        localdata: data
    };    
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#nroMesReferencia").jqxDropDownList(
        {
            source: dataAdapter,
            theme: 'energyblue',
            width: 200,
            height: 25,
            selectedIndex: 0,
            displayMember: 'DSC_MES_REFERENCIA',
            valueMember: 'NRO_MES_REFERENCIA'
    });
}
function MontaComboAno(){ 
    var data = new Array();
    var NRO_ANO_REFERENCIA = [2014,2015,2016,2017,2018,2019,2020,2021,2022];
    var DSC_ANO_REFERENCIA = [2014,2015,2016,2017,2018,2019,2020,2021,2022];
    var k =0;
    for (var i = 0; i < NRO_ANO_REFERENCIA.length; i++) { 
        var row = {};
        row["NRO_ANO_REFERENCIA"] = NRO_ANO_REFERENCIA[k]; 
        row["DSC_ANO_REFERENCIA"] = DSC_ANO_REFERENCIA[k];
        data[i] = row;
        k++;
    }   
    var source =
    {
        datatype: "array",
        localdata: data
    };    
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#nroAnoReferencia").jqxDropDownList(
        {
            source: dataAdapter,
            theme: 'energyblue',
            width: 200,
            height: 25,
            selectedIndex: 0,
            displayMember: 'DSC_ANO_REFERENCIA',
            valueMember: 'NRO_ANO_REFERENCIA'
    });
}
function CarregaGridPagamento(){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");      
    $.post('../../Controller/Pagamento/PagamentoController.php',
           {
               method: 'ListarPagamentoAbertos',
               dscPagamento: $("#txtPesquisa").val(),
               nroMesReferencia: $("#nroMesReferencia").val(),
               nroAnoReferencia: $("#nroAnoReferencia").val()
           },
           function(ListaPagamentos){
                ListaPagamentos = eval ('('+ListaPagamentos+')');
                if (ListaPagamentos[0]==true){
                    MontaTabelaPagamentos(ListaPagamentos[1]);
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListaPagamentos[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }
           }
    );
}
function MontaTabelaPagamentos(ListaPagamentos){
    var theme = 'energyblue';
    var nomeGrid = 'listaPagamentos';
    var source =
    {
        localdata: ListaPagamentos,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'DTA_VENCIMENTO', type: 'string' },
            { name: 'NRO_NOSSO_NUMERO', type: 'string' },
            { name: 'NRO_DOCUMENTO', type: 'string' },
            { name: 'VLR_MENSALIDADE', type: 'string' },
            { name: 'TXT_EMAIL', type: 'string' },
            { name: 'NME_PESSOA', type: 'string' }
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
          { text: 'Cliente', columntype: 'textbox', datafield: 'NME_PESSOA', width: 150},
          { text: 'Email', columntype: 'textbox', datafield: 'TXT_EMAIL', width: 150},
          { text: 'Data', columntype: 'textbox', datafield: 'DTA_VENCIMENTO', width: 150},
          { text: 'Nosso N&uacute;mero', datafield: 'NRO_NOSSO_NUMERO', columntype: 'textbox', width: 150},          
          { text: 'Documento', datafield: 'NRO_DOCUMENTO', columntype: 'textbox', width: 150},          
          { text: 'Valor', datafield: 'VLR_MENSALIDADE', columntype: 'textbox', width: 150}      
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
        $("#dtaVencimento").text($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).DTA_VENCIMENTO);
        $("#vlrMensalidade").text($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).VLR_MENSALIDADE);
        $("#nroNossoNumero").text($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).NRO_NOSSO_NUMERO);
        $("#txtEmail").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).TXT_EMAIL);
        $("#nmePessoa").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).NME_PESSOA);
        $("#dtaPagamento").val('');
        $("#vlrPagamento").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).VLR_MENSALIDADE);
        $("#codTipoPagamento").val(-1);
        $( "#CadInformaPagamento" ).jqxWindow('open');
        //window.open('../../Controller/Pagamento/PagamentoController.php?method=GerarBoletoGeral&nossoNumero='+$('#'+nomeGrid).jqxGrid('getrowdatabyid', rowID).NRO_NOSSO_NUMERO);
    });
    $("#dialogInformacao" ).jqxWindow("close");  
}
$(document).ready(function(){
    MontaComboMes();
    MontaComboAno();
    CarregaGridPagamento();
});

