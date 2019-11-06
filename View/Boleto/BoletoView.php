<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
  <head>
      <title>Cadastro de Classifica&ccedil;&atilde;o</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="js/BoletoView.js"></script>

  </head>
  <body>
      <input type="hidden" id="method" name="method">
      <input type="hidden" id="txtEmail" name="txtEmail">
      <input type="hidden" id="nmePessoa" name="nmePessoa">
      <table width="100%" id="CadastroBoleto">
          <tr>
              <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
                  Gera&ccedil;&atilde;o de Pagamento
              </td>
          </tr>
          <tr>
              <td><table>          
                    <tr>
                        <td>
                            Ano
                        </td>
                        <td>
                            M&ecirc;s
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id='nroAnoReferencia'></div>
                        </td>
                        <td>
                            <div id='nroMesReferencia'></div>
                        </td>
                    </tr> 
                  </table>
              </td>
          </tr>
          <tr>
              <td><table width="40%">          
                    <tr>
                        <td>
                            <input type="button" id="btnGerarBoleto" value="Gerar Pagamentos">
                        </td>
                        <td>
                            <input type="button" id="btnEnviarEmail" value="Enviar Boletos por email">
                        </td>
                    </tr>          
                  </table>
              </td>
          </tr>          
          <tr>
              <td>
                  <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
                    <div id="listaPagamentos">
                    </div>
                  </div>
              </td>
          </tr>
      </table>
    <div id="CadInformaPagamento">
        <div id="windowHeader">
        </div>
        <div style="overflow: hidden;" id="windowContent">
            <?  include_once "CadInformaPagamentoView.php";?>
        </div>
    </div>       
  </body>
</html>
