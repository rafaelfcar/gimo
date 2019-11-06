$(function(){
    $("#btnPagamentoLoja").click(function(){
        CarregaGridPagamentos();
        $("#PagamentosLojaView").jqxWindow("open");
    });  
    $("#btnGerarPagamento").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando loja!");
        $( "#dialogInformacao" ).jqxWindow("open");
        $.post('../../Controller/Loja/LojaController.php',
            {method: 'GerarPagamento',
            codLoja: $("#codLoja").val()}, function(data){

            data = eval('('+data+')');
            if (data[0]==1){
                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");                
                setTimeout(function(){                    
                    $( "#CadMenus" ).jqxWindow("close");
                },"2000");
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar registro!<br>'+data[1]);
            }
        });
    });          
    $("#btnSalvar").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando loja!");
        $( "#dialogInformacao" ).jqxWindow("open");
        if ($('#codLoja').val()==0){
            method = 'InsertLoja';
        }else{
            method = 'UpdateLoja';
        }		
        if ($("#indAtiva").is(":checked")){
            var indAtiva = 'S';
        }else{
            var indAtiva = 'N';
        }
        if ($("#indCentral").is(":checked")){
            var indCentral = 'S';
        }else{
            var indCentral = 'N';
        }		
        arquivo='';
        $.post('../../Controller/Loja/LojaController.php',
            {method: method,
            codLoja: $("#codLoja").val(),
            nmeLoja: $("#nmeLoja").val(),
            nroCep: $("#nroCep").val(),
            txtEndereco: $("#txtEndereco").val(),
            txtBairro: $("#txtBairro").val(),
            txtComplemento: $("#txtComplemento").val(),
            sglUF: $("#sglUF").val(),
            codCliente: $("#codCliente").val(),
            nroDiaPagamento: $("#nroDiaPagamento").val(),
            vlrMensalidade: $("#vlrMensalidade").val(),
            nroCnpj: $("#nroCnpj").val(),
            indCentral: indCentral,
            indAtiva: indAtiva}, function(data){

            data = eval('('+data+')');
            if (data[0]==1){
                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                CarregaGridLoja();
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    $( "#CadMenus" ).jqxWindow("close");
                },"2000");
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar registro!'+data[1]);
            }
        });        
    });
});

function CarregaComboCliente(){
    $.post('../../Controller/Usuario/UsuarioController.php',
           {
               method: 'ListaDadosUsuario'
           },
           function(ListaDadosUsuario){
                ListaDadosUsuario = eval ('('+ListaDadosUsuario+')');
                if (ListaDadosUsuario[0]){
                    MontaComboDadosUsuario(ListaDadosUsuario[1]);
                }else{
                    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Erro ao listar Imobili&aacute;rias! <br> "+listaUsuario[1]+"</h4>");                    
                }
           }
    );
}

function MontaComboDadosUsuario(ListaDadosUsuario){
    var source =
    {
        localdata: ListaDadosUsuario,
        datatype: "json",
        datafields:
        [
            { name: 'COD_CLIENTE', type: 'string' },
            { name: 'NME_CLIENTE', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);    
    $("#codCliente").jqxDropDownList(
    {
        source: dataAdapter,
        theme: theme,
        width: 200,
        height: 25,
        selectedIndex: 0,
        displayMember: 'NME_CLIENTE',
        valueMember: 'COD_CLIENTE'
    }); 
}

$(document).ready(function(){
   CarregaComboCliente(); 
});