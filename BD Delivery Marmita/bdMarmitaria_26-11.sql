-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.13-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para bddelivery
CREATE DATABASE IF NOT EXISTS `bddelivery` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bddelivery`;

-- Copiando estrutura para tabela bddelivery.cardapio
CREATE TABLE IF NOT EXISTS `cardapio` (
  `codcardapio` int(11) NOT NULL AUTO_INCREMENT,
  `ceproduto1` int(11) NOT NULL COMMENT 'Somente se o campo marmita da tabela produto for S',
  `ceproduto2` int(11) DEFAULT NULL COMMENT 'Somente se o campo marmita da tabela produto for S',
  `datacardapio` date NOT NULL COMMENT 'A data que sera adquirido',
  `datacadastro` date NOT NULL COMMENT 'Data inserida após realizar registro',
  PRIMARY KEY (`codcardapio`),
  UNIQUE KEY `datacardapio` (`datacardapio`),
  KEY `FKEY_produto1` (`ceproduto1`),
  KEY `FKEY_produto2` (`ceproduto2`),
  CONSTRAINT `FKEY_produto1` FOREIGN KEY (`ceproduto1`) REFERENCES `produto` (`codproduto`),
  CONSTRAINT `FKEY_produto2` FOREIGN KEY (`ceproduto2`) REFERENCES `produto` (`codproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Sómente um cardápio por dia';

-- Copiando dados para a tabela bddelivery.cardapio: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cardapio` DISABLE KEYS */;
INSERT INTO `cardapio` (`codcardapio`, `ceproduto1`, `ceproduto2`, `datacardapio`, `datacadastro`) VALUES
	(3, 17, 19, '2018-06-01', '2018-10-09'),
	(4, 17, 21, '2018-11-26', '2018-10-09');
/*!40000 ALTER TABLE `cardapio` ENABLE KEYS */;

-- Copiando estrutura para tabela bddelivery.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `codcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nomecliente` varchar(50) NOT NULL,
  `rg` varchar(12) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `sexo` varchar(2) NOT NULL,
  `dtnasc` date NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `telefone2` varchar(14) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `senha` longtext NOT NULL,
  `endereco` int(11) NOT NULL,
  `endereco2` int(11) DEFAULT NULL,
  PRIMARY KEY (`codcliente`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cpf` (`cpf`),
  KEY `endereco` (`endereco`),
  KEY `endereco2` (`endereco2`),
  CONSTRAINT `endereco` FOREIGN KEY (`endereco`) REFERENCES `endereco` (`codend`),
  CONSTRAINT `endereco2` FOREIGN KEY (`endereco2`) REFERENCES `endereco` (`codend`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela bddelivery.cliente: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`codcliente`, `nomecliente`, `rg`, `cpf`, `sexo`, `dtnasc`, `telefone`, `telefone2`, `email`, `senha`, `endereco`, `endereco2`) VALUES
	(3, 'felipe correa gomes', '507995818', '46188259878', 'm', '2017-10-21', '14998975907', NULL, 'teste@gmail.com', '202cb962ac59075b964b07152d234b70', 86, 87),
	(4, 'felipe correa gomes', '12', '461882598780', 'f', '2000-10-21', '12312', NULL, 'fefefe@mail.com', '1c9ac0159c94d8d0cbedc973445af2da', 88, NULL);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela bddelivery.endereco
