<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/TipoPagamento/TipoPagamentoDao.php");
class TipoPagamentoModel extends BaseModel
{
    public function TipoPagamentoModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarTipoPagamento($Json=true){
        $dao = new TipoPagamentoDao();
        $lista = $dao->ListaTipoPagamento();   
        $listaBooleanAtualizada = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVO', 'ATIVO');
        if ($Json){
            return json_encode($listaBooleanAtualizada);
        }else{
            return $listaBooleanAtualizada;        
        }
    }

    Public Function SelecionaTipoPagamento($Json=true, $codCidade=null){
        $dao = new TipoPagamentoDao();
        $lista = $dao->SelecionaTipoPagamento($codCidade);        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
    
    Public Function InsertTipoPagamento(){
        $dao = new TipoPagamentoDao();
        return json_encode($dao->InsertTipoPagamento());
    }

    Public Function UpdateTipoPagamento(){
        $dao = new TipoPagamentoDao();
        return json_encode($dao->UpdateTipoPagamento());
    }	
    
}
