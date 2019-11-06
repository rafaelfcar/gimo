<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Banco/BancoDao.php");
class BancoModel extends BaseModel
{
    public function BancoModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarBanco($Json=true){
        $dao = new BancoDao();
        $lista = $dao->ListaBanco($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario']);        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
	
    Public Function InsertBanco(){
        $dao = new BancoDao();
        return json_encode($dao->InsertBanco());
    }

    Public Function UpdateBanco(){
        $dao = new BancoDao();
        return json_encode($dao->UpdateBanco());
    }	
    
}
