-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2025 at 08:24 AM
-- Server version: 8.0.41-0ubuntu0.22.04.1
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Jardineira`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cliente`
--

CREATE TABLE `Cliente` (
  `Id` int NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Endereco` varchar(255) NOT NULL,
  `Telefone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Compra`
--

CREATE TABLE `Compra` (
  `Id` int NOT NULL,
  `DataHora` datetime NOT NULL,
  `IdCliente` int NOT NULL,
  `StatusPagamento` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Estoque`
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
-- Table structure for table `Pedido`
--

CREATE TABLE `Pedido` (
  `Id` int NOT NULL,
  `IdProduto` int NOT NULL,
  `IdCompra` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Produto`
--

CREATE TABLE `Produto` (
  `Id` int NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Valor` float NOT NULL,
  `Tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Compra`
--
ALTER TABLE `Compra`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fkCliente` (`IdCliente`);

--
-- Indexes for table `Estoque`
--
ALTER TABLE `Estoque`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fkProdutoE` (`IdProduto`);

--
-- Indexes for table `Pedido`
--
ALTER TABLE `Pedido`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fkCompra` (`IdCompra`),
  ADD KEY `fkProduto` (`IdProduto`);

--
-- Indexes for table `Produto`
--
ALTER TABLE `Produto`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cliente`
--
ALTER TABLE `Cliente`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Compra`
--
ALTER TABLE `Compra`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Estoque`
--
ALTER TABLE `Estoque`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Pedido`
--
ALTER TABLE `Pedido`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Produto`
--
ALTER TABLE `Produto`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Compra`
--
ALTER TABLE `Compra`
  ADD CONSTRAINT `fkCliente` FOREIGN KEY (`IdCliente`) REFERENCES `Cliente` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `Estoque`
--
ALTER TABLE `Estoque`
  ADD CONSTRAINT `fkProdutoE` FOREIGN KEY (`IdProduto`) REFERENCES `Produto` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `Pedido`
--
ALTER TABLE `Pedido`
  ADD CONSTRAINT `fkCompra` FOREIGN KEY (`IdCompra`) REFERENCES `Compra` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fkProduto` FOREIGN KEY (`IdProduto`) REFERENCES `Produto` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
