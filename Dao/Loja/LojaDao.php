<?
include_once("../../Dao/BaseDao.php");
class LojaDao extends BaseDao
{
  Public Function LojaDao(){
      $this->conect();
  }

  Public Function ListaLoja($codCliente, $codUsuario){
    try{
        $sql = "SELECT L.COD_LOJA,
                       L.DSC_LOJA,
                       L.CEP,
                       L.ENDERECO,
                       L.BAIRRO,
                       L.COMPLEMENTO,
                       L.IND_CENTRAL,
                       L.COD_CLIENTE,
                       L.SGL_UF,
                       L.NRO_DIA_PAGAMENTO,
                       L.NRO_CNPJ,
                       L.VLR_MENSALIDADE,
                       L.IND_ATIVA
                  FROM EN_LOJA L";  
        if (!$this->IsDesenv($codUsuario)){
            $sql .= " WHERE L.COD_CLIENTE = $codCliente";
        }                  
        $rs_localiza = $this->selectDB("$sql", false);
    }catch(Exception $e){
        echo "erro".$e;
    }
    return $rs_localiza;
  }

    Public Function ListarLojaAtiva(){
        $codCliente = filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT L.COD_LOJA,
                       L.DSC_LOJA,
                       L.CEP,
                       L.ENDERECO,
                       L.BAIRRO,
                       L.COMPLEMENTO,
                       L.IND_CENTRAL,
                       L.COD_CLIENTE,
                       L.SGL_UF,
                       L.NRO_DIA_PAGAMENTO,
                       L.NRO_CNPJ,
                       L.VLR_MENSALIDADE,
                       L.IND_ATIVA
                  FROM EN_LOJA L
                 WHERE L.IND_ATIVA = 'S' 
                   AND L.COD_CLIENTE = $codCliente";           
        $rs_localiza = $this->selectDB("$sql", false);
        return $rs_localiza;
    }
  
  Public Function UpdateLoja(){
    try{
        $sql = "UPDATE EN_LOJA
                   SET DSC_LOJA = '".filter_input(INPUT_POST, 'nmeLoja', FILTER_SANITIZE_STRING)."',
                       CEP = '".filter_input(INPUT_POST, 'nroCep', FILTER_SANITIZE_STRING)."',
                       ENDERECO = '".filter_input(INPUT_POST, 'txtEndereco', FILTER_SANITIZE_STRING)."',
                       BAIRRO = '".filter_input(INPUT_POST, 'txtBairro', FILTER_SANITIZE_STRING)."',
                       COMPLEMENTO = '".filter_input(INPUT_POST, 'txtComplemento', FILTER_SANITIZE_STRING)."',
                       IND_CENTRAL = '".filter_input(INPUT_POST, 'indCentral', FILTER_SANITIZE_STRING)."',
                       COD_CLIENTE = '".filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_STRING)."',
                       NRO_DIA_PAGAMENTO = '".filter_input(INPUT_POST, 'nroDiaPagamento', FILTER_SANITIZE_STRING)."',
                       NRO_CNPJ = '".filter_input(INPUT_POST, 'nroCnpj', FILTER_SANITIZE_STRING)."',
                       VLR_MENSALIDADE = '".filter_input(INPUT_POST, 'vlrMensalidade', FILTER_SANITIZE_STRING)."',
                       IND_ATIVA = '".filter_input(INPUT_POST, 'indAtiva', FILTER_SANITIZE_STRING)."'
                 WHERE COD_LOJA = ".filter_input(INPUT_POST, 'codLoja', FILTER_SANITIZE_STRING);
        $rs_localiza = $this->insertDB("$sql");
    }catch(Exception $e){
        echo "erro".$e;
    }
    return $rs_localiza;
  }

