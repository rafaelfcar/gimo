<form name="menuForm" enctype="multpart/form-data" id="CadUfForm" method="post" action="../../Controller/Seguranca/CadastroMenuController.php">
    <input type="hidden" id="sglUfAnt" name="sglUfAnt">
    <input type="hidden" id="method" name="method">
    <input type="hidden" id="dscCaminhoImagem" name="dscCaminhoImagem">
    <table>
        <tr>
            <td>Sigla</td>
        </tr>
        <tr>
            <td><input type="text" id="sglUf" size="10"></td>
        </tr>
        <tr>
            <td>Estado</td>
        </tr>
        <tr>
            <td><input type="text" id="dscUf"></td>
        </tr>
        <tr>
            <td>
                <input type="button" id="btnSalvar" name="btnSalvar" value="Salvar">
            </td>
        </tr>
    </table>
</form>
