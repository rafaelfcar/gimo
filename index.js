$(function() {
    valor = '{x:'+$(window).width/2+', y:'+$(window).heigth/2+'}';
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
    $("#CadastroForm").jqxWindow({
        autoOpen: true,
        height: 150,
        width: 350,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        isModal: false,
        title: 'Login - Sistema GIMO'
    });
    $(".login").keyup(function(event){
        if (event.keyCode==13){
            $("#btnLogin").click();
        }
    }); 
    $("#btnLogin").jqxButton({ width: '100', theme: 'energyblue' });
    $("#btnLogin").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, efetuando Login!");
        $( "#dialogInformacao" ).jqxWindow("open");        
        $.post('Controller/Login/LoginController.php',
               {
                   method: 'Logar',
                   nmeLogin: $("#nmeLogin").val(),
                   txtSenha: $("#txtSenha").val()
               },
               function(logar){
                    logar = eval ('('+logar+')');
                    if (logar[0]==true){
                        window.location.href=logar[1][0]['DSC_PAGINA'];
                    }else{
                        $( "#dialogInformacao" ).jqxWindow('setContent', "Usu&aacute;rio ou senha inv&aacute;lido!");                        
                    }
               }
        );
    });

});
$(document).ready(function(){
    $("#nmeLogin").focus();
});