
<script src="js/CadInformaPagamentoView.js"></script>      
<table width="100%" id="CadastroImovels">
    <tr>
        <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
          Informe de Pagamento
        </td>
    </tr>
    <tr>
        <td>
          <table id="codigo">
              <tr>
                  <td style="text-align:left;height:10%;font-size:14px;color:#000000;vertical-align:middle;font-family: arial, helvetica, serif;">
                      Data do Vencimento: <label id="dtaVencimento"></label>
                  </td>
              </tr>
              <tr>
                  <td style="text-align:left;height:10%;font-size:14px;color:#000000;vertical-align:middle;font-family: arial, helvetica, serif;">
                      Valor do Pagamento: <label id="vlrMensalidade"></label>
                  </td>
              </tr>
              <tr>
                  <td style="text-align:left;height:10%;font-size:14px;color:#000000;vertical-align:middle;font-family: arial, helvetica, serif;">
                      Nosso N&uacute;mero: <label id="nroNossoNumero"></label>
                  </td>
              </tr>
              <tr>
                  <td>
                      <div id="codTipoPagamento"></div>
                  </td>
              </tr>
          </table>
        </td>
    </tr>
    <tr>
        <td>
          <table id="codigo">
              <tr>
                  <td style="text-align:left;height:10%;font-size:14px;color:#000000;vertical-align:middle;font-family: arial, helvetica, serif;">
                      Data do Pagamento
                  </td>
              </tr>
              <tr>
                  <td>
                      <input type="text" id="dtaPagamento" size="10" class="inputFont14">
                  </td>
              </tr>
              <tr>
                  <td style="text-align:left;height:10%;font-size:14px;color:#000000;vertical-align:middle;font-family: arial, helvetica, serif;">
                      Valor do Pagamento
                  </td>
              </tr>
              <tr>
                  <td>
                      <input type="text" id="vlrPagamento" size="10" class="inputFont14">
                  </td>
              </tr>
              <tr>
                  <td style="text-align:left;height:10%;font-size:14px;color:#000000;vertical-align:middle;font-family: arial, helvetica, serif;">
                      Tipo de Pagamento
                  </td>
              </tr>
              <tr>
                  <td>
                      <div id="codTipoPagamento"></div>
                  </td>
              </tr>
          </table>
        </td>
    </tr>
    <tr>
        <td>
          <table id="codigo">
              <tr>
                  <td>
                      <input type="button" id="btnSalvarPagamento" value="Salvar">
                  </td>
                  <td>
                      <input type="button" id="btnEnviarEmailCliente" value="Enviar boleto por Email">
                  </td>
              </tr>              
          </table>            
        </td>
    </tr>  
</table> 
