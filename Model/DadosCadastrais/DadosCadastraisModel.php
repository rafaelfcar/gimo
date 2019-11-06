<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/DadosCadastrais/DadosCadastraisDao.php");
class DadosCadastraisModel extends BaseModel
{
    public function DadosCadastraisModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarDadosCadastrais($Json=true){
        $dao = new DadosCadastraisDao();
        $lista = $dao->ListaDadosCadastrais($_SESSION['cod_cliente_final']);   
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }

    Public Function UpdateDadosCadastrais(){
        $dao = new DadosCadastraisDao();
        return json_encode($dao->UpdateDadosCadastrais($_SESSION['cod_cliente_final']));
    }	
    
}
