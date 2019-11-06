$(function(){
    $("#EnviaEmailPagamentoView").jqxWindow({
        autoOpen: false,
        height: "700px",
        width: "1250px",
        maxHeight: 600,
        maxWidth: 1000,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Envio de Email'
    });
    $( "#dtaPagamentoEmail" ).datepicker({
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
    $("#btnEnviaEmail").click(function(){
        EnviaEmail();        
    });     
});

function EnviaEmail(){
    $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando loja!");
    $( "#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Loja/LojaController.php',
           {
               method: 'EnviaEmail',
               txtEmail: $("#txtEmailEmail").val(),
               dscLoja: $("#dscLojaEmail").val(),
               codLoja: $("#codLojaEmail").val(),
               dtaBoleto: $("#dtaBoletoEmail").val(),
               nroBoleto: $("#nroBoletoEmail").val(),
               dtaAtual: $("#dtaPagamentoEmail").val()
           },
           function(listaLoja){
                listaLoja = eval ('('+listaLoja+')');
                if (listaLoja['retorno']==true){
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'Email enviado');
                    $( "#dialogInformacao" ).jqxWindow('open');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>');
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}