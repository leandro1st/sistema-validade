-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07-Maio-2019 às 21:00
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
('Pocky', '2019-05-31', '2019-04-30 11:54:14', 4),
('LÃ¡men MÃ´nica', '2019-05-24', '2019-04-30 11:54:33', 5),
('Misso Shiro Sakura', '2019-05-14', '2019-04-30 11:54:53', 6),
('Duchen Maria', '2019-05-13', '2019-04-30 11:57:43', 8),
('Mini Cookies AmÃªndoas/Castanha', '2019-05-20', '2019-04-30 11:59:33', 10),
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
('PaÃ§oquita Diet', '2019-05-25', '2019-04-30 12:09:25', 30),
('Rosquinha Amendoim Satsumaya 250g', '2019-10-05', '2019-05-03 16:04:49', 32),
('Glico Frango', '2019-08-10', '2019-05-03 16:05:06', 33),
('Ãgar Ãgar 10g', '2020-04-02', '2019-05-03 16:05:32', 34),
('Rice Stick (macarrÃ£o arroz)', '2020-08-24', '2019-05-03 16:05:59', 35),
('Okoshi Hikage 200g', '2019-10-10', '2019-05-03 16:06:18', 36),
('Wasabi Taichi 1kg', '2020-07-02', '2019-05-03 16:07:00', 37),
('Hidiki 35g', '2020-12-31', '2019-05-03 16:07:26', 38),
('Extrato de soja 300g', '2020-04-01', '2019-05-03 16:08:00', 39),
('Iriko nÂº 0 50g', '2020-02-21', '2019-05-03 16:08:19', 40),
('Iriko nÂº 2 100g', '2020-04-25', '2019-05-03 16:08:42', 41),
('Karinto Yoko', '2019-10-10', '2019-05-03 16:08:51', 42),
('Rosquinha Amendoim Satsumaya 150g', '2019-11-22', '2019-05-07 14:19:37', 43),
('Sembei Paulista 90g', '2019-10-26', '2019-05-07 14:20:12', 44),
('Yakissoba Alfa 500g', '2020-05-01', '2019-05-07 14:20:38', 45),
('Yakissoba Hirotani 500g', '2020-04-30', '2019-05-07 14:21:13', 46),
('Amendoim King 400g', '2019-08-27', '2019-05-07 14:21:35', 47),
('Molho de Ostra 255g', '2021-12-11', '2019-05-07 14:22:09', 48),
('Ã“leo de Gergelim Hong Kong 500ml', '2022-03-13', '2019-05-07 14:22:57', 49),
('Gergelim Preto Torrado 100g', '2020-03-15', '2019-05-07 14:23:15', 50),
('Soboro 2g', '2020-08-16', '2019-05-07 14:23:47', 51),
('Soboro 2g', '2020-12-10', '2019-05-07 14:23:55', 52),
('Karinto Yoko', '2019-10-10', '2019-05-07 14:24:13', 53),
('Amendoim King 150g', '2019-08-25', '2019-05-07 14:26:35', 54),
('Azuma Mirin 500ml', '2020-04-05', '2019-05-07 14:27:08', 55);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
