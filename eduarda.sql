-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/08/2023 às 09:06
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `eduarda`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `animal`
--

CREATE TABLE `animal` (
  `IdAnimal` int(11) NOT NULL,
  `Brinco` varchar(10) NOT NULL,
  `Especie` varchar(45) NOT NULL,
  `Sexo` enum('M','F') NOT NULL,
  `Data_de_nascimento` date DEFAULT NULL,
  `Pelagem` varchar(45) DEFAULT NULL,
  `IdCategoria` int(11) NOT NULL,
  `idProdutor` int(11) NOT NULL,
  `idRebanho` int(11) NOT NULL,
  `Peso` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `animal`
--

INSERT INTO `animal` (`IdAnimal`, `Brinco`, `Especie`, `Sexo`, `Data_de_nascimento`, `Pelagem`, `IdCategoria`, `idProdutor`, `idRebanho`, `Peso`) VALUES
(13, 'A1B1', 'pastor', 'F', '1943-11-22', 'pelagem-teste', 5, 36, 6, 222.33);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `idProdutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Nome`, `idProdutor`) VALUES
(5, 'categoria_teste', 36);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `ANIMAL_IdAnimal` int(11) NOT NULL,
  `INVENTARIO_idInventario` int(11) NOT NULL,
  `Peso_total` float NOT NULL,
  `Status` enum('N','E','M','C','R') NOT NULL DEFAULT 'E'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `inventario`
--

CREATE TABLE `inventario` (
  `idInventario` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Ano` char(4) NOT NULL,
  `idProdutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `inventario`
--

INSERT INTO `inventario` (`idInventario`, `Nome`, `Ano`, `idProdutor`) VALUES
(3, 'a', '2000', 36);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rebanho`
--

CREATE TABLE `rebanho` (
  `idRebanho` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `idProdutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `rebanho`
--

INSERT INTO `rebanho` (`idRebanho`, `Nome`, `idProdutor`) VALUES
(6, 'teste_rebanho', 36);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idProdutor` int(11) NOT NULL,
  `Nome` varchar(80) NOT NULL,
  `Cpf` varchar(15) NOT NULL,
  `Telefone` varchar(15) DEFAULT NULL,
  `Endereco` text DEFAULT NULL,
  `Email` varchar(45) NOT NULL,
  `Senha` varchar(80) NOT NULL,
  `Rg` varchar(12) DEFAULT NULL,
  `Localidade` varchar(45) DEFAULT NULL,
  `Prop_rural` varchar(60) DEFAULT NULL,
  `Municipio` varchar(45) DEFAULT 'São Borja',
  `Cep` char(10) DEFAULT NULL,
  `Nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idProdutor`, `Nome`, `Cpf`, `Telefone`, `Endereco`, `Email`, `Senha`, `Rg`, `Localidade`, `Prop_rural`, `Municipio`, `Cep`, `Nivel`) VALUES
(35, 'Alexandre Pires', '049.688.270-84', '222', 'rua coronel lago', 'ale@gmail.com', '202cb962ac59075b964b07152d234b70', '121221', '11212', '12121112', 'São Borja', '1212', 2),
(36, 'Eduarda Dotto ', '039.8521.160-37', '22', 'a', 'eduarda.2021309901@aluno.iffar.edu.br', '202cb962ac59075b964b07152d234b70', 'a', 'a', 'a', 'São Borja', 'a', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`IdAnimal`),
  ADD UNIQUE KEY `Brinco` (`Brinco`),
  ADD KEY `fk_Animal_Categoria1_idx` (`IdCategoria`),
  ADD KEY `fk_Animal_Usuário1_idx` (`idProdutor`),
  ADD KEY `fk_Animal_Rebanho1_idx` (`idRebanho`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`),
  ADD KEY `fk_Categoria_Usuario` (`idProdutor`);

--
-- Índices de tabela `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idInventario`),
  ADD KEY `fk_Inventario_Usuario` (`idProdutor`);

--
-- Índices de tabela `rebanho`
--
ALTER TABLE `rebanho`
  ADD PRIMARY KEY (`idRebanho`),
  ADD KEY `fk_Rebanho_Usuario` (`idProdutor`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idProdutor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animal`
--
ALTER TABLE `animal`
  MODIFY `IdAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idInventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `rebanho`
--
ALTER TABLE `rebanho`
  MODIFY `idRebanho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idProdutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `fk_Animal_Categoria1` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Animal_Rebanho1` FOREIGN KEY (`idRebanho`) REFERENCES `rebanho` (`idRebanho`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Animal_Usuário1` FOREIGN KEY (`idProdutor`) REFERENCES `usuario` (`idProdutor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_Categoria_Usuario` FOREIGN KEY (`idProdutor`) REFERENCES `usuario` (`idProdutor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_Inventario_Usuario` FOREIGN KEY (`idProdutor`) REFERENCES `usuario` (`idProdutor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `rebanho`
--
ALTER TABLE `rebanho`
  ADD CONSTRAINT `fk_Rebanho_Usuario` FOREIGN KEY (`idProdutor`) REFERENCES `usuario` (`idProdutor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
