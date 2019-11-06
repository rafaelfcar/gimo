<?
include_once("../BaseController.php");
include_once("../../Model/Uf/UfModel.php");
class UfController extends BaseController
{
    function UfController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de  de Uf
     */
    Public Function ChamaView(){
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    /**
     * Retorna a lista de departamentos
     * Utilizada na tela UfView.js
     */
    Public Function ListarUf(){
        $UfModel = new UfModel();
        echo $UfModel->ListarUf();
    }
    
	
    Public Function InsertUf(){
        $lojaModel = new UfModel();
        echo $lojaModel->InsertUf();
    }

    Public Function UpdateUf(){
        $lojaModel = new UfModel();
        echo $lojaModel->UpdateUf();
    }	
}
$loginController = new UfController();