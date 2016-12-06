-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28-Nov-2016 às 03:12
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `threadsoft_db`
--
CREATE DATABASE IF NOT EXISTS `threadsoft_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `threadsoft_db`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de categorias.',
  `category` varchar(45) NOT NULL COMMENT 'Tabela destinada a registrar as categorias do produtos.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela destinada a registrar as categorias do produto.';

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(01, 'Calça'),
(04, 'Camisa'),
(03, 'Jaqueta'),
(02, 'Saia'),
(05, 'Sobretudo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `checks`
--

CREATE TABLE `checks` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de cheques.',
  `sellers_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de vendedor relativo ao cheque.',
  `number` varchar(30) NOT NULL COMMENT 'Número do cheque.',
  `value` decimal(6,2) UNSIGNED NOT NULL COMMENT 'Valor contido no cheque.',
  `date_receipt` date NOT NULL COMMENT 'Data de recebimento do cheque.',
  `status` tinyint(1) NOT NULL COMMENT 'Status do cheque. Se foi descontado, ou ocorreu falha no desconto.',
  `date_good_for` date DEFAULT NULL COMMENT 'Data boa para o desconto do cheque.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena os cheques relativos aos vendedores.';

--
-- Extraindo dados da tabela `checks`
--

INSERT INTO `checks` (`id`, `sellers_id`, `number`, `value`, `date_receipt`, `status`, `date_good_for`) VALUES
(0001, 001, '54363463452', '1000.00', '2016-11-13', 1, '2016-12-13'),
(0002, 003, '9849849867', '2000.00', '2016-11-13', 3, '2016-12-30'),
(0003, 002, '654584561', '100.00', '2016-11-13', 1, '2017-03-01'),
(0004, 004, '49849841561', '50.00', '2016-11-13', 2, '2017-01-01'),
(0005, 001, '254549618', '5000.00', '2016-11-13', 2, '2016-12-16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cities`
--

CREATE TABLE `cities` (
  `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de cidade.',
  `states_id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de estado onde a cidade se localiza.',
  `name` varchar(45) NOT NULL COMMENT 'Nome de cidade.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as cidades relativas aos estados.';

--
-- Extraindo dados da tabela `cities`
--

INSERT INTO `cities` (`id`, `states_id`, `name`) VALUES
(001, 01, 'Joinville'),
(002, 01, 'Florianópolis'),
(003, 01, 'Tubarão'),
(004, 01, 'Garuva'),
(005, 02, 'Porto Alegre'),
(006, 02, 'Gramado'),
(007, 02, 'Pelotas'),
(008, 02, 'Canoas'),
(009, 03, 'São Paulo'),
(010, 03, 'Santos'),
(011, 04, 'Curitiba');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entries`
--

CREATE TABLE `entries` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de estrada.',
  `sellers_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'Identificador único de vendedor, pode ser nulo pois só é usado em caso de devolução.',
  `date` date NOT NULL COMMENT 'Data de entrada.',
  `hour` time NOT NULL COMMENT 'Hora de entrada.',
  `type` char(1) NOT NULL COMMENT 'Tipo de entrada [produto novo, devolução ou reposição].'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as entradas de produtos no estoque.';

--
-- Extraindo dados da tabela `entries`
--

INSERT INTO `entries` (`id`, `sellers_id`, `date`, `hour`, `type`) VALUES
(00001, NULL, '2016-10-10', '16:00:00', '1'),
(00002, NULL, '2016-10-10', '16:00:00', '1'),
(00003, NULL, '2016-11-13', '16:08:00', '1'),
(00004, NULL, '2016-11-13', '16:08:00', '1'),
(00005, NULL, '2016-11-13', '16:08:00', '1'),
(00006, NULL, '2016-11-13', '16:08:00', '1'),
(00007, NULL, '2016-11-13', '16:08:00', '1'),
(00008, NULL, '2016-11-27', '19:41:00', '1'),
(00009, NULL, '2016-11-27', '19:41:00', '1'),
(00010, NULL, '2016-11-27', '19:41:00', '1'),
(00011, NULL, '2016-11-27', '19:41:00', '1'),
(00012, NULL, '2016-11-27', '19:41:00', '1'),
(00013, NULL, '2016-11-27', '19:41:00', '1'),
(00014, NULL, '2016-11-27', '19:41:00', '1'),
(00015, NULL, '2016-11-27', '19:43:00', '1'),
(00016, NULL, '2016-11-27', '19:43:00', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entries_has_products_has_sizes`
--

CREATE TABLE `entries_has_products_has_sizes` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de entradas que tem produtos com tamanhos.',
  `entries_id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de entradas.',
  `products_has_sizes_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de produtos com tamanhos.',
  `quantity` smallint(4) UNSIGNED NOT NULL COMMENT 'Quantidade de produtos contidos na entrada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que vincula os produtos de cada tamanho com as estradas no estoque.';

--
-- Extraindo dados da tabela `entries_has_products_has_sizes`
--

INSERT INTO `entries_has_products_has_sizes` (`id`, `entries_id`, `products_has_sizes_id`, `quantity`) VALUES
(00001, 00001, 001, 5),
(00002, 00002, 005, 5),
(00003, 00003, 008, 100),
(00004, 00004, 005, 10),
(00005, 00005, 002, 100),
(00006, 00006, 005, 5),
(00007, 00007, 009, 5),
(00008, 00008, 004, 4),
(00009, 00009, 005, 2),
(00010, 00010, 001, 6),
(00011, 00011, 002, 10),
(00012, 00012, 003, 12),
(00013, 00013, 009, 5),
(00014, 00014, 006, 7),
(00015, 00015, 010, 5),
(00016, 00016, 011, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventories`
--

CREATE TABLE `inventories` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para estoque.',
  `products_has_sizes_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Tamanho do produo que está no estoque.',
  `quantity` smallint(4) UNSIGNED NOT NULL COMMENT 'Quantidade de produto por tamanho.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela destinada a armazenar a quantidade de cada produto por tamanho no estoque.';

--
-- Extraindo dados da tabela `inventories`
--

INSERT INTO `inventories` (`id`, `products_has_sizes_id`, `quantity`) VALUES
(001, 001, 8),
(002, 005, 16),
(003, 008, 93),
(004, 002, 107),
(005, 009, 5),
(006, 004, 1),
(007, 003, 12),
(008, 006, 7),
(009, 010, 5),
(010, 011, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de fabricante.',
  `name` varchar(45) NOT NULL COMMENT 'Nome fantasia de fabricante.',
  `phone` bigint(20) UNSIGNED NOT NULL COMMENT 'Telefone de contato de fabricante.',
  `email` varchar(100) NOT NULL COMMENT 'E-mail de contato de fabricante.',
  `cnpj` bigint(18) UNSIGNED ZEROFILL NOT NULL COMMENT 'CNPJ de fabricante.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena os faricantes dos produtos.';

--
-- Extraindo dados da tabela `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`, `phone`, `email`, `cnpj`) VALUES
(01, 'Cia Rotta', 4798456547, 'ciarotta@exemplo', 000003263463534263),
(02, 'SkyLife', 4785497458, 'skylife@exemplo', 4568793263463534263),
(03, 'Gato Preto', 4759869823, 'gatopreto@exemplo', 456845626345653426);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de produto.',
  `categories_id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Categoria de produto.',
  `manufacturers_id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de fabricante.',
  `code` int(3) NOT NULL COMMENT 'Código de produto.',
  `model` varchar(45) NOT NULL COMMENT 'Modelo de produto.',
  `sex` tinyint(1) NOT NULL COMMENT 'Sexo do produto.',
  `price` decimal(5,2) UNSIGNED NOT NULL COMMENT 'Preço de produto.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena os produtos.';

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `categories_id`, `manufacturers_id`, `code`, `model`, `sex`, `price`) VALUES
(001, 01, 01, 1, 'M1', 1, '100.00'),
(002, 04, 01, 2, 'M2', 3, '60.00'),
(003, 02, 01, 3, 'M3', 2, '55.00'),
(004, 05, 03, 4, 'M4', 1, '200.00'),
(005, 03, 03, 5, 'M5', 2, '150.00'),
(006, 05, 03, 6, 'M6', 3, '180.00'),
(007, 02, 02, 7, 'M7', 2, '140.00'),
(008, 04, 02, 8, 'M8', 1, '40.00'),
(009, 01, 01, 9, 'M9', 3, '200.00'),
(010, 05, 03, 10, 'M10', 3, '300.00'),
(011, 04, 01, 11, 'M11', 1, '100.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products_has_sizes`
--

CREATE TABLE `products_has_sizes` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de produto com tamanho.',
  `products_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de produto.',
  `sizes_id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de tamanho.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que vincula os produtos com os seus devidos tamanhos.';

--
-- Extraindo dados da tabela `products_has_sizes`
--

INSERT INTO `products_has_sizes` (`id`, `products_id`, `sizes_id`) VALUES
(001, 001, 03),
(002, 002, 03),
(003, 003, 01),
(004, 004, 02),
(005, 005, 04),
(006, 006, 01),
(007, 007, 03),
(008, 008, 03),
(009, 009, 03),
(010, 010, 03),
(011, 011, 04);

-- --------------------------------------------------------

--
-- Estrutura da tabela `removals`
--

CREATE TABLE `removals` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de saída.',
  `sellers_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de vendedor que recebe os itens da saída. Esse campo pode ser nulo, pois o tipo de saída pode ser de reparo',
  `date` date NOT NULL COMMENT 'Data de saída.',
  `hour` time NOT NULL COMMENT 'Hora de saída.',
  `type` char(1) NOT NULL COMMENT 'Tipo da saída.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as saídas de produtos do estoque.';

--
-- Extraindo dados da tabela `removals`
--

INSERT INTO `removals` (`id`, `sellers_id`, `date`, `hour`, `type`) VALUES
(00003, 001, '2016-11-26', '20:18:00', 'm'),
(00004, 001, '2016-11-26', '23:45:00', 'b'),
(00005, 002, '2016-11-27', '19:46:00', 'b'),
(00006, 002, '2016-11-27', '19:46:00', 'b'),
(00007, 003, '2016-11-27', '19:46:00', 'b'),
(00008, 003, '2016-11-27', '19:46:00', 'b'),
(00009, 002, '2016-11-27', '19:54:00', 'm'),
(00010, 002, '2016-11-27', '19:54:00', 'm'),
(00011, 002, '2016-11-27', '19:54:00', 'm'),
(00012, 002, '2016-11-27', '19:54:00', 'm'),
(00013, 004, '2016-11-27', '19:55:00', 'm'),
(00014, 004, '2016-11-27', '19:55:00', 'm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `removals_has_products_has_sizes`
--

CREATE TABLE `removals_has_products_has_sizes` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de saída que tem produtos com tamanhos.',
  `removals_id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificado de saída.',
  `products_has_sizes_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de produto com tamnho.',
  `quantity` smallint(4) UNSIGNED NOT NULL COMMENT 'Quantidade de produtos contidos na saída.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que vincula os produtos de cada tamanho com as saídas do estoque.';

--
-- Extraindo dados da tabela `removals_has_products_has_sizes`
--

INSERT INTO `removals_has_products_has_sizes` (`id`, `removals_id`, `products_has_sizes_id`, `quantity`) VALUES
(00001, 00003, 005, 1),
(00002, 00004, 005, 1),
(00003, 00005, 001, 2),
(00004, 00006, 005, 4),
(00005, 00007, 009, 5),
(00006, 00008, 008, 1),
(00007, 00009, 001, 1),
(00008, 00010, 002, 2),
(00009, 00011, 004, 3),
(00010, 00012, 008, 5),
(00011, 00013, 008, 1),
(00012, 00014, 002, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `repairs`
--

CREATE TABLE `repairs` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de saída reparo.',
  `removals_has_products_has_sizes_id` int(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de saída que tem produtos com tamanhos.',
  `entries_id` int(5) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'Identificador de entrada de produto.',
  `date` date NOT NULL COMMENT 'Data de saída de reparo.',
  `hour` time NOT NULL COMMENT 'Hora de saída de reparo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as saída de produtos para reparo em seus respectivos fabricantes.';

-- --------------------------------------------------------

--
-- Estrutura da tabela `sellers`
--

CREATE TABLE `sellers` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de vendedor.',
  `cities_id` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de cidade onde o vendedor atua.',
  `name` varchar(45) NOT NULL COMMENT 'Nome do vendedor.',
  `email` varchar(100) NOT NULL COMMENT 'E-mail de vendedor.',
  `phone` bigint(20) NOT NULL COMMENT 'Telefone de vendedor.',
  `birth_date` date NOT NULL COMMENT 'Data de nascimento do vendedor.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena os vededores.';

--
-- Extraindo dados da tabela `sellers`
--

INSERT INTO `sellers` (`id`, `cities_id`, `name`, `email`, `phone`, `birth_date`) VALUES
(001, 001, 'Jean Capote', 'jean@exemplo', 47987451235, '1996-10-10'),
(002, 001, 'Marlow Dickel', 'marlow@exemplo', 4798784535, '1994-10-10'),
(003, 001, 'Liany Bitencourt', 'liany@exemplo', 47845787451, '1999-10-10'),
(004, 010, 'Ricardo Fulano', 'ricardo@exemplo', 4794135447, '1998-10-10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sizes`
--

CREATE TABLE `sizes` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para tamanho.',
  `size` varchar(10) NOT NULL COMMENT 'Campo destinado a registrar o tamanho dos produtos.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela destinada a armazenar o tamanho do produto.';

--
-- Extraindo dados da tabela `sizes`
--

INSERT INTO `sizes` (`id`, `size`) VALUES
(02, 'G'),
(04, 'GG'),
(03, 'M'),
(01, 'P');

-- --------------------------------------------------------

--
-- Estrutura da tabela `states`
--

CREATE TABLE `states` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único de estado.',
  `name` varchar(45) NOT NULL COMMENT 'Nome de estado.',
  `initials` char(2) NOT NULL COMMENT 'Sigla, ou iniciais, de estado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena os estados.';

--
-- Extraindo dados da tabela `states`
--

INSERT INTO `states` (`id`, `name`, `initials`) VALUES
(01, 'Santa Catarina', 'SC'),
(02, 'Rio Grande do Sul', 'RS'),
(03, 'São Paulo', 'SP'),
(04, 'Paraná', 'PR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Este campo serve como identificador único para usuário.',
  `username` varchar(20) NOT NULL COMMENT 'Este campo é destinado a armazenar o nome de usuário.',
  `password` char(32) NOT NULL COMMENT 'Este campo é a armazenar a senha para o usuário.',
  `email` varchar(100) NOT NULL COMMENT 'Este campo é destinado a armazanar o e-mail do usuário.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Esta tabela armazena todos os usuários do software.';

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(01, 'admin', 'admin', 'admin@exemplo'),
(02, 'admin2', 'admin2', 'admin2@exemplo'),
(03, 'admin3', 'admin3', 'admin3@exemplo'),
(04, 'admin4', 'admin4', 'admin4@exemplo'),
(05, 'admin5', 'admin', 'admin5@exemplo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_UNIQUE` (`category`);

--
-- Indexes for table `checks`
--
ALTER TABLE `checks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_checks_sellers1_idx` (`sellers_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cities_states1_idx` (`states_id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entries_sellers1_idx` (`sellers_id`);

--
-- Indexes for table `entries_has_products_has_sizes`
--
ALTER TABLE `entries_has_products_has_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entries_has_products_has_sizes_products_has_sizes1_idx` (`products_has_sizes_id`),
  ADD KEY `fk_entries_has_products_has_sizes_entries1_idx` (`entries_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventories_products_has_sizes1_idx` (`products_has_sizes_id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `e_mail_UNIQUE` (`email`),
  ADD UNIQUE KEY `cnpj_UNIQUE` (`cnpj`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`),
  ADD KEY `fk_products_categories1_idx` (`categories_id`),
  ADD KEY `fk_products_manufacturers1_idx` (`manufacturers_id`);

--
-- Indexes for table `products_has_sizes`
--
ALTER TABLE `products_has_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_has_sizes_sizes1_idx` (`sizes_id`),
  ADD KEY `fk_products_has_sizes_products_idx` (`products_id`);

--
-- Indexes for table `removals`
--
ALTER TABLE `removals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_removals_sellers1_idx` (`sellers_id`);

--
-- Indexes for table `removals_has_products_has_sizes`
--
ALTER TABLE `removals_has_products_has_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_removals_has_products_has_sizes_products_has_sizes1_idx` (`products_has_sizes_id`),
  ADD KEY `fk_removals_has_products_has_sizes_removals1_idx` (`removals_id`);

--
-- Indexes for table `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_repairs_removals_has_products_has_sizes1_idx` (`removals_has_products_has_sizes_id`),
  ADD KEY `fk_repairs_entries1_idx` (`entries_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `e_mail_UNIQUE` (`email`),
  ADD UNIQUE KEY `phone_UNIQUE` (`phone`),
  ADD KEY `fk_sellers_cities1_idx` (`cities_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `size_UNIQUE` (`size`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `initials_UNIQUE` (`initials`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `e_mail_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de categorias.', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `checks`
--
ALTER TABLE `checks`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de cheques.', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de cidade.', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de estrada.', AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `entries_has_products_has_sizes`
--
ALTER TABLE `entries_has_products_has_sizes`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de entradas que tem produtos com tamanhos.', AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para estoque.', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de fabricante.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de produto.', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `products_has_sizes`
--
ALTER TABLE `products_has_sizes`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de produto com tamanho.', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `removals`
--
ALTER TABLE `removals`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de saída.', AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `removals_has_products_has_sizes`
--
ALTER TABLE `removals_has_products_has_sizes`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de saída que tem produtos com tamanhos.', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de saída reparo.';
--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de vendedor.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para tamanho.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de estado.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve como identificador único para usuário.', AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `checks`
--
ALTER TABLE `checks`
  ADD CONSTRAINT `fk_checks_sellers1` FOREIGN KEY (`sellers_id`) REFERENCES `sellers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `fk_cities_states1` FOREIGN KEY (`states_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `fk_entries_sellers1` FOREIGN KEY (`sellers_id`) REFERENCES `sellers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `entries_has_products_has_sizes`
--
ALTER TABLE `entries_has_products_has_sizes`
  ADD CONSTRAINT `fk_entries_has_products_has_sizes_entries1` FOREIGN KEY (`entries_id`) REFERENCES `entries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entries_has_products_has_sizes_products_has_sizes1` FOREIGN KEY (`products_has_sizes_id`) REFERENCES `products_has_sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `fk_inventories_products_has_sizes1` FOREIGN KEY (`products_has_sizes_id`) REFERENCES `products_has_sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_manufacturers1` FOREIGN KEY (`manufacturers_id`) REFERENCES `manufacturers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `products_has_sizes`
--
ALTER TABLE `products_has_sizes`
  ADD CONSTRAINT `fk_products_has_sizes_products` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_has_sizes_sizes1` FOREIGN KEY (`sizes_id`) REFERENCES `sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `removals`
--
ALTER TABLE `removals`
  ADD CONSTRAINT `fk_removals_sellers1` FOREIGN KEY (`sellers_id`) REFERENCES `sellers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `removals_has_products_has_sizes`
--
ALTER TABLE `removals_has_products_has_sizes`
  ADD CONSTRAINT `fk_removals_has_products_has_sizes_products_has_sizes1` FOREIGN KEY (`products_has_sizes_id`) REFERENCES `products_has_sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_removals_has_products_has_sizes_removals1` FOREIGN KEY (`removals_id`) REFERENCES `removals` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `repairs`
--
ALTER TABLE `repairs`
  ADD CONSTRAINT `fk_repairs_entries1` FOREIGN KEY (`entries_id`) REFERENCES `entries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_repairs_removals_has_products_has_sizes1` FOREIGN KEY (`removals_has_products_has_sizes_id`) REFERENCES `removals_has_products_has_sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `fk_sellers_cities1` FOREIGN KEY (`cities_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
