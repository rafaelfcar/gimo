<?
include_once("../BaseController.php");
include_once("../../Model/Banco/BancoModel.php");
class BancoController extends BaseController
{
    function BancoController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de  de Banco
     */
    Public Function ChamaView(){
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    /**
     * Retorna a lista de departamentos
     * Utilizada na tela BancoView.js
     */
    Public Function ListarBanco(){
        $BancoModel = new BancoModel();
        echo $BancoModel->ListarBanco();
    }
    
	
    Public Function InsertBanco(){
        $lojaModel = new BancoModel();
        echo $lojaModel->InsertBanco();
    }

    Public Function UpdateBanco(){
        $lojaModel = new BancoModel();
        echo $lojaModel->UpdateBanco();
    }	
}
$loginController = new BancoController();