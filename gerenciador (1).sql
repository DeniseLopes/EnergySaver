-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Out-2018 às 23:07
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gerenciador`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consumo`
--

CREATE TABLE `consumo` (
  `id` int(11) NOT NULL,
  `watts_segundo` decimal(10,2) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `equipamento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dispositivo`
--

CREATE TABLE `dispositivo` (
  `id` int(11) NOT NULL,
  `mac_address` varchar(20) DEFAULT NULL,
  `ip` varchar(16) DEFAULT NULL,
  `descricao` text,
  `usuario_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `dispositivo_id` int(11) NOT NULL,
  `watts_potencia` decimal(10,2) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio`
--

CREATE TABLE `relatorio` (
  `id` int(11) NOT NULL,
  `total_watts` decimal(10,2) NOT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio_consumo`
--

CREATE TABLE `relatorio_consumo` (
  `relatorio_id` int(11) NOT NULL,
  `consumo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_equipamento`
--

CREATE TABLE `tipo_equipamento` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_equipamento`
--

INSERT INTO `tipo_equipamento` (`id`, `categoria`) VALUES
(1, 'computador'),
(2, 'impressora'),
(3, 'geladeira'),
(4, 'transformador'),
(5, 'ar-condicionado'),
(6, 'televisao'),
(7, 'radio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `dt_nasc` date DEFAULT NULL,
  `dt_cadastro` datetime DEFAULT NULL,
  `cpf` char(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `img_perfil` varchar(60) DEFAULT NULL,
  `login` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `dt_nasc`, `dt_cadastro`, `cpf`, `email`, `senha`, `img_perfil`, `login`) VALUES
(1, 'Diego', NULL, '2018-10-15 18:38:18', NULL, 'diegommorais12@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '10_perfil.', NULL),
(3, 'Denise', NULL, '2018-10-15 19:09:15', NULL, 'denise@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '10_perfil.', NULL),
(4, 'Thiago', NULL, '2018-10-15 19:32:50', NULL, 'thiago@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '10_perfil.', NULL),
(5, 'Ana', NULL, '2018-10-15 20:08:46', NULL, 'ana@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '10_perfil.', NULL),
(6, 'as', NULL, '2018-10-15 21:05:05', NULL, 'a', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '10_perfil.', NULL),
(7, 'Diego Magno', NULL, '2018-10-15 22:00:28', NULL, 'ddd@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '10_perfil.', NULL),
(8, 'aaa', NULL, '2018-10-15 22:00:42', NULL, 'aaa@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '10_perfil.', NULL),
(9, 'Diego Magno', '0000-00-00', '2018-10-28 02:10:10', '44269009802', 'diegommorais@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '../../uf/9/9_perfil.jpg', 'Magnomo'),
(10, 'Lucas', NULL, '2018-10-28 02:16:53', NULL, 'lucas@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '10_perfil.', NULL),
(11, 'Diego Magno', '1995-10-22', '2018-10-28 17:28:45', '44269009802', 'magnomu@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '../../uf/11/11_perfil.jpg', 'Magnomo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consumo`
--
ALTER TABLE `consumo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cosumo` (`equipamento_id`);

--
-- Indexes for table `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`usuario_id`);

--
-- Indexes for table `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo` (`tipo`),
  ADD KEY `fk_dispositivo` (`dispositivo_id`);

--
-- Indexes for table `relatorio`
--
ALTER TABLE `relatorio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relatorio_consumo`
--
ALTER TABLE `relatorio_consumo`
  ADD PRIMARY KEY (`relatorio_id`,`consumo_id`),
  ADD KEY `fk_consumo` (`consumo_id`);

--
-- Indexes for table `tipo_equipamento`
--
ALTER TABLE `tipo_equipamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consumo`
--
ALTER TABLE `consumo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dispositivo`
--
ALTER TABLE `dispositivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relatorio`
--
ALTER TABLE `relatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `consumo`
--
ALTER TABLE `consumo`
  ADD CONSTRAINT `fk_cosumo` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamento` (`id`);

--
-- Limitadores para a tabela `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD CONSTRAINT `fk_dispositivo` FOREIGN KEY (`dispositivo_id`) REFERENCES `dispositivo` (`id`),
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo_equipamento` (`id`);

--
-- Limitadores para a tabela `relatorio_consumo`
--
ALTER TABLE `relatorio_consumo`
  ADD CONSTRAINT `fk_consumo` FOREIGN KEY (`consumo_id`) REFERENCES `consumo` (`id`),
  ADD CONSTRAINT `fk_relatorio` FOREIGN KEY (`relatorio_id`) REFERENCES `relatorio` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
