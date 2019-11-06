$(function(){
    $( "#dtaPagamento" ).datepicker({
        dateFormat: 'dd/mm/yy',
        changeYear: true,
        changeMonth: true,
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });  
    $("#vlrPagamento").maskMoney({symbol:"R$ ",decimal:",",thousands:"."});
    $("#btnSalvarPagamento").click(function(){
        $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, salvando registro! <br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
        $( "#dialogInformacao" ).jqxWindow("open");
        $.post('../../Controller/Boleto/BoletoController.php',
               {
                   method: 'InformaPagamento',
                   nroNossoNumero: $("#nroNossoNumero").text(),
                   dtaPagamento: $("#dtaPagamento").val(),
                   vlrPagamento: $("#vlrPagamento").val(),
                   codTipoPagamento: $("#codTipoPagamento").val()
               },
               function(result){        
                   result = eval ('('+result+')');                  
                    if (result[0]){
                        
                        CarregaGridPagamento();
                        $( "#dialogInformacao" ).jqxWindow('setContent', "Registro Salvo com sucesso!");   
                        setTimeout(function(){
                            
                            $("#CadTransacaoImovel").jqxWindow("close");                         
                            $("#dialogInformacao").jqxWindow("close");
                            
                        },"2000");
                    }else{
                        $( "#dialogInformacao" ).jqxWindow('setContent', result[1]);
                    }
               }
        );
    });    
    $("#btnEnviarEmailCliente").click(function(){
        $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, salvando registro! <br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
        $( "#dialogInformacao" ).jqxWindow("open");
        $.post('../../Controller/Pagamento/PagamentoController.php',
               {
                   method: 'EnviarEmailCliente',
                   nroNossoNumero: $("#nroNossoNumero").text(),
                   dtaVencimento: $("#dtaVencimento").text(),
                   txtEmail: $("#txtEmail").val(),
                   nmePessoa: $("#nmePessoa").val(),
               },
               function(result){        
                   result = eval ('('+result+')');                  
                    if (result['retorno']){
                        $( "#dialogInformacao" ).jqxWindow('setContent', "Boleto Enviado com sucesso!");   
                        setTimeout(function(){                                                   
                            $("#dialogInformacao").jqxWindow("close");
                            
                        },"2000");
                    }else{
                        $( "#dialogInformacao" ).jqxWindow('setContent', result['msg']);
                    }
               }
        );
    }); 
});


function CarregaComboTipoPagamento(){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Combo!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/TipoPagamento/TipoPagamentoController.php',
           {
               method: 'SelecionaTipoPagamento'
           },
           function(ListarTipoPagamento){
                ListarTipoPagamento = eval ('('+ListarTipoPagamento+')');
                if (ListarTipoPagamento[0]==true){
                    MontaComboTipoPagamento(ListarTipoPagamento[1]);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarUf[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboTipoPagamento(ListarTipoPagamento){    
    var source =
    {
        localdata: ListarTipoPagamento,
        datatype: "json",
        datafields:
        [
            { name: 'COD_TIPO_PAGAMENTO', type: 'string' },
            { name: 'DSC_TIPO_PAGAMENTO', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);    
    $("#codTipoPagamento").jqxDropDownList(
    {
        source: dataAdapter,
        theme: theme,
        width: 200,
        height: 25,
        selectedIndex: -1,
        displayMember: 'DSC_TIPO_PAGAMENTO',
        valueMember: 'COD_TIPO_PAGAMENTO'
    });                
}

$(document).ready(function(){    
    CarregaComboTipoPagamento();   
});

