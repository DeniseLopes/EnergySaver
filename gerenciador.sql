-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Nov-2018 às 20:56
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

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
-- Estrutura da tabela `categoria_equipamento`
--

CREATE TABLE `categoria_equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria_equipamento`
--

INSERT INTO `categoria_equipamento` (`id`, `nome`) VALUES
(1, 'computador'),
(2, 'impressora'),
(3, 'geladeira'),
(4, 'transformador'),
(5, 'ar-condicionado'),
(6, 'tv'),
(7, 'radio');

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
-- Estrutura da tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL,
  `modelo` varchar(40) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `gerenciador_id` int(11) NOT NULL,
  `watts_potencia` decimal(10,2) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `descricao` text,
  `src_img` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`id`, `modelo`, `tipo`, `gerenciador_id`, `watts_potencia`, `status`, `descricao`, `src_img`) VALUES
(22, 'Positivo SC3', 1, 3, '11.00', 'desconectado', 'Micro tipo 2 desktop da sala 3 identificaÃ§Ã£o a017', '/assets/imgs/computador-icon.png'),
(23, 'Ricoh 3510DN', 2, 4, '10.00', 'desconectado', 'Impressora compartilhada na rede, localizada no corredor', '/assets/imgs/impressora-icon.png'),
(24, 'Brastemp', 3, 5, '16.00', 'desconectado', 'Geladeira da cozinha de casa', '/assets/imgs/geladeira-icon.png'),
(25, 'ETX500', 4, 6, '9.00', 'desconectado', 'Transformador de 110 para 220 ligado na maquina de lavar roupas.', '/assets/imgs/transformador-icon.png'),
(26, 'Splint inverter', 5, 7, '16.00', 'desconectado', 'Ar- condicionado da sala', '/assets/imgs/ar-condicionado-icon.png'),
(27, 'Semptoshipa SHD', 6, 8, '12.00', 'desconectado', 'Tv do quarto da DendÃª', '/assets/imgs/tv-icon.png'),
(28, 'Radio Relolgio ETX300', 7, 9, '13.00', 'desconectado', 'Radio do meu quarto', '/assets/imgs/radio-icon.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gerenciador`
--

CREATE TABLE `gerenciador` (
  `id` int(11) NOT NULL,
  `mac_address` varchar(20) DEFAULT NULL,
  `ip` varchar(16) DEFAULT NULL,
  `descricao` text,
  `usuario_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gerenciador`
--

INSERT INTO `gerenciador` (`id`, `mac_address`, `ip`, `descricao`, `usuario_id`, `status`) VALUES
(3, '11:11:11:11:11:11', '127.179.11.135', 'aadasda', 31, NULL),
(4, '1a:7b:c3:de:33:ed', '192.110.1.15', 'gerenciador da sala', 31, NULL),
(5, '14:5e:f6:d2:a1:aa', '192.168.11.23', 'Testando', 31, NULL),
(6, '1e:2f:3d:6f:5a:42', '192.168.11.110', 'gerenciador da sala', 31, NULL),
(7, '33:22:11:aa:cc:ff', '11.11.11.11', 'ADASDA', 31, NULL),
(8, '12:34:56:78:90:1a', '14.12.11.10', 'TelevisÃ£o do quarto', 31, NULL),
(9, 'aa:aa:aa:aa:aa:aa', '11.11.11.11', 'asdsada', 31, NULL);

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
  `login` varchar(40) DEFAULT NULL,
  `sobrenome` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `dt_nasc`, `dt_cadastro`, `cpf`, `email`, `senha`, `img_perfil`, `login`, `sobrenome`) VALUES
(1, 'Diego', NULL, '2018-10-15 18:38:18', NULL, 'diegommorais12@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '10_perfil.', NULL, NULL),
(3, 'Denise', NULL, '2018-10-15 19:09:15', NULL, 'denise@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '10_perfil.', NULL, NULL),
(4, 'Thiago', NULL, '2018-10-15 19:32:50', NULL, 'thiago@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '10_perfil.', NULL, NULL),
(5, 'Ana', NULL, '2018-10-15 20:08:46', NULL, 'ana@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '10_perfil.', NULL, NULL),
(6, 'as', NULL, '2018-10-15 21:05:05', NULL, 'a', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '10_perfil.', NULL, NULL),
(7, 'Diego Magno', NULL, '2018-10-15 22:00:28', NULL, 'ddd@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '10_perfil.', NULL, NULL),
(8, 'aaa', NULL, '2018-10-15 22:00:42', NULL, 'aaa@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '10_perfil.', NULL, NULL),
(9, 'Diego ', '1995-10-22', '2018-10-28 02:10:10', '442.690.098', 'diego013@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '../../uf/9/9_perfil.jpg', 'Magnomoasdas', 'Magno '),
(10, 'Lucas', NULL, '2018-10-28 02:16:53', NULL, 'lucas@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '10_perfil.', NULL, NULL),
(11, '  Diego ', '1995-10-22', '2018-10-28 17:28:45', '44269009802', 'magnomu@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '../../uf/11/11_perfil.jpg', 'Magnomo', 'Magno  '),
(12, 'Diego', '1987-07-11', '2018-10-29 16:43:28', '442.690.098', '  diego@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../../uf/12/12_perfil.jpg', 'Magnomo', 'Magno '),
(13, 'Diego', NULL, '2018-10-29 19:37:43', NULL, 'diego@magno.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13/13_perfil.jpg', NULL, NULL),
(17, 'Thiago', NULL, '2018-10-29 20:08:56', NULL, 'thiagomota@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../uf/17_perfil.jpg', NULL, NULL),
(18, 'Teste', NULL, '2018-10-29 20:31:28', NULL, 'teste@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../uf//18_perfil.jpg', NULL, NULL),
(20, 'Teste ', '1987-07-11', '2018-10-29 20:34:11', '244.654.971', 'teste13@teste.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../../uf/20/20_perfil.jpg', 'Koala', 'Tester '),
(21, ' Caio ', '2001-11-11', '2018-10-29 21:13:07', '44269009802', 'caio@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../../uf/21/21_perfil.jpg', 'Caiozito', 'Abreu'),
(22, ' Gamba ', '1995-10-22', '2018-10-29 21:35:48', '', 'gamba@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../../uf/22/22_perfil.jpg', 'Gambiarra', 'Fedorento'),
(23, 'Diego', NULL, '2018-10-30 18:02:38', NULL, 'diego13@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../../uf/23/23_perfil.jpg', NULL, 'Magno'),
(24, 'teste', NULL, '2018-10-30 18:05:22', NULL, 'tester@t.com', '111111', '../../uf/24/24_perfil.jpg', NULL, 'teste'),
(25, 'Douglas', NULL, '2018-10-30 18:12:44', NULL, 'douglas@uol.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../../uf/25/25_perfil.jpg', NULL, 'Santos'),
(26, 'Caio ', '2011-11-11', '2018-11-01 17:14:42', '281.056.688', 'caio@uol.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../../uf/26/26_perfil.jpg', 'Caiozito', 'Abreu '),
(27, 'teste', NULL, '2018-11-01 17:16:46', NULL, 'teste@teste.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../../uf/27/27_perfil.jpg', NULL, 'teste2'),
(28, 'ABC', NULL, '2018-11-01 17:32:53', NULL, 'GHI', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../../uf/28/28_perfil.jpg', NULL, 'DEF'),
(29, 'André', NULL, '2018-11-01 17:41:38', NULL, 'andre@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../../uf/29/29_perfil.jpg', NULL, 'Azevedo'),
(30, 'Thiago', NULL, '2018-11-01 21:50:57', NULL, 'toledo@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '../../uf/30/30_perfil.jpg', NULL, 'Toledo'),
(31, 'Tester', '0000-00-00', '2018-11-05 16:00:29', '', '      magno@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', '../../uf/31/31_perfil.jpg', 'Testador', 'Tester '),
(32, 'John', '1995-10-22', '2018-11-08 15:37:44', '281.056.688', ' john@doe.com', '601f1889667efaebb33b8c12572835da3f027f78', '../../uf/32/32_perfil.jpg', 'John Doe', 'John ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria_equipamento`
--
ALTER TABLE `categoria_equipamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumo`
--
ALTER TABLE `consumo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cosumo` (`equipamento_id`);

--
-- Indexes for table `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo` (`tipo`),
  ADD KEY `fk_dispositivo` (`gerenciador_id`);

--
-- Indexes for table `gerenciador`
--
ALTER TABLE `gerenciador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`usuario_id`);

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
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `gerenciador`
--
ALTER TABLE `gerenciador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `relatorio`
--
ALTER TABLE `relatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `consumo`
--
ALTER TABLE `consumo`
  ADD CONSTRAINT `fk_cosumo` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamento` (`id`);

--
-- Limitadores para a tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD CONSTRAINT `fk_dispositivo` FOREIGN KEY (`gerenciador_id`) REFERENCES `gerenciador` (`id`),
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`tipo`) REFERENCES `categoria_equipamento` (`id`);

--
-- Limitadores para a tabela `gerenciador`
--
ALTER TABLE `gerenciador`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

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
