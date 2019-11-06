<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Cliente/ClienteDao.php");
class ClienteModel extends BaseModel
{
    public function ClienteModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    /**
     * Retorna a Lista de clientes.
     * Utilizado no ClienteController.php.
     * retorna por Default um Json.
     * Caso Valor seja passado por parametro false retornará um array.
     */
    Public Function ListarCliente($Json=true){
        $dao = new ClienteDao();
        $lista = $dao->ListarCliente(); 
        if ($lista[0]){
            $listaAtualizada = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVO', 'ATIVO');
        }else{
            $listaAtualizada = $lista;
        }
        if ($Json){
            return json_encode($listaAtualizada);
        }else{
            return $listaAtualizada;
        }
    }

    /**
     * Atualiza a tabela de cliente
     * Uilizado no ClienteController.php
     * @return boolean
     */
    Public Function UpdateCliente(){
        $dao = new ClienteDao();
        return json_encode($dao->UpdateCliente());
    }

    /**
     * Insere na tabela de cliente
     * Uilizado no ClienteController.php
     * @return boolean
     */
    Public Function InsertCliente(){
        $dao = new ClienteDao();
        return json_encode($dao->InsertCliente());
    }

}
