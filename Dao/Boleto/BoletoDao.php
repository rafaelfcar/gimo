<?
include_once("../../Dao/BaseDao.php");
class BoletoDao extends BaseDao
{
    Public Function BoletoDao(){
        $this->conect();
    }

    Public Function ListaBoleto(){    
        $sql = "SELECT IP.DTA_VENCIMENTO,
                       IP.DTA_PAGAMENTO,
                       IP.VLR_PAGAMENTO,
                       IP.NRO_DOCUMENTO,
                       IP.NRO_NOSSO_NUMERO 
                  FROM RE_IMOVEL_PAGAMENTO IP";  
        return $this->selectDB("$sql", false);
    }

    Public Function ListarTodosBoletos($codCliente){
        $nroMesReferencia = filter_input(INPUT_POST, 'nroMesReferencia');
        if ($nroMesReferencia<10){
            $nroMesReferencia = '0'.$nroMesReferencia;
        }
        $nroAnoReferencia = filter_input(INPUT_POST, 'nroAnoReferencia');
        $sql = "SELECT IPE.COD_IMOVEL,
                       CONCAT(NRO_DIA_PAGAMENTO, '/".$nroMesReferencia."/".$nroAnoReferencia."') AS DTA_PAGAMENTO, 
                       IPE.VLR_TRANSACAO
                  FROM EN_IMOVEL I
                 INNER JOIN RE_IMOVEL_PESSOA IPE
                    ON I.COD_IMOVEL = IPE.COD_IMOVEL
                 WHERE I.COD_IMOVEL IN (SELECT COD_IMOVEL
                                          FROM RE_IMOVEL_PESSOA
                                         WHERE (DTA_INICIO<=NOW() AND DTA_FIM>=NOW())
                                           AND DTA_CANCELAMENTO = '0000-00-00')
                   AND I.COD_IMOVEL NOT IN (SELECT COD_IMOVEL
                                          FROM RE_IMOVEL_PAGAMENTO
                                         WHERE (MONTH(DTA_VENCIMENTO) = ".$nroMesReferencia."
                                           AND YEAR(DTA_VENCIMENTO) = ".$nroAnoReferencia.")
                                           AND DTA_PAGAMENTO IS NOT NULL)
                   AND I.COD_CLIENTE = $codCliente";
        //echo $sql; die;
        return $this->selectDB("$sql", false);
    }

    Public Function RemoverBoletos(){
        $nroMesReferencia = filter_input(INPUT_POST, 'nroMesReferencia');
        $nroAnoReferencia = filter_input(INPUT_POST, 'nroAnoReferencia');
        $sql = "DELETE FROM RE_IMOVEL_PAGAMENTO 
                 WHERE (MONTH(DTA_VENCIMENTO) = $nroMesReferencia 
                   AND YEAR(DTA_VENCIMENTO) = $nroAnoReferencia)
                   AND DTA_PAGAMENTO IS NULL";          
        $rs_localiza = $this->insertDB("$sql");
        return $rs_localiza;
    }

    Public Function InsertBoleto($codImovel, $dtaVencimento, $vlrPagamento, $nroDocumento, $nroNossoNumero){
      $sql = "INSERT INTO RE_IMOVEL_PAGAMENTO (
                     COD_IMOVEL,
                     DTA_VENCIMENTO,
                     VLR_MENSALIDADE,
                     NRO_DOCUMENTO,
                     NRO_NOSSO_NUMERO)
              VALUES ($codImovel,
                     '".$this->ConverteDataForm($dtaVencimento)."',
                     '".$vlrPagamento."',
                     '".$nroDocumento."',
                     '".$nroNossoNumero."')";          
      $rs_localiza = $this->insertDB("$sql");
      return $rs_localiza;
    }

    Public Function VerificaNossoNumero($nossoNumero){    
        $sql = "SELECT COUNT(NRO_NOSSO_NUMERO) AS QTD 
                  FROM RE_IMOVEL_PAGAMENTO 
                 WHERE NRO_NOSSO_NUMERO = '".$nossoNumero."'";  
        return $this->selectDB("$sql", false);
    }

    Public Function InformaPagamento(){        
        $vlrPagamento = filter_input(INPUT_POST, 'vlrPagamento', FILTER_SANITIZE_STRING);
        $vlrPagamento = str_replace(',', '.', str_replace('.', '', $vlrPagamento));
        $sql = "UPDATE RE_IMOVEL_PAGAMENTO 
                   SET VLR_PAGAMENTO = '".$vlrPagamento."',
                       DTA_PAGAMENTO = '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaPagamento', FILTER_SANITIZE_STRING))."',
                       COD_TIPO_PAGAMENTO = '".filter_input(INPUT_POST, 'codTipoPagamento', FILTER_SANITIZE_STRING)."'
                 WHERE NRO_NOSSO_NUMERO = '".filter_input(INPUT_POST, 'nroNossoNumero', FILTER_SANITIZE_STRING)."'";         
        $rs_localiza = $this->insertDB("$sql");
        return $rs_localiza;
    }
}