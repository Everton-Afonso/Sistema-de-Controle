-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.23 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para mydb
CREATE DATABASE IF NOT EXISTS `mydb` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mydb`;

-- Copiando estrutura para tabela mydb.baixas
CREATE TABLE IF NOT EXISTS `baixas` (
  `idBaixas` int NOT NULL AUTO_INCREMENT,
  `motivo` varchar(150) NOT NULL,
  `data` date NOT NULL,
  `estoque_idestoque` int NOT NULL,
  PRIMARY KEY (`idBaixas`,`estoque_idestoque`),
  KEY `fk_baixas_estoque1_idx` (`estoque_idestoque`),
  CONSTRAINT `fk_baixas_estoque1` FOREIGN KEY (`estoque_idestoque`) REFERENCES `estoque` (`idestoque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mydb.baixas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `baixas` DISABLE KEYS */;
/*!40000 ALTER TABLE `baixas` ENABLE KEYS */;

-- Copiando estrutura para tabela mydb.estoque
CREATE TABLE IF NOT EXISTS `estoque` (
  `idestoque` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `quantidade` int NOT NULL,
  `usuario_idusuario` int NOT NULL,
  PRIMARY KEY (`idestoque`,`usuario_idusuario`),
  KEY `fk_Estoque_Usuario_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_Estoque_Usuario` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mydb.estoque: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
INSERT INTO `estoque` (`idestoque`, `nome`, `localizacao`, `descricao`, `quantidade`, `usuario_idusuario`) VALUES
	(79, 'Led', 'Armario', 'Led De Auto Brilho', 33, 1),
	(80, 'Arduino', 'Prateleira', 'Placa', 27, 1),
	(81, 'Led Vermelho', 'Armario', 'Lede De Auto Brilho', 600, 1),
	(82, 'teste', 'teste', 'teste', 2, 1),
	(83, 'Teste3', 'Placa', 'Prateleira', 4, 1),
	(84, 'Teste 2', 'Placa', 'Armario', 5, 1),
	(85, 'Arduino Uno', 'Placa', 'Armario', 50, 1),
	(86, 'Teste 1', 'Placa', 'Prateleira', 50, 1);
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;

-- Copiando estrutura para tabela mydb.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `user` varchar(45) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mydb.usuario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idusuario`, `user`, `pass`) VALUES
	(1, 'autobots', '$2y$10$wQyWO1rj.DzbZlf8u/t0j.aVSeJXVrTQxOISJeKXxbBwpeb2xHO3K');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
