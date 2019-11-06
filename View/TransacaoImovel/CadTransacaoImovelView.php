<html>
    <body>  
<script src="js/CadTransacaoImovelView.js"></script>
<table width="100%">
      <tr>
          <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
              Transa&ccedil;&atilde;o de Im&oacute;veis
          </td>
      </tr> 

<tr>
    <td>
        <table width="5%">
        <tr>
            <td>
                <div style='margin-top: 10px;' id='rbAluguel'>Aluguel</div>
            </td>
            <td>
                <div style='margin-top: 10px;' id='rbVenda'>Venda</div>
            </td>                 
        </tr>
        </table>
    </td>
</tr>       
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
                   C&oacute;digo do Im&oacute;vel
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="codImovel" size="10" readonly="readonly"> 
                    <input type="button" value="Localizar Im&oacute;vel" id="btnCadImovel">
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
                <input type="button" value="Salvar" id="btnSalvarTransacaoImovel">
            </td>                 
        </tr>
        </table>
    </td>
</tr>
<tr>
    <td>
        <div id="CadImovel">
            <div id="windowHeader">
            </div>
            <div style="overflow: hidden;" id="windowContent">
                <?  include_once "CadImovelView.php";?>
            </div>
        </div>
    </td>
</tr>
</table>  
<div id="CadPessoa">
      <div id="windowHeader">
      </div>
      <div style="overflow: hidden;" id="windowContent">
          <? include_once "../Pessoa/CadPessoaView.php";?>
      </div>
</div>   
</body>
</html>