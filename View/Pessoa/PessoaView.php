<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
  <head>
    <title>Cadastro de Pessoas</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="js/PessoaView.js"></script>

  </head>
  <body>
      <input type="hidden" id="method" name="method">
      <table width="100%" id="CadastroPessoas">
          <tr>
              <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
                  Cadastro de Pessoas
              </td>
          </tr>
          <tr>
              <td>
                  <input type="button" id="btnNovo" value="Novo">
              </td>
          </tr>
          <tr>
              <td>
                  <table>
                      <tr>
                          <td style="text-align:left;height:10%;font-size:14px;color:#000000;vertical-align:middle;font-family: arial, helvetica, serif;">
                              Digite alguma parte do nome para a pesquisa:
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <input type="text" id="txtPesquisa" size="30" class="inputFont14">
                          </td>
                          <td>
                              <input type="button" id="btnPesquisaPessoa" value="Pesquisar Pessoa">
                          </td>
                      </tr>
                  </table>
              </td>
          </tr>
          <tr>
              <td>
                  <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
                    <div id="listaPessoas">
                    </div>
                  </div>
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
  </body>
</html>
