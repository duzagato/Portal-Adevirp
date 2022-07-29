-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Jul-2022 às 03:07
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
(5, 9, 24, '', 'segunda-feira', 7, 1655111600),
(7, 9, 17, '', 'quinta-feira', 8, 1641092400),
(18, 9, 22, '', 'segunda-feira', 1, 1652519600),
(19, 9, 18, '', 'segunda-feira', 2, 1655863600),
(21, 9, 17, '', 'segunda-feira', 4, 1652519600);

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaborador`
--

CREATE TABLE `colaborador` (
  `colaborador_id` int(11) NOT NULL,
  `info_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colaborador`
--

INSERT INTO `colaborador` (`colaborador_id`, `info_id`, `tipo_id`) VALUES
(4, 1, 2),
(5, 3, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `educando`
--

CREATE TABLE `educando` (
  `educando_id` int(11) NOT NULL,
  `info_id` int(11) NOT NULL,
  `educando_visao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `educando`
--

INSERT INTO `educando` (`educando_id`, `info_id`, `educando_visao`) VALUES
(5, 2, 'Baixa');

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
(1, 'Apostilha informática.docx', '', 1, 0, 2, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `info`
--

CREATE TABLE `info` (
  `info_id` int(11) NOT NULL,
  `info_nome` varchar(20) NOT NULL,
  `info_sobrenome` varchar(20) NOT NULL,
  `info_email` varchar(50) NOT NULL,
  `info_celular` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info`
--

INSERT INTO `info` (`info_id`, `info_nome`, `info_sobrenome`, `info_email`, `info_celular`) VALUES
(1, 'Guilherme', 'Sandrin', 'guilherme.sandrin@gmail.com', '16988702222'),
(2, 'Eduardo', 'Zagato', 'du.zagatto@hotmail.com', '16988708149'),
(3, 'João', 'Pedro', 'joao@gmail.com', '16988101999');

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
(1, 2, '$2y$10$nD0sRDGuDypHSOPi.4vd6Oq5qUWoskfaTyo71l2mEKVcj3GjAHn6W');

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
  `relatorio_atendimento_data` varchar(20) NOT NULL,
  `relatorio_atendimento_descricao` text NOT NULL,
  `voluntario_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `relatorio_data` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `usuario_apelido` varchar(50) NOT NULL,
  `usuario_senha` varchar(60) NOT NULL,
  `usuario_nome` varchar(20) NOT NULL,
  `usuario_sobrenome` varchar(20) NOT NULL,
  `usuario_slug` varchar(100) NOT NULL,
  `usuario_email` varchar(50) NOT NULL,
  `usuario_celular` varchar(20) NOT NULL,
  `usuario_visao` varchar(10) NOT NULL,
  `tipo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_apelido`, `usuario_senha`, `usuario_nome`, `usuario_sobrenome`, `usuario_slug`, `usuario_email`, `usuario_celular`, `usuario_visao`, `tipo_id`) VALUES
(2, 'admin', '$2y$10$RCLX3i2Csz9wzABcBr2m4Orngg8Gw5cczSOO90.awHAPfTvpIB8x2', 'Administração', 'Adevirp', '', 'admin@adevirp.com', '16988708149', 'Normal', 1),
(9, 'guilhermesandrin', '$2y$10$cKx7gSyQbJ/Y5yHc9AkE5u5ouJIch4wmdFqkmSrtGezmdLj562gqq', 'Guilherme', 'Sandrin', 'guilherme-sandrin', 'guilherme.sandrin@gmail.com', '1699112200', 'Cego', 3),
(10, 'joaopedro', '$2y$10$2HA5irWoNJ1yDGp9dRH3GuaMa3SGYnjIV3zikDx4VVS4KcCy60cQ.', 'João', 'Pedro', 'joao-pedro', 'joao@gmail.com', '16988102929', 'Normal', 3),
(13, 'simonebeauvoir', '$2y$10$0C3X9pFGnInQ9Elarob0/u2dastXdqo5IPL5sN4FNOJmXixcWDLkW', 'Simone', 'De Beauvoir', 'simone-de-beauvoir', 'simone@gmail.com', '1699112200', 'Baixa', 3),
(14, 'merylstreep', '$2y$10$nJQLEAD5rKwVqWQgz5QlteZU.ffP167AXe2.CzYhYR1F2en/cKRuu', 'Meryl', 'Streep', 'meryl-streep', 'meryl@gmail.com', '1698112999', 'Baixa', 5),
(15, 'lauanaprado', '$2y$10$PHwSABUJU0.QzMxCyXfygOTN3zlhGmeOzlARE6esY4SyHUXA9vybm', 'Lauana', 'Prado', 'lauana-prado', 'lauana@gmail.com', '1999221100', 'Cego', 5),
(16, 'janeausten', '$2y$10$Z9nE3XNJma9ZqidyiHkfQOD9Anzq93ehVq/IJpL1FvYC4rIXU.0Ja', 'Jane', 'Austen', 'jane-austen', 'jane@gmail.com', '1699221003', 'Cego', 5),
(17, 'supermax', '$2y$10$j38Rn5VI5N7PmJjHwSRVJOPhOVqa1iSz3bfeWvymUMAE.faHQ287.', 'Max', 'Verstappen', 'max-verstappen', 'max@gmail.com', '1699212233', 'Cego', 5),
(18, 'tombrady', '$2y$10$3lYpT8ODB3zMyxdz.C5fzuHA6yQdmYaYO1QgGhqkjpMap0s3it7VW', 'Tom', 'Brady', 'tom-brady', 'tom@gmail.com', '1699221100', 'Baixa', 5),
(19, 'jonathancalleri', '$2y$10$0FuvseLjq0/tIsxrWKF9UOy/f8jaauYsv3S8pAgyh7YV1RD/bRRke', 'Jonathan', 'Calleri', 'jonathan-calleri', 'jonathan@gmail.com', '1688991100', 'Baixa', 5),
(20, 'rogerioceni', '$2y$10$zu38AI7qrCagbp9e/URMuev7EVvFiDhmi0QDBiknIlIQVYr3V2EhK', 'Rogério', 'Ceni', 'rogerio-ceni', 'rogerioceni@gmail.com', '1699110032', 'Baixa', 5),
(21, 'aynrand', '$2y$10$LMJ.fkL/BJZZI/8GJpGKZOUJZfGG7OrEtXF6W6fssdPliEPUy/YVS', 'Ayn', 'Rand', 'ayn-rand', 'ayn@gmail.com', '1699201221', 'Cego', 5),
(22, 'jkrowling', '$2y$10$EQf23gdIH46N6XPxrhVbfe5mUfOVpxJfykQCiBC6jcSaKfiw1Dh7C', 'Joanne', 'Kathleen Rowling', 'joanne-kathleen-rowling', 'jk@gmail.com', '16992103201', 'Baixa', 5),
(23, 'agathachristie', '$2y$10$weHOajHTTmAmDUEkmo8AgeWtB520nfxHARv1owpzNPkbA4YFfM/gq', 'Agatha', 'Christie', 'agatha-christie', 'agatha@gmail.com', '1699210391', 'Cego', 5),
(24, 'magnuscarlsen', '$2y$10$qpjwgvYnTf1ibH4Z06ATA.PaPlekQ3ErBufTWKWX/MPDQxk1bnfqq', 'Magnus', 'Carlsen', 'magnus-carlsen', 'magnus@gmail.com', '16992010141', 'Baixa', 5),
(25, 'mises', '$2y$10$cgurnX693EqiFs00gDzRkewetOzTs1tNIhAgvdEysacjxw9SQhWl.', 'Ludwig', 'Von Mises', 'ludwig-von-mises', 'mises@gmail.com', '1693019442', 'Baixa', 3);

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
-- Índices para tabela `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`colaborador_id`),
  ADD KEY `info_id` (`info_id`),
  ADD KEY `tipo_id` (`tipo_id`);

--
-- Índices para tabela `educando`
--
ALTER TABLE `educando`
  ADD PRIMARY KEY (`educando_id`),
  ADD KEY `info_id` (`info_id`);

--
-- Índices para tabela `impressao`
--
ALTER TABLE `impressao`
  ADD PRIMARY KEY (`impressao_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`info_id`);

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
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `colaborador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `educando`
--
ALTER TABLE `educando`
  MODIFY `educando_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `impressao`
--
ALTER TABLE `impressao`
  MODIFY `impressao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `info`
--
ALTER TABLE `info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `login_token`
--
ALTER TABLE `login_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `projeto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tipo`
--
ALTER TABLE `tipo`
  MODIFY `tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`educando_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`professor_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Limitadores para a tabela `colaborador`
--
ALTER TABLE `colaborador`
  ADD CONSTRAINT `colaborador_ibfk_2` FOREIGN KEY (`info_id`) REFERENCES `info` (`info_id`),
  ADD CONSTRAINT `colaborador_ibfk_3` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`tipo_id`);

--
-- Limitadores para a tabela `educando`
--
ALTER TABLE `educando`
  ADD CONSTRAINT `educando_ibfk_1` FOREIGN KEY (`info_id`) REFERENCES `info` (`info_id`);

--
-- Limitadores para a tabela `impressao`
--
ALTER TABLE `impressao`
  ADD CONSTRAINT `impressao_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Limitadores para a tabela `login_token`
--
ALTER TABLE `login_token`
  ADD CONSTRAINT `login_token_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
