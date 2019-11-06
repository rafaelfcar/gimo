
<script src="js/ImovelView.js"></script>
<input type="hidden" id="indPessoa" name="indPessoa">      
<table width="100%" id="CadastroImovels">
    <tr>
        <td width="100%" style="text-align:left;height:10%;font-size:18px;color:#a4bed4;vertical-align:middle;font-family: arial, helvetica, serif;border-bottom: 1px solid #a4bed4;">
          Cadastro de Im&oacute;veis
        </td>
    </tr>
    <tr>
        <td>
          <input type="button" id="btnNovo" value="Novo">
        </td>
    </tr>
    <tr>
        <td>
          <table id="codigo">
              <tr>
                  <td style="text-align:left;height:10%;font-size:14px;color:#000000;vertical-align:middle;font-family: arial, helvetica, serif;">
                      Digite o C&oacute;digo para pesquisa:
                  </td>
              </tr>
              <tr>
                  <td>
                      <input type="text" id="codImovelPesquisa" size="10" class="inputFont14">
                  </td>
              </tr>
          </table>
        </td>
    </tr>

    <tr>
        <td>
            <table width="40%" id="nome">                      
              <tr>
                  <td style="text-align:left;height:10%;font-size:14px;color:#000000;vertical-align:middle;font-family: arial, helvetica, serif;">
                      Digite parte do nome do propriet&aacute;rio:
                  </td>
              </tr>
              <tr>
                  <td>
                      <input type="text" id="nmeProprietarioPesquisa" size="30" class="inputFont14">
                  </td>
              </tr>                      
          </table>
        </td>
    </tr>

    <tr>
        <td>
            <table width="40%" id="bairro">
            <tr>
                <td>Estado</td>
                <td>Cidade</td>
                <td>Bairro</td>
            </tr>
            <tr>            
                <td><div id="sglUfPesquisa" class="comboUf"></div></td>
                <td><div id="codCidadePesquisa" class="comboCidade"></div></td>
                <td><div id="codBairroPesquisa" class="comboBairro"></div></td>                       
            </tr> 
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <input type="button" id="btnPesquisaImovel" value="Pesquisar Im&oacute;vel">
        </td>
    </tr>          
    <tr>
        <td id="tdListaImovel">
            <div id="listaImovels"></div>
        </td>
    </tr> 
</table> 
