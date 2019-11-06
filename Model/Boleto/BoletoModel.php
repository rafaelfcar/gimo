<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Boleto/BoletoDao.php");
class BoletoModel extends BaseModel
{
    public function BoletoModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarBoleto($Json=true){
        $dao = new BoletoDao();
        $lista = $dao->ListaBoleto($_SESSION['cod_cliente_final'], $_SESSION['cod_usuario']);        
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;        
        }
    }
	
    Public Function InsertBoleto(){
        $dao = new BoletoDao();
        return json_encode($dao->InsertBoleto());
    }

    Public Function UpdateBoleto(){
        $dao = new BoletoDao();
        return json_encode($dao->UpdateBoleto());
    }

    Public Function GerarBoletosMensal(){
        $dao = new BoletoDao();
        $remover = $dao->RemoverBoletos();
        if ($remover[0]){
            $listaBoletos = $dao->ListarTodosBoletos($_SESSION['cod_cliente_final']);        
            if ($listaBoletos[0]){
                if ($listaBoletos[1]!=null){
                    for ($i=0;$i<count($listaBoletos);$i++){            
                        $verificaNossoNumero[1][0]['QTD']=1;
                        while ($verificaNossoNumero[1][0]['QTD']>0){
                            $nossoNumero = '';
                            for($j=0;$j<8;$j++){
                                $nossoNumero .= rand(0, 9);
                            }
                            $verificaNossoNumero = $dao->VerificaNossoNumero($nossoNumero);
                        }
                        $numeroDocumento = date("d").'.'.date("Y").rand(0,9).rand(0,9).'.'.date("m");
                        if (key_exists($i, $listaBoletos[1])){
                            $result = $dao->InsertBoleto($listaBoletos[1][$i]['COD_IMOVEL'], 
                                               $listaBoletos[1][$i]['DTA_PAGAMENTO'], 
                                               $listaBoletos[1][$i]['VLR_TRANSACAO'], 
                                               $numeroDocumento, 
                                               $nossoNumero);
                        }
                    }
                }else{
                    $result = $listaBoletos; 
                }
            }else{
                $result = $listaBoletos;
            }
        }else{
            $result = $remover;
        }
        return json_encode($result);
    }	

    Public Function InformaPagamento(){
        $dao = new BoletoDao();
        return json_encode($dao->InformaPagamento());
    }
    
}
