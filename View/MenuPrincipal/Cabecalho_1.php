<?
if (!isset($_SESSION)){
    session_start();
}
$rs_usuario = $_SESSION['DadosUsuario'];
?>
    <script type="text/javascript" src="../../Resources/jqx/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../../Resources/jqx/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="../../Resources/jqx/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../../Resources/jqx/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../../Resources/jqx/jqwidgets/jqxmenu.js"></script>
<div id="cabecalho">
  <table width="100%" align="left">
	<tr>
		<td align="left" rowspan="3"
            style="text-align:left;
                   height:10%;
                   font-size:14px;
                   color:#0150D3;
                   vertical-align:middle;
                   font-family: arial, helvetica, serif;"
            width="30%">
		<?
		//	echo"<img width=\"550 heigth=\"135\" src=\"http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/xpto/ArquivosGerais/topo.jpg\">";
        echo $rs_usuario[0]['NME_CLIENTE'];?> <BR>
             e-Capa - Controle Automatizado para Produ&ccedil;&atilde;o de Alimentos
		</td>
		<td align="left"
            style="text-align:left;
                   height:10%;
                   font-size:14px;
                   color:#0150D3;
                   vertical-align:middle;
                   font-family: arial, helvetica, serif;">
		<?
			echo "Usu&aacute;rio: ".$rs_usuario[0]['NME_USUARIO_COMPLETO'];
			echo "<BR>";
			echo $rs_usuario[0]['DSC_LOJA'];
			echo "<BR>";
            echo"<a style=\"text-align:left;
                   height:10%;
                   font-size:10px;
                   color:#0150D3;
                   vertical-align:middle;
                   font-family: arial, helvetica, serif;\" href=\"http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/capa/ArquivosGerais/MenuPrincipal.php\">Clique aqui para p&aacute;gina inicial</a>";
        ?>
		</td>
	</tr>

  </table>
</div>