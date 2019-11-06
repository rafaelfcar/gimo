<?
include_once("../../Dao/BaseDao.php");
class PessoaDao extends BaseDao
{
    Public Function PessoaDao(){
        $this->conect();
    }

    Public Function ListaPessoa($codCliente, $codUsuario){    
        $sql = "SELECT COD_PESSOA,
                     NME_PESSOA,
                     NRO_CPF,
                     TXT_ENDERECO,
                     P.COD_BAIRRO,
                     B.NME_BAIRRO,
                     C.COD_CIDADE,
                     C.NME_CIDADE,
                     U.SGL_UF,
                     U.DSC_UF,
                     NRO_CEP,
                     NRO_RG,
                     TXT_ORGAO_EXPEDIDOR,
                     SGL_UF_ORGAO_EXPEDIDOR,
                     TXT_EMAIL
                FROM EN_PESSOAS P 
                LEFT JOIN EN_BAIRRO B ON P.COD_BAIRRO = B.COD_BAIRRO
                LEFT JOIN EN_CIDADE C ON B.COD_CIDADE = C.COD_CIDADE
                LEFT JOIN EN_UF U ON C.SGL_UF = U.SGL_UF";  
        if (!$this->IsDesenv($codUsuario)){
          $sql .= " WHERE COD_CLIENTE = $codCliente";
        }      
        //echo $sql; die;
        return $this->selectDB("$sql", false);
        //return $rs_localiza;
    }

    Public Function ListarPessoaPorNome($codCliente, $codUsuario){  
        $nmePessoa = filter_input(INPUT_POST, 'nmePessoa', FILTER_SANITIZE_STRING);
        $sql = "SELECT COD_PESSOA,
                     NME_PESSOA,
                     NRO_CPF,
                     TXT_ENDERECO,
                     P.COD_BAIRRO,
                     B.NME_BAIRRO,
                     C.COD_CIDADE,
                     C.NME_CIDADE,
                     COALESCE(U.SGL_UF,-1) AS SGL_UF,
                     U.DSC_UF,
                     NRO_CEP,
                     NRO_RG,
                     TXT_ORGAO_EXPEDIDOR,
                     SGL_UF_ORGAO_EXPEDIDOR,
                     TXT_EMAIL
                FROM EN_PESSOAS P 
                LEFT JOIN EN_BAIRRO B ON P.COD_BAIRRO = B.COD_BAIRRO
                LEFT JOIN EN_CIDADE C ON B.COD_CIDADE = C.COD_CIDADE
                LEFT JOIN EN_UF U ON C.SGL_UF = U.SGL_UF
               WHERE 1=1 ";  
        if (!$this->IsDesenv($codUsuario)){
          $sql .= " AND COD_CLIENTE = $codCliente";
        }   
        $sql .= " AND NME_PESSOA LIKE '%".$nmePessoa."%'";
        //echo $sql; die;
        return $this->selectDB("$sql", false);
        //return $rs_localiza;
    }

    Public Function ListaPessoaGrid($codCliente, $codUsuario){    
        $sql = "SELECT COD_PESSOA,
                     NME_PESSOA,
                     NRO_CPF
                FROM EN_PESSOAS 
               WHERE 1=1 ";  
        if (!$this->IsDesenv($codUsuario)){
          $sql .= " AND COD_CLIENTE = $codCliente";
        }   
        $sql .= " AND NME_PESSOA LIKE '%".$_REQUEST['term']."%'";
        //echo $sql; die;
        return $this->selectDB("$sql", false);
        //return $rs_localiza;
    }

