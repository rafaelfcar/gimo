<?
include_once("../../Dao/BaseDao.php");
include_once("../../Form/Seguranca/ClienteFinalForm.php");
class ClienteFinalDao extends BaseDao
{
    function ClienteFinalDao(){
    }

    function ListarClienteGrid($parametro,
                               $codClienteFinal){
        try{
            $sql_lista = "SELECT COD_CLIENTE,
                              DSC_CLIENTE,
                              NRO_CPF,
                              NRO_CNPJ,
                              NRO_TELEFONE_CONTATO,
                              NRO_TELEFONE_CELULAR,
                              TXT_ENDERECO
                         FROM EN_CLIENTE
                        WHERE DSC_CLIENTE LIKE '$parametro%'
                          AND COD_CLIENTE_FINAL = $codClienteFinal";
            $lista = $this->selectDB("$sql_lista", false);
        }catch(Exception $e){
            echo "erro".$e;
        }
        return $lista;
    }

    function AddClienteFinal(){
        $form = new ClienteFinalForm();
        $codClienteFinal = $this->CatchUltimoCodigo('EN_CLIENTE_FINAL', 'COD_CLIENTE_FINAL');
        $sql_lista = "
        INSERT INTO EN_CLIENTE_FINAL VALUES ( ".$codClienteFinal.", ".
                                              "'".$form->getNmeClienteFinal()."') ";
        $result = $this->insertDB("$sql_lista");
        if ($result){
            $form->setCodClienteFinal($codClienteFinal);
        }
        return $result;

    }

    function UpdateCliente(){
        $form = new ClienteForm();
            $sql_lista = "
             UPDATE EN_CLIENTE
                SET DSC_CLIENTE='".$form->getDscCliente()."',
                    TXT_ENDERECO = '".$form->getTxtEndereco()."',
                    NRO_TELEFONE_CONTATO = '".$form->getFone()."',
                    NRO_TELEFONE_CELULAR = '".$form->getFoneCelular()."',
                    NRO_CPF = '".$form->getNroCpf()."',
                    NRO_CNPJ = '".$form->getNroCnpj()."'
              WHERE COD_CLIENTE = ".$form->getCodCliente();
            $result = $this->insertDB("$sql_lista");
        echo $result; exit;
        return $result;

    }

    function DeleteCliente(){
        $form = new ClienteForm();
        $sql_lista = "
        DELETE FROM EN_CLIENTE
         WHERE COD_CLIENTE = ".$form->getCodCliente();
        $result = $this->insertDB("$sql_lista");
        return $result;

    }

}
?>
