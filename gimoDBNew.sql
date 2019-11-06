-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.5.27-log - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              8.2.0.4675
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para gimo
DROP DATABASE IF EXISTS `gimo`;
CREATE DATABASE IF NOT EXISTS `gimo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gimo`;


-- Copiando estrutura para tabela gimo.en_bairro
DROP TABLE IF EXISTS `en_bairro`;
CREATE TABLE IF NOT EXISTS `en_bairro` (
  `COD_BAIRRO` int(11) NOT NULL,
  `COD_CIDADE` int(11) NOT NULL,
  `NME_BAIRRO` varchar(100) DEFAULT NULL,
  `IND_ATIVO` char(1) DEFAULT NULL,
  PRIMARY KEY (`COD_BAIRRO`,`COD_CIDADE`),
  KEY `FK_EN_BAIRRO_en_cidade` (`COD_CIDADE`),
  CONSTRAINT `FK_EN_BAIRRO_en_cidade` FOREIGN KEY (`COD_CIDADE`) REFERENCES `en_cidade` (`COD_CIDADE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.en_bairro: ~6 rows (aproximadamente)
DELETE FROM `en_bairro`;
/*!40000 ALTER TABLE `en_bairro` DISABLE KEYS */;
INSERT INTO `en_bairro` (`COD_BAIRRO`, `COD_CIDADE`, `NME_BAIRRO`, `IND_ATIVO`) VALUES
	(1, 1, 'Asa Sul', 'S'),
	(2, 2, 'Aguas Claras', 'S'),
	(3, 3, 'Vicente Pires', 'S'),
	(4, 1, 'Taguatinga Sul', 'S'),
	(5, 1, 'Asa Sul (Desativado)', 'S'),
	(6, 1, '', 'S');
/*!40000 ALTER TABLE `en_bairro` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.en_banco
DROP TABLE IF EXISTS `en_banco`;
CREATE TABLE IF NOT EXISTS `en_banco` (
  `COD_BANCO` int(11) NOT NULL,
  `NME_BANCO` varchar(100) DEFAULT NULL,
  `DSC_ARQUIVO_BOLETO` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`COD_BANCO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.en_banco: ~2 rows (aproximadamente)
DELETE FROM `en_banco`;
/*!40000 ALTER TABLE `en_banco` DISABLE KEYS */;
INSERT INTO `en_banco` (`COD_BANCO`, `NME_BANCO`, `DSC_ARQUIVO_BOLETO`) VALUES
	(1, 'Banco do Brasil', 'boleto_bb.php'),
	(2, 'Caixa EconÃ´mica', 'boleto_cef.php');
/*!40000 ALTER TABLE `en_banco` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.en_cidade
DROP TABLE IF EXISTS `en_cidade`;
CREATE TABLE IF NOT EXISTS `en_cidade` (
  `COD_CIDADE` int(11) NOT NULL,
  `SGL_UF` char(2) NOT NULL,
  `NME_CIDADE` varchar(100) DEFAULT NULL,
  `IND_ATIVO` char(1) DEFAULT NULL,
  PRIMARY KEY (`COD_CIDADE`,`SGL_UF`),
  KEY `FK_UF_CIDADE` (`SGL_UF`),
  CONSTRAINT `FK_UF_CIDADE` FOREIGN KEY (`SGL_UF`) REFERENCES `en_uf` (`SGL_UF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.en_cidade: ~18 rows (aproximadamente)
DELETE FROM `en_cidade`;
/*!40000 ALTER TABLE `en_cidade` DISABLE KEYS */;
INSERT INTO `en_cidade` (`COD_CIDADE`, `SGL_UF`, `NME_CIDADE`, `IND_ATIVO`) VALUES
	(1, 'DF', 'Brasilia ', 'S'),
	(2, 'DF', 'Aguas claras', 'S'),
	(3, 'DF', 'Vicente Pires', 'S'),
	(4, 'DF', 'Taguatinga', 'S'),
	(5, 'DF', 'CeilÃ¢ndia', 'S'),
	(6, 'DF', 'GuarÃ¡', 'S'),
	(7, 'DF', 'NÃºcleo Bandeirante', 'S'),
	(8, 'DF', 'Riacho Fundo', 'S'),
	(9, 'DF', 'BrazlÃ¢ndia', 'S'),
	(10, 'DF', 'Planaltina', 'S'),
	(11, 'DF', 'Gama', 'S'),
	(12, 'DF', 'Samambaia', 'S'),
	(13, 'DF', 'Cruzeiro', 'S'),
	(14, 'DF', 'Recanto das Emas', 'S'),
	(15, 'DF', 'Sobradinho', 'S'),
	(16, 'DF', 'Santa Maria', 'S'),
	(17, 'DF', 'SÃ£o SebastiÃ£o', 'S'),
	(18, 'CE', 'Fortaleza', 'S');
/*!40000 ALTER TABLE `en_cidade` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.en_cliente
DROP TABLE IF EXISTS `en_cliente`;
CREATE TABLE IF NOT EXISTS `en_cliente` (
  `COD_CLIENTE` int(4) NOT NULL DEFAULT '0',
  `NME_CLIENTE` varchar(100) DEFAULT NULL,
  `NRO_CNPJ` varchar(18) DEFAULT NULL,
  `TXT_ENDERECO` varchar(100) DEFAULT NULL,
  `NRO_TELEFONE` varchar(14) DEFAULT NULL,
  `NME_FIGURA` varchar(100) DEFAULT NULL,
  `IND_ATIVO` char(1) DEFAULT NULL,
  `COD_BANCO` int(11) DEFAULT NULL,
  `NRO_AGENCIA` varchar(50) DEFAULT NULL,
  `NRO_CONTA_CORRENTE` varchar(50) DEFAULT NULL,
  `VLR_MULTA` float DEFAULT NULL,
  `VLR_JUROS` float DEFAULT NULL,
  PRIMARY KEY (`COD_CLIENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.en_cliente: ~4 rows (aproximadamente)
DELETE FROM `en_cliente`;
/*!40000 ALTER TABLE `en_cliente` DISABLE KEYS */;
INSERT INTO `en_cliente` (`COD_CLIENTE`, `NME_CLIENTE`, `NRO_CNPJ`, `TXT_ENDERECO`, `NRO_TELEFONE`, `NME_FIGURA`, `IND_ATIVO`, `COD_BANCO`, `NRO_AGENCIA`, `NRO_CONTA_CORRENTE`, `VLR_MULTA`, `VLR_JUROS`) VALUES
	(1, 'ADM', '', NULL, NULL, '', 'S', NULL, NULL, NULL, NULL, NULL),
	(2, 'Elaine', '', '', '', '', 'S', 1, '12345', '012548', 5, 1),
	(3, 'Francisco Pereira ImobiliÃ¡ria', '12312312', '12312312', '', '', 'S', 1, '123123', '123123123', 20, 2),
	(4, 'CTIS', '', '', '', '', 'S', 1, '3582-3', '000000', 1, 1);
/*!40000 ALTER TABLE `en_cliente` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.en_detalhe
DROP TABLE IF EXISTS `en_detalhe`;
CREATE TABLE IF NOT EXISTS `en_detalhe` (
  `COD_DETALHE` int(11) NOT NULL,
  `DSC_DETALHE` varchar(100) DEFAULT NULL,
  `IND_ATIVO` char(1) DEFAULT NULL,
  PRIMARY KEY (`COD_DETALHE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.en_detalhe: ~10 rows (aproximadamente)
DELETE FROM `en_detalhe`;
/*!40000 ALTER TABLE `en_detalhe` DISABLE KEYS */;
INSERT INTO `en_detalhe` (`COD_DETALHE`, `DSC_DETALHE`, `IND_ATIVO`) VALUES
	(1, 'porcelanato', 'S'),
	(2, 'laje', 'S'),
	(3, '3 quartos', 'S'),
	(4, '1 suite', 'S'),
	(5, 'armarios cozinha', 'S'),
	(6, 'armarios quartos', 'S'),
	(7, 'Churrasqueira', 'S'),
	(8, 'Piscina', 'S'),
	(9, 'ArmÃ¡rio banheiro', 'S'),
	(10, 'DCE', 'S');
/*!40000 ALTER TABLE `en_detalhe` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.en_imovel
DROP TABLE IF EXISTS `en_imovel`;
CREATE TABLE IF NOT EXISTS `en_imovel` (
  `COD_IMOVEL` int(11) NOT NULL,
  `COD_BAIRRO` int(11) DEFAULT NULL,
  `VLR_IMOVEL` float DEFAULT NULL,
  `VLR_TAMANHO` float DEFAULT NULL,
  `COD_CLIENTE` int(11) DEFAULT NULL,
  `COD_PROPRIETARIO` int(11) DEFAULT NULL,
  `TXT_ENDERECO` varchar(255) DEFAULT NULL,
  `NRO_CEP` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`COD_IMOVEL`),
  KEY `fk_en_imovel_en_cliente1` (`COD_CLIENTE`),
  KEY `fk_en_imovel_en_pessoas1` (`COD_PROPRIETARIO`),
  CONSTRAINT `fk_en_imovel_en_cliente1` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `en_cliente` (`COD_CLIENTE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_en_imovel_en_pessoas1` FOREIGN KEY (`COD_PROPRIETARIO`) REFERENCES `en_pessoas` (`COD_PESSOA`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.en_imovel: ~2 rows (aproximadamente)
DELETE FROM `en_imovel`;
/*!40000 ALTER TABLE `en_imovel` DISABLE KEYS */;
INSERT INTO `en_imovel` (`COD_IMOVEL`, `COD_BAIRRO`, `VLR_IMOVEL`, `VLR_TAMANHO`, `COD_CLIENTE`, `COD_PROPRIETARIO`, `TXT_ENDERECO`, `NRO_CEP`) VALUES
	(1, 2, 1000, 1, 4, 1, 'Sem endereÃ§o', ''),
	(2, 3, 500000, 1000, 3, 8, 'vicente pires', '71.095-000');
/*!40000 ALTER TABLE `en_imovel` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.en_loja
DROP TABLE IF EXISTS `en_loja`;
CREATE TABLE IF NOT EXISTS `en_loja` (
  `COD_LOJA` int(4) NOT NULL DEFAULT '0',
  `DSC_LOJA` varchar(50) DEFAULT NULL,
  `CEP` varchar(50) DEFAULT NULL,
  `ENDERECO` varchar(80) DEFAULT NULL,
  `BAIRRO` varchar(50) DEFAULT NULL,
  `COMPLEMENTO` varchar(50) DEFAULT NULL,
  `IND_CENTRAL` char(1) DEFAULT NULL,
  `COD_CLIENTE` int(4) DEFAULT NULL,
  `IND_ATIVA` char(1) DEFAULT NULL,
  `SGL_UF` char(2) DEFAULT NULL,
  `NRO_DIA_PAGAMENTO` int(4) DEFAULT NULL,
  `NRO_CNPJ` varchar(18) DEFAULT NULL,
  `VLR_MENSALIDADE` decimal(9,0) DEFAULT NULL,
  `TXT_EMAIL` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`COD_LOJA`),
  KEY `FK_CLIENTE_LOJA` (`COD_CLIENTE`),
  CONSTRAINT `FK_CLIENTE_LOJA` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `en_cliente` (`COD_CLIENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.en_loja: ~4 rows (aproximadamente)
DELETE FROM `en_loja`;
/*!40000 ALTER TABLE `en_loja` DISABLE KEYS */;
INSERT INTO `en_loja` (`COD_LOJA`, `DSC_LOJA`, `CEP`, `ENDERECO`, `BAIRRO`, `COMPLEMENTO`, `IND_CENTRAL`, `COD_CLIENTE`, `IND_ATIVA`, `SGL_UF`, `NRO_DIA_PAGAMENTO`, `NRO_CNPJ`, `VLR_MENSALIDADE`, `TXT_EMAIL`) VALUES
	(1, 'ADM', '', '', '', '', 'N', 1, 'S', NULL, 0, '', 0, NULL),
	(2, 'Elaine', '', '', '', '', 'N', 2, 'S', '', 15, '', 0, NULL),
	(3, 'Francisco Pereira ImobiliÃ¡ria', '', '', '', '', 'N', 3, 'S', '', 0, '', 0, NULL),
	(4, 'CTIS', '', '', '', '', 'N', 4, 'S', '', 0, '', 0, NULL);
/*!40000 ALTER TABLE `en_loja` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.en_noticias
DROP TABLE IF EXISTS `en_noticias`;
CREATE TABLE IF NOT EXISTS `en_noticias` (
  `COD_NOTICIAS` char(10) NOT NULL DEFAULT '',
  `TXT_NOTICIAS` varchar(50) DEFAULT NULL,
  `TXT_OBSERVACAO` longtext,
  `DTA_NOTICIA` datetime DEFAULT NULL,
  `COD_CLIENTE` int(4) DEFAULT NULL,
  PRIMARY KEY (`COD_NOTICIAS`),
  KEY `FK_CLIENTE_NOTICIA` (`COD_CLIENTE`),
  CONSTRAINT `FK_CLIENTE_NOTICIA` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `en_cliente` (`COD_CLIENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.en_noticias: ~4 rows (aproximadamente)
DELETE FROM `en_noticias`;
/*!40000 ALTER TABLE `en_noticias` DISABLE KEYS */;
INSERT INTO `en_noticias` (`COD_NOTICIAS`, `TXT_NOTICIAS`, `TXT_OBSERVACAO`, `DTA_NOTICIA`, `COD_CLIENTE`) VALUES
	('1', 'taxa', 'Baixou a taxa', '2014-04-18 17:27:15', 2),
	('2', 'Aluga-se', 'Teste', '2014-04-25 15:14:48', 4),
	('3', 'Aluga-se', 'Teste', '2014-04-25 15:15:06', 4),
	('4', 'boleto', 'teste', '2014-04-26 08:55:41', 3);
/*!40000 ALTER TABLE `en_noticias` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.en_pessoas
DROP TABLE IF EXISTS `en_pessoas`;
CREATE TABLE IF NOT EXISTS `en_pessoas` (
  `COD_PESSOA` int(11) NOT NULL,
  `NME_PESSOA` varchar(100) DEFAULT NULL,
  `NRO_CPF` varchar(11) DEFAULT NULL,
  `TXT_ENDERECO` varchar(255) DEFAULT NULL,
  `COD_BAIRRO` int(11) DEFAULT NULL,
  `NRO_CEP` char(8) DEFAULT NULL,
  `NRO_RG` varchar(30) DEFAULT NULL,
  `TXT_ORGAO_EXPEDIDOR` varchar(15) DEFAULT NULL,
  `SGL_UF_ORGAO_EXPEDIDOR` varchar(2) DEFAULT NULL,
  `TXT_EMAIL` varchar(100) DEFAULT NULL,
  `COD_CLIENTE` int(11) DEFAULT NULL,
  PRIMARY KEY (`COD_PESSOA`),
  KEY `FK_CLIENTE_PESSOA` (`COD_CLIENTE`),
  KEY `FK_BAIRRO_PESSOA` (`COD_BAIRRO`),
  CONSTRAINT `FK_BAIRRO_PESSOA` FOREIGN KEY (`COD_BAIRRO`) REFERENCES `en_bairro` (`COD_BAIRRO`),
  CONSTRAINT `FK_CLIENTE_PESSOA` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `en_cliente` (`COD_CLIENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.en_pessoas: ~11 rows (aproximadamente)
DELETE FROM `en_pessoas`;
/*!40000 ALTER TABLE `en_pessoas` DISABLE KEYS */;
INSERT INTO `en_pessoas` (`COD_PESSOA`, `NME_PESSOA`, `NRO_CPF`, `TXT_ENDERECO`, `COD_BAIRRO`, `NRO_CEP`, `NRO_RG`, `TXT_ORGAO_EXPEDIDOR`, `SGL_UF_ORGAO_EXPEDIDOR`, `TXT_EMAIL`, `COD_CLIENTE`) VALUES
	(1, 'Luciana', '00000000191', '', 2, '', '', '', 'DF', 'lucianaribeiro.nunes@gmail.com', 4),
	(2, 'Teste', '60393315770', '', NULL, '', '', '', 'AC', '', 4),
	(3, 'Teste 1', '38811427703', '', NULL, '', '', '', 'DF', '', 4),
	(4, 'Teste 1', '35527338251', '', NULL, '', '', '', 'DF', '', 4),
	(5, 'Teste 1', '65548518526', '', NULL, '', '', '', 'DF', '', 4),
	(6, 'teste 02', '45777436200', '', 2, '', '', '', 'AC', '', 4),
	(7, 'Rafael Freitas Carneiro', '70167664115', 'vicente pires', 3, '71095000', '1891333', 'ssp', 'DF', 'rafaelfcarneiro@gmail.com', 3),
	(8, 'Ruy', '14566788172', '', 3, '', '', '', 'AC', '', 3),
	(9, 'teste', '84823771834', '', 1, '', '', '', 'AC', '', 1),
	(10, '744.145.587-19', '74414558719', '', 3, '', '', '', 'AC', '', 1),
	(11, '537.273.416-70', '53727341670', '', 1, '', '', '', 'AC', '', 1);
/*!40000 ALTER TABLE `en_pessoas` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.en_tipo_pagamento
DROP TABLE IF EXISTS `en_tipo_pagamento`;
CREATE TABLE IF NOT EXISTS `en_tipo_pagamento` (
  `COD_TIPO_PAGAMENTO` int(10) NOT NULL DEFAULT '0',
  `DSC_TIPO_PAGAMENTO` varchar(100) DEFAULT NULL,
  `IND_ATIVO` char(1) DEFAULT NULL,
  PRIMARY KEY (`COD_TIPO_PAGAMENTO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.en_tipo_pagamento: 5 rows
DELETE FROM `en_tipo_pagamento`;
/*!40000 ALTER TABLE `en_tipo_pagamento` DISABLE KEYS */;
INSERT INTO `en_tipo_pagamento` (`COD_TIPO_PAGAMENTO`, `DSC_TIPO_PAGAMENTO`, `IND_ATIVO`) VALUES
	(1, 'CartÃ£o de CrÃ©dito', 'S'),
	(2, 'Boleto BancÃ¡rio', 'S'),
	(3, 'Dinheiro', 'S'),
	(4, 'CartÃ£o de Debito', 'S'),
	(5, 'Dinheiro', 'S');
/*!40000 ALTER TABLE `en_tipo_pagamento` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.en_uf
DROP TABLE IF EXISTS `en_uf`;
CREATE TABLE IF NOT EXISTS `en_uf` (
  `SGL_UF` char(2) NOT NULL,
  `DSC_UF` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SGL_UF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.en_uf: ~27 rows (aproximadamente)
DELETE FROM `en_uf`;
/*!40000 ALTER TABLE `en_uf` DISABLE KEYS */;
INSERT INTO `en_uf` (`SGL_UF`, `DSC_UF`) VALUES
	('AC', 'Acre'),
	('AL', 'Alagoas'),
	('AM', 'Amazonas'),
	('AP', 'AmapÃ¡'),
	('BA', 'Bahia'),
	('CE', 'CearÃ¡'),
	('DF', 'Distrito Federal'),
	('ES', 'EspÃ­rito Santo'),
	('GO', 'GoiÃ¡s'),
	('MA', 'MaranhÃ£o'),
	('MG', 'Minas Gerais'),
	('MS', 'Mato Grosso do Sul'),
	('MT', 'Mato Grosso'),
	('PA', 'ParanÃ¡'),
	('PB', 'ParaÃ­ba'),
	('PE', 'Pernambuco'),
	('PI', 'PiauÃ­'),
	('PR', 'ParÃ¡'),
	('RJ', 'Rio de Janeiro'),
	('RN', 'Rio Grande do Norte'),
	('RO', 'RondÃ´nia'),
	('RR', 'Roraima'),
	('RS', 'Rio Grande do Sul'),
	('SC', 'Santa Catarina'),
	('SE', 'Sergipe'),
	('SP', 'SÃ£o Paulo'),
	('TO', 'Tocantins');
/*!40000 ALTER TABLE `en_uf` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.re_detalhe_imovel
DROP TABLE IF EXISTS `re_detalhe_imovel`;
CREATE TABLE IF NOT EXISTS `re_detalhe_imovel` (
  `COD_IMOVEL` int(11) NOT NULL,
  `COD_DETALHE` int(11) NOT NULL,
  PRIMARY KEY (`COD_IMOVEL`,`COD_DETALHE`),
  KEY `fk_RE_DETALHE_IMOVEL_EN_DETALHE1` (`COD_DETALHE`),
  KEY `fk_RE_DETALHE_IMOVEL_en_imovel1` (`COD_IMOVEL`),
  CONSTRAINT `fk_RE_DETALHE_IMOVEL_EN_DETALHE1` FOREIGN KEY (`COD_DETALHE`) REFERENCES `en_detalhe` (`COD_DETALHE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_RE_DETALHE_IMOVEL_en_imovel1` FOREIGN KEY (`COD_IMOVEL`) REFERENCES `en_imovel` (`COD_IMOVEL`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.re_detalhe_imovel: ~5 rows (aproximadamente)
DELETE FROM `re_detalhe_imovel`;
/*!40000 ALTER TABLE `re_detalhe_imovel` DISABLE KEYS */;
INSERT INTO `re_detalhe_imovel` (`COD_IMOVEL`, `COD_DETALHE`) VALUES
	(2, 1),
	(2, 2),
	(2, 3),
	(2, 4),
	(2, 5);
/*!40000 ALTER TABLE `re_detalhe_imovel` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.re_imovel_pagamento
DROP TABLE IF EXISTS `re_imovel_pagamento`;
CREATE TABLE IF NOT EXISTS `re_imovel_pagamento` (
  `COD_IMOVEL` int(10) NOT NULL DEFAULT '0',
  `NRO_NOSSO_NUMERO` varchar(50) NOT NULL DEFAULT '',
  `DTA_VENCIMENTO` date NOT NULL DEFAULT '0000-00-00',
  `DTA_PAGAMENTO` date DEFAULT NULL,
  `VLR_MENSALIDADE` float DEFAULT NULL,
  `NRO_DOCUMENTO` varchar(50) DEFAULT NULL,
  `COD_TIPO_PAGAMENTO` int(11) DEFAULT NULL,
  `VLR_PAGAMENTO` float DEFAULT NULL,
  PRIMARY KEY (`COD_IMOVEL`,`NRO_NOSSO_NUMERO`,`DTA_VENCIMENTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.re_imovel_pagamento: ~3 rows (aproximadamente)
DELETE FROM `re_imovel_pagamento`;
/*!40000 ALTER TABLE `re_imovel_pagamento` DISABLE KEYS */;
INSERT INTO `re_imovel_pagamento` (`COD_IMOVEL`, `NRO_NOSSO_NUMERO`, `DTA_VENCIMENTO`, `DTA_PAGAMENTO`, `VLR_MENSALIDADE`, `NRO_DOCUMENTO`, `COD_TIPO_PAGAMENTO`, `VLR_PAGAMENTO`) VALUES
	(1, '48908549', '2014-01-26', NULL, 0.01, '25.201416.04', NULL, NULL),
	(2, '31008972', '2014-05-10', NULL, 1500, '26.201432.04', NULL, NULL),
	(2, '42143470', '2014-04-10', NULL, 1500, '26.201447.04', NULL, NULL);
/*!40000 ALTER TABLE `re_imovel_pagamento` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.re_imovel_pessoa
DROP TABLE IF EXISTS `re_imovel_pessoa`;
CREATE TABLE IF NOT EXISTS `re_imovel_pessoa` (
  `COD_IMOVEL` int(11) NOT NULL,
  `COD_PESSOA` int(11) NOT NULL,
  `DTA_INICIO` date NOT NULL,
  `DTA_FIM` date DEFAULT NULL,
  `DTA_CANCELAMENTO` date DEFAULT NULL,
  `VLR_TRANSACAO` float DEFAULT NULL,
  `TPO_TRANSACAO` char(1) DEFAULT NULL,
  `NRO_DIA_PAGAMENTO` int(11) DEFAULT NULL,
  PRIMARY KEY (`COD_IMOVEL`,`COD_PESSOA`,`DTA_INICIO`),
  KEY `fk_RE_IMOVEL_PESSOA_en_pessoas1` (`COD_PESSOA`),
  KEY `fk_RE_IMOVEL_PESSOA_en_imovel1` (`COD_IMOVEL`),
  CONSTRAINT `fk_RE_IMOVEL_PESSOA_en_imovel1` FOREIGN KEY (`COD_IMOVEL`) REFERENCES `en_imovel` (`COD_IMOVEL`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_RE_IMOVEL_PESSOA_en_pessoas1` FOREIGN KEY (`COD_PESSOA`) REFERENCES `en_pessoas` (`COD_PESSOA`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.re_imovel_pessoa: ~2 rows (aproximadamente)
DELETE FROM `re_imovel_pessoa`;
/*!40000 ALTER TABLE `re_imovel_pessoa` DISABLE KEYS */;
INSERT INTO `re_imovel_pessoa` (`COD_IMOVEL`, `COD_PESSOA`, `DTA_INICIO`, `DTA_FIM`, `DTA_CANCELAMENTO`, `VLR_TRANSACAO`, `TPO_TRANSACAO`, `NRO_DIA_PAGAMENTO`) VALUES
	(1, 1, '2014-04-23', '2014-04-30', '0000-00-00', 0.01, 'A', 26),
	(2, 7, '2014-02-24', '2015-03-24', '0000-00-00', 1500, 'A', 10);
/*!40000 ALTER TABLE `re_imovel_pessoa` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.re_permissao_perfil
DROP TABLE IF EXISTS `re_permissao_perfil`;
CREATE TABLE IF NOT EXISTS `re_permissao_perfil` (
  `COD_PERFIL` int(10) NOT NULL DEFAULT '0',
  `COD_PERFIL_ACESSO` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`COD_PERFIL`,`COD_PERFIL_ACESSO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.re_permissao_perfil: ~10 rows (aproximadamente)
DELETE FROM `re_permissao_perfil`;
/*!40000 ALTER TABLE `re_permissao_perfil` DISABLE KEYS */;
INSERT INTO `re_permissao_perfil` (`COD_PERFIL`, `COD_PERFIL_ACESSO`) VALUES
	(1, 1),
	(1, 3),
	(1, 5),
	(1, 6),
	(3, 3),
	(5, 3),
	(5, 5),
	(6, 3),
	(6, 5),
	(6, 6);
/*!40000 ALTER TABLE `re_permissao_perfil` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.se_menu
DROP TABLE IF EXISTS `se_menu`;
CREATE TABLE IF NOT EXISTS `se_menu` (
  `COD_MENU_W` int(4) NOT NULL,
  `DSC_MENU_W` varchar(100) DEFAULT NULL,
  `NME_CONTROLLER` varchar(1000) DEFAULT NULL,
  `NME_METHOD` varchar(1000) DEFAULT NULL,
  `DSC_CAMINHO_IMAGEM` varchar(1000) DEFAULT NULL,
  `IND_ATALHO` char(1) DEFAULT NULL,
  `IND_MENU_ATIVO_W` char(1) DEFAULT NULL,
  `COD_MENU_PAI_W` int(4) DEFAULT NULL,
  PRIMARY KEY (`COD_MENU_W`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.se_menu: ~30 rows (aproximadamente)
DELETE FROM `se_menu`;
/*!40000 ALTER TABLE `se_menu` DISABLE KEYS */;
INSERT INTO `se_menu` (`COD_MENU_W`, `DSC_MENU_W`, `NME_CONTROLLER`, `NME_METHOD`, `DSC_CAMINHO_IMAGEM`, `IND_ATALHO`, `IND_MENU_ATIVO_W`, `COD_MENU_PAI_W`) VALUES
	(5, 'Restrito', '../ArquivosGerais/MenuPrincipal.php?codMenuPai=5', '', '', 'N', 'S', 0),
	(6, 'UsuÃ¡rios', 'Usuario/UsuarioController.php', 'ChamaView', '../../Resources/images/add_user.png', 'S', 'S', 5),
	(7, 'Grupos de UsuÃ¡rios', 'Seguranca/PerfilController.php', 'ChamaView', '', 'N', 'S', 5),
	(8, 'PermissÃ£o de Menus', 'Seguranca/PermissaoController.php', 'ChamaView', '../../Resources/images/seguranca_3_5_Security2.png', 'S', 'S', 5),
	(9, 'Menus', 'Seguranca/CadastroMenuController.php', 'ChamaView', '../../Resources/images/aqua_icons_system_graphite_desktop.png', 'S', 'S', 5),
	(11, 'ConfiguraÃ§Ãµes', 'MenuPrincipal.php', NULL, NULL, NULL, 'S', 0),
	(17, 'Cadastro', '../ArquivosGerais/MenuPrincipal.php', NULL, NULL, NULL, 'S', 0),
	(28, 'Lojas', '#', NULL, NULL, NULL, 'S', 0),
	(31, 'NotÃ­cias', 'Noticias/NoticiasController.php', 'Chamaview', '../../Resources/images/ICONE NEWS.png', 'S', 'S', 17),
	(32, 'Clientes', 'Cliente/ClienteController.php', 'ChamaView', '', 'N', 'S', 5),
	(33, 'Lojas', 'Loja/LojaController.php', 'ChamaView', '../../Resources/images/6946_128x128.png', 'S', 'S', 5),
	(36, 'Pagamentos', '../boletophp/ListaBoletosCliente.php', NULL, NULL, NULL, 'S', 5),
	(37, 'Acesso Lojas', '../Lojas/ControleAcessoLoja.php', NULL, NULL, NULL, 'S', 5),
	(38, 'Lista Pagamentos Abertos', '../pagamentos/ListaPagamentosAbertos.php', NULL, NULL, NULL, 'S', 5),
	(40, 'Logof', '../index.php', '', '../../Resources/images/logof.jpg', 'S', 'S', 17),
	(41, 'Pessoas', 'Pessoa/PessoaController.php', 'ChamaView', '../../Resources/images/cliente.png', 'S', 'S', 17),
	(42, 'UF', 'Uf/UfController.php', 'ChamaView', '', 'N', 'S', 17),
	(43, 'Cidades', 'Cidade/CidadeController.php', 'ChamaView', '', 'N', 'S', 17),
	(44, 'Bairro', 'Bairro/BairroController.php', 'ChamaView', '', 'N', 'S', 17),
	(45, 'Detalhes do ImÃ³vel', 'Detalhe/DetalheController.php', 'ChamaView', '', 'N', 'S', 17),
	(46, 'ImÃ³veis', 'Imovel/ImovelController.php', 'ChamaView', '../../Resources/images/MenuPrincipal.jpg', 'S', 'S', 17),
	(47, 'RelatÃ³rios', '#', '', '', 'N', 'S', 0),
	(48, 'Bancos', 'Banco/BancoController.php', 'ChamaView', '', 'N', 'S', 17),
	(49, 'Dados Cadastrais', 'DadosCadastrais/DadosCadastraisController.php', 'ChamaView', '', 'N', 'S', 11),
	(50, 'MovimentaÃ§Ãµes', '#', '', '', 'N', 'S', 0),
	(51, 'TransaÃ§Ã£o de imÃ³vel', 'TransacaoImovel/TransacaoImovelController.php', 'ChamaView', '../../Resources/images/transferencia.png', 'S', 'S', 50),
	(52, 'PermissÃ£o de perfis', 'PermissaoPerfil/PermissaoPerfilController.php', 'ChamaView', '', 'N', 'S', 5),
	(53, 'Controle de Pagamentos', 'Boleto/BoletoController.php', 'ChamaView', '../../Resources/images/despesas.jpg', 'S', 'S', 50),
	(54, '2Âª via de boleto', 'Pagamento/PagamentoController.php', 'ChamaView', '', 'N', 'S', 50),
	(55, 'Tipo de Pagamento', 'TipoPagamento/TipoPagamentoController.php', 'ChamaView', '', 'N', 'S', 17);
/*!40000 ALTER TABLE `se_menu` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.se_menu_perfil
DROP TABLE IF EXISTS `se_menu_perfil`;
CREATE TABLE IF NOT EXISTS `se_menu_perfil` (
  `COD_PERFIL_W` int(4) NOT NULL,
  `COD_MENU_W` int(4) NOT NULL,
  PRIMARY KEY (`COD_PERFIL_W`,`COD_MENU_W`),
  KEY `FK_MENU` (`COD_MENU_W`),
  CONSTRAINT `FK_MENU` FOREIGN KEY (`COD_MENU_W`) REFERENCES `se_menu` (`COD_MENU_W`),
  CONSTRAINT `FK_PERFIL` FOREIGN KEY (`COD_PERFIL_W`) REFERENCES `se_perfil` (`COD_PERFIL_W`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.se_menu_perfil: ~57 rows (aproximadamente)
DELETE FROM `se_menu_perfil`;
/*!40000 ALTER TABLE `se_menu_perfil` DISABLE KEYS */;
INSERT INTO `se_menu_perfil` (`COD_PERFIL_W`, `COD_MENU_W`) VALUES
	(1, 5),
	(6, 5),
	(1, 6),
	(6, 6),
	(1, 7),
	(1, 8),
	(1, 9),
	(1, 11),
	(6, 11),
	(1, 17),
	(3, 17),
	(5, 17),
	(6, 17),
	(5, 28),
	(1, 31),
	(5, 31),
	(6, 31),
	(1, 32),
	(1, 33),
	(1, 37),
	(1, 38),
	(1, 40),
	(3, 40),
	(5, 40),
	(6, 40),
	(1, 41),
	(5, 41),
	(6, 41),
	(1, 42),
	(5, 42),
	(6, 42),
	(1, 43),
	(5, 43),
	(6, 43),
	(1, 44),
	(5, 44),
	(6, 44),
	(1, 45),
	(5, 45),
	(6, 45),
	(1, 46),
	(5, 46),
	(6, 46),
	(1, 48),
	(1, 49),
	(6, 49),
	(1, 50),
	(3, 50),
	(6, 50),
	(1, 51),
	(6, 51),
	(1, 52),
	(1, 53),
	(6, 53),
	(3, 54),
	(1, 55),
	(6, 55);
/*!40000 ALTER TABLE `se_menu_perfil` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.se_perfil
DROP TABLE IF EXISTS `se_perfil`;
CREATE TABLE IF NOT EXISTS `se_perfil` (
  `COD_PERFIL_W` int(4) NOT NULL DEFAULT '0',
  `DSC_PERFIL_W` varchar(50) DEFAULT NULL,
  `IND_ATIVO` char(1) DEFAULT NULL,
  PRIMARY KEY (`COD_PERFIL_W`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.se_perfil: ~4 rows (aproximadamente)
DELETE FROM `se_perfil`;
/*!40000 ALTER TABLE `se_perfil` DISABLE KEYS */;
INSERT INTO `se_perfil` (`COD_PERFIL_W`, `DSC_PERFIL_W`, `IND_ATIVO`) VALUES
	(1, 'Administrador', 'S'),
	(3, 'Cliente', 'S'),
	(5, 'SecretÃ¡ria', 'S'),
	(6, 'Gerente de ImobiliÃ¡ria', 'S');
/*!40000 ALTER TABLE `se_perfil` ENABLE KEYS */;


-- Copiando estrutura para tabela gimo.se_usuario
DROP TABLE IF EXISTS `se_usuario`;
CREATE TABLE IF NOT EXISTS `se_usuario` (
  `COD_USUARIO` int(4) NOT NULL DEFAULT '0',
  `NME_USUARIO` varchar(50) DEFAULT NULL,
  `NME_USUARIO_COMPLETO` varchar(60) DEFAULT NULL,
  `TXT_SENHA_W` varchar(1000) DEFAULT NULL,
  `IND_LOGADO` int(4) DEFAULT NULL,
  `DATA_LOGADO` datetime DEFAULT NULL,
  `NRO_TEL_CELULAR` varchar(50) DEFAULT NULL,
  `TXT_EMAIL` varchar(60) DEFAULT NULL,
  `DTA_INATIVO` datetime DEFAULT NULL,
  `COD_LOJA` int(4) DEFAULT NULL,
  `COD_PERFIL_W` int(4) DEFAULT NULL,
  `COD_CLIENTE` int(4) DEFAULT NULL,
  `TXT_SENHA_W_SEM_NADA` varchar(250) DEFAULT NULL,
  `NRO_CPF` varchar(11) DEFAULT NULL,
  `IND_ATIVO` char(1) DEFAULT NULL,
  PRIMARY KEY (`COD_USUARIO`),
  KEY `FK_PERFIL_USUARIO` (`COD_PERFIL_W`),
  KEY `FK_CLIENTE_USUARIO` (`COD_CLIENTE`),
  CONSTRAINT `FK_CLIENTE_USUARIO` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `en_cliente` (`COD_CLIENTE`),
  CONSTRAINT `FK_PERFIL_USUARIO` FOREIGN KEY (`COD_PERFIL_W`) REFERENCES `se_perfil` (`COD_PERFIL_W`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela gimo.se_usuario: ~15 rows (aproximadamente)
DELETE FROM `se_usuario`;
/*!40000 ALTER TABLE `se_usuario` DISABLE KEYS */;
INSERT INTO `se_usuario` (`COD_USUARIO`, `NME_USUARIO`, `NME_USUARIO_COMPLETO`, `TXT_SENHA_W`, `IND_LOGADO`, `DATA_LOGADO`, `NRO_TEL_CELULAR`, `TXT_EMAIL`, `DTA_INATIVO`, `COD_LOJA`, `COD_PERFIL_W`, `COD_CLIENTE`, `TXT_SENHA_W_SEM_NADA`, `NRO_CPF`, `IND_ATIVO`) VALUES
	(2, 'RAFAEL.FREITAS', 'Elaine Lopes', 'MQ==', 0, '0000-00-00 00:00:00', ' ', 'rafaelfcarneiro@gmail.com', '0000-00-00 00:00:00', 3, 1, 1, 'RFM144', '', 'S'),
	(6, 'Administrador', 'Administrador', 'MQ==', NULL, NULL, NULL, '', NULL, 1, 1, NULL, NULL, '', 'S'),
	(7, 'gerente', 'Francisco Pereira', 'MQ==', NULL, NULL, NULL, 'rafaelfcarneiro@gmail.com', NULL, 3, 6, NULL, NULL, '', 'S'),
	(8, 'ctis', 'Ctis', 'MQ==', NULL, NULL, NULL, '', NULL, 4, 6, NULL, NULL, '70167664115', 'S'),
	(9, '00000000191', 'Luciana', 'MTIzNDU5', NULL, NULL, NULL, 'lucianaribeiro.nunes@gmail.com', NULL, 4, 3, NULL, NULL, '00000000191', 'S'),
	(10, '60393315770', 'Teste', 'MTIzNDU5', NULL, NULL, NULL, '', NULL, 4, 3, NULL, NULL, '60393315770', 'S'),
	(11, '38811427703', 'Teste 1', 'MTIzNDU5', NULL, NULL, NULL, '', NULL, 4, 3, NULL, NULL, '38811427703', 'S'),
	(12, '35527338251', 'Teste 1', 'MTIzNDU5', NULL, NULL, NULL, '', NULL, 4, 3, NULL, NULL, '35527338251', 'S'),
	(13, '65548518526', 'Teste 1', 'MTIzNDU5', NULL, NULL, NULL, '', NULL, 4, 3, NULL, NULL, '65548518526', 'S'),
	(14, '45777436200', 'teste 02', 'MTIzNDU5', NULL, NULL, NULL, '', NULL, 4, 3, NULL, NULL, '45777436200', 'S'),
	(15, '70167664115', 'Rafael Freitas Carneiro', 'MQ==', NULL, NULL, NULL, 'rafaelfcarneiro@gmail.com', NULL, 3, 3, NULL, NULL, '70167664115', 'S'),
	(16, '14566788172', 'Ruy', 'MTIzNDU5', NULL, NULL, NULL, '', NULL, 3, 3, NULL, NULL, '14566788172', 'S'),
	(17, '84823771834', 'teste', 'MTIzNDU5', NULL, NULL, NULL, '', NULL, 1, 3, NULL, NULL, '84823771834', 'S'),
	(18, '74414558719', '744.145.587-19', 'MTIzNDU5', NULL, NULL, NULL, '', NULL, 1, 3, NULL, NULL, '74414558719', 'S'),
	(19, '53727341670', '537.273.416-70', 'MTIzNDU5', NULL, NULL, NULL, '', NULL, 1, 3, NULL, NULL, '53727341670', 'S');
/*!40000 ALTER TABLE `se_usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
