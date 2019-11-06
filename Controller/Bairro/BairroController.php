<?
include_once("../BaseController.php");
include_once("../../Model/Bairro/BairroModel.php");
include_once("../../Model/Uf/UfModel.php");
include_once("../../Model/Cidade/CidadeModel.php");
class BairroController extends BaseController
{
    function BairroController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de  de Bairro
     */
    Public Function ChamaView(){
        $ufModel = new UfModel();
        $cidadeModel = new CidadeModel();
        $listaUf = $ufModel->ListarUf(false);
        $listaCidade = $cidadeModel->SelecionaCidades(false, $listaUf[1][0][0]);
        $params = array('listaUf' => urlencode(serialize($listaUf)),
                        'listaCidade' => urlencode(serialize($listaCidade)));        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    /**
     * Retorna a lista de departamentos
     * Utilizada na tela BairroView.js
     */
    Public Function ListarBairro(){
        $BairroModel = new BairroModel();
        echo $BairroModel->ListarBairro();
    }
    
    Public Function SelecionaBairro(){
        $BairroModel = new BairroModel();
        echo $BairroModel->SelecionaBairro();
    }
    
    Public Function InsertBairro(){
        $lojaModel = new BairroModel();
        echo $lojaModel->InsertBairro();
    }

    Public Function UpdateBairro(){
        $lojaModel = new BairroModel();
        echo $lojaModel->UpdateBairro();
    }	
}
$loginController = new BairroController();