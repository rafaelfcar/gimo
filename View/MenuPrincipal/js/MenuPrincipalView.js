$(function() {
    $( "#Menu" ).jqxWindow({
        autoOpen: true,
        theme: 'energyblue',
        width: $(window).width()-20,
        height: $(window).height()-20,
        position: 'center',
        title: 'AHC - Menu Principal',
        open: function(event, ui) {
            $(this).parents(".ui-dialog:first").find(".ui-dialog-titlebar-close").remove();
        }
    });
    
});
function CarregaNoticias(){
    $("#divNoticias").html("<span style='align:center;'>Aguarde, Carregando!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></span>");
    $.post('../../Controller/MenuPrincipal/MenuPrincipalController.php',
        {
            method: 'CarregaNoticias'
        },
        function(listaNoticias){
             listaNoticias = eval ('('+listaNoticias+')');
             if (listaNoticias[0]==true){
                 MontaTabelaNoticias(listaNoticias[1]);
             }else{
                 $( "#dialogInformacao" ).jqxWindow('setContent', "Erro ao buscar noticias!<br>"+listaNoticias[1]);
                 $( "#dialogInformacao" ).jqxWindow('open');
             }
        }
    );    
}

function CarregaAtalhos(){
    $("#divAtalhos").html("<span style='align:center;'>Aguarde, Carregando!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></span>");
    $.post('../../Controller/MenuPrincipal/MenuPrincipalController.php',
        {
            method: 'CarregaAtalhos'
        },
        function(listaAtalhos){
             listaAtalhos = eval ('('+listaAtalhos+')');
             if (listaAtalhos[0]==true){
                 MontaTabelaAtalhos(listaAtalhos[1]);
             }else{
                 $( "#dialogInformacao" ).jqxWindow('setContent', "Erro ao buscar atalhos!<br>"+listaAtalhos[1]);
                 $( "#dialogInformacao" ).jqxWindow('open');
             }
        }
    );
}

function MontaTabelaNoticias(listaNoticias){
    if (listaNoticias!=null){
        tabela = '<table width="100%">';
        for(i=0;i<listaNoticias.length;i++){
            tabela = tabela + '<tr><td style="font-size:20;font-family: arial, helvetica, serif;height:10%;">'+listaNoticias[i].DTA_NOTICIA+' - '+listaNoticias[i].DSC_TITULO+'</td></tr>';
            tabela = tabela + '<tr><td>'+listaNoticias[i].TXT_NOTICIA+'</td></tr>';
            tabela = tabela + '<tr><td style="border-bottom:1px solid #000000;"><br><br></td></tr>';
        }
        tabela = tabela + '</table>';
    }else{
        tabela = '';
    }
    $("#divNoticias").html(tabela);
}
function chamaAtalho(controller, method){    
    window.location.href = controller+'?method='+method;
}
function MontaTabelaAtalhos(listaAtalhos){
    if (listaAtalhos!=null){
        tabela = '<table width="100%" border="0">';
        colunas = 5;
        j=5;
        for(i=0;i<listaAtalhos.length;i++){
            if (j==colunas){
                tabela = tabela + "<tr style=''><td style='font-size:20;font-family: arial, helvetica, serif;height:10%;padding-top:20px;'>"
                j=0;
            }
            tabela = tabela + "<a style='padding-left:45px;' href='"+listaAtalhos[i].NME_CONTROLLER+"?method="+listaAtalhos[i].NME_METHOD+"'><img src='"+listaAtalhos[i].DSC_CAMINHO_IMAGEM+"' title='"+listaAtalhos[i].DSC_MENU_W+"' width='65' height='65'></a>";
            j++;
            if (j==colunas){
                tabela = tabela + "</td></tr>";
            }
        }
        tabela = tabela + '</table>';
    }else{
        tabela = '';
    }
    $("#divAtalhos").html(tabela);
}

$(document).ready(function() {
    CarregaNoticias();
    CarregaAtalhos();    
});
