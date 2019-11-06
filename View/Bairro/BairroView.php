<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
  <head>
      <title>Cadastro de Bairros</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="js/BairroView.js"></script>

  </head>
  <body>
      <input type="hidden" id="method" name="method">
      <table width="100%" id="CadastroBairro">
          <tr>
              <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
                  Cadastro de Bairros
              </td>
          </tr>
          <tr>
              <td>
                  <input type="button" id="btnNovo" value="Novo Bairro">
              </td>
          </tr>
          <tr>
              <td id='tdListaBairro'>
                  <div id="listaBairro"></div>
              </td>
          </tr>
      </table>
      <div id="CadBairro">
            <div id="windowHeader">
            </div>
            <div style="overflow: hidden;" id="windowContent">
                <? include_once "CadBairroView.php";?>
            </div>
      </div>
  </body>
</html>
