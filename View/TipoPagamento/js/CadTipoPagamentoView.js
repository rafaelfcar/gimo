$(function(){  
    $("#btnSalvar").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando Tipo de pagamento!");
        $( "#dialogInformacao" ).jqxWindow("open");
        if ($.trim($("#dscTipoPagamento").val())==''){
            $( "#dialogInformacao" ).jqxWindow('setContent', "Informe o nome do bairro por favor!");
            return;
        }  
        if ($("#indAtivo").jqxCheckBox('val')){
            ativo = 'S';
        }else{
            ativo = 'N';
        }    
        $.post('../../Controller/TipoPagamento/TipoPagamentoController.php',
            {
                method: $("#method").val(),
                codTipoPagamento: $("#codTipoPagamento").val(),
                dscTipoPagamento: $("#dscTipoPagamento").val(),
                indAtivo: ativo
            }, function(data){

            data = eval('('+data+')');
            if (data[0]){
                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                CarregaGridTipoPagamento();
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    $( "#CadTipoPagamento" ).jqxWindow("close");
                },"2000");
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar Menu!'+data[1]);
            }
        });
    });
});

