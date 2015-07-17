-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2015 at 06:22 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `teste_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `mailing` tinyint(1) DEFAULT NULL,
  `senha` varchar(100) NOT NULL,
  `ativo` int(11) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `data_ativacao` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `celular`, `mailing`, `senha`, `ativo`, `data_cadastro`, `data_ativacao`) VALUES
(26, 'Mark Gerald Martins', 'mark.g.martins@gmail.com', '11994579418', NULL, '8f0e9a3c719c75f7f84ee92dab6a758c', 1, '2015-07-17 16:42:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
