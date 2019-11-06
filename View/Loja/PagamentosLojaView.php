
<script src="js/PagamentosLojaView.js"></script>
<input type="hidden" id="method" name="method">
<table width="100%">
    <tr>
        <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
            Pagamentos
        </td>
    </tr>
    <tr>
        <td id='tdListaPagamentosLoja'>
            <div id="ListaPagamentosLoja"></div>
        </td>
    </tr>
</table>
<div id="EnvioEmailPagamentoView">
      <div id="windowHeader">
      </div>
      <div style="overflow: hidden;" id="windowContent">
          <? include_once "EnvioEmailPagamentoView.php";?>
      </div>
</div> 
<div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
    <div id="MenuPagamentos" style="display:none;">
        <ul>
            <li>Visualizar Boleto</li>
            <li>Enviar por email</li>
        </ul>
    </div>   
</div>

