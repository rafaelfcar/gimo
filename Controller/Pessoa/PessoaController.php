<?
include_once("../BaseController.php");
include_once("../../Model/Pessoa/PessoaModel.php");
include_once("../../Model/Uf/UfModel.php");
include_once("../../Model/Cidade/CidadeModel.php");
include_once("../../Model/Bairro/BairroModel.php");
class PessoaController extends BaseController
{
    function PessoaController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de  de Pessoa
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
     * Utilizada na tela PessoaView.js
     */
    Public Function ListarPessoa(){
        $PessoaModel = new PessoaModel();
        echo $PessoaModel->ListarPessoa();
    }
    
    Public Function ListarPessoaPorNome(){
        $PessoaModel = new PessoaModel();
        echo $PessoaModel->ListarPessoaPorNome();
    }
    
    Public Function ListarPessoaGrid(){
        $PessoaModel = new PessoaModel();
        echo $PessoaModel->ListarPessoaGrid();
    }
	
    Public Function InsertPessoa(){
        $PessoaModel = new PessoaModel();
        echo $PessoaModel->InsertPessoa();
    }

    Public Function UpdatePessoa(){
        $PessoaModel = new PessoaModel();
        echo $PessoaModel->UpdatePessoa();
    }	
}
$loginController = new PessoaController();