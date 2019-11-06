<script src="js/CadCidadeView.js"></script>
<form name="menuForm" enctype="multpart/form-data" id="CadUfForm" method="post" action="../../Controller/Seguranca/CadastroMenuController.php">
    <input type="hidden" id="codCidade" name="codCidade">
    <input type="hidden" id="dscCaminhoImagem" name="dscCaminhoImagem">
    <table>
        <tr>
            <td>Cidade</td>
        </tr>
        <tr>
            <td><input type="text" id="nmeCidade" size="50"></td>
        </tr>
        <tr>
            <td>Estado</td>
        </tr>
        <tr>
            <td><div id="sglUf"></div></td>
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
