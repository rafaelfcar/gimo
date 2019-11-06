<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/TransacaoImovel/TransacaoImovelDao.php");
class TransacaoImovelModel extends BaseModel
{
    public function TransacaoImovelModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarImovelDisponivel($Json=true){
        $dao = new TransacaoImovelDao();
        $codImovel = filter_input(INPUT_POST, 'codImovelPesquisa', FILTER_SANITIZE_NUMBER_INT);
        $nmeProprietarioPesquisa = filter_input(INPUT_POST, 'nmeProprietarioPesquisa', FILTER_SANITIZE_STRING);
        $codBairro = filter_input(INPUT_POST, 'codBairroPesquisa', FILTER_SANITIZE_NUMBER_INT);
        $parametro = '';        
        if ($codImovel!=''){
            $parametro = " AND I.COD_IMOVEL = ".$codImovel;
        }else if ($nmeProprietarioPesquisa!=''){
            $parametro = " AND I.COD_PROPRIETARIO IN (SELECT COD_PESSOA FROM EN_PESSOAS WHERE NME_PESSOA LIKE '".$nmeProprietarioPesquisa."%')";
        }else if ($codBairro!=''){
            $parametro = " AND I.COD_BAIRRO = ".$codBairro;
        }                
        $lista = $dao->ListarImovelDisponivel($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario'], $parametro);        
        if ($lista[0]){            
            $lista = $this->FormataMoedaInArray($lista, 'VLR_IMOVEL');
        }
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }

    Public Function ListarImovelInDisponivel($Json=true){
        $dao = new TransacaoImovelDao();                
        $lista = $dao->ListarImovelInDisponivel($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario']);        
        if ($lista[0]){            
            $lista = $this->FormataMoedaInArray($lista, 'VLR_IMOVEL');
            $lista = BaseModel::AtualizaDataInArray($lista, 'DTA_INICIO|DTA_FIM|DTA_CANCELAMENTO');
        }
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
	
    Public Function InsertTransacaoImovel(){
        $dao = new TransacaoImovelDao();
        return json_encode($dao->InsertTransacaoImovel($_SESSION['cod_cliente_final']));
    }

    Public Function UpdateTransacaoImovel(){
        $dao = new TransacaoImovelDao();
        return json_encode($dao->UpdateTransacaoImovel());
    }  
}
