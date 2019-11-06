function Imprimir() {

//Salvando as configura��es do browser do usu�rio
var h = factory.printing.header;
var f = factory.printing.footer;
var l = factory.printing.leftMargin
var lf = factory.printing.leftMargin;
var t = factory.printing.topMargin;
var r = factory.printing.rightMargin;
var b = factory.printing.bottomMargin;

//Ocultando o bot�o de Impress�o
document.all("printbtn").style.visibility = 'hidden';

/*Definindo as configura��es de Cabe�alho e rodap�
C�digo Impress�o
--------------------------------------------------------------------------------------
&w Window title
&u Page address (URL)
&d Date in short format (as specified by Regional Settings in Control Panel)
&D Date in long format (as specified by Regional Settings in Control Panel)
&t Time in the format specified by Regional Settings in Control Panel
&T Time in 24-hour format
&p Current page number
&P Total numeros de pages
&& Um �nico ampersand (&)(&)
&b O texto imediatamente depois destes car�teres como centrados.
&b&b O texto imediatamente depois do primeiro "&b" como centrado, e o
texto que segue o segundo "&b" como direito-justificado. */
factory.printing.header = "";
factory.printing.footer = "";

//Definindo a orienta��o do Papel
factory.printing.portrait = true;

//Definindo o tipo de papel
//factory.printing.PaperSize = "A4";

//Definindo as margens de impress�o
factory.printing.leftMargin = 10;
factory.printing.topMargin = 15;
factory.printing.rightMargin = 8,47;
factory.printing.bottomMargin = 4,23;

//Definindo a exibi��o da caixa de configura��es da impressora
factory.printing.Print(true);

//Restaurando as informa��oes de Cabe�alho e Rodap� do browser do usu�rio
factory.printing.header = h;
factory.printing.footer = f;
factory.printing.leftMargin = lf;
factory.printing.topMargin = t;
factory.printing.rightMargin = r;
factory.printing.bottomMargin = b;

//esperando o Spooling
//factory.printing.WaitForSpoolingComplete();
alert("Impress�o Ok!");

//Exibindo novamente o bot�o de impress�o
document.all("printbtn").style.visibility = 'visible';
}

function Preview(){
//Salvando as configura��es do browser do usu�rio
var h = factory.printing.header;
var f = factory.printing.footer;
var l = factory.printing.leftMargin
var lf = factory.printing.leftMargin;
var t = factory.printing.topMargin;
var r = factory.printing.rightMargin;
var b = factory.printing.bottomMargin;
factory.printing.header = "";
factory.printing.footer = "";

//Definindo a orienta��o do Papel
factory.printing.portrait = true;

//Definindo o tipo de papel
//factory.printing.PaperSize = "A4";

//Definindo as margens de impress�o
factory.printing.leftMargin = 10;
factory.printing.topMargin = 15;
factory.printing.rightMargin = 8,47;
factory.printing.bottomMargin = 4,23;
//Ocultando o bot�o de Impress�o
document.all("printbtn").style.visibility = 'hidden';

factory.printing.Preview();
factory.printing.header = h;
factory.printing.footer = f;
factory.printing.leftMargin = lf;
factory.printing.topMargin = t;
factory.printing.rightMargin = r;
factory.printing.bottomMargin = b;

//Exibindo novamente o bot�o de impress�o
document.all("printbtn").style.visibility = 'visible';
}

// Altera cabe�alho padr�o                
function fnPrint() {
  //try     {
    // Aplica as altera��es nos registros                                
    saveAndClearSetting();                                
	var ret = saveAndClearSetting();                                	
	// chama o evento de impress�o                                
	window.print();                                
	// Define altera��o de cabe�alho e rodap� da p�gina                                
	//if ( ret ) restoreSetting();                        
  /*} catch (e) { 
    alert("err="+e.description); 
  } */               
}                
var hkey_path = "HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\PageSetup\\";                
var hkey_key_header = hkey_path+"header"; // cabe�alho                
var hkey_key_footer = hkey_path+"footer"; //rodap�                
var hkey_key_margin_bottom = hkey_path+"margin_bottom"; // margem inferior                
var hkey_key_margin_left = hkey_path+"margin_left"; // margem esquerda                
var hkey_key_margin_right = hkey_path+"margin_right"; // margem direita                
var hkey_key_margin_top = hkey_path+"margin_top"; // margem superior                
var old_header = "&w&bP�gina &p de &P "; // cabe�alho original                
var old_footer = "&u&b&d "; // rodap� original                                
//Salva as configura��es originais e  aplica as configura��es em branco                
function saveAndClearSetting() {                  
  var RegWsh = new ActiveXObject("WScript.Shell");                        
  RegWsh.RegWrite(hkey_key_margin_top,"0");                        
  RegWsh.RegWrite(hkey_key_margin_left,"0");   
  RegWsh.RegWrite(hkey_key_header,"");                        
  RegWsh.RegWrite(hkey_key_footer,"");  
  try {                        
	old_header = RegWsh.RegRead(hkey_key_header);                        
	old_footer = RegWsh.RegRead(hkey_key_footer);                        
	RegWsh.RegWrite(hkey_key_header,"");                        
	RegWsh.RegWrite(hkey_key_footer,"");                        
	return true;                  
  } catch (e) {                         
    if ( e.description.indexOf("O servidor de automa��o n�o pode criar objeto") != -1 ) {                                
      alert(" Erro ao tentar alterar as configura��es do IE. Por favor altere as configura��es de seguran�a  e tente novamente.");                         
    } // if                        
    else {                                
      alert("ERR="+e.description);                         
    } // else                  
  } // catch                        
  return false;                
}                
  // Restaura as configura��es originais                
function restoreSetting() {                  
  try {                        
    var RegWsh = new ActiveXObject("WScript.Shell");                        
	RegWsh.RegWrite(hkey_key_header,old_header);                        
	RegWsh.RegWrite(hkey_key_footer,old_footer);                  
  } catch (e) {                        
    if ( e.description.indexOf("O servidor de automa��o n�o pode criar objeto") != -1 ) {                                
	  alert("Erro ao tentar alterar as configura��es do IE. Por favor altere as configura��es de seguran�a  e tente novamente.");                        
	} // if   
	else {                                
	  alert("ERR="+e.description);                         
	} // else                  
  } // catch                
}// JavaScript Document