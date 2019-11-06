<?
include_once("../BaseController.php");
include_once("../../Model/Loja/LojaModel.php");
include_once("../../Model/Cliente/ClienteModel.php");
class LojaController extends BaseController
{
    function LojaController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de  de Loja
     */
    Public Function ChamaView(){
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    /**
     * Retorna a lista de departamentos
     * Utilizada na tela LojaView.js
     */
    Public Function ListarLoja(){
        $LojaModel = new LojaModel();
        echo $LojaModel->ListarLoja();
    }
    
    Public Function ListarLojaAtiva(){
        $LojaModel = new LojaModel();
        echo $LojaModel->ListarLojaAtiva();
    }
    
    /**
     * Retorna a lista de lojas com preço
     */
    Public Function ListarPrecoLoja(){
        $LojaModel = new LojaModel();
        echo $LojaModel->ListarPrecoLoja();        
    }
	
    Public Function InsertLoja(){
        $lojaModel = new LojaModel();
        echo $lojaModel->InsertLoja();
    }

    Public Function UpdateLoja(){
        $lojaModel = new LojaModel();
        echo $lojaModel->UpdateLoja();
    }	

    Public Function CarregaGridPagamentos(){
        $lojaModel = new LojaModel();
        echo $lojaModel->CarregaGridPagamentos();
    }

    Public Function GerarPagamento(){
        $lojaModel = new LojaModel();
        echo $lojaModel->GerarPagamento();
    }
    Public Function EnviaEmail(){
        $lojaModel = new LojaModel();
        date_default_timezone_set('America/Toronto');
        require_once('../../Resources/PHPMailer_5.2.4/class.phpmailer.php');
        $mail             = new PHPMailer();
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username   = "rafaelfcarneiro@gmail.com";  // GMAIL username
        $mail->Password   = "rfm14402";            // GMAIL password
        $mail->SetFrom('rafaelfcarneiro@gmail.com', 'Rafael Freitas Carneiro');
        $mail->AddReplyTo("rafaelfcarneiro@gmail.com","First Last");
        $mail->Subject    = "Sistema de Pedidos";
        $lojas = $lojaModel->CarregaBoleto(false);        
        $texto = '';
        for ($i=0;$i<count($lojas[1]);$i++){
          $texto .= '<a href="'.BaseController::getPath().'/Resources/boletophp/boleto_itauC.php?codLoja='.$lojas[1][$i]['COD_LOJA'].'&dtaAtual='.filter_input(INPUT_POST, 'dtaAtual').'&nroBoleto='.$lojas[1][$i]['NRO_NOSSO_NUMERO'].'">'.$lojas[1][$i]['DSC_LOJA'].'</a><br>';
        }
        $mail->MsgHTML($texto);
        $address = "rafaelfcarneiro@gmail.com";
        $mail->AddAddress($address, "Rafael");        
        if(!$mail->Send()) {
          $return = array("msg"=>"Mailer Error: " . $mail->ErrorInfo,
                          "retorno"=>false);
        } else {
          $return = array("msg"=>"sucesso",
                          "retorno"=>true);
        }
        echo json_encode($return);
    }
}
$loginController = new LojaController();