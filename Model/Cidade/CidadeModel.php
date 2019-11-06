<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Cidade/CidadeDao.php");
class CidadeModel extends BaseModel
{
    public function CidadeModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarCidade($Json=true){
        $dao = new CidadeDao();
        $lista = $dao->ListaCidade($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario']); 
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

    Public Function SelecionaCidades($Json=true, $sglUf=null){
        $dao = new CidadeDao();
        $lista = $dao->SelecionaCidades($sglUf);        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
    
    Public Function InsertCidade(){
        $dao = new CidadeDao();
        $result = $dao->VerificaNomeCidade();
        if ($result[0]){
            if ($result[1]!=null){
                if ($result[1][0]['QTD']>0){
                    $result[0]=false;
                    $result[1]='Nome de cidade j&aacute; existe!';
                }else{
                    $result = $dao->InsertCidade();
                }
            }
        }        
        return json_encode($result); 
    }

    Public Function UpdateCidade(){
        $dao = new CidadeDao();
        $result = $dao->VerificaNomeCidade();
        if ($result[0]){
            if ($result[1]!=null){
                if ($result[1][0]['QTD']>0){
                    $result[0]=false;
                    $result[1]='Nome de cidade j&aacute; existe!';
                }else{
                    $result = $dao->UpdateCidade();
                }
            }
        }        
        return json_encode($result);        
    }	
    
}
