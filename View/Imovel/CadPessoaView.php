<script src="js/CadPessoaView.js"></script>
    <table width="100%">
    <tr>
        <td>
            <table width="100%" cellpadding="2">
            <tr>
                <td class="labelFont12">
                    C&oacute;digo (autom&aacute;tico):
                </td>
            </tr>
            <tr>
                <td >
                    <input type="text" style="border: 0px;" id="codPessoa" readonly="true" class="inputFont14">
                </td>
            </tr>
            <tr>
                <td class="labelFont12" colspan="2">
                    Nome:
                </td>
            </tr>
            <tr>
                <td width="50%" colspan="2">
                    <input type="text" id="nmePessoa" size="50" class="inputFont14">
                </td>
            </tr>
            <tr>
                <td class="labelFont12">
                    CPF:
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <input type="text" id="nroCpf" size="15" class="inputFont14">
                </td>
            </tr>
            <tr>
                <td>
                    <table width="60%">            
                    <tr>
                        <td class="labelFont12">Endere&ccedil;o:</td>
                        <td class="labelFont12">CEP:</td>
                    </tr>
                    <tr>
                        <td width="50%"><input type="text" id="txtEndereco" size="50" class="inputFont14"></td>
                        <td width="50%"><input type="text" id="nroCep" size="10" class="inputFont14"></td>
                    </tr>
                    </table>                     
                </td>
            </tr>           
            <tr>
                <td>
                    <table width="60%">
                    <tr>
                        <td>Estado</td>
                        <td>Cidade</td>
                        <td>Bairro</td>
                    </tr>
                    <tr>               
                    <input type="hidden" id="uf">
                    <input type="hidden" id="cidade">
                    <input type="hidden" id="bairro">          
                        <td id="tdUf"><div id="sglUf"></div></td>
                        <td id="tdCidade"><div id="codCidade"></div></td>
                        <td id="tdBairro"><div id="codBairro"></div></td>                        
                    </tr> 
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="80%">
                    <tr>
                        <td width="30%">RG</td>
                        <td width="30%">&Oacute;rg&atilde;o Expedidor</td>
                        <td width="40%">UF &Oacute;rg&atilde;o Expedidor</td>
                    </tr>
                    <tr>
                        <td width="30%"><input type="text" id="nroRg" size="20" class="inputFont14"></td>
                        <td width="30%"><input type="text" id="txtOrgaoExpedidor" size="10" class="inputFont14"></td> 
                        <td width="40%"><select name="sglUfOrgaoExpedidor" id="sglUfOrgaoExpedidor">
                                <?$listarUf = unserialize(urldecode($_POST['listaUf']));
                                $listaUf = $listarUf[1];
                                for($i=0;$i<count($listaUf);$i++){
                                    echo "<option value=\"".$listaUf[$i]['SGL_UF']."\">".$listaUf[$i]['DSC_UF']."</option>";
                                }
                                ?>
                                </select></td>                       
                    </tr> 
                    </table>
                </td>
            </tr>      
            <tr>
                <td class="labelFont12" colspan="2">
                    Email:
                </td>
            </tr>
            <tr>
                <td width="50%" colspan="2">
                    <input type="text" id="txtEmail" size="50" class="inputFont14">
                </td>
            </tr>            
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%">
            <tr>
                <td>
                    <input type="button" value="Salvar" id="btnSalvarPessoa">
                </td>
            </tr>
            </table>
        </td>
    </tr>
    </table>
