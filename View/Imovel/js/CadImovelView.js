$(function(){    
    $("#nroCep").mask('99.999-999');
    $("#vlrImovel").maskMoney({symbol:"R$ ",decimal:",",thousands:".", precision:2});
    $('#nmeProprietario').autocomplete({
        source:'../../Controller/Pessoa/PessoaController.php?method=ListarPessoaGrid',
        minLength:4,
        select: function(event, ui) {
            $("#codProprietario").val(ui.item.id);
            $('#nmeProprietario').val(ui.item.label);                        
        },
        search: function(){$(this).addClass('loading');},
        open: function(){$(this).removeClass('loading');}
    });     
    $("#btnDetalheImovel").click(function(){        
        $("#CadDetalhe").jqxWindow("open");
        $('#checkboxes').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
        CarregaListaDetalhes();
    });
    $("#btnCadPessoa").click(function(){ 
        $("#indPessoa").val('P');
        $("#CadPessoa").jqxWindow("open");                
    });     
    $("#btnHistoricoImovel").click(function(){         
        $("#HistoricoImovel").jqxWindow("open");
        CarregaHistoricoImovel();
    });        
    $("#btnTransacaoImovel").click(function(){        
        $("#vlrTransacaoImovel").val($("#vlrImovel").val());
        $(".cancelamento").hide();
        $("#CadTransacaoImovel").jqxWindow("open");                
    });  
    $("#btnCancelarTransacao").click(function(){
        $("#CadTransacaoImovel").jqxWindow("open");         
        CarregaUltimaTransacao();               
    });           
    $("#btnSalvarImovel").click(function(){
        $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, salvando registro! <br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
        $( "#dialogInformacao" ).jqxWindow("open");
        if ($("#codImovel").val()>0){
            method = 'UpdateImovel';
        }else{
            method = 'InsertImovel';
        }
        $.post('../../Controller/Imovel/ImovelController.php',
               {
                   method: method,
                   codImovel: $("#codImovel").val(),
                   txtEndereco: $("#txtEndereco").val(),
                   nroCep: $("#nroCep").val(),
                   codBairro: $("#codBairroImovel").val(),
                   codProprietario: $("#codProprietario").val(),
                   vlrImovel: $("#vlrImovel").val(),
                   vlrTamanho: $("#vlrTamanho").val()
               },
               function(result){        
                   result = eval ('('+result+')');                  
                    if (result[0]){
                        $("#codImovel").val(result[1]);
                        $("#btnDetalheImovel").show('slow');
                        $("#btnTransacaoImovel").show('slow');
                        setTimeout(function(){
                            
                            $( "#dialogInformacao" ).jqxWindow('setContent', "Registro Salvo com sucesso!");                            
                            $("#dialogInformacao").jqxWindow("close");
                            
                        },"2000");
                    }else{
                        $( "#dialogInformacao" ).jqxWindow('setContent', result[1]);
                    }
               }
        );
    });    
});

function CarregaUltimaTransacao(){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Combo!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Imovel/ImovelController.php',
           {
               method: 'CarregaUltimaTransacao',
               codImovel: $("#codImovel").val()
           },
           function(ListarUltimaTransacao){
                ListarUltimaTransacao = eval ('('+ListarUltimaTransacao+')');
                if (ListarUltimaTransacao[0]==true){
                    $("#codPessoaTransacao").val(ListarUltimaTransacao[1][0].COD_PESSOA);
                    $("#nmePessoaTransacao").val(ListarUltimaTransacao[1][0].NME_PESSOA);
                    $("#vlrTransacaoImovel").val(ListarUltimaTransacao[1][0].VLR_TRANSACAO);
                    $("#nroDiaVencimento").val(ListarUltimaTransacao[1][0].NRO_DIA_PAGAMENTO);
                    $("#dtaInicio").val(ListarUltimaTransacao[1][0].DTA_INICIO);
                    $("#dtaTermino").val(ListarUltimaTransacao[1][0].DTA_FIM);
                    $("#dtaCancelamento").val(ListarUltimaTransacao[1][0].DTA_CANCELAMENTO);
                    if(ListarUltimaTransacao[1][0].TIPO=='A'){
                        $('#rbAluguel').jqxRadioButton('checked');
                    }else{
                        $('#rbVenda').jqxRadioButton('checked');
                    }
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarUf[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}

function CarregaComboUFImovel(sglUf){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Combo!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Uf/UfController.php',
           {
               method: 'ListarUf'
           },
           function(ListarUf){
                ListarUf = eval ('('+ListarUf+')');
                if (ListarUf[0]==true){
                    MontaComboUfImovel(ListarUf[1], sglUf);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarUf[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboUfImovel(ListarUf, sglUf){ 
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
    $("#sglUfImovel").jqxDropDownList(
     {
         source: dataAdapter,
         theme: theme,
         width: 200,
         height: 25,
         selectedIndex: -1,
         displayMember: 'DSC_UF',
         valueMember: 'SGL_UF'
    });
    $("#sglUfImovel").val(sglUf);
    $("#sglUfImovel").change(function(){       
        CarregaComboCidadeImovel($(this).val(), -1);    
    });         
}

function CarregaComboCidadeImovel(sglUf, codCidade){ 
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
                    MontaComboCidadeImovel(ListarCidade[1], codCidade);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarCidade[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboCidadeImovel(ListarCidade, codCidade){  
    $("#tdCidadeImovel").html('');
    $("#tdCidadeImovel").html('<div id="codCidadeImovel" class="comboUf"></div>');   
    $("#tdBairroImovel").html('');
    $("#tdBairroImovel").html('<div id="codBairroImovel" class="comboUf"></div>');        
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
    $("#codCidadeImovel").jqxDropDownList(
    {
        source: dataAdapter,
        theme: theme,
        width: 200,
        height: 25,
        selectedIndex: -1,
        displayMember: 'NME_CIDADE',
        valueMember: 'COD_CIDADE'
    });      
    $("#codCidadeImovel").val(codCidade);
    $("#codCidadeImovel").change(function(){
        CarregaComboBairroImovel($(this).val(), -1);
    });       
}

function CarregaComboBairroImovel(codCidade, codBairro){
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
                    MontaComboBairroImovel(ListarBairro[1], codBairro);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+ListarBairro[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboBairroImovel(ListarBairro, codBairro){    
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
    $("#codBairroImovel").jqxDropDownList(
    {
        source: dataAdapter,
        theme: theme,
        width: 200,
        height: 25,
        selectedIndex: -1,
        displayMember: 'NME_BAIRRO',
        valueMember: 'COD_BAIRRO'
    });    
    $("#codBairroImovel").val(codBairro);
}