<?
include_once("../../Dao/BaseDao.php");
class DetalheDao extends BaseDao
{
    Public Function DetalheDao(){
        $this->conect();
    }

    Public Function ListaDetalhe($codCliente){    
        $sql = "SELECT COD_DETALHE,
                       DSC_DETALHE,
                       IND_ATIVO
                  FROM EN_DETALHE 
                 WHERE COD_CLIENTE = $codCliente";  
        return $this->selectDB("$sql", false);
    }

    Public Function ListaDetalheImovel($codCliente){    
        $sql = "SELECT D.COD_DETALHE,
                       D.DSC_DETALHE,
                       IND_ATIVO,
                       (SELECT COD_DETALHE 
                          FROM RE_DETALHE_IMOVEL DI 
                         WHERE DI.COD_DETALHE = D.COD_DETALHE 
                           AND COD_IMOVEL = ".filter_input(INPUT_POST, 'codImovel', FILTER_SANITIZE_NUMBER_INT).") AS COD_DETALHE_IMOVEL
                  FROM EN_DETALHE D
                 WHERE IND_ATIVO = 'S' 
                   AND D.COD_CLIENTE = $codCliente";  
        return $this->selectDB("$sql", false);
    }

    Public Function UpdateDetalhe(){
        try{
            $sql = "UPDATE EN_DETALHE
                       SET DSC_DETALHE = '".filter_input(INPUT_POST, 'dscDetalhe', FILTER_SANITIZE_STRING)."',
                           IND_ATIVO = '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."'
                     WHERE COD_DETALHE = '".filter_input(INPUT_POST, 'codDetalhe', FILTER_SANITIZE_STRING)."'";
            $rs_localiza = $this->insertDB("$sql");
        }catch(Exception $e){
            echo "erro".$e;
        }
        return $rs_localiza;
    }

    Public Function InsertDetalhe($codCliente){
        $codDetalhe = $this->CatchUltimoCodigo("EN_DETALHE", "COD_DETALHE");
        $sql = "INSERT INTO EN_DETALHE (
                       COD_DETALHE,
                       DSC_DETALHE, 
                       IND_ATIVO,
                       COD_CLIENTE)
                VALUES (
                       ".$codDetalhe.",
                       '".filter_input(INPUT_POST, 'dscDetalhe', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."',
                       ".$codCliente.")";          
        $rs_localiza = $this->insertDB("$sql");
        return $rs_localiza;
    }
}