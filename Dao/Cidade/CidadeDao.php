<?
include_once("../../Dao/BaseDao.php");
class CidadeDao extends BaseDao
{
  Public Function CidadeDao(){
      $this->conect();
  }

  Public Function ListaCidade(){    
    $sql = "SELECT COD_CIDADE,
                   C.SGL_UF,
                   DSC_UF,
                   NME_CIDADE,
                   IND_ATIVO
              FROM EN_CIDADE C
              LEFT JOIN EN_UF U ON C.SGL_UF = U.SGL_UF";      
    return $this->selectDB("$sql", false);    
  }
  
  Public Function SelecionaCidades($sglUf){    
    $sql = "SELECT COD_CIDADE,
                   C.SGL_UF,
                   DSC_UF,
                   NME_CIDADE
              FROM EN_CIDADE C
              LEFT JOIN EN_UF U ON C.SGL_UF = U.SGL_UF 
             WHERE C.IND_ATIVO = 'S'" ;
    if ($sglUf==null){
        $sql .= "  AND C.SGL_UF = '".  filter_input(INPUT_POST, 'sglUf', FILTER_SANITIZE_STRING)."'";
    }else{
        $sql .= "  AND C.SGL_UF = '".$sglUf."'";
    }
    $sql .= " ORDER BY NME_CIDADE ";
    return $this->selectDB("$sql", false);    
  }
  
  Public Function UpdateCidade(){
    try{
        $sql = "UPDATE EN_CIDADE
                   SET NME_CIDADE = '".filter_input(INPUT_POST, 'nmeCidade', FILTER_SANITIZE_STRING)."',
                       SGL_UF = '".filter_input(INPUT_POST, 'sglUf', FILTER_SANITIZE_STRING)."',
                       IND_ATIVO = '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."'
                 WHERE COD_CIDADE = ".filter_input(INPUT_POST, 'codCidade', FILTER_SANITIZE_NUMBER_INT);
        $rs_localiza = $this->insertDB("$sql");        
    }catch(Exception $e){
        echo "erro".$e;
    }
    return $rs_localiza;
  }

  Public Function InsertCidade(){
      $codCidade = $this->CatchUltimoCodigo("EN_CIDADE", "COD_CIDADE");
    $sql = "INSERT INTO EN_CIDADE (
                   COD_CIDADE,
                   SGL_UF,
                   IND_ATIVO,
                   NME_CIDADE)
            VALUES (
                   $codCidade,
                   '".filter_input(INPUT_POST, 'sglUf', FILTER_SANITIZE_STRING)."',
                   '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."',
                   '".filter_input(INPUT_POST, 'nmeCidade', FILTER_SANITIZE_STRING)."')";              
    $rs_localiza = $this->insertDB("$sql");
    return $rs_localiza;
  }
  
    Public Function VerificaNomeCidade(){
        $nmeCidade = trim(filter_input(INPUT_POST, 'nmeCidade', FILTER_SANITIZE_STRING));
        $sql = "SELECT COUNT(*) AS QTD
                  FROM EN_CIDADE 
                 WHERE NME_CIDADE = '".$nmeCidade."'
                   AND COD_CIDADE <> ".filter_input(INPUT_POST, 'codCidade', FILTER_SANITIZE_NUMBER_INT);      
        return $this->selectDB("$sql", false);         
    }
}