$(document).ready(function(){
 
    $("#CadImovel").jqxWindow({
        autoOpen: false,
        height: 350,
        width: 650,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Cadastro de Im&oacute;veis'
    });  
    $("#CadDetalhe").jqxWindow({
        autoOpen: false,
        height: 250,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Cadastro de Detalhes do Im&oacute;vel'
    });   
    $("#CadPessoa").jqxWindow({
        autoOpen: false,
        height: 450,
        width: 650,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Cadastro de Pessoas'
    });  
    $("#CadTransacaoImovel").jqxWindow({
        autoOpen: false,
        height: 450,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Alugar ou Vender'
    });     
    $("#HistoricoImovel").jqxWindow({
        autoOpen: false,
        height: 350,
        width: 650,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Hist&oacute;rico do Im&oacute;vel'
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
});