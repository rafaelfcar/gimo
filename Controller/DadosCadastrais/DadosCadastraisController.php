<?
include_once("../BaseController.php");
include_once("../../Model/DadosCadastrais/DadosCadastraisModel.php");
class DadosCadastraisController extends BaseController
{
    function DadosCadastraisController(){
        eval("\$this->".BaseController::getMethod()."();");
    }
    
    Public Function ChamaView(){
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }
    
    Public Function ListarDadosCadastrais(){
        $DadosCadastraisModel = new DadosCadastraisModel();
        echo $DadosCadastraisModel->ListarDadosCadastrais();
    }
    
    Public Function UpdateDadosCadastrais(){
        $lojaModel = new DadosCadastraisModel();
        echo $lojaModel->UpdateDadosCadastrais();
    }	
}
$loginController = new DadosCadastraisController();