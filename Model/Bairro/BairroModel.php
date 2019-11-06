<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Bairro/BairroDao.php");
class BairroModel extends BaseModel
{
    public function BairroModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarBairro($Json=true){
        $dao = new BairroDao();
        $lista = $dao->ListaBairro($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario']);
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

    Public Function SelecionaBairro($Json=true, $codCidade=null){
        $dao = new BairroDao();
        $lista = $dao->SelecionaBairro($codCidade);        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
    
    Public Function InsertBairro(){
        $dao = new BairroDao();
        $result = $dao->VerificaNomeBairro();
        if ($result[0]){
            if ($result[1]!=null){
                if ($result[1][0]['QTD']>0){
                    $result[0]=false;
                    $result[1]='Nome de bairro j&aacute; existe!';
                }else{
                    $result = $dao->InsertBairro();
                }
            }
        }
        return json_encode($result);
    }

    Public Function UpdateBairro(){
        $dao = new BairroDao();
        $result = $dao->VerificaNomeBairro();
        if ($result[0]){
            if ($result[1]!=null){
                if ($result[1][0]['QTD']>0){
                    $result[0]=false;
                    $result[1]='Nome de bairro j&aacute; existe!';
                }else{
                    $result = $dao->UpdateBairro();
                }
            }
        }        
        return json_encode($result);
    }	
    
}
