$(function(){
    $("#btnSalvar").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando!");
        $( "#dialogInformacao" ).jqxWindow("open");           
        $.post('../../Controller/Banco/BancoController.php',
            {method: $("#method").val(),
            codBanco: $("#codBanco").val(),
            nmeBanco: $("#nmeBanco").val(),
            dscArquivoBoleto: $("#dscArquivoBoleto").val()}, function(data){

            data = eval('('+data+')');
            if (data[0]==1){
                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                CarregaGridBanco();
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    $( "#CadBanco" ).jqxWindow("close");
                },"2000");
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar Menu!'+data[1]);
            }
        });
    });
});

