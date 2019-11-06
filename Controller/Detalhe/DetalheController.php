<?
include_once("../BaseController.php");
include_once("../../Model/Detalhe/DetalheModel.php");
class DetalheController extends BaseController
{
    function DetalheController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de  de Detalhe
     */
    Public Function ChamaView(){
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    /**
     * Retorna a lista de departamentos
     * Utilizada na tela DetalheView.js
     */
    Public Function ListarDetalhe(){
        $DetalheModel = new DetalheModel();
        echo $DetalheModel->ListarDetalhe();
    }
    
    Public Function ListarDetalheImovel(){
        $DetalheModel = new DetalheModel();
        echo $DetalheModel->ListarDetalheImovel();
    }
	
    Public Function InsertDetalhe(){
        $lojaModel = new DetalheModel();
        echo $lojaModel->InsertDetalhe();
    }

    Public Function UpdateDetalhe(){
        $lojaModel = new DetalheModel();
        echo $lojaModel->UpdateDetalhe();
    }	
}
$loginController = new DetalheController();