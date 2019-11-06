<?
include_once("../../Dao/BaseDao.php");
class UfDao extends BaseDao
{
  Public Function UfDao(){
      $this->conect();
  }

  Public Function ListaUf(){    
    $sql = "SELECT SGL_UF,
                   DSC_UF
              FROM EN_UF U";  
    return $this->selectDB("$sql", false);
  }
  
  Public Function UpdateUf(){
    try{
        $sql = "UPDATE EN_UF
                   SET DSC_UF = '".filter_input(INPUT_POST, 'dscUf', FILTER_SANITIZE_STRING)."',
                       SGL_UF = '".filter_input(INPUT_POST, 'sglUf', FILTER_SANITIZE_STRING)."'
                 WHERE SGL_UF = '".filter_input(INPUT_POST, 'sglUfAnt', FILTER_SANITIZE_STRING)."'";
        $rs_localiza = $this->insertDB("$sql");
    }catch(Exception $e){
        echo "erro".$e;
    }
    return $rs_localiza;
  }

  Public Function InsertUf(){
    $sql = "INSERT INTO EN_UF (
                   SGL_UF,
                   DSC_UF)
            VALUES (
                   '".filter_input(INPUT_POST, 'sglUf', FILTER_SANITIZE_STRING)."',
                   '".filter_input(INPUT_POST, 'dscUf', FILTER_SANITIZE_STRING)."')";          
    $rs_localiza = $this->insertDB("$sql");
    return $rs_localiza;
  }
}