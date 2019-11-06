$(function(){
    $("#btnSalvar").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando Detalhe!");
        $( "#dialogInformacao" ).jqxWindow("open");        
        if ($("#indAtivo").jqxCheckBox('val')){
            ativo = 'S';
        }else{
            ativo = 'N';
        }      
        $.post('../../Controller/Detalhe/DetalheController.php',
            {
                method: $("#method").val(),
                codDetalhe: $("#codDetalhe").val(),
                dscDetalhe: $("#dscDetalhe").val(),
                indAtivo: ativo
            }, function(data){

            data = eval('('+data+')');
            if (data[0]==1){
                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                CarregaGridDetalhe();
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    $( "#CadDetalhe" ).jqxWindow("close");
                },"1000");
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar Menu!'+data[1]);
            }
        });
    });
});
$(document).ready(function(){
    $("input[type='button']").button(); 
});