    Public Function InsertLoja(){
        $codLoja = $this->CatchUltimoCodigo("EN_LOJA", "COD_LOJA");
        $sql = "INSERT INTO EN_LOJA (
                       COD_LOJA,
                       DSC_LOJA,
                       CEP,
                       ENDERECO,
                       BAIRRO,
                       COMPLEMENTO,
                       IND_CENTRAL,
                       COD_CLIENTE,
                       SGL_UF,
                       NRO_DIA_PAGAMENTO,
                       NRO_CNPJ,
                       VLR_MENSALIDADE,
                       IND_ATIVA)
                VALUES (
                       $codLoja,
                       '".filter_input(INPUT_POST, 'nmeLoja', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'nroCep', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'txtEndereco', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'txtBairro', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'txtComplemento', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'indCentral', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'sglUf', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'nroDiaPagamento', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'nroCnpj', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'vlrMensalidade', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'indAtiva', FILTER_SANITIZE_STRING)."')"; 
        return $this->insertDB("$sql");
    }
  
    Public Function CarregaGridPagamentos(){ 
        $sql = "SELECT L.COD_LOJA,
                       L.DSC_LOJA,
                       DATE(DTA_BOLETO) AS DTA_BOLETO,
                       DATE(DTA_PAGAMENTO) AS DTA_PAGAMENTO,
                       VLR_BOLETO,
                       IND_VISUALIZA,
                       NRO_NOSSO_NUMERO,
                       L.TXT_EMAIL
                  FROM EN_PAGAMENTO P
                 INNER JOIN EN_LOJA L ON P.COD_LOJA = L.COD_LOJA
                 WHERE L.COD_LOJA = ".  filter_input(INPUT_POST, 'codLoja', FILTER_SANITIZE_NUMBER_INT);  
        return $this->selectDB("$sql", false);
    }

    Public Function CarregaBoleto(){ 
        $sql = "SELECT L.COD_LOJA,
                       L.DSC_LOJA,
                       DATE(DTA_BOLETO) AS DTA_BOLETO,
                       VLR_BOLETO,
                       IND_VISUALIZA,
                       CEP,
                       ENDERECO,
                       BAIRRO,
                       COMPLEMENTO,
                       NRO_CNPJ,
                       SGL_UF,
                       NRO_NOSSO_NUMERO,
                       L.TXT_EMAIL,                       
                       L.ENDERECO
                  FROM EN_PAGAMENTO P
                 INNER JOIN EN_LOJA L ON P.COD_LOJA = L.COD_LOJA
                 WHERE L.COD_LOJA = ".$_REQUEST['codLoja']."
                   AND P.NRO_NOSSO_NUMERO = ".$_REQUEST['nroBoleto'];          
        return $this->selectDB("$sql", false);
    }
    
    Public Function GerarPagamento($nossoNumero){
        $codLoja = filter_input(INPUT_POST, "codLoja", FILTER_SANITIZE_NUMBER_INT);
        $diaMensalidade = $this->PegaDataMensalidade($codLoja);         
        $valorMensalidade = $this->PegaValorMensalidade($codLoja);
        $verificaMensalidade = $this->VerificaMensalidade($codLoja, $diaMensalidade[1][0][0]);
        if (!$verificaMensalidade[0]){
            $sql = "INSERT INTO EN_PAGAMENTO (COD_LOJA, DTA_BOLETO, VLR_BOLETO, NRO_NOSSO_NUMERO)
                                      VALUES (".$codLoja.",'".$diaMensalidade[1][0][0]."',
                                              ".$valorMensalidade[1][0][0].", ".$nossoNumero.")";
            return $this->insertDB($sql);
        }else{
            $ret[0] = false;
            $ret[1] = 'Mensalidade j&aacute; incluida para esta loja neste mes.';
            return $ret;
        }
    }
    
    Public Function PegaDataMensalidade($codLoja){
        $sql = "select date(concat(year(now()),'-', month(now()),'-',nro_dia_pagamento)) as a 
                  from en_loja where cod_loja = $codLoja";
        return $this->selectDB($sql, false);
    }
    
    Public Function PegaValorMensalidade($codLoja){
        $sql = "select vlr_mensalidade
                  from en_loja where cod_loja = $codLoja";
        return $this->selectDB($sql, false);
    }    
    
    Public Function VerificaMensalidade($codLoja, $dtaMensalidade){
        $sql = "SELECT COUNT(*) AS QTD FROM EN_PAGAMENTO
                 WHERE COD_LOJA = $codLoja AND DTA_BOLETO = '$dtaMensalidade'";
        //echo $sql; die;
        $ret = $this->selectDB($sql, false);        
        if ($ret[0]){            
            if ($ret[1][0][0]>0){
                $ret[0]=true;
            }else{
                $ret[0]=false;
            }
        }        
        return $ret;
    }
}