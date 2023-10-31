-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Out-2023 às 16:58
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `microblog_tiago`
--
CREATE DATABASE IF NOT EXISTS `microblog_tiago` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `microblog_tiago`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` smallint(6) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Segurança'),
(2, 'Mercado'),
(4, 'Mobile'),
(5, 'Games'),
(6, 'Educação'),
(7, 'Desenvolvimento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `id` mediumint(9) NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `titulo` varchar(150) NOT NULL,
  `texto` text NOT NULL,
  `resumo` tinytext NOT NULL,
  `imagem` varchar(45) NOT NULL,
  `destaque` enum('sim','nao') NOT NULL,
  `usuario_id` smallint(6) DEFAULT NULL,
  `categoria_id` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`id`, `data`, `titulo`, `texto`, `resumo`, `imagem`, `destaque`, `usuario_id`, `categoria_id`) VALUES
(1, '2023-10-25 08:38:56', 'Udacity lança curso de deep learning em português', 'Deep learning é o tema do momento dentre as empresas do Vale do Silício: o reconhecimento facial do Facebook, a assistente virtual Siri, o carro autônomo do Google e o diagnóstico de um tipo raro de câncer pelo IBM Watson são apenas algumas possíveis aplicações. Por meio desta tecnologia, sistemas cada vez mais inteligentes estão sendo desenvolvidos e resolvendo problemas de altíssima complexidade.&#13;&#10;&#13;&#10;Brasileiros agora já conseguem se especializar nesta área: a Udacity – a Universidade do Vale do Silício – lançou em português o programa Nanodegree Fundamentos de Deep Learning. Tipos e arquiteturas de redes neurais, reconhecimento de objetos, bots inteligentes, drone image tracking, previsão do mercado de ações e visualização de dados são alguns dos conceitos e aplicações abordados no curso.&#13;&#10;&#13;&#10;“Deep learning é uma tecnologia transformadora que já vemos à nossa volta todos os dias em imagens médicas, pesquisas do Google, carros autônomos e muito mais. Estamos apenas no início do que esta tecnologia pode fazer por nós, mal posso esperar para ver o que nossos alunos construirão em seguida”, comenta Sebastian Thrun, professor de Stanford e fundador da Udacity.&#13;&#10;&#13;&#10;Deep learning é o tema do momento dentre as empresas do Vale do Silício: o reconhecimento facial do Facebook, a assistente virtual Siri, o carro autônomo do Google e o diagnóstico de um tipo raro de câncer pelo IBM Watson são apenas algumas possíveis aplicações. Por meio desta tecnologia, sistemas cada vez mais inteligentes estão sendo desenvolvidos e resolvendo problemas de altíssima complexidade.&#13;&#10;&#13;&#10;Brasileiros agora já conseguem se especializar nesta área: a Udacity – a Universidade do Vale do Silício – lançou em português o programa Nanodegree Fundamentos de Deep Learning. Tipos e arquiteturas de redes neurais, reconhecimento de objetos, bots inteligentes, drone image tracking, previsão do mercado de ações e visualização de dados são alguns dos conceitos e aplicações abordados no curso.&#13;&#10;&#13;&#10;“Deep learning é uma tecnologia transformadora que já vemos à nossa volta todos os dias em imagens médicas, pesquisas do Google, carros autônomos e muito mais. Estamos apenas no início do que esta tecnologia pode fazer por nós, mal posso esperar para ver o que nossos alunos construirão em seguida”, comenta Sebastian Thrun, professor de Stanford e fundador da Udacity.', 'A Udacity lançou em português o programa Nanodegree Fundamentos de Deep Learning, que abordará temas como tipos e arquiteturas de redes neurais, reconhecimento de objetos, bots inteligentes, drone image tracking, entre outros.', 'felicidade.jpg', 'nao', 3, 6),
(2, '2023-10-25 08:39:37', 'Chrome vai marcar sites HTTP no modo de navegação anônima como não seguros', 'O Google anunciou ontem o segundo passo no seu plano de marcar todos os sites HTTP como não seguros no Chrome. A partir de outubro de 2017, o Chrome marcará sites HTTP com dados inseridos e sites HTTP no modo de navegação anônima como não seguros.&#13;&#10;&#13;&#10;O HTTPS é uma versão mais segura do protocolo HTTP usado na Internet para conectar usuários a sites. As conexões seguras são consideradas uma medida necessária para diminuir o risco de os usuários serem vulneráveis à injeção de conteúdo, o que pode resultar em espionagem, ataques man-in-the-middle e modificação de outros dados.&#13;&#10;&#13;&#10;Os dados são mantidos seguros de terceiros, e os usuários podem ficar mais confiantes de que estão se comunicando com o site correto.&#13;&#10;&#13;&#10;O Google anunciou ontem o segundo passo no seu plano de marcar todos os sites HTTP como não seguros no Chrome. A partir de outubro de 2017, o Chrome marcará sites HTTP com dados inseridos e sites HTTP no modo de navegação anônima como não seguros.&#13;&#10;&#13;&#10;O HTTPS é uma versão mais segura do protocolo HTTP usado na Internet para conectar usuários a sites. As conexões seguras são consideradas uma medida necessária para diminuir o risco de os usuários serem vulneráveis à injeção de conteúdo, o que pode resultar em espionagem, ataques man-in-the-middle e modificação de outros dados.&#13;&#10;&#13;&#10;Os dados são mantidos seguros de terceiros, e os usuários podem ficar mais confiantes de que estão se comunicando com o site correto.', 'A partir de outubro de 2017, o Chrome marcará sites HTTP com dados inseridos e sites HTTP no modo de navegação anônima como não seguros.', 'sanduiche.jpg', 'sim', 3, 1),
(3, '2023-10-25 08:40:26', 'Estudo aponta que profissionais de TI certificados têm desempenho melhor', 'A tecnologia da informação é uma área vital para a maioria das empresas atualmente e uma das que mais crescem em oportunidades de trabalho. &#13;&#10;&#13;&#10;Ter as habilidades certas dá aos profissionais da TI a confiança necessária para atender às demandas dos empregadores, aumentando seu desempenho e o da organização.&#13;&#10;&#13;&#10;De acordo com da IDC, profissionais certificados têm um desempenho melhor e mais domínio de conhecimento em relação àqueles que não são certificados.&#13;&#10;&#13;&#10;O estudo da IDC comparando duas equipes, com e sem as certificações, com um conjunto de tarefas específicas e objetivamente mensuráveis, mostrou que os funcionários certificados realizaram tarefas de forma mais confiável e consistente.&#13;&#10;&#13;&#10;Leonard Wadewitz, diretor da CompTIA para América Latina e Caribe, conta que esses resultados atendem às principais perspectivas que líderes de TI e CIOs têm para sua equipe: rapidez e assertividade no dia a dia e na resolução de problemas.&#13;&#10;&#13;&#10;A tecnologia da informação é uma área vital para a maioria das empresas atualmente e uma das que mais crescem em oportunidades de trabalho. Ter as habilidades certas dá aos profissionais da TI a confiança necessária para atender às demandas dos empregadores, aumentando seu desempenho e o da organização.&#13;&#10;&#13;&#10;De acordo com da IDC, profissionais certificados têm um desempenho melhor e mais domínio de conhecimento em relação àqueles que não são certificados.&#13;&#10;&#13;&#10;O estudo da IDC comparando duas equipes, com e sem as certificações, com um conjunto de tarefas específicas e objetivamente mensuráveis, mostrou que os funcionários certificados realizaram tarefas de forma mais confiável e consistente.&#13;&#10;&#13;&#10;Leonard Wadewitz, diretor da CompTIA para América Latina e Caribe, conta que esses resultados atendem às principais perspectivas que líderes de TI e CIOs têm para sua equipe: rapidez e assertividade no dia a dia e na resolução de problemas.', 'Estudo comparando duas equipes, com e sem certificações, mostrou que os funcionários certificados realizaram tarefas de forma mais confiável e consistente.', 'mais.jpg', 'sim', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` smallint(6) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('admin','editor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`) VALUES
(1, 'Tiago', 'tiago@msn.com', '$2y$10$0cEpcP3OmwFx1l2t269Pq.l/MEyXz.l1QONGbhSikGg2HNFh4ynFa', 'admin'),
(2, 'Fulanaaaa da Silva', 'fulana@silva.com', '$2y$10$b2IhCddQ3.EVMTKbEzlOYuI.qQQNKrqfT1HO1Dlqmj//j2LHUtZhK', 'admin'),
(3, 'Detonator', 'detonator@massacration.com', '$2y$10$n.vGauobc8SGs5NPx2cXneonaFsmCqygSVOv6k17b6ns2w5hpdD4G', 'editor'),
(4, 'Binho', 'binho@msn.com', '$2y$10$9gsvpsUtGtx3y.RXcje.d.AN5dFXHT8dHe8zY9GkL.Z/sFhjnW.jK', 'editor');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_noticias_usuarios` (`usuario_id`),
  ADD KEY `fk_noticias_categorias` (`categoria_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_noticias_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_noticias_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
