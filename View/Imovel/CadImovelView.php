<script src="js/CadImovelView.js"></script>
<input type="hidden" id="habilitaChange">
<table width="100%">
<tr>
    <td>
        <table width="100%" cellpadding="2">
        <tr>
            <td>
                <table width="60%">                   
                <tr>
                    <td class="labelFont12">
                        C&oacute;digo (autom&aacute;tico):
                    </td>
                </tr>
                <tr>
                    <td >
                        <input type="text" style="border: 0px;" id="codImovel" readonly="true" class="inputFont14">
                    </td>
                </tr>
                </table>
            </td>              
        </tr>                      
        <tr>
            <td class="labelFont12">
                Propriet&aacute;rio
            </td>
        </tr>
        <tr>
            <td >
                <input type="hidden" id="codProprietario">
                <input type="text" id="nmeProprietario" class="inputFont14" size='40'> 
                <input type="button" value=". . ." id="btnCadPessoa">
            </td>
        </tr>    
        <tr>
            <td>
                <table width="60%">              
                    <tr>
                        <td class="labelFont12">
                            Valor
                        </td>
                        <td class="labelFont12">
                            Tamanho do Im&oacute;vel (em M)
                        </td>                
                    </tr>            
                    <tr>
                        <td >                    
                            <input type="text" id="vlrImovel" class="inputFont14">
                        </td>
                        <td >                    
                            <input type="text" id="vlrTamanho" class="inputFont14">
                        </td>                
                    </tr>    
                </table>
            </td>
        </tr>                            
        <tr>
            <td>
                <table width="60%">            
                <tr>
                    <td class="labelFont12">Endere&ccedil;o:</td>
                    <td class="labelFont12">CEP:</td>
                </tr>
                <tr>
                    <td width="50%"><input type="text" id="txtEndereco" size="50" class="inputFont14"></td>
                    <td width="50%"><input type="text" id="nroCep" size="10" class="inputFont14"></td>
                </tr>
                </table>                     
            </td>
        </tr>           
        <tr>
            <td>
                <table width="60%">
                <tr>
                    <td>Estado</td>
                    <td>Cidade</td>
                    <td>Bairro</td>
                </tr>
                <tr>                       
                    <input type="hidden" id="ufImovel">
                    <input type="hidden" id="cidadeImovel">
                    <input type="hidden" id="bairroImovel">
                    <td id="tdUfImovel"><div id="sglUfImovel" class="comboUf"></div></td>
                    <td id="tdCidadeImovel"><div id="codCidadeImovel" class="comboCidade"></div></td>
                    <td id="tdBairroImovel"><div id="codBairroImovel" class="comboBairro"></div></td>                        
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
                <input type="button" value="Salvar" id="btnSalvarImovel">
            </td>
            <td>
                <input type="button" value="Detalhes" id="btnDetalheImovel">
            </td>
            <td>
                <input type="button" value="Hist&oacute;rico" id="btnHistoricoImovel">
            </td>                 
        </tr>
        </table>
    </td>
</tr>  
</table>    
<div id="CadPessoa">
      <div id="windowHeader">
      </div>
      <div style="overflow: hidden;" id="windowContent">
          <? include_once "CadPessoaView.php";?>
      </div>
</div> 
<div id="HistoricoImovel">
      <div id="windowHeader">
      </div>
      <div style="overflow: hidden;" id="windowContent">
          <? include_once "HistoricoImovelView.php";?>
      </div>
</div> 
<div id="CadDetalhe">
    <div id="windowHeader">
    </div>
    <div style="overflow: auto;" id="windowContent">
        <? include_once "CadDetalheView.php";?>
    </div>
</div> 
<div id="CadTransacaoImovel">
      <div id="windowHeader">
      </div>
      <div style="overflow: auto;" id="windowContent">
          <? include_once "CadTransacaoImovelView.php";?>
      </div>
</div> 