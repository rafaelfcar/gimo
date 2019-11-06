<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Uf/UfDao.php");
class UfModel extends BaseModel
{
    public function UfModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarUf($Json=true){
        $dao = new UfDao();
        $lista = $dao->ListaUf($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario']);        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
	
    Public Function InsertUf(){
        $dao = new UfDao();
        return json_encode($dao->InsertUf());
    }

    Public Function UpdateUf(){
        $dao = new UfDao();
        return json_encode($dao->UpdateUf());
    }	
    
}
