<script src="js/CadDetalheView.js"></script>
<form name="menuForm" enctype="multpart/form-data" id="CadDetalheForm" method="post" action="../../Controller/Seguranca/CadastroMenuController.php">    
    <input type="hidden" id="method" name="method">    
    <table>
        <tr>
            <td>Codigo</td>
        </tr>
        <tr>
            <td><input type="text" id="codDetalhe" size="10" readonly="true"></td>
        </tr>
        <tr>
            <td>Descri&ccedil;&atilde;o</td>
        </tr>
        <tr>
            <td><input type="text" id="dscDetalhe"></td>
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
