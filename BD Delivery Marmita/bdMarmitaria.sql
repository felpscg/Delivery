-- MySQL Script generated by MySQL Workbench
-- Tue Aug 21 16:13:14 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema bddelivery
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bddelivery
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bddelivery` DEFAULT CHARACTER SET utf8 ;
USE `bddelivery` ;

-- -----------------------------------------------------
-- Table `bddelivery`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bddelivery`.`endereco` (
  `cidade` VARCHAR(45) NOT NULL,
  `bairro` VARCHAR(45) NOT NULL,
  `rua` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `cep` VARCHAR(45) NOT NULL,
  `cliente_end` INT NOT NULL,
  PRIMARY KEY (`cliente_end`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bddelivery`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bddelivery`.`clientes` (
  `cod_clientes` INT NOT NULL AUTO_INCREMENT,
  `nome_cliente` VARCHAR(45) NOT NULL,
  `rg` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `sexo` VARCHAR(45) NOT NULL,
  `dataNasc` DATETIME NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `telefone2` VARCHAR(45) NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `endereco` INT NOT NULL,
  `complemento` VARCHAR(45) NULL,
  PRIMARY KEY (`cod_clientes`),
  INDEX `endereco_idx` (`endereco` ASC),
  CONSTRAINT `endereco`
    FOREIGN KEY (`endereco`)
    REFERENCES `bddelivery`.`endereco` (`cliente_end`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bddelivery`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bddelivery`.`produtos` (
  `cod_produtos` INT NOT NULL AUTO_INCREMENT,
  `nome_produto` VARCHAR(45) NOT NULL,
  `descricao_prod` TEXT(200) NOT NULL,
  `preco` FLOAT NOT NULL,
  `tamanho` VARCHAR(45) NULL,
  `dataCad` DATETIME NOT NULL,
  `marmita` TINYINT NULL,
  PRIMARY KEY (`cod_produtos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bddelivery`.`vendas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bddelivery`.`vendas` (
  `num_vendas` INT NOT NULL AUTO_INCREMENT,
  `data_venda` DATETIME NOT NULL,
  `qtd_produto` INT NOT NULL,
  `produto` INT NOT NULL,
  `tipo_marmita` INT NULL,
  `valor_total_venda` FLOAT NOT NULL,
  `cliente` INT NOT NULL,
  `forma_pag` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(45) NULL,
  `item_cardapio` VARCHAR(45) NULL,
  `qtditem_cardapio` VARCHAR(45) NULL,
  `observacoes` VARCHAR(45) NULL,
  PRIMARY KEY (`num_vendas`),
  INDEX `cliente_idx` (`cliente` ASC),
  CONSTRAINT `cliente`
    FOREIGN KEY (`cliente`)
    REFERENCES `bddelivery`.`clientes` (`cod_clientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bddelivery`.`cardapio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bddelivery`.`cardapio` (
  `cod_cardapio` INT NOT NULL AUTO_INCREMENT,
  `produto1` INT NOT NULL,
  `produto2` INT NULL,
  `data_cardapio` DATE NOT NULL,
  `preco_venda_card` FLOAT NOT NULL,
  PRIMARY KEY (`cod_cardapio`),
  INDEX `produto1_idx` (`produto1` ASC, `produto2` ASC),
  CONSTRAINT `produto1`
    FOREIGN KEY (`produto1` , `produto2`)
    REFERENCES `bddelivery`.`produtos` (`cod_produtos` , `cod_produtos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bddelivery`.`imagens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bddelivery`.`imagens` (
  `cod_imagem` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  `hex` BLOB NOT NULL,
  `nome_imagem` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cod_imagem`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
