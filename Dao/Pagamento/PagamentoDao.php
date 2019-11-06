<?
include_once("../../Dao/BaseDao.php");
class PagamentoDao extends BaseDao
{
    Public Function PagamentoDao(){
        $this->conect();
    }

    Public Function ListarPagamentoAbertosPorCliente($codUsuario, $codCliente){
        $sql = "SELECT IP.DTA_VENCIMENTO,
                       IP.NRO_NOSSO_NUMERO,
                       IP.NRO_DOCUMENTO,
                       IP.VLR_MENSALIDADE,
                       P.NME_PESSOA,
                       P.TXT_EMAIL
                  FROM RE_IMOVEL_PAGAMENTO IP
                 INNER JOIN EN_IMOVEL I
                    ON IP.COD_IMOVEL = I.COD_IMOVEL
                 INNER JOIN RE_IMOVEL_PESSOA IPE
                    ON IP.COD_IMOVEL = IPE.COD_IMOVEL
                 INNER JOIN EN_PESSOAS P
                    ON IPE.COD_PESSOA = P.COD_PESSOA
                 WHERE IPE.COD_PESSOA = (SELECT COD_PESSOA
                                       FROM EN_PESSOAS P
                                      INNER JOIN SE_USUARIO U
                                         ON P.NRO_CPF = U.NRO_CPF
                                      WHERE COD_USUARIO = $codUsuario
                                        AND P.COD_CLIENTE = $codCliente)
                   AND IP.DTA_PAGAMENTO IS NULL";         
        return $this->selectDB("$sql", false);
    }

    Public Function ListarPagamentoAbertos($codCliente){
        $nroMesReferencia = filter_input(INPUT_POST, 'nroMesReferencia');
        if ($nroMesReferencia<10){
            $nroMesReferencia = '0'.$nroMesReferencia;
        }
        $nroAnoReferencia = filter_input(INPUT_POST, 'nroAnoReferencia');
        $sql = "SELECT DISTINCT IP.DTA_VENCIMENTO,
                       IP.NRO_NOSSO_NUMERO,
                       IP.NRO_DOCUMENTO,
                       IP.VLR_MENSALIDADE,
                       P.NME_PESSOA,
                       P.TXT_EMAIL
                  FROM RE_IMOVEL_PAGAMENTO IP
                 INNER JOIN EN_IMOVEL I
                    ON IP.COD_IMOVEL = I.COD_IMOVEL
                 INNER JOIN RE_IMOVEL_PESSOA IPE
                    ON IP.COD_IMOVEL = IPE.COD_IMOVEL
                 INNER JOIN EN_PESSOAS P
                    ON IPE.COD_PESSOA = P.COD_PESSOA
                 WHERE IPE.COD_PESSOA IN (SELECT COD_PESSOA
                                       FROM EN_PESSOAS P
                                      WHERE P.COD_CLIENTE = $codCliente)
                   AND (MONTH(IP.DTA_VENCIMENTO) = $nroMesReferencia 
                   AND  YEAR(IP.DTA_VENCIMENTO) = $nroAnoReferencia)
                   AND IP.DTA_PAGAMENTO IS NULL";  
        return $this->selectDB("$sql", false);
    }

    Public Function DadosCliente($codCliente){
        $sql = "SELECT NME_CLIENTE,
                    NRO_CNPJ,
                    TXT_ENDERECO,
                    NME_BANCO,
                    NRO_AGENCIA,
                    NRO_CONTA_CORRENTE,
                    DSC_ARQUIVO_BOLETO
               FROM EN_CLIENTE C
              INNER JOIN EN_BANCO B
                 ON C.COD_BANCO = B.COD_BANCO
              WHERE COD_CLIENTE = $codCliente";  
        return $this->selectDB("$sql", false);
    }

    Public Function DadosClienteEmail(){
        $nroNossoNumero = $_REQUEST['nossoNumero'];
        $sql = "SELECT NME_CLIENTE,
                    NRO_CNPJ,
                    TXT_ENDERECO,
                    NME_BANCO,
                    NRO_AGENCIA,
                    NRO_CONTA_CORRENTE,
                    DSC_ARQUIVO_BOLETO
               FROM EN_CLIENTE C
              INNER JOIN EN_BANCO B
                 ON C.COD_BANCO = B.COD_BANCO
              WHERE COD_CLIENTE = (SELECT COD_CLIENTE
                                     FROM RE_IMOVEL_PAGAMENTO IP
                                    INNER JOIN RE_IMOVEL_PESSOA IPE
                                       ON IP.COD_IMOVEL = IPE.COD_IMOVEL
                                    INNER JOIN EN_PESSOAS P
                                       ON IPE.COD_PESSOA = P.COD_PESSOA
                                    WHERE IP.NRO_NOSSO_NUMERO = '".$nroNossoNumero."')";  
        return $this->selectDB("$sql", false);
    }

