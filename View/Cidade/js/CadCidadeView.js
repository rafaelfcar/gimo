$(function(){  
    $("#indAtivo").jqxCheckBox({ width: 120, height: 25, theme: theme });
    $("#btnSalvar").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando Cidade!");
        $( "#dialogInformacao" ).jqxWindow("open");    
        if ($.trim($("#nmeCidade").val())==''){
            $( "#dialogInformacao" ).jqxWindow('setContent', "Informe o nome da cidade por favor!");
            return;
        } 
        if ($("#indAtivo").jqxCheckBox('val')){
            ativo = 'S';
        }else{
            ativo = 'N';
        }       
        $.post('../../Controller/Cidade/CidadeController.php',
            {method: $("#method").val(),
            codCidade: $("#codCidade").val(),
            sglUf: $("#sglUf").val(),
            indAtivo: ativo,
            nmeCidade: $("#nmeCidade").val()}, function(data){

            data = eval('('+data+')');
            if (data[0]==1){
                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                CarregaGridCidade();
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    $( "#CadCidade" ).jqxWindow("close");
                },"2000");
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar Menu!'+data[1]);
            }
        });
    });
});

function CarregaComboUF(sglUf){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Combo!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Uf/UfController.php',
           {
               method: 'ListarUf'
           },
           function(ListarUf){
                ListarUf = eval ('('+ListarUf+')');
                if (ListarUf[0]==true){
                    MontaComboUf(ListarUf[1], sglUf);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarUf[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboUf(ListarUf, sglUf){ 
    $("#tdUf").html('');
    $("#tdUf").html('<div id="sglUf" class="comboUf"></div>');    
    var source =
    {
        localdata: ListarUf,
        datatype: "json",
        datafields:
        [
            { name: 'SGL_UF', type: 'string' },
            { name: 'DSC_UF', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);    
    $("#sglUf").jqxDropDownList(
     {
         source: dataAdapter,
         theme: theme,
         width: 200,
         height: 25,
         selectedIndex: -1,
         displayMember: 'DSC_UF',
         valueMember: 'SGL_UF'
    });
    $("#sglUf").val(sglUf); 
}
$(document).ready(function(){
    CarregaComboUF('');
    $("input[type='button']").button(); 
});

