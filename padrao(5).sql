-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27-Mar-2015 às 21:20
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `painelnovo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `metodo` varchar(255) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `data` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `usuario_nome` varchar(255) NOT NULL,
  `descricao` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=156 ;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id`, `modulo`, `controller`, `metodo`, `ip`, `data`, `usuario_id`, `usuario_nome`, `descricao`) VALUES
(151, 'default', 'usuariogrupo', 'editar-acao', '127.0.0.1', 1423482598, 2, 'Paulo', 'Edição do Grupo Usuário'),
(152, 'default', 'usuariogrupo', 'editar-acao', '127.0.0.1', 1423482618, 2, 'Paulo', 'Edição do Grupo Usuário'),
(153, 'default', 'usuariogrupo', 'editar-acao', '127.0.0.1', 1423482847, 2, 'Paulo', 'Edição do Grupo Usuário'),
(154, 'default', 'usuariogrupo', 'cadastrar-acao', '127.0.0.1', 1423482991, 2, 'Paulo', 'Cadastro do Grupo Usuário'),
(155, 'default', 'usuariogrupo', 'excluir', '127.0.0.1', 1423483005, 2, 'Paulo', 'Exclusão do Grupo Usuário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `membro`
--

CREATE TABLE IF NOT EXISTS `membro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(40) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cep` varchar(40) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `profissao` varchar(255) NOT NULL,
  `batizado` int(11) NOT NULL,
  `discipulador` varchar(255) NOT NULL,
  `estado_civil` varchar(255) NOT NULL,
  `conjuge` varchar(255) NOT NULL,
  `data_casamento` date NOT NULL,
  `filho` int(11) NOT NULL,
  `qtd_filho` varchar(255) NOT NULL,
  `pre_encontro` int(11) NOT NULL,
  `pre_encontro_local` varchar(400) NOT NULL,
  `encontro_com_deus` int(11) NOT NULL,
  `encontro_com_deus_local` varchar(400) NOT NULL,
  `pos_encontro` int(11) NOT NULL,
  `pos_encontro_local` varchar(400) NOT NULL,
  `reencontro` int(11) NOT NULL,
  `reencontro_local` varchar(400) NOT NULL,
  `mover_celular` int(11) NOT NULL,
  `mover_celular_local` varchar(255) NOT NULL,
  `resgatao` int(11) NOT NULL,
  `resgatao_local` varchar(400) NOT NULL,
  `revisao` int(11) NOT NULL,
  `revisao_local` varchar(400) NOT NULL,
  `levita` int(11) NOT NULL,
  `levita_local` varchar(400) NOT NULL,
  `texto` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Extraindo dados da tabela `membro`
--

INSERT INTO `membro` (`id`, `nome`, `email`, `senha`, `telefone`, `data_nascimento`, `cep`, `cidade`, `bairro`, `celular`, `profissao`, `batizado`, `discipulador`, `estado_civil`, `conjuge`, `data_casamento`, `filho`, `qtd_filho`, `pre_encontro`, `pre_encontro_local`, `encontro_com_deus`, `encontro_com_deus_local`, `pos_encontro`, `pos_encontro_local`, `reencontro`, `reencontro_local`, `mover_celular`, `mover_celular_local`, `resgatao`, `resgatao_local`, `revisao`, `revisao_local`, `levita`, `levita_local`, `texto`, `status`) VALUES
(20, 'Paulo Henrique Pereira', 'paulo@netsuprema.com.br', 'e10adc3949ba59abbe56e057f20f883e', '(62) 8107-1807', '2015-02-02', '', 'Goiânia', 'Jardim Bela Vista', '(12) 6516-5165', '', 0, 'Uere', '2', 'teste', '0000-00-00', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '0', 0, '', 0, '', 0, '', 'teste', 0),
(23, 'Paulo Henrique Pereira', 'paulo@pixelgo.com.br', '25f9e794323b453885f5181f1b624d0b', '(16) 5165-1651', '1987-01-22', '', 'Goiânia', 'Jardim Bela Vista', '(15) 1651-6515', '', 1, 'Paulo', '2', 'Taynara', '0000-00-00', 1, '1', 1, 'Characa', 0, '', 0, '', 0, '', 0, '0', 0, '', 0, '', 0, '', '', 0),
(28, 'Lucas das Candogas', 'luca.dias.silva@gmail.com', '25f9e794323b453885f5181f1b624d0b', '(54) 3542-3542', '1987-02-15', '74.778-878', 'Goiânia', 'Jardim Bela Vista', '(54) 2354-3254', 'fsda543', 0, 'teste', '1', '', '0000-00-00', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulo`
--

CREATE TABLE IF NOT EXISTS `modulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `nome_menu` varchar(255) NOT NULL,
  `modulo_grupo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Extraindo dados da tabela `modulo`
--

INSERT INTO `modulo` (`id`, `nome`, `nome_menu`, `modulo_grupo_id`) VALUES
(61, 'default:index', 'Home', 1),
(62, 'default:logs', 'Logs', 0),
(63, 'default:membro', 'Membro', 0),
(64, 'default:usuario', 'Usuário', 1),
(65, 'default:usuariogrupo', 'Usuário Grupo', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulo_grupo`
--

CREATE TABLE IF NOT EXISTS `modulo_grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `modulo_grupo`
--

INSERT INTO `modulo_grupo` (`id`, `nome`, `status`) VALUES
(1, 'Usuário', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE IF NOT EXISTS `permissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `permissao` varchar(255) NOT NULL DEFAULT 'allow',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`role_id`,`resource_id`,`permissao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resource` (`resource`),
  KEY `modulo_id` (`modulo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Extraindo dados da tabela `resource`
--

INSERT INTO `resource` (`id`, `resource`, `role_id`, `modulo_id`, `nome`) VALUES
(84, 'index', 1, 61, 'Listar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  `id_parent` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `role`
--

INSERT INTO `role` (`id`, `role`, `id_parent`) VALUES
(1, 'ROOT', 0),
(3, 'Usuário', 0),
(14, 'teste', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '',
  `senha` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_usuario_usuario_grupo1_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `senha`, `email`, `img`, `status`, `role_id`) VALUES
(2, 'Paulo', 'bdbe3051e3908442241f74aed765e822', 'paulo@pixelgo.com.br', '', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `resource`
--
ALTER TABLE `resource`
  ADD CONSTRAINT `resource_ibfk_1` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
