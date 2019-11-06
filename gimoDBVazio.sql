-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.12-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2014-04-18 09:31:26
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for gimo
DROP DATABASE IF EXISTS `gimo`;
CREATE DATABASE IF NOT EXISTS `gimo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gimo`;


-- Dumping structure for table gimo.en_bairro
DROP TABLE IF EXISTS `en_bairro`;
CREATE TABLE IF NOT EXISTS `en_bairro` (
  `COD_BAIRRO` int(11) NOT NULL,
  `COD_CIDADE` int(11) NOT NULL,
  `NME_BAIRRO` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`COD_BAIRRO`,`COD_CIDADE`),
  KEY `FK_EN_BAIRRO_en_cidade` (`COD_CIDADE`),
  CONSTRAINT `FK_EN_BAIRRO_en_cidade` FOREIGN KEY (`COD_CIDADE`) REFERENCES `en_cidade` (`COD_CIDADE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table gimo.en_banco
DROP TABLE IF EXISTS `en_banco`;
CREATE TABLE IF NOT EXISTS `en_banco` (
  `COD_BANCO` int(11) NOT NULL,
  `NME_BANCO` varchar(100) DEFAULT NULL,
  `DSC_ARQUIVO_BOLETO` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`COD_BANCO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table gimo.en_cidade
DROP TABLE IF EXISTS `en_cidade`;
CREATE TABLE IF NOT EXISTS `en_cidade` (
  `COD_CIDADE` int(11) NOT NULL,
  `SGL_UF` char(2) NOT NULL,
  `NME_CIDADE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`COD_CIDADE`,`SGL_UF`),
  KEY `FK_UF_CIDADE` (`SGL_UF`),
  CONSTRAINT `FK_UF_CIDADE` FOREIGN KEY (`SGL_UF`) REFERENCES `en_uf` (`SGL_UF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table gimo.en_cliente
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
  PRIMARY KEY (`COD_CLIENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table gimo.en_detalhe
DROP TABLE IF EXISTS `en_detalhe`;
CREATE TABLE IF NOT EXISTS `en_detalhe` (
  `COD_DETALHE` int(11) NOT NULL,
  `DSC_DETALHE` varchar(100) DEFAULT NULL,
  `IND_ATIVO` char(1) DEFAULT NULL,
  PRIMARY KEY (`COD_DETALHE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table gimo.en_imovel
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

-- Data exporting was unselected.


-- Dumping structure for table gimo.en_loja
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

-- Data exporting was unselected.


-- Dumping structure for table gimo.en_noticias
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

-- Data exporting was unselected.


-- Dumping structure for table gimo.en_pessoas
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

-- Data exporting was unselected.


-- Dumping structure for table gimo.en_uf
DROP TABLE IF EXISTS `en_uf`;
CREATE TABLE IF NOT EXISTS `en_uf` (
  `SGL_UF` char(2) NOT NULL,
  `DSC_UF` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SGL_UF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table gimo.re_detalhe_imovel
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

-- Data exporting was unselected.


-- Dumping structure for table gimo.re_imovel_pagamento
DROP TABLE IF EXISTS `re_imovel_pagamento`;
CREATE TABLE IF NOT EXISTS `re_imovel_pagamento` (
  `COD_IMOVEL` int(10) NOT NULL DEFAULT '0',
  `DTA_VENCIMENTO` date DEFAULT NULL,
  `DTA_PAGAMENTO` date DEFAULT NULL,
  `VLR_MENSALIDADE` float DEFAULT NULL,
  `NRO_DOCUMENTO` varchar(50) DEFAULT NULL,
  `NRO_NOSSO_NUMERO` varchar(50) DEFAULT NULL,
  `COD_TIPO_PAGAMENTO` int(11) DEFAULT NULL,
  `VLR_PAGAMENTO` float DEFAULT NULL,
  PRIMARY KEY (`COD_IMOVEL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table gimo.re_imovel_pessoa
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

-- Data exporting was unselected.


-- Dumping structure for table gimo.re_permissao_perfil
DROP TABLE IF EXISTS `re_permissao_perfil`;
CREATE TABLE IF NOT EXISTS `re_permissao_perfil` (
  `COD_PERFIL` int(10) NOT NULL DEFAULT '0',
  `COD_PERFIL_ACESSO` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`COD_PERFIL`,`COD_PERFIL_ACESSO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table gimo.se_menu
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

-- Data exporting was unselected.


-- Dumping structure for table gimo.se_menu_perfil
DROP TABLE IF EXISTS `se_menu_perfil`;
CREATE TABLE IF NOT EXISTS `se_menu_perfil` (
  `COD_PERFIL_W` int(4) NOT NULL,
  `COD_MENU_W` int(4) NOT NULL,
  PRIMARY KEY (`COD_PERFIL_W`,`COD_MENU_W`),
  KEY `FK_MENU` (`COD_MENU_W`),
  CONSTRAINT `FK_MENU` FOREIGN KEY (`COD_MENU_W`) REFERENCES `se_menu` (`COD_MENU_W`),
  CONSTRAINT `FK_PERFIL` FOREIGN KEY (`COD_PERFIL_W`) REFERENCES `se_perfil` (`COD_PERFIL_W`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table gimo.se_perfil
DROP TABLE IF EXISTS `se_perfil`;
CREATE TABLE IF NOT EXISTS `se_perfil` (
  `COD_PERFIL_W` int(4) NOT NULL DEFAULT '0',
  `DSC_PERFIL_W` varchar(50) DEFAULT NULL,
  `IND_ATIVO` char(1) DEFAULT NULL,
  PRIMARY KEY (`COD_PERFIL_W`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table gimo.se_usuario
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
  PRIMARY KEY (`COD_USUARIO`),
  KEY `FK_PERFIL_USUARIO` (`COD_PERFIL_W`),
  KEY `FK_CLIENTE_USUARIO` (`COD_CLIENTE`),
  CONSTRAINT `FK_CLIENTE_USUARIO` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `en_cliente` (`COD_CLIENTE`),
  CONSTRAINT `FK_PERFIL_USUARIO` FOREIGN KEY (`COD_PERFIL_W`) REFERENCES `se_perfil` (`COD_PERFIL_W`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
