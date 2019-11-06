$(function(){
    $("#indAtivo").jqxCheckBox({ width: 120, height: 25, theme: theme });
    $("#CadDadosCadastrais").jqxWindow({
        autoOpen: false,
        height: 300,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Cadastro de Status Im&oacute;vel'
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
    
    $("#btnSalvar").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando Status Im&oacute;vel!");
        $( "#dialogInformacao" ).jqxWindow("open");     
        $.post('../../Controller/DadosCadastrais/DadosCadastraisController.php',
            {
                method: 'UpdateDadosCadastrais',
                nmeCliente: $("#nmeCliente").val(),
                nroCNPJ: $("#nroCNPJ").val(),
                txtEndereco: $("#nroCNPJ").val(),
                nroTelefone: $("#nroTelefone").val(),
                codBanco: $("#codBanco").val(),
                nroAgencia: $("#nroAgencia").val(),
                nroContaCorrente: $("#nroContaCorrente").val(),
                vlrMulta: $("#vlrMulta").val(),
                vlrJuros: $("#vlrJuros").val()
            }, function(data){

            data = eval('('+data+')');
            if (data[0]){
                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                },"2000");
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar Menu!'+data[1]);
            }
        });
    });
});

function CarregaGridDadosCadastrais(){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Status Im&oacute;vel!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/DadosCadastrais/DadosCadastraisController.php',
           {
               method: 'ListarDadosCadastrais'
           },
           function(listaDadosCadastrais){
                listaDadosCadastrais = eval ('('+listaDadosCadastrais+')');
                if (listaDadosCadastrais[0]==true){
                    $("#nmeCliente").val(listaDadosCadastrais[1][0].NME_CLIENTE);
                    $("#nroCNPJ").val(listaDadosCadastrais[1][0].NRO_CNPJ);
                    $("#nroTelefone").val(listaDadosCadastrais[1][0].NRO_TELEFONE);
                    $("#txtEndereco").val(listaDadosCadastrais[1][0].TXT_ENDERECO);
                    CarregaComboBanco(listaDadosCadastrais[1][0].COD_BANCO);
                    $("#nroAgencia").val(listaDadosCadastrais[1][0].NRO_AGENCIA);
                    $("#nroContaCorrente").val(listaDadosCadastrais[1][0].NRO_CONTA_CORRENTE);
                    $("#vlrMulta").val(listaDadosCadastrais[1][0].VLR_MULTA);
                    $("#vlrJuros").val(listaDadosCadastrais[1][0].VLR_JUROS);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+listaDadosCadastrais[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function CarregaComboBanco(codBanco){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Combo!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Banco/BancoController.php',
           {
               method: 'ListarBanco'
           },
           function(ListarBanco){
                ListarBanco = eval ('('+ListarBanco+')');
                if (ListarBanco[0]==true){
                    MontaComboBanco(ListarBanco[1], codBanco);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarUf[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboBanco(ListarBanco, codBanco){    
    var source =
    {
        localdata: ListarBanco,
        datatype: "json",
        datafields:
        [
            { name: 'COD_BANCO', type: 'string' },
            { name: 'NME_BANCO', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);    
    $("#codBanco").jqxDropDownList(
    {
        source: dataAdapter,
        theme: theme,
        width: 200,
        height: 25,
        selectedIndex: -1,
        displayMember: 'NME_BANCO',
        valueMember: 'COD_BANCO'
    });  
    $("#codBanco").val(codBanco);
}
$(document).ready(function(){
    CarregaGridDadosCadastrais();
});