    Public Function UpdatePessoa(){
        $nroCpf = str_replace('-','',str_replace('.', '', filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_STRING)));
        $nroCep = str_replace('-','',str_replace('.', '', filter_input(INPUT_POST, 'nroCep', FILTER_SANITIZE_STRING)));
        $sql = "UPDATE EN_PESSOAS
                     SET NME_PESSOA = '".filter_input(INPUT_POST, 'nmePessoa', FILTER_SANITIZE_STRING)."',
                         NRO_CPF = '".$nroCpf."',
                         TXT_ENDERECO = '".filter_input(INPUT_POST, 'txtEndereco', FILTER_SANITIZE_STRING)."',
                         NRO_CEP = '".$nroCep."',
                         COD_BAIRRO = ".filter_input(INPUT_POST, 'codBairro', FILTER_SANITIZE_NUMBER_INT).",
                         NRO_RG = '".filter_input(INPUT_POST, 'nroRg', FILTER_SANITIZE_STRING)."',
                         TXT_ORGAO_EXPEDIDOR = '".filter_input(INPUT_POST, 'txtOrgaoExpedidor', FILTER_SANITIZE_STRING)."',
                         SGL_UF_ORGAO_EXPEDIDOR = '".filter_input(INPUT_POST, 'sglUfOrgaoExpedidor', FILTER_SANITIZE_STRING)."',
                         TXT_EMAIL = '".filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_STRING)."'
                   WHERE COD_PESSOA = ".filter_input(INPUT_POST, 'codPessoa', FILTER_SANITIZE_STRING);
        return $this->insertDB("$sql");
    }

    Public Function UpdateLogin($codLoja){
        $nroCpf = str_replace('-','',str_replace('.', '', filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_STRING)));
        $sql = "UPDATE SE_USUARIO
                     SET NME_USUARIO_COMPLETO = '".filter_input(INPUT_POST, 'nmePessoa', FILTER_SANITIZE_STRING)."',
                         NRO_CPF = '".$nroCpf."',
                         COD_LOJA = ".$codLoja.",
                         TXT_EMAIL = '".filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_STRING)."'
                   WHERE NRO_CPF = '".$nroCpf."'";
        return $this->insertDB("$sql");
    }

    Public Function InsertPessoa($codCliente){ 
        $nroCpf = str_replace('-','',str_replace('.', '', filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_STRING)));
        $nroCep = str_replace('-','',str_replace('.', '', filter_input(INPUT_POST, 'nroCep', FILTER_SANITIZE_STRING)));
        $codPessoa = $this->CatchUltimoCodigo("EN_PESSOAS", "COD_PESSOA");
        $codBairro = filter_input(INPUT_POST, 'codBairro', FILTER_SANITIZE_STRING);                
        $sql = "INSERT INTO EN_PESSOAS (
                       COD_PESSOA,
                       NME_PESSOA,
                       NRO_CPF,
                       TXT_ENDERECO,
                       NRO_CEP,
                       COD_BAIRRO,
                       NRO_RG,
                       TXT_ORGAO_EXPEDIDOR,
                       SGL_UF_ORGAO_EXPEDIDOR,
                       TXT_EMAIL,
                       COD_CLIENTE)
                VALUES (
                       $codPessoa,
                       '".filter_input(INPUT_POST, 'nmePessoa', FILTER_SANITIZE_STRING)."',
                       '".$nroCpf."',
                       '".filter_input(INPUT_POST, 'txtEndereco', FILTER_SANITIZE_STRING)."',
                       '".$nroCep."',
                       ".$codBairro.",
                       '".filter_input(INPUT_POST, 'nroRg', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'txtOrgaoExpedidor', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'sglUfOrgaoExpedidor', FILTER_SANITIZE_STRING)."',
                       '".filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_STRING)."',
                       $codCliente)";          
        $rs_localiza = $this->insertDB("$sql");
        if ($rs_localiza[0]){
            $rs_localiza[1] = $codPessoa;
        }
        return $rs_localiza;
    }	 
    
    Public Function AddLoginCliente($codLoja){       
        $nroCpf = str_replace('-','',str_replace('.', '', filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_STRING)));
        $codUsuario = $this->CatchUltimoCodigo('SE_USUARIO', 'COD_USUARIO');
        $nroCpf = str_replace('-','',str_replace('.', '', filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_NUMBER_INT)));
        $senha = base64_encode("123459");
        $sql_lista = "INSERT INTO SE_USUARIO (
                             COD_USUARIO,
                             NME_USUARIO,
                             NME_USUARIO_COMPLETO,
                             TXT_SENHA_W,
                             TXT_EMAIL,
                             COD_PERFIL_W,
                             IND_ATIVO,
                             NRO_CPF,
                             COD_LOJA)
                     VALUES(".$codUsuario.",
                            '".$nroCpf."',
                            '".filter_input(INPUT_POST, 'nmePessoa', FILTER_SANITIZE_MAGIC_QUOTES)."',
                            '".$senha."',
                            '".filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_MAGIC_QUOTES)."',
                            3,
                            'S',
                            '".$nroCpf."',
                            ".$codLoja.")";
        $result = $this->insertDB("$sql_lista");
        return $result;
    } 

    Public Function VerificaCpf($codCliente){
        $codPessoa = filter_input(INPUT_POST, 'codPessoa', FILTER_SANITIZE_STRING);
        if ($codPessoa==''){
            $codPessoa = 0;
        }   
        $nroCpf = str_replace('-','',str_replace('.', '', filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_STRING)));
        $sql = "SELECT COUNT(COD_PESSOA) AS QTD
                FROM EN_PESSOAS 
               WHERE NRO_CPF = '".$nroCpf."'
                 AND COD_PESSOA <> $codPessoa
                 AND COD_CLIENTE = $codCliente ";        
        return $this->selectDB("$sql", false);
    }
}