-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/03/2026 às 15:31
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mydb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carro`
--

CREATE TABLE `carro` (
  `CarroID` int(11) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `marca` varchar(35) NOT NULL,
  `Ano` int(11) NOT NULL,
  `cor` varchar(45) NOT NULL,
  `ProprietarioID` int(11) NOT NULL,
  `ManutencaoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `carro`
--

INSERT INTO `carro` (`CarroID`, `modelo`, `marca`, `Ano`, `cor`, `ProprietarioID`, `ManutencaoID`) VALUES
(1, 'Civic', 'Honda', 2022, 'Preto', 1, 1),
(2, 'Onix', 'Chevrolet', 2021, 'Branco', 2, 2),
(3, 'Corolla', 'Toyota', 2023, 'Prata', 3, 3),
(4, 'HB20', 'Hyundai', 2020, 'Azul', 4, 4),
(5, 'Golf', 'Volkswagen', 2019, 'Vermelho', 5, 5),
(6, 'Mustang', 'Ford', 2023, 'Laranja', 1, 1),
(7, 'Compass', 'Jeep', 2022, 'Branco', 2, 2),
(8, 'Sandero', 'Renault', 2020, 'Prata', 3, 3),
(9, 'T-Cross', 'Volkswagen', 2021, 'Cinza', 4, 4),
(10, 'Yaris', 'Toyota', 2024, 'Azul', 5, 5),
(11, 'Mustang', 'FordManual', 2024, 'Laranja', 1, 1),
(12, '208', 'Pegout', 2022, 'Branco', 2, 2),
(13, 'Sandero', 'Renault', 2020, 'Prata', 3, 3),
(14, 'Dolphin', 'BYD', 2025, 'Azul', 4, 4),
(15, 'Yaris', 'Toyota', 2024, 'Prata', 5, 5),
(16, 'Mustang', 'FordManual', 2024, 'Laranja', 1, 1),
(17, '208', 'Pegout', 2022, 'Branco', 2, 2),
(18, 'Sandero', 'Renault', 2020, 'Prata', 3, 3),
(19, 'Dolphin', 'BYD', 2025, 'Azul', 4, 4),
(20, 'Yaris', 'Toyota', 2024, 'Prata', 5, 5),
(21, 'Mustang', 'FordManual', 2024, 'Laranja', 1, 1),
(22, '208', 'Pegout', 2022, 'Branco', 2, 2),
(23, 'Sandero', 'Renault', 2020, 'Prata', 3, 3),
(24, 'Dolphin', 'BYD', 2025, 'Azul', 4, 4),
(25, 'Yaris', 'Toyota', 2024, 'Prata', 5, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `manutencao`
--

CREATE TABLE `manutencao` (
  `ManutencaoID` int(11) NOT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `CarroID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `manutencao`
--

INSERT INTO `manutencao` (`ManutencaoID`, `descricao`, `CarroID`) VALUES
(1, 'Troca de óleo e filtro', NULL),
(2, 'Alinhamento e balanceamento', NULL),
(3, 'Revisão do sistema de freios', NULL),
(4, 'Reparo na parte elétrica', NULL),
(5, 'Pintura do para-choque', NULL),
(6, 'Troca  Pastilhas', NULL),
(7, 'Alinhamento ', NULL),
(8, 'Limpeza de Ar ', NULL),
(9, 'Troca de Velas', NULL),
(10, 'Revisão ', NULL),
(11, 'Troca de Pastilhas', NULL),
(12, 'Alinhamento 3D', NULL),
(13, 'Limpeza de Ar Condicionado', NULL),
(14, 'Troca de Velas', NULL),
(15, 'Revisão Geral', NULL),
(16, 'Troca de Pastilhas', NULL),
(17, 'Alinhamento 3D', NULL),
(18, 'Limpeza de Ar Condicionado', NULL),
(19, 'Troca de Velas', NULL),
(20, 'Revisão Geral', NULL),
(21, 'Troca de Pastilhas', NULL),
(22, 'Alinhamento ', NULL),
(23, 'Limpeza de Ar Condicionado', NULL),
(24, 'Troca de Velas', NULL),
(25, 'Revisão Geral', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `proprietario`
--

CREATE TABLE `proprietario` (
  `ProprietarioID` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `proprietario`
--

INSERT INTO `proprietario` (`ProprietarioID`, `Nome`) VALUES
(1, 'João Silva'),
(2, 'Maria Oliveira'),
(3, 'Carlos Souza'),
(4, 'Ana Costa'),
(5, 'Pedro Santos'),
(6, 'Aline Ferreira'),
(7, 'Bruno Mendes'),
(8, 'Sandro Martins Costa'),
(9, 'Diego Lopes'),
(10, 'Elena Robson'),
(11, 'Aline Ferreira'),
(12, 'Bruno Mendes'),
(13, 'Camila Rocha'),
(14, 'Diego Lopes'),
(15, 'Elena Nuves'),
(16, 'Aline Ferreira'),
(17, 'Bruno Mendes'),
(18, 'Camila Rocha'),
(19, 'Diego Lopes'),
(20, 'Elena Nuves'),
(21, 'Sandro Martins da Costa'),
(22, 'Bruno hypolito'),
(23, 'Nicolas Hayashi Hara'),
(24, 'Diego Lopes'),
(25, 'Elena Pereira');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`CarroID`),
  ADD KEY `fk_carrro_manutencao` (`ManutencaoID`);

--
-- Índices de tabela `manutencao`
--
ALTER TABLE `manutencao`
  ADD PRIMARY KEY (`ManutencaoID`);

--
-- Índices de tabela `proprietario`
--
ALTER TABLE `proprietario`
  ADD PRIMARY KEY (`ProprietarioID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carro`
--
ALTER TABLE `carro`
  MODIFY `CarroID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `manutencao`
--
ALTER TABLE `manutencao`
  MODIFY `ManutencaoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `proprietario`
--
ALTER TABLE `proprietario`
  MODIFY `ProprietarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carro`
--
ALTER TABLE `carro`
  ADD CONSTRAINT `fk_carrro_manutencao` FOREIGN KEY (`ManutencaoID`) REFERENCES `manutencao` (`ManutencaoID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
