-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Nov-2023 às 21:01
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `animal`
--

CREATE TABLE `animal` (
  `idAnimal` int(11) NOT NULL,
  `Brinco` varchar(10) NOT NULL,
  `Especie` varchar(45) NOT NULL,
  `Sexo` enum('M','F') NOT NULL,
  `Data_de_nascimento` date DEFAULT NULL,
  `Pelagem` varchar(45) DEFAULT NULL,
  `idRebanho` int(11) NOT NULL,
  `idProdutor` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `animal`
--

INSERT INTO `animal` (`idAnimal`, `Brinco`, `Especie`, `Sexo`, `Data_de_nascimento`, `Pelagem`, `idRebanho`, `idProdutor`, `idCategoria`) VALUES
(1, '15', 'gado jersey', 'F', '2023-05-10', 'vermelha ', 4, 1, 3),
(2, '18', 'angus', 'M', '2020-02-07', 'curto ', 5, 1, 4),
(3, '20', 'bovino', 'M', '2021-05-14', 'bege', 6, 1, 5),
(4, '37', 'angus', 'M', '2022-11-26', 'preto ', 4, 1, 1),
(5, '25', 'bovino', 'M', '2022-11-12', 'preto ', 2, 1, 5),
(6, '30', 'gado jersey', 'M', '2021-03-08', 'preto ', 5, 1, 5),
(7, '27', 'angus', 'M', '2022-02-12', 'preto ', 4, 1, 5),
(8, '45', 'bovino', 'M', '2021-03-02', 'branco', 5, 1, 5),
(9, '1', 'holandesa', 'F', '1111-11-11', 'vermelha ', 6, 1, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `idProdutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Nome`, `idProdutor`) VALUES
(1, 'bovina', 1),
(3, 'bovino', 1),
(4, 'bovino', 1),
(5, 'bovino', 1),
(6, 'ovino', 2),
(8, 'ovino', 1),
(10, 'aves', 1),
(11, 'peixes', 1),
(13, 'suino', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `IdEstoque` int(11) NOT NULL,
  `idAnimal` int(11) NOT NULL,
  `idInventario` int(11) NOT NULL,
  `Peso` float NOT NULL,
  `Status` enum('N','E','M','C','R') NOT NULL,
  `BO` text DEFAULT NULL,
  `idProdutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`IdEstoque`, `idAnimal`, `idInventario`, `Peso`, `Status`, `BO`, `idProdutor`) VALUES
(7, 5, 5, 600, 'E', '', 1),
(8, 4, 4, 540, 'C', '', 1),
(9, 8, 8, 120, 'M', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventario`
--

CREATE TABLE `inventario` (
  `idInventario` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Ano` year(4) NOT NULL,
  `idProdutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `inventario`
--

INSERT INTO `inventario` (`idInventario`, `Nome`, `Ano`, `idProdutor`) VALUES
(1, 'Inventario', 2018, 1),
(3, 'inventario', 2020, 1),
(4, 'inventario', 2021, 1),
(5, 'inventario', 2022, 1),
(6, 'inventario', 2023, 1),
(8, 'Inventario', 2019, 1),
(9, 'Inventario ', 2017, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rebanho`
--

CREATE TABLE `rebanho` (
  `idRebanho` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `idProdutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `rebanho`
--

INSERT INTO `rebanho` (`idRebanho`, `Nome`, `idProdutor`) VALUES
(1, 'rebanho 2', 1),
(2, 'rebanho 3', 1),
(4, 'rebanho 6', 1),
(5, 'rebanho 8', 1),
(6, 'rebanho 10', 1),
(7, 'rebanho 4', 1),
(8, 'Oi Duda (Ra aqui)!', 2),
(9, 'rebanho 30', 1),
(10, 'rebanho 1', 1),
(11, 'rebanho 5', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
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
  `Municipio` varchar(45) DEFAULT NULL,
  `Cep` char(10) DEFAULT NULL,
  `Nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idProdutor`, `Nome`, `Cpf`, `Telefone`, `Endereco`, `Email`, `Senha`, `Rg`, `Localidade`, `Prop_rural`, `Municipio`, `Cep`, `Nivel`) VALUES
(1, 'Eduarda!', '039.8521.160-37', '.', '.', 'eduarda.2021309901@aluno.iffar.edu.br', '202cb962ac59075b964b07152d234b70', '.', '.', '.', '.', '.', 2),
(2, 'alexandre', '123456789', NULL, NULL, 'aleixon@aleixon', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, NULL, 1),
(3, 'fabiana ', '9864368', NULL, NULL, 'fabiana@gmail', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, NULL, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`idAnimal`),
  ADD KEY `fk_idCategoria` (`idCategoria`),
  ADD KEY `fk_idProdutor` (`idProdutor`),
  ADD KEY `fk_idRebanho` (`idRebanho`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`),
  ADD KEY `fk_idProdutorm` (`idProdutor`);

--
-- Índices para tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`IdEstoque`),
  ADD KEY `fk_idProdutor_estoque` (`idProdutor`);

--
-- Índices para tabela `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idInventario`),
  ADD KEY `fk_idProdutor_inventario` (`idProdutor`);

--
-- Índices para tabela `rebanho`
--
ALTER TABLE `rebanho`
  ADD PRIMARY KEY (`idRebanho`),
  ADD KEY `fk_rebanho_usuario_idx` (`idProdutor`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idProdutor`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animal`
--
ALTER TABLE `animal`
  MODIFY `idAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `IdEstoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idInventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `rebanho`
--
ALTER TABLE `rebanho`
  MODIFY `idRebanho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idProdutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `fk_idCategoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`),
  ADD CONSTRAINT `fk_idProdutor` FOREIGN KEY (`idProdutor`) REFERENCES `usuario` (`idProdutor`),
  ADD CONSTRAINT `fk_idRebanho` FOREIGN KEY (`idRebanho`) REFERENCES `rebanho` (`idRebanho`);

--
-- Limitadores para a tabela `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_idProdutorm` FOREIGN KEY (`idProdutor`) REFERENCES `usuario` (`idProdutor`);

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `fk_idAnimal_estoque` FOREIGN KEY (`idAnimal`) REFERENCES `animal` (`idAnimal`),
  ADD CONSTRAINT `fk_idProdutor_estoque` FOREIGN KEY (`idProdutor`) REFERENCES `usuario` (`idProdutor`);

--
-- Limitadores para a tabela `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_idProdutor_inventario` FOREIGN KEY (`idProdutor`) REFERENCES `inventario` (`idInventario`);

--
-- Limitadores para a tabela `rebanho`
--
ALTER TABLE `rebanho`
  ADD CONSTRAINT `fk_idProdutor_rebanho` FOREIGN KEY (`idProdutor`) REFERENCES `rebanho` (`idRebanho`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
