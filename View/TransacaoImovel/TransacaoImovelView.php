<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
    <body>   
<script src="js/CreateWindow.js"></script>    
<script src="js/TransacaoImovelView.js"></script>
  <input type="hidden" id="indPessoa" name="indPessoa"> 
  <input type="hidden" id="method" name="method">      
  <table width="100%" id="CadastroImovels">
      <tr>
          <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
              Transa&ccedil;&atilde;o de Im&oacute;veis
          </td>
      </tr>
      <tr>
          <td>
              <input type="button" id="btnNovaTransacao" value="Nova">
          </td>
      </tr>          
      <tr>
          <td>
              <div id="listaImovelIndisponivel"></div>
          </td>
      </tr> 
  </table>
  
    <div id="CadTransacaoImovel">
        <div id="windowHeader">
        </div>
        <div style="overflow: hidden;" id="windowContent">
            <?  include_once "CadTransacaoImovelView.php";?>
        </div>
    </div>  
</body>
</html>

  