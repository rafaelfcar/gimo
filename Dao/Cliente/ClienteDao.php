<?
include_once("../../Dao/BaseDao.php");
class ClienteDao extends BaseDao
{
  Public Function ClienteDao(){
      $this->conect();
  }

  /**
   * Seleciona a lista de clientes de acordo com o Cliente.
   * Utilizado no ClienteModel.php   
   * @return Array
   */
  Public Function ListarCliente(){
    $sql = "SELECT COD_CLIENTE, NME_CLIENTE, NRO_CNPJ, TXT_ENDERECO, NRO_TELEFONE, NME_FIGURA, IND_ATIVO
              FROM EN_CLIENTE             
             ORDER BY NME_CLIENTE";          
    $rs_localiza = $this->selectDB("$sql", false);
    return $rs_localiza;
  }

  /**
   * Atualiza um registro na tabela EN_CLIENTE.
   * Utilizado na ClienteModel.php
   * @return boolean
   */
  Public Function UpdateCliente(){
    $sql = "UPDATE EN_CLIENTE
               SET IND_ATIVO = '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."',
                   NME_CLIENTE = '".filter_input(INPUT_POST, 'nmeCliente', FILTER_SANITIZE_MAGIC_QUOTES)."',
                   NRO_CNPJ = '".filter_input(INPUT_POST, 'nroCnpj', FILTER_SANITIZE_STRING)."',
                   NME_FIGURA = '".filter_input(INPUT_POST, 'nmeFigura', FILTER_SANITIZE_STRING)."'                       
             WHERE COD_CLIENTE = ".filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_STRING);
    $rs_localiza = $this->insertDB("$sql");
    return $rs_localiza;
  }

  /**
   * Insere um registro na tabela EN_CLIENTE.
   * Utilizado na ClienteModel.php
   * @return boolean
   */
  Public Function InsertCliente(){
    $codCliente = $this->CatchUltimoCodigo("EN_CLIENTE", "COD_CLIENTE");
    $sql = "INSERT INTO EN_CLIENTE (COD_CLIENTE, NME_CLIENTE, NRO_CNPJ, TXT_ENDERECO, NRO_TELEFONE, NME_FIGURA, IND_ATIVO)
            VALUES ($codCliente, 
                    '".filter_input(INPUT_POST, 'nmeCliente', FILTER_SANITIZE_STRING)."', 
                    '".filter_input(INPUT_POST, 'nroCnpj', FILTER_SANITIZE_STRING)."', 
                    '".filter_input(INPUT_POST, 'txtEndereco', FILTER_SANITIZE_STRING)."', 
                    '".filter_input(INPUT_POST, 'nroTelefone', FILTER_SANITIZE_STRING)."', 
                    '".filter_input(INPUT_POST, 'nmeFigura', FILTER_SANITIZE_STRING)."',
                    '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."')";
    $rs_localiza = $this->insertDB("$sql");
    return $rs_localiza;
  }

}
?>
