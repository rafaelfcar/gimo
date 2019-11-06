<?
include_once("../../Dao/BaseDao.php");
class TransacaoImovelDao extends BaseDao
{
    Public Function TransacaoImovelDao(){
        $this->conect();
    }
    
    Public Function ListarImovelDisponivel($codCliente, $codUsuario, $parametro){       
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
                 WHERE I.COD_IMOVEL NOT IN (SELECT COD_IMOVEL
                                              FROM RE_IMOVEL_PESSOA
                                             WHERE (DTA_INICIO<=NOW() AND DTA_FIM>=NOW())
                                               AND DTA_CANCELAMENTO = '0000-00-00')
                   AND I.COD_CLIENTE = $codCliente ";
      $sql .= $parametro;    
      return $this->selectDB("$sql", false);    
    }

    Public Function ListarImovelInDisponivel($codCliente, $codUsuario){       
        $sql = "SELECT IP.COD_IMOVEL,
                       B.COD_BAIRRO,
                       B.NME_BAIRRO,
                       C.COD_CIDADE,
                       C.NME_CIDADE,
                       U.SGL_UF,
                       U.DSC_UF,
                       I.VLR_IMOVEL,
                       I.VLR_TAMANHO,
                       I.COD_PROPRIETARIO,
                       P.COD_PESSOA,
                       P.NME_PESSOA,
                       P.NRO_CPF,
                       I.TXT_ENDERECO,
                       I.NRO_CEP,
                       IP.TPO_TRANSACAO,
                       IP.VLR_TRANSACAO,
                       IP.NRO_DIA_PAGAMENTO,
                       IP.DTA_INICIO,
                       IP.DTA_FIM,
                       IP.DTA_CANCELAMENTO
                  FROM EN_IMOVEL I
                 INNER JOIN RE_IMOVEL_PESSOA IP
                    ON I.COD_IMOVEL = IP.COD_IMOVEL
                   AND (DTA_INICIO<=NOW() AND DTA_FIM>=NOW())
                   AND DTA_CANCELAMENTO = '1900-01-01'
                  LEFT JOIN EN_BAIRRO B
                    ON I.COD_BAIRRO = B.COD_BAIRRO
                  LEFT JOIN EN_CIDADE C
                    ON B.COD_CIDADE = C.COD_CIDADE
                  LEFT JOIN EN_UF U
                    ON C.SGL_UF = U.SGL_UF
                  LEFT JOIN EN_PESSOAS P
                    ON IP.COD_PESSOA = P.COD_PESSOA 
                 WHERE I.COD_CLIENTE = $codCliente ";
      return $this->selectDB("$sql", false);    
    }
  
