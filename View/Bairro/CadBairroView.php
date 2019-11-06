<script src="js/CadBairroView.js"></script>
<form name="menuForm" enctype="multpart/form-data" id="CadUfForm" method="post" action="../../Controller/Seguranca/CadastroMenuController.php">
    <input type="hidden" id="codBairro" name="codBairro">
    <input type="hidden" id="dscCaminhoImagem" name="dscCaminhoImagem">
    <table>
        <tr>
            <td>Bairro</td>
        </tr>
        <tr>
            <td><input type="text" id="nmeBairro" size="50"></td>
        </tr>
        <tr>
            <td>Estado</td>
        </tr>
        <tr>
            <td><div id="sglUf"></td>
        </tr>
        <tr>
            <td>Cidade</td>
        </tr>
        <tr>
            <td id="tdCidade"><div id="codCidade"></div></td>
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
