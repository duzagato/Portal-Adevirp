-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Ago-2022 às 19:45
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `adevirp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE `agenda` (
  `agenda_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `educando_id` int(11) NOT NULL,
  `agenda_titulo` varchar(50) NOT NULL,
  `agenda_dia` varchar(20) NOT NULL,
  `agenda_aula` int(11) NOT NULL,
  `agenda_inc_data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `agenda`
--

INSERT INTO `agenda` (`agenda_id`, `professor_id`, `educando_id`, `agenda_titulo`, `agenda_dia`, `agenda_aula`, `agenda_inc_data`) VALUES
(5, 9, 1, '', 'segunda-feira', 7, 1655111600),
(7, 9, 12, '', 'quinta-feira', 8, 1641092400),
(18, 9, 15, '', 'segunda-feira', 1, 1652519600),
(19, 9, 11, '', 'segunda-feira', 2, 1655863600),
(21, 9, 4, '', 'segunda-feira', 4, 1652519600),
(37, 10, 5, '', 'segunda-feira', 2, 1659753150),
(38, 10, 3, '', 'segunda-feira', 1, 1659753281),
(39, 10, 13, '', 'terca-feira', 3, 1658905267),
(40, 10, 6, '', 'terca-feira', 4, 1636696986),
(41, 10, 3, '', 'segunda-feira', 3, 1633460507),
(42, 10, 11, '', 'quarta-feira', 1, 1636859904),
(43, 10, 12, '', 'terca-feira', 2, 1658576660),
(44, 10, 14, '', 'quinta-feira', 8, 1657910637),
(45, 10, 15, '', 'quinta-feira', 1, 1646873114),
(46, 10, 1, '', 'quinta-feira', 2, 1642721788),
(47, 10, 15, '', 'quarta-feira', 3, 1651312218),
(48, 10, 15, '', 'quinta-feira', 3, 1646386208),
(49, 10, 11, '', 'quarta-feira', 4, 1635810205),
(50, 10, 4, '', 'quarta-feira', 5, 1657790129),
(51, 10, 5, '', 'quarta-feira', 6, 1643852952),
(52, 10, 1, '', 'quinta-feira', 4, 1658000273),
(53, 10, 15, '', 'terca-feira', 5, 1640369127),
(54, 10, 11, '', 'quinta-feira', 2, 1652407458);

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca_autor`
--

