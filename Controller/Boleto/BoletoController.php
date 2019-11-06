<?
include_once("../BaseController.php");
include_once("../../Model/Boleto/BoletoModel.php");
class BoletoController extends BaseController
{
    function BoletoController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de  de Boleto
     */
    Public Function ChamaView(){
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Public Function ListarBoleto(){
        $BoletoModel = new BoletoModel();
        echo $BoletoModel->ListarBoleto();
    }
    
    Public Function InsertBoleto(){
        $lojaModel = new BoletoModel();
        echo $lojaModel->InsertBoleto();
    }

    Public Function UpdateBoleto(){
        $lojaModel = new BoletoModel();
        echo $lojaModel->UpdateBoleto();
    }	

    Public Function GerarBoletosMensal(){
        $lojaModel = new BoletoModel();
        echo $lojaModel->GerarBoletosMensal();
    }

    Public Function InformaPagamento(){
        $lojaModel = new BoletoModel();
        echo $lojaModel->InformaPagamento();
    }
}
$loginController = new BoletoController();