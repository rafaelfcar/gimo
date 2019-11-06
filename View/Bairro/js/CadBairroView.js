$(function(){ 
    $("#indAtivo").jqxCheckBox({ width: 120, height: 25, theme: theme });
    $("#sglUf").change(function(){
        MontaComboCidade($(this).val());
    });   
    $("#btnSalvar").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando Bairro!");
        $( "#dialogInformacao" ).jqxWindow("open"); 
        if ($.trim($("#nmeBairro").val())==''){
            $( "#dialogInformacao" ).jqxWindow('setContent', "Informe o nome do bairro por favor!");
            return;
        } 
        if ($("#indAtivo").jqxCheckBox('val')){
            ativo = 'S';
        }else{
            ativo = 'N';
        }  
        $.post('../../Controller/Bairro/BairroController.php',
            {method: $("#method").val(),
            codBairro: $("#codBairro").val(),            
            codCidade: $("#codCidade").val(),
            nmeBairro: $("#nmeBairro").val(),
            indAtivo: ativo}, function(data){

            data = eval('('+data+')');
            if (data[0]==1){
                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                CarregaGridBairro();
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    $( "#CadBairro" ).jqxWindow("close");
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
    $("#sglUf").change(function(){
        CarregaComboCidade($(this).val(), -1);
    });
}

function CarregaComboCidade(sglUf, codCidade){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Combo!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Cidade/CidadeController.php',
           {
               method: 'SelecionaCidades',
               sglUf: sglUf
           },
           function(ListarCidade){
                ListarCidade = eval ('('+ListarCidade+')');
                if (ListarCidade[0]==true){
                    MontaComboCidade(ListarCidade[1], codCidade);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarCidade[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboCidade(ListarCidade, codCidade){   
    $("#tdCidade").html('');
    $("#tdCidade").html('<div id="codCidade" class="comboUf"></div>');        
    var source =
    {
        localdata: ListarCidade,
        datatype: "json",
        datafields:
        [
            { name: 'COD_CIDADE', type: 'string' },
            { name: 'NME_CIDADE', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);    
    $("#codCidade").jqxDropDownList(
    {
        source: dataAdapter,
        theme: theme,
        width: 200,
        height: 25,
        selectedIndex: -1,
        displayMember: 'NME_CIDADE',
        valueMember: 'COD_CIDADE'
    });      
    $("#codCidade").val(codCidade);
}

$(document).ready(function(){
    CarregaComboUF('');
    $("input[type='button']").button(); 
});