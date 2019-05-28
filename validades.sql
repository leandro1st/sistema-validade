-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Maio-2019 às 17:16
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
('Pocky', '2019-05-31', '2019-04-30 11:54:14', 4),
('LÃ¡men MÃ´nica', '2019-05-24', '2019-04-30 11:54:33', 5),
('Look Chocolate', '2019-05-24', '2019-04-30 12:02:15', 15),
('FeijÃ£o Kicaldo', '2019-05-29', '2019-04-30 12:06:48', 23),
('Tonkatsu', '2019-05-28', '2019-04-30 12:06:55', 24),
('LÃ¡men Sapporo Shoyu', '2019-05-28', '2019-04-30 12:07:05', 25),
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
('Azuma Mirin 500ml', '2020-04-05', '2019-05-07 14:27:08', 55),
('Sembei Sankio', '2019-09-15', '2019-05-07 16:23:21', 56),
('Saque Azuma 500ml', '2020-03-13', '2019-05-07 16:23:35', 57),
('Canjica de Milho Doce 50g', '2019-10-08', '2019-05-14 12:09:00', 58),
('Glico Tomate', '2019-08-10', '2019-05-14 12:09:51', 59),
('Canjica de Milho Salgada 50g', '2019-10-06', '2019-05-14 12:10:01', 60),
('Ebicen Cebola 60g', '2019-10-05', '2019-05-14 12:10:48', 61),
('Rosquinha Coco Satsumaya 150g', '2019-11-03', '2019-05-14 12:11:03', 62),
('Sweet Jelly Morango 200g', '2020-04-12', '2019-05-14 12:11:38', 63),
('Okaki Apimentado 100g', '2019-09-20', '2019-05-14 12:12:00', 64),
('Dashinomoto 200g', '2020-02-04', '2019-05-14 12:12:24', 65),
('Dashinomoto 200g', '2020-04-02', '2019-05-14 12:12:29', 66),
('Ebicen CamarÃ£o 60g', '2019-10-05', '2019-05-14 12:12:54', 67),
('Shiitake Slice Fujiyama 50g', '2020-07-20', '2019-05-14 12:13:23', 68),
('Sembei Satsumaya Leite 280g', '2019-11-29', '2019-05-14 12:14:17', 69),
('Mupy Morango', '2019-11-26', '2019-05-14 12:14:39', 70),
('Mupy Uva', '2019-11-30', '2019-05-14 12:14:47', 71),
('Sembei Kyakuni Gergelim', '2019-07-26', '2019-05-17 14:54:26', 72),
('Sembei Kyakuni Gergelim Chato', '2019-08-01', '2019-05-17 14:54:54', 73),
('Yakissoba Alfa 500g', '2020-05-15', '2019-05-17 14:56:34', 74),
('ChÃ¡ Verde Yamamotoyama 200g', '2020-02-24', '2019-05-17 14:58:10', 75),
('Sweet Jelly Original 60g', '2020-03-20', '2019-05-17 14:58:46', 76),
('Sweet Jelly Original 60g', '2020-04-10', '2019-05-17 14:58:52', 77),
('Ã“leo de Gergelim Hong Kong 100ml', '2022-03-07', '2019-05-17 14:59:18', 78),
('Tempurako WoomTree 500g', '2021-01-14', '2019-05-17 14:59:55', 79),
('Tempurako WoomTree 500g', '2021-02-11', '2019-05-17 15:00:01', 80),
('Panko WoomTree 200g', '2021-02-11', '2019-05-17 15:00:34', 81),
('Karinto Yoko', '2019-10-10', '2019-05-17 15:00:51', 82),
('Kare Bom Curry', '2020-04-01', '2019-05-17 15:03:11', 83),
('Panko Alfa 200g', '2020-04-15', '2019-05-17 15:03:37', 84),
('Cookies Misto Ichiban', '2019-08-21', '2019-05-17 15:04:09', 85),
('Sembei Sankio', '2019-09-29', '2019-05-17 15:04:26', 86),
('Okoshi Hikage 100g', '2019-11-08', '2019-05-17 15:05:05', 87),
('Biscoito da Sorte', '2019-07-11', '2019-05-17 15:06:09', 88),
('Biscoito da Sorte', '2019-07-24', '2019-05-17 15:06:19', 89),
('Yokomizo Coco', '2019-06-25', '2019-05-17 15:06:38', 90),
('Yokomizo Leite', '2019-06-17', '2019-05-17 15:06:50', 91),
('Sembei Want Want Nori', '2019-12-26', '2019-05-21 11:13:48', 92),
('Gergelim Branco Torrado 100g', '2020-04-15', '2019-05-21 11:14:27', 93),
('Gergelim Preto Torrado 100g', '2020-04-01', '2019-05-21 11:14:44', 94),
('Molho Tare Sakura', '2020-03-31', '2019-05-21 11:15:59', 95),
('Kombu Fujiyama', '2020-02-05', '2019-05-21 11:16:28', 96),
('Okaki Bimi Original', '2019-11-06', '2019-05-21 11:22:36', 97),
('Okaki Bimi Amendoim', '2019-11-06', '2019-05-21 11:23:14', 98),
('Rosquinha Amendoim Satsumaya 250g', '2019-10-05', '2019-05-21 11:27:01', 99),
('Furikake Nori Sake 30g', '2020-12-13', '2019-05-21 11:27:33', 100),
('Furikake Nori Tamago 33g', '2020-12-13', '2019-05-21 11:27:46', 101),
('Furikake Katsuomirin 30g', '2020-09-12', '2019-05-21 11:28:00', 102),
('Missoshiru Wakame 12p', '2019-08-03', '2019-05-21 11:29:26', 103),
('Sembei Kyakuni Gergelim', '2019-08-09', '2019-05-21 11:29:41', 104),
('Mandiopan Cores', '2020-05-02', '2019-05-21 11:30:20', 105),
('Misso Shiro Sakura 500g', '2020-01-29', '2019-05-21 11:31:08', 106),
('Kare Golden MÃ©dio 220g', '2020-06-25', '2019-05-21 11:31:33', 107),
('Kare Golden MÃ©dio 92g', '2020-07-29', '2019-05-21 11:31:53', 108),
('Kare Golden Forte 220g', '2020-08-06', '2019-05-21 11:32:45', 109),
('Sembei Kyakuni Gengibre', '2019-08-29', '2019-05-28 12:01:37', 110),
('Amendoim King 150g', '2019-09-22', '2019-05-28 12:01:59', 111),
('Dashinomoto 200g', '2020-04-02', '2019-05-28 12:02:15', 112),
('Sembei Shirayuki 120g', '2019-11-10', '2019-05-28 12:02:49', 113),
('Sembei Satsumaya Amendoim 280g', '2019-12-07', '2019-05-28 12:03:10', 114),
('Milk no Kuni', '2019-11-13', '2019-05-28 12:03:26', 115),
('Super Lemon', '2019-10-31', '2019-05-28 12:03:43', 116),
('Bala de Lichia', '2019-11-20', '2019-05-28 12:03:56', 117),
('Wasabi Neri S&B', '2020-05-14', '2019-05-28 12:04:38', 118),
('Kare Golden Fraco 220g', '2020-08-19', '2019-05-28 12:05:53', 119),
('Sembei Paulista 90g', '2019-11-17', '2019-05-28 12:06:18', 120),
('Sequilho Paulista 200g', '2019-11-10', '2019-05-28 12:07:21', 121),
('Sweet Jelly Original 200g', '2020-05-15', '2019-05-28 12:07:46', 122),
('Ebicen CamarÃ£o 60g', '2019-10-15', '2019-05-28 12:08:15', 123),
('Wasabi Globo', '2019-12-20', '2019-05-28 12:08:37', 124),
('Umeboshi Casa Forte 230g', '2020-05-16', '2019-05-28 12:09:06', 125),
('Ã“leo de Gergelim Natural Hong Kong 100ml', '2022-05-02', '2019-05-28 12:09:44', 126),
('Molho Yakisoba Alfa 500ml', '2020-05-13', '2019-05-28 12:10:10', 127),
('Udon Alfa 500g', '2020-05-13', '2019-05-28 12:10:42', 128),
('Harussame', '2022-01-10', '2019-05-28 12:11:22', 129),
('Panko Alfa 1kg', '2020-05-23', '2019-05-28 12:16:27', 130);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
