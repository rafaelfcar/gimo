
<script src="js/EnvioEmailPagamentoView.js"></script>

<input type="hidden" id="codLojaEmail">
<input type="hidden" id="dscLojaEmail">
<input type="hidden" id="dtaBoletoEmail">
<input type="hidden" id="txtEmailEmail">
<input type="hidden" id="nroBoletoEmail">
<table width="100%">
    <tr>
        <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
            Data para Pagamento
        </td>
    </tr>
    <tr>
        <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
            <input type="text" id="dtaPagamentoEmail">
        </td>
    </tr>
    <tr>
        <td>
            <input type="button" id="btnEnviaEmail" value="Enviar Email">
        </td>
    </tr>
    <tr>
        <td id='tdListaPagamentosLoja'>
            <div id="ListaPagamentosLoja"></div>
        </td>
    </tr>
</table>

