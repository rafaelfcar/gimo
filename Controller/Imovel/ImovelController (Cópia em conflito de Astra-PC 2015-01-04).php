<?
include_once("../BaseController.php");
include_once("../../Model/Imovel/ImovelModel.php");
include_once("../../Model/Uf/UfModel.php");
include_once("../../Model/Cidade/CidadeModel.php");
include_once("../../Model/Bairro/BairroModel.php");
include_once("../../Model/Cliente/ClienteModel.php");
class ImovelController extends BaseController
{
    function ImovelController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de  de Imovel
     */
    Public Function ChamaView(){
        $ufModel = new UfModel();
        $cidadeModel = new CidadeModel();
        $bairroModel = new BairroModel();
        $listaUf = $ufModel->ListarUf(false);
        $listaCidade = $cidadeModel->SelecionaCidades(false, $listaUf[1][0][0]);
        $listaBairro = $bairroModel->SelecionaBairro(false, $listaCidade[1][0][0]);        
        $params = array('listaUf' => urlencode(serialize($listaUf)),
                        'listaCidade' => urlencode(serialize($listaCidade)),
                        'listaBairro' => urlencode(serialize($listaBairro)));  
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    /**
     * Retorna a lista de departamentos
     * Utilizada na tela ImovelView.js
     */
    Public Function ListarImovel(){
        $ImovelModel = new ImovelModel();
        echo $ImovelModel->ListarImovel();
    }
	
    Public Function InsertImovel(){
        $ImovelModel = new ImovelModel();
        echo $ImovelModel->InsertImovel();
    }

    Public Function UpdateImovel(){
        $ImovelModel = new ImovelModel();
        echo $ImovelModel->UpdateImovel();
    }	
    
    Public Function SalvarDetalhesImovel(){
        $ImovelModel = new ImovelModel();
        echo $ImovelModel->SalvarDetalhesImovel();
    }
    
    Public Function CarregaHistoricoImovel(){
        $ImovelModel = new ImovelModel();
        echo $ImovelModel->CarregaHistoricoImovel();
    }
}
$loginController = new ImovelController();