<?
include_once("../../Dao/BaseDao.php");
class LoginDao extends BaseDao
{
  function LoginDao(){
      $this->conect();
  }

  /**
   * Confere o usuário no banco de dados
   * @param type $nmeLogin
   * @param type $txtSenha
   * @return boolean
   */
  function Logar($nmeLogin,
                 $txtSenha){
    $sql = " SELECT COD_USUARIO,
                    COD_PERFIL_W,
                    L.COD_CLIENTE,
                    u.COD_LOJA
                FROM SE_USUARIO U
               INNER JOIN EN_LOJA L
                  ON U.COD_LOJA = L.COD_LOJA
               INNER JOIN EN_CLIENTE C
                  ON L.COD_CLIENTE = C.COD_CLIENTE
            WHERE NME_USUARIO = '$nmeLogin'
                AND TXT_SENHA_W='$txtSenha'
                AND U.IND_ATIVO = 'S'
                AND L.IND_ATIVA = 'S'
                AND C.IND_ATIVO = 'S'";    
    return $this->selectDB($sql, false);
  }

  function CarregaMenu($codUsuario,
                       $codMenuPai,
                       $path){
    try{
        $sql_localiza = "
        SELECT DSC_MENU_W,
               m.COD_MENU_W,
               '".$path."'+'/Controller/'+NME_CONTROLLER AS NME_CONTROLLER,
               NME_METHOD,
               NME_USUARIO_COMPLETO,
               M.COD_MENU_PAI_W,
               TXT_SENHA_W
          FROM SE_MENU M
         INNER JOIN SE_MENU_PERFIL MP
            ON M.COD_MENU_W = MP.COD_MENU_W
         INNER JOIN SE_USUARIO U
            ON MP.COD_PERFIL_W = U.COD_PERFIL_W
         WHERE COD_USUARIO = ".$codUsuario." AND IND_MENU_ATIVO_W = 'S'
           AND M.COD_MENU_PAI_W = '$codMenuPai'
         ORDER BY DSC_MENU_W";
//echo $sql_localiza; exit;
        $rs_localiza = $this->selectDB("$sql_localiza", false);
    }catch(Exception $e){
        echo "erro".$e;
    }
    return $rs_localiza;
  }

  function AlteraSenha($codUsuario){      
      $senha = base64_encode(filter_input(INPUT_POST, 'txtNova', FILTER_SANITIZE_MAGIC_QUOTES));
      $sql = "UPDATE SE_USUARIO SET TXT_SENHA_W = '".$senha."'
               WHERE COD_USUARIO = $codUsuario";
      return $this->insertDB($sql);
  }

}
?>
