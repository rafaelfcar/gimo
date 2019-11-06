$(document).ready(function(){        
    $("#CadTransacaoImovel").jqxWindow({
        autoOpen: false,
        height: 550,
        width: 650,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Transa&ccedil;&atilde;o de Im&oacute;veis'
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
    $("#CadImovel").jqxWindow({
        autoOpen: false,
        height: 550,
        width: 650,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: true,
        title: 'Pesquisa de Im&oacute;veis'
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