$(function(){    
    $( "#dtaInicio" ).datepicker({
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
    $( "#dtaTermino" ).datepicker({
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
    $( "#dtaCancelamento" ).datepicker({
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
    $("#vlrTransacaoImovel").maskMoney({symbol:"R$ ",decimal:",",thousands:"."});
    $('#nmePessoaTransacao').autocomplete({
        source:'../../Controller/Pessoa/PessoaController.php?method=ListarPessoaGrid',
        minLength:4,
        select: function(event, ui) {
            $("#codPessoaTransacao").val(ui.item.id);
            $('#nmePessoaTransacao').val(ui.item.label);                        
        },
        search: function(){$(this).addClass('loading');},
        open: function(){$(this).removeClass('loading');}
    }); 
    $("#rbAluguel").jqxRadioButton({ width: 250, height: 25, checked: true, theme: 'energyblue'});
    $("#rbVenda").jqxRadioButton({ width: 250, height: 25, theme: 'energyblue'});
    $('#rbAluguel').on('change', function(){
       if ($('#rbAluguel').jqxRadioButton('checked')){
           $(".hideVenda").show('slow');
       }else{
           $(".hideVenda").hide('slow');
       }
    });
    $("#btnSalvarTransacaoImovel").click(function(){
        $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, salvando registro! <br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
        $( "#dialogInformacao" ).jqxWindow("open");
        var checked = $('#rbAluguel').jqxRadioButton('checked'); 
        var tpoTransacao = '';
        if (checked){
            tpoTransacao = 'A';
        }else{
            tpoTransacao = 'V';
        }
        $.post('../../Controller/Imovel/ImovelController.php',
               {
                   method: 'SalvarTransacaoImovel',
                   codImovel: $("#codImovel").val(),
                   codPessoaTransacao: $("#codPessoaTransacao").val(),
                   vlrTransacaoImovel: $("#vlrTransacaoImovel").val(),
                   dtaInicio: $("#dtaInicio").val(),
                   dtaTermino: $("#dtaTermino").val(),
                   dtaCancelamento: $("#dtaCancelamento").val(),
                   vlrImovel: $("#vlrImovel").val(),
                   vlrTamanho: $("#vlrTamanho").val(),
                   tpoTransacao: tpoTransacao,
                   nroDiaVencimento: $("#nroDiaVencimento").val()
               },
               function(result){        
                   result = eval ('('+result+')');                  
                    if (result[0]==true){
                        
                        CarregaGridImovel();
                        setTimeout(function(){
                            
                            $( "#dialogInformacao" ).jqxWindow('setContent', "Registro Salvo com sucesso!");                            
                            $("#dialogInformacao").jqxWindow("close");
                            
                        },"2000");
                    }else{
                        $( "#dialogInformacao" ).jqxWindow('setContent', result[1]);
                    }
               }
        );
    });    
    $("#btnCadPessoaTransacao").click(function(){ 
        $("#indPessoa").val('C');
        $("#CadPessoa").jqxWindow("open");                
    });     
});