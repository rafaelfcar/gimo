<?
include_once("../../Dao/BaseDao.php");
class ImovelDao extends BaseDao
{
  Public Function ImovelDao(){
      $this->conect();
  }

  Public Function ListaImovel($codCliente, $codUsuario, $parametro){ 
      $sql = "SELECT COD_IMOVEL,
                     B.COD_BAIRRO,
                     B.NME_BAIRRO,
                     C.COD_CIDADE,
                     C.NME_CIDADE,
                     U.SGL_UF,
                     U.DSC_UF,
                     I.VLR_IMOVEL,
                     I.VLR_TAMANHO,
                     I.COD_PROPRIETARIO,
                     P.NME_PESSOA,
                     P.NRO_CPF,
                     I.TXT_ENDERECO,
                     I.NRO_CEP
                FROM EN_IMOVEL I
                LEFT JOIN EN_BAIRRO B
                  ON I.COD_BAIRRO = B.COD_BAIRRO
                LEFT JOIN EN_CIDADE C
                  ON B.COD_CIDADE = C.COD_CIDADE
                LEFT JOIN EN_UF U
                  ON C.SGL_UF = U.SGL_UF
                LEFT JOIN EN_PESSOAS P
                  ON I.COD_PROPRIETARIO = P.COD_PESSOA 
               WHERE I.COD_CLIENTE = $codCliente ";
    $sql .= $parametro;    
    return $this->selectDB("$sql", false);    
  }
  
    Public Function UpdateImovel(){
        $vlrImovel = filter_input(INPUT_POST, 'vlrImovel', FILTER_SANITIZE_STRING);
        $vlrImovel = str_replace(',', '.', str_replace('.', '', $vlrImovel));
        $sql = "UPDATE EN_IMOVEL
                   SET TXT_ENDERECO = '".filter_input(INPUT_POST, 'txtEndereco', FILTER_SANITIZE_STRING)."',
                       NRO_CEP = '".filter_input(INPUT_POST, 'nroCep', FILTER_SANITIZE_STRING)."',
                       COD_BAIRRO = ".filter_input(INPUT_POST, 'codBairro', FILTER_SANITIZE_NUMBER_INT).",
                       VLR_IMOVEL = '".$vlrImovel."',
                       VLR_TAMANHO = '".filter_input(INPUT_POST, 'vlrTamanho', FILTER_SANITIZE_STRING)."',                       
                       COD_PROPRIETARIO = ".filter_input(INPUT_POST, 'codProprietario', FILTER_SANITIZE_NUMBER_INT)."
                 WHERE COD_IMOVEL = ".filter_input(INPUT_POST, 'codImovel', FILTER_SANITIZE_NUMBER_INT);        
        $return = $this->insertDB("$sql");     
        if ($return[0]){
            $ret = array(0=>true,
                         1=>filter_input(INPUT_POST, 'codImovel', FILTER_SANITIZE_NUMBER_INT));
        }else{
            $ret = $return;
        }
        return $ret;            
    }

    Public Function InsertImovel($codCliente){  
        $vlrImovel = filter_input(INPUT_POST, 'vlrImovel', FILTER_SANITIZE_STRING);
        $vlrImovel = str_replace(',', '.', str_replace('.', '', $vlrImovel));  
        $codImovel = $this->CatchUltimoCodigo("EN_IMOVEL", "COD_IMOVEL");
        $sql = "INSERT INTO EN_IMOVEL (COD_IMOVEL,
                       TXT_ENDERECO,
                       NRO_CEP,
                       COD_BAIRRO,
                       VLR_IMOVEL,
                       VLR_TAMANHO,
                       COD_PROPRIETARIO,
                       COD_CLIENTE)
                VALUES (
                       $codImovel,
                       '".filter_input(INPUT_POST, 'txtEndereco', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'nroCep', FILTER_SANITIZE_STRING)."',
                       ".filter_input(INPUT_POST, 'codBairro', FILTER_SANITIZE_NUMBER_INT).",
                       '".$vlrImovel."',
                       '".filter_input(INPUT_POST, 'vlrTamanho', FILTER_SANITIZE_STRING)."',
                       ".filter_input(INPUT_POST, 'codProprietario', FILTER_SANITIZE_NUMBER_INT).",
                       $codCliente)";          
        $return = $this->insertDB("$sql");     
        if ($return[0]){
            $ret = array(0=>true,
                         1=>$codImovel);
        }else{
            $ret = $return;
        }
        return $ret;
    }
    
    Public Function RemoveDetalhesImovel(){
        $sql = "DELETE FROM RE_DETALHE_IMOVEL WHERE COD_IMOVEL = ".filter_input(INPUT_POST, 'codImovel', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB($sql);
    }
    
    Public Function CarregaHistoricoImovel(){
        $sql = "SELECT DATE(DTA_INICIO) AS DTA_INICIO,
                       DATE(DTA_FIM) AS DTA_FIM,
                       IP.VLR_TRANSACAO,
                       P.NME_PESSOA,
                       CASE WHEN TPO_TRANSACAO = 'A' THEN 'ALUGUEL'
                            WHEN TPO_TRANSACAO = 'V' THEN 'VENDA'
                       ELSE '' END AS TPO_TRANSACAO
                  FROM RE_IMOVEL_PESSOA IP
                  LEFT JOIN EN_PESSOAS P
                    ON IP.COD_PESSOA = P.COD_PESSOA
                 WHERE IP.COD_IMOVEL = ".  filter_input(INPUT_POST, 'codImovel', FILTER_SANITIZE_NUMBER_INT);
        return $this->selectDB($sql, false);
    }
}