CREATE TABLE `biblioteca_autor` (
  `biblioteca_autor_id` int(11) NOT NULL,
  `biblioteca_autor_nome` varchar(100) NOT NULL,
  `biblioteca_autor_slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca_categoria`
--

CREATE TABLE `biblioteca_categoria` (
  `biblioteca_categoria_id` int(11) NOT NULL,
  `biblioteca_categoria_nome` varchar(30) NOT NULL,
  `biblioteca_categoria_slug` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca_livro`
--

CREATE TABLE `biblioteca_livro` (
  `biblioteca_livro_id` int(11) NOT NULL,
  `biblioteca_livro_capa` varchar(50) NOT NULL,
  `biblioteca_livro_titulo` varchar(100) NOT NULL,
  `biblioteca_livro_slug` varchar(100) NOT NULL,
  `biblioteca_livro_sinopse` text NOT NULL,
  `biblioteca_livro_arquivo` varchar(50) NOT NULL,
  `biblioteca_autor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `impressao`
--

CREATE TABLE `impressao` (
  `impressao_id` int(11) NOT NULL,
  `impressao_arquivo` varchar(50) NOT NULL,
  `impressao_descricao` text NOT NULL,
  `impressao_ampliada` tinyint(1) NOT NULL,
  `impressao_braille` tinyint(1) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `impressao_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `impressao`
--

INSERT INTO `impressao` (`impressao_id`, `impressao_arquivo`, `impressao_descricao`, `impressao_ampliada`, `impressao_braille`, `usuario_id`, `impressao_status`) VALUES
(1, 'Apostilha informática.docx', '', 1, 0, 2, 0),
(2, 'Apostilha informática.docx', '', 1, 0, 10, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro_categoria`
--

CREATE TABLE `livro_categoria` (
  `id` int(11) NOT NULL,
  `biblioteca_livro_id` int(11) NOT NULL,
  `biblioteca_categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_token`
--

CREATE TABLE `login_token` (
  `token_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login_token`
--

INSERT INTO `login_token` (`token_id`, `usuario_id`, `token`) VALUES
(11, 9, 'ad62f0904f2ecce');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `projeto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `projeto_nome` varchar(30) NOT NULL,
  `projeto_descricao` text NOT NULL,
  `projeto_data` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`projeto_id`, `usuario_id`, `projeto_nome`, `projeto_descricao`, `projeto_data`) VALUES
(2, 9, 'Apostila de Informática', 'Apostila de informática.', '26/07/2022');

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio`
--

CREATE TABLE `relatorio` (
  `relatorio_id` int(11) NOT NULL,
  `relatorio_descricao` text NOT NULL,
  `relatorio_presenca` tinyint(1) NOT NULL,
  `relatorio_atendimento_data` int(11) NOT NULL,
  `relatorio_data` int(20) NOT NULL,
  `educando_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `relatorio`
--

INSERT INTO `relatorio` (`relatorio_id`, `relatorio_descricao`, `relatorio_presenca`, `relatorio_atendimento_data`, `relatorio_data`, `educando_id`, `professor_id`) VALUES
(4, 'Aula de soroban', 1, 20220201, 7, 15, 10),
(9, 'sklAJSKLSJL\r\n', 1, 20220101, 7, 15, 10),
(28, 'ldçajdkalkj', 1, 1655089200, 1659933831, 1, 9),
(30, '', 0, 1656298800, 1659934110, 1, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `tipo_id` int(11) NOT NULL,
  `tipo_nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`tipo_id`, `tipo_nome`) VALUES
(1, 'Administrador'),
(2, 'Coordenador'),
(3, 'Professor'),
(4, 'Técnico'),
(5, 'Educando'),
(6, 'Voluntário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nome` varchar(20) NOT NULL,
  `usuario_sobrenome` varchar(20) NOT NULL,
  `usuario_email` varchar(50) NOT NULL,
  `usuario_celular` varchar(20) NOT NULL,
  `usuario_genero` varchar(10) NOT NULL,
  `usuario_visao` varchar(10) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `usuario_apelido` varchar(30) NOT NULL,
  `usuario_senha` varchar(60) NOT NULL,
  `usuario_slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nome`, `usuario_sobrenome`, `usuario_email`, `usuario_celular`, `usuario_genero`, `usuario_visao`, `tipo_id`, `usuario_apelido`, `usuario_senha`, `usuario_slug`) VALUES
(1, 'Eduardo', 'Zagato', 'duzagatto@hotmail.com', '16988708149', 'Masculino', 'Baixa', 5, 'eduardozagato', '$2y$10$3bFVey1oLDq8S9LXY7DekOyB0NXM0R./pOeh37sYJfdxr.7PLHKLm', 'eduardo-zagato'),
(2, 'Administração', 'Adevirp', 'admin@adevirp.com', '1639131900', 'Masculino', 'Normal', 1, 'admin', '$2y$10$IsNgj1QOQVQxq0wnvElmye8OIykiRd/T96TQFSPN/h57wg1xL.tiy', 'administracao-adevirp'),
(3, 'Max', 'Verstappen', 'max@gmail.com', '16998381938', 'Masculino', 'Cego', 5, 'maxverstappen', '$2y$10$ZNQm87P9VVemlE4i4qCSI.aoAUxgF50TCJgsfMImUb36O77cc6qDy', 'max-verstappen'),
(4, 'Rogério', 'Ceni', 'rc@gmail.com', '16998389429', 'Masculino', 'Baixa', 5, 'rogerioceni', '$2y$10$hbOSv1ce43DmeHohgVeCWuE09q/nIyBEiBrTQTZNtEXR4ScoQ6Oku', 'rogerio-ceni'),
(5, 'Ayn', 'Rand', 'ayn@gmail.com', '15986838291', 'Feminino', 'Cego', 5, 'aynrand', '$2y$10$GAO.1MoAEdgZFsRD2gB6Gu3BXIohXXQx0gloQjIhmb0QR23zkHuIq', 'ayn-rand'),
(6, 'Joanne', 'Kathleen Rowling', 'jkrowling@gmail.com', '1699110022', 'Feminino', 'Cego', 5, 'jkrowling', '$2y$10$akvzN1tfTecmUYGO3t/JueTB5DSjEDEZkw3gd/nOZwadgc4ms0kHS', 'joanne-kathleen-rowling'),
(7, 'Jane', 'Austen', 'jane@gmail.com', '1999221100', 'Feminino', 'Normal', 6, 'jane', '$2y$10$EkNQcc7CfZ2RndW0Uak3IuxHT4kR1ZhKTSLWsKEujEPySZ4.lPkYi', 'jane-austen'),
(8, 'Magnus', 'Carlsen', 'magnus@gmail.com', '1699112200', 'Masculino', 'Baixa', 5, 'magnuscarlsen', '$2y$10$7wMjYObRHbhCpKeP01eaGOPeur1M2Rzv3a4rrUvxUiTEoGBmykHAK', 'magnus-carlsen'),
(9, 'João', 'Pedro', 'joaopedro@gmail.com', '1699221003', 'Masculino', 'Normal', 3, 'joaopedro', '$2y$10$S2jz5.ApfZGq9dznQmG6iOFw6z0RH3wTA6A6h/69taML5AHFtfLly', 'joao-pedro'),
(10, 'Guilherme', 'Sandrin', 'guilherme.sandrin@gmail.com', '1999221100', 'Masculino', 'Cego', 3, 'guilhermesandrin', '$2y$10$Zcpr028hfEM5tr9hCCJzC.8SJMr/r6h9lQ1JeYvjv88GSPhKVbTta', 'guilherme-sandrin'),
(11, 'Tess', 'Gerritsen', 'tess@gmail.com', '16988102929', 'Feminino', 'Cego', 5, 'tess', '$2y$10$8ZgHm7doEufnHMzYhdjfY.EkeNKRcS.zJ0GmIWy0mEIfWUT5bhqUm', 'tess-gerritsen'),
(12, 'Noel', 'Gallagher', 'noel@gmail.com', '16988102929', 'Masculino', 'Baixa', 5, 'noel', '$2y$10$SGUlvoT4ioCmxj6PN0lQVusClijqbFSR3t45El/JMk/BnanX8Y43q', 'noel-gallagher'),
(13, 'Jonathan', 'Calleri', 'jonathan@gmail.com', '1699110022', 'Masculino', 'Baixa', 5, 'calleri', '$2y$10$jlSVh2XRirMJ7w2lhE419eLD0n8kemwCDxS0m6m5RF0zvyGqo80Vq', 'jonathan-calleri'),
(14, 'Hermione', 'Granger', 'hermione@gmail.com', '1699110022', 'Feminino', 'Cego', 5, 'hermione', '$2y$10$P4FCqw/KydH1gmFRIEwCK.ak7hSjP.iIbu5YAE9Nkss0sluB89OLG', 'hermione-granger'),
(15, 'Kobe', 'Bryant', 'kobe@gmail.com', '16988102929', 'Masculino', 'Baixa', 5, 'kobe', '$2y$10$YRKnhV2YvAKLNT3nDLOmp.DUorfTF7EUEaVZ/EqiidTSkooE3QyCi', 'kobe-bryant'),
(16, 'Ludwig', 'Von Mises', 'ludwig@gmail.com', '16988102929', 'Masculino', 'Normal', 3, 'mises', '$2y$10$nHTx5et08JtjTbjaUdeIPu256kORIBU4nbvgU2ObYw92JoSR9ZK7G', 'ludwig-von-mises'),
(17, 'Edward', 'Snowden', 'edward@gmail.com', '16988102929', 'Masculino', 'Normal', 2, 'snowden', '$2y$10$lVKJhqv/4K.CKAoxWuNErO/MK0V6lnkSbrurY9qOCQZYgc8reaeOC', 'edward-snowden'),
(18, 'Axl', 'Rose', 'axl@gmail.com', '16988102929', 'Masculino', 'Baixa', 6, 'axl', '$2y$10$v61qt4jbPTHyxcLLuV2FzuZ5O919of2X1EZnNlAoV9bkK..lyQnvG', 'axl-rose');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`agenda_id`),
  ADD KEY `user_id` (`professor_id`),
  ADD KEY `agenda_ibfk_1` (`educando_id`);

--
-- Índices para tabela `biblioteca_autor`
--
ALTER TABLE `biblioteca_autor`
  ADD PRIMARY KEY (`biblioteca_autor_id`);

--
-- Índices para tabela `biblioteca_categoria`
--
ALTER TABLE `biblioteca_categoria`
  ADD PRIMARY KEY (`biblioteca_categoria_id`);

--
-- Índices para tabela `biblioteca_livro`
--
ALTER TABLE `biblioteca_livro`
  ADD PRIMARY KEY (`biblioteca_livro_id`),
  ADD KEY `biblioteca_autor_id` (`biblioteca_autor_id`);

--
-- Índices para tabela `impressao`
--
ALTER TABLE `impressao`
  ADD PRIMARY KEY (`impressao_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `livro_categoria`
--
ALTER TABLE `livro_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biblioteca_categoria_id` (`biblioteca_categoria_id`),
  ADD KEY `biblioteca_livro_id` (`biblioteca_livro_id`);

--
-- Índices para tabela `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `user_id` (`usuario_id`);

--
-- Índices para tabela `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`projeto_id`);

--
-- Índices para tabela `relatorio`
--
ALTER TABLE `relatorio`
  ADD PRIMARY KEY (`relatorio_id`);

--
-- Índices para tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de tabela `biblioteca_autor`
--
ALTER TABLE `biblioteca_autor`
  MODIFY `biblioteca_autor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `biblioteca_categoria`
--
ALTER TABLE `biblioteca_categoria`
  MODIFY `biblioteca_categoria_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `biblioteca_livro`
--
ALTER TABLE `biblioteca_livro`
  MODIFY `biblioteca_livro_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `impressao`
--
ALTER TABLE `impressao`
  MODIFY `impressao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `livro_categoria`
--
ALTER TABLE `livro_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `login_token`
--
ALTER TABLE `login_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `projeto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `relatorio`
--
ALTER TABLE `relatorio`
  MODIFY `relatorio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `tipo`
--
ALTER TABLE `tipo`
  MODIFY `tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `biblioteca_livro`
--
ALTER TABLE `biblioteca_livro`
  ADD CONSTRAINT `biblioteca_livro_ibfk_1` FOREIGN KEY (`biblioteca_autor_id`) REFERENCES `biblioteca_autor` (`biblioteca_autor_id`);

--
-- Limitadores para a tabela `livro_categoria`
--
ALTER TABLE `livro_categoria`
  ADD CONSTRAINT `livro_categoria_ibfk_1` FOREIGN KEY (`biblioteca_categoria_id`) REFERENCES `biblioteca_categoria` (`biblioteca_categoria_id`),
  ADD CONSTRAINT `livro_categoria_ibfk_2` FOREIGN KEY (`biblioteca_livro_id`) REFERENCES `biblioteca_livro` (`biblioteca_livro_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