    Public Function DadosPessoa($codUsuario, $codCliente, $codLoja){
        $sql = "SELECT IP.DTA_VENCIMENTO,
                       DATEDIFF(NOW(),IP.DTA_VENCIMENTO) AS DIAS_ATRASO,
                       IP.VLR_MENSALIDADE,
                       IP.NRO_NOSSO_NUMERO,
                       IP.NRO_DOCUMENTO,
                       P.NME_PESSOA,
                       P.TXT_ENDERECO,
                       B.NME_BAIRRO,
                       C.NME_CIDADE,
                       C.SGL_UF,
                       P.NRO_CEP,
                       L.TXT_EMAIL,
                       Cl.VLR_MULTA,
                       Cl.VLR_JUROS,
                       DATE_FORMAT(IP.DTA_VENCIMENTO, '%m') AS MES_REFERENCIA,
                       DATE_FORMAT(IP.DTA_VENCIMENTO, '%y') AS ANO_REFERENCIA
                  FROM RE_IMOVEL_PAGAMENTO IP
                 INNER JOIN RE_IMOVEL_PESSOA IPE
                    ON IP.COD_IMOVEL = IPE.COD_IMOVEL
                 INNER JOIN EN_PESSOAS P
                    ON IPE.COD_PESSOA = P.COD_PESSOA
                 INNER JOIN EN_BAIRRO B
                    ON P.COD_BAIRRO = B.COD_BAIRRO
                 INNER JOIN EN_CIDADE C
                    ON B.COD_CIDADE = C.COD_CIDADE
                 INNER JOIN SE_USUARIO U
                    ON P.NRO_CPF = U.NRO_CPF
                 INNER JOIN EN_CLIENTE Cl
                    ON P.COD_CLIENTE = Cl.COD_CLIENTE
                 INNER JOIN EN_LOJA L
                    ON CL.COD_CLIENTE = L.COD_CLIENTE
                   AND L.COD_LOJA = $codLoja
                 WHERE P.COD_PESSOA = (SELECT COD_PESSOA
                                       FROM EN_PESSOAS P
                                      INNER JOIN SE_USUARIO U
                                         ON P.NRO_CPF = U.NRO_CPF
                                      WHERE COD_USUARIO = $codUsuario
                                        AND P.COD_CLIENTE = $codCliente)";  
        return $this->selectDB("$sql", false);
    }

    Public Function DadosPessoaEmail($codLoja){
        $nroNossoNumero = $_REQUEST['nossoNumero'];
        $sql = "SELECT IP.DTA_VENCIMENTO,
                       DATEDIFF(NOW(),IP.DTA_VENCIMENTO) AS DIAS_ATRASO,
                       IP.VLR_MENSALIDADE,
                       IP.NRO_NOSSO_NUMERO,
                       IP.NRO_DOCUMENTO,
                       P.NME_PESSOA,
                       P.TXT_ENDERECO,
                       B.NME_BAIRRO,
                       C.NME_CIDADE,
                       C.SGL_UF,
                       P.NRO_CEP,
                       L.TXT_EMAIL,
                       Cl.VLR_MULTA,
                       Cl.VLR_JUROS,
                       DATE_FORMAT(IP.DTA_VENCIMENTO, '%m') AS MES_REFERENCIA,
                       DATE_FORMAT(IP.DTA_VENCIMENTO, '%y') AS ANO_REFERENCIA
                  FROM RE_IMOVEL_PAGAMENTO IP
                 INNER JOIN RE_IMOVEL_PESSOA IPE
                    ON IP.COD_IMOVEL = IPE.COD_IMOVEL
                 INNER JOIN EN_PESSOAS P
                    ON IPE.COD_PESSOA = P.COD_PESSOA
                 INNER JOIN EN_BAIRRO B
                    ON P.COD_BAIRRO = B.COD_BAIRRO
                 INNER JOIN EN_CIDADE C
                    ON B.COD_CIDADE = C.COD_CIDADE
                 INNER JOIN SE_USUARIO U
                    ON P.NRO_CPF = U.NRO_CPF
                 INNER JOIN EN_CLIENTE Cl
                    ON P.COD_CLIENTE = Cl.COD_CLIENTE
                 INNER JOIN EN_LOJA L
                    ON CL.COD_CLIENTE = L.COD_CLIENTE
                   AND L.COD_LOJA = $codLoja
                 WHERE IP.NRO_NOSSO_NUMERO = '".$nroNossoNumero."'";          
        return $this->selectDB("$sql", false);
    }

    Public Function DadosPessoaGeral($codLoja){
        $nroNossoNumero = $_REQUEST['nossoNumero'];
        $sql = "SELECT IP.DTA_VENCIMENTO,
                       DATEDIFF(NOW(),IP.DTA_VENCIMENTO) AS DIAS_ATRASO,
                       IP.VLR_MENSALIDADE,
                       IP.NRO_NOSSO_NUMERO,
                       IP.NRO_DOCUMENTO,
                       P.NME_PESSOA,
                       P.TXT_ENDERECO,
                       B.NME_BAIRRO,
                       C.NME_CIDADE,
                       C.SGL_UF,
                       P.NRO_CEP,
                       L.TXT_EMAIL,
                       Cl.VLR_MULTA,
                       Cl.VLR_JUROS,
                       DATE_FORMAT(IP.DTA_VENCIMENTO, '%m') AS MES_REFERENCIA,
                       DATE_FORMAT(IP.DTA_VENCIMENTO, '%y') AS ANO_REFERENCIA
                  FROM RE_IMOVEL_PAGAMENTO IP
                 INNER JOIN RE_IMOVEL_PESSOA IPE
                    ON IP.COD_IMOVEL = IPE.COD_IMOVEL
                 INNER JOIN EN_PESSOAS P
                    ON IPE.COD_PESSOA = P.COD_PESSOA
                 INNER JOIN EN_BAIRRO B
                    ON P.COD_BAIRRO = B.COD_BAIRRO
                 INNER JOIN EN_CIDADE C
                    ON B.COD_CIDADE = C.COD_CIDADE
                 INNER JOIN EN_CLIENTE Cl
                    ON P.COD_CLIENTE = Cl.COD_CLIENTE
                 INNER JOIN EN_LOJA L
                    ON CL.COD_CLIENTE = L.COD_CLIENTE
                   AND L.COD_LOJA = $codLoja
                 WHERE IP.NRO_NOSSO_NUMERO = '".$nroNossoNumero."'";          
        return $this->selectDB("$sql", false);
    }
}