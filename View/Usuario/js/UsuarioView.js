$(function() {  
    $( "#CadUsuarios" ).jqxWindow({
        autoOpen: false,
        height: 450,
        width: 650,
        theme: theme,
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        title: 'Cadastro de Usu&aacute;rios',
        isModal: true
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
    $("#btnNovo").click(function(){    
        LimparCampos();
        $("#CadUsuarios").jqxWindow("open");
    });   
});

function CarregaGridUsuario(){
    $("#tdGrid").html("");
    $("#tdGrid").html('<div id="listaUsuarios"></div>');    
    $('#listaUsuarios').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando grid!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");      
    $.post('../../Controller/Usuario/UsuarioController.php',
           {
               method: 'ListarUsuario'
           },
           function(listaUsuario){
                listaUsuario = eval ('('+listaUsuario+')');
                if (listaUsuario[0]){
                    MontaTabelaUsuario(listaUsuario[1]);
                }else{
                    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Erro ao listar Usu&aacute;rios! <br> "+listaUsuario[1]+"</h4>");                    
                }
           }
    );
}
function MontaTabelaUsuario(listaUsuario){
    var nomeGrid = 'listaUsuarios';    
    var source =
    {
        localdata: listaUsuario,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'COD_USUARIO', type: 'string' },
            { name: 'NME_USUARIO', type: 'string' },
            { name: 'NME_USUARIO_COMPLETO', type: 'string' },
            { name: 'TXT_EMAIL', type: 'string' },
            { name: 'COD_PERFIL_W', type: 'string' },
            { name: 'DSC_PERFIL_W', type: 'string' },
            { name: 'NRO_CPF', type: 'string' },
            { name: 'IND_ATIVO', type: 'string' },
            { name: 'ATIVO', type: 'boolean' },
            { name: 'COD_LOJA', type: 'string' },
            { name: 'COD_CLIENTE', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: 1000,
        source: dataAdapter,
        theme: theme,
        sortable: true,
        filterable: true,
        pageable: true,
        columnsresize: true,
        selectionmode: 'singlerow',
        columns: [
          { text: 'C&oacute;digo', columntype: 'textbox', datafield: 'COD_USUARIO', width: 80},
          { text: 'Login', datafield: 'NME_USUARIO', columntype: 'textbox', width: 180},
          { text: 'Nome', datafield: 'NME_USUARIO_COMPLETO', columntype: 'textbox', width: 180},
          { text: 'Email', datafield: 'TXT_EMAIL', columntype: 'textbox', width: 180},
          { text: 'Pefil', datafield: 'COD_PERFIL_W', columntype: 'textbox', width: 180},
          { text: 'Perfil', datafield: 'DSC_PERFIL_W', columntype: 'textbox', width: 180},
          { text: 'CPF', datafield: 'NRO_CPF', columntype: 'textbox', width: 180},
          { text: 'Ativo', datafield: 'ATIVO', columntype: 'checkbox', width: 67 }
        ]
    });
    // events
    $('#'+nomeGrid).jqxGrid('hidecolumn', 'COD_PERFIL_W');
    $('#'+nomeGrid).jqxGrid('hidecolumn', 'NRO_CPF');
    
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#'+nomeGrid).on('rowdoubleclick', function (event)
    {
        var args = event.args;
        var rows = $('#listaUsuarios').jqxGrid('getdisplayrows');
        var rowData = rows[args.visibleindex];
        var rowID = rowData.uid;        
        $("#codUsuario").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).COD_USUARIO);
        $("#nmeLogin").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).NME_USUARIO);
        $("#nmeUsuario").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).NME_USUARIO_COMPLETO);
        $("#txtEmail").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).TXT_EMAIL);
        $("#codPerfil").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).COD_PERFIL_W);
        $("#nroCpf").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).NRO_CPF);       
        $("#codCliente").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).COD_CLIENTE);
        CarregaLojas($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).COD_CLIENTE, $('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).COD_LOJA);        
        if ($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).IND_ATIVO=='S'){            
            $("#indAtivo").jqxCheckBox('check');
        }else{            
            $("#indAtivo").jqxCheckBox('uncheck');
        }
        $("#method").val("UpdateMenu");
        $("#CadUsuarios").jqxWindow("open");
    });    
    $("#dialogInformacao" ).jqxWindow("close");  
}

function LimparCampos(){
    $("#codUsuario").val('');
    $("#nmeLogin").val('');
    $("#nmeUsuario").val('');
    $("#txtEmail").val('');
    $("#codPerfil").val('0');
    $("#nroCpf").val('');
}
$(document).ready(function(){
    CarregaComboPerfil();
    CarregaGridUsuario();
});