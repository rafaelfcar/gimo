<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
  <head>
      <title>Cadastro de DadosCadastraiss</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="js/DadosCadastraisView.js"></script>

  </head>
  <body>
      <input type="hidden" id="method" name="method">
      <table width="100%" id="CadastroDadosCadastrais">
          <tr>
              <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
                  Atualiza&ccedil;&atilde;o de Dados Cadastrais
              </td>
          </tr>
          <tr>
              <td>
                  Nome
              </td>
          </tr>          
          <tr>
              <td>
                  <input type="text" id="nmeCliente" size="60">
              </td>
          </tr>
          <tr>
              <td>
                  <table>
                    <tr>
                        <td>
                            CNPJ
                        </td>
                        <td>
                            Telefone
                        </td>
                    </tr>          
                    <tr>
                        <td>
                            <input type="text" id="nroCNPJ" size="20">
                        </td>
                        <td>
                            <input type="text" id="nroTelefone" size="20">
                        </td>
                    </tr>
                  </table>
              </td>
          </tr>  
          <tr>
              <td>
                  <table>
                    <tr>
                        <td>
                            Endere&ccedil;o
                        </td>
                    </tr>          
                    <tr>
                        <td>
                            <input type="text" id="txtEndereco" size="60">
                        </td>
                    </tr>
                  </table>
              </td>
          </tr>   
          <tr>
              <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
                  Dados para a gera&ccedil;&atilde;o de boletos
              </td>
          </tr>          
          <tr>
              <td>
                  <table>
                    <tr>
                        <td>
                            Banco
                        </td>
                        <td>
                            Ag&ecirc;ncia
                        </td>
                        <td>
                            Conta Corrente
                        </td>
                    </tr>          
                    <tr>
                        <td>
                            <div id="codBanco"></div>
                        </td>
                        <td>
                            <input type="text" id="nroAgencia" size="20">
                        </td>
                        <td>
                            <input type="text" id="nroContaCorrente" size="20">
                        </td>
                    </tr>
                  </table>
              </td>
          </tr>    
          <tr>
              <td>
                  <table>
                    <tr>
                        <td>
                            Valor da Multa (em R$)
                        </td>
                        <td>
                            Valor dos Juros (em %)
                        </td>
                    </tr>          
                    <tr>
                        <td>
                            <input type="text" id="vlrMulta" size="20">
                        </td>
                        <td>
                            <input type="text" id="vlrJuros" size="20">
                        </td>
                    </tr>
                  </table>
              </td>
          </tr>              
          <tr>
              <td>
                  <table>         
                    <tr>
                        <td>
                            <input type="button" id="btnSalvar" value="Salvar">
                        </td>
                    </tr>
                  </table>
              </td>
          </tr>           
      </table>
  </body>
</html>
