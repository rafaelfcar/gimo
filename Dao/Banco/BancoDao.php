<?
include_once("../../Dao/BaseDao.php");
class BancoDao extends BaseDao
{
  Public Function BancoDao(){
      $this->conect();
  }

  Public Function ListaBanco(){    
    $sql = "SELECT COD_BANCO,
                   NME_BANCO,
                   DSC_ARQUIVO_BOLETO
              FROM EN_BANCO";  
    return $this->selectDB("$sql", false);
  }
  
  Public Function UpdateBanco(){
    try{
        $sql = "UPDATE EN_BANCO
                   SET NME_BANCO = '".filter_input(INPUT_POST, 'nmeBanco', FILTER_SANITIZE_STRING)."',
                       DSC_ARQUIVO_BOLETO = '".filter_input(INPUT_POST, 'dscArquivoBoleto', FILTER_SANITIZE_STRING)."'
                 WHERE COD_BANCO = '".filter_input(INPUT_POST, 'codBanco', FILTER_SANITIZE_STRING)."'";
        $rs_localiza = $this->insertDB("$sql");
    }catch(Exception $e){
        echo "erro".$e;
    }
    return $rs_localiza;
  }

  Public Function InsertBanco(){
    $codBanco = $this->CatchUltimoCodigo("EN_BANCO", "COD_BANCO");
    $sql = "INSERT INTO EN_BANCO (
                   COD_BANCO,
                   NME_BANCO,
                   DSC_ARQUIVO_BOLETO)
            VALUES ($codBanco,
                   '".filter_input(INPUT_POST, 'nmeBanco', FILTER_SANITIZE_STRING)."',
                   '".filter_input(INPUT_POST, 'dscArquivoBoleto', FILTER_SANITIZE_STRING)."')";          
    $rs_localiza = $this->insertDB("$sql");
    return $rs_localiza;
  }
}