<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
  <head>
      <title>Cadastro de Classifica&ccedil;&atilde;o</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="js/DetalheView.js"></script>

  </head>
  <body>
      <input type="hidden" id="method" name="method">
      <table width="100%" id="CadastroDetalhe">
          <tr>
              <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
                  Cadastro de Detalhes
              </td>
          </tr>
          <tr>
              <td>
                  <input type="button" id="btnNovo" value="Novo Detalhe">
              </td>
          </tr>
          <tr>
              <td id='tdListaDetalhe'>
                  <div id="listaDetalhe"></div>
              </td>
          </tr>
      </table>
      <div id="CadDetalhe">
            <div id="windowHeader">
            </div>
            <div style="overflow: hidden;" id="windowContent">
                <? include_once "CadDetalheView.php";?>
            </div>
      </div>
  </body>
</html>