CREATE TABLE IF NOT EXISTS `endereco` (
  `codend` int(11) NOT NULL AUTO_INCREMENT,
  `cep` varchar(9) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `cidade` varchar(40) NOT NULL,
  `numrua` int(5) NOT NULL,
  `comp` int(3) DEFAULT NULL,
  `estado` varchar(4) NOT NULL,
  `bairro` varchar(40) NOT NULL,
  PRIMARY KEY (`codend`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela bddelivery.endereco: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` (`codend`, `cep`, `rua`, `cidade`, `numrua`, `comp`, `estado`, `bairro`) VALUES
	(76, '19901080', 'Rua Paraná', 'Ourinhos', 1563, NULL, 'SP', 'Jardim Matilde'),
	(77, '19901080', 'Rua Paraná', 'Ourinhos', 1563, NULL, 'SP', 'Jardim Matilde'),
	(78, '29027-278', 'Rua João Paulo Coutinho', 'Vitória', 123, NULL, 'ES', 'do Cabral'),
	(80, '29027-272', 'Rua João Paulo C1utinho', 'Vitó2a', 122, NULL, 'E2', 'do C2ral'),
	(81, '19901080', 'Rua Paraná', 'Ourinhos', 123, NULL, 'AC', 'Jardim Matilde'),
	(82, '29027-278', 'Rua João Paulo Coutinho', 'Vitória', 123, NULL, 'ES', 'do Cabral'),
	(83, '19901080', 'parana', 'ourinhos', 1563, NULL, 'sp', 'matilde'),
	(84, '19901080', 'parana', 'ourinhos', 1563, NULL, 'sp', 'matilde'),
	(85, '19901080', 'Rua Paraná', 'Ourinhos', 1234, NULL, 'SP', 'Jardim Matilde'),
	(86, '19901080', 'Rua Paraná', 'Ourinhos', 1563, NULL, 'SP', 'Jardim Matilde'),
	(87, '18113-800', 'Rua Benedito Galero', 'Votorantim', 1234, NULL, 'SP', 'Jardim São Matheus'),
	(88, '19901080', 'Rua Paraná', 'Ourinhos', 1563, NULL, 'SP', 'Jardim Matilde');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;

-- Copiando estrutura para tabela bddelivery.nfvenda
CREATE TABLE IF NOT EXISTS `nfvenda` (
  `codnf` int(11) NOT NULL AUTO_INCREMENT,
  `numvenda` int(11) NOT NULL COMMENT 'não é unico, pois será comparado a outros campos com o mesmo valor',
  `cecliente` int(11) NOT NULL,
  `ceproduto` int(11) NOT NULL,
  `qtdproduto` int(11) NOT NULL COMMENT 'Quantidade do produto',
  `datanf` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'data de criação da NF',
  `valortotal` float NOT NULL COMMENT 'armazena o valor total do produto para que ao atualizar o valor na tabela produtos, esteja guardado o valor vendido * qtd',
  PRIMARY KEY (`codnf`),
  KEY `FKEY_nf1` (`cecliente`),
  KEY `FKEY_nf2` (`ceproduto`),
  CONSTRAINT `FKEY_nf1` FOREIGN KEY (`cecliente`) REFERENCES `cliente` (`codcliente`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FKEY_nf2` FOREIGN KEY (`ceproduto`) REFERENCES `produto` (`codproduto`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COMMENT='Nota fiscal de vendas para armazenar o valor vendido e definir o numero de venda';

-- Copiando dados para a tabela bddelivery.nfvenda: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `nfvenda` DISABLE KEYS */;
INSERT INTO `nfvenda` (`codnf`, `numvenda`, `cecliente`, `ceproduto`, `qtdproduto`, `datanf`, `valortotal`) VALUES
	(1, 1, 3, 21, 3, '2018-11-25 00:00:00', 13),
	(11, 2, 3, 21, 2, '2018-11-25 10:56:27', 4),
	(12, 3, 3, 21, 2, '2018-11-25 12:23:57', 4),
	(13, 3, 3, 17, 1, '2018-11-25 12:23:57', 23.97),
	(14, 3, 3, 19, 2, '2018-11-25 12:23:57', 46);
/*!40000 ALTER TABLE `nfvenda` ENABLE KEYS */;

-- Copiando estrutura para tabela bddelivery.produto
CREATE TABLE IF NOT EXISTS `produto` (
  `codproduto` int(11) NOT NULL AUTO_INCREMENT,
  `nomeproduto` varchar(45) NOT NULL,
  `descproduto` text,
  `precoprod` float NOT NULL,
  `quantidade` smallint(6) NOT NULL COMMENT 'Quantidade em estoque',
  `datacad` date NOT NULL,
  `marmita` varchar(2) NOT NULL,
  PRIMARY KEY (`codproduto`),
  UNIQUE KEY `nomeproduto` (`nomeproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bddelivery.produto: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` (`codproduto`, `nomeproduto`, `descproduto`, `precoprod`, `quantidade`, `datacad`, `marmita`) VALUES
	(17, 'Marmita Teste', 'Arroz, feijão', 23.32, 1, '2018-10-05', 's'),
	(19, 'Coca-Cola', '300 ml', 3, 5, '2018-11-11', 'n'),
	(21, 'ccc', 'qaeqw', 2, 12, '2018-11-09', 's'),
	(22, 'Conquista', '1 lt', 3, 7, '2018-11-11', 'n');
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;

-- Copiando estrutura para tabela bddelivery.venda
CREATE TABLE IF NOT EXISTS `venda` (
  `codvenda` int(11) NOT NULL AUTO_INCREMENT,
  `numvenda` int(11) NOT NULL,
  `datavenda` date NOT NULL COMMENT 'Preenchida automaticamente após inserção',
  `qtdproduto` int(11) NOT NULL,
  `tipomarmita` int(11) DEFAULT NULL,
  `cecliente` int(11) NOT NULL,
  `formapag` varchar(45) DEFAULT NULL,
  `observacoes` varchar(100) DEFAULT NULL,
  `valorvenda` float NOT NULL,
  PRIMARY KEY (`codvenda`),
  KEY `FKEY_venda1` (`cecliente`),
  CONSTRAINT `FKEY_venda1` FOREIGN KEY (`cecliente`) REFERENCES `cliente` (`codcliente`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bddelivery.venda: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `venda` DISABLE KEYS */;
/*!40000 ALTER TABLE `venda` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
