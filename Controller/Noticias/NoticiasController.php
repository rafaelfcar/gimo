<?
include_once("../BaseController.php");
include_once("../../Model/Noticias/NoticiasModel.php");
class NoticiasController extends BaseController
{
    function NoticiasController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de Noticias
     */
    Public Function ChamaView(){
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    /**
     * Retorna uma lista de registros da tabela EN_NOTICIAS
     */
    Public Function ListarNoticias(){
        $noticiasModel = new NoticiasModel();
        echo $noticiasModel->ListarNoticias();
    }

    /**
     * Atualiza um registro da tabela EN_NOTICIAS
     */
    Public Function UpdateNoticia(){        
        $noticiasModel = new NoticiasModel();
        echo $noticiasModel->UpdateNoticia();
    }
    
    /**
     * Insere um registro na tabela EN_NOTICIAS
     */
    Public Function InsertNoticias(){
        $noticiasModel = new NoticiasModel();
        echo $noticiasModel->InsertNoticia();
    }
}
$loginController = new NoticiasController();
?>