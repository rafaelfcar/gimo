<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Pessoa/PessoaDao.php");
class PessoaModel extends BaseModel
{
    public function PessoaModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarPessoa($Json=true){
        $dao = new PessoaDao();
        $lista = $dao->ListaPessoa($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario']);        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }

    Public Function ListarPessoaPorNome($Json=true){
        $dao = new PessoaDao();
        $lista = $dao->ListarPessoaPorNome($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario']);        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }

    Public Function ListarPessoaGrid($Json=true){
        $dao = new PessoaDao();
        $lista = $dao->ListaPessoaGrid($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario']);   
        for($i=0;$i<count($lista[1]);$i++ ) {
            $data[] = array(
                'value' => $lista[1][$i]['NME_PESSOA'],
                'label' => $lista[1][$i]['NME_PESSOA'].' CPF: '.$lista[1][$i]['NRO_CPF'],
                'id' => $lista[1][$i]['COD_PESSOA']
            );
            $i++;
        }
        if (empty($lista[1])){
            $data[] = array(
                'value' => '',
                'label' => 'Sem dados para a pesquisa',
                'id' => 0
            );
        }                       
        if ($Json){
            return json_encode($data);
        }else{
            return $data;        
        }
    }
    
    Public Function InsertPessoa(){
        $dao = new PessoaDao();
        $result = $dao->VerificaCpf($_SESSION['cod_cliente_final']);
        if ($result[0]){
            if ($result[1][0]['QTD']>0){
                $result[0] = false;
                $result[1] = 'CPF j&aacute; cadastrado!';
                return json_encode($result);
            }
        }
        $result = $dao->InsertPessoa($_SESSION['cod_cliente_final']);
        if ($result[0]){
            $dao->AddLoginCliente($_SESSION['cod_loja']);
        }        
        return json_encode($result);
    }

    Public Function UpdatePessoa(){
        $dao = new PessoaDao();
        $result = $dao->VerificaCpf($_SESSION['cod_cliente_final']);
        if ($result[0]){
            if ($result[1][0]['QTD']>0){
                $result[0] = false;
                $result[1] = 'CPF j&aacute; cadastrado!';
                return json_encode($result);
            }
        }
        $result = $dao->UpdatePessoa($_SESSION['cod_cliente_final']);
        if ($result[0]){
            $dao->UpdateLogin($_SESSION['cod_loja']);
        }         
        return json_encode($result);
    }
    
}
