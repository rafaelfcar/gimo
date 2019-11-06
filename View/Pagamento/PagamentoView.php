<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
  <head>
    <title>Cadastro de Pagamentos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="js/PagamentoView.js"></script>

  </head>
  <body>
      <input type="hidden" id="method" name="method">
      <table width="100%" id="CadastroPagamentos">
          <tr>
              <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
                  Cadastro de Pagamentos
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
  </body>
</html>
