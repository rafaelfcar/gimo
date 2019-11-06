<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Pagamento/PagamentoDao.php");
class PagamentoModel extends BaseModel
{
    public function PagamentoModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarPagamentoAbertosPorCliente($Json=true){
        $dao = new PagamentoDao();
        $lista = $dao->ListarPagamentoAbertosPorCliente($_SESSION['cod_usuario'], $_SESSION['cod_cliente_final']);        
        if ($lista[0]){
            if ($lista[1]!=null){
                $lista = BaseModel::AtualizaDataInArray($lista, 'DTA_VENCIMENTO');
            }
        }        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }

    Public Function ListarPagamentoAbertos($Json=true){
        $dao = new PagamentoDao();
        $lista = $dao->ListarPagamentoAbertos($_SESSION['cod_cliente_final']);        
        if ($lista[0]){
            if ($lista[1]!=null){
                $lista = BaseModel::AtualizaDataInArray($lista, 'DTA_VENCIMENTO');
            }
        }
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
    
    Public Function DadosCliente($Json=true){
        $dao = new PagamentoDao();
        $lista = $dao->DadosCliente($_SESSION['cod_cliente_final']);        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
    
    Public Function DadosClienteEmail($Json=true){
        $dao = new PagamentoDao();
        $lista = $dao->DadosClienteEmail();        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }

    Public Function DadosPessoa($Json=true){        
        $dao = new PagamentoDao();
        $lista = $dao->DadosPessoa($_SESSION['cod_usuario'], $_SESSION['cod_cliente_final'], $_SESSION['cod_loja']);
        if ($lista[0]){
            if ($lista[1][0]['DIAS_ATRASO']>0){
                $lista[1][0]['VLR_MENSALIDADE'] = ($lista[1][0]['VLR_MENSALIDADE']+$lista[1][0]['VLR_MULTA'])+(($lista[1][0]['VLR_MENSALIDADE']*$lista[1][0]['VLR_JUROS']*$lista[1][0]['DIAS_ATRASO'])/100);
                $lista[1][0]['DTA_VENCIMENTO'] = date('d/m/Y');
            }else{
                $lista = BaseModel::AtualizaDataInArray($lista, 'DTA_VENCIMENTO');
            }
        }        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }

    Public Function DadosPessoaEmail($Json=true){
        $dao = new PagamentoDao();
        $lista = $dao->DadosPessoaEmail($_SESSION['cod_loja']);
        if ($lista[0]){
            if ($lista[1][0]['DIAS_ATRASO']>0){
                echo $lista[1][0]['DIAS_ATRASO'];
                $lista[1][0]['VLR_MENSALIDADE'] = ($lista[1][0]['VLR_MENSALIDADE']+$lista[1][0]['VLR_MULTA'])+(($lista[1][0]['VLR_MENSALIDADE']*$lista[1][0]['VLR_JUROS']*$lista[1][0]['DIAS_ATRASO'])/100);
                $lista[1][0]['DTA_VENCIMENTO'] = date('d/m/Y');
            }else{
                $lista = BaseModel::AtualizaDataInArray($lista, 'DTA_VENCIMENTO');
            }
        }        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }  

    Public Function DadosPessoaGeral($Json=true){
        $dao = new PagamentoDao();
        $lista = $dao->DadosPessoaGeral($_SESSION['cod_loja']);
        if ($lista[0]){
            if ($lista[1][0]['DIAS_ATRASO']>0){
                $lista[1][0]['VLR_MENSALIDADE'] = ($lista[1][0]['VLR_MENSALIDADE']+$lista[1][0]['VLR_MULTA'])+(($lista[1][0]['VLR_MENSALIDADE']*$lista[1][0]['VLR_JUROS']*$lista[1][0]['DIAS_ATRASO'])/100);
                $lista[1][0]['DTA_VENCIMENTO'] = date('d/m/Y');
            }else{
                $lista = BaseModel::AtualizaDataInArray($lista, 'DTA_VENCIMENTO');
            }
        }        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }     
    
}
