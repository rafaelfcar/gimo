$(function(){
    $("#nroCpf").mask('999.999.999-99');
    $("#nroCep").mask('99.999-999'); 
    $("#nroCpf").blur(function(){
       if ((!valCpf($("#nroCpf").val()))&&($("#nroCpf").val()!='')){
            $( "#dialogInformacao" ).jqxWindow('setContent', "<h4 style='text-align:center;'>CPF Inv&aacute;lido!</h4>");
            $( "#dialogInformacao" ).jqxWindow("open");    
            $("#nroCpf").focus();
        }
    });       
    $("#btnSalvarPessoa").click(function(){
        $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, salvando registro! <br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
        $( "#dialogInformacao" ).jqxWindow("open");
        if ($("#codPessoa").val()>0){
            method = 'UpdatePessoa';
        }else{
            method = 'InsertPessoa';
        }        
        if (($("#codBairro").val()==null) || ($("#codBairro").val()=='' || $("#codBairro").val()=='null')){
            codBairro='NULL';
        }else{
            codBairro = $("#codBairro").val();
        }
        $.post('../../Controller/Pessoa/PessoaController.php',
               {
                   method: method,
                   codPessoa: $("#codPessoa").val(),
                   nmePessoa: $("#nmePessoa").val(),
                   nroCpf: $("#nroCpf").val(),
                   txtEndereco: $("#txtEndereco").val(),
                   nroCep: $("#nroCep").val(),
                   codBairro: codBairro,
                   nroRg: $("#nroRg").val(),
                   txtOrgaoExpedidor: $("#txtOrgaoExpedidor").val(),
                   sglUfOrgaoExpedidor: $("#sglUfOrgaoExpedidor").val(),
                   txtEmail: $("#txtEmail").val()
               },
               function(result){        
                   result = eval ('('+result+')');
                    if (result[0]==true){
                        if ($("#indPessoa").val()=='P'){
                            $("#nmeProprietario").val($("#nmePessoa").val());
                            $("#codProprietario").val(result[1]);
                        }else{
                            $("#nmePessoaTransacao").val($("#nmePessoa").val());
                            $("#codPessoaTransacao").val(result[1]);
                        }
                        setTimeout(function(){
                            
                            $( "#dialogInformacao" ).jqxWindow('setContent', "Registro Salvo com sucesso!");                            
                            $("#dialogInformacao").jqxWindow("close");
                            $("#CadPessoa").jqxWindow("close");
                            
                        },"2000");
                    }else{
                        $( "#dialogInformacao" ).jqxWindow('setContent', result);
                    }
               }
        );
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
    $("#tdBairro").html('');
    $("#tdBairro").html('<div id="codBairro" class="comboUf"></div>');        
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
    $("#codCidade").change(function(){
        CarregaComboBairro($(this).val(), -1);
    });
}

function CarregaComboBairro(codCidade, codBairro){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Combo!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Bairro/BairroController.php',
           {
               method: 'SelecionaBairro',
               codCidade: codCidade
           },
           function(ListarBairro){
                ListarBairro = eval ('('+ListarBairro+')');
                if (ListarBairro[0]==true){
                    MontaComboBairro(ListarBairro[1], codBairro);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarBairro[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboBairro(ListarBairro, codBairro){    
    var source =
    {
        localdata: ListarBairro,
        datatype: "json",
        datafields:
        [
            { name: 'COD_BAIRRO', type: 'string' },
            { name: 'NME_BAIRRO', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);    
    $("#codBairro").jqxDropDownList(
    {
        source: dataAdapter,
        theme: theme,
        width: 200,
        height: 25,
        selectedIndex: -1,
        displayMember: 'NME_BAIRRO',
        valueMember: 'COD_BAIRRO'
    });    
    $("#codBairro").val(codBairro);
}
function valCpf(c){ 
    var Soma; 
    var Resto; 
    Soma = 0; 
    var strCPF;
    strCPF = c.replace(".","");
    strCPF = strCPF.replace(".","");
    cpf = strCPF.replace("-","");
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
          return false;
    for (i = 0; i < cpf.length - 1; i++)
          if (cpf.charAt(i) != cpf.charAt(i + 1))
                {
                digitos_iguais = 0;
                break;
                }
    if (!digitos_iguais){
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
              soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
              return false;
        numeros = cpf.substring(0,10);
        soma = 0;
        for (i = 11; i > 1; i--)
              soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
              return false;
        return true;
    }else{
        return false;
    }
}