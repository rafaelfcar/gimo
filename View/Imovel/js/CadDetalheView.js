$(function() {
    $("#btnSalvarDetalhe").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando detalhes!");
        $( "#dialogInformacao" ).jqxWindow("open");        
        var checkBoxes = '';
        $.post('../../Controller/Detalhe/DetalheController.php',
            {method: 'ListarDetalhe'}, function(dados){

            dados = eval('('+dados+')');            
            data = dados[1];            
            if (data!=null){
                for (i=0;i<data.length;i++){                    
                    if ($("#chk"+data[i].COD_DETALHE).jqxCheckBox('val')){
                        checkBoxes += data[i].COD_DETALHE+';S|';
                    }else{
                        checkBoxes += data[i].COD_DETALHE+';N|';
                    }
                }
                $.post('../../Controller/Imovel/ImovelController.php',
                    {method: 'SalvarDetalhesImovel',
                    codImovel: $("#codImovel").val(),
                    C: checkBoxes}, function(data){

                    data = eval('('+data+')');
                    if (data[0]){
                        $( "#dialogInformacao" ).jqxWindow('setContent', "Detalhes Salvos!");
                    }else{
                        $( "#dialogInformacao" ).jqxWindow('setContent', "Erro: "+data[1]);
                    }
                });
            }
        });        
    });
});
function CarregaListaDetalhes(){
    $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, carregando lista de detalhes");
    $( "#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Detalhe/DetalheController.php',
        {method: 'ListarDetalheImovel',
        codImovel: $("#codImovel").val()}, function(data){

        data = eval('('+data+')');
        if (data[0]){
            if (data[1]!=null){
                ListaDetalhes(data[1]);
            }else{
                $("#checkboxes").html('Sem Dados');
                $( "#dialogInformacao" ).jqxWindow("close");
            }
        }
    });
}
function ListaDetalhes(ListaDetalhe){
    $("#checkboxes").html('');
    count=3;
    tabela = '';
    for(i=0;i<ListaDetalhe.length;i++){
        if (count==3){
            tabela += "<tr>";
            count=0;
        }       
        dscDetalhe = ListaDetalhe[i].DSC_DETALHE;        
        tabela += "<td width='400px'>";
        tabela += "<div id='chk"+ListaDetalhe[i].COD_DETALHE+"' style='margin-left: 10px; float: left;' class='check'><span>"+dscDetalhe+"</span></div><br>";
        tabela += "</td>";
        count++;
        if (count==3){
            tabela += "</tr>";
        }
    }
    $("#checkboxes").html(tabela);    
    $(".check").jqxCheckBox({ width: 120, height: 25, theme: theme });
    $('.check').jqxCheckBox('uncheck');
    for(i=0;i<ListaDetalhe.length;i++){        
        if (ListaDetalhe[i].COD_DETALHE_IMOVEL==null){            
            $("#chk"+ListaDetalhe[i].COD_DETALHE).jqxCheckBox('uncheck');
        }else{            
            $("#chk"+ListaDetalhe[i].COD_DETALHE).jqxCheckBox('check');
        }
    } 
    $( "#dialogInformacao" ).jqxWindow("close");
}