<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Detalhe/DetalheDao.php");
class DetalheModel extends BaseModel
{
    public function DetalheModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarDetalhe($Json=true){
        $dao = new DetalheDao();
        $lista = $dao->ListaDetalhe($_SESSION['cod_cliente_final']);  
        if ($lista[0]){
            if ($lista[1]!=null){
                $lista = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVO', 'ATIVO');
            }
        }
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
	
    Public Function ListarDetalheImovel($Json=true){
        $dao = new DetalheDao();
        $lista = $dao->ListaDetalheImovel($_SESSION['cod_cliente_final']); 
        if ($lista[0]){
            if ($lista[1]!=null){
                $lista = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVO', 'ATIVO');
            }
        }       
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
    
    Public Function InsertDetalhe(){
        $dao = new DetalheDao();
        return json_encode($dao->InsertDetalhe($_SESSION['cod_cliente_final']));
    }

    Public Function UpdateDetalhe(){
        $dao = new DetalheDao();
        return json_encode($dao->UpdateDetalhe());
    }	
    
}
