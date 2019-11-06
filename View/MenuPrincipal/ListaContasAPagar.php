<?$listaContas = unserialize(urldecode($_POST['ListaContas']));
if (count($listaContas)>0 && $listaContas!=''){?>
    <table width="30%" class="TabelaCabecalho">
        <tr>
            <td class="TDTitulo">
                Lista de contas a pagar hoje
            </td>
        </tr>
    </table>
    <table width="30%" class="TabelaCabecalho" cellspacing="0">
        <tr>
            <td>
                &nbsp;
            </td>
            <td class="TDTitulo">
                Descrição
            </td>
            <td class="TDTitulo">
                Valor
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <?
        $corLinha="white";
        for($i=0;$i<count($listaContas);$i++){
            if ($corLinha=="white"){
                $corLinha="E8E8E8";
            }else{
                $corLinha="white";
            }?>
        <tr bgcolor="<?echo $corLinha?>" class="trcor" id="trcor" >
            <td><input type="checkbox" name="indPagar" value="<?echo$listaContas[$i]['COD_PAGAMENTO']?>" checked></td>
            <td><?echo $listaContas[$i]['DSC_PAGAMENTO'];?></td>
            <td><?echo number_format($listaContas[$i]['VLR_PAGAMENTO'],2,',','.');?></td>
            <td><a href="#"><img src="../../Resources/images/visto.png" width="20" height="20" title="Pagar esta conta"></a></td>
        </tr>
        <?}?>
    </table>
    <table width="30%" class="TabelaCabecalho">
        <tr>
            <td class="TDTitulo">
                <input type="button" value="Informar o pagamento das contas selecionadas" id="btnClicar">
            </td>
        </tr>
    </table>
<?}?>
