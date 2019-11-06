<?
include_once("../BaseController.php");
include_once("../../Model/Cliente/ClienteModel.php");
class ClienteController extends BaseController
{
  function ClienteController(){
    eval("\$this->".BaseController::getMethod()."();");
  }

    /**
     * Redireciona para a view de  de Cliente
     */
    Public Function ChamaView(){      
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    /**
     * Retorna uma lista de Cliente.
     * Utilizada na ClienteView.js
     */
    Public Function ListarCliente(){
        $ClienteModel = new ClienteModel();
        echo $ClienteModel->ListarCliente();
    }

    /**
     * Atualiza um registro no banco de dados, na tabela classificacao
     * Utilizado na ClienteView.js
     */
    Public Function UpdateCliente(){
        $ClienteModel = new ClienteModel();
        echo $ClienteModel->UpdateCliente();
    }

    /**
     * Insere um registro no banco de dados, na tabela classificacao
     * Utilizado na ClienteView.js
     */
    Public Function InsertCliente(){
        $ClienteModel = new ClienteModel();
        echo $ClienteModel->InsertCliente();
    }

    Public Function uploadArquivo(){      
        $arquivo = $_FILES['arquivo'];
        $tipos = array('jpg', 'png', 'gif', 'psd', 'bmp');
        $enviar = $this->uploadFile($arquivo, '../../Resources/images/', $tipos);
        $data['sucesso'] = false;
        if(isset($enviar['erro'])){
            $data['msg'] = $enviar['erro'];
        }else{
            $data['sucesso'] = true;
            $data['msg'] = $enviar['caminho'];
        }
        echo json_encode($data);
    }

    function uploadFile($arquivo, $pasta, $tipos, $nome = null){
        $nomeOriginal='';
        if(isset($arquivo)){
            $infos = explode(".", $arquivo["name"]);

            if(!$nome){
                for($i = 0; $i < count($infos) - 1; $i++){
                    $nomeOriginal = $nomeOriginal . $infos[$i] . ".";
                }
            }
            else{
                $nomeOriginal = $nome . ".";
            }
            $tipoArquivo = $infos[count($infos) - 1];

            $tipoPermitido = false;
            foreach($tipos as $tipo){
                if(strtolower($tipoArquivo) == strtolower($tipo)){
                    $tipoPermitido = true;
                }
            }
            if(!$tipoPermitido){
                $retorno["erro"] = "Tipo nÃ£o permitido";
            }
            else{
                if(move_uploaded_file($arquivo['tmp_name'], $pasta . $nomeOriginal . $tipoArquivo)){
                    $retorno["caminho"] = $pasta . $nomeOriginal . $tipoArquivo;
                }
                else{
                    $retorno["erro"] = "Erro ao fazer upload";
                }
            }
        }
        else{
            $retorno["erro"] = "Arquivo nao setado";
        }
        return $retorno;
    }
}
$ClienteController = new ClienteController();