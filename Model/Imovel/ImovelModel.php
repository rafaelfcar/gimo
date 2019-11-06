<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Imovel/ImovelDao.php");
class ImovelModel extends BaseModel
{
    public function ImovelModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarImovel($Json=true){
        $dao = new ImovelDao();
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
        $lista = $dao->ListaImovel($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario'], $parametro);        
        if ($lista[0]){            
            $lista = $this->FormataMoedaInArray($lista, 'VLR_IMOVEL');
        }
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
	
    Public Function InsertImovel(){
        $dao = new ImovelDao();
        return json_encode($dao->InsertImovel($_SESSION['cod_cliente_final']));
    }

    Public Function UpdateImovel(){
        $dao = new ImovelDao();
        return json_encode($dao->UpdateImovel());
    }	

    Public function SalvarDetalhesImovel(){
        $dao = new ImovelDao();        
        $dao->RemoveDetalhesImovel();
        $array = explode("|", $_POST['C']);
        $sql = 'INSERT INTO RE_DETALHE_IMOVEL (COD_IMOVEL, COD_DETALHE) VALUES ';
        for ($i=0;$i<count($array)-1;$i++){
            $registro=explode(';',$array[$i]);            
            if ($registro[1]=='S'){
                $sql .= ' ('.filter_input(INPUT_POST, 'codImovel', FILTER_SANITIZE_NUMBER_INT).','.$registro[0].'), ';
            }
        }
        $sql = substr($sql, 0, strlen($sql)-2);        
        $atualizado = $dao->insertDB($sql);
        return json_encode($atualizado);
    }	
    
    Public Function CarregaHistoricoImovel(){
        $ImovelDao = new ImovelDao();
        $lista = $ImovelDao->CarregaHistoricoImovel();
        $listaDataAtualizada = BaseModel::AtualizaDataInArray($lista, 'DTA_INICIO|DTA_FIM');
        return json_encode($listaDataAtualizada);
    }   
}
