<?
if (!isset($_SESSION)){
    session_start();
}
?>
<?
$rs_usuario = $_SESSION['DadosUsuario'];
?>
<div id="cabecalho">
    <table width="100%" align="left">
        <tr>
            <td align="left" rowspan="2" style="text-align:left;height:10%;font-size:14px;color:#0150D3;vertical-align:middle;font-family: arial, helvetica, serif;" width="60%">
                <?echo $rs_usuario[1][0]['NME_CLIENTE'];?> <BR>
                e-Capa - Controle Automatizado para Produ&ccedil;&atilde;o de Alimentos
            </td>
            <td align="left" style="text-align:left;height:10%;font-size:14px;color:#0150D3;vertical-align:middle;font-family: arial, helvetica, serif;">
		<?echo "Usu&aacute;rio: ".$rs_usuario[1][0]['NME_USUARIO_COMPLETO'];
		  echo "<BR>";
		  echo $rs_usuario[1][0]['DSC_LOJA'];
                ?>
            </td>
	</tr>
    </table>
</div>
