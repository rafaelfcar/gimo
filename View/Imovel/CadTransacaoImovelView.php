<script src="js/CadTransacaoImovelView.js"></script>
<table width="100%">
<tr>
    <td>
        <table width="100%" cellpadding="0">
            <tr>
                <td>
                    Cliente
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" id="codPessoaTransacao">
                    <input type="text" id="nmePessoaTransacao" size="40"> 
                    <input type="button" value=". . ." id="btnCadPessoaTransacao">
                </td>
            </tr>    
            <tr>
                <td>
                    <table width="60%">              
                        <tr>
                            <td>
                                Valor
                            </td>     
                            <td class='hideVenda'>
                                Dia de Vencimento
                            </td>             
                        </tr>            
                        <tr>
                            <td>                    
                                <input type="text" id="vlrTransacaoImovel" >
                            </td>   
                            <td class='hideVenda'>                    
                                <input type="text" id="nroDiaVencimento" >
                            </td>             
                        </tr>    
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="60%">              
                        <tr>
                            <td>
                                Data de in&iacute;cio
                            </td>   
                            <td>
                                Data de t&eacute;rmino
                            </td>              
                        </tr>            
                        <tr>
                            <td >                    
                                <input type="text" id="dtaInicio" >
                            </td>  
                            <td >                    
                                <input type="text" id="dtaTermino" >
                            </td>               
                        </tr>    
                                                <tr>
                            <td class='cancelamento'>
                                Data de Cancelamento
                            </td>              
                        </tr>            
                        <tr>
                            <td >                    
                                <input type="text" id="dtaCancelamento" class='cancelamento'>
                            </td>                
                        </tr>  
                    </table>
                </td>
            </tr>          
        </table>
    </td>
</tr>
<tr>
    <td>
        <table width="100%">
        <tr>
            <td>
                <div id='jqxWidget'>
                    <div style='margin-top: 10px;' id='rbAluguel'>Aluguel</div>
                    <div style='margin-top: 10px;' id='rbVenda'>Venda</div>
                </div>
            </td>                 
        </tr>
        </table>
    </td>
</tr>    
<tr>
    <td>
        <table width="100%">
        <tr>
            <td>
                <input type="button" value="Salvar" id="btnSalvarTransacaoImovel">
            </td>                 
        </tr>
        </table>
    </td>
</tr>
</table>    

