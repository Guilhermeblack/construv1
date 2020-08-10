-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 29-Ago-2019 às 10:33
-- Versão do servidor: 5.6.41-84.1
-- versão do PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `immob049_construcao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(10) UNSIGNED NOT NULL,
  `nome_cli` varchar(255) DEFAULT NULL,
  `cpf_cli` varchar(80) DEFAULT NULL,
  `rg_cli` varchar(80) DEFAULT NULL,
  `estadocivil_cli` varchar(80) DEFAULT NULL,
  `nacionalidade_cli` varchar(100) DEFAULT NULL,
  `profissao_cli` varchar(100) DEFAULT NULL,
  `nascimento_cli` varchar(80) DEFAULT NULL,
  `email_cli` varchar(80) DEFAULT NULL,
  `cidade_cli` varchar(80) DEFAULT NULL,
  `logradouro_cli` varchar(80) DEFAULT NULL,
  `endereco_cli` varchar(200) DEFAULT NULL,
  `numero_cli` varchar(10) DEFAULT NULL,
  `complemento_cli` varchar(80) DEFAULT NULL,
  `bairro_cli` varchar(100) DEFAULT NULL,
  `cep_cli` varchar(80) DEFAULT NULL,
  `telefone1_cli` varchar(40) DEFAULT NULL,
  `telefone2_cli` varchar(80) DEFAULT NULL,
  `obs_cli` text,
  `estado_cli` varchar(10) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `imob_id` int(11) NOT NULL,
  `creci` varchar(20) NOT NULL,
  `insc_municipal` varchar(40) NOT NULL,
  `cadastrado_por` int(11) NOT NULL,
  `data_cadastro` varchar(40) NOT NULL,
  `alterado_por` int(11) NOT NULL,
  `data_alterado` varchar(40) NOT NULL,
  `fisico_juridico` int(11) NOT NULL,
  `categoria_cliente` int(11) NOT NULL,
  `cargo` varchar(200) NOT NULL,
  `salario_base` varchar(40) NOT NULL,
  `data_contratacao` varchar(20) NOT NULL,
  `data_demissao` varchar(20) NOT NULL,
  `foto_cli` varchar(200) NOT NULL,
  `cpf_rfb` varchar(40) NOT NULL,
  `renda_total` varchar(40) NOT NULL,
  `telefone3_cli` varchar(40) DEFAULT NULL,
  `path_foto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nome_cli`, `cpf_cli`, `rg_cli`, `estadocivil_cli`, `nacionalidade_cli`, `profissao_cli`, `nascimento_cli`, `email_cli`, `cidade_cli`, `logradouro_cli`, `endereco_cli`, `numero_cli`, `complemento_cli`, `bairro_cli`, `cep_cli`, `telefone1_cli`, `telefone2_cli`, `obs_cli`, `estado_cli`, `senha`, `idgrupo`, `imob_id`, `creci`, `insc_municipal`, `cadastrado_por`, `data_cadastro`, `alterado_por`, `data_alterado`, `fisico_juridico`, `categoria_cliente`, `cargo`, `salario_base`, `data_contratacao`, `data_demissao`, `foto_cli`, `cpf_rfb`, `renda_total`, `telefone3_cli`, `path_foto`) VALUES
(1, 'immobile', '', '', '-1', '', '', '', 'immobile', '', NULL, '', '', '', '', '', '', '', '', '', '1234', 5, 0, '', '', 0, '', 1, '26-06-2019 15:22:07', 0, 0, '', '', '', '', '', '', '', '', 'img/perfil/13428478_1559384814364044_585699133798657119_n.png'),
(15, 'Murilo Passareli', '376.953.358-51', '', 'Solteiro(a)', 'Brasileiro', 'Arquiteto', '27-06-1991', 'murilo-apassareli@hotmail.com', 'Franca', NULL, 'Rua Frei Agostinho de Jesus', '459', '', 'Vila Santa Terezinha', '14409297', '(16) 99201-6069', '', '', 'SP', '1234', 14, 0, '', '', 1, '20-08-2019 15:01:48', 1, '20-08-2019 15:13:44', 1, 0, 'Arquiteto', '', '', '', '', '', '', '', 'img/perfil/'),
(16, 'Kelly Carrijo', '445.936.748-32', '', 'Solteiro(a)', 'Brasileira', '', '28-12-1996', 'kellycarrijo28@hotmail.com', 'Franca', NULL, 'Rua Joao Moritz Rugendas', '470', '', 'Parque Residencial Nova Franca', '14409216', '(16) 99320-8423', '', '', 'SP', '1234', 5, 0, '', '', 1, '20-08-2019 15:04:01', 0, '', 1, 0, 'Estagiario', '', '', '', '', '', '', '', 'img/perfil/'),
(17, 'Ac Torres Empreendimentos Imobiliarios LTDA', '17.552.478/0001-27', '', '', '', '', '', 'comprasactorres@hotmail.com', 'Franca', NULL, 'Avenida Rio Amazonas', '680', '', 'Residencial Amazonas', '14406010', '', '', '', 'SP', '1234', 5, 0, '', '', 1, '20-08-2019 15:09:48', 0, '', 2, 0, '', '', '', '', '', '37695335851', '', '', 'img/perfil/'),
(18, 'Fornecedor 1', '189.075.990-25', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 1, '21-08-2019 11:54:42', 0, '', 1, 0, '', '', '', '', '', '', '', '', 'img/perfil/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