    Public Function UpdateTransacaoImovel(){
        $vlrTransacaoImovel = filter_input(INPUT_POST, 'vlrTransacaoImovel', FILTER_SANITIZE_STRING);
        $vlrTransacaoImovel = str_replace(',', '.', str_replace('.', '', $vlrTransacaoImovel));
        $sql = "UPDATE RE_IMOVEL_PESSOA
                   SET NRO_DIA_PAGAMENTO = '".filter_input(INPUT_POST, 'nroDiaVencimento', FILTER_SANITIZE_STRING)."'
                 WHERE COD_IMOVEL = ".filter_input(INPUT_POST, 'codImovel', FILTER_SANITIZE_NUMBER_INT)."
                   AND COD_PESSOA = ".filter_input(INPUT_POST, 'codPessoaTransacao', FILTER_SANITIZE_NUMBER_INT)."
                   AND DTA_INICIO = '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaInicio', FILTER_SANITIZE_STRING))."'";        
        $return = $this->insertDB("$sql");     
        if ($return[0]){
            $ret = array(0=>true,
                         1=>filter_input(INPUT_POST, 'codTransacaoImovel', FILTER_SANITIZE_NUMBER_INT));
        }else{
            $ret = $return;
        }
        return $ret;            
    }

    Public Function InsertTransacaoImovel($codCliente){    
            $vlrTransacao = filter_input(INPUT_POST, 'vlrTransacaoImovel', FILTER_SANITIZE_STRING);
            $vlrTransacao = str_replace(',', '.', str_replace('.', '', $vlrTransacao));        
            $sql = "INSERT INTO RE_IMOVEL_PESSOA 
                           (COD_IMOVEL, COD_PESSOA, DTA_INICIO, DTA_FIM, DTA_CANCELAMENTO, VLR_TRANSACAO, TPO_TRANSACAO, NRO_DIA_PAGAMENTO)
                    VALUES (".filter_input(INPUT_POST, 'codImovel', FILTER_SANITIZE_NUMBER_INT).",
                            ".filter_input(INPUT_POST, 'codPessoaTransacao', FILTER_SANITIZE_NUMBER_INT).",
                            '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaInicio', FILTER_SANITIZE_STRING))."',
                            '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaTermino', FILTER_SANITIZE_STRING))."',
                            '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaCancelamento', FILTER_SANITIZE_STRING))."',
                            '".$vlrTransacao."',
                            '".filter_input(INPUT_POST, 'tpoTransacao', FILTER_SANITIZE_STRING)."',
                            '".filter_input(INPUT_POST, 'nroDiaVencimento', FILTER_SANITIZE_STRING)."')";
            $result = $this->insertDB($sql);
            return $result;
    }
    
    Public Function RemoveDetalhesTransacaoImovel(){
        $sql = "DELETE FROM RE_DETALHE_IMOVEL WHERE COD_IMOVEL = ".filter_input(INPUT_POST, 'codTransacaoImovel', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB($sql);
    }
    Public Function SalvarTransacaoTransacaoImovel(){
        $sql = "DELETE FROM RE_IMOVEL_PESSOA WHERE COD_IMOVEL = ".filter_input(INPUT_POST, 'codTransacaoImovel', FILTER_SANITIZE_NUMBER_INT)."
                   AND COD_PESSOA = ".filter_input(INPUT_POST, 'codPessoaTransacao', FILTER_SANITIZE_NUMBER_INT)."
                   AND DTA_INICIO = '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaInicio', FILTER_SANITIZE_STRING))."'";
        $result = $this->insertDB($sql);
        if ($result[0]){
            $vlrTransacao = filter_input(INPUT_POST, 'vlrTransacaoTransacaoImovel', FILTER_SANITIZE_STRING);
            $vlrTransacao = str_replace(',', '.', str_replace('.', '', $vlrTransacao));        
            $sql = "INSERT INTO RE_IMOVEL_PESSOA 
                           (COD_IMOVEL, COD_PESSOA, DTA_INICIO, DTA_FIM, DTA_CANCELAMENTO, VLR_TRANSACAO, TPO_TRANSACAO, NRO_DIA_PAGAMENTO)
                    VALUES (".filter_input(INPUT_POST, 'codTransacaoImovel', FILTER_SANITIZE_NUMBER_INT).",
                            ".filter_input(INPUT_POST, 'codPessoaTransacao', FILTER_SANITIZE_NUMBER_INT).",
                            '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaInicio', FILTER_SANITIZE_STRING))."',
                            '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaTermino', FILTER_SANITIZE_STRING))."',
                            '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaCancelamento', FILTER_SANITIZE_STRING))."',
                            '".$vlrTransacao."',
                            '".filter_input(INPUT_POST, 'tpoTransacao', FILTER_SANITIZE_STRING)."',
                            '".filter_input(INPUT_POST, 'nroDiaVencimento', FILTER_SANITIZE_STRING)."')";
            $result = $this->insertDB($sql);
        }
        return $result;
    }    
    
    Public Function CarregaStatusTransacaoImovel(){
        $codTransacaoImovel = filter_input(INPUT_POST, "codTransacaoImovel", FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT COUNT(COD_IMOVEL) AS QTD
                  FROM RE_IMOVEL_PESSOA
                 WHERE (DTA_INICIO<=NOW() AND DTA_FIM>=NOW())
                   AND COD_IMOVEL = $codTransacaoImovel
                   AND DTA_CANCELAMENTO = '0000-00-00'";    
        return $this->selectDB("$sql", false);    
    }
    
    Public Function CarregaHistoricoTransacaoImovel(){
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
                 WHERE IP.COD_IMOVEL = ".  filter_input(INPUT_POST, 'codTransacaoImovel', FILTER_SANITIZE_NUMBER_INT);
        return $this->selectDB($sql, false);
    }
    
    Public Function CarregaUltimaTransacao(){
        $sql = "SELECT DATE(DTA_INICIO) AS DTA_INICIO,
                       DATE(DTA_FIM) AS DTA_FIM,
                       DATE(DTA_CANCELAMENTO) AS DTA_CANCELAMENTO,
                       IP.VLR_TRANSACAO,
                       P.COD_PESSOA,
                       P.NME_PESSOA,
                       CASE WHEN TPO_TRANSACAO = 'A' THEN 'ALUGUEL'
                            WHEN TPO_TRANSACAO = 'V' THEN 'VENDA'
                       ELSE '' END AS TPO_TRANSACAO,
                       TPO_TRANSACAO AS TIPO,
                       IP.NRO_DIA_PAGAMENTO
                  FROM RE_IMOVEL_PESSOA IP
                  LEFT JOIN EN_PESSOAS P
                    ON IP.COD_PESSOA = P.COD_PESSOA
                 WHERE IP.DTA_INICIO = (SELECT MAX(DTA_INICIO)
                                          FROM RE_IMOVEL_PESSOA IMP
                                         WHERE IMP.COD_IMOVEL = ".  filter_input(INPUT_POST, 'codTransacaoImovel', FILTER_SANITIZE_NUMBER_INT).")";
        return $this->selectDB($sql, false);
    }
}
