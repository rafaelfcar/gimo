<?php
include 'Dao/BaseDao.php';
$conn = mysql_connect('localhost','root','');
mysql_select_db('gimo',$conn);
$sql_contas = "
ALTER TABLE EN_CIDADE
	ADD COLUMN IND_ATIVO CHAR(1) NULL DEFAULT NULL AFTER NME_CIDADE;
";
if (!mysql_query($sql_contas)){
   echo mysql_error();
}
?>
 
