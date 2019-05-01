-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Maio-2019 às 20:49
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `validades`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `nome_produto` varchar(300) NOT NULL,
  `validade` date NOT NULL,
  `hora_cadastro` datetime NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`nome_produto`, `validade`, `hora_cadastro`, `id`) VALUES
('Somen AssaÃ­', '2019-05-17', '2019-04-30 11:53:19', 1),
('Yokomizo Leite', '2019-05-07', '2019-04-30 11:53:36', 2),
('Pocky', '2019-05-31', '2019-04-30 11:54:14', 4),
('LÃ¡men MÃ´nica', '2019-05-24', '2019-04-30 11:54:33', 5),
('Misso Shiro Sakura', '2019-05-14', '2019-04-30 11:54:53', 6),
('Duchen Maria', '2019-05-13', '2019-04-30 11:57:43', 8),
('Mini Cookies AmÃªndoas/Castanha', '2019-05-20', '2019-04-30 11:59:33', 10),
('Mini Cookies Castanha do ParÃ¡ e Caju', '2019-05-03', '2019-04-30 12:01:14', 11),
('Salcique', '2019-05-15', '2019-04-30 12:01:25', 12),
('Cookies Misto', '2019-05-20', '2019-04-30 12:01:36', 13),
('Chips Mexicana', '2019-05-18', '2019-04-30 12:01:44', 14),
('Look Chocolate', '2019-05-24', '2019-04-30 12:02:15', 15),
('Polvilho Cebola', '2019-05-19', '2019-04-30 12:02:30', 16),
('Polvilho Queijo', '2019-05-19', '2019-04-30 12:03:08', 18),
('Sembei Kyakuni Choga', '2019-05-09', '2019-04-30 12:03:38', 19),
('Sembei Kyakuni Gergelim', '2019-05-09', '2019-04-30 12:06:23', 20),
('Suspiro', '2019-05-10', '2019-04-30 12:06:30', 21),
('FeijÃ£o Kicaldo', '2019-05-29', '2019-04-30 12:06:48', 23),
('Tonkatsu', '2019-05-28', '2019-04-30 12:06:55', 24),
('LÃ¡men Sapporo Shoyu', '2019-05-28', '2019-04-30 12:07:05', 25),
('LÃ¡men Sapporo Shoyu', '2019-05-19', '2019-04-30 12:08:41', 27),
('Hersheys', '2019-05-30', '2019-04-30 12:09:15', 29),
('PaÃ§oquita Diet', '2019-05-25', '2019-04-30 12:09:25', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
