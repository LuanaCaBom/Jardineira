-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 04/06/2025 às 16:52
-- Versão do servidor: 8.0.41-0ubuntu0.22.04.1
-- Versão do PHP: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `Jardineira`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Cliente`
--

CREATE TABLE `Cliente` (
  `Id` int NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Endereco` varchar(255) NOT NULL,
  `Telefone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `Cliente`
--

INSERT INTO `Cliente` (`Id`, `Nome`, `Email`, `Endereco`, `Telefone`) VALUES
(2, 'bsdgb', 'adfgasg@ughdv.lkdj', 'afgjswej', '166949849486');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Compra`
--

CREATE TABLE `Compra` (
  `Id` int NOT NULL,
  `DataHora` datetime NOT NULL,
  `IdCliente` int NOT NULL,
  `StatusPagamento` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Estoque`
--

CREATE TABLE `Estoque` (
  `Id` int NOT NULL,
  `Localizacao` varchar(255) NOT NULL,
  `Quantidade` int NOT NULL,
  `Lote` int NOT NULL,
  `IdProduto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Pedido`
--

CREATE TABLE `Pedido` (
  `Id` int NOT NULL,
  `IdProduto` int NOT NULL,
  `IdCompra` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Produto`
--

CREATE TABLE `Produto` (
  `Id` int NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Valor` float NOT NULL,
  `Tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `Produto`
--

INSERT INTO `Produto` (`Id`, `Nome`, `Valor`, `Tipo`) VALUES
(1, 'Djamba', 30, 'Remédio');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`Id`);

--
-- Índices de tabela `Compra`
--
ALTER TABLE `Compra`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fkCliente` (`IdCliente`);

--
-- Índices de tabela `Estoque`
--
ALTER TABLE `Estoque`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fkProdutoE` (`IdProduto`);

--
-- Índices de tabela `Pedido`
--
ALTER TABLE `Pedido`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fkCompra` (`IdCompra`),
  ADD KEY `fkProduto` (`IdProduto`);

--
-- Índices de tabela `Produto`
--
ALTER TABLE `Produto`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Cliente`
--
ALTER TABLE `Cliente`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `Compra`
--
ALTER TABLE `Compra`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Estoque`
--
ALTER TABLE `Estoque`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Pedido`
--
ALTER TABLE `Pedido`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Produto`
--
ALTER TABLE `Produto`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `Compra`
--
ALTER TABLE `Compra`
  ADD CONSTRAINT `fkCliente` FOREIGN KEY (`IdCliente`) REFERENCES `Cliente` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `Estoque`
--
ALTER TABLE `Estoque`
  ADD CONSTRAINT `fkProdutoE` FOREIGN KEY (`IdProduto`) REFERENCES `Produto` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `Pedido`
--
ALTER TABLE `Pedido`
  ADD CONSTRAINT `fkCompra` FOREIGN KEY (`IdCompra`) REFERENCES `Compra` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fkProduto` FOREIGN KEY (`IdProduto`) REFERENCES `Produto` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
