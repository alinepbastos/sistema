-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.13 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para sistema
DROP DATABASE IF EXISTS `sistema`;
CREATE DATABASE IF NOT EXISTS `sistema` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sistema`;


-- Copiando estrutura para tabela sistema.cliente
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_cnpj` varchar(14) NOT NULL COMMENT 'Número do Docto',
  `cli_razaosocial` varchar(200) NOT NULL,
  `cli_status` int(2) NOT NULL,
  `cli_key` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`cli_id`),
  UNIQUE KEY `cli_cnpj` (`cli_cnpj`),
  KEY `FK2_CLIENTE_STATUS` (`cli_status`),
  CONSTRAINT `FK2_CLIENTE_STATUS` FOREIGN KEY (`cli_status`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistema.cliente: ~0 rows (aproximadamente)
DELETE FROM `cliente`;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


-- Copiando estrutura para tabela sistema.contrato
DROP TABLE IF EXISTS `contrato`;
CREATE TABLE IF NOT EXISTS `contrato` (
  `contr_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_id` int(11) NOT NULL,
  `serv_id` int(11) NOT NULL,
  `contr_datainicial` date NOT NULL,
  `contr_datafinal` date NOT NULL,
  `contr_key` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`contr_id`),
  KEY `FK1_REG_CLI_ID` (`cli_id`),
  KEY `FK2_REG_SERV_ID` (`serv_id`),
  CONSTRAINT `FK1_REG_CLI_ID` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`),
  CONSTRAINT `FK2_REG_SERV_ID` FOREIGN KEY (`serv_id`) REFERENCES `servico` (`serv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistema.contrato: ~0 rows (aproximadamente)
DELETE FROM `contrato`;
/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;


-- Copiando estrutura para tabela sistema.servico
DROP TABLE IF EXISTS `servico`;
CREATE TABLE IF NOT EXISTS `servico` (
  `serv_id` int(11) NOT NULL AUTO_INCREMENT,
  `serv_descricao` varchar(200) NOT NULL,
  `serv_status` int(2) NOT NULL,
  `serv_key` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`serv_id`),
  KEY `FK1_SERV_STATUS` (`serv_status`),
  CONSTRAINT `FK1_SERV_STATUS` FOREIGN KEY (`serv_status`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistema.servico: ~0 rows (aproximadamente)
DELETE FROM `servico`;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;


-- Copiando estrutura para tabela sistema.status
DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL,
  `status_descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistema.status: ~2 rows (aproximadamente)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`status_id`, `status_descricao`) VALUES
	(0, 'Inativo'),
	(1, 'Ativo');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;


-- Copiando estrutura para tabela sistema.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nome` varchar(150) NOT NULL,
  `usu_login` varchar(50) NOT NULL,
  `usu_senha` varchar(200) NOT NULL,
  `usu_key` varchar(200) NOT NULL,
  `usu_status` int(2) DEFAULT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `login` (`usu_login`),
  KEY `FK1_USUARIO_STATUS` (`usu_status`),
  CONSTRAINT `FK1_USUARIO_STATUS` FOREIGN KEY (`usu_status`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistema.usuario: ~1 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usu_id`, `usu_nome`, `usu_login`, `usu_senha`, `usu_key`, `usu_status`) VALUES
	(1, 'Aline', 'aline', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'c4ca4238a0b923820dcc509a6f75849b', 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


-- Copiando estrutura para view sistema.view_contratos_clientes
DROP VIEW IF EXISTS `view_contratos_clientes`;
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `view_contratos_clientes` (
	`contr_id` INT(11) NOT NULL,
	`cli_id` INT(11) NOT NULL,
	`cli_cnpj` VARCHAR(14) NOT NULL COMMENT 'Número do Docto' COLLATE 'latin1_swedish_ci',
	`cli_razaosocial` VARCHAR(200) NOT NULL COLLATE 'latin1_swedish_ci',
	`serv_id` INT(11) NOT NULL,
	`serv_descricao` VARCHAR(200) NOT NULL COLLATE 'latin1_swedish_ci',
	`inicio` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`fim` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`dias_restantes` INT(7) NULL,
	`cli_key` VARCHAR(200) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;


-- Copiando estrutura para trigger sistema.trg_cria_key_cliente
DROP TRIGGER IF EXISTS `trg_cria_key_cliente`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trg_cria_key_cliente` BEFORE INSERT ON `cliente` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    
      /* Pega o valor do AUTO_INCREMENT. */    
    SELECT AUTO_INCREMENT into next_id
	 FROM  INFORMATION_SCHEMA.TABLES
	 WHERE TABLE_SCHEMA = 'sistema'
	 AND   TABLE_NAME   = 'cliente';

    SET NEW.cli_key = MD5(next_id);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Copiando estrutura para trigger sistema.trg_cria_key_contrato
DROP TRIGGER IF EXISTS `trg_cria_key_contrato`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trg_cria_key_contrato` BEFORE INSERT ON `contrato` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    
      /* Pega o valor do AUTO_INCREMENT. */    
    SELECT AUTO_INCREMENT into next_id
	 FROM  INFORMATION_SCHEMA.TABLES
	 WHERE TABLE_SCHEMA = 'sistema'
	 AND   TABLE_NAME   = 'contrato';

    SET NEW.contr_key = MD5(next_id);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Copiando estrutura para trigger sistema.trg_cria_key_servico
DROP TRIGGER IF EXISTS `trg_cria_key_servico`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trg_cria_key_servico` BEFORE INSERT ON `servico` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    
    /* Pega o valor do AUTO_INCREMENT. */    
    SELECT AUTO_INCREMENT into next_id
	 FROM  INFORMATION_SCHEMA.TABLES
	 WHERE TABLE_SCHEMA = 'sistema'
	 AND   TABLE_NAME   = 'servico';

    SET NEW.serv_key = MD5(next_id);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Copiando estrutura para trigger sistema.trg_cria_key_usuario
DROP TRIGGER IF EXISTS `trg_cria_key_usuario`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trg_cria_key_usuario` BEFORE INSERT ON `usuario` FOR EACH ROW BEGIN
      
    DECLARE next_id INT;
    
      /* Pega o valor do AUTO_INCREMENT. */    
    SELECT AUTO_INCREMENT into next_id
	 FROM  INFORMATION_SCHEMA.TABLES
	 WHERE TABLE_SCHEMA = 'sistema'
	 AND   TABLE_NAME   = 'usuario';

    SET NEW.usu_key = MD5(next_id);
    
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Copiando estrutura para view sistema.view_contratos_clientes
DROP VIEW IF EXISTS `view_contratos_clientes`;
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `view_contratos_clientes`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `view_contratos_clientes` AS SELECT contr.contr_id, contr.cli_id, cli.cli_cnpj, cli.cli_razaosocial, contr.serv_id,
serv.serv_descricao, DATE_FORMAT(contr.contr_datainicial, '%d/%m/%Y') as inicio, 
DATE_FORMAT(contr.contr_datafinal, '%d/%m/%Y') as fim,
DATEDIFF( contr.contr_datafinal, NOW()) as dias_restantes, cli_key
FROM contrato contr, cliente cli, servico serv
WHERE contr.cli_id = cli.cli_id
AND contr.serv_id = serv.serv_id ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
