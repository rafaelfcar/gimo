<?
include_once("../../Dao/BaseDao.php");
class NoticiasDao extends BaseDao
{
  Public Function NoticiasDao(){
      $this->conect();
  }
  
  /**
   * Retorna um array de registros da tabela EN_NOTICIAS
   * @param Integer $codCliente
   * @return Array
   */
  Public Function ListaNoticias($codCliente){    
    $sql = "SELECT COD_NOTICIAS,
                   TXT_NOTICIAS,
                   TXT_OBSERVACAO,
                   DATE(DTA_NOTICIA) AS DTA_NOTICIA
              FROM EN_NOTICIAS
             WHERE COD_CLIENTE = $codCliente";
    $rs_localiza = $this->selectDB("$sql", false);
    return $rs_localiza;
  }

    /**
     * Faz a Alteração de um registro na tabela EN_NOTICIAS
     * @return boolean
     */
  Public Function UpdateNoticia(){
    $sql = "UPDATE EN_NOTICIAS
               SET TXT_NOTICIAS = '".filter_input(INPUT_POST, 'dscTitulo',FILTER_SANITIZE_STRING)."',
                   TXT_OBSERVACAO = '".filter_input(INPUT_POST, 'dscNoticias',FILTER_SANITIZE_STRING)."'
             WHERE COD_NOTICIAS = ".filter_input(INPUT_POST, 'codNoticias', FILTER_SANITIZE_NUMBER_INT);
    $rs_localiza = $this->insertDB("$sql");        
    return $rs_localiza;
  }

  /**
   * Insere um registro na tabela EN_NOTICIAS
   * @param Integer $codCliente
   * @return boolean
   */
  Public Function InsertNoticias($codCliente){    
    $codNoticias = $this->CatchUltimoCodigo("EN_NOTICIAS", "COD_NOTICIAS");
    $sql = "INSERT INTO EN_NOTICIAS (COD_NOTICIAS,TXT_NOTICIAS,TXT_OBSERVACAO,DTA_NOTICIA,COD_CLIENTE)
            VALUES ($codNoticias,'".filter_input(INPUT_POST, 'dscTitulo',FILTER_SANITIZE_STRING)."','".filter_input(INPUT_POST, 'dscNoticias', FILTER_SANITIZE_STRING)."',NOW(),$codCliente)";
    $rs_localiza = $this->insertDB("$sql");
    return $rs_localiza;
  }

}
?>
