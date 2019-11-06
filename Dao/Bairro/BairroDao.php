<?
include_once("../../Dao/BaseDao.php");
class BairroDao extends BaseDao
{
  Public Function BairroDao(){
      $this->conect();
  }

  Public Function ListaBairro(){    
    $sql = "SELECT COD_BAIRRO,
                   B.COD_CIDADE,
                   NME_CIDADE,
                   NME_BAIRRO,
                   DSC_UF,
                   U.SGL_UF,
                   B.IND_ATIVO
              FROM EN_BAIRRO B
              LEFT JOIN EN_CIDADE C ON B.COD_CIDADE = C.COD_CIDADE
              LEFT JOIN EN_UF U ON C.SGL_UF = U.SGL_UF";      
    return $this->selectDB("$sql", false);    
  }

  Public Function SelecionaBairro($codCidade){    
    $sql = "SELECT COD_BAIRRO,
                   B.COD_CIDADE,
                   NME_CIDADE,
                   NME_BAIRRO,
                   DSC_UF,
                   U.SGL_UF
              FROM EN_BAIRRO B
              LEFT JOIN EN_CIDADE C ON B.COD_CIDADE = C.COD_CIDADE
              LEFT JOIN EN_UF U ON C.SGL_UF = U.SGL_UF 
             WHERE B.IND_ATIVO = 'S'";      
    if ($codCidade==null){
        $sql .= "  AND B.COD_CIDADE = '".  filter_input(INPUT_POST, 'codCidade', FILTER_SANITIZE_STRING)."'";
    }else{
        $sql .= "  AND B.COD_CIDADE = '".$codCidade."'";
    }        
    $sql .= " ORDER BY NME_BAIRRO ";
    return $this->selectDB("$sql", false);    
  }
  
  Public Function UpdateBairro(){
    try{
        $sql = "UPDATE EN_BAIRRO
                   SET NME_BAIRRO = '".filter_input(INPUT_POST, 'nmeBairro', FILTER_SANITIZE_STRING)."', 
                       IND_ATIVO = '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."',
                       COD_CIDADE = '".filter_input(INPUT_POST, 'codCidade', FILTER_SANITIZE_NUMBER_INT)."'
                 WHERE COD_BAIRRO = ".filter_input(INPUT_POST, 'codBairro', FILTER_SANITIZE_NUMBER_INT);
        $rs_localiza = $this->insertDB("$sql");
    }catch(Exception $e){
        echo "erro".$e;
    }
    return $rs_localiza;
  }

  Public Function InsertBairro(){
      $codBairro = $this->CatchUltimoCodigo("EN_BAIRRO", "COD_BAIRRO");
    $sql = "INSERT INTO EN_BAIRRO (
                   COD_BAIRRO,
                   COD_CIDADE,
                   IND_ATIVO, 
                   NME_BAIRRO)
            VALUES (
                   $codBairro,
                   ".filter_input(INPUT_POST, 'codCidade', FILTER_SANITIZE_NUMBER_INT).",
                   '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."',
                   '".filter_input(INPUT_POST, 'nmeBairro', FILTER_SANITIZE_STRING)."')";          
    $rs_localiza = $this->insertDB("$sql");
    return $rs_localiza;
  }
  
    Public Function VerificaNomeBairro(){
        $nomeBairro = trim(filter_input(INPUT_POST, 'nmeBairro', FILTER_SANITIZE_STRING));
        $sql = "SELECT COUNT(*) AS QTD
                  FROM EN_BAIRRO 
                 WHERE NME_BAIRRO = '".$nomeBairro."'
                   AND COD_BAIRRO <> ".filter_input(INPUT_POST, 'codBairro', FILTER_SANITIZE_NUMBER_INT);      
        return $this->selectDB("$sql", false);         
    }
}