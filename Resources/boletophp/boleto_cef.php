<?php
$dadosPessoa = unserialize(urldecode($_POST['dadosPessoa']));

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 2.95;
$data_venc = $dadosPessoa[0]['DTA_VENCIMENTO'];  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = $dadosPessoa[0]['VLR_MENSALIDADE']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["inicio_nosso_numero"] = "80";  // Carteira SR: 80, 81 ou 82  -  Carteira CR: 90 (Confirmar com gerente qual usar)
$dadosboleto["nosso_numero"] = $dadosPessoa[0]['NRO_NOSSO_NUMERO'];
$dadosboleto["numero_documento"] = $dadosPessoa[0]['NRO_DOCUMENTO'];	// Num do pedido ou do documento
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula



// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $dadosPessoa[0]['NME_PESSOA'];
$dadosboleto["endereco1"] = $dadosPessoa[0]['TXT_ENDERECO'];
$dadosboleto["endereco2"] = $dadosPessoa[0]['NME_BAIRRO']." ".$dadosPessoa[0]['NME_CIDADE']." ".$dadosPessoa[0]['SGL_UF']." CEP: ".$dadosPessoa[0]['NRO_CEP'];

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "";
$dadosboleto["demonstrativo2"] = "Mensalidade referente a ".$dadosPessoa[0]['MES_REFERENCIA']."/".$dadosPessoa[0]['ANO_REFERENCIA']."<br>Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = "";

// INSTRUÇÕES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
$dadosboleto["instrucoes2"] = "- Receber até 10 dias após o vencimento";
$dadosboleto["instrucoes3"] = "- Em caso de dúvidas entre em contato conosco: ".$dadosPessoa[0]['TXT_EMAIL'];
$dadosboleto["instrucoes4"] = "";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //
$dadosCliente = unserialize(urldecode($_POST['dadosCliente']));
$nroConta = utf8_decode($dadosCliente[0]['NRO_CONTA_CORRENTE']);
// DADOS DA SUA CONTA - CEF
$dadosboleto["agencia"] = utf8_decode($dadosCliente[0]['NRO_AGENCIA']); // Num da agencia, sem digito
$dadosboleto["conta"] = $nroConta; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] = substr($nroConta, strlen($nroConta)-1, strlen($nroConta)); 	// Digito do Num da conta

// DADOS PERSONALIZADOS - CEF
$dadosboleto["conta_cedente"] = $nroConta; // ContaCedente do Cliente, sem digito (Somente Números)
$dadosboleto["conta_cedente_dv"] = substr($nroConta, strlen($nroConta)-1, strlen($nroConta)); // Digito da ContaCedente do Cliente
$dadosboleto["carteira"] = "SR";  // Código da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)

// SEUS DADOS
$dadosboleto["identificacao"] = utf8_decode($dadosCliente[0]['NME_CLIENTE']);
$dadosboleto["cpf_cnpj"] = utf8_decode($dadosCliente[0]['NRO_CNPJ']);
$dadosboleto["endereco"] = utf8_decode($dadosCliente[0]['TXT_ENDERECO']);
$dadosboleto["cidade_uf"] = "";
$dadosboleto["cedente"] = utf8_decode($dadosCliente[0]['NME_CLIENTE']);

// NÃO ALTERAR!
include("include/funcoes_cef.php"); 
include("include/layout_cef.php");
?>
