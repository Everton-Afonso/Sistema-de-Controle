-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.18 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para mydb
CREATE DATABASE IF NOT EXISTS `mydb` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mydb`;

-- Copiando estrutura para tabela mydb.componentes
CREATE TABLE IF NOT EXISTS `componentes` (
  `idcomponentes` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idcomponentes`,`usuario_idusuario`),
  KEY `fk_componentes_usuario1_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_componentes_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mydb.componentes: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `componentes` DISABLE KEYS */;
INSERT INTO `componentes` (`idcomponentes`, `nome`, `descricao`, `quantidade`, `usuario_idusuario`) VALUES
	(1, 'Arduino Uno', 'Placas Microcontroladora', 10, 1),
	(2, 'Resistor 1K', 'Tem finalidade de transformar energia elétrica em energia térmica', 40, 1),
	(3, 'Resistor 10K', 'Tem finalidade de transformar energia elétrica em energia térmica', 50, 1),
	(4, 'Resistor 350 ohms', 'Tem finalidade de transformar energia elétrica em energia térmica', 20, 1);
/*!40000 ALTER TABLE `componentes` ENABLE KEYS */;

-- Copiando estrutura para tabela mydb.estoque
CREATE TABLE IF NOT EXISTS `estoque` (
  `idestoque` int(11) NOT NULL AUTO_INCREMENT,
  `descricaoEstoque` varchar(255) NOT NULL,
  `componentes_idcomponentes` int(11) NOT NULL,
  PRIMARY KEY (`idestoque`,`componentes_idcomponentes`),
  KEY `fk_estoque_componentes1_idx` (`componentes_idcomponentes`),
  CONSTRAINT `fk_estoque_componentes1` FOREIGN KEY (`componentes_idcomponentes`) REFERENCES `componentes` (`idcomponentes`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mydb.estoque: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;

-- Copiando estrutura para tabela mydb.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(30) NOT NULL,
  `pass` varchar(100) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela mydb.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idusuario`, `user`, `pass`) VALUES
	(1, 'autobots', '$2y$10$wQyWO1rj.DzbZlf8u/t0j.aVSeJXVrTQxOISJeKXxbBwpeb2xHO3K');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
