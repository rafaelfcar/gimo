<?
include_once("../../Dao/BaseDao.php");
class TipoPagamentoDao extends BaseDao
{
    Public Function TipoPagamentoDao(){
        $this->conect();
    }

    Public Function ListaTipoPagamento(){    
        $sql = "SELECT COD_TIPO_PAGAMENTO,
                       DSC_TIPO_PAGAMENTO,
                       IND_ATIVO
                  FROM EN_TIPO_PAGAMENTO";      
        return $this->selectDB("$sql", false);    
    }

    Public Function SelecionaTipoPagamento($codCidade){    
        $sql = "SELECT COD_TIPO_PAGAMENTO,
                       DSC_TIPO_PAGAMENTO,
                       IND_ATIVO
                  FROM EN_TIPO_PAGAMENTO
                 WHERE IND_ATIVO = 'S'";   
        return $this->selectDB("$sql", false);    
    }

    Public Function UpdateTipoPagamento(){
        try{
            $sql = "UPDATE EN_TIPO_PAGAMENTO
                       SET DSC_TIPO_PAGAMENTO = '".filter_input(INPUT_POST, 'dscTipoPagamento', FILTER_SANITIZE_STRING)."',
                           IND_ATIVO = '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."'
                     WHERE COD_TIPO_PAGAMENTO = ".filter_input(INPUT_POST, 'codTipoPagamento', FILTER_SANITIZE_NUMBER_INT);
            $rs_localiza = $this->insertDB("$sql");
        }catch(Exception $e){
            echo "erro".$e;
        }
        return $rs_localiza;
    }

    Public Function InsertTipoPagamento(){
        $codTipoPagamento = $this->CatchUltimoCodigo("EN_TIPO_PAGAMENTO", "COD_TIPO_PAGAMENTO");
        $sql = "INSERT INTO EN_TIPO_PAGAMENTO (
                       COD_TIPO_PAGAMENTO,
                       DSC_TIPO_PAGAMENTO,
                       IND_ATIVO)
                VALUES (
                       $codTipoPagamento,
                       '".filter_input(INPUT_POST, 'dscTipoPagamento', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."')"; 
        $rs_localiza = $this->insertDB("$sql");        
        return $rs_localiza;
    }
  
    Public Function VerificaTipoPagamento(){
        $dscTipoPagamento = trim(filter_input(INPUT_POST, 'dscTipoPagamento', FILTER_SANITIZE_STRING));
        $sql = "SELECT COUNT(*) AS QTD
                  FROM EN_TIPO_PAGAMENTO 
                 WHERE DSC_TIPO_PAGAMENTO = '".$dscTipoPagamento."'
                   AND COD_TIPO_PAGAMENTO <> ".filter_input(INPUT_POST, 'codTipoPagamento', FILTER_SANITIZE_NUMBER_INT);      
        return $this->selectDB("$sql", false);         
    }
}