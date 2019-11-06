<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Loja/LojaDao.php");
class LojaModel extends BaseModel
{
    public function LojaModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    /**
     * Retorna a Lista de departamentos.
     * Utilizado no LojaController.php.
     */
    Public Function ListarPrecoLoja(){
        $dao = new LojaDao();
        $lista = $dao->ListaPrecoLoja($_SESSION['cod_cliente_final']);
        $listaBooleanAtualizada = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVA', 'ATIVO');
        $listaMoedaAtualizada = BaseModel::FormataMoedaInArray($listaBooleanAtualizada, 'VLR_PRECO');
        return json_encode($listaMoedaAtualizada);        
    }

    Public Function ListarLoja($Json=true){
        $dao = new LojaDao();
        $lista = $dao->ListaLoja($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario']);
        $listaBooleanAtualizada = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVA|IND_CENTRAL', 'ATIVA|CENTRAL');
        if ($Json){
            return json_encode($listaBooleanAtualizada);        
        }else{
            return $listaBooleanAtualizada;        
        }
    }

    Public Function ListarLojaAtiva($Json=true){
        $dao = new LojaDao();
        $lista = $dao->ListarLojaAtiva();
        if ($Json){
            return json_encode($lista);        
        }else{
            return $lista;        
        }
    }
	
    Public Function InsertLoja(){
        $dao = new LojaDao();
        return json_encode($dao->InsertLoja());
    }

    Public Function UpdateLoja(){
        $dao = new LojaDao();
        return json_encode($dao->UpdateLoja());
    }	
    
    Public Function CarregaGridPagamentos($Json=true){
        $dao = new LojaDao();
        $lista = $dao->CarregaGridPagamentos(); 		        
        $listaDatasAtualizada = BaseModel::AtualizaDataInArray($lista, 'DTA_BOLETO|DTA_PAGAMENTO');
        if ($Json){
            return json_encode($listaDatasAtualizada);
        }else{
            return $listaDatasAtualizada;
        }
    }	

    Public Function GerarPagamento($Json=true){
        $dao = new LojaDao();
        $nossoNumero = substr(microtime(), 2, 8);
        $lista = $dao->GerarPagamento($nossoNumero);        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }
    Public Function CarregaBoleto($Json=true){
        $dao = new LojaDao();
        $lista = $dao->CarregaBoleto();        
        if ($lista[0]){        
            $listaDatasAtualizada = BaseModel::AtualizaDataInArray($lista, 'DTA_BOLETO');
            if ($Json){
                return json_encode($listaDatasAtualizada);
            }else{
                return $listaDatasAtualizada;
            }
        }else{
            echo json_encode($lista);
            die;
        }
    }
}
