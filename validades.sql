-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19-Jun-2019 às 00:24
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
-- Estrutura da tabela `excluidos`
--

CREATE TABLE `excluidos` (
  `nome_produto` varchar(300) NOT NULL,
  `validade` date NOT NULL,
  `hora_cadastro` datetime NOT NULL,
  `hora_exclusao` datetime NOT NULL,
  `id` int(11) NOT NULL,
  `id_exclusao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `excluidos`
--

INSERT INTO `excluidos` (`nome_produto`, `validade`, `hora_cadastro`, `hora_exclusao`, `id`, `id_exclusao`) VALUES
('Biscoito Hits Salgado Original 40g', '2019-06-13', '2019-06-12 19:04:22', '2019-06-14 13:17:39', 242, 1),
('Lamen Misso Sapporo 84g', '2019-06-16', '2019-06-12 19:05:09', '2019-06-17 10:22:48', 244, 2),
('Farinha LinhaÃ§a Moida Casa Forte 150g', '2019-06-17', '2019-06-12 19:07:02', '2019-06-17 19:47:04', 249, 3),
('Look Morango 55g', '2019-06-17', '2019-06-12 13:02:47', '2019-06-17 19:47:06', 197, 4),
('Suco de MaÃ§Ã£ Yakult 200ml', '2019-06-17', '2019-06-12 12:55:19', '2019-06-17 19:47:07', 195, 5),
('Yokomizo Leite', '2019-06-17', '2019-05-17 15:06:50', '2019-06-17 19:47:10', 91, 6),
('PÃ£o Rei do Trigo Mandioquinha 400G', '2019-06-18', '2019-06-17 19:41:34', '2019-06-18 19:16:50', 286, 7),
('Suco de Uva Maguary 900ml', '2019-06-18', '2019-06-12 12:52:55', '2019-06-18 19:16:53', 190, 8);

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
('Kare Bom Curry', '2020-04-01', '2019-05-17 15:03:11', 83),
('Panko Alfa 200g', '2020-04-15', '2019-05-17 15:03:37', 84),
('Cookies Misto Ichiban', '2019-08-21', '2019-05-17 15:04:09', 85),
('Sembei Sankio', '2019-09-29', '2019-05-17 15:04:26', 86),
('Okoshi Hikage 100g', '2019-11-08', '2019-05-17 15:05:05', 87),
('Biscoito da Sorte', '2019-07-11', '2019-05-17 15:06:09', 88),
('Biscoito da Sorte', '2019-07-24', '2019-05-17 15:06:19', 89),
('Yokomizo Coco', '2019-06-25', '2019-05-17 15:06:38', 90),
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
('Panko Alfa 1kg', '2020-05-23', '2019-05-28 12:16:27', 130),
('Okaki Gergelim 200g', '2019-11-22', '2019-06-04 11:16:04', 132),
('Ebicen Cebola 60g', '2019-10-25', '2019-06-04 11:24:01', 133),
('Sembei Kyakuni Gergelim', '2019-09-03', '2019-06-04 11:24:16', 134),
('Glico Tomate', '2019-09-25', '2019-06-04 11:24:38', 135),
('Ebicen CamarÃ£o 60g', '2019-10-30', '2019-06-04 11:25:07', 136),
('Choga Gari Pote Takaki', '2019-11-17', '2019-06-04 11:25:44', 137),
('Choga Gari Pote Takaki', '2019-11-20', '2019-06-04 11:25:49', 138),
('Okoshi Integral 200g', '2019-11-08', '2019-06-04 11:26:36', 139),
('Karinto Yoko', '2019-11-30', '2019-06-04 11:26:54', 140),
('Okaki Apimentado 100g', '2019-10-10', '2019-06-04 11:27:08', 141),
('Gergelim Preto Torrado 100g', '2020-04-15', '2019-06-04 11:30:29', 142),
('Dashinomoto 500g', '2020-05-02', '2019-06-04 11:33:28', 143),
('Sembei Satsumaya Gergelim 280g', '2019-12-13', '2019-06-04 11:35:02', 144),
('Gergelim Branco Torrado 100g', '2020-05-02', '2019-06-04 11:37:33', 145),
('Okaki Nori 100g', '2019-10-08', '2019-06-04 11:39:14', 146),
('Okaki Nori 100g', '2019-09-21', '2019-06-04 11:40:48', 147),
('Rosquinha Coco Satsumaya 150g', '2020-01-08', '2019-06-04 11:43:28', 148),
('Cookies Misto Ichiban', '2019-09-20', '2019-06-04 11:44:15', 149),
('Sembei Paulista 90g', '2019-11-10', '2019-06-07 11:59:11', 150),
('Sembei Sankio', '2019-10-08', '2019-06-07 12:00:01', 151),
('Furikake Nori Tamago 33g', '2021-03-30', '2019-06-07 12:07:13', 152),
('Furikake Kenko Yasai 30g', '2021-03-30', '2019-06-07 12:07:55', 153),
('Shoyu MacrobiÃ³tico Daimaru', '2020-05-20', '2019-06-07 12:10:05', 154),
('Umeboshi Casa Forte 500g', '2020-04-15', '2019-06-07 12:10:31', 155),
('Yakissoba Hirotani 500g', '2020-05-30', '2019-06-07 12:11:24', 156),
('Udon Alfa 500g', '2020-05-27', '2019-06-07 12:12:27', 157),
('Somen Alfa 500g', '2020-04-29', '2019-06-07 12:13:13', 158),
('Yakissoba Alfa 500g', '2020-05-28', '2019-06-07 12:13:23', 159),
('Udon Assai 500g', '2020-01-17', '2019-06-07 12:13:51', 160),
('Iriko nÂº 0 50g', '2020-02-22', '2019-06-07 12:16:24', 161),
('Iriko Misto 50g', '2020-03-10', '2019-06-07 12:16:44', 162),
('Iriko Misto 50g', '2020-03-07', '2019-06-07 12:16:50', 163),
('Moti Gome Jipovura', '2020-05-31', '2019-06-07 12:17:44', 164),
('Gelatina Sortida com Coco', '2019-12-15', '2019-06-07 12:18:46', 165),
('Kare Ãndia', '2020-11-30', '2019-06-07 12:22:30', 166),
('Yokan', '2020-01-14', '2019-06-07 12:23:00', 167),
('Ãgar Ãgar 10g', '2020-05-02', '2019-06-11 10:37:45', 168),
('Semente de Chia 200g', '2020-05-02', '2019-06-11 10:38:35', 169),
('Gergelim Preto Cru 100g', '2020-05-16', '2019-06-11 10:39:00', 170),
('Shiitake Seco Takaki 40g', '2020-02-19', '2019-06-11 10:40:17', 171),
('Shiitake Seco Takaki 100g', '2020-02-19', '2019-06-11 10:40:35', 172),
('Okaki Gergelim 200g', '2019-11-08', '2019-06-11 10:56:25', 173),
('Udon Mezzani 500g', '2020-05-05', '2019-06-11 10:57:02', 174),
('Ãgar Ãgar 100g', '2020-02-04', '2019-06-11 10:57:35', 175),
('Missoshiru Wakame 12p', '2019-10-12', '2019-06-11 10:58:34', 176),
('Amendoim King 400g', '2019-09-03', '2019-06-11 10:58:53', 177),
('Dashinomoto 200g', '2020-05-02', '2019-06-11 10:59:32', 178),
('Kimuchi no Moto', '2020-07-17', '2019-06-11 10:59:47', 179),
('Sembei Kyakuni Gergelim Chato', '2019-09-09', '2019-06-11 11:00:17', 180),
('Sembei Want Want Shelly', '2020-01-04', '2019-06-11 11:55:27', 181),
('Torrada de Arroz Integral Chia/Gergelim', '2020-01-29', '2019-06-11 11:55:48', 182),
('Torrada de Arroz Integral Quinoa/LinhaÃ§a', '2020-01-29', '2019-06-11 11:56:01', 183),
('Yokomizo Coco', '2019-07-24', '2019-06-11 11:56:09', 184),
('Rosquinha Gergelim Satsumaya 150g', '2019-12-09', '2019-06-11 11:56:38', 185),
('Rosquinha Gergelim Satsumaya 150g', '2019-12-11', '2019-06-11 11:58:09', 186),
('Okoshi Hikage 100g', '2019-11-27', '2019-06-11 11:59:37', 187),
('Okoshi Hikage 200g', '2019-11-29', '2019-06-11 11:59:42', 188),
('Sembei Satsumaya Gergelim 280g', '2019-12-26', '2019-06-11 11:59:53', 189),
('Cream Cheese Ipanema 150g', '2019-08-09', '2019-06-12 12:53:09', 191),
('Nectar Maguary Pessego 200ml', '2019-07-06', '2019-06-12 12:53:26', 192),
('Nectar Maguary Uva 200ml', '2019-06-23', '2019-06-12 12:53:37', 193),
('Nectar Maguary MaÃ§Ã£ 1l', '2019-08-12', '2019-06-12 12:53:51', 194),
('Suco de MaÃ§Ã£ Yakult 200ml', '2019-07-28', '2019-06-12 12:55:27', 196),
('Look Chocolate 55g', '2019-07-30', '2019-06-12 13:04:09', 198),
('Ebicen Cebola 60g', '2019-06-20', '2019-06-12 13:09:15', 199),
('Glico Queijo 80g', '2019-07-25', '2019-06-12 13:11:58', 200),
('Glico Frango 80g', '2019-07-20', '2019-06-12 13:13:36', 201),
('Custard C/06 138g', '2019-06-21', '2019-06-12 17:41:47', 202),
('Talento Meio Diet AvelÃ£s 25g', '2019-07-10', '2019-06-12 18:44:47', 203),
('PÃ£o De Forma Integral 400g', '2019-07-25', '2019-06-12 18:46:17', 204),
('Ervilha Com Wasabi 100g', '2019-08-01', '2019-06-12 18:46:35', 205),
('Recheadinho Goiabinha Bauducco 112g', '2019-06-21', '2019-06-12 18:46:56', 206),
('Udon Assai 500gr', '2019-07-22', '2019-06-12 18:47:18', 207),
('Torrada Integral Bauducco 160g', '2019-06-26', '2019-06-12 18:48:03', 208),
('Missoshiru Wakame 12p', '2019-07-27', '2019-06-12 18:49:41', 209),
('Aonori Powder Yamahide 15g', '2019-06-22', '2019-06-12 18:50:08', 210),
('Otsumami C/ Iriko 200g', '2019-08-01', '2019-06-12 18:51:18', 211),
('Molho Tonkatsu Maruiti 500ml', '2019-07-17', '2019-06-12 18:51:40', 212),
('Batata Frita Ondulada Ebicen 50g', '2019-07-20', '2019-06-12 18:51:53', 213),
('Panda Kids Leite Morango S/ Glu/ Lact 100g', '2019-07-31', '2019-06-12 18:52:29', 214),
('Palito Ao Leite 160g', '2019-08-04', '2019-06-12 18:52:50', 215),
('Look Morango 55g', '2019-08-04', '2019-06-12 18:53:06', 216),
('Panda Kids Doce De Leite S/ Glu/ Lact 100g', '2019-07-31', '2019-06-12 18:53:23', 217),
('Amendoim Doce Pote Castella 170g', '2019-07-24', '2019-06-12 18:53:39', 218),
('Lamen Instantaneo Kimchi 120g', '2019-07-18', '2019-06-12 18:54:00', 219),
('Bala Gengibre, Mel E PrÃ³polis 55g', '2019-07-21', '2019-06-12 18:54:50', 220),
('Refresco Fit Light Uva 8g', '2019-06-19', '2019-06-12 18:55:46', 221),
('Recheadinho Chocolate Bauducco 104g', '2019-07-14', '2019-06-12 18:56:07', 222),
('Lamem Tonkotsu Shoyu 83g', '2019-07-05', '2019-06-12 18:56:25', 223),
('Talento Meio Amargo AmÃªndoas 25g', '2019-07-28', '2019-06-12 18:56:43', 224),
('Coffee Beans Zero Cappuccino 10g', '2019-06-30', '2019-06-12 18:57:21', 225),
('Farinha de MaracujÃ¡ Casa Forte 200g', '2019-08-01', '2019-06-12 18:57:48', 226),
('Pipoca Doce De Milho Clac 170g', '2019-08-09', '2019-06-12 18:58:19', 227),
('Bananinha Santa Branca 35g', '2019-08-07', '2019-06-12 18:58:32', 228),
('Farinha de Trigo 1 Kg', '2019-07-13', '2019-06-12 18:59:10', 229),
('Refresco Fit Light Laranja 10g', '2019-06-19', '2019-06-12 18:59:25', 230),
('Bala Jap. Flor Kiss', '2019-07-31', '2019-06-12 19:00:18', 231),
('Okoshi Integral Hikage 200g', '2019-07-21', '2019-06-12 19:00:43', 232),
('Queijo ParmesÃ£o Ralado Italac 50g', '2019-08-01', '2019-06-12 19:01:18', 233),
('Chips Mexicana Original', '2019-07-21', '2019-06-12 19:01:36', 234),
('Amendoim Doce Pote Castella 170g', '2019-07-17', '2019-06-12 19:01:52', 235),
('Sembei Kyakuni Gengibre 200g', '2019-06-21', '2019-06-12 19:02:17', 236),
('Bacon Listrado Salcique 65g', '2019-07-21', '2019-06-12 19:02:30', 237),
('Duo Duplo Chocolate 34g', '2019-06-23', '2019-06-12 19:02:50', 238),
('Bisc.dÃ¡gua Na Boca BambolÃª 160g', '2019-07-30', '2019-06-12 19:03:22', 239),
('Trakinas Chocolate', '2019-08-03', '2019-06-12 19:03:42', 240),
('Trakinas Morango', '2019-07-08', '2019-06-12 19:03:53', 241),
('Refr Suco Pessego C/pdÃ§s 240ml', '2019-07-14', '2019-06-12 19:04:46', 243),
('Roll Cake Choc.baud.34g', '2019-06-26', '2019-06-12 19:05:29', 245),
('Shoyu Sakura Tradicional 1l', '2019-06-30', '2019-06-12 19:06:10', 246),
('Pipoca Doce De Milho Clac 50g', '2019-07-08', '2019-06-12 19:06:19', 247),
('Batata Frita Ondulada Ebicen 50g', '2019-06-30', '2019-06-12 19:06:27', 248),
('Dashinomoto 500g', '2019-08-02', '2019-06-12 19:07:21', 250),
('Ãgar Ãgar 500mg 60 Caps', '2019-08-07', '2019-06-12 19:08:14', 251),
('Udon Japones Nagatanien 400g', '2020-04-02', '2019-06-14 12:39:12', 252),
('Shoyu MacrobiÃ³tico Oshima 500ml', '2020-05-27', '2019-06-14 13:02:23', 253),
('Karinto Yoko 200g', '2019-11-30', '2019-06-14 13:02:52', 254),
('Mirim Saque Azuma 500ml', '2020-05-22', '2019-06-14 13:03:33', 255),
('ChÃ¡ de Amora 40g', '2020-09-07', '2019-06-14 13:04:27', 256),
('AÃ§Ãºcar Mascavo 500g', '2020-05-16', '2019-06-14 13:04:42', 257),
('Bisc Bolinho Yokomizo 270g', '2019-07-21', '2019-06-14 13:05:38', 258),
('Kare Golden Forte 220g', '2020-09-13', '2019-06-14 13:06:07', 259),
('Amendoim King 400g', '2019-10-16', '2019-06-14 13:10:22', 260),
('Bala Jelly Sweet Morango 200g', '2020-05-16', '2019-06-14 13:10:43', 261),
('Sembei Crocante Gengibre 290g', '2019-11-30', '2019-06-14 13:11:09', 262),
('Gergelim Preto Torrado Casa Forte 100g', '2020-04-15', '2019-06-14 13:13:45', 263),
('Kinako-soja Em PÃ³ 200g', '2020-05-17', '2019-06-14 13:14:51', 264),
('Ã“leo Soja Liza 900ml', '2019-11-13', '2019-06-17 10:23:36', 265),
('Vinagre Alcool Castelo 750ml', '2020-10-19', '2019-06-17 10:26:00', 266),
('Maionese Quero 495g', '2019-12-18', '2019-06-17 11:41:48', 267),
('Look Bisc Wafer Floresta Negra 55g', '2019-12-18', '2019-06-17 11:42:22', 268),
('Creme De Leite ItambÃ© 300g', '2020-02-13', '2019-06-17 11:43:00', 269),
('Queijo Ralado Teixeira 50G', '2019-09-12', '2019-06-17 12:59:17', 270),
('Queijo Ralado Teixeira 50G', '2019-09-13', '2019-06-17 12:59:28', 271),
('CafÃ© Tradicional PilÃ£o 250G Almof', '2020-01-24', '2019-06-17 13:03:40', 272),
('CafÃ© Tradicional PilÃ£o 500G', '2020-09-30', '2019-06-17 14:08:29', 273),
('CafÃ© Tradicional 3 CoraÃ§Ãµes 500G', '2020-10-11', '2019-06-17 14:09:15', 274),
('CafÃ© Tradicional 3 CoraÃ§Ãµes 250G', '2020-09-11', '2019-06-17 14:09:25', 275),
('Molho Polpa de Tomate Quero 520G', '2020-09-30', '2019-06-17 14:11:15', 276),
('Pipoca Canjica de Milho Doce 50G', '2019-10-21', '2019-06-17 19:28:13', 277),
('Tempero para Conserva de Pepino 45G', '2019-07-31', '2019-06-17 19:34:58', 278),
('Curry Megamori Pronto 300G', '2020-05-22', '2019-06-17 19:35:10', 279),
('Biscoito de Polvilho Pingo de Minas 80G', '2019-09-11', '2019-06-17 19:36:12', 280),
('Batata Palha Point Chips 100G', '2019-11-22', '2019-06-17 19:36:29', 281),
('Karinto Salgado Cebola 90G', '2019-07-20', '2019-06-17 19:37:09', 282),
('Karinto Salgado Alho 90G', '2019-08-03', '2019-06-17 19:37:49', 283),
('PÃ£o Rei do Trigo Leite 400G', '2019-07-02', '2019-06-17 19:40:53', 284),
('PÃ£o Rei do Trigo Batata 400G', '2019-06-19', '2019-06-17 19:41:14', 285),
('PÃ£o Rei do Trigo Batata 400G', '2019-07-02', '2019-06-17 19:42:40', 287),
('PÃ£o Rei do Trigo Milho 400G', '2019-07-02', '2019-06-17 19:42:50', 288),
('GuaranÃ¡ Guaranita 2L', '2019-09-29', '2019-06-17 19:44:47', 289),
('Coca Cola 2L', '2019-08-21', '2019-06-17 19:45:21', 290),
('Bisc Bolinho Yokomizo 270G', '2019-07-31', '2019-06-18 10:11:15', 291),
('Pipoca Canjica de Milho Doce 50G', '2019-11-12', '2019-06-18 10:12:17', 292),
('Okaki Nori 100G', '2019-11-23', '2019-06-18 10:48:34', 293),
('Tempurako 500G', '2021-03-04', '2019-06-18 10:50:14', 294),
('Yakissoba Nissin 500G', '2019-12-25', '2019-06-18 10:50:33', 295),
('Ã“leo La-Yu Chili Oil S&B 33ml', '2020-12-01', '2019-06-18 10:54:32', 296),
('Gelatina de Alga Frutas Sortida c/ Coco 280G', '2019-12-12', '2019-06-18 10:55:57', 297),
('Gelatina de Alga Lichia c/ Coco 280G', '2019-12-13', '2019-06-18 10:56:07', 298),
('Torrada Arroz Integ Org Chia/Gerg 75G', '2020-01-29', '2019-06-18 10:57:10', 299),
('Torrada Arroz Integ Org Quinoa/LinhaÃ§a 75G', '2020-01-29', '2019-06-18 10:57:54', 300),
('Mandiopan 100G', '2021-04-05', '2019-06-18 10:59:03', 301),
('Kare Golden Curry Medio 92G', '2020-07-29', '2019-06-18 10:59:37', 302),
('Sembei Shelly Want Want 122G', '2020-01-04', '2019-06-18 11:00:09', 303),
('Saque Azuma Kirim Dourado 175ml', '2019-09-21', '2019-06-18 11:00:55', 304),
('Yaki Soba Hirotani 500G', '2020-05-31', '2019-06-18 11:02:58', 305),
('Choga Gari Pote 230G Dren 100G', '2019-11-28', '2019-06-18 11:03:37', 306),
('Choga Gari Pote 230G Dren 100G', '2019-12-04', '2019-06-18 11:03:49', 307),
('Molho p/ Yakissoba Alfa 500ml', '2020-05-27', '2019-06-18 11:04:14', 308),
('Rosquinha Satsumaya Amendoim Pote 250G', '2019-11-16', '2019-06-18 11:04:37', 309),
('Okazunori Shinsen c/ 08 20G', '2019-10-15', '2019-06-18 11:06:24', 310),
('Sembei Satsumaya Leite 280G', '2020-02-08', '2019-06-18 11:07:53', 311),
('Cha Bancha Yamamotoyama c/ 15', '2021-02-28', '2019-06-18 11:08:26', 312),
('Kareko Condimento India 57G', '2019-11-30', '2019-06-18 11:09:14', 313),
('Kareko Condimento India 57G', '2019-12-31', '2019-06-18 11:09:51', 314),
('Ã“leo de Gergelim Torrado Hong Kong 100ml', '2022-05-07', '2019-06-18 11:12:11', 315),
('Ã“leo de Gergelim Torrado Kenko 100ml', '2020-10-31', '2019-06-18 11:12:42', 316),
('Hitimi Togarashi S&B 15G', '2021-05-13', '2019-06-18 11:13:20', 317),
('Rosquinha Satsumaya Coco Pote 250G', '2019-10-22', '2019-06-18 11:13:40', 318),
('Nori Ab Edomae c/ 10F 23G', '2021-01-01', '2019-06-18 11:14:12', 319),
('Banana Chips 100G', '2019-07-18', '2019-06-18 11:20:23', 320),
('Pipoca Doce de Milho Clac 170G', '2019-10-11', '2019-06-18 11:21:02', 321);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `excluidos`
--
ALTER TABLE `excluidos`
  ADD PRIMARY KEY (`id_exclusao`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `excluidos`
--
ALTER TABLE `excluidos`
  MODIFY `id_exclusao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
