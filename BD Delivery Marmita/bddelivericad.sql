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
  `produto1` int(11) NOT NULL COMMENT 'Somente se o campo marmita da tabela produto for S',
  `produto2` int(11) DEFAULT NULL COMMENT 'Somente se o campo marmita da tabela produto for S',
  `datacardapio` date DEFAULT NULL COMMENT 'A data que sera adquirido',
  `datacadastro` date NOT NULL COMMENT 'Data inserida após realizar registro',
  `precovenda` float NOT NULL,
  PRIMARY KEY (`codcardapio`),
  UNIQUE KEY `datacadastro` (`datacadastro`),
  KEY `produto1` (`produto1`),
  KEY `produto2` (`produto2`),
  CONSTRAINT `produto1` FOREIGN KEY (`produto1`) REFERENCES `produto` (`codproduto`),
  CONSTRAINT `produto2` FOREIGN KEY (`produto2`) REFERENCES `produto` (`codproduto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Sómente um cardápio por dia';

-- Copiando dados para a tabela bddelivery.cardapio: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cardapio` DISABLE KEYS */;
/*!40000 ALTER TABLE `cardapio` ENABLE KEYS */;

-- Copiando estrutura para tabela bddelivery.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `codcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nomecliente` varchar(50) NOT NULL,
  `rg` varchar(12) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `sexo` varchar(50) NOT NULL,
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
  CONSTRAINT `endereco2` FOREIGN KEY (`endereco2`) REFERENCES `endereco` (`codend`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela bddelivery.cliente: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`codcliente`, `nomecliente`, `rg`, `cpf`, `sexo`, `dtnasc`, `telefone`, `telefone2`, `email`, `senha`, `endereco`, `endereco2`) VALUES
	(43, '21', '123', '123', '123', '2018-09-24', '123', NULL, '123', '123', 2, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela bddelivery.endereco: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` (`codend`, `cep`, `rua`, `cidade`, `numrua`, `comp`, `estado`, `bairro`) VALUES
	(1, '19901080', 'Rua Paraná', 'Ourinhos', 1234, NULL, 'SP', 'Jardim Matilde'),
	(2, '19901080', 'Rua Paraná', 'Ourinhos', 12345, NULL, 'SP', 'Jardim Matilde'),
	(3, '19901080', 'Rua Paraná', 'Ourinhos', 12345, NULL, 'SP', 'Jardim Matilde'),
	(4, '19901080', 'Rua Paraná', 'Ourinhos', 12345, NULL, 'SP', 'Jardim Matilde'),
	(5, '19901080', 'Rua Paraná', 'Ourinhos', 12345, NULL, 'SP', 'Jardim Matilde'),
	(6, '19901080', 'Rua Paraná', 'Ourinhos', 12345, NULL, 'SP', 'Jardim Matilde');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;

-- Copiando estrutura para tabela bddelivery.img
CREATE TABLE IF NOT EXISTS `img` (
  `codimg` int(11) NOT NULL AUTO_INCREMENT,
  `conteudo` blob NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `tipouso` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`codimg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bddelivery.img: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `img` DISABLE KEYS */;
/*!40000 ALTER TABLE `img` ENABLE KEYS */;

-- Copiando estrutura para tabela bddelivery.produto
CREATE TABLE IF NOT EXISTS `produto` (
  `codproduto` int(11) NOT NULL AUTO_INCREMENT,
  `nomeproduto` varchar(45) NOT NULL,
  `descproduto` text NOT NULL,
  `preco` float NOT NULL,
  `tamanho` varchar(1) DEFAULT NULL,
  `datacad` date NOT NULL,
  `marmita` varchar(1) NOT NULL,
  `img` int(11) NOT NULL,
  PRIMARY KEY (`codproduto`),
  KEY `imagem` (`img`),
  CONSTRAINT `imagem` FOREIGN KEY (`img`) REFERENCES `img` (`codimg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bddelivery.produto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;

-- Copiando estrutura para tabela bddelivery.venda
CREATE TABLE IF NOT EXISTS `venda` (
  `codvenda` int(11) NOT NULL AUTO_INCREMENT,
  `numvenda` int(11) NOT NULL,
  `datavenda` date NOT NULL COMMENT 'Preenchida automaticamente após inserção',
  `produto` int(11) NOT NULL,
  `qtdproduto` int(11) NOT NULL,
  `tipomarmita` int(11) DEFAULT NULL,
  `itemcardapio` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `enderecoent` int(11) NOT NULL COMMENT 'Endereco referenciado ao codigo que irá receber da tabela endereco que ja é referenciada com o cliente',
  `formapag` varchar(45) NOT NULL,
  `observacoes` varchar(100) DEFAULT NULL,
  `valorvenda` float NOT NULL,
  PRIMARY KEY (`codvenda`),
  UNIQUE KEY `numvenda` (`numvenda`),
  KEY `cliente` (`cliente`),
  KEY `produto` (`produto`),
  KEY `itemcardapio` (`itemcardapio`),
  KEY `enderecoent` (`enderecoent`),
  CONSTRAINT `cliente` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`codcliente`),
  CONSTRAINT `enderecoent` FOREIGN KEY (`enderecoent`) REFERENCES `endereco` (`codend`),
  CONSTRAINT `itemcardapio` FOREIGN KEY (`itemcardapio`) REFERENCES `cardapio` (`codcardapio`),
  CONSTRAINT `produto` FOREIGN KEY (`produto`) REFERENCES `produto` (`codproduto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bddelivery.venda: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `venda` DISABLE KEYS */;
/*!40000 ALTER TABLE `venda` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
