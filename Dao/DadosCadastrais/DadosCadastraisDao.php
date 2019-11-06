<?
include_once("../../Dao/BaseDao.php");
class DadosCadastraisDao extends BaseDao
{
  Public Function DadosCadastraisDao(){
      $this->conect();
  }

  Public Function ListaDadosCadastrais($codCliente){    
    $sql = " SELECT COD_CLIENTE,
                    NME_CLIENTE,
                    NRO_CNPJ,
                    TXT_ENDERECO,
                    NRO_TELEFONE,
                    IND_ATIVO,
                    COD_BANCO,
                    NRO_AGENCIA,
                    NRO_CONTA_CORRENTE,
                    VLR_MULTA,
                    VLR_JUROS
               FROM EN_CLIENTE
              WHERE COD_CLIENTE = $codCliente";      
    return $this->selectDB("$sql", false);    
  }
  
  Public Function UpdateDadosCadastrais($codCliente){
    try{
        $sql = "UPDATE EN_CLIENTE
                   SET NME_CLIENTE = '".filter_input(INPUT_POST, 'nmeCliente', FILTER_SANITIZE_STRING)."',
                       NRO_CNPJ = '".filter_input(INPUT_POST, 'nroCNPJ', FILTER_SANITIZE_STRING)."',
                       TXT_ENDERECO = '".filter_input(INPUT_POST, 'txtEndereco', FILTER_SANITIZE_STRING)."',
                       NRO_TELEFONE = '".filter_input(INPUT_POST, 'nroTelefone', FILTER_SANITIZE_STRING)."',
                       COD_BANCO = '".filter_input(INPUT_POST, 'codBanco', FILTER_SANITIZE_STRING)."',
                       NRO_AGENCIA = '".filter_input(INPUT_POST, 'nroAgencia', FILTER_SANITIZE_STRING)."',
                       NRO_CONTA_CORRENTE = '".filter_input(INPUT_POST, 'nroContaCorrente', FILTER_SANITIZE_STRING)."',
                       VLR_MULTA = '".filter_input(INPUT_POST, 'vlrMulta', FILTER_SANITIZE_STRING)."',
                       VLR_JUROS = '".filter_input(INPUT_POST, 'vlrJuros', FILTER_SANITIZE_STRING)."'
                 WHERE COD_CLIENTE = $codCliente";
        $rs_localiza = $this->insertDB("$sql");
    }catch(Exception $e){
        echo "erro".$e;
    }
    return $rs_localiza;
  }
}