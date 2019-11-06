<form name="menuForm" enctype="multpart/form-data" id="CadClienteForm" method="post" action="../../Controller/Seguranca/CadastroMenuController.php">
    <input type="hidden" id="codCliente" name="codCliente">
    <input type="hidden" id="method" name="method">
    <input type="hidden" id="dscCaminhoImagem" name="dscCaminhoImagem">
    <table>
        <tr>
            <td>Nome</td>
        </tr>
        <tr>
            <td><input type="text" id="nmeCliente" size="50"></td>
        </tr>
        <tr>
            <td>CNPJ</td>
        </tr>
        <tr>
            <td><input type="text" id="nroCnpj"></td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" id="indAtivo" name="indAtivo"> Ativo
            </td>
        </tr>
        <tr>
            <td>
                <input type="button" id="btnSalvar" name="btnSalvar" value="Salvar">
            </td>
        </tr>
    </table>
    Selecione o arquivo:<br>
    <input type="file" name="arquivo" id="imagem" size="45" />
    <br />
    <progress value="0" max="100"></progress>
    <span id="porcentagem">0%</span>
    <br />    
</form>
