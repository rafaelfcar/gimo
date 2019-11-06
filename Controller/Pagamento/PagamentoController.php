<?
include_once("../BaseController.php");
include_once("../../Model/Pagamento/PagamentoModel.php");
class PagamentoController extends BaseController
{
    function PagamentoController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

    /**
     * Redireciona para a Tela de  de Pagamento
     */
    Public Function ChamaView(){
        $params = array();  
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Public Function ListarPagamentoAbertosPorCliente(){
        $PagamentoModel = new PagamentoModel();
        echo $PagamentoModel->ListarPagamentoAbertosPorCliente();
    }

    Public Function ListarPagamentoAbertos(){
        $PagamentoModel = new PagamentoModel();
        echo $PagamentoModel->ListarPagamentoAbertos();
    }
    
    Public Function GerarBoletoEmail(){
        $pagamentoModel = new PagamentoModel();
        $dadosCliente = $pagamentoModel->DadosClienteEmail(false);
        $dadosPessoa = $pagamentoModel->DadosPessoaEmail(false);
        $params = array('dadosCliente' => urlencode(serialize($dadosCliente[1])),
                        'dadosPessoa' => urlencode(serialize($dadosPessoa[1])));  
        echo ($this->gen_redirect_and_form('../../Resources/boletophp/'.$dadosCliente[1][0]['DSC_ARQUIVO_BOLETO'], $params));    
    }
    
    Public Function GerarBoleto(){
        $pagamentoModel = new PagamentoModel();
        $dadosCliente = $pagamentoModel->DadosCliente(false);
        $dadosPessoa = $pagamentoModel->DadosPessoa(false);
        $params = array('dadosCliente' => urlencode(serialize($dadosCliente[1])),
                        'dadosPessoa' => urlencode(serialize($dadosPessoa[1])));  
//        echo ($this->gen_redirect_and_form('../../Resources/boletophp/'.$dadosCliente[1][0]['DSC_ARQUIVO_BOLETO'], $params));
    }
    
    Public Function GerarBoletoGeral(){
        $pagamentoModel = new PagamentoModel();
        $dadosCliente = $pagamentoModel->DadosCliente(false);
        $dadosPessoa = $pagamentoModel->DadosPessoaGeral(false);      
        $params = array('dadosCliente' => urlencode(serialize($dadosCliente[1])),
                        'dadosPessoa' => urlencode(serialize($dadosPessoa[1])));  
        echo ($this->gen_redirect_and_form('../../Resources/boletophp/'.$dadosCliente[1][0]['DSC_ARQUIVO_BOLETO'], $params));
    }
    
    Public Function EnviarEmail(){
        $PagamentoModel = new PagamentoModel();
        date_default_timezone_set('America/Toronto');
        require_once('../../Resources/PHPMailer_5.2.4/class.phpmailer.php');
        $mail             = new PHPMailer();
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username   = "sistemagimo@gmail.com";  // GMAIL username
        $mail->Password   = "rfm14402";            // GMAIL password
        $mail->SetFrom('noreply@noreply.com', 'Sistema GIMO');
        $mail->AddReplyTo("noreply@noreply.com","NoReply");
        $mail->Subject    = "Sistema de Pedidos";        
        $listaPagamentos = $PagamentoModel->ListarPagamentoAbertos(false);
        if ($listaPagamentos[0]){
            if ($listaPagamentos[1]!=null){
                for($i=0;$i<count($listaPagamentos[1]);$i++){
                    $texto = '<a href="'.BaseController::getPath().'/Controller/Pagamento/PagamentoController.php?method=GerarBoletoEmail&nossoNumero='.$listaPagamentos[1][$i]['NRO_NOSSO_NUMERO'].'">'.$listaPagamentos[1][$i]['DTA_VENCIMENTO'].'</a><br>';
                    $mail->MsgHTML($texto);
                    $address = $listaPagamentos[1][$i]['TXT_EMAIL'];
                    $mail->AddAddress($address, $listaPagamentos[1][$i]['NME_PESSOA']);        
                    if(!$mail->Send()) {
                      $return = array("msg"=>"Mailer Error: " . $mail->ErrorInfo,
                                      "retorno"=>false);
                    } else {
                      $return = array("msg"=>"sucesso",
                                      "retorno"=>true);
                    }            
                }
            }else{
                $return = array("msg"=>"Sem dados para enviar boletos",
                                "retorno"=>false);
            }
        }else{
            $return = array("msg"=>"Erro ao buscar dados",
                            "retorno"=>false);
        }

        echo json_encode($return);
    }
    
    Public Function EnviarEmailCliente(){
        $nroNossoNumero = filter_input(INPUT_POST, 'nroNossoNumero', FILTER_SANITIZE_STRING);
        $dtaVencimento = filter_input(INPUT_POST, 'dtaVencimento', FILTER_SANITIZE_STRING);
        $txtEmail = filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_STRING);
        $nmePessoa = filter_input(INPUT_POST, 'nmePessoa', FILTER_SANITIZE_STRING);        
        date_default_timezone_set('America/Toronto');
        require_once('../../Resources/PHPMailer_5.2.4/class.phpmailer.php');
        $mail             = new PHPMailer();
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username   = "sistemagimo@gmail.com";  // GMAIL username
        $mail->Password   = "rfm14402";            // GMAIL password
        $mail->SetFrom('noreply@noreply.com', 'Sistema GIMO');
        $mail->AddReplyTo("noreply@noreply.com","NoReply");
        $mail->Subject    = "Sistema de Pedidos";        
        $texto = '<a href="'.BaseController::getPath().'/Controller/Pagamento/PagamentoController.php?method=GerarBoletoEmail&nossoNumero='.$nroNossoNumero.'">'.$dtaVencimento.'</a><br>';
        $mail->MsgHTML($texto);
        $address = $txtEmail;
        $mail->AddAddress($address, $nmePessoa);        
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
$loginController = new PagamentoController();