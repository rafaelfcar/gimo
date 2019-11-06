<?
include_once("../BaseController.php");
class ContratoController extends BaseController
{
    function ContratoController(){
        eval("\$this->".BaseController::getMethod()."();");
    }
    
    Private Function ChamaView(){
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }
}
$loginController = new ContratoController();