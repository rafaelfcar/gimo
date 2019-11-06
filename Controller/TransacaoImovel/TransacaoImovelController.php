<?
include_once("../BaseController.php");
include_once("../../Model/TransacaoImovel/TransacaoImovelModel.php");
include_once("../../Model/Uf/UfModel.php");
include_once("../../Model/Cidade/CidadeModel.php");
include_once("../../Model/Bairro/BairroModel.php");
include_once("../../Model/Cliente/ClienteModel.php");
class TransacaoImovelController extends BaseController
{
    function TransacaoImovelController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de  de TransacaoImovel
     */
    Public Function ChamaView(){      
        $params = array();  
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }
	
    Public Function InsertTransacaoImovel(){
        $TransacaoImovelModel = new TransacaoImovelModel();
        echo $TransacaoImovelModel->InsertTransacaoImovel();
    }

    Public Function UpdateTransacaoImovel(){
        $TransacaoImovelModel = new TransacaoImovelModel();
        echo $TransacaoImovelModel->UpdateTransacaoImovel();
    }
    
    Public Function ListarImovelDisponivel(){
        $ImovelModel = new TransacaoImovelModel();
        echo $ImovelModel->ListarImovelDisponivel();
    }
    
    Public Function ListarImovelInDisponivel(){
        $ImovelModel = new TransacaoImovelModel();
        echo $ImovelModel->ListarImovelInDisponivel();
    }
}
$loginController = new TransacaoImovelController();