$(function(){
    $("#btnSalvar").click(function(){
        $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, salvando registro! <br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
        $( "#dialogInformacao" ).jqxWindow("open");
        if ($('#indAtivo').is(":checked")){
            indAtivo = "S";
        }else{
            indAtivo = "N";
        }
        $.post('../../Controller/Noticias/NoticiasController.php',
            {method: $("#method").val(),
            codNoticias: $('#codNoticias').val(),
            dscNoticias: $("#dscNoticias").val(),
            dscTitulo: $('#dscTitulo').val() },
            function(result){                   
                result = eval ('('+result+')');                
                if (result[0]==true){
                    $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                    CarregaGridNoticias();
                    setTimeout(function(){
                        $( "#dialogInformacao" ).jqxWindow("close");
                        $( "#CadNoticias" ).jqxWindow("close");
                    },"2000");
                }else{
                    $( "#dialogInformacao" ).jqxWindow('setContent', "Erro ao Salvar Registro!<br>"+result);
                }
            }
        );
    });
});

$(document).ready(function(){
    $("input[type='button']").button(); 
});

