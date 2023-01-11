-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.27-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para teste_pmk
CREATE DATABASE IF NOT EXISTS `teste_pmk` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `teste_pmk`;

-- Copiando estrutura para tabela teste_pmk.doadores
CREATE TABLE IF NOT EXISTS `doadores` (
  `id_doador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(144) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `data_cad` date DEFAULT NULL,
  `intervalo` varchar(50) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `forma_pag` varchar(50) DEFAULT NULL,
  `cod_banco` varchar(50) DEFAULT NULL,
  `agencia` varchar(50) DEFAULT NULL,
  `conta` varchar(50) DEFAULT NULL,
  `cartao` varchar(50) DEFAULT NULL,
  `nome_ipresso` varchar(50) DEFAULT NULL,
  `venc_cartao` varchar(50) DEFAULT NULL,
  `cvv` varchar(50) DEFAULT NULL,
  `cep` varchar(50) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_doador`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela teste_pmk.doadores: ~1 rows (aproximadamente)
INSERT INTO `doadores` (`id_doador`, `nome`, `cpf`, `email`, `telefone`, `data_nasc`, `data_cad`, `intervalo`, `valor`, `forma_pag`, `cod_banco`, `agencia`, `conta`, `cartao`, `nome_ipresso`, `venc_cartao`, `cvv`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`) VALUES
	(1, 'Doador Teste', '512.738.200-88', 'teste@teste.com.br', '(11) 98564-9565', '2000-01-20', '2023-01-10', 'Bimestral', 125, 'credito', '237', '', '', '5540 7367 5543 1900', 'Teste T Teste', '02/24', '169', '04344070', 'Avenida General Valdomiro de Lima', '217', '', 'Jabaquara', 'São Paulo', 'SP');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
