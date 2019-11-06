<script src="js/CadTipoPagamentoView.js"></script>
<form name="menuForm" enctype="multpart/form-data" id="CadUfForm" method="post" action="../../Controller/Seguranca/CadastroMenuController.php">
    <input type="hidden" id="codTipoPagamento" name="codTipoPagamento">
    <table>
        <tr>
            <td>Tipo de Pagamento</td>
        </tr>
        <tr>
            <td><input type="text" id="dscTipoPagamento" size="50"></td>
        </tr>
        <tr>
            <td>
                <div id="indAtivo"> Ativo</div>
            </td>
        </tr>       
        <tr>
            <td>
                <input type="button" id="btnSalvar" name="btnSalvar" value="Salvar">
            </td>
        </tr>
    </table>
</form>
