<script src="js/CadLojaView.js"></script>
<form name="menuForm" id="CadLojaForm" method="post">
    <input type="hidden" id="codLoja" name="codLoja">
    <input type="hidden" id="method" name="method">
    <input type="hidden" id="dscCaminhoImagem" name="dscCaminhoImagem">
    <table>
        <tr>
            <td>Nome</td>
            <td>Cliente</td>
        </tr>
        <tr>
            <td><input type="text" id="nmeLoja" size="50"></td>
            <td >
                <div id='codCliente'></div>
            </td>            
        </tr>
        <tr>
            <td>CEP</td>
            <td>Endere&ccedil;o</td>
        </tr>
        <tr>
            <td><input type="text" id="nroCep"></td>
            <td><input type="text" id="txtEndereco" size="50"></td>
        </tr>   
        <tr>
            <td>Bairro</td>
            <td>Complemento</td>
        </tr>
        <tr>
            <td><input type="text" id="txtBairro"></td>
            <td><input type="text" id="txtComplemento"></td>
        </tr> 
        <tr>
            <td>UF</td>
        </tr>
        <tr>
            <td><input type="text" id="sglUF"></td>
        </tr>  
        <tr>
            <td>Dia de Pagamento</td>
            <td>Valor</td>
        </tr>
        <tr>
            <td><input type="text" id="nroDiaPagamento"></td>
            <td><input type="text" id="vlrMensalidade"></td>
        </tr>         
        <tr>
            <td>CNPJ</td>
        </tr>
        <tr>
            <td><input type="text" id="nroCnpj"></td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" id="indCentral" name="indCentral"> Central
            </td>
            <td>
                <input type="checkbox" id="indAtiva" name="indAtiva"> Ativa
            </td>
        </tr>        
        <tr>
            <td>
                <input type="button" id="btnSalvar" name="btnSalvar" value="Salvar">
            </td>
            <td>
                <input type="button" id="btnPagamentoLoja" name="btnPagamentoLoja" value="Pagamentos">
            </td>            
            <td>
                <input type="button" id="btnGerarPagamento" name="btnGerarPagamento" value="Gerar Pagamentos">
            </td>                        
        </tr>
    </table>   
</form>
<div id="PagamentosLojaView">
      <div id="windowHeader">
      </div>
      <div style="overflow: hidden;" id="windowContent">
          <? include_once "PagamentosLojaView.php";?>
      </div>
</div>
