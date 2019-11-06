<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Noticias/NoticiasDao.php");
class NoticiasModel extends BaseModel
{
    public function NoticiasModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    /**
     * Retorna uma lista de registros da tabela EN_NOTICIAS
     * @param boolean $Json
     * @return Array or JSON
     */
    Public Function ListarNoticias(){
        $dao = new NoticiasDao();
        $lista = $dao->ListaNoticias($_SESSION['cod_cliente_final']);
        $listaAtualizada = BaseModel::AtualizaDataInArray($lista, 'DTA_NOTICIA');
        return json_encode($listaAtualizada);
    }

    /**
     * Atualiza um registro na tabela EN_NOTICIAS
     * @return boolean
     */
    Public Function UpdateNoticia(){
        $dao = new NoticiasDao();
        return json_encode($dao->UpdateNoticia());
    }

    /**
     * Insere um registro na tabela EN_NOTICIAS
     * @return boolean
     */
    Public Function InsertNoticia(){
        $dao = new NoticiasDao();
        return json_encode($dao->InsertNoticias($_SESSION['cod_cliente_final']));
    }

}
?>
