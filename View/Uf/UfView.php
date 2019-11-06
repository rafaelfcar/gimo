<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
  <head>
      <title>Cadastro de Classifica&ccedil;&atilde;o</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="js/UfView.js"></script>

  </head>
  <body>
      <input type="hidden" id="method" name="method">
      <table width="100%" id="CadastroUf">
          <tr>
              <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
                  Cadastro de Unidades Federativas
              </td>
          </tr>
          <tr>
              <td>
                  <input type="button" id="btnNovo" value="Nova UF">
              </td>
          </tr>
          <tr>
              <td id='tdListaUf'>
                  <div id="listaUf"></div>
              </td>
          </tr>
      </table>
      <div id="CadUf">
            <div id="windowHeader">
            </div>
            <div style="overflow: hidden;" id="windowContent">
                <? include_once "CadUfView.php";?>
            </div>
      </div>
  </body>
</html>
