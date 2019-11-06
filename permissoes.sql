-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.12-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2014-04-18 16:28:07
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for gimo
DROP DATABASE IF EXISTS `gimo`;
CREATE DATABASE IF NOT EXISTS `gimo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gimo`;


-- Dumping structure for table gimo.en_banco
DROP TABLE IF EXISTS `en_banco`;
CREATE TABLE IF NOT EXISTS `en_banco` (
  `COD_BANCO` int(11) NOT NULL,
  `NME_BANCO` varchar(100) DEFAULT NULL,
  `DSC_ARQUIVO_BOLETO` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`COD_BANCO`)
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
  `NRO_CPF` varchar(11) DEFAULT NULL,
  `IND_ATIVO` char(1) DEFAULT NULL,
  PRIMARY KEY (`COD_USUARIO`),
  KEY `FK_PERFIL_USUARIO` (`COD_PERFIL_W`),
  KEY `FK_CLIENTE_USUARIO` (`COD_CLIENTE`),
  CONSTRAINT `FK_CLIENTE_USUARIO` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `en_cliente` (`COD_CLIENTE`),
  CONSTRAINT `FK_PERFIL_USUARIO` FOREIGN KEY (`COD_PERFIL_W`) REFERENCES `se_perfil` (`COD_PERFIL_W`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
