<?php
$dadosPessoa = unserialize(urldecode($_POST['dadosPessoa']));

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 2.95;
$data_venc = $dadosPessoa[0]['DTA_VENCIMENTO'];  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = $dadosPessoa[0]['VLR_MENSALIDADE']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = $dadosPessoa[0]['NRO_NOSSO_NUMERO'];
$dadosboleto["numero_documento"] = $dadosPessoa[0]['NRO_DOCUMENTO'];	// Num do pedido ou do documento
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $dadosPessoa[0]['NME_PESSOA'];
$dadosboleto["endereco1"] = $dadosPessoa[0]['TXT_ENDERECO'];
$dadosboleto["endereco2"] = $dadosPessoa[0]['NME_BAIRRO']." ".$dadosPessoa[0]['NME_CIDADE']." ".$dadosPessoa[0]['SGL_UF']." CEP: ".$dadosPessoa[0]['NRO_CEP'];

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "";
$dadosboleto["demonstrativo2"] = "Mensalidade referente a ".$dadosPessoa[0]['MES_REFERENCIA']."/".$dadosPessoa[0]['ANO_REFERENCIA']."<br>Taxa banc�ria - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = "";

// INSTRU��ES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% ap�s o vencimento";
$dadosboleto["instrucoes2"] = "- Receber at� 10 dias ap�s o vencimento";
$dadosboleto["instrucoes3"] = "- Em caso de d�vidas entre em contato conosco: ".$dadosPessoa[0]['TXT_EMAIL'];
$dadosboleto["instrucoes4"] = "";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "10";
$dadosboleto["valor_unitario"] = "10";
$dadosboleto["aceite"] = "N";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DM";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //
$dadosCliente = unserialize(urldecode($_POST['dadosCliente']));

// DADOS DA SUA CONTA - BANCO DO BRASIL
$dadosboleto["agencia"] = utf8_decode($dadosCliente[0]['NRO_AGENCIA']); // Num da agencia, sem digito
$dadosboleto["conta"] = utf8_decode($dadosCliente[0]['NRO_CONTA_CORRENTE']); 	// Num da conta, sem digito

// DADOS PERSONALIZADOS - BANCO DO BRASIL
$dadosboleto["convenio"] = "7777777";  // Num do conv�nio - REGRA: 6 ou 7 ou 8 d�gitos
$dadosboleto["contrato"] = "999999"; // Num do seu contrato
$dadosboleto["carteira"] = "18";
$dadosboleto["variacao_carteira"] = "-019";  // Varia��o da Carteira, com tra�o (opcional)

// TIPO DO BOLETO
$dadosboleto["formatacao_convenio"] = "7"; // REGRA: 8 p/ Conv�nio c/ 8 d�gitos, 7 p/ Conv�nio c/ 7 d�gitos, ou 6 se Conv�nio c/ 6 d�gitos
$dadosboleto["formatacao_nosso_numero"] = "2"; // REGRA: Usado apenas p/ Conv�nio c/ 6 d�gitos: informe 1 se for NossoN�mero de at� 5 d�gitos ou 2 para op��o de at� 17 d�gitos

/*
#################################################
DESENVOLVIDO PARA CARTEIRA 18

- Carteira 18 com Convenio de 8 digitos
  Nosso n�mero: pode ser at� 9 d�gitos

- Carteira 18 com Convenio de 7 digitos
  Nosso n�mero: pode ser at� 10 d�gitos

- Carteira 18 com Convenio de 6 digitos
  Nosso n�mero:
  de 1 a 99999 para op��o de at� 5 d�gitos
  de 1 a 99999999999999999 para op��o de at� 17 d�gitos

#################################################
*/


// SEUS DADOS
$dadosboleto["identificacao"] = utf8_decode($dadosCliente[0]['NME_CLIENTE']);
$dadosboleto["cpf_cnpj"] = utf8_decode($dadosCliente[0]['NRO_CNPJ']);
$dadosboleto["endereco"] = utf8_decode($dadosCliente[0]['TXT_ENDERECO']);
$dadosboleto["cidade_uf"] = "";
$dadosboleto["cedente"] = utf8_decode($dadosCliente[0]['NME_CLIENTE']);

// N�O ALTERAR!
include("include/funcoes_bb.php"); 
include("include/layout_bb.php");
?>
