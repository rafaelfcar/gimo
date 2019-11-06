<?
include_once("../BaseController.php");
include_once("../../Model/Cidade/CidadeModel.php");
include_once("../../Model/Uf/UfModel.php");
class CidadeController extends BaseController
{
    function CidadeController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de  de Cidade
     */
    Public Function ChamaView(){
        $ufModel = new UfModel();
        $listaUf = $ufModel->ListarUf(false);
        $params = array('listaUf' => urlencode(serialize($listaUf)));        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    /**
     * Retorna a lista de departamentos
     * Utilizada na tela CidadeView.js
     */
    Public Function ListarCidade(){
        $CidadeModel = new CidadeModel();
        echo $CidadeModel->ListarCidade();
    }
    
    Public Function SelecionaCidades(){
        $CidadeModel = new CidadeModel();
        echo $CidadeModel->SelecionaCidades();        
    }
	
    Public Function InsertCidade(){
        $lojaModel = new CidadeModel();
        echo $lojaModel->InsertCidade();
    }

    Public Function UpdateCidade(){
        $lojaModel = new CidadeModel();
        echo $lojaModel->UpdateCidade();
    }	
}
$loginController = new CidadeController();