-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 10.1.2.123:3306
-- Generation Time: 09-Fev-2019 às 21:33
-- Versão do servidor: 10.2.16-MariaDB
-- versão do PHP: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u295717340_bingo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bingo`
--

CREATE TABLE `bingo` (
  `id` int(50) NOT NULL,
  `nome` text CHARACTER SET utf8 NOT NULL,
  `online` int(1) NOT NULL,
  `cartela` longtext CHARACTER SET utf8 NOT NULL,
  `pedrasConfirm` text COLLATE utf8_unicode_ci NOT NULL,
  `pronto` int(1) NOT NULL,
  `sala` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos`
--

CREATE TABLE `jogos` (
  `id` int(50) NOT NULL,
  `titulo` text CHARACTER SET utf8 NOT NULL,
  `pedras` longtext COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `linha` text COLLATE utf8_unicode_ci NOT NULL,
  `cheia` text COLLATE utf8_unicode_ci NOT NULL,
  `andamento` int(1) NOT NULL,
  `pause` int(1) NOT NULL,
  `adm` text COLLATE utf8_unicode_ci NOT NULL,
  `protegido` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `jogos`
--

INSERT INTO `jogos` (`id`, `titulo`, `pedras`, `data`, `linha`, `cheia`, `andamento`, `pause`, `adm`, `protegido`) VALUES
(15, 'SALA 1 (0/10)', '', '', '', '', 0, 1, '', 0),
(26, 'SALA 2 (0/10)', '', '', '', '', 0, 1, '', 0),
(27, 'SALA 3 (0/20)', '', '', '', '', 0, 1, '', 0),
(28, 'SALA 4 (0/20)', '', '', '', '', 0, 1, '', 0),
(29, 'FAMILIA SANTOS', '', '', '', '', 0, 1, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bingo`
--
ALTER TABLE `bingo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bingo`
--
ALTER TABLE `bingo`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `jogos`
--
ALTER TABLE `jogos`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
